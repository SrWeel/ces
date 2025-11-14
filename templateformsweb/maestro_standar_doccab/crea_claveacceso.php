<?php
$tiempossss=340000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

function agregar_dv($_rol) {
    /* Remuevo los ceros del comienzo. */
    while($_rol[0] == "0") {
        $_rol = substr($_rol, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "1" : $dv);
    return $dv;
}

//10032016 01 0992460598001 2 001001000003010 0000301015
$fechaemi=$_POST["doccab_fechaemision_cliente"];
$tipocx=$_POST["tipocmp_codigo"];
$idempval=$_POST["emp_id"];

$faccab_nfactura=$_POST["doccab_ndocumento"];
$banderaencontro=$_POST["doccab_id"];


$fechahora_clv=explode(" ",$fechaemi);
$solofecha_clv=explode("-",$fechahora_clv[0]);

$rucempresa=$objformulario->replace_cmb("app_empresa","emp_id,emp_ruc","where emp_id=",$idempval,$DB_gogess);	

$ambiente_valorc=$objformulario->replace_cmb("app_empdocumento","emp_id,ambi_valor","where tipocmp_codigo='".$tipocx."' and emp_id=",$idempval,$DB_gogess);
$emision_valorc=$objformulario->replace_cmb("app_empdocumento","emp_id,tipoemi_codigo","where tipocmp_codigo='".$tipocx."' and emp_id=",$idempval,$DB_gogess);

$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$rucempresa.$ambiente_valorc.str_replace("-","",$faccab_nfactura);	

//$numocho_dig=randomString(8);	

//---codigo
			//$codigoclv8=$sacacamposc[12]*1;
$numocho_dig= substr($banderaencontro, -8); 
	
//---codigo

$numerogenerado=$claveacc.$numocho_dig.$emision_valorc;
$numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$emision_valorc.$numerovalidador;

$actualiza_data="update app_documentocabecera set doccab_clavedeaccesos='".$clavegenerada."' where doccab_id='".$banderaencontro."'";
$rs_acceso = $DB_gogess->executec($actualiza_data,array());

echo '<input name="cacceso_cal" type="hidden" id="cacceso_cal" value="'.$clavegenerada.'">';

}
?>
