<?php
include('qr/vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$valor_busca=$_POST["ireport"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario();

$obs_extra=$_POST["obs_extra"];
$table=$_POST["table"];
$campo_primariodata=$_POST["campo_primariodata"];
$valor_id=$_POST["valor_id"];

$obj_NumerosEnLetras=new NumerosEnLetras();


//campos de la tabla principal

//$lista_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_guarda=1";
//$rs_campos = $DB_gogess->executec($lista_campos,array());

//campos de la tabla principal


function fechaCastellano_let($fecha,$obj_NumerosEnLetras) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  //$nombredia.
  
  $letra_num=$obj_NumerosEnLetras->convertir($numeroDia, $currency = '', $format = false, $decimals = '');
  $anio_let=$obj_NumerosEnLetras->convertir($anio, $currency = '', $format = false, $decimals = '');
  
  return " ".strtoupper($letra_num." DE ".$nombreMes." DE ".$anio_let);
}

function fechaCastellano($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  //$nombredia.
  return " ".$numeroDia." de ".$nombreMes." de ".$anio;
}


$busca_certificado="select * from dns_certificados where certif_id='".$valor_busca."'";
$rs_cert = $DB_gogess->executec($busca_certificado,array());

$lee_plantilla=$rs_cert->fields["certif_contenido"];


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);

$fecha_actual=date("Y-m-d");
$fecha_ciudad=$nciudad.", ".fechaCastellano($fecha_actual);
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

 
$centro_ciudad='';
$centro_ciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,cant_codigo"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);
$nombrecentro_ciudad=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre"," where cant_codigo like ",$centro_ciudad,$DB_gogess);

$centro_codigo=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo"," where centro_id =",1,$DB_gogess);

$fecha_textociudad=$nombrecentro_ciudad.", ".fechaCastellano($fecha_actual);

$lee_plantilla=str_replace("-fechaciudad-",$fecha_textociudad,$lee_plantilla);
$lee_plantilla=str_replace("-centro-",$nciudad,$lee_plantilla);

$lee_plantilla=str_replace("-desde-",$_POST["fechai"],$lee_plantilla);
$lee_plantilla=str_replace("-hasta-",$_POST["fechaf"],$lee_plantilla);

$lee_plantilla=str_replace("-ndesde-",fechaCastellano_let($_POST["fechai"],$obj_NumerosEnLetras),$lee_plantilla);
$lee_plantilla=str_replace("-nhasta-",fechaCastellano_let($_POST["fechaf"],$obj_NumerosEnLetras),$lee_plantilla);

$lee_plantilla=str_replace("-unicodigo-","<b>UNICODIGO:</b>".$centro_codigo,$lee_plantilla);

$fecha1= new DateTime($_POST["fechai"]);
$fecha2= new DateTime($_POST["fechaf"]);
$diff = $fecha1->diff($fecha2);
$ndias=0;
$ndias=$diff->days+1;

$lee_plantilla=str_replace("-dias-",$ndias,$lee_plantilla);


$lee_plantilla=str_replace("-hinicio-",$_POST["horai"],$lee_plantilla);
$lee_plantilla=str_replace("-hfin-",$_POST["horaf"],$lee_plantilla);

$obs_extra=$_POST["obs_extra"];

$lee_plantilla=str_replace("-observaciones-","<br>".$_POST["obs_extra"],$lee_plantilla);


////////////////////////////////////////////////////////
$lista_tbl="select * from gogess_sistable where tab_name='".$table."'";
$rs_tbl = $DB_gogess->executec($lista_tbl,array());
$tab_campoprimario=$rs_tbl->fields["tab_campoprimario"];
$obt_sub=explode("_",$tab_campoprimario);

$fecha_registrodata=$obt_sub[0]."_fecharegistro";

//despliega datos de la atencion
$list_actual="select * from ".$table." where ".$campo_primariodata."='".$valor_id."'";
$rs_acti = $DB_gogess->executec($list_actual,array());

if($table=='dns_psicologia' or $table=='dns_psicologiaadolecentes' or $table=='dns_psicologiainfantil' or $table=='dns_subsecuentepsicologia')
{
 $reval_id=0;
 $reval_id=$rs_acti->fields["reval_id"];
 
 $n_resuleva=$objformulario->replace_cmb("dns_resultadoevaluacion","reval_id,reval_nombre"," where reval_id =",$reval_id,$DB_gogess);
 $lee_plantilla=str_replace("-aptooapto-",$n_resuleva,$lee_plantilla);
	
}		
		

