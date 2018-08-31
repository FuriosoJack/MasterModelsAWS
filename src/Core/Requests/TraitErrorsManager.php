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

/**
 * Trait para le manejo de los errores que puede tener la solicitud 
 *
 *
 * @package FuriosoJack\MasterModelsAWS\Core\Requests 
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 
 * @access 
 */
trait TraitErrorsManager {
    
    /**
     * Errores del la solicitud, que puden se generados por fallos en la solicitud
     * como Fllas en la conexion con el servidor, o fallos directamente que devuelva el response
     * @var string 
     */
   protected $errors = null;
   
   /**
    * Devuelve los errores
    * @return string
    */
   public function getErrors(): string
   {
       return $this->errors;
   }
   
   /**
    * Asigna los errores
    * @param string $errors
    */
   protected function setErros(string $errors)
   {
       $this->errors = $errors;
   }

   /**
    * Se encarga de validar si existen errores en la solicitud
    * @return bool
    */
   public function thereAreErrors()
   {
       //Si no es nulo existen errores de lo contrario no existen
     return !is_null($this->errors);
   }
}
