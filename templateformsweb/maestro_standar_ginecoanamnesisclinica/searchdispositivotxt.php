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
$lista_clientes="select cuadrobm_nombredispositivo,cuadrobm_presentacion,cuadrobm_codigoatc,cuadrobm_preciodispositivo from dns_cuadrobasicomedicamentos where categ_id=2 and cuadrobm_nombredispositivo like '%".$_GET[ "term" ]."%' order by cuadrobm_nombredispositivo asc";
//$lista_clientes="select * from dns_cuadrobasicomedicamentos where categ_id=2";

//$file = fopen("codigo".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
//fwrite($file, $lista_clientes . PHP_EOL);
//fclose($file);

$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["cuadrobm_nombredispositivo"]." ".$rs_clientes->fields["cuadrobm_presentacion"];
	 $companies[$ic]["value"]=$rs_clientes->fields["cuadrobm_nombredispositivo"];
	 $companies[$ic]["descripcion"]=$rs_clientes->fields["cuadrobm_nombredispositivo"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["precio"]=$rs_clientes->fields["cuadrobm_preciodispositivo"];
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = trim($company["label"]);
	
	
	$companyLabel=iconv('UTF-8', 'ASCII//TRANSLIT', $companyLabel);
	$companyLabel=str_replace("'","",$companyLabel);
	//$companyLabel=utf8_decode($companyLabel);
	$term=iconv('UTF-8', 'ASCII//TRANSLIT', $term);
	$term=str_replace("'","",$term);

	
	if ( strpos( strtoupper($companyLabel), strtoupper($term) ) !== false ) {
		    
		array_push( $result, $company );
	}
}




echo json_encode( $result );

}
?>