<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
 $sql1='';
 $sql2='';
 $sql3='';
 $sql4='';
 
 $tipofor_id=0;
 $mnupan_id=$_POST["pVar3"];
 $namemodulo=$_POST["namemodulo"];


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
//include(@$director."libreria/estructura/aqualis_master.php");

//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar3"]));

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$lista_tabla_vista="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tabgrid_id"];
$rs_tabla_vista = $DB_gogess->executec($lista_tabla_vista,array());

//saca datos de la tabla


$tabla=$rs_tabla->fields["tab_name"];

if($rs_tabla_vista->fields["tab_name"])
{
$tabla_vista=$rs_tabla_vista->fields["tab_name"];
}
else
{
$tabla_vista=$rs_tabla->fields["tab_name"];
}


$campos_paragrid=$rs_datosmenu->fields["mnupan_campogrid"];
$campo_id=$rs_tabla->fields["tab_campoprimario"];

$sqltotal="";


 //for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
  //{

  //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

  //} 

$objformulario= new  ValidacionesFormulario();
//$objformulario->sisfield_arr=$gogess_sisfield;
//$objformulario->sistable_arr=$gogess_sistable;
//$ntabla= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_title"," where tab_name like",$tabla,$DB_gogess);
$comillasimple="'";
$boto_borrar=0;

//echo $_SESSION['ces1313777_jobt_id'];
if($_SESSION['ces1313777_jobt_id']==2)
{
$boto_borrar=1;
}
else
{
$boto_borrar=0;
}

$boto_borrar=1;

//Crea tabla para grid

$objgrid_fk->campos_visualizar=$campos_paragrid;

$ordenlistado="order by ".$campo_id." desc";

$objgrid_fk->orden=$ordenlistado;

$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);


//=============================================================

$array_data[0]["titulo"]="Fecha";
$array_data[0]["col"]="3";
$array_data[0]["campo"]="comcont_fecha";
$array_data[0]["tipo"]="fecha";
$array_data[0]["tablacmb"]="gogess_sino";
$array_data[0]["campocmb"]="value,etiqueta";
$array_data[0]["orderby"]="";

$array_data[1]["titulo"]="Concepto";
$array_data[1]["col"]="2";
$array_data[1]["campo"]="comcont_concepto";
$array_data[1]["tipo"]="text";
$array_data[1]["tablacmb"]="";
$array_data[1]["campocmb"]="";
$array_data[1]["orderby"]="";

$array_data[2]["titulo"]="N&uacute;mero de comprobante";
$array_data[2]["col"]="2";
$array_data[2]["campo"]="comcont_numeroc";
$array_data[2]["tipo"]="text";
$array_data[2]["tablacmb"]="";
$array_data[2]["campocmb"]="";
$array_data[2]["orderby"]="";

$array_data[3]["titulo"]="Estado";
$array_data[3]["col"]="3";
$array_data[3]["campo"]="comcont_estado";
$array_data[3]["tipo"]="text";
$array_data[3]["tablacmb"]="";
$array_data[3]["campocmb"]="";
$array_data[3]["orderby"]="";



$funcion_buscar="desplegar_grid_asientos();";
$col_buscar="3";

$formualrio_dspl=$objBuscadorfunciones->creaform_buscador($_POST,$col_buscar,$funcion_buscar,$array_data,$DB_gogess);

echo $formualrio_dspl;

//=============================================================


echo '';
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;" align="center" ><br><br></div><br>';
echo '<table id="datatable1" class="display responsive cell-border" cellspacing="0" width="100%">
<thead><tr>';
//echo '<th >Imprimir </th>';
echo '<th >Editar</th>';
if($boto_borrar)
{

echo '<th >Borrar</th>';

}

		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{

		 echo '<th>'.utf8_encode($objgrid_fk->arrcampos_titulo[$i]).'</th>';

	}            

echo '</tr></thead>';
echo '<tfoot><tr>';
//echo '<th >Imprimir</th>';
echo '<th >Editar</th>';

if($boto_borrar)
{

echo '<th >Borrar</th>';

}


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
//$campo_id==$camposdata or
if( $camposdata=='emp_id')

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


