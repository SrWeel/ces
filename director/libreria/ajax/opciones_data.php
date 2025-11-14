<?php
ini_set("session.gc_maxlifetime","14400");
session_start();

?>

<?php
//Llamando objetos
$director="../../";

include("../../cfgclases/clases.php");
//Conexion a la base de datos

$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

$listagrid="select * from gogess_subgrid where subgri_id=".$_POST["psubgri_id"];
	
	$resultgrid = $DB_gogess->Execute($listagrid);	
	if($resultgrid)
	{	
	   while (!$resultgrid->EOF) 
	   {
	   
	     $table_b=$resultgrid->fields["subgri_nameenlace"];
		 $campoenc_b=$resultgrid->fields["subgri_campoenlace"];
		 $tipoenlace_b=$resultgrid->fields["subgri_tipoenlace"];		 
		 $subgri_campoidts_b=$resultgrid->fields["subgri_campoidts"];
	   
	//////////////////////////////////////////////     
		 $listacampos="select * from gogess_sisfield where tab_name like '".$resultgrid->fields["subgri_nameenlace"]."' and fie_activogrid=1";
//echo $listacampos;
$resultarreglo = $DB_gogess->Execute($listacampos);
$cami=0;
if($resultarreglo)
{
   while (!$resultarreglo->EOF) 
	   {
	   
	    $variables_uni[$cami][1]=$resultarreglo->fields["fie_name"];
		
		if($resultarreglo->fields["field_type"]!='int')
		{
		$variables_uni[$cami][2]='texto';
		}
		else
		{
		$variables_uni[$cami][2]='int';
		}
			
		$variables_uni[$cami][3]='';
		$cami++;
	    $resultarreglo->MoveNext();
	   }
}

	/////////////////////////////////////////////	 
		 
		 
	    $resultgrid->MoveNext();
		 
	   }
	 }  

//campos
   
		
		$tablainserta=$resultgrid->fields["subgri_nameenlace"];
		
//campos

if ($_POST["popcion"]==1)
{
    for($i=0;$i<count($variables_uni);$i++)
	{
	   
		  
		   $campos=$campos.$variables_uni[$i][1].",";
		   $camposval=$camposval."'".$_POST["p".$variables_uni[$i][1]]."',";

	
	}
	$campos=substr($campos,0,-1);
	$camposval=substr($camposval,0,-1);
	
    $sqlinsertar="insert into ".$table_b." (".$campoenc_b.",".$campos.") VALUES (".$_POST["p".$campoenc_b."_uni"].",".$camposval.")";
	//echo $sqlinsertar;
	$DB_gogess->Execute($sqlinsertar);
	
	
}


if($_POST["popcion"]==2)
{
   
	$borrarotorgante="delete from ".$table_b." where ".$subgri_campoidts_b."=".$_POST["p".$subgri_campoidts_b]."";
	$DB_gogess->Execute($borrarotorgante);
	
	
	
	
}

?>
