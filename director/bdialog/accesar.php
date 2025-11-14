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
$nombrevarget1='';
for($i=0;$i<$numero;$i++){
$nombrevarget1=$tags[$i];
$$nombrevarget1=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombrevarget='';
for($i=0;$i<$numero2;$i++){ 
//$$tags2[$i]=$valores2[$i]; 

$nombrevarget=$tags2[$i];
$$nombrevarget=$valores2[$i];

}
?>
<html>
<head>
<title>Borrar</title>
<?php
//Llamando objetos
$director="../";

include("../cfgclases/clases.php");




?>
<script language=javascript>
	window.returnValue=""
	function cmdAceptar(ac){	
	
	if (ac=='si')
	{ 
	
	    parent.document.form_<?php echo $table; ?>.action='index.php?table=<?php echo $table; ?>&sessid=<?php echo $sessid; ?>';
        parent.document.form_<?php echo $table; ?>.tb.value='<?php echo $tb ?>';
        parent.document.form_<?php echo $table; ?>.opcion_<?php echo $table; ?>.value='buscar';
        parent.document.form_<?php echo $table; ?>.opcionb.value='agregarcampos';
        parent.document.form_<?php echo $table; ?>.csearch.value=<?php echo $csearch; ?>;  
        parent.document.form_<?php echo $table; ?>.submit()
	   
	 }

	}		
	function cmdCancelar(){
			
			parent.document.getElementById('opcionejecutardiv3').style.display = 'none';
	}
	
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-color: #ccdafd;
}
.Estilo1 {
	color: #000033;
	font-weight: bold;
}
.Estilo2 {font-size: 11px}
.Estilo3 {color: #000033; font-weight: bold; font-size: 11px; }
-->
</style>

</head>
<body topmargin="0" leftmargin="0">


<table border="0" align="center" cellpadding="2" bordercolor="#111111" id="AutoNumber1" style="BORDER-COLLAPSE: collapse">
  <tr> 
    <td></td>
  </tr>
  <tr> 
    <td></td>
  </tr>
  <tr> 
   <td> <div align="center" class="Estilo1 Estilo2">Desea Agregar los campos?</div></td>
  </tr>
  <tr> 
    <td> <div align="center"> 
        
		<input type="button" value="Aceptar" onClick="javascript:cmdAceptar('si')" name="cmdAceptar" class="boton">
        <input type="button" value="Cancelar" onClick="javascript:cmdCancelar()" name="cmdCancelar" class="boton">
    </div></td>
  </tr>
</table>

</body>

</html>
