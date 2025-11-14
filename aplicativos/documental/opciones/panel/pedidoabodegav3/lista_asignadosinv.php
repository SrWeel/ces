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
?>

<link href="../../../../../templates/page/menu/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../../../../templates/page/dependencies/bootstrap/css/bootstrap.min.css" type="text/css">

<link type="text/css" href="../../../../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../../../js/ui.mask.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../../../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.fixheadertable.js"></script>
<script src="../../../../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<link type="text/css" href="../../../../../templates/page/css/jquery.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../templates/page/js/jquery.dataTables.min.js"></script> 
<link type="text/css" href="../../../../../templates/page/css/responsive.dataTables.min.css" rel="stylesheet" />	
<link type="text/css" href="../../../../../templates/page/css/buttons.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../templates/page/js/dataTables.responsive.min.js"></script> 
<script type="text/javascript" src="../../../../../templates/page/js/dataTables.buttons.min.js"></script> 

<link rel="stylesheet" type="text/css" href="../../../../../templates/page/css/jquery.datetimepicker.min.css" >

<script src="../../../../../templates/page/js/jquery.datetimepicker.full.min.js"></script>


<?php
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_GET["precu_id"];
$centro_id=$_GET["centro_id"];

$tabla_lista='';

if($centro_id==1)
{
  $centro_id='55';
  $tabla_lista='dns_principalstockactual';
}
else
{
  $tabla_lista='dns_stockactual';
}

echo "<br>";
$lista_bprecuentac="select * from dns_precuenta left join cesdb_arextension.dns_convenios on dns_precuenta.convepr_id=cesdb_arextension.dns_convenios.conve_id where precu_id='".$precu_id."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());

$precu_activo=0;
$precu_activo=$rs_bprecuentac->fields["precu_activo"];

$cuenta_v=0;

$clie_id=$rs_bprecuentac->fields["clie_id"];

//=================================================================

    
	
	$code_redp=0;
	$code_redp=$rs_bprecuentac->fields["conve_redpublica"];
	
	$red_publicaX='NO';
	if($rs_bprecuentac->fields["conve_redpublica"]==1)
	{
	  $red_publicaX='SI';
	}

//=================================================================

$busca_clientec="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	

?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php
echo "<b>PACIENTE:</b> ".$rs_bclientec->fields["clie_nombre"].' '.$rs_bclientec->fields["clie_apellido"]."<br>";
echo "<b>CONVENIO:</b> ".$rs_bprecuentac->fields["conve_nombre"]."<br>";
echo "<b>RED PUBLICA:</b> ".$red_publicaX."<br>";	  
	  ?></td>
    </tr>
  </table>


