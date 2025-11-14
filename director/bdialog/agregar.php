<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
?>
<?php
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$$tags2[$i]=$valores2[$i]; 
}

?> 
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
    <td width="98%"> <div align="center"><font color="#FFFFFF">Desea agregar los campos pendientes?</font></div></td>
  </tr>
  <tr> 
    <td width="98%" height="28"> <div align="center">         
        <input type="button" value="Cancelar" onClick="javascript:cmdCancelar()" name="cmdCancelar" class="boton">
		<input type="button" value="Aceptar" onClick="javascript:cmdAceptar('si')" name="cmdAceptar" class="boton">
      </div></td>
  </tr>
</table>

</body>

</html>
