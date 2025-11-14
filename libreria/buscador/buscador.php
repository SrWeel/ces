<?php
/**
 * Buscador Funciones
 * 
 * Este archivo permite obtener funciones standar para el sistema.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package buscador_funciones
 */
 
 
class buscador_funciones{

public $datauno=array();
var $camposlike;
var $campostxt;
var $mesrol;
 

 
 function creaform_buscador($_POSTX,$col_buscar,$funcion_buscar,$array_data,$DB_gogess)
 {
        $form_buscar='';
		$form_buscar.='<div class="panel panel-default">
			<div class="panel-body">
			<div class="form-group"> ';
       
        for($i=0;$i<count($array_data);$i++)
		{
              
			  
			  switch ($array_data[$i]["tipo"]) {
				  case 'fecha':
				  {
				    $form_buscar.='<div class="col-md-'.$array_data[$i]["col"].'">'.$array_data[$i]["titulo"].'<br>';
					$form_buscar.='Fecha inicio:<input name="'.$array_data[$i]["campo"].'inicio_x" type="text" id="'.$array_data[$i]["campo"].'inicio_x" class="form-control" value="'.$_POSTX[$array_data[$i]["campo"]."inicio_x"].'" autocomplete="off">';
					$form_buscar.='Fecha fin:<input name="'.$array_data[$i]["campo"].'fin_x" type="text" id="'.$array_data[$i]["campo"].'fin_x" class="form-control" value="'.$_POSTX[$array_data[$i]["campo"]."fin_x"].'" autocomplete="off">';
					$form_buscar.='</div>';
				  }						
					break;
				  
				  case 'text':
				  {
				    $form_buscar.='<div class="col-md-'.$array_data[$i]["col"].'">'.$array_data[$i]["titulo"];
					$form_buscar.='<input name="'.$array_data[$i]["campo"].'_x" type="text" id="'.$array_data[$i]["campo"].'_x" class="form-control" value="'.$_POSTX[$array_data[$i]["campo"]."_x"].'" autocomplete="off">';
					$form_buscar.='</div>';
				  }						
					break;
				  case 'select':
				  {
					  $form_buscar.='<div class="col-md-'.$array_data[$i]["col"].'">'.$array_data[$i]["titulo"];
					  $form_buscar.='<select class="form-control" name="'.$array_data[$i]["campo"].'_x" id="'.$array_data[$i]["campo"].'_x">
					                 <option value="">--Seleccionar--</option>';
					  $form_buscar.=$this->fill_cmblistado($array_data[$i]["tablacmb"],$array_data[$i]["campocmb"],$_POSTX[$array_data[$i]["campo"]."_x"],$array_data[$i]["orderby"],$DB_gogess);					 			   
					  $form_buscar.='</select>';	
					  $form_buscar.='</div>';		   
				   }	 
					break;
				  case 'textarea':
					{
					  $form_buscar.='<div class="col-md-'.$array_data[$i]["col"].'">'.$array_data[$i]["titulo"];
					  $form_buscar.='<textarea  name="'.$array_data[$i]["campo"].'_x"  class="form-control"  id="'.$array_data[$i]["campo"].'_x"  rows="4" wrap="VIRTUAL" cols="25" >'.$_POSTX[$array_data[$i]["campo"]."_x"].'</textarea>';
					  $form_buscar.='</div>';					  
					}
					break;
				  default:
					{
				      $form_buscar.='<div class="col-md-'.$array_data[$i]["col"].'">'.$array_data[$i]["titulo"];
					  $form_buscar.='<input name="'.$array_data[$i]["campo"].'_x" type="text" id="'.$array_data[$i]["campo"].'_x" class="form-control" value="'.$_POSTX[$array_data[$i]["campo"]."_x"].'" autocomplete="off">';
					  $form_buscar.='</div>';
				    }
							
				}
	  
          
        }
		
$form_buscar.='     </div>

<div class="form-group">	
<div class="col-md-'.$col_buscar.'">
<br>
<button type="button" class="mb-sm btn btn-primary" onclick="'.$funcion_buscar.'" style="background-color:#000066">BUSCAR</button>

</div>
</div>

                  </div>
                </div>';
	
		
$form_buscar.='<script type="text/javascript">
<!--';

				
	 for($i=0;$i<count($array_data);$i++)
		{
              
			  
			  switch ($array_data[$i]["tipo"]) {
				  case 'fecha':
				  {
					
					$form_buscar.=" $( '#".$array_data[$i]["campo"]."inicio_x' ).datepicker({dateFormat: 'yy-mm-dd'}); 
					";
					
					$form_buscar.=" $( '#".$array_data[$i]["campo"]."fin_x' ).datepicker({dateFormat: 'yy-mm-dd'}); 
					";
					
				  }						
					break;
				}
		}	
		
$form_buscar.='-->
</script>';
							
				
	return $form_buscar;				
		
 }
 
 

						       
 


function fill_cmblistado($tablecmb,$fieldcmb,$vbus,$orden,$DB_gogess)
{

$despliega_data="";
//-------------------------------------------------------
$selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

//echo  $selecTabla;
//print_r($DB_gogess);
  //$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);
  $DB_gogess->funciones_ADODB_FETCH_NUM();
  $rs_fill = $DB_gogess->executec($selecTabla,array());
  if($rs_fill)
  {
  		while (!$rs_fill->EOF) {

               $fld=$rs_fill->FetchField(0);
			   $tipocampo =$rs_fill->MetaType($fld->type);
		       $textvalor='';
			  for($ij=1;$ij<count($rs_fill->fields);$ij++)
               {
				 $textvalor=$textvalor.$rs_fill->fields[$ij]." ";
			   }

           if ($tipocampo=='C')
             { 
               if ($rs_fill->fields[0]== $vbus)
                { 
                    $despliega_data.="<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";
                }
               else
                 {
					$despliega_data.="<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";
                 }
              }
            else 
              {
               if ($rs_fill->fields[0]== $vbus)
                {  
				   $despliega_data.="<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";
                }
               else
			     {
					$despliega_data.="<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";
                 }
              }
			$rs_fill->MoveNext();
             } 
    }

	$DB_gogess->funciones_ADODB_FETCH_ASSOC();
	
	return  $despliega_data;

}

 
 
}
 
 
 ?>