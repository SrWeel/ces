<br><br><?php

$table='app_empresa'; 
$director='';

if($_SESSION['ces1313777_sessid_emp_id'])
{
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

  
			//$em_id_val=0;		
	
	
	$variableb=0;
			if($_SESSION['ces1313777_sessid_emp_id']=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_SESSION['ces1313777_sessid_emp_id'];
                     $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_SESSION['ces1313777_sessid_emp_id'];				 
				  }
	
	
if($csearch)
{
$campos_tipo=Array
(
	
	'usua_fecha_uingreso'=> 'hidden3',
	'usua_hora_uingreso'=> 'hidden3',
	'usua_fecha_cambioclv'=> 'hidden3',
	'emp_estado'=> 'hidden2',
	'usua_id'=> 'hidden3',
	'usua_adm'=> 'hidden2'

);

}

	
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><button type="submit" class="btn btn-primary">Aceptar</button></td>
			    
			  </tr>
			</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="desplegar_grid()";
  		$template_reemplazo='templateformsweb/maestro_standar_empresa/';			  

?>


 <div align="center" >	 
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="700" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td valign="top"><?php		
		include("aplicativos/documental/tablas.php");
		
?></td>
    </tr>
</table>

</form>	
</div>
<div id=div_alias >
  <input name="alias_valor" type="hidden" id="alias_valor" value="" />
</div>
<div id=div_ncontenido ></div>

<script type="text/javascript">
<!--
//CKEDITOR.disableAutoInline = true;
	//$( 'textarea#introtext' ).ckeditor();
//  End -->
</script>
<?php
}
else
{
	echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';
	
}
?>
<br><br>
