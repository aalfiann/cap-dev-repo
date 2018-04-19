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
use \classes\JSON as JSON;
use \classes\CustomHandlers as CustomHandlers;
use \classes\system\Util as Util;
use \classes\system\cargo\Dictionary as Dictionary;
use PDO;
	/**
     * A class for transaction management cargo
     *
     * @package    Transaction Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class Transaction {
        // model data transaction
        var $username,$waybill,$branchid,
        // consignor
        $customerid,$consignor_name,$consignor_alias,$consignor_address,$consignor_phone,$consignor_fax,$consignor_email,
        // consignee
        $referenceid,$consignee_name,$consignee_attention,$consignee_address,$consignee_phone,$consignee_fax,
        //goods
        $instruction,$description,$goods_data,$goods_koli,$weight,$weight_real,
        //route
        $modeid,$origin,$destination,$estimation,
        //insurance
        $insurance_rate,$goods_value,
        //tariff
        $kgp,$kgs,$hkgp,$hkgs,
        //payment
        $paymentid,$shipping_cost,$shipping_insurance,$shipping_packing,$shipping_forward,$shipping_handling,$shipping_surcharge,$shipping_admin,$shipping_cost_total,
        //status
        $statusid,$created_at,$created_by,$updated_at,$updated_by;

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

        // 19 = failed
        // 27 = on process
        // 28 = on hold
        // 41 = success
        // 47 = void

        private function generateWaybill($prefix){
            return Auth::uniqidNumeric($prefix);
        }

        private function logging($codeid,$description,$statusid,$username){
            $log = new \classes\system\cargo\TraceLog($this->db);
            $log->codeid = $codeid;
            $log->description = $description;
            $log->statusid = $statusid;
            $log->username = $username;
            return $log->insert();
        }

        public function add(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Util::isUserActive($this->db,$this->username)){
                    $newusername = strtolower($this->username);
			        $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
                    $newwaybill = $this->generateWaybill(strtoupper($newbranchid));

                    $newphone1 = Validation::integerOnly($this->consignor_phone);
                    $newfax1 = Validation::integerOnly($this->consignor_fax);
                    $newphone2 = Validation::integerOnly($this->consignee_phone);
                    $newfax2 = Validation::integerOnly($this->consignee_fax);

                    $newweight = Validation::integerOnly($this->weight);
                    $newweightreal = Validation::numericOnly($this->weight_real);

                    $newmodeid = Validation::integerOnly($this->modeid);
                    $newest = Validation::integerOnly($this->estimation);
                    
                    $newinsurancerate = Validation::numericOnly($this->insurance_rate);
                    $newgoodsvalue = Validation::integerOnly($this->goods_value);
                    $newgoodskoli = Validation::integerOnly($this->goods_koli);

                    $newkgp = Validation::integerOnly($this->kgp);
                    $newkgs = Validation::integerOnly($this->kgs);
                    $newhkgp = Validation::integerOnly($this->hkgp);
                    $newhkgs = Validation::integerOnly($this->hkgs);
                    
                    $newpaymentid = Validation::integerOnly($this->paymentid);
                    $newshippingcost = Validation::integerOnly($this->shipping_cost);
                    $newshippinginsurance = Validation::integerOnly($this->shipping_insurance);
                    $newshippingpacking = Validation::integerOnly($this->shipping_packing);
                    $newshippingforward = Validation::integerOnly($this->shipping_forward);
                    $newshippinghandling = Validation::integerOnly($this->shipping_handling);
                    $newshippingsurcharge = Validation::integerOnly($this->shipping_surcharge);
                    $newshippingadmin = Validation::integerOnly($this->shipping_admin);
                    $newshippingdiscount = Validation::integerOnly($this->shipping_discount);
                    $newshippingcosttotal = Validation::integerOnly($this->shipping_cost_total);

                    try {
		        		$this->db->beginTransaction();
				        $sql = "INSERT INTO transaction_waybill 
                                (WayBill,BranchID,
                                CustomerID,Consignor_name,Consignor_alias,Consignor_address,Consignor_phone,Consignor_fax,Consignor_email,
                                ReferenceID,Consignee_name,Consignee_attention,Consignee_address,Consignee_phone,Consignee_fax,
                                ModeID,Origin,Destination,Estimation,
                                Instruction,Description,Goods_data,Goods_koli,Weight,Weight_real,
                                Insurance_rate,Goods_value,
                                Tariff_kgp,Tariff_kgs,Tariff_hkgp,Tariff_hkgs,
                                PaymentID,Shipping_cost,Shipping_insurance,Shipping_packing,Shipping_forward,Shipping_handling,Shipping_surcharge,Shipping_admin,Shipping_discount,Shipping_cost_total,
                                StatusID,Created_at,Created_by) 
        					VALUES 
                                (:waybill,:branchid,
                                :customerid,:consignor_name,:consignor_alias,:consignor_address,:consignor_phone,:consignor_fax,:consignor_email,
                                :referenceid,:consignee_name,:consignee_attention,:consignee_address,:consignee_phone,:consignee_fax,
                                :modeid,:origin,:destination,:estimation,
                                :instruction,:description,:goods_data,:goods_koli,:weight,:weight_real,
                                :insurance_rate,:goods_value,
                                :kgp,:kgs,:hkgp,:hkgs,
                                :paymentid,:shipping_cost,:shipping_insurance,:shipping_packing,:shipping_forward,:shipping_handling,:shipping_surcharge,:shipping_admin,:shipping_discount,:shipping_cost_total,
                                '27',current_timestamp,:username);";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $newwaybill, PDO::PARAM_STR);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        
                        $stmt->bindParam(':customerid', $this->customerid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_name', $this->consignor_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_alias', $this->consignor_alias, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_address', $this->consignor_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_phone', $newphone1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_fax', $newfax1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_email', $this->consignor_email, PDO::PARAM_STR);

                        $stmt->bindParam(':referenceid', $this->referenceid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_name', $this->consignee_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_attention', $this->consignee_attention, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_address', $this->consignee_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_phone', $newphone2, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_fax', $newfax2, PDO::PARAM_STR);

                        $stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
                        $stmt->bindParam(':origin', $this->origin, PDO::PARAM_STR);
                        $stmt->bindParam(':destination', $this->destination, PDO::PARAM_STR);
                        $stmt->bindParam(':estimation', $newest, PDO::PARAM_STR);

                        $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
                        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_data', $this->goods_data, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_koli', $newgoodskoli, PDO::PARAM_STR);
                        $stmt->bindParam(':weight', $newweight, PDO::PARAM_STR);
                        $stmt->bindParam(':weight_real', $newweightreal, PDO::PARAM_STR);

                        $stmt->bindParam(':insurance_rate', $newinsurancerate, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_value', $newgoodsvalue, PDO::PARAM_STR);

                        $stmt->bindParam(':kgp', $newkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $newkgs, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgp', $newhkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgs', $newhkgs, PDO::PARAM_STR);

                        $stmt->bindParam(':paymentid', $newpaymentid, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost', $newshippingcost, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_insurance', $newshippinginsurance, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_packing', $newshippingpacking, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_forward', $newshippingforward, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_handling', $newshippinghandling, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_surcharge', $newshippingsurcharge, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_admin', $newshippingadmin, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_discount', $newshippingdiscount, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost_total', $newshippingcosttotal, PDO::PARAM_STR);

    					if ($stmt->execute()) {
	    					$data = [
                                'status' => 'success',
                                'waybill' => $newwaybill,
                                'info' => Dictionary::write('waybill_created'),
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
                            ];
                            $this->logging($newwaybill,Dictionary::write('waybill_created'),'27',$newusername);
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
                        'code' => 'RS906',
                        'message' => CustomHandlers::getreSlimMessage('RS906')
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

        public function update(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if (Util::isUserActive($this->db,$this->username)){
			        $newusername = strtolower($this->username);
			        $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));

                    $newphone1 = Validation::integerOnly($this->consignor_phone);
                    $newfax1 = Validation::integerOnly($this->consignor_fax);
                    $newphone2 = Validation::integerOnly($this->consignee_phone);
                    $newfax2 = Validation::integerOnly($this->consignee_fax);

                    $newweight = Validation::integerOnly($this->weight);
                    $newweightreal = Validation::numericOnly($this->weight_real);

                    $newmodeid = Validation::integerOnly($this->modeid);
                    $newest = Validation::integerOnly($this->estimation);
                    
                    $newinsurancerate = Validation::numericOnly($this->insurance_rate);
                    $newgoodsvalue = Validation::integerOnly($this->goods_value);
                    $newgoodskoli = Validation::integerOnly($this->goods_koli);

                    $newkgp = Validation::integerOnly($this->kgp);
                    $newkgs = Validation::integerOnly($this->kgs);
                    $newhkgp = Validation::integerOnly($this->hkgp);
                    $newhkgs = Validation::integerOnly($this->hkgs);
                    
                    $newpaymentid = Validation::integerOnly($this->paymentid);
                    $newshippingcost = Validation::integerOnly($this->shipping_cost);
                    $newshippinginsurance = Validation::integerOnly($this->shipping_insurance);
                    $newshippingpacking = Validation::integerOnly($this->shipping_packing);
                    $newshippingforward = Validation::integerOnly($this->shipping_forward);
                    $newshippinghandling = Validation::integerOnly($this->shipping_handling);
                    $newshippingsurcharge = Validation::integerOnly($this->shipping_surcharge);
                    $newshippingadmin = Validation::integerOnly($this->shipping_admin);
                    $newshippingdiscount = Validation::integerOnly($this->shipping_discount);
                    $newshippingcosttotal = Validation::integerOnly($this->shipping_cost_total);

        			try {
		        		$this->db->beginTransaction();
				        $sql = "UPDATE transaction_waybill a 
                            SET a.CustomerID=:customerid,a.Consignor_name=:consignor_name,a.Consignor_alias=:consignor_alias,a.Consignor_address=:consignor_address,
                                    a.Consignor_phone=:consignor_phone,a.Consignor_fax=:consignor_fax,a.Consignor_email=:consignor_email,
                                a.ReferenceID=:referenceid,a.Consignee_name=:consignee_name,a.Consignee_attention=:consignee_attention,a.Consignee_address=:consignee_address,
                                    a.Consignee_phone=:consignee_phone,a.Consignee_fax=:consignee_fax,
                                a.ModeID=:modeid,a.Origin=:origin,a.Destination=:destination,a.Estimation=:estimation,
                                a.Instruction=:instruction,a.Description=:description,a.Goods_data=:goods_data,a.Goods_koli=:goods_koli,a.Weight=:weight,a.Weight_real=:weight_real,
                                a.Insurance_rate=:insurance_rate,a.Goods_value=:goods_value,
                                a.Tariff_kgp=:kgp,a.Tariff_kgs=:kgs,a.Tariff_hkgp=:hkgp,a.Tariff_hkgs=:hkgs,
                                a.PaymentID=:paymentid,a.Shipping_cost=:shipping_cost,a.Shipping_insurance=:shipping_insurance,a.Shipping_packing=:shipping_packing,
                                    a.Shipping_forward=:shipping_forward,a.Shipping_handling=:shipping_handling,a.Shipping_surcharge=:shipping_surcharge,a.Shipping_admin=:shipping_admin,
                                    a.Shipping_discount=:shipping_discount,a.Shipping_cost_total=:shipping_cost_total,
                                a.Updated_at=current_timestamp,a.Updated_by=:username 
        					WHERE a.WayBill=:waybill AND a.StatusID='27' ".(($roles<3)?"":"AND a.BranchID = :branchid").";";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        if ($roles == 6 || $roles == 7) $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        
                        $stmt->bindParam(':customerid', $this->customerid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_name', $this->consignor_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_alias', $this->consignor_alias, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_address', $this->consignor_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_phone', $newphone1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_fax', $newfax1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_email', $this->consignor_email, PDO::PARAM_STR);

                        $stmt->bindParam(':referenceid', $this->referenceid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_name', $this->consignee_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_attention', $this->consignee_attention, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_address', $this->consignee_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_phone', $newphone2, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_fax', $newfax2, PDO::PARAM_STR);

                        $stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
                        $stmt->bindParam(':origin', $this->origin, PDO::PARAM_STR);
                        $stmt->bindParam(':destination', $this->destination, PDO::PARAM_STR);
                        $stmt->bindParam(':estimation', $newest, PDO::PARAM_STR);

                        $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
                        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_data', $this->goods_data, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_koli', $newgoodskoli, PDO::PARAM_STR);
                        $stmt->bindParam(':weight', $newweight, PDO::PARAM_STR);
                        $stmt->bindParam(':weight_real', $newweightreal, PDO::PARAM_STR);

                        $stmt->bindParam(':insurance_rate', $newinsurancerate, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_value', $newgoodsvalue, PDO::PARAM_STR);

                        $stmt->bindParam(':kgp', $newkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $newkgs, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgp', $newhkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgs', $newhkgs, PDO::PARAM_STR);

                        $stmt->bindParam(':paymentid', $newpaymentid, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost', $newshippingcost, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_insurance', $newshippinginsurance, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_packing', $newshippingpacking, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_forward', $newshippingforward, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_handling', $newshippinghandling, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_surcharge', $newshippingsurcharge, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_admin', $newshippingadmin, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_discount', $newshippingdiscount, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost_total', $newshippingcosttotal, PDO::PARAM_STR);

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
                        'code' => 'RS906',
                        'message' => CustomHandlers::getreSlimMessage('RS906')
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

        public function delete(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles == '1'){
                    $newbranchid = strtolower($this->branchid);
    				try{
                        $this->db->beginTransaction();
    
                        $sql = "DELETE FROM transaction_waybill WHERE WayBill = :waybill;";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
						
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

        public function void(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
                    $newusername = strtolower($this->username);
    				try{
                        $this->db->beginTransaction();
                        if ($roles < 3){
                            $sql = "UPDATE transaction_waybill a 
                                SET a.StatusID = '47',a.Updated_at=current_timestamp,a.Updated_by=:username 
                                WHERE a.WayBill = :waybill;";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        } else if($roles == 6) {
                            $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
                            $sql = "UPDATE transaction_waybill a 
                                SET a.StatusID = '47',a.Updated_at=current_timestamp,a.Updated_by=:username 
                                WHERE a.WayBill = :waybill AND a.BranchID = :branchid;";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                            $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        }
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS103',
			    				'message' => CustomHandlers::getreSlimMessage('RS103')
                            ];
                            $this->logging($this->waybill,Dictionary::write('waybill_void'),'47',$newusername);
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS203',
			    				'message' => CustomHandlers::getreSlimMessage('RS203')
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

        public function delivered(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $roles = Auth::getRoleID($this->db,$this->token);
                if ($roles < 3 || $roles == 6){
                    $newusername = strtolower($this->username);
    				try{
                        $this->db->beginTransaction();
                        if ($roles < 3){
                            $sql = "UPDATE transaction_waybill a 
                                SET a.StatusID = '41',a.Updated_at=current_timestamp,a.Updated_by=:username 
                                WHERE a.WayBill = :waybill;";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        } else if($roles == 6) {
                            $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
                            $sql = "UPDATE transaction_waybill a 
                                SET a.StatusID = '41',a.Updated_at=current_timestamp,a.Updated_by=:username 
                                WHERE a.WayBill = :waybill AND a.BranchID = :branchid;";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                            $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        }
						
						if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS103',
			    				'message' => CustomHandlers::getreSlimMessage('RS103')
                            ];
                            $this->logging($this->waybill,Dictionary::write('waybill_delivered').' ','41',$newusername);
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS203',
			    				'message' => CustomHandlers::getreSlimMessage('RS203')
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

        public function getWaybillID(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Util::isUserActive($this->db,$this->username)){
                    $newusername = strtolower($this->username);
                    $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
                    $data = [
                        'status' => 'success',
                        'code' => 'RS101',
                        'waybill' => $this->generateWaybill(strtoupper($newbranchid)),
                        'message' => CustomHandlers::getreSlimMessage('RS101')
                    ];
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS906',
                        'message' => CustomHandlers::getreSlimMessage('RS906')
                    ];
                }
            } else {
                $data = [
	    			'status' => 'error',
				    'code' => 'RS401',
					'message' => CustomHandlers::getreSlimMessage('RS401')
    			];
            }
            
            return JSON::safeEncode($data,true);
        }

    }