<?php
/**
 * This class is a part of reSlim project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\system;
use \classes\Auth as Auth;
use \classes\Validation as Validation;
use PDO;
	/**
     * A class for company management external system in reSlim
     *
     * @package    System Company reSlim
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
	class Company {
        // model data company
        var $username,$branchid,$name,$address,$phone,$fax,$email,$owner,$tin,$pic,$statusid,$adminname;
        
        function __construct($db=null) {
			if (!empty($db)) 
	        {
    	        $this->db = $db;
        	}
		}
		
		/**
		 * Inserting into database to add new company
		 * @return result process in json encoded data
		 */
		private function doAdd(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
                    $newusername = strtolower($this->username);
			        $newbranchid = strtolower($this->branchid);
			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO sys_company (BranchID,Name,Address,Phone,Fax,Email,Owner,PIC,TIN,StatusID,Username) 
        					VALUES (:branchid,:name,:address,:phone,:fax,:email,:owner,:pic,:tin,'1',:username);";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                        $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
                        $stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
                        $stmt->bindParam(':fax', $this->fax, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                        $stmt->bindParam(':owner', $this->owner, PDO::PARAM_STR);
                        $stmt->bindParam(':pic', $this->pic, PDO::PARAM_STR);
                        $stmt->bindParam(':tin', $this->tin, PDO::PARAM_STR);
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
			
			return $data;
			$this->db = null;
        }
        

		/**
		 * Determine if company is already registered or not
		 * @return boolean true / false
		 */
		private function isCompanyExist(){
			$newbranchid = strtolower($this->branchid);
			$r = false;
			$sql = "SELECT a.BranchID
				FROM sys_company a 
				WHERE a.BranchID = :branchid;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() > 0){
	                $r = true;
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Add new company
		 * @return result process in json encoded data
		 */
		public function add(){
			if ( preg_match('/[A-Za-z0-9]+/',$this->branchid) == false ){
				$data = [
					'status' => 'error',
					'code' => 'RS804',
					'message' => CustomHandlers::getreSlimMessage('RS804')
				];
			} else {
				if ($this->isCompanyExist() == false){
					$data = $this->doAdd();
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS603',
						'message' => CustomHandlers::getreSlimMessage('RS603')
					];
				}
			}
			
			return json_encode($data,JSON_PRETTY_PRINT);
        }
        
        /** 
         * Update company
         *
         * @return json encoded data
         */
		public function update(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
                    $newusername = strtolower($this->username);
                    $newbranchid = strtolower($this->branchid);
                    $newstatusid = Validator::integerOnly($this->statusid);
                    
		    		try{
                        $this->db->beginTransaction();
    
                        $sql = "UPDATE sys_company a SET a.Name=:name,a.Address=:address,a.Phone=:phone,a.Fax=:fax,a.Email=:email,a.Owner=:owner,
                                a.TIN=:tin,a.PIC=:pic,a.StatusID=:statusid,a.Updated_by=:username
                            WHERE a.BranchID = :branchid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':statusid', $newstatusid, PDO::PARAM_STR);
                        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                        $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
                        $stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
                        $stmt->bindParam(':fax', $this->fax, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                        $stmt->bindParam(':owner', $this->owner, PDO::PARAM_STR);
                        $stmt->bindParam(':pic', $this->pic, PDO::PARAM_STR);
                        $stmt->bindParam(':tin', $this->tin, PDO::PARAM_STR);
                        $stmt->execute();
                    
                        $this->db->commit();
                        
                        $data = [
                            'status' => 'success',
                            'code' => 'RS103',
                            'message' => CustomHandlers::getreSlimMessage('RS103')
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

		/** 
         * Delete company
         *
         * @return json encoded data
         */
		public function delete(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    $newbranchid = strtolower($this->branchid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM sys_company WHERE BranchID = :branchid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->execute();
                    
                        $this->db->commit();
                        
                        $data = [
                            'status' => 'success',
                            'code' => 'RS306',
                            'message' => CustomHandlers::getreSlimMessage('RS306')
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

		/** 
		 * Search all data company paginated
		 * @return result process in json encoded data
		 */
		public function searchAllCompanyAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				$roles = Auth::getRoleID($this->db,$this->token);
				$search = "%$this->search%";
				//count total row
				$sqlcountrow = "SELECT count(a.BranchID) as TotalRow 
					from sys_company a
					inner join core_status b on a.StatusID=b.StatusID
					where a.BranchID like :search
                    or a.Name like :search
                    or a.BranchID like :search
                    or a.Phone like :search
					order by a.BranchID asc;";
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
							$sql = "SELECT a.Created_at,a.BranchID,a.Name,a.Address,a.Phone,a.Fax,a.Email,a.TIN,a.Owner,a.PIC,a.StatusID,b.`Status`,a.Username,a.Updated_at,a.Updated_by 
								from sys_company a
								inner join core_status b on a.StatusID=b.StatusID
								where a.BranchID like :search
                                or a.Name like :search
                                or a.BranchID like :search
                                or a.Phone like :search
								order by a.BranchID asc LIMIT :limpage , :offpage;";
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
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data);
	        $this->db= null;
		}
        
        
        //OPTIONS=======================================


        /** 
		 * Get all data Company ID
		 * @return result process in json encoded data
		 */
		public function showOptionCompany() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.BranchID,a.Name
					FROM sys_company a
					WHERE a.StatusID = '1' OR a.StatusID = '42'
					ORDER BY a.BranchID ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

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
        
		/** 
		 * Get all data Status for company
		 * @return result process in json encoded data
		 */
		public function showOptionStatus() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '1' OR a.StatusID = '42'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

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
    }