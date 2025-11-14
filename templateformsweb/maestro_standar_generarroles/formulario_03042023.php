<?php

$objformulario->react_id=$react_id;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
            $valoralet=mt_rand(1,50000);
			$aletorioid='02'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["genr_enlacex"]=$aletorioid;
			$objformulario->sendvar["genr_aniox"]=date("Y");
			$objformulario->sendvar["genr_mesx"]=date("m");
			


$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

?>
<center>
<input type="button" name="Button" value="GENERAR ROLES" onclick="genera_datos()" /><br /><br /><br />

<table width="470" border="0">
  <tr>
    <td colspan="5"><div align="center">CEDULA: 
      <input name="valcedula_val" type="text" id="valcedula_val" />
    </div></td>
  </tr>
  
   <tr>
    <td colspan="5">
&nbsp;&nbsp;&nbsp;	</td>
   </tr>
  
   <tr>
    <td colspan="5">
&nbsp;&nbsp;&nbsp;	</td>
   </tr>
   
   	
  <tr>
    <td><?php
echo '<div onclick="ver_datos()" style="cursor:pointer"  ><img src="images/pdfrol.png" border="0"  /></a></center>';
?></td>
    <td width="400" >&nbsp;</td>
    <td>&nbsp;</td>

    <td width="400" >&nbsp;</td>
    <td><?php
echo '<div onclick="envia_correo()" style="cursor:pointer"  ><img src="images/mailrol.png" border="0"  /></a></center>';
?></td>
  </tr>
  

  <tr>
    <td>
	<?php
	echo '<div onclick="ver_datosconsolidado()" style="cursor:pointer"  ><img src="images/xlsrol.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick="ver_datosconsolidado_codigo()" style="cursor:pointer"  ><img src="images/xlsrol_codigo.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick="ver_datosconsolidado_educadoras()" style="cursor:pointer"  ><img src="images/xlsrol_educadoras.png" border="0"  /></a></center>';
	?>	</td>
  </tr> 
  
  
  <tr>
    <td>
	<?php
	echo '<div onclick="ver_datosconsolidado_discapacidad()" style="cursor:pointer"  ><img src="images/xlsrol_discapacidad.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("luzesperanza") style="cursor:pointer"  ><img src="images/xlsrol_luzesperanza.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("concejales") style="cursor:pointer"  ><img src="images/xlsrol_concejales.png" border="0"  /></a></center>';
	?>	</td>
  </tr> 
  
  <tr>
    <td>
	<?php
	echo '<div onclick=ver_filtado("mayor") style="cursor:pointer"  ><img src="images/xlsrol_mayor.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("mies") style="cursor:pointer"  ><img src="images/xlsrol_mies.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("librer") style="cursor:pointer"  ><img src="images/xlsrol_librer.png" border="0"  /></a></center>';
	?>	</td>
  </tr>  
  
  <tr>
    <td>
	<?php
	echo '<div onclick=ver_filtado("ocacionales") style="cursor:pointer"  ><img src="images/xlsrol_ocacionales.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("permanente") style="cursor:pointer"  ><img src="images/xlsrol_permanente.png" border="0"  /></a></center>';
	?>    </td>
    <td width="400" >&nbsp;</td>
    <td>
	<?php
	echo '<div onclick=ver_filtado("provicional") style="cursor:pointer"  ><img src="images/xlsrol_provicional.png" border="0"  /></a></center>';
	?>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td><?php
	echo '<div onclick=ver_filtado("global") style="cursor:pointer"  ><img src="images/xlsrol_global.png" border="0"  /></a></center>';
	?>	</td>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>    
</table>

</center>
<br />
<div id="despl_roldepagos" align="center"></div>
<br /><br /><br />
<?php

if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}
echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>

<div id=div_<?php echo $table ?> > </div>

<script type="text/javascript">
<!--



function envia_correo()
{


  if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }
   
   $("#despl_roldepagos").load("pdfroles/roles_emailvarios.php",{
   genr_id:$('#genr_id').val(),
   valcedula_val:$('#valcedula_val').val()

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  }); 
  $("#despl_roldepagos").html("Espere un momento"); 


}

function genera_datos()
{
   if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }
   
   $("#despl_roldepagos").load("templateformsweb/maestro_standar_generarroles/generar_rol.php",{
   genr_id:$('#genr_id').val()

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  }); 
  $("#despl_roldepagos").html("Espere un momento"); 

}

function ver_datos()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_varios.php?genr_id='+$('#genr_id').val()+'&valcedula_val='+$('#valcedula_val').val();

}


function ver_datosconsolidado()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_consolidado.php?genr_id='+$('#genr_id').val();
}

function ver_datosconsolidado_codigo()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_consolidado_codigo.php?genr_id='+$('#genr_id').val();
}

function ver_datosconsolidado_educadoras()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_consolidado_educadoras.php?genr_id='+$('#genr_id').val();
}


function ver_datosconsolidado_discapacidad()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_consolidado_discapacidad.php?genr_id='+$('#genr_id').val();
}

//filtrados
function ver_filtado(nombre)
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_consolidado_'+nombre+'.php?genr_id='+$('#genr_id').val();
}



$( "#genr_fechacierre" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>