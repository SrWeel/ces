<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
//base datos
$director="../../../../";
include ("../../../../cfgclases/clases.php");

//parametros
$subindice="_report";
//parametros

//saca datos de empresa para filtrar
$idempresa=$objformulario->replace_cmb("factur_usuarios","usua_id,em_id","where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
//saca datos de empresa para filtrar


//armasql busqueda
if($_POST["rept_nombre_val"])
{
   $sql1="rept_nombre like '%".$_POST["rept_nombre_val"]."%' and ";
}
if($_POST["rept_activo_val"]=='0' or $_POST["rept_activo_val"]=='1')
{
   
   $sql2="rept_activo = ".$_POST["rept_activo_val"]." and ";
}



$sqltotal=$sql1.$sql2.$sql3.$sql4;
$sqltotal=substr($sqltotal,0,-4);


//armasql busqueda


$tabla="kyradm_report";
$objgrid_fk->campos_visualizar="'rept_id','rept_nombre','rept_activo'";
$objgrid_fk->orden="order by rept_id desc";
$objgrid_fk->leer_data($tabla,"","","",100,$sqltotal,$DB_gogess);

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
	<div align="center"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Opciones</td>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
	     echo '<td width="239" background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'<img src="libreria/grid/fondo.png" align="absmiddle" /></td>';
	
	}
    
   
	echo '</tr>';
	
	if(count($objgrid_fk->filas)>0)
	   {
	   foreach($objgrid_fk->filas as $datoslista): 
	   
	   $comillasimple="'";
	   
	   echo '<tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor="#ffffff" onmouseover=this.style.cursor="hand";this.style.backgroundColor="#d4d0c8" >';
	   
	
		$linkeditar='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Editar","divBody'.$subindice.'","divDialog'.$subindice.'",880,600,'.$comillasimple.$datoslista["rept_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';
			
		
	   echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/opcion.png"  /></center>';
		echo '</span></td>';
		
	    $linkborrar= 'onclick=borrar_registro("'.$tabla.'","rept_id","'.$datoslista["rept_id"].'") style=cursor:pointer';
	   
	    echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/borrar.png"  /></center>';
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
		
        echo '<td class="borde_grid" height="28" ><span class="css_listatxt">'.$rmp.'</span></td>';
	
	    endforeach; 
	
	    $comillasimple="'";
	
		
		
		//echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';
		//echo '<center><img src="images/editar.png"  /></center>';
		//echo '</span></td>';
	 
	   // echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';  
	    //echo '<center><img src="images/borrar_grid.png"  /></center>';   
	   // echo '</span></td>';
	   


		
		
	   
       //despliega campos
       echo '</tr>';
  
	   endforeach; 
	   
	   }
	
    echo '</table></div>';    

?>

