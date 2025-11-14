<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$listav_camposobl='';

$comilla_s="'";
$codigo_boton=$_POST["codigo_boton"];
$campo_enlace=$_POST["campo_enlace"];
$table=$_POST["table"];
$ncampo_enlace=$_POST["ncampo_enlace"];
$test_id=$_POST["test_id"];
$formulario_path=$_POST["formulario_path"];

//$table='';

//echo $codigo_boton."<br>";
//echo $campo_enlace."<br>";
//echo $table."<br>";
//echo $ncampo_enlace."<br>";

$obtiene_test="select * from appg_test where test_id='".$test_id."'";
$rs_test= $DB_gogess->executec($obtiene_test,array());

$nbse=$rs_test->fields["test_nombrebase"];
$tbl_fija=$rs_test->fields["test_ntablafija"];

$nombre_tabla=$rs_test->fields["test_ntabla"];
$separa_subindex=explode("_",$nombre_tabla);
$sub_index = substr($separa_subindex[1], 0, 4)."_";
$campo_id=$sub_index."id";
?>

<div class="panel panel-default">
     <div class="panel-heading">
    <h3 class="panel-title"><?php echo utf8_encode($rs_test->fields["test_nombre"]); ?></h3>
  </div>
<div class="panel-body">

<div class="form-group">
     
     <?php
     $listav_campos='';
     $listavtitulos_campos='';
     $listav_camposfecha='';
     $listav_camposarchivo='';
     $listav_patharchivo='';
     //busca campos
     $lista_campos="select * from appg_escala where test_id='".$test_id."'";
     $rs_lcampos= $DB_gogess->executec($lista_campos,array());
     if($rs_lcampos)
     {
        while (!$rs_lcampos->EOF)
			{
               
               if($rs_lcampos->fields["tipc_id"]=='3')
        	  {
        		  //select
        		  echo '<div id="despliegue_'.$rs_lcampos->fields["esca_nameid"].'x" class="col-md-'.$rs_lcampos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcampos->fields["esca_nombre"]);
        		  echo '<select class="form-control" name="'.$rs_lcampos->fields["esca_nameid"].'x" id="'.$rs_lcampos->fields["esca_nameid"].'x"  >';
        		  echo '<option value="" >--Seleccionar--</option>';
        		  $objformulario->fill_cmb($rs_lcampos->fields["esca_tablatomadato"],$rs_lcampos->fields["esca_camposdata"],'',' '.$rs_lcampos->fields["esca_ordendata"],$DB_gogess);
        		  echo '</select>';
        		  echo '</div>';
        	  }
        	  
        	  if($rs_lcampos->fields["tipc_id"]=='1')
        	  { 
        	     //text    
        	      echo '<div class="col-md-'.$rs_lcampos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcampos->fields["esca_nombre"]);
        		  echo '<input placeholder="'.utf8_encode($rs_lcampos->fields["esca_nombre"]).'" name="'.$rs_lcampos->fields["esca_nameid"].'x" type="text" id="'.$rs_lcampos->fields["esca_nameid"].'x" class="form-control" value=""  />';
        		  echo '</div>';
        	  }
        	  
        	  if($rs_lcampos->fields["tipc_id"]=='2')
        	  {
        	      //textarea
        	      echo '<div class="col-md-'.$rs_lcampos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcampos->fields["esca_nombre"]);
        		  echo '<textarea placeholder="'.utf8_encode($rs_lcampos->fields["esca_nombre"]).'" name="'.$rs_lcampos->fields["esca_nameid"].'x" id="'.$rs_lcampos->fields["esca_nameid"].'x"  class="form-control"   ></textarea>';
        		  echo '</div>';
        	  }
        	  
        	  if($rs_lcampos->fields["tipc_id"]=='6')
        	  {
        	      
        	      //textarea
        	      $ncampo_arch=$rs_lcampos->fields["esca_nameid"]."x";
        	      echo '<div class="col-md-'.$rs_lcampos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcampos->fields["esca_nombre"]);
        		  echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$ncampo_arch.'imagen" type="file" id="'.$ncampo_arch.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$ncampo_arch.$comilla_s.')" /></label></td><td><a href="javascript:subir_archivopath('.$comilla_s.$ncampo_arch.$comilla_s.','.$comilla_s.$table.$comilla_s.','.$comilla_s.$rs_lcampos->fields["esca_patharchivo"].$comilla_s.')" class="btn btn-default">Subir Archivo</a>  
					<input name="'.$ncampo_arch.'" id="'.$ncampo_arch.'"   type="hidden"   value=""   >	
					</td>
					<td><div class="messages'.$ncampo_arch.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (jpg,png,gif,pdf,doc)</div></td>
				  </tr>
				  </table>';
                  echo '<div class="showImage'.$ncampo_arch.'"></div>';
        		  
        		  echo '</div>';
        	  }
        	  
        	  $listav_campos.=$rs_lcampos->fields["esca_nameid"].",";
        	  $listavtitulos_campos.=$rs_lcampos->fields["esca_nombre"].",";
        	  
        	  if($rs_lcampos->fields["esca_obligatorio"]==1)
        	  {
        	  $listav_camposobl.=$rs_lcampos->fields["esca_nameid"].",";
			  $listav_camposoblnombre.=$rs_lcampos->fields["esca_nombre"].",";
        	  } 
        	  
        	  if($rs_lcampos->fields["tipda_id"]==2)
        	  {
        	    $listav_camposfecha.=$rs_lcampos->fields["esca_nameid"].",";
        	  }
        	  
        	  if($rs_lcampos->fields["tipc_id"]==6)
        	  {
        	    $listav_camposarchivo.=$rs_lcampos->fields["esca_nameid"].",";
        	    $listav_patharchivo.=$rs_lcampos->fields["esca_patharchivo"].",";
        	  }
        	  
               $rs_lcampos->MoveNext();
			}   
     }
     //busca campos
     ?>
     
   <input name="<?php echo $campo_id; ?>x" type="hidden" id="<?php echo $campo_id; ?>x" value="0" />   
