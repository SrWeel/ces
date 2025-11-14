<?php

//CONFIGURACIONES



$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);

$subindice="_sretencion";



			 //datos de la empresa 

$idempresatxt=$objformulario->replace_cmb("factur_usuarios","id_usuario,id_empresa","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);

$nusuariotxt=$objformulario->replace_cmb("factur_usuarios","id_usuario,usr_username","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);

$nombretxtempresa=$objformulario->replace_cmb("factur_empresa","id_empresa,dat_razon_social","where id_empresa=",$idempresatxt,$DB_gogess);



$ructxt_empresa=$objformulario->replace_cmb("factur_empresa","id_empresa,dat_ruc","where id_empresa=",$idempresatxt,$DB_gogess);



						 //datos de la empresa



$objCfgSistema->sistema_data_cfg($idempresatxt,$DB_gogess);	



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

function desaparecer_borrar_ret()

{

    

	setTimeout(function () { $('#grid_borrar_ret').fadeOut(); }, 2000);

  

}



function desplegar_grid_ret()

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

	desplegar_grid_ret()

	

}



function desplegar_grid_ret_buscar()

{

   $("#grid<?php echo $subindice ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice ?>.php",{

    nretencion_val:$('#nretencion_val').val(),

	ruccliente_val:$('#ruccliente_val').val(),

	fechafac_val:$('#fechafac_val').val(),

	origen_val:$('#origen_val').val(),

	estado_ret_val:$('#estado_ret_val').val(),

	archivo_val:$('#archivo_val').val()

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

            width: 880,

            height: 590,

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

  //desplegar_grid_ret();

  ver_formapago_ret();

  crear_xml_retencion();

  archivo_pdfret(0);

 // funcion_cerrar_pop('divDialog<?php echo $subindice ?>');



}







function guarda<?php echo $subindice ?>_nuevo(divresultado,mensaje)

{

  

 //$('#'+divresultado).html(mensaje);  

  

   // desplegar_grid_ret();

	ver_formapago_ret();

	crear_xml_retencion();

	archivo_pdfret(0);

   // funcion_cerrar_pop('divDialog<?php echo $subindice ?>');

   if($('#opcion_<?php echo $table ?>').val()=='actualizar')

   {

   setTimeout(function () { funcion_cerrar_pop('divDialog<?php echo $subindice ?>'); }, 1000);

   }

   else

   {

	  setTimeout(function () { $('#div_factur_sretencion_cab').html('') }, 2000); 

   }



}



function salir_factura_ret()

{  

  

  crear_xml_retencion();

  archivo_pdfret(0);

  setTimeout(function () { funcion_cerrar_pop('divDialog<?php echo $subindice ?>'); }, 5000);



}



function ver_formapago_ret()

{



   $("#verifica_exfac_ret").load("aplications/usuario/opciones/extras/existe_sretencion.php",{

     pid_sretcab:$('#id_sretcab').val()

  },function(result){  

      

	    if($('#existe_factura_ret').val()==1)

			  {			  

			  

			  

			  <?php

			 if($objCfgSistema->cfs_validarsri==1)

			 {

			  

			 ?>

			

			       

    

				  $('#div_btnvalidarsri_ret').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=validar_proceso_ret($("#id_sretcab").val())  style=cursor:pointer ><img src="images/validar.png" border=0 /></td></tr></table>');	

			

		     

			  <?php

			    

			 }

			 else

			 {

			 ?>

			  $('#div_btnvalidarsri_ret').html('');			 

			 <?php

			 }

			 ?>			 	

			 

			 <?php

			 if($objCfgSistema->cfs_formadepago==1)

			 {

			 ?>

			  

 

  

			 

			  $('#div_btnformapago_ret').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick="forma_pago_abrir()" style="cursor:pointer" ><img src="images/fpago.png"/></td></tr></table>');	

			  

			 

			  

			 <?php

			 }

			 else

			 {

			 ?>

			 $('#div_btnformapago_ret').html('');

			 <?php

			 }			 

			 ?>		 

			 

			 <?php

			 if($objCfgSistema->cfs_verpdf==1)

			 {

			 ?>

			 $('#div_btnverpdf_ret').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=archivo_pdfret(1) style=cursor:pointer ><img src="images/verpdf.png" border=0 /></td></tr></table>');

			 <?php

			 }

			 else

			 {

			 ?>			  

			  $('#div_btnverpdf_ret').html('');

			 <?php

			  }

			 ?>

			 

			 <?php

			 if($objCfgSistema->cfs_verxml==1)

			 {

			 ?>

			  $('#div_btnverxml_ret').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick=descargar_archivo_xmlret($("#id_sretcab").val()) style=cursor:pointer ><img src="images/verxml.png" border=0 /></td></tr></table>');

			 <?php

			 }

			 else

			 {

			 ?>

			  $('#div_btnverxml_ret').html('');

			 <?php

			 }			 

			 ?>



			 

			 

		     <?php

			  if($objCfgSistema->cfs_tikets==1)

			  {

			  ?>

			  $('#area_imp').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td>&nbsp;</td><td><a target="_blank" class="btnPrint_imp" href="aplications/usuario/opciones/extras/archivo_imp.php?pdf='+$("#id_sretcab").val()+'" ><img src="images/imp_fac.png" border=0 /></a></td><td>&nbsp;</td><td><a class="btnPrint" href="aplications/usuario/opciones/extras/tickets.php?ti='+$("#id_sretcab").val()+'" ><img src="images/imp_ti.png" border=0 /></a></td></tr></table>');

			  <?php

			  }

			  else

			  {

			  ?>

			 $('#area_imp').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td>&nbsp;</td><td><a target="_blank" class="btnPrint_imp" href="aplications/usuario/opciones/extras/archivo_imp.php?pdf='+$("#id_sretcab").val()+'" ><img src="images/imp_fac.png" border=0 /></a></td><td>&nbsp;</td></tr></table>');

			  <?php

			  }

			  ?>

			  

			  

			  <?php

			if($objperfil->estado_maker==1)

				{

			?>	

			  if($('#srete_paracheker').val()!=2)	

			  { 

			  if($('#srete_estadosri').val()!='AUTORIZADO')	

			  {		      

			  //anularr

			  $('#div_btnanular_ret').html('<table border="0" cellpadding="0" cellspacing="0"><tr><td  onclick=enviar_anular_ret($("#id_sretcab").val()) style=cursor:pointer ><img src="images/anular.png"  /> </td></tr></table>');			  

			  }

			  }

			<?php

			}

			?>  

			   

	        if($("#id_compracab").val()>0)

			{

				// $('#div_parachecker_ret').html('');

			}

			  

			 //  $(".btnPrint").printPage();

			  //$(".btnPrint_imp").printPage();

			  

			

			  

			  

			   }

	  

	  

  });  

  $("#verifica_exfac_ret").html("Espere un momento..."); 

   

}



function enviar_anular_ret(id_sretcab)

{

    abrir_standar("aplications/usuario/opciones/extras/proceso_anularret.php","Anular","divBody_anular_ret","divDialog_anular_ret",700,300,id_sretcab,0,0,0,0,0,0);



}



function borrar_registro_ret(tabla,campo,valor)

{

     

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar_ret").load("aplications/usuario/opciones/grid/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

      desplegar_grid_ret();

	  desaparecer_borrar_ret();

  });  

  $("#grid_borrar_ret").html("Espere un momento...");  

  

  

  }



}







