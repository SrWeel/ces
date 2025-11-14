<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$fie_id=$_POST["fie_id"];
$b_data=$_POST["b_data"];

//if($b_data)
//{

$obtine_data="select * from gogess_sisfield where 	fie_id='".$fie_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$fie_tabledb=$rs_obtdata->fields["fie_tabledb"];
$fie_datadb=$rs_obtdata->fields["fie_datadb"];
$fie_sqlorder=$rs_obtdata->fields["fie_sqlorder"];
$fie_name=$rs_obtdata->fields["fie_name"];
$gridfield_campoextrasbuscado=$rs_obtdata->fields["fie_camposbusca"];
$gridfield_filtrobuscador=$rs_obtdata->fields["fie_campodevuelve"];

$lista_campos=array();
$lista_campos=explode(",",$fie_datadb.",".$gridfield_campoextrasbuscado);

$listabusqueda='';
for($i=1;$i<count($lista_campos);$i++)
	{
	   if($lista_campos[$i])
	   {   
	   $listabusqueda.=" ".$lista_campos[$i]." like '%".$b_data."%' or ";
	   }
	}

$listabusqueda=substr($listabusqueda.$sql100,0,-3);

$sql_quita='';
if($fie_tabledb=='app_proveedor')
{
  $sql_quita=' provee_borradologico=0 and ';
}


if($b_data!='')
{
$lista_sql="select * from ".$fie_tabledb."  where ".$sql_quita." provee_cedula like '".$b_data."%'";
$lista_sqlcount="select count(*) as total from ".$fie_tabledb."  where ".$sql_quita." provee_cedula like '".$b_data."%'";
}

//echo $lista_sql;
$rs_lcanp = $DB_gogess->executec($lista_sql,array());

//cantidad
$rs_lcanpcount = $DB_gogess->executec($lista_sqlcount,array());
//cantidad
?>
<?php
if($rs_lcanpcount->fields["total"]>0)
{
?>
<span style="color:#FF0000"><center><b>Alerta!!! Persona ya existe seleccione para continuar</b></center></span>
<?php
}
?>
<table border="1" align="center">
<?php
if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
?>
  <tr>
    <td style="font-size:10px"><input type="button" name="Submit" value="Sel" onClick="ver_editformencexiste('<?php echo $rs_lcanp->fields[$lista_campos[0]]; ?>')"></td>
	<?php
	for($i=1;$i<count($lista_campos);$i++)
	{
	  if($lista_campos[$i])
	  {
	   echo '<td style="font-size:10px" >'.$rs_lcanp->fields[$lista_campos[$i]].'</td>';
	   }
	}
	?>    
  </tr>
<?php
        $rs_lcanp->MoveNext();
     }
  } 
?>  
</table>

<script type="text/javascript">
<!--


function ver_editformencexiste(valor)
{

$("#div_formdata").load("aplicativos/documental/opciones/grid/standarformprov/grid_nuevo_standarform.php",{
 
 fie_id:'<?php echo $fie_id; ?>',
 valor:valor

 },function(result){       


  });  

$("#div_formdata").html("Espere un momento...");

}

<?php
if($rs_lcanpcount->fields["total"]>0)
{
?>
alert("Alerta!!! Persona ya existe seleccione para continuar");
<?php
}
?>



//  End -->
</script>

<?php
//}

?>