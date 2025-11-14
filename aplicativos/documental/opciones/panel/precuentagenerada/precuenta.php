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

$ci_paciente=$_POST["ci_paciente"];


$lista_usv="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];
?>
<br>
<input name="pr_seleccionado" type="hidden" id="pr_seleccionado" value="0" />
<input name="clie_seleccionado" type="hidden" id="clie_seleccionado" value="0" />
<input name="atenc_seleccionado" type="hidden" id="atenc_seleccionado" value="0" />

 
 
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E9F1F5"><div align="center">CI</div></td>
     <td bgcolor="#E9F1F5"><div align="center">Codigo Precuenta</div></td>	
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CONVENIO</div></td>
    <td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA INICIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA FIN</div></td>
	<td bgcolor="#E9F1F5"><div align="center">ESTADO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FACTURAR</div></td>
	<td bgcolor="#E9F1F5"><div align="center">SELECCIONAR</div></td>
  </tr>
<?php
 $comulla_simple="'";
 $tabla_valordata="";
 $tabla_valordata="'dns_precuenta'";
  
$lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where (clie_rucci='".$ci_paciente."' or clie_nombre like '%".$ci_paciente."%'  or clie_apellido like '%".$ci_paciente."%' )  order by precu_id desc";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	$precu_id=$rs_bprecuenta->fields["precu_id"];
	$atenc_enlace=$rs_bprecuenta->fields["atenc_enlace"];
	
	$lista_aten="select * from dns_atencion where atenc_enlace='".$atenc_enlace."'";
	$rs_aten = $DB_gogess->executec($lista_aten,array());
	
	$atenc_id=$rs_aten->fields["atenc_id"];
	$e_estado='';
	$e_estadof='';
	if($rs_bprecuenta->fields["precu_activo"]=='2')
	{
	$e_estado='CERRADO';
	}
	
	if($rs_bprecuenta->fields["precu_activo"]=='1')
	{
	$e_estado='ABIERTO';
	}
	
	if($rs_bprecuenta->fields["precu_facturar"]=='1')
	{
	$e_estadof='PARA FACTURAR';
	}
	
	$lista_txt=$rs_bprecuenta->fields["precu_observacion"]." Fi:".$rs_bprecuenta->fields["precu_fechainicio"]." Ff:".$rs_bprecuenta->fields["precu_fechafinal"];
	
	
	$campo_valor="";
	$campo_valor="'precu_id'";
	$ide_producto='precu_id';
	$ncampo_val='dns_precuenta';
	
	
	$convepr_id=$rs_bprecuenta->fields["convepr_id"];
	$lista_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}
	?>

  <tr>
    <td><?php echo $rs_bprecuenta->fields["clie_rucci"]; ?></td>
	<td><div align="center"><?php echo str_pad($rs_bprecuenta->fields["precu_id"], 10, "0", STR_PAD_LEFT); ?></div></td>
	<td><?php echo $rs_bprecuenta->fields["clie_nombre"].' '.$rs_bprecuenta->fields["clie_apellido"]; ?></td>
	<td><?php echo $rs_conve->fields["conve_nombre"].' RED PUBLICA: <b>'.$red_publica.'</b>'; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_observacion"]; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_fechainicio"]; ?></td>
	 <td><?php echo $rs_bprecuenta->fields["precu_fechafinal"]; ?></td>
	 
	<td>
	<?php
	$ncampo_val='precu_activo';

	echo '<select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'"  onChange="guardar_campost('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_bprecuenta->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
    <option value="" >--Tipo--</option>';
    $objformulario->fill_cmb('dns_estadoprecuenta','estap_id,estap_nombre',$rs_bprecuenta->fields[$ncampo_val],'',$DB_gogess);
    echo '</select>';
		
	?>
	</td> 
	 
	<td>
	<?php
	$ncampo_val='precu_facturar';

	echo '<select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'"  onChange="guardar_campost('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_bprecuenta->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
    <option value="" >--Tipo--</option>';
    $objformulario->fill_cmb('dns_estadofactura','estapf_id,estapf_nombre',$rs_bprecuenta->fields[$ncampo_val],'',$DB_gogess);
    echo '</select>';
		
	?>
	</td> 
	
	 <td>
     <input type="button" name="Submit5" value="Seleccionar" onclick="seleccioanr_data('<?php echo $precu_id; ?>','<?php echo $clie_id; ?>','<?php echo $atenc_id; ?>','<?php echo $lista_txt; ?>')" /></td>
  </tr>

	 
	 <?php	
	
	   $rs_bprecuenta->MoveNext();	
	}	
} 	
?>
</table>

