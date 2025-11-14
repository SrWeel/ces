<?php
@$funcionextrag=@$objformulario->tab_valextguardar;
$separa_data=explode(",",@$objtableform->tab_campoprimario);

$objformulario->idvalor_validador=@$csearch;
$concatecacampoprymary='';
for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
{
	$concatecacampoprymary=$concatecacampoprymary."p".$separa_data[$i_campo].":"."$('#".$separa_data[$i_campo]."').val()".",";
}
$concatecacampoprymary=substr($concatecacampoprymary,0,-1);

?>
<SCRIPT LANGUAGE=javascript>
<!--

function nuevo_<?php echo str_replace(".","_",@$table); ?>()
{
<?php

 $dataenc='';
 $armaencrip="geamv=".@$geamv."&campoant=".@$campoant."&tableant1=".@$tableant1."&valorlocal=".@$table."&tableant=".@$tableant."&listab=".@$listab."&campo=".@$campo."&obp=".@$obp;
//echo $armaencrip;
 $dataenc=base64_encode($armaencrip);
 $linknuevo="index.php?mp=".$dataenc;
  ?>
$(location).attr('href', '<?php echo $linknuevo ?>');

}

<?php
  $objformulario->campoorden=@$campoorden;
  $objformulario->forden=@$forden;
  $objformulario->id_inicio=@$id_inicio; 
  $comillasimple="'";
  
  ///opciones despues que guarda
  
     $funciones_cuandoguarda='
	 aparecer_mensaje();
	 $("#div_'.str_replace(".","_",$table).'").html("<span style='.$comillasimple.'font-size:11px; color:green;'.$comillasimple.'>Guardado con exito...</span>");
	 desaparecer_mensaje();	  
	 '.@$funcionextrag; 
	 
  //opcinies despues que guarda 
  

?>

function desaparecer_mensaje()
{
    
	setTimeout(function () { $('#div_<?php echo str_replace(".","_",$table); ?>').fadeOut(); }, 2000);
  
}

function aparecer_mensaje()
{
    
	setTimeout(function () { $('#div_<?php echo str_replace(".","_",$table); ?>').fadeIn(); },1);
  
}

function pop_up_pantalla(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#divBody_popup");
        xobjPadre.append("<div id='divDialogo_popup'  title='"+titulopantalla+"'></div>");
        var xobj = $("#divDialogo_popup");

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
            width: 500,
            height: 400,
            modal: true,
            buttons: {
                "Cerrar": function() {

                    $(this).dialog( "close" );
                }
            }
        });
        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});
        xobj.dialog( "open" );
        return false;
    }
    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);
}


function abrir_pantalla(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
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

//-->
</SCRIPT>

<SCRIPT LANGUAGE=javascript>
<!--
function ejecutar_grid(tabla)
{

 $("#grid_tabla").load("libreria/grid/grid_tablas.php",{
    ptabla:tabla,
	pcampoenl:'<?php echo @$campo; ?>',
	plistab:'<?php echo @$listab; ?>',
	pobp:'<?php echo @$obp; ?>'
  },function(result){  

  });  
  $("#grid_tabla").html("Espere un momento...");  

}


function ejecutar_formulario_<?php echo str_replace(".","_",$table); ?>(){
    var options = {
        target: '#div_<?php echo str_replace(".","_",$table); ?>',
        type: 'post',
        url:'libreria/ejecuta/procesar.php',
        data: {opcion:$('#opcion_<?php echo str_replace(".","_",$table) ?>').val(),tabla:'<?php echo $table ?>',<?php echo $concatecacampoprymary ?>},
        success: function(result) {
		//alert("Holaaa");
		eval(result);
            if(result_global=="1") 
			{
			   
			   <?php
			   echo $funciones_cuandoguarda;
			   ?>
			   
			   if($('#opcion_<?php echo str_replace(".","_",$table); ?>').val()=='guardar')
			   {
			  // $('#opcion_<?php echo $table ?>').val('actualizar');
			  
			  <?php
			  $dataenc='';
			  $armaencrip="geamv=".@$geamv."&campoant=".@$campoant."&tableant1=".@$tableant1."&valorlocal=".@$table."&tableant=".@$tableant."&listab=".@$listab."&campo=".@$campo."&obp=".@$obp;
			  $dataenc=base64_encode($armaencrip);
			  $linkgr="index.php?mp=".$dataenc;
			  	?>		  			    
			  $(window).attr('location', '<?php echo @$linkgr ?>');
			   
			   
			   
				} 
				 
				ejecutar_grid('<?php echo $table ?>')
			  
			}
			else
			{
			 $("#div_<?php echo str_replace(".","_",$table); ?>").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Error al realizar el proceso, por favor intente mas tarde...</span>");
			}
		
		}
    };

   $("#div_<?php echo str_replace(".","_",$table); ?>").html("<table border=0><tr><td></td><td><span style='font-size:11px; color:green;'>Ejecutando...</span></td></tr></table>");
   $("#form_<?php echo str_replace(".","_",$table); ?>").ajaxSubmit(options);	
}


$.validator.setDefaults({
    debug: true,submitHandler: function(form) {	
	
	ejecutar_formulario_<?php echo str_replace(".","_",$table); ?>();
	}
	
	
});


$(document).ready(function() {

ejecutar_grid('<?php echo $table ?>');
<?php 
//GENERA FORMATOS
 $objformulario->generar_script_formatos($table,1,@$varsend,$DB_gogess);
 echo "\n\n";
?>

 $("#form_<?php echo str_replace(".","_",$table); ?>").validate({ 
<?php
//GENERA VALIDACIONES
 $objformulario->generar_script($table,2,@$varsend,$DB_gogess);
//GENERA FORMATOS
?>
  });	

});	

//-->
</SCRIPT>


<SCRIPT LANGUAGE=javascript>
<!--
<?php
  
 $objformulario->generar_script(@$table,3,@$varsend,$DB_gogess);
echo "\n\n";
 $objformulario->generar_script(@$table,4,@$varsend,$DB_gogess);
echo "\n\n";
$objformulario->generar_script(@$table,5,@$varsend,$DB_gogess);
 
?>
//-->
</SCRIPT>

<script language="javascript">
<!--

function agregar_detalle(link,tab_id) {
myWindow2=window.open(link,'ventana'+tab_id,'width=750,height=500,scrollbars=YES');

 myWindow2.focus();

}

function fecha_bloqueasigna(dia,mes,anio,campo)
{
    var fechallega;
    fechallega=$('#'+anio).val()+"-"+$('#'+mes).val()+"-"+$('#'+dia).val();
   $('#'+campo).val(fechallega);
}
//-->
</script>
