<style type="text/css">
<!--
.factd5 {font-size: 11px; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
.factd8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.factd9 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #003399; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>

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
<?php 
//Llamando objetos
include("../libreria/formulario.php");
include("../libreria/dbcc.php");
include("../cfgclases/config.php");

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
//Valores globales

?>

 <?php	
	
$detallesql="select * from gogess_ayuda where ayu_id=".$idayuda;
 $resultadod = mysql_query($detallesql);

  		while($rowd = mysql_fetch_array($resultadod)) 
			{	
			$tituloayu=$rowd[ayu_titulo];
			$detalleayu=$rowd[ayu_detalle];
			}

?>
      <div align="center">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/ayuda.jpg"></td>
          </tr>
        </table>
        <p class="Estilo2">AYUDA DE LA SECCION ACTUAL
          <br>
                      </p>
      </div>
      <table width="100%"  border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td bgcolor="#F0F5F7"><div align="center"><span class="factd9"><?php echo $tituloayu ?></span></div></td>
        </tr>
        <tr>
          <td bgcolor="#FBFCFD"><span class="factd8"><?php echo $detalleayu ?> </span></td>
        </tr>
      </table>
      