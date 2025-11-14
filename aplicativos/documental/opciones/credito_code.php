<?php

//CONFIGURACIONES

$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);





$subindice="_credito";

 //datos de la empresa

 $idempresatxt=$objformulario->replace_cmb("factur_usuarios","id_usuario,id_empresa","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);



$nusuariotxt=$objformulario->replace_cmb("factur_usuarios","id_usuario,usuario_username","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);

$nombretxtempresa=$objformulario->replace_cmb("efacfactura_empresa","id_empresa,dat_razon_social","where id_empresa=",$idempresatxt,$DB_gogess);



$ructxt_empresa=$objformulario->replace_cmb("efacfactura_empresa","id_empresa,empresa_ruc","where id_empresa=",$idempresatxt,$DB_gogess);



$objCfgSistema->sistema_data_cfg($idempresatxt,$DB_gogess);			



 $lista_tifac="select * from  factur_tipofactur where id_empresa=".$idempresatxt." and tifac_activo=1" ;

    

	 $rs_gogesstipfac = $DB_gogess->Execute($lista_tifac);

		   $tipofac=$rs_gogesstipfac->fields["tifac_facturacion"];

			



 //datos de la empresa



?>

<style type="text/css">

<!--

.Estilo2 {font-size: 10px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

}

.Estilo4 {font-size: 8px}

.Estilo5 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }





table.fija{

border: #000000 2px solid;

box-shadow: 2px -2px 2px #000;



}







.buttoncarrito {

		border: none;

		background: #3a7999;

		color: #f2f2f2;

		padding: 10px;

		font-size: 18px;

		border-radius: 5px;

		position: relative;

		box-sizing: border-box;

		transition: all 500ms ease; 

	}	

.buttoncarrito{

 padding: 10px 35px;

 overflow:hidden;

}

.buttoncarrito:before {

 font-family: FontAwesome;

 content: "\f07a";

 position: absolute;

 top: 11px;

 left: -30px;

 transition: all 200ms ease;

}

.buttoncarrito:hover:before {

 left: 7px;

}





.buttonasigna {

		border: none;

		background: #3a7999;

		color: #f2f2f2;

		padding: 10px;

		font-size: 18px;

		border-radius: 5px;

		position: relative;

		box-sizing: border-box;

		transition: all 500ms ease; 

	}	

.buttonasigna{

 padding: 10px 35px;

 overflow:hidden;

}

.buttonasigna:before {

 font-family: FontAwesome;

 content:"\f090";

 position: absolute;

 top: 11px;

 left: -30px;

 transition: all 200ms ease;

}

.buttonasigna:hover:before {

 left: 7px;

}

	





.buttoncerrar {

		border: none;

		background: #3a7999;

		color: #f2f2f2;

		padding: 10px;

		font-size: 18px;

		border-radius: 5px;

		position: relative;

		box-sizing: border-box;

		transition: all 500ms ease; 

	}	

.buttoncerrar{

 padding: 10px 35px;

 overflow:hidden;

}

.buttoncerrar:before {

 font-family: FontAwesome;

 content:"\f155";

 position: absolute;

 top: 11px;

 left: -30px;

 transition: all 200ms ease;

}

.buttoncerrar:hover:before {

 left: 7px;

}

		



	

.buttonguardar {

		border: none;

		background: #3a7999;

		color: #f2f2f2;

		padding: 10px;

		font-size: 18px;

		border-radius: 5px;

		position: relative;

		box-sizing: border-box;

		transition: all 500ms ease; 

	}	

.buttonguardar{

 padding: 10px 35px;

 overflow:hidden;

}

.buttonguardar:before {

 font-family: FontAwesome;

 content:"\f0c7";

 position: absolute;

 top: 11px;

 left: -30px;

 transition: all 200ms ease;

}

.buttonguardar:hover:before {

 left: 7px;

}

			





-->

</style>

<script type="text/javascript">

<!--









function credito_searchcredaut(tipo)

{

 

  $("#div_listacred").load("aplications/usuario/opciones/grid/grid_credito_buscar.php",{

    tipo_espliegue:tipo

  },function(result){  

    

  });  

  $("#div_listacred").html("Espere un momento..."); 

   $("#div_menucredi").html("");

   $("#div_menucrediecoh").html("");

 

}







 ////jquery envio factura x mail

  function envioxmail_cre()

{

	 $("#cre_envioxmail").load("correo/email_notascred.php",{

     mid_crecab:$('#id_crecab').val()

  },function(result){  

      

  });  

  $("#cre_envioxmail").html("enviando comprobante al correo...");  

   }

 /////////////////////////////////////////

 





 function enviocre_documento()

{

$("#enviocre_div").load("autoriza/envio_cre.php",{fid_crecab:$('#id_crecab').val()},function(result){  

      

});  

$("#enviocre_div").html("Espere un momento...");  



}



 function autorizacre_documento()

{







$("#autorizacre_div").load("autoriza/autoriza_cre.php",{fid_crecab:$('#id_crecab').val()},function(result){  

      

}); 



 ///grid_factura()

 setTimeout(grid_validacionsri, 10000)

 //grid_validacionsri()

$("#autorizacre_div").html("Espere un momento...");  



}



function firmar_documento()

{



$("#firmar_div").load("aplications/usuario/opciones/extras/firma/proceso_credito.php",{xml:$('#id_crecab').val()},function(result){  

      

  });  

  enviocre_documento()



setTimeout(autorizacre_documento, 10000)

  $("#firmar_div").html("Espere un momento...");  



}









function desaparecer_borrar()

{

    

	setTimeout(function () { $('#grid_borrar').fadeOut(); }, 2000);

  

}



function desplegar_grid()

{

   $("#grid<?php echo $subindice ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>.php",{

 inicio_lista:$('#inicio_lista').val(),fin_lista:$('#fin_lista').val()

  },function(result){  



  });  

  $("#grid<?php echo $subindice ?>").html("Espere un momento..."); 

   

 

}



function siguiente_pagina(inicio,fin)

{

	$('#inicio_lista').val(inicio);

	$('#fin_lista').val(fin);

	desplegar_grid();

	

}



function desplegar_grid_buscar()

{

   $("#grid<?php echo $subindice ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>.php",{

    ncomprobante_val:$('#ncomprobante_val').val(),

	ruccliente_val:$('#ruccliente_val').val(),

	fechafac_val:$('#fechafac_val').val(),

	tip_comprobanteval:$('#tip_comprobanteval').val(),

	estado_crecab_val:$('#estado_crecab_val').val()

  },function(result){  

   

  });  

  $("#grid<?php echo $subindice ?>").html("Espere un momento...");  



}





function llamar_editar<?php echo $subindice ?>(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {

        var xobjPadre = $("#divBody<?php echo $subindice ?>");

        xobjPadre.append("<div id='divDialog<?php echo $subindice ?>'  title='"+titulopantalla+"'></div>");

        var xobj = $("#divDialog<?php echo $subindice ?>");



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

            width: 990,

            height: 690,

            modal: true,

           

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}



function guarda<?php echo $subindice ?>_fin(divresultado,mensaje)

{

      

  //$('#'+divresultado).html(mensaje);  

  desplegar_grid();

  ver_formapago();

 // funcion_cerrar_pop('divDialog<?php echo $subindice ?>');



}



//EJECUTA DESPUES DE GUARDAR UNA FACTURA

function guarda<?php echo $subindice ?>_nuevo(divresultado,mensaje)

{

  

 //$('#'+divresultado).html(mensaje);  

  

    desplegar_grid();

	ver_formapago();

	crear_xml_credito($('#crecab_tipocomprobante').val());

	archivo_pdf(0);

	grid_validacionsri()

	 if($('#opcion_<?php echo $table ?>').val()=='actualizar')

   {

    setTimeout(function () { funcion_cerrar_pop('divDialog<?php echo $subindice ?>'); funcion_cerrar_pop('div_dialog_opcionv') }, 3000);

  }

}



function salir_factura()

{  

  crear_xml_credito($('#crecab_tipocomprobante').val()) 

  setTimeout(function () { funcion_cerrar_pop('divDialog<?php echo $subindice ?>'); funcion_cerrar_pop('div_dialog_opcionv') }, 5000);



}

//EJECUTA DESPUES DE GUARDAR UNA FACTURA





function crear_xml_credito(tipocomprobante)

{

  

  if(tipocomprobante=='04')

   {

   

  $("#div_creaxml").load("aplications/usuario/opciones/extras/xml/creando_xmlcredito.php",{

    pid_crecab:$('#id_crecab').val()

  },function(result){  

   

  });  

  $("#div_creaxml").html("Espere un momento...");  

  

  }

  

  if(tipocomprobante=='05')

   {

   

  $("#div_creaxml").load("aplications/usuario/opciones/extras/xml/creando_xmldebito.php",{

    pid_crecab:$('#id_crecab').val()

  },function(result){  

   

  });  

  $("#div_creaxml").html("Espere un momento...");  

  

  }

  

   

}



function ver_formapago()

{

   $("#verifica_exfac").load("aplications/usuario/opciones/extras/existe_credito.php",{

     pid_crecab:$('#id_crecab').val()

  },function(result){  

      

	    if($('#existe_credito').val()==1)

			  {

			  

				 

			 <?php

			 if($objCfgSistema->cfs_verpdf==1)

			 {

			 ?>

			 $('#div_btnverpdf').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=archivo_pdf(1) style=cursor:pointer ><img src="images/verpdf.png" border=0 /></td></tr></table>');

			 <?php

			 }

			 else

			 {

			 ?>			  

			  $('#div_btnverpdf').html('');

			 <?php

			  }

			 ?>

			<?php

			 if($objCfgSistema->cfs_validarsri==1)

			 {

			    

			 ?>

			

    

				  $('#div_btnvalidarsri').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=validar_proceso($("#id_crecab").val())  style=cursor:pointer ><img src="images	/validar.png" border=0 /></td></tr></table>');	

				  

				 <?php if( $tipofac==1)

				 { ?>

		     grid_validacionsri();

				 <?php

			    	 }

			 }

			 else

			 {

			 ?>

			  $('#div_btnvalidarsri').html('');			 

			 <?php

			 }

			 ?>			 	

			 

			 <?php

			 if($objCfgSistema->cfs_formadepago==1)

			 {

			 ?>

			  

 

  

			 

			  $('#div_btnformapago').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick="forma_pago_abrir()" style="cursor:pointer" ><img src="images/fpago.png"/></td></tr></table>');	

			  

			 

			  

			 <?php

			 }

			 else

			 {

			 ?>

			 $('#div_btnformapago').html('');

			 <?php

			 }			 

			 ?>		 

			

			 

			 <?php

			 if($objCfgSistema->cfs_verxml==1)

			 {

			 ?>

			  $('#div_btnverxml').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=descargar_archivo_xml($("#id_crecab").val()) style=cursor:pointer ><img src="images/verxml.png" border=0 /></td></tr></table>');

			 <?php

			 }

			 else

			 {

			 ?>

			  $('#div_btnverxml').html('');

			 <?php

			 }			 

			 ?>





			 

		     <?php

			  if($objCfgSistema->cfs_tikets==1)

			  {

			  ?>

			  $('#area_imp').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td>&nbsp;</td><td><a target="_blank" class="btnPrint_imp" href="aplications/usuario/opciones/extras/archivo_imp.php?pdf='+$("#id_crecab").val()+'" ><img src="images/imp_fac.png" border=0 /></a></td><td>&nbsp;</td><td><a class="btnPrint" href="aplications/usuario/opciones/extras/tickets.php?ti='+$("#id_crecab").val()+'" ><img src="images/imp_ti.png" border=0 /></a></td></tr></table>');

			  <?php

			  }

			  else

			  {

			  ?>

			 $('#area_imp').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td>&nbsp;</td><td><a target="_blank" class="btnPrint_imp" href="aplications/usuario/opciones/extras/archivo_imp.php?pdf='+$("#id_crecab").val()+'" ></a></td><td>&nbsp;</td></tr></table>');

			  <?php

			  }

			  ?>

			  

			

			 

			  if($('#crecab_estadosri').val()!='AUTORIZADO')	

			  {		      

			  //anularr

			  $('#div_btnanular').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td  onclick=enviar_anular($("#id_crecab").val()) style=cursor:pointer ><img src="images/anular.png"  /> </td></tr></table>');			  

			  }

			

			

			  

			   $(".btnPrint").printPage();

			  $(".btnPrint_imp").printPage();

			  

			   }

	  

	  

  });  

  $("#verifica_exfac").html("Espere un momento..."); 

   

}



function enviar_anular(id_crecab)

{

    abrir_standar("aplications/usuario/opciones/extras/proceso_anularcre.php","Anular","divBody_anular","divDialog_anular",700,400,id_crecab,0,0,0,0,0,0);



}





function borrar_registro(tabla,campo,valor)

{

      if($('#crecab_estadosri').val()=='AUTORIZADO')

   {

     alert("no puede ser borrado.");

	 return false;

   } 

	

	

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar").load("aplications/usuario/opciones/grid/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

      desplegar_grid();

	  desaparecer_borrar();

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}



//para abrir xml

function descargar_archivo_xml(xml_valor)

{

  if($("#crecab_tipocomprobante").val()=='04')

  {

   //window.open('xmlcredito/' + xml_valor + '.xml','ventana1','width=800,height=500,scrollbars=YES');

   window.open('xmlcredito/ver.php?xml=' + xml_valor,'ventana1','width=800,height=500,scrollbars=YES');

  }

  if($("#crecab_tipocomprobante").val()=='05')

  {

   //window.open('xmldebito/' + xml_valor + '.xml','ventana1','width=800,height=500,scrollbars=YES');

   window.open('xmldebito/ver.php?xml=' + xml_valor,'ventana1','width=800,height=500,scrollbars=YES');

  }

  

}



//Para abrir pdf

function archivo_pdf(tipo_ejecuta)

{

  var pathpdf; 

  //if($("#crecab_tipocomprobante").val()=='04')

 // {

 //    pathpdf="aplications/usuario/opciones/extras/pdf/crepdfarchivo.php";

 // }

 // if($("#crecab_tipocomprobante").val()=='05')

 // {

    // pathpdf="aplications/usuario/opciones/extras/pdf/debpdfarchivo.php";

  //}

   

  //$("#div_creaxml").load(pathpdf,{

  //  pid_crecab:$('#id_crecab').val()

  //},function(result){  

  

  if(tipo_ejecuta==1)

  {

   

    if($("#crecab_tipocomprobante").val()=='04')

  		{

   // window.open('pdfcredito/' + $('#id_crecab').val() +'.pdf' ,'PDF','width=800,height=500,scrollbars=YES');

	window.location.href='pdfcredito/pdf.php?xml=' + $('#id_crecab').val();

	

		}

	if($("#crecab_tipocomprobante").val()=='05')

		  {

	//window.open('pdfdebito/' + $('#id_crecab').val() +'.pdf' ,'PDF','width=800,height=500,scrollbars=YES');	

	window.location.href='pdfdebito/pdf.php?xml=' + $('#id_crecab').val();  

		  

		  }

	

   

  }  

  

   

  //});  

  //$("#div_creaxml").html("Espere un momento..."); 

   

  

}



function imprimir_ticket(tic_valor)

{

   window.open('aplications/usuario/opciones/extras/tickets.php?ti=' + tic_valor ,'tic','width=800,height=500,scrollbars=YES');

}



function factoring_proceso(fac_id)

{

    abrir_standar("aplications/usuario/opciones/extras/proceso_factoringu.php","Factoring","divBody_factoringu","divDialog_factoringu",700,400,fac_id,0,0,0,0,0,0);



}



function buscar_cliente()

{

    $("#div_cbusca").load("aplications/usuario/opciones/extras/busca_cliente.php",{

    pruc:$('#crecab_rucci_cliente').val()

  },function(result){  

      

	  if($('#encuentra_enc').val()==1)

	  {

	    $('#crecab_nombrerazon_cliente').val($('#nombreapellido_enc').val());

		$('#crecab_direccion_cliente').val($('#direccion_enc').val());

		$('#crecab_telefono_cliente').val($('#telefono_enc').val());

		$('#crecab_email_cliente').val($('#email_enc').val());

		$('#crecab_rucci_cliente').val($('#rucci_enc').val());		

		$('#tipoident_codigo').val($('#tipodoc_enc').val());

		

		

		

	  }

	  else

	  {

	     $('#crecab_nombrerazon_cliente').val('');

		$('#crecab_direccion_cliente').val('');

		$('#crecab_telefono_cliente').val('');

		$('#crecab_email_cliente').val('');

		$('#tipoident_codigo').val('');

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_cliente.php","Cliente","divBody_cliente","divDialog_cliente",750,450,0,$('#crecab_rucci_cliente').val(),0,0,0,0,0);

	  }

	  

  });  

  $("#div_cbusca").html("Espere un momento...");     



}







function buscar_cliente_actualizar()

{

    $("#div_cbusca").load("aplications/usuario/opciones/extras/busca_cliente.php",{

    pruc:$('#crecab_rucci_cliente').val()

  },function(result){  

      

	  if($('#encuentra_enc').val()==1)

	  {

	    $('#crecab_nombrerazon_cliente').val($('#nombreapellido_enc').val());

		$('#crecab_direccion_cliente').val($('#direccion_enc').val());

		$('#crecab_telefono_cliente').val($('#telefono_enc').val());

		$('#crecab_email_cliente').val($('#email_enc').val());

		$('#crecab_rucci_cliente').val($('#rucci_enc').val());

		$('#tipoident_codigo').val($('#tipodoc_enc').val());

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_cliente.php","Cliente","divBody_cliente","divDialog_cliente",750,450,0,$('#crecab_rucci_cliente').val(),0,0,0,0,0);

	  }

	  else

	  {

	     $('#crecab_nombrerazon_cliente').val('');

		$('#crecab_direccion_cliente').val('');

		$('#crecab_telefono_cliente').val('');

		$('#crecab_email_cliente').val('');

		$('#tipoident_codigo').val('');

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_cliente.php","Cliente","divBody_cliente","divDialog_cliente",750,450,0,$('#crecab_rucci_cliente').val(),0,0,0,0,0);

	  }

	  

  });  

  $("#div_cbusca").html("Espere un momento...");     



}





function buscar_cliente_actualiza()

{

    $("#div_cbusca").load("aplications/usuario/opciones/extras/busca_cliente.php",{

    pruc:$('#client_ciruc').val()

  },function(result){  

      

	  if($('#encuentra_enc').val()==1)

	  {

	    $('#crecab_nombrerazon_cliente').val($('#nombreapellido_enc').val());

		$('#crecab_direccion_cliente').val($('#direccion_enc').val());

		$('#crecab_telefono_cliente').val($('#telefono_enc').val());

		$('#crecab_email_cliente').val($('#email_enc').val());	

		$('#crecab_rucci_cliente').val($('#rucci_enc').val());	

		$('#tipoident_codigo').val($('#tipodoc_enc').val());

		funcion_cerrar_pop('divDialog_cliente');

	  }	

	  

  });  

  $("#div_cbusca").html("Espere un momento...");  

}





function validar_proceso(fac_id)

{

    abrir_standar_val("aplications/usuario/opciones/extras/proceso_validarcredito.php","Validar SRI","divBody_validarsri","divDialog_validarsri",600,500,fac_id,0,0,0,0,0,0);



}







function ver_detalle_activa(fac_id)

{

    abrir_standar("aplications/usuario/opciones/extras/ver_detalle_activacre.php","ALERTA","divBody_factoringu","divDialog_factoringu",400,300,fac_id,0,0,0,0,0,0);



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





function abrir_standar_val(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

				desplegar_grid();					

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





function nuevocredito()

{



  if($('#n_faccredito').val()=='')

  {

    alert("debe ingresar un numero de factura...");

	return false;

  }

  

  if($('#n_tipoc').val()=='')

  {

    alert("Ingrese el tipo de comprobante...");

	return false;

  }

  



  

  

  llamar_editar<?php echo $subindice ?>("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>_nuevo.php","Nuevo-RUC:<?php echo $ructxt_empresa ?>--<?php echo str_replace(" ","-",$nombretxtempresa) ?>--Usuario:<?php echo $nusuariotxt ?>",0,0,$('#n_faccredito').val(),$('#n_tipoc').val(),0,0,0);

  

}



function nuevocreditoecoh()

{



  if($('#n_faccredito').val()=='')

  {

    alert("debe ingresar un numero de factura...");

	return false;

  }

  

  if($('#n_tipoc').val()=='')

  {

    alert("Ingrese el tipo de comprobante...");

	return false;

  }

  

  

  

 $("#div_menucrediecoh").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>_nuevo.php",{

	pVar1:'Nuevo-RUC:<?php echo $ructxt_empresa ?>',

	pVar2:'<?php echo str_replace(" ","-",$nombretxtempresa) ?>',

	pVar3:$('#n_faccredito').val(),

	pVar4:$('#n_tipoc').val()

	 

	 

   

  },function(result){  

    

  });  

  $("#div_menucrediecoh").html("Espere un momento..."); 

  $("#div_menucredi").html("");

 

}







function envio_emailcli(xmlfact)

{

 if (confirm("Esta seguro que desea enviar el email al cliente?"))

	 { 

  $("#div_envioemail").load("aplications/usuario/opciones/extras/correos/envio_emailcre.php",{

    pid_crecab:xmlfact

  },function(result){  

     desplegar_grid_buscar();

  });  

  $("#div_envioemail").html("Espere un momento..."); 

  }

  

}





function credito_menu()

{

 

  $("#div_menucredi").load("aplications/usuario/opciones/extras/menu_credito.php",{

   

  },function(result){  

    

  });  

  $("#div_menucredi").html("Espere un momento..."); 

 

}



function credito_newcred()

{

 

  $("#div_menucredi").load("aplications/usuario/opciones/extras/menu_credito.php",{

   

  },function(result){  

    

  });  

  $("#div_menucredi").html("Espere un momento..."); 

   $("#div_menucrediecoh").html("");

   $("#div_listacred").html("");

 

}



function credito_searchcred()

{

 

  $("#div_listacred").load("aplications/usuario/opciones/grid/grid_credito_buscar.php",{

   

  },function(result){  

    

  });  

  $("#div_listacred").html("Espere un momento..."); 

   $("#div_menucredi").html("");

   $("#div_menucrediecoh").html("");

 

}



function publicar(id_crecab)

{

   

  $("#div_publicar_"+id_crecab).load("aplications/usuario/opciones/extras/publicar.php",{

    pid_crecab:id_crecab

  },function(result){  

  

    		

		   

  });  

  $("#div_publicar_"+id_crecab).html("..."); 

  

}





//  End -->

</script>

<?php

		///verificando lotes

		

		

	  $lista_datoslote="select * from  factur_lotecredito where id_empresa=".$idempresatxt." and caja_id=".$_SESSION['id_cajaval']." and lotec_estado=1";

     $banderaexistelote=0;

	 $rs_gogessform = $DB_gogess->Execute($lista_datoslote);

	 if($rs_gogessform)

	 {

		  while (!$rs_gogessform->EOF) {

		  

		   $banderaexistelote++;

		   $loteinicial=$rs_gogessform->fields["lotec_inicio"];

		   $lotefinal= $rs_gogessform->fields["lotec_fin"];	

		    $idlotex= $rs_gogessform->fields["lotec_id"];	

		   $cantidadlote=$rs_gogessform->fields["lotec_cantidadt"];	

			$rs_gogessform->MoveNext();

		  }

	 }

		$valida1=1;

		$valida2=1;

		

		if($banderaexistelote>1)

		{

		 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:11px" >Alerta!!! No puede estar activo dos lotes al mismo tiempo para este punto de emisi&oacute;n...</div>';

		 $valida1=0;

		}

		if($banderaexistelote==0)

		{

		 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:11px" >Alerta!!! No hay lote asignado a este punto de emisi&oacute;n...</div>';

		 $valida2=0;

		}

		///verificando lotes				

						

				$resultadoval=$valida1*$valida2;	

				

				if($resultadoval)

				{

						  

				///$linkeditar= 'onclick="nuevocredito()" style=cursor:pointer';

					

				}	

					

			///$link_panel_buscar='onclick=abrir_standar("aplications/usuario/opciones/extras/menu'.$subindice.'.php","Buscar","div_body_buscar","div_dialog_buscar",990,600,0,0,0,0,0,0,0) style=cursor:pointer';				

		

		   //aplications/usuario/opciones/extras/menu_credito.php

		   $arrgloop[14]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Nuevo","div_body_buscar","div_dialog_buscar",1200,700,0,0,0,0,0,0,2) style=cursor:pointer';

		   

					

					$arrgloop[15]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar","div_dialog_buscar",990,600,0,0,0,0,0,0,0) style=cursor:pointer';	

					

					

					

					if($tipofac==1)

					{

					$arrgloop[16]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar","div_dialog_buscar",990,600,0,0,0,0,0,0,2) style=cursor:pointer';	

						}

						?>



<div id=grid_borrar align="center" ></div>

<div align="center"><span class="Estilo4">&nbsp;  </span>



  <div align="center">

  <table width="500" border="0" cellpadding="0" cellspacing="0">

    <tr>

     

	  

	  

	  

	  

	  

	  <?php

  //Menu Generico



  $objmenuFactura = new  menu_generico($linkeditar,$link_panel_buscar,$linklote,$arrgloop,'',$objperfil);  

  $objmenuFactura->desplegar_menu();

  

  ?>

      <td   width="240" valign="top">

      <div align="center">

      

      <div id=div_menucredi ></div>

      <div id=div_menucrediecoh ></div>

      <div id=div_listacred ></div>

      

      

      </div>

      </td>

    </tr>

  </table>

  </div>

  <span class="Estilo4">&nbsp; </span></div>  

<div id=divBody<?php echo $subindice ?> ></div>



<div id="div_body_export" ></div>

<div id="divBody_factoringu" ></div>

<div id="div_body_buscar" ></div>

<div id="div_body_opcionv" ></div>

<div id="divBody_validarsri" ></div>

<div id="divBody_anular" ></div>

<SCRIPT LANGUAGE=javascript>

<!--

credito_menu();

$("#n_faccredito").mask({mask: "###-###-#########"});



//  End -->

</script>