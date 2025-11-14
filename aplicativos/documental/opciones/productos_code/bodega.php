<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

@$tiempossss=144000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

//echo $_POST["pVar1"];

//Llamando objetos

if($_SESSION['ces1313777_sessid_inicio'])

{

$director='../../../../';

include("../../../../cfg/clases.php");

include("../../../../cfg/declaracion.php");



$listacampos1="select * from app_bodega where emp_id=".$_POST["emp_id"]." order by bode_id asc";

$rs_gogessform = $DB_gogess->executec($listacampos1,array());



?>

<table border="0" cellpadding="0" cellspacing="2">

  <tr>

  <?php

   if($rs_gogessform)

 {

     	while (!$rs_gogessform->EOF) {	

  ?>

    <td onClick="lista_productos('<?php echo $rs_gogessform->fields["bode_id"]; ?>')" style="cursor:pointer" ><img src="images/bodega.png"><br><b><center><?php echo $rs_gogessform->fields["bode_nombre"]; ?></center></b></td>

<?php

$rs_gogessform->MoveNext();	

		}

	}

?>	

  </tr>

</table>



<?php

}

else

{

   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';

}

?>