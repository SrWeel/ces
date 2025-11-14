<?php
$tiempossss=44600000;
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
	//busca zona del centro
	$busca_zona="select zona_id from dns_centrosalud where centro_id=".$_SESSION['ces1313777_centro_id'];
	$rs_zona = $DB_gogess->executec($busca_zona);
	$zona_id=$rs_zona->fields["zona_id"];
	//busca zona del centro
	
	$busca_medicamento="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".trim($_POST["plantra_codigox"])."'";
	$cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($busca_medicamento);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {
						
						
						$stockactual="select sum(stock_cantidad * stock_signo) as stockactual from dns_stockactual where centro_id=".$_SESSION['ces1313777_centro_id']." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);
						
						if($rs_stactua->fields["stockactual"])
						{
						echo "Disponible al momento:".$rs_stactua->fields["stockactual"];
						}
						else
						{
						echo "Disponible al momento: 0";
						}
						
						$cuadrobm_id=$rs_listacmp->fields["cuadrobm_id"];
						
						$rs_listacmp->MoveNext();
						}
					}	
}

?>


<div onClick="abrir_standar('templateformsweb/maestro_standar_anamnesisclinica/lista_existencias.php','Existencias','divBody_existencia','divDialog_existencia',800,500,'<?php echo $zona_id; ?> ','<?php echo $cuadrobm_id; ?>',0,0,0,0,0)" ><img src="images/lupaatencion.png" width="50" height="50"></div>

<div id="divBody_existencia" ></div>