<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
?>

<style type="text/css">
<!--
.txt_cmb { 
font-family:Verdana, Geneva, sans-serif; 
font-size:11px;

}
-->
</style>


<script type="text/javascript">
<!-- Begin


function selecciona_dato() {

   var dato_val=$('#listaag_camp option:selected').html();
   var res_valor = dato_val.split("--");
   
   if(res_valor[1].trim()==$('#nfield').val())
   {
	   
	    alert("Invalid Operation");
		return false; 
   }

   $("#validar_campo").load("templateforms/maestro_standar_developer/validar.php",{
	  
	  ingreso:res_valor[1].trim(),
	  nfield:$('#nfield').val()
  
  },function(result){  
        
		if($('#valor_validacion').val()==1)
		{
			 alert("Invalid Operation");
		}
		else
		{
			
			var concatena;
			if(res_valor[0].trim()=='Operation')
			{
			  var concatena=$('#textarea_op').val() + "["+res_valor[1].trim()+"]";
			}
			else
			{
			 var concatena=$('#textarea_op').val() + res_valor[1];
			}
			$('#textarea_op').val(concatena);
	
			
		}
		
     });  



	
	
	

}


function agregar_nas()
{
	  
	  
	  var dato_val=$('#el_mas').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_op').val() + res_valor;

    $('#textarea_op').val(concatena);
	
}

function agregar_resta()
{
	  
	  
	  var dato_val=$('#el_resta').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_op').val() + res_valor;

    $('#textarea_op').val(concatena);
	
}


function agregar_div()
{
	  
	  
	  var dato_val=$('#el_div').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_op').val() + res_valor;

    $('#textarea_op').val(concatena);
	
}

function agregar_mult()
{
	  
	  
	  var dato_val=$('#el_mult').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_op').val() + res_valor;

    $('#textarea_op').val(concatena);
	
}


function guardar_campo_op()
{
  if($('#nfield').val()=='')
  {
	  alert("Fill in the title field");
	  return false;
  }
  
  
  $("#guardar_campo").load("templateforms/maestro_standar_developer/editar_op.php",{
	  
	  vardevdet_id:<?php echo $_POST["pVar2"] ?>,
	  textarea_op:$('#textarea_op').val(),
	  nfield:$('#nfield').val()
  
  },function(result){  
        listar_ag();
     });  
    $("#guardar_campo").html("Espere un momento...");

}

//  End -->
</script>



<table width="500" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td valign="top" class="txt_cmb" >
    
    <?php
			  $list_data="select * from sth_vddetalle where vardev_id=".$_POST["pVar1"];
              $resultlistat = $DB_gogess->Execute($list_data);
			  ?>
			  <select name="listaag_camp" size="10" id="listaag_camp" ondblclick="selecciona_dato()"  >
			  <?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  $nombretabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like ",$resultlistat->fields["vardevdet_tabla"],$DB_gogess);
					  
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_sisfield","fie_name,fie_title","where tab_name ='".$resultlistat->fields["vardevdet_tabla"]."' and fie_name like ",$resultlistat->fields["vardevdet_campo"],$DB_gogess));
					  
					  if(!($nombrecampo))
					  {
						  
						$nombrecampo=$resultlistat->fields["vardevdet_campo"];
						$nombretabla="Operation";
					  }
					  
					  echo '<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
              </select>
    
    
    </td>
    <td valign="middle" class="txt_cmb" >
    
    <table border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td><input type="button" name="el_mas" id="el_mas" value="+" onclick="agregar_nas()" width="35px" /></td>
        <td><input type="button" name="el_resta" id="el_resta" value="-" onclick="agregar_resta()" width="35px" /></td>
      </tr>
      <tr>
        <td><input type="button" name="el_mult" id="el_mult" value="*" onclick="agregar_mult()" width="35px" /></td>
        <td><input type="button" name="el_div" id="el_div" value="/" onclick="agregar_div()" width="35px" /></td>
      </tr>
  </table>
  
  </td>
    <td valign="top" class="txt_cmb" >
    <?php
	if($_POST["pVar7"]==1)
	{
	?>
    Name field:
<input type="text" name="nfield" id="nfield" value="" />
<center><textarea name="textarea_op" id="textarea_op" cols="30" rows="5"></textarea></center>
<input type="button" name="button" id="button" value="Add" onclick="agregar_campo_op()" />
<div id="guardar_campo" ></div>
<?php
	}
?>

<?php
	if($_POST["pVar7"]==2)
	{
		
		$busca_data="select * from sth_vddetalle where vardevdet_id=".$_POST["pVar2"];
		$result_data = $DB_gogess->Execute($busca_data);
	?>
    Name field:
<input type="text" name="nfield" id="nfield" value="<?php echo $result_data->fields["vardevdet_campo"]; ?>" />
<center><textarea name="textarea_op" id="textarea_op" cols="30" rows="5"><?php echo $result_data->fields["vardevdet_operation"]; ?></textarea></center>
<input type="button" name="button" id="button" value="Save" onclick="guardar_campo_op()" />
<div id="guardar_campo" ></div>
<?php
	}
?>
    
    
    </td>
  </tr>
</table>
<div id="validar_campo" >
<input name="valor_validacion" type="hidden" id="valor_validacion" value="0">
</div>
<?php
}

?>
