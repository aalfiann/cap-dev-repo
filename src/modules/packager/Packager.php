<?php

namespace modules\packager;                         //Make sure namespace is same structure with parent directory

use \classes\Auth as Auth;                          //For authentication internal user
use \classes\JSON as JSON;                          //For handling JSON in better way
use \classes\CustomHandlers as CustomHandlers;      //To get default response message
use PDO;                                            //To connect with database

	/**
     * Packager Modules class
     *
     * @package    modules/packager
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim-modules-packager/blob/master/LICENSE.md  MIT License
     */
    class Packager {

        //database var
        protected $db;

        //base var
        protected $basepath,$baseurl,$basemod;

        //master var
        var $username,$token;

        //for multi language
        var $lang;
        
        //construct database object
        function __construct($db=null) {
            if (!empty($db)) $this->db = $db;
            $this->baseurl = (($this->isHttps())?'https://':'http://').$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
            $this->basepath = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
            $this->basemod = dirname(__FILE__);
        }

        //Detect scheme host
        function isHttps() {
            $whitelist = array(
                '127.0.0.1',
                '::1'
            );
            
            if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                if (!empty($_SERVER['HTTP_CF_VISITOR'])){
                    return isset($_SERVER['HTTPS']) ||
                    ($visitor = json_decode($_SERVER['HTTP_CF_VISITOR'])) &&
                    $visitor->scheme == 'https';
                } else {
                    return isset($_SERVER['HTTPS']);
                }
            } else {
                return 0;
            }            
        }

        //Get modules information
        public function viewInfo(){
            return file_get_contents($this->basemod.'/package.json');
        }

        //PACKAGER================

        private function dirname_r($path, $count=1){
            if ($count > 1){
               return dirname($this->dirname_r($path, --$count));
            }
            return dirname($path);
        }

        private function isMatchLast($match,$string){
            if (substr($string, (-1 * abs(strlen($match)))) == $match) return true;
            return false;
        }

        private function fileSearch($dir, $ext='php',$extIsRegex=false) {
            $files = [];
            $fh = opendir($dir);
    
            while (($file = readdir($fh)) !== false) {
                if($file == '.' || $file == '..')
                    continue;
    
                $filepath = $dir . DIRECTORY_SEPARATOR . $file;
    
                if (is_dir($filepath))
                    $files = array_merge($files, $this->fileSearch($filepath, $ext));
                else {
                    if($extIsRegex){
                        if(preg_match($ext, $file)) array_push($files, $filepath);
                    } else {
                        if($this->isMatchLast($ext,$file)) array_push($files, $filepath);
                    }
                }
            }
            closedir($fh);
            return $files;
        }

        private function formatSize($bytes) {
            $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' );
            $base = 1024;
            $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
            return sprintf('%1.2f' ,$bytes / pow($base,$class)).' '.$si_prefix[$class];
        }

        private function GetDirectorySize($path){
            $bytestotal = 0;
            $path = realpath($path);
            if($path!==false && $path!='' && file_exists($path)){
                foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $object){
                    $bytestotal += $object->getSize();
                }
            }
            return $bytestotal;
        }

        private function rrmdir($dir) {
            if (is_dir($dir)) {
              $files = scandir($dir);
              foreach ($files as $file)
              if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
              rmdir($dir);
            }
            else if (file_exists($dir)) unlink($dir);
        } 

        private function rcopy($src, $dst) {
            if (file_exists($dst)) $this->rrmdir($dst);
            if (is_dir($src)) {
              mkdir($dst);
              $files = scandir($src);
              foreach ($files as $file)
              if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file"); 
            }
            else if (file_exists($src)) copy($src, $dst);
        }

        private function isDependencyExists($dependency,$folders){
            $c = 0;  
            if (is_array($dependency)){
                if (in_array("", $dependency, true)) return true;
                $dp = count($dependency);
                for ($i=0;$i<$dp;$i++){
                    foreach($folders as $folder){
                        if ($folder == str_replace('modules/','',$dependency[$i])){
                            $c++;  
                        }
                    }
                }
            } else {
                if (empty($dependency)) return true;
                $dp = 1;
                foreach($folders as $folder){
                    if ($folder == str_replace('modules/','',$dependency)){
                        $c++;
                    }
                }
            }
            if ($c == $dp) return true;
            return false;
        }

        // Show all package installed
        public function showAll(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $role = Auth::getRoleID($this->db,$this->token);
                if ($role == 1) {
                    // Scan all packages
                    $packs = $this->fileSearch('../modules/','package.json');
                    $listmodules = str_replace(['../modules/','/package.json'],'',$packs);
                    foreach ($packs as $pack) {
                        $mods = json_decode(file_get_contents($pack));
                        $size = $this->GetDirectorySize(str_replace(DIRECTORY_SEPARATOR.'package.json','',realpath($pack)));
                        $compatible = (version_compare(RESLIM_VERSION, $mods->package->require->reSlim, ">=")?true:false);
                        $dependency = (isset($mods->package->dependency)?$this->isDependencyExists($mods->package->dependency,$listmodules):true);
                        $readme = str_replace(DIRECTORY_SEPARATOR.'package.json','',realpath($pack)).'/README.md';
                        $readmeurl = (($this->isHttps())?'https://':'http://').$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['PHP_SELF'])).'/'.basename($this->dirname_r(__FILE__,2)).'/'.basename(dirname($pack)).'/README.md';
                        $folder[] = [
                            'date' => date('Y-m-d H:m:s',filectime($pack)),
                            'namespace' => basename($this->dirname_r(__FILE__,2)).'/'.basename(dirname($pack)),
                            'package' => $mods->package,
                            'path' => [
                                'folder' => str_replace(DIRECTORY_SEPARATOR.'package.json','',realpath($pack)),
                                'json' => realpath($pack)
                            ],
                            'size' => $this->formatSize($size),
                            'bytes' => $size,
                            'app' => 'reSlim v.'.RESLIM_VERSION,
                            'compatible' => [
                                'status' => (($compatible)?'ok':'failed'),
                                'message' => (($compatible)?'Package '.$mods->package->name.' '.Dictionary::write('is_compatible',$this->lang).' '.RESLIM_VERSION:'Package '.$mods->package->name.' '.Dictionary::write('is_not_compatible',$this->lang).' '.RESLIM_VERSION),
                            ],
                            'dependency' => [
                                'status' => (($dependency)?'ok':'failed'),
                                'list' => (isset($mods->package->dependency)?$mods->package->dependency:''),
                                'message' => (($dependency)?'Package '.$mods->package->name.' '.Dictionary::write('dependency_ok',$this->lang):Dictionary::write('dependency_fail',$this->lang)),
                            ],
                            'readme' => [
                                'url' => ((file_exists($readme))?$readmeurl:''),
                                'path' => ((file_exists($readme))?$readme:''),
                                'content' => ((file_exists($readme))?file_get_contents($readme):''),
                                'tips' => Dictionary::write('tips_readme',$this->lang)
                            ]
                        ];
                    }
                    sort($folder);
                    if (!empty($packs)){
                        $data = [
                            'results' => $folder,
                            'status' => 'success',
                            'code' => 'PC103',
                            'message' => Dictionary::write('PC103',$this->lang)
                        ];
                    } else {
                        $data = [
                            'status' => 'error',
                            'code' => 'PC203',
                            'message' => Dictionary::write('PC203',$this->lang)
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
            return JSON::safeEncode($data,true);
	        $this->db= null;
        }

        public function installFromZip($source,$namespaces=""){
            $namespaces = str_replace('modules/','',$namespaces);
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $role = Auth::getRoleID($this->db,$this->token);
                if ($role == 1) {
                    if (empty($namespaces)) $namespaces = uniqid();
                    //Download Zip
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $source);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $data = curl_exec ($ch);
                    curl_close ($ch);

                    //Save Zip
                    $destination = $namespaces.".zip"; // NEW FILE LOCATION
                    $file = fopen($destination, "w+");
                    fputs($file, $data);
                    fclose($file);

                    //Extract Zip
                    $zip = new \ZipArchive;
                    $res = $zip->open($destination);
                    if ($res === TRUE) {
                        $zip->extractTo(dirname($this->basemod,1).'/');
                        $zip->close();
                        unlink($destination);
                        $data = [
                            'status' => 'success',
                            'code' => 'PC101',
                            'message' => Dictionary::write('PC101',$this->lang)
                        ];
                    } else {
                        $data = [
                            'status' => 'error',
                            'code' => 'PC201',
                            'message' => Dictionary::write('PC201',$this->lang),
                            'path' => dirname($this->basemod,1),
                            'base' => $this->basemod
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

        public function installFromZipSafely($source,$namespaces=""){
            $namespaces = str_replace('modules/','',$namespaces);
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $role = Auth::getRoleID($this->db,$this->token);
                if ($role == 1) {
                    if (empty($namespaces)) $namespaces = uniqid();
                    //Download Zip
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $source);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $data = curl_exec ($ch);
                    curl_close ($ch);

                    //Save Zip
                    $destination = $namespaces.".zip"; // NEW FILE LOCATION
                    $file = fopen($destination, "w+");
                    fputs($file, $data);
                    fclose($file);

                    //Extract Zip
                    $zip = new \ZipArchive;
                    $res = $zip->open($destination);
                    if ($res === TRUE) {
                        $folderpath = dirname($this->basemod,1).'/tmp';
                        $zip->extractTo($folderpath);
                        $directories = scandir($folderpath);
                        if (count($directories) ==3){
                            foreach($directories as $directory){
                                if($directory !='.' and $directory != '..'){
                                    if(is_dir($folderpath.'/'.$directory)){
                                        $this->rcopy($folderpath.'/'.$directory,dirname($this->basemod,1).'/'.$namespaces);
                                    }
                                }
                            }
                            $data = [
                                'status' => 'success',
                                'code' => 'PC101',
                                'path' => dirname($this->basemod,1).'/'.$namespaces,
                                'message' => Dictionary::write('PC101',$this->lang)
                            ];
                        } else {
                            $data = [
                                'status' => 'error',
                                'code' => 'PC104',
                                'message' => Dictionary::write('PC204',$this->lang)
                            ];
                        }
                        $zip->close();
                        unlink($destination);
                        $this->rrmdir($folderpath);
                    } else {
                        $data = [
                            'status' => 'error',
                            'code' => 'PC201',
                            'message' => Dictionary::write('PC201',$this->lang),
                            'path' => dirname($this->basemod,1),
                            'base' => $this->basemod
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

        public function uninstallPackage($namespaces){
            $namespaces = str_replace('modules/','',$namespaces);
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $role = Auth::getRoleID($this->db,$this->token);
                if ($role == 1) {
                    $this->rrmdir(dirname($this->basemod,1).'/'.$namespaces);
                    $data = [
                        'status' => 'success',
                        'code' => 'PC102',
                        'message' => Dictionary::write('PC102',$this->lang),
                        'namespace' => 'modules/'.$namespaces
                    ];
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 'RS404',
                        'message' => CustomHandlers::getreSlimMessage('RS404',$this->lang),
                        'namespace' => 'modules/'.$namespaces
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