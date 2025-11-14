<?php
require('json-rpc.php');
require("../adodb/adodb.inc.php");
require('../cfgclases/config.php');
if (function_exists('xdebug_disable')) {
    xdebug_disable();
}

class MysqlDemo {
  public function comandos($comandos) {
    global $DB_gogess;
	$ntabla='';
	$ncampoprimario='';
	$tncampoprimario='';
	$tncampoprimario='';
	$titulo='';
	$grid='';
	$orden='';
	$comando_ejecuta=explode(" ",$comandos);
	if($comando_ejecuta[0]=="formulario")
	{
	
	   for ($it=0;$it<count($comando_ejecuta);$it++)
	   {
	       $quita_c=str_replace(")","",$comando_ejecuta[$it]);
	       $busca_comandos=explode("(",$quita_c);
		   //nombre tabla
		   if(trim($busca_comandos[0])=="-t")
		   {
		      $ntabla=$busca_comandos[1];
		   }
		   //primary key
		   if(trim($busca_comandos[0])=="-pky")
		   {
		      $ncampoprimario=$busca_comandos[1];
		   }
		   //tipo primary key
		   if(trim($busca_comandos[0])=="-tpky")
		   {
		      $tncampoprimario=$busca_comandos[1];
		   }
		   //titulo tabla
		   if(trim($busca_comandos[0])=="-titulo")
		   {
		      $titulo=$busca_comandos[1];
		   }
		   //grid tabla
		   if(trim($busca_comandos[0])=="-grid")
		   {
		      $grid=$busca_comandos[1];
		   }
		   
		   //orden tabla
		   if(trim($busca_comandos[0])=="-orden")
		   {
		      $orden=$busca_comandos[1];
		   }
		   
		   
	   }
	

	
   $sql_lista="INSERT INTO `gogess_sistable` (`tab_name`, `tab_campoprimario`, `tab_tipocampoprimariio`, `tab_title`, `tab_information`, `tab_actv`, `tab_mdobuscar`, `st_id`, `tab_bextras`, `tab_valextguardar`, `tab_rel`, `tab_crel`, `tab_trel`, `tab_datosf`, `tab_archivo`, `tab_formatotabla`, `ayu_id`, `tab_nlista`, `tab_tablaregreso`, `instan_id`, `tab_tipoimp`, `tab_sqlimp`, `tab_archivoimp`, `tab_camposgrid`, `tab_scriptorden`, `tab_campogeneracion`, `tab_campoorden`, `tab_compilar`)  VALUES('".$ntabla."', '".$ncampoprimario."', '".$tncampoprimario."', '".$titulo."', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', '".$grid."', '".$orden."', '', '', 0);";
    $res = $DB_gogess->Execute($sql_lista);
	   if(!($res))
	   {
	     $comandos="Tabla ya existe en el sistema...";
	   }
	   else
	   {
	     $comandos="Exito...";
	   }
	
	}
	
	$result[]=$comandos;
	$result2[]=$result;
	
	return $result2;
	
	
  }
}
//echo "s";
handle_json_rpc(new MysqlDemo());

?>