</div>


<div class="form-group">	
<div class="col-md-12">

<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $test_id;  ?>('<?php echo $campo_enlace; ?>',0,1)"  style="background-color:#000066" >AGREGAR / GUARDAR</button>
<br><br>
<div id="lista_detalles_<?php echo $test_id;  ?>"> </div>
<div id="editar_detalles_<?php echo $test_id;  ?>" style="height:20px" ></div>   

<div id="guardarf_detalles_<?php echo $test_id;  ?>" style="height:20px" ></div>

<!-- <button  style="background-color:#000066" >Generar</button>
-->

<?php
//busca datos
$busca_datos="select * from ".$nbse.".".$tbl_fija." where standar_enlace='".$campo_enlace."'";
$rs_buscadata= $DB_gogess->executec($busca_datos,array());
//busca datos fijos generales

     $lista_camposfijos="select * from appg_fijaescala where test_id='".$test_id."'";
     $rs_lcamposfijos= $DB_gogess->executec($lista_camposfijos,array());
     if($rs_lcamposfijos)
     {
        while (!$rs_lcamposfijos->EOF)
			{
			     $link_g='';
			     $link_g="guarda_campo_".$test_id."('".$nbse."','".$tbl_fija."','".$rs_lcamposfijos->fields["esca_nameid"]."','".$campo_enlace."','".$sub_index."')";
			     
			     if($rs_lcamposfijos->fields["tipc_id"]=='3')
            	  {
            		  //select
            		  echo '<div id="despliegue_'.$rs_lcamposfijos->fields["esca_nameid"].'x" class="col-md-'.$rs_lcamposfijos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcamposfijos->fields["esca_nombre"]);
            		  echo '<select class="form-control" name="'.$rs_lcamposfijos->fields["esca_nameid"].'x" id="'.$rs_lcamposfijos->fields["esca_nameid"].'x"  onchange="'.$link_g.'" >';
            		  echo '<option value="" >--Seleccionar--</option>';
            		  $objformulario->fill_cmb($rs_lcamposfijos->fields["esca_tablatomadato"],$rs_lcamposfijos->fields["esca_camposdata"],@$rs_buscadata->fields[$rs_lcamposfijos->fields["esca_nameid"]],' '.$rs_lcamposfijos->fields["esca_ordendata"],$DB_gogess);
            		  echo '</select>';
            		  echo '</div>';
            	  }
            	  
            	  if($rs_lcamposfijos->fields["tipc_id"]=='1')
            	  { 
            	     //text    
            	      echo '<div class="col-md-'.$rs_lcamposfijos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcamposfijos->fields["esca_nombre"]);
            		  echo '<input placeholder="'.utf8_encode($rs_lcamposfijos->fields["esca_nombre"]).'" name="'.$rs_lcamposfijos->fields["esca_nameid"].'x" type="text" id="'.$rs_lcamposfijos->fields["esca_nameid"].'x" class="form-control" value="'.@$rs_buscadata->fields[$rs_lcamposfijos->fields["esca_nameid"]].'"  onblur="'.$link_g.'" />';
            		  echo '</div>';
            	  }
            	  
            	  if($rs_lcamposfijos->fields["tipc_id"]=='2')
            	  {
            	      //textarea
            	      echo '<div class="col-md-'.$rs_lcamposfijos->fields["esca_tamanioc"].'">'.utf8_encode($rs_lcamposfijos->fields["esca_nombre"]);
            		  echo '<textarea placeholder="'.utf8_encode($rs_lcamposfijos->fields["esca_nombre"]).'" name="'.$rs_lcamposfijos->fields["esca_nameid"].'x" id="'.$rs_lcamposfijos->fields["esca_nameid"].'x"  class="form-control"  onblur="'.$link_g.'" >'.@$rs_buscadata->fields[$rs_lcamposfijos->fields["esca_nameid"]].'</textarea>';
            		  echo '</div>';
            	  }
			    
			    
			    $rs_lcamposfijos->MoveNext();
			}
     }		



//busca datos fijos generales
?>
<p>&nbsp;</p>
</div>
</div>	



</div>
</div>

