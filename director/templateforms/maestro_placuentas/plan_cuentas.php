<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<link type="text/css" href="../../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/jquery.corner.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/ui.mask.js"></script>
<script type="text/javascript" src="../../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../../js/jquery.fixheadertable.js"></script>
<script src="../../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../../../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../../../ckeditor/adapters/jquery.js"></script>


<link type="text/css" href="../../../css/jquery.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../../js/jquery.dataTables.min.js"></script> 

<link rel="stylesheet" href="../../../css/bootstrap/css/bootstrap.min.css" type="text/css">

<script type="text/javascript" src="../../../js/franklin.js"></script>

<!-- NProgress -->
<script src="../../../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../../../vendors/Chart.js/dist/Chart.min.js"></script>

<!-- <script src="build/js/custom.min.js"></script>
<script type="text/javascript" src="js/dataTables.fixedColumns.min.js"></script> -->

<script type="text/javascript">

<!-- Begin

function hideLoading() {

	document.getElementById('pageIsLoading').style.display = 'none'; // DOM3 (IE5, NS6) only

}

function modi_plsn()
{
 abrir_pantalla("templateforms/maestro_standar_illustrator/panel_grafico.php","PLAN","divBody_grafico","divDialog_grafico",500,500,0,0,0,0,0,0,0);
}


function abrir_pantalla(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
    var data_divBody=divBody;
	var data_divDialog=divDialog;
	var data_ancho=ancho;
	var data_alto=alto;
    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#"+divBody);
        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"'></div>");
        var xobj = $("#"+data_divDialog);
        xobj.dialog({
            open: function(event, ui) {
                $(".ui-pg-selbox").css({"visibility":"hidden"});
            },
            close: function(event, ui) {
				
                $(".ui-pg-selbox").css({"visibility":"visible"});
                $(this).remove();
									
            },
            resizable: false,
            autoOpen: false,
            width: data_ancho,
            height: data_alto,
            modal: true,
           
        });
        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});
        xobj.dialog( "open" );
        return false;
    }
    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);
}
//  End -->

</script>

<?php
if($_SESSION['sessidadm1777_pichincha'])
{
$director='../../';
include("../../cfgclases/clases.php");

$cuentas_data='';
function despliega_int($plancs_id,$codigo_m,$DB_gogess)
{

    $GLOBALS["cuentas_data"].= '<blockquote>';
	$lista_pla="select * from lpin_plancuentas where plancs_id='".$plancs_id."'";
	$rs_plan = $DB_gogess->Execute($lista_pla);
	if($rs_plan)
	  {
		  while (!$rs_plan->EOF) {
		  
			$GLOBALS["cuentas_data"].= $codigo_m.".".$rs_plan->fields["planc_codigo"].".".utf8_encode($rs_plan->fields["planc_nombre"])." <span onclick='modi_plsn()' style='cursor:pointer' >+ (".$rs_plan->fields["planc_id"].")</span> <br>";
			
			//==========================
			$lista_placuenta="select count(*) as t from lpin_plancuentas where plancs_id='".$rs_plan->fields["planc_id"]."'";
	        $rs_plancuenta = $DB_gogess->Execute($lista_placuenta);
			//========================== 
			 if($rs_plancuenta->fields["t"]>0)
			 {
			 despliega_int($rs_plan->fields["planc_id"],$codigo_m.".".$rs_plan->fields["planc_codigo"],$DB_gogess);
		     }
			 
			$rs_plan->MoveNext();
		  }
	  }	  
	  else
	  {
	   return 1;
	  }
   $GLOBALS["cuentas_data"].= '</blockquote>';
}


$lista_pla="select * from lpin_plancuentas where plancs_id=0";
$rs_plan = $DB_gogess->Execute($lista_pla);
if($rs_plan)
  {
	  while (!$rs_plan->EOF) {
	  
	    $cuentas_data.=$rs_plan->fields["planc_codigo"].".".utf8_encode($rs_plan->fields["planc_nombre"])." <span onclick='modi_plsn()' style='cursor:pointer' >+ (".$rs_plan->fields["planc_id"].")</span>  <br>";
		despliega_int($rs_plan->fields["planc_id"],$rs_plan->fields["planc_codigo"],$DB_gogess);
		   
	  
	    $rs_plan->MoveNext();
	  }
  }	  



echo $cuentas_data;

}

?>
<div id="divBody_grafico"></div>