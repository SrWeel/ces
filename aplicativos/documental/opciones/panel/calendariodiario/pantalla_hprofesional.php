<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44540000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

 $director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
$obj_util=new util_funciones();

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

  $usua_id=$_POST["pVar1"];

  $lista_horarios="select * from clinica_horarios ch inner join app_usuario us on ch.usua_id=us.usua_id inner join dns_listadia ld on ch.dia_id=ld.dia_id where us.usua_id='".$usua_id."' and horario_activo='1'";
  
  ?>
  
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DAE9F3"><div align="center"><strong>DIA</strong></div></td>
    <td bgcolor="#DAE9F3"><div align="center"><strong>HORARIO</strong></div></td>
  </tr>
  <?php
  $rs_lh= $DB_gogess->executec($lista_horarios,array());  
  if($rs_lh)
   {
	   while (!$rs_lh->EOF) {

		 ?>
	     <tr>
			<td><div align="center"><?php echo $rs_lh->fields["dia_nombre"]; ?></div></td>
			<td><div align="center"><?php echo $rs_lh->fields["horario_hora"]." - ".$rs_lh->fields["horario_horafin"]; ?></div></td>
		  </tr>
	   
	     <?php
	      $rs_lh->MoveNext();
	   }
    }	
  
  ?>
</table>
  <?php
     
  
  
}

?>