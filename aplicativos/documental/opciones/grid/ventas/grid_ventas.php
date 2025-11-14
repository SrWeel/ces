<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$sql1='';
$sql2='';
$sql3='';

//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));


$orden_grid=array();
$coloum_ord='';
$ascdesc_ord='';
if($rs_datosmenu->fields["mnupan_nordengrid"])
{
$orden_grid=explode("-",$rs_datosmenu->fields["mnupan_nordengrid"]);
$coloum_ord=$orden_grid[0];
$ascdesc_ord=$orden_grid[1];
}


$mnupan_campoarchivo=$rs_datosmenu->fields["mnupan_campoarchivo"];

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$lista_tabla_vista="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tabgrid_id"];
$rs_tabla_vista = $DB_gogess->executec($lista_tabla_vista,array());
//saca datos de la tabla

$carpeta='ventas';
$tabla=$rs_tabla->fields["tab_name"];

if($rs_tabla_vista->fields["tab_name"])
{
$tabla_vista=$rs_tabla_vista->fields["tab_name"];
}
else
{
$tabla_vista=$rs_tabla->fields["tab_name"];
}
$subindice="_ventas";
$campos_paragrid=$rs_datosmenu->fields["mnupan_campogrid"];
$campo_id=$rs_tabla->fields["tab_campoprimario"];

$sqltotal="";


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();
//$objformulario->sisfield_arr=$gogess_sisfield;
//$objformulario->sistable_arr=$gogess_sistable;
$ntabla= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_title"," where tab_name like",$tabla,$DB_gogess);
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

$boto_borrar=0;
//Crea tabla para grid

$objgrid_fk->campos_visualizar=$campos_paragrid;

$ordenlistado="order by ".$campo_id." desc";

$objgrid_fk->orden=$ordenlistado;

$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);


echo '';
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;" align="center" >'.$ntabla.'</div><br>';
echo '<table id="datatable1" class="display responsive cell-border" cellspacing="0" width="100%">
<thead><tr>';
//echo '<th >Imprimir </th>';
echo '<th >Editar</th>';

echo '<th >Anular</th>';
if($boto_borrar)
{

echo '<th >Borrar</th>';

}

if($rs_datosmenu->fields["mnupan_campoarchivo"])
{
	echo '<th >Archivo</th>';
}

		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{

		 echo '<th>'.$objgrid_fk->arrcampos_titulo[$i].'</th>';

	}  
	

echo '</tr></thead>';
echo '<tfoot><tr>';
//echo '<th >Imprimir</th>';
echo '<th >Editar</th>';
echo '<th >Anular</th>';
if($boto_borrar)
{

echo '<th >Borrar</th>';

}

if($rs_datosmenu->fields["mnupan_campoarchivo"])
{
	echo '<th >Archivo</th>';
}

		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
{

	 echo '<th>'.$objgrid_fk->arrcampos_titulo[$i].'</th>';
}            

echo '</tr></tfoot>';		
echo '</table>';
echo '</div>';

$concatena_camp='';
$concatena_data='';
foreach($objgrid_fk->arrcampos_nombre as $camposdata): 

if($campo_id==$camposdata or $camposdata=='emp_id')

	 {

	  $concatena_camp.= '{ "data": "'.$camposdata.'","visible": false },';

	 }
	 else
	 {
	 
      if($camposdata=='doccab_total' or $camposdata=='subtotal' or $camposdata=='doccab_iva' or $camposdata=='retencion' or $camposdata=='saldo')
	  {
	  $concatena_camp.= '{ "data": "'.$camposdata.'",
	   
	   render: function (data, type) {
                    var number = $.fn.dataTable.render
                        .number(".", ",", 2, "$")
                        .display(data); 
                    return number;
                }
	  
	   },';
	   
	  }
	  else
	  {
	  $concatena_camp.= '{ "data": "'.$camposdata.'" },';
	  }
	  

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

if($tabla=='efacsistema_producto')
{

$sql2=" prod_nivel=1 and ";

}

$lista_usvf="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_usvf= $DB_gogess->executec($lista_usvf,array());
$usua_farmacia=0;
$usua_farmacia=$rs_usvf->fields["usua_farmacia"];
$usua_admrecaudacion=0;
$usua_admrecaudacion=$rs_usvf->fields["usua_admrecaudacion"];
$usua_puedeanularventa=0;
$usua_puedeanularventa=$rs_usvf->fields["usua_puedeanularventa"];

$estab_id=$rs_usvf->fields["estab_id"];
$busca_esta="select * from efacsistema_establecimiento where estab_id='".$estab_id."'";
$rs_besta= $DB_gogess->executec($busca_esta,array());
$estab_codigo=$rs_besta->fields["estab_codigo"];


$pemision_id=$rs_usvf->fields["pemision_id"];
$busca_emif="select * from efacsistema_puntoemision where pemision_id='".$pemision_id."'";
$rs_bemif= $DB_gogess->executec($busca_emif,array());
$pemision_num=$rs_bemif->fields["pemision_num"];





$sql4='';

$lista_fac='';
$lista_fac=$estab_codigo."-".$pemision_num."-";

if(str_replace("-","",$lista_fac))
{
  
    
   $sql4=" doccab_ndocumento like '".$lista_fac."%' and ";
  
}

if($usua_admrecaudacion=='1')
{
  $sql4='';
}

