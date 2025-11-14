<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$cuenta=999;
$secuencial_i=2499;

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
require_once "Classes/PHPExcel.php";
$archdt_fila='1';

$busca_archivo="select * from lpin_tomafisica where tomfis_id='".$_POST["tomfis_id"]."'";
$rs_barchivo = $DB_gogess->executec($busca_archivo,array());

$tomfis_enlace=$rs_barchivo->fields["tomfis_enlace"];
$tomfis_procesado=$rs_barchivo->fields["tomfis_procesado"];

if($tomfis_procesado==1)
{
  
  echo "<br><center><b>Ya fue procesada...no puede volver a cargar los registros</b></center>";

}
else
{

$borra_volveracargar="delete from lpin_ajusteproducto where tomfis_enlace='".$tomfis_enlace."'";
$rs_vv = $DB_gogess->executec($borra_volveracargar,array());

///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$barchivo=$rs_barchivo->fields["tomfis_archivo"];
$centro_id=$rs_barchivo->fields["centro_id"];

$centro_idformulario=0;
$centro_idformulario=$rs_barchivo->fields["centro_id"];

if($centro_id==1)
{
  $centro_id=55;
}

$nombre_archivo=$barchivo;
$url = "../../archivoinv/".$nombre_archivo;
$archdt_fila='1';


$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);

//print_r($sheetnames);
$index_data=0;
for($ival=0;$ival<(count($sheetnames));$ival++)
{
  if($sheetnames[$ival]=='TERRESTRE')
  {
     $index_data=$ival;
   }

}



$index_val=$index_data;
$worksheet = $excelObj->getSheet($index_val);
$maxCell = $worksheet->getHighestRowAndColumn();
$data = $worksheet->rangeToArray('A'.$archdt_fila.':' . $maxCell['column'] . $maxCell['row']);
$data = array_map('array_filter', $data);

$cuenta_real=0;
$cuenta_real=count($data); 
$cuenta_real=$maxCell['row'];

//print_r($data);

$letras_leer="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W";
$array_letra=explode(",",$letras_leer);


//leer cabecera
$bodega_procesa=0;
$cuentad=0;
for($i=2;$i<=2;$i++)
{
   //print_r($data[$i]); 
   $bodega_procesa=$data[$i][0];
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++
if($centro_idformulario==$bodega_procesa)
{
//valida datos
$hay_valor=0;
$acumula_fila='';
$mensaje_extra='';
for($i=4;$i<count($data);$i++)
{
  //echo $data[$i][11]."<br>";
  $lista_nproductoy="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".trim(@$data[$i][2])."'";
  $rs_nproductoy = $DB_gogess->executec($lista_nproductoy,array());
  
  $cuadrobm_id_bu=0;
  $cuadrobm_id_bu=$rs_nproductoy->fields["cuadrobm_id"];
  
  //__________________________________________________
  if($cuadrobm_id_bu>0)
  {
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  if(@$data[$i][2]!='')
  {
  
   if(@$data[$i][0])
		{ 
			 if(@$data[$i][11]>=0)
			 {
			    
			 } 
			 else
			 {
			 //echo "----<br>".@$data[$i][11]."----<br>";
			    $hay_valor=1;
				$fila=$i+1;
				$acumula_fila.=$fila.' SIN VALOR - ';
			 
			 }
        }
	else
	{
	    $hay_valor=1;	
		$fila=$i+1;
		$acumula_fila.=$fila.'SIN VALORES - ';	  
	}
	
  }
  else
  {
        $hay_valor=1;	
		$fila=$i+1;
		$acumula_fila.=$fila.' SIN CODIGO - ';  
  } 
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!111
   }
   else
   {
        $hay_valor=1;	
		$fila=$i+1;
		$acumula_fila.=$fila.' CODIGO NO EXISTE - ';  
   
   } 		
  //__________________________________________________
  
  
}

if($hay_valor==1)
{
  echo "ALERTA FILAS SIN VALORES<br>";
  echo $acumula_fila;

}
//valida datos



//echo "CORRECTO";
if($hay_valor==0)
{
//=======================================//=========================
     
for($i=4;$i<count($data);$i++)
{
   //print_r($data[$i]); 
   
  if(@$data[$i][0])
		{


 
 if(@$data[$i][11]>0)
 {

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
$tomfis_enlace=$rs_barchivo->fields["tomfis_enlace"];	
$lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".trim(@$data[$i][2])."'";
$rs_nproducto = $DB_gogess->executec($lista_nproducto,array());  
	
$cuadrobm_id=$rs_nproducto->fields["cuadrobm_id"];	
$datos_produ="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());
$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);
$busca_und="select uniddesg_id from dns_principalstockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."' order by stock_id  desc limit 1";
$rs_und = $DB_gogess->executec($busca_und);
$unid_idx=$rs_und->fields["uniddesg_id"];
	
	$unid_id=$unid_idx;	
	$ajuspr_cantidad=$rs_stactua->fields["stactual"];	
	$ajuspr_creal=@$data[$i][11];	

//calcula data
$ajuspr_diferencia=$ajuspr_cantidad-$ajuspr_creal;
//calcula data
   
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$ajuspr_fecharegistro=date("Y-m-d H:i:s");	 


if($cuadrobm_id>0)
{		  

if(!($unid_id))
{
  $unid_id=1;
}
$ingresa_pro="INSERT INTO lpin_ajusteproducto ( tomfis_enlace,cuadrobm_id, unid_id, ajuspr_cantidad, ajuspr_creal, ajuspr_diferencia, usua_id, ajuspr_fecharegistro) VALUES ('".$tomfis_enlace."','".$cuadrobm_id."','".$unid_id."','".$ajuspr_cantidad."','".$ajuspr_creal."','".$ajuspr_diferencia."','".$usua_id."','".$ajuspr_fecharegistro."')";


$rs_und = $DB_gogess->executec($ingresa_pro);
echo ".";	
	  
}
else
{
echo trim(@$list_d[1])."<br>";

}


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}
 



    }
   
   
   
}	 
	 
//=======================================//=========================
}
else
{
  echo "<br>EXISTEN ERRORES EN EL ARCHIVO";
  ?>
  <script type="text/javascript">
<!--
 
 alert("Alert: EL ARCHIVO TIENE ERRORES");
 
//  End -->
</script>
<?php
}

	 

}
else
{

?>
<script type="text/javascript">
<!--
 
 alert("Alert: EL ARCHIVO NO PERTENCE A LA BODEGA SELECIONADA");
 
//  End -->
</script>
<?php

}
//+++++++++++++++++++++++++++++++++++++++++++++++++++


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}


?>