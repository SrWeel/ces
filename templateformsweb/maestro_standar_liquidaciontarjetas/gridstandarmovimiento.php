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
<div id="l_detallemovimientot">

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


function lista_movimientost()
{
     
     
	 $("#l_detallemovimientot").load("templateformsweb/maestro_standar_conciliaciontarjetas/movimientos/lista_movimientos.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>',
		conct_fechacorte:$('#conct_fechacorte').val(),
		conct_cuenta:$('#conct_cuenta').val(),
		conct_saldobanco:$('#conct_saldobanco').val(),
		conct_id:$('#conct_id').val()
		
	  },function(result){  

		    
	  });  
	
	  $("#l_detallemovimientot").html("...");  

}


function actualiza_retenciones()
{
     
	 $("#acv_retencion").load("templateformsweb/maestro_standar_conciliaciontarjetas/movimientos/actualizar_lista.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>'
	  },function(result){  
      
	  lista_retenciones(); 
		    
	  });  
	
	  $("#acv_retencion").html("...");  

}

if($('#conct_id').val()!='')
{
  lista_movimientost();
}


$( "#dia_conct_fechacorte" ).on( "change", function() {
  lista_movimientost();
} );

$( "#mes_conct_fechacorte" ).on( "change", function() {
  lista_movimientost();
} );

$( "#anio_conct_fechacorte" ).on( "change", function() {
  lista_movimientost();
} );



$( "#conct_cuenta" ).on( "change", function() {
  lista_movimientost();
} );

//-->
</script>