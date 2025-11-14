<style type="text/css">
<!--
.Estilo1 {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.TableScroll {
        z-index:99;
		width:980px;
        height:550px;	
        overflow: auto;
      }
	  
-->
</style>

<script language="javascript">
<!--


function subir_clientes()
{
  $("#id_boton1").html("Procesando....");
  $("#div_subir").load("../lector_xls/lectura_contactos.php",{},function(result){  
     
	 ver_boton1();
	 
  });  
  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");


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
   $("#id_boton2").html("");
   $("#div_subir").load("../lector_xls/lector_datos.php",{

  },function(result){  
     ver_boton2();
  });  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");  

}


//--------------------------------

function subir_ncredito()
{
   $("#id_boton4").html("");
   $("#div_subir").load("../lector_xls/lector_ncredito.php",{

  },function(result){  
     ver_boton4();
  });  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");  

}


//-------------------------------


function subir_proveedor()
{
  $("#id_boton3").html("Procesando....");
  $("#div_subir").load("../lector_xls/lectura_proveedor.php",{},function(result){  
     
	 ver_boton3();
	 
  });  
  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

//-->
</script>



<p>&nbsp;</p>
<div align="center">
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="251">
	<div align="center">
	<div id="id_boton1" >
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td onClick="subir_clientes()" ><img src="images/subir_cliente.png" width="128" height="128" /></td>
        </tr>
      </table>
	</div>  
    </div>
	</td>
    <td width="249">
	<div align="center">
	<div id="id_boton2" >
	<table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_facturas()" ><img src="images/subir_factura.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>
	</td>
  </tr>
  <tr>
    <td>
	<div align="center">
	<div id="id_boton3" >
	<table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_proveedor()" ><img src="images/subir_proveedor.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>
	</td>
    <td >
	
	
	<div align="center">
	<div id="id_boton4" >
	<table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td onclick="subir_ncredito()" ><img src="images/subir_ncredito.png" width="128" height="128" /></td>
      </tr>
    </table>
	</div>
	</div>
	
	
	</td>
  </tr>
</table>
</div>
<div id=div_subir align="center" class="TableScroll" >&nbsp;</div>
