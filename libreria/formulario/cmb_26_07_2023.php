<?php



/**



 * Combo

 * 

 * Este archivo permite llenar los campo combobox

 * 

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package FormularioCmb



*/



class FormularioCmb extends FormularioProceso

{ 





/**

 * Llena los campos combobox.

 * 

 * Llena los campos combobox

 * 

 * @param string $tablecmb $fieldcmb $vbus $orden.

 * @return string select.

 */





//llena campos multiples

function fill_cmb_multiplev($tablecmb,$fieldcmb,$vbus,$orden,$DB_gogess)

{

	

 if (trim(@$this->fie_sqlconexiontabla)) 

 {



  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".@$this->fie_sqlconexiontabla." ".$orden;



 }

 else

 {



  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;



 }

 echo '<table border="0" cellpadding="0" cellspacing="1">';

			

         			  

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



			     



				 $textvalor=$this->textorraro($textvalor.$rs_fill->fields[$ij]." - ");

				 

				if ($rs_fill->fields[0]==$vbus)

                {  



                   //echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";

				   

				   echo '<tr><td>'.$textvalor.'</td><td><input type="radio" name="radio_'.$this->fie_name.'" id="radio_'.$this->fie_name.'" value="'.$rs_fill->fields[0].'" checked="checked" onclick="seleccion_'.$this->fie_name.'()" /></td></tr>';



                }

               else

                {



					



					//echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";

echo '<tr><td>'.$textvalor.'</td><td><input type="radio" name="radio_'.$this->fie_name.'" id="radio_'.$this->fie_name.'" value="'.$rs_fill->fields[0].'" onclick="seleccion_'.$this->fie_name.'()" /></td></tr>';

					



                 }



			   



			   }

	

	

	

	

	 $rs_fill->MoveNext();

	 }

  }

echo '</table>';	

  $DB_gogess->funciones_ADODB_FETCH_ASSOC();

}

//llena campos multiples


function fill_cmbutf8($tablecmb,$fieldcmb,$vbus,$orden,$DB_gogess)
{

if(@$this->fie_tipocomb==1)
{

        $separacampo=explode(",",$fieldcmb);
		for($i=0;$i<count($this->combo_arr[$tablecmb]);$i++)
		{
		  if($vbus==$this->combo_arr[$tablecmb][$i][$separacampo[0]])
		  {
		   echo "<option value='".$this->combo_arr[$tablecmb][$i][$separacampo[0]]."'  selected >".$this->combo_arr[$tablecmb][$i][$separacampo[1]]."</option>";
		   }
		   else
		   {
			echo "<option value='".$this->combo_arr[$tablecmb][$i][$separacampo[0]]."' >".$this->combo_arr[$tablecmb][$i][$separacampo[1]]."</option>";
		   }
		}

}
else
{

//-------------------------------------------------------

if (trim(@$this->fie_sqlconexiontabla)) 
{
  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".@$this->fie_sqlconexiontabla." ".$orden;
 }
  else
 {
if(@$this->campoejecuta==@$this->ncamponombre)
 {
 $orden=str_replace(@$this->remplazarpor,@$this->codigofiltro,$orden);
 $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;
 }
 else
 {
 $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;
 }
 }
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

             $textvalor=utf8_encode($textvalor);
           if ($tipocampo=='C')
             {              
               if ($rs_fill->fields[0]== $vbus)
                {  
                   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";
                }
               else
                 {
					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";
                 }

              }
            else 
              {
               if ($rs_fill->fields[0]== $vbus)
                { 
				   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";
                }
               else
                 {
					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";
                 }
              }

			$rs_fill->MoveNext();
             } 
    }

	$DB_gogess->funciones_ADODB_FETCH_ASSOC();
	//-----------------------------------------------------

}
}




function fill_cmb($tablecmb,$fieldcmb,$vbus,$orden,$DB_gogess)
{

if(@$this->fie_tipocomb==1)
{

        $separacampo=explode(",",$fieldcmb);

		for($i=0;$i<count($this->combo_arr[$tablecmb]);$i++)
		{


		  if($vbus==$this->combo_arr[$tablecmb][$i][$separacampo[0]])
		  {



		   echo "<option value='".$this->combo_arr[$tablecmb][$i][$separacampo[0]]."'  selected >".$this->combo_arr[$tablecmb][$i][$separacampo[1]]."</option>";



		   }
		   else
		   {


			echo "<option value='".$this->combo_arr[$tablecmb][$i][$separacampo[0]]."' >".$this->combo_arr[$tablecmb][$i][$separacampo[1]]."</option>";



		   }


		}



}
else
{



//-------------------------------------------------------


 if (trim(@$this->fie_sqlconexiontabla)) 
{


  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".@$this->fie_sqlconexiontabla." ".$orden;



 }
  else
 {





if(@$this->campoejecuta==@$this->ncamponombre)
 {

 $orden=str_replace(@$this->remplazarpor,@$this->codigofiltro,$orden);

 $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

 }

 else

 {

 

 $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

 }


 }


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


                   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";


                }
               else
                 {



					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";


                 }

              }
            else 
              {

               if ($rs_fill->fields[0]== $vbus)
                {  



				   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";


                }
               else
			     {

					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";


                 }



              }



			$rs_fill->MoveNext();



             }  




    }




	$DB_gogess->funciones_ADODB_FETCH_ASSOC();

	//-----------------------------------------------------


}


}









