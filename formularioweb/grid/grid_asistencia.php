<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<style type="text/css">
body{ 
   font-family:Verdana, Arial, Helvetica, sans-serif; 
   font-size:11px;
       
   }
 </style> 
<?php
if(@$_SESSION['formularioweb_usua_id'])
{
//-------------------------------------------------------------------


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$carpeta='usuario';
$tabla="app_cliente";
$tabla_vista="app_cliente_vista";
$subindice="_cliente";
$campos_paragrid="'clie_registro','clie_rucci','clie_nombre','clie_apellido','clie_registrado'";
$campo_id="clie_id";
$sqltotal="";

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{

include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

} 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$ntabla= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_title"," where tab_name like",$tabla,$DB_gogess);
$comillasimple="'";

//echo $_SESSION['formularioweb_jobt_id'];
if($_SESSION['formularioweb_jobt_id']==2)
{
$boto_borrar=1;
}
else
{
$boto_borrar=0;
}


$objgrid_fk->campos_visualizar=$campos_paragrid;
$ordenlistado="order by ".$campo_id." desc";
$ordenlistado="";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);
$comill_s="'";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_cliente.php'.$comill_s.','.$comill_s.'EMPRENDIMIENTO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,0,0,0,0,0,0)" style=cursor:pointer';	


//$_SESSION['formularioweb_even_id'];

$nevento= $objformulario->replace_cmb("app_eventos","even_id,even_nombre"," where even_id =",$_SESSION['formularioweb_even_id'],$DB_gogess);
echo $nevento."<br>";
echo $_SESSION['formularioweb_fecha_valor'];

echo '<table id="datatable1'.$tabla.'" class="display responsive cell-border" cellspacing="0"  width="100%">
<thead><tr>';
echo '<th >Editar</th>';
if($boto_borrar)
{
echo '<th >Borrar</th>';
}
echo '<th >Asistencia</th>';
//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
{

	 echo '<th>'.utf8_encode($objgrid_fk->arrcampos_titulo[$i]).'</th>';


}            
echo '</tr></thead>';
$suma_asiste=0;
$suma_noasiste=0;
$ver_registro=1;
$listado_asistentes="select * from 	app_cliente";
$rs_asistentes = $DB_gogess->executec($listado_asistentes,array());
  if($rs_asistentes)
			{
			
				while (!$rs_asistentes->EOF) 
				{
				
				 $busca_asistencia="select * from app_asistencia where asis_fecharegistro='".$_SESSION['formularioweb_fecha_valor']."' and even_id=".$_SESSION['formularioweb_even_id']." and clie_id=".$rs_asistentes->fields["clie_id"];
				  $rs_basistencia = $DB_gogess->executec($busca_asistencia,array());
				  
				  if($rs_basistencia->fields["asis_asiste"]==1)
				  {
				    $suma_asiste++;
				  
				  }
				  else
				  {
				    $suma_noasiste++;
				  
				  }
				  
				  
				if($_POST["pVar1"]==1)
				{
				   if($rs_basistencia->fields["asis_asiste"]==1)
				   {
				      $ver_registro=1;
				   }
				   else
				   {
				   
				     $ver_registro=0;
				   }
				}
				
				
				if($_POST["pVar1"]==2)
				{
				   if($rs_basistencia->fields["asis_asiste"]==1)
				   {
				      $ver_registro=0;
				   }
				   else
				   {
				   
				     $ver_registro=1;
				   }
				}
				
				if($ver_registro==1)
				{
				
				  echo '<tr>
				  <td>';
				  echo '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'formulario/datos_cliente.php\',\'Editar\',\'divBody_lista\','.$rs_asistentes->fields[$campo_id].',0,0,0,0,0,0)" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';
				  
				  echo '</td>';
				  if($boto_borrar)
                  {
				  echo '<td>';
				  
				  echo '<div onclick="borrar_registro(\''.$tabla.'\',\''.$campo_id.'\','.$rs_asistentes->fields[$campo_id].')" style=cursor:pointer ><img src="images/delete.png"  /></div>';
				  
				  echo '</td>';
				  }
				  
				  
				  echo '<td>';
				  
	
				  
                  if($rs_basistencia->fields["asis_asiste"]==1)
				  {
				  echo '<div id="activa_plan_'.$rs_asistentes->fields[$campo_id].'" onclick="activar_desactivar('.$rs_asistentes->fields[$campo_id].','.$_SESSION['formularioweb_even_id'].',\''.$_SESSION['formularioweb_fecha_valor'].'\')" style=cursor:pointer ><img src="images/on.png"  /></div>';
				  }
				  else
				  {
				  echo '<div id="activa_plan_'.$rs_asistentes->fields[$campo_id].'" onclick="activar_desactivar('.$rs_asistentes->fields[$campo_id].','.$_SESSION['formularioweb_even_id'].',\''.$_SESSION['formularioweb_fecha_valor'].'\')" style=cursor:pointer ><img src="images/off.png"  /></div>';
				  
				  }
				  
				  
				  echo '</td>';
				  
				  
				  for ($i=0;$i<count($objgrid_fk->arrcampos_nombre);$i++)
				  {
						 echo '<td>'.utf8_encode($rs_asistentes->fields[$objgrid_fk->arrcampos_nombre[$i]]).'</td>';
				
				   }   
				   
				   echo '</tr>';
				   
				   }
				   
				  $rs_asistentes->MoveNext();
				}
			
			
			}


echo '<tfoot><tr>';
echo '<th >Editar</th>';
if($boto_borrar)
{
echo '<th >Borrar</th>';
}
echo '<th >Asistencia</th>';
//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';
for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
  {
		 echo '<th>'.utf8_encode($objgrid_fk->arrcampos_titulo[$i]).'</th>';

	}            

echo '</tr></tfoot>';		

echo '</table>';

echo '</div>';


echo "<b>Total asistieron:</b>".$suma_asiste."<br>";
echo "<b>Total no asistieron:</b>".$suma_noasiste;

?>
<script type="text/javascript">
<!--
$(document).ready(function() {

$('#datatable1<?php echo $tabla; ?>').DataTable( {
    "order": [[ 6, "desc" ]],
    responsive: true
} );


} );
-->
</script>
<?php
//---------------------------------------------------------------------
}
?>