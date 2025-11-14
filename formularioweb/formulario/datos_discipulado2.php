<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=544000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
//echo $_POST["pVar1"];
//bloqeuar despues de un tiempo

if(@$_POST["valor_clie"]>0)
{
  $_POST["pVar1"]=$_POST["valor_clie"];
}
//Llamando objetos
$table='app_cliente';  

$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");





//leer con json

$lista_tbldata=array('gogess_sisfield','gogess_sistable');

$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");

$gogess_sistable = json_decode($contenido, true);

$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");

$gogess_sisfield = json_decode($contenido, true);

//leer con json 



$objformulario= new  ValidacionesFormulario();

$objtableform= new templateform();

 if ($table)

  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

  

  

$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;

$comillasimple="'";

 //"Fg:".@$_POST["clie_tpedad"];
 $_POST["clie_tpedad"]=2;
//para cambiar el formato de algunos campos

if($_POST["clie_tpedad"]==2)
{

$campos_tipo=Array
(

	'clie_token'=>'hidden3',
	'clie_seguroprivadoarchivo'=>'hidden3',
	'usua_id'=>'hidden3',
	'clie_seguromsparchivo'=>'hidden3',
	'clie_etiquetadatosseguro'=>'hidden3',
	'clie_titularseguro'=>'hidden3',
	'tippo_id'=>'hidden3',
	'conve_id'=>'hidden3',		

);

}





if($_POST["clie_tpedad"]==1)

{

$campos_tipo=Array

(

    'dat_id '=> 'hidden3',

	'clie_etiqueta1'=>'hidden3',
	'clie_etiquetadatosseguro'=> 'hidden3',

	'clie_mama'=>'hidden3',

	'clie_papa'=>'hidden3',

	'clie_representante'=>'hidden3',

	'clie_celularpapa'=>'hidden3',

	'clie_celularmama'=>'hidden3',

	'clie_etiqueta2'=>'hidden3',

	'clie_registrado'=>'hidden3',

	'clie_token'=>'hidden3',

	'clie_historiaanterior'=>'hidden3',

	'tipopac_id'=>'hidden3',

	'usuar_id'=>'hidden3',

	'usua_id'=>'hidden3',

	'centro_id'=>'hidden3',

	'clie_registro'=>'hidden3',

	'clie_emergenciatelf'=>'hidden3',

	'clie_telefono'=>'hidden3',

	'repr_parentesco'=>'hidden3',

	'repr_llamar'=>'hidden3',

	'repr1_parentesco'=>'hidden3',

	'repr1_llamar'=>'hidden3',

	'clie_fechaingreso'=>'hidden3',

	'tipoci_id'=>'selectpekecorto',

	'clie_rucci'=>'textpekecorto',

	'clie_apellido'=>'textpekecorto',

	'clie_nombre'=>'textpekecorto',

	'clie_genero'=>'selectpekecorto',

	'clie_fechanacimiento'=>'fechabloqueopekeedadcorto',

	'clie_instruccion'=>'textpekecorto',

	'clie_institucion'=>'hidden3',

	'clie_ocupacion'=>'textpekecorto',

	'clie_direccion'=>'textpekecorto',

	'clie_encadodeemergencia'=>'textpekecorto',

	'clie_celular'=>'textpekecorto',

	'clie_email'=>'textpekecorto',

	'repr_tipdoc'=>'selectpekecorto',

	'repr_ci'=>'textpekecorto',

	'repr_nombre'=>'textpekecorto',

	'repr_profesion'=>'textpekecorto',

	'repr_ocupacion'=>'textpekecorto',

	'repr_telftrabajo'=>'textpekecorto',

	'repr_celular'=>'textpekecorto',

	'repr_nhijos'=>'textpekecorto',

	'repr1_tipdoc'=>'selectpekecorto',

	'repr1_ci'=>'textpekecorto',

	'repr1_nombre'=>'textpekecorto',

	'repr1_profesion'=>'textpekecorto',

	'repr1_ocupacion'=>'textpekecorto',

	'repr1_telftrabajo'=>'textpekecorto',

	'repr1_celular'=>'textpekecorto',

	'repr1_nhijos'=>'textpekecorto',

	'clie_foto'=>'txtgraficocorto',

	'repr2_tipdoc'=>'selectpekecorto',

	'repr2_ci'=>'textpekecorto',

	'repr2_nombre'=>'textpekecorto',

	'repr2_direccion'=>'textpekecorto',

	'repr2_telftrabajo'=>'textpekecorto',

	'repr2_celular'=>'textpekecorto',

	'repr2_llamar'=>'hidden3',
	'clie_seguromsparchivo'=>'hidden3',

	

	

	

		

);

}



