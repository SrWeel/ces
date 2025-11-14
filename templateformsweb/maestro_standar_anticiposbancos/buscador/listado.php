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

$gridfield_id=$_POST["gridfield_id"];
$b_data=$_POST["b_data"];

//if($b_data)
//{

$obtine_data="select * from gogess_gridfield where 	gridfield_id='".$gridfield_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$gridfield_tablecmb=$rs_obtdata->fields["gridfield_tablecmb"];
$gridfield_camposcmb=$rs_obtdata->fields["gridfield_camposcmb"];
$gridfield_ordercmb=$rs_obtdata->fields["gridfield_ordercmb"];
$gridfield_nameid=$rs_obtdata->fields["gridfield_nameid"];
$gridfield_campoextrasbuscado=$rs_obtdata->fields["gridfield_campoextrasbuscado"];
$gridfield_filtrobuscador=$rs_obtdata->fields["gridfield_filtrobuscador"];

$lista_campos=array();
$lista_campos=explode(",",$gridfield_camposcmb.",".$gridfield_campoextrasbuscado);

$listabusqueda='';
for($i=1;$i<count($lista_campos);$i++)
	{
	   if($lista_campos[$i])
	   {   
	   $listabusqueda.=" ".$lista_campos[$i]." like '%".$b_data."%' or ";
	   }
	}

$listabusqueda=substr($listabusqueda.$sql100,0,-3);

if($gridfield_filtrobuscador)
{
$lista_sql="select * from ".$gridfield_tablecmb."  where (".$listabusqueda.") and ".$gridfield_filtrobuscador;
}
else
{
$lista_sql="select * from ".$gridfield_tablecmb."  where (".$listabusqueda.") ";
}
$rs_lcanp = $DB_gogess->executec($lista_sql,array());
?>
<table border="1" align="center">
<?php
if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
?>
  <tr>
    <td style="font-size:10px"><input type="button" name="Submit" value="Sel" onClick="seleccionar_regn('<?php echo $rs_lcanp->fields[$lista_campos[0]]; ?>')"></td>
	<?php
	for($i=1;$i<count($lista_campos);$i++)
	{
	  if($lista_campos[$i])
	  {
	   echo '<td style="font-size:10px" >'.utf8_decode($rs_lcanp->fields[$lista_campos[$i]]).'</td>';
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
function seleccionar_regn(valor)
{
   
   $('#<?php echo $gridfield_nameid ?>').val(valor);
   
   <?php
   if($gridfield_id=='1863')
   {
   
   echo '
   llenar_dataproducto();';
   
   }
   ?>

}
//  End -->
</script>LLLL

<?php
//}

?>