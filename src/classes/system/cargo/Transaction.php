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
        var $username,$waybill,$branchid,$destid,$recipient,$relation,$deliveryid,
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
        $kgp,$kgs,$minkgp,$hkgp,$hkgs,$minhkgp,
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
        // 27 = ok
        // 28 = on hold
        // 29 = on process
        // 41 = success
        // 47 = void
        // 53 = return

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

        private function logVoid($codeid,$description,$statusid,$username){
            $log = new \classes\system\cargo\TraceLog($this->db);
            $log->codeid = $codeid;
            $log->description = $description;
            $log->statusid = $statusid;
            $log->username = $username;
            return $log->insertVoid();
        }

        private function logPod($branchid,$waybill,$description,$statusid,$username,$recipient='',$relation='',$deliveryid=''){
            $log = new \classes\system\cargo\TraceLog($this->db);
            $log->branchid = $branchid;
            $log->waybill = $waybill;
            $log->description = $description;
            $log->recipient = $recipient;
            $log->relation = $relation;
            $log->deliveryid = $deliveryid;
            $log->statusid = $statusid;
            $log->username = $username;
            return $log->insertPod();
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
                    $newminkgp = Validation::integerOnly($this->minkgp);
                    $newminhkgp = Validation::integerOnly($this->minhkgp);
                    
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
                                (WayBill,BranchID,DestID,
                                CustomerID,Consignor_name,Consignor_alias,Consignor_address,Consignor_phone,Consignor_fax,Consignor_email,
                                ReferenceID,Consignee_name,Consignee_attention,Consignee_address,Consignee_phone,Consignee_fax,
                                ModeID,Origin,Destination,Estimation,
                                Instruction,Description,Goods_data,Goods_koli,Weight,Weight_real,
                                Insurance_rate,Goods_value,
                                Tariff_kgp,Tariff_kgs,Tariff_kgp_min,Tariff_hkgp,Tariff_hkgs,Tariff_hkgp_min,
                                PaymentID,Shipping_cost,Shipping_insurance,Shipping_packing,Shipping_forward,Shipping_handling,Shipping_surcharge,Shipping_admin,Shipping_discount,Shipping_cost_total,
                                StatusID,Created_at,Created_by) 
        					VALUES 
                                (:waybill,:branchid,:destid,
                                :customerid,:consignor_name,:consignor_alias,:consignor_address,:consignor_phone,:consignor_fax,:consignor_email,
                                :referenceid,:consignee_name,:consignee_attention,:consignee_address,:consignee_phone,:consignee_fax,
                                :modeid,:origin,:destination,:estimation,
                                :instruction,:description,:goods_data,:goods_koli,:weight,:weight_real,
                                :insurance_rate,:goods_value,
                                :kgp,:kgs,:minkgp,:hkgp,:hkgs,:minhkgp,
                                :paymentid,:shipping_cost,:shipping_insurance,:shipping_packing,:shipping_forward,:shipping_handling,:shipping_surcharge,:shipping_admin,:shipping_discount,:shipping_cost_total,
                                '29',current_timestamp,:username);";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $newwaybill, PDO::PARAM_STR);
                        $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':destid', $this->destid, PDO::PARAM_STR);
                        
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
                        $stmt->bindParam(':minkgp', $newminkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':minhkgp', $newminhkgp, PDO::PARAM_STR);

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
                            if ($stmt->rowCount() > 0){
                                $data = [
                                    'status' => 'success',
                                    'waybill' => $newwaybill,
                                    'info' => Dictionary::write('waybill_created'),
                                    'code' => 'RS101',
                                    'message' => CustomHandlers::getreSlimMessage('RS101')
                                ];
                                $this->logging($newwaybill,Dictionary::write('waybill_created'),'29',$newusername);
                            } else {
                                $data = [
                                    'status' => 'error',
                                    'code' => 'RS201',
                                    'message' => CustomHandlers::getreSlimMessage('RS201')
                                ];    
                            }
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
                    $newminkgp = Validation::integerOnly($this->minkgp);
                    $newminhkgp = Validation::integerOnly($this->minhkgp);
                    
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
                            SET a.DestID=:destid,a.CustomerID=:customerid,a.Consignor_name=:consignor_name,a.Consignor_alias=:consignor_alias,a.Consignor_address=:consignor_address,
                                    a.Consignor_phone=:consignor_phone,a.Consignor_fax=:consignor_fax,a.Consignor_email=:consignor_email,
                                a.ReferenceID=:referenceid,a.Consignee_name=:consignee_name,a.Consignee_attention=:consignee_attention,a.Consignee_address=:consignee_address,
                                    a.Consignee_phone=:consignee_phone,a.Consignee_fax=:consignee_fax,
                                a.ModeID=:modeid,a.Origin=:origin,a.Destination=:destination,a.Estimation=:estimation,
                                a.Instruction=:instruction,a.Description=:description,a.Goods_data=:goods_data,a.Goods_koli=:goods_koli,a.Weight=:weight,a.Weight_real=:weight_real,
                                a.Insurance_rate=:insurance_rate,a.Goods_value=:goods_value,
                                a.Tariff_kgp=:kgp,a.Tariff_kgs=:kgs,a.Tariff_kgp_min=:minkgp,a.Tariff_hkgp=:hkgp,a.Tariff_hkgs=:hkgs,a.Tariff_hkgp_min=:minhkgp,
                                a.PaymentID=:paymentid,a.Shipping_cost=:shipping_cost,a.Shipping_insurance=:shipping_insurance,a.Shipping_packing=:shipping_packing,
                                    a.Shipping_forward=:shipping_forward,a.Shipping_handling=:shipping_handling,a.Shipping_surcharge=:shipping_surcharge,a.Shipping_admin=:shipping_admin,
                                    a.Shipping_discount=:shipping_discount,a.Shipping_cost_total=:shipping_cost_total,
                                a.Updated_at=current_timestamp,a.Updated_by=:username 
        					WHERE a.WayBill=:waybill AND a.StatusID='29' ".(($roles<3)?"":"AND a.BranchID = :branchid").";";
		    			$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        if ($roles == 6 || $roles == 7) $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        $stmt->bindParam(':destid', $this->destid, PDO::PARAM_STR);
                        
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
                        $stmt->bindParam(':minkgp', $newminkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':minhkgp', $newminhkgp, PDO::PARAM_STR);

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
                                WHERE a.WayBill = :waybill AND a.StatusID='29';";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        } else if($roles == 6) {
                            $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
                            $sql = "UPDATE transaction_waybill a 
                                SET a.StatusID = '47',a.Updated_at=current_timestamp,a.Updated_by=:username 
                                WHERE a.WayBill = :waybill  AND a.StatusID='29' AND a.BranchID = :branchid;";
                            $stmt = $this->db->prepare($sql);
                            $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                            $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                            $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                        }
						
						if ($stmt->execute()) {
                            if ($stmt->rowCount() > 0){
                                $data = [
                                    'status' => 'success',
                                    'code' => 'RS103',
                                    'message' => CustomHandlers::getreSlimMessage('RS103')
                                ];
                                if($this->logging($this->waybill,Dictionary::write('waybill_void'),'47',$newusername)){
                                    $this->logVoid($this->waybill,$this->description,'47',$newusername);
                                }
                            } else {
                                $data = [
                                    'status' => 'error',
                                    'code' => 'waybill_not_found_1',
                                    'message' => Dictionary::write('waybill_not_found_1')
                                ];    
                            }
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
                if (Util::isUserActive($this->db,$this->username)){
                    $newusername = strtolower($this->username);
                    $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
    				try{
                        $this->db->beginTransaction();
                        $sql = "UPDATE transaction_waybill a 
                            SET a.StatusID = '41',a.Updated_at=current_timestamp,a.Updated_by=:username 
                            WHERE a.WayBill = :waybill AND a.DestID = :destid AND a.StatusID<>'41' AND a.StatusID<>'53';";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        $stmt->bindParam(':destid', $newbranchid, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
                            if ($stmt->rowCount() > 0){
                                $data = [
                                    'status' => 'success',
                                    'code' => 'RS103',
                                    'message' => CustomHandlers::getreSlimMessage('RS103')
                                ];
                                if($this->logging($this->waybill,Dictionary::write('waybill_delivered').' '.strtoupper($this->recipient).' ('.strtoupper($this->relation).')','41',$newusername)){
                                    $this->logPod(
                                        $newbranchid,$this->waybill,Dictionary::write('waybill_delivered'),'41',$newusername,
                                        $this->recipient,$this->relation,$this->deliveryid
                                    );
                                }
                            } else {
                                $data = [
                                    'status' => 'error',
                                    'code' => 'waybill_not_found_1',
                                    'message' => Dictionary::write('waybill_not_found_1')
                                ];    
                            }
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

        public function failed(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Util::isUserActive($this->db,$this->username)){
                    $newusername = strtolower($this->username);
                    $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
    				try{
                        $this->db->beginTransaction();
                        $sql = "UPDATE transaction_waybill a 
                            SET a.StatusID = '19',a.Updated_at=current_timestamp,a.Updated_by=:username 
                            WHERE a.WayBill = :waybill AND a.DestID = :destid AND a.StatusID<>'41' AND a.StatusID<>'53';";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        $stmt->bindParam(':destid', $newbranchid, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
                            if ($stmt->rowCount() > 0){
                                $data = [
                                    'status' => 'success',
                                    'code' => 'RS103',
                                    'message' => CustomHandlers::getreSlimMessage('RS103')
                                ];
                                if($this->logging($this->waybill,$this->description,'19',$newusername)){
                                    $this->logPod(
                                        $newbranchid,$this->waybill,$this->description,'19',$newusername,'','',$this->deliveryid
                                    );
                                }
                            } else {
                                $data = [
                                    'status' => 'error',
                                    'code' => 'waybill_not_found_1',
                                    'message' => Dictionary::write('waybill_not_found_1')
                                ];    
                            }
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

        public function returned($opt='1'){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Util::isUserActive($this->db,$this->username)){
                    $newusername = strtolower($this->username);
                    $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
    				try{
                        $this->db->beginTransaction();
                        $sql = "UPDATE transaction_waybill a 
                            SET a.StatusID = '53',a.Updated_at=current_timestamp,a.Updated_by=:username 
                            WHERE a.WayBill = :waybill AND a.DestID = :destid AND a.StatusID<>'41' AND a.StatusID<>'53';";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);
                        $stmt->bindParam(':destid', $newbranchid, PDO::PARAM_STR);
						
						if ($stmt->execute()) {
                            if ($stmt->rowCount() > 0){
                                $data = [
                                    'status' => 'success',
                                    'code' => 'RS103',
                                    'message' => CustomHandlers::getreSlimMessage('RS103')
                                ];
                                switch($opt){
                                    case '1':
                                        $msg = Dictionary::write('waybill_return');
                                        break;
                                    case '2':
                                        $msg = Dictionary::write('waybill_return_consignor');
                                        break;
                                    case '3':
                                        $msg = Dictionary::write('waybill_return_consignee');
                                        break;
                                    default:
                                        $msg = Dictionary::write('waybill_return');
                                }
                                if($this->logging($this->waybill,$msg,'53',$newusername)){
                                    $this->logPod(
                                        $newbranchid,$this->waybill,$msg,'53',$newusername,'','',$this->deliveryid
                                    );
                                }
                            } else {
                                $data = [
                                    'status' => 'error',
                                    'code' => 'waybill_not_found_1',
                                    'message' => Dictionary::write('waybill_not_found_1')
                                ];    
                            }
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

        /** 
		 * Show data waybill only single detail for registered user
		 * @return result process in json encoded data
		 */
		public function showWaybillDetail(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$sql = "SELECT a.Waybill,a.BranchID,e.Address as 'Branch_address',e.Phone as 'Branch_phone',e.Fax as 'Branch_fax',e.Email as 'Branch_email',e.TIN as 'Branch_TIN',a.DestID,
                    a.CustomerID,a.Consignor_name,a.Consignor_alias,a.Consignor_address,a.Consignor_phone,a.Consignor_fax,a.Consignor_email,
                    a.ReferenceID,a.Consignee_name,a.Consignee_attention,a.Consignee_address,a.Consignee_phone,a.Consignee_fax,
                    a.Instruction,a.Description,a.Goods_data,a.Goods_koli,a.Weight,a.Weight_real,
                    a.ModeID,d.Mode,a.Origin,a.Destination,a.Estimation,
                    a.Insurance_rate,a.Goods_value,
                    a.Tariff_kgp,a.Tariff_kgs,a.Tariff_kgp_min,a.Tariff_hkgp,a.Tariff_hkgs,a.Tariff_hkgp_min,
                    a.PaymentID,c.Payment,a.Shipping_cost,a.Shipping_insurance,a.Shipping_packing,a.Shipping_forward,a.Shipping_handling,a.Shipping_surcharge,a.Shipping_admin,a.Shipping_discount,a.Shipping_cost_total,
                    a.StatusID,b.`Status`,a.Created_at,a.Created_by,a.Updated_at,a.Updated_by,a.Updated_sys
                FROM transaction_waybill a
                INNER JOIN core_status b ON a.StatusID=b.StatusID
                INNER JOIN mas_payment c ON a.PaymentID = c.PaymentID
                INNER JOIN mas_mode d ON a.ModeID = d.ModeID
                INNER JOIN sys_company e ON a.BranchID = e.BranchID
                WHERE a.Waybill = :waybill LIMIT 1;";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$datares = "[";
								while($redata = $stmt->fetch()) 
								{
									$datares .= '{
                                        "Branch":{
                                            "ID":'.json_encode($redata['BranchID']).',
                                            "Origin":'.json_encode($redata['Origin']).',
                                            "Address":'.json_encode($redata['Branch_address']).',
                                            "Phone":'.json_encode($redata['Branch_phone']).',
                                            "Fax":'.json_encode($redata['Branch_fax']).',
                                            "Email":'.json_encode($redata['Branch_email']).',
                                            "TIN":'.json_encode($redata['Branch_TIN']).'
                                        },
                                        "Data":{
                                            "Waybill":'.json_encode($redata['Waybill']).',
                                            "DestID":'.json_encode($redata['DestID']).',
                                            "Created_at":'.json_encode($redata['Created_at']).',
                                            "Created_by":'.json_encode($redata['Created_by']).'
                                        },
                                        "Consignor":{
                                            "CustomerID":'.json_encode($redata['CustomerID']).',
                                            "Name":'.json_encode($redata['Consignor_name']).',
                                            "Alias":'.json_encode($redata['Consignor_alias']).',
                                            "Address":'.json_encode($redata['Consignor_address']).',
                                            "Phone":'.json_encode($redata['Consignor_phone']).',
                                            "Fax":'.json_encode($redata['Consignor_fax']).',
                                            "Email":'.json_encode($redata['Consignor_email']).'
                                        },
                                        "Consignee":{
                                            "ReferenceID":'.json_encode($redata['ReferenceID']).',
                                            "Name":'.json_encode($redata['Consignee_name']).',
                                            "Attention":'.json_encode($redata['Consignee_attention']).',
                                            "Address":'.json_encode($redata['Consignee_address']).',
                                            "Phone":'.json_encode($redata['Consignee_phone']).',
                                            "Fax":'.json_encode($redata['Consignee_fax']).'
                                        },
                                        "Goods":{
                                            "Instruction":'.json_encode($redata['Instruction']).',
                                            "Description":'.json_encode($redata['Description']).',
                                            "Weight_real":'.json_encode($redata['Weight_real']).',
                                            "Weight":'.json_encode($redata['Weight']).',
                                            "Koli":'.json_encode($redata['Goods_koli']).',
                                            "Detail":'.$redata['Goods_data'].'
                                        },
                                        "Route":{
                                            "ModeID":'.json_encode($redata['ModeID']).',
                                            "Mode":'.json_encode($redata['Mode']).',
                                            "Origin":'.json_encode($redata['Origin']).',
                                            "Destination":'.json_encode($redata['Destination']).',
                                            "Estimation":'.json_encode($redata['Estimation']).'
                                        },
                                        "Insurance":{
                                            "Rate":'.json_encode($redata['Insurance_rate']).',
                                            "Value":'.json_encode($redata['Goods_value']).'
                                        },
                                        "Tariff":{
                                            "KGP":'.json_encode($redata['Tariff_kgp']).',
                                            "KGS":'.json_encode($redata['Tariff_kgs']).',
                                            "MinKG":'.json_encode($redata['Tariff_kgp_min']).'
                                        },
                                        "Tariff_handling":{
                                            "KGP":'.json_encode($redata['Tariff_hkgp']).',
                                            "KGS":'.json_encode($redata['Tariff_hkgs']).',
                                            "MinKG":'.json_encode($redata['Tariff_hkgp_min']).'
                                        },
                                        "Payment":{
                                            "PaymentID":'.json_encode($redata['PaymentID']).',
                                            "Name":'.json_encode($redata['Payment']).'
                                        },
                                        "Transaction":{
                                            "Shipping_cost":'.json_encode($redata['Shipping_cost']).',
                                            "Shipping_insurance":'.json_encode($redata['Shipping_insurance']).',
                                            "Shipping_packing":'.json_encode($redata['Shipping_packing']).',
                                            "Shipping_forward":'.json_encode($redata['Shipping_forward']).',
                                            "Shipping_handling":'.json_encode($redata['Shipping_handling']).',
                                            "Shipping_surcharge":'.json_encode($redata['Shipping_surcharge']).',
                                            "Shipping_admin":'.json_encode($redata['Shipping_admin']).',
                                            "Shipping_discount":'.json_encode($redata['Shipping_discount']).',
                                            "Shipping_cost_total":'.json_encode($redata['Shipping_cost_total']).'
                                        },
                                        "Log":{
                                            "StatusID":'.json_encode($redata['StatusID']).',
                                            "Status":'.json_encode($redata['Status']).',
                                            "Updated_at":'.json_encode($redata['Updated_at']).',
                                            "Updated_by":'.json_encode($redata['Updated_by']).',
                                            "Updated_sys":'.json_encode($redata['Updated_sys']).'
                                        }
                                    },';
								}
								$datares = substr($datares, 0, -1);
								$datares .= "]";
						$data = [
			   	            'result' => json_decode($datares), 
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
		 * Trace data waybill only single detail for registered user
		 * @return result process in json encoded data
		 */
		public function traceWaybillDetail(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$sql = "SELECT a.Waybill,a.BranchID,e.Address as 'Branch_address',e.Phone as 'Branch_phone',e.Fax as 'Branch_fax',e.Email as 'Branch_email',e.TIN as 'Branch_TIN',a.DestID,
                    a.CustomerID,a.Consignor_name,a.Consignor_alias,a.Consignor_address,a.Consignor_phone,a.Consignor_fax,a.Consignor_email,
                    a.ReferenceID,a.Consignee_name,a.Consignee_attention,a.Consignee_address,a.Consignee_phone,a.Consignee_fax,
                    a.Instruction,a.Description,a.Goods_data,a.Goods_koli,a.Weight,a.Weight_real,
                    a.ModeID,d.Mode,a.Origin,a.Destination,a.Estimation,
                    a.Insurance_rate,a.Goods_value,
                    a.Tariff_kgp,a.Tariff_kgs,a.Tariff_kgp_min,a.Tariff_hkgp,a.Tariff_hkgs,a.Tariff_hkgp_min,
                    a.PaymentID,c.Payment,a.Shipping_cost,a.Shipping_insurance,a.Shipping_packing,a.Shipping_forward,a.Shipping_handling,a.Shipping_surcharge,a.Shipping_admin,a.Shipping_discount,a.Shipping_cost_total,
                    a.StatusID,b.`Status`,f.Recipient,f.Relation,a.Created_at,a.Created_by,a.Updated_at,a.Updated_by,a.Updated_sys
                FROM transaction_waybill a
                INNER JOIN core_status b ON a.StatusID=b.StatusID
                INNER JOIN mas_payment c ON a.PaymentID = c.PaymentID
                INNER JOIN mas_mode d ON a.ModeID = d.ModeID
                INNER JOIN sys_company e ON a.BranchID = e.BranchID
                LEFT JOIN log_data_pod f ON a.Waybill = f.WayBill
                WHERE a.Waybill = :waybill LIMIT 1;";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){

                        $sql2 = "SELECT a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username
            				FROM log_data a
			            	INNER JOIN core_status b ON a.StatusID = b.StatusID
            				WHERE a.CodeID = :waybill
			            	ORDER BY a.ItemID ASC";
            			$stmt2 = $this->db->prepare($sql2);
            			$stmt2->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

                        if ($stmt2->execute()) {	
                            if ($stmt2->rowCount() > 0){
                                $datatrace = "[";
                                while($retrace = $stmt2->fetch()){
                                    $datatrace .= '{
                                        "Created_at":'.json_encode($retrace['Created_at']).',
                                        "Description":'.json_encode($retrace['Description']).',
                                        "StatusID":'.json_encode($retrace['StatusID']).',
                                        "Status":'.json_encode($retrace['Status']).',
                                        "Created_by":'.json_encode($retrace['Username']).'
                                    },';
                                }
                                $datatrace = substr($datatrace, 0, -1);
                                $datatrace .= "]";
                            }
                        }

        	   		   	$datares = "[";
								while($redata = $stmt->fetch()) 
								{
									$datares .= '{
                                        "Branch":{
                                            "ID":'.json_encode($redata['BranchID']).',
                                            "Origin":'.json_encode($redata['Origin']).',
                                            "Address":'.json_encode($redata['Branch_address']).',
                                            "Phone":'.json_encode($redata['Branch_phone']).',
                                            "Fax":'.json_encode($redata['Branch_fax']).',
                                            "Email":'.json_encode($redata['Branch_email']).',
                                            "TIN":'.json_encode($redata['Branch_TIN']).'
                                        },
                                        "Data":{
                                            "Waybill":'.json_encode($redata['Waybill']).',
                                            "DestID":'.json_encode($redata['DestID']).',
                                            "Created_at":'.json_encode($redata['Created_at']).',
                                            "Created_by":'.json_encode($redata['Created_by']).'
                                        },
                                        "Consignor":{
                                            "CustomerID":'.json_encode($redata['CustomerID']).',
                                            "Name":'.json_encode($redata['Consignor_name']).',
                                            "Alias":'.json_encode($redata['Consignor_alias']).',
                                            "Address":'.json_encode($redata['Consignor_address']).',
                                            "Phone":'.json_encode($redata['Consignor_phone']).',
                                            "Fax":'.json_encode($redata['Consignor_fax']).',
                                            "Email":'.json_encode($redata['Consignor_email']).'
                                        },
                                        "Consignee":{
                                            "ReferenceID":'.json_encode($redata['ReferenceID']).',
                                            "Name":'.json_encode($redata['Consignee_name']).',
                                            "Attention":'.json_encode($redata['Consignee_attention']).',
                                            "Address":'.json_encode($redata['Consignee_address']).',
                                            "Phone":'.json_encode($redata['Consignee_phone']).',
                                            "Fax":'.json_encode($redata['Consignee_fax']).'
                                        },
                                        "Goods":{
                                            "Instruction":'.json_encode($redata['Instruction']).',
                                            "Description":'.json_encode($redata['Description']).',
                                            "Weight_real":'.json_encode($redata['Weight_real']).',
                                            "Weight":'.json_encode($redata['Weight']).',
                                            "Koli":'.json_encode($redata['Goods_koli']).',
                                            "Detail":'.$redata['Goods_data'].'
                                        },
                                        "Route":{
                                            "ModeID":'.json_encode($redata['ModeID']).',
                                            "Mode":'.json_encode($redata['Mode']).',
                                            "Origin":'.json_encode($redata['Origin']).',
                                            "Destination":'.json_encode($redata['Destination']).',
                                            "Estimation":'.json_encode($redata['Estimation']).'
                                        },
                                        "Insurance":{
                                            "Rate":'.json_encode($redata['Insurance_rate']).',
                                            "Value":'.json_encode($redata['Goods_value']).'
                                        },
                                        "Tariff":{
                                            "KGP":'.json_encode($redata['Tariff_kgp']).',
                                            "KGS":'.json_encode($redata['Tariff_kgs']).',
                                            "MinKG":'.json_encode($redata['Tariff_kgp_min']).'
                                        },
                                        "Tariff_handling":{
                                            "KGP":'.json_encode($redata['Tariff_hkgp']).',
                                            "KGS":'.json_encode($redata['Tariff_hkgs']).',
                                            "MinKG":'.json_encode($redata['Tariff_hkgp_min']).'
                                        },
                                        "Payment":{
                                            "PaymentID":'.json_encode($redata['PaymentID']).',
                                            "Name":'.json_encode($redata['Payment']).'
                                        },
                                        "Transaction":{
                                            "Shipping_cost":'.json_encode($redata['Shipping_cost']).',
                                            "Shipping_insurance":'.json_encode($redata['Shipping_insurance']).',
                                            "Shipping_packing":'.json_encode($redata['Shipping_packing']).',
                                            "Shipping_forward":'.json_encode($redata['Shipping_forward']).',
                                            "Shipping_handling":'.json_encode($redata['Shipping_handling']).',
                                            "Shipping_surcharge":'.json_encode($redata['Shipping_surcharge']).',
                                            "Shipping_admin":'.json_encode($redata['Shipping_admin']).',
                                            "Shipping_discount":'.json_encode($redata['Shipping_discount']).',
                                            "Shipping_cost_total":'.json_encode($redata['Shipping_cost_total']).'
                                        },
                                        "Log":{
                                            "StatusID":'.json_encode($redata['StatusID']).',
                                            "Status":'.json_encode($redata['Status']).',
                                            "Updated_at":'.json_encode($redata['Updated_at']).',
                                            "Updated_by":'.json_encode($redata['Updated_by']).',
                                            "Updated_sys":'.json_encode($redata['Updated_sys']).'
                                        },
                                        "POD":{
                                            "Recipient":'.json_encode($redata['Recipient']).',
                                            "Relation":'.json_encode($redata['Relation']).'
                                        }'.(!empty($datatrace)?',"Trace":'.$datatrace:'').'
                                    },';
								}
								$datares = substr($datares, 0, -1);
								$datares .= "]";
						$data = [
			   	            'result' => json_decode($datares), 
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
		 * Trace data waybill only single detail for public
		 * @return result process in json encoded data
		 */
		public function traceWaybillDetailPublic(){
			$sql = "SELECT a.Waybill,a.BranchID,e.Address as 'Branch_address',e.Phone as 'Branch_phone',e.Fax as 'Branch_fax',e.Email as 'Branch_email',e.TIN as 'Branch_TIN',a.DestID,
                a.CustomerID,a.Consignor_name,a.Consignor_alias,a.Consignor_address,a.Consignor_phone,a.Consignor_fax,a.Consignor_email,
                a.ReferenceID,a.Consignee_name,a.Consignee_attention,a.Consignee_address,a.Consignee_phone,a.Consignee_fax,
                a.Instruction,a.Description,a.Goods_data,a.Goods_koli,a.Weight,a.Weight_real,
                a.ModeID,d.Mode,a.Origin,a.Destination,a.Estimation,
                a.Insurance_rate,a.Goods_value,
                a.Tariff_kgp,a.Tariff_kgs,a.Tariff_kgp_min,a.Tariff_hkgp,a.Tariff_hkgs,a.Tariff_hkgp_min,
                a.PaymentID,c.Payment,a.Shipping_cost,a.Shipping_insurance,a.Shipping_packing,a.Shipping_forward,a.Shipping_handling,a.Shipping_surcharge,a.Shipping_admin,a.Shipping_discount,a.Shipping_cost_total,
                a.StatusID,b.`Status`,f.Recipient,f.Relation,a.Created_at,a.Created_by,a.Updated_at,a.Updated_by,a.Updated_sys
            FROM transaction_waybill a
            INNER JOIN core_status b ON a.StatusID=b.StatusID
            INNER JOIN mas_payment c ON a.PaymentID = c.PaymentID
            INNER JOIN mas_mode d ON a.ModeID = d.ModeID
            INNER JOIN sys_company e ON a.BranchID = e.BranchID
            LEFT JOIN log_data_pod f ON a.Waybill = f.WayBill
            WHERE a.Waybill = :waybill LIMIT 1;";
				
			$stmt = $this->db->prepare($sql);		
			$stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

			if ($stmt->execute()) {	
    		    if ($stmt->rowCount() > 0){

                    $sql2 = "SELECT a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username
            			FROM log_data a
			        	INNER JOIN core_status b ON a.StatusID = b.StatusID
            			WHERE a.CodeID = :waybill
			        	ORDER BY a.ItemID ASC";
        			$stmt2 = $this->db->prepare($sql2);
        			$stmt2->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

                    if ($stmt2->execute()) {	
                        if ($stmt2->rowCount() > 0){
                            $datatrace = "[";
                            while($retrace = $stmt2->fetch()){
                                $datatrace .= '{
                                    "Created_at":'.json_encode($retrace['Created_at']).',
                                    "Description":'.json_encode($retrace['Description']).',
                                    "StatusID":'.json_encode($retrace['StatusID']).',
                                    "Status":'.json_encode($retrace['Status']).',
                                    "Created_by":'.json_encode($retrace['Username']).'
                                },';
                            }
                            $datatrace = substr($datatrace, 0, -1);
                            $datatrace .= "]";
                        }
                    }

        	   		$datares = "[";
						while($redata = $stmt->fetch()) 
						{
							$datares .= '{
                                "Branch":{
                                    "ID":'.json_encode($redata['BranchID']).',
                                    "Origin":'.json_encode($redata['Origin']).',
                                    "Address":'.json_encode($redata['Branch_address']).',
                                    "Phone":'.json_encode($redata['Branch_phone']).',
                                    "Fax":'.json_encode($redata['Branch_fax']).',
                                    "Email":'.json_encode($redata['Branch_email']).',
                                    "TIN":'.json_encode($redata['Branch_TIN']).'
                                },
                                "Data":{
                                    "Waybill":'.json_encode($redata['Waybill']).',
                                    "DestID":'.json_encode($redata['DestID']).',
                                    "Created_at":'.json_encode($redata['Created_at']).',
                                    "Created_by":'.json_encode($redata['Created_by']).'
                                },
                                "Consignor":{
                                    "CustomerID":'.json_encode($redata['CustomerID']).',
                                    "Name":'.json_encode($redata['Consignor_name']).',
                                    "Alias":'.json_encode($redata['Consignor_alias']).',
                                    "Address":'.json_encode($redata['Consignor_address']).',
                                    "Phone":'.json_encode($redata['Consignor_phone']).',
                                    "Fax":'.json_encode($redata['Consignor_fax']).',
                                    "Email":'.json_encode($redata['Consignor_email']).'
                                },
                                "Consignee":{
                                    "ReferenceID":'.json_encode($redata['ReferenceID']).',
                                    "Name":'.json_encode($redata['Consignee_name']).',
                                    "Attention":'.json_encode($redata['Consignee_attention']).',
                                    "Address":'.json_encode($redata['Consignee_address']).',
                                    "Phone":'.json_encode($redata['Consignee_phone']).',
                                    "Fax":'.json_encode($redata['Consignee_fax']).'
                                },
                                "Goods":{
                                    "Instruction":'.json_encode($redata['Instruction']).',
                                    "Description":'.json_encode($redata['Description']).',
                                    "Weight_real":'.json_encode($redata['Weight_real']).',
                                    "Weight":'.json_encode($redata['Weight']).',
                                    "Koli":'.json_encode($redata['Goods_koli']).',
                                    "Detail":'.$redata['Goods_data'].'
                                },
                                "Route":{
                                    "ModeID":'.json_encode($redata['ModeID']).',
                                    "Mode":'.json_encode($redata['Mode']).',
                                    "Origin":'.json_encode($redata['Origin']).',
                                    "Destination":'.json_encode($redata['Destination']).',
                                    "Estimation":'.json_encode($redata['Estimation']).'
                                },
                                "Insurance":{
                                    "Rate":'.json_encode($redata['Insurance_rate']).',
                                    "Value":'.json_encode($redata['Goods_value']).'
                                },
                                "Tariff":{
                                    "KGP":'.json_encode($redata['Tariff_kgp']).',
                                    "KGS":'.json_encode($redata['Tariff_kgs']).',
                                    "MinKG":'.json_encode($redata['Tariff_kgp_min']).'
                                },
                                "Tariff_handling":{
                                    "KGP":'.json_encode($redata['Tariff_hkgp']).',
                                    "KGS":'.json_encode($redata['Tariff_hkgs']).',
                                    "MinKG":'.json_encode($redata['Tariff_hkgp_min']).'
                                },
                                "Payment":{
                                    "PaymentID":'.json_encode($redata['PaymentID']).',
                                    "Name":'.json_encode($redata['Payment']).'
                                },
                                "Transaction":{
                                    "Shipping_cost":'.json_encode($redata['Shipping_cost']).',
                                    "Shipping_insurance":'.json_encode($redata['Shipping_insurance']).',
                                    "Shipping_packing":'.json_encode($redata['Shipping_packing']).',
                                    "Shipping_forward":'.json_encode($redata['Shipping_forward']).',
                                    "Shipping_handling":'.json_encode($redata['Shipping_handling']).',
                                    "Shipping_surcharge":'.json_encode($redata['Shipping_surcharge']).',
                                    "Shipping_admin":'.json_encode($redata['Shipping_admin']).',
                                    "Shipping_discount":'.json_encode($redata['Shipping_discount']).',
                                    "Shipping_cost_total":'.json_encode($redata['Shipping_cost_total']).'
                                },
                                "Log":{
                                    "StatusID":'.json_encode($redata['StatusID']).',
                                    "Status":'.json_encode($redata['Status']).',
                                    "Updated_at":'.json_encode($redata['Updated_at']).',
                                    "Updated_by":'.json_encode($redata['Updated_by']).',
                                    "Updated_sys":'.json_encode($redata['Updated_sys']).'
                                },
                                "POD":{
                                    "Recipient":'.json_encode($redata['Recipient']).',
                                    "Relation":'.json_encode($redata['Relation']).'
                                }'.(!empty($datatrace)?',"Trace":'.$datatrace:'').'
                            },';
						}
						$datares = substr($datares, 0, -1);
						$datares .= "]";
						$data = [
			   	            'result' => json_decode($datares), 
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

        /** 
		 * Trace data waybill only single simple for public
		 * @return result process in json encoded data
		 */
		public function traceWaybillSimplePublic(){
			$sql = "SELECT a.Waybill,a.BranchID,a.DestID,
                a.CustomerID,a.Consignor_name,a.Consignor_alias,a.Consignor_address,a.Consignor_phone,a.Consignor_fax,a.Consignor_email,
                a.ReferenceID,a.Consignee_name,a.Consignee_attention,a.Consignee_address,a.Consignee_phone,a.Consignee_fax,
                a.ModeID,c.Mode,a.Origin,a.Destination,a.Estimation,
                a.StatusID,b.`Status`,d.Recipient,d.Relation,a.Created_at,a.Created_by,a.Updated_at,a.Updated_by,a.Updated_sys
            FROM transaction_waybill a
            INNER JOIN core_status b ON a.StatusID=b.StatusID
            INNER JOIN mas_mode c ON a.ModeID = c.ModeID
            LEFT JOIN log_data_pod d ON a.Waybill = d.WayBill
            WHERE a.Waybill = :waybill LIMIT 1;";
				
			$stmt = $this->db->prepare($sql);		
			$stmt->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

			if ($stmt->execute()) {	
    		    if ($stmt->rowCount() > 0){

                    $sql2 = "SELECT a.Created_at,a.CodeID,a.Description,a.StatusID,b.Status,a.Username
            			FROM log_data a
			        	INNER JOIN core_status b ON a.StatusID = b.StatusID
            			WHERE a.CodeID = :waybill
			        	ORDER BY a.ItemID ASC";
        			$stmt2 = $this->db->prepare($sql2);
        			$stmt2->bindParam(':waybill', $this->waybill, PDO::PARAM_STR);

                    if ($stmt2->execute()) {	
                        if ($stmt2->rowCount() > 0){
                            $datatrace = "[";
                            while($retrace = $stmt2->fetch()){
                                $datatrace .= '{
                                    "Created_at":'.json_encode($retrace['Created_at']).',
                                    "Description":'.json_encode($retrace['Description']).',
                                    "StatusID":'.json_encode($retrace['StatusID']).',
                                    "Status":'.json_encode($retrace['Status']).',
                                    "Created_by":'.json_encode($retrace['Username']).'
                                },';
                            }
                            $datatrace = substr($datatrace, 0, -1);
                            $datatrace .= "]";
                        }
                    }

        	   		$datares = "[";
						while($redata = $stmt->fetch()) 
						{
							$datares .= '{
                                "Data":{
                                    "Waybill":'.json_encode($redata['Waybill']).',
                                    "BranchID":'.json_encode($redata['BranchID']).',
                                    "DestID":'.json_encode($redata['DestID']).',
                                    "Created_at":'.json_encode($redata['Created_at']).',
                                    "Created_by":'.json_encode($redata['Created_by']).'
                                },
                                "Consignor":{
                                    "CustomerID":'.json_encode($redata['CustomerID']).',
                                    "Name":'.json_encode($redata['Consignor_name']).',
                                    "Alias":'.json_encode($redata['Consignor_alias']).',
                                    "Address":'.json_encode($redata['Consignor_address']).',
                                    "Phone":'.json_encode($redata['Consignor_phone']).',
                                    "Fax":'.json_encode($redata['Consignor_fax']).',
                                    "Email":'.json_encode($redata['Consignor_email']).'
                                },
                                "Consignee":{
                                    "ReferenceID":'.json_encode($redata['ReferenceID']).',
                                    "Name":'.json_encode($redata['Consignee_name']).',
                                    "Attention":'.json_encode($redata['Consignee_attention']).',
                                    "Address":'.json_encode($redata['Consignee_address']).',
                                    "Phone":'.json_encode($redata['Consignee_phone']).',
                                    "Fax":'.json_encode($redata['Consignee_fax']).'
                                },
                                "Route":{
                                    "ModeID":'.json_encode($redata['ModeID']).',
                                    "Mode":'.json_encode($redata['Mode']).',
                                    "Origin":'.json_encode($redata['Origin']).',
                                    "Destination":'.json_encode($redata['Destination']).',
                                    "Estimation":'.json_encode($redata['Estimation']).'
                                },
                                "Log":{
                                    "StatusID":'.json_encode($redata['StatusID']).',
                                    "Status":'.json_encode($redata['Status']).',
                                    "Updated_at":'.json_encode($redata['Updated_at']).',
                                    "Updated_by":'.json_encode($redata['Updated_by']).',
                                    "Updated_sys":'.json_encode($redata['Updated_sys']).'
                                },
                                "POD":{
                                    "Recipient":'.json_encode($redata['Recipient']).',
                                    "Relation":'.json_encode($redata['Relation']).'
                                }'.(!empty($datatrace)?',"Trace":'.$datatrace:'').'
                            },';
						}
						$datares = substr($datares, 0, -1);
						$datares .= "]";
						$data = [
			   	            'result' => json_decode($datares), 
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