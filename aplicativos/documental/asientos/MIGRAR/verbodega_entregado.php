<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$cuadrobm_id=375;
$centro_id='14';

$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);


$select_bu="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_id ='".$cuadrobm_id."'";
$rs_bu= $DB_gogess->executec($select_bu,array());

$stockactual="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id=".$rs_bu->fields["cuadrobm_id"]." and stock_periodo='".$periodo_actual."'";
$rs_stactua = $DB_gogess->executec($stockactual);

echo "C&oacute;digo:".$rs_bupedido->fields["precu_id"]."<br>";
echo "Saldo actual: ".$rs_stactua->fields["stactual"]*1;

$actual_saldo=0;
$actual_saldo=$rs_stactua->fields["stactual"]*1;
$concatena_id='';


$busca_paraentrega="select entregamoviin_id,moviincent_id,moviin_id from dns_movimientoinventario where tipom_id=2 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='375' and year(moviin_fecharegistro)>='2023' and centro_id='14' ORDER BY `dns_movimientoinventario`.`moviin_id` ASC";
  $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {
	  
	  
	  $busca_vok="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='375' and year(moviin_fecharegistro)>='2023' and centro_id='14' and  (moviin_id='".$rs_paraentrega->fields["entregamoviin_id"]."' or moviin_id='".$rs_paraentrega->fields["entregamoviin_id"]."') ORDER BY `dns_movimientoinventario`.`moviin_id` ASC";
	  
	  $rs_vok = $DB_gogess->executec($busca_vok,array());
	  
	  if($rs_vok->fields["moviin_id"]>0)
	  {
	    echo "si esta<br>";
	  }
	  else
	  {
	    echo $rs_paraentrega->fields["moviin_id"]."<br>";
	  }
	 
       $rs_paraentrega->MoveNext();
      }
  }




}


?>