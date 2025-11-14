<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$ci_busqueda=$_POST["pVar1"];
$doccab_pgacont=$_POST["pVar2"];

$sql1='';
$sql2='';
if($ci_busqueda)
{
   
  $sql1=" clie_rucci='".$ci_busqueda."' and ";

}
$sqlconcatena=$sql1.$sql2;
$sqlconcatena=substr($sqlconcatena,0,-4);

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
	  <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Historia Clinica </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Paciente</div></td>
	  <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">OBS</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Codigo Precuenta </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Inicio </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Cierre </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Estado</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Agrupado</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo">&nbsp;</td>
    </tr>
	<?php
	
	$lista_precuentas="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where ".$sqlconcatena." and precu_activo=2 and precu_facturar=1 order by precu_id desc limit 1";

	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["precu_activo"]==1)
   {
     $estado_prec='ABIERTO';
   
   }
   else
   {
     $estado_prec='CERRADO';
   
   }
	?>
    <tr>
      
	  <td height="21" class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["clie_rucci"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["clie_nombre"]." ".$rs_lprecuentas->fields["clie_apellido"]; ?></div></td>
	  <td height="21" class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_observacion"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo str_pad($rs_lprecuentas->fields["precu_id"], 10, "0", STR_PAD_LEFT); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechainicio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechafinal"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
      <td class="css_texto" style="cursor:pointer" onclick="ver_detallepragrupado('<?php echo $rs_lprecuentas->fields["precu_id"]; ?>')"><div align="center"><img src="images/listados.png" width="32" height="32" /></div></td>
      <td class="css_texto" style="cursor:pointer" >&nbsp;</td>
    </tr>
	<?php
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>
</table>
<div id="lista_detallesp"></div>
<div id="campo_valor"></div>
<div id="asigna_precuenta"></div>

<script type="text/javascript">
<!--


function ver_detallepragrupado(precu_id)
{
   $("#lista_detallesp").load("templateformsweb/maestro_standar_ventas/lista_dprecuentaag.php",{
    precu_id:precu_id,
	doccab_pgacont:'<?php echo $doccab_pgacont; ?>'
  },function(result){  
      
  });  
  $("#lista_detallesp").html("Espere un momento...");  

}	


function ver_detallepr(precu_id)
{
   $("#lista_detallesp").load("templateformsweb/maestro_standar_ventas/lista_dprecuenta.php",{
    precu_id:precu_id
  },function(result){  
      
  });  
  $("#lista_detallesp").html("Espere un momento...");  

}	

function guardar_campos(tabla,campo,id,valor,campoidtabla,cantidad,clie_id,precu_id,tipo)
{

$("#campo_valor").load("aplicativos/documental/opciones/panel/precuenta/guarda_campo2.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla,
cantidad:cantidad,
clie_id:clie_id,
precu_id:precu_id,
tipo:tipo

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}

//-->
</script> 

<?php
}
?>

