<?php
require_once realpath(__DIR__ . '/..').'/config.php';
$lang = [
    //core
    'core_register_success' => 'Proses Pendaftaran Berhasil!',
    'core_register_failed' => 'Proses Pendaftaran Gagal!',
    'core_update_success' => 'Proses Pembaharuan Berhasil!',
    'core_update_failed' => 'Proses Pembaharuan Gagal!',
    'core_delete_success' => 'Proses Hapus Berhasil!',
    'core_delete_failed' => 'Proses Hapus Gagal!',
    'core_upload_success' => 'Proses Unggah Berhasil!',
    'core_upload_failed' => 'Proses Unggah Gagal!',
    'core_login_failed' => 'Proses Masuk Gagal!',
    'core_not_connected' => 'Tidak dapat tersambung ke server!',
    'core_api_add_success' => 'Proses Menambahkan API Keys Berhasil!',
    'core_api_add_failed' => 'Proses Menambahkan API Keys Gagal!',
    'core_mail_reset_password1' => 'Permintaan reset kata sandi',
    'core_mail_reset_password2' => 'Anda telah membuat permintaan untuk reset kata sandi.',
    'core_mail_reset_password3' => 'Ini adalah link untuk reset:',
    'core_mail_reset_password4' => 'Hiraukan email ini jika Anda tidak ingin mereset kata sandi. Link akan kadaluarsa secara otomatis dalam waktu 3 hari dari sekarang.',
    'core_mail_reset_password5' => 'Terima Kasih',
    'core_reset_password_success1' => 'Permintaan reset kata sandi telah terkirim ke email Anda!',
    'core_reset_password_success2' => 'Jika tidak ada, cobalah untuk periksa folder spam atau mengulang lagi nanti.',
    'core_reset_password_failed' => 'Proses Lupa Kata Sandi Gagal!',
    'core_change_password_success' => 'Proses Ubah Kata Sandi Berhasil!',
    'core_change_password_failed' => 'Proses Ubah Kata Sandi Gagal!',
    'core_mail_send_success' => 'Pesan telah berhasil terkirim!',
    'core_mail_send_failed' => 'Pesan gagal terkirim!',
    'core_try_again' => 'Silahkan coba lagi nanti!',
    'core_settings_changed' => 'Pengaturan telah berubah!',
    'core_auto_refresh' => 'Halaman ini akan disegarkan secara otomatis dalam 2 detik...',
    'core_clear_log_success' => 'Proses Hapus Log Berhasil!',
    'core_clear_log_failed' => 'Proses Hapus Log Gagal!',
    'core_process_add' => 'Proses Menambahkan',
    'core_process_update' => 'Proses Pembaharuan',
    'core_process_delete' => 'Proses Hapus',
    //development
    'app' => 'Aplikasi',
    'maintenance' => 'Perawatan',
    'extension' => 'Extension',
    'develop_process_title' => 'Proses Pembangunan',
    'develop_process_info' => 'Maaf, halaman ini masih dalam proses pembangunan.',
    'maintenance_process_title' => 'Proses Perawatan',
    'maintenance_process_info' => 'Maaf, halaman ini masih dalam proses perawatan.',
    //theme
    'theme_panel' => 'Panel Tema',
    'theme_light' => 'Tema Cerah',
    'theme_dark' => 'Tema Gelap',
    //login
    'login' => 'Masuk',
    'form_login' => 'Form Masuk',
    //register
    'register' => 'Pendaftaran',
    'form_register' => 'Form Pendaftaran',
    'have_account' => 'Sudah punya akun?',
    //contact
    'contact_us' => 'Hubungi Kami',
    'form_contact_us' => 'Form Hubungi Kami',
    'send_message_failed' => 'Proses Kirim Pesan Gagal,',
    'wrong_security_key' => 'Kode Keamanan Salah!',
    'send_message' => 'Kirim Pesan',
    //forgot password
    'reset_password' => 'Permintaan Reset Kata Sandi',
    'form_reset_password' => 'Form Permintaan Reset Kata Sandi',
    'submit_reset_password' => 'Reset Kata Sandi',
    //verify password
    'verify_password' => 'Verifikasi Kata Sandi Baru',
    'form_verify_password' => 'Form Verifikasi Kata Sandi Baru',
    //dashboard
    'dashboard' => 'Dashboard',
    //api key
    'api_key' => 'API Key',
    'api_keys' => 'API Keys',
    //data user, edit, view profile
    'edit_user_profile' => 'Ubah Profil Pengguna',
    'user_profile' => 'Profil Pengguna',
    'my_profile' => 'Profilku',
    'view_profile' => 'Lihat Profil',
    //explore file
    'explore_file' => 'Jelajah File',
    'file_cloud' => 'File Cloud',
    'upload_file' => 'Unggah File ke Server',
    'upload_now' => 'Unggah Sekarang',
    'detail_file' => 'Detil File',
    'upload_here' => 'Unggah file disini...',
    //data page
    'page' => 'Halaman',
    'page_id' => 'Halaman ID',
    'image' => 'Gambar',
    'tags' => 'Tags',
    'description' => 'Deskripsi',
    'content' => 'Konten',
    'data_page' => 'Data Halaman',
    'create_page' => 'Buat Halaman Baru',
    'update_page' => 'Perbaharui Halaman',
    'save_page' => 'Publikasikan Halaman',
    'form_editor' => 'Form Editor',
    //user access
    'my_access' => 'Aksesku',
    'user_access' => 'Akses Pengguna',
    'title_access' => 'Akses Token Data',
    'info_access' => 'Token Anda akan otomatis dihapus saat Anda logout atau mencapai tanggal kedaluwarsa.',
    'notice_access' => 'Anda bisa segera mencabut token tersebut jika Anda merasa seseorang telah mencurinya.',
    'revoke_access' => 'Cabut',
    'revoke_access_all' => 'Cabut Semua Token',
    'active_access' => 'Token sedang dipakai sekarang',
    'token' => 'Token',
    'date_login' => 'Tanggal Login',
    'expired' => 'Kedaluwarsa',
    //settings
    'tools' => 'Perkakas',
    'settings' => 'Pengaturan',
    'no_have_api' => 'Tidak punya API Keys? Anda dapat membuatnya',
    //error log
    'error_log' => 'Error Log',
    'error_log_title' => 'Error Log di API Server',
    'error_log_description' => 'Ini adalah data log yang terekam di API Server Anda',
    'clear_log' => 'Hapus Log',
    //general
    'home' => 'Beranda',
    'username' => 'Nama Pengguna (Username)',
    'password' => 'Kata Sandi (Password)',
    'confirm_password' => 'Konfirmasi Kata Sandi',
    'new_password' => 'Kata Sandi Baru',
    'notice_change_password' => 'Untuk alasan keamanan, Anda akan otomatis keluar jika salah input kata sandi lama.',
    'confirm_new_password' => 'Konfirmasi Kata Sandi Baru',
    'change_password' => 'Ubah Kata Sandi',
    'not_match_password' => 'Kata sandi Anda tidak cocok!',
    'fullname' => 'Nama Lengkap',
    'address' => 'Alamat',
    'phone' => 'Telepon',
    'about_me' => 'Tentang Saya',
    'avatar' => 'Avatar',
    'security_key' => 'Kode Keamanan:',
    'name' => 'Nama',
    'email_address' => 'Alamat Email',
    'subject' => 'Judul',
    'message' => 'Pesan',
    'remember_me' => 'Ingat Saya',
    'forgot_password' => 'Lupa Kata Sandi?',
    'terms' => 'Persyaratan Layanan',
    'i_agree' => 'Saya setuju dengan',
    'not_agree' => 'Anda tidak menyetujui Persyaratan Layanan kami!',
    'close' => 'Tutup',
    'submit' => 'Submit',
    'search' => 'Cari',
    'add' => 'Tambah',
    'cancel' => 'Batal',
    'edit' => 'Edit',
    'manage' => 'Kelola',
    'delete' => 'Hapus',
    'domain' => 'Domain',
    'data' => 'Data',
    'shows_no' => 'Menampilkan no:',
    'from_total_data' => 'dari total data:',
    'export' => 'Ekspor',
    'status' => 'Status',
    'update' => 'Perbaharui',
    'user' => 'Pengguna',
    'profile' => 'Profil',
    'registered' => 'Terdaftar',
    'last_updated' => 'Terakhir Diperbaharui',
    'title' => 'Judul',
    'alternate' => 'Alternatif Judul',
    'external_link' => 'Eksternal Link',
    'browse_file' => 'Cari File',
    'show_detail' => 'Lihat Detil',
    'base_path' => 'Base Path',
    'url_api' => 'Url API',
    'save' => 'Simpan',
    'info' => 'Info',
    'not_found' => 'Tidak Ditemukan',
    'logout' => 'Keluar',
    'explore' => 'Jelajah',
    'here' => 'disini',
    'status_success' => 'Berhasil!',
    'status_failed' => 'Gagal!',
    //general table
    'tb_no' => 'No',
    'tb_item_id' => 'Item ID',
    'tb_role' => 'Sebagai',
    'tb_username' => 'Username',
    'tb_created_at' => 'Dibuat',
    'tb_updated_at' => 'Diperbaharui saat',
    'tb_updated_by' => 'Diperbaharui oleh',
    'tb_date_upload' => 'Tanggal Unggah',
    'tb_upload_by' => 'Diunggah oleh',
    'tb_file_type' => 'Tipe File',
    'tb_direct_link' => 'Direct Link',
    //datatables default
    'dt_not_found' => 'Maaf, Data tidak ditemukan',
    'dt_display' => 'Tampilkan _MENU_ data per halaman',
    'dt_info' => 'Menampilkan halaman _PAGE_ dari _PAGES_',
    'dt_info_empty' => 'Data tidak tersedia',
    'dt_filtered' => '(memfilter dari _MAX_ total data)',
    //datatables custom
    'dt_shows_page' => 'Halaman',
    'dt_of' => 'dari',
    //general input form
    'input_username' => 'Nama Pengguna Anda',
    'input_password' => 'Kata Sandi Anda',
    'input_name' => 'Nama Anda disini...',
    'input_email' => 'Alamat Email Anda disini...',
    'input_subject' => 'Tulis judul disini...',
    'input_message' => 'Isi pesan Anda disini...',
    'input_security_key' => 'Jawab pertanyaan disini...',
    'input_confirm_password' => 'Ulangi Kata Sandi Anda',
    'input_fullname' => 'Nama Lengkap Anda disini...',
    'input_address' => 'Alamat Anda disini...',
    'input_phone' => 'Telepon Anda disini...',
    'input_about_me' => 'Deskripsi mengenai Anda...',
    'input_avatar' => 'Harap input url gambar untuk avatar Anda.',
    'input_search' => 'Cari disini...',
    'input_domain' => 'Domain Anda disini...',
    'input_api_key' => 'API Key Anda disini...',
    'input_image_page' => 'Input url gambar untuk halaman Anda disini...',
    'input_title_page' => 'Input judul halaman Anda disini...',
    'input_tags_page' => 'Input Tags halaman Anda pisahkan dengan koma disini...',
    'input_description_page' => 'Input deskripsi halaman Anda disini...',
    'input_content_page' => 'Input konten halaman Anda disini...',
    'input_title_file' => 'Nama judul dari file Anda...',
    'input_title_website' => 'Judul website Anda...',
    'input_alternate_file' => 'Nama judul alternatif dari file Anda...',
    'input_external_link' => 'Url ke link eksternal...',
    'input_choose_file' => 'Pilih File',
    'input_item_id' => 'Item ID dari file Anda...',
    'input_date_upload' => 'Tanggal Unggah dari file Anda...',
    'input_upload_by' => 'Nama penggugah file Anda...',
    'input_file_type' => 'Tipe dari file Anda...',
    'input_direct_link' => 'Url direct link dari file Anda...',
    'input_base_path' => 'Input url folder website Anda...',
    'input_url_api' => 'Input url folder Rest API Anda...',
    //general modal
    'modal_terms' => '<p>Anda setuju, melalui penggunaan layanan ini, Anda tidak akan menggunakan 
    aplikasi ini untuk mengirim materi yang secara sengaja salah dan / atau memfitnah, 
    Tidak akurat, kasar, vulgar, penuh kebencian, melecehkan, cabul, kotor, Orientasi seksual, 
    mengancam, menyerang privasi seseorang, atau sebaliknya dari hukum apapun Anda setuju untuk 
    tidak mengirimkan materi yang dilindungi hak cipta kecuali jika 
    hak cipta memang dimiliki oleh Anda.</p>
    
    <p>Kami sebagai pemilik aplikasi ini juga berhak mengungkapkan identitas Anda (atau 
    apapun informasi yang kami ketahui tentang anda) jika terjadi keluhan atau tindakan legal 
    yang timbul dari pesan yang diposkan oleh Anda. Kami mencatat semua alamat protokol internet 
    yang mengakses situs ini.</p>
    
    <p>Harap dicatat bahwa iklan, surat berantai, skema piramida, dan 
    permohonan adalah tidak sesuai dengan aplikasi ini.</p>
    
    <p>Kami berhak menghapus konten apapun dengan alasan atau tanpa alasan apapun.
    Kami berhak menghentikan keanggotaan apapun dengan alasan atau tanpa 
    alasan sama sekali.</p>
    
    <p>Anda harus berusia minimal 13 tahun untuk menggunakan layanan ini.</p>'
];