<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","4600000");
ini_set("session.gc_maxlifetime","4600000");
session_start();
$director="../adm_alianzanorte/";
include ("../adm_alianzanorte/cfgclases/clases.php");
  
@$_SESSION['formularioweb_ac']=0;


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IGLESIA ALIANZA NORTE</title>
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="_assets/css/jqm-demos.css">
	
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
	
	
	
	<link type="text/css" href="css/jquery.dataTables.min.css" rel="stylesheet" />	
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.css">
	
	
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	<script src="js/ui.datepicker-es.js"></script>
	<script src="js/ui.mask.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script> 
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	
	 <style>
	.ui-mobile label, div.ui-controlgroup-label {
      font-weight: 400;
      font-size: 13px;
    }
	
	.banner {
  width: 100%;
  height: 20%;
}


.banner img {
  height : 100%;
  width: 100%;
}
	
	 </style>
</head>

<script type="text/javascript">
<!--
function desaparecer_borrar()
{

    

	setTimeout(function () { $('#grid_borrar').fadeOut(); }, 2000);

  

}



function borrar_registro(tabla,campo,valor)

{

     

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar").load("grid/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

     
	  abrir_standar('grid/grid_asistencia.php','divBody_lista',0,0,0,0,0,0,0);

	  desaparecer_borrar();

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}



   $(".messages").hide();

    //queremos que esta variable sea global

    var fileExtension = "";

    //función que observa los cambios del campo file y obtiene información

function informacion_archivo(campo)

{



       //obtenemos un array con los datos del archivo

        var file = $("#"+campo+"imagen")[0].files[0];

        //obtenemos el nombre del archivo

        var fileName = file.name;

        //obtenemos la extensión del archivo

        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

        //obtenemos el tamaño del archivo

        var fileSize = file.size;

        //obtenemos el tipo de archivo image/png ejemplo

        var fileType = file.type;

        //mensaje con la información del archivo

		var megas=0;

		megas=eval(fileSize)/1048576;

		

        showMessage("<span class='info"+campo+"' style='padding: 10px; border-radius: 10px; background: orange; color: #fff;font-family:Verdana, Arial, Helvetica, sans-serif;text-align: center;font-size:11px;' >Peso: "+megas.toFixed(4)+" MB.</span>",campo);



}



function subir_archivo(ncampo,table,anchot,altot,anchoor,altoor)

{

   if(isImage(fileExtension))
     {

     var formData = new FormData($("#form_"+table)[0]);

	 formData.append("ncampo",ncampo);
	 formData.append("anchot",anchot);
     formData.append("altot",altot);
	 formData.append("anchoor",anchoor);
     formData.append("altoor",altoor);

	 var nombre_campo=ncampo;

        var message = ""; 

        //hacemos la petición ajax  

		

        $.ajax({

            url: '../libreria/archivo/upload.php',  

            type: 'post',

            // Form data

            //datos del formulario

            data: formData,

            //necesario para subir archivos via ajax

            cache: false,

            contentType: false,

            processData: false,

            //mientras enviamos el archivo

            beforeSend: function(){

			

                message = $("<span class='before' >Subiendo imagen, por favor espere</span>");

                showMessage(message,nombre_campo)        

            },

            //una vez finalizado correctamente

            success: function(data){

			if(data.trim()!='')

					{

                message = $("<span class='success' >Imagen ha subido correctamente.</span>");

				}

else

{

 message = $("<span class='success' >Por favor seleccione un archivo.</span>");

}

                showMessage(message,nombre_campo);

                if(isImage(fileExtension))

                {

                    

					if(data.trim()!='')

					{

					$(".showImage"+ncampo).html("&nbsp;<a href='../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../archivo/"+data+"' alt='125x125' width='180px' ></a>");
					

					}

                }

				else

				{

				  if(data.trim()!='')

					{

				   $(".showImage"+ncampo).html("&nbsp;<a href='../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../archivo/"+data+"' alt='125x125' width='180px' ></a>");

				   }

				

				}

				$('#'+nombre_campo).val(data);

            },

            //si ha ocurrido un error

            error: function(){

                message = $("<span class='error' >Ha ocurrido un error. Seleccione el archivo</span>");

                showMessage(message,nombre_campo);

            }

        });

   

   
 }
   else
   {
   
    alert("Archivo no permitido solo (jpg,png,gif)");
   }
   



}







//como la utilizamos demasiadas veces, creamos una función para 

