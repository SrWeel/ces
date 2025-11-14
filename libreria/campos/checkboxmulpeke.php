<?php

 $icheck=0;
 $valorfievalue='';
      if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}

		  if (!($this->contenid[$nombre_campo]==""))
           {	

		     $valorfievalue=explode(",",$this->contenid[$nombre_campo]);					

             echo '<div class="form-group">';

			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			 echo '<div class="col-md-5" style="z-index:99;width:260px;height:140px;overflow: auto;" >';


				 $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

				 $resulcheck = $DB_gogess->executec($sqlchek,array());  

				 $campos_d=explode(",",$this->fie_datadb);

				  if ($resulcheck)

				  {

				  $icheck=1;

				  

				  while(!$resulcheck->EOF) 

						{						  

						  if (@$valorfievalue[$icheck-1])

						  {

						 

						  echo '<div class="checkbox">';

						  echo '<label for="'.$nombre_campo.$icheck.'">';

						  echo "<input name='".$nombre_campo.$icheck."'  ".$this->fie_attrib."  type='checkbox' id='".$nombre_campo.$icheck."' value='".$resulcheck->fields[$campos_d[0]]."'  checked >".utf8_encode($resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]]);

						  echo '</label>';

						  echo '</div>'; 

						  

						  }

						  else

						  {

						

						  echo '<div class="checkbox">';

						  echo '<label for="'.$nombre_campo.$icheck.'">';

						  echo "<input name='".$nombre_campo.$icheck."'  ".$this->fie_attrib."  type='checkbox' id='".$nombre_campo.$icheck."' value='".$resulcheck->fields[$campos_d[0]]."' >".utf8_encode($resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]]);

						  echo '</label>';

						  echo '</div>'; 

						  

						  }

						  

						  

						  

						  

						  $icheck++;

						  $resulcheck->MoveNext();

						  

						}

				  }	

			

			 echo '</div>';

			 echo '<div class="col-xs-1">';

			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';

			 echo '</div>'; 

			 echo '<div class="col-xs-1">';

			 echo $this->fie_txtextra;

			 echo '</div>';  

			 echo '</div>';



			 			 

           }

		  else

           {

		     if ($this->fie_value)

			 {			

			 

			 $valorfievalue=explode(",",$this->fie_value);					

             echo '<div class="form-group">';

			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			 echo '<div class="col-md-5" style="z-index:99;width:260px;height:140px;overflow: auto;" >';

 

	             $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

				 $resulcheck = $DB_gogess->executec($sqlchek,array());  

				 $campos_d=explode(",",$this->fie_datadb);

				  if ($resulcheck)

				  {

				  $icheck=1;

				  

				  while(!$resulcheck->EOF) 

						{						  

						  if (@$valorfievalue[$icheck-1])

						  {

						 

						  echo '<div class="checkbox">';

						  echo '<label for="'.$nombre_campo.$icheck.'">';

						  echo "<input name='".$nombre_campo.$icheck."'  ".$this->fie_attrib."  type='checkbox' id='".$nombre_campo.$icheck."' value='".$resulcheck->fields[$campos_d[0]]."' checked >".utf8_encode($resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]]);

						  echo '</label>';

						  echo '</div>'; 

						 

						  }

						  else

						  {

						  

						 

						  echo '<div class="checkbox">';

						  echo '<label for="'.$nombre_campo.$icheck.'">';

						  echo "<input name='".$nombre_campo.$icheck."'  ".$this->fie_attrib."  type='checkbox' id='".$nombre_campo.$icheck."' value='".$resulcheck->fields[$campos_d[0]]."' checked >".utf8_encode($resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]]);

						  echo '</label>';

						  echo '</div>'; 

						 

						  }

						  $icheck++;

						  

						  $resulcheck->MoveNext();

						  

						}

				  }	

			

			 echo '</div>';

			 echo '<div class="col-xs-1">';

			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';

			 echo '</div>'; 

			 echo '<div class="col-xs-1">';

			 echo $this->fie_txtextra;

			 echo '</div>';  

			 echo '</div>';

			 

			   

			 }

			 else

			 {

			    

				/////////////////////////////////////////



				

			   echo '<div class="form-group" >';

			   echo'<label class="control-label col-md-5" >'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			   echo '<div class="col-md-5"  style="z-index:99;width:260px;height:140px;overflow: auto;" >';

               

			   

	             $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

				 $resulcheck = $DB_gogess->executec($sqlchek,array());  

				 $campos_d=explode(",",$this->fie_datadb);

				  if ($resulcheck)

				  {

				  $icheck=1;

				  

				  while(!$resulcheck->EOF) 

						{						  

						  

						  echo '<div class="checkbox">';

						  echo '<label for="'.$nombre_campo.$icheck.'">';

						  echo "<input name='".$nombre_campo.$icheck."' ".$this->fie_attrib."  type='checkbox' id='".$nombre_campo.$icheck."' value='".$resulcheck->fields[$campos_d[0]]."'  >".utf8_encode($resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]]);

						  echo '</label>';

						  echo '</div>'; 

						  

						  $icheck++;

						  

						  $resulcheck->MoveNext();

						  

						}

				  }	

			   

				  

			

			 echo '</div>';

			 echo '<div class="col-md-1">';

			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';

			 echo '</div>'; 

			 echo '<div class="col-md-1">';

			 echo $this->fie_txtextra;

			 echo '</div>';  

			 echo '</div>';

				

				

				/////////////////////////////////////////

				

			 }

			 

			 

           }



?>