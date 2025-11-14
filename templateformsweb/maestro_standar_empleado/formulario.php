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
function generar_edad(fechallega)
{

  $("#edadclie_fechanacimiento").load("templateformsweb/maestro_standar_empleado/edad.php",{
    clie_fechanacimiento:fechallega

  },function(result){  


  });  

  $("#edadclie_fechanacimiento").html("Espere un momento...");  

}





function generar_edadin()
{

if($("#clie_fechanacimiento").val()!='0000-00-00')
{

  $("#edadclie_fechanacimiento").load("templateformsweb/maestro_standar_empleado/edad.php",{
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
</script>
<?php

$anio_inicial=2018;
$subindice_at="_rubro";
$carpeta_at="rubro";

$subindice_hextras="_hextras";
$carpeta_hextras="hextras";

$subindice_anticipos="_anticipos";
$carpeta_anticipos="anticipos";

$subindice_vextras="_vextras";
$carpeta_vextras="vextras";

$subindice_evolpart="_informeevolucionparticular";
$carpeta_evolpart="informeevolucionparticular";


$subindice_vtomadas="_vacacionestomadas";
$carpeta_vtomadas="vacacionestomadas";


$objformulario->react_id=$react_id;


	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["solofechax"]=date("Y-m-d");
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=@$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["tipoci_idx"]=1;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$valoralet=mt_rand(1,50000);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["usua_enlacex"]=$aletorioid;	

?>
 <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Datos Personales</a></li>
    <li><a href="#tabs-2">Rubros Asignados</a></li>
	<li><a href="#tabs-3">Horas Extras</a></li>
	<li><a href="#tabs-4">Anticipos de Sueldo</a></li>
	<li><a href="#tabs-5">Valores Extras</a></li>
	<li><a href="#tabs-6">Vacaciones</a></li>
  </ul>

  <div id="tabs-1" style="font-size:11px">
    <p>
<?php
$linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>&nbsp;&nbsp;&nbsp;';

$linkg="onclick=abrir_standar('templateformsweb/maestro_standar_empleado/fotog.php','FOTO','divBody_foto','divDialog_foto',800,600,$('#usua_archivo').val(),$('#usua_id').val(),1,0,0,0,0) style='cursor:pointer'";

echo '<button type="button" class="mb-sm btn btn-info" '.$linkg.'  style="cursor:pointer"> GIRAR FOTO </button>';

?>
<div id="divBody_foto"></div>
<div class="row">
  <div class="col-sm-12">
  <fieldset disabled>
  <?php  $objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);  ?>  
  </fieldset>
  <div id="antiguedad_id" align="left"></div>
  </div>
  <div class="col-sm-12" id="cocp"><?php
  
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);


?>
  <div id="vacaciones_id" align="left"></div>   
  </div>
</div>
<br>
<?php 
$objformulario->generar_formulario_bootstrap(@$submit,$table,50,$DB_gogess); 
 ?>
 
 

<br>
<?php
echo $botonenvio;
?>

<?php
if($csearch)
{    
  
  ?>
  <p>&nbsp;</p>
  


  <center>
  <input type="button" name="Submit" value="Reset Clave" onclick="resetclv()" />
  <div id="clv_panel" ></div>
  </center>
  
  <p>&nbsp;</p>
  <?php
  
}
?>



	</p>
  </div>
  
  <div id="tabs-2" style="font-size:11px" >
    <p>
<?php
$comill_s="'";
$cliente_valor="$('#usua_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/rubro/grid_rubro_nuevo.php'.$comill_s.','.$comill_s.'RUBROS'.$comill_s.','.$comill_s.'divBody_interno_rubro'.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'144'.$comill_s.',0,0,0,0)" style=cursor:pointer';
echo '<div align="left" >';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';
echo '</div>';
?>

<div id="divBody_interno<?php echo $subindice_at; ?>" ></div>
<div align="center" id=grid<?php echo $subindice_at; ?> ></div>	

	</p>

  </div>
  
  <div id="tabs-3" style="font-size:11px" >
    <p>
<!--	<input type="button" name="Submit2" value="Button" onclick="desplegar_grid_hextras()" />  -->
<?php
$comill_s="'";
$cliente_valor="$('#usua_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/hextras/grid_hextras_nuevo.php'.$comill_s.','.$comill_s.'HORAS_EXTRAS'.$comill_s.','.$comill_s.'divBody_interno'.$subindice_hextras.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'145'.$comill_s.',0,0,0,0)" style=cursor:pointer';
echo '<div align="left" >';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';
echo '</div>';
?>	
	<div id="divBody_interno<?php echo $subindice_hextras; ?>" ></div>
    <div align="center" id=grid<?php echo $subindice_hextras; ?> ></div>	
	
	</p>
  </div>
  
  
   <div id="tabs-4" style="font-size:11px" >
    <p>
<?php
$comill_s="'";
$cliente_valor="$('#usua_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/anticipos/grid_anticipos_nuevo.php'.$comill_s.','.$comill_s.'ANTICIPOS'.$comill_s.','.$comill_s.'divBody_interno'.$subindice_anticipos.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'146'.$comill_s.',0,0,0,0)" style=cursor:pointer';
echo '<div align="left" >';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';
echo '</div>';
?>
    <div id="divBody_interno<?php echo $subindice_anticipos; ?>" ></div>
    <div align="center" id=grid<?php echo $subindice_anticipos; ?> ></div>
    </p>
  </div>
  
  
 <div id="tabs-5" style="font-size:11px" >
    <p>
<?php
$comill_s="'";
$cliente_valor="$('#usua_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/vextras/grid_vextras_nuevo.php'.$comill_s.','.$comill_s.'VALORES_EXTRAS'.$comill_s.','.$comill_s.'divBody_interno'.$subindice_vextras.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'147'.$comill_s.',0,0,0,0)" style=cursor:pointer';
echo '<div align="left" >';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';
echo '</div>';
?>
    <div id="divBody_interno<?php echo $subindice_vextras; ?>" ></div>
    <div align="center" id=grid<?php echo $subindice_vextras; ?> ></div>
    </p>
  </div>
  
  
  <div id="tabs-6" style="font-size:11px" >
    <p>
<?php
$comill_s="'";
$cliente_valor="$('#usua_id').val()";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/vacacionestomadas/grid_vacacionestomadas_nuevo.php'.$comill_s.','.$comill_s.'VACACIONES'.$comill_s.','.$comill_s.'divBody_interno'.$subindice_vtomadas.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'148'.$comill_s.',0,0,0,0)" style=cursor:pointer';
echo '<div align="left" >';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';
echo '</div>';
?>
    <div id="divBody_interno<?php echo $subindice_vtomadas; ?>" ></div>
    <div align="center" id=grid<?php echo $subindice_vtomadas; ?> ></div>
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



function calcula_vacaciones()
{
   
   if($('#usua_id').val())
   {
   
	   $("#vacaciones_id").load("templateformsweb/maestro_standar_empleado/vacaciones.php",{
		  usua_id:$('#usua_id').val()
	
	  },function(result){  
	
	  }); 
	
		$("#vacaciones_id").html("Espere un momento"); 
  
  }

}


function calcula_antiguedad()
{
   
   if($('#usua_id').val())
   {
   
	   $("#antiguedad_id").load("templateformsweb/maestro_standar_empleado/antiguedad.php",{
		  usua_id:$('#usua_id').val()
	
	  },function(result){  
	
	  }); 
	
		$("#antiguedad_id").html("Espere un momento"); 
  
  }

}

calcula_antiguedad();
calcula_vacaciones();


function desplegar_grid_rubro()
{


   $("#grid<?php echo $subindice_at; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_at; ?>/grid<?php echo $subindice_at; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_at; ?>'

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  });  

  $("#grid<?php echo $subindice_at; ?>").html("Espere un momento");  

}


