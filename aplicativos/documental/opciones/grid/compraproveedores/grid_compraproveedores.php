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
//echo $tabla_vista;

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


//Crea tabla para grid

$objgrid_fk->campos_visualizar=$campos_paragrid;

$ordenlistado="order by ".$campo_id." desc";

$objgrid_fk->orden=$ordenlistado;

$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);

echo '';
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;" align="center" ><br><br></div><br>';

$busca_camposbuscador=$_POST["campos_bu"];
$compra_fechai=$_POST["compra_fechai"];
$compra_fechaf=$_POST["compra_fechaf"];
$provee_nombreb=$_POST["provee_nombreb"];
$compra_descripcionb=$_POST["compra_descripcionb"];
$compra_nfacturab=$_POST["compra_nfacturab"];
$estado_pp=$_POST["estado_pp"];
$estado_sri=$_POST["estado_sri"];
$code_compra=$_POST["code_compra"];
$tipdocbu_id=$_POST["tipdocbu_id"];

include("buscador.php");

echo '<table id="'.$_POST["namemodulo"].'" class="display responsive cell-border" cellspacing="0" width="100%">
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

       if($camposdata=='neto' or $camposdata=='totalret' or $camposdata=='saldo' or $camposdata=='compra_total' or $camposdata=='compra_iva')
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

//$sql4=' tipomov_id=17 and ';

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
$sqlb11='';
$sqlb12='';
$sqlb13='';
$sqlb14='';



$fecha_hoysaca=date("Y-m-d");
$sacarr=array();
$sacarr=explode("-",$fecha_hoysaca);
$dias_del_mes = cal_days_in_month(CAL_GREGORIAN, $sacarr[1], $sacarr[0]);

 



if($compra_fechai!='' and $compra_fechaf!='')
{
  
   $sqlb1=" compra_fecha>='".$compra_fechai."' and compra_fecha<='".$compra_fechaf."' and ";
}  
else
{
  
  if($compra_fechai!='' and $compra_fechaf=='')
  {  
    $sqlb1=" compra_fecha>='".$compra_fechai."' and ";
  }
  else
  {
    if($compra_fechai=='' and $compra_fechaf!='')
	{
	   $sqlb1=" compra_fecha<='".$compra_fechaf."' and ";  
    }
  }

}  

if($provee_nombreb)
  {
   $sqlb2=" ( provee_nombre like '%".$provee_nombreb."%' or provee_ruc like '%".$provee_nombreb."%') and ";
  }  

if($compra_descripcionb)
  {
   $sqlb3=" compra_descripcion like '%".$compra_descripcionb."%' and ";
  }
  
if($compra_nfacturab)
  {
   $sqlb4=" compra_nfactura like '%".$compra_nfacturab."%' and ";
  }
  
if($estado_pp)
  {
     if($estado_pp=='PENDIENTE')
	 {
	   $sqlb5=" saldo>0 and ";
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
     $sqlb6=" sriretencion ='' and ";
   }
   else
   {
     $sqlb6=" sriretencion ='".$estado_sri."' and ";
   }
}     


if($code_compra)
{
  $sqlb11=" compra_id ='".$code_compra."' and ";
}

if($tipdocbu_id)
{
  $sqlb12=" tipdoc_id ='".$tipdocbu_id."' and ";
}

$buscador_sql='';
$buscador_sql=$sqlb1.$sqlb2.$sqlb3.$sqlb4.$sqlb5.$sqlb6.$sqlb7.$sqlb8.$sqlb9.$sqlb10.$sqlb11.$sqlb12.$sqlb13.$sqlb14;

if($buscador_sql=='')
{

if($compra_fechai=='' and $compra_fechaf=='')
{
   //primera fecha
   
$fechauno = new DateTime(date("Y-m-d"));
// Restar dos meses
$fechauno->modify('-2 months');
// Mostrar la fecha resultante
$fechaini=$fechauno->format('Y-m-d');
   
   //primera fecha
   
   $compra_fechai=$fechaini;
   
   $compra_fechaf=$sacarr[0]."-".$sacarr[1]."-".$dias_del_mes;
   $sqlb1=" compra_fecha>='".$compra_fechai."' and compra_fecha<='".$compra_fechaf."' and ";
}   


}

$buscador_sql='';
$buscador_sql=$sqlb1.$sqlb2.$sqlb3.$sqlb4.$sqlb5.$sqlb6.$sqlb7.$sqlb8.$sqlb9.$sqlb10.$sqlb11.$sqlb12.$sqlb13.$sqlb14;

@$sqltotal=$sql1.$sql2.$sql3.$sql4.$buscador_sql;
echo $sqltotal=substr($sqltotal,0,-4);
$filtro_data=base64_encode($sqltotal);

//filtros
//echo $tabla_vista;
?>

<script type="text/javascript">
<!--

 $('#<?php echo $_POST["namemodulo"]; ?>').DataTable( {
        "order": [[ 2, "desc" ]], 
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
		"searching": false,
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

				 return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\','+full["<?php echo $campo_id ?>"]+')" style=cursor:pointer ><center><img src="images/delete.png"  /></center></td></tr></table>';

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

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}

?>