<br><br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">Bodega:
      <select name="centro_id " id="centro_id"  class="form-control" >
        <?php
	         echo '<option value="">---Seleccionar--</option>';
			 $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id!=1 order by centro_id asc ",$DB_gogess);	
			 
	  ?>
      </select>    </td>
  </tr>
  <tr>
    <td>Buscar:
    <input name="b_data" type="text" id="b_data" value="" /></td>
    <td><input type="button" name="Submit" value="DESPLEGAR" onclick="desplegar_listainventario()" /></td>
  </tr>
  <tr>
    <td colspan="2"><br /><div align="center">
      <input name="fecha_desc" type="text" id="fecha_desc" value="<?php echo date("Y-m-d"); ?>" class="form-control"  />
    </div></td>
  </tr>
</table>
<b><div id="detalle_det" align="center"></div></b>
<div align="right"><br>
  <input type="button" name="Submit2" value="Imprimir" onclick="imprimir_doc()" />
  <input type="button" name="Submit2" value="Excel" onclick="imprimir_docexcel()" /> 
  &nbsp;&nbsp;&nbsp;
  <input type="button" name="Submit2" value="Imprimir Resumen" onclick="imprimir_docresumen()" />  
  <input type="button" name="Submit2" value="Imprimir Resumen Excel" onclick="imprimir_docresumenexcel()" />
  
  
</div>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="52%" valign="top"><div id="lista_bodega" class="TableScroll_lista"></div></td>
    <td width="48%" valign="top"><div id="lista_asignado" class="TableScroll_lista"></div></td>
  </tr>
</table>


<div id="p_borrar"></div>
<div id="divBody_pdespacho"></div>
<br /><br /><table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Buscar Med/Insumo:<input name="bucsa_med" type="text" id="bucsa_med" />
      <input type="button" name="Submit3" value="Buscar" onclick="lista_cmb()" />
      <br /><br /></td>
  </tr>
    <tr>
    <td>
	Origen:<select name="centrotx_id " id="centrotx_id"  class="form-control" onchange="lista_cmb()" >
      <?php
	         echo '<option value="">---Seleccionar--</option>';
			 $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id=1 order by centro_id asc ",$DB_gogess);
			  echo '<option value="9999">COMPRA EXTERNA</option>';
			   echo '<option value="8888">VARIOS</option>';	
	  ?>
	  
    </select></td>
	
  </tr>
  <tr>
    <td>
	<div id="lista_mediext"></div>
	</td>
	
  </tr>
</table>
<hr />
<br /><br />



<center>TARIFARIO PRODUCTOS Y SERVICIOS CL&Iacute,NICA DE ESPECIALIDADES DEL SUR</center>


<input name="b_tarifario" type="text" id="b_tarifario" />
<input type="button" name="Submit4" value="Listar Tarifario" onclick="desplegar_listatarifario()" />
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top"><div id="lista_tarfario" class="TableScroll_lista"></div></td>
    <td width="50%" valign="top"><div id="lista_tarasignado" class="TableScroll_lista"></div></td>
  </tr>
</table>

<hr />
<br /><br />
<center>TARIFARIO MCGRAW HILL</center>
<div class="col-sm-12"> 
	<div id="hill_btn" ><div onClick="hill_ver()" style="cursor:pointer" ><img src="images/hill.png"></div></div>
</div>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top"><div id="lista_hgasignado" class="TableScroll_lista"></div></td>
  </tr>
</table>

<div id="divBody_insumo" ></div>
<div id="campo_valorpr"></div>

<script type="text/javascript">
<!--


function guardar_campost(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorpr").load("aplicativos/documental/opciones/panel/precuentagenerada/guarda_campoppre.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){ 


  });  

$("#campo_valorpr").html("Espere un momento...");

}

function seleccioanr_data(precu_id,clie_id,atenc_id,txt)
{
 $('#pr_seleccionado').val(precu_id);
 $('#clie_seleccionado').val(clie_id);
 $('#atenc_seleccionado').val(atenc_id);
 
 $('#detalle_det').html(txt);
 
 alert("Selecciono una precuenta asegurese que este cerrada y que sea del paciente solicitado");
 desplegar_asignadoshg();
 desplegar_asignados();
 desplegar_asignadostarifatio();

}

function desplegar_asignadostarifatio()
{

   $("#lista_hgasignado").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadostar.php",{
      
	  precu_id:$('#pr_seleccionado').val()

  },function(result){  


  });  
  $("#lista_hgasignado").html("Espere un momento");  
}

function hill_ver()
{
abrir_standar("aplicativos/documental/opciones/panel/precuentagenerada/mghill.php","TARIFARIO","divBody_insumo","divDialog_insumo",900,600,$('#pr_seleccionado').val(),0,0,0,0,0,0);
}


function imprimir_doc() {

if($('#pr_seleccionado').val()>0)
{
window.open('aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadosimpc.php?precu_id='+$('#pr_seleccionado').val()+'&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');
}
else
{
  alert("Seleccione la precuenta");
}


}

