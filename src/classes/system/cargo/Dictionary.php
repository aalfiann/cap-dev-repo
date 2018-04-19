<?php
/**
 * This class is a part of Cargo project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\system\cargo;
    /**
     * A class for transaction management cargo
     *
     * @package    Dictionary Cargo
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/cap-dev-repo/blob/master/license.md  MIT License
     */
	class Dictionary {
        /**
         * @param $id is indonesian dictionary
         *
         */
        public static $id = [
            //Transaction process
            'waybill_created' => 'Menunggu proses pengiriman',
            'waybill_manifested' => 'Sedang dalam proses pengiriman',
            'waybill_onboard' => 'Sedang dalam perjalanan menuju destinasi',
            'waybill_arrived' => 'Barang telah sampai di destinasi',
            'waybill_delivered' => 'Barang telah diterima oleh:',
            'waybill_picked' => 'Barang akan diambil sendiri oleh penerima',
            'waybill_pickup' => 'Proses penjemputan barang oleh origin',
            //Transaction onhold
            'waybill_onhold_origin' => 'Barang sementara ditahan di origin',
            'waybill_onhold_destination' => 'Barang sementara ditahan di destinasi',
            //Transaction failed
            'waybill_void' => 'Transaksi pengiriman telah dibatalkan',
            'waybill_dex' => 'Pengantaran barang gagal karena',
            'waybill_return' => 'Sedang dalam proses retur ke origin',
            'waybill_return_consignor' => 'Barang di retur sesuai permintaan pengirim',
            'waybill_return_consignee' => 'Barang di retur sesuai permintaan penerima'
        ];

        /**
         * @param $en is english dictionary
         *
         */
        public static $en = [
            //Transaction process
            'waybill_created' => 'Waiting for shipping process',
            'waybill_manifested' => 'In the delivery process',
            'waybill_onboard' => 'On the way to the destination',
            'waybill_arrived' => 'Goods have arrived at the destination',
            'waybill_delivered' => 'Goods have been received by:',
            'waybill_picked' => 'Goods will be picked up by the recipient',
            'waybill_pickup' => 'Pickup process by origin',
            //Transaction onhold
            'waybill_onhold_origin' => 'Goods temporarily held in origin',
            'waybill_onhold_destination' => 'Goods temporarily held in destination',
            //Transaction failed
            'waybill_void' => 'The shipping transaction has been void',
            'waybill_dex' => 'Delivery of goods failed because',
            'waybill_return' => 'In the process of returning to origin',
            'waybill_return_consignor' => 'Goods are returned at the sender\'s request',
            'waybill_return_consignee' => 'Goods are returned at the recipient\'s request'
        ];

        /**
         * @param $key : input the key of dictionary
         * @return string dictionary language
         */
        public static function write($key,$lang='id'){
            switch($lang){
                case 'id':
                    return self::$id[$key];
                break;
                case 'en':
                    return self::$en[$key];
                break;
                default:
                    return self::$id[$key];
            }
        }
    }