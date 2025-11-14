<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//echo $_POST["pVar1"];
//Llamando objetos
$table='fnino_dato';  
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

//para cambiar el formato de algunos campos
$campos_tipo=Array
(
    'dat_id '=> 'hidden3'
		
);
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
 gracias();	    
";
  		$template_reemplazo='templateformsweb/maestro_standar_nino/';
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
-->
</style>

<script type="text/javascript">
<!--

function ver_sinino(table)
{
  if($('#cuenta_nino').val()>0)
  {
  $( "#"+table ).submit();
  }
  else
  {
    alert("Debe registrar al menos un ni\u00f1o en la lista. De clic en agregar para que se agregen a la lista...");
  }
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
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">
<div id="gracias_id">
<div class="alert alert-success"> <B>Nuestro objetivo como Iglesia Infantil es tener un mayor seguimiento y cuidado espiritual de nuestro ni&ntilde;os y ni&ntilde;as, a trav&eacute;s de ustedes como padres. Por eso de manera amable nos gustar&iacute;a que nos proporcione la siguiente informaci&oacute;n.<br />
<span style="color:#FF0000">*Obligatorio</span></B> </div>

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
 $('#gracias_id').html("<center><br><br><b><img src='mano-ok.png' width='150' height='144' border='0'><br>ENVIO REALIZADO CON EXITO</b></center>");
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

//  End -->
</script>

<div id="divBody_envioemail" ></div>