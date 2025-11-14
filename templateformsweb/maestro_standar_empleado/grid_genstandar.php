<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$listav_camposobl='';

?>
<style type="text/css">
<!--

.txt_titulo {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	border: 1px solid #666666;			
 }

.txt_txt {

	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #666666;			
 }
.Estilo1 {font-size: 10px}
-->
</style>
<?php
$objformulario= new  ValidacionesFormulario();

$test_id=$_POST["fie_id"];
$obtiene_test="select * from appg_test where test_id='".$test_id."'";
$rs_test= $DB_gogess->executec($obtiene_test,array());

$funcion_ejecuta=$rs_test->fields["test_funcion"];

//tabla_grid
$sub_tabla=$rs_test->fields["test_nombrebase"].".".$rs_test->fields["test_ntabla"];

$nombre_tabla=$rs_test->fields["test_ntabla"];
$separa_subindex=explode("_",$nombre_tabla);
$sub_index = substr($separa_subindex[1], 0, 4)."_";

//id tabla grid
$campo_id=$sub_index."id";
$fecha_registro=$sub_index."fecharegistro";

     $listav_campos='';
     $listavtitulos_campos='';
     $listav_camposfecha='';
     //busca campos
     $lista_campos="select * from appg_escala where test_id='".$test_id."'";
     $rs_lcampos= $DB_gogess->executec($lista_campos,array());
     if($rs_lcampos)
     {
        while (!$rs_lcampos->EOF)
			{
			    
			  $listav_campos.=$rs_lcampos->fields["esca_nameid"].",";
        	  $listavtitulos_campos.=$rs_lcampos->fields["esca_nombre"].",";
        	  if($rs_lcampos->fields["esca_obligatorio"]==1)
        	  {
        	  $listav_camposobl.=$rs_lcampos->fields["esca_nameid"].",";
        	  } 
        	  if($rs_lcampos->fields["tipda_id"]==2)
        	  {
        	    $listav_camposfecha.=$rs_lcampos->fields["esca_nameid"].",";
        	  }
			    
			  $rs_lcampos->MoveNext();  
			}
     }		



//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$listav_campos);
$campos_datainserta=array();
$campos_datainserta=explode(",",$listav_campos);


//subtablas
//campo enlace
$campo_enlace='';
$campo_enlace='standar_enlace';
//fecha registro grid
$campo_fecharegistro='';
$campo_fecharegistro=$fecha_registro;

//titulos
$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$listavtitulos_campos);

//lista
$fie_camposgridselect=array();
$fie_camposgridselect=explode(",",$listav_campos);
//print_r($fie_camposgridselect);

if($_POST["opcion"]==2)
{
 $borra_reg="delete from ".$sub_tabla." where ".$campo_enlace."='".$_POST["enlace"]."' and ".$campo_id."=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());
}


if($_POST["opcion"]==1)
{


		if($_POST[$campo_id."x"]>0)
			{
			 $sql_edita='';
			 $sql_edita=$objvarios->genera_updategriddata($sub_tabla,$campo_id,$_POST[$campo_id."x"],$_POST,$campos_datainserta);
			 $rs_edita = $DB_gogess->executec($sql_edita,array());
			
			}
			else
			{
			 $rs_inserta ='';
			 $sql_inserta=$objvarios->genera_insertempleado($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d H:i:s"),$_POST,$campos_datainserta);
			 $rs_inserta = $DB_gogess->executec($sql_inserta,array());
			
			}



}
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td style="background-color:#5586B7; color:#FFFFFF" >Eliminar</td>
	<td style="background-color:#5586B7; color:#FFFFFF" >Editar</td>
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
	    if($fie_tituloscamposgrid[$i])
	    {
        echo '<td style="background-color:#5586B7; color:#FFFFFF" >'.utf8_encode($fie_tituloscamposgrid[$i]).'</td>';
	    }
	 }
	?>
	<td style="background-color:#5586B7; color:#FFFFFF" >Fecha Registro</td>
	<td style="background-color:#5586B7; color:#FFFFFF" >Usuario Registra</td>
  </tr>
<?php
$cuenta=0;

$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."'";


//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
    <td onClick="grid_extras_<?php echo $test_id; ?>('<?php echo $rs_data->fields[$campo_enlace]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td onClick="grid_editar_<?php echo $test_id; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>
	<?php
	
	$lista_campos="select * from appg_escala where test_id='".$test_id."'";
     $rs_lcampos= $DB_gogess->executec($lista_campos,array());
     if($rs_lcampos)
     {
        while (!$rs_lcampos->EOF)
			{
			    if($rs_lcampos->fields["tipc_id"]==3)
			    {
			         $dato_valor='';
		             $dataval=array();
		             $dataval=explode(",",$rs_lcampos->fields["esca_camposdata"]);
			         
			         $busca_valor="select ".$rs_lcampos->fields["esca_camposdata"]." from ".$rs_lcampos->fields["esca_tablatomadato"]." where ".$dataval[0]."='".$rs_data->fields[$rs_lcampos->fields["esca_nameid"]]."';";
		             $rs_bval = $DB_gogess->executec($busca_valor,array());
		             $dato_valor=$rs_bval->fields[$dataval[1]];
		             echo '<td>'.utf8_encode($dato_valor).'</td>';
		             
			    }
			    else
			    {
			        if($rs_lcampos->fields["tipc_id"]==6)
            		  {
            		    if($rs_data->fields[$rs_lcampos->fields["esca_nameid"]])
						{
						  echo '<td><a href="'.$rs_lcampos->fields["esca_patharchivo"].$rs_data->fields[$rs_lcampos->fields["esca_nameid"]].'" target="_blank"><img src="images/file.png" width="32" height="38" /></a></td>';
            		    }
						else
						{
						  echo '<td></td>';
						}
					  }
            		  else
			         {
			           echo '<td>'.$rs_data->fields[$rs_lcampos->fields["esca_nameid"]].'</td>';
			         }
			    }
			    
			   $rs_lcampos->MoveNext();  
			}
     }		
	
	$obt_usuario="select * from app_usuario where usua_id='".$rs_data->fields["usua_id"]."'";
    $rs_usuario= $DB_gogess->executec($obt_usuario,array());
    
	echo '<td>'.$rs_data->fields[$fecha_registro].'</td>';
	echo '<td style="font-size:8px" ><b>'.$rs_usuario->fields["usua_nombre"].'</b></td>';
		?>
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
</div>
<script type="text/javascript">
<!--
<?php
echo $funcion_ejecuta;
?>
//  End -->
</script>

<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$test_id.'","divDialog_acsession'.$test_id.'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession'.$test_id.'"></div>
';

}
?>