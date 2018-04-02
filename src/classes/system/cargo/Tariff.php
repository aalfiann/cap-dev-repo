<?php
/**
 * This class is a part of Cargo project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\system\cargo;
use \classes\Auth as Auth;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use PDO;
	/**
     * A class for tariff management cargo
     *
     * @package    Tariff Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
	class Tariff {
        // model data tariff
        var $username,$branchid,$kabupaten,$kgp,$kgs,$minkg,$estimasi,$origin,$destination;

        // for pagination
		var $page,$itemsPerPage;

		// for search
		var $search;

		protected $db;
        
        function __construct($db=null) {
			if (!empty($db)) 
	        {
    	        $this->db = $db;
        	}
        }
        
        //TARIFF=================================

        public function addTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
			        $newbranchid = strtolower($this->branchid);
			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO tariff_data (BranchID,Kabupaten,KGP,KGS,Min_Kg,Estimasi) 
        					VALUES (:branchid,:kabupaten,:kgp,:kgs,:minkg,:estimasi);";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
                        $stmt->bindParam(':estimasi', $this->estimasi, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS407')
                ];
            }
			
			return json_encode($data);
			$this->db = null;
        }

        public function updateTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
			        $newbranchid = strtolower($this->branchid);
			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "UPDATE tariff_data SET KGP=:kgp,KGS=:kgs,Min_Kg=:minkg,Estimasi=:estimasi 
        					WHERE BranchID=:branchid AND Kabupaten=:kabupaten;";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
                        $stmt->bindParam(':estimasi', $this->estimasi, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS103',
				    			'message' => CustomHandlers::getreSlimMessage('RS103')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS407')
                ];
            }
			
			return json_encode($data);
			$this->db = null;
        }

        public function deleteTariff(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    $newbranchid = strtolower($this->branchid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM tariff_data WHERE BranchID = :branchid AND Kabupaten=:kabupaten;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104')
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
			} else {
				$data = [
	    			'status' => 'error',
				    'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401')
    			];
			}
		    return json_encode($data);
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
						from tariff_data a
						left join tariff_handling b on a.Kabupaten=b.Kabupaten
						where a.BranchID like :search
						or a.Kabupaten like :search
						order by a.Kabupaten asc;";
					$stmt = $this->db->prepare($sqlcountrow);		
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				} else {
					//count total row
					$sqlcountrow = "SELECT count(x.BranchID) as TotalRow 
						from (
							SELECT a.BranchID,a.Kabupaten,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg',
								(SELECT a.BranchID FROM sys_user a WHERE a.Username = :username) as UserBranch 
							from tariff_data a
							left join tariff_handling b on a.Kabupaten=b.Kabupaten
							where a.Kabupaten like :search
							having a.BranchID = UserBranch
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
							$sql = "SELECT a.BranchID,a.Kabupaten,a.Estimasi,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg'
								from tariff_data a
								left join tariff_handling b on a.Kabupaten=b.Kabupaten
								where a.BranchID like :search
								or a.Kabupaten like :search
								order by a.Kabupaten asc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						} else {
							// Query Data
							$sql = "SELECT a.BranchID,a.Kabupaten,a.Estimasi,a.KGP,a.KGS,a.Min_Kg,ifnull(b.KGP,0) as 'H_KGP',ifnull(b.KGS,0) as 'H_KGS',ifnull(b.Min_Kg,0) as 'H_Min_Kg',
									(SELECT a.BranchID FROM sys_user a WHERE a.Username = :username) as UserBranch 
								from tariff_data a
								left join tariff_handling b on a.Kabupaten=b.Kabupaten
								where a.Kabupaten like :search
								having a.BranchID = UserBranch
								order by a.Kabupaten asc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						}
							
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				    } else {
    	    			$data = [
        	    			'status' => 'error',
		    	    		'code' => 'RS601',
        			    	'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		    	    }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
				
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
		}
		
		public function searchTariff(){
			if (Auth::validToken($this->db,$this->token)){
				$origin = "$this->origin";
				$destination = "$this->destination";
				$weight = Validation::integerOnly($this->weight);
				if (!empty($weight)){
					$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,ifnull(c.KGP,0) as 'H_KGP',ifnull(c.KGS,0) as 'H_KGS',ifnull(c.Min_Kg,0) as 'H_Min_Kg',a.Estimasi,
							if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
							ifnull(if($weight <= c.Min_Kg,c.KGP, (($weight - c.Min_Kg) * c.KGS) + c.KGP),0) as 'Handling',
							((Select Tariff)+(Select Handling)) as 'Total'
						FROM tariff_data a
						INNER JOIN sys_company b ON a.BranchID = b.BranchID
						LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten
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
								'message' => CustomHandlers::getreSlimMessage('RS501')
							];
						} else {
							$data = [
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601')
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}	
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS801',
						'message' => CustomHandlers::getreSlimMessage('RS801')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
		}

		public function searchTariffPublic(){
			$origin = "$this->origin";
			$destination = "$this->destination";
			$weight = Validation::integerOnly($this->weight);
			if (!empty($weight)){
				$sql = "SELECT b.`Name` as 'Origin', a.Kabupaten as 'Destination', a.KGP, a.KGS,a.Min_Kg,ifnull(c.KGP,0) as 'H_KGP',ifnull(c.KGS,0) as 'H_KGS',ifnull(c.Min_Kg,0) as 'H_Min_Kg',a.Estimasi,
						if($weight <= a.Min_Kg,a.KGP, (($weight - a.Min_Kg) * a.KGS) + a.KGP) as 'Tariff',
						ifnull(if($weight <= c.Min_Kg,c.KGP, (($weight - c.Min_Kg) * c.KGS) + c.KGP),0) as 'Handling',
						((Select Tariff)+(Select Handling)) as 'Total'
					FROM tariff_data a
					INNER JOIN sys_company b ON a.BranchID = b.BranchID
					LEFT JOIN tariff_handling c ON a.Kabupaten = c.Kabupaten
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
	    		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
				    } else {
        			    $data = [
        			    	'status' => 'error',
	        			    'code' => 'RS601',
    		    	    	'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		    	    }          	   	
				} else {
					$data = [
        				'status' => 'error',
						'code' => 'RS202',
		        		'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}	
			} else {
				$data = [
					'status' => 'error',
					'code' => 'RS801',
					'message' => CustomHandlers::getreSlimMessage('RS801')
				];
			}
        
			return json_encode($data);
	        $this->db= null;
		}

        //HANDLING=================================

        public function addHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO tariff_handling (Kabupaten,KGP,KGS,Min_Kg) 
        					VALUES (:kabupaten,:kgp,:kgs,:minkg);";
		    			$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS407')
                ];
            }
			
			return json_encode($data);
			$this->db = null;
        }

        public function updateHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
        			try {
		        		$this->db->beginTransaction();
				        $sql = "UPDATE tariff_handling SET KGP=:kgp,KGS=:kgs,Min_Kg=:minkg 
        					WHERE Kabupaten=:kabupaten;";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
                        $stmt->bindParam(':kgp', $this->kgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $this->kgs, PDO::PARAM_STR);
                        $stmt->bindParam(':minkg', $this->minkg, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS103',
				    			'message' => CustomHandlers::getreSlimMessage('RS103')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS401',
                    'message' => CustomHandlers::getreSlimMessage('RS407')
                ];
            }
			
			return json_encode($data);
			$this->db = null;
        }

        public function deleteHandling(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM tariff_handling WHERE Kabupaten=:kabupaten;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':kabupaten', $this->kabupaten, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104')
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
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
                        'message' => CustomHandlers::getreSlimMessage('RS404')
                    ];
                }
			} else {
				$data = [
	    			'status' => 'error',
				    'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401')
    			];
			}
		    return json_encode($data);
    		$this->db = null;
        }

        public function searchHandlingAsPagination(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower($this->username);
				$search = "%$this->search%";
				$roles = Auth::getRoleID($this->db,$this->token);
				if ($roles < 3 || $roles == 6){
					//count total row
					$sqlcountrow = "SELECT count(a.Kabupaten) as TotalRow 
						from tariff_handling a
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
							$sql = "SELECT a.Kabupaten,a.KGP,a.KGS,a.Min_Kg
								from tariff_handling a
								where a.Kabupaten like :search
								order by a.Kabupaten asc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
								
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
									'status' => 'error',
									'code' => 'RS202',
									'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
						} else {
							$data = [
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601')
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS404',
						'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
        }

        //LIST=================================

        public function listOrigin(){
			if (Auth::validToken($this->db,$this->token)){
				$search = "$this->search%";
				$sql = "SELECT a.`Name`
					FROM sys_company a
					WHERE a.`Name` like :search
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
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
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
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
		}
		
		public function listOriginPublic(){
			$search = "$this->search%";
			$sql = "SELECT a.`Name`
				FROM sys_company a
				WHERE a.`Name` like :search
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
        	        	'message' => CustomHandlers::getreSlimMessage('RS501')
					];
		        } else {
        			$data = [
            	    	'status' => 'error',
		    		    'code' => 'RS601',
        	    	    'message' => CustomHandlers::getreSlimMessage('RS601')
					];
    	        }          	   	
			} else {
				$data = [
        			'status' => 'error',
					'code' => 'RS202',
	        		'message' => CustomHandlers::getreSlimMessage('RS202')
				];
			}		
        
			return json_encode($data);
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
        	        	'message' => CustomHandlers::getreSlimMessage('RS501')
					];
		        } else {
        			$data = [
            	    	'status' => 'error',
		    		    'code' => 'RS601',
        	    	    'message' => CustomHandlers::getreSlimMessage('RS601')
					];
    	        }          	   	
			} else {
				$data = [
        			'status' => 'error',
					'code' => 'RS202',
	        		'message' => CustomHandlers::getreSlimMessage('RS202')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
        }
    }