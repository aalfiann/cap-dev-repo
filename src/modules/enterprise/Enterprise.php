<?php

namespace modules\enterprise;                       //Make sure namespace is same structure with parent directory

use \classes\Auth as Auth;                          //For authentication internal user
use \classes\JSON as JSON;                          //For handling JSON in better way
use \classes\CustomHandlers as CustomHandlers;      //To get default response message
use PDO;                                            //To connect with database

	/**
     * Enterprise management system
     *
     * @package    modules/enterprise
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
    class Enterprise {
        // modules information var
        protected $information = [
            'package' => [
                'name' => 'Enterprise',
                'uri' => 'https://github.com/aalfiann/reSlim-modules/tree/master/enterprise',
                'description' => 'Enterprise management system',
                'version' => '1.0',
                'require' => [
                    'reSlim' => '1.9.0'
                ],
                'license' => [
                    'type' => 'MIT',
                    'uri' => 'https://github.com/aalfiann/reSlim-modules/tree/master/enterprise/LICENSE.md'
                ],
                'author' => [
                    'name' => 'M ABD AZIZ ALFIAN',
                    'uri' => 'https://github.com/aalfiann'
                ],
            ]
        ];

        // database var
        protected $db;

        //master var
		var $username,$token;
        
        //construct database object
        function __construct($db=null) {
			if (!empty($db)) {
    	        $this->db = $db;
        	}
        }

        //Get modules information
        public function viewInfo(){
            return JSON::encode($this->information,true);
        }

    }