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

$doblesc='"';

$lista_clientes="select client_ciruc,tipoident_codigocl,client_nombre,client_apellido,client_direccion,client_telefono,client_mail from efacfactura_cliente union SELECT clie_rucci as client_ciruc, CASE WHEN tipoci_id=1 THEN ".$doblesc."05".$doblesc." WHEN tipoci_id=2 THEN ".$doblesc."06".$doblesc." WHEN tipoci_id=3 THEN ".$doblesc."08".$doblesc." ELSE ".$doblesc."05".$doblesc." END as tipoident_codigocl,clie_nombre  as client_nombre,clie_apellido as client_apellido,clie_direccion as client_direccion,clie_telefono as client_telefono,clie_email as client_mail FROM app_cliente";



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