<style>

		#calendar {

			font-family:Arial;

			font-size:12px;

		}

		#calendar caption {

			text-align:left;

			padding:5px 10px;

			background-color:#003366;

			color:#fff;

			font-weight:bold;

		}

		#calendar th {

			background-color:#006699;

			color:#fff;

			width:40px;

			border:thin solid #000000;

		}

		#calendar td {

			text-align: right;

            padding: 2px 5px;

            background-color: #eee;

            border: thin solid #1f1f2a;

		}

		#calendar .hoy {

			background-color:red;

		}

.Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

</style>

<script>

function ver_calendario_general()
{


    $("#cal_general").load("templateformsweb/maestro_standar_pacientes/calendario/cal.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val(),
	clie_id:$('#clie_id').val()



  },function(result){  


  });  



  $("#cal_general").html("Espere un momento...");  


}



function selecciona_dia_general(anio,mes,dia)
{

	//$('#horat_fechax').val(anio+'-'+mes+'-'+dia);

}



function generar_edad(fechallega)
{


  $("#edadclie_fechanacimiento").load("templateformsweb/maestro_standar_pacientes/edad.php",{

    clie_fechanacimiento:fechallega



  },function(result){  


  });  



  $("#edadclie_fechanacimiento").html("Espere un momento...");  


}


function generar_edadin()
{



	

if($("#clie_fechanacimiento").val()!='0000-00-00')
{

  $("#edadclie_fechanacimiento").load("templateformsweb/maestro_standar_pacientes/edad.php",{

    clie_fechanacimiento:$("#clie_fechanacimiento").val()



  },function(result){  



  });  



  $("#edadclie_fechanacimiento").html("Espere un momento...");  

}





}


function imprimir_datos()
{

    <?php
   
   $busca_dtabla="select * from gogess_sistable where tab_name='".$table."'";
   $rs_dtabla = $DB_gogess->executec($busca_dtabla,array());
   
   ?>

   if($('#<?php echo @$rs_dtabla->fields["tab_campoprimario"] ?>').val()!='')
   {
   
   myWindow3=window.open('aplicativos/documental/datos_substandarform_print.php?iddata=<?php echo @$rs_dtabla->fields["tab_id"]; ?>&pVar2='+$('#<?php echo @$rs_dtabla->fields["tab_campoprimario"] ?>').val()+'&pVar3=<?php echo $_POST["pVar2"] ?>','ventana_imp','width=850,height=700,scrollbars=YES');

   myWindow3.focus();
   }
   else
   {
     alert("Para imprimir debe guardar el registro");
   
   }


}


function genera_pdfadmision()
{
  if($('#<?php echo $rs_dtabla->fields["tab_campoprimario"]; ?>').val()>0)
	 {	 
	    location.href = 'pdfformularios/pdfadmision.php?clie_id='+$('#clie_id').val()+'&iddata=<?php echo @$rs_dtabla->fields["tab_id"]; ?>&pVar2='+$('#<?php echo @$rs_dtabla->fields["tab_campoprimario"] ?>').val()+'&pVar3=<?php echo $_POST["pVar2"] ?>'
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir");	 
	 }

}

</script>

<?php
$anio_inicial=2018;
$subindice_at="_atencion";
$carpeta_at="atencion";

$subindice_evol="_informeevolucion";
$carpeta_evol="informeevolucion";

