<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$partop_id=$_POST["partop_id"];
$clie_id=$_POST["partop_id"];


$lista_usv="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];

$usua_permitepedido=$rs_usv->fields['usua_permitepedido'];

?>
<br>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#C0D8E2"><div align="center"><b>CODIGO</b></div></td>
	<td bgcolor="#E9F1F5"><div align="center">SALA</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA</div></td>
    <td bgcolor="#E9F1F5"><div align="center">HORA</div></td>
    <td bgcolor="#E9F1F5"><div align="center">HAB</div></td>
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">EDAD</div></td>
	<td bgcolor="#E9F1F5"><div align="center">PROCEDIMIENTO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CIRUJANO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">AYUDANTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">T. QUIROFANO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">ANESTESIOLOGO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">TEAM QX</div></td>
	<td bgcolor="#E9F1F5"><div align="center">DESTINO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
	<td bgcolor="#E9F1F5"><div align="center">SEGURO</div></td>
  </tr>
<?php
$convepr_id=0;

if($usua_permitepedido==1 or $_SESSION['ces1313777_sessid_inicio']==284 or $_SESSION['ces1313777_sessid_inicio']==295 or $_SESSION['ces1313777_sessid_inicio']==515)
{
$lista_bprecuenta="select * from lpin_parteoperatorio left join cesdb_arextension.dns_convenios on lpin_parteoperatorio.convepr_id=cesdb_arextension.dns_convenios.conve_id where partop_id='".$partop_id."'";

}
else
{
$lista_bprecuenta="select * from lpin_parteoperatorio left join cesdb_arextension.dns_convenios on lpin_parteoperatorio.convepr_id=cesdb_arextension.dns_convenios.conve_id where partop_id='".$partop_id."' and partop_estado=1";

}

$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	

$convepr_id=$rs_bprecuenta->fields["convepr_id"];



	?>

  <tr>
    <td bgcolor="#C0D8E2"><div align="center"><b><?php echo $rs_bprecuenta->fields["partop_id"]; ?></b></div></td>
    <td><div align="center"><?php echo $rs_bprecuenta->fields["partop_sala"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_fecha"]; ?></div></td>
    <td><div align="center"><?php echo $rs_bprecuenta->fields["partop_hora"]; ?></div></td>
    <td><div align="center"><?php echo $rs_bprecuenta->fields["partop_hab"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_paciente"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_edad"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_procedimiento"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_cirujano"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_ayudante"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_tquirofano"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_anesteciologo"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_teamqx"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_destino"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["partop_observacion"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["conve_nombre"]; ?></div></td>	
	
  </tr>

	 
	 <?php	
	
	   $rs_bprecuenta->MoveNext();	
	}	
} 


$verifica_redpu=0;

if($convepr_id==7 or $convepr_id==22 or $convepr_id==27 or $convepr_id==28)
{
  $verifica_redpu=1;

}
	
?>
</table>
<?php
if($verifica_redpu==1)
{
 echo "<br><center><b>RED PUBLICA</b></center>";
}
?>
<br><br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">
      Para la bodega:
	   <select name="centro_id " id="centro_id"  class="form-control" onchange="desplegar_listainventario()">
        <?php
	         echo '<option value="">---Seleccionar--</option>';
			 //if($verifica_redpu==1)
			 //{
			   //$objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id=29 order by centro_id asc ",$DB_gogess);	
			 //}
			// else
			 //{
			   $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id=1 order by centro_id asc ",$DB_gogess);	
			// }
	  ?>
      </select>  
	</td>
  </tr>
  <tr>
    <td>Buscar:
    <input name="b_data" type="text" id="b_data" value="" /></td>
    <td><input type="button" name="Submit" value="DESPLEGAR" onclick="desplegar_listainventario()" /></td>
  </tr>
  <tr>
    <td colspan="2"><br /><div align="center">
      <input name="fecha_desc" type="hidden" id="fecha_desc" value="<?php echo date("Y-m-d"); ?>" class="form-control"  />
    </div></td>
  </tr>
</table>

<div align="right"><br>
<?php
if($usua_permitepedido==1 or $_SESSION['ces1313777_sessid_inicio']==284 or $_SESSION['ces1313777_sessid_inicio']==295 or $_SESSION['ces1313777_sessid_inicio']==515)
{
?>
 <input type="button" name="Submit2" value="Tomar Inventario Pedido" onclick="tomainv_doc()" /> &nbsp;&nbsp;&nbsp;
<?php
}
?> 
  <input type="button" name="Submit2" value="Imprimir" onclick="imprimir_doc()" />
  <input type="button" name="Submit2" value="Excel" onclick="imprimir_docexcel()" />
</div>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="52%" valign="top"><div id="lista_bodega" class="TableScroll_lista"></div></td>
    <td width="48%" valign="top"><div id="lista_asignado" class="TableScroll_lista"></div></td>
  </tr>
</table>


<!--
<center>TARIFARIO</center>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top"><div id="lista_tarfario" class="TableScroll_lista"></div></td>
    <td width="50%" valign="top"><div id="lista_tarasignado" class="TableScroll_lista"></div></td>
  </tr>
