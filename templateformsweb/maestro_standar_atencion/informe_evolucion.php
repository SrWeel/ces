<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{
$objformulario= new  ValidacionesFormulario();
$comillasimple="'";

$clie_id=$_POST["pVar1"];
$atenc_id=$_POST["pVar2"];

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

$datos_usuario="select * from  app_usuario where usua_id=".$_SESSION['ces1313777_sessid_inicio'];
$rs_usuario = $DB_gogess->executec($datos_usuario,array());


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$rs_usuario->fields["centro_id"],$DB_gogess);
?>
<script type="text/javascript">
<!--

function ver_ingresodata(eteneva_id)
{

$("#informe_datavalor").load("templateformsweb/maestro_standar_atencion/ingresar_infoevolucion.php",{
eteneva_id:eteneva_id,
usua_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'
 },function(result){       


  });  
$("#informe_datavalor").html("Espere un momento...");

}

//  End -->
</script>

<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }

.TableScroll_evo {
        z-index:99;
		width:620px;
        height:110px;	
        overflow: auto;
      }

-->
</style>

<div class="TableScroll_evo" >
<table width="600" border="1" align="center" cellpadding="4" cellspacing="1">
  <tr>
    <td bgcolor="#CCDBE3" class="Estilo4"><div align="center">Reporte</div></td>
	<td bgcolor="#CCDBE3" class="Estilo4"><div align="center">Fecha de Entrega </div></td>
    <td bgcolor="#CCDBE3" class="Estilo4"><div align="center">Observacion</div></td>
    <td bgcolor="#CCDBE3" class="Estilo4"><div align="center">Reactivos Realizados</div></td>
    <td bgcolor="#CCDBE3" class="Estilo4"><div align="center">Facturado</div></td>
  </tr>
  <?php
  $reactivos="";
 $cuenta=0;
 $lista_servicios="select * from dns_atencionevaluacion where atenc_enlace='".$rs_atencion->fields['atenc_enlace']."' and centro_id='".$rs_usuario->fields["centro_id"]."'  order by eteneva_id desc";
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
    $reactivos="";
  if($rs_data->fields["eteneva_ps"]=='true')
	{
     $reactivos.="Psicolog&iacute;a - ";
    }
  
  if($rs_data->fields["eteneva_p"]=='true')
	{  
	
	$reactivos.="Pedagog&iacute;a - ";
	}

if($rs_data->fields["eteneva_l"]=='true')
	{
	$reactivos.="Lenguaje - ";
	
	}	

if($rs_data->fields["eteneva_tf"]=='true')
	{
	$reactivos.="Terapia F&iacute;sica - ";
	}
  
  ?>
  <tr>
    <td class="Estilo2" onClick="ver_ingresodata('<?php echo $rs_data->fields["eteneva_id"]; ?>')" style="cursor:pointer"  ><div align="center"><img src="images/informev.png" width="20" height="25" /></div></td>
    <td class="Estilo2"><div align="center"><?php echo $rs_data->fields["eteneva_fechaentrega"]; ?></div></td>
    <td class="Estilo2"><div align="center"><?php echo $rs_data->fields["eteneva_observacion"]; ?></div></td>
    <td class="Estilo2"><div align="center"><?php echo $reactivos; ?></div></td>
    <td class="Estilo2"><div align="center"><?php echo $rs_data->fields["eteneva_numfactura"]; ?></div></td>
  </tr>
  <?php
       $rs_data->MoveNext();	   
	  }
  }
  
  ?>  
  
</table>
</div>


<div id="informe_datavalor"></div>

<div id="informe_g"></div>
<?php
}			
else
{
echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';
	
}

?>