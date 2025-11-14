<?php
$tiempossss=4450000;
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
$lista_clientes="select * from dns_cuadrobasicomedicamentos where categ_id=2 and cuadrobm_codigoatc like '".$_GET[ "term" ]."%'";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["value"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["descripcion"]=$rs_clientes->fields["cuadrobm_nombredispositivo"];
	 $companies[$ic]["precio"]=$rs_clientes->fields["cuadrobm_preciodispositivo"];
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = $company[ "label" ];
	
	//$file = fopen("codigo".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
    //fwrite($file, strtoupper($companyLabel)."===>".strtoupper($term) . PHP_EOL);
    //fclose($file);
	
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )
	  !== false ) {
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>