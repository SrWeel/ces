<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}



<?php

$objformulario->generar_formulario_css(@$submit,@$table,$DB_gogess);

?>





 #grid_div { 

 top:205px; left:16px;

			 position: absolute;

			

 }

  #agregar_div { 

 top:130px; left:780px;

			 position: absolute;

			

 }
 
  #fpago_div { 

 top:130px; left:700px;

			 position: absolute;

			

 }

-->

</style>

<?php

 $tab_id_valor=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_id","where tab_name like",$table,$DB_gogess);

 $lista_detalle="select * from gogess_subgrid where tab_id=".$tab_id_valor; 

 $rs_detalle = $DB_gogess->executec($lista_detalle,array());

 

?>

<script language="javascript">

<!--

function descuento_general()
{
//doccab_descuento
      

	      $("#grid_descuento").load("templateformsweb/maestro_standar_doccab/borrar_item.php",{idenlace:id_borrar

   

		  },function(result){  

		  

		  

		  });  

		  $("#grid_descuento").html("Espere un momento...");




}

function crear_claveacceso()

{



$("#grid_claveacceso").load("templateformsweb/maestro_standar_doccab/crea_claveacceso.php",{

   

doccab_fechaemision_cliente:$('#doccab_fechaemision_cliente').val(),

tipocmp_codigo:$('#tipocmp_codigo').val(),

emp_id:$('#emp_id').val(),

doccab_ndocumento:$('#doccab_ndocumento').val(),

doccab_id:$('#doccab_id').val()





 },function(result){       

		

		$('#doccab_clavedeaccesos').val($('#cacceso_cal').val());

		$('#despliegue_doccab_clavedeaccesos').html($('#cacceso_cal').val());	 

  });  

  $("#grid_claveacceso").html("Espere un momento...");





}



function guardar_cliente_data()

{



   $("#grid_clientef").load("templateformsweb/maestro_standar_doccab/guarda_cliente.php",{

   

doccab_rucci_cliente:$('#doccab_rucci_cliente').val(),

doccab_nombrerazon_cliente:$('#doccab_nombrerazon_cliente').val(),

doccab_direccion_cliente:$('#doccab_direccion_cliente').val(),

doccab_telefono_cliente:$('#doccab_telefono_cliente').val(),

doccab_email_cliente:$('#doccab_email_cliente').val(),

emp_id:$('#emp_id').val()



 },function(result){       

			 

  });  

  $("#grid_clientef").html("Espere un momento...");

   

}





function grid_factura(asg)

{

$("#grid_div").load("templateformsweb/maestro_standar_doccab/grid_detalle.php",{

enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),

idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>',

opcion:asg

 },function(result){       

			 

  });  

  $("#grid_div").html("Espere un momento...");

}

//forma de pago

function forma_pago()
{

abrir_standar("templateformsweb/maestro_standar_doccab/fpago.php","FORMA_PAGO","divBody_fpago","divDialog_fpago",600,500,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),0,0,0,0,0,0);


}

//forma de pago



function insumo_ver()

{



abrir_standar("templateformsweb/maestro_standar_doccab/insumo.php","INSUMO","divBody_insumo","divDialog_insumo",500,600,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),0,0,0,0,0,0);



}



function borrar_item(id_borrar)

{



    if(confirm("Alerta. Desea borrar este registro ?")) { 

      

	      $("#grid_borraitemv").load("templateformsweb/maestro_standar_doccab/borrar_item.php",{idenlace:id_borrar

   

		  },function(result){  

		  

		  grid_factura(0);

		  

		  });  

		  $("#grid_borraitemv").html("Espere un momento...");



    }

	

	

}



function actualiza_campo(tabla,campo,idtabla,id_detalle,valor)
{



     $("#div_actualizac").load("templateformsweb/maestro_standar_doccab/actualiza_campo.php",{

	 tablap:tabla,

	 campop:campo,

     idtablap:idtabla,

	 id_detallep:id_detalle,

	 valorp:valor,
	 enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),
     idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>'

		  },function(result){  

		  
$('#docdet_total_'+id_detalle).html($('#total_linea').val());
		

		$('#subtotaliva').html($('#subtotaliva1').val());
		$('#subtotaliva0').html($('#subtotaliva01').val());
		$('#subtotalnoobj').html($('#subtotalnoobj1').val());
		$('#subtotalexentoiva').html($('#subtotalexentoiva1').val());
		$('#iva').html($('#iva1').val());
		$('#total').html($('#total1').val());

		  });  

	 $("#div_actualizac").html("Espere un momento...");



}

