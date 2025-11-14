<?php
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{


if(strlen(@$_POST["valor_b"])>=1)	
{

$sql1='';

if($_POST["valor_b"])
{
$sql1=" ( prod_codigo like '%".@$_POST["valor_b"]."%' or prod_nombre like '%".@$_POST["valor_b"]."%') and ";
}

if(@$_SESSION['ces1313777_sessid_emp_id'])
{
   $sql2="emp_id = ".@$_SESSION['ces1313777_sessid_emp_id']." and ";
}


$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);

if($concatenado)
{
	$lista_prductos="select * from efacsistema_producto where ".$concatenado." order by prod_pedido desc";

}

else

{



	$lista_prductos="select * from efacsistema_producto order by prod_pedido desc limit 20";

}





$tipopac_id='';

$lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($_POST["ci_paga"])."'";

$rs_datahijos = $DB_gogess->executec($lista_hijos,array());

if($rs_datahijos)

 {

	  while (!$rs_datahijos->EOF) {	

        

		$tipopac_id=$rs_datahijos->fields["tipopac_id"];



        $rs_datahijos->MoveNext();	   

	  }

  }

?>



<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">

<?php



$rs_data = $DB_gogess->executec($lista_prductos,array());



 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

?>

  <tr bgcolor="#EFF3F5">

    <td onClick="agregar_insumo('<?php echo $rs_data->fields["prod_id"]; ?>','<?php echo trim($_POST["ci_paga"]); ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>

    <td><b><?php echo $rs_data->fields["prod_nombre"]; ?></b></td>

	<?php

	$valor_precio=0;

	switch ($tipopac_id) {

    case 1:

        $valor_precio=$rs_data->fields["prod_precioisfa"];

        break;

    case 2:

        $valor_precio=$rs_data->fields["prod_precio"];

        break;

    case 3:

        $valor_precio=$rs_data->fields["prod_precioconvenio"];

        break;

	case 4:

        $valor_precio=$rs_data->fields["prod_precioconveniohermano"];

        break;	

	case 5:

        $valor_precio=$rs_data->fields["prod_preciopolicia"];

        break;

	case 6:

        $valor_precio=$rs_data->fields["prod_preciomilitar"];

        break;	

	default:

	    $valor_precio=$rs_data->fields["prod_precio"];

	   	break;				

    }

	?>

    <td><b>$ <?php echo $valor_precio; ?></b></td>

    

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

	  echo "Por favor ingrese mas de 1 caracteres para la b&uacute;squeda...";

  }



}

?>