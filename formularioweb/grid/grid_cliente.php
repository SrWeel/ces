ssss<?php
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


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$carpeta='usuario';
$tabla="app_cliente";
$tabla_vista="app_cliente_vista";
$subindice="_cliente";
$campos_paragrid="'clie_id','clie_nombre','clie_apellido','asiste','clie_registrado'";
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


//Crea tabla para grid

$objgrid_fk->campos_visualizar=$campos_paragrid;
$ordenlistado="order by ".$campo_id." desc";
$ordenlistado="";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);
$comill_s="'";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_cliente.php'.$comill_s.','.$comill_s.'EMPRENDIMIENTO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,0,0,0,0,0,0)" style=cursor:pointer';	



//echo '<div align="center">';

//echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span> Agregar</button>';



//echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;" align="center" >'.$ntabla.'</div><br>';




echo '<table id="datatable1'.$tabla.'" class="display responsive cell-border" cellspacing="0"  width="100%"><thead><tr>';
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







$concatena_camp='';



$concatena_data='';



foreach($objgrid_fk->arrcampos_nombre as $camposdata): 

//if($campo_id==$camposdata or $camposdata=='total_aclara')





if(   $camposdata=='clie_id' or $camposdata=='requ_fecharegistro' or $camposdata=='asiste')
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





//$sql1="	even_id in ('0','".@$_SESSION['formularioweb_even_id']."') and (asis_fecharegistro =curdate() or asis_fecharegistro is null) and ";







@$sqltotal=$sql1.$sql2.$sql3.$sql4.$sql5;



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



            "url": "../libreria/grid/scripts/post.php",



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

				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'formulario/datos_cliente.php\',\'Editar\',\'divBody_lista\','+full["<?php echo $campo_id ?>"]+',0,0,0,0,0,0)" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';	

				}

		 },
		 <?php 



		 if($boto_borrar)
{



		 ?>

		 { 



		"targets": -1,



		"data":null,



		"defaultContent":"<button></button>",



		"mRender": function (data,type,full)



				{



				 return '<div onclick="borrar_registro(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\','+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><img src="images/delete.png"  /></div>';



				}



		 },



		 <?php



		 }



		 ?>
 
{ 



		"targets": -1,



		"data":null,



		"defaultContent":"<button></button>",



		"mRender": function (data,type,full)

              {


                  if(full["asiste"]==1)
				  {
				  return '<div id="activa_plan_'+full["<?php echo $campo_id ?>"]+'" onclick="activar_desactivar('+full["<?php echo $campo_id ?>"]+',<?php echo   $_SESSION['formularioweb_even_id']; ?>,\'<?php echo   $_SESSION['formularioweb_fecha_valor']; ?>\')" style=cursor:pointer ><img src="images/on.png"  /></div>';
				  }
				  else
				  {
				  return '<div id="activa_plan_'+full["<?php echo $campo_id ?>"]+'" onclick="activar_desactivar('+full["<?php echo $campo_id ?>"]+',<?php echo   $_SESSION['formularioweb_even_id']; ?>,\'<?php echo   $_SESSION['formularioweb_fecha_valor']; ?>\')" style=cursor:pointer ><img src="images/off.png"  /></div>';
				  
				  }
				 



				}



		 },
		 

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



echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000 ">La sesi&oacute;n a caducado de clic en F5 para continuar</div>';



}



?>