$subindice_evolpart="_informeevolucionparticular";
$carpeta_evolpart="informeevolucionparticular";
            

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            //$objformulario->sendvar["centro_idx"]=@$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["centro_idx"]='1';
			$objformulario->sendvar["tipoci_idx"]=1;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$valoralet=mt_rand(1,50000);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["clie_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["prob_codigox"]='17';
			$objformulario->sendvar["cant_codigox"]='1701';
			$objformulario->sendvar["idgen_idx"]=4;
			$objformulario->sendvar["orien_idx"]=4;
			$objformulario->sendvar["nact_idx"]=56;
			$objformulario->sendvar["nac_idx"]=56;
			
			
			$busca_dtabla="select max(clie_hcpinos) as hcmx from app_cliente";
			$rs_dtabla = $DB_gogess->executec($busca_dtabla,array());
			$max_hc = @$rs_dtabla->fields["hcmx"];
			$max_hc = $max_hc+1;
			

			$objformulario->sendvar["clie_hcpinosx"]=$max_hc;
			
			
				


$busca_conv="select * from app_usuario where usua_id='".@$_SESSION['ces1313777_sessid_inicio']."'";
$rs_dconv = $DB_gogess->executec($busca_conv,array());

?>

 

 <div id="tabs">

  <ul>

    <li><a href="#tabs-1">Validaci&oacute;n e Ingreso de Datos Personales</a></li>


    <li><a href="#tabs-2">Preconsulta</a></li>


  </ul>

  <div id="tabs-1" style="font-size:11px">

    <p>

	<?php
$linkimprimir='onClick=genera_pdfadmision();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR ADMISIONES </button>&nbsp;&nbsp;&nbsp;';

$linkimprimirresp='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimirresp.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR INF</button>&nbsp;&nbsp;&nbsp;';

$linkg="onclick=abrir_standar('templateformsweb/maestro_standar_pacientes/fotog.php','FOTO','divBody_foto','divDialog_foto',800,600,$('#clie_foto').val(),$('#clie_id').val(),1,0,0,0,0) style='cursor:pointer'";

echo '<button type="button" class="mb-sm btn btn-info" '.$linkg.'  style="cursor:pointer"> GIRAR FOTO </button>';


$linkgayuda="onclick=abrir_standar('ayuda/ayuda.php','AYUDA','divBody_foto','divDialog_foto',900,600,1,0,0,0,0,0,0) style='cursor:pointer'";

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkgayuda.'  style="cursor:pointer"> AYUDA </button>';

//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'paciente',$('#clie_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'paciente',$('#clie_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';
//cambio de fecha registro


echo '<div id="div_verifica" ></div>';

$alerta_info='';
if(!(@$_POST["pVar1"]))
{
  $alerta_info='<br>POR FAVOR VERIFIQUE EL N&UacuteMERO DE C&Eacute;DULA ANTES DE GUARDAR, YA QUE ESTE CAMPOS LA SIGUIENTE VEZ NO PODRA SER MODIFICADO (SOLO CON AUTORIZACI&Oacute;N)';
}
?>

<div id="divBody_foto"></div>
<div class="alert alert-info"><b>DATOS DEL PACIENTE / USUARIO <span style="color:#CC3300">!!! AVISO, NO OLVIDE LLENAR LA FECHA DE NACIMIEMTO (IMPORTANTE PARA SIGNOS VITALES)<?php echo $alerta_info; ?></span> </b></div>

<?php
$fecha_hoydia=date("Y-m-d");
$nueva_rango=date("Y-m-d",strtotime($fecha_hoydia."+2 days")); 

//alerta interconsulta
$lista_interx="select * from dns_newinterconsulta where (intercon_fecharegistro>='".$fecha_hoydia." 01:01' and intercon_fecharegistro<='".$nueva_rango." 23:59') and clie_id='".$objformulario->contenid["clie_id"]."'";

$rs_fechainterx = $DB_gogess->executec($lista_interx,array());

if($rs_fechainterx)
   {
			 while (!$rs_fechainterx->EOF) {
			 
			 	
				$busca_ttablat="select * from gogess_sistable where tab_name='".$rs_fechainterx->fields["enlace_tablaexterno"]."'";
				$rs_buntable = $DB_gogess->executec($busca_ttablat,array());
				
				$ntablavalor='';
				$ntablavalor=$rs_buntable->fields["tab_title"];

               echo "<span style='color:#FF0000' ><b>ALERTA: Tiene una Interconsulta ID:".$rs_fechainterx->fields["intercon_id"]." en formulario ".$ntablavalor."</b></span><br>";
                
				 $rs_fechainterx->MoveNext();
      }
  }	  
	  
?>

<div class="row">

  <div class="col-sm-6"><?php $objformulario->generar_formulario(@$submit,$table,1,$DB_gogess);  ?></div>

  <div class="col-sm-6"><?php $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess);  ?></div>

