<?php
if($_SESSION['ces1313777_sessid_inicio'])
 { 
$subindice='_cliente';
$carpeta='cliente';
?>
<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{

  },function(result){  

  });  
  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  

}

function borrar_registro(tabla,campo,valor)
{
     
	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 


	 $("#grid_borrar").load("aplicativos/documental/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){  
      desplegar_grid();
	 
  });  
  $("#grid_borrar").html("Espere un momento...");  
  
  
  }

}


//  End -->
</script>
<?php

$linkeditar= 'onclick=abrir_standar("aplicativos/documental/opciones/grid/'.$carpeta.'/grid'.$subindice.'_nuevo.php","Nuevo","divBody'.$subindice.'","divDialog'.$subindice.'",950,600,0,0,0,0,0,0,0) style=cursor:pointer';	

 //$objmenuFactura = new  menu_generico(@$linkeditar,@$link_panel_buscar,'','','',$objperfil);  
 //$objmenuFactura->desplegar_menu();

?>
<table width="900px" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td> <input type="button" name="Submit" value="NUEVO" <?php echo $linkeditar; ?> class="btn-submit" > 
	&nbsp;
	</td>
  </tr>
</table>

<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>
<script type="text/javascript">
<!--
desplegar_grid();
//  End -->
</script>
<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="grid_borrar" ></div>
<?php
 }

?>
