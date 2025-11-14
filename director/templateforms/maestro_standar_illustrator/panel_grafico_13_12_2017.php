<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../";
include("../../cfgclases/clases.php");
include("lib_graph.php");

$list_data="select * from sth_vddetalle where vardevdet_tabla!='' and vardevdet_id='".$_POST["pVar1"]."'";
$resultlistat = $DB_gogess->Execute($list_data);
$table_data=$resultlistat->fields["vardevdet_tabla"];

$es_numero=is_numeric($table_data);
if($es_numero)
{

$data_base=$objformulario->replace_cmb("gogess_virtualtable","virtual_id,datab_id"," where virtual_id=",$table_data,$DB_gogess);
$string_conection=$objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_stringconection"," where virtual_id=",$table_data,$DB_gogess);	

}
else
{

$data_base=$objformulario->replace_cmb("gogess_sistable","tab_name,datab_id"," where tab_name like ",$table_data,$DB_gogess);
$string_conection=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_stringconection"," where tab_name like ",$table_data,$DB_gogess);
	
}


//----------------------------------------------

//$data_base=$objformulario->replace_cmb("gogess_sistable","tab_name,datab_id"," where tab_name like ",$table_data,$DB_gogess);
//$string_conection=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_stringconection"," where tab_name like ",$table_data,$DB_gogess);
					
switch ($data_base) {
    case 1:
		{
		    echo "data";
			include("grafico_mysql.php");
		}
        break;
    case 2:
        {
			$separa_conection=explode(",",$string_conection);
			//print_r($separa_conection);
			## conexion a sql server...
			$link_sqlserver=mssql_connect($separa_conection[0],$separa_conection[1],$separa_conection[2]);
			## seleccionamos la base de datos
			mssql_select_db($separa_conection[3],$link_sqlserver);
			## generamos el query
			
			include("grafico_sqlserver.php");
		}
        break;

    default:
       {
		   include("grafico_mysql.php");
	   }
}



//---------------------------------------------

}
else
{
 echo "sesion ended, type F5 to continue";
	
}
?>