</div>  

<?php

$fecha_hoyv='';
$fecha_hoyv=date("d-m-Y");
$comilla_s="'";

?>
<br>
<button type="button" class="mb-sm btn btn-info" onclick="seguro_rp()" style="cursor:pointer"> VERIFICAR RED P&Uacute;BLICA </button> &nbsp; <!-- &nbsp;<button type="button" class="mb-sm btn btn-info" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/agendar_terapiaseguros.php','Perfil','divBody_ext','1','130',0,0,0,0,0)" style="cursor:pointer"> AGENDAMIENTO SEGUROS </button> -->
<?php $objformulario->generar_formulario(@$submit,$table,3,$DB_gogess);  ?>
<br />
<!-- <input type="button" name="Button" value="AGREGAR REPRESENTANTE" onclick="agregar_repredefactura()" />
<div id="agregar_rep"></div>-->
<br />
<?php $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess);  ?>

<br>

<?php $objformulario->generar_formulario(@$submit,$table,50,$DB_gogess);  ?>

<br>

<?php

echo $botonenvio;

?>

	

	</p>

  </div>



  <div id="tabs-2" style="font-size:11px" >

    <p>

	

<?php
$comill_s="'";
$cliente_valor="$('#clie_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php'.$comill_s.','.$comill_s.'ATENCION'.$comill_s.','.$comill_s.'divBody_interno_atencion'.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'39'.$comill_s.',0,0,0,0)" style=cursor:pointer';	
echo '<div align="left" >';


echo '<span id="btn_nuevaatencion" ><button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button></span>';

$linkgayuda="onclick=abrir_standar('ayuda/ayuda.php','AYUDA','divBody_foto','divDialog_foto',900,600,2,0,0,0,0,0,0) style='cursor:pointer'";

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkgayuda.'  style="cursor:pointer"> AYUDA </button>';

//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'atencion',$('#atenc_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'atencion',$('#atenc_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';
//cambio de fecha registro


echo '</div>';
?>
<div id="divBody_interno<?php echo $subindice_at; ?>" ></div>


	<div align="center" id=grid<?php echo $subindice_at; ?> ></div>
	
	
	</p>
  </div>

 

</div>


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

<div id=div_<?php echo $table ?> > </div>





<script>

  $( function() {

    $( "#tabs" ).tabs();

  } );

function agregar_repredefactura()
{

   $("#agregar_rep").load("templateformsweb/maestro_standar_pacientes/busca_rep.php",{

  clie_rucci:$('#clie_rucci').val()


  },function(result){  

  });  

  $("#agregar_rep").html("Espere un momento");  

}



  
function desplegar_grid_informeevolucionparticular()
{

   $("#grid<?php echo $subindice_evolpart; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_evolpart; ?>/grid<?php echo $subindice_evolpart; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_evolpart; ?>'
  //filtro_val:$('#filtro_val').val()

  },function(result){  

  });  

  $("#grid<?php echo $subindice_evolpart; ?>").html("Espere un momento");  

}


function desplegar_grid_informeevolucion()
{

   $("#grid<?php echo $subindice_evol; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_evol; ?>/grid<?php echo $subindice_evol; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_evol; ?>'
  //filtro_val:$('#filtro_val').val()

  },function(result){  

  });  

  $("#grid<?php echo $subindice_evol; ?>").html("Espere un momento");  

}




  

function desplegar_grid_atencion(filtro)
{

   $("#grid<?php echo $subindice_at; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_at; ?>/grid<?php echo $subindice_at; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_at; ?>',
  filtro:filtro
  //filtro_val:$('#filtro_val').val()

  },function(result){  

  });  


  $("#grid<?php echo $subindice_at; ?>").html("Espere un momento <img src='images/progress/progress_1.gif' width='31' height='31' />");  

}



//desplegar_grid_atencion();

