<?php
require_once realpath(__DIR__ . '/..').'/config.php';
$customlang = [
    //your custom language variable
    'custom_test' => 'Test',
    //global
    'result' => 'Result',
    'clear' => 'Clear',
    'submit_success' => 'Submit Success!',
    'submit_failed' => 'Submit Failed!',
    //direction
    'next' => 'Next',
    'previous' => 'Previous',
    'go_back' => 'Go Back',
    //wizard
    'step_next' => 'Next <i class="mdi mdi-skip-next"></i>',
    'step_previous' => '<i class="mdi mdi-skip-previous"></i> Previous',
    'step_loading' => 'Loading...',
    'step_pagination' => 'Pagination',
    'step_current' => 'current step:',
    //nominal
    'currency_format' => '$',
    //cargo
    'tariff' => 'Tariff',
    'handling' => 'Handling',
    'district' => 'District',
    'kgp' => 'KGP',
    'kgs' => 'KGS',
    'minkg' => 'Min_Kg',
    'hkgp' => 'H_KGP',
    'hkgs' => 'H_KGS',
    'hminkg' => 'H_Min_Kg',
    'estimation' => 'Estimation',
    'origin' => 'Origin',
    'destination' => 'Destination',
    'branchid_origin' => 'Branch ID Origin',
    'branchid_destination' => 'Branch ID Destination',
    'weight' => 'Weight',
    'actkg' => 'Act. Kg',
    'volkg' => 'Vol. Kg',
    'realkg' => 'Real Kg',
    'days' => 'Day(s)',
    'mode' => 'Mode',
    'type' => 'Type',
    'customer' => 'Customer',
    'actual' => 'Actual',
    'bag' => 'Bag',
    'waybill' => 'Waybill',
    //dimension
    'length' => 'Length',
    'width' => 'Width',
    'height' => 'Height',
    'volume' => 'Volume',
    'cubication' => 'Cubication',
    //transaction
    'transaction' => 'Transaction',
    'payment_method' => 'Payment Method',
    'shipper' => 'Shipper',
    'consignee' => 'Consignee',
    'payment' => 'Payment',
    'customer_id' => 'Customer ID',
    'customer_type' => 'Customer Type',
    'browse' => 'Browse',
    'shipper_name' => 'Shipper Name',
    'shipper_alias_name' => 'Alias Name',
    'shipper_address' => 'Shipper Address',
    'shipper_phone' => 'Shipper Phone',
    'shipper_fax' => 'Shipper Fax',
    'reference_id' => 'Referensi ID',
    'attention_name' => 'Attention Name',
    'consignee_name' => 'Consignee Name',
    'consignee_address' => 'Consignee Address',
    'consignee_phone' => 'Consignee Phone',
    'consignee_fax' => 'Consignee Fax',
    //transaction helper
    'transaction_success' => 'Transaction Success!',
    'transaction_failed' => 'Transaction Failed!',
    'transaction_failed_customer' => 'Except Non Member, Customer ID is required to filled!',
    'transaction_input_notice' => 'Fields marked with an asterisk are required.',
    //shipping
    'shipping_cost' => 'Shipping Cost',
    'shipping_cost_admin' => 'Admin Fee',
    'shipping_cost_discount' => 'Discount',
    'shipping_cost_forward' => 'Forwarding Cost',
    'shipping_cost_handling' => 'Handling Cost',
    'shipping_cost_insurance' => 'Insurance Fee',
    'shipping_cost_packing' => 'Packing Cost',
    'shipping_cost_surcharge' => 'Surcharge',
    'shipping_cost_total' => 'Total Cost',
    //insurance
    'insurance' => 'Insurance',
    'insurance_calculate' => 'Calculate Insurance',
    'insurance_rate' => 'Rate Premium',
    //goods
    'goods_value' => 'Nilai Barang',
    'goods_weight' => 'Weight of Goods',
    'goods_detail' => 'Goods Detail',
    'goods_instruction' => 'Instruction',
    'goods_description' => 'Description',
    //help transaction
    'help_browse_customer' => 'Click browse to search Customer ID.',
    'help_reference_id' => 'Reference ID is no partner\'s receipt, so the system can tracking using no partner\'s receipt.',
    'help_dest_id' => 'You have to choose which branch of destination will handle your goods.<br>If City Courier then select your own branch.',
    //validation
    'select_destination_required' => 'You have not selected destination branches yet!',
    //input transaction
    'input_browse_customer' => 'Customer ID could be ID Corporate or ID Member...',
    'input_reference_id' => 'Referensi ID must unique...',
    'input_reference_id_val' => 'Input 8-20 chars. Example: '.uniqid(rand(10,99).'/'.rand(1,9).'-'.rand(1,9).'.'),
    //inquiry
    'inquiry' => 'Inquiry',
    'check_tariff' => 'Check Tariff',
    'calculate_tariff' => 'Calculate Tariff',
    //placeholder
    'city_district' => 'City / District',
    //print
    'print' => 'Print',
    'print_preview' => 'Preview Print'
];