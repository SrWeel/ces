<?php

$tiempossss=14000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();



$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])

{

	

if(strlen(@$_POST["valor_b"])>=4)	

{

	

$sql1='';

if($_POST["valor_b"])

{



$sql1=" ( produ_codigoserial like '%".@$_POST["valor_b"]."%' or produ_nombre like '%".@$_POST["valor_b"]."%') and ";



}

if(@$_SESSION['ces1313777_sessid_emp_id'])

{

   $sql2="emp_id = ".@$_SESSION['ces1313777_sessid_emp_id']." and ";

}

$concatenado=$sql1.$sql2;



$concatenado=substr($concatenado,0,-4);





if($concatenado)

{

	$lista_prductos="select * from app_producto where ".$concatenado." order by produ_pedido desc";

}

else

{

	$lista_prductos="select * from app_producto order by produ_pedido desc limit 10";

	

}





?>



<table width="400" border="0" align="center" cellpadding="2" cellspacing="1">

<?php

$rs_data = $DB_gogess->executec($lista_prductos,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

?>

  <tr bgcolor="#EFF3F5">

    <td onClick="agregar_insumo('<?php echo $rs_data->fields["produ_id"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>

    <td><b><?php echo $rs_data->fields["produ_nombre"]; ?></b></td>

    <td><b>$ <?php echo $rs_data->fields["produ_preciogen"]; ?></b></td>

  </tr>

<?php

$rs_data->MoveNext();	   

	  }

  }

?>  

</table>



<?php

  }

  else

  {

	  

	  echo "Por favor ingrese mas de 3 caracteres para la b&uacute;squeda...";

  }

}

?>