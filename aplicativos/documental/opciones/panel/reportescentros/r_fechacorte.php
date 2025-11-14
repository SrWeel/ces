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
$fechai=$_POST["fechai"];
$categ_id=$_POST["categ_id"];



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

?>
<div align="center">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><strong>DIRECCION NACIONAL DE ATENCION INTEGRA EN SALUD DE LA POLICIA NACIONAL </strong></div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Bodega: BODEGA DNS Fecha de Corte: </strong><?php echo $fechai; ?></div></td>
    </tr>
    <tr>
      <td><div align="center"></div></td>
    </tr>
  </table>
</div>
<?php
$bu_fcorte="select * from dns_compras co inner join dns_principalmovimientoinventario det on co.compra_id=det.compra_id inner join cmb_dns_cuadrobasicomedicamentos cm on cm.cuadrobm_id=det.cuadrobm_id where compra_fechaaprobacion<='".$fechai."' and year(compra_fechaaprobacion)='".$per_activo."' and cm.categ_id='".$categ_id."' and det.tipomov_id=17 order by nombre_med asc";
?>
<br>
<br>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
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
  $saldo=0; 
  $rs_listafcorte = $DB_gogess->executec($bu_fcorte);
                   if($rs_listafcorte)
				   {
						while (!$rs_listafcorte->EOF) {
						
					$datop=array();				
					$datop=$objBodega->nombre_pr('',$rs_listafcorte->fields["cuadrobm_id"],$DB_gogess);
					
					$stock_ac=0;
                    $stock_ac=$objBodega->stock_alafecha($centro_id,$rs_listafcorte->fields["cuadrobm_id"],$fechai,$rs_listafcorte->fields["moviin_nlote"],$rs_listafcorte->fields["compra_id"],$DB_gogess);
					
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
						<td><?php echo $total_valor; ?></td>
  </tr>					
					<?php						
					}
                         $rs_listafcorte->MoveNext();
                       }
				}	   
  
  
  ?>
</table>
<?php
}
?>