<script type="text/javascript">

<!--

function ingreso_usuario()

{

   
	

  if ($('#usuario_valor').val()=='')

	{

	alert('Debe llenar el Campo USUARIO:');

	return false;

	}



  if ($('#clave_valor').val()=='')

	{

	alert('Debe llenar el Campo CLAVE:');

	return false;

	}


 if ($('#punto_id').val()==0)

	{

	alert('Debe seleccionar el Punto de emisi\u00f3n:');

	return false;

	}

 

  $("#acceso_usuario").load("libreria/acceso/validar.php",{

  

    accesousuario:'<?php echo $accesousuario ?>',usuario_valor:$('#usuario_valor').val(),clave_valor:$('#clave_valor').val(),punto_id:$('#punto_id').val()

  

  

  },function(result){  



  });  

  $("#acceso_usuario").html("Espere un momento...");





}





function salir_sistema()

{

   $("#acceso_panel").load("libreria/acceso/salir.php",{



  },function(result){  



  });  

  $("#acceso_panel").html("Espere un momento...");  



}









function funcion_cerrar_pop(valor_pop)

{

$('#'+valor_pop).dialog( "close" );

}



function mensajemch()

{

alert("Su perfil no permite el acceso a esta opcion...");

}





function activar_formulario(accesousuario)

{

	

    $("#divBody_ingreso").load("<?php echo $ap_path ?>form_ing.php",{

	accesousuario_p:accesousuario

  },function(result){  

      

  });  

  $("#divBody_ingreso").html("Espere un momento...");  



}



function abrir_pantalla_servicio(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

				location.reload();

									

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




function abrir_standar_pop(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

            modal: false,

           

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}



function abrir_standar_archivo(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7,pregf_id,form_id){	

    var data_divBody=divBody;

	var data_divDialog=divDialog;

	var data_ancho=ancho;

	var data_alto=alto;
	var data_variablepreg=pregf_id;
	var data_variableform=form_id;
	

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

				actualiza_datos(data_variableform,data_variablepreg);

									

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



function ejecuta_imp(parametro,idimp) {
window.open('impresion/imprimir.php?pa=' + parametro +'&imp='+idimp,'IMPRIMIR','width=750,height=600,scrollbars=YES');

}


//  End -->

</script>