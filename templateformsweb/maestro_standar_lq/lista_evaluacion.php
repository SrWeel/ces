<?php
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{


$sql1='';

//echo $_SESSION['ces1313777_sessid_emp_id'];
if(@$_SESSION['ces1313777_sessid_emp_id'])
{

   $sql2="emp_id = ".@$_SESSION['ces1313777_sessid_emp_id']." and dns_atencionevaluacion.centro_id=".$_SESSION['ces1313777_centro_id']." and repres_ci='".trim($_POST["ci_paga"])."'  and ";

}

$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);

if($concatenado)
{



	 $lista_prductos="select eteneva_id,prod_precio,clie_nombre,clie_apellido,prod_id,eteneva_id,app_cliente.clie_id from dns_atencionevaluacion inner join app_cliente on dns_atencionevaluacion.clie_id=app_cliente.clie_id  

	inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace

	 where ".$concatenado." order by eteneva_id desc";

	 



}

//echo  $lista_prductos;
?>

<table width="450" border="0" align="center" cellpadding="2" cellspacing="1">
<?php

$rs_data = $DB_gogess->executec($lista_prductos,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	

	  
          //busca tipo cliente

$lista_clit="select distinct tipopac_id from app_cliente where clie_id='".trim($rs_data->fields["clie_id"])."'";
$rs_clit = $DB_gogess->executec($lista_clit,array());
if($rs_clit)
 {
	  while (!$rs_clit->EOF) {	
        
		$tipopac_id=$rs_clit->fields["tipopac_id"];

             $rs_clit->MoveNext();	   
	  }
  }

//---------------------------------------
    $valor_precioc='';
    $valor_precioc='prod_precio';
	switch ($tipopac_id) {
    case 1:
        $valor_precioc="prod_precioisfa";
        break;
    case 2:
        $valor_precioc="prod_precio";
        break;
    case 3:
        $valor_precioc="prod_precioconvenio";
        break;
	case 4:
        $valor_precioc="prod_precioconveniohermano";
        break;	
	case 5:
        $valor_precioc="prod_preciopolicia";
        break;
	case 6:
        $valor_precioc="prod_preciomilitar";
        break;		
	case 7:
        $valor_precioc="prod_preciomilitar";
        break;	
	case 8:
        $valor_precioc="prod_preciomilitar";
        break;	
	case 9:
        $valor_precioc="prod_apadrinado";
        break;					
    }




//---------------------------------------


          //busca tipo cliente
 
	  $ver_prductos="select * from efacsistema_producto where prod_id=".$rs_data->fields["prod_id"];
	  $rs_dproductos = $DB_gogess->executec($ver_prductos,array());

	  $ver_grupo="select * from faesa_asigahorario inner join faesa_grupos on faesa_asigahorario.grup_id=faesa_grupos.grup_id where eteneva_id=".$rs_data->fields["eteneva_id"];
	  $rs_vergrupo = $DB_gogess->executec($ver_grupo,array());
	  
	  //busca hora
	  $busca_hora="select * from faesa_integragrupo where grup_id=".$rs_vergrupo->fields["grup_id"]." order by integr_hora asc limit 1";
      $rs_bhora = $DB_gogess->executec($busca_hora,array());
	  

	  $nombre_pro='';
	  $nombre_pro=$rs_data->fields["clie_nombre"]." ".$rs_data->fields["clie_apellido"]."<br>".$rs_dproductos->fields["prod_nombre"]."<br>".$rs_vergrupo->fields["asighor_fecha"]."<br>".$rs_vergrupo->fields["grup_nombre"]." Hora: ".$rs_bhora->fields["integr_hora"];
	  
	  
    //busca si ya fue facturado
	  $busca_facturado="select * from  beko_lqdetalle where eteneva_id=".$rs_data->fields["eteneva_id"]."";
      $rs_bfacturado = $DB_gogess->executec($busca_facturado,array());
	  
	  $yafacturado=0;
	 // echo $rs_bfacturado->fields["docdet_id"];
	  if($rs_bfacturado->fields["docdet_id"]>0)
	  {  
	     $yafacturado=1;
	  }
	  
	  if($rs_bhora->fields["integr_hora"])
	  {
	  
	     if($yafacturado==0)
		 {
?>

  <tr bgcolor="#EFF3F5">
    <td onClick="agregar_evaluacion('<?php echo $rs_data->fields["eteneva_id"]; ?>','<?php echo trim($_POST["ci_paga"]); ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td><b><?php echo utf8_encode($nombre_pro); ?></b></td>
	<?php
	    $valor_precio=0;
        $valor_precio=$rs_dproductos->fields[$valor_precioc];
	?>
    <td><b>$ <?php echo $valor_precio; ?></b></td>
  </tr>
<?php
        }
      }

$rs_data->MoveNext();	   
	  }
  }
?>  

</table>

<?php





}

?>