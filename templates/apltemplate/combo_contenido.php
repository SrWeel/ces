<?
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
<?php

//Llamando objetos
include("../../libreria/formulario.php");
include("../../libreria/dbcc.php");
include("../../cfgclases/config.php");

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
//Valores globales


$ar=$_GET["q"];
$apl=$_GET["q1"];
$secc=$_GET["q2"];
$seccionp=$_GET["q3"];
$system=$_GET["q4"];
$sessid=$_GET["q5"];

$d1=$_GET["q6"];
$d2=$_GET["q7"];
$d3=$_GET["q8"];

if ($ar)
{
echo '<table   border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<iframe src="index.php?ar='.$ar.'&secc=1&seccionp='.$seccionp.'&system='.$system.'&sessid='.$sessid.'" width="750" height="510" frameborder=0 ></iframe>
</td>
  </tr>
  <tr>
    <td>        
              <span align="center">
                <input type="button" value="Cerrar " onClick="javascript:cmdCancelar()" name="Cancelar" class="boton">         
            </span>	
	</td>
  </tr>
</table>';
}
else
{
 if ($apl)
{

echo '<table   border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<iframe src="index.php?d1='.$d1.'&d2='.$d2.'&d3='.$d3.'&apl='.$apl.'&secc=7&system='.$system.'&sessid='.$sessid.'" width="750" height="510" frameborder=0 ></iframe>
</td>
  </tr>
  <tr>
    <td>        
              <span align="center">
                <input type="button" value="Cerrar " onClick="javascript:cmdCancelar()" name="Cancelar" class="boton">         
            </span>	
	</td>
  </tr>
</table>';
}
}
								
?>
