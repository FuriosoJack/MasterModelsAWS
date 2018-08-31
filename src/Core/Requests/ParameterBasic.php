<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;

/**
 * Clase de estructura basica de los parametros de una solicitud
 * contiene los metodos necesarios para asegurar que la conexion se realizar 
 * conrreactamente
 *
 * @package FuriosoJack\MasterModelsAWS\Core\Client\Requests
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
class ParameterBasic {
   
    /**
     * Parametros con valor añadidos hasta el momento para ejecutar la solicitud
     * @var array 
     */
    protected $parameters;
    
    /**
     * Parametros que son obligatorios para poder ejecutar la solicitud.
     * Cuando se habla de requerido es que puede que para el cliente de AWS no sea requerido
     * pero para el funcionamiento interno de la solucition que se desarrolle SI
     * @var array
     */
    protected $parametersRequired;
    
    /**
     * Parametros faltantes para que se pueda ejecutar la solicitud
     * @var array
     */
    protected $parametersMissing;
    
    
    /**
     * Parametros que pueden o no ir en la solicitud
     * @var array
     */
    protected $parametersOptional;
    
    
    public function __construct()
    {
        //Se inicializan los parametros
        $this->parameters = [];
        $this->parametersRequired = [];
        $this->parametersOptional = [];       
        
        
        //Se establecen los parametros requeridos
        $this->initParametersRequired();
        
        //Se inicia los parametros faltantes con todos los requeridos
        //Se combina los paramtros requeridos con los obcionales
        $this->parametersMissing = array_merge($this->parametersOptional,$this->parametersRequired);
    }
    
    /**
     * Establece los parametros requeridos para ejecutar la solicitud
     * Este es el metodo que los hijos deben sobrescribir para obtener los parametros.
     * Por defecto no establece nada.
     * 
     */
    protected function initParametersRequired()
    {
                      
    }
    
    /**
     * Verifica si el parametro es requerido para hacer la solicitud
     * @param string $paramName key del parametro
     * @return bool
     */
    private function checkParametrerIsRequired(string $paramName)
    {
        //Se valida si el key del parametro indicado esta en el array de los parmetros requeridos
        return in_array($paramName, $this->parametersRequired);
    }
    
    /**
     * Verifica si el parametro hace falta
     * @param string $paramName key del parametro
     * @return bool
     */
    private function checkParameterIsMissing(string $paramName)
    {   
        //si el parametros esta en el array de parametros faltantes
        return in_array($paramName, $this->parametersMissing);
    }
    
    /**
     * Veifica si el parametro es obcional para hacer la solicitud
     * @param string $paramName key del parametro
     * @return bool
     */
    private function checkParameterIsOptional(string $paramName)
    {
        return in_array($paramName, $this->parametersOptional);        
    }
    
    /**
     * Remueve un parametro del array de parametros opcionale
     * @param int $key indice del parametro
     */
    private function removeParameterOptional(int $key)
    {
        unset($this->parametersObtional[$key]);
    }
    
    /**
     * Remueve un parametro del array de parametros faltantes
     * @param int $key indice del parametro
     */
    private function removeParameterMissing(int $key)
    {
         unset($this->parametersMissing[$key]);
    }
    
    /**
     * Añade el valor al parametro indicado de la solicitud
     * @throws Exception
     * @param string $paramerName nombreo key del parametro 
     * @param string|integer|float|double|array $value valor del parametro
     */
    public function addValueForParameter(string $paramerName, $value)
    {
        //Si el parametro no es requerido y no es un parametro opcional
        if(!$this->checkParametrerIsRequired($paramerName) && !$this->checkParameterIsOptional($paramerName) ){
          //Se lanza exceppcion
          throw new \Exception("Parametro[".$paramerName."] Incorrecto!!");
        }   
        
        //Si no esta en los parametros que hacen falta, quiere decir que ya esta ingresado
        if(!$this->checkParameterIsMissing($paramerName)){
            throw new \Exception("Parametro[".$paramerName."] Ya ingresado!!");
        }
        
        //Se remueve parametro de los parametros faltantes
        $this->removeParameterMissing(array_search($paramerName, $this->parametersMissing));
        
        
        //Se inserta el parametros al array de parametros con valor
        $this->parameters[$paramerName] = $value;
        
    }
    /**
     * Llena los valores de los parametros pasando un array de clave valor 
     * @param array $parameters parametros con su valor
     */
    public function addAllValuesForParameters(array $parameters)
    {
        //Recorrido del los parametros indicados
        foreach ($parameters as $key => $value) {
            //Se añade el valor del parametros
            $this->addValueForParameter($key, $value);
        }        
    }
    
    /**
     * Verifica si existen parametros por ingresar
     * @return bool
     */
    private  function existParametersMissing()
    {
        //Si el conteo de parametros mayor a cero
       return count($this->parametersMissing) > 0;
    }
    
    /**
     * Devuelve en definitiva todos los parametros con sus valores
     * @return array
     * @throws Exception
     */
    public function getParametersFinally(): array
    {
        //Si hacen falta parametros por ingresar
        if($this->existParametersMissing()){
            throw new \Exception("Hacen falta parametros por ingresar.");
        }
        
        return $this->parameters;
    }
    
}