if($rs_datosmenu->fields["mnupan_campoenlace"])
{

if(@$_SESSION['ces1313777_sessid_emp_id'])
{

  $sql1=$rs_datosmenu->fields["mnupan_campoenlace"]." = ".@$_SESSION['ces1313777_sessid_emp_id']." and ";

}

}


//----------------------------------------------------------------------------------------
//print_r($_POST);
$campos_bu=$_POST["campos_bu"];

$concatena_sqlb='';
if($campos_bu)
{
 $listado_buscador=array();
 $listado_buscador=explode(",",$campos_bu);
 
 for($z=0;$z<count($listado_buscador);$z++)
 {
    
	$saca_tipodata=array();
	$saca_tipodata=explode("|",$listado_buscador[$z]);
	
	
	    
		  switch ($saca_tipodata[1]) {
			  case 'fecha':
				{
				   $fechai=str_replace("_x","inicio_x",$saca_tipodata[0]);
				   $fechaf=str_replace("_x","fin_x",$saca_tipodata[0]);
				   //echo $fechai.":".$_POST[$fechai]."<br>";
				   //echo $fechaf.":".$_POST[$fechaf]."<br>";
				   if(trim($_POST[$fechai])!='' and trim($_POST[$fechaf])!='')
				   {
				   
				     $concatena_sqlb.= " (".str_replace("_x","",$saca_tipodata[0]).">='".$_POST[$fechai]."' and ".str_replace("_x","",$saca_tipodata[0])."<='".$_POST[$fechaf]."') and ";
					 
				   }
				   else
				   {
				      if(trim($_POST[$fechai])!='')
					  {					  
					    $concatena_sqlb.= " (".str_replace("_x","",$saca_tipodata[0]).">='".$_POST[$fechai]."') and ";
					  }
					  else
					  {
					    if(trim($_POST[$fechaf])!='')
					     { 	
					        $concatena_sqlb.= " (".str_replace("_x","",$saca_tipodata[0])."<='".$_POST[$fechaf]."') and ";	
						 }			  
					  }				   
				   }
				   
				}
				break;
			  case 'text':
				{
				   if($_POST[$saca_tipodata[0]])
	                {		
				       $concatena_sqlb.= " ".str_replace("_x","",$saca_tipodata[0])." like '%".$_POST[$saca_tipodata[0]]."%' and ";
					 } 
				
				}	
				break;
			  case 'textarea':
				{
				   if($_POST[$saca_tipodata[0]])
	                {		
				       $concatena_sqlb.= " ".str_replace("_x","",$saca_tipodata[0])." like '%".$_POST[$saca_tipodata[0]]."%' and ";
					 } 
				
				}	
				break; 	
			  default:
				{	
					if($_POST[$saca_tipodata[0]])
	                {		
				       $concatena_sqlb.= " ".str_replace("_x","",$saca_tipodata[0])." ='".$_POST[$saca_tipodata[0]]."' and ";
					 }  
				}
			}
		  
	
 }
 
}
//----------------------------------------------------------------------------------------


@$sqltotal=$sql1.$sql2.$sql3.$sql4.$concatena_sqlb;
$sqltotal=substr($sqltotal,0,-4);
$filtro_data=base64_encode($sqltotal);

//filtros
?>

<script type="text/javascript">
<!--

 $('#datatable1').DataTable( {
        "order": [[ 3, "desc" ]], 
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

            "url": "libreria/grid/scripts/post.php",
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

				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_<?php echo $namemodulo; ?>.php\',\'Editar\',\'divBody_interno_<?php echo $_POST["namemodulo"]; ?>\','+full["<?php echo $campo_id ?>"]+',\'0\',\'<?php echo @$_POST["pVar3"]; ?>\',\'\',0,\'0\',\'0\')" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';

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

                  if(full["tipoa_id"]==6)
					{					
					
				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\','+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><center><img src="images/delete.png"  /></center></td></tr></table>';
				 
				    }
					else
					{
				return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td ><center></center></td></tr></table>';	
					
					}

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





function borrar_registro(tabla,campo,valor)
{

 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 

	 $("#grid_borrar").load("aplicativos/documental/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){  
    desplegar_grid_asientos();

  });  

  $("#grid_borrar").html("Espere un momento...");    

  }

}

-->
</script>

 <div id="divBody_causasdet" ></div>
 <div id="divBody_arbidet" ></div>

<?php

}

else

{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}

?>