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
$subntable=$nombre_modulo;

$nueva_tablasubindice='dns_'.$nombre_modulo.'anamesis';
$nueva_tablasubsecuente='dns_'.$nombre_modulo.'consultaexterna';

$path_panel="aplicativos/documental/opciones/panel/panel_substandaranamnesissubsecuente.php";
$path_carpetagrid="aplicativos/documental/opciones/grid/substandarformanamnesissubsecuente/grid_substandarformanamnesissubsecuente.php";
$path_datos="aplicativos/documental/datos_substandarformanamnesissubsecuente.php";
$path_tmpforms="templateformsweb/maestro_standar_consultaexterna";
$path_tmpformsformulario="templateformsweb/maestro_standar_consultaexterna/formulario.php";

//panel==============================================================================
$mnupan_archivoactual='panel_substandarformunicoanamnesis.php';
$mnupan_archivo='panel_stn'.$nombre_modulo.'anamnesis.php';

$mnupan_archivosubsecuenteactual='panel_substandaranamnesissubsecuente.php';
$mnupan_archivosubsecuente='panel_stn'.$nombre_modulo.'subsecuente.php';


$subindiceactual_sub='_substandarformanamnesissubsecuente';
$carpetaactual_sub='substandarformanamnesissubsecuente';
$subindice_sub='_stn'.$nombre_modulo."subsecuente";
$carpeta_sub='stn'.$nombre_modulo."subsecuente";

$url="panelsubsecuente/".$mnupan_archivosubsecuenteactual;
$lee_panel=$objvarios->leer_contenido_completo($url);

$datosactual_sub="datos_substandarformanamnesissubsecuente.php";
$datos_sub="datos_stn".$nombre_modulo."subsecuente.php";

$lee_panel=str_replace($datosactual_sub,$datos_sub,$lee_panel);
$lee_panel=str_replace($subindiceactual_sub,$subindice_sub,$lee_panel);
$lee_panel=str_replace($carpetaactual_sub,$carpeta_sub,$lee_panel);


$pdfform_actual='pdfformularioevolucion.php';
$pdfform='pdfformevolucion'.$nombre_modulo.'.php';

$lee_panel=str_replace($pdfform_actual,$pdfform,$lee_panel);


//busca menuinicial tabla principal
$menup_string="select * from gogess_menupanel inner join gogess_sistable on gogess_menupanel.tab_id=gogess_sistable.tab_id where tab_name='".$nueva_tablasubindice."'";
$rs_string = $DB_gogess->executec($menup_string,array());

$datosactual="datos_substandarformunicoanamnesis.php";
$datos="datos_stn".$nombre_modulo."anamnesis.php";
$lee_panel=str_replace($datosactual,$datos,$lee_panel);

$mnupan_id=$rs_string->fields["mnupan_id"];
$tab_id=$rs_string->fields["tab_id"];
if($mnupan_id>0)
{
$lee_panel=str_replace("-principal-",$mnupan_id,$lee_panel);
$lee_panel=str_replace("-idtabla-",$tab_id,$lee_panel);
}




//aplicativos/documental/opciones/panel/
$archivo="../aplicativos/documental/opciones/panel/".$mnupan_archivosubsecuente;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//panel==============================================================================



//datos================================================================================
//agregar en la fila 164 el nombre de la tabla principal para registrar alergias--- $nueva_tablasubindice
$url="panelsubsecuente/".$datosactual_sub;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace($mnupan_archivosubsecuenteactual,$mnupan_archivosubsecuente,$lee_panel);

//busca menuinicial tabla subsecuente
$menup_string="select * from gogess_menupanel inner join gogess_sistable on gogess_menupanel.tab_id=gogess_sistable.tab_id where tab_name='".$nueva_tablasubsecuente."'";
$rs_string = $DB_gogess->executec($menup_string,array());

$mnupan_id=$rs_string->fields["mnupan_id"];
if($mnupan_id>0)
{
$lee_panel=str_replace("-subsecuente-",$mnupan_id,$lee_panel);
}
$lee_panel=str_replace("-idtabla-",$tab_id,$lee_panel);

