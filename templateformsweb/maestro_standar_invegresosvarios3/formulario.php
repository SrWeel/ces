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

function imprimir_despacho()
{
  if($('#egrec_id').val()=='')
  {  
    alert("Para imprimir debe guardar el registro");
	return false;
  }
  
  
  
  tablas_verlista('egresocentros/verlista.php',$.base64.encode($('#egrec_id').val()));
  
 

}




//  End -->
</script>