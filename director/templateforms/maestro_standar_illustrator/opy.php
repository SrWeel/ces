<?php
?>
<script language="javascript">
<!--
function lista_camposop()
{
 

  if($('#ltablas').val()==null)
  {
	 alert("Select the table");  
	 return false;
  }
  
  
  $("#div_listacop").load("templateforms/maestro_standar_illustrator/listacop.php",{ltablas:$('#ltablas').val()},function(result){  
    
	
  });  
  $("#div_listacop").html("Wait a moment...");
  

}

function agregar_sum()
{
	
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	var dato_val="sum(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="sum"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}


function agregar_min()
{
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	
	var dato_val="min(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="min"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}


function agregar_max()
{
	
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	var dato_val="max(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="max"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}

function agregar_count()
{
	
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	var dato_val="count(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="count"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}

function agregar_avg()
{
	
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	
	var dato_val="avg(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="avg"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}


function agrega_camposY_form()
{
	
	if($('#textarea_yop').val()==null)
	{
	  alert("Please, select the field operation");
	  return false;
	}

	
	var dato_val=$('#textarea_yop').val();
	var id_val=$('#opd_val').val();
	var decimales=$('#decimal_yop').val();
	
	$('#graph_labelformula').val(dato_val);
	$('#graph_labelformula_label').html(dato_val);
	$('#graph_formula').val(dato_val);
	
	$('#graph_decimals').val(decimales);
	
	$('#divDialog_grafico').dialog( "close" );
	
}

//----operaciones------


function agregar_nas()
{
	  
	  
	var dato_val=$('#el_mas').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;

	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor;
	
	
	$('#opd_val').val(concatena2);
    $('#textarea_yop').val(concatena);
	$('#graph_labelformula').val(concatena);
	
	
}

function agregar_resta()
{
	  
	  
	  var dato_val=$('#el_resta').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;

    $('#textarea_yop').val(concatena);
	
}


function agregar_div()
{
	  
	  
	  var dato_val=$('#el_div').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;

    $('#textarea_yop').val(concatena);
	
}

function agregar_mult()
{
	  
	  
	var dato_val=$('#el_mult').val();
	
	var res_valor = dato_val;
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;

    $('#textarea_yop').val(concatena);
	
}



//-----operaciones-----

//-----nooperation valor-----

function agregar_nooperation()
{
	
	if($('#lcamposop option:selected').val()==null)
	{
	    alert("Select Field");	
		return false;
	}
	
	var dato_val="nooperation(-valor-)";
	
	var id_val=$('#lcamposop option:selected').val();
	
	var res_valor =dato_val.replace("-valor-", "$"+$('#lcamposop option:selected').html());
	var res_valor_form ="nooperation"+"-"+$('#lcamposop option:selected').val();
	
	var concatena;
	var concatena=$('#textarea_yop').val() + res_valor;
	
	var concatena2;
	var concatena2=$('#opd_val').val() + res_valor_form;

    $('#textarea_yop').val(concatena);
	
	$('#opd_val').val(concatena2);
	
	
}


lista_camposop();
//-->
</script>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>FIELDS</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
    <div id="div_listacop" >
         <select name="lcamposop" size="10" id="lcamposop">
         </select>
    </div>
              </td>
    <td valign="top"><table border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td><input type="button" name="el_sum" id="el_sum" value="sum()" onclick="agregar_sum()" style="width:115px"  /></td>
        <td>&nbsp;</td>
        <td rowspan="7"><table border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td><input type="button" name="el_mas" id="el_mas" value="+" onclick="agregar_nas()" width="35px" /></td>
            <td><input type="button" name="el_resta" id="el_resta" value="-" onclick="agregar_resta()" width="35px" /></td>
          </tr>
          <tr>
            <td><input type="button" name="el_mult" id="el_mult" value="*" onclick="agregar_mult()" width="35px" /></td>
            <td><input type="button" name="el_div" id="el_div" value="/" onclick="agregar_div()" width="35px" /></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td><input type="button" name="el_min" id="el_min" value="min()" onclick="agregar_min()" style="width:115px"  /></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><input type="button" name="el_avg" id="el_avg" value="avg()" onclick="agregar_avg()" style="width:115px"  /></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><input type="button" name="el_count" id="el_count" value="count()" onClick="agregar_count()" style="width:115px"  /></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><input type="button" name="el_max" id="el_max" value="max()" onClick="agregar_max()" style="width:115px"  /></td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td><input type="button" name="el_nooperation" id="el_nooperation" value="nooperation()" onClick="agregar_nooperation()" style="width:115px"  /></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
    <td valign="top"><textarea name="textarea_yop" id="textarea_yop" cols="40" rows="9"><?php echo $_POST["pVar1"]; ?></textarea>
	<br />  Decimals:<input name="decimal_yop" type="text" id="decimal_yop" size="10" value="3" />
    <input name="opd_val" type="hidden" id="opd_val" value="">
    <br><input type="submit" name="button" id="button" value="ADD OPERATION" onClick="agrega_camposY_form()"></td>
  </tr>
</table>