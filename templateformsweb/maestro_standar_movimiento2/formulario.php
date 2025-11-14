<?php

	        $enlace_general=@$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_POST["centro_id"];
			$objformulario->sendvar["cuadrobm_idx"]=$_POST["pVar7"];
			$objformulario->pathext="../../../../../";
			
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
	   
	   ?>         <?php
	   
//$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
	   
	   ?></td>
     </tr>
     <tr>
       <td bgcolor="#70AADA"><div align="center"><span class="style1">ALMACENAMIENTO Y CONSUMO </span></div></td>
     </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
	   
	   ?></td>
     </tr>
     <tr>
       <td bgcolor="#70AADA"><div align="center" class="style1">TRANSFERENCIAS</div></td>
     </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
	   
	   ?></td>
     </tr>
     <tr>
       <td bgcolor="#70AADA"><div align="center"><span class="style1">&nbsp;</span></div></td>
     </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
	   
	   ?></td>
     </tr>
   </table>

<div id="divBody_lista" ></div>

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


<script type="text/javascript">
<!--

  $( "#centrorecibe_cantidad" ).change(function() {
  
   
	  multiplica();
	  
  });
  
  $( "#moviin_cantidadunidadconsumo" ).change(function() {
  

	  multiplica();
	  
  });
  
  function multiplica()
  {
      var valor1=parseFloat($( "#centrorecibe_cantidad" ).val());
	  var valor2=parseFloat($( "#moviin_cantidadunidadconsumo" ).val());
	  var im=valor1*valor2;
	  var num = im;
	  
	  $( "#moviin_totalenunidadconsumo" ).val(num);
  }

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>