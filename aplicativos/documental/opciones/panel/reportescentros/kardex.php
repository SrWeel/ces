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
 
 $bodega_principal=$_SESSION['ces1313777_centro_id']; 
 $ncentro= $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$bodega_principal,$DB_gogess);
 $centro_id=$bodega_principal;
?>

<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="imagenes/export_to_excel.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>

<center><B><?php echo $ncentro; ?><br /> KARDEX </B></center><br />  

<div id="campo_valor" style="height:20px" ></div>

<div align="center">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
	  <td>Categor&iacute;a :</td>
	  <td><select name="categ_id" id="categ_id" style="font-size:11px; width:120px" onchange="ver_lista()" >
	        <?php
	          printf("<option value=''>---Categorias--</option>");  
			  $objformulario->fill_cmb("dns_categoriadns","categ_id,categ_nombre","","order by categ_id asc",$DB_gogess);
           ?>		   
	  </select>
	  </td>
      <td>Medicamento / dispositivo :</td>
      <td><div id="listado_p">	  
	   <select name="codigo_pr" id="codigo_pr" style="font-size:11px; width:120px" >
          
      </select>
	  </div>
	  </td>  
      <td>
	  <table cellspacing="2" border="0"><tbody><tr><td onclick="buscar_producto_select()" style="cursor:pointer"><img src="../../../../../images/searchbu.png" width="20" height="18"></td></tr> </tbody></table>
	  
	  </td>
      <td>No. Lote </td>
      <td>
	  <div id="listado_lote">
	  <input name="lote_pr" type="text" id="lote_pr" autocomplete="off" />
	  </div>
	  </td>
      <td>&nbsp;</td>
      <td>Fecha Inicio: </td>
      <td><input name="fechai" type="text" id="fechai" autocomplete="off" /></td>
      <td>&nbsp;</td>
      <td>Fecha Fin: </td>
      <td><input name="fechaf" type="text" id="fechaf" autocomplete="off" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="Button" value="Ver Kardex" onclick="ver_reporte()" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="actualiza_stock" style="height:20px" ></div>
  <br />
</div>

<div id="divBody_productox"></div>

<div id="Exportar_a_Excel">
<div id="listado_v">

</div>
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

if($('#lote_pr').val()=='')
{
  alert("LOTE OBLIGATORIO");
  return false;
}

if($('#fechai').val()=='')
{
  alert("FECHA DESDE OBLIGATORIO");
  return false;
}

if($('#fechaf').val()=='')
{
  alert("FECHA HASTA OBLIGATORIO");
  return false;
}

$("#listado_v").load("r_kardex.php",{
  codigo_pr:$('#codigo_pr').val(),
  lote_pr:$('#lote_pr').val(),
  fechai:$('#fechai').val(),
  fechaf:$('#fechaf').val()
  
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


function buscar_producto_select()
{
   
abrir_standar("buscar_producto_select.php","Buscar","divBody_productox","divDialog_productox",750,450,0,0,0,0,0,0,$('#categ_id').val());
	 
}

function busca_contexto_select()
  {
	  $("#lista_bucx").load("lista_bu.php",{
        bu_txtproducto:$('#bu_txtproducto').val(),
		categ_id:$('#categ_id').val()

	  },function(result){  
	
	
	  });  
	
	  $("#lista_bucx").html("Espere un momento...");  
  
  }	


function selecciona_p(valor)
{
  $('#codigo_pr').val(valor);
  funcion_cerrar_pop('divDialog_productox');
  ver_listalotes(); 
} 


function funcion_cerrar_pop(valor_pop)
{

$('#'+valor_pop).dialog( "close" );

}


function abrir_standar(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

    var data_divBody=divBody;
    var data_divDialog=divDialog;
	var data_ancho=ancho;
	var data_alto=alto;

    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {

        var xobjPadre = $("#"+divBody);

        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"'></div>");
        var xobj = $("#"+data_divDialog);
        xobj.dialog({

            open: function(event, ui) {

                $(".ui-pg-selbox").css({"visibility":"hidden"});
            },
            close: function(event, ui) {

                $(".ui-pg-selbox").css({"visibility":"visible"});
                $(this).remove();

            },
            resizable: false,
            autoOpen: false,
            width: data_ancho,
            height: data_alto,
            modal: true,
        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;
    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}

//  End -->
</script>

<SCRIPT LANGUAGE=javascript>
<!--

$('#fechai' ).datepicker({dateFormat: 'yy-mm-dd'});
$('#fechaf' ).datepicker({dateFormat: 'yy-mm-dd'});

//-->
</SCRIPT>

<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="divBody_producto" ></div>
<div id="grid_borrar"></div>

<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
	
	
</body>
</html>