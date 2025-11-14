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
$idempresa=$objformulario->replace_cmb("factur_usuarios","usua_id,em_id","where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
$nombreempresa=$objformulario->replace_cmb("factur_empresa","em_id,em_nombre","where em_id=",$idempresa,$DB_gogess);

$campos_tipo=Array
(
    'em_ruc' => 'hidden2',
	'em_certificado' => 'txtarchivo',
	'em_logo' => 'txtarchivo',
    
);

  $table='factur_empresa';  
  
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
	
	
	//$idempresa=$objformulario->replace_cmb("factur_usuarios","usua_id,em_id","where usua_id=",$csearch,$DB_gogess);
    //$nombreempresa=$objformulario->replace_cmb("factur_empresa","em_id,em_nombre","where em_id=",$idempresa,$DB_gogess);

  
			
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    
			  </tr>
			</table>
</div>';	

	
		//$funcionextrag="reenvia_alinicio()";
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
    <td valign="top">
	
	<?php
	$activo_serv=0;
	if($activo_serv==1)
	{
	?>
	<?php
	//lista servicios de la empresa
	
	$listaservicios="select * from factur_servicios where em_id=".$idempresa;
	
	$result_servicios= $DB_gogess->Execute($listaservicios);	
	if ($result_servicios)
			   {
				 while (!$result_servicios->EOF) 
					{
					
					   $serv_compras=$result_servicios->fields["serv_compras"];
					   $serv_ventas=$result_servicios->fields["serv_ventas"];
					   $serv_pagofac=$result_servicios->fields["serv_pagofac"];
					   $serv_gestioncobfac=$result_servicios->fields["serv_gestioncobfac"];
					   $serv_factoring=$result_servicios->fields["serv_factoring"];

					
					   $result_servicios->MoveNext();  
					}
				}	
	
	//saca datos del perfil para el usuario
	$listasperfil="select * from spag_usuarios_perfil where usua_id=".$csearch;
	
	$result_perfil= $DB_gogess->Execute($listasperfil);	
	if ($result_perfil)
			   {
				 while (!$result_perfil->EOF) 
					{
					
					   $tipous_id=$result_perfil->fields["tipous_id"];
					   
					   $perusu_admempresa=$result_perfil->fields["perusu_admempresa"];
					   
					   $perusu_compras=$result_perfil->fields["perusu_compras"];
					   
					   $perusu_ventas=$result_perfil->fields["perusu_ventas"];
					  
					   $perusu_pagofac=$result_perfil->fields["perusu_pagofac"];
					   
					   $perusu_gestioncobfac=$result_perfil->fields["perusu_gestioncobfac"];
					   
					   $perusu_factoring=$result_perfil->fields["perusu_factoring"];
					  

					
					   $result_perfil->MoveNext();  
					}
				}	
	
	
	?>
	
	&nbsp;<br />
	<br />
	<div align="center"> <span class="Estilo1">Servicios Activados <br />
	  Empresa: <?php echo $nombreempresa ?>
	    </span>
	  <table width="320" border="0" cellpadding="5" cellspacing="0" class="borde_css">
      <tr>
        <td bgcolor="#FFFFFF">
		  <div align="center"> <br />
		  <table width="276" border="0" align="center" cellpadding="0" cellspacing="0"> 
		 
		  <?php 
		  if($serv_compras==1)
		  {
		  ?>
		  
		  <tr>
            <td>
			
			
					</td>
            <td>Recepcion de Facturas (Gratuito)</td>
          </tr>
		  <?php
		  }
		  ?>
		  <?php
		  if($serv_ventas==1)
		  {
		  ?>
          <tr>
            <td>
			
			</td>
            <td>Emision factura</td>
          </tr>
		  <?php
		  }
		  ?>
		  <?php
		  if($serv_pagofac==1)
		  {
		  ?>
          <tr>
            <td>
					
			
			</td>
            <td>Pago facturas</td>
          </tr>
		  <?php
		  }
		  ?>
		  <?php
		  if($serv_gestioncobfac==1)
		  {
		  ?>
          <tr>
            <td>
			
		</td>
            <td>Gesti&oacute;n de Cobranza por D&eacute;bito Directo</td>
          </tr>
          <?php
		  }
		  ?>
		  <?php
		  if($serv_factoring==1)
		  {
		  ?>
		  <tr>
            <td>
			
			</td>
            <td>Factoring</td>
          </tr>
		  <?php
		  }
		  ?>
        </table>
		    <br />
		  </div></td>
      </tr>
    </table>
	
	    <br />
	    <div id=grusua_idservicio ></div>
	</div>
	
	
	<div align="center">
	  <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td onclick="abrir_pantalla_servicio('aplications/usuario/opciones/servicios/servicios.php','Servicios','divBody_servicios','divDialog_servicios',780,700,0,0,0,0,0,0,0)" style="cursor:pointer" ><img src="images/services.png" /></td>
        </tr>
      </table>
	  </div>
	<?php
	}
	?>
	  
	  </td>
  </tr>
</table>

	

</form>

<div id=divBody_servicios ></div>