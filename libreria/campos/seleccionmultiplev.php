<?php
if (!($this->imprpt))
{

	   //No impresión

		if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

				 

				if (@$this->contenid[$nombre_campo]<>"")	

				{

			

			if($this->fie_inactivoftabla)

			{			 

     		 

			  $this->fill_cmb_multiplev($this->fie_tabledb,$this->fie_datadb,@$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 

		

			}

			else

			{

				//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";

			echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 
<script language="javascript">
<!--		 
function seleccion_'.$nombre_campo.'()
{

$(\'#'.$nombre_campo.'\').val($(\'input:radio[name=radio_'.$nombre_campo.']:checked\').val());


}
//-->
</script>			 
			 
	<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">		 		 
';

			  $this->fill_cmb_multiplev($this->fie_tabledb,$this->fie_datadb,trim(@$this->contenid[$nombre_campo]),$this->fie_sqlorder,$DB_gogess);			 

			 echo $this->txtobligatorio.'</td>			 

			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 

			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 

			 //campos concatenados

			 if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  kyradm_sisfieldconcatena where fie_id=".@$this->fie_id;

			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);

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

			 </tr>';	

			

			}					 

								 

								 

				}

				else

				{							 

					

					if($this->fie_inactivoftabla)

			{			 

			

			  $this->fill_cmb_multiplev($this->fie_tabledb,$this->fie_datadb,@$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 

			

				}

				else

				{

				

			  echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >	
			 
			 <script language="javascript">
<!--		 
function seleccion_'.$nombre_campo.'()
{

$(\'#'.$nombre_campo.'\').val($(\'input:radio[name=radio_'.$nombre_campo.']:checked\').val());


}
//-->
</script>	
			 	 
<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.@$this->sendvar[$this->fie_sendvar].'">
			 ';

			  $this->fill_cmb_multiplev($this->fie_tabledb,$this->fie_datadb,@$this->sendvar[$this->fie_sendvar],$this->fie_sqlorder,$DB_gogess);			 

			 echo $this->txtobligatorio.'</td>			 

			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 

			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 

			 //campos concatenados

			 if(@$this->fie_id)

			 {

			 $buscaconcatenacion="select * from  kyradm_sisfieldconcatena where fie_id=?";

			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array(@$this->fie_id));

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

			 </tr>';

			 

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

		$rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);

		  

		  		if($this->fie_inactivoftabla)

			{	

			echo $rmp;

			 }

			 else

			 {

			 echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$rmp.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	

			 </tr>';

			 

			 

			 }

	

		}

		}

		//Fin impresión

		}

?>