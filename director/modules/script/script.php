<?php
$objformulario->form_format_tabla(@$table,$DB_gogess);

if (@$objformulario->tab_archivo)
{

echo '<SCRIPT LANGUAGE=javascript>
<!--

function subirarchiv(campogeneral) {
window.open("modules/archivos/archivo.php?campogeneral="+campogeneral,campogeneral,"width=600,height=100,scrollbars=NO");

}
//-->
</SCRIPT>';


}

echo '<script src="libreria/ajax/selectuser_combog.js" type="text/javascript"></script>';
?>

<script language="javascript">
<!--

function ver_ayuda(idayuda) {
window.open('ayuda/ayuda.php?idayuda=' + idayuda,'ventana1','width=750,height=500,scrollbars=YES');

}
//-->
</script>

<?php
include_once("modules/ultimopantalla/ultimo.php");

//Funciones de guardado  

include_once("libreria/func_g.php");


if (@$table)
{
 $objformulario->lisbusqueda=@$listab;
 $objformulario->cambusqueda=@$campo;
 include("script/edicion.php");
}

if (@$tablelista)
{
 $objtableform->select_templateform($tablelista,$DB_gogess);	
}

printf("<link href='%sstyles/formato.css' rel='stylesheet' type='text/css'>",$objtemplate->path_template);
if($table)
{
$tipoimp=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_tipoimp","where tab_name like ",$table,$DB_gogess);
$archimp=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_archivoimp","where tab_name like ",$table,$DB_gogess);
}

if(@$tipoimp==1)
{
  $dtimp='modules/archimp/'.$archimp.'?table='.$table.'&opcion=buscar&sessid='.$sessid.'&csearch='.$csearch.'&fimp=1&listab='.$listab;
}
else
{
    @$dtimp='modules/fimpresion.php?table='.$table.'&opcion=buscar&sessid='.$sessid.'&csearch='.$csearch.'&fimp=1&listab='.$listab;

}

	  

?>


<script language="javascript">
<!--

function imp_documento_<?php $table ?>() {
window.open('<?php echo $dtimp ?>','Impresion','width=750,height=500,scrollbars=YES');

}
//-->
</script>