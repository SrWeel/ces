<?php
ini_set('max_execution_time','-1');
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include($director."libreria/variables/variables.php");

require_once "Classes/PHPExcel.php";
 
$url = "PADRELUISQ.xlsx";

$cuenta_insert=0; 
$cuenta_update=0;

$perio_id=1;
$subper_id=1; 
//$url = $target_path;
$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$lista_tabs=explode(",",'1°"A"HISTORIA');


$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);

//print_r($sheetnames);
//busca resumen
$index_data=0;
for($ival=0;$ival<(count($sheetnames));$ival++)
{
  if($sheetnames[$ival]=='RESUMEN DE NOTAS')
  {
    // echo $sheetnames[$ival]."<br>";
     $index_data=$ival;
   }

}

//bsca resumen


$index_val=$index_data;

$worksheet = $excelObj->getSheet($index_val);

//print_r($worksheet);

$maxCell = $worksheet->getHighestRowAndColumn();

//print_r($maxCell);

$data = $worksheet->rangeToArray('A3:' . $maxCell['column'] . $maxCell['row']); 

 
//print_r($data);
$nombre_docente=array();
$nombre_materia=array();
$nombre_gradocurso=array();

$cuentadosente=0;
$cuentamateria=0;
$activa_lista=0;
$cuentagradocurso=0;

$nombre_docenteval='';
$nombre_asiganturaval='';
$nombre_gradocursoval='';

$cuenta_lista=0;

//PERSONAL----------------------------------------------------------------
$cuentav=0;
$lista_personal=array();
$busca_personal=" select * from inc_personal";
$resulta_personal = $DB_gogess->executec($busca_personal,array());
 if($resulta_personal)
 {
    while (!$resulta_personal->EOF)
	{	   
	   $lista_personal[$cuentav]["id"]=utf8_encode($resulta_personal->fields["peri_id"]);	
	   $lista_personal[$cuentav]["nombre1"]=utf8_encode($resulta_personal->fields["peri_nombres"]);	
	   $lista_personal[$cuentav]["nombre2"]=utf8_encode($resulta_personal->fields["peri_nombres2"]);
	   $lista_personal[$cuentav]["apellido1"]=utf8_encode($resulta_personal->fields["peri_apellidos"]);
	   $lista_personal[$cuentav]["apellido2"]=utf8_encode($resulta_personal->fields["peri_apellidos2"]);
	   $cuentav++;
	   
	   $resulta_personal->MoveNext();
	} 
 
 }
//PERSONAL-----------------------------------------------------------------
 
 
//ALUMNO----------------------------------------------------------------
$cuentav=0;
$lista_alu=array();
$busca_alu=" select * from inc_alumno";
$resulta_alu = $DB_gogess->executec($busca_alu,array());
 if($resulta_alu)
 {
    while (!$resulta_alu->EOF)
	{	   
	   $lista_alu[$cuentav]["id"]=utf8_encode($resulta_alu->fields["alu_id"]);	
	   
	   $explode_nombre=array();
	   $explode_nombre=explode(" ",utf8_encode($resulta_alu->fields["alu_nombres"]));
	   
	   $explode_apellidos=array();
	   $explode_apellidos=explode(" ",utf8_encode($resulta_alu->fields["alu_apellidos"]));
	   
	   $lista_alu[$cuentav]["nombre1"]=@$explode_nombre[0];	
	   $lista_alu[$cuentav]["nombre2"]=@$explode_nombre[1];
	   $lista_alu[$cuentav]["apellido1"]=@$explode_apellidos[0];
	   $lista_alu[$cuentav]["apellido2"]=@$explode_apellidos[1];
	   
	   //busca amp_id
	   
	   $busca_amp_id="select * from inc_alumnoperiodo inner join inc_alumnoperiodomateria on inc_alumnoperiodo.aluper_id=inc_alumnoperiodomateria.aluper_id where perio_id=".$perio_id." and inc_alumnoperiodo.alu_id='".$resulta_alu->fields["alu_id"]."'";
	   
	   $resulta_amp_id = $DB_gogess->executec($busca_amp_id,array());
	   
	   $lista_alu[$cuentav]["amp_id"]=$resulta_amp_id->fields["amp_id"];
	   
	   //busca amp_id

	   $cuentav++;
	   
	   $resulta_alu->MoveNext();
	} 
 
 }
//ALUMNO----------------------------------------------------------------- 
//print_r($lista_alu); 
//print_r($lista_personal);

