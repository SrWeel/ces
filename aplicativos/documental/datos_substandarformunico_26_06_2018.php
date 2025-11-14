<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];
$eteneva_id=@$_POST["pVar5"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$areas_id=array();

$areas_id["faesa_psicologia"]=1;
$areas_id["faesa_lenguaje"]=2;
$areas_id["faesa_terapiafisica"]=3;
$areas_id["faesa_pedagogia"]=4;
$areas_id["faesa_anamnesisclinica"]=0;

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));


$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

//saca datos de la tabla
//echo $_POST["pVar1"];
//Llamando objetos

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];  

if($eteneva_id)
{
$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=? and eteneva_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id,@$eteneva_id));
}
else
{
$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id));
}

///obtener doc y fecha
if(@$eteneva_id)
{


$busca_docfecha="select * from faesa_asigahorario where eteneva_id=".@$eteneva_id." and atenc_id=".$atenc_id;
$rs_docfecha = $DB_gogess->executec($busca_docfecha,array($atenc_id,@$clie_id));

$especi_id=$areas_id[$table];
$tipp_id=0;
if($especi_id==0)
{
$tipp_id=1;
}
else
{
$tipp_id=2;
}
$grup_id=$rs_docfecha->fields["grup_id"];

if($especi_id==0)
{

$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id;

}
else
{
$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id." and especi_id=".$especi_id;

}
$rs_buscadatos_fecha = $DB_gogess->executec($buscadatos_fecha,array());



}
else
{


$busca_docfecha="select * from faesa_asigahorario where  atenc_id=".$atenc_id;
$rs_docfecha = $DB_gogess->executec($busca_docfecha,array($atenc_id,@$clie_id));

$especi_id=$areas_id[$table];
$tipp_id=0;
if($especi_id==0)
{
$tipp_id=1;
}
else
{
$tipp_id=2;
}
$grup_id=$rs_docfecha->fields["grup_id"];

if($especi_id==0)
{

$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id;

}
else
{
$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id." and especi_id=".$especi_id;

}
$rs_buscadatos_fecha = $DB_gogess->executec($buscadatos_fecha,array());




}
///obtener doc y fecha

$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];



include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

//para cambiar el formato de algunos campos

$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"]);
$campos_tipo=array();
for($i=0;$i<count($lista_camposv);$i++)
{
    $separa_campo=explode(',',$lista_camposv[$i]);
	if($separa_campo[0])
	{
	$campos_tipo[$separa_campo[0]]=$separa_campo[1];
    }
}

//para cambiar el formato de algunos campos     
	
	$em_id_val=0;	
	$csearch=0;	

	$variableb=0;
			if($psic_id_valor==0)
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$psic_id_valor;
					 $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$psic_id_valor;				 
				  }
		//echo $csearch; 
		 $comillasimple="'";
		 $botonenvio='<br><br>

<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
			<button type="submit" class="mb-sm btn btn-primary" >Guardar '.utf8_encode($rs_tabla->fields["tab_title"]).'</button>
		
		</div>
		</div>
</div>
';	
		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funcionextrag=" alert('Registro guardado...');
		$('#div_".$table."').html('.');
		";
		
		
		if($rs_datosmenu->fields["mnupan_templatetabla"])
		{
  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';
		}
		else
		{
		$template_reemplazo='templateformsweb/maestro_standar_substandar/';
		
		}
		//echo $template_reemplazo;
	
?>	
<style>
label.error{
color:red;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-style:italic;
font-size:11px;
}
div.error{
display:none;
}
input{
}
input.checkbox{
border:none
}
input:focus{
border:1px dotted black;
}
input.error{
border:1px dotted red;
}

</style> 
<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
.texto_caja{
font-size: 11px; 
font-family: Verdana, Arial, Helvetica, sans-serif
}
-->
</style>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<B> <?php echo utf8_encode($rs_tabla->fields["tab_title"]); ?> </B> <br />
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		echo $botonenvio;
		include("tablas_unico.php");
		echo $botonenvio;
?>	
</form>
</div>
<?php
}			
?>
<script type="text/javascript">
<!--
$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

$( "#lab_fechasolicitud" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#lab_fechatoma" ).datepicker({dateFormat: 'yy-mm-dd'});



//  End -->
</script>