<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<br /><br />
<?php
$lista_precuentaslbdega="select distinct centrob_id from dns_preddetalleprecuentav left join dns_centrosalud_origen on dns_preddetalleprecuentav.centrob_id=dns_centrosalud_origen.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) ";
 
 $rs_lprecuentasbdega = $DB_gogess->executec($lista_precuentaslbdega,array());

 if($rs_lprecuentasbdega)
 {

	  while (!$rs_lprecuentasbdega->EOF) {  
	  
	  $centro_disposentrecentros=$objformulario->replace_cmb("dns_centrosalud_origen","centro_id,centro_nombre"," where centro_id=",$rs_lprecuentasbdega->fields["centrob_id"],$DB_gogess);

?>
  
  
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Solicita de </div></td> 
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">AREA</div></td> 
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>       
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">C&oacute;digo</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad Pedida</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad Entregada </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad Pediente </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Stock Actual Bodega Principal</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Estado</div></td>
    </tr>
	<?php
	$valor_total=0;
	//$lista_precuentas="select * from dns_preddetalleprecuentav left join dns_centrosalud on dns_preddetalleprecuentav.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_preddetalleprecuentav.centrob_id in (".$centro_id.",1,9999,8888)";
	
 $lista_precuentas="select * from dns_preddetalleprecuentav left join dns_centrosalud_origen on dns_preddetalleprecuentav.centrob_id=dns_centrosalud_origen.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and centrob_id='".$rs_lprecuentasbdega->fields["centrob_id"]."'";
	
$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());
 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  
	  //busca si ya entrego
		
		//$busca_entregado="select sum(detapre_cantidad) as cantidad_val from dns_detalleprecuenta where precu_id='".$precu_id."' and detapreoper_id='".$rs_lprecuentas->fields["detapre_id"]."'";
		
		$busca_entregado="select sum(detapre_cantidad) as cantidad_val from dns_detalleprecuenta where areap_id>0 and precu_id='".$precu_id."' and detapreoper_id='".$rs_lprecuentas->fields["detapre_id"]."'";
		
		$rs_okentreg = $DB_gogess->executec($busca_entregado,array());		
		$cantidad_val=$rs_okentreg->fields["cantidad_val"];
		
	  //busca si ya entrego	

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_preddetalleprecuentav'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   $pendiente=$rs_lprecuentas->fields["detapre_cantidad"]-$cantidad_val;
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 
   $cuenta_v++;
   
   
   $area_id=$rs_lprecuentas->fields["area_id"];
   
   $busca_area="select * from lpin_area where area_id='".$area_id."'";
   $rs_barea= $DB_gogess->executec($busca_area,array());
   $narea_v='';
   $narea_v=$rs_barea->fields["area_nombre"];
   
   
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
        <?php echo $cuenta_v; ?>
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"].' '.$rs_lprecuentas->fields["detapre_origen"]; ?></div></td>
	  
	  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $narea_v; ?></div></td>
	  
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>   
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  
	  
//$ncampo_val='detapre_observacion';
//echo '<input name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_camposzz('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';
			
					
	  
	  ?>	  
	  </div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	    <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $cantidad_val; ?></div></td>
		
		 <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $pendiente; ?></div></td>
     <!-- <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td> -->
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
	  
	  <td class="css_texto" style="font-size:10px" ><div align="center">
	 <?php
	 $stockactual="select sum(stock_cantidad*stock_signo) as stactual from ".$tabla_lista." where centro_id='".$centro_id."' and cuadrobm_id='".$rs_lprecuentas->fields["cuadrobm_id"]."'";
	 $rs_stactua = $DB_gogess->executec($stockactual);
	 
	 echo $rs_stactua->fields["stactual"]."<br>"; 
	 if($rs_stactua->fields["stactual"]>=$rs_lprecuentas->fields["detapre_cantidad"])
	 {	 
	    echo "Disponible para descargo";
	 }
	 else
	 {
	    echo '<span style="color:#FF0000">No disponible en Bodega</span>';	 
	 }
	?>
		</div></td>	
		
		<?php
		$color='';
		$mensaje_data='';
		if($pendiente>0)
		{
		   $color=' bgcolor="#F1B4D1" ';
		   $mensaje_data='<b>PENDIENTE</b>';
		}
		else
		{
		   
		   $color=' bgcolor="#C4F4D2" ';
		   $mensaje_data='<b>ENTREGADO</b>';
		}
		
		?>
		<td class="css_texto" style="font-size:10px" <?php echo $color; ?> ><div align="center">
		
		<?php echo $mensaje_data; ?>
		
		</div></td>	
					
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
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td> 
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b>&nbsp;</b></div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>
<br />
<!-- <input type="button" name="Submit" value="PROCESAR PEDIDO A <?php echo $centro_disposentrecentros; ?>" onclick="procesa_data_pboega('<?php echo $rs_lprecuentasbdega->fields["centrob_id"]; ?>','<?php echo $precu_id; ?>')" />  -->

<?php
$busca_asigancion="select * from dns_precuenta where asg_pedido='".$precu_id."'";
$rs_pasignacion = $DB_gogess->executec($busca_asigancion);

if($rs_pasignacion->fields["precu_id"]>0)
{

echo "ASIGNADO A PRECUENTA NUMERO: ".$rs_pasignacion->fields["precu_id"]."<br>";

$busca_datax="select * from app_cliente where clie_id='".$rs_pasignacion->fields["clie_id"]."'";
$rs_udatax = $DB_gogess->executec($busca_datax,array());

echo "PACIENTE: ".$rs_udatax->fields["clie_nombre"]." ".$rs_udatax->fields["clie_apellido"];

}
//else
//{
?>

 <table width="200" border="0" align="center" cellpadding="0" cellspacing="0" class="display responsive cell-border" >
    <tr>
      <td><div align="center">CI PACIENTE</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><input name="ci_paciente" type="text" id="ci_paciente"  class="form-control" value="<?php echo $rs_bclientec->fields["clie_rucci"]; ?>"  readonly="" /></td>
            <td>&nbsp;</td>
            <td><input type="button" name="Submit2" value="OK" onclick="desplegar_precuenta_real()" style="height:30px" /></td>
          </tr>
        </table>
        </div></td>
    </tr>
  </table>
  

  
<?php
//}
?>  

<div id="lsta_precuenta"></div>

<div id="area_data_procesa" ></div>

<hr />
<br /><br />
<?php
           $rs_lprecuentasbdega->MoveNext();	   

	  }
  }

?>

<br />

<br /><br />

  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center">__________________________________</div></td>
      <td>&nbsp;</td>
      <td><div align="center">__________________________________</div></td>
    </tr>
    <tr>
      <td><div align="center">FIRMA SOLICITANTE </div></td>
      <td>&nbsp;</td>
      <td><div align="center">FIRMA BODEGA </div></td>
    </tr>
    <tr>
      <td><div align="center">NOMBRE:</div></td>
      <td>&nbsp;</td>
      <td><div align="center">NOMBRE:</div></td>
    </tr>
  </table>
  <div id="campo_valorxx"></div>

<script type="text/javascript">
<!--

function procesa_data_redpu(bodega,precu_id,clie_id)
{
$('#ejecuta_datax').html(''); 

$("#area_data_procesa").load("procesa_dataenviorp.php",{
   centrob_id:bodega,
   precu_id:precu_id,
   clie_id:clie_id,
   code_redp:'<?php echo $code_redp; ?>'

 },function(result){   
 
       

  });  

$("#area_data_procesa").html("Espere un momento...");


}


function procesa_data_pboega(bodega,precu_id,clie_id)
{
$('#ejecuta_datax').html(''); 

$("#area_data_procesa").load("procesa_dataenvio.php",{
   centrob_id:bodega,
   precu_id:precu_id,
   clie_id:clie_id,
   code_redp:'<?php echo $code_redp; ?>'

 },function(result){   
 
       

  });  

$("#area_data_procesa").html("Espere un momento...");


}


function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/pedidoabodega/guarda_campop.php",{

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

<script type="text/javascript">
<!--
function desplegar_precuenta_real()
{
  if($('#ci_paciente').val()=='')
  {
     alert("Ingrese la cedula del paciente");
     return false;
  }
  
   $("#lsta_precuenta").load("precuenta_real.php",{
      
	  ci_paciente:$('#ci_paciente').val(),
      precu_id:'<?php echo $precu_id; ?>',
	  centro_id:'<?php echo $centro_id; ?>'
	  
  },function(result){  


  });  
  $("#lsta_precuenta").html("Espere un momento");  
}

//  End -->
</script>