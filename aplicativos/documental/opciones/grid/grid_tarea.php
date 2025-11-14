<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";
//saca datos de empresa para filtrar

//armasql busqueda



if(@$_POST["pVar2"])
{
	$sql1="proy_id = ".@$_POST["pVar2"]." and ";
	
	
}

/*if($_POST["nivel2_val"])
{
   $sql1="parent_id = ".$_POST["nivel2_val"]." and ";
}

if($_POST["nivel3_val"])
{
   $sql2="id = ".$_POST["nivel3_val"]." and ";  
}*/

@$sqltotal=$sql1.$sql2.$sql3;
$sqltotal=substr($sqltotal,0,-4);



//armasql busqueda

$subindice="_tarea";
$tabla="media_tarea";
$objgrid_fk->campos_visualizar="'tare_id','tare_nombre','tare_fechainicio','tare_fechafin','estad_id'";
$ordenlistado="order by tare_id desc";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data("media_tarea","","","",90,$sqltotal,$DB_gogess);


echo '<div align="center">';
	
echo '<br><br><div class="panel panel-default" style="width:900px" >
<div class="panel-heading">REGISTROS
                     </div>
<div class="panel-body"><table  id="datatable1" class="table table-striped table-hover" >';
echo '<thead>
    <tr>';
	echo '<th >Opciones</th>';
	echo '<th >Responsables</th>';
		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
	      if($objgrid_fk->arrcampos_tipo[$i]=="int")
		  {
			 $orden_col='class="sort-numeric"';  
		  }
		  else
		  {
			   $orden_col='class="sort-alpha"';  
		  }
		 
		 echo '<th '.$orden_col.' >'.$objgrid_fk->arrcampos_titulo[$i].'</th>';
	
	}
	      
   
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	if(count(@$objgrid_fk->filas)>0)
	   {
	   foreach($objgrid_fk->filas as $datoslista): 
	   
	   echo '<tr>';
	   
		 $linkeditar= 'onclick=abrir_standar("aplicativos/documental/opciones/grid/grid'.$subindice.'_nuevo.php","Editar","divBody'.$subindice.'","divDialog'.$subindice.'",800,500,'.$datoslista["tare_id"].',0,0,0,0,0,0) style=cursor:pointer';
		 
		 $link_asignado= 'onclick=abrir_standar("aplicativos/documental/opciones/proyecto_code/tarea.php","Tareas","divBody'.$subindice.'","divDialog_tarea",800,500,'.$datoslista["tare_id"].',0,0,0,0,0,0) style=cursor:pointer';
		 
		
			echo '<td '.$linkeditar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/opcion.png"  /></center>';
		echo '</span></td>';
		
		echo '<td '.@$linktarea.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/tarea.png"  /></center>';
		echo '</span></td>';

       $linkborrar= 'onclick=borrar_registro("'.$tabla.'","tare_id","'.$datoslista["tare_id"].'") style=cursor:pointer';
	   
	  // echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';
		//echo '<center><img src="images/opciones/borrar.png"  /></center>';
		//echo '</span></td>';
		
	    foreach($objgrid_fk->arrcampos_nombre as $camposdata): 
	   
	   //despliega campos
	   
	    $objformulario->campo_gogess($tabla,$camposdata,$DB_gogess);
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[$camposdata];			 
			      }	
		
        echo '<td ><span class="css_listatxt">'.utf8_encode($rmp).'</span></td>';
	
	    endforeach; 
	
	 
	  
	     
	   
       //despliega campos
       echo '</tr>';
  
	   endforeach; 
	   
	   }
	
    echo '</tbody>';
	

	echo '</table></div></div></div>';    

?>
<div id=div_body_ncert ></div>
<div id="divBody_tarea" ></div>