function imprimir_docresumen() {

if($('#pr_seleccionado').val()>0)
{
window.open('aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadosimpcr.php?precu_id='+$('#pr_seleccionado').val()+'&centro_id='+$('#centro_id').val(),'ventana4','width=750,height=500,scrollbars=YES');
}
else
{
  alert("Seleccione la precuenta");
}


}

function imprimir_docresumenexcel() {

if($('#pr_seleccionado').val()>0)
{
window.open('aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadosimpcr.php?excel=1&precu_id='+$('#pr_seleccionado').val()+'&centro_id='+$('#centro_id').val(),'ventana41','width=750,height=500,scrollbars=YES');
}
else
{
  alert("Seleccione la precuenta");
}


}


function imprimir_docexcel() {

if($('#pr_seleccionado').val()>0)
{
window.open('aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadosimpc.php?excel=1&precu_id='+$('#pr_seleccionado').val()+'&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');
}
else
{
  alert("Seleccione la precuenta");
}


}

function lista_cmb()
{

   if($('#centrotx_id').val()=='')
   {
     alert("Seleccione el origen...");
     return false;
   }

   $("#lista_mediext").load("aplicativos/documental/opciones/panel/precuentagenerada/cmb_listamed.php",{
      
	  centro_id:$('#centrotx_id').val(),
	  b_data:$('#bucsa_med').val(),
	  precu_id:$('#pr_seleccionado').val()

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_mediext").html("Espere un momento");  

}



function ejecuta_despachar(cuadrobm_id,centro_id,maximop,clie_id)
{
	
  
  abrir_standar("aplicativos/documental/opciones/panel/precuentagenerada/lotes.php","Despacho","divBody_pdespacho","divDialog_pdespacho",580,500,$('#pr_seleccionado').val(),'dns_precuenta',centro_id,'<?php echo $_SESSION['datafrank1109_sessid_inicio']; ?>',$('#clie_seleccionado').val(),maximop,cuadrobm_id);
  
}


function desplegar_listainventario()
{
  if($('#centro_id').val()=='')
  {
     alert("Seleccione la bodega");
     return false;
  }
  
   $("#lista_bodega").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_medinsu.php",{
      
	  centro_id:$('#centro_id').val(),
	  b_data:$('#b_data').val(),
	  clie_id:$('#clie_seleccionado').val()

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_bodega").html("Espere un momento");  
}


function desplegar_listatarifario()
{
  if($('#clie_seleccionado').val()>0)
  {
  
   $("#lista_tarfario").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_tarifario.php",{
      
    b_tarifario:$('#b_tarifario').val(),
	clie_id:$('#clie_seleccionado').val()
	
  },function(result){  

     desplegar_asignadostarifatio();
  });  
  $("#lista_tarfario").html("Espere un momento");  
  
  }
  else
  {
    alert("Seleccione el cliente por favor...");
  
  }
}


function desplegar_asignados()
{

   $("#lista_asignado").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_asignados.php",{
      
	  precu_id:$('#pr_seleccionado').val(),
	  centro_id:$('#centro_id').val()

  },function(result){  


  });  
  $("#lista_asignado").html("Espere un momento");  
}

function desplegar_asignadostarifatio()
{

   $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadostar.php",{
      
	  precu_id:$('#pr_seleccionado').val()

  },function(result){  


  });  
  $("#lista_tarasignado").html("Espere un momento");  
}

function desplegar_asignadoshg()
{

   $("#lista_hgasignado").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_asignadohg.php",{
      
	  precu_id:$('#pr_seleccionado').val()

  },function(result){  


  });  
  $("#lista_hgasignado").html("Espere un momento");  
}



//desplegar_asignadostarifatio();

function asgnar_prdetalle(prod_id,centro_id)
{

if($('#cantidp_'+prod_id).val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }

 $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/precuentagenerada/asignar_gtar.php",{
      
	  precu_id:$('#pr_seleccionado').val(),
	  clie_id:$('#clie_seleccionado').val(),
	  atenc_id:$('#atenc_seleccionado').val(),
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

 $("#lista_asignado").load("aplicativos/documental/opciones/panel/precuentagenerada/asignar_g.php",{
      
	  precu_id:$('#pr_seleccionado').val(),
	  clie_id:$('#clie_seleccionado').val(),
	  atenc_id:$('#atenc_seleccionado').val(),
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
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuentagenerada/borrar_g.php",{
      
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
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuentagenerada/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignadostarifatio();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}




function borrar_asighg(detapre_id)
{

let text;
if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuentagenerada/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignadoshg();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}


function borrar_asigxprincipal(detapre_id)
{

if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuentagenerada/borrar_gprincipal.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignados();
desplegar_listainventario();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}




//  End -->
</script>

<script language="javascript">
    <!--
	 $("#fecha_desc").datepicker({dateFormat: 'yy-mm-dd'});
	 
	 //-->
</script>