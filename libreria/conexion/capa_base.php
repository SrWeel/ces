<?php

/**

 * Conexion a Base de datos

 * 

 * Este archivo permite conectar un modulo de base de datos a nuestro sistema

 * Para poder usar a futuro actualizaciones de conexion.

 * @author Ecohevea <franklin.aguas@gogess.com>

 * @version 1.0

 * @package ConexionData

 */

 

abstract class DatabaseProvider  

{ 

    private $resource;  

	public abstract function connectando($host, $user, $pass, $dbname,$tipobase);  

	public abstract function escape($var);

 

}







class AdodbPhp extends DatabaseProvider  

    {  

        public function connectando($host, $user, $pass, $dbname,$tipobase){  

		

            $DB_gogess = NewADOConnection($tipobase);

			

			$DB_gogess->Connect($host,$user,$pass,$dbname);

			
            $DB_gogess->SetCharSet('utf8');
			

			//$DB_gogess->debug=true;

			

			$this->resource=$DB_gogess;

            return  $this->resource;  

			

        }  

		

        public function escape($var){  
          
		   $var=htmlentities($var);
         //return @mysql_real_escape_string($var);  
		  return $var;

        } 

      

       

    }  





class DatabaseLayer  

{  

    //Almacena internamente el proveedor  

    private $provider;  

    //Usado para las callbacks, se explica luego  

    private $params;  

    //Almacena la instancia para el Singleton  

    private static $_con;  

	

    //Constructor privado  

    private function __construct($provider,$host,$user,$pass,$dbname,$tipobase){

		

			if(!class_exists($provider)){  

			throw new Exception("El proveedor especificado no ha sido implentado o añadido.");  

			}  

			$this->provider = new $provider;  

			$this->provider->connectando($host, $user, $pass, $dbname,$tipobase);  

			

			

			  

	}  

    //Funcion del Singleton que devuelve o crea la instancia  

    public static function getConnection($provider,$host,$user,$pass,$dbname,$tipobase){

		

		if(self::$_con){  

        return self::$_con;  

		}  

		else{  

			$class = __CLASS__;  

			self::$_con = new $class($provider,$host,$user,$pass,$dbname,$tipobase);  

			

			return self::$_con;  

		} 

		

		

	}  

	

	 private function prepare($sql, $params){

		 

	  if($params)

	  {

		 for($i=0;$i<sizeof($params); $i++){  

				if(is_bool($params[$i])){  

					$params[$i] = $params[$i]? 1:0;  

				}  

				elseif(is_double($params[$i]))  

					$params[$i] = str_replace(',', '.', $params[$i]);  

				elseif(is_numeric($params[$i]))  

					$params[$i] = $this->provider->escape($params[$i]);  

				elseif(is_null($params[$i]))  

					$params[$i] = "NULL";  

				else  

					$params[$i] = "'".$this->provider->escape($params[$i])."'";  

			

   		 }  

	  }

	  

		$this->params = $params;  

		$q = preg_replace_callback("/(\?)/i", array($this,"replaceParams"), $sql);  

      // echo $q;

    	return $q;  

		 

		 

	}  

	

	 private function replaceParams($coincidencias){

		 	$b=current($this->params);  

    		next($this->params);  

    		return $b; 

		 

		 } 

     

	

	 public function executec($q, $params=null){

		

	

		 

		 $query = $this->prepare($q, $params);  

		

	     return $this->provider->resource->Execute($query);

		

		

	

	 }

	 

	 

	  public function funciones_ADODB_FETCH_NUM(){

		

	    //$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);

	     return $this->provider->resource->SetFetchMode(ADODB_FETCH_NUM);

		

		

	

	 }

	 

	  public function funciones_ADODB_FETCH_ASSOC(){

		

	    //$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);

	     return $this->provider->resource->SetFetchMode(ADODB_FETCH_ASSOC);

		

		

	

	 }

	 

	  public function funciones_nuevoID($id_generado){

		$id_devuelve=0;
		$id_insertado=0;

	    //$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);
	   $id_insertado=$this->provider->resource->Insert_ID();
		
       if($id_insertado)
	   {
	   
	      $id_devuelve=$id_insertado;
	   }
	   else
	   {
	     $id_devuelve=$id_generado;
	   
	   }
   
	     return $id_devuelve;

		

		

	

	 }

	 

	

} 

?>