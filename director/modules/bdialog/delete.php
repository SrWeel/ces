<html>
<head>
<title>Escoja la opcion a buscar</title>
<script language=javascript>
	window.returnValue=""
	function cmdAceptar(ac){	   
		if (ac!=""){
			window.returnValue=ac
			window.close()
			}
	}		
	function cmdCancelar(){
			window.close()
	}
	
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#CB352E" topmargin="0" leftmargin="0">
<table border="0" cellpadding="2" style="BORDER-COLLAPSE: collapse" bordercolor="#111111" id="AutoNumber1" align="center">
  <tr> 
    <td width="98%"></td>
  </tr>
  <tr> 
    <td width="98%"></td>
  </tr>
  <tr> 
    <td width="98%"> <div align="center"><font color="#FFFFFF">Desea Borrar el 
        registro?</font></div></td>
  </tr>
  <tr> 
    <td width="98%" height="28"> <div align="center"> 
        <input type="button" value="Aceptar" onClick="javascript:cmdAceptar('si')" name="cmdAceptar" class="boton">
        <input type="button" value="Cancelar" onClick="javascript:cmdCancelar()" name="cmdCancelar" class="boton">
      </div></td>
  </tr>
</table>

</body>

</html>
