
<script type="text/javascript">
<!--

function busca_empresa()
{
    $("#div_listaempresa").load("aplications/usuario/opciones/extras/lista_empresa.php",{
    pruc_valor:$('#ruc_valor').val(),
	pusuario_valor:$('#usuario_valor').val()
  },function(result){  
      
  });  
  $("#div_listaempresa").html("Espere un momento...");  

}

function busca_caja()
{
    $("#div_listacaja").load("aplications/usuario/opciones/extras/lista_punto.php",{
    pruc_valor:$('#ruc_valor').val(),
	pusuario_valor:$('#usuario_valor').val(),
	pestab_id:$('#estab_id').val()
  },function(result){  
      
  });  
  $("#div_listacaja").html("Espere un momento...");  

}

function busca_establecimiento()
{
    $("#div_listaestablecimiento").load("aplications/usuario/opciones/extras/lista_establecimiento.php",{
    pruc_valor:$('#ruc_valor').val(),
	pusuario_valor:$('#usuario_valor').val(),
	emp_id:$('#emp_id').val()
  },function(result){  
      
  });  
  $("#div_listaestablecimiento").html("Espere un momento...");  

}

///-------------------------------------------

function activar_formulario()
{
    $("#divBody_ingreso").load("aplications/usuario/form_ing.php",{
	pusuario_valor:$('#usuario_valor').val()
  },function(result){  
      
  });  
  $("#divBody_ingreso").html("Espere un momento...");  

}

///-------------------------------------------

function valida_usuario()
{
   if($('#id_caja').val()==0)
   {
      alert("Seleccione una caja para ingresar al sistema...");
	  return false;
   }

    $("#div_validausuario").load("aplications/usuario/opciones/extras/lista_usuario.php",{
    pruc_valor:$('#ruc_valor').val(),
	pusuario_valor:$('#usuario_valor').val(),
	pclave_valor:$('#clave_valor').val()
  },function(result){  
      
	  
	  
  });  
  $("#div_validausuario").html("Espere un momento...");  

}

function abrir_pantalla_ingreso(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
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

//  End -->
</script>

<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table border="0" cellpadding="0" cellspacing="0">

  <tr>
  <td >
  <div id=divBody_ingreso ></div>
  
  
  </td>
    <td><div align="center">
<p>&nbsp;</p>
<div id=acceso_usuario >&nbsp;</div>
<p>&nbsp;</p>
<div id=acceso_otc ></div>
<div id=acceso_otc_validado style="color:#FFFFFF"></div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php echo $botonrecuperarclave ?><?php //echo $logosistema; ?><?php echo $botonregistro ?></div>


<script type="text/javascript">
<!--
activar_formulario();
//  End -->
</script>