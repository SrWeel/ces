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
<title>Inventario</title>

<SCRIPT LANGUAGE=javascript>
<!--

function ac_stock()
{

var txt;
var r = confirm("Si esta seguro que nadie esta usando el sistema, ejecute este proceso.");
if (r == true) {

$("#actualiza_stock").load("actualiza_stock.php",{


 },function(result){       
     listado_facturas();
  });  

$("#actualiza_stock").html("Espere un momento...");


} 


}

function compilar_app()
{

$("#campo_compilar").load("../../../compilador/index.php",{


 },function(result){       

  });  

$("#campo_compilar").html("Espere un momento...");


}

function guardar_campos(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valor").load("guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}


function borrar_campos(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valor").load("borrar.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}


	
//-->
</SCRIPT>
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

$buus_lab='';
$buus_lab=$objformulario->replace_cmb("app_usuario","usua_id,usua_laboratorio"," where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
						   
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
    padding: 4px 4px;
    margin-bottom: 0;
    font-size: 11px;
    font-weight: 400;
}
	
-->
</style>
<hr />

<?php
 
 $bodega_principal=55; 
 $ncentro= $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$bodega_principal,$DB_gogess);
 $centro_id=$bodega_principal;
?>
<center><B><?php echo $ncentro; ?><br /> FACTURAS DE COMPRA </B><br /><?php

if($buus_lab=='1')
{
 echo 'LABORATORIO<BR>';
}


?><br />
  <table border="0">
    <tr>
      <td><img src="alerta.png" width="20" height="18" /></td>
      <td>Observaciones en productos </td>
    </tr>
    <tr>
      <td><img src="sinverificar.png" width="20" height="18" /></td>
      <td>Aun hay items no verificados y aceptados </td>
    </tr>
	<tr>
      <td><img src="sinreg.png" width="20" height="18" /></td>
      <td>Sin registros </td>
    </tr>
	<tr>
	  <td bgcolor="#87DAA8">&nbsp;</td>
	  <td><strong>RED P&Uacute;BLICA </strong></td>
    </tr>
  </table>
</center><br />  

<div id="campo_valor" style="height:20px" ></div>

<div align="center">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td nowrap="nowrap">CUM o CUDIM:</td>
      <td><input name="atc_val" type="text" id="atc_val" /></td>
      <td>&nbsp;</td>
      <td>Buscar:</td>
      <td><input name="txtbusca" type="text" id="txtbusca" /></td>
   
  
      <td><input type="button" name="Button2" value="Buscar/Actualizar" onclick="listado_facturas()" /></td>
      <td><!-- <input type="button" name="Button" value="Nueva Factura de Compra" onclick="abrir_standar('compras/grid_compras_nuevo.php','Producto','divBody_producto','divDialog_producto',800,600,0,0,0,0,0,'<?php echo $bodega_principal; ?>','<?php echo $_GET["insu"]; ?>')" /> --> </td>
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
//produ_preciogen
//tari_codigo
<?php
$subindice="_factura";
?>

function compras_prkprod(compra_id)
 {
    //alert(compra_id);
	 abrir_standar('movimiento_compras/movimiento.php','Compras_<?php echo $nombre_lista; ?>','divBody<?php echo $subindice; ?>','divDialog<?php echo $subindice; ?>',990,700,0,compra_id,0,0,0,'<?php echo $bodega_principal; ?>','<?php echo $insu_valorx; ?>');
	 
 }
 
 
function compras_prkmov(produ_id)
 {
  
	 abrir_standar('movimiento/movimiento_mov.php','Movimiento','divBody<?php echo $subindice; ?>','divDialog<?php echo $subindice; ?>',990,700,0,produ_id,0,0,0,0,0);
	 
 } 

 function preparacion_prk(produ_id)
 {
  
     abrir_standar('ingrediente/ingrediente.php','Preparacion','divBody<?php echo $subindice; ?>','divDialog<?php echo $subindice; ?>',990,600,0,produ_id,0,0,0,0,0);

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
    

function borrar_registro_bu(tabla,campo,valor)
{

if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 

	 $("#grid_borrar").load("../../../../../aplicativos/documental/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){ 

      listado_facturas();

  });  

  $("#grid_borrar").html("Espere un momento...");  

  }

}



function listado_facturas()
{

  var path;
  
 <?php
 if($buus_lab=='1')
 {
   echo "path='listados_faclab.php'";
 }
 else
 {
   echo "path='listados_fac.php'";
 
 }
 ?>

   $("#listado_v").load(path,{

  insu:'<?php echo $_GET["insu"]; ?>',
  txtbusca:$('#txtbusca').val(),
  atc_val:$('#atc_val').val()
  
  },function(result){  


  });  

  $("#listado_v").html("Espere un momento...");  


}

