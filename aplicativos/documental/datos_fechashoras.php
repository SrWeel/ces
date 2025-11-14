<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

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
$comillasimple="'";

?>
<script type="text/javascript">
<!--
function guarda_cita(id_data)
{
   if($('#vetr_id').val()==0)
   {
   alert("Seleccione el medico");
   return false;
   }
   
   if($('#sala_id').val()==0)
   {
   alert("Seleccione la sala");
   return false;
   }
 //alert($('input:checkbox[name=checkbox_'+id_data+']:checked').val());
   $("#div_gcita").load("aplicativos/documental/guarda_cita.php",{
   anio:'<?php echo $_POST["pVar1"] ?>',
   mes:'<?php echo $_POST["pVar2"] ?>',
   dia:'<?php echo $_POST["pVar3"] ?>',
   fich_id:'<?php echo $_POST["pVar4"] ?>',
   hora_sel:id_data,
   hora_estado:$('input:checkbox[name=checkbox_'+id_data+']:checked').val(),
   vetr_id:$('#vetr_id').val(),
   sala_id:$('#sala_id').val()
  },function(result){  

ver_calendario_mes();
lista_horas();

  });  

  $("#div_gcita").html("Espere un momento...");  

}

function lista_horas()
{

   if($('#vetr_id').val()==0)
   {
   alert("Seleccione el medico");
   return false;
   }
   
   if($('#sala_id').val()==0)
   {
   alert("Seleccione la sala");
   return false;
   }
   $("#lista_horasd").load("aplicativos/documental/lista_horas.php",{
    anio:'<?php echo $_POST["pVar1"] ?>',
    mes:'<?php echo $_POST["pVar2"] ?>',
    dia:'<?php echo $_POST["pVar3"] ?>',
    fich_id:'<?php echo $_POST["pVar4"] ?>',
    vetr_id:$('#vetr_id').val(),
    sala_id:$('#sala_id').val()
  },function(result){  



  });  

  $("#lista_horasd").html("Espere un momento...");  

}
//  End -->
</script>

<?php
$anio=$_POST["pVar1"];
$mes=str_pad($_POST["pVar2"], 2, "0", STR_PAD_LEFT);
$dia=str_pad($_POST["pVar3"], 2, "0", STR_PAD_LEFT);
$fich_id=$_POST["pVar4"];

//echo $anio."<br>";
//echo $mes."<br>";
//echo $dia."<br>";
//echo $fich_id."<br>";



echo "A&ntilde;o:".$anio." - Mes:".$mes." - D&iacute;a:".$dia."<br><br>";
?>
<center>
<select name="vetr_id" id="vetr_id">
<option value="0" selected>--doctor--</option>
<?php
$objformulario->fill_cmb("app_veterinario","vetr_id,vetr_nombre",@$vbus,"order by vetr_nombre asc",$DB_gogess);
?>
</select>
<select name="sala_id" id="sala_id">
<option value="0" selected>--sala--</option>
<?php
$objformulario->fill_cmb("app_salas","sala_id,sala_nombre",@$vbus,"order by sala_nombre asc",$DB_gogess);
?>
</select>
<input type="button" name="Submit" value="Ver"   onclick="lista_horas()" >

</center>
<div id="lista_horasd">

</div>
<div id="div_gcita"></div>