function descargar_archivo_xmlret(xml_valor)

{

 // window.open('xmlretencion/' + xml_valor + '.xml','ventana1','width=800,height=500,scrollbars=YES');

   window.open('xmlretencion/ver.php?xml=' + xml_valor,'ventana1','width=800,height=500,scrollbars=YES');

}







function archivo_pdfret(tipo_ejecuta)

{



   // $("#div_creaxml").load("aplications/usuario/opciones/extras/pdf/sretencionpdf.php",{

   // pid_sretcab:$('#id_sretcab').val()

	//  },function(result){  

	  

				if(tipo_ejecuta==1)

				{

				// window.open('pdfsretencion/' + $('#id_sretcab').val() +'.pdf' ,'PDF','width=800,height=500,scrollbars=YES');

				 

				  window.location.href='pdfsretencion/pdf.php?xml=' + $('#id_sretcab').val();

				 

			   }

			   

	 // });  

	//  $("#div_creaxml").html("Espere un momento..."); 

  

  

}







function imprimir_ticketret(tic_valor)

{

   window.open('aplications/usuario/opciones/extras/tickets.php?ti=' + tic_valor ,'tic','width=800,height=500,scrollbars=YES');

}







function validar_proceso_ret(fac_id)

{

    abrir_standar_val("aplications/usuario/opciones/extras/proceso_validarret.php","Validar SRI","divBody_validarsri_ret","divDialog_validarsri_ret",600,500,fac_id,0,0,0,0,0,0);

}





