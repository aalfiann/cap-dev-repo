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
     * A class for mode management
     *
     * @package    Mode Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class Mode {
        // model data mode
		var $username,$modeid,$mode;
		
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
		
		/**
		 * Inserting into database to add new mode
		 * @return result process in json encoded data
		 */
		private function doAdd(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 2){
			        $newmode = ucwords($this->mode);			
        			try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO mas_mode (Mode) 
        					VALUES (:mode);";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':mode', $newmode, PDO::PARAM_STR);
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
                    'message' => CustomHandlers::getreSlimMessage('RS401')
                ];
            }
			
			return $data;
			$this->db = null;
        }
        

		/**
		 * Determine if mode name is already exist or not
		 * @return boolean true / false
		 */
		private function isModeExist(){
			$newmode = ucwords($this->mode);
			$r = false;
			$sql = "SELECT a.Mode
				FROM mas_mode a 
				WHERE a.Mode = :mode;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':mode', $newmode, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() > 0){
	                $r = true;
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Add new mode
		 * @return result process in json encoded data
		 */
		public function add(){
			if ($this->isModeExist() == false){
                $data = $this->doAdd();
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 'RS603',
                    'message' => CustomHandlers::getreSlimMessage('RS603')
                ];
            }
			
			return json_encode($data,JSON_PRETTY_PRINT);
        }
        
        /** 
         * Update mode
         *
         * @return json encoded data
         */
		public function update(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3){
                    $newmodeid = Validation::integerOnly($this->modeid);
                    $newmode = ucwords($this->mode);
		    		try{
                        $this->db->beginTransaction();
    
                        $sql = "UPDATE mas_mode a SET a.Mode=:mode
                            WHERE a.ModeID = :modeid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':mode', $newmode, PDO::PARAM_STR);
                        $stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
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
         * Delete mode
         *
         * @return json encoded data
         */
		public function delete(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    $newmodeid = Validation::integerOnly($this->modeid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM mas_mode WHERE ModeID = :modeid;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
                        
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

		/** 
		 * Search all data mode paginated
		 * @return result process in json encoded data
		 */
		public function searchModeAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				$search = "%$this->search%";
				//count total row
				$sqlcountrow = "SELECT count(a.ModeID) as TotalRow 
					from mas_mode a
					where a.ModeID like :search
                    or a.Mode like :search
                    order by a.Mode asc;";
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
						$sql = "SELECT a.ModeID,a.Mode 
							from mas_mode a
							where a.ModeID like :search
                            or a.Mode like :search
                            order by a.Mode asc LIMIT :limpage , :offpage;";
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

		/** 
		 * Search all data mode paginated public
		 * @return result process in json encoded data
		 */
		public function searchModeAsPaginationPublic() {
			$search = "%$this->search%";
			//count total row
			$sqlcountrow = "SELECT count(a.ModeID) as TotalRow 
				from mas_mode a
				where a.ModeID like :search
                or a.Mode like :search
                order by a.Mode asc;";
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
					$sql = "SELECT a.ModeID,a.Mode 
						from mas_mode a
						where a.ModeID like :search
                        or a.Mode like :search
                        order by a.Mode asc LIMIT :limpage , :offpage;";
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
        
			return json_encode($data);
	        $this->db= null;
		}
        
        
        //OPTIONS=======================================


        /** 
		 * Get all data Mode as a list option
		 * @return result process in json encoded data
		 */
		public function showOptionMode() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$sql = "SELECT a.ModeID,a.Mode
					FROM mas_mode a
					ORDER BY a.Mode ASC";
				$stmt = $this->db->prepare($sql);
				
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
		 * Get all data Mode as a list option
		 * @return result process in json encoded data
		 */
		public function showOptionModePublic() {
			$sql = "SELECT a.ModeID,a.Mode
				FROM mas_mode a
				ORDER BY a.Mode ASC";
			$stmt = $this->db->prepare($sql);
				
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