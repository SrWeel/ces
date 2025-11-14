<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<table width="700" border="0" align="center" cellpadding="4" cellspacing="2">  
  <tr>
    <td valign="top"><div align="center" >
      <?php
	
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			
			$objformulario->sendvar["caucab_idx"]=$_POST["pVar2"];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
    </div></td>
  <td valign="top" ><div align="center" >
<div align="center" > <?php  $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess);  ?></div>
  </td>
    <?php
    //$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
	?>
  </tr>
</table>

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
$( "#caudet_fechaingreso" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#caudet_fechaaudiencia" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#caudet_fechaacta" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>