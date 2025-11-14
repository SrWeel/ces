<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","14400");
session_start();

$director="../../../../";
include ("../../../../cfgclases/clases.php");

$table="ca_equipos_inventario";
$subindice="_equipoing";
$subindice_parte="_parteing";
$objformulario->pathexterno="../../../../";

?>
<script type="text/javascript">
<!--
function desplegar_gr()
{
	
	
   $("#grid<?php echo $subindice; ?>").load("aplications/usuario/opciones/extras/grid_equipo/grid<?php echo $subindice; ?>.php",{

  },function(result){  

  });  
  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  

}

function formulario_uno(ideditar)
{
	
		
   $("#form<?php echo $subindice; ?>").load("aplications/usuario/opciones/extras/grid_equipo/grid<?php echo $subindice; ?>_nuevo.php",{
enlace:'<?php echo $_POST["pVar1"] ?>',pVar1:ideditar
  },function(result){  

  });  
  $("#form<?php echo $subindice; ?>").html("Espere un momento...");  
	
}


function borrar_registro_data(tabla,campo,valor)
{
     
	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 


	 $("#grid_borrar_data").load("aplications/usuario/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){  
      desplegar_gr()
	  formulario_uno();
  });  
  $("#grid_borrar_data").html("Espere un momento...");  
  
  
  }

}

function desplegar_gr_partes(idenlace)
{
	
	
   $("#grid<?php echo $subindice; ?>_partes").load("aplications/usuario/opciones/extras/grid_equipo/grid<?php echo $subindice_parte; ?>.php",{
  idenlacep:idenlace
  },function(result){  

  });  
  $("#grid<?php echo $subindice; ?>_partes").html("Espere un momento...");  

}


function borrar_registro_parte(tabla,campo,valor,enlace)
{
     
	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 


	 $("#grid_borrar_parte").load("aplications/usuario/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor,
	 penlace:enlace
  },function(result){  
      desplegar_gr_partes(enlace);
	
  });  
  $("#grid_borrar_parte").html("Espere un momento...");  
  
  
  }

}

//  End -->
</script>
<style type="text/css">
.css_parte {
	font-size: 11px;
	font-family: Verdana, Geneva, sans-serif;
	text-align: center;
	font-weight: bold;
}
</style>


<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="400" rowspan="2" valign="top"><?php 
	//$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,1,$DB_gogess); 
	
	?>
 
      <div id=form<?php echo $subindice; ?> ></div>
    
    </td>
    <td width="400" valign="top">
	
	<div id=grid<?php echo $subindice; ?> ></div>
    </td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E1E8EC">
   
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td  bgcolor="#C7DAE4" class="css_parte">PARTES</td>
        </tr>
       
        <tr>
          <td colspan="2"> <div id=grid<?php echo $subindice; ?>_partes >&nbsp;</div></td>
        </tr>
    </table>
    
    </td>
  </tr>
</table>
<div id=grid_borrar_data ></div>
<div id=grid_borrar_parte ></div>
<div id=divBody_parteing ></div>
<script type="text/javascript">
<!--
formulario_uno('');
desplegar_gr();
//  End -->
</script>