//actauliza descuento



function actualiza_descuentogeneral(tabla,campo,idtabla,id_detalle,valor)
{



     $("#div_actualizac").load("templateformsweb/maestro_standar_doccab/actualiza_campodescuento.php",{

	 tablap:tabla,

	 campop:campo,

     idtablap:idtabla,

	 id_detallep:id_detalle,

	 valorp:valor,
	 enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),
     idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>'

		  },function(result){  

		  
$('#docdet_total_'+id_detalle).html($('#total_linea').val());
		

		$('#subtotaliva').html($('#subtotaliva1').val());
		$('#subtotaliva0').html($('#subtotaliva01').val());
		$('#subtotalnoobj').html($('#subtotalnoobj1').val());
		$('#subtotalexentoiva').html($('#subtotalexentoiva1').val());
		$('#iva').html($('#iva1').val());
		$('#total').html($('#total1').val());

		  });  

	 $("#div_actualizac").html("Espere un momento...");



}



//-->
</script>



      <script>

         $(function() {

            $( "#doccab_rucci_cliente" ).autocomplete({

               source: "templateformsweb/maestro_standar_doccab/search.php",

               minLength: 5,

			   select: function( event, ui ) {

				  $('#doccab_nombrerazon_cliente').val(ui.item.nombre);

				  $('#doccab_direccion_cliente').val(ui.item.direccion);

				  $('#doccab_telefono_cliente').val(ui.item.telefono);

				  $('#doccab_email_cliente').val(ui.item.email);

					

			   }

            });

         });

      </script>



<table width="700" height="400" border="0" align="center" cellpadding="4" cellspacing="2">  

  <tr>

    <td valign="top"><div align="center">

      <?php

	 

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["tipocmp_codigox"]='01';

			$objformulario->sendvar["estaf_idx"]='1';

			

			 $objformulario->sendvar["doccab_rucempresax"]=$objformulario->replace_cmb("app_empresa","emp_id,emp_ruc","where emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);

			 $valoralet=mt_rand(1,500);

			 $aletorioid='01'.$_SESSION['ces1313777_sessid_cedula'].$objformulario->sendvar["doccab_rucempresax"].date("Ymdhis").$valoralet;

			 $objformulario->sendvar["doccab_idx"]=$aletorioid;	

			 

			 

$objformulario->sendvar["ambi_valorx"]=$objformulario->replace_cmb("app_empdocumento","emp_id,ambi_valor","where tipocmp_codigo='".$objformulario->sendvar["tipocmp_codigox"]."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);

			 

$objformulario->sendvar["emis_valorx"]=$objformulario->replace_cmb("app_empdocumento","emp_id,tipoemi_codigo","where tipocmp_codigo='".$objformulario->sendvar["tipocmp_codigox"]."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);



$objformulario->sendvar["doccab_clavedeaccesosx"]='';

			

			

			$objformulario->generar_formulario_campos(@$submit,$table,$DB_gogess);

			 

            //$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

        ?>

		<div id="agregar_div">

		<table border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td onClick="insumo_ver()" style="cursor:pointer"><img src="images/coche.png"></td>

  </tr>

</table>

</div>

<div id="fpago_div">

		<table border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td onClick="forma_pago()" style="cursor:pointer"><img src="images/fpago.png"></td>

  </tr>

</table>

</div>


		<div id="grid_div"></div>

		

    </div></td>

 

    <?php

    //$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 

	?>

  </tr>

</table>



<?php       

if($csearch)

{

 $valoropcion='actualizar';

}

else

{

 $valoropcion='guardar';

}



echo "<input name='csearch' type='hidden' value=''>

<input name='idab' type='hidden' value=''>

<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >

<input name='table' type='hidden' value='".$table."'>";



?>

<div id="div_<?php echo $table ?>" > </div>
<div id="divBody_fpago" ></div>
<div id="divBody_insumo" ></div>

<div id="grid_borraitemv" ></div>

<div id="grid_clientef"></div>

<div id="grid_claveacceso" ></div>

<div id="div_actualizac" ><input name="total_linea" type="hidden" id="total_linea" value="" ></div>

<script language="javascript">
<!--

grid_factura(0);

$('#doccab_identificacionpaciente_despliegue').html('<button type="button" class="mb-sm btn btn-success" onclick="" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Datos Paciente </button>');

//-->
</script>