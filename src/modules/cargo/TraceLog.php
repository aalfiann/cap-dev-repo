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
use PDO;
	/**
     * A class for trace log management
     *
     * @package    TraceLog Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class TraceLog {
        // model data trace log
		var $username,$codeid,$description,$statusid,$itemid,$created_at,
		// data pod
		$branchid,$waybill,$recipient,$relation,$deliveryid;
		
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

		/**
		 * Insert new trace log
		 * @return bool
		 */
		public function insert(){
			$result = false;
    		$newusername = strtolower($this->username);	
			$newstatusid = Validation::integerOnly($this->statusid);			
		    try {
				
				$sql = "INSERT INTO log_data (CodeID,Description,StatusID,Created_at,Username) 
		    		VALUES (:codeid,:description,:statusid,current_timestamp,:username);";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
				$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
				$stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
		    	if ($stmt->execute()) {
					if ($stmt->rowCount() > 0){
						$result = true;
					}
				}
				
			} catch (PDOException $e) {
    			$result = false;
			}
			return $result;
			$this->db = null;
		}
		
		/**
		 * Insert new void trace log
		 * @return bool
		 */
		public function insertVoid(){
			$result = false;
    		$newusername = strtolower($this->username);	
			$newstatusid = Validation::integerOnly($this->statusid);			
		    try {
				
				$sql = "INSERT INTO log_data_void (CodeID,Description,StatusID,Created_at,Username) 
		    		VALUES (:codeid,:description,:statusid,current_timestamp,:username);";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
				$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
				$stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
		    	if ($stmt->execute()) {
					if ($stmt->rowCount() > 0){
						$result = true;
					}
				}
	    		
			} catch (PDOException $e) {
    			$result = false;
			}
			return $result;
			$this->db = null;
		}

		/**
		 * Insert new pod trace log
		 * @return bool
		 */
		public function insertPod(){
			$result = false;
    		$newusername = strtolower($this->username);	
			$newstatusid = Validation::integerOnly($this->statusid);			
		    try {
				
				$sql = "INSERT INTO log_data_pod (BranchID,WayBill,Description,Recipient,Relation,DeliveryID,StatusID,Created_at,Username) 
		    		VALUES (:branchid,:waybill,:description,:recipient,:relation,:deliveryid,:statusid,current_timestamp,:username);";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':branchid', $this->branchid, PDO::PARAM_STR);
				$stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
				$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
				$stmt->bindParam(':recipient', $this->recipient, PDO::PARAM_STR);
				$stmt->bindParam(':relation', $this->relation, PDO::PARAM_STR);
				$stmt->bindParam(':deliveryid', $this->deliveryid, PDO::PARAM_STR);
				$stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
		    	if ($stmt->execute()) {
					if ($stmt->rowCount() > 0){
						$result = true;
					}
				}
	    		
			} catch (PDOException $e) {
    			$result = false;
			}
			return $result;
			$this->db = null;
		}
		
		/**
		 * Add new trace log
		 * @return result process in json encoded data
		 */
		public function add(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
    		        $newusername = strtolower($this->username);	
					$newstatusid = Validation::integerOnly($this->statusid);			
		        	try {
				    	$this->db->beginTransaction();
						$sql = "INSERT INTO log_data (CodeID,Description,StatusID,Created_at,Username) 
		        			VALUES (:codeid,:description,:statusid,current_timestamp,:username);";
				    	$stmt = $this->db->prepare($sql);
						$stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
						$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
						$stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
						$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
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
        
        
        /** 
         * Update trace log
         *
         * @return json encoded data
         */
		public function update(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
                    $newusername = strtolower($this->username);	
					$newstatusid = Validation::integerOnly($this->statusid);
					$newitemid = Validation::integerOnly($this->itemid);
		    		try{
                        $this->db->beginTransaction();
    
                        $sql = "UPDATE log_data a SET a.Description=:description,a.StatusID=:statusid,a.Updated_at=current_timestamp,a.Updated_by=:username
                            WHERE a.ItemID = :itemid;";
						$stmt = $this->db->prepare($sql);
						$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
						$stmt->bindParam(':itemid', $newitemid, PDO::PARAM_STR);
                        $stmt->execute();
                    
                        $this->db->commit();
                        
                        $data = [
                            'status' => 'success',
                            'code' => 'RS103',
                            'message' => CustomHandlers::getreSlimMessage('RS103',$this->lang)
                        ];
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

		/** 
         * Delete by item id trace log
         *
         * @return json encoded data
         */
		public function deleteByItem(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    $newitemid = Validation::integerOnly($this->itemid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM log_data WHERE ItemID = :itemid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':itemid', $newitemid, PDO::PARAM_STR);
                        
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

		/** 
         * Delete by code id trace log
         *
         * @return json encoded data
         */
		public function deleteByCode(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM log_data WHERE CodeID = :codeid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
                        
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

		/** 
		 * Search all data trace log paginated
		 * @return result process in json encoded data
		 */
		public function searchTraceAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				$search = "%$this->search%";
				//count total row
				$sqlcountrow = "SELECT count(a.ItemID) as TotalRow 
					from log_data a
					inner join core_status b on a.StatusID = b.StatusID
					where a.CodeID like :search
                    or a.ItemID like :search
                    order by a.Created_at asc;";
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
						$sql = "SELECT a.ItemID,a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username,a.Updated_at,a.Updated_by,a.Updated_sys
							from log_data a
							inner join core_status b on a.StatusID = b.StatusID
							where a.CodeID like :search
                            or a.ItemID like :search
                            order by a.Created_at asc LIMIT :limpage , :offpage;";
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
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db= null;
		}
        
        
        //OPTIONS=======================================


        /** 
		 * Get all data trace log by code id
		 * @return result process in json encoded data
		 */
		public function getTraceByCode() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$sql = "SELECT a.ItemID,a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username,a.Updated_at,a.Updated_by,a.Updated_sys
					FROM log_data a
					INNER JOIN core_status b ON a.StatusID = b.StatusID
					WHERE a.CodeID = :codeid
					ORDER BY a.ItemID ASC";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
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

        /** 
		 * Get all data trace log by code id
		 * @return result process in json encoded data
		 */
		public function getTraceByCodePublic() {
			$sql = "SELECT a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username
				FROM log_data a
				INNER JOIN core_status b ON a.StatusID = b.StatusID
				WHERE a.CodeID = :codeid
				ORDER BY a.ItemID ASC";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':codeid', $this->codeid, PDO::PARAM_STR);
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