//--retencion

function llamar_editar_retencion(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {

        var xobjPadre = $("#divBody_retencion_ret");

        xobjPadre.append("<div id='divDialog_retencion_ret'  title='"+titulopantalla+"'></div>");

        var xobj = $("#divDialog_retencion_ret");



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

            width: 880,

            height: 590,

            modal: true,

           

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}

//--retencion



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

				desplegar_grid_ret();					

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









function buscar_cliente_prove()

{

    

	$("#div_cbusca_prove").load("aplications/usuario/opciones/extras/busca_proveedor.php",{

    pruc:$('#srete_rucci_cliente').val()

  },function(result){  

      

	  if($('#encuentra_enc_prove').val()==1)

	  {

	    $('#srete_nombrerazon_cliente').val($('#nombreapellido_enc_prove').val());

		$('#srete_direccion_cliente').val($('#direccion_enc_prove').val());

		$('#srete_telefono_cliente').val($('#telefono_enc_prove').val());

		$('#srete_email_cliente').val($('#email_enc_prove').val());

		$('#srete_rucci_cliente').val($('#rucci_enc_prove').val());		

		$('#tidcomp_codigo').val($('#tipodoc_enc_prove').val());

		

      }

	  else

	  {

	     $('#srete_nombrerazon_cliente').val('');

		$('#srete_direccion_cliente').val('');

		$('#srete_telefono_cliente').val('');

		$('#srete_email_cliente').val('');

		$('#tidcomp_codigo').val('');

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_proveedor.php","Cliente","divBody_proveedor_ret","divDialog_proveedor_ret",750,450,0,$('#srete_rucci_cliente').val(),0,0,0,0,0);

	  }

	  

  });  

  $("#div_cbusca_prove").html("Espere un momento...");     



}







function buscar_cliente_prove_actualizar()

{

    $("#div_cbusca_prove").load("aplications/usuario/opciones/extras/busca_proveedor.php",{

    pruc:$('#srete_rucci_cliente').val()

  },function(result){  

      

	  if($('#encuentra_enc_prove').val()==1)

	  {

	    $('#srete_nombrerazon_cliente').val($('#nombreapellido_enc_prove').val());

		$('#srete_direccion_cliente').val($('#direccion_enc_prove').val());

		$('#srete_telefono_cliente').val($('#telefono_enc_prove').val());

		$('#srete_email_cliente').val($('#email_enc_prove').val());

		$('#srete_rucci_cliente').val($('#rucci_enc_prove').val());

		$('#tidcomp_codigo').val($('#tipodoc_enc_prove').val());

		

		$('#tipprove_codigo').val($('#tipprove_codigocc_prove').val());

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_proveedor.php","Cliente","divBody_proveedor_ret","divDialog_proveedor_ret",750,450,0,$('#srete_rucci_cliente').val(),0,0,0,0,0);

	  }

	  else

	  {

	     $('#srete_nombrerazon_cliente').val('');

		$('#srete_direccion_cliente').val('');

		$('#srete_telefono_cliente').val('');

		$('#srete_email_cliente').val('');

		

		$('#tidcomp_codigo').val('');

		abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_proveedor.php","Cliente","divBody_proveedor_ret","divDialog_proveedor_ret",750,450,0,$('#srete_rucci_cliente').val(),0,0,0,0,0);

	  }

	  

  });  

  $("#div_cbusca_prove").html("Espere un momento...");     



}





function buscar_cliente_prove_actualiza()

{

    $("#div_cbusca_prove").load("aplications/usuario/opciones/extras/busca_proveedor.php",{

    pruc:$('#prov_ciruc').val()

  },function(result){  

      

	  if($('#encuentra_enc_prove').val()==1)

	  {

	    $('#srete_nombrerazon_cliente').val($('#nombreapellido_enc_prove').val());

		$('#srete_direccion_cliente').val($('#direccion_enc_prove').val());

		$('#srete_telefono_cliente').val($('#telefono_enc_prove').val());

		$('#srete_email_cliente').val($('#email_enc_prove').val());	

		$('#srete_rucci_cliente').val($('#rucci_enc_prove').val());	

		$('#tidcomp_codigo').val($('#tipodoc_enc_prove').val());

		

		$('#tipprove_codigo').val($('#tipprove_codigocc_prove').val());

		

		funcion_cerrar_pop('divDialog_proveedor_ret');

	  }	

	  

  });  

  $("#div_cbusca_prove").html("Espere un momento...");  

}









function crear_xml_retencion()

{

  

   

  $("#div_creaxml_ret").load("aplications/usuario/opciones/extras/xml/creando_xmlsret.php",{

    pid_sretcab:$('#id_sretcab').val()

  },function(result){  

   

  });  

  $("#div_creaxml_ret").html("Espere un momento...");  

   

}





function ver_detalle_activa_ret(sret_id)

{

    abrir_standar("aplications/usuario/opciones/extras/ver_detalle_sretactiva.php","ALERTA","divBody_factoringu_ret","divDialog_factoringu_ret",400,300,sret_id,0,0,0,0,0,0);



}



function envio_emailcli_ret(xmlfact)

{

 if (confirm("Esta seguro que desea enviar el email al cliente?"))

	 { 

  $("#div_envioemail_ret").load("aplications/usuario/opciones/extras/correos/envio_emailsret.php",{

    pid_sretcab:xmlfact

  },function(result){  

     desplegar_grid_ret_buscar();

  });  

  $("#div_envioemail_ret").html("Espere un momento..."); 

  }

  

}



function publicarFakturaweb(id_sretcab)

{

   

  $("#div_publicar_"+id_sretcab).load("aplications/usuario/opciones/extras/publicarfkret.php",{

    pid_sretcab:id_sretcab

  },function(result){  

  

    		

		   

  });  

  $("#div_publicar_"+id_sretcab).html("..."); 

  

}





//  End -->

</script>

<?php

						

			

						

						  

					$linkeditar= 'onclick=llamar_editar'.$subindice.'("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Nuevo-RUC:'.$ructxt_empresa.'--'.str_replace(" ","-",$nombretxtempresa).'--Usuario:'.$nusuariotxt.'",0,0,0,0,0,0,0) style=cursor:pointer';

					

					

					

				$link_panel_buscar='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscar'.$subindice.'",900,600,0,0,0,0,0,0,0) style=cursor:pointer';	

							

				$linklote='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscar'.$subindice.'",990,600,0,0,0,0,0,0,1) style=cursor:pointer';

				

				$arrgloop[0]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscar",990,600,0,0,0,0,0,0,2) style=cursor:pointer';

					$arrgloop[1]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscar",990,600,0,0,0,0,0,0,3) style=cursor:pointer';

					$arrgloop[2]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscarl",990,600,0,0,0,0,0,0,4) style=cursor:pointer';

					

					$arrgloop[3]='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_buscar.php","Buscar","div_body_buscar'.$subindice.'","div_dialog_buscar'.$subindice.'",900,600,0,0,0,0,0,0,5) style=cursor:pointer';		

						?>



<div id=grid_borrar_ret ></div>

<div align="center"><span class="Estilo4">&nbsp;  </span>

  <?php

  //Menu Generico

  $objmenuFactura = new  menu_generico($linkeditar,$link_panel_buscar,$linklote,$arrgloop,'',$objperfil);  

  $objmenuFactura->desplegar_menu();

  

  ?>

  <span class="Estilo4">&nbsp; </span></div>  

<div id=divBody<?php echo $subindice ?> ></div>



<div id="div_body_export_ret" ></div>

<div id="divBody_factoringu_ret" ></div>

<div id="div_body_buscar<?php echo $subindice ?>" ></div>

<div id="div_body_opcion<?php echo $subindice  ?>" ></div>

<div id="divBody_retencion_ret" ></div>

<div id="divBody_validarsri_ret" ></div>

<div id="divBody_anular_ret" ></div>