///del buscador
$campors_buscador=$_POST["campors_buscador"];
$sqlb1='';
$sqlb2='';
$sqlb3='';
$sqlb4='';
$sqlb5='';
$sqlb6='';
$sqlb7='';
$sqlb8='';
$sqlb9='';
$sqlb10='';

if($campors_buscador)
{
 $listado_buscador=array();
 $listado_buscador=explode(",",$campors_buscador);
 for($z=0;$z<count($listado_buscador);$z++)
 {
    $ncampo='';
	$ncampo=trim($listado_buscador[$z]);
	$$ncampo=$_POST[$ncampo];	
	
	//echo $ncampo."<br>";
	//echo $$ncampo."<br>";
 }
 
}

if($fechai!='' and $fechaf!='')
{
   $sqlb1=" (doccab_fechaemision_cliente>='".$fechai."' and doccab_fechaemision_cliente<='".$fechaf."') and ";
}  
else
{
  
  if($fechai!='' and $fechaf=='')
  {  
    $sqlb1=" doccab_fechaemision_cliente>='".$fechai."' and ";
  }
  else
  {
    if($fechai=='' and $fechaf!='')
	{
	   $sqlb1=" doccab_fechaemision_cliente<='".$fechaf."' and ";  
    }
  }

}  


	
if($doccab_rucci_cliente)
  {
   $sqlb2=" doccab_rucci_cliente like '%".$doccab_rucci_cliente."%' and ";
  } 

if($doccab_nombrerazon_cliente)
  {
   $sqlb3=" doccab_nombrerazon_cliente like '%".$doccab_nombrerazon_cliente."%' and ";
  } 
  
if($doccab_ndocumento)
  {
   $sqlb4=" doccab_ndocumento like '%".$doccab_ndocumento."%' and ";
  } 

if($estado_pp)
  {
    if($estado_sri=='PENDIENTE')
    {
	  $sqlb5=" 	saldo>0 and ";
	}
	
	if($estado_pp=='PAGADO')
	{
	  $sqlb5=" saldo=0 and ";
	}
	
  }       

if($estado_sri)
  {
      if($estado_sri=='PENDIENTE')
      {
	    $sqlb6=" doccab_estadosri ='' and ";
	  }
	  else
	  {
	    $sqlb6=" doccab_estadosri ='".$estado_sri."' and ";
	  }
  } 
  
if($doccab_anulado)
{
  
  if($doccab_anulado=='SI')
      {
	    $sqlb7=" doccab_anulado ='ANULADO' and ";
	  }
  
  if($doccab_anulado=='NO')
      {
	    $sqlb7=" doccab_anulado ='' and ";
	  }
}       


if($tipo_docv)
{

$sqlb8=" tipocmp_codigo ='".$tipo_docv."' and ";

}

///del buscador

$buscador_sql='';
echo $buscador_sql=$sqlb1.$sqlb2.$sqlb3.$sqlb4.$sqlb5.$sqlb6.$sqlb7.$sqlb8.$sqlb9.$sqlb10;


@$sqltotal=$sql1.$sql2.$sql3.$sql4.$buscador_sql;
$sqltotal=substr($sqltotal,0,-4);
$filtro_data=base64_encode($sqltotal);

//filtros
if(!($coloum_ord))
{

$coloum_ord='3';
$ascdesc_ord='desc';

}
?>

<script type="text/javascript">
<!--

 $('#datatable1').DataTable( {
        "order": [[ <?php echo $coloum_ord; ?>, "<?php echo $ascdesc_ord; ?>" ]],
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

return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_ventas.php\',\'Editar\',\'divBody_ext\','+'\''+full["<?php echo $campo_id ?>"]+'\''+',\'<?php echo $_POST["pVar2"]; ?>\',0,0,0,0,0)" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';

				}

		 },
		 { 
		"targets": -1,
		"data":null,
		"defaultContent":"<button></button>",
		"mRender": function (data,type,full)
				{
                    
			    <?php
				if($usua_puedeanularventa==1)
				{
				?>			 
				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="abrir_standar(\'aplicativos/documental/datos_anular.php\',\'Anular\',\'divBody_anular\',\'divDialog_anular\',400,290,\''+full["<?php echo $campo_id ?>"]+'\',0,0,0,0,0,0)" style=cursor:pointer ><center><img src="images/anular.png"  /></center></td></tr></table>';
				 <?php
				 }
				 else
				 {
				 ?>
				  return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td><center></center></td></tr></table>';
				 <?php
				 }
				 ?>
				 
				 
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

				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\','+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><center><img src="images/delete.png"  /></center></td></tr></table>';

				}

		 }

		 <?php

		 }

		 ?>

		 <?php 

		 if($rs_datosmenu->fields["mnupan_campoarchivo"])

		 {

		 ?>

		 ,

		 { 

		"targets": -1,

		"data":null,

		"defaultContent":"<button></button>",

		"mRender": function (data,type,full)

				{

				if(full["<?php echo $mnupan_campoarchivo; ?>"]=='')
				{
					
					return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="" style=cursor:pointer ><center></center></td></tr></table>';
				}
				else
				{
					return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="" style=cursor:pointer ><center><a href="archivo/'+full["<?php echo $mnupan_campoarchivo; ?>"]+'" target="_blank" class="thumbnail" ><img src="archivo/file.png" alt="125x125" width="70px" ></a></center></td></tr></table>';
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



-->
</script>

 <div id="divBody_causasdet" ></div>
 <div id="divBody_arbidet" ></div>
 <div id="divBody_anular" ></div>

<?php

}

else

{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}

?>