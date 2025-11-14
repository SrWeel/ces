<?php
$campos_dataedit=array();
$campos_dataedit=explode(",",$this->fie_tablasubgridcampos);
$campo_id=$this->fie_tablasubcampoid;

$fie_tblcombogrid=$this->fie_tblcombogrid;
$fie_campoidcombogrid=$this->fie_campoidcombogrid;

$campos_validaciongrid=array();
$campos_validaciongrid=explode(",",$this->fie_camposobligatoriosgrid);

$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$this->fie_tituloscamposgrid);

$campo_enlace=$this->fie_campoenlacesub;

?>
<div class="panel panel-default" >
<div class="panel-heading">

    <h3 class="panel-title" style="color:#000033">Movimientos</h3>

 </div>
<div class="panel-body">
<div id="l_detallemovimiento">

</div>

<div id="acv_retencion"></div>

</div>
</div>

<script language="javascript">
<!--

<?php
$valor_enlace='';
if(@$this->contenid[$campo_enlace])
{
$valor_enlace=@$this->contenid[$campo_enlace];
}
else
{
$valor_enlace=@$this->sendvar[$campo_enlace."x"];
}
?>


function lista_movimientos()
{
     
	 $("#l_detallemovimiento").load("templateformsweb/maestro_standar_conciliacionbancos/movimientos/lista_movimientos.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>',
		conc_fechacorte:$('#conc_fechacorte').val(),
		conc_cuenta:$('#conc_cuenta').val(),
		conc_saldobanco:$('#conc_saldobanco').val()
		
	  },function(result){  

		    
	  });  
	
	  $("#l_detallemovimiento").html("...");  

}


function actualiza_retenciones()
{
     
	 $("#acv_retencion").load("templateformsweb/maestro_standar_conciliacionbancos/movimientos/actualizar_lista.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>'
	  },function(result){  
      
	  lista_retenciones(); 
		    
	  });  
	
	  $("#acv_retencion").html("...");  

}

if($('#conc_id').val()!='')
{
  lista_movimientos();
}


$( "#dia_conc_fechacorte" ).on( "change", function() {
  lista_movimientos();
} );

$( "#mes_conc_fechacorte" ).on( "change", function() {
  lista_movimientos();
} );

$( "#anio_conc_fechacorte" ).on( "change", function() {
  lista_movimientos();
} );



$( "#conc_cuenta" ).on( "change", function() {
  lista_movimientos();
} );

//-->
</script>