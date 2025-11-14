<?php
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
$ic=0;
$lista_clientes="select inven_descripcion,inven_codigo,inven_valorunit from dns_inventariopr";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["inven_descripcion"];
	 $companies[$ic]["value"]=$rs_clientes->fields["inven_descripcion"];
	 $companies[$ic]["descripcion"]=$rs_clientes->fields["inven_descripcion"];
	 $companies[$ic]["codigo"]=utf8_encode($rs_clientes->fields["inven_codigo"]);
	 $companies[$ic]["valorunitario"]=utf8_encode($rs_clientes->fields["inven_valorunit"]);
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = $company[ "label" ];
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )
	  !== false ) {
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>