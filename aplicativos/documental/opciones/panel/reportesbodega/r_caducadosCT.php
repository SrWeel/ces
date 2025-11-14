<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$codigo_pr=$_POST["codigo_pr"];
$lote_pr=$_POST["lote_pr"];
$fechai=$_POST["fechaf"];
$fechaf=$_POST["fechaf"];
$categ_id=$_POST["categ_id"];

$fechaf=date("Y-m-d");

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();
$centro_id=55;
$b_periodoac="";
$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

$saca_consulta="select * from dns_subbodega where subo_id='1'";
$rs_consul = $DB_gogess->executec($saca_consulta);
$subo_script=$rs_consul->fields["subo_script"];


$bu_fcorte="select * from  dns_principalmovimientoinventario det left join dns_compras co on co.compra_id=det.compra_id inner join cmb_dns_cuadrobasicomedicamentos cm on cm.cuadrobm_id=det.cuadrobm_id where compra_fechaaprobacion<='".$fechaf."' and year(compra_fechaaprobacion)>='".$per_activo."' and cm.categ_id='".$categ_id."' and det.tipomov_id in (2,17,8,9,10,16) order by moviin_fechadecaducidad asc";
 
$bu_fcorte="select * from  dns_principalmovimientoinventario det left join dns_compras co on co.compra_id=det.compra_id inner join cmb_dns_cuadrobasicomedicamentos cm on cm.cuadrobm_id=det.cuadrobm_id where (compra_fechaaprobacion<='".$fechaf."' or moviin_fecharegistro<='".$fechaf."') and (year(compra_fechaaprobacion)>='".$per_activo."' or perioac_id >='".$per_activo."') and cm.categ_id='".$categ_id."' and det.tipomov_id in (2,17,8,9,10,16) ".$subo_script." order by moviin_fechadecaducidad asc";
 
?>
<br>
<br>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7"><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="7"><div align="center"><strong>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR </strong></div></td>
  </tr>
  <tr>
    <td colspan="7"><div align="center"><strong><b>Bodega: BODEGA PRINCIPAL Fecha de Corte: <?php echo $fechai; ?></b></strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>C&oacute;digo</strong></div></td>
    <td><div align="center"><strong>Lote</strong></div></td>
    <td><div align="center"><strong>Fec. Cad.</strong></div></td>
    <td><div align="center"><strong>Nombre del Producto</strong></div></td>
    <td><div align="center"><strong>Saldo</strong></div></td>
    <td><div align="center"><strong>Costo</strong></div></td>
    <td><div align="center"><strong>Total</strong></div></td>
  </tr>
  <?php
  $somatt1=0;
  $somatt2=0;
  $somatt3=0;
  
  $saldo=0; 
  $rs_listafcorte = $DB_gogess->executec($bu_fcorte);
                   if($rs_listafcorte)
				   {
						while (!$rs_listafcorte->EOF) {
						
					$datop=array();				
					$datop=$objBodega->nombre_pr('',$rs_listafcorte->fields["cuadrobm_id"],$DB_gogess);
					
					//$stock_aci=0;
                    //$stock_aci=$objBodega->stock_alafecha($centro_id,$rs_listafcorte->fields["cuadrobm_id"],$fechai,$rs_listafcorte->fields["moviin_nlote"],$rs_listafcorte->fields["compra_id"],$DB_gogess);
					
					$stock_acf=0;
                    $stock_acf=$objBodega->stock_alafecha($centro_id,$rs_listafcorte->fields["cuadrobm_id"],$fechaf,$rs_listafcorte->fields["moviin_nlote"],$rs_listafcorte->fields["compra_id"],$DB_gogess);
					
					//$stock_ac= $stock_aci-$stock_acf;
					
					$stock_ac= $stock_acf;
					
					$total_valor=0;
					$total_valor=$stock_ac*$rs_listafcorte->fields["moviin_preciocompra"];					
					$total_valor=number_format($total_valor, 2, '.', '');
					if($stock_ac>0)
					{
					?>
					<tr>
						<td><?php echo $datop["codigo"]; ?></td>
						<td><?php echo $rs_listafcorte->fields["moviin_nlote"]; ?></td>
						<td nowrap="nowrap"><?php echo $rs_listafcorte->fields["moviin_fechadecaducidad"];  ?></td>
						<td><?php echo $datop["nombre"]; ?></td>
						<td><?php echo $stock_ac; ?></td>
						<td><?php echo $rs_listafcorte->fields["moviin_preciocompra"]; ?></td>
						<td><?php echo round($total_valor,2); ?></td>
  </tr>					
					<?php	
                         $somatt1=$somatt1+$stock_ac;
                       $somatt2=$somatt2+$rs_listafcorte->fields["moviin_preciocompra"];
                       $somatt3=$somatt3+$total_valor;	
					   
					}
                         $rs_listafcorte->MoveNext();
                       }
				}	   
  
  
  ?>
  
      <tr>
						<td><b>TOTALES</b></td>
						<td>&nbsp;</td>
						<td nowrap="nowrap">&nbsp;</td>
						<td>&nbsp;</td>
						<td><?php //echo $somatt1; ?></td>
						<td><?php echo $somatt2; ?></td>
						<td><?php echo $somatt3; ?></td>
              </tr>	
			  
</table>
<?php
}
?>