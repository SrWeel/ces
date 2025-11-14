<?php
$tiempossss=4445000;
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

$lista_clientes="select * from efacfactura_cliente";



$rs_clientes = $DB_gogess->executec($lista_clientes,array());

 if($rs_clientes)

 {

	  while (!$rs_clientes->EOF) {	

	  

	 $companies[$ic]["label"]=$rs_clientes->fields["client_ciruc"];

	 $companies[$ic]["value"]=$rs_clientes->fields["client_ciruc"];

	 $companies[$ic]["ruc"]=$rs_clientes->fields["client_ciruc"];

	 $companies[$ic]["codigo"]=$rs_clientes->fields["tipoident_codigocl"];

	 $companies[$ic]["nombre"]=$rs_clientes->fields["client_nombre"];
	 $companies[$ic]["apellido"]=$rs_clientes->fields["client_apellido"];

	 $companies[$ic]["direccion"]=$rs_clientes->fields["client_direccion"];

	 $companies[$ic]["telefono"]=$rs_clientes->fields["client_telefono"];

	 $companies[$ic]["email"]=$rs_clientes->fields["client_mail"];

	 

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