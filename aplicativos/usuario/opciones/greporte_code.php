<?php
//CONFIGURACIONES
$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);
$subindice="_report";
?>
<style type="text/css">
<!--
.Estilo2 {font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo4 {font-size: 8px}
-->
</style>
<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid<?php echo $subindice ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>.php",{

  },function(result){  

  });  
  $("#grid<?php echo $subindice ?>").html("Espere un momento...");  

}

function desplegar_grid_buscar()
{
   $("#grid<?php echo $subindice ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>.php",{
    rept_nombre_val:$('#rept_nombre_val').val(),
	rept_activo_val:$('#rept_activo_val').val()
  },function(result){  

  });  
  $("#grid<?php echo $subindice ?>").html("Espere un momento...");  

}



function guarda<?php echo $subindice ?>_fin(divresultado,mensaje)
{
  

  $('#'+divresultado).html(mensaje);  
  desplegar_grid();
  
  setTimeout(function () { funcion_cerrar_pop('divDialog<?php echo $subindice ?>') }, 2000);
 

}

///cuando guarda un usuario
function guarda<?php echo $subindice ?>_nuevo(divresultado,mensaje)
{
  
   $('#'+divresultado).html(mensaje);    

 $("#div_buscarepg").load("aplications/usuario/opciones/extras/reporte_guardado.php",{
  rept_aleatunico:$('#rept_aleatunico').val()
  },function(result){  
    
	$('#rept_id').val($('#idguardado').val());
	$('#despliegue_rept_id').html($('#idguardado').val());
	
	$('#div_panelprint').show();

  });  
  $("#div_buscarepg").html("Espere un momento...");  



}


function borrar_registro(tabla,campo,valor)
{
     
	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 


	 $("#grid_borrar").load("aplications/usuario/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){  
      desplegar_grid();
	  
  });  
  $("#grid_borrar").html("Espere un momento...");  
  
  
  }

}

//  End -->
</script>
<SCRIPT LANGUAGE=javascript>
<!--
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


function abrir_standar_bu(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
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
<div align="center">
 <div id=grid_borrar ></div>

 <span class="Estilo4">&nbsp; </span>
 <?php
					
						 				
						  
					$linkeditar='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Editar","divBody'.$subindice.'","divDialog'.$subindice.'",880,600,0,0,0,0,0,0,0) style=cursor:pointer';
					
					$link_panel_buscar='onclick=abrir_standar_bu("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar","div_dialog_buscar",900,600,0,0,0,0,0,0,0) style=cursor:pointer';
					
					
				
					
						?>
 <?php
  //Menu Generico
  $objmenuFactura = new  menu_generico($linkeditar,$link_panel_buscar,$linklote,'','',$objperfil);  
  $objmenuFactura->desplegar_menu();
  
  ?>
 <span class="Estilo4">&nbsp; </span></div>
<div id=divBody<?php echo $subindice ?> ></div>
<div id="div_body_buscar" ></div>
<div id="div_body_opcionu" ></div>
<div id="div_buscarepg" ></div>