function desplegar_grid_hextras()
{

   $("#grid<?php echo $subindice_hextras; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_hextras; ?>/grid<?php echo $subindice_hextras; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_hextras; ?>'

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  });  

  $("#grid<?php echo $subindice_hextras; ?>").html("Espere un momento");  

}


function desplegar_grid_anticipos()
{

   $("#grid<?php echo $subindice_anticipos; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_anticipos; ?>/grid<?php echo $subindice_anticipos; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_anticipos; ?>'

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  });  

  $("#grid<?php echo $subindice_anticipos; ?>").html("Espere un momento");  

}


function desplegar_grid_vextras()
{

   $("#grid<?php echo $subindice_vextras; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_vextras; ?>/grid<?php echo $subindice_vextras; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_vextras; ?>'

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  });  

  $("#grid<?php echo $subindice_vextras; ?>").html("Espere un momento");  

}


function desplegar_grid_vacacionestomadas()
{

   $("#grid<?php echo $subindice_vtomadas; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta_vtomadas; ?>/grid<?php echo $subindice_vtomadas; ?>.php",{

  pVar2:<?php echo $cliente_valor; ?>,
  pVar3:<?php echo $_POST["pVar3"] ?>,
  indice_grid:'<?php echo $subindice_vtomadas; ?>'

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  });  

  $("#grid<?php echo $subindice_vtomadas; ?>").html("Espere un momento");  

}

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
	   $('#tabs').enableTab(2);
	   $('#tabs').enableTab(3);
	   $('#tabs').enableTab(4);
	   $('#tabs').enableTab(5);
	   desplegar_grid_rubro();
	   desplegar_grid_hextras();
	   desplegar_grid_anticipos();
	   desplegar_grid_vextras();
	   desplegar_grid_vacacionestomadas();
	}



	function desactiva_tab()
	{
	  //  $('#tabs').disableTab(1);	
		$('#tabs').disableTab(1);
        $('#tabs').disableTab(2);
		$('#tabs').disableTab(3);
		$('#tabs').disableTab(4);
		$('#tabs').disableTab(5);
	}

	<?php
	if($objformulario->contenid["usua_id"]>0)
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

         $(function() {
            $( "#repres_cix" ).autocomplete({
               source: "templateformsweb/maestro_standar_empleado/search.php",
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


function resetclv()
{

   $("#clv_panel").load("templateformsweb/maestro_standar_faeusuario/clvreset.php",{
    idv:$('#usua_id').val()


  },function(result){  



  });  

  $("#clv_panel").html("Espere un momento...");  

}

</script>

<script type="text/javascript">
<!--
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});

$("#cocp").hide();

//  End -->
</script>