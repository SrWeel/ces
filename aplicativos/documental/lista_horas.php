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

$listacitas="select * from app_horas";	 
$rs_lcitas = $DB_gogess->executec($listacitas,array());

   $anio= @$_POST["anio"];
  
   $mes=str_pad(@$_POST["mes"], 2, "0", STR_PAD_LEFT);
   $dia=str_pad(@$_POST["dia"], 2, "0", STR_PAD_LEFT);
   
   $fich_id= @$_POST["fich_id"];
   $vetr_id=$_POST["vetr_id"];
   $sala_id=$_POST["sala_id"];
   //$horat=$objformulario->replace_cmb("app_horas","hora_id,hora_tiempo"," where hora_id=",$hora_sel,$DB_gogess);
   $fecha_se=$anio."-".$mes."-".$dia;
   
   $fecha_hora=date("Y-m-d H:i:s");
   
?>
<table width="300" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td><strong>HORA</strong></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $marca_data='';
  $estado_chek='';
  $comill_simple="'";
  if($rs_lcitas)
	       {
		       while (!$rs_lcitas->EOF) {
			   
			   //$busca_reg="select * from app_cita where cit_fecha='' and cit_hora=''";
			   $horat=$objformulario->replace_cmb("app_horas","hora_id,hora_tiempo"," where hora_id=",$rs_lcitas->fields["hora_id"],$DB_gogess);
			   $busca_reg="select * from app_cita where fich_id='".@$fich_id."' and vetr_id='".$vetr_id."' and sala_id='".$sala_id."' and cit_fecha='".$fecha_se."' and cit_hora='".$horat."'";
                $rs_buscac = $DB_gogess->executec($busca_reg,array());
				if($rs_buscac->fields["cit_confirmado"])
				{
				$estado_chek='checked';
				}
				else
				{
				$estado_chek='';
				}
				
				$fehca_listahora=$fecha_se." ".$horat;
				if($fecha_hora<=$fehca_listahora)
				{
				
				$marca_data='<input name="checkbox_'.$rs_lcitas->fields["hora_id"].'" type="checkbox" id="checkbox_'.$rs_lcitas->fields["hora_id"].'" value="1" onClick="guarda_cita('.$comill_simple.$rs_lcitas->fields["hora_id"].$comill_simple.')"  '.$estado_chek.' >';
				
				}
				else
				{
				 if($estado_chek)
				 {
				 $marca_data='<img src="images/marca.png">';
				  }
				  else
				  {
				  $marca_data='<img src="images/marca_off.png">';
				  }
				
				}
  ?>
  <tr>
    <td><?php echo 	$rs_lcitas->fields["hora_tiempo"]; ?></td>
    <td><?php echo $marca_data; ?></td>
  </tr>
  <?php
    $rs_lcitas->MoveNext();
			   }
		  
		   }
  ?>
</table>
