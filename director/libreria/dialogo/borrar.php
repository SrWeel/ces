<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
?>
<?php
$table=$_POST["pVar1"];
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");

if($_POST["pVar3"]=='guardar')
{
 echo "<br><br><center><span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >No ha seleccionado un registro para borrar...</span></center>";
}
else
{
?>
<SCRIPT LANGUAGE=javascript>
<!--
function cancelar_borrado()
{
  $('#divDialog_borrar_<?php echo $table; ?>').remove();
}
function aceptar_borrado()
{

  $("#ejecuta_borrado").load("libreria/dialogo/ejecuta_borrado.php",{
  
  paraborra:'<?php echo base64_encode($_POST["pVar2"]) ?>',ptabla:'<?php echo $table ?>'
  
  },function(result){  
  
      
	  eval(result);
            if(result_borrado=="1") 
			{
			   $("#ejecuta_borrado").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:green;'>Registro borrado con exito...</span>");
			   nuevo_<?php echo $table; ?>();
			}
			else
			{			
			   $("#ejecuta_borrado").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Error al borrar el regsitro es posible que tenga datos relacionados...</span>");
			   
			}
	  
	  
  });  
  $("#ejecuta_borrado").html("Espere un momento...");
  
}
//-->
</SCRIPT>

<div align="center"><strong><br />
  Desea borrar el registro?
  </strong>
  <br />
  <br />
  <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td onclick="aceptar_borrado()" style="cursor:pointer" ><img src="images/ok.png" width="110" height="40"></td>
      <td onclick="cancelar_borrado()" style="cursor: pointer"><img src="images/cancelar.png" width="110" height="40"></td>
    </tr>
  </table>
</div>
<div id=ejecuta_borrado ></div>

<?php
}
?>
