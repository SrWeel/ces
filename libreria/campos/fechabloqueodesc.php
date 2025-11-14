<?php

$comillas='"';



$len=$this->field_maxcaracter;



if (!($this->imprpt))

	   {

         //No impresión	  

		if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

		  if (!(@$this->contenid[$nombre_campo]==""))

           {						

		 

		    if($this->fie_inactivoftabla)

			{
            
			 echo $this->fie_title.$this->fecha_bloque_desc("Y-m-d",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'"  >';

			}

			else

			{

			echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'"  width="12%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"   >
              '.$this->fecha_bloque_desc("d-m-Y",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"   value="'.$this->contenid[$nombre_campo].'"    >'.$this->fie_txtextra."";

			 

			 //campos concatenados

			 if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".@$this->fie_id;

			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array());

			 if($rs_buscacampoc)

			 {

			    while (!$rs_buscacampoc->EOF) 

				{

				   

				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);

				   $rs_buscacampoc->MoveNext();

				}

			 }

			 }

			 //campos concatenados

			 

			 echo '</td>

			 

			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>

			 
 

			 </tr>';		

			} 

			 

           }

		  else

           {

         	if ($this->fie_sendvar)				

             { 

               		

					

			if($this->fie_inactivoftabla)

			{

			  echo $this->fie_title.$this->fecha_bloque_desc("Y-m-d",$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->sendvar[$this->fie_sendvar].'"  >';

			}

			else

			{			 

			echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'"  width="10%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"  >

			 '.$this->fecha_bloque_desc("d-m-Y",$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->sendvar[$this->fie_sendvar].'"    >'.$this->fie_txtextra."";

			 

			 //campos concatenados

			 if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".$this->fie_id;

			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array());

			 if($rs_buscacampoc)

			 {

			    while (!$rs_buscacampoc->EOF) 

				{

				   

				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);

				   $rs_buscacampoc->MoveNext();

				}

			 }

			 }

			 //campos concatenados

			 

			 echo '</td>

			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td> 

			 </tr>';

			}	 

				 

				 

              }

             else

              {

			    if (@$this->dedatos)

				{

				

				if($this->fie_inactivoftabla)

			{			

		    echo $this->fie_title.$this->fecha_bloque_desc("Y-m-d",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'"  >';

			}

			else

			{

			echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'"  width="10%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'"  nowrap="nowrap"  >

			 '.$this->fecha_bloque_desc("d-m-Y",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'"   >'.$this->fie_txtextra."";

			 

			  //campos concatenados

			  if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".$this->fie_id;

			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array());

			 if($rs_buscacampoc)

			 {

			    while (!$rs_buscacampoc->EOF) 

				{

				   

				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);

				   $rs_buscacampoc->MoveNext();

				}

			 }

			 }

			 //campos concatenados 

			 

			 echo '</td>

			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
	

			 </tr>';

			}	   

				   

				}  

				else

				{

				  

				  	if($this->fie_inactivoftabla)

			{	

				  

				  echo $this->fie_title.$this->fecha_bloque_desc("Y-m-d",$nombre_campo,$this->fie_value,$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"   value="'.$this->fie_value.'"  >';

			}

			else

			{

				  echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'"   width="10%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"  >

			 '.$this->fecha_bloque_desc("d-m-Y",$nombre_campo,$this->fie_value,$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->fie_value.'"   >'.$this->fie_txtextra."";

			 

			 //campos concatenados

			 if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".@$this->fie_id;

			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array());

			 if($rs_buscacampoc)

			 {

			    while (!$rs_buscacampoc->EOF) 

				{

				   

				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);

				   $rs_buscacampoc->MoveNext();

				}

			 }

			 }

			 //campos concatenados

			 

			 echo '</td>

			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>

			 

			 </tr>';

			

			

			}	  

				  

				

				}

              }  

           }

           //Fin no impresión

		   }

		   else

		   {

		   //Impresión

		   		 if ($this->fie_activarprt)

		 {

		   if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

		   

		   if ($this->contenid[$nombre_campo]<>'')

		{

	           

				  	if($this->fie_inactivoftabla)

			{	   

				  echo $this->contenid[$nombre_campo];

			 }

			 else

			 {

			  echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'" width="10%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->contenid[$nombre_campo].' </td>

			</tr>';

			 

			 

			 }

					   

		 }

		 

		 }  

		   //Impresión

		   

		   

		   

		   }

?>