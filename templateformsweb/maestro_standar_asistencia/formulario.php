<script language="javascript">
<!--
function procesar_xls()
{
if($('#biom_id').val()>0)
{


$("#div_procesar").load("templateformsweb/maestro_standar_asistencia/procesar.php",{
biom_id:$('#biom_id').val(),centro_id:'<?php echo $_SESSION['ces1313777_centro_id'];  ?>'
},function(result){  
    
  });  
  $("#div_procesar").html("Espere un momento...");



}
else
{
  alert("Porfavor subir el archivo y guardar el resgitro para poder procesar");

}

}
//-->
</script>
<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			

			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

?>

   

<p>&nbsp;</p>
<center>
  <input type="button" name="Submit" value="PROCESAR" onclick="procesar_xls()" />
  <p>&nbsp;</p>
  <div id="div_procesar"></div>
</center>




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