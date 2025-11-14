<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director="../../../../../";
include ("../../../../../cfgclases/clases.php");
$comillasimple="'";
//saca datos de empresa para filtrar

//armasql busqueda





if($_POST["bu_nombre"])
{
   $sql1="ei_nombre_equipo like '".$_POST["bu_nombre"]."' and ";
}


if($_POST["bu_numparte"])
{
   $sql2="ei_numero_parte like '".$_POST["bu_numparte"]."' and ";
}


if($_POST["bu_numserie"])
{
   $sql3="ei_numero_serie like '".$_POST["bu_numserie"]."' and ";
}
/*if($_POST["nivel2_val"])
{
   $sql1="parent_id = ".$_POST["nivel2_val"]." and ";
}

if($_POST["nivel3_val"])
{
   $sql2="id = ".$_POST["nivel3_val"]." and ";  
}*/

$sqltotal=$sql1.$sql2.$sql3;
$sqltotal=substr($sqltotal,0,-4);



//armasql busqueda

$subindice="_equipos_inventario";
$tabla="ca_equipos_inventario";
$campoidtabla="ei_id";
$objgrid_fk->campos_visualizar="'ei_id','ei_nombre_equipo','ei_numero_parte','ei_numero_serie','bo_id','em_id','eq_id'";
$ordenlistado="order by ei_id desc";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data($tabla,"","","",90,$sqltotal,$DB_gogess);


echo '
	<style type="text/css">
<!--
.css_listatxt {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.borde_grid {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #CCCCCC;
}
-->
</style>
	<div align="center">';
	
?><?php	
	
echo '<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Selecionar</td>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Ver</td>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Partes</td>';
	
		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
	    echo '<td width="139" background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'</td>';
	
	}
	      
   
	echo '</tr>';
	
	if(count($objgrid_fk->filas)>0)
	   {
	   foreach($objgrid_fk->filas as $datoslista): 
	   
	   
	   
	   echo '<tr  >';
	   
		// $linkeditar= 'onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Editar","divBody'.$subindice.'","divDialog'.$subindice.'",990,600,'.$datoslista[$campoidtabla].',0,0,0,0,0,0) style=cursor:pointer';
		 
		$linkeditar= " onclick= formulario_uno('".$datoslista[$campoidtabla]."')  style=cursor:pointer ";
		
		
		$linkparte= " onclick= desplegar_gr_partes('".$datoslista[$campoidtabla]."')  style=cursor:pointer ";
		
		echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';
		echo '<center><input name="seleccion_" type="checkbox" id="seleccion_" value="1" /></center>';
		echo '</span></td>';
	
		
		echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/telf.png"  /></center>';
		echo '</span></td>';

       $linkborrar= 'onclick=borrar_registro_data("'.$tabla.'","'.$campoidtabla.'","'.$datoslista[$campoidtabla].'") style=cursor:pointer';
	   
	    echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/borrar.png"  /></center>';
		echo '</span></td>';
		
		echo '<td class="borde_grid" height="28" width="30px" '.$linkparte.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/partes.png"  /></center>';
		echo '</span></td>';
		
	    foreach($objgrid_fk->arrcampos_nombre as $camposdata): 
	   
	   //despliega campos
	   
	    $objformulario->form_format_field($tabla,$camposdata,$DB_gogess);
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[$camposdata];			 
			      }	
		
        echo '<td class="borde_grid" height="28" ><span class="css_listatxt">'.utf8_encode($rmp).'</span></td>';
	
	    endforeach; 
	
	 
	  
	     
	   
       //despliega campos
       echo '</tr>';
  
	   endforeach; 
	   
	   }
	
    echo '</table></div>';    

?>
<div id=div_body_ncert ></div>
<div id=divBody_ingreso ></div>
