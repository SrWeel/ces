<script language="javascript">
<!--

//-->

</script>
<?php	  

	        $ver_boton=1;
			//---ENLACE
			$valoralet=mt_rand(1,50000);
			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;
			//----		

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usuar_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["usua_idx"]=$_POST["pVar2"];
			$objformulario->sendvar["codex"]=$aletorioid;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["hcx"]=$rs_dcliente->fields["usua_ciruc"];
			$objformulario->sendvar["atenc_fechaingresox"]=date("Y-m-d");		 

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["asigrhext_enlacex"]=$aletorioid;

		//echo getcwd();
echo $botonenvio;
?>
<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
</div>
</div>
<?php 
echo $botonenvio;
?>
<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
}
?>
</div>
</div>
<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
}
?>
</div>
</div>
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
<div id="divBody_informes" ></div>
<div id="divBody_buscadorgeneral"></div>

<script type="text/javascript">
<!--

function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_rubros/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

//  End -->
</script>