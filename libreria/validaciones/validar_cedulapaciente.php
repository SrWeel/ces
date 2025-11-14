<?php

//include("../../cfgclases/sessiontime.php");
$tiempossss=167000;
ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

?>

<?php

//Llamando objetos

$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");

//Conexion a la base de datos

$comparativa1=0;

$comparativa2=0;



if($objvalidacion->validarID($_REQUEST[$_POST['campo_validar']])=='NO')

 {

   $comparativa1=0;  

  }

else

{

  $comparativa1=1;

}



$comparativa2=1;



if(trim($_POST["idg"]))

{

 $buscaruc="select clie_rucci from app_cliente where clie_rucci='".$_REQUEST[$_POST['campo_validar']]."' clie_id not in(".trim($_POST["idg"]).")";

}

else

{

 $buscaruc="select clie_rucci from app_cliente where clie_rucci='".$_REQUEST[$_POST['campo_validar']]."'";

}





$estado="true";

$rs_gogessform = $DB_gogess->executec($buscaruc,array());

if($rs_gogessform)

{

     	while (!$rs_gogessform->EOF) {

		     $comparativa2=0;

			 $rs_gogessform->MoveNext();  

		}

}





/*$fp = fopen("fichero.txt", "w");

fputs($fp,$_POST["tipdoc_id"] );

fclose($fp);*/



if($_POST["tipoci_id"]==2)
{

	

	$comparativa1=1;

}



$resultadocp=$comparativa1*$comparativa2;



if($resultadocp)

{

echo 'true';

}

else

{

echo 'false';

}

?>