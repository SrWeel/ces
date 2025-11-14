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
			$objformulario->sendvar["compra_tipox"]=1;		
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
					
			$objformulario->sendvar["compra_numeroprocesox"]=$codig_unicovalor;					
			$objformulario->sendvar["compra_enlacex"]=$codig_unicovalor;
			
			$objformulario->sendvar["tipop_idx"]=0;
			$objformulario->sendvar["frm_idx"]=0;
			$objformulario->sendvar["proveevar_idx"]='2909';
			$objformulario->sendvar["subtgen_idx"]=0;
			
		    $objformulario->sendvar["compra_nfacturax"]="VARIOS".strtoupper(uniqid());
				
			$objformulario->sendvar["compra_fechax"]=date("Y-m-d");
			
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
			$objformulario->pathext	='../../../../../';

?>
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
 $objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess); 
 $objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess); 
 ?>
 
 <div id="oc_ret">
 <?php
 $objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess); 
	   
	   ?>
	   </div></td>
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

<?php
if(!($csearch))
{
?>
//showUser_combog('tipomov_id',$('#tipom_id').val(),'divtipomov_id','tipom_id','dns_compras','',0,0,0,0,0); 
showUser_combog('tipomov_id',$('#tipom_id').val(),'divtipomov_id','tipom_id','dns_varioscompras','',0,0,0,0,0);
<?php
}
?>

$('#oc_ret').hide();



//  End -->
</script>