function calcular_edad($fechan,$fechafin){

$resultado=array();

$separa_anios=array();

$valor_anio=0;

$valor_mes=0;

$fechainicial = new DateTime($fechan);

$fechafinal = new DateTime($fechafin);

$diferencia = $fechainicial->diff($fechafinal);

$meses = ( $diferencia->y * 12 ) + $diferencia->m;



$anios=$meses/12;

$separa_anios=explode(".",$anios);

$valor_anio=@$separa_anios[0];

$valor_mes=("0.".@$separa_anios[1])*12;



$resultado["anio"]=$valor_anio;

$resultado["mes"]=$valor_mes;



return $resultado;

}

	









/**







 * Reemplaza los datos de un combo en el grid.







 * 







 * Reemplaza los datos de un combo en el grid







 * 







 * @param string $tablecmb $fieldcmb $sql $valorbus .







 * @return string nombre.







 */




function replace_cmb($tablecmb,$fieldcmb,$sql,$valorbus,$DB_gogess)
{

if(@$this->fie_tipocomb==1)
{

  $listacampos=explode(",",$fieldcmb); 
	  for($i=0;$i<count($this->combo_arr[$tablecmb]);$i++)
	{

		  if($valorbus==$this->combo_arr[$tablecmb][$i][$listacampos[0]])
		  {


	    return  trim($this->combo_arr[$tablecmb][$i][$listacampos[1]]);

		  }

		} 

}
else
{

   //----------------------------------------------------------------

  $buscawhere=strstr(@$this->fie_sqlorder,'where');

  if($buscawhere)
  {

   $this->fie_sqlorder='';

  } 


  if ($sql)
  {

  $oprb= trim(strchr ($sql,'like'));



 if ($oprb=='like')
 {







	  if (@$this->fie_sqlconexiontabla)
	  {



    $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." and ".$this->fie_sqlconexiontabla." ".$this->fie_sqlorder;  

		}
		else
		{

	$selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." ".$this->fie_sqlorder;  	

		}


 }
 else
 {

   	  if (@$this->fie_sqlconexiontabla)
	  {

 	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql."'".$valorbus."'"." and ".$this->fie_sqlconexiontabla." ".$this->fie_sqlorder;

	  }
	  else
	  {

	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql."'".$valorbus."'"." ".@$this->fie_sqlorder; 

	  }

 } 

//echo $selecTabla;

  $rs_cmb = $DB_gogess->executec($selecTabla,array());



  if ($rs_cmb)
  {

  		while (!$rs_cmb->EOF) {


			   $scacampos=explode(",",$fieldcmb);

			   for($ij=1;$ij<count($scacampos);$ij++)
			   {
				 @$textvalor=$textvalor.$rs_cmb->fields[$scacampos[$ij]]." ";

			   }


                return trim($textvalor);

				$rs_cmb->MoveNext();

			}   


   }

  }	


  //------------------------------------------------------	

  }

}

// obtiene registros de una tabla con una sola consulta
function obtiene_unregistro($tabla,$campo,$valor,$DB_gogess)
{
   $lista_data="select * from ".$tabla." where ".$campo."='".$valor."'";
   $rs_cmb = $DB_gogess->executec($lista_data,array());
   
   return $rs_cmb;

}


//obtiene si ya existe primera ves en este centro
function obtiene_atencionanam($clie_id,$centro_id,$DB_gogess)
{
   $lista_data="select * from dns_anamesisexamenfisico where clie_id='".$clie_id."' and centro_id=".$centro_id;
   $rs_cmb = $DB_gogess->executec($lista_data,array());
   
   return $rs_cmb;

}

function obtiene_consultaext($clie_id,$centro_id,$DB_gogess)
{
   $lista_data="select * from dns_consultaexterna where clie_id='".$clie_id."' and centro_id=".$centro_id;
   $rs_cmb = $DB_gogess->executec($lista_data,array());
   
   return $rs_cmb;

}



}

?>