//$('#tabs-2').hide();


    $.fn.disableTab = function (tabIndex, hide) {

        // Get the array of disabled tabs, if any

        var disabledTabs = this.tabs("option", "disabled");



        if ($.isArray(disabledTabs)) {

            var pos = $.inArray(tabIndex, disabledTabs);



            if (pos < 0) {

                disabledTabs.push(tabIndex);

            }

        }

        else {

            disabledTabs = [tabIndex];

        }



        this.tabs("option", "disabled", disabledTabs);



        if (hide === true) {

            $(this).find('li:eq(' + tabIndex + ')').addClass('ui-state-hidden');

        }



        // Enable chaining

        return this;

    };



    $.fn.enableTab = function (tabIndex) {

                $(this).find('li:eq(' + tabIndex + ')').removeClass('ui-state-hidden');

        this.tabs("enable", tabIndex);

        return this;

        

    };





    function activa_tab()
	{	

	   //$('#tabs').enableTab(1);

	   $('#tabs').enableTab(1);
	  // $('#tabs').enableTab(2); 
	  // $('#tabs').enableTab(3);


	   desplegar_grid_atencion(0);
	   desplegar_grid_informeevolucion();
	   desplegar_grid_informeevolucionparticular();

	}

	

	function desactiva_tab()

	{

	  //  $('#tabs').disableTab(1);	
		$('#tabs').disableTab(1);
		//$('#tabs').disableTab(2);
		//$('#tabs').disableTab(3);
		

	}

	<?php

	if($objformulario->contenid["clie_id"]>0)

	{   

	   echo '

	  activa_tab();

	  ';

	

	}

	else

	{

	   echo '

	   desactiva_tab();

	   '; 

	  

	}

	

	if(@$atenc_id)

	{

	

	echo "ver_formularioenpantalla('aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php','Editar','divBody_interno".$subindice_at."','".$atenc_id."','".$_POST["pVar1"]."','39',0,0,0,0);";

	

	echo '$("#tabs").tabs( {active:1} );';

	

	}

	?>

</script>



<script>

ver_calendario_general();

</script>





<script>

function seguro_acces()
{
  myWindow2=window.open('http://www.calidadsalud.gob.ec/acess-app-servicio-ciudadano/public/medicinaPrepagada/consulta.jsf','seguro','width=750,height=500,scrollbars=YES');

 myWindow2.focus();

}

function seguro_rp()
{
  myWindow2=window.open('https://coresalud.msp.gob.ec/coresalud/app.php/publico/rpis/afiliacion/consulta','Red','width=750,height=500,scrollbars=YES');

 myWindow2.focus();

}

