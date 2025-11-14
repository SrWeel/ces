<?php
//retenciones
//$DB_gogesssqt_ret = NewADOConnection('mysql');
//$DB_gogesssql->debug=true;
//$DB_gogesssqt_ret->Connect("localhost", "root", "z0mv0e", "xmlsridb");
//$DB_gogesssqt_ret->Connect("localhost", "root", "", "xmlsridb");

?>
<script type="text/javascript">
<!--

function abrir_standar(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
    var data_divBody=divBody;
	var data_divDialog=divDialog;
	var data_ancho=ancho;
	var data_alto=alto;
    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#"+divBody);
        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"'></div>");
        var xobj = $("#"+data_divDialog);
        xobj.dialog({
            open: function(event, ui) {
                $(".ui-pg-selbox").css({"visibility":"hidden"});
            },
            close: function(event, ui) {
				
                $(".ui-pg-selbox").css({"visibility":"visible"});
                $(this).remove();
									
            },
            resizable: false,
            autoOpen: false,
            width: data_ancho,
            height: data_alto,
            modal: true,
           
        });
        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});
        xobj.dialog( "open" );
        return false;
    }
    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);
}





function desplegar_grid()
{
   $("#grid_retencion").load("aplications/usuario/opciones/grid/grid_retencion.php",{

  },function(result){  

  });  
  $("#grid_retencion").html("Espere un momento...");  

}

function subir_retencion()
{
   $("#boton_retencion").load("../xmlsri/conector_ws/lector_xml.php",{

  },function(result){  
 activar_boton()
  });  
  $("#boton_retencion").html("Espere un momento...");  

}

function activar_boton()
{
   $("#boton_retencion").html('<div align="center"><input type="submit" name="Submit" value="Subir Retencion"  onclick="subir_retencion()"></div>');
   
   desplegar_grid();

}

function enviar_comprobante(idtipo)
{

  $("#div_enviomasivo").load("envio_masivo/envio_retenciones.php",{},function(result){  
     
  });  
  $("#div_enviomasivo").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}



function subir_espera()
{
   $("#div_espera").load("../xmlsri/conector_ws/lector_xmlp.php",{

  },function(result){  
desplegar_grid();
  });  
  $("#div_espera").html("Espere un momento...");  

}
function ver_sri1(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{

  $("#"+divBody).load(urlpantalla,{pVar1:variable1},function(result){  
     
  });  
  $("#"+divBody).html("<img src='images/barra_carga.gif' width='220' height='40' />");


}
//  End -->
</script>

<p>&nbsp;</p>
<div align="center">
  <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top"><div id=boton_retencion >
            <div align="center">
			<?php
	if($_SESSION['usua_admx']==1)
	{
	?>
              <input type="button" name="Submit2" value="Subir Retencion" onClick="subir_retencion()">
			  
			  
<?php
}
?>
            </div>
        </div></td>
        <td  valign="top">&nbsp;</td>
        <td  valign="top"><input type="button" name="Submit2" value="Autorizar documentos en espera" onClick="subir_espera()">&nbsp;&nbsp;&nbsp;
		 <?php
			  if($_SESSION['usua_enviomasivox']=='1')
			  {
			  ?>
          <input type="button" name="Submit" value="Envio Masivo" onclick="enviar_comprobante(0)" />
		  
		   <?php
			  }
			  ?>
		  </td>
        <td  valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"  valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"  valign="top"><div id=grid_retencion > </div></td>
      </tr>
    </table></td>
    <td valign="top">
	
	  <div align="center"></div>
	
	<div id=div_enviomasivo >&nbsp;</div>
	<div id=div_espera >&nbsp;</div>
	
	</td>
  </tr>
</table>
</div>

<script type="text/javascript">
<!--

desplegar_grid();

//  End -->
</script>