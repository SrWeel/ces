<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$cuadro_valor=array();
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

function leer_contenido_completo($url){
	
	if (file_exists($url)) {
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   
	}
	else
{
 echo 'Archivo no existe...';	

}
   return $texto;
}


function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;

$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;

$resultado["anio"]=$valor_anio;
$resultado["mes"]=$valor_mes;

return $resultado;
}


function campo_gogess($table,$field,$DB_gogess)
{
	
  foreach ($objformulario->sisfield_arr as $campos) {	
	if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 &&  trim($campos["fie_name"])==$field)
	{
	    
		        $campos_data["field_type"]= $campos["field_type"];
				$campos_data["field_flags"]=$campos["field_flags"];				
				$campos_data["tab_name"]=$campos["tab_name"];				
				$campos_data["fie_name"]=$campos["fie_name"];
				@$campos_data["tab_datosf"]=$campos["tab_datosf"];				
				$campos_data["fie_title"]=$campos["fie_title"];
				$campos_data["fie_type"]=$campos["fie_type"];
				$campos_data["fie_style"]=$campos["fie_style"];
				$campos_data["fie_value"]=$campos["fie_value"];
				$campos_data["fie_tabledb"]=$campos["fie_tabledb"];
				$campos_data["fie_datadb"]=$campos["fie_datadb"];
				$campos_data["fie_active"]=$campos["fie_active"];				
				$campos_data["fie_attrib"]=$campos["fie_attrib"];
				$campos_data["fie_activesearch"]=$campos["fie_activesearch"];
				$campos_data["fie_obl"]=$campos["fie_obl"];
				$campos_data["fie_sql"]=$campos["fie_sql"];
				$campos_data["fie_group"]=$campos["fie_group"];
				$campos_data["fie_sendvar"]=$campos["fie_sendvar"];
				$campos_data["fie_tactive"]=$campos["fie_tactive"];
				$campos_data["fie_lencampo"]=$campos["fie_lencampo"];
				$campos_data["fie_txtextra"]=$campos["fie_txtextra"];
				$campos_data["fie_valiextra"]=$campos["fie_valiextra"];
				$campos_data["fie_txtizq"]=$campos["fie_txtizq"];
				$campos_data["fie_lineas"]=$campos["fie_lineas"];
				$campos_data["fie_tabindex"]=$campos["fie_tabindex"];
				$campos_data["fie_activarprt"]=$campos["fie_activarprt"];
				$campos_data["fie_verificac"]=$campos["fie_verificac"];
				$campos_data["fie_tablac"]=$campos["fie_tablac"];
				$campos_data["fie_sqlorder"]=$campos["fie_sqlorder"];				
				$campos_data["fie_styleobj"]=$campos["fie_styleobj"];
				$campos_data["fie_naleatorio"]=$campos["fie_naleatorio"];
				$campos_data["fie_sqlconexiontabla"]=$campos["fie_sqlconexiontabla"];
				$campos_data["fie_activelista"]=$campos["fie_activelista"];
				$campos_data["fie_campoafecta"]=$campos["fie_campoafecta"];
				$campos_data["fie_camporecibe"]=$campos["fie_camporecibe"];
				$campos_data["fie_inactivoftabla"]=$campos["fie_inactivoftabla"];			
				
				$campos_data["fie_evitaambiguo"]=$campos["fie_evitaambiguo"];
				$campos_data["fie_activogrid"]=$campos["fie_activogrid"];
				$campos_data["field_maxcaracter"]=$campos["field_maxcaracter"];
				@$campos_data["fie_tipocomb"]=$campos["fie_tipocomb"];
				
				$campos_data["fie_activarbuscador"]=$campos["fie_activarbuscador"];
				$campos_data["fie_tablabusca"]=$campos["fie_tablabusca"];
				$campos_data["fie_camposbusca"]=$campos["fie_camposbusca"];
				$campos_data["fie_campodevuelve"]=$campos["fie_campodevuelve"];
				$campos_data["fie_placeholder"]=$campos["fie_placeholder"];
				$campos_data["fie_archivogrid"]=$campos["fie_archivogrid"];		
				$campos_data["fie_id"]=$campos["fie_id"];
				
				
				
				$campos_data["existecampo"]=1;
				
				$bandera=$campos["fie_name"];
	}
} 