function verificar_seguro(fecha)
{
   if($('#clie_rucci').val()=='')
   {
     alert("Por favor ingrese el CI");
   
   }
   else
   {
   <?php 
   $fechaf='';
   $fechaf=date("d-m-Y");
    ?>
   var url="https://coresalud.msp.gob.ec/coresalud/app.php/publico/rpis/afiliacion/consultafiliacion/"+$('#clie_rucci').val()+"/<?php echo $fechaf; ?>";
   
   $("#div_verifica").load("../../../scraping2/lektor.php",{
   url:url
  },function(result){  
         
         $('#tipopac_id').val($('#valor_as').val());
		 $('#clie_aseguradora').val($('#valor_avalor').val());
		 $('#despliegue_clie_aseguradora').html($('#valor_avalor').val());		 
		 
		 $('#clie_apellido').val($('#valor_apellido').val());
		 $('#clie_nombre').val($('#valor_nombre').val());
		 
		 
		if($('#dia_clie_fechanacimiento').val()=='null' || $('#dia_clie_fechanacimiento').val()=='00')
		{		
		 $('#dia_clie_fechanacimiento').val($('#dia_clie_fechanacimientov').val());	
		}
		if($('#mes_clie_fechanacimiento').val()=='null' || $('#mes_clie_fechanacimiento').val()=='00')
		{	 
		 $('#mes_clie_fechanacimiento').val($('#mes_clie_fechanacimientov').val());
		}		 
		if($('#anio_clie_fechanacimiento').val()=='null' || $('#anio_clie_fechanacimiento').val()=='00000')
		{
		 $('#anio_clie_fechanacimiento').val($('#anio_clie_fechanacimientov').val());
		}
		 
		 
		 
		// $('#dia_clie_fechanacimiento').val($('#dia_clie_fechanacimientov').val());
		 //$('#mes_clie_fechanacimiento').val($('#mes_clie_fechanacimientov').val());
		// $('#anio_clie_fechanacimiento').val($('#anio_clie_fechanacimientov').val());
		 
		 fecha_bloqueasignaedad('dia_clie_fechanacimiento','mes_clie_fechanacimiento','anio_clie_fechanacimiento','clie_fechanacimiento');
		 
		 $('#clie_consultaredpublica').val($('#valor_generalt').val())
		 $('#despliegue_clie_consultaredpublica').html($('#valor_generalt').val())
		 
		 $('#clie_consultaredpublicafecha').val($('#fvalor_generalt').val())
		 $('#despliegue_clie_consultaredpublicafecha').html($('#fvalor_generalt').val())
		 
		 
		 
  });  

  $("#div_verifica").html("Espere un momento...");  
  
  }

}


         $(function() {

            $( "#repres_cix" ).autocomplete({

               source: "templateformsweb/maestro_standar_pacientes/search.php",

               minLength: 4,

			   select: function( event, ui ) {

			   

                  $('#repres_cix').val(ui.item.ruc);

				  $('#repres_nombrex').val(ui.item.nombre);

				  $('#repres_telefonox').val(ui.item.telefono);

				  $('#repres_parentescox').val(ui.item.parentesco);



				  

				 lista_hijos(ui.item.ruc);

					

			   }

            });

         });

		 

generar_edadin();		

//$('#clie_rucci_despliegue').html('<button type="button" class="mb-sm btn btn-info" onclick=verificar_seguro("<?php echo $fecha_hoyv; ?>")  style="cursor:pointer">CONSULTAR</button>'); 


  $(function() {
            $( "#clie_rucci" ).autocomplete({
               source: "templateformsweb/maestro_standar_pacientes/searchfactura.php",
               minLength: 2,
			   select: function( event, ui ) {			  

				  $('#clie_apellido').val(ui.item.apellido);
				  $('#clie_nombre').val(ui.item.nombre);
				  $('#clie_direccion').val(ui.item.direccion);
				  $('#clie_celular').val(ui.item.celular);
				  $('#clie_telefono').val(ui.item.telefono);
				  $('#clie_email').val(ui.item.email);
				  $('#civil_id').val(ui.item.civil);
				  $('#clie_fechanacimiento').val(ui.item.clie_fechanacimiento);
				  
				  $('#anio_clie_fechanacimiento').val(ui.item.anio_clie_fechanacimiento);
				  $('#mes_clie_fechanacimiento').val(ui.item.mes_clie_fechanacimiento);
				  $('#dia_clie_fechanacimiento').val(ui.item.dia_clie_fechanacimiento);	
				  $('#clie_genero').val(ui.item.clie_genero);				  
				  $('#clie_instruccion').val(ui.item.clie_instruccion);
				  $('#grp_id').val('12');
				  
				  $('#prob_codigo').val(ui.item.prob_codigo);
				  $('#cant_codigo').val(ui.item.cant_codigo);			  
				  
				  
				  
				  
				  fecha_bloqueasignaedad('dia_clie_fechanacimiento','mes_clie_fechanacimiento','anio_clie_fechanacimiento','clie_fechanacimiento');
					
			   }
            });
         });	

<?php
if(!($csearch))
{
?>
showUser_combog('cant_codigo',$('#prob_codigo').val(),'divcant_codigo','prob_codigo','app_cliente','',0,0,0,0,0);
//$('#cant_codigo').val('1701');
<?php
}
?>

<?php
if($rs_dconv->fields["conve_id"]>0)
{
?>
 desactiva_tab();
<?php
}
?>
</script>
