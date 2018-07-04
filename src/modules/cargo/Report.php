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
use \classes\Validation as Validation;
use \classes\JSON as JSON;
use \classes\CustomHandlers as CustomHandlers;
use \modules\enterprise\Util as Util;
use \modules\cargo\Dictionary as Dictionary;
use \modules\cargo\TraceLog as TraceLog;
use PDO;
	/**
     * A class for report management cargo
     *
     * @package    Report Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class Report {
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
        var $firstdate,$lastdate,$search;
        
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
		 * Get data statistic page
		 * @return result process in json encoded data
		 */
		public function salesTransactionSummaryYear() {
			if (Auth::validToken($this->db,$this->token)){
                $newyear = Validation::integerOnly($this->year);
                $newusername = strtolower($this->username);
                $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
				$roles = Auth::getRoleID($this->db,$this->token);
				if($roles != 5){
					$sql = "SELECT 
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.StatusID='41' AND x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'success',
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.StatusID='29' AND x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'on_process',
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.StatusID='19' AND x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'failed',
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.StatusID='53' AND x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'returned',
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.StatusID='47' AND x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'void',
                        (SELECT count(x.Waybill) FROM transaction_waybill x WHERE x.BranchID=:branchid AND year(x.Created_at)=:newyear) AS 'total',
                        IFNULL((SELECT sum(x.Shipping_cost_total) FROM transaction_waybill x WHERE x.BranchID=:branchid AND year(x.Created_at)=:newyear AND x.StatusID<>'47'),0) AS 'gross_profit',
                        IFNULL(round((((SELECT total) - ((SELECT on_process)+(SELECT failed)+(SELECT returned)+(SELECT void)))/(SELECT total))*100),0) AS 'percent_up',
                        IFNULL((100 - (SELECT percent_up)),0) AS 'percent_down';";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':newyear', $newyear, PDO::PARAM_STR);
                    $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);

                    if ($stmt->execute()) {	
                        if ($stmt->rowCount() > 0){
                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $data = [
                                'result' => $results, 
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
	        $this->db= null;
		}
        
        /** 
		 * Get data statistic page in Year
		 * @return result process in json encoded data
		 */
        public function salesTransactionChartYear(){
			if (Auth::validToken($this->db,$this->token)){
				$newyear = Validation::integerOnly($this->year);
                $newusername = strtolower($this->username);
                $newbranchid = strtolower(Util::getUserBranchID($this->db,$newusername));
				$roles = Auth::getRoleID($this->db,$this->token);
				if($roles != 5){
					$sql = "SELECT 
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 1 GROUP BY MONTH(a.Created_at)) AS 'Jan',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 2 GROUP BY MONTH(a.Created_at)) AS 'Feb',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 3 GROUP BY MONTH(a.Created_at)) AS 'Mar',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 4 GROUP BY MONTH(a.Created_at)) AS 'Apr',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 5 GROUP BY MONTH(a.Created_at)) AS 'May',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 6 GROUP BY MONTH(a.Created_at)) AS 'Jun',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 7 GROUP BY MONTH(a.Created_at)) AS 'Jul',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 8 GROUP BY MONTH(a.Created_at)) AS 'Aug',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 9 GROUP BY MONTH(a.Created_at)) AS 'Sep',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 10 GROUP BY MONTH(a.Created_at)) AS 'Oct',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 11 GROUP BY MONTH(a.Created_at)) AS 'Nov',
                        (SELECT sum(a.Shipping_cost_total) AS Total FROM transaction_waybill a WHERE a.BranchID=:branchid AND a.StatusID <> '47' AND YEAR(a.Created_at) = :newyear AND MONTH(a.Created_at) = 12 GROUP BY MONTH(a.Created_at)) AS 'Dec';";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':newyear', $newyear, PDO::PARAM_STR);
                    $stmt->bindParam(':branchid', $newbranchid, PDO::PARAM_STR);
                    
                    if ($stmt->execute()) {
                        if ($stmt->rowCount() > 0){
                            $datares = "";
                            $datalabel = '{"labels":["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],';
                            $dataseries = '"series":[';
                            while($redata = $stmt->fetch()) {
                                $datares .= '
                                    ['.JSON::safeEncode($redata['Jan']).','.JSON::safeEncode($redata['Feb']).','.JSON::safeEncode($redata['Mar']).','.JSON::safeEncode($redata['Apr']).','.JSON::safeEncode($redata['May']).','.JSON::safeEncode($redata['Jun']).','.JSON::safeEncode($redata['Jul']).','.JSON::safeEncode($redata['Aug']).','.JSON::safeEncode($redata['Sep']).','.JSON::safeEncode($redata['Oct']).','.JSON::safeEncode($redata['Nov']).','.JSON::safeEncode($redata['Dec']).'],';
                            }
                            $datares = substr($datares, 0, -1);
                            $combine = $datalabel.$dataseries.$datares.']}';
                            $data = [
                                'results' => json_decode($combine), 
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
			$this->db= null;
        }
    
    }