//evitar repetición de código

function showMessage(message,campo){

    $(".messages"+campo).html("").show();

    $(".messages"+campo).html(message);

}

 

//comprobamos si el archivo a subir es una imagen

//para visualizarla una vez haya subido

function isImage(extension)

{

    switch(extension.toLowerCase()) 

    {

        case 'jpg': case 'gif': case 'png': case 'jpeg':

            return true;

        break;

        default:

            return false;

        break;

    }

}







function refreshFrame(nframe,path){

    $('#'+nframe).attr('src', path);

}

//  End -->

</script>



<script type="text/javascript">
<!--



function salir_sistema()
{

$("#div_login").load("acceso/salir.php",{

 },function(result){  

      

  });  

  $("#div_login").html("Espere un momento...");  


}




function abrir_standar(urlpantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{

$("#"+divBody).load(urlpantalla,{
      pVar1:variable1,
	  pVar2:variable2,
	  pVar3:variable3,
	  pVar4:variable4,
	  pVar5:variable5,
	  pVar6:variable6,
	  pVar7:variable7

  },function(result){  


  });  
  $("#"+divBody).html("Espere un momento...");


}
    
	

function ver_formularioenpantalla(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{
    $("#"+divBody).load(urlpantalla,{
	pVar1:variable1,
	pVar2:variable2,
	pVar3:variable3,
	pVar4:variable4,
	pVar5:variable5,
	pVar6:variable6,
	pVar7:variable7
  },function(result){  
      
  });  
  $("#"+divBody).html("Espere un momento...");  

}
//  End -->
</script>


<body>

<!-- Start of first page: #one -->
<div data-role="page" id="home">

	<div data-role="header" data-position="inline">
		<h1>IGLESIA ALIANZA NORTE</h1>
		<a href="./" data-icon="home" data-role="button" rel="external" data-iconpos="notext">Home</a>
		<a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power" onClick="salir_sistema()" >Salir</a>
	</div><!-- /header -->

<div role="main" class="ui-content">
	
<div id="divBody_lista">
<?php
//busca banner
$lista_banner="select * from app_banner where bann_activo=1 order by bann_id desc";
$rs_banner = $DB_gogess->Execute($lista_banner);	

if($rs_banner->fields["bann_banner"]!='')
{
?>
<center>
	<div class="banner">	
	<img src="../archivo/bannerninos.jpg" alt="Responsive image">
	</div>
</center>
<?php
}
?>


</div>

<center>
<?php
$fecha_hoy=date("Y-m-d");
echo "<b>".$fecha_hoy."</b>";
?>
</center>
<div id="div_nivel" >

</div>
<div id="div_login" ></div>

<div id="div_bienvenida">

<center><b>DATOS DE LOS NIÑOS DE LA IGLESIA ALIANZA NORTE</b></center>
<div id="formulario_id"></div>

</div>
<script type="text/javascript">
<!--
$( "#us_fechanac" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  minDate: new Date(1900, 1 - 1, 1),
	  yearRange: '1900:2050',
      dateFormat: 'yy-mm-dd'
});

$("#us_fechanac").mask({mask: "####-##-##"});

//  End -->
</script>

<div id="div_ingreso" ></div>
<center>
<br><br>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="https://www.facebook.com/IglesiaAlianzaNorte" target="_blank"><img src="images/facebook.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
    <td><a href="https://www.instagram.com/iglesia_alianzanorte" target="_blank"><img src="images/instagram.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
    <td><a href="https://www.youtube.com/c/IglesiaAlianzaNorte" target="_blank"><img src="images/youtube.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
  </tr>
</table>
</center>
</div><!-- /content -->	
</div><!-- /page one -->



<script type="text/javascript">
<!--

function ver_formulario()
{
   
   $("#formulario_id").load("formulario/datos_nino.php",{

  },function(result){  

  });  

  $("#formulario_id").html("<center><img src='carga.gif' width='300' height='250'></center>"); 


}




function bievenida()
{

  $("#div_bienvenida").load("bienvenida.php",{
   usuario_val:$('#usuario_val').val(),
   clave_val:$('#clave_val').val()
  },function(result){  


  });  

  $("#div_bienvenida").html("Espere un momento...");  
  
  
}

ver_formulario();

//  End -->
</script>

<script type="text/javascript">
<!--
$( "#fecha_valor" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#tare_fechafin" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>
<div id="grid_borrar"></div>

</body>
</html>
