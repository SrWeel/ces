<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_GET["excel"]==1)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."LISTA_".$fechahoy.".xls");
}

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_GET["precu_id"];
$centro_id=$_GET["centro_id"];

if($centro_id==1)
{
  $centro_id='55';
}


$lista_bprecuentac="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());
$clie_id=$rs_bprecuentac->fields["clie_id"];

$busca_clientec="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());

$ci_data='';	 
$nombre_paciente='';

if(@$_GET["excel"]==1)
{
   $ci_data=$rs_bclientec->fields["clie_rucci"];
   $nombre_paciente=utf8_decode($rs_bclientec->fields["clie_nombre"]." ".$rs_bclientec->fields["clie_apellido"]);
}
else
{
   $ci_data=$rs_bclientec->fields["clie_rucci"];
   $nombre_paciente=$rs_bclientec->fields["clie_nombre"]." ".$rs_bclientec->fields["clie_apellido"];
}
?>
<div align="center"><strong>PRE-FACTURA </strong><br />
</div>

<div align="center"><strong>RESUMEN AGRUPADO</strong><br />
</div>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>CI: </strong></td>
    <td><?php echo $ci_data; ?></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>PACIENTE: </strong></td>
    <td width="557"><?php echo $nombre_paciente; ?></td>
    <td width="165"></td>
    <td width="179"></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>DIAGNOSTICO:&nbsp;</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>M&Eacute;DICO:&nbsp;</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>FECHA    DE INGRESO : </strong></td>
    <td>&nbsp;</td>
    <td><strong>FACTURA N&deg;</strong></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="2" nowrap="nowrap"><strong>FECHA    DE ALTA: </strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<br />
PCT<br />

<?php
$lista_precuentasx="select round((sum(detapre_precioventa*detapre_cantidad)),2) as totalmed from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1)  order by detapre_tipo asc";
$rs_lprecuentasx = $DB_gogess->executec($lista_precuentasx,array());
	
$total_medicamento=0;
$total_medicamento=$rs_lprecuentasx->fields["totalmed"];

//==============================================================

$lista_precuentasx1="select round((sum(detapre_precioventa*detapre_cantidad)),2) as totalmed from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (2)  order by detapre_tipo asc";
$rs_lprecuentasx1 = $DB_gogess->executec($lista_precuentasx1,array());
	
$total_insumos=0;
$total_insumos=$rs_lprecuentasx1->fields["totalmed"];

//===============================================================
//IVA
$total_ivavalor=0;
$lista_precuentasiva="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (2)  order by detapre_tipo asc";
	
$rs_lprecuentasiva = $DB_gogess->executec($lista_precuentasiva,array());

 if($rs_lprecuentasiva)
 {
	  while (!$rs_lprecuentasiva->EOF) {  
	  
	  
	    $bu_cuadrobm_id=$rs_lprecuentasiva->fields["cuadrobm_id"];
		$busca_cuadro="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$bu_cuadrobm_id."'";
		$rs_buscaiva = $DB_gogess->executec($busca_cuadro,array());
		
		$tari_codigo=0;
		$tari_codigo=$rs_buscaiva->fields["tari_codigo"];
		
		$busca_tarifavalor="select * from beko_tarifa where tari_codigo='".$tari_codigo."'";
		$rs_tarivalor = $DB_gogess->executec($busca_tarifavalor,array());
		
		$tari_valor=$rs_tarivalor->fields["tari_valor"];
		
		if($tari_valor>0)
		{
		  $stotal_valorx=$rs_lprecuentasiva->fields["detapre_precioventa"]*$rs_lprecuentasiva->fields["detapre_cantidad"];
		  $valor_ivcalculo=$tari_valor/100;
		  
		  $valor_iva=$stotal_valorx*$valor_ivcalculo;  
		  $total_ivavalor=$total_ivavalor+$valor_iva;
		}
	  
	  
	     $rs_lprecuentasiva->MoveNext();	
	  }
  }	  
