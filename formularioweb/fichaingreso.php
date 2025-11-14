<?php

ini_set('display_errors',0);

error_reporting(E_ALL);

ini_set("session.cookie_lifetime","4600000");

ini_set("session.gc_maxlifetime","4600000");

session_start();

$director="../director/";

include ("../director/cfgclases/clases.php");

  

@$_SESSION['formularioweb_ac']=0;



@$token_val=explode("|",base64_decode($_GET["token"]));

$id_cli=$token_val[0];

?>

<!DOCTYPE html>

<html translate="no" >

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR- FORMULARIO DE REGISTRO - AGENDAMIENTO VIA WEB</title>

	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">

	<link rel="stylesheet" href="_assets/css/jqm-demos.css">

	

<link rel="apple-touch-icon" sizes="57x57" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="60x60" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="72x72" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="76x76" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="114x114" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="120x120" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="144x144" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="152x152" href="images/favicon2-100x100.png">

<link rel="apple-touch-icon" sizes="180x180" href="images/favicon2-100x100.png">

<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon2-100x100.png">

<link rel="icon" type="image/png" sizes="32x32" href="images/favicon2-100x100.png">

<link rel="icon" type="image/png" sizes="96x96" href="images/favicon2-100x100.png">

<link rel="icon" type="image/png" sizes="16x16" href="images/favicon2-100x100.png">

<link rel="manifest" href="favicon/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="images/favicon2-100x100.png">

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