//para cambiar el formato de algunos campos





     

	

	$em_id_val=0;	

		



	$variableb=0;

			if($_POST["pVar1"]=='undefined')

				  {

					 $variableb=0;

				  }

				  else

				  {

					 $variableb=$_POST["pVar1"];

					 $_REQUEST["opcion_".$table]="buscar";

			         $csearch=$_POST["pVar1"];				 

				  }

		 

		 $comillasimple="'";

		 $botonenvio='<br><br>



<div align="center">

		 <div class="form-group">

         <div class="col-xs-12">

		   

			<button type="button" class="mb-sm btn btn-primary"  onclick="ver_sinino('.$comillasimple.'form_'.$table.$comillasimple.')" >ENVIAR</button>

		

		</div>

		</div>

</div>





';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
@$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";



$funcionextrag="
 
 pedirAgendardos(result_insertado);
 genera_padremadre();	    

";

  		$template_reemplazo='templateformsweb/maestro_standar_ficha2/';

?>	

<style>

label.error{

color:red;

font-family:Verdana, Arial, Helvetica, sans-serif;

font-style:italic;

font-size:11px;

}

div.error{

display:none;

}

input{

}

input.checkbox{

border:none

}

input:focus{

border:1px dotted black;

}

input.error{

border:1px dotted red;

}

body{ 

font-size:11px;



}

</style> 

<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}



.ui-mobile label, div.ui-controlgroup-label {

    font-weight: 400;

    font-size: 11px;

}



.form-control {

    display: block;

    width: 100%;

    height: 25px;

    padding: 3px 6px;

    font-size: 11px;

    line-height: 0.7;

    color: #555;

    background-color: #fff;

    background-image: none;

    border: 1px solid #ccc;

    border-radius: 4px;

}

.form-group {

    margin-bottom: 3px;

}



.ui-overlay-a, .ui-page-theme-a, .ui-page-theme-a .ui-panel-wrapper {

    background-color: #ffffff;

    border-color: #bbb;

    color: #333;

    text-shadow: 0 1px 0 #f3f3f3;

}

-->

</style>



<script type="text/javascript">

<!--



function ver_sinino(table)

{

  <?php

  if($_POST["clie_tpedad"]==2)

  {

  ?>

   if($('#repr_ci').val()=='' &&  $('#repr1_ci').val()=='')

  {

      alert("Porfavor ingrese los datos del padre o madre"); 

      return false;

      

  }

  

  if($('#repr_ci').val()!='')

  {

       

       if($('#repr_tipdoc').val()=='')

       {

           alert("Ingrese el Tipo Documento");

           return false;

           

       }

       if($('#repr_nombre').val()=='')

       {

           alert("Ingrese el Nombre");

           return false;

           

       }

       if($('#repr_profesion').val()=='')

       {

           alert("Ingrese Profesion");

           return false;

           

       }

       

       if($('#repr_ocupacion').val()=='')

       {

           alert("Ingrese Ocupacion");

           return false;

           

       }

       

       if($('#repr_celular').val()=='')

       {

           alert("Ingrese Celular");

           return false;

           

       }

  }

  

  

  if($('#repr1_ci').val()!='')

  {

       

       if($('#repr1_tipdoc').val()=='')

       {

           alert("Ingrese el Tipo Documento");

           return false;

           

       }

       if($('#repr1_nombre').val()=='')

       {

           alert("Ingrese el Nombre");

           return false;

           

       }

       if($('#repr1_profesion').val()=='')

       {

           alert("Ingrese Profesion");

           return false;

           

       }

       

       if($('#repr1_ocupacion').val()=='')

       {

           alert("Ingrese Ocupacion");

           return false;

           

       }

       

       if($('#repr1_celular').val()=='')

       {

           alert("Ingrese Celular");

           return false;

           

       }

  }

  

  <?php

  }

  ?>

  //if($('#cuenta_nino').val()>0)

  //{

  

    $( "#"+table ).submit();

  

 // }

 // else

  //{

  //  alert("Debe registrar al menos un ni\u00f1o en la lista. De clic en agregar para que se agregen a la lista...");

 // }

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



      desplegar_grid();



	  desaparecer_borrar();



  });  



  $("#grid_borrar").html("Espere un momento...");  



  



  



  }







}









