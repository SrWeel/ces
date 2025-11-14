<?php
$tiempossss=444000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{
$sql1="";
$sql2="";
$sql3="";

@$usua_idfacval=$_POST["usua_idfacval"];

//doccab_autorizacion

//llega tipo y convenio
$conve_descuento=0;
if($_POST["conve_id"]>0)
{
$busca_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$_POST["conve_id"]."'";
$rs_convenio = $DB_gogess->executec($busca_convenio,array());
$conve_descuento=$rs_convenio->fields["conve_descuento"];
}

//llega tipo y convenio

if(strlen(@$_POST["valor_b"])>=0)	
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


if($_POST["prof_idval"])
{
   
   $sql3=" prof_id ='".$_POST["prof_idval"]."' and ";

}


$concatenado=$sql1.$sql2.$sql3;
$concatenado=substr($concatenado,0,-4);

if($concatenado)
{
	$lista_prductos="select * from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where ".$concatenado." and prod_nivel=1 and grdifun_activo=1 and prod_precio>0 and tipp_id=3 order by prod_nombre asc";

}
else
{



	$lista_prductos="select * from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where grdifun_activo=1 and prod_nivel=1 and prod_precio>0 and tipp_id=3  order by prod_nombre asc limit 20";

}


?>


<div align="center">
    <strong class="css_cantidad">PROFESIONAL:</strong>
     
	 <select name="usua_idfacval" id="usua_idfacval">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select app_usuario.usua_id,usua_apellido,usua_nombre from app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace where app_usuario.usua_estado=1 and dns_gridfuncionprofesional.prof_id='".$_POST["prof_idval"]."' order by usua_apellido asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			if($usua_idfacval==$rs_gogessform->fields["usua_id"])
			{
			echo '<option value="'.$rs_gogessform->fields["usua_id"].'" selected="selected" >'.$rs_gogessform->fields["usua_apellido"].' '.$rs_gogessform->fields["usua_nombre"].'</option>';
			}
			else
			{
			echo '<option value="'.$rs_gogessform->fields["usua_id"].'">'.$rs_gogessform->fields["usua_apellido"].' '.$rs_gogessform->fields["usua_nombre"].'</option>';
			}
			
			$rs_gogessform->MoveNext();
			}
		}	  
	  ?> 
    </select>
 
  
  <br><br>
</div>


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

    <td onClick="agregar_insumo('<?php echo $rs_data->fields["prod_id"]; ?>',$('#usua_idfacval').val(),'<?php echo $_POST["prof_idval"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td><b><?php echo $rs_data->fields["prod_codigo"]; ?></b></td>
    <td><b><?php echo $rs_data->fields["prod_nombre"]; ?></b></td>

	<?php

	$valor_precio=0;
	$valor_precio=$rs_data->fields["prod_precio"];
	
    if($gconve_precio>0)
	{
	    //$saca_descuentovalor=($conve_descuento*$rs_data->fields["prod_precio"])/100;
	    $valor_precio=$gconve_precio;
	}
	?>

    <td nowrap="nowrap"><b>$ <?php echo $valor_precio; ?></b></td>

    

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