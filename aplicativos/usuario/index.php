<?php

//Parametres de ingreso al sistema
$accesousuario=1;

$sacadatosdelmodulo="select * from gogess_areausuarios where accw_activo=1 and accw_id=".$accesousuario;

 $rs_datamodulo = $DB_gogess->Execute($sacadatosdelmodulo);
 if($rs_datamodulo)
 {
  while (!$rs_datamodulo->EOF) {
  
    
    
	$idacceso=$rs_datamodulo->fields["accw_id"];
    $tabla_usuario=$rs_datamodulo->fields["tab_id"];
	
	$campo_usuario=$rs_datamodulo->fields["accw_cusuario"];
    $campo_clave=$rs_datamodulo->fields["accw_cclave"];
	$campo_nombre=$rs_datamodulo->fields["accw_cnombre"];
     
	$campo_emailusario=$rs_datamodulo->fields["accw_cemail"];    
    $campo_tituloemail=$rs_datamodulo->fields["accw_tituloemail"];

    $campo_replyto=$rs_datamodulo->fields["accw_replyto"];
	$campo_paginaweb=$rs_datamodulo->fields["accw_paginaweb"];
    
	$campo_codigo_actvcuenta=$rs_datamodulo->fields["accw_codigo"];  
    $campo_campoenlace=$rs_datamodulo->fields["accw_cidtabla"];
	
    $campo_rclave=$rs_datamodulo->fields["accw_rclave"];
	$campo_rregistro=$rs_datamodulo->fields["accw_rregistro"];
	
	$campo_logo=$rs_datamodulo->fields["accw_logo"];
	

    $campo_extra1=$rs_datamodulo->fields["accw_campoextra1"];
	$campo_extra2=$rs_datamodulo->fields["accw_campoextra2"];
	
	$activarswivel=$rs_datamodulo->fields["accw_activarswivel"];
	
  //    ,[accw_activotb]
  //    ,[accw_tablabase]
  //    ,[accw_campotbenlace]
 
    $rs_datamodulo->MoveNext();
  }
}
///Recuperar clave

if ($campo_rclave==1)
{
  $olvidoclave='onclick="recuperar_clave()"  style="cursor:pointer" ';  
  $botonrecuperarclave='<img name="ingreso_r3_c4" src="'.$ap_path.'images/ingreso_r3_c4.png" width="144" height="30" border="0" id="ingreso_r3_c4" alt="" />';
}
else
{
  $olvidoclave='';
  $botonrecuperarclave='';
}

//registro usuario

if($campo_rregistro==1)
{   
   $funcionbotonregistro='onclick="registro_usuario()" style="cursor:pointer" ';  
   $botonregistro='<img name="ingreso_r4_c4" src="'.$ap_path.'images/ingreso_r4_c4.png" width="144" height="38" border="0" id="ingreso_r4_c4" alt="" />';
}
else
{

   $funcionbotonregistro='';  
   $botonregistro='';
}

//logo
if($campo_logo)
{
  $logosistema='<img name="ingreso_r2_c1" src="'.'archivo/'.$campo_logo.'" width="180" height="181" border="0" id="ingreso_r2_c1" alt="" />';
}
else
{
  $logosistema='';
}

//linkportal
if($campo_paginaweb)
{
$linkportal=$campo_paginaweb;
}
else
{
$linkportal='#';
}

//ingreso al sistem
//ingreso_usuario()

$funcionbotoningreso='onclick="ingreso_usuario()" style="cursor:pointer" ';

?>

<script type="text/javascript">
<!--
function ingreso_usuario()
{
   
 

	
  if ($('#ruc_valor').val()=='')
	{
	alert('Debe llenar el Campo RUC:');
	return false;
	}
	
  if ($('#usuario_valor').val()=='')
	{
	alert('Debe llenar el Campo USUARIO:');
	return false;
	}

  if ($('#clave_valor').val()=='')
	{
	alert('Debe llenar el Campo CLAVE:');
	return false;
	}
 
 

 
 
  $("#acceso_usuario").load("libreria/acceso/validar.php",{
  
    accesousuario:'<?php echo $accesousuario ?>',usuario_valor:$('#usuario_valor').val(),clave_valor:$('#clave_valor').val(),ruc_valor:$('#ruc_valor').val()
  
  
  },function(result){  

  });  
  $("#acceso_usuario").html("Espere un momento...");


}


function salir_sistema()
{
   $("#acceso_panel").load("libreria/acceso/salir.php",{

  },function(result){  

  });  
  $("#acceso_panel").html("Espere un momento...");  

}




function funcion_cerrar_pop(valor_pop)
{
$('#'+valor_pop).dialog( "close" );
}

function llamar_extras(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	
    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#divBody_ext");
        xobjPadre.append("<div id='divDialog_extra'  title='"+titulopantalla+"'></div>");
        var xobj = $("#divDialog_extra");

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
            width:690,
            height: 430,
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
//echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
if($_SESSION['ces1313777_sessid_inicio'])
{

    include($ap_path."entorno.php");	
}
else
{
   include($ap_path."ingreso.php");	

}


?> 
<div id=divBody_ext ></div>