<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
date_default_timezone_set("America/Guayaquil");

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objvarios=new util_funciones();

require_once "Classes/PHPExcel.php";
$archdt_id=$_POST["archdt_id"];

$busca_archivo="select * from conco_archivosdata where archdt_id='".$archdt_id."'";
$rs_archivo = $DB_gogess->executec($busca_archivo);

$lista_mes=array();

$lista_mes[1]='ENERO';
$lista_mes[2]='FEBRERO';
$lista_mes[3]='MARZO';
$lista_mes[4]='ABRIL';
$lista_mes[5]='MAYO';
$lista_mes[6]='JUNIO';
$lista_mes[7]='JULIO';
$lista_mes[8]='AGOSTO';
$lista_mes[9]='SEPTIEMBRE';
$lista_mes[10]='OCTUBRE';
$lista_mes[11]='NOVIEMBRE';
$lista_mes[12]='DICIEMBRE';


$lista_mesnom['ENERO']=1;
$lista_mesnom['FEBRERO']=2;
$lista_mesnom['MARZO']=3;
$lista_mesnom['ABRIL']=4;
$lista_mesnom['MAYO']=5;
$lista_mesnom['JUNIO']=6;
$lista_mesnom['JULIO']=7;
$lista_mesnom['AGOSTO']=8;
$lista_mesnom['SEPTIEMBRE']=9;
$lista_mesnom['OCTUBRE']=10;
$lista_mesnom['NOVIEMBRE']=11;
$lista_mesnom['DICIEMBRE']=12;


$archdt_anio=$rs_archivo->fields["archdt_anio"];
$archdt_mes=$rs_archivo->fields["archdt_mes"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];

$days_in_month =0;
$days_in_month = cal_days_in_month(CAL_GREGORIAN,$archdt_mes,$archdt_anio);


$archdt_fila=$rs_archivo->fields["archdt_fila"];
$tiparch_id=$rs_archivo->fields["tiparch_id"];

$busca_ntabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_archivo->fields["tiparch_id"]."'";
$rs_ntabla = $DB_gogess->executec($busca_ntabla);
$nombre_tabla=$rs_ntabla->fields["tiparch_ntabla"];

//vacida datos
$vacia_data="delete from ".$nombre_tabla." where archdt_id='".$archdt_id."'";
$rs_vaciadata = $DB_gogess->executec($vacia_data);

///borra asignado
$vacia_data="delete from conco_asiganhextras where archdt_id='".$archdt_id."'";
$rs_vaciadata = $DB_gogess->executec($vacia_data);



$seguir_pasox=1;



$busca_datosing="select * from ".$nombre_tabla." where archdt_id='".$archdt_id."'";
$rs_datossing = $DB_gogess->executec($busca_datosing);

$horas_id=$rs_datossing->fields["horas_id"];

if($horas_id>0)
{
  if($seguir_pasox==1)
  {
  echo "Archivo ya fue procesado...";
  ?>
  
<script type="text/javascript">
<!--
alert("Archivo ya fue procesado...");
//  End -->
</script>

  <?php
  }
  
  if($seguir_pasox==0)
  {
    echo "Archivo no corresponde al mes seleccionado...";
	?>
  
<script type="text/javascript">
<!--
alert("Archivo no corresponde al mes seleccionado...");
//  End -->
</script>

  <?php
  }
  
}
else
{
///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//vacia datos

$nombre_archivo="";
$url = "../../excel/".$rs_archivo->fields["archdt_archivo"];


$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);