function funcion_cerrar_pop(valor_pop)
{
$('#'+valor_pop).dialog( "close" );
}

function actualiza_despuesg()
{
   
   actualiza_cmb();
   //$('#proveevar_id').val($('#provee_id').val());

}

function actualiza_cmb()
{
     
	 $("#cmb_proveevar_id").load("../proveedor_d/cmb_proveedor.php",{

	  },function(result){  
	  //alert($('#provee_id').val());
	      $('#proveevar_id').val($('#provee_id').val());
		    
	  });  
	
	  $("#cmb_proveevar_id").html("...");  

}


function listado_buscainventario(nombrecreado)
{
  var path;
  
 <?php
 if($buus_lab=='1')
 {
   echo "path='listados_faclab.php'";
 }
 else
 {
   echo "path='listados_fac.php'";
 
 }
 ?>
  
   $("#listado_v").load(path,{

  insu:'<?php echo $_GET["insu"]; ?>',
  txtbusca:nombrecreado
  
  },function(result){  


  });  

  $("#listado_v").html("Espere un momento...");  


}


listado_facturas()	
//  End -->
</script>

<SCRIPT LANGUAGE=javascript>
<!--
function tablas_celdas(id) {

myWindow4=window.open('general_total.php?insu='+id,'ventana_celda','width=100%,height=100%,scrollbars=YES');
myWindow4.focus();

}



$(".messages").hide();
//queremos que esta variable sea global
var fileExtension = "";
//función que observa los cambios del campo file y obtiene información

function informacion_archivo(campo)
{

       //obtenemos un array con los datos del archivo
        var file = $("#"+campo+"imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
		var megas=0;
		megas=eval(fileSize)/1048576;

        showMessage("<span class='info"+campo+"' style='padding: 10px; border-radius: 10px; background: orange; color: #fff;font-family:Verdana, Arial, Helvetica, sans-serif;text-align: center;font-size:11px;' >Peso: "+megas.toFixed(4)+" MB.</span>",campo);


}


function subir_archivo(ncampo,table)
{

   if(isImage(fileExtension))
     {

     var formData = new FormData($("#form_"+table)[0]);
	 formData.append("ncampo",ncampo);
	 var nombre_campo=ncampo;
        var message = ""; 

        //hacemos la petición ajax  

        $.ajax({
            url: '../../../../../libreria/archivo/uploadinv.php',  
            type: 'post',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){

                message = $("<span class='before' >Subiendo imagen, por favor espere</span>");
                showMessage(message,nombre_campo)        
            },
            //una vez finalizado correctamente
            success: function(data){
			if(data.trim()!='')
					{

                message = $("<span class='success' >Imagen ha subido correctamente.</span>");

				}
else
{
 message = $("<span class='success' >Por favor seleccione un archivo.</span>");
}

                showMessage(message,nombre_campo);
                if(isImage(fileExtension))
                {


					if(data.trim()!='')
					{

					$(".showImage"+ncampo).html("&nbsp;<a href='../../../../../archivoinv/"+data+"' target='_blank' class='thumbnail' ><img src='../../../../../images/file.png' alt='125x125' width='40px' ></a>");

					}
                }
				else
				{
				  if(data.trim()!='')
					{
				   $(".showImage"+ncampo).html("&nbsp;<a href='../../../../../archivoinv/"+data+"' target='_blank' class='thumbnail' ><img src='../../../../../images/file.png' alt='125x125' width='40px' ></a>");
				   }

				}
				$('#'+nombre_campo).val(data);
            },

            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error' >Ha ocurrido un error. Seleccione el archivo</span>");
                showMessage(message,nombre_campo);
            }
        });

 }
   else
   {
    alert("Archivo no permitido solo (jpg,png,gif,zip)");
   }

}


//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message,campo){

    $(".messages"+campo).html("").show();
    $(".messages"+campo).html(message);
}

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido

function isImage(extension)
{

    switch(extension.toLowerCase()) 
    {

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF': case 'zip': case 'xml':
            return true;
        break;
        default:
            return false;
        break;
    }
}


function refreshFrame(nframe,path){

    $('#'+nframe).attr('src', path);

}


//-->
</SCRIPT>

<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="divBody_producto" ></div>
<div id="grid_borrar"></div>


	
</body>
</html>