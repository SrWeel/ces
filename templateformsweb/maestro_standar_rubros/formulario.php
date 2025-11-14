<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#D2E4E6"><div align="center">INDICACIONES</div></td>
  </tr>
  <tr>
    <td height="116" bgcolor="#DDEFF4"><p>Uso de Rango inicio(opcional) y Rango Fina(Opcional) Se usan para parametrizar el rango de calculo del decimo cuarto y decimo tercer, ejemplo: El decimo cuarto se calcula desde el 1 de marzo del a&ntilde;o anterior al 29 o 28 de febrero del a&ntilde;o actual. En el sistema quedar&iacute;a de la siguiente forma:</p>
    <p>Rango inicio(opcional): 03-01-AN (MES-DIA-AN quiere decir a&ntilde;o anterior) </p>
    <p>Rango Fina(Opcional): 02-29-AC (MES-DIA-AC quiere decir a&ntilde;o actual) </p></td>
  </tr>
</table>

<?php

$objformulario->react_id=$react_id;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usuar_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
            $valoralet=mt_rand(1,50000);
			$aletorioid='02'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["rubrg_enlacex"]=$aletorioid;


$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 


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

<div id="divBody_buscadorgeneral"></div>

<script type="text/javascript">
<!--
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>

<script type="text/javascript">
<!--

function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_rubros/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

//  End -->
</script>