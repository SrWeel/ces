<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=544444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

if(@$_POST["llave"]==1)
{

//Crear nuevos directorios completos
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
 
        $d->close();
    }else {
        copy( $source, $target );
    }
}
 
 
include("cfgmodulo.php");

$original_tablasubindice='dns_anamesisexamenfisico';
$original_tablasubsecuente='dns_consultaexterna';

$nueva_tablasubindice='dns_'.$nombre_modulo.'anamesis';
$nueva_tablasubsecuente='dns_'.$nombre_modulo.'consultaexterna';

$path_panel="aplicativos/documental/opciones/panel/panel_substandarformunicoanamnesis.php";
$path_carpetagrid="aplicativos/documental/opciones/grid/substandarformunicoanamnesis/grid_substandarformunicoanamnesis.php";
$path_datos="aplicativos/documental/datos_substandarformunicoanamnesis.php";
$path_tmpforms="templateformsweb/maestro_standar_anamnesisclinica";
$path_tmpformsformulario="templateformsweb/maestro_standar_anamnesisclinica/formulario.php";

//panel==============================================================================
$mnupan_archivoactual='panel_substandarformunicoanamnesis.php';
$mnupan_archivo='panel_stn'.$nombre_modulo.'anamnesis.php';

$mnupan_archivosubsecuenteactual='panel_substandaranamnesissubsecuente.php';
$mnupan_archivosubsecuente='panel_stn'.$nombre_modulo.'subsecuente.php';

$subindiceactual='_substandarformunicoanamnesis';
$carpetaactual='substandarformunicoanamnesis';
$subindice='_stn'.$nombre_modulo;
$carpeta='stn'.$nombre_modulo;

$url="panel/".$mnupan_archivoactual;
$lee_panel=$objvarios->leer_contenido_completo($url);

$datosactual="datos_substandarformunicoanamnesis.php";
$datos="datos_stn".$nombre_modulo."anamnesis.php";

$lee_panel=str_replace($datosactual,$datos,$lee_panel);
$lee_panel=str_replace($subindiceactual,$subindice,$lee_panel);
$lee_panel=str_replace($carpetaactual,$carpeta,$lee_panel);


//aplicativos/documental/opciones/panel/
$archivo="../aplicativos/documental/opciones/panel/".$mnupan_archivo;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);
//panel================================================================================



//datos================================================================================
//agregar en la fila 164 el nombre de la tabla principal para registrar alergias--- $nueva_tablasubindice
$url="panel/".$datosactual;
$lee_panel=$objvarios->leer_contenido_completo($url);

//busca menuinicial tabla principal
$menup_string="select * from gogess_menupanel inner join gogess_sistable on gogess_menupanel.tab_id=gogess_sistable.tab_id where tab_name='".$nueva_tablasubindice."'";
$rs_string = $DB_gogess->executec($menup_string,array());

$mnupan_id=$rs_string->fields["mnupan_id"];
if($mnupan_id>0)
{
$lee_panel=str_replace("-principal-",$mnupan_id,$lee_panel);

}
//busca menuinicial tabla subsecuente
$menup_string="select * from gogess_menupanel inner join gogess_sistable on gogess_menupanel.tab_id=gogess_sistable.tab_id where tab_name='".$nueva_tablasubsecuente."'";
$rs_string = $DB_gogess->executec($menup_string,array());

$mnupan_id=$rs_string->fields["mnupan_id"];
if($mnupan_id>0)
{
$lee_panel=str_replace("-subsecuente-",$mnupan_id,$lee_panel);
}
$lee_panel=str_replace($mnupan_archivoactual,$mnupan_archivo,$lee_panel);
$lee_panel=str_replace($mnupan_archivosubsecuenteactual,$mnupan_archivosubsecuente,$lee_panel);

$pdfform_actual='pdformulario.php';
$pdfform='pdformulario'.$nombre_modulo.'.php';

$lee_panel=str_replace($pdfform_actual,$pdfform,$lee_panel);


//aplicativos/documental
$archivo="../aplicativos/documental/".$datos;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//datos================================================================================

//crear carpeta grid===================================================================
//aplicativos/documental/opciones/grid/'.$carpeta.'/
$estructura = '../aplicativos/documental/opciones/grid/'.$carpeta."/";
if(!mkdir($estructura, 0777, true)) {
    die('Fallo al crear las carpetas...');
}


