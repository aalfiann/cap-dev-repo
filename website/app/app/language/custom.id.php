<?php
require_once realpath(__DIR__ . '/..').'/config.php';
$customlang = [
    //your custom language variable
    'custom_test' => 'Test',
    //global
    'result' => 'Hasil',
    'clear' => 'Hapus',
    'submit_success' => 'Submit Sukses!',
    'submit_failed' => 'Submit Gagal!',
    //direction
    'next' => 'Berikutnya',
    'previous' => 'Sebelumnya',
    //wizard
    'step_next' => 'Berikutnya <i class="mdi mdi-skip-next"></i>',
    'step_previous' => '<i class="mdi mdi-skip-previous"></i> Sebelumnya',
    'step_loading' => 'Loading...',
    'step_pagination' => 'Paginasi',
    'step_current' => 'langkah saat ini:',
    //nominal
    'currency_format' => 'Rp.',
    //cargo
    'tariff' => 'Tarif',
    'handling' => 'Handling',
    'district' => 'Kabupaten',
    'kgp' => 'KGP',
    'kgs' => 'KGS',
    'minkg' => 'Min_Kg',
    'hkgp' => 'H_KGP',
    'hkgs' => 'H_KGS',
    'hminkg' => 'H_Min_Kg',
    'estimation' => 'Estimasi',
    'origin' => 'Kota Asal',
    'destination' => 'Destinasi',
    'weight' => 'Berat',
    'actkg' => 'Act. Kg',
    'volkg' => 'Vol. Kg',
    'realkg' => 'Real Kg',
    'days' => 'Hari',
    'mode' => 'Moda',
    'type' => 'Tipe',
    'customer' => 'Customer',
    'actual' => 'Actual',
    'bag' => 'Koli',
    //dimension
    'length' => 'Panjang',
    'width' => 'Lebar',
    'height' => 'Tinggi',
    'volume' => 'Volume',
    'cubication' => 'Kubikasi',
    //transaction
    'transaction' => 'Transaksi',
    'payment_method' => 'Metode Pembayaran',
    'shipper' => 'Pengirim',
    'consignee' => 'Penerima',
    'payment' => 'Pembayaran',
    'customer_id' => 'Customer ID',
    'customer_type' => 'Tipe Customer',
    'browse' => 'Browse',
    'shipper_name' => 'Nama Pengirim',
    'shipper_alias_name' => 'Nama Alias',
    'shipper_address' => 'Alamat Pengirim',
    'shipper_phone' => 'Telp. Pengirim',
    'shipper_fax' => 'Fax Pengirim',
    'reference_id' => 'Referensi ID',
    'attention_name' => 'U.P.',
    'consignee_name' => 'Nama Penerima',
    'consignee_address' => 'Alamat Penerima',
    'consignee_phone' => 'Telp. Penerima',
    'consignee_fax' => 'Fax Penerima',
    //transaction helper
    'transaction_success' => 'Transaksi Sukses!',
    'transaction_failed' => 'Transaksi Gagal!',
    'transaction_failed_customer' => 'Selain Non Member, Customer ID harus diisi!',
    'transaction_input_notice' => 'Kolom yang diberi tanda bintang wajib diisi.',
    //shipping
    'shipping_cost' => 'Biaya Kirim',
    'shipping_cost_admin' => 'Biaya Admin',
    'shipping_cost_discount' => 'Diskon',
    'shipping_cost_forward' => 'Biaya Penerus',
    'shipping_cost_handling' => 'Biaya Handling',
    'shipping_cost_insurance' => 'Biaya Asuransi',
    'shipping_cost_packing' => 'Biaya Packing',
    'shipping_cost_surcharge' => 'Biaya Tambahan',
    'shipping_cost_total' => 'Total Biaya',
    //insurance
    'insurance' => 'Asuransi',
    'insurance_calculate' => 'Hitung Asuransi',
    'insurance_rate' => 'Rate Premi',
    //goods
    'goods_value' => 'Nilai Barang',
    'goods_weight' => 'Berat Barang',
    'goods_detail' => 'Detil Barang',
    'goods_instruction' => 'Instruksi',
    'goods_description' => 'Deskripsi',
    //help transaction
    'help_browse_customer' => 'Klik browse untuk mencari Customer ID.',
    'help_reference_id' => 'Referensi ID adalah no resi mitra, agar sistem dapat tracking menggunakan no resi mitra.',
    //input transaction
    'input_browse_customer' => 'Customer ID dapat berupa ID Corporate atau ID Member...',
    'input_reference_id' => 'Referensi ID harus unik...',
    'input_reference_id_val' => 'Input 8-20 karakter. Contoh: '.uniqid(rand(10,99).'/'.rand(1,9).'-'.rand(1,9).'.'),
    //inquiry
    'inquiry' => 'Inquiry',
    'check_tariff' => 'Cek Tarif',
    'calculate_tariff' => 'Hitung Tarif',
    //placeholder
    'city_district' => 'Kota / Kabupaten'
];