function activar_tablas()

{



   var sumador1;

   var sumador2;

   var sumador3;

   var total;

   

   sumador1=0;

   sumador2=0;

   sumador3=0;

   total=0;

   

   if($("#clie_binaabc1").is(':checked'))

   {

    sumador1=1;

   

   }

   

   

   

    if($("#clie_binaabc2").is(':checked'))

	  {

    sumador2=1;

   

   }



	

  if($("#clie_binaabc3").is(':checked'))

  {

    sumador3=1;

   

   }

 

	total= sumador1+sumador2+sumador3;

   

    if(total>0)

	{

	  $('#vista_panelx').show();

	

	}

	else

	{

	  $('#vista_panelx').hide();

	

	}

}



//  End -->

</script>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<div id="gracias_id">

<?php

if($_POST["clie_tpedad"]==1)

{

    echo '<center><b><div style="font-size:17px">ADULTO</div></b></center>'; 

}

else

{

    

   echo '<center><b><div style="font-size:17px">MENOR DE EDAD</div></b></center>';  

}

?>







<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

$path_ext='../';		

include("tablas.php");

		

?>	



</form>



</div>

</div>



<script type="text/javascript">

<!--

$( "#clie_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});



//activar_tablas();

function gracias()

{

 $('#gracias_id').html("<center><br><br><b><img src='mano-ok.png' width='150' height='144' border='0'><br>REGISTRO REALIZADO CON EXITO</b></center>");

}



function genera_padremadre()

{

    

    

  $("#divBody_listaparents").load("aplicativos/modulos_standar/standar_lista.php",{



  clie_rucci:$('#clie_rucci').val()



  },function(result){  



     gracias();	



  });  



  $("#divBody_listaparents").html("Espere un momento"); 

    

}



function envia_email(formu_id,mensaje)

{

   //alert($('#clie_megustaria3').is(':checked'));

   

   if($('#clie_megustaria3').is(':checked')==true)

   {

    

    idinsertado=$('#clie_id').val();

	

	$("#divBody_envioemail").load("aplicativos/modulos_standar/standar_envio_pastor.php",{



	idinsertado:idinsertado,

	formu_id:formu_id



  },function(result){  



      // $('#formulario_standar').html(mensaje);	



  });  



  $("#divBody_envioemail").html("Espere un momento"); 

  

  

  }



}


function pedirAgendardos(result_insertado){
        $("#formulario_id").load("formulario/agendar.php",{
         clie_tpedad:'<?php echo $_POST["clie_tpedad"] ?>',
         pDate:'<?php echo $_POST["pDate"] ?>',
         pHour:'<?php echo $_POST["pHour"] ?>',
         pCentroID:'<?php echo $_POST["pCentroID"] ?>',
         pProfID:'<?php echo $_POST["pProfID"] ?>',
         pEspID:'<?php echo $_POST["pEspID"] ?>',
         pClieID:result_insertado,
         cedulaPaciente:'<?php echo $_POST["cedulaPaciente"] ?>'
       },function(result){
           
       });
    }

<?php
if($_POST["cedulaPaciente"]!='')
{
  echo "$('#clie_rucci').val('".$_POST["cedulaPaciente"]."');";
}
?>

//  End -->
</script>


<div id="divBody_envioemail" ></div>

<div id="divBody_listaparents"></div>