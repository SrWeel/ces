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
$frocob_id=$_POST["frocob_id"];


function busca_conarbol($cuenta,$DB_gogess)
{
    $busca_detalles="select count(*) as total from lpin_plancuentas_vista where  planc_codigocp like '".$cuenta.".%'";
	
	$rs_stotales = $DB_gogess->executec($busca_detalles,array());
   
    return $rs_stotales->fields["total"]-1;

}

$obtiene_solodetalles="";
$listadiariox="select * from lpin_plancuentas order by planc_orden asc";
$rs_listadiariox = $DB_gogess->executec($listadiariox,array());
 if($rs_listadiariox)
 {
     while (!$rs_listadiariox->EOF) {
	    
		$cantidadd_valord=0;
	    $cantidadd_valord=busca_conarbol($rs_listadiariox->fields["planc_codigoc"],$DB_gogess);
		
		if($cantidadd_valord==0)
		{
		
		    $obtiene_solodetalles.="'".$rs_listadiariox->fields["planc_codigoc"]."',";
			 
		}
	 
	 
	    $rs_listadiariox->MoveNext();	
	} 
 }  
$paralista_sql='';
$paralista_sql=$obtiene_solodetalles."'p'"; 


//if($b_data)
//{

$obtine_data="select * from gogess_sisfield where fie_id='".$fie_id."'";
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

	  

$sql_filtro='';
if($fie_tabledb=='lpin_plancuentas')
{
  
  $sql_filtro='';
  $filtro_cuenta='';
  $bandera='';
  $busca_filtro="select * from lpin_formadecobro where frocob_id='".$frocob_id."'";
  $rs_filtro = $DB_gogess->executec($busca_filtro,array());
  
  if($rs_filtro)
  {
	  while (!$rs_filtro->EOF) {	
	     
		 if($rs_filtro->fields["frocob_cuentas"])
		 {
		  $bandera='1';
	      $filtro_cuenta=explode(",",$rs_filtro->fields["frocob_cuentas"]);
	     }
		 
	     $rs_filtro->MoveNext();
	  }
  }	 
  
  //print_r($filtro_cuenta);
  if($bandera=='1')
  {
	  for($i=0;$i<count($filtro_cuenta);$i++)
	   {
		 
		   $sql_filtro.="'".$filtro_cuenta[$i]."',";
	   
	   }
	  
	  $sql_filtro=substr($sql_filtro,0,-1);
	  
	  $sql_filtro=" planc_codigoc in (".$sql_filtro.") and ";
	  
  }	  
  
}

$sql_filtro_f="";
$ordena_data="";
if($fie_tabledb=='lpin_plancuentas')
{
  $sql_filtro_f=" planc_codigoc in (".$paralista_sql.") and ";
  $ordena_data=" order by planc_orden asc ";
  
}

if($gridfield_filtrobuscador)
{
$lista_sql="select * from ".$fie_tabledb."  where ".$sql_filtro_f." ".$sql_filtro." (".$listabusqueda.") and ".$gridfield_filtrobuscador." ".$ordena_data;
}
else
{
$lista_sql="select * from ".$fie_tabledb."  where ".$sql_filtro_f." ".$sql_filtro." (".$listabusqueda.") ".$ordena_data;
}

//echo $lista_sql;

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
function seleccionar_regn(valor)
{
   
   $('#<?php echo $fie_name ?>').val(valor);
   //llena_cliente();

}
//  End -->
</script>

<?php
//}

?>