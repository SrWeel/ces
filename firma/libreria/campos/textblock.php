<?php
$bloquevalor='readonly=0';
$comillas='"';
$len=$this->field_maxcaracter;

if (!($this->imprpt))
	   {
         //No impresión	  
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
		 
		    if($this->fie_inactivoftabla)
			{
			 echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" '.$bloquevalor.' >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'"  '.$bloquevalor.'  >'.$this->txtobligatorio;
			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>
			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			 
			 
			 echo '</td>			 
			 </tr>';		
			} 
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
               		
					
			if($this->fie_inactivoftabla)
			{
			  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'"  '.$bloquevalor.' >';
			}
			else
			{			 
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" '.$bloquevalor.' >'.$this->txtobligatorio;
			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>
			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			 
			 
			 echo '</td>			 
			 </tr>';
			}	 
				 
				 
              }
             else
              {
			    if ($this->dedatos)
				{
				
				if($this->fie_inactivoftabla)
			{			
		    echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'"  nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" '.$bloquevalor.' >'.$this->txtobligatorio;
			 
			  //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados 
			 
			 echo '</td>
			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			 
			 
			 echo '</td>	
			 </tr>';
			}	   
				   
				}  
				else
				{
				  
				  	if($this->fie_inactivoftabla)
			{	
				  
				  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" '.$bloquevalor.' >';
			}
			else
			{
				  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).' size="'.$this->fie_lencampo.'" '.$bloquevalor.' >'.$this->txtobligatorio;
			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>
			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			 
			 
			 echo '</td>
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
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->contenid[$nombre_campo].' </td>
			</tr>';
			 
			 
			 }
					   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>