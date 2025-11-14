<?php	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$centro_id;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["categ_idx"]=$insu_valorx;
			$objformulario->sendvar["tipom_idx"]=1;
			$objformulario->sendvar["tipomov_idx"]=17;

			$objformulario->sendvar["frm_idx"]=7;
			
			$objformulario->sendvar["compra_tipox"]=0;
			
			$unico_number='';
			$unico_number=strtoupper(uniqid());
			
			
			$objformulario->sendvar["compra_numeroprocesox"]=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
						
			
			
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
			$objformulario->pathext	='../../../../../';



?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
?></td>
    <td><center><input type="button" name="Submit" value="LEER XML" onclick="leer_xml()" /></center><div id="procesa_xml"></div></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
 $objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

	   
	   ?></td>
     </tr>
</table>


<div id="divBody_proveedor"></div>
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

$( "#certifgext_ndiasvalidados" ).change(function() {
  
var nvalida=parseFloat($('#certifgext_ndiasvalidados').val());
  
if(nvalida>30)
{
	 $('#alerta_valor').html('<center><div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000"><b>ALERTA NO DEBE SUPERAR LOS 30 DIAS</b></div></center>');
}	

				 
});

$( "#compra_fechaaprobacion" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#compra_fecha" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

//$('#certif_contenido').ckeditor();

$('#proveevar_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_proveedor_actualizar()' style='cursor:pointer'><img src='images/moreedit.png' width='20' height='18'></td></tr> </tbody></table>");


function buscar_proveedor_actualizar()
{
   
abrir_standar("../proveedor_d/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,$('#proveevar_id').val(),0,0,0,0,0);
	 
}

function leer_xml()
{

if($('#compra_xml').val()=='')
{
  alert("Subir xml al sistema para procesar");
  return false;
}

	  $("#procesa_xml").load("../../../../../templateformsweb/maestro_standar_compras2/procesa_xml.php",{
        compra_xml:$('#compra_xml').val()
	  },function(result){  
	
	
	  });  
	
	  $("#procesa_xml").html("Espere un momento...");  


}


//  End -->
</script>