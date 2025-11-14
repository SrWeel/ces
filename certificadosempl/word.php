<?php
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
require_once('libletras.php');

$objformulario= new  ValidacionesFormulario();

$obj_NumerosEnLetras=new NumerosEnLetras1();


$busca_certificado="select * from dns_emplcertificados where certif_id='".$valor_busca."'";
$rs_cert = $DB_gogess->executec($busca_certificado,array());

$lee_plantilla=$rs_cert->fields["certif_contenido"];


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);

$fecha_actual=date("Y-m-d");
$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano($fecha_actual);
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

 
$centro_ciudad='';
$centro_ciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_ciudad"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);
$centro_ciudad='La Concordia';
$fecha_textociudad=$centro_ciudad.", ".$objvarios->fechaCastellano($fecha_actual);



$lee_plantilla=str_replace("-fechaciudad-",$fecha_textociudad,$lee_plantilla);
$lee_plantilla=str_replace("-centro-",$nciudad,$lee_plantilla);

$lee_plantilla=str_replace("-desde-",$_POST["fechai"],$lee_plantilla);
$lee_plantilla=str_replace("-hasta-",$_POST["fechaf"],$lee_plantilla);

//lee paciente
$datos_paciente="select * from app_usuario where usua_rucci='".$_POST["c1"]."'";
$rs_pacient = $DB_gogess->executec($datos_paciente,array());

$lista_campos="select * from gogess_sisfield where tab_name='app_usuario' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  //echo $rs_pacient->fields[$rs_campos->fields["fie_name"]]."<br>";
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_pacient->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  
//lee paciente


//datos de rrhh

$busca_clientesrrhh="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) and usua_id='".$rs_pacient->fields["usua_id"]."' order by info_id desc";
$rs_listaclientesrrhh= $DB_gogess->executec($busca_clientesrrhh,array());

$info_fechaingreso=$rs_listaclientesrrhh->fields["info_fechaingreso"];
$fecha_conoce=$objvarios->fechaCastellano($info_fechaingreso);
$info_regimenlaboral=$rs_listaclientesrrhh->fields["info_regimenlaboral"];
$info_unidad=$rs_listaclientesrrhh->fields["info_unidad"];

$unidadt=$objformulario->replace_cmb("app_tipounidad","tipouni_id,tipouni_nombre"," where tipouni_id =",$info_unidad,$DB_gogess);

$lee_plantilla=str_replace("-unidadt-",utf8_decode($unidadt),$lee_plantilla);

$regimen=$objformulario->replace_cmb("cmb_regimenlaboral","tiporeglab_id,tiporeglab_nombre"," where tiporeglab_id =",$info_regimenlaboral,$DB_gogess);

$lee_plantilla=str_replace("-regimenl-",utf8_decode($regimen),$lee_plantilla);

$lee_plantilla=str_replace("-fechainiciot-",$fecha_conoce,$lee_plantilla);

//datos de rrhh

$pinstitucional=$objformulario->replace_cmb("cmb_puestoinstitucional","tipoinst_id,tipoinst_nombre"," where tipoinst_id =",$rs_listaclientesrrhh->fields["info_puestoinstitucional"],$DB_gogess);
$lee_plantilla=str_replace("-puesto-",utf8_decode($pinstitucional),$lee_plantilla);

$lee_plantilla=str_replace("-remuneracion-",$rs_listaclientesrrhh->fields["info_rmu"],$lee_plantilla);

$letra_num=$obj_NumerosEnLetras->convertir($rs_listaclientesrrhh->fields["info_rmu"], $currency = '', $format = false, $decimals = '');
$lee_plantilla=str_replace("-remuneracionlet-",$letra_num,$lee_plantilla);
//busca director de talento humano


$busca_dth="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) and info_puestoinstitucional='83' order by info_id desc";
$rs_listadth= $DB_gogess->executec($busca_dth,array());

$nombre_dth=$rs_listadth->fields["usua_siglastitulo"].'. '.$rs_listadth->fields["usua_nombre"].' '.$rs_listadth->fields["usua_apellido"];

$lee_plantilla=str_replace("-directoth-",ucwords(strtolower($nombre_dth)),$lee_plantilla);


//busca director de talento humano



//lee medico
$datos_paciente="select * from app_usuario where usua_ciruc='".@$_POST["c2"]."'";
$rs_pacient = $DB_gogess->executec($datos_paciente,array());

$lista_campos="select * from gogess_sisfield where tab_name='app_usuario' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_pacient->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
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
					
					$sql_buscount[$num_id]="select count(*) as total from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where (".$rs_diagnost->fields["fie_campofecharegistro"].">='".$_POST["fechai"]."' and ".$rs_diagnost->fields["fie_campofecharegistro"]."<='".$_POST["fechaf"]." 23:59') and usua_ci='".$_POST["c1"]."'";
					
					$rs_diacount = $DB_gogess->executec($sql_buscount[$num_id],array());
					if($rs_diacount->fields["total"]>0)
					{
					
					
					$sql_buscadiag[$num_id]="select distinct * from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where (".$rs_diagnost->fields["fie_campofecharegistro"].">='".$_POST["fechai"]."' and ".$rs_diagnost->fields["fie_campofecharegistro"]."<='".$_POST["fechaf"]." 23:59') and usua_ci='".$_POST["c1"]."'";
					 
					$diagnostico_valor.="<ul>";
					//$diagnostico_valor.="<br>".$rs_diagnost->fields["tab_title"]."<ul>";
					//---------------------------------
						$rs_diagtrs = $DB_gogess->executec($sql_buscadiag[$num_id],array());
						if($rs_diagtrs)
						{
						   while (!$rs_diagtrs->EOF) {
						   
						     $diagnostico_valor.="<li>".$rs_diagtrs->fields["diagn_cie"]." ".$rs_diagtrs->fields["diagn_descripcion"]." ".$rs_diagtrs->fields["diagn_tipo"]."</li>";
						   
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



$lee_plantilla=str_replace("-diagnostico-",utf8_decode("".$diagnostico_valor),$lee_plantilla);

//$diagnostico_valor
//diagnostico


//lee medico FIRMA
$lista_num=0;
$responsables_cuadro='';
$busca_cliente="select * from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where  usua_ciruc='".$_POST["c2"]."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$obtiene_nombres[$lista_num]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."</b><br>".$rs_bcliente->fields["jobt_name"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."<p>&nbsp;</p><p>&nbsp;</p>";
		
$lista_medicos.= $rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"].", ";
$lista_num++;


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

}
?>
<div align="center" style="width:900px">
  <textarea name="textarea_certificado" cols="70" rows="5" id="textarea_certificado">
  <?php
  echo utf8_encode($lee_plantilla);
  ?>
  </textarea>
  
  <br>
  <div class="form-group">
         <div class="col-xs-6">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_imp()"> GRABAR </button>
		</div>
		  <div class="col-xs-6">
			<button type="button" class="mb-sm btn btn-primary" onclick="imp_cert()"> IMPRIMIR </button>
		</div>
  </div>
</div>



<script type="text/javascript">
<!--
$('#textarea_certificado').ckeditor({
      width: 900,
      height: 500
    });

//  End -->
</script>