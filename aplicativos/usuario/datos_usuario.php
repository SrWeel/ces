("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if($_POST["pVar1"])
{
//echo $_POST["pVar1"];
//Llamando objetos
$table='kyr_alumno';  
$director="../../";
include ("../../cfgclases/clases.php");
//para cambiar el formato de algunos campos
$campos_tipo=Array
(
    'alu_id' => 'hidden3',
    'alu_ci' => 'hidden2',
	'alu_foto' => 'hidden3',
	'alu_usuario' => 'hidden2',
	'alu_clave' => 'hidden3',
	'alu_bachillerato' => 'hidden3'
);
//para cambiar el formato de algunos campos


     
	
	$em_id_val=0;	
		

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
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_extra'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';	
		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        $funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
  		$template_reemplazo='templateformsweb/maestro_usuariofac/';
?>	
     <div align="center" >
	 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php		
		include("tablas.php");
		
?>	</td>
  </tr>
</table>

	</form>
   </div>
<?php
}			
?>.php");
		
?>	</td>
  </tr>
</table>

	</form>
   </div>
<?php
}			
?>