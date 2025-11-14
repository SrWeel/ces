<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if($_SESSION['sessidadm1777_pichincha'])
{
$director='../../';
include("../../cfgclases/clases.php");

$nombre_archivo="";
$url = "plan.csv";


function buscar_linea($codigo,$DB_gogess)
{
  $lista_code=array();
  $lista_code=explode(".",$codigo);  
  $cantidad_c=count($lista_code);
  
  $id_registrp='';
  
  if($cantidad_c==1)
  {
      $busca_coce="select * from lpin_plancuentas where planc_codigo='".$lista_code[0]."' and plancs_id=0";
	  $rs_coce = $DB_gogess->Execute($busca_coce);
	  $id_registrp=$rs_coce->fields["planc_id"];  
  }
  else
  {
  
  
  
  }
  
  for($i=0;$i<count($lista_code);$i++)
  {
     
	 //$busca_coce="select * from lpin_plancuentas where planc_codigo='".$lista_code[$i]."' and "
    
  } 
  
  return $id_registrp;

}


function despliega_int($plancs_id,$codigo_m,$DB_gogess)
{
   
	$lista_pla="select * from lpin_plancuentas where plancs_id='".$plancs_id."'";
	$rs_plan = $DB_gogess->Execute($lista_pla);
	if($rs_plan)
	  {
		  while (!$rs_plan->EOF) {
		  			
			$GLOBALS["listas_plan"].= $codigo_m.".".$rs_plan->fields["planc_codigo"]."|".$rs_plan->fields["planc_id"]."|".$rs_plan->fields["planc_nombre"]."=";
			
			
			//==========================
			$lista_placuenta="select count(*) as t from lpin_plancuentas where plancs_id='".$rs_plan->fields["planc_id"]."'";
	        $rs_plancuenta = $DB_gogess->Execute($lista_placuenta);
			//========================== 
			 if($rs_plancuenta->fields["t"]>0)
			 {
			 despliega_int($rs_plan->fields["planc_id"],$codigo_m.".".$rs_plan->fields["planc_codigo"],$DB_gogess);
		     }
			 
			$rs_plan->MoveNext();
		  }
	  }	  
	  else
	  {
	   return 1;
	  }

}



function busca_idc($lista_c,$cuenta,$DB_gogess)
{
    

	$lista_pla="select * from lpin_plancuentas where plancs_id=0";
	$rs_plan = $DB_gogess->Execute($lista_pla);
	if($rs_plan)
	  {
		  while (!$rs_plan->EOF) {
		  
		  
			$GLOBALS["listas_plan"].=$rs_plan->fields["planc_codigo"]."|".$rs_plan->fields["planc_id"]."|".$rs_plan->fields["planc_nombre"]."=";			
			despliega_int($rs_plan->fields["planc_id"],$rs_plan->fields["planc_codigo"],$DB_gogess);
			   
		  
			$rs_plan->MoveNext();
		  }
	  }	  
	
	
	$lista_c=array();
	$lista_c=explode("=",$GLOBALS["listas_plan"]);
  
  
   $id_valor='';
   for($i=0;$i<count($lista_c);$i++)
   {     
	 $arreglo_n=array();
	 $arreglo_n=explode("|",$lista_c[$i]);
	 if($cuenta==$arreglo_n[0])
	 {
	   $id_valor=$arreglo_n[1];	 
	 }   
   }
   
   return $id_valor;

}

//echo busca_idc($lista_c,'1.1.1.3');

function quita_unnivel($cuenta_string)
{
  $lista_array=array();
  $lista_array=explode(".",$cuenta_string);
  $concatena='';
  for($i=0;$i<count($lista_array)-1;$i++)
  {
     $concatena.=$lista_array[$i]."."; 
  
  }
  
  return substr($concatena,0,-1);
  
}


$cl=0;
$fp = fopen($url, "r");
while (!feof($fp)){
        
	    $cl++;
	    $linea = fgets($fp);	
        $array_fila=array();
	    $array_fila=explode(",",$linea);
		
        //print_r($array_fila);
	   
	    //obtiene los puntos
		$cuenta_string='';
		$cuenta_string=$array_fila[0];
		$code_plam=explode(".",$array_fila[0]);
		$nombre=$array_fila[1];
		
		if(count($code_plam)==1)
		{
		  echo "Principal:".$nombre."<br>";
		  //inserta datos
		  $planc_codigo=$code_plam[0];
		  $planc_nombre=trim($nombre);
		  $insert_data="insert into lpin_plancuentas(planc_codigo,planc_nombre) values ('".$planc_codigo."','".$planc_nombre."');";
		  echo $insert_data."<br>";
		  $rs_plan1 = $DB_gogess->Execute($insert_data);
		  //inserta datos
		}
		else
		{
		   $listas_plan='';
		   
		   //$nivels=substr($cuenta_string,0,-2);
		   
		   $nivels=quita_unnivel($cuenta_string);
		   
		   echo "Superior code:".$nivels."<br>";
		   $id_reg='';
		   $id_reg=busca_idc($lista_c,trim($nivels),$DB_gogess);
		   
		   $code_f=array();
		   $code_f=explode(".",$cuenta_string);
		   
		   $cuenta_n=count($code_f)-1;
		   
		   $planc_codigo=$code_f[$cuenta_n];
		   $planc_nombre=trim($nombre);
		   
		   $insert_data="insert into lpin_plancuentas(planc_codigo,planc_nombre,plancs_id) values ('".$planc_codigo."','".$planc_nombre."','".$id_reg."');";
		   $rs_plan2 = $DB_gogess->Execute($insert_data);
		   echo $insert_data."<br>";
		     
		}
		
		//obtiene los puntos
	   
	   
}


}

?>