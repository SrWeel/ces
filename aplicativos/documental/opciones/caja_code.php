<?php

//ini_set('display_errors',1);

//error_reporting(E_ALL);

ini_set("session.gc_maxlifetime","14400");

session_start();



$subindice="_registrocaja";

?>



<script type="text/javascript">

<!--

function desplegar_grid()
{

   $("#grid<?php echo $subindice; ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice; ?>.php",{

    fecha_b:$('#fecha_b').val()

  },function(result){  



  });  

  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  



}

function cerrar_caja()
{
	$("#grid<?php echo $subindice; ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice; ?>.php",{

    fecha_b:$('#fecha_b').val(),
	opcion_b:'1'

  },function(result){  



  });  

  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  
	
}

function ver_cajaclv()
{

   $("#ver_caja").load("aplications/usuario/opciones/grid/aplica_clv.php",{

us_caja:$('#us_caja').val(),
us_clave:$('#us_clave').val(),

  },function(result){  



  });  

  $("#ver_caja").html("Espere un momento..."); 


}



function desplegar_grid_buscar()

{

   $("#grid<?php echo $subindice; ?>").load("aplications/usuario/opciones/grid/grid<?php echo $subindice; ?>.php",{



  },function(result){  



  });  

  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  



}



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

function abrir_standar_scaja(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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
                $('#ver_caja').html('');
									

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






function abrir_standar_sinmodal(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

            modal: false,

           

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}



function borrar_registro(tabla,campo,valor)

{

     

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar").load("aplications/usuario/opciones/grid/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

      desplegar_grid();

	  desaparecer_borrar();

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}







//  End -->

</script>



<style type="text/css">

.css_titulo {

	font-family: Verdana, Geneva, sans-serif;

	font-size: 11px;

	font-weight: bold;

}

.resultados {

	font-family: Verdana, Geneva, sans-serif;

	font-size: 13px;

    font-weight: normal;

}

.css_tituloben {

	font-size: 11px;

	font-family: Verdana, Geneva, sans-serif;

	font-weight: bold;

}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; }
</style>



<?php

$linkeditar= 'onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Nuevo","divBody'.$subindice.'","divDialog'.$subindice.'",600,450,0,0,0,0,0,0,0) style=cursor:pointer';

?>

<?php

//echo "Prueba:".$_SESSION['ces1313777_sessid_idempresa'];

?>

<p>&nbsp;</p>

<div align="center">

<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td bgcolor="#E8EFF0" class="css_tituloben">Crear registro</td>

    <td rowspan="4" valign="top">
    <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Fecha: </td>
    <td><input type="text" name="fecha_b" id="fecha_b" /></td>
    <td><input type="button" name="button" id="button" value="Buscar" onclick="desplegar_grid()" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

    
    <div id=grid<?php echo $subindice; ?> ></div>
  <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>CERRA CAJA </td>
    <td></td>
    <td><input type="button" name="button" id="button" value="CERRAR" onclick="cerrar_caja()" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>  
    
    
    
    </td>

  </tr>
  
  <?php
$usr_caja=$objformulario->replace_cmb("factur_usuarios","id_usuario,usr_caja","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
if($usr_caja==1)
{

  ?>
   <tr>

    <td align="center" <?php echo $linkeditar; ?> ><div id=div_cerrado ><img src="images/opciones/nuevo_registro.png" width="128" height="128" /></div></td>

  </tr>
<?php
}
else
{
?> 
  
  <tr>

    <td align="center" >
	
	
	  <table width="200" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"><div align="center"><strong>ACCESO CAJA </strong></div></td>
          </tr>
        <tr>
          <td><span class="Estilo5">USUARIO:</span></td>
          <td><input name="us_caja" type="text" id="us_caja"></td>
        </tr>
        <tr>
          <td><span class="Estilo5">CLAVE:</span></td>
          <td><input name="us_clave" type="text" id="us_clave"></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            <input type="button" name="Submit" value="Ingresar" onClick="ver_cajaclv()" >
          </div></td>
          </tr>
      </table>
	</td>

  </tr>

  <tr>

    <td align="center" ><div id=ver_caja ></div></td>

  </tr>

<?php
}
?>
  <tr>

    <td bgcolor="#E8EFF0" class="resultados"><span class="css_tituloben">Buscar Registro</span></td>

  </tr>

  

</table>



</div>



<div id=divBody<?php echo $subindice ?> ></div>

<div id="grid_borrar" ></div>

<script type="text/javascript">

<!--

desplegar_grid();


$( "#fecha_b" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->

</script>