//crear carpeta grid===================================================================


//grid=================================================================================
$gridactual="grid_substandarformunicoanamnesis.php";
$grid="grid".$subindice.".php";

$url="panel/".$gridactual;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace($datosactual,$datos,$lee_panel);
$lee_panel=str_replace($subindiceactual,$subindice,$lee_panel);
$lee_panel=str_replace($carpetaactual,$carpeta,$lee_panel);


//aplicativos/documental/opciones/grid/'.$carpeta.'/
$archivo="../aplicativos/documental/opciones/grid/".$carpeta."/".$grid;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//grid=================================================================================

//template forms=======================================================================
$templateformsactual='maestro_standar_anamnesisclinica';
$templateforms='maestro_standar_'.$nombre_modulo.'anam';

//templateformsweb/

if(!is_dir("../templateformsweb/".$templateforms."/")){
//Asignamos la carpeta que queremos copiar
$source ="panel/".$templateformsactual;
//El destino donde se guardara la copia
$destination = "../templateformsweb/".$templateforms."/";
full_copy($source, $destination);
}

//template forms=======================================================================

//pdfplantillas========================================================================
$subntable=$nombre_modulo;

$organo_actual="cesdb_arextension.dns_gridorgano";
$organo="cesdb_arextension.dns_".$subntable."gridorgano";

$fisico_actual="cesdb_arextension.dns_gridexamenfisico";
$fisico="cesdb_arextension.dns_".$subntable."gridexamenfisico";

$cuadro_actual="dns_cuadrobasico";
$cuadro="cesdb_arextension.dns_".$subntable."cuadrobasico";

$diagnostico_actual="dns_diagnosticoanamnesis";
$diagnostico="cesdb_arextension.dns_".$subntable."diagnosticoanamnesis";

$receta_actual="cesdb_arextension.dns_recetaanamesisexamenfisico";
$receta="cesdb_arextension.dns_".$subntable."receta";

$dispositivo_actual="cesdb_arextension.dns_dispositivomedicoexafisico";
$dispositivo="cesdb_arextension.dns_".$subntable."dispositivos";

$pdfform_actual='pdformulario.php';
$pdfform='pdformulario'.$nombre_modulo.'.php';

$url="panel/".$pdfform_actual;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace("form003anverso.php","form003anverso".$nombre_modulo.".php",$lee_panel);
$lee_panel=str_replace($organo_actual,$organo,$lee_panel);
$lee_panel=str_replace($fisico_actual,$fisico,$lee_panel);
$lee_panel=str_replace($cuadro_actual,$cuadro,$lee_panel);
$lee_panel=str_replace($diagnostico_actual,$diagnostico,$lee_panel);
$lee_panel=str_replace($receta_actual,$receta,$lee_panel);
$lee_panel=str_replace($dispositivo_actual,$dispositivo,$lee_panel);


//pdfformularios/$pdfform
$archivo="../pdfformularios/".$pdfform;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);



$plantilla_actual="form003anverso.php";
$plantilla="form003anverso".$nombre_modulo.".php";

$url="panel/".$plantilla_actual;
$lee_panel=$objvarios->leer_contenido_completo($url);

//pdfformularios/plantillas/'.$plantilla.'
$archivo="../pdfformularios/plantillas/".$plantilla;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);
//pdfplantillas========================================================================

//lista organos y sistemas

$organos_actualfile="gridstandarall.php";
$organosfile="gridstandarall.php";
$url="panel/".$organos_actualfile;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace(trim($organo_actual),trim($organo),$lee_panel);
$archivo="../templateformsweb/".$templateforms."/".$organosfile;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id); 
//lista organos y sistemas

//spcp================================================================================

$organos_actualfile="editar_spcp.php";
$organosfile="editar_spcp.php";
$url="panel/".$organos_actualfile;
$lee_panel=$objvarios->leer_contenido_completo($url);

$organo_actual="cesdb_arextension.dns_gridorgano";
$organo="cesdb_arextension.dns_".$subntable."gridorgano";

$lee_panel=str_replace(trim($organo_actual),trim($organo),$lee_panel);
$archivo="../templateformsweb/".$templateforms."/".$organosfile;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id); 


//spcp================================================================================
}
?>