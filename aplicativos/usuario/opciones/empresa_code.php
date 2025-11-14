<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//ini_set("session.gc_maxlifetime","14400");
//session_start();
$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);

?>
<script type="text/javascript">
<!--
function abrir_pantalla_servicio(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
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
				location.reload();
									
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

function reenvia_alinicio()
{  
    
  setTimeout(function () { $(location).attr('href','index.php?snp=YVdSdFpXNDlNVE1tWVhCc1BURTNKbk5sWTJNOU55WnpaV05qWVhCc1BURT0=724'); }, 2000);

}
//  End -->
</script>
<?php
$idempresa=$objformulario->replace_cmb("factura_usuario","usua_id,emp_id","where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);


$nombreempresa=$objformulario->replace_cmb("factura_empresa","emp_id,em_nombre","where emp_id=",$idempresa,$DB_gogess);

$campos_tipo=Array
(
    'emp_ruc' => 'hidden2',
	'emp_id' => 'hidden3',
	'emp_logo' => 'txtarchivografico',
    
);

  $table='factura_empresa';  
  
  if ($table)
  {
  $objtableform->select_templateform($table,$DB_gogess);	
  }
//Datos de empresa
	
			
	
	$variableb=0;
			if($idempresa=='')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$idempresa;
					 $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$idempresa;				 
				  }
	
	
	//$idempresa=$objformulario->replace_cmb("factura_usuarios","usua_id,emp_id","where usua_id=",$csearch,$DB_gogess);
    //$nombreempresa=$objformulario->replace_cmb("factura_empresa","emp_id,em_nombre","where emp_id=",$idempresa,$DB_gogess);

  
			
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    
			  </tr>
			</table>
</div>';	

	
		$funcionextrag="";
  		$template_reemplazo='templateformsweb/maestro_empresa/';			  

?>


<style type="text/css">
<!--
.borde_css {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	border: 1px solid #CCCCCC;
}
.Estilo1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>


 <div align="center" >
	<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="700" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td><?php		
		include("aplications/usuario/tablas.php");
		
?>	</td>
   
  </tr>
</table>

	

</form>

<div id=divBody_servicios ></div>