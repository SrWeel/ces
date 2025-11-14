<style type="text/css">
<!--
.TableScroll {
        z-index:99;
		width:230px;
        height:130px;	
        overflow: auto;
      }
	  
.TableScroll_d {
        z-index:99;
		width:430px;
        height:530px;	
        overflow: auto;
      }	  
.Estilo2 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
	  
-->
</style>

<script language="javascript">
<!--




function subir_clientes()
{
  $("#id_boton1").html("Procesando....");
  $("#div_subirc").load("../lector_xls/lectura_contactos.php",{},function(result){  
     
	 ver_boton1();
	 
  });  
  
  $("#div_subirc").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function ver_boton1()
{

$("#id_boton1").html("<table border='0' cellpadding='0' cellspacing='0'><tr> <td onClick='subir_clientes()' ><img src='images/subir_cliente.png' width='128' height='128' /></td></tr></table>");

}

function ver_boton2()
{

$("#id_boton2").html("<table border='0' cellpadding='0' cellspacing='0'><tr> <td onClick='subir_facturas()' ><img src='images/subir_factura.png' width='128' height='128' /></td></tr></table>");

}

function ver_boton3()
{

$("#id_boton3").html("<table border='0' cellpadding='0' cellspacing='0'><tr> <td onClick='subir_proveedor()' ><img src='images/subir_proveedor.png' width='128' height='128' /></td></tr></table>");

}

function ver_boton4()
{

$("#id_boton4").html("<table border='0' cellpadding='0' cellspacing='0'><tr> <td onClick='subir_ncredito()' ><img src='images/subir_ncredito.png' width='128' height='128' /></td></tr></table>");

}
//-----------------------------------



function subir_facturas()
{
   $("#id_boton2").html("Procesando....");
   $("#div_subirf").load("../lector_xls/lector_datos.php",{

  },function(result){  
     ver_boton2();
  });  
  $("#div_subirf").html("<img src='images/barra_carga.gif' width='220' height='40' />");  

}

//--------------------------------

function subir_ncredito()
{
   $("#id_boton4").html("Procesando....");
   $("#div_subirn").load("../lector_xls/lector_ncredito.php",{

  },function(result){  
     ver_boton4();
  });  
  $("#div_subirn").html("<img src='images/barra_carga.gif' width='220' height='40' />");  

}

//-------------------------------


function subir_proveedor()
{
  $("#id_boton3").html("Procesando....");
  
  $("#div_subirp").load("../lector_xls/lectura_proveedor.php",{},function(result){  
     
	 ver_boton3();
	 
  });  
  
  $("#div_subirp").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function llamar_verificar(path)
{

$("#divBody_verificar").load(path,{},function(result){  
     
	 
  });  
  
  $("#divBody_verificar").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

//-->
</script>



<p>&nbsp;</p>
<div align="center">

<?php
	if($_SESSION['usua_admx']==1)
	{
	?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="612" valign="top">

      <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="125">
	<div align="center">
	<div id="id_boton1" >
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td onClick="subir_clientes()" style="cursor:pointer" ><img src="images/subir_cliente.png" width="128" height="128" /></td>
        </tr>
      </table>
	</div>  
    </div>	</td>
    <td width="126" onclick="llamar_verificar('../lector_xls/verificar_contactos.php')" style="cursor:pointer"><div align="center" class="Estilo2">VERIFICAR ARCHIVO CLIENTE</div></td>
    <td width="249">
	<div align="center">
	<div id="id_boton2" >
	<table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_facturas()" style="cursor:pointer"  ><img src="images/subir_factura.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>	</td>
    <td width="249" class="Estilo2" onclick="llamar_verificar('../lector_xls/verificar_datos.php')" style="cursor:pointer" ><div align="center">VERIFICAR ARCHIVO FACTURA</div></td>
    <td width="249" rowspan="3" valign="top" class="Estilo2"  >&nbsp;</td>
  </tr>
  <tr>
    <td>
    <div id=div_subirc align="center" class="TableScroll" >&nbsp;</div></td>
    <td>&nbsp;</td>
    <td>
    <div id=div_subirf align="center" class="TableScroll" >&nbsp;</div></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>
	<div align="center">
	<div id="id_boton3" ><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_proveedor()" style="cursor:pointer"  ><img src="images/subir_proveedor.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>	</td>
    <td class="Estilo2" onclick="llamar_verificar('../lector_xls/verificar_proveedor.php')" style="cursor:pointer" ><div align="center">VERIFICAR ARCHIVO PROVEEDOR</div></td>
    <td>
	
		<div align="center">
	<div id="id_boton4" >
	<table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_ncredito()" style="cursor:pointer"  ><img src="images/subir_ncredito.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>	</td>
    <td class="Estilo2" onclick="llamar_verificar('../lector_xls/verificar_ncredito.php')" style="cursor:pointer" ><div align="center">VERIFICAR ARCHIVO NCREDITO</div></td>
    </tr>
  <tr>
    <td><div id=div_subirp align="center" class="TableScroll" >&nbsp;</div></td>
    <td>&nbsp;</td>
    <td><div id=div_subirn align="center" class="TableScroll" >&nbsp;</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</td>
    <td width="288" valign="top"><div id='divBody_verificar' class="TableScroll_d"  >DESPLIEGUE</div></td>
  </tr>
</table>

<?php
}
?>
</div>