$fecha_ac=array();
$fecha_ac=explode(" ",$rs_acti->fields[$fecha_registrodata]);
$nfecha_ac=fechaCastellano($fecha_ac[0]);
//despliega datos de la atencion
//////////////////////////////////////////////////////////
$lee_plantilla=str_replace("-fechaatencion-",$fecha_ac[0],$lee_plantilla);



$lee_plantilla=str_replace("-nfechaatencion-",fechaCastellano_let($fecha_ac[0],$obj_NumerosEnLetras),$lee_plantilla);



//lee paciente
$datos_paciente="select * from app_cliente where clie_rucci='".$_POST["c1"]."'";
$rs_pacient = $DB_gogess->executec($datos_paciente,array());

//clie_situaciongradopaciente
//clie_instruccion
//clie_dondetrabaja

$lista_campos="select * from gogess_sisfield where tab_name='app_cliente' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  //echo $rs_pacient->fields[$rs_campos->fields["fie_name"]]."<br>";
				  $rmp='';
				  if ($rs_campos->fields["fie_value"]=="replace")
							{
							
						$valorbus=$rs_pacient->fields[$rs_campos->fields["fie_name"]];
						$rmp=$objformulario->replace_cmb($rs_campos->fields["fie_tabledb"],$rs_campos->fields["fie_datadb"],$rs_campos->fields["fie_sql"],$valorbus,$DB_gogess);  	
				  
				       $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rmp,$lee_plantilla);
					   
					   }
					   else
					   {
					   
					    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_pacient->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
					   
					   }
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  
//lee paciente


//lee medico
$datos_medico="select * from app_usuario where usua_ciruc='".$_POST["c2"]."'";
$rs_medico = $DB_gogess->executec($datos_medico,array());


$lista_campos="select * from gogess_sisfield where tab_name='app_usuario' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				 
					 $rmp='';
				     if ($rs_campos->fields["fie_value"]=="replace")
					  {							
						$valorbus=$rs_medico->fields[$rs_campos->fields["fie_name"]];
						$rmp=$objformulario->replace_cmb($rs_campos->fields["fie_tabledb"],$rs_campos->fields["fie_datadb"],$rs_campos->fields["fie_sql"],$valorbus,$DB_gogess);				  
				        $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rmp,$lee_plantilla);					   
					   }
					   else
					   {					   
					    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",utf8_encode($rs_medico->fields[$rs_campos->fields["fie_name"]]),$lee_plantilla);					   
					   }
					
					
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  


//lee medico

//diagnostico
$tabla_maestra="dns_atencion";
$id_atencion="atenc_id";
$lista_tablas=array();
$sql_buscadiag=array();
$num_id=0;
$diagnostico_valor='';

$diagnostico_noformat='';

if($_POST["tab_name"])
{
$lista_tablas_diag="select * from gogess_sisfield inner join gogess_sistable on gogess_sisfield.tab_name=gogess_sistable.tab_name where ttbl_id=1 and gogess_sistable.tab_name='".$_POST["tab_name"]."'";
}
else
{
$lista_tablas_diag="select * from gogess_sisfield inner join gogess_sistable on gogess_sisfield.tab_name=gogess_sistable.tab_name where ttbl_id=1";
}
$rs_diagnost = $DB_gogess->executec($lista_tablas_diag,array());
if ($rs_diagnost)
			   {
			      while (!$rs_diagnost->EOF) {
				  
				    $lista_tablas[$num_id]["tabla"]=$rs_diagnost->fields["tab_name"];
					$lista_tablas[$num_id]["grid"]=$rs_diagnost->fields["fie_tablasubgrid"];
					$lista_tablas[$num_id]["enlace"]=$rs_diagnost->fields["fie_campoenlacesub"];
					$lista_tablas[$num_id]["fechareg"]=$rs_diagnost->fields["fie_campofecharegistro"];
					
					
					if($rs_diagnost->fields["fie_tablasubgrid"])
					{
					
					$sql_buscount[$num_id]="select count(*) as total from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where ".$campo_primariodata."='".$valor_id."'";
					
					
					$rs_diacount = $DB_gogess->executec($sql_buscount[$num_id],array());
					if($rs_diacount->fields["total"]>0)
					{
					
					
					$sql_buscadiag[$num_id]="select distinct * from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where ".$campo_primariodata."='".$valor_id."'";
					 
					$diagnostico_valor.="<ul>";
					
					//echo $sql_buscadiag[$num_id];
					//$diagnostico_valor.="<br>".$rs_diagnost->fields["tab_title"]."<ul>";
					//---------------------------------
						$rs_diagtrs = $DB_gogess->executec($sql_buscadiag[$num_id],array());
						if($rs_diagtrs)
						{
						   while (!$rs_diagtrs->EOF) {
						   
						     $diagnostico_valor.="<li>".$rs_diagtrs->fields["diagn_cie"]." ".$rs_diagtrs->fields["diagn_descripcion"]."</li>";
							 $diagnostico_noformat.=$rs_diagtrs->fields["diagn_cie"]." ".$rs_diagtrs->fields["diagn_descripcion"]." ";
						   
						     $rs_diagtrs->MoveNext();
						   }
						   
						}
					//---------------------------------
					$diagnostico_valor.="</ul>";
					
					
					
					}
					
					}
						
					
					$num_id++;
				  
				   $rs_diagnost->MoveNext();	
				  }
}	



