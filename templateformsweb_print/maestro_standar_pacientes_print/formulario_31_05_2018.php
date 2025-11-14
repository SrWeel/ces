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
	mes_idg:$('#mes_idg').val()

  },function(result){  

      

  });  

  $("#cal_general").html("Espere un momento...");  



}

function selecciona_dia_general(anio,mes,dia)
{
    
	//$('#horat_fechax').val(anio+'-'+mes+'-'+dia);
	
}
</script>
<?php

$anio_inicial=2018;

$subindice_at="_atencion";
$carpeta_at="atencion";

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["clie_enlacex"]=$aletorioid;	
			
			

?>
 
 <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Datos Personales</a></li>
	<li><a href="#tabs-2">Anamnesis Cl&iacute;nica</a></li>
    <li><a href="#tabs-3">Evaluaci&oacute;n</a></li>
	<li><a href="#tabs-4">Calendario</a></li>
  </ul>
  <div id="tabs-1" style="font-size:11px">
    <p>
	
<div class="row">
  <div class="col-sm-6"><?php $objformulario->generar_formulario(@$submit,$table,1,$DB_gogess);  ?></div>
  <div class="col-sm-6"><?php $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess);  ?></div>
</div>  

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
   <?php $objformulario->generar_formulario(@$submit,$table,3,$DB_gogess);  ?>
   
<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,5,$DB_gogess);  ?>
</div>
</div>

<?php $objformulario->generar_formulario(@$submit,$table,6,$DB_gogess);  ?>

<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,7,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,8,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,9,$DB_gogess);  ?>

<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,10,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,11,$DB_gogess);  ?>
</div>
</div>

<?php $objformulario->generar_formulario(@$submit,$table,12,$DB_gogess);  ?>

<B><hr />DESARROLLO F&Iacute;SICO:</B>
<br>
<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,13,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,14,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,15,$DB_gogess);  ?>


<B><hr />DESARROLLO LENGUAJE:</B>
<br>
<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,16,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,17,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,18,$DB_gogess);  ?>


<B><hr />DESARROLLO COGNITIVO:</B>
<br>
<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,19,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,20,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,21,$DB_gogess);  ?>



<B><hr />DESARROLLO SOCIAL:</B>
<br>
<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,22,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,23,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,24,$DB_gogess);  ?>



<div class="form-group">	
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,25,$DB_gogess);  ?>
</div>
<div class="col-md-6">
<?php $objformulario->generar_formulario(@$submit,$table,26,$DB_gogess);  ?>
</div>
</div>
<?php $objformulario->generar_formulario(@$submit,$table,27,$DB_gogess);  ?>

<?php $objformulario->generar_formulario(@$submit,$table,28,$DB_gogess);  ?>
<?php $objformulario->generar_formulario(@$submit,$table,29,$DB_gogess);  ?>
<?php $objformulario->generar_formulario(@$submit,$table,30,$DB_gogess);  ?>

<?php
echo $botonenvio;
?>
   </p> 
  </div>
  <div id="tabs-3" style="font-size:11px" >
    <p>
	
	
<?php
$comill_s="'";
$cliente_valor="$('#clie_id').val()";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php'.$comill_s.','.$comill_s.'ATENCION'.$comill_s.','.$comill_s.'divBody_interno_atencion'.$comill_s.','.$comill_s.$comill_s.','.$cliente_valor.','.$comill_s.'39'.$comill_s.',0,0,0,0)" style=cursor:pointer';	

echo '<div align="center">';

echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';

echo '</div>';

?>
	
<div id="divBody_interno<?php echo $subindice_at; ?>" ></div>

<p>&nbsp;</p>	
	<div align="center" id=grid<?php echo $subindice_at; ?> ></div>
	
	</p>
  </div>
  
  <div id="tabs-4" style="font-size:11px" >
    <p>
	
	 <?php
//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3">A&ntilde;o:</span></td>
    <td><span class="Estilo3">
      <select name="anio_idg" id="anio_idg">
        <option value="0">-seleccionar-</option>
        <?php
	  $anio_actual=date("Y");
	  $numanio=$anio_actual-$anio_inicial;
	  if($numanio==0)
	  {
	       echo '<option value="'.$anio_actual.'">'.$anio_actual.'</option>';
	  
	  }
	  else
	  {
	      for($i=0;$i<=$numanio;$i++)
		  {
		      echo '<option value="'.$anio_actual+$i.'">'.$anio_actual+$i.'</option>';
			  
		  }
	  
	  }
	  
	  ?>
        </select>
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3">Mes</span></td>
    <td><span class="Estilo3">
      <select name="mes_idg" id="mes_idg">
	     <option value="0">-seleccionar-</option>
		 <?php
		 for($i=1;$i<=count($meses);$i++)
		  {
		      echo '<option value="'.$i.'">'.$meses[$i].'</option>';
			  
		  }
		 ?>
      </select>
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Ver" onClick="ver_calendario_general()"></span></td>
  </tr>
</table>
</div>
	
	
	 <div id="cal_general"></div>

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
  
  
  
function desplegar_grid_atencion()
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

desplegar_grid_atencion();

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
	   $('#tabs').enableTab(1);
	   $('#tabs').enableTab(2);
	   $('#tabs').enableTab(3);
	   desplegar_grid_atencion();
	}
	
	function desactiva_tab()
	{
	    $('#tabs').disableTab(1);	
		$('#tabs').disableTab(2);
		$('#tabs').disableTab(3);
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
	
	echo '$("#tabs").tabs( {active:2} );';
	
	}
	?>
</script>

<script>
ver_calendario_general();
</script>


<script>
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
</script>