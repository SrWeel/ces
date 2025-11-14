<?php
/*
################################################################
#	Coneccion a la base de datos
#
################################################################
*/
//Objeto conexión, Conecta a la base de datos Mysql
class conecc{
    //Atributos Basicos de la clase
    var $servidor; //host
    var $nombredb; //Nombre de la Base de Datos
    var $nombreu; //Nombre del usuario autorizado para entrar a la Base de Datos 

    //Atributos Modificados
    var $enlace;//Almacena el enlace con la Base de Datos una vez establecido
    var $resultado;//Almacena el resultado obtenido por la consulta a la BD
    var $consulta;//Almacena la consulta realizada con el metodo consultaBD();
	
	//Usuarios
	var $usuario;
	var $clave;
	var $privilegios;
    var $descuentoo;
//constructos
Function constructor($servidor,$nombredb,$nombreu)
{
 $this->servidor=$servidor;
 $this->nombredb=$nombredb;
 $this->nombreu=$nombreu; 
}
//Funcion de conección	
function conectardb($basededatos,$host,$userdb,$passwdb)
{
    if($this->enlace=mysql_connect($host,$userdb,$passwdb))
    //if($this->enlace=mysql_connect("localhost","sistema_unlugar_com","sistemadb"))
	{
      if(mysql_select_db($basededatos,$this->enlace))
	    {
            
        }
	  else
	   {
           echo "Error al seleccionar la base de datos!";
           exit();
       }
    }
	else
	{
       echo "Error al enlazar al Servidor!";
       exit();
    }
}


}



?>