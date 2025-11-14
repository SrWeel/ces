<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("lib_ruc.php");



$objcedularuc= new ValidarIdentificacion();
//Conexion a la base de datos
$comparativa1=0;
$comparativa2=0;



$valor_enlace='';
$tabla_gridvalor="dns_representante";
$campo_id='repres_id';
$campo_enlace='clie_enlace';
$campo_fecharegistro='repres_fecharegistro';
$campo_usuarioregistra='usua_id';
$campos_data=array('repres_ci','repres_nombre','repres_telefono','repres_parentesco','repres_observacion');
$campos_datainserta=array('tipoident_codigo','repres_ci','repres_nombre','repres_telefono','repres_parentesco','repres_observacion','usua_id');
$campos_name=array('CI','Nombre','Tel&eacute;fono','Parentesco','Observaci&oacute;n');

$sqlcampos='';
 for($i=0;$i<count($campos_data);$i++)
	 {
	     $sqlcampos=$sqlcampos.",".$campos_data[$i];
	 }
$sqlcampos=substr($sqlcampos,1);



?>

<style type="text/css">
<!--

.txt_titulo {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

	border: 1px solid #666666;			

 }

.txt_txt {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	border: 1px solid #666666;			

 }

.Estilo1 {font-size: 10px}

-->

</style>

<?php
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


if($_POST["opcion"]==2)
{

$borra_reg="delete from ".$tabla_gridvalor." where clie_enlace=".$_POST["enlace"]." and repres_id=".$_POST["idgrid"];
$rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{

$resultado_val=0;
if(trim($_POST["tipoident_codigox"])=='04' OR trim($_POST["tipoident_codigox"])=='05' )
{

//------------------------------------------------
$numero = trim($_POST['repres_cix']);
$numeroc_validar=$_POST['repres_cix'];

if(strlen($numero)==10)
{

   $resultado_val=$objcedularuc->validarCedula($numeroc_validar);

}



if(strlen($numero)==13)
{

//-----------------------------------------------

    if ($numero[2] >= 0 OR $numero < 6) {                    
					$resultado_val=$objcedularuc->validarRucPersonaNatural($numeroc_validar);
	                }

    if ($numero[2] == 9) {
                   $resultado_val=$objcedularuc->validarRucSociedadPrivada($numeroc_validar);
                }

     if ($numero[2] == 6) {
                   $resultado_val=$objcedularuc->validarRucSociedadPublica($numeroc_validar);
                }
//-----------------------------------------------
}


//----------------valida cedula
if($resultado_val)
 {
   $comparativa1=1;  
  }
else
{
  $comparativa1=0;
}
//----------------valida cedula

//-------------------------------------------------
}
else
{
  $comparativa1=1; 

}

if($comparativa1==1)
{

if($_POST["repres_idx"]>0)
{
$sql_actualiza="update dns_representante set tipoident_codigo='".$_POST["tipoident_codigox"]."',repres_ci='".$_POST["repres_cix"]."',repres_nombre='".$_POST["repres_nombrex"]."',repres_telefono='".$_POST["repres_telefonox"]."',repres_parentesco='".$_POST["repres_parentescox"]."',repres_observacion='".$_POST["repres_observacionx"]."',repres_fecharegistro='".date("Y-m-d")."',usua_id='".$_SESSION['ces1313777_sessid_inicio']."' where repres_id=".$_POST["repres_idx"];
$rs_inserta = $DB_gogess->executec($sql_actualiza,array());
}
else
{
 $sql_inserta=$objvarios->genera_insert($tabla_gridvalor,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_SESSION['ces1313777_sessid_inicio'],date("Y-m-d"),$_POST,$campos_datainserta);
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

//------------------------------------------
//inserta en cliente

$inserta_parafactura="INSERT INTO `efacfactura_cliente` ( `emp_id`, `tipoident_codigocl`, `client_ciruc`, `client_nombre`, `client_sexo`, `client_direccion`, `client_telefono`, `client_celular`, `client_mail`, `client_fechareg`, `sisu_id`, `client_emailextra`) VALUES
( '".$_SESSION['ces1313777_sessid_emp_id']."', '".$_POST["tipoident_codigox"]."', '".$_POST["repres_cix"]."', '".$_POST["repres_nombrex"]."', '', '', '".$_POST["repres_telefonox"]."', '', '', '".date("Y-m-d")."', 0, '');";

$rs_factura = $DB_gogess->executec($inserta_parafactura,array());

//-------------------------------------------


}


  echo '<input name="si_ci" type="hidden" id="si_ci" value="1">';

}
else
{
  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">CI Incorrecto...</div></center>';
  echo '<input name="si_ci" type="hidden" id="si_ci" value="0">';


}

}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>
	<td>Editar</td>
	
	<?php
	for($i=0;$i<count($campos_name);$i++)
	 {
		 echo '<td>'.$campos_name[$i].'</td>';
		 
	 }
	?>

  </tr>

  <?php


$cuenta=0;
$lista_servicios="select ".$campo_id.",".$campo_enlace.",".$sqlcampos." from ".$tabla_gridvalor." where ".$campo_enlace."='".$_POST['enlace']."'";
$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
	
	<td onClick="grid_editar_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>
	
	<?php
	for($i=0;$i<count($campos_data);$i++)
	 {
		 echo '<td>'.$rs_data->fields[$campos_data[$i]].'</td>';
		 
	 }
	?>
  </tr>
  <?php
   $rs_data->MoveNext();	   

	  }
  }
  ?>
</table>
<input name="si_capacitacion" type="hidden" id="si_capacitacion" value="<?php echo $cuenta ?>">
</div>