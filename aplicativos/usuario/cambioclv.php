<script type="text/javascript">
<!--

function funcion_cerrar_pop(valor_pop)
{
$('#'+valor_pop).dialog( "close" );
}

function llamar_extras(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#divBody_ext");
        xobjPadre.append("<div id='divDialog_extra'  title='"+titulopantalla+"'></div>");
        var xobj = $("#divDialog_extra");

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
            width: 590,
            height: 330,
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
<div id=divBody_ext ></div>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000" ><?php echo $objcontrolclv->mensaje_clave; ?></p>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td onclick="llamar_extras('aplications/usuario/datos_clave.php','Clave','<?php echo $_SESSION['ces1313777_sessid_inicio'] ?>',0,0,0,0,0,0)" style="cursor:pointer"  ><img src="images/cambiarclave.png" width="166" height="45"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
