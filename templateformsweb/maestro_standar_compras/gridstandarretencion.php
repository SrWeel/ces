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


<!-- <input type="button" name="Submit" value="VER XML" onclick="verdetallesret_xml()" class="btn btn-default" > -->
<div class="panel panel-default" >
<div class="panel-body">
<div id="l_detallerete">

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


function lista_retenciones()
{
     
	 $("#l_detallerete").load("templateformsweb/maestro_standar_compras/retenciones/lista_retenciones.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>'
	  },function(result){  

		    
	  });  
	
	  $("#l_detallerete").html("...");  

}


function actualiza_retenciones()
{
     
	 $("#acv_retencion").load("templateformsweb/maestro_standar_compras/retenciones/actualizar_lista.php",{
        campo_enlace:'<?php echo $valor_enlace; ?>'
	  },function(result){  
      
	  lista_retenciones(); 
		    
	  });  
	
	  $("#acv_retencion").html("...");  

}


lista_retenciones();

//-->
</script>