$lee_plantilla=str_replace("-diagnostico-","".$diagnostico_valor,$lee_plantilla);

$lee_plantilla=str_replace("-enfermedad-","".$diagnostico_noformat." ".$obs_extra,$lee_plantilla);

//$diagnostico_valor
//diagnostico



$n_contingencia='';
$n_contingencia=$objformulario->replace_cmb("cesdb_arcombos.cmb_contingencia","contin_id,contin_nombre"," where contin_id=",$_POST["contin_id"],$DB_gogess);
$lee_plantilla=str_replace("-tcontingencia-",$n_contingencia,$lee_plantilla);




//lee medico FIRMA
$lista_num=0;
$responsables_cuadro='';
$busca_cliente="select * from app_usuario where  usua_ciruc='".$_POST["c2"]."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$obtiene_nombres[$lista_num]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".utf8_encode($rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"])."</b><br>".$rs_bcliente->fields["usua_formaciondelprofesional"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."<p>&nbsp;</p><p>&nbsp;</p>";
		
$lista_medicos.= $rs_bcliente->fields["usua_siglastitulo"]." ".utf8_encode($rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]).", ";
$lista_num++;

$telefonocent='';
$telefonocent=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_telefono"," where centro_id =",1,$DB_gogess);
$lee_plantilla=str_replace("-telefonocentro-",$telefonocent,$lee_plantilla);

$direccioncentro='';
$direccioncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_direccion"," where centro_id =",1,$DB_gogess);
$lee_plantilla=str_replace("-direccioncentro-",utf8_encode($direccioncentro),$lee_plantilla);
//lee medico

$responsables_cuadro='';
if(count($obtiene_nombres)>1)
{
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,2);
}
else
{
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,1);

}

$lee_plantilla=str_replace("-medico-",$obtiene_nombres[0],$lee_plantilla);

$lee_plantilla=str_replace("-fechasolo-",date("Y/m/d"),$lee_plantilla);

$lee_plantilla=str_replace("-dias-",$_POST["nd_otorgado"],$lee_plantilla);


$lee_plantilla=str_replace('-sello-','<img src="temporal/sello.jpg" width="150" height="149" />',$lee_plantilla);




}
?>
<div id="pantalla_gword" ></div>
<div  style="width:700px">
 <div class="form-group">
         <div class="col-xs-6">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_imp()"> GRABAR </button>
		</div>
		  <div class="col-xs-6">
			<button type="button" class="mb-sm btn btn-primary" onclick="imp_cert()"> IMPRIMIR </button>
		</div>
  </div>
  <div style="border: 1px solid #000000" class="TableScrollcertificado" >
  <?php
  echo $lee_plantilla;
  ?>
  <textarea name="textarea_certificado" cols="70" rows="5" id="textarea_certificado">
  <?php
  echo $lee_plantilla;
  ?>
  </textarea>
  </div>
  <br> 
</div>

<script type="text/javascript">
<!--

function guarda_imp()
{

$("#pantalla_gword").load("certificadosd/guardar_word.php",{
ireport:$('#certif_id').val(),
c1:'<?php echo $_POST["c1"]; ?>',
c2:'<?php echo $_POST["c2"]; ?>',
fechai:$('#fechai').val(),
fechaf:$('#fechaf').val(),
especi_id:$('#especi_id').val(),
texto:$('#textarea_certificado').val(),
table:'<?php echo $table; ?>',
valor_id:'<?php echo $valor_id; ?>',
certifg_especialidad:'<?php echo $certifg_especialidad; ?>',
usua_formaciondelprofesional:'<?php echo $rs_bcliente->fields["usua_formaciondelprofesional"]; ?>'

  },function(result){  

ver_listacert();

  });  

  $("#pantalla_gword").html('<img src="cargando.gif" width="120" height="51" />');  

}

$('#textarea_certificado').hide();

//  End -->
</script>