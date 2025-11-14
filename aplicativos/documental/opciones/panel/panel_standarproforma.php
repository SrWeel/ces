<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
//Llamando objetos
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

} 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";



?>

<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid").load("grif.php",{
  

  },function(result){  


  });  
  $("#grid").html("Espere un momento");  
}



//  End -->
</script>



<style type="text/css">
<!--

.alert-success
{

color:#000033;
background-color:#FFFFFF;
border-color:#ffffff;

}


.alert-success1
{

color:#000033;
background-color:#FFFFFF;
border-color:#000000;

}
.css_titulo {font-weight: bold}

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;

}

-->
</style>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
<div id="lista_manos">
<!-- despliegue -->
<div class="panel panel-default">
 <div class="panel-heading">
    <h3 class="panel-title" style="color:#000033" >PROFORMAS</h3>
 </div>
<div class="panel-body">
  <p>&nbsp;</p>
  
  
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>C&eacute;dula Cliente: </td>
      <td><input name="ci_ciente" type="text" id="ci_ciente" value="" /></td>
      <td><input type="button" name="Submit" value="Buscar" onclick="listar_cliente()" /></td>
    </tr>
  </table>
  <div id="lista_proforma"></div>
  
  
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Historia Clinica </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Paciente</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Codigo Precuenta </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Inicio </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Cierre </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Estado</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Movimiento</div></td>
    </tr>
	<?php
	$lista_precuentas="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id order by precu_fechainicio desc";
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
      <td class="css_texto"><div align="center"><?php echo str_pad($rs_lprecuentas->fields["precu_id"], 10, "0", STR_PAD_LEFT); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechainicio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechafinal"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
      <td class="css_texto" onclick="ver_detalle('<?php echo $rs_lprecuentas->fields["precu_id"]; ?>')" style="cursor:pointer"><div align="center"><img src="images/listados.png" width="32" height="32" /></div></td>
    </tr>
	<?php
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>
  </table>
  <p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>

<div id="divBody_precuenta" ></div>
<!--<div id="lista_clientes"></div>-->

<script type="text/javascript">
<!--

function listar_cliente()
{

 $("#lista_proforma").load("aplicativos/documental/opciones/panel/proformas/listab_cliente.php",{
     ci_ciente:$('#ci_ciente').val()    
  },function(result){  


  });  
  $("#lista_proforma").html("Espere un momento");  

}

//  End -->
</script>


</div>
</div>


<!-- despliegue -->
</div>
</div>
<?php
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>

<SCRIPT LANGUAGE=javascript>
<!--

function ver_detalle(precu_id)
{
   abrir_standar('aplicativos/documental/opciones/panel/precuenta_detalle.php','DETALLES _PRECUENTA','divBody_precuenta','divDialog_precuenta',800,500,precu_id,0,0,0,0,0,0);
}
//-->
</SCRIPT>