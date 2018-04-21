<?php 
/**
 * This class is a part of middleware reSlim project to make validation for required parameter in rest api
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\middleware;
use \classes\CustomHandlers as CustomHandlers;
use \classes\Cors as Cors;
use PDO;
    /**
     * A class for validate the required parameter
     *
     * @package    Core reSlim
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
    class RequiredParam
    {
        private $parameter,$strict,$regex,$message;

        /**
         * Constructor
         * 
         * @var parameter is the body of the request parameter
         * @var strict if is set to true, then parameter is can not be empty. Default is false.
         * @var regex is to validate the value of the parameter. This will working if you set strict to true.
         */
        public function __construct($parameter,$strict=false,$regex=''){
            $this->parameter = $parameter;
            $this->strict = $strict;
            $this->regex = $regex;
        }

        public function __invoke($request, $response, $next){
            if($this->validate($request,$this->parameter,$this->strict,$this->regex)){
                $response = $next($request, $response);    
                return $response;
            } else {
                $body = $response->getBody();
                if (empty($this->message)){
                    $body->write(json_encode([
                        'status' => 'error',
                        'code' => 'RS801',
                        'message' => CustomHandlers::getreSlimMessage('RS801')
                    ]));
                } else {
                    $body->write(json_encode([
                        'status' => 'error',
                        'code' => 'RS801',
                        'message' => CustomHandlers::getreSlimMessage('RS801'),
                        'parameter' => $this->message
                    ]));
                }
                
                return Cors::modify($response,$body,400);
            }
        }

        private function validateRegex($regex,$key,$value){
            if(!preg_match($regex, $value)){
                $this->message[$key] = 'the value is not valid!';
                return false;
            }
            return true;
        }

        private function validate($request,$parameter,$strict=false,$regex=''){
            $parsedBody = $request->getParsedBody();
            if ($strict == 'strict') $strict = true;
            if (empty($parsedBody)) return true;
            if (is_array($parameter)){
                $aa = 0;
                foreach ($parameter as $singleparam){
                    $tt = 0;
                    foreach ($parsedBody as $key => $value) {
                        if ($key==$singleparam){
                            if($strict){
                                if (!empty($value)){
                                    if (!empty($regex)){
                                        if($this->validateRegex($regex,$key,$value)){
                                            $tt += 1;    
                                        }
                                    } else {
                                        $tt += 1;
                                    }
                                } else {
                                    $this->message[$key] = 'the value is can not be empty!';
                                }
                            } else {
                                $tt += 1;
                            }
                        }
                    }
                    if($tt == 0) $aa += 1;
                }
                if($aa > 0) return false;
            } else {
                $tt=0;
                foreach ($parsedBody as $key => $value) {
                    if ($key==$parameter){
                        if($strict){
                            if (!empty($value)){
                                if (!empty($regex)){
                                    if($this->validateRegex($regex,$key,$value)){
                                        $tt += 1;    
                                    }
                                } else {
                                    $tt += 1;
                                }
                            } else {
                                $this->message[$key] = 'the value is can not be empty!';
                            }
                        } else {
                            $tt += 1;
                        }
                    }
                }
                if($tt == 0) return false;
            }
            return true;
        }
    }