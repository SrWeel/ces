<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
//ini_set('memory_limit', '-1');
$director="../../";
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


//$_POST["formu_id"]=3;
//$_POST["idinsertado"]=2;
/*busca datos generar pdf*/

$busca_form="select * from gogess_formulario where formu_id=".$_POST["formu_id"];
$resul_form = $DB_gogess->executec($busca_form,array());

$busca_datostabla="select * from  gogess_sistable where tab_name='".$resul_form->fields["formu_tablaguarda"]."'";
$resul_tabla = $DB_gogess->executec($busca_datostabla,array());

$busca_datosenviar="select * from ".$resul_form->fields["formu_tablaguarda"]." where ".$resul_tabla->fields["tab_campoprimario"]."='".$_POST["idinsertado"]."'";
$resul_datosenvia = $DB_gogess->executec($busca_datosenviar,array());


$busca_datoscampos="select * from gogess_sisfield where tab_name='".$resul_form->fields["formu_tablaguarda"]."' and fie_guarda=1";
$concatena_contenido=' ';
$resul_campos = $DB_gogess->executec($busca_datoscampos,array());
$concatena_contenido=$resul_form->fields["formu_plantillapdf"];
if ($resul_campos)
        {
			 while (!$resul_campos->EOF) {	
			 
			 
			 $concatena_contenido=str_replace("{".$resul_campos->fields["fie_name"]."}",$resul_datosenvia->fields[$resul_campos->fields["fie_name"]],$concatena_contenido);
			 
			 
			 $resul_campos->MoveNext();
			 }
		}
	
//echo utf8_encode($concatena_contenido);
//$concatena_contenido='hola';

$output ='';
$dompdf = new DOMPDF();
$dompdf->load_html(utf8_encode($concatena_contenido), 'UTF-8');
$dompdf->render();

$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    ////$canvas->line(10,730,800,730,array(0,0,0),1);
    $canvas->page_text(530, 833, "{PAGE_NUM} de {PAGE_COUNT}",
                   $font, 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");
//$dompdf->stream($xml.".pdf");	
$output = $dompdf->output();
$fecha_hoy=date("Ymd");
file_put_contents('../../pdf/formulario_'.$_POST["formu_id"].$_POST["idinsertado"].$fecha_hoy.'.pdf', $output);	
?><input id="insertado_val" name="insertado_val" type="hidden" value="<?php echo $_POST["idinsertado"]; ?>">
<br><br><center>Descargue su formulario dando clic <b><a href="pdf/<?php echo "formulario_".$_POST["formu_id"].$_POST["idinsertado"].$fecha_hoy.".pdf"; ?>" target="_blank">AQU&Iacute;</a></b></center>