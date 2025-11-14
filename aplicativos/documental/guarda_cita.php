<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

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
$comillasimple="'";

$anio= @$_POST["anio"];

$mes=str_pad(@$_POST["mes"], 2, "0", STR_PAD_LEFT);
$dia=str_pad(@$_POST["dia"], 2, "0", STR_PAD_LEFT);

$fich_id= @$_POST["fich_id"];
$hora_sel= @$_POST["hora_sel"];
$hora_estado= @$_POST["hora_estado"];
$vetr_id= @$_POST["vetr_id"];
$sala_id= @$_POST["sala_id"];

$horat=$objformulario->replace_cmb("app_horas","hora_id,hora_tiempo"," where hora_id=",$hora_sel,$DB_gogess);
$fecha_se=$anio."-".$mes."-".$dia;

if($hora_estado)
{
  $acitva=1;
}
else
{
  $acitva=0;
}


$busca_sicruza="select * from app_cita where fich_id not in('".@$_POST["fich_id"]."') and sala_id='".$sala_id."' and cit_fecha='".$fecha_se."' and cit_hora='".$horat."'";
$rs_buscaccruza = $DB_gogess->executec($busca_sicruza,array());

if($rs_buscaccruza->fields["cit_id"])
{



   echo '
   
   <script type="text/javascript">
<!--
   alert("La sala ya esta ocupada seleccione otra sala, otra hora o fecha");
   
   //  End -->
</script>
   ';
   
}
else
{

$busca_ot="select * from app_cita where fich_id ='".@$_POST["fich_id"]."' and sala_id='".$sala_id."' and cit_fecha='".$fecha_se."' and cit_hora='".$horat."'";
$rs_buscaccruzaot = $DB_gogess->executec($busca_ot,array());
if($rs_buscaccruzaot->fields["cit_id"])
{
echo '
   
   <script type="text/javascript">
<!--
   alert("Ya tiene una cita asignada en esa sala");
   
   //  End -->
</script>
   ';

}
else
{
//----------------


$busca_reg="select * from app_cita where fich_id='".@$_POST["fich_id"]."' and vetr_id='".$vetr_id."' and sala_id='".$sala_id."' and cit_fecha='".$fecha_se."' and cit_hora='".$horat."'";
$rs_buscac = $DB_gogess->executec($busca_reg,array());
if($rs_buscac->fields["cit_id"])
{

  $actualiza_data="update app_cita set cit_confirmado='".$acitva."' where cit_id=".$rs_buscac->fields["cit_id"];
  $rs_okacx = $DB_gogess->executec($actualiza_data,array());

}
else
{

  $ingresa_reg="insert into app_cita (fich_id,vetr_id,sala_id,cit_fecha,cit_hora,cit_confirmado,cit_fecharegistro) values ('".$fich_id."','".$vetr_id."','".$sala_id."','".$fecha_se."','".$horat."',1,'".date("Y-m-d")."')";
  $rs_okacx = $DB_gogess->executec($ingresa_reg,array());
}


//-----------------------
}

}
?>