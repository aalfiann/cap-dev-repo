<?php
require_once realpath(__DIR__ . '/..').'/config.php';
$vocabularies[] = [
    //your custom language variable
    'custom_test' => 'Test',
    //DataBank
    'databank' => 'Data Bank',
    'databank_name' => 'Nama Bank',
    'databank_fullname' => 'Nama Bank Lengkap',
    'databank_address' => 'Alamat Bank',
    'databank_account_name' => 'Nama Rekening',
    'databank_account_no' => 'No. Rekening',
    //Image Gallery 
    'gallery_image_me' => 'Galeri ku',
    'gallery_image_remote_upload' => 'Remote Upload',
    'gallery_image_url' => 'URL Gambar',
    'gallery_image_url_placehold' => 'Contoh: http://the-image.com/abc.jpg',
    'gallery_image_title' => 'Judul Gambar',
    'gallery_image_title_placehold' => 'Input judul gambar disini...',
    'gallery_image_desc_placehold' => 'Input deskripsi gambar disini...',
    'gallery_image_about' => 'Galeri ku ini berfungsi untuk berbagi, menduplikasi dan publikasi gambar Anda secara publik.',
    'gallery_image_about_2' => '<br><br><b>Catatan:</b><br>- Kami tidak mengunggah dan menyimpan gambar Anda ke dalam server kami.',
    //invoice
    'invoice' => 'Invoice',
    'invoice_id' => 'Invoice ID',
    'invoice_create' => 'Buat Invoice Baru',
    'invoice_edit' => 'Edit Invoice',
    'invoice_date' => 'Tanggal',
    'invoice_id_po' => 'PO',
    'invoice_po' => 'No. PO',
    'invoice_item_id' => 'No. AWB',
    'invoice_payment' => 'Pembayaran',
    'invoice_from' => 'Dari',
    'invoice_to' => 'Kepada',
    'invoice_name' => 'Nama',
    'invoice_name_company' => 'Nama Perusahaan',
    'invoice_address' => 'Alamat',
    'invoice_phone' => 'Telepon',
    'invoice_fax' => 'Fax',
    'invoice_email' => 'Email',
    'invoice_website' => 'Website',
    'invoice_description' => 'Keterangan',
    'invoice_qty' => 'QTY',
    'invoice_amount' => 'Harga',
    'invoice_sub_total' => 'Sub Total',
    'invoice_tax_total' => 'Ppn',
    'invoice_total' => 'Total',
    'invoice_tax' => 'PPn %',
    'invoice_term' => 'Tempo (hari)',
    'invoice_due_date' => 'Jatuh Tempo',
    'invoice_signature' => 'Nama Tanda Tangan',
    'invoice_bank' => 'Bank',
    'invoice_bank_name' => 'Nama Bank',
    'invoice_bank_address' => 'Alamat Bank',
    'invoice_bank_account_name' => 'Nama Rekening',
    'invoice_bank_account_no' => 'No Rekening',
    'invoice_val_row_empty' => 'Data invoice masih kosong!',
    'invoice_recipient_signature' => 'Penerima',
    'invoice_recipient_signature_info' => '(Tanggal, Nama dan Tanda tangan)',
    'invoice_authorized_signature' => 'Tanda Tangan Resmi',
    'invoice_amount_in_word' => 'Terbilang',
    //deposit
    'deposit' => 'Deposit',
    'deposit_transaction_create' => 'Buat Transaksi',
    'deposit_ho' => 'Deposit HO',
    'deposit_id' => 'DepositID',
    'deposit_refid' => 'ReferenceID',
    'deposit_date' => 'Tanggal',
    'deposit_desc' => 'Deskripsi',
    'deposit_description' => 'Riwayat semua transaksi deposit ada disini.',
    'deposit_description_report' => 'Laporan total deposit saldo semua pengguna ada disini.',
    'deposit_credit' => 'Kredit',
    'deposit_debit' => 'Debet',
    'deposit_task' => 'Task',
    'deposit_before' => 'Sebelum',
    'deposit_mutation' => 'Mutasi',
    'deposit_mutation_data' => 'Data Mutasi Saldo',
    'deposit_balance' => 'Saldo',
    'deposit_topup' => 'Topup',
    'deposit_info_bank' => 'Informasi Rekening Bank',
    'deposit_info_detail' => 'Info Detil',
    'deposit_help_id' => 'DepositID adalah username penerima.',
    'deposit_help_refid' => 'ReferenceID adalah kode unik transaksi.',
    'deposit_help_desc' => 'Deskripsi tentang transaksi Anda.',
    'deposit_help_mutation' => 'Masukkan nilai nominal transaksi.',
    'deposit_transaction_do' => 'Akan melakukan transaksi',
    'deposit_transaction_confirm' => 'Transaksi ini tidak dapat dibatalkan!',
    'deposit_transaction_submit_yes' => 'Iya, Lanjutkan Saja!',
    'deposit_transaction_success' => 'Transaksi Berhasil!',
    'deposit_transaction_failed' => 'Transaksi Gagal!',
    //livechat
    'livechat' => 'Live Chat',
    //flexible config
    'flexibleconfig' => 'Flexible Config',
    'flexibleconfig_description' => 'Simpan konfigurasi tanpa batas untuk penggunaan yang fleksibel.',
    'flexibleconfig_key' => 'Key',
    'flexibleconfig_value' => 'Value',
    'flexibleconfig_desc' => 'Deskripsi',
    'flexibleconfig_delete_warning' => 'Hati - hati! Menghapus Flexible Config mengakibatkan kerusakan pada aplikasi!',
    //agent
    'agent' => 'Agent',
    'agent_setting' => 'Pengaturan Agent',
    'agent_setting_description' => 'Semua data pengaturan agent Anda ada disini.',
    'agent_setting_key' => 'Key',
    'agent_setting_value' => 'Value',
    'agent_setting_desc' => 'Deskripsi',
    'agent_setting_delete_warning' => 'Data pengaturan agent diperlukan untuk transaksi waybill!',
    'agent_setting_logo' => 'URL Logo',
    'agent_setting_company' => 'Perusahaan',
    'agent_setting_company_name' => 'Nama',
    'agent_setting_company_alias' => 'Nama Alias (Sebutan atau Disingkat)',
    'agent_setting_company_slogan' => 'Slogan',
    'agent_setting_company_address' => 'Alamat',
    'agent_setting_company_phone' => 'Telp',
    'agent_setting_company_fax' => 'Fax',
    'agent_setting_company_email' => 'Email',
    'agent_setting_company_tin' => 'Legalitas',
    'agent_setting_company_hotline' => 'Hotline',
    'agent_setting_company_website' => 'Website',
    'agent_setting_company_coordinat' => 'Koordinat',
    'agent_setting_company_facebook' => 'Facebook',
    'agent_setting_company_twitter' => 'Twitter',
    'agent_setting_company_gplus' => 'Google+',
    'agent_setting_company_owner' => 'Nama Pemilik',
    'agent_setting_company_signature_name' => 'Nama Tanda Tangan',
    'agent_setting_company_footer' => 'Catatan Kaki',
    'agent_setting_bank' => 'Bank',
    'agent_setting_bank_name' => 'Nama Bank',
    'agent_setting_bank_address' => 'Alamat Bank',
    'agent_setting_bank_account_name' => 'Nama Rekening',
    'agent_setting_bank_account_no' => 'No Rekening',
    'agent_setting_other' => 'Lain - lain',
    'agent_setting_origin_district' => 'Kota/Kabupaten',
    'agent_setting_admin_cost' => 'Biaya Admin',
    'agent_setting_warning_transaction_title' => 'Transaki Ditunda!',
    'agent_setting_warning_transaction_setting' => 'Anda belum melengkapi pengaturan data Agen!',
    'agent_gross_profit' => 'Laba Kotor',
    'agent_rate_shipping' => 'Rate Sukses',
    'agent_total_onprocess' => 'Total On Process',
    'agent_total_success' => 'Total Success',
    'agent_total_failed' => 'Total Failed',
    'agent_total_return' => 'Total Return',
    'agent_total_void' => 'Total Void',
    'agent_total_waybill' => 'Total Waybill',
    'agent_notice_chart' => '<strong>Perhatian:</strong><p>Grafik Data Transaksi ini menampilkan summary data dalam jangka 1 tahun.<br>Dan akan direset otomatis pada setiap awal tahun.</p>',
    //agent helper
    'agent_helper_logo' => 'Standarisasi ukuran logo untuk perusahaan harus 150x60 px.',
    'agent_helper_company_name' => 'Waybill akan otomatis menggunakan nama perusahaan jika tidak ada logo',
    'agent_helper_company_website' => 'Website perusahaan Anda.',
    'agent_helper_company_coordinat' => 'Anda bisa mendapatkan lokasi koordinat dari <a href="http://map.google.com" target="_blank">Google Map</a>',
    'agent_helper_company_hotline' => 'No ekstension penting untuk customer Anda.',
    'agent_helper_company_signature_name' => 'Waybill akan otomatis menggunakan username jika tidak ada nama tanda tangan',
    'agent_helper_company_owner' => 'Nama pemilik perusahaan.',
    'agent_helper_company_tin' => 'Nomor legalitas perusahaan (NPWP/SIUP/AKTA).',
    'agent_helper_bank_account_name' => 'Nama Rekening Bank.',
    'agent_helper_bank_account_no' => 'No Rekening Bank.',
    'agent_helper_origin_district' => 'Atur kota/kabupaten asal untuk digunakan di transaksi waybill.',
    'agent_helper_admin_cost' => 'Atur default biaya admin untuk digunakan di transaksi waybill.',
    //agent placeholder
    'agent_placeholder_logo' => 'Contoh: http://domain.com/logo-anda.jpg',
    'agent_placeholder_company_facebook' => 'Contoh: http://facebook.com/username',
    'agent_placeholder_company_twitter' => 'Contoh: http://twitter.com/username',
    'agent_placeholder_company_gplus' => 'Contoh: http://plus.google.com/123456789',
    'agent_placeholder_bank_name' => 'Contoh: Bank BCA / Bank Mandiri / Bank BRI...',
    //trace
    'trace' => 'Trace',
    'trace_go' => 'GO!',
    //trace placeholder
    'trace_placeholder_waybill' => 'Contoh: CGK12345xxxxx',
    //global
    'via' => 'Via',
    'service' => 'Layanan',
    'reason' => 'Sebab',
    'result' => 'Hasil',
    'clear' => 'Hapus',
    'submit_success' => 'Submit Sukses!',
    'submit_failed' => 'Submit Gagal!',
    //direction
    'next' => 'Berikutnya',
    'previous' => 'Sebelumnya',
    'go_back' => 'Kembali',
    //wizard
    'step_next' => 'Berikutnya <i class="mdi mdi-skip-next"></i>',
    'step_previous' => '<i class="mdi mdi-skip-previous"></i> Sebelumnya',
    'step_loading' => 'Loading...',
    'step_pagination' => 'Paginasi',
    'step_current' => 'langkah saat ini:',
    //nominal
    'currency_format' => 'Rp.',
    //cargo
    'minimum_kg' => 'Minimal Kg',
    'minimum_weight' => 'Minimal Berat',
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
    'data_origin' => 'Data Origin',
    'destination' => 'Destinasi',
    'branch_origin' => 'Cabang Origin',
    'branchid_origin' => 'ID Cabang Origin',
    'branchid_destination' => 'ID Cabang Destinasi',
    'weight' => 'Berat',
    'actkg' => 'Act. Kg',
    'volkg' => 'Vol. Kg',
    'realkg' => 'Real Kg',
    'days' => 'Hari',
    'mode' => 'Moda',
    'modeid' => 'Moda ID',
    'type' => 'Tipe',
    'customer' => 'Customer',
    'actual' => 'Actual',
    'bag' => 'Koli',
    'waybill' => 'Waybill',
    'pod' => 'Proof of Delivery',
    'void' => 'Void',
    'deliveryid' => 'Delivery ID',
    'return' => 'Retur',
    'return_shipper' => 'Permintaan Pengirim',
    'return_recipient' => 'Permintaan Penerima',
    'return_origin' => 'Permintaan Origin',
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
    'alias' => 'Alias',
    'shipper_address' => 'Alamat Pengirim',
    'shipper_phone' => 'Telp. Pengirim',
    'shipper_fax' => 'Fax Pengirim',
    'reference_id' => 'Referensi ID',
    'attention_name' => 'U.P.',
    'att' => 'U.P.',
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
    'goods_description' => 'Deskripsi Barang',
    //help transaction
    'help_browse_customer' => 'Klik browse untuk mencari Customer ID.',
    'help_reference_id' => 'Referensi ID adalah no resi mitra, agar sistem dapat tracking menggunakan no resi mitra.',
    'help_dest_id' => 'Anda harus memilih cabang destinasi mana yang akan menghandle barang Anda.<br>Jika <span class="badge badge-inverse">City Courier</span> atau <span class="badge badge-inverse">Direct</span> maka pilih cabang Anda sendiri.',
    //help void
    'help_void' => 'Void adalah pembatalan dokumen',
    'help_void_waybill' => 'Waybill hanya dapat di void oleh Origin',
    //help pod
    'help_pod' => 'POD adalah laporan status pengantaran',
    'help_pod_waybill' => 'POD Status hanya dapat di isi oleh Destinasi',
    'help_pod_description' => 'Perhatian, Harap diisi dengan bijak karena akan dibaca oleh customer',
    //validation
    'select_destination_required' => 'Anda belum memilih cabang destinasi!',
    //input transaction
    'input_browse_customer' => 'Customer ID dapat berupa ID Corporate atau ID Member...',
    'input_reference_id' => 'Referensi ID harus unik...',
    'input_reference_id_val' => 'Input 8-20 karakter. Contoh: '.uniqid(rand(10,99).'/'.rand(1,9).'-'.rand(1,9).'.'),
    //inquiry
    'inquiry' => 'Inquiry',
    'check_tariff' => 'Cek Tarif',
    'calculate_tariff' => 'Hitung Tarif',
    'tariff_cubic_info' => 'Kubikasi hanya berlaku pada tariff via laut (Sea) saja.',
    //placeholder
    'city_district' => 'Kota / Kabupaten',
    //print
    'print' => 'Print',
    'print_preview' => 'Pratinjau Print',
    //print report
    'sheet_for_shipper' => 'Lembar 1 untuk pengirim.',
    'sheet_for_goods' => 'Lembar 2 POD/Barang.',
    'sheet_for_goods_only' => 'Lembar 2 Barang/Penerima.',
    'sheet_for_pod' => 'Lembar 3 untuk POD.',
    'tel' => 'Telp',
    'route_shipment' => 'Rute Kiriman',
    'date_transaction' => 'Tanggal Transaksi',
    'date_send' => 'Tanggal Kirim',
    'date_received' => 'Tanggal Diterima',
    'admin' => 'Admin',
    'custid' => 'Cust. ID',
    'refid' => 'Ref. ID',
    'weight_or_volume' => 'Kg/Vol',
    'relation_status' => 'Hubungan Status',
    //print info
    'print_desktop_notice' => 'Jika menggunakan Handphone, hanya tampilan saja yang terlihat rusak, tapi hasil print tetap oke.',
    //signature
    'info_signature_1' => '* TTD dan Nama',
    'info_signature_2' => '* TTD, Nama dan Hubungan Status',
    //report
    'report' => 'Laporan',
    'firstdate' => 'Tanggal Awal',
    'lastdate' => 'Tanggal Akhir',
    'destid' => 'Dest. ID',
    //tracking
    'shipment_history' => 'Riwayat Kiriman',
    'received_by' => 'Diterima oleh'
];