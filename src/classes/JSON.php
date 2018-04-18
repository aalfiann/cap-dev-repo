<?php
/**
 * This class is a part of reSlim project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes;
use \classes\JSON as JSON;
	/**
     * A class for handle json in reSlim
     *
     * @package    Core reSlim
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2016 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
	class JSON {

		/**
		 * Convert string to valid UTF8 chars 
		 *
		 * @var string is the array string or value
		 *
		 * @return string
		 */
		private static function convertToUTF8($string){
			if (is_array($string)) {
				foreach ($string as $k => $v) {
					$string[$k] = self::convertToUTF8($v);
				}
			} else if (is_string ($string)) {
				return utf8_encode($string);
			}
			return $string;
		}

        /**
		 * Encode Array string or value to json
		 *
		 * @var data is the array string or value
		 * @var pretty is to make ouput json nice, clean and readable. Default is false for perfomance speed reason.
		 *
		 * @return string
		 */
        public static function encode($data,$pretty=false){
			if ($pretty){
				return json_encode($data,JSON_PRETTY_PRINT);
			}
			return json_encode($data);
		}

		/**
		 * Safest way to encode Array string or value to json
		 *
		 * @var data is the array string or value
		 * @var pretty is to make ouput json nice, clean and readable. Default is false for perfomance speed reason.
		 *
		 * @return string
		 */
        public static function safeEncode($data,$pretty=false){
			if ($pretty){
				return json_encode(self::convertToUTF8($data),JSON_PRETTY_PRINT);
			}
			return json_encode(self::convertToUTF8($data));
		}

		/**
		 * Determine is valid json or not
		 *
		 * @var data is the array string or value
		 *
		 * @return bool
		 */
		public static function isValid($data=null) {
			if (!empty($data)) {
				@json_decode($data);
				return (json_last_error() === JSON_ERROR_NONE);
			}
			return false;
		}

		/**
		 * Debugger to test json encode
		 * Note: 
		 * - Actualy this is hard to test json_encode in php way, you have to encode the string to another utf8 chars by yourself.
		 * - This is because if you do in php, json_encode function will auto giving backslash in your string if it contains invalid chars.
		 *
		 * @var string is the array string or value
		 *
		 * @return string json output formatted
		 */
		public static function debug_encode($string,$simple=false){
			json_encode($string,JSON_UNESCAPED_UNICODE);

			switch (json_last_error()) {
				case JSON_ERROR_NONE:
					$msg = 'no errors found';
					if($simple){
						$data = ['status' => 'valid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'valid','message' => $msg];
					}
					break;
				case JSON_ERROR_DEPTH:
					$msg = 'maximum stack depth exceeded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_STATE_MISMATCH:
					$msg = 'underflow or the modes mismatch';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_CTRL_CHAR:
					$msg = 'unexpected control character found';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_SYNTAX:
					$msg = 'syntax error, malformed json';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF8:
					$msg = 'malformed UTF-8 characters, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_RECURSION:
					$msg = 'malformed one or more recursive references, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_INF_OR_NAN:
					$msg = 'malformed NAN or INF, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UNSUPPORTED_TYPE:
					$msg = 'a value of a type that cannot be encoded was given';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_INVALID_PROPERTY_NAME:
					$msg = 'a property name that cannot be encoded was given';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF16:
					$msg = 'malformed UTF-16 characters, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
				default:
					$msg = 'unknown error';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $string,'status' => 'invalid','message' => $msg];
					}
					break;
			}
			return json_encode($data,JSON_PRETTY_PRINT);
		}
		
		/**
		 * Debugger to test json decode
		 *
		 * @var json is the json string
		 *
		 * @return string json output formatted
		 */
		public static function debug_decode($json,$simple=false){
			json_decode($json);

			switch (json_last_error()) {
				case JSON_ERROR_NONE:
					$msg = 'no errors found';
					if($simple){
						$data = ['status' => 'valid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'valid','message' => $msg];
					}
					break;
				case JSON_ERROR_DEPTH:
					$msg = 'maximum stack depth exceeded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_STATE_MISMATCH:
					$msg = 'underflow or the modes mismatch';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_CTRL_CHAR:
					$msg = 'unexpected control character found';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_SYNTAX:
					$msg = 'syntax error, malformed json';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF8:
					$msg = 'malformed UTF-8 characters, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_RECURSION:
					$msg = 'malformed one or more recursive references, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_INF_OR_NAN:
					$msg = 'malformed NAN or INF, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UNSUPPORTED_TYPE:
					$msg = 'a value of a type that cannot be encoded was given';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_INVALID_PROPERTY_NAME:
					$msg = 'a property name that cannot be encoded was given';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF16:
					$msg = 'malformed UTF-16 characters, possibly incorrectly encoded';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
				default:
					$msg = 'unknown error';
					if($simple){
						$data = ['status' => 'invalid','message' => $msg];
					} else {
						$data = ['data'=> $json,'status' => 'invalid','message' => $msg];
					}
					break;
			}
			return json_encode($data,JSON_PRETTY_PRINT);
		}

    }