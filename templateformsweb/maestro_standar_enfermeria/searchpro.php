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

$busca_nivel="select  permif_id from dns_centrosalud where centro_id=".$_SESSION['ces1313777_centro_id'];
$rs_bnivel = $DB_gogess->executec($busca_nivel,array());


$lista_clientes="select prod_codigo,prod_nombre,prod_precio from efacsistema_producto where prod_nivel=".$rs_bnivel->fields["permif_id"];
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["prod_codigo"];
	 $companies[$ic]["value"]=$rs_clientes->fields["prod_codigo"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["prod_codigo"];
	 $companies[$ic]["descripcion"]=utf8_encode($rs_clientes->fields["prod_nombre"]);
	 $companies[$ic]["precio"]=utf8_encode($rs_clientes->fields["prod_precio"]);
	 
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