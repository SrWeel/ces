<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");



$conc_id=0;
$conc_id=$_GET["pVar9"];

$obtiene_info="select * from app_conciliacion where conc_id='".$conc_id."'";
$rs_obtinfo= $DB_gogess->executec($obtiene_info,array());


$compra_enlace=$rs_obtinfo->fields["conc_enlace"];
$conc_fechacorte=$rs_obtinfo->fields["conc_fechacorte"];
$conc_cuenta=$rs_obtinfo->fields["conc_cuenta"];
$conc_saldobanco=$rs_obtinfo->fields["conc_saldobanco"];
$conc_id=$rs_obtinfo->fields["conc_id"];

echo "Listado:".$conc_id;
$cuenta_seleecionos=0;
$cuenta_noseleecionos=0;

$bloque_registro=0;

if($conc_id>0)
{
$busca_elanterior="select * from app_conciliacion where conc_id < ".$conc_id." order by conc_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}
else
{
$busca_elanterior="select * from app_conciliacion  order by conc_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}

$fecha_corteanterior=$rs_ultimafecha->fields["conc_fechacorte"];
$conc_saldocontableant=$rs_ultimafecha->fields["conc_saldocontable"];

?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<center>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR .</center>
<?php

$busca_plcuenta="select * from lpin_plancuentas where planc_codigoc='".$rs_obtinfo->fields["conc_cuenta"]."'";
$rs_bucuenta = $DB_gogess->executec($busca_plcuenta,array());

echo $rs_bucuenta->fields["planc_codigoc"]." ".$rs_bucuenta->fields["planc_nombre"]."<br>";
echo $rs_obtinfo->fields["conc_descripcion"]."<br>";

echo "<b>Saldo Bancario: </b>".$rs_obtinfo->fields["conc_saldobanco"]."<br>";
echo "<b>Saldo Contable: </b>".$rs_obtinfo->fields["conc_saldocontable"]."<br>";
echo "<b>Diferencia: </b>".$rs_obtinfo->fields["conc_diferencia"];

?><br><br>
<div id="campo_valorx"></div>  
<table class="table table-bordered" style="width:100%">
  <tbody><tr>
   <td bgcolor="#DFE9EE"></td>
   <td bgcolor="#DFE9EE"><b>Fecha</b></td>
   <td bgcolor="#DFE9EE"><b>Detalle</b></td>
   <td bgcolor="#DFE9EE"><b>Referencia</b></td>
   <td bgcolor="#DFE9EE"><b>Tipo</b></td>
   <td bgcolor="#DFE9EE"><b>Monto</b></td>
   </tr>
   
   <?php
   if($conc_saldocontableant)
   {
   ?>
   <tr>
	<td><b>Saldo Anterior</b></td>
    <td nowrap="nowrap" ><?php echo $fecha_corteanterior; ?></td>
	<td></td>
	<td></td>
	<td nowrap="nowrap"></td>
	<td><b><?php echo $conc_saldocontableant; ?></b></td>
  </tr>
   
   <?php
   }
   
   ?>
   
<?php
$suma_valort=0;

if(!(trim($fecha_corteanterior)))
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where ((comcont_fecha<='".$conc_fechacorte."' and conc_idform=0) or (conc_idform='".$conc_id."') or (comcont_fecha<='".$conc_fechacorte."' and  detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='".$conc_cuenta."' and comcont_anulado=0  order by comcont_fecha asc";


}
else
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where (( comcont_fecha >'".$fecha_corteanterior."' and comcont_fecha<='".$conc_fechacorte."' and conc_idform=0 ) or (conc_idform='".$conc_id."') or (comcont_fecha<='".$conc_fechacorte."' and 	detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='".$conc_cuenta."' and comcont_anulado=0 order by comcont_fecha asc";
}

//echo $lista_renta;

$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
$contador_lista++;	 
	 $detalle='';
	 $referencia='';
	 $tipo='';
	 
	 $comcont_tabla=$rs_listadata->fields["comcont_tabla"];
	 
	 if(!($comcont_tabla))
	 {
	    $detalle=$rs_listadata->fields["comcont_concepto"];
	    $referencia=$rs_listadata->fields["comcont_numeroc"];
		
		$tipoa_id=$rs_listadata->fields["tipoa_id"];
		
		$busca_tipo="select * from lpin_tipoasiento where tipoa_id='".$tipoa_id."'";
		$rs_btipo= $DB_gogess->executec($busca_tipo,array());		
		$tipo=strtoupper($rs_btipo->fields["tipoa_nombre"]);
		
	 }
	 else
	 {
	 
	     switch ($comcont_tabla) {
				case 'app_anticipos':
					{
					
					   $busca_datos="select * from app_anticipos where anti_id='".$rs_listadata->fields["comcont_idtabla"]."'";
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   $detalle=$rs_bd->fields["anti_descripcion"];
	                   $referencia=$rs_bd->fields["anti_comprobante"];
					   
					    $detantic_id=$rs_bd->fields["detantic_id"];
					    $busca_tipo="select * from cesdb_arcombos.cmd_tipodetallemovanticipo where detantic_id='".$detantic_id."'";
						$rs_btipo= $DB_gogess->executec($busca_tipo,array());		
						$tipo=strtoupper($rs_btipo->fields["detantic_nombre"]);
					
					}
					break;
				case 'lpin_cobropago':
					{
					   if($rs_listadata->fields["comcont_tablas"]=='dns_compras')
					   {
					    $busca_datos="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='".$rs_listadata->fields["comcont_idtabla"]."' and  compracp_id='".$rs_listadata->fields["comcont_idtablas"]."'";
					   
					   }
					   
					   if($rs_listadata->fields["comcont_tablas"]=='beko_documentocabecera')
					   {
					     $busca_datos="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='".$rs_listadata->fields["comcont_idtabla"]."' and  doccabcp_id='".$rs_listadata->fields["comcont_idtablas"]."'";
					   
					   }
					   
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   
					   $frocob_id=$rs_bd->fields["frocob_id"];
					   $busca_tipo="select * from lpin_formadecobro where frocob_id='".$frocob_id."'";
					   $rs_btipo= $DB_gogess->executec($busca_tipo,array());		
					   $tipo=strtoupper($rs_btipo->fields["frocob_nombre"]);
					   
					   $doccab_id=$rs_bd->fields["doccabcp_id"];
					   $compra_id=$rs_bd->fields["compracp_id"];
					   
					   $ndoc='';
					   
					   if($doccab_id)
					   {
					      $busca_datos2="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
					      $rs_bd2 = $DB_gogess->executec($busca_datos2,array());
						  $ndoc=$rs_bd->fields["crb_ncomprobante"];
					      $dscrip=$rs_bd2->fields["doccab_adicional"];
					   }
					   
					   if($compra_id)
					   {
					      $busca_datos2="select * from dns_compras where compra_id='".$compra_id."'";
					      $rs_bd2 = $DB_gogess->executec($busca_datos2,array());
					      $ndoc=$rs_bd->fields["crb_ncomprobante"];
						  $dscrip=$rs_bd2->fields["compra_descripcion"];
					   }
					   
					   $detalle=$dscrip.' '.$rs_bd->fields["crb_descripcion"];
	                   $referencia=$ndoc;
					   
					   
					    
					
					}
					break;
				case 'app_movimientobancos':
					{
					    
					   $busca_datos="select * from app_movimientobancos inner join app_proveedor on app_movimientobancos.proveemovban_id=app_proveedor.provee_id where movban_id='".$rs_listadata->fields["comcont_idtabla"]."'";
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   
					   $detmov_id=$rs_bd->fields["detmov_id"];
					   $busca_tipo="select * from cesdb_arcombos.cmd_tipodetallemovbancos where detmov_id='".$detmov_id."'";
					   $rs_btipo= $DB_gogess->executec($busca_tipo,array());		
					   $tipo=strtoupper($rs_btipo->fields["detmov_nombre"]);
					   
					   
					   $detalle=$rs_bd->fields["movban_descripcion"].' '.$rs_bd->fields["provee_nombre"];
	                   $referencia=$rs_bd->fields["movban_comprobante"];				   
					   
					
					
					}
					break;
			}
	 
	 
	 }
	
	
if($rs_listadata->fields["detcc_conciliacion"]==1)
	{	  
  ?> 
  <tr>
    <td>&nbsp;</td>

	<?php
	$comulla_simple="'";
    $tabla_valordata="";
    $tabla_valordata="'lpin_detallecomprobantecontable'";
	
	$campo_valor="";
	$campo_valor="'detcc_id'";
	$ide_producto='detcc_id';
	$ncampo_val='detcc_conciliacion';
	
	if($rs_listadata->fields["detcc_conciliacion"]==1)
	{
	
 
	//echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" value="'.$rs_listadata->fields[$ide_producto].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].','.$comulla_simple.$ide_producto.$comulla_simple.')";  checked />';	
	
	$cuenta_seleecionos++;

		}
	else
	{
	
	
	//echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" value="'.$rs_listadata->fields[$ide_producto].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].','.$comulla_simple.$ide_producto.$comulla_simple.')"; />';	
	
	$cuenta_noseleecionos++;
	
	}	


$monto=0;
$signo='';
if($rs_listadata->fields["detcc_debe"]>0)
{
  $monto=$rs_listadata->fields["detcc_debe"];
  $signo='<i class="fa fa-plus" style="color:#000000"></i>';
  $montosuma=$rs_listadata->fields["detcc_debe"];
}
if($rs_listadata->fields["detcc_haber"]>0)
{
  $monto=$rs_listadata->fields["detcc_haber"];
  $signo='<i class="fa fa-minus" style="color:#FF0000"></i>';
  $montosuma=$rs_listadata->fields["detcc_haber"]*-1;
}

//$rs_listadata->fields["comcont_id"]
	?>

    <td nowrap="nowrap" ><?php echo $rs_listadata->fields["comcont_fecha"]; ?></td>
	<td><?php echo $detalle; ?></td>
	<td><?php echo $referencia; ?></td>
	<td nowrap="nowrap"><?php echo $signo.' '.$tipo; ?></td>
	<td><?php echo $monto; ?></td>
  </tr>
<?php
}


if($rs_listadata->fields["detcc_conciliacion"]==1 and $rs_listadata->fields["conc_idform"]==$conc_id)
{
$suma_valort=$suma_valort+$montosuma;
}

         $rs_listadata->MoveNext();
	  }
  }	


$saldo_finalmes=0;
$saldo_finalmes=$conc_saldocontableant+($suma_valort);

$diferencia=0;
$diferencia=round(($conc_saldobanco-$saldo_finalmes),2);
?>  
 </td>
	<td></td>
	<td>SALDO</td>
	<td></td>
	<td></td>
	<td></td>
	<td><div id="stotal"><b><?php echo $saldo_finalmes; ?></b></div></td>
  </tr>
  
  </tbody>
 </table>