return $campos_data;
		
		
}	

function generar_formulario($submit,$table,$grupof,$imprpt,$DB_gogess)
{

//print_r($this->sisfield_arr);
//Formulario de despliegue de campos

 $this->form_format_tabla($table,$DB_gogess);

	   foreach ($objformulario->sisfield_arr as $campos) {

		    if(trim($campos["tab_name"])==trim($table) && trim($campos["fie_active"])==1 &&  trim($campos["fie_group"])==trim($grupof))
	            {

	                  //----------------------------------------------

					  $campos_data=$campo_gogess($table,$campos["fie_name"],$DB_gogess);

					  if($campos["fie_activarbuscador"]==1)

							{

							  $funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar','".$campos["fie_tablabusca"]."','".$campos["fie_camposbusca"]."','".$campos["fie_campodevuelve"]."','".$campos["fie_name"]."',0,0,0)";

							  $boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';

							}

							else

							{

							   $boton_buscar='';

							}

							

							$opcionesconca=$boton_buscar;

							

					        $nombre_campo=strtolower($campos["fie_name"]);	
$this->ncamponombre='';
							$campos_data["ncamponombre"]=$nombre_campo;

							$campos_data["txtobligatorio"]='';

							if ($campos["fie_obl"])

							 {

								 

								   if (!($imprpt))

								   {

									   $txtobligatorio="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;'>*</span>";

									}  

								 

							 }

							  

							//Despliega un campo

							//En caso de cambiar formato de campo manual

					if(trim(@$this->campos_formatoc[$campos["fie_name"]]))

					{

					  $campos["fie_typeweb"]=trim($this->campos_formatoc[$campos["fie_name"]]);

					}

                    //En caso de cambiar formato de campo manual

//echo $campos["fie_typeweb"];
					

					if ($campos["fie_typeweb"])

					{

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."campos/".$campos["fie_typeweb"].".php");

						 

						}

						else

						{

						  include($this->pathexternoimp."campos/".$campos["fie_typeweb"].".php");

						  

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."campos/default.php");

						} 

					

					}

						printf("\n");

					     

					 //-----------------------------------------------

	            }

	   } 

	  
//Fin Formulario despliegue campso

}

$plantilla=leer_contenido_completo('plantillas/infromeevaluacion.php');

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($_GET["atenc_id"]));

$datos_cliente="select * from app_cliente where clie_id=".$rs_atencion->fields["clie_id"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

$resultado=str_replace('-fecha-',date('Y-m-d'),$plantilla);
$resultado=str_replace('-nombre-',$rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"],$resultado);
$resultado=str_replace('-fechanacimiento-',$rs_dcliente->fields["clie_fechanacimiento"],$resultado);
$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fecha"]);
$edad=$num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
$resultado=str_replace('-edad-',$edad,$resultado);
$resultado=str_replace('-direccion-',$rs_dcliente->fields["clie_direccion"],$resultado);
$resultado=str_replace('-telefono-',$rs_dcliente->fields["clie_telefono"],$resultado);
$resultado=str_replace('-instruccion-',$rs_dcliente->fields["clie_instruccion"],$resultado);
$resultado=str_replace('-institucion-',$rs_dcliente->fields["clie_institucion"],$resultado);

$nfuente= $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_dcliente->fields["usua_id"],$DB_gogess);

$resultado=str_replace('-fuentededatos-',$nfuente,$resultado);
$resultado=str_replace('-fechaevaluacion-',$rs_atencion->fields["atenc_fecha"],$resultado);
$resultado=str_replace('-motivo-',$rs_atencion->fields["atenc_observacion"],$resultado);

$lista_psicologia="select * from faesa_psicologia where atenc_id=?";
$rs_psicologia = $DB_gogess->executec($lista_psicologia,array($_GET["atenc_id"]));




echo $resultado;
?>