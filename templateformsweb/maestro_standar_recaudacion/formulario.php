<?php
//busca si es adm recaudador
$rec_adm=0;
$rec_adm=$objformulario->replace_cmb("app_usuario","usua_id,usua_admrecaudacion"," where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
//busca si es adm recaudador
	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
            $valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["recau_enlacex"]=$aletorioid;
			

			
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
<div class="alert alert-success"><b>Nota Importante!!! POR FAVOR NO OLVIDE GUARDAR EL REGISTRO DESPUES DE AGREGAR UN DATO EN EL SEGUIMIENTO, DANDO CLIC EN &nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data()"> GRABAR</button> </b></div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);

?>



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
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>

<?php
if($rec_adm==1)
{
?>
$('#solo_adm').show();
<?php
}
else
{
?>
$('#solo_adm').hide();
<?php
}
?>

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>