function busca_xnombre($nombre,$lista_personal,$DB_gogess)
{
      $obtiene_ids=array();
	  $separa_lista=array();
	  $separa_lista=explode(" ",$nombre);  
	  
	 // print_r($separa_lista);
	  
	  for($i=0;$i<count($lista_personal);$i++)
	  {
	       $cuenta_equivalencias=0;
		   //echo "___________________________________________________<br>";
		   for($z=0;$z<count($separa_lista);$z++)
		   {
		   //____________________________________________________________
		      //echo $lista_personal[$i]["nombre1"]."-->".$separa_lista[$z]."<br>";
			  //echo $lista_personal[$i]["nombre2"]."-->".$separa_lista[$z]."<br>";
			  //echo $lista_personal[$i]["apellido1"]."-->".$separa_lista[$z]."<br>";
			  //echo $lista_personal[$i]["apellido2"]."-->".$separa_lista[$z]."<br>";
			  
		      if($lista_personal[$i]["nombre1"]==$separa_lista[$z])
			  {
			     //echo ".";
			     $cuenta_equivalencias++;
			  }
			  if($lista_personal[$i]["nombre2"]==$separa_lista[$z])
			  {
			     //echo ".";
			     $cuenta_equivalencias++;
			  }
			  if($lista_personal[$i]["apellido1"]==$separa_lista[$z])
			  {
			     //echo ".";
			     $cuenta_equivalencias++;
			  }
			  
			  if($lista_personal[$i]["apellido2"]==$separa_lista[$z])
			  {
			     //echo ".";
			     $cuenta_equivalencias++;
			  }			  
			//____________________________________________________________
			  
		   }	
		   if($cuenta_equivalencias>2)
		   {
		       @$obtiene_ids[$nombre]["id"]=$lista_personal[$i]["id"];			   
			   @$obtiene_ids[$nombre]["eq"]=$cuenta_equivalencias;
		   
		   }   
	      
	  }
	  
	  return $obtiene_ids;
    
}


 
for($iv=0;$iv<count($data);$iv++)
{

	   //echo "---------------<br>";
	   //print_r($data[$iv]);
	   for($zi=0;$zi<count($data[$iv]);$zi++)
	   {
	   
			 // echo $data[$iv][$zi]."<br>";
			  if(trim($data[$iv][$zi])=='DOCENTE:')
			  {
				 $nombre_docente[$cuentadosente]=$data[$iv][3];
				 $nombre_docenteval=$data[$iv][3];
				 
				 $resultado_idsprofe=array();
				 $resultado_idsprofe=busca_xnombre($nombre_docenteval,$lista_personal,$DB_gogess);
				 
				 
				 
				 $cuentadosente++;		
			  }
			  
			  if(trim($data[$iv][$zi])=='ASIGNATURA')
			  {
				 $nombre_materia[$cuentamateria]=$data[$iv][4];
				 $nombre_asiganturaval=$data[$iv][4];
				 $cuentamateria++;		
			  }	
			  
			  if(trim($data[$iv][$zi])=='GRADO/CURSO:')
			  {
				 $nombre_gradocurso[$cuentagradocurso]=$data[$iv][3];
				 $nombre_gradocursoval=$data[$iv][3];
				 $cuentagradocurso++;		
			  }	
			  
			  
			  if(trim(str_replace("\n", "",$data[$iv][$zi]))=='APELLIDOS Y NOMBRES')
			  {				 
		        //echo $data[$iv][$zi];
				 
				 $activa_lista=1;
				 
				 
			  }	  	  
	   
	   }
	   ///---------------------------------------------------------------
	   $resultado_ids=array();
	   if($activa_lista==1)
	   {
			  			   
			 if($data[$iv][1]>=1 and $data[$iv][1]<=40)
			   {
				  
				  $separado_por_guion[$nombre_docenteval][$nombre_asiganturaval][$nombre_gradocursoval][$cuenta_lista] = "|".$nombre_docenteval."|".$nombre_asiganturaval."|".$nombre_gradocursoval."|".implode("|",$data[$iv]); 	
				  $cuenta_lista++;	
				  
				  print_r($data[$iv]);
				  
				  $resultado_ids=array();
				  $resultado_ids=busca_xnombre($data[$iv][2],$lista_alu,$DB_gogess);
				  print_r($resultado_ids);
				 
				  $peri_id=@$resultado_idsprofe[$nombre_docenteval]["id"];
				  
				  //obtiene profesor periodo
				  $busca_proper_id="select proper_id from inc_profesorperiodo where peri_id='".$peri_id."' and perio_id='".$perio_id."'";
				  $resulta_proper_id = $DB_gogess->executec($busca_proper_id,array());
				  $proper_id=0; 				  
				  $proper_id=$resulta_proper_id->fields["proper_id"];
				  
				  //gru_id
				  //obtiene profesor periodo
				  
				  //obtiene grupo
				   $letra_valor=substr(utf8_decode($nombre_gradocursoval), -4);
				   $letra_valor=trim(str_replace('"','',$letra_valor));
				    
				   $busca_grupo="select * from inc_grupo where gru_nombre='".$letra_valor."'";
				   echo $busca_grupo."<br>";
				   $resulta_bgrupo = $DB_gogess->executec($busca_grupo,array());
				   $gru_id=0;
				   $gru_id=$resulta_bgrupo->fields["gru_id"];
				   if(!($gru_id))
				   {
				       
				       $busca_grupo="select * from inc_grupo where gru_nombre='A'";
				       echo $busca_grupo."<br>";
				       $resulta_bgrupo = $DB_gogess->executec($busca_grupo,array());
				       $gru_id=0;
				       $gru_id=$resulta_bgrupo->fields["gru_id"];
				       
				   }
				   
				   //$busca_grupo="select ";
				  //obtiene grupo
				  
				  //busca materia
				  $busca_mat="select * from inc_nivel where nivl_alias like '".substr(utf8_decode($nombre_gradocursoval), 0, -5)."%'"; 
				  $resulta_bmateria = $DB_gogess->executec($busca_mat,array()); 
				  //echo $busca_mat."<br>";
				  
				  $nivl_id=0;
				  $nivl_id=$resulta_bmateria->fields["nivl_id"];
				  
				  //echo $nivl_id."<br>";
				  
				  $busca_mat2="select * from  inc_materia where nivl_id='".$resulta_bmateria->fields["nivl_id"]."' and mate_nombre='".utf8_decode($nombre_asiganturaval)."'";
				  $resulta_bmateria2 = $DB_gogess->executec($busca_mat2,array()); 
				  
				  //echo $busca_mat2."<br>";
				  
				  if(!($resulta_bmateria2->fields["mate_id"]))
				  {
				    $nombre_gradocursoval.$nombre_asiganturaval;
				  }
				  
				  $mate_id=0;
				  $mate_id=$resulta_bmateria2->fields["mate_id"];
				  
				  //echo $mate_id."<br>";
				  
				  $busca_inc_materiaprofesor="select * from  inc_materiaprofesor where gru_id='".$gru_id."' and proper_id='".$proper_id."' and peri_id='".$peri_id."' and nivl_id='".$nivl_id."' and mate_id='".$mate_id."'";
				  $resulta_inc_materiaprofesor = $DB_gogess->executec($busca_inc_materiaprofesor,array()); 
				  
				  echo $busca_inc_materiaprofesor."<br>";
				  
				  $matprof_id=$resulta_inc_materiaprofesor->fields["matprof_id"];
				  
				  echo $matprof_id."<br>";
				  //busca materia
				  
				  //busca inc_alumnoperiodo
				  $busca_inc_alumnoperiodo="select * from inc_alumnoperiodo where alu_id='".$resultado_ids[$data[$iv][2]]["id"]."' and perio_id='".$perio_id."'";
				  echo $busca_inc_alumnoperiodo."<br>";
				  $resulta_inc_alumnoperiodo = $DB_gogess->executec($busca_inc_alumnoperiodo,array()); 
				  $aluper_id=0;
				  $aluper_id=$resulta_inc_alumnoperiodo->fields["aluper_id"];
				  
				  //busca inc_alumnoperiodo
				  
				  //busca inc_alumnoperiodomateria
				  $busca_inc_alumnoperiodomateria="select * from inc_alumnoperiodomateria where aluper_id='".$aluper_id."' and alu_id='".$resultado_ids[$data[$iv][2]]["id"]."' and nivl_id='".$nivl_id."' and matprof_id='".$matprof_id."'";
				  echo $busca_inc_alumnoperiodomateria."<br>";
				  $result_inc_alumnoperiodomateria = $DB_gogess->executec($busca_inc_alumnoperiodomateria,array()); 
				  $amp_id=0;
				  $amp_id=$result_inc_alumnoperiodomateria->fields["amp_id"];
				  //busca inc_alumnoperiodomateria
				  
				 // print_r($data[$iv]);
				 // echo $resultado_ids[$data[$iv][2]]["id"]."<br>";
				 // echo $busca_inc_alumnoperiodomateria."<br>";
				  
				  if($amp_id)
				  {
				     
					 $busca_actualizax="select * from inc_nota where amp_id='".$amp_id."' and subper_id='".$subper_id."'";
					 $result_bactualizax = $DB_gogess->executec($busca_actualizax,array());
					 
					 if($result_bactualizax->fields["amp_id"])
					 {
					     $act_data="update inc_nota set nta_nota1='".$data[$iv][4]."',nta_nota2='".$data[$iv][5]."',nta_nota3='".$data[$iv][6]."',nta_nota6='".$data[$iv][8]."' where amp_id='".$amp_id."' and subper_id='".$subper_id."'";
					     echo $act_data."<br>";
					     $result_okdata = $DB_gogess->executec($act_data,array());
					     $cuenta_update++;
					 }
					 else
					 {
					     $inserta_nota="insert into  inc_nota(amp_id,nta_nota1,nta_nota2,nta_nota3,subper_id,nta_nota6) values ('".$amp_id."','".$data[$iv][4]."','".$data[$iv][5]."','".$data[$iv][6]."','".$subper_id."','".$data[$iv][8]."')";
					     echo $inserta_nota."<br>";
					     $cuenta_insert++;
					     $result_insertanota = $DB_gogess->executec($inserta_nota,array());    
					     
					 }
					 
					 
				  
				  }
				  else
				  {
				       echo "ALERTA<br>";
				      
				  }
				  
				  
				  if($data[$iv][1]==40)
				  {
				    $activa_lista=0;
					$cuenta_lista=0;
				  }
				  
				  
				}  
				  
				  	   
			   
       
	   }	   
	   
    

}

//print_r($separado_por_guion);

echo "<BR>________________________<BR>".$cuenta_insert."_______________________________<BR>";
echo "<BR>________________________<BR>".$cuenta_update."_______________________________<BR>";


?>