?>

  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CANTIDAD </div></td>
 
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">DESCRIPCION</div></td>
      
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">V, UNITARIO</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">IVA </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">V, TOTAL</div></td>
    </tr>
	<?php
	$valor_total=0;
	//$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuenta.centrob_id in (".$centro_id.",1,9999,8888)";
	$total_ivavalory=0;
	$lista_precuentas="select  detapre_tipo,centro_nombre,detapre_observacion,usua_id,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad ,detapre_precioventa,detapre_fecharegistro  from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (3,4)  group by detapre_detalle order by detapre_tipo asc  ";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
  if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     $estado_prec='TARIFARIO';
   
   }
   
    if($rs_lprecuentas->fields["detapre_tipo"]==4)
   {
     $estado_prec='MCGRAW HILL';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuenta'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 

        
		
		
		/*$total_ivavalor=0;
        $tari_codigo=0;
		$tari_codigo=$rs_lprecuentas->fields["tari_codigo"];
		
		$busca_tarifavalor="select * from beko_tarifa where tari_codigo='".$tari_codigo."'";
		$rs_tarivalorx = $DB_gogess->executec($busca_tarifavalor,array());
		
		$tari_valor=$rs_tarivalorx->fields["tari_valor"];
		
		if($tari_valor>0)
		{
		  $stotal_valorx=$rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"];
		  $valor_ivcalculo=$tari_valor/100;
		  
		  $valor_iva=$stotal_valorx*$valor_ivcalculo;  
		  $total_ivavalor=$total_ivavalor+$valor_iva;
		}*/
	  $valor_ivay=0;
if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     //tarifario
	    $detapre_codigopx=$rs_lprecuentas->fields["detapre_codigop"];
		$busca_codex="select * from efacsistema_producto where prod_codigo='".$detapre_codigopx."'";
		$rs_buscodex = $DB_gogess->executec($busca_codex,array());
		
		$impu_codigo_x=$rs_buscodex->fields["impu_codigo"];
		$tari_codigo_x=$rs_buscodex->fields["tari_codigo"];
		
		$busca_tarifavalorz="select * from beko_tarifa where tari_codigo='".$tari_codigo_x."'";
		$rs_tarivalorz = $DB_gogess->executec($busca_tarifavalorz,array());
		
		$tari_valorz=$rs_tarivalorz->fields["tari_valor"];
		
		if($tari_codigo_x>0)
		{
		  $stotal_valorx=$rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"];
		  $valor_ivcalculox=$tari_valorz/100;
		  
		  $valor_ivay=$stotal_valorx*$valor_ivcalculox;  
		  $total_ivavalory=$total_ivavalory+$valor_ivay;
		}
   
   }
 
	?>
    <tr>

      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo  $valor_ivay; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round((($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"])+$valor_ivay),2); ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round((($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"])+$valor_ivay),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>
   <tr>
      <td class="css_texto" style="font-size:10px" ><div align="center">1</div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center">INSUMOS</div></td>      
      <td class="css_texto"><div align="center"><?php echo round($total_insumos,2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($total_ivavalor,2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($total_insumos+$total_ivavalor,2); ?></div></td>
    </tr>
<?php
  $valor_total=$valor_total+$total_insumos+$total_ivavalor;
?>	
	 <tr>
      <td class="css_texto" style="font-size:10px" ><div align="center">1</div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center">MEDICAMENTOS</div></td>      
      <td class="css_texto"><div align="center"><?php echo round($total_medicamento,2); ?></div></td>
	  <td class="css_texto"><div align="center">&nbsp;</div></td>
	  <td class="css_texto"><div align="center"><?php echo round($total_medicamento,2); ?></div></td>
    </tr>
<?php
  $valor_total=$valor_total+$total_medicamento;
?>	

<tr>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo round($valor_total,2); ?></b></div></td>
</tr>
</table>


<br />
MEDICAMENTOS

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
       <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"></div></td>    
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Tipo</div></td>   
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO RP</div></td>   
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE RP</div></td>    
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">MEDICAMENTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">V, UNITARIO</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	$contador_dd=0;
	$valor_total=0;
	//$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuenta.centrob_id in (".$centro_id.",1,9999,8888)";
	
	$lista_precuentas="select detapre_tipo,centro_nombre,detapre_observacion,usua_id,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad ,detapre_precioventa,detapre_fecharegistro,cuadrobm_id from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1) group by detapre_detalle order by detapre_tipo asc ";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
  if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     $estado_prec='TARIFARIO';
   
   }
   
    if($rs_lprecuentas->fields["detapre_tipo"]==4)
   {
     $estado_prec='MCGRAW HILL';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuenta'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 
 
 $contador_dd++;
 
$bu_cuadrobm_id=$rs_lprecuentas->fields["cuadrobm_id"];
$busca_cuadroC="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$bu_cuadrobm_id."'";
$rs_buscaivaC = $DB_gogess->executec($busca_cuadroC,array());
	?>
    <tr>
      <td height="28" class="css_texto"><div align="center"><?php echo $contador_dd; ?></div></td>
	   <td height="28" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>

      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_buscaivaC->fields["cuadrobm_codigoispol"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_buscaivaC->fields["cuadrobm_descripciontn"]; ?></div></td>

      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo round($valor_total,2); ?></b></div></td>
</tr>
</table>
<br />

INSUMOS

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
       <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"></div></td> 
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Tipo</div></td>    
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO RP</div></td>   
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE RP</div></td>  
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">MEDICAMENTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">V, UNITARIO</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	$total_ivavalor=0;
	$valor_total=0;
	$contador_dd=0;
	//$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuenta.centrob_id in (".$centro_id.",1,9999,8888)";
	
	$lista_precuentas="select detapre_tipo,centro_nombre,detapre_observacion,usua_id,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad ,detapre_precioventa,detapre_fecharegistro,cuadrobm_id from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (2)  group by detapre_detalle order by detapre_tipo asc ";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
  if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     $estado_prec='TARIFARIO';
   
   }
   
    if($rs_lprecuentas->fields["detapre_tipo"]==4)
   {
     $estado_prec='MCGRAW HILL';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuenta'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 

//busca iva

$bu_cuadrobm_id=$rs_lprecuentas->fields["cuadrobm_id"];
$busca_cuadro="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$bu_cuadrobm_id."'";
$rs_buscaiva = $DB_gogess->executec($busca_cuadro,array());

$tari_codigo=0;
$tari_codigo=$rs_buscaiva->fields["tari_codigo"];

$busca_tarifavalor="select * from beko_tarifa where tari_codigo='".$tari_codigo."'";
$rs_tarivalor = $DB_gogess->executec($busca_tarifavalor,array());

$tari_valor=$rs_tarivalor->fields["tari_valor"];

if($tari_valor>0)
{
  $stotal_valorx=$rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"];
  $valor_ivcalculo=$tari_valor/100;
  
  $valor_iva=$stotal_valorx*$valor_ivcalculo;  
  $total_ivavalor=$total_ivavalor+$valor_iva;
}
//busca iva
 $contador_dd++;
 
$bu_cuadrobm_id=$rs_lprecuentas->fields["cuadrobm_id"];
$busca_cuadroC="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$bu_cuadrobm_id."'";
$rs_buscaivaC = $DB_gogess->executec($busca_cuadroC,array());
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center"><?php echo $contador_dd; ?></div></td>
	   <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	   
	   <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_buscaivaC->fields["cuadrobm_codigoispol"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_buscaivaC->fields["cuadrobm_descripciontn"]; ?></div></td>

      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?> </div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">SUBTOTAL</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo round($valor_total,2); ?></b></div></td>
</tr>
<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">IVA</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo round($total_ivavalor,2); ?></b></div></td>
</tr>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">TOTAL</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo round($valor_total+$total_ivavalor,2); ?></b></div></td>
</tr>

</table>


<br />




<div id="campo_valorxx"></div>

<script type="text/javascript">
<!--
function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/precuentagenerada/guarda_campop.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valorxx").html("Espere un momento...");



}

//  End -->
</script>