<?php

$campos_pathfile=array();
$campos_pathfile=explode(",",$listav_patharchivo);

$campos_datafile=array();
$campos_datafile=explode(",",$listav_camposarchivo);

$campos_dataedit=array();
$campos_dataedit=explode(",",$listav_campos);
$campo_id=$campo_id;

$campos_validaciongrid=array();
$campos_validaciongrid=explode(",",$listav_camposobl);

$campos_validaciongridnombre=array();
$campos_validaciongridnombre=explode(",",$listav_camposoblnombre);


$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$listavtitulos_campos);

$fie_camposfecha=array();
$fie_camposfecha=explode(",",$listav_camposfecha);

?>

<script language="javascript">
<!--
function guarda_campo_<?php echo $test_id;  ?>(base,table,campo,enlace,sub_index)
{
     
    $("#guardarf_detalles_<?php echo $test_id;  ?>").load("<?php echo $formulario_path; ?>guardar_standar.php",{
    enlace:enlace,
    base:base,
    table:table,
    campo:campo,
    valorcampo:$('#'+campo+'x').val(),
    sub_index:sub_index
     },function(result){       
    	
    
      });  
    
    $("#guardarf_detalles_<?php echo $test_id;  ?>").html("Espere un momento...");
     
     
}

function grid_editar_<?php echo $test_id;  ?>(enlacep,id_grid,opcionp)
{

$("#editar_detalles_<?php echo $test_id;  ?>").load("<?php echo $formulario_path; ?>editar_standarplus.php",{
enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fie_id:'<?php echo $test_id;  ?>',
<?php echo $campo_id; ?>x:id_grid

 },function(result){       
	$('#<?php echo $campo_id; ?>x').val($('#<?php echo $campo_id; ?>xval').val());
	<?php
	for($i=0;$i<count($campos_dataedit);$i++)
	 {
		if($campos_dataedit[$i])
		{
		 echo "$('#".$campos_dataedit[$i]."x').val($('#".$campos_dataedit[$i]."xval').val());";
		} 
	 }
	 
	for($i=0;$i<count($campos_datafile);$i++)
	 {
		if($campos_datafile[$i])
		{

		 echo "$('.showImage".$campos_datafile[$i]."x').html('&nbsp;<a href=\"".$campos_pathfile[$i]."'+$('#".$campos_datafile[$i]."xval').val()+'\" target=\"_blank\" class=\"thumbnail\" ><img src=\"images/file.png\" alt=\"125x125\" width=\"32px\" ></a>')";
		 
		} 
	 }	 
	 
	 
	?>

  });  

$("#editar_detalles_<?php echo $test_id;  ?>").html("Espere un momento...");

}


function grid_extras_<?php echo $test_id;  ?>(enlacep,id_grid,opcionp)
{

if(opcionp==1)
{
//validaciones
   <?php
	for($i=0;$i<count($campos_validaciongrid);$i++)
	 {
		 if($campos_validaciongrid[$i])
		 {
		 echo "		 
		  if($('#".$campos_validaciongrid[$i]."x').val()=='')
		  {
		   var titulo_data='".utf8_encode($campos_validaciongridnombre[$i])."';
		   alert('Campo Obligarorio ('+titulo_data+'))...');
		   return false;
		  }
		 ";
		 }
		 
	 }
	?>
  
}


if(opcionp==2)
{

	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}


$("#lista_detalles_<?php echo $test_id;  ?>").load("<?php echo $formulario_path; ?>grid_genstandar.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
<?php echo $campo_id; ?>x:$('#<?php echo $campo_id; ?>x').val(),
<?php
for($i=0;$i<count($campos_dataedit);$i++)
	 {
	    if($campos_dataedit[$i])
	    {
	     echo $campos_dataedit[$i]."x:$('#".$campos_dataedit[$i]."x').val(),
		";
	    }
	 }
	 
	 
?>
fie_id:'<?php echo $test_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'

 },function(result){       
	<?php
	echo " $('#".$campo_id."x').val(''); 
	";
    for($i=0;$i<count($campos_dataedit);$i++)
	 {
		if($campos_dataedit[$i])
		{
		echo " $('#".$campos_dataedit[$i]."x').val(''); 
		";
		}
	 }
	 
	
	for($i=0;$i<count($campos_datafile);$i++)
	 {
		if($campos_datafile[$i])
		{

		 echo "$('.showImage".$campos_datafile[$i]."x').html('')";
		 
		} 
	 } 
	 
     ?>	
     
  });  

$("#lista_detalles_<?php echo $test_id;  ?>").html("Espere un momento...");

}


//-->
</script>

<script type="text/javascript">
<!--
<?php


for($i=0;$i<count($fie_camposfecha);$i++)
	 {
		if($fie_camposfecha[$i])
		{
		
		   echo "$('#".$fie_camposfecha[$i]."x').datepicker({dateFormat: 'yy-mm-dd'});
		 " ;
		
		}
	 }


?>

 grid_extras_<?php echo $test_id;  ?>('<?php echo $campo_enlace; ?>',0,0);

//  End -->
</script>


