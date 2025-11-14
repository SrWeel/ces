<?php
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if(@$_SESSION['ces1313777_usua_id'])
{
$ic=0;
$lista_clientes="select * from app_cliente";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["clie_nombre"]." ".$rs_clientes->fields["clie_apellido"];
	 $companies[$ic]["value"]=$rs_clientes->fields["clie_nombre"]." ".$rs_clientes->fields["clie_apellido"];
	 $companies[$ic]["nombre"]=$rs_clientes->fields["clie_nombre"];
	 $companies[$ic]["direccion"]=$rs_clientes->fields["clie_direccion"];
	 $companies[$ic]["telefono"]=$rs_clientes->fields["clie_telefono"];
	 $companies[$ic]["email"]=$rs_clientes->fields["clie_email"];
         $companies[$ic]["clie_id"]=$rs_clientes->fields["clie_id"];

	 
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