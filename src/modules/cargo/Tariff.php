<?php
/**
 * This class is a part of Cargo project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace modules\cargo;
use \classes\Auth as Auth;
use \classes\JSON as JSON;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use \modules\enterprise\Util as Util;
use PDO;
	/**
     * A class for tariff management cargo
     *
     * @package    Tariff Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class Tariff {
        // model data tariff
        var $username,$branchid,$kabupaten,$kgp,$kgs,$minkg,$estimasi,$origin,$destination,$length,$width,$height,$weight,$cubic,$modeid,$mode;

        // for pagination
		var $page,$itemsPerPage;

		// for search
		var $search;

		// for multi language
		var $lang;

		protected $db;
        
        function __construct($db=null) {
			if (!empty($db)) 
	        {
    	        $this->db = $db;
        	}
        }
        
		//TARIFF=================================
		
		/**
		 * Round decimal value with custom nearest point number
		 *
		 * @param numToRound is the value number to round
		 * @param pointDecimal is the nearest point
		 * @return decimal
		 */
		private function limitRound($numToRound,$pointDecimal=0.5){
			$value = 0;
			if(($numToRound - floor($numToRound)) >= $pointDecimal){
				$value = 1;
			} else {
				$value = 0;
			}
			return floor($numToRound + $value);
		}

		/**
		 * Determine value is number or decimal
		 * 
		 * @param val is the string
		 * @return bool
		 */
		private function is_decimal($val){
			if ($val == 0) return true;
			if (is_numeric($val)) return true;
			return is_numeric( $val ) && floor( $val ) != $val;
		}

		/**
		 * Calculate Volume Kg for Cargo
		 * @return number
		 */
		private function calculateVolKg(){
			$result =0;
			$cargovol = 0;

			$ilength = ($this->is_decimal($this->length)?$this->length:0);
			$iwidth = ($this->is_decimal($this->width)?$this->width:0);
			$iheight = ($this->is_decimal($this->height)?$this->height:0);
			$icubic = $this->cubic;
			
			switch ($this->mode) {
				case "air":
					$cargovol = 6000;
					break;
				case "sea":
					if ($icubic=='true') {
						$cargovol = 1000000;
					} else {
						$cargovol = 4000;
					}
					break;
				default:
					$cargovol = 4000;
			}
			
			$temp    = ($ilength * $iwidth * $iheight) / $cargovol;
			if ($temp>0 && $temp<1){
				$result = 1;
			} else if ($temp<0){
				$result = 0;
			} else {
				$result = $temp;
			}
			return $result;
		}

        public function addTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
			        $newbranchid = strtolower($this->branchid);
					$newest = Validation::integerOnly($this->estimasi);
					$newmodeid = Validation::integerOnly($this->modeid);

        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO tariff_data (BranchID,Kabupaten,KGP,KGS,Min_Kg,Estimasi,ModeID) 
        					VALUES (:branchid,:kabupaten,:kgp,:kgs,:minkg,:estimasi,:modeid);";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
						$stmt->bindParam(':estimasi', $newest, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101',$this->lang)
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201',$this->lang)
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
    			    	$data = [
	    			    	'status' => 'error',
		    			    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    			    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
                ];
            }
			
			return JSON::encode($data,true);
			$this->db = null;
        }

        public function updateTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
			        $newbranchid = strtolower($this->branchid);
					$newest = Validation::integerOnly($this->estimasi);
					$newmodeid = Validation::integerOnly($this->modeid);
        			try {
		        		$this->db->beginTransaction();
				        $sql = "UPDATE tariff_data SET KGP=:kgp,KGS=:kgs,Min_Kg=:minkg,Estimasi=:estimasi 
        					WHERE BranchID=:branchid AND Kabupaten=:kabupaten AND ModeID=:modeid;";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
						$stmt->bindParam(':estimasi', $newest, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS103',
				    			'message' => CustomHandlers::getreSlimMessage('RS103',$this->lang)
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203',$this->lang)
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
    			    	$data = [
	    			    	'status' => 'error',
		    			    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    			    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
                ];
            }
			
			return JSON::encode($data,true);
			$this->db = null;
        }

        public function deleteTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
					$newbranchid = strtolower($this->branchid);
					$newmodeid = Validation::integerOnly($this->modeid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM tariff_data WHERE BranchID = :branchid AND Kabupaten=:kabupaten AND ModeID=:modeid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
						$stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $this->modeid, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104',$this->lang)
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204',$this->lang)
				    		];
						}
						
						$this->db->commit();
                    } catch (PDOException $e){
                        $data = [
                            'status' => 'error',
                            'code' => $e->getCode(),
                            'message' => $e->getMessage()
                        ];
                        $this->db->rollBack();
                    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
			} else {
				$data = [
	    			'status' => 'error',
				    'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
    			];
			}
		    return JSON::encode($data,true);
    		$this->db = null;
        }

        public function searchTariffAsPagination(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower($this->username);
				$search = "%$this->search%";
				$roles = Auth::getRoleID($this->db,$this->token);
				if ($roles < 3 || $roles == 6){
					//count total row
					$sqlcountrow = "SELECT count(a.BranchID) as TotalRow 
						from (
									SELECT x.BranchID,x.Kabupaten,x.ModeID,y.Mode,x.Estimasi,x.KGP,x.KGS,x.Min_Kg
									FROM tariff_data x
									INNER JOIN mas_mode y ON x.ModeID = y.ModeID
								) as a
						left join tariff_handling b on a.Kabupaten=b.Kabupaten and b.ModeID = a.ModeID
						where a.BranchID like :search
						or a.Kabupaten like :search
						order by a.Kabupaten asc;";
					$stmt = $this->db->prepare($sqlcountrow);		
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				} else {
					//count total row
					$sqlcountrow = "SELECT count(x.BranchID) as TotalRow 
						from (
							SELECT a.BranchID,a.Kabupaten,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg' 
							from (
									SELECT x.BranchID,x.Kabupaten,x.ModeID,y.Mode,x.Estimasi,x.KGP,x.KGS,x.Min_Kg,
										(SELECT a.BranchID FROM sys_user a WHERE a.Username = :username) as UserBranch
									FROM tariff_data x
									INNER JOIN mas_mode y ON x.ModeID = y.ModeID
									HAVING x.BranchID = UserBranch
								) as a
							left join tariff_handling b on a.Kabupaten=b.Kabupaten and b.ModeID = a.ModeID
							where a.Kabupaten like :search
							order by a.Kabupaten asc
						) x;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				}
				
				if ($stmt->execute()) {	
    	    		if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);
						
						if ($roles < 3){
							// Query Data
							$sql = "SELECT a.BranchID,a.Kabupaten,a.ModeID,a.Mode,a.Estimasi,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg'
								from (
									SELECT x.BranchID,x.Kabupaten,x.ModeID,y.Mode,x.Estimasi,x.KGP,x.KGS,x.Min_Kg
									FROM tariff_data x
									INNER JOIN mas_mode y ON x.ModeID = y.ModeID
								) as a
								left join tariff_handling b on a.Kabupaten=b.Kabupaten and b.ModeID = a.ModeID
								where a.BranchID like :search
								or a.Kabupaten like :search
								order by a.Kabupaten asc limit :limpage,:offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						} else {
							// Query Data
							$sql = "SELECT a.BranchID,a.Kabupaten,a.ModeID,a.Mode,a.Estimasi,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg' 
								from (
									SELECT x.BranchID,x.Kabupaten,x.ModeID,y.Mode,x.Estimasi,x.KGP,x.KGS,x.Min_Kg,
										(SELECT a.BranchID FROM sys_user a WHERE a.Username = :username) as UserBranch
									FROM tariff_data x
									INNER JOIN mas_mode y ON x.ModeID = y.ModeID
									HAVING x.BranchID = UserBranch
								) as a
								left join tariff_handling b on a.Kabupaten=b.Kabupaten and b.ModeID = a.ModeID
								where a.Kabupaten like :search
								order by a.Kabupaten asc limit :limpage,:offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						}
							
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->lang = $this->lang;
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
								];	
							}			
				    } else {
    	    			$data = [
        	    			'status' => 'error',
		    	    		'code' => 'RS601',
        			    	'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
		    	    }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
				
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}
		
		public function searchTariff(){
			if (Auth::validToken($this->db,$this->token)){
				switch ($this->mode) {
					case "air":
						$mode = ucwords('air');
						$modeid = '1';
						break;
					case "road":
						$mode = ucwords('road');
						$modeid = '2';
						break;
					case "sea":
						$mode = ucwords('sea');
						$modeid = '3';
						break;
					default:
						$mode = ucwords('road');
						$modeid = '2';
				}

				$origin = "$this->origin";
				$destination = "$this->destination";

				$iweight = ($this->is_decimal($this->weight)?$this->weight:1);
				$volumekg = $this->calculateVolKg();
				if ($iweight >= $volumekg){
					$weight = $iweight;
				} else {
					$weight = $volumekg;
				}

				if (!empty($weight) || $weight==0){
					$realkg = $weight;
					$weight = $this->limitRound($weight,0.3);
					$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,ifnull(c.KGP,0) as 'H_KGP',ifnull(c.KGS,0) as 'H_KGS',ifnull(c.Min_Kg,0) as 'H_Min_Kg',a.Estimasi,
							($weight) as Kg,($volumekg) as VolKg,($realkg) as RealKg,
							if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
							ifnull(if($weight <= c.Min_Kg,c.KGP, (($weight - c.Min_Kg) * c.KGS) + c.KGP),0) as 'Handling',
							('$mode') as Mode
						FROM tariff_data a
						INNER JOIN sys_company b ON a.BranchID = b.BranchID
						LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten and c.ModeID = a.ModeID
						WHERE b.`Name` = :origin and a.Kabupaten = :destination and a.ModeID = '".$modeid."';";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
					$stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
	
					if ($stmt->execute()) {	
						if ($stmt->rowCount() > 0){
							$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$data = [
								'results' => $results, 
								'status' => 'success', 
								'code' => 'RS501',
								'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
							];
						} else {
							$data = [
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
						];
					}	
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS801',
						'message' => CustomHandlers::getreSlimMessage('RS801',$this->lang)
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}

		public function searchTariffPublic(){
			switch ($this->mode) {
				case "air":
					$mode = ucwords('air');
					$modeid = '1';
					break;
				case "road":
					$mode = ucwords('road');
					$modeid = '2';
					break;
				case "sea":
					$mode = ucwords('sea');
					$modeid = '3';
					break;
				default:
					$mode = ucwords('road');
					$modeid = '2';
			}

			$origin = "$this->origin";
			$destination = "$this->destination";
		
			$iweight = ($this->is_decimal($this->weight)?$this->weight:0);
			$volumekg = $this->calculateVolKg();
			if ($iweight >= $volumekg){
				$weight = $iweight;
			} else {
				$weight = $volumekg;
			}

			if (!empty($weight) || $weight==0){
				$realkg = $weight;
				$weight = $this->limitRound($weight,0.3);
				$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,a.Estimasi,
						($weight) as Kg,($volumekg) as VolKg,($realkg) as RealKg,
						if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
						('$mode') as Mode				
					FROM tariff_data a
					INNER JOIN sys_company b ON a.BranchID = b.BranchID
					LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten and c.ModeID = a.ModeID
					WHERE b.`Name` = :origin and a.Kabupaten = :destination and a.ModeID='".$modeid."';";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
				$stmt->bindParam(':destination', $destination, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    			    if ($stmt->rowCount() > 0){
    		   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   		        'results' => $results, 
    	    	    	    'status' => 'success', 
		           	    	'code' => 'RS501',
	    		        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
				    } else {
        			    $data = [
        			    	'status' => 'error',
	        			    'code' => 'RS601',
    		    	    	'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
		    	    }          	   	
				} else {
					$data = [
        				'status' => 'error',
						'code' => 'RS202',
		        		'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}	
			} else {
				$data = [
					'status' => 'error',
					'code' => 'RS801',
					'message' => CustomHandlers::getreSlimMessage('RS801',$this->lang)
				];
			}
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}

		public function searchTariffList(){
			if (Auth::validToken($this->db,$this->token)){
				$origin = "$this->origin";
				$destination = "$this->destination";
		
				$iweight = ($this->is_decimal($this->weight)?$this->weight:0);
				$volumekg = $this->calculateVolKg();
				if ($iweight >= $volumekg){
					$weight = $iweight;
				} else {
					$weight = $volumekg;
				}

				if (!empty($weight) || $weight==0){
					$realkg = $weight;
					$weight = $this->limitRound($weight,0.3);
					$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,a.Estimasi,
							($weight) as Kg,($volumekg) as VolKg,($realkg) as RealKg,
							if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
							REPLACE((select x.Mode from mas_mode x where x.ModeID=a.ModeID),' Freight','') as Mode				
						FROM tariff_data a
						INNER JOIN sys_company b ON a.BranchID = b.BranchID
						LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten and c.ModeID = a.ModeID
						WHERE b.`Name` = :origin and a.Kabupaten = :destination;";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
					$stmt->bindParam(':destination', $destination, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    				    if ($stmt->rowCount() > 0){
    		   			   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$data = [
				   		        'results' => $results, 
    		    	    	    'status' => 'success', 
			           	    	'code' => 'RS501',
	    			        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
							];
				    	} else {
        			    	$data = [
        			    		'status' => 'error',
		        			    'code' => 'RS601',
    			    	    	'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
							];
		    		    }          	   	
					} else {
						$data = [
        					'status' => 'error',
							'code' => 'RS202',
			        		'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
						];
					}	
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS801',
						'message' => CustomHandlers::getreSlimMessage('RS801',$this->lang)
					];
				} 
			} else {
				$data = [
					'status' => 'error',
					'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}

		public function searchTariffListPublic(){
			$origin = "$this->origin";
			$destination = "$this->destination";
		
			$iweight = ($this->is_decimal($this->weight)?$this->weight:0);
			$volumekg = $this->calculateVolKg();
			if ($iweight >= $volumekg){
				$weight = $iweight;
			} else {
				$weight = $volumekg;
			}

			if (!empty($weight) || $weight==0){
				$realkg = $weight;
				$weight = $this->limitRound($weight,0.3);
				$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,a.Estimasi,
						($weight) as Kg,($volumekg) as VolKg,($realkg) as RealKg,
						if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
						REPLACE((select x.Mode from mas_mode x where x.ModeID=a.ModeID),' Freight','') as Mode				
					FROM tariff_data a
					INNER JOIN sys_company b ON a.BranchID = b.BranchID
					LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten and c.ModeID = a.ModeID
					WHERE b.`Name` = :origin and a.Kabupaten = :destination;";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
				$stmt->bindParam(':destination', $destination, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    			    if ($stmt->rowCount() > 0){
    		   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   		        'results' => $results, 
    	    	    	    'status' => 'success', 
		           	    	'code' => 'RS501',
	    		        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
				    } else {
        			    $data = [
        			    	'status' => 'error',
	        			    'code' => 'RS601',
    		    	    	'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
		    	    }          	   	
				} else {
					$data = [
        				'status' => 'error',
						'code' => 'RS202',
		        		'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}	
			} else {
				$data = [
					'status' => 'error',
					'code' => 'RS801',
					'message' => CustomHandlers::getreSlimMessage('RS801',$this->lang)
				];
			}
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}

        //HANDLING=================================

        public function addHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO tariff_handling (Kabupaten,KGP,KGS,Min_Kg,ModeID) 
        					VALUES (:kabupaten,:kgp,:kgs,:minkg,:modeid);";
		    			$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
						$stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $this->modeid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101',$this->lang)
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201',$this->lang)
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
    			    	$data = [
	    			    	'status' => 'error',
		    			    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    			    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
                ];
            }
			
			return JSON::encode($data,true);
			$this->db = null;
        }

        public function updateHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
        			try {
		        		$this->db->beginTransaction();
				        $sql = "UPDATE tariff_handling SET KGP=:kgp,KGS=:kgs,Min_Kg=:minkg 
        					WHERE Kabupaten=:kabupaten and ModeID=:modeid;";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
						$stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $this->modeid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS103',
				    			'message' => CustomHandlers::getreSlimMessage('RS103',$this->lang)
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203',$this->lang)
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
    			    	$data = [
	    			    	'status' => 'error',
		    			    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    			    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
                ];
            }
			
			return JSON::encode($data,true);
			$this->db = null;
        }

        public function deleteHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM tariff_handling WHERE Kabupaten=:kabupaten and ModeID=:modeid;";
                        $stmt = $this->db->prepare($sql);
						$stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
						$stmt->bindParam(':modeid', $this->modeid, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104',$this->lang)
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204',$this->lang)
				    		];
						}
						
						$this->db->commit();
                    } catch (PDOException $e){
                        $data = [
                            'status' => 'error',
                            'code' => $e->getCode(),
                            'message' => $e->getMessage()
                        ];
                        $this->db->rollBack();
                    }
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
                    ];
                }
			} else {
				$data = [
	    			'status' => 'error',
				    'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
    			];
			}
		    return JSON::encode($data,true);
    		$this->db = null;
        }

        public function searchHandlingAsPagination(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower($this->username);
				$search = "%$this->search%";
				$roles = Auth::getRoleID($this->db,$this->token);
				if ($roles < 3){
					//count total row
					$sqlcountrow = "SELECT count(a.Kabupaten) as TotalRow 
						from tariff_handling a
						inner join mas_mode b on a.ModeID = b.ModeID
						where a.Kabupaten like :search
						order by a.Kabupaten asc;";
					$stmt = $this->db->prepare($sqlcountrow);		
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {
						if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
							
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);
							
							// Query Data
							$sql = "SELECT a.Kabupaten,a.ModeID,b.Mode,a.KGP,a.KGS,a.Min_Kg
								from tariff_handling a
								inner join mas_mode b on a.ModeID = b.ModeID
								where a.Kabupaten like :search
								order by a.Kabupaten asc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
								
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->lang = $this->lang;
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
									'status' => 'error',
									'code' => 'RS202',
									'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
								];	
							}			
						} else {
							$data = [
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
						];
					}
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS404',
						'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang)
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
        }

		//LIST=================================
		
		public function listOriginAuto() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower($this->username);
                if (Util::isUserActive($this->db,$this->username)){
					$sql = "SELECT b.BranchID,b.Name
						FROM sys_user a
						INNER JOIN sys_company b ON a.BranchID = b.BranchID
						WHERE b.StatusID = '1' AND a.Username = :username
						LIMIT 1;";
				
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS906',
						'message' => CustomHandlers::getreSlimMessage('RS906',$this->lang)
					];
				}
					
				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'results' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
        }

        public function listOrigin(){
			if (Auth::validToken($this->db,$this->token)){
				$search = "$this->search%";
				$sql = "SELECT a.BranchID,a.`Name`
					FROM sys_company a
					WHERE a.StatusID = '1' AND a.`Name` like :search
					ORDER BY a.`Name` ASC;";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				
				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'results' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
        }

        public function listDestination(){
			if (Auth::validToken($this->db,$this->token)){
				$search = "$this->search%";
				$sql = "SELECT DISTINCT a.Kabupaten
					FROM tariff_data a
					WHERE a.Kabupaten like :search
					ORDER BY a.Kabupaten ASC;";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':search', $search, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'results' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}
		
		public function listOriginPublic(){
			$search = "$this->search%";
			$sql = "SELECT a.BranchID,a.`Name`
				FROM sys_company a
				WHERE a.StatusID = '1' AND a.`Name` like :search
				ORDER BY a.`Name` ASC;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				
			if ($stmt->execute()) {	
    		    if ($stmt->rowCount() > 0){
    	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$data = [
			   	        'results' => $results, 
    	    		    'status' => 'success', 
			       	    'code' => 'RS501',
        	        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
					];
		        } else {
        			$data = [
            	    	'status' => 'error',
		    		    'code' => 'RS601',
        	    	    'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
					];
    	        }          	   	
			} else {
				$data = [
        			'status' => 'error',
					'code' => 'RS202',
	        		'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
        }

        public function listDestinationPublic(){
			$search = "$this->search%";
			$sql = "SELECT DISTINCT a.Kabupaten
				FROM tariff_data a
				WHERE a.Kabupaten like :search
				ORDER BY a.Kabupaten ASC;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':search', $search, PDO::PARAM_STR);

			if ($stmt->execute()) {	
    		    if ($stmt->rowCount() > 0){
    	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$data = [
			   	        'results' => $results, 
    	    		    'status' => 'success', 
			       	    'code' => 'RS501',
        	        	'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
					];
		        } else {
        			$data = [
            	    	'status' => 'error',
		    		    'code' => 'RS601',
        	    	    'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
					];
    	        }          	   	
			} else {
				$data = [
        			'status' => 'error',
					'code' => 'RS202',
	        		'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
        }
    }