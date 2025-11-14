<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

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


?>
<div class="table-responsive">
<table class="table table-bordered" >
<?php
 $cuenta=0;
$lista_servicios="select requ_id,usua_id,app_requerimiento.catag_id,catag_nombre,requ_observacion from app_requerimiento inner join  app_catalogo on app_requerimiento.catag_id=app_catalogo.catag_id where app_requerimiento.catag_id in(select catag_id from app_servicios where usua_id=".@$_SESSION['ces1313777_sessid_inicio'].") order by requ_id desc";
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  $cuenta++;
	  
$busca_existe="select requ_id,manol_aceptado,manol_fechaaceptado,usua_id from app_manolevantada where requ_id=".$rs_data->fields["requ_id"]." and usua_id=".@$_SESSION['ces1313777_sessid_inicio'];
$rs_okexiste = $DB_gogess->executec($busca_existe,array());
$imagen_foto='';
if(@$rs_okexiste->fields["requ_id"])
{
  
  $imagen_foto='images/mlevantada.png';
}
else
{
  $imagen_foto='images/mcerrada.png';
}
  ?>
   <tr bgcolor="#FFFFFF">
    <td>
<blockquote >
<div class="row">


<div class="col-xs-4" >
  <p><?php echo $rs_data->fields["requ_observacion"]; ?></p>
  <small><?php echo utf8_encode($rs_data->fields["catag_nombre"]); ?></small>
 <div id="levanta_<?php echo $rs_data->fields["requ_id"]; ?>" onClick="levantar_mano('<?php echo $rs_data->fields["requ_id"]; ?>','<?php echo @$_SESSION['ces1313777_sessid_inicio']; ?>')" style="cursor:pointer" ><img src="<?php echo $imagen_foto; ?>"></div>
</div>

<div class="col-xs-5" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" ><b>
<?php
if(@$rs_okexiste->fields["manol_aceptado"])
{
  
  $busca_datosus_v="select * from app_usuario where usua_id=?";
  $rs_usuarios_v = $DB_gogess->executec($busca_datosus_v,array($rs_data->fields["usua_id"]));
  echo $rs_usuarios_v->fields["usua_nombre"]." ".$rs_usuarios_v->fields["usua_apellido"]." Acepto su servicios contactese en:<br>";
  echo "Email:".$rs_usuarios_v->fields["usua_email"]."<br>";
  echo "Tel&eacute;fono:".$rs_usuarios_v->fields["usua_celular"]."<br>";
  
}
?></b>
</div>

</div>
</blockquote>
    </td>
	
</tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
 </table> 
</div>  




