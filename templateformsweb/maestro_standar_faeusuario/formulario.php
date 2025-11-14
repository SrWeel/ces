<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["etn_idx"]=6;
			$objformulario->sendvar["nac_idx"]=56;
			
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["usua_enlacex"]=$aletorioid;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			
		 

//$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);

?>

  <center>
  <input type="button" name="Submit" value="Reset Clave" onclick="resetclv()" />
  <div id="clv_panel" ></div>
  </center><br />
<?php	

$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);

if($csearch)
{    
  
  ?>
  <p>&nbsp;</p>
  


  
  <p>&nbsp;</p>
  <?php
  
}
?>



<?php
if($csearch)

{

 $valoropcion='actualizar';

}

else

{

 $valoropcion='guardar';

}

//usua_horascontrato


//$busca_ideal="select * from dns_profesion where prof_id=".$objformulario->contenid['usua_formaciondelprofesional'];
//$rs_ideal = $DB_gogess->executec($busca_ideal,array());


//echo $rs_ideal->fields['prof_citasideales']."<br>";
//echo $objformulario->contenid['usua_horascontrato']."<br>";

//$busca_efectivas="SELECT count(`anam_hc`) as numcli FROM `dns_anamesisexamenfisico` WHERE `anam_fecharegistro`>='2019-05-01' and `anam_fecharegistro`<='2019-05-31' and `usua_id`=45";
//$rs_efectivas = $DB_gogess->executec($busca_efectivas,array());

//echo $rs_efectivas->fields['numcli']."<br>";

//$porcentaje=($rs_efectivas->fields['numcli']/$rs_ideal->fields['prof_citasideales'])*100;

//echo number_format($porcentaje, 2, '.', '');

echo "<input name='csearch' type='hidden' value=''>

<input name='idab' type='hidden' value=''>

<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >

<input name='table' type='hidden' value='".$table."'>";



?>


<div id=div_<?php echo $table ?> > </div>


<script type="text/javascript">
<!--
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>

<script type="text/javascript">

function resetclv()
{

   $("#clv_panel").load("templateformsweb/maestro_standar_faeusuario/clvreset.php",{
    idv:$('#usua_id').val()


  },function(result){  



  });  

  $("#clv_panel").html("Espere un momento...");  

}

</script>

<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>