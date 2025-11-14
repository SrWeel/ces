<?php

function sinoformulario($grupg_id,$tabla,$eteneva_id,$grupg_tablasexternasino,$grupg_tablasexterna,$atenc_enlace,$campelace,$DB_gogess)
{
	////////////////
	if($grupg_tablasexternasino=='0')
	{
		$tablas=$tabla;
		$campelace='atenc_id';
		$enlaceid=$eteneva_id;
		}
		
		if($grupg_tablasexternasino=='1')
	{
		$tablas=$grupg_tablasexterna;
		$campelace;
		$enlaceid=$atenc_enlace;
		}
	
	 $lista_campollenosino="select * from ".$tablas." where ".$campelace."='".$enlaceid."'";
$rs_tabsinocamp = $DB_gogess->executec($lista_campollenosino,array());

	
	
   $lista_formulariog="SELECT *
FROM faesa_gruposcamposgrid
  INNER JOIN faesa_gruposgrids ON faesa_gruposgrids.grupg_id =
    faesa_gruposcamposgrid.grupg_id where faesa_gruposgrids.grupg_id=".$grupg_id;
	$rs_formgrupp = $DB_gogess->executec($lista_formulariog,array());
	//echo $rs_formgrupp->fields["grupgcamp_campos"];
	
			$sino="";

if($rs_formgrupp)
 {

	  while (!$rs_formgrupp->EOF) {
		  
		
		  @$campostodos.=$rs_formgrupp->fields["grupgcamp_campos"].",";
		  	
	   $rs_formgrupp->MoveNext();	   

	  }
  }
  
  //echo $campostodos;
  
    @$campostodosarray = explode(",", $campostodos);
	
	//print_r($campostodosarray);
	  
	  for ($i = 0; $i <= count($campostodosarray); $i++) {
   		
			//$banderaform=1;
		//
	   @$caractprimero=substr($campostodosarray[$i], 0,1);
		if($caractprimero=='-'){
			
			   $campostodosarray[$i];
		    	$nombrecampos= str_replace('-', '', $campostodosarray[$i]);
			
	//echo  $rs_tabsinocamp->fields[$nombrecampos]."<br>";
	
	//echo  $rs_tabsinocamp->fields[$nombrecampos];
			
			
			   if($sino < 2){
			  
			
			if($rs_tabsinocamp->fields[$nombrecampos]!="")
			{
								 
				 $sino++;
				 
				}
			   }
			}
			
	    }
		

  
 
		 
  
  
  return $sino;
  
		}
////////////////	 
	
	
	function sinofila($grupg_id,$tabla,$eteneva_id,$DB_gogess)
{
	////////////////
	
	 $lista_campollenosino="select * from ".$tabla." where atenc_id='".$eteneva_id."'";
$rs_tabsinocamp = $DB_gogess->executec($lista_campollenosino,array());

	
	
   $lista_formulariog="SELECT *
FROM faesa_gruposcamposgrid
  INNER JOIN faesa_gruposgrids ON faesa_gruposgrids.grupg_id =
    faesa_gruposcamposgrid.grupg_id where faesa_gruposgrids.grupg_id=".$grupg_id;
	$rs_formgrupp = $DB_gogess->executec($lista_formulariog,array());
	//echo $rs_formgrupp->fields["grupgcamp_campos"];
	
			$sino="";

if($rs_formgrupp)
 {

	  while (!$rs_formgrupp->EOF) {
		  
		
		  @$campostodos.=$rs_formgrupp->fields["grupgcamp_campos"]."/";
		  	
	   $rs_formgrupp->MoveNext();	   

	  }
	  
	//  $campostodos=substr($campostodos,0,-1);
  }
  
  echo $campostodos;
  
    @$campostodosarray = explode("/", $campostodos);
	
	
	//print_r($campostodosarray);
	  
	  for ($i = 0; $i <= count($campostodosarray); $i++) {
   		
			//$banderaform=1;
		//
	   @$caractprimero=substr($campostodosarray[$i], 0,1);
		if($caractprimero=='-'){
			
			   $campostodosarray[$i];
		    	$nombrecampos= str_replace('-', '', $campostodosarray[$i]);
			
	//echo  $rs_tabsinocamp->fields[$nombrecampos]."<br>";
	
	//echo  $rs_tabsinocamp->fields[$nombrecampos];
			
			
			   if($sino < 2){
			  
			
			if($rs_tabsinocamp->fields[$nombrecampos]!="")
			{
								 
				 $sino++;
				 
				}
			   }
			}
			
	    }
		
  
  
 
		 
  
  
  return $sino;
  
		}
	
	

?>
