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
$lista_clientes="select * from app_clienteseguros where clie_rucci like '".$_GET[ "term" ]."%'";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());

//$file = fopen("codigo".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
//fwrite($file, $lista_clientes . PHP_EOL);
//fclose($file);

 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["clie_rucci"];
	 $companies[$ic]["value"]=$rs_clientes->fields["clie_rucci"];
	 $companies[$ic]["nombre"]=$rs_clientes->fields["clie_nombre"];
	 $companies[$ic]["apellido"]=$rs_clientes->fields["clie_apellido"];
	 $companies[$ic]["direccion"]=$rs_clientes->fields["clie_direccion"];
	 $companies[$ic]["telefono"]=$rs_clientes->fields["clie_telefono"];
	 $companies[$ic]["celular"]=$rs_clientes->fields["clie_celular"];
	 $companies[$ic]["email"]=$rs_clientes->fields["clie_email"];
	 $companies[$ic]["civil"]=$rs_clientes->fields["civil_id"];
	 $companies[$ic]["clie_fechanacimiento"]=$rs_clientes->fields["clie_fechanacimiento"];
	 $separa_fecha=array();
	 $separa_fecha=explode("-",$rs_clientes->fields["clie_fechanacimiento"]);	 
	 $companies[$ic]["dia_clie_fechanacimiento"]=$separa_fecha[2];
	 $companies[$ic]["mes_clie_fechanacimiento"]=$separa_fecha[1];
	 $companies[$ic]["anio_clie_fechanacimiento"]=$separa_fecha[0];
	 $companies[$ic]["clie_genero"]=$rs_clientes->fields["clie_genero"];	 
	 $companies[$ic]["clie_instruccion"]=$rs_clientes->fields["clie_instruccion"];	 
	 $companies[$ic]["prob_codigo"]=$rs_clientes->fields["prob_codigo"];
	 $companies[$ic]["cant_codigo"]=$rs_clientes->fields["cant_codigo"];
	 
	 
	 
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