<?php

/*
 * The MIT License
 *
 * Copyright 2018 Juan Diaz - FuriosoJack <iam@furiosojack.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * @license https://raw.githubusercontent.com/FuriosoJack/MasterModelsAWS/master/LICENSE
 */

namespace FuriosoJack\MasterModelsAWS\Core\Requests;
use Aws\Result;
/**
 * Trait para el manejo del response aws
 *
 * @package FuriosoJack\MasterModelsAWS\Core\Requests 
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 
 * @access 
 */
trait TraitResponseManager {
    
    
    /**
     * Response de la solicitud AWS
     * @var \Aws\Result 
     */
    protected $response;
    
  
    
    /**
     *  Retorna el resultado de la solicitud
     * **Cuando se retorna un response en `null` es por que existen errores por erro se debe primero verificar que no existan errores**
     *
        * Ejemplo De reponse:
        * 
        * ```
        *    object(Aws\Result)#102 (1) {
        *        ["data":"Aws\Result":private]=>
        *        array(2) {
        *          ["Vpcs"]=>
        *          array(1) {
        *            [0]=>
        *            array(8) {
        *              ["CidrBlock"]=>
        *              string(13) "172.31.0.0/16"
        *              ["DhcpOptionsId"]=>
        *              string(13) "dopt-a86sds9c8ghce"
        *              ["State"]=>
        *              string(9) "available"
        *              ["VpcId"]=>
        *              string(12) "vpc-b3f0efdssdbc12a"
        *              ["InstanceTenancy"]=>
        *              string(7) "default"
        *              ["CidrBlockAssociationSet"]=>
        *              array(1) {
        *                [0]=>
        *                array(3) {
        *                  ["AssociationId"]=>
        *                  string(23) "vpc-cidr-assoc-0bcasdggff0d60"
        *                  ["CidrBlock"]=>
        *                  string(13) "172.31.0.0/16"
        *                  ["CidrBlockState"]=>
        *                  array(1) {
        *                    ["State"]=>
        *                    string(10) "associated"
        *                  }
        *                }
        *              }
        *              ["IsDefault"]=>
        *              bool(true)
        *              ["Tags"]=>
        *              array(1) {
        *                [0]=>
        *                array(2) {
        *                  ["Key"]=>
        *                  string(4) "Name"
        *                  ["Value"]=>
        *                  string(7) "default"
        *                }
        *              }
        *            }
        *          }
        *          ["@metadata"]=>
        *          array(4) {
        *            ["statusCode"]=>
        *            int(200)
        *            ["effectiveUri"]=>
        *            string(35) "https://ec2.us-east-1.amazonaws.com"
        *            ["headers"]=>
        *            array(5) {
        *              ["content-type"]=>
        *              string(22) "text/xml;charset=UTF-8"
        *              ["transfer-encoding"]=>
        *              string(7) "chunked"
        *              ["vary"]=>
        *              string(15) "Accept-Encoding"
        *              ["date"]=>
        *              string(29) "Fri, 31 Aug 2018 15:51:57 GMT"
        *              ["server"]=>
        *              string(9) "AmazonEC2"
        *            }
        *            ["transferStats"]=>
        *            array(1) {
        *              ["http"]=>
        *              array(1) {
        *                [0]=>
        *                array(0) {
        *                }
        *              }
        *            }
        *          }
        *        }
        *      } 
        *```         
        * @see Markdown
     * @link https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.Result.html
     * @return \Aws\Result|null $response resultado de la solicitud
     */
    public function getResonse():Result
    {
        return $this->response;
    }
    
    /**
     * Se encarga de insertar la respuesta de la peticion
     * @param \Aws\Result $response
     */
    private function setResponse(Result $response = null)
    {
        $this->response = $response;        
    }
    
}
