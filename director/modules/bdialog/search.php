<html>
<head>
<META name=VI60_defaultClientScript content=VBScript>
<title>Search...</title>
<script language=javascript>
	window.returnValue=""
	function cmdAceptar(){	   
		if (txtdato.value!=""){
			window.returnValue="<?php echo $busq ?>$$"+ opt.value +"$$"+txtdato.value;			
			window.close()
			}
		else 
			alert("debe ingresar un dato a buscar")
	}
	function cmdCancelar(){
			window.close()
	}
	
</script>
<SCRIPT ID=clientEventHandlersVBS LANGUAGE=vbscript>
<!--

Sub txtdato_onkeypress
if window.event.keycode=13 then
	cmdAceptar()
end if

End Sub

Sub txtdato_onchange
'txtdato.value=""
End Sub

-->
</SCRIPT>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #A6C6C8;
}
-->
</style></head>
<body topmargin="0" leftmargin="0">
<table border="0" align="center" cellpadding="2" bordercolor="#111111" bgcolor="#A6C6C8" id="AutoNumber1" style="BORDER-COLLAPSE: collapse">
  <tr> 
    <td width="98%"></td>
  </tr>
  <tr> 
    <td width="98%"></td>
  </tr>
  <tr> 
    <td width="98%"> 
      <div align="center"> 
        <input type="hidden" name="opt" value="3">
        <input name="txtdato" class="combolab">
      </div>
    </td>
  </tr>
  <tr> 
    <td width="98%" height="28"> 
      <div align="center"> 
        <input type="button" value="Aceptar" onClick="javascript:cmdAceptar()" name="cmdAceptar" class="boton">
        <input type="button" value="Cancelar" onClick="javascript:cmdCancelar()" name="cmdCancelar" class="boton">
      </div>
    </td>
  </tr>
</table>

</body>

</html>
