<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//CONFIGURACIONES
$subindice="_report";

$director="../../../../";
include ("../../../../cfgclases/clases.php");

$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);


if($objperfil->estado_maker==1)
{

$campos_tipo=Array
(
	'usr_fecha_habilitacion' => 'hidden2',
	'usr_fecha_alta' => 'hidden2',
	'sisu_id'=> 'hidden3',
	'prod_activo'=> 'hidden3',
);

}

if($objperfil->estado_checker==1)
{

$campos_tipo=Array
(
	'tipp_id' => 'hidden2',
	'prod_codigo' => 'hidden2',
	'prod_nombre' => 'hidden2',
	'prod_precio' => 'hidden2',
	'prod_ivasino' => 'hidden2',
	'sisu_id'=> 'hidden3'	
	
);

}

if($objperfil->estado_consulta==1)
{

$campos_tipo=Array
(
	'usr_fecha_habilitacion' => 'hidden2',
	'usr_fecha_alta' => 'hidden2',
	'sisu_id'=> 'hidden3',
	'prod_activo'=> 'hidden3',
);

}



//Datos de empresa
$idempresa=$objformulario->replace_cmb("factur_usuarios","usua_id,em_id","where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
$nombreempresa=$objformulario->replace_cmb("factur_empresa","em_id,em_nombre","where em_id=",$idempresa,$DB_gogess);
$em_id_val=$idempresa;	


$objimpuestos->datos_cfg($em_id_val,$DB_gogess);
$objCfgSistema->sistema_data_cfg($em_id_val,$DB_gogess);	

  $table='kyradm_report';  
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
	
	
	
	$botonaceptar='';
	
				
		 $botonaceptar='<div id=baceptar ><input type="image" name="imageField" src="images/aceptar.png" /></div>';
		 

		  
	 $comillasimple="'";
	 
if($objperfil->estado_consulta==0)
{	 
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><div id=div_btnaceptar >'.$botonaceptar.'</div></td>
			    <td>&nbsp;</td>
				<td><div id="div_btnformapago" ></div></td>
				<td>&nbsp;</td>
				<td><div id="div_btnvalidarsri" ></div></td>
				<td>&nbsp;</td>
				<td><div id="div_btnverpdf" ></div></td>
				<td>&nbsp;</td>
				<td><div id="div_btnverxml" ></div></td>
				<td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog'.$subindice.$comillasimple.')"  style="cursor:pointer" ><div id=div_btncancelar ><img src="images/cancelar.png" ></div></td>
				<td ><div id="div_btnanular" ></div></td>
			  </tr>
			</table>
</div>';	

}

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="guarda".$subindice."_nuevo('div_".$table."','".$mensajege."')";
		
  		$template_reemplazo='templateformsweb/maestro_standar'.$subindice.'/';			  

?>

<style type="text/css">
<!--
.borde_css {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	border: 1px solid #CCCCCC;
}
-->
</style>
 <div align="center" >	
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 	 
<table width="400" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td><?php		
		include("../../tablas.php");
		
?>	</td>
    </tr>
</table>
</form>


	
</div><div id="divBody_proveedor" ></div>
<div id="div_cbusca" >
<input name="rucci_enc" type="hidden" id="rucci_enc" value="" />
<input name="nombreapellido_enc" type="hidden" id="nombreapellido_enc" value="" />
<input name="direccion_enc" type="hidden" id="direccion_enc" value="" />
<input name="telefono_enc" type="hidden" id="telefono_enc" value="" />
<input name="email_enc" type="hidden" id="email_enc" value="" />
<input name="encuentra_enc" type="hidden" id="encuentra_enc" value="0" />
<input name="tipodoc_enc" type="hidden" id="tipodoc_enc" value="" />
</div>

<div id=verifica_exfac >

<input name="existe_factura" type="hidden" id="existe_factura" value="0" />

</div>


<?php

	if($objformulario->contenid["estaf_id"]==2)
		{
	?>
	<script type="text/javascript">
<!--
$('#baceptar').html('');
//  End -->
</script>
	<?php
		}
		
?>