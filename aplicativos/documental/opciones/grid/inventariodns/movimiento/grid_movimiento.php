<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<style type="text/css">
<!--
table.dataTable tbody th, table.dataTable tbody td {
    padding: 1px 10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
}
-->
</style>
<?php
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$carpeta='movimiento';
$tabla="dns_movimientoinventario";
$tabla_vista="dns_movimientoinventario_vista";
$subindice="_movimiento";
$campos_paragrid="'moviin_id','centro_id','tipom_nombre','tipomov_nombre ','moviin_nlote','moviin_fechadecaducidad','moviin_fecharegistro','centrorecibe_cantidad','moviin_totalenunidadconsumo'";
$campo_id="moviin_id";
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
$boto_borrar=1;

//Crea tabla para grid
$objgrid_fk->campos_visualizar=$campos_paragrid;
$ordenlistado="order by ".$campo_id." desc";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);
echo '<div align="center"><table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><br>';
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;" align="center" >'.$ntabla.'</div><br>';
echo '<table id="datatable1'.$tabla.'" class="display" cellspacing="0" width="100%"><thead><tr>';
echo '<th >Editar</th>';
if($boto_borrar)
{

echo '<th >Borrar</th>';

}
		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
		 echo '<th>'.$objgrid_fk->arrcampos_titulo[$i].'</th>';

	}            

echo '</tr></thead>';
echo '<tfoot><tr>';
echo '<th >Editar</th>';

if($boto_borrar)
{

echo '<th >Borrar</th>';
}

		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{

		 echo '<th>'.$objgrid_fk->arrcampos_titulo[$i].'</th>';

	}            

echo '</tr></tfoot>';		
echo '</table>';
echo '</td>
  </tr>
</table></div>';

$concatena_camp='';
$concatena_data='';


foreach($objgrid_fk->arrcampos_nombre as $camposdata): 

if($campo_id==$camposdata)
	 {
	  $concatena_camp.= '{ "data": "'.$camposdata.'","visible": false },';

	 }
	 else
	 {
	  $concatena_camp.= '{ "data": "'.$camposdata.'" },';
	  }

	  $concatena_data.=$camposdata.",";

endforeach; 



//filtros



if(@$_POST['cuadrobm_id'])
{

   $sql1="cuadrobm_id = '".@$_POST['cuadrobm_id']."' and ";

}

if(@$_POST['centro_id'])
{

   $sql2="centro_id = '".@$_POST['centro_id']."' and ";

}




@$sqltotal=$sql1.$sql2.$sql3;
$sqltotal=substr($sqltotal,0,-4);
$filtro_data=base64_encode($sqltotal);

//filtros
?>
<script type="text/javascript">
<!--

 $('#datatable1<?php echo $tabla; ?>').DataTable( {



        "language": {



            "lengthMenu": "Ver _MENU_ registros por pag.",



            "zeroRecords": "No hay registros - sorry",



            "info": "Pag. _PAGE_ de _PAGES_",



            "infoEmpty": "No records available",



            "infoFiltered": "(filtered from _MAX_ total records)",



			"sSearch": "Buscar:",



			"oPaginate": {



				"sFirst":    	"Primero",



				"sPrevious": 	"Anterior",



				"sNext":     	"Siguiente",



				"sLast":     	"Ultimo"



			}



        },



        "processing": true,



        "serverSide": true,



        "ajax": {



            "url": "../../../../../libreria/grid/scripts/post.php",



			"data": function ( d ) {



                d.tabla= "<?php echo $tabla_vista; ?>";



                d.id= "<?php echo $campo_id; ?>";



				d.lista="<?php echo $concatena_data; ?>";



				d.filtro="<?php echo $filtro_data; ?>";



            },



            "type": "POST"



        },



        "columns": [



		{ 



		"targets": -1,



		"data":null,



		"defaultContent":"<button></button>",



		"mRender": function (data,type,full)



				{



				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="desplegar_formulario('+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><center><img src="../../../../../images/editar.png"  /></center></td></tr></table>';



				}



		 }



		 <?php 



		 if($boto_borrar)



		 {



		 ?>



		 ,



		 { 



		"targets": -1,



		"data":null,



		"defaultContent":"<button></button>",



		"mRender": function (data,type,full)



				{



				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro_movimiento(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\','+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><center><img src="../../../../../images/delete.png"  /></center></td></tr></table>';



				}



		 }



		 <?php



		 }



		 ?>



		 ,



          <?php



		  echo substr($concatena_camp,0,-1);



		  ?>    



        ]



    } );







-->



</script>



 <div id="divBody_causasdet" ></div>



 



 <div id="divBody_arbidet" ></div>



<?php



}



else



{



echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000 ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';



}



?>