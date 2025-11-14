<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set('memory_limit',-1);

if (@$_POST["Excel"]=='on' or @$_POST["Excel"]==1)
{
 $fechahoy=date("Y-m-d");
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
 $banderaimp=1;
}

/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='mp')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}


if(@$mp)
{   
   @$decodevalor = base64_decode($mp);
}

$splitvar=explode("&",@$decodevalor);

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
 // echo $splitvar[$ivari]."<br>";
  $sacadatav=explode("=",$splitvar[$ivari]);
  
  //if (preg_match('/^[a-z\d_=]{1,10}$/i',$sacadatav[1])) {
  
  @$$sacadatav[0]=$sacadatav[1];
  
  //}

}
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['ces1313777_sessid_inicio']))
{
	if (!(@$_POST["Excel"]=='on'))
     {
?>	
<link type="text/css" href="../../css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ui.mask.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../js/jquery.printPage.js"></script>
<script type="text/javascript" src="../../js/jquery.formatCurrency.js"></script>
<script type="text/javascript" src="../../js/jquery.fixheadertable.js"></script>
<script src="../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../../js/jquery.idletimer.js"></script>
<?php
	 }
?>	
<style type="text/css">
<!--
/*listas*/
.cmbforms {
	font-family: Arial, Helvetica;
	color: #000000;
	text-decoration: none;
	font-weight: normal;
	font-size: 11px;
}
.OKcampo{
	font-family: Arial, Helvetica;
	color: #000000;
	text-decoration: none;
	font-weight: normal;
	font-size: 11px;
}
.csstitulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
.linklista{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
}
.csslista{
font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;

	text-decoration: none;

}

.css_obj{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.css_objtxt{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}

-->
</style>
<?php
if($_GET["ireport"])
{
$ireport=$_GET["ireport"];
}
$concatenacampos='';
$gruposvla='';
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");


$list_data="select * from sth_vddetalle where vardevdet_tabla!='' and vardev_id=".$ireport;
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
					
switch ($data_base) {
    case 1:
		{
		   
			 $separa_conection=explode(",",$string_conection);
			 $link_mysqlserver = NewADOConnection('mysqli');
             $link_mysqlserver->Connect($separa_conection[0],$separa_conection[1],$separa_conection[2],$separa_conection[3]);
			 include("verreporte_mysql.php");
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
			include("verreporte_sqlserver.php");
		}
        break;

    default:
       {
		   include("verreporte_mysql.php");
	   }
}


	
}
else
{
 echo "sesion ended, type F5 to continue";
	
}
?>