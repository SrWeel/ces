<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

 $table='spag_postulante'; 
$director="../../../../";
include ("../../../../cfgclases/clases.php");

$campos_tipo=Array
(
	
	'usr_clave'=> 'password'
	
);


  
			//$em_id_val=0;		
	
	
	$variableb=0;
			if($_POST["pVar1"]=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_POST["pVar1"];
                     $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_POST["pVar1"];				 
				  }
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_usuarios'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="desplegar_grid_buscar();
		crea_usuario();
		";
  		$template_reemplazo='templateformsweb/maestro_standar_usuarios/';			  

?>


 <div align="center" >	 
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="700" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td valign="top"><?php		
		include("../../tablas.php");
		
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
CKEDITOR.disableAutoInline = true;
	$( 'textarea#introtext' ).ckeditor();
//  End -->
</script>