$index_data=0;
for($ival=0;$ival<(count($sheetnames));$ival++)
{
  if($sheetnames[$ival]=='Hoja1')
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

$array_letra=array();
$array_tipo=array();
$contador_letra=0;
$lista_campos="select * from cmb_camposarch inner join appg_tipodata on cmb_camposarch.tipda_id=appg_tipodata.tipda_id where tiparch_id='".$tiparch_id."'";

$rs_lcampos = $DB_gogess->executec($lista_campos);
if($rs_lcampos)
 {
	  while (!$rs_lcampos->EOF) {
	     
		 $array_letra[$contador_letra]=$rs_lcampos->fields["crch_columnaexcel"];
		 $array_tipo[$contador_letra]=$rs_lcampos->fields["tipda_nombre"];
		 $array_nombrecampo[$contador_letra]=$rs_lcampos->fields["crch_nameid"];
		 
	     $contador_letra++;
	  
	  $rs_lcampos->MoveNext();
	  }
  }	
  
 $campos_data=implode(",",$array_nombrecampo); 
 //echo $campos_data;
 //print_r($array_letra);

      $inicio_val=0; 
      $row='';
	  for ($row = $archdt_fila; $row <= $cuenta_real; $row++) {
	      $datos=array();
		  
		  for ($ilet=0;$ilet<count($array_letra);$ilet++)
			{
				
				switch ($array_tipo[$ilet]) {
					case 'DATE':
					    {
						    $valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
							if($valorfecha)
							{
			                 $datos[$array_nombrecampo[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
							}
							else
							{
							 $datos[$array_nombrecampo[$ilet]] ='0000-00-00';
							}
						}
						break;
					case 'DATETIME':
						{
						    $date='';
							$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
						    $date = date_create($valorfecha);
							if($valorfecha)
							{
					          $datos[$array_nombrecampo[$ilet]]=@date_format($date, 'Y-m-d H:i:s');
							  if(!(trim($datos[$array_nombrecampo[$ilet]])))
							  {
							  $datos[$array_nombrecampo[$ilet]]=PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD hh:mm:ss");
							  }
							}
							else
							{
							$datos[$array_nombrecampo[$ilet]]='0000-00-00 00:00';
							}
						}
						break;
					case 'TIME':
						{
						    $date='';
							$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
						    $date = date_create($valorfecha);
							if($valorfecha)
							{
					         
							 $datos[$array_nombrecampo[$ilet]]=@date_format($date, 'H:i:s');
							 if(!(trim(($datos[$array_nombrecampo[$ilet]]))))
							 {
							 $datos[$array_nombrecampo[$ilet]]=PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "hh:mm:ss");
							 }
							 
							}
							else
							{
							 $datos[$array_nombrecampo[$ilet]]='00:00';
							}
						}
						break;	
				     case 'WITH DECIMALS':
						{
						
						    @$datos[$array_nombrecampo[$ilet]]=str_replace("'", "\'",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
							@$datos[$array_nombrecampo[$ilet]]=str_replace(",", "",@$datos[$array_nombrecampo[$ilet]]);
							if(@$datos[$array_nombrecampo[$ilet]]=='')
							  {
							  @$datos[$array_nombrecampo[$ilet]]='0';
							  }
						 
						}		
					 break;	
					default:
					   {
						  
						  @$datos[$array_nombrecampo[$ilet]]=str_replace("'", "\'",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
						  @$datos[$array_nombrecampo[$ilet]]=str_replace("-", "",@$datos[$array_nombrecampo[$ilet]]);
								
							if(@$datos[$array_nombrecampo[$ilet]]=='')
							  {
							  @$datos[$array_nombrecampo[$ilet]]='0';
							  }
							  
					   }
					   
				}
					   

			}
						
			$datos["archdt_anio"]=trim($archdt_anio);
			$datos["archdt_mes"]=$archdt_mes;
			$datos["usua_id"]=$usua_id;
			$datos["archdt_fecharegistro"]=date("Y-m-d H:i:s");
			$datos["archdt_id"]=$archdt_id;
		    $array_camposdata=array();
			$array_camposdata=explode(",",$campos_data.",archdt_anio,archdt_mes,usua_id,archdt_fecharegistro,archdt_id");
			$sql_inserta='';
			//echo $array_nombrecampo[0];
			//print_r($datos);
			if($datos[$array_nombrecampo[0]])
			{
			$sql_inserta=$objvarios->genera_insert_general($nombre_tabla,$datos,$array_camposdata);
			}
			//echo $sql_inserta."<br>";
			$rs_sitienedata = $DB_gogess->executec($sql_inserta);
		
	  
	  }

echo "<span style='color:#000000' >&nbsp;&nbsp;Processed File...</span>";

//sube datos

//echo $lista_mes[$archdt_mes];

//$archdt_anio

$seguir_paso=1;

$lista_buscando="select * from ".$nombre_tabla." where archdt_id='".$archdt_id."'";
$rs_buscal = $DB_gogess->executec($lista_buscando);

if($rs_buscal)
 {
	  while (!$rs_buscal->EOF) {
	  
	     if(trim($archdt_anio)==trim($rs_buscal->fields["horas_anio"]) and trim($lista_mes[$archdt_mes])==trim($rs_buscal->fields["horas_mes"]))
		 {		 
		 
		 }
	     else
		 {
		   $seguir_paso=0;
		 }		 
	  
	    $rs_buscal->MoveNext();
	  }
  }	

if($seguir_paso==1)
{
//procesa archivo y datos

$lista_buscando="select * from ".$nombre_tabla." where archdt_id='".$archdt_id."'";
$rs_buscal = $DB_gogess->executec($lista_buscando);

if($rs_buscal)
 {
	  while (!$rs_buscal->EOF) {
	  
$valor_mesdata=str_pad($archdt_mes, 2, '0', STR_PAD_LEFT);	  

$valoralet=mt_rand(1,50000);
$aletorioid='02'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;

$horas_cedula=$rs_buscal->fields["horas_cedula"];
$busca_daf="select * from app_usuario where usua_ciruc='".$horas_cedula."'";
$rs_buscadaf = $DB_gogess->executec($busca_daf);

$usua_idxd=$rs_buscadaf->fields["usua_id"];

if($usua_idxd>0)
{

//50%	  
if($rs_buscal->fields["horas_valorcincuenta"]>0)
{	  
$emp_id=1;
$usua_id=$usua_idxd;
$asigrhext_anio=$rs_buscal->fields["horas_anio"];
$asigrhext_mes=$lista_mesnom[$rs_buscal->fields["horas_mes"]];
$asigrhext_observacion='HORAS 50%';
$asigrhext_fechai=$rs_buscal->fields["horas_anio"]."-".$valor_mesdata."-01";
$asigrhext_fechaf=$rs_buscal->fields["horas_anio"]."-".$valor_mesdata."-".$days_in_month;
$asigrhext_horas=$rs_buscal->fields["horas_ncincuenta"];
$asigrhext_valorhoras=$rs_buscal->fields["horas_valorcincuenta"];
$asigrhext_archivo='';
$asigrhext_activo=1;
$asigrhext_enlace=$aletorioid;
$asigrhext_fecharegistro=date("Y-m-d H:i:s");
$usuar_id=$_SESSION['ces1313777_sessid_inicio'];


$insrta_dat="insert into conco_asiganhextras (emp_id,usua_id,asigrhext_anio,asigrhext_mes,asigrhext_observacion,asigrhext_fechai,asigrhext_fechaf,asigrhext_horas,asigrhext_valorhoras,asigrhext_archivo,asigrhext_activo,asigrhext_enlace,asigrhext_fecharegistro,usuar_id,archdt_id) value ('".$emp_id."','".$usua_id."','".$asigrhext_anio."','".$asigrhext_mes."','".$asigrhext_observacion."','".$asigrhext_fechai."','".$asigrhext_fechaf."','".$asigrhext_horas."','".$asigrhext_valorhoras."','".$asigrhext_archivo."','".$asigrhext_activo."','".$asigrhext_enlace."','".$asigrhext_fecharegistro."','".$usuar_id."','".$archdt_id."')";

$rs_insdata = $DB_gogess->executec($insrta_dat);
}
//50%	

//100%

if($rs_buscal->fields["horas_valorcien"]>0)
{	  
$emp_id=1;
$usua_id=$usua_idxd;
$asigrhext_anio=$rs_buscal->fields["horas_anio"];
$asigrhext_mes=$lista_mesnom[$rs_buscal->fields["horas_mes"]];
$asigrhext_observacion='HORAS 100%';
$asigrhext_fechai=$rs_buscal->fields["horas_anio"]."-".$valor_mesdata."-01";
$asigrhext_fechaf=$rs_buscal->fields["horas_anio"]."-".$valor_mesdata."-".$days_in_month;
$asigrhext_horas=$rs_buscal->fields["horas_nhorascien"];
$asigrhext_valorhoras=$rs_buscal->fields["horas_valorcien"];
$asigrhext_archivo='';
$asigrhext_activo=1;
$asigrhext_enlace=$aletorioid;
$asigrhext_fecharegistro=date("Y-m-d H:i:s");
$usuar_id=$_SESSION['ces1313777_sessid_inicio'];


$insrta_dat="insert into conco_asiganhextras (emp_id,usua_id,asigrhext_anio,asigrhext_mes,asigrhext_observacion,asigrhext_fechai,asigrhext_fechaf,asigrhext_horas,asigrhext_valorhoras,asigrhext_archivo,asigrhext_activo,asigrhext_enlace,asigrhext_fecharegistro,usuar_id,archdt_id) value ('".$emp_id."','".$usua_id."','".$asigrhext_anio."','".$asigrhext_mes."','".$asigrhext_observacion."','".$asigrhext_fechai."','".$asigrhext_fechaf."','".$asigrhext_horas."','".$asigrhext_valorhoras."','".$asigrhext_archivo."','".$asigrhext_activo."','".$asigrhext_enlace."','".$asigrhext_fecharegistro."','".$usuar_id."','".$archdt_id."')";

$rs_insdata = $DB_gogess->executec($insrta_dat);
}

//100%




}
else
{
  echo "<br><b>Usuario no existe con cedula:</b> ".$horas_cedula."<br>";

}



         $rs_buscal->MoveNext();
	  }
  }
  
  
//procesa archivo y datos
}
else
{   
 echo "<b><br>Archivo no corresponde al mes seleccionado...</b>";
}
//sube datos

///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}


}
?>