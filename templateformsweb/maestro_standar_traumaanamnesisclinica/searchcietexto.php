<?php
$tiempossss=540000;
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
$lista_clientes="select * from dns_cie where cie_descripcion like '%".$_GET[ "term" ]."%' order by cie_descripcion asc";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());

//$file = fopen("sql".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
//fwrite($file,$lista_clientes . PHP_EOL);
//fclose($file);

 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["cie_descripcion"];
	 $companies[$ic]["value"]=$rs_clientes->fields["cie_descripcion"];
	 $companies[$ic]["descripcion"]=$rs_clientes->fields["cie_descripcion"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["cie_codigo"];
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = $company[ "label" ];
	$companyLabel=iconv('UTF-8', 'ASCII//TRANSLIT', $companyLabel);
	$companyLabel=str_replace("'","",$companyLabel);
	
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )
	  !== false ) {
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>