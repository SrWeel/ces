<?php
  $ejecuta_test='';
  $lista_areas="select * from appg_area where react_id='".$this->react_id."' and area_activo=1 order by area_orden asc";
  $rs_listaareas= $DB_gogess->executec($lista_areas,array());
  if($rs_listaareas)
  {
      while (!$rs_listaareas->EOF)
			{
      
                echo '<div class="col-md-12"><div class="form-group"><div class="col-xs-12" style="background-color:#000033;color:#FFFFFF">'.$rs_listaareas->fields["area_nombre"].'</div></div></div>';
                
                $obtiene_listatest="select * from appg_test where react_id='".$this->react_id."' and area_id='".$rs_listaareas->fields["area_id"]."'";
                $rs_listatest= $DB_gogess->executec($obtiene_listatest,array());
                $rs_listatestcb= $DB_gogess->executec($obtiene_listatest,array());
                
                $ncampo_enlace='';
                $ncampo_enlace=$this->fie_sendvar;
                
                //echo $this->contenid[$campos["fie_campoenlacesub"]];
                if(@$this->contenid[$campos["fie_campoenlacesub"]])
                {
                  $campo_enlace='';
                  $campo_enlace=$this->contenid[$campos["fie_campoenlacesub"]];
                }
                else
                {
                  $campo_enlace='';
                  $campo_enlace=$this->sendvar[$this->fie_sendvar];  
                }
                
                //conjunto de botones
                $acumula_btn='';
                 if($rs_listatestcb)
            		{
            			while (!$rs_listatestcb->EOF)
            			{
            			     $codigo_botonval="";
            			     $codigo_botonval="btn_".$this->fie_id."_".$this->react_id."_".$rs_listatestcb->fields["test_id"]."_".$rs_listaareas->fields["area_id"];
            			    
            			     $acumula_btn.=$codigo_botonval.";";
            			     
            			     $rs_listatestcb->MoveNext(); 
            			}
            		}	
                
                //conjunto de botones
                
                //lista botones
                $cuenta_btn=0;
                
                 if($rs_listatest)
            		{
            			while (!$rs_listatest->EOF)
            			{
            			   $codigo_boton="";
            			   $codigo_boton="btn_".$this->fie_id."_".$this->react_id."_".$rs_listatest->fields["test_id"]."_".$rs_listaareas->fields["area_id"];
            			   $comilla_simple="'";
            			   $cuenta_btn++;
            			   
            			   if($cuenta_btn==1)
            			   {
            			       $ejecuta_test.=' ocultar_mostrar_'.$this->fie_id.'('.$comilla_simple.$codigo_boton.$comilla_simple.','.$comilla_simple.$campo_enlace.$comilla_simple.','.$comilla_simple.$table.$comilla_simple.','.$comilla_simple.$ncampo_enlace.$comilla_simple.','.$rs_listatest->fields["test_id"].','.$comilla_simple.$rs_listaareas->fields["area_id"].$comilla_simple.','.$comilla_simple.$acumula_btn.$comilla_simple.'); ';
            			   }
            				
            			   echo '<input type="button" name="'.$codigo_boton.'" id="'.$codigo_boton.'" value="'.utf8_encode($rs_listatest->fields["test_nombre"]).'" onclick="ocultar_mostrar_'.$this->fie_id.'('.$comilla_simple.$codigo_boton.$comilla_simple.','.$comilla_simple.$campo_enlace.$comilla_simple.','.$comilla_simple.$table.$comilla_simple.','.$comilla_simple.$ncampo_enlace.$comilla_simple.','.$rs_listatest->fields["test_id"].','.$comilla_simple.$rs_listaareas->fields["area_id"].$comilla_simple.','.$comilla_simple.$acumula_btn.$comilla_simple.')" style="font-size:10px; font-weight:bold"/>';	 	    
            					    
            			  $rs_listatest->MoveNext();  
            			}
            		}
                
                
                //lista botones
                
                echo '<div id="divtest_'.$rs_listaareas->fields["area_id"].'_'.$this->fie_id.'" style="height:290px" ></div>';
                
                
              $rs_listaareas->MoveNext();
			}
  }
  
  
 
?>


<script>
 function ocultar_mostrar_<?php echo $this->fie_id; ?>(codigo_boton,campo_enlace,table,ncampo_enlace,test_id,area_id,listacmb)
 {
   

  cambio_inactivo(codigo_boton,0,area_id,listacmb);
     
  $("#divtest_"+area_id+"_<?php echo $this->fie_id; ?>").load("<?php echo $this->formulario_path ?>gridtest.php",{
	 codigo_boton:codigo_boton,
	 campo_enlace:campo_enlace,
	 table:table,
	 ncampo_enlace:ncampo_enlace,
	 test_id:test_id,
	 area_id:area_id,
	 formulario_path:'<?php echo $this->formulario_path; ?>'

  },function(result){  


  });  

  $("#divtest_"+area_id+"_<?php echo $this->fie_id; ?>").html("Espere un momento...");  

 }
 
 function cambio_inactivo(divdata,opcion,area_id,listacmb)
  {  
    
    
    var str = listacmb;
    var res = str.split(";");
    
    
    for (var i = 0; i < res.length; i++) {
       
       
       if(res[i]!='')
       {
        	
        	$('#'+res[i]).css('background-color','#C5E0EB');
	        $('#'+res[i]).css('color','#000000');
	        $('#'+res[i]).css('border','#000000');
	        $('#'+res[i]).css('border','solid');
	        $('#'+res[i]).css('border-width','thin'); 
           
       }
       
    }
    
  
    if(opcion==0)
	{
	        $('#'+divdata).css('background-color','#000033');
        	$('#'+divdata).css('color','#FFFFFF');
        	$('#'+divdata).css('border','#000000');
        	$('#'+divdata).css('border','solid');
        	$('#'+divdata).css('border-width','thin');   
	}
	
  }
  
  <?php
    echo $ejecuta_test;
  ?>
</script>