</table>

-->

<div id="p_borrar"></div>
<div id="divBody_pdespacho"></div>
<br /><br />
<!--

-->

<script type="text/javascript">
<!--

function tomainv_doc() {

if($('#centro_id').val()=='')
{
  alert("Porfavor seleccione la bodega");
  return false;
}

window.open('aplicativos/documental/opciones/panel/pedidoabodegav2/lista_asignadosinv.php?partop_id=<?php echo $partop_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}

function imprimir_doc() {
window.open('aplicativos/documental/opciones/panel/pedidoabodegav2/lista_asignadosimp.php?partop_id=<?php echo $partop_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}

function imprimir_docexcel() {
window.open('aplicativos/documental/opciones/panel/pedidoabodegav2/lista_asignadosimp.php?excel=1&partop_id=<?php echo $partop_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}


function lista_cmb()
{

   if($('#centrotx_id').val()=='')
   {
     alert("Seleccione el origen...");
     return false;
   }

   $("#lista_mediext").load("aplicativos/documental/opciones/panel/pedidoabodegav2/cmb_listamed.php",{
      
	  centro_id:$('#centrotx_id').val(),
	  b_data:$('#bucsa_med').val(),
	  partop_id:'<?php echo $partop_id; ?>'

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_mediext").html("Espere un momento");  

}



function ejecuta_despachar(cuadrobm_id,centro_id,maximop,clie_id)
{
	
   
  
  abrir_standar("aplicativos/documental/opciones/panel/pedidoabodegav2/lotes.php","Despacho","divBody_pdespacho","divDialog_pdespacho",580,500,'<?php echo $partop_id; ?>','lpin_parteoperatorio',centro_id,'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>','<?php echo $clie_id; ?>',maximop,cuadrobm_id);
  
  
  
}

function desplegar_listainventario()
{
  if($('#centro_id').val()=='')
  {
     alert("Seleccione la bodega");
     return false;
  }
  
   $("#lista_bodega").load("aplicativos/documental/opciones/panel/pedidoabodegav2/lista_medinsu.php",{
      
	  centro_id:$('#centro_id').val(),
	  b_data:$('#b_data').val(),
	  clie_id:'<?php echo $clie_id; ?>',
	  verifica_redpu:'<?php echo $verifica_redpu; ?>'

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_bodega").html("Espere un momento");  
}


function desplegar_listatarifario()
{
  
   $("#lista_tarfario").load("aplicativos/documental/opciones/panel/pedidoabodegav2/lista_tarifario.php",{
      

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_tarfario").html("Espere un momento");  
}


function desplegar_asignados()
{

   $("#lista_asignado").load("aplicativos/documental/opciones/panel/pedidoabodegav2/lista_asignados.php",{
      
	  partop_id:'<?php echo $partop_id; ?>',
	  centro_id:$('#centro_id').val()

  },function(result){  


  });  
  $("#lista_asignado").html("Espere un momento");  
}

function desplegar_asignadostarifatio()
{

   $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/pedidoabodegav2/lista_asignadostar.php",{
      
	  partop_id:'<?php echo $partop_id; ?>'

  },function(result){  


  });  
  $("#lista_tarasignado").html("Espere un momento");  
}


desplegar_asignados();
//desplegar_asignadostarifatio();

function asgnar_prdetalle(prod_id,centro_id)
{

if($('#cantidp_'+prod_id).val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }

 $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/pedidoabodegav2/asignar_gtar.php",{
      
	  partop_id:'<?php echo $partop_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  prod_id:prod_id,
	  cantidad:$('#cantidp_'+prod_id).val(),
	  centro_id:centro_id

  },function(result){  

desplegar_asignadostarifatio();

  });  
  $("#lista_tarasignado").html("Espere un momento"); 


}


function asgnar_detalle(cuadrobm_id,centro_id,maximop,clie_id)
{

 var maximovalor;
 
 maximovalor=parseFloat(maximop);

 if($('#cantid_'+cuadrobm_id).val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }
 
 if($('#cantid_'+cuadrobm_id).val()>maximovalor)
 {
    alert("Cantidad supera al stock actual...");
   return false;
 
 }

 $("#lista_asignado").load("aplicativos/documental/opciones/panel/pedidoabodegav2/asignar_g.php",{
      
	  partop_id:'<?php echo $partop_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  cuadrobm_id:cuadrobm_id,
	  cantidad:$('#cantid_'+cuadrobm_id).val(),
	  centro_id:centro_id,
	  maximop:maximop,
	  centro_id:centro_id

  },function(result){  

//desplegar_asignados();

  });  
  $("#lista_asignado").html("Espere un momento"); 

}

function borrar_asigx(detapre_id)
{

if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/pedidoabodegav2/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignados();
desplegar_listainventario();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}



function borrar_asigtar(detapre_id)
{

let text;
if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/pedidoabodegav2/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignadostarifatio();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}

desplegar_listainventario();

//desplegar_listatarifario();

//  End -->
</script>

<script language="javascript">
    <!--
	 $("#fecha_desc").datepicker({dateFormat: 'yy-mm-dd'});
	 
	 //-->
</script>