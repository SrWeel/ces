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
$lista_clientes="select * from dns_cuadrobasicomedicamentos where CONCAT(cuadrobm_principioactivo,cuadrobm_presentacion,cuadrobm_concentracion,cuadrobm_primerniveldesagregcion,cuadrobm_tercerniveldesagregcion) like '%".$_GET[ "term" ]."%'";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());

//$file = fopen("codigo".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
//fwrite($file, $lista_clientes . PHP_EOL);
//fclose($file);

 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 //$companies[$ic]["label"]=utf8_encode($rs_clientes->fields["cuadrobm_principioactivo"])." ".utf8_encode($rs_clientes->fields["cuadrobm_presentacion"]);
	 $companies[$ic]["label"]=$rs_clientes->fields["cuadrobm_principioactivo"]." ".$rs_clientes->fields["cuadrobm_presentacion"]." ".$rs_clientes->fields["cuadrobm_concentracion"]." ".$rs_clientes->fields["cuadrobm_primerniveldesagregcion"]." ".$rs_clientes->fields["cuadrobm_tercerniveldesagregcion"];
	 $companies[$ic]["value"]=$rs_clientes->fields["cuadrobm_principioactivo"];
	 $companies[$ic]["descripcion"]=$rs_clientes->fields["cuadrobm_principioactivo"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["via"]=$rs_clientes->fields["cuadrobm_primerniveldesagregcion"];
	 $companies[$ic]["concentracion"]=$rs_clientes->fields["cuadrobm_concentracion"];
	 $companies[$ic]["presentacion"]=$rs_clientes->fields["cuadrobm_presentacion"];
	 $companies[$ic]["techo"]=$rs_clientes->fields["cuadrobm_preciotecho"];
	 $companies[$ic]["techosinpr"]=$rs_clientes->fields["cuadrobm_preciotechomenosporcentaje"];
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];

//print_r($companies);

$result = array();
foreach ($companies as $company) {
	$companyLabel = trim($company["label"]);
	$companyLabel=iconv('UTF-8', 'ASCII//TRANSLIT', $companyLabel);
	$companyLabel=str_replace("'","",$companyLabel);
	
	$term=iconv('UTF-8', 'ASCII//TRANSLIT', $term);
	$term=str_replace("'","",$term);
	
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )!== false ) {
	   // print_r($company);
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>