.ui-overlay-a, .ui-page-theme-a, .ui-page-theme-a .ui-panel-wrapper {

    background-color: #ffffff;

    border-color: #bbb;

    color: #333;

    text-shadow: 0 1px 0 #f3f3f3;

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

		<h1>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR - AGENDAMIENTO DE CITAS M&Eacute;DICAS</h1>

		<a href="./fichaingreso.php" data-icon="home" data-role="button" rel="external" data-iconpos="notext">Home</a>

		<a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power" onClick="salir_sistema()" >Salir</a>

	</div><!-- /header -->



<div role="main" class="ui-content">

	

<div id="divBody_lista">

<?php

//busca banner

$lista_banner="select * from app_bannerweb where bann_activo=1 and tipb_id=3 order by bann_id desc";

$rs_banner = $DB_gogess->Execute($lista_banner);	



if($rs_banner->fields["bann_banner"]!='')

{
echo $lista_banner;
?>

<center>

	<div class="banner">	

	<img src="../archivo/<?php echo $rs_banner->fields["bann_banner"]; ?>" alt="Responsive image"> 

	</div>

</center> 

<?php 

}

else

{

?>

<table width="100%">
    <tr>
        <td align="left"><img  id="u3700" src="images/logohome2.png?crc=<?php echo date("YmdHis"); ?>" alt=""  ></td>
        <!-- <td align="right"><img src="images/logo_logi_pref.png?crc=<?php echo date("YmdHis"); ?>" alt=""  ></td> -->
    </tr>
</table>

<?php

}

?>





</div>



<center>

<?php

$fecha_hoy=date("Y-m-d");

//echo "<b>".$fecha_hoy."</b>";

?>

</center>

<div id="div_nivel" >



</div>

<div id="div_login" ></div>



<div id="div_bienvenida"  >



    <center><b><div style="font-size:17px" >AGENDAMIENTO DE CITAS M&Eacute;DICAS</div></b></center>
	
	 <center><b><div style="font-size:16px" >IMPORTANTE: Recuerde acudir 10 minutos antes de su cita ya que el tiempo m&aacute;ximo de espera es 5 minutos</div></b></center>

<div id="formulario_id" data-id-cli="<?php echo $id_cli; ?>"> 

    

<br><br>

<?php
/*$query = <<<QUERY
    SELECT prof_id, prof_nombre
    FROM cesdb_arextension.dns_profesion
    WHERE prof_id in (select prof.prof_id from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where prof.prof_id not in (3,34,29,911127,911119,63,911120,65,66,911114,38,777,888,911116,77))  order by prof_nombre asc
QUERY;*/

$query = <<<QUERY
    select prof_id, prof_nombre from cesdb_arextension.dns_profesion where prof_nosalir=0 and  (prof_especialidad=1 or prof_especialidadconcodigo=1) and prof_id not in(911116) order by prof_nombre asc 
QUERY;

$rsEspecialidades = $DB_gogess->Execute($query);

?>


<div align="center">

    <div class="form-group">
        <div class="col-xs-12">

          <select name="centro_id" id="centro_id" class="form-control" onChange="list_servicio()"  >
            <option value="" selected>Seleccione el Centro</option>
                <?php
		  $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre","","where centro_permiteagendamiento=1 order by centro_nombre asc ",$DB_gogess);		
		 //$objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre","","where centro_id=1 order by centro_nombre asc ",$DB_gogess); 
		   ?>
         </select>
		 <br />
          </div>
    </div> 

    <div class="form-group">
        <div class="col-xs-12">
		  <div id="servicios_lista">
            <select id="clie_centromedico" class="form-control"  >
                <option value="" selected="selected">Seleccione el Servicio</option><?php
                while(!$rsEspecialidades->EOF){
                    echo <<<RES
                        <option value="{$rsEspecialidades->fields["prof_id"]}">{$rsEspecialidades->fields["prof_nombre"]}</option>
                    RES;
                    $rsEspecialidades->MoveNext();
                }?>
            </select>
			</div>
        </div>
    </div>   
	<p>&nbsp;</p> 
    <div class="">
        <button class="btn btn-primary" style="width: 12em;" onClick="selectCentroXesp()">Siguiente</button>
    </div>
    
<!--
  <br><br>

  

  <div class="form-group">

         <div class="col-xs-12">

  <button class="ui-btn" onClick="ver_formulario()" style="background-color:#002C46; color:#FFFFFF;font-size:13px; width:300px">LLENAR FICHA</button>

         </div>

  </div>
-->
  

  

</div>

<br><br>

    

    

</div>



</div>

<script type="text/javascript">

<!--

function list_servicio()
{

$("#servicios_lista").load("cmb_servicios.php",{

centro_id:$('#centro_id').val()

 },function(result){ 
			 

  });  

  $("#servicios_lista").html("Espere un momento...");

}


function selectCentroXesp(){
    let esp = $("#clie_centromedico").val();
	
	if($('#centro_id').val()=='')
	{
	    alert("Por favor, seleccione el Centro");
        return;
	}
	
    if(esp==""){
        alert("Por favor, seleccione la especialidad");
        return;
    }
    //$("#formulario_id").load("./showCalendarAg.php?esp=" + esp);
	
	
	$("#formulario_id").load("./showCalendarAg.php",{
    
	 centro_id:$('#centro_id').val(),
	 esp:esp	
	
	 },function(result){ 
				 
	
	});  
	
	
	
}

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

    <td><a href="https://www.facebook.com/pichinchahumana/" target="_blank"><img src="images/facebook.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>

    <td><a href="https://www.instagram.com/pichinchahumana/" target="_blank"><img src="images/instagram.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
	
	<td><a href="https://api.whatsapp.com/send?phone=593984558633&text=Por%20favor%20necesito%20agendar%20una%20cita%20en%20Pichincha%20Humana" target="_blank"><img src="images/whatsapp.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
	<!--<td><a href="https://calendly.com/demrodriguez79/30min?back=1&month=2022-03" target="_blank"><img src="images/calendario.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>-->


  </tr>

</table>

</center>

</div><!-- /content -->	

</div><!-- /page one -->







<script type="text/javascript">

<!--



function ver_formulario()

{

   if($('#clie_tpedad').val()==0)

   {

       alert("Por favor seleccione si es Adulto o menor de Edad");

       return false;

       

   }

   

   $("#formulario_id").load("formulario/datos_discipulado2.php",{

   valor_clie: document.querySelector("#formulario_id").getAttribute("data-id-cli"),

   clie_tpedad:$('#clie_tpedad').val()

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



//ver_formulario();



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

