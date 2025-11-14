<style type="text/css">



<!--



.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }



.espacio_css {



	font-size: 7px;



	font-family: Arial, Helvetica, sans-serif;



}

.Estilo1 {font-size: 11px}



-->



</style>



<script type="text/javascript">

<!--

function desplegar_lista()

{

  $("#lista_estab").load("templateformsweb/maestro_standar_empresa/lista_establecimientos.php",{



  },function(result){  



  });  


  $("#lista_estab").html("Espere un momento...");

}

 

 

function desplegar_listaboega()
{
  $("#lista_bodegab").load("templateformsweb/maestro_standar_empresa/lista_bodega.php",{

  },function(result){  


  });  

  $("#lista_bodegab").html("Espere un momento...");

}


function desplegar_listaimp()
{
 
  $("#lista_impresion").load("templateformsweb/maestro_standar_empresa/lista_impresion.php",{

  },function(result){  


  });  

  $("#lista_impresion").html("Espere un momento...");

}

function guardar_imp(idimp,x,y,tm)
{
  $("#lista_impresion").load("templateformsweb/maestro_standar_empresa/lista_impresion.php",{
  idimpp:idimp,
  xp:x,
  yp:y,
  letratm:tm
 },function(result){  


  });  

  $("#lista_impresion").html("Espere un momento...");

}

//  End -->

</script> 



<table width="800" border="0" align="center" cellpadding="4" cellspacing="2">  



  <tr>



    <td width="262" valign="top"><div align="center">



      <?php



	 



		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	



			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	



            $objformulario->sendvar["horax"]=date("H:i:s");



			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];



			 $objformulario->sendvar["usr_tpingx"]=0;



			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];



			



			 



$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 



?>



    </div></td>



    <td width="6" valign="top">&nbsp;</td>



    <td width="500" valign="top"><?php



    $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 



	?>

      <input type="button" name="Submit" value="Nuevo Establecimiento" onclick="abrir_standar('aplicativos/documental/opciones/grid/establecimiento/grid_establecimiento_nuevo.php','Nuevo','divBody_establecimiento','divDialog_establecimiento',800,400,0,0,0,0,0,0,0)" style="cursor:pointer">

      <br>

	  <div id="lista_estab" >

     

	  

	  </div>

      <br />

      <br />

  <br><br>    

       <input type="button" name="Submit" value="Nueva Bodega" onclick="abrir_standar('aplicativos/documental/opciones/grid/bodega/grid_bodega_nuevo.php','Nuevo','divBody_bodega','divDialog_bodega',800,400,0,0,0,0,0,0,0)" style="cursor:pointer">

      <br>

	  <div id="lista_bodegab" >

     

	  

	  </div>

<br><br>

<br>
<div id="lista_impresion" >

     

	  

</div>  

	</td>



  </tr>



</table>







<?php       



if($csearch)



{



 $valoropcion='actualizar';



}



else



{



 $valoropcion='guardar';



}







echo "<input name='csearch' type='hidden' value=''>



<input name='idab' type='hidden' value=''>



<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >



<input name='table' type='hidden' value='".$table."'>";







?>



<div id=div_<?php echo $table ?> > </div>

<div id="divBody_establecimien" ></div>

<script type="text/javascript">



<!-- Begin

$("#estbl_codigo_val").mask({mask: "###"});



desplegar_lista();

desplegar_listaboega();

desplegar_listaimp();

//  End -->



</script>

