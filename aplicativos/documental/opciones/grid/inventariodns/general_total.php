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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventario</title>

<SCRIPT LANGUAGE=javascript>
<!--



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
-->
</style></head>

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
<?php
 $ncentro= $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$_SESSION['ces1313777_centro_id'],$DB_gogess);
 $centro_id=$_SESSION['ces1313777_centro_id'];
?>
<center><B><?php echo $ncentro; ?></B></center><br />
<hr />
<?php
  $ntabla= $objformulario->replace_cmb("dns_categoriadns","categ_id,categ_nombre"," where categ_id=",$_GET["insu"],$DB_gogess);
  echo "<center><b>".$ntabla."</b></center>";
  ?>

<div id="campo_valor" style="height:20px" ></div>

<div align="center">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>Buscar:</td>
      <td><input name="txtbusca" type="text" id="txtbusca" /></td>
      <td>
	  <?php
	  if($_GET["insu"]==5)
	  {
	  ?>
	  <select name="produ_idip" id="produ_idip" class="Estilo2" >
          <?php
	          printf("<option value=''>---Insumo Preparado--</option>");  
			  $objformulario->fill_cmb("page_producto","produ_id,produ_nombre",""," where catpr_id=7 order by produ_nombre asc",$DB_gogess);
           ?>
      </select>
	  <?php
	  }
	  else
	  {
	     echo '<input name="produ_idip" type="hidden" id="produ_idip" value="" />';
	  }
	  ?>
	  
	  
	  
	  </td>
      <td>
	  
	  <?php
	  if($_GET["insu"]==5 or $_GET["insu"]==7)
	  {
	  ?>
	  <select name="produ_idpp" id="produ_idpp" class="Estilo2" >
          <?php
	          printf("<option value=''>---Producto Preparado--</option>");  
			  $objformulario->fill_cmb("page_producto","produ_id,produ_nombre",""," where catpr_id=3 order by produ_nombre asc",$DB_gogess);
           ?>
       </select>	 
	  <?php
	  }
	  else
	  {
	      echo '<input name="produ_idpp" type="hidden" id="produ_idpp" value="" />';
	  
	  }
	  ?>
	   
	    </td>
  
      <td><input type="button" name="Button2" value="Buscar" onclick="listado_inventario()" /></td>
      <td><input type="button" name="Button" value="Nuevo Producto" onclick="abrir_standar('producto/grid_producto_nuevo.php','Producto','divBody_producto','divDialog_producto',990,600,0,0,0,0,0,0,'<?php echo $_GET["insu"]; ?>')" /></td>
    </tr>
  </table>
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
function calcula_coniva1(campo1,campo2,resultado,id)
{

//alert($('#cmb_'+campo2+id).val());

$("#div_ivavalor").load("calcula_iva.php",{

produ_preciogen:$('#cmb_'+campo1+id).val(),
tari_codigo:$('#cmb_'+campo2+id).val()


  },function(result){  
   
	  $('#cmb_'+resultado+id).val($('#valor_conimpuesto').val());
	  
	  guardar_campos('page_producto','produ_precioventaconiva',id,$('#cmb_produ_precioventaconiva'+id).val(),'produ_id')
	  
	  
  });  

  $("#div_ivavalor").html("Espere un momento...");  
}
	



<?php
$subindice="_producto";
?>

function compras_prk(produ_id,centro_id)
 {
  
	 abrir_standar('movimiento/movimiento.php','Movimiento','divBody<?php echo $subindice; ?>','divDialog<?php echo $subindice; ?>',1200,700,0,0,0,0,0,centro_id,produ_id);
	 
 }

 function preparacion_prk(produ_id)
 {
  
     abrir_standar('ingrediente/ingrediente.php','Preparacion','divBody<?php echo $subindice; ?>','divDialog<?php echo $subindice; ?>',990,600,0,0,0,0,0,0,produ_id);

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


      listado_inventario();
	



  });  

  $("#grid_borrar").html("Espere un momento...");  


  }


}



function listado_inventario()
{

   $("#listado_v").load("listados.php",{

  insu:'<?php echo $_GET["insu"]; ?>',
  txtbusca:$('#txtbusca').val(),
  centro_idb:'<?php echo $centro_id; ?>',
  produ_idpp:$('#produ_idpp').val()
  
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


function listado_buscainventario(nombrecreado,nombrecreado2)
{
var enviotxt; 
 if(nombrecreado!='')
  {
	  enviotxt=nombrecreado;
  }
else
{
	  enviotxt=nombrecreado2;
}

   $("#listado_v").load("listados.php",{

  insu:'<?php echo $_GET["insu"]; ?>',
  txtbusca:enviotxt,
  centro_idb:'<?php echo $centro_id; ?>'
  
  },function(result){  


  });  

  $("#listado_v").html("Espere un momento...");  


}


function borrar_registro_movimiento(tabla,campo,valor)
{


	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 



	 $("#grid_borrar").load("../../../../../aplicativos/documental/opciones/grid/grid_borrar.php",{



     ptabla:tabla,



	 pcampo:campo,



	 pvalor:valor



  },function(result){  


      
	  desplegar_grid_su();
	  listado_inventario();



  });  

  $("#grid_borrar").html("Espere un momento...");  


  }


}


//listado_inventario()	
//  End -->
</script>

<SCRIPT LANGUAGE=javascript>
<!--
function tablas_celdas(id) {

myWindow4=window.open('general_total.php?insu='+id,'ventana_celda','width=100%,height=100%,scrollbars=YES');
myWindow4.focus();

}

//-->
</SCRIPT>

<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="divBody_producto" ></div>
<div id="grid_borrar"></div>


	
</body>
</html>