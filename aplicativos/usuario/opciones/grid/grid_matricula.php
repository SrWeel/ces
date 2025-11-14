<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director="../../../../";
include ("../../../../cfgclases/clases.php");
$comillasimple="'";
//saca datos de empresa para filtrar

//armasql busqueda


   $sql1="alu_id = ".$_SESSION['ces1313777_sessid_inicio']." and ";


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

$subindice="_matricula";
$tabla="kyr_matricula";
$objgrid_fk->campos_visualizar="'matr_id','alu_id','estr_id','estdm_id','matr_pagado','matr_fecha'";
$ordenlistado="order by matr_id desc";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data("kyr_matricula","","","",90,$sqltotal,$DB_gogess);


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
	
?>	
	
<?php	
	
echo '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>';
	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Opciones</td>';
		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
	     echo '<td width="139" background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'</td>';
	
	}
	      
   
	echo '</tr>';
	
	if(count($objgrid_fk->filas)>0)
	   {
	   foreach($objgrid_fk->filas as $datoslista): 
	   
	   
	   
	   echo '<tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor="#ffffff" onmouseover=this.style.cursor="hand";this.style.backgroundColor="#d4d0c8" >';
	   
		 $linkeditar= 'onclick=abrir_standar("aplications/usuario/opciones/extras/notas.php","Editar","divBody_notas","divDialog_notas",990,500,'.$datoslista["matr_id"].',0,0,0,0,0,0) style=cursor:pointer';
		 
		
			echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';
		echo '<center><img src="images/opciones/opcion.png"  /></center>';
		echo '</span></td>';

       $linkborrar= 'onclick=borrar_registro("'.$tabla.'","matr_id","'.$datoslista["matr_id"].'") style=cursor:pointer';
	   
	  // echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';
		//echo '<center><img src="images/opciones/borrar.png"  /></center>';
		//echo '</span></td>';
		
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