$pdfform_actual='pdfformularioevolucion.php';
$pdfform='pdfformevolucion'.$nombre_modulo.'.php';
$lee_panel=str_replace($pdfform_actual,$pdfform,$lee_panel);

//aplicativos/documental
$archivo="../aplicativos/documental/".$datos_sub;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//datos================================================================================


//crear carpeta grid===================================================================
//aplicativos/documental/opciones/grid/'.$carpeta_sub.'/
$estructura = '../aplicativos/documental/opciones/grid/'.$carpeta_sub."/";
if(!mkdir($estructura, 0777, true)) {
    die('Fallo al crear las carpetas...');
}
//crear carpeta grid===================================================================


//grid=================================================================================

$gridactual_sub="grid_substandarformanamnesissubsecuente.php";
$grid_sub="grid".$subindice_sub.".php";

$url="panelsubsecuente/".$gridactual_sub;
$lee_panel=$objvarios->leer_contenido_completo($url);

//$lee_panel=str_replace($subindiceactual,$subindice,$lee_panel);
//$lee_panel=str_replace($carpetaactual,$carpeta,$lee_panel);
$lee_panel=str_replace($datosactual_sub,$datos_sub,$lee_panel);

//aplicativos/documental/opciones/grid/'.$carpeta_sub.'/
$archivo="../aplicativos/documental/opciones/grid/".$carpeta_sub."/".$grid_sub;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//grid=================================================================================


//template forms=======================================================================
$templateformsactual_sub='maestro_standar_consultaexterna';
$templateforms_sub='maestro_standar_'.$nombre_modulo.'sub';

//templateformsweb/

if(!is_dir("../templateformsweb/".$templateforms_sub."/")){
//Asignamos la carpeta que queremos copiar
$source ="panelsubsecuente/".$templateformsactual_sub;
//El destino donde se guardara la copia
$destination = "../templateformsweb/".$templateforms_sub."/";
full_copy($source, $destination);
}

//template forms=======================================================================



//pdfplantillas========================================================================
$pdfform_actual='pdfformularioevolucion.php';
$pdfform='pdfformevolucion'.$nombre_modulo.'.php';

$url="panelsubsecuente/".$pdfform_actual;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace("evoform002reverso.php","evoform002reverso".$nombre_modulo.".php",$lee_panel);

//pdfformularios/$pdfform
$archivo="../pdfformularios/".$pdfform;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);


$plantilla_actual="evoform002reverso.php";
$plantilla="evoform002reverso".$nombre_modulo.".php";

$url="panelsubsecuente/".$plantilla_actual;
$lee_panel=$objvarios->leer_contenido_completo($url);

//pdfformularios/plantillas/'.$plantilla.'
$archivo="../pdfformularios/plantillas/".$plantilla;
$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id);

//pdfplantillas========================================================================


//lista organos y sistemas
$organo_actual="cesdb_arextension.dns_evoluciongridorgano";
$organo="cesdb_arextension.dns_".$subntable."evoluciongridorgano";

$organos_actualfile="gridstandarall.php";
$organosfile="gridstandarall.php";
$url="panelsubsecuente/".$organos_actualfile;
$lee_panel=$objvarios->leer_contenido_completo($url);

$lee_panel=str_replace(trim($organo_actual),trim($organo),$lee_panel);
$archivo="../templateformsweb/".$templateforms_sub."/".$organosfile;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id); 
//lista organos y sistemas

//spcp================================================================================

$organos_actualfile="editar_spcp.php";
$organosfile="editar_spcp.php";
$url="panelsubsecuente/".$organos_actualfile;
$lee_panel=$objvarios->leer_contenido_completo($url);

$organo_actual="cesdb_arextension.dns_evoluciongridorgano";
$organo="cesdb_arextension.dns_".$subntable."evoluciongridorgano";

$lee_panel=str_replace(trim($organo_actual),trim($organo),$lee_panel);
$archivo="../templateformsweb/".$templateforms_sub."/".$organosfile;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id); 


//spcp================================================================================

echo "Ejecutado...";

}
?> 