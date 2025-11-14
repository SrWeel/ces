<?php	  

	        $enlace_general=@$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=55;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["categ_idx"]=$insu_valorx;		
			
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];		
			
			$objformulario->sendvar["tipom_idx"]=2;
			$objformulario->sendvar["tipomov_idx"]=5; 
			$objformulario->sendvar["egrec_tipox"]=0;

$buus_lab='';
$buus_lab=$objformulario->replace_cmb("app_usuario","usua_id,usua_laboratorio"," where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);


            if($buus_lab=='1')
            {
             $objformulario->sendvar["centrod_idx"]=30;
			}

?>

<b>TIEMPO LIMITE DE ENTREGA</b>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
 $objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
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

function procesar_despacho()
{
  if($('#egrec_id').val()=='')
  {  
    alert("Para procesar debe guardar el registro");
	return false;
  }
  
  
if (confirm("Esta seguro que desea realizar este proceso ?"))
	 { 
  
  $("#proceso_divval").load("egresocentros/procesar_despacho.php",{
   egrec_id:$('#egrec_id').val()
 
  },function(result){ 
      listado_despachos();
  });  

  $("#proceso_divval").html("Espere un momento...");
  
  }
  

}

function imprimir_despacho()
{
  if($('#egrec_id').val()=='')
  {  
    alert("Para imprimir debe guardar el registro");
	return false;
  }
  
  
  
  tablas_verlista('egresocentros/verlista.php',$.base64.encode($('#egrec_id').val()));
  
 

}


$( "#certifgext_ndiasvalidados" ).change(function() {
  
var nvalida=parseFloat($('#certifgext_ndiasvalidados').val());
  
if(nvalida>30)
{
	 $('#alerta_valor').html('<center><div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000"><b>ALERTA NO DEBE SUPERAR LOS 30 DIAS</b></div></center>');
}	

				 
});

$( "#compra_fechaaprobacion" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#egrec_fecha" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

//$('#certif_contenido').ckeditor();

$('#proveevar_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_proveedor_actualizar()' style='cursor:pointer'><img src='images/moreedit.png' width='20' height='18'></td></tr> </tbody></table>");


function buscar_proveedor_actualizar()
{
   
abrir_standar("../proveedor_d/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,$('#proveevar_id').val(),0,0,0,0,0);
	 
}


//  End -->
</script>