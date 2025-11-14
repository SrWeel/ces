<?php

//ini_set('display_errors',1);

//error_reporting(E_ALL);

include("../../../../cfgclases/sessiontime.php");

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();



//CONFIGURACIONES

$subindice="_caja";



$director="../../../../";

include ("../../../../cfgclases/clases.php");



$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);



//Datos de empresa

$idempresa=$objformulario->replace_cmb("factur_usuarios","id_usuario,id_empresa","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);

$nombreempresa=$objformulario->replace_cmb("factur_empresa","id_empresa,dat_razon_social","where id_empresa=",$idempresa,$DB_gogess);

$id_empresa_val=$idempresa;	



$banderauso1=1;

$banderauso2=1;

$banderauso3=1;

$banderauso4=1;

//------------------------Busca uso



if($_POST["pVar1"]=='undefined' or $_POST["pVar1"]=='0')

				  {

					 $verificador=1;

				  }

				  else

				  {

					//facturas

					$buscaexistencia="select * from factur_lotefacturas where id_empresa=".$id_empresa_val." and caja_id=".$_POST["pVar1"];		

					$rs_existe = $DB_gogess->Execute($buscaexistencia);

                    if($rs_existe)

					{

						while (!$rs_existe->EOF) {

						

							$listalotes.=$rs_existe->fields["lote_id"].",";

						

						$rs_existe->MoveNext();

						}

					}	

						

					$listalotes=substr($listalotes,0,-1);

					

					 $buscafac="select * from factur_factura_cabecera where lote_id in (".$listalotes.")";



					 $rs_gogessformx = $DB_gogess->Execute($buscafac);

					 

					 if($rs_gogessformx)

					 {

							if($rs_gogessformx->fields["id_facturacab"])

							{

							  $banderauso1=0;

							}

							else

							{

							  $banderauso1=1;

							}

					 }

					//facturas

					//notas de credito

					$listalotes='';

					$buscaexistencia="select * from factur_lotecredito where id_empresa=".$id_empresa_val." and caja_id=".$_POST["pVar1"];		

					$rs_existe = $DB_gogess->Execute($buscaexistencia);

                    if($rs_existe)

					{

						while (!$rs_existe->EOF) {

						

							$listalotes.=$rs_existe->fields["lotec_id"].",";

						

						$rs_existe->MoveNext();

						}

					}	

						

					$listalotes=substr($listalotes,0,-1);

					

					 $buscafac="select * from factur_credito_cab where cre_tipocomprobante='04' and lote_id in (".$listalotes.")";

                     

					 $rs_gogessformx = $DB_gogess->Execute($buscafac);

					 

					 if($rs_gogessformx)

					 {

							if($rs_gogessformx->fields["id_crecab"])

							{

							  $banderauso2=0;

							}

							else

							{

							  $banderauso2=1;

							}

					 }

					//notas de credito 

					

					//notas de debito

					$listalotes='';

					$buscaexistencia="select * from factur_lotedebito where id_empresa=".$id_empresa_val." and caja_id=".$_POST["pVar1"];		

					$rs_existe = $DB_gogess->Execute($buscaexistencia);

                    if($rs_existe)

					{

						while (!$rs_existe->EOF) {

						

							$listalotes.=$rs_existe->fields["loted_id"].",";

						

						$rs_existe->MoveNext();

						}

					}	

						

					$listalotes=substr($listalotes,0,-1);

					

					 $buscafac="select * from factur_credito_cab where  cre_tipocomprobante='05' and  lote_id in (".$listalotes.")";

                     

					 $rs_gogessformx = $DB_gogess->Execute($buscafac);

					 

					 if($rs_gogessformx)

					 {

							if($rs_gogessformx->fields["id_crecab"])

							{

							  $banderauso3=0;

							}

							else

							{

							  $banderauso3=1;

							}

					 }

					//notas de debito

					

					//notas de retenciones

					$listalotes='';

					$buscaexistencia="select * from factur_loteretencion where id_empresa=".$id_empresa_val." and caja_id=".$_POST["pVar1"];		

					$rs_existe = $DB_gogess->Execute($buscaexistencia);

                    if($rs_existe)

					{

						while (!$rs_existe->EOF) {

						

							$listalotes.=$rs_existe->fields["loter_id"].",";

						

						$rs_existe->MoveNext();

						}

					}	

						

					$listalotes=substr($listalotes,0,-1);

					

					 $buscafac="select * from factur_sretencion_cab where  lote_id in (".$listalotes.")";

                     

					 $rs_gogessformx = $DB_gogess->Execute($buscafac);

					 

					 if($rs_gogessformx)

					 {

							if($rs_gogessformx->fields["id_sretcab"])

							{

							  $banderauso4=0;

							}

							else

							{

							  $banderauso4=1;

							}

					 }

					//notas de retenciones

					$verificador=$banderauso1*$banderauso2*$banderauso3*$banderauso4;

							 

				  }



//------------------------



if($objperfil->estado_maker==1)

{

if($verificador==1)

{

	$campos_tipo=Array

	(

		'caja_id' => 'hidden3',

		//'caja_sino'=> 'hidden3',

	);

}

if($verificador==0)

{

   $campos_tipo=Array

	(

		'caja_id' => 'hidden3',

		'caja_sino'=> 'hidden3',

		'caja_nombre'=> 'hidden2',

		'caja_num'=> 'hidden2',

	);



}





}



if($objperfil->estado_checker==1)

{



$campos_tipo=Array

(

	'caja_id' => 'hidden3',

	'caja_nombre' => 'hidden2',

	'caja_num' => 'hidden2',	

	

);



}



if($objperfil->estado_consulta==1)

{



$campos_tipo=Array

(

	'caja_id' => 'hidden3',

	'caja_nombre' => 'hidden2',

	'caja_num' => 'hidden2',

	'caja_sino'=> 'hidden2',

	

);



}













$objimpuestos->datos_cfg($id_empresa_val,$DB_gogess);

$objCfgSistema->sistema_data_cfg($id_empresa_val,$DB_gogess);	



  $table='factur_caja';  

			//$id_empresa_val=0;		



	

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

	if($objCfgSistema->cfs_aceptar==1)

	{	

	  

				

		 $botonaceptar='<div id=baceptar ><input type="image" name="imageField" src="images/aceptar.png" /></div>';

		 

		

	}

	

		  

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

		

		$funcionextrag="guarda".$subindice."_nuevo('".$divresultado."','".$mensajege."')";

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



<script type="text/javascript">

<!--

ver_formapago();



 

//  End -->

</script>



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