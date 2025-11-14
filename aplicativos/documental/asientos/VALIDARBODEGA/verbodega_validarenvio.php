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





echo '<table width="500" border="1">';

$busca_paraentrega="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='375' and year(moviin_fecharegistro)>='2023' and centro_id='14' order by moviin_fechadecaducidad asc";
  $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {
	  
	  $tipo_movi=$objformulario->replace_cmb("dns_tipomovimiento","tipom_id,tipom_nombre"," where tipom_id=",$rs_paraentrega->fields["tipom_id"],$DB_gogess);
	  $motivo_movi=$objformulario->replace_cmb("dns_motivomovimiento","tipomov_id,tipomov_nombre"," where tipomov_id=",$rs_paraentrega->fields["tipomov_id"],$DB_gogess);
	  
	  echo "  <tr>
           <td bgcolor='#CCECF7' ><b>LOTE: ".$rs_paraentrega->fields["moviin_nlote"]." CODIGO: 1 ID_MOV=".$rs_paraentrega->fields["moviin_id"]." Cantidad=".$rs_paraentrega->fields["moviin_totalenunidadconsumo"]." Centro:".$rs_paraentrega->fields["centro_id"]."</b> TIPO MOV: ".$rs_paraentrega->fields["tipom_id"]." ".$tipo_movi." - MOTIVO MOV: ".$rs_paraentrega->fields["tipomov_id"]." ".$motivo_movi."</td>
        </tr>";
		
	 
	 $busca_stock="select * from dns_stockactual where moviin_id='".$rs_paraentrega->fields["moviin_id"]."'";
	 $rs_stock = $DB_gogess->executec($busca_stock,array());
	 echo "  <tr>
           <td bgcolor='#CCECF7' ><b>STOCK ID: ".$rs_stock->fields["stock_id"]."</b> MOVI ID: ".$rs_stock->fields["moviin_id"]." Signo: ".$rs_stock->fields["stock_signo"]." Cantidad: ".$rs_stock->fields["stock_cantidad"]." Centro: ".$rs_stock->fields["centro_id"]." </td>
        </tr>";	
	 
	  
	  $busca_dondeestan="select * from  dns_movimientoinventario where (entregamoviin_id='".$rs_paraentrega->fields["moviin_id"]."' or moviincent_id='".$rs_paraentrega->fields["moviin_id"]."')";	  
	  $rs_vok = $DB_gogess->executec($busca_dondeestan,array());
	  
	  if($rs_vok)
      {
		  while (!$rs_vok->EOF) {
		  
		   $busca_stocksalida="select * from dns_stockactual where moviin_id='".$rs_vok->fields["moviin_id"]."'";
	       $rs_stocksalida = $DB_gogess->executec($busca_stocksalida,array());
		   
		  echo "<tr>
           <td><b>CODIGO: 2  SALIO DE ".$rs_paraentrega->fields["moviin_id"]."  ->  ID_MOVIENV= ".$rs_vok->fields["moviin_id"]." Cantidad=".$rs_vok->fields["moviin_totalenunidadconsumo"]." Centro:".$rs_vok->fields["centro_id"]."<br> STOCK ID: ".$rs_stocksalida->fields["stock_id"]."</b> MOVI ID: ".$rs_stocksalida->fields["moviin_id"]." Signo: ".$rs_stocksalida->fields["stock_signo"]." Cantidad: ".$rs_stocksalida->fields["stock_cantidad"]." Centro: ".$rs_stocksalida->fields["centro_id"]." </b></td>
        </tr>";
		
		  
		  $rs_vok->MoveNext();
		  }	  
	  }
	  
	   echo "  <tr>
           <td bgcolor='#CCECF7' ><hr></td>
        </tr>";
	 
       $rs_paraentrega->MoveNext();
      }
  }

echo '</table>';


}


?>

