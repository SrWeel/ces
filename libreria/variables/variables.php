<?php

/***VARIABLES POR GET ***/
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='snp')
	{
	///
		 $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

$decodevalor=base64_decode(substr(@$snp,0,-3));
if($decodevalor)
{
   $decodevalor=$objcontenido_sistema->decrypt($decodevalor);
}


$splitvar=explode("&",$decodevalor);
$nombreget='';
for($ivari=0;$ivari<count($splitvar);$ivari++)
{
 // echo $splitvar[$ivari]."<br>";
  $sacadatav=explode("=",$splitvar[$ivari]);
  
  //if (preg_match('/^[a-z\d_=]{1,10}$/i',$sacadatav[1])) {
  
  $nombreget=$sacadatav[0];
  @$$nombreget=$sacadatav[1];
  
  //}

}


///Bloque links grandes
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles
$nombre_var='';
// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
 $nombre_var=$tags2[$i];
  $$nombre_var=$valores2[$i];  
}

?>