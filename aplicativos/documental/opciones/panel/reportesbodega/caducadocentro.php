<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

$insu_valorx=$_GET["insu"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kardex</title>

<SCRIPT LANGUAGE=javascript>
<!--



	
//-->
</SCRIPT>

<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.record_table {
    width: 100%;
    border-collapse: collapse;
}
.record_table tr:hover {
    background: #eee;
}
.record_table td {
    border: 1px solid #eee;
}
.highlight_row {
    background: #eee;
}
.error{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FF0000;
	font-weight: normal;
}

.btn {
    display: inline-block;
    padding: 6px 6px;
    margin-bottom: 0;
    font-size: 11px;
    font-weight: 400;
	}
-->
</style>
</head>

<body>
<?php
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
} 

if($insu_valorx==1)
{
 $nombre_lista='Medicamento';
}

if($insu_valorx==2)
{
 $nombre_lista='Dispositivos';
}

$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
?>

<link href="../../../../../templates/page/menu/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../../../../templates/page/dependencies/bootstrap/css/bootstrap.min.css" type="text/css">

<link type="text/css" href="../../../../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../../../js/ui.mask.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../../../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../../../../js/jquery.fixheadertable.js"></script>
<script src="../../../../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<link type="text/css" href="../../../../../templates/page/css/jquery.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../templates/page/js/jquery.dataTables.min.js"></script> 
<link type="text/css" href="../../../../../templates/page/css/responsive.dataTables.min.css" rel="stylesheet" />	
<link type="text/css" href="../../../../../templates/page/css/buttons.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../../../templates/page/js/dataTables.responsive.min.js"></script> 
<script type="text/javascript" src="../../../../../templates/page/js/dataTables.buttons.min.js"></script> 

<link rel="stylesheet" type="text/css" href="../../../../../templates/page/css/jquery.datetimepicker.min.css" >

<script src="../../../../../templates/page/js/jquery.datetimepicker.full.min.js"></script>
<br />

<hr />

<?php
 
 $bodega_principal=55; 
 $ncentro= $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$bodega_principal,$DB_gogess);
 $centro_id=$bodega_principal;
?>
<center><B><?php echo $ncentro; ?><br /> 
CADUCADOS Y POR CADUCAR POR CENTROS </B>
</center><br />  

<div id="campo_valor" style="height:20px" ></div>

<div align="center">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="14"><div align="center"><strong>CENTRO: 
	  
	   <select name="centro_idval" id="centro_idval" onchange="ver_lista()">
		 <?php
	          printf("<option value=''>----</option>");  
			  $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",""," where centro_activosistema=1 and centro_id!=55 order by centro_nombre asc",$DB_gogess);
           ?>	
                </select>
	  
	  </strong></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
	  <td>Categor&iacute;a:</td>
	  <td><select name="categ_id" id="categ_id" style="font-size:11px; width:120px" class="form-control" onchange="oculta_val()">
	        <?php
	          printf("<option value=''>---Categorias--</option>");  
			  $objformulario->fill_cmb("dns_categoriadns","categ_id,categ_nombre","","order by categ_id asc",$DB_gogess);
           ?>		   
	  </select>	  </td>
      <td>&nbsp;</td>  
      <td>&nbsp;</td>
      <td>Sub Categoria: </td>
      <td><div id="sub_c" ><select name="subcateg_idx" id="subcateg_idx" style="font-size:11px;" class="form-control" >
          <?php
	          printf("<option value=''>---Categorias--</option>");  
			  $objformulario->fill_cmb("dns_subcategorias","subcateg_id,subcateg_nombre",""," where subcateg_id in (17,2,1,3) order by subcateg_nombre asc",$DB_gogess);
           ?>
      </select></div></td>
      <td>&nbsp;</td>
      <td>Fecha Corte: </td>
      <td><input name="fechai"  id="fechai" autocomplete="off" class="form-control" value="<?php echo date("Y-m-d"); ?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="button" name="Button" value="Ver Corte" onclick="ver_reporte()" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="actualiza_stock" style="height:20px" ></div>
  <br />
</div>


<div id="listado_v">

</div>
<br />
<?php
}
else
{
echo "Caducada sesion";
}
?>

<div id="div_ivavalor"></div>



<script type="text/javascript">
<!--


function ver_reporte()
{

if($('#codigo_pr').val()=='')
{
  alert("CODIGO PRODUCTO OBLIGATORIO");
  return false;
}

if($('#fechai').val()=='')
{
  alert("FECHA DESDE OBLIGATORIO");
  return false;
}

$("#listado_v").load("r_caducadocentro.php",{
  fechai:$('#fechai').val(),
  categ_id:$('#categ_id').val(),
  centro_id:$('#centro_idval').val(),
  subcateg_id:$('#subcateg_idx').val()
  
 },function(result){       

  });  

$("#listado_v").html("Espere un momento...");

}

function ver_lista()
{

  $("#listado_p").load("listap.php",{
  categ_id:$('#categ_id').val()
  
 },function(result){       

  });  

$("#listado_p").html("Espere un momento...");

}


function ver_listalotes()
{

  $("#listado_lote").load("listalote.php",{
  categ_id:$('#categ_id').val(),
  codigo_pr:$('#codigo_pr').val()
  
 },function(result){       

  });  

$("#listado_lote").html("Espere un momento...");

}


function oculta_val()
{
  if($('#categ_id').val()==1)
  {
    $('#sub_c').hide();
  
  }
  else
  {
  
     $('#sub_c').show();
  }

}


//$('#sub_c').hide();

//  End -->
</script>

<SCRIPT LANGUAGE=javascript>
<!--

$('#fechai' ).datepicker({dateFormat: 'yy-mm-dd'});
//$('#fechaf' ).datepicker({dateFormat: 'yy-mm-dd'});

//-->
</SCRIPT>

<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="divBody_producto" ></div>
<div id="grid_borrar"></div>


	
</body>
</html>