<?php

header('Content-Type: text/html; charset=UTF-8');

ini_set('display_errors',0);

error_reporting(E_ALL);

$tiempossss=444540000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{



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



 if (@$table)



  {



  $objtableform->select_templateform(@$table,$DB_gogess);	



  }



$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;



$clie_id=$_POST["pVar2"];

$mnupan_id=$_POST["pVar3"];

$atenc_id=$_POST["pVar4"];

$eteneva_id=$_POST["pVar5"];



$fie_id=$_POST["pVar6"];

$enlace=$_POST["pVar7"];



?>

<script type="text/javascript">

<!--



function desplegar_integrantesg()

{

   $("#grid_integrantes").load("templateformsweb/maestro_standar_atencion/integrantes.php",{

  

  grup_idx:$('#grup_idx').val()

 

  },function(result){  





  });  

  $("#grid_integrantes").html("Espere un momento");  

}



function guardar_horario()

{



 if($('#grup_idx').val()=='0')

  {



  alert("Seleccione el grupo...");



  return false;



  }

 

  if($('#asighor_fechax').val()=='')

  {



  alert("Ingrese la fecha...");



  return false;



  }

 

 

  $("#grid_g").load("templateformsweb/maestro_standar_atencion/guardarhorario.php",{

  eteneva_id:'<?php echo $eteneva_id ?>',

  clie_id:'<?php echo $clie_id ?>',

  atenc_id:'<?php echo $atenc_id ?>',

  grup_idx:$('#grup_idx').val(),

  asighor_fechax:$('#asighor_fechax').val()

 

  },function(result){  





       grid_extras_<?php echo $fie_id;  ?>('<?php echo @$enlace; ?>',0,0);

    

  });  

  $("#grid_g").html("Espere un momento"); 

  

}

//  End -->

</script>



<?php

$busca_datos="select * from faesa_asigahorario where eteneva_id=".$eteneva_id;

$rs_bdatos = $DB_gogess->executec($busca_datos,array());



?>



<div class="form-group" >

<div class="col-md-12">

     <select class="form-control" name="grup_idx" id="grup_idx" onclick="desplegar_integrantesg()" style="font-size:11px"  >

     <option value="0" >--Seleccion Grupo--</option>

			<?php

			$objformulario->fill_cmb('faesa_grupos','grup_id,grup_nombre',@$rs_bdatos->fields["grup_id"],' where centro_id='.$_SESSION['ces1313777_centro_id'].' order by grup_id asc',$DB_gogess);

			?>

     </select>

</div>

</div>	 

<p>&nbsp;</p>

<div class="form-group">

<div class="col-md-12">

    <input placeholder="Fecha evaluaci&oacute;n" name="asighor_fechax" id="asighor_fechax" class="form-control" style="font-size:11px"  value="<?php echo @$rs_bdatos->fields["asighor_fecha"]; ?>"  type="text"  >

</div>

</div>





<p>&nbsp;</p>

<div id="grid_integrantes"></div>	 



<BR /><BR />

<div class="form-group">

<div class="col-md-12">



<button type="submit" class="mb-sm btn btn-primary" onclick="guardar_horario()"  >Guardar</button>



</div>

</div>



<div id="grid_g"></div>



<script type="text/javascript">

<!--

 $("#asighor_fechax").datepicker({dateFormat: 'yy-mm-dd'});

desplegar_integrantesg();

 //  End -->

</script>

<?php
}
else
{

$varable_func=' $("#divDialog_calendario").dialog( "close" ); ';
$varable_enviafunc=base64_encode($varable_func);
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';


	
}		
?>