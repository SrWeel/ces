<?php
ini_set('display_errors',0);
ini_set('memory_limit',-1);
error_reporting(E_ALL);
@$tiempossss=55544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
//Llamando objetos
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$clie_id=$_POST["pVar2"];
$atenc_id=$_POST["pVar4"];
$odonto_id=$_POST["pVar5"];
$tabla_toma=$_POST["pVar6"];
$centro_id=$_POST["pVar7"];

$usua_idfacval=$_SESSION['ces1313777_sessid_inicio'];
$prof_idval=37;

$sql1='';
$sql2='';
$sql3='';
$sql3=" prof_id ='".$prof_idval."' and ";

$concatenado=$sql1.$sql2.$sql3;
$concatenado=substr($concatenado,0,-4);

$lista_prductos="select * from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where ".$concatenado." and prod_nivel=1 and grdifun_activo=1 and prod_precio>0 and tipp_id=3 order by prod_pedido desc";

?>

<table width="550" border="1" align="center" cellpadding="2" cellspacing="1">

<?php

$rs_data = $DB_gogess->executec($lista_prductos,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	  
	  //ver precio convenio
	  $gconve_precio=0;
	  if($_POST["conve_id"]>0)
      {
	    $busca_valorconvenio="select * from cesdb_arextension.dns_gridconvenios where prod_enlace='".$rs_data->fields["prod_enlace"]."' and gconve_convenio='".$_POST["conve_id"]."'";
		$rs_valorconvenio = $DB_gogess->executec($busca_valorconvenio,array());
	    $gconve_precio=$rs_valorconvenio->fields["gconve_precio"];
	  }
	  
	  //ver precio convenio

?>

  <tr bgcolor="#EFF3F5">

    <td onClick="agregar_insumopedido('<?php echo $rs_data->fields["prod_id"]; ?>',$('#usua_idfacval').val(),'<?php echo $_POST["prof_idval"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td style="font-size:9px"><b><?php echo $rs_data->fields["prod_codigo"]; ?></b></td>
    <td style="font-size:9px" ><b><?php echo $rs_data->fields["prod_nombre"]; ?></b></td>

	<?php

	$valor_precio=0;
	$valor_precio=$rs_data->fields["prod_precio"];
	
    if($gconve_precio>0)
	{
	    //$saca_descuentovalor=($conve_descuento*$rs_data->fields["prod_precio"])/100;
	    $valor_precio=$gconve_precio;
	}
	?>

    <td nowrap="nowrap" style="font-size:9px" ><b>$ <?php echo $valor_precio; ?></b></td>

    

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

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>