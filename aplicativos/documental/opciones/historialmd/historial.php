<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
//include("libreport.php");
$objformulario= new  ValidacionesFormulario();



$busca_atencionactual="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id where clie_rucci='".$_POST["clie_rucci"]."' and atenc_id='".$_POST["atenc_id"]."'";
$rs_ATENCIOn = $DB_gogess->executec($busca_atencionactual,array());

$clie_id=$rs_ATENCIOn->fields["clie_id"];
$atenc_id=$_POST["atenc_id"];

?>
<style type="text/css">
    <!--
    .css_listaespe {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
    .subsecuente {padding-left: 20px; background-color: #F5F5F5;}
    -->
</style>
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td bgcolor="#DDEAEE"><span class="css_listaespe">FECHA</span></td>
        <td bgcolor="#DDEAEE"><span class="css_listaespe">ESPECIALIDAD</span></td>
        <td bgcolor="#DDEAEE"><span class="css_listaespe">DOCUMENTO</span></td>
    </tr>
    <?php

    // ARRAYS PARA CONTROLAR DUPLICADOS - DEBEN ESTAR AQUÍ PARA QUE PERSISTAN
    $laboratorios_mostrados = array();
    $imagenes_mostradas = array();

    // NOTA: Esta consulta busca las tablas de PRIMERA VEZ (anamnesis).
    // Se excluyen las tablas de subsecuentes (evoluciones/consultas externas), laboratorios e imágenes que se buscan por separado
    $lista_tabeval="select * from gogess_sistable where tab_name not in ('dns_imagenologia','dns_laboratorio','dns_laboratorioinforme','dns_consultaexterna','dns_rehabilitacionanamesis','dns_otorrinoanamesis','dns_ginecologiaconsultaexterna','dns_emergenciaconsultaexterna','dns_gastroenterologiaconsultaexterna','dns_pediatriaconsultaexterna','dns_cardiologiaconsultaexterna','dns_traumatologiaconsultaexterna','dns_hospitalconsultaexterna','dns_newinterconsulta','dns_newhospitalizacionconsultaexterna','dns_newgastroenterologiaconsultaexterna','dns_newcardiologiaconsultaexterna','dns_newpediatriaconsultaexterna','dns_newtraumatologiaconsultaexterna','dns_newconsultaexternaconsultaexterna','dns_newemergenciaconsultaexterna','dns_newprotocolooperatorio','dns_protocolooperatorio','dns_epicrisisconsultaexterna','dns_newimagenologia','dns_newimagenologiainfo','dns_imagenologiainfo','dns_newlaboratorio') and  tab_sysmedico=1";
    $rs_tabeval = $DB_gogess->executec($lista_tabeval,array());
//    $log_file = 'diagnostico_paciente_' . $clie_id . '_' . date('Y-m-d_His') . '.txt';
//    $log_content = "=== DIAGNÓSTICO DE REGISTROS DEL PACIENTE ===\n";
//    $log_content .= "Cliente ID: " . $clie_id . "\n";
//    $log_content .= "Atención ID: " . $atenc_id . "\n";
//    $log_content .= "RUC/CI: " . $_POST["clie_rucci"] . "\n";
//    $log_content .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
//    $log_content .= "==========================================\n\n";
//
//    // Array de tablas que SÍ tienen PDF configurado en el código
//    $tablas_con_pdf = array(
//            'dns_newconsultaexternaanamesis',
//            'dns_anamesisexamenfisico',
//            'dns_emergenciaanamesis',
//            'dns_gastroenterologiaanamesis',
//            'dns_pediatriaanamesis',
//            'dns_newtraumatologiaanamesis',
//            'dns_newcardiologiaanamesis',
//            'dns_neonatologiaanamesis',
//            'dns_newginecologiaanamesis',
//            'dns_newoftalmologiaanamesis',
//            'dns_newurologiaanamesis',
//            'dns_newdermatologiaanamesis',
//            'dns_cirugiaanamesis',
//            'dns_newmedicinainternaanamesis',
//            'dns_cardiologiaanamesis',
//            'dns_cirugiavascularconsultaexterna',
//            'dns_nuevainternacion',
//            'dns_newhospitalizacionanamesis',
//            'dns_ginecologiaanamesis',
//            'dns_odontologiaanamesis',
//            'dns_otorrinolaringologiaanamesis',
//            'dns_medicinainternaanamnesis',
//            'dns_cirugiapediatricaanamnesis',
//            'dns_otorrinoanamesis',
//            'dns_traumatologiaanamesis',
//            'dns_colposcopia',
//            'dns_oftalmologiaanamesis',
//            'dns_psicologiaanamesis',
//            'dns_urologiaanamesis',
//            'dns_dermatologiaanamesis',
//            'dns_nuevointerconsulta',
//            'dns_odontologianewconsultaexterna'
//    );
//
//    // Consulta todas las tablas médicas (misma lógica del código original)
//    $lista_tabeval_diagnostico = "select * from gogess_sistable where tab_name not in ('dns_imagenologia','dns_laboratorio','dns_laboratorioinforme','dns_consultaexterna','dns_rehabilitacionanamesis','dns_otorrinoanamesis','dns_ginecologiaconsultaexterna','dns_emergenciaconsultaexterna','dns_gastroenterologiaconsultaexterna','dns_pediatriaconsultaexterna','dns_cardiologiaconsultaexterna','dns_traumatologiaconsultaexterna','dns_hospitalconsultaexterna','dns_newinterconsulta','dns_newhospitalizacionconsultaexterna','dns_newgastroenterologiaconsultaexterna','dns_newcardiologiaconsultaexterna','dns_newpediatriaconsultaexterna','dns_newtraumatologiaconsultaexterna','dns_newconsultaexternaconsultaexterna','dns_newemergenciaconsultaexterna','dns_newprotocolooperatorio','dns_protocolooperatorio','dns_epicrisisconsultaexterna','dns_newimagenologia','dns_newimagenologiainfo','dns_imagenologiainfo','dns_newlaboratorio') and tab_sysmedico=1 order by tab_name";
//
//    $rs_tabeval_diagnostico = $DB_gogess->executec($lista_tabeval_diagnostico, array());
//
//    $contador_total = 0;
//    $contador_con_pdf = 0;
//    $contador_sin_pdf = 0;
//    $registros_sin_pdf = array();
//
//    if($rs_tabeval_diagnostico) {
//        while (!$rs_tabeval_diagnostico->EOF) {
//            $tab_name = $rs_tabeval_diagnostico->fields["tab_name"];
//            $tab_id = $rs_tabeval_diagnostico->fields["tab_id"];
//            $tab_campoprimario = $rs_tabeval_diagnostico->fields["tab_campoprimario"];
//            $tab_descripcion = $rs_tabeval_diagnostico->fields["tab_descripcion"];
//
//            // Busca registros del paciente en esta tabla
//            $separa_subind = explode("_", $tab_campoprimario);
//            $campo_fechareg = $separa_subind[0] . "_fecharegistro";
//
//            $lista_secciones_diagnostico = "select * from " . $tab_name . " where atenc_id='" . $atenc_id . "' order by " . $campo_fechareg . " desc";
//
//            $rs_seccion_diagnostico = $DB_gogess->executec($lista_secciones_diagnostico, array());
//
//            if($rs_seccion_diagnostico && !$rs_seccion_diagnostico->EOF) {
//                $num_registros = 0;
//
//                // Cuenta registros
//                while (!$rs_seccion_diagnostico->EOF) {
//                    $num_registros++;
//                    $rs_seccion_diagnostico->MoveNext();
//                }
//
//                if($num_registros > 0) {
//                    $contador_total += $num_registros;
//                    $tiene_pdf = in_array($tab_name, $tablas_con_pdf);
//
//                    if($tiene_pdf) {
//                        $contador_con_pdf += $num_registros;
//                        $status = "✓ CON PDF CONFIGURADO";
//                    } else {
//                        $contador_sin_pdf += $num_registros;
//                        $status = "✗ SIN PDF CONFIGURADO";
//                        $registros_sin_pdf[] = array(
//                                'tabla' => $tab_name,
//                                'cantidad' => $num_registros,
//                                'tab_id' => $tab_id,
//                                'descripcion' => $tab_descripcion,
//                                'campo_fecha' => $campo_fechareg,
//                                'campo_primario' => $tab_campoprimario
//                        );
//                    }
//
//                    $log_content .= "TABLA: " . $tab_name . "\n";
//                    $log_content .= "  Tab ID: " . $tab_id . "\n";
//                    $log_content .= "  Descripción: " . $tab_descripcion . "\n";
//                    $log_content .= "  Registros encontrados: " . $num_registros . "\n";
//                    $log_content .= "  Status: " . $status . "\n";
//                    $log_content .= "  Campo fecha: " . $campo_fechareg . "\n";
//                    $log_content .= "  Campo primario: " . $tab_campoprimario . "\n";
//                    $log_content .= "  ---\n\n";
//                }
//            }
//
//            $rs_tabeval_diagnostico->MoveNext();
//        }
//    }
//
//    // Buscar laboratorios
//    $log_content .= "\n=== LABORATORIOS ===\n\n";
//
//    // Laboratorio antiguo
//    $busca_lab_antiguo = "select * from dns_laboratorio where atenc_id='" . $atenc_id . "'";
//    $rs_lab_antiguo = $DB_gogess->executec($busca_lab_antiguo, array());
//    $num_lab_antiguo = 0;
//    if($rs_lab_antiguo) {
//        while (!$rs_lab_antiguo->EOF) {
//            $num_lab_antiguo++;
//            $rs_lab_antiguo->MoveNext();
//        }
//    }
//
//    // Laboratorio nuevo
//    $busca_lab_nuevo = "select * from dns_newlaboratorio where atenc_id='" . $atenc_id . "'";
//    $rs_lab_nuevo = $DB_gogess->executec($busca_lab_nuevo, array());
//    $num_lab_nuevo = 0;
//    if($rs_lab_nuevo) {
//        while (!$rs_lab_nuevo->EOF) {
//            $num_lab_nuevo++;
//            $rs_lab_nuevo->MoveNext();
//        }
//    }
//
//    $log_content .= "Laboratorios (versión antigua): " . $num_lab_antiguo . " registros ✓ CON PDF\n";
//    $log_content .= "Laboratorios (versión nueva): " . $num_lab_nuevo . " registros ✓ CON PDF\n";
//
//    // Buscar imagenología
//    $log_content .= "\n=== IMAGENOLOGÍA ===\n\n";
//
//    // Imagenología antigua
//    $busca_img_antiguo = "select * from dns_imagenologia where atenc_id='" . $atenc_id . "'";
//    $rs_img_antiguo = $DB_gogess->executec($busca_img_antiguo, array());
//    $num_img_antiguo = 0;
//    if($rs_img_antiguo) {
//        while (!$rs_img_antiguo->EOF) {
//            $num_img_antiguo++;
//            $rs_img_antiguo->MoveNext();
//        }
//    }
//
//    // Imagenología nueva
//    $busca_img_nuevo = "select * from dns_newimagenologia where atenc_id='" . $atenc_id . "'";
//    $rs_img_nuevo = $DB_gogess->executec($busca_img_nuevo, array());
//    $num_img_nuevo = 0;
//    if($rs_img_nuevo) {
//        while (!$rs_img_nuevo->EOF) {
//            $num_img_nuevo++;
//            $rs_img_nuevo->MoveNext();
//        }
//    }
//
//    $log_content .= "Imagenología (versión antigua): " . $num_img_antiguo . " registros ✓ CON PDF\n";
//    $log_content .= "Imagenología (versión nueva): " . $num_img_nuevo . " registros ✓ CON PDF\n";
//
//    // RESUMEN
//    $log_content .= "\n\n==============================================\n";
//    $log_content .= "RESUMEN DEL DIAGNÓSTICO\n";
//    $log_content .= "==============================================\n\n";
//    $log_content .= "Total de registros analizados: " . $contador_total . "\n";
//    $log_content .= "Registros CON PDF configurado: " . $contador_con_pdf . "\n";
//    $log_content .= "Registros SIN PDF configurado: " . $contador_sin_pdf . "\n";
//    $log_content .= "Laboratorios: " . ($num_lab_antiguo + $num_lab_nuevo) . " (CON PDF)\n";
//    $log_content .= "Imagenología: " . ($num_img_antiguo + $num_img_nuevo) . " (CON PDF)\n";
//
//    if($contador_sin_pdf > 0) {
//        $log_content .= "\n\n!!! ATENCIÓN: HAY " . $contador_sin_pdf . " REGISTROS SIN PDF CONFIGURADO !!!\n\n";
//        $log_content .= "==============================================\n";
//        $log_content .= "TABLAS QUE NECESITAN CONFIGURACIÓN DE PDF\n";
//        $log_content .= "==============================================\n\n";
//
//        foreach($registros_sin_pdf as $registro) {
//            $log_content .= "TABLA: " . $registro['tabla'] . "\n";
//            $log_content .= "  Registros sin PDF: " . $registro['cantidad'] . "\n";
//            $log_content .= "  Tab ID: " . $registro['tab_id'] . "\n";
//            $log_content .= "  Descripción: " . $registro['descripcion'] . "\n";
//            $log_content .= "  Campo fecha: " . $registro['campo_fecha'] . "\n";
//            $log_content .= "  Campo primario: " . $registro['campo_primario'] . "\n";
//            $log_content .= "\n";
//            $log_content .= "  CÓDIGO A AGREGAR EN HISTORIAL.PHP:\n";
//            $log_content .= "  -----------------------------------\n";
//            $log_content .= "  if(\$rs_tabeval->fields[\"tab_name\"]=='" . $registro['tabla'] . "')\n";
//            $log_content .= "  {\n";
//            $log_content .= "      \$campos_data='';\n";
//            $log_content .= "      \$campos_data64='';\n";
//            $log_content .= "      \$campos_data='iddata='.\$rs_tabeval->fields[\"tab_id\"].'&pVar2='.@\$clie_id.'&pVar4='.\$atenc_id.'&pVar5='.\$eteneva_id.'&pVar3='.\$mnupan_id;\n";
//            $log_content .= "      \$campos_data64=base64_encode(\$campos_data);\n";
//            $log_content .= "      \n";
//            $log_content .= "      \$linkpdfg=\"pdformulario_" . strtolower($registro['tabla']) . "\";  // CAMBIAR NOMBRE DEL PDF\n";
//            $log_content .= "      \$urllinkg=\"pdfformularios/\".\$linkpdfg.\".php?ssr=\".\$campos_data64.\"|\".\"+\".\$rs_seccion->fields[\$rs_tabeval->fields[\"tab_campoprimario\"]];\n";
//            $log_content .= "      \$linkimprimirg=\"onClick=ver_pdfform('\".\$urllinkg.\"')\";\n";
//            $log_content .= "      \n";
//            $log_content .= "      \$campo_fecha='" . $registro['campo_fecha'] . "';\n";
//            $log_content .= "  }\n";
//            $log_content .= "  -----------------------------------\n\n";
//        }
//    } else {
//        $log_content .= "\n✓ TODAS LAS TABLAS TIENEN PDF CONFIGURADO\n";
//    }
//
//    // Guardar el log
//    file_put_contents($log_file, $log_content);
//
//    // Mostrar mensaje en pantalla
//    echo "<div style='background-color: #fff3cd; border: 2px solid #ffc107; padding: 15px; margin: 20px; border-radius: 5px;'>";
//    echo "<h3 style='color: #856404; margin-top: 0;'>📋 DIAGNÓSTICO GENERADO</h3>";
//    echo "<p style='color: #856404; font-size: 14px;'>";
//    echo "Se ha generado el archivo de diagnóstico:<br>";
//    echo "<strong>" . $log_file . "</strong><br><br>";
//    echo "Total registros: <strong>" . $contador_total . "</strong><br>";
//    echo "Con PDF: <strong style='color: green;'>" . $contador_con_pdf . "</strong><br>";
//    echo "Sin PDF: <strong style='color: red;'>" . $contador_sin_pdf . "</strong><br>";
//    echo "Laboratorios: <strong style='color: green;'>" . ($num_lab_antiguo + $num_lab_nuevo) . "</strong><br>";
//    echo "Imagenología: <strong style='color: green;'>" . ($num_img_antiguo + $num_img_nuevo) . "</strong>";
//    echo "</p>";
//    if($contador_sin_pdf > 0) {
//        echo "<p style='color: red; font-weight: bold;'>⚠️ ATENCIÓN: Hay " . $contador_sin_pdf . " registros sin PDF configurado</p>";
//    }
//    echo "<p style='color: #856404; font-size: 12px; margin-bottom: 0;'>";
//    echo "Revisa el archivo de log para ver el detalle completo y el código que necesitas agregar.";
//    echo "</p>";
//    echo "</div>";
    if($rs_tabeval)
    {
        while (!$rs_tabeval->EOF) {

            //busca campos
            $lista_datosmenu="select * from gogess_menupanel where tab_id='".$rs_tabeval->fields["tab_id"]."'";
            $rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));

            //busca campos


            $separa_subind=explode("_",$rs_tabeval->fields["tab_campoprimario"]);
            $campo_fechareg=$separa_subind[0]."_fecharegistro";
            $lista_secciones="select * from ".$rs_tabeval->fields["tab_name"]." where ".$rs_tabeval->fields["tab_name"].".atenc_id='".$rs_ATENCIOn->fields["atenc_id"]."' order by ".$campo_fechareg." desc";

            $rs_seccion = $DB_gogess->executec($lista_secciones,array());
            if($rs_seccion)
            {
                while (!$rs_seccion->EOF) {

                    $campos_data='';
                    $campos_data64='';
                    $eteneva_id='';
                    $mnupan_id=$rs_datosmenu->fields["mnupan_id"];
                    $linkpdfg='';
                    $urllinkg='';
                    $linkimprimirg='';
                    $campo_fecha='';




                    if($rs_tabeval->fields["tab_name"]=='dns_newconsultaexternaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularionewconsultaexterna";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';


                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_newemergenciaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularionewemergencia";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';


                    }


                    if($rs_tabeval->fields["tab_name"]=='dns_anamesisexamenfisico')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularioanamesisexamenfisico";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='exa_fecharegistro';


                    }


                    if($rs_tabeval->fields["tab_name"]=='dns_emergenciaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularioemergenciaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_gastroenterologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariogastroenterologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }


                    if($rs_tabeval->fields["tab_name"]=='dns_pediatriaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariopediatriaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_newtraumatologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularionewtraumatologia";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_traumatologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariotraumatologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }


                    if($rs_tabeval->fields["tab_name"]=='dns_hospitalanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariohospitalanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='anam_fecharegistro';
                    }


                    if($rs_tabeval->fields["tab_name"]=='dns_cardiologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariocardiologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='anam_fecharegistro';

                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_ginecologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularioginecologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='anam_fecharegistro';
                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_interconsulta')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariointerconsulta";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='intercon_fecharegistro';
                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_referencia')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdfreferencia";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='referencia_fecharegistro';
                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_enfermeria')
                    {
                        $campo_fecha='enfer_fecharegistro';

                        // Preparar datos base para los enlaces
                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        // Definir los 7 reportes consolidados de enfermería
                        $reportes_enfermeria = array(
                                array(
                                        'titulo' => 'REGISTRO DE IMPLEMENTOS HOSPITALARIOS',
                                        'archivo' => 'generate_implhosp_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'REGISTRO DE DIETAS SUMINISTRADAS',
                                        'archivo' => 'generate_dtsm_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'CLÍNICA DE ESPECIALIDADES SUR CONSTANTES VITALES Y BALANCE HÍDRICO',
                                        'archivo' => 'generate_ctevitalbh_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'ACTIVIDADES GENERALES DE ENFERMERÍA - REPORTE CONSOLIDADO',
                                        'archivo' => 'generate_acgnlnursing_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'CONTROL PREOPERATORIO - REPORTE CONSOLIDADO',
                                        'archivo' => 'generate_preoperative_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'ADMINISTRACIÓN DE MEDICAMENTOS - KÁRDEX CONSOLIDADO',
                                        'archivo' => 'genera_medicationadmin_consolidado.php'
                                ),
                                array(
                                        'titulo' => 'NOTAS DE ENFERMERÍA - REPORTE CONSOLIDADO',
                                        'archivo' => 'pdfformenfermeria_consolidado.php'
                                )
                        );

                        // Marcar que se encontró enfermería para mostrar los 7 reportes
                        $mostrar_reportes_enfermeria = true;
                        $fecha_enfermeria = $rs_seccion->fields[$campo_fecha];

                        // IMPORTANTE: Hacer skip de este registro para que NO se muestre en la tabla
                        // Solo se mostrarán los 7 reportes consolidados al final
                        $rs_seccion->MoveNext();
                        continue; // Saltar a la siguiente iteración sin mostrar este registro
                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_newhospitalizacionanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularionewhospitalizacion";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='anam_fecharegistro';
                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_recuperacion')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="generate_recoveryhall";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
                        $campo_fecha='recup_fecharegistro';
                    }
                    if($rs_tabeval->fields["tab_name"]=='dns_newsalarecuperacionanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="generate_recoveryhall";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=generate_viewpdf_enfermeria('".$urllinkg."')";
                        $campo_fecha='recup_fecharegistro';
                    }
                    if($rs_tabeval->fields["tab_name"]=='dns_newepicrisisanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformularionewepicrisis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=generate_viewpdf_enfermeria('".$urllinkg."')";
                        $campo_fecha='recup_fecharegistro';
                    }

                    ?>
                    <tr>
                        <td valign="top"><?php  echo $rs_seccion->fields[$campo_fecha]; ?></td>
                        <td><?php  echo $rs_tabeval->fields["tab_title"]; ?><hr />
                            <?php

                            // ============================================
                            // BUSCA SUBSECUENTES PARA CADA TIPO DE CONSULTA
                            // ============================================

                            // SUBSECUENTES PARA CONSULTA EXTERNA NEW
                            if($rs_tabeval->fields["tab_name"]=='dns_newconsultaexternaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='558'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_newconsultaexternaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionnewconsultaexterna";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_consultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA ANAMNESIS EXAMEN FISICO
                            if($rs_tabeval->fields["tab_name"]=='dns_anamesisexamenfisico')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='320'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_consultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformularioevolucion";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_consultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA EMERGENCIA
                            if($rs_tabeval->fields["tab_name"]=='dns_emergenciaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='464'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_emergenciaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionemergencia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_emergenciaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA GASTROENTEROLOGIA
                            if($rs_tabeval->fields["tab_name"]=='dns_gastroenterologiaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='450'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_gastroenterologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevoluciongastroenterologia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_gastroenterologiaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA PEDIATRIA
                            if($rs_tabeval->fields["tab_name"]=='dns_pediatriaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='442'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_pediatriaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionpediatria";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_pediatriaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA TRAUMATOLOGIA NEW
                            if($rs_tabeval->fields["tab_name"]=='dns_newtraumatologiaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='582'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_newtraumatologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionnewtraumatologia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_newtraumatologiaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA TRAUMATOLOGIA
                            if($rs_tabeval->fields["tab_name"]=='dns_traumatologiaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='454'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_traumatologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevoluciontraumatologia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_traumatologiaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA CARDIOLOGIA
                            if($rs_tabeval->fields["tab_name"]=='dns_cardiologiaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='446'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_cardiologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucioncardiologia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_cardiologiaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA GINECOLOGIA
                            if($rs_tabeval->fields["tab_name"]=='dns_ginecologiaanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='458'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_ginecologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionginecologia";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_ginecologiaconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA HOSPITAL (PROTOCOLO OPERATORIO)
                            if($rs_tabeval->fields["tab_name"]=='dns_hospitalanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='432'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_protocolooperatorio where protoop_tblprincipal='dns_hospitalanamesis' and protoop_idenlace='".$rs_seccion->fields["anam_id"]."' order by protoop_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $protoop_id=$rs_subsecuentes->fields["protoop_id"];

                                        $linkpdfgx="pdformularioprotocolo";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$protoop_id;
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='protoop_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_protocolooperatorio'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                                // SUBSECUENTES PARA HOSPITAL (EPICRISIS)
                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='436'";
                                $tab_id=436;
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_epicrisisanamesis where protoop_tblprincipal='dns_hospitalanamesis' and protoop_idenlace='".$rs_seccion->fields["anam_id"]."' order by anam_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5=0&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $anam_id=$rs_subsecuentes->fields["anam_id"];

                                        $linkpdfgx="pdformularioepicrisis";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$anam_id;
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='anam_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_epicrisisanamesis'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            // SUBSECUENTES PARA NEWHOSPITALIZACION
                            if($rs_tabeval->fields["tab_name"]=='dns_newhospitalizacionanamesis')
                            {

                                $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='554'";
                                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
                                $mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];

                                $lista_subsecuentes="select * from dns_newhospitalizacionconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
                                $rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
                                if($rs_subsecuentes)
                                {
                                    while (!$rs_subsecuentes->EOF) {

                                        $campos_data='';
                                        $campos_data64='';
                                        $campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
                                        $campos_data64=base64_encode($campos_data);

                                        $linkpdfgx="pdfformevolucionnewhospitalizacion";
                                        $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];
                                        $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
                                        $campo_fechax='conext_fecharegistro';

                                        $lista_tabevalx="select * from gogess_sistable where tab_name='dns_newhospitalizacionconsultaexterna'";
                                        $rs_tablax = $DB_gogess->executec($lista_tabevalx,array());

                                        echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";



                                        $rs_subsecuentes->MoveNext();
                                    }
                                }


                            }

                            ?>
                        </td>
                        <td valign="top" style="cursor:pointer" <?php echo $linkimprimirg; ?> ><img src="images/pdfdoc.png" ></td>
                        <td>
                            <?php //echo $links_data; ?>
                        </td>
                    </tr>
                    <?php

                    //busca laboratorio
                    $busca_laborato="select * from dns_laboratorio where lab_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and lab_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."'";
                    $rs_laborato = $DB_gogess->executec($busca_laborato,array());
                    if($rs_laborato)
                    {
                        while (!$rs_laborato->EOF) {

                            // CONTROL DE DUPLICADOS: Solo mostrar si no se ha mostrado antes
                            if(!in_array($rs_laborato->fields["lab_id"], $laboratorios_mostrados)) {
                                // Agregar al array de mostrados
                                $laboratorios_mostrados[] = $rs_laborato->fields["lab_id"];

                                $eteneva_id=0;
                                $tab_id=284;
                                $mnupan_id=60;
                                $campos_data='';
                                $campos_data64='';
                                $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                                $campos_data64=base64_encode($campos_data);
                                $linkpdf="pdflaboratorio";
                                $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_laborato->fields["lab_id"];
                                $linkimprimir="onClick=ver_pdfform('".$urllink."')";

                                //busca id informe
                                $busca_informeimg="select * from dns_laboratorioinforme where lab_id='".$rs_laborato->fields["lab_id"]."'";
                                $rs_laboratoinforme = $DB_gogess->executec($busca_informeimg,array());
                                //busca id informe

                                $logoinforme='';
                                $eteneva_idi=0;
                                $tab_idi=325;
                                $mnupan_idi=91;
                                $linkpdfi="pdflaboratorioinforme";
                                $campos_datai='';
                                $campos_data64i='';
                                $campos_datai='iddata='.$tab_idi.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=91';
                                $campos_data64i=base64_encode($campos_datai);
                                $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_laboratoinforme->fields["labinfor_id"];

                                if($rs_laboratoinforme->fields["labinfor_id"]>0)
                                {
                                    $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
                                    $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';
                                }

                                $logoinforme='';
                                ?>

                                <tr>
                                    <td></td>
                                    <td>LABORATORIO CLINICO - SOLICITUD (SNS-MSP / HCU-form.010 / 2008)<br /> <?php echo $rs_laborato->fields["lab_fecharegistro"]; ?></td>
                                    <td>

                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
                                                <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <?php //echo $links_data; ?>
                                    </td>
                                </tr>

                                <?php
                            } // Fin del control de duplicados
                            $rs_laborato->MoveNext();
                        }
                    }

                    //busca laboratorio



                    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                    //busca laboratorio nuevo

                    $busca_laborato="select * from dns_newlaboratorio where lab_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and lab_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."'";
                    $rs_laborato = $DB_gogess->executec($busca_laborato,array());
                    if($rs_laborato)
                    {
                        while (!$rs_laborato->EOF) {

                            // CONTROL DE DUPLICADOS: Solo mostrar si no se ha mostrado antes
                            if(!in_array($rs_laborato->fields["lab_id"], $laboratorios_mostrados)) {
                                // Agregar al array de mostrados
                                $laboratorios_mostrados[] = $rs_laborato->fields["lab_id"];

                                $eteneva_id=0;
                                $tab_id=590;
                                $mnupan_id=219;
                                $campos_data='';
                                $campos_data64='';
                                $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                                $campos_data64=base64_encode($campos_data);
                                $linkpdf="pdfnewlaboratorio";
                                $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_laborato->fields["lab_id"];
                                $linkimprimir="onClick=ver_pdfform('".$urllink."')";

                                //busca id informe
                                $busca_informeimg="select * from dns_laboratorioinforme where lab_id='".$rs_laborato->fields["lab_id"]."'";
                                $rs_laboratoinforme = $DB_gogess->executec($busca_informeimg,array());
                                //busca id informe

                                $logoinforme='';
                                $eteneva_idi=0;
                                $tab_idi=325;
                                $mnupan_idi=91;
                                $linkpdfi="pdflaboratorioinforme";
                                $campos_datai='';
                                $campos_data64i='';
                                $campos_datai='iddata='.$tab_idi.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=91';
                                $campos_data64i=base64_encode($campos_datai);
                                $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_laboratoinforme->fields["labinfor_id"];

                                if($rs_laboratoinforme->fields["labinfor_id"]>0)
                                {
                                    $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
                                    $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';
                                }

                                $logoinforme='';
                                ?>

                                <tr>
                                    <td></td>
                                    <td>NEW LABORATORIO CLINICO - SOLICITUD (SNS-MSP / HCU-form.010 / 2021)<br /> <?php echo $rs_laborato->fields["lab_fecharegistro"]; ?></td>
                                    <td>

                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
                                                <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <?php //echo $links_data; ?>
                                    </td>
                                </tr>

                                <?php
                            } // Fin del control de duplicados
                            $rs_laborato->MoveNext();
                        }
                    }

                    //busca laboratorio nuevo



                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


                    ///=====================================================================================================

                    //busca imagen (versión antigua)
                    $busca_imagen="select * from dns_imagenologia where imgag_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and imgag_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."' order by imgag_fecharegistro desc";
                    $rs_imagen = $DB_gogess->executec($busca_imagen,array());
                    if($rs_imagen)
                    {
                        while (!$rs_imagen->EOF) {

                            // CONTROL DE DUPLICADOS: Solo mostrar si no se ha mostrado antes
                            if(!in_array($rs_imagen->fields["imgag_id"], $imagenes_mostradas)) {
                                // Agregar al array de mostrados
                                $imagenes_mostradas[] = $rs_imagen->fields["imgag_id"];

                                $campo_fechasecun='imgag_fecharegistro';

                                $eteneva_id=0;
                                $tab_id=285;
                                $mnupan_id=61;
                                $campos_data='';
                                $campos_data64='';
                                $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                                $campos_data64=base64_encode($campos_data);
                                $linkpdf="pdfimagen";
                                $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_imagen->fields["imgag_id"];
                                $linkimprimir="onClick=ver_pdfform('".$urllink."')";

                                //busca id informe
                                $busca_informeimg="select * from dns_imagenologiainfo where imgag_id='".$rs_imagen->fields["imgag_id"]."'";
                                $rs_imageninforme = $DB_gogess->executec($busca_informeimg,array());
                                //busca id informe

                                $logoinforme='';
                                $eteneva_idi=0;
                                $tab_idi=324;
                                $mnupan_idi=90;
                                $linkpdfi="pdfimageninforme";
                                $campos_datai='';
                                $campos_data64i='';
                                $campos_datai='iddata=324&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=90';
                                $campos_data64i=base64_encode($campos_datai);
                                $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_imageninforme->fields["imginfo_id"];

                                if($rs_imageninforme->fields["imginfo_id"]>0)
                                {
                                    $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
                                    $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';
                                }


                                ?>

                                <tr>
                                    <td></td>
                                    <td>IMAGENOLOGIA - SOLICITUD (SNS-MSP / HCU-form.012 / 2008)<br><?php echo $rs_imagen->fields["imgag_fecharegistro"]; ?></td>
                                    <td>


                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
                                                <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <?php //echo $links_data; ?>
                                    </td>
                                </tr>

                                <?php
                            } // Fin del control de duplicados
                            $rs_imagen->MoveNext();
                        }
                    }
                    //busca imagen (versión antigua)



                    //busca imagen nuevo

                    $busca_imagen="select * from dns_newimagenologia where imgag_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and imgag_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."' order by imgag_fecharegistro desc";
                    $rs_imagen = $DB_gogess->executec($busca_imagen,array());
                    if($rs_imagen)
                    {
                        while (!$rs_imagen->EOF) {

                            // CONTROL DE DUPLICADOS: Solo mostrar si no se ha mostrado antes
                            if(!in_array($rs_imagen->fields["imgag_id"], $imagenes_mostradas)) {
                                // Agregar al array de mostrados
                                $imagenes_mostradas[] = $rs_imagen->fields["imgag_id"];

                                $campo_fechasecun='imgag_fecharegistro';

                                $eteneva_id=0;
                                $tab_id=587;
                                $mnupan_id=217;
                                $campos_data='';
                                $campos_data64='';
                                $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                                $campos_data64=base64_encode($campos_data);
                                $linkpdf="pdfnewimagen";
                                $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_imagen->fields["imgag_id"];
                                $linkimprimir="onClick=ver_pdfform('".$urllink."')";

                                //busca id informe
                                $busca_informeimg="select * from dns_newimagenologiainfo where imgag_id='".$rs_imagen->fields["imgag_id"]."'";
                                $rs_imageninforme = $DB_gogess->executec($busca_informeimg,array());
                                //busca id informe

                                $logoinforme='';
                                $eteneva_idi=0;
                                $tab_idi=589;
                                $mnupan_idi=218;
                                $linkpdfi="pdfnewimageninforme";
                                $campos_datai='';
                                $campos_data64i='';
                                $campos_datai='iddata=589&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=218';
                                $campos_data64i=base64_encode($campos_datai);
                                $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_imageninforme->fields["imginfo_id"];

                                if($rs_imageninforme->fields["imginfo_id"]>0)
                                {
                                    $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
                                    $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';
                                }


                                ?>

                                <tr>
                                    <td></td>
                                    <td>IMAGENOLOGIA - SOLICITUD (SNS-MSP / HCU-form.012 / 2021)<br><?php echo $rs_imagen->fields["imgag_fecharegistro"]; ?></td>
                                    <td>


                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
                                                <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <?php //echo $links_data; ?>
                                    </td>
                                </tr>

                                <?php
                            } // Fin del control de duplicados
                            $rs_imagen->MoveNext();
                        }
                    }
                    //busca imagen nuevo



                    ///======================================================================================================




                    $rs_seccion->MoveNext();
                }
            }


            $rs_tabeval->MoveNext();
        }
    }

    // ============================================
    // MOSTRAR REPORTES CONSOLIDADOS DE ENFERMERÍA
    // ============================================
    // Si se encontró al menos un registro de enfermería, mostrar los 7 reportes consolidados
    if(isset($mostrar_reportes_enfermeria) && $mostrar_reportes_enfermeria === true && isset($reportes_enfermeria))
    {
        // Preparar datos base para los enlaces (usar los últimos datos de enfermería encontrados)
        $campos_data_enf = 'pVar2='.$clie_id.'&pVar4='.$atenc_id;
        $campos_data64_enf = base64_encode($campos_data_enf);

        foreach($reportes_enfermeria as $reporte)
        {
            $urllink_enf = "pdfformularios/".$reporte['archivo']."?ssr=".$campos_data64_enf;
            ?>
            <tr>
                <td valign="top"><?php echo isset($fecha_enfermeria) ? $fecha_enfermeria : ''; ?></td>
                <td><strong>ENFERMERÍA</strong><br /><?php echo $reporte['titulo']; ?></td>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td onClick="generate_viewpdf_enfermeria('<?php echo $urllink_enf; ?>')" style="cursor:pointer">
                                <img src="images/pdfdoc.png"><br />Ver Reporte
                            </td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            <?php
        }
    }
    // ============================================
    // FIN REPORTES CONSOLIDADOS DE ENFERMERÍA
    // ============================================

    ?>
</table>

<script type="text/javascript">
    <!--

    function ver_pdfform(url)
    {

        window.open(url, '_blank');

    }
    function generate_viewpdf_enfermeria(url)
    {

        window.open(url, '_blank');

    }

    function sin_acceso()
    {
        alert("No tiene acceso a este documento, llame al administrador para solicitar el acceso...");

    }

    function imprimir_datos(tab_id,clie_id,atenc_id,eteneva_id,mnupan_id,id)
    {

        myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata='+tab_id+'&pVar2='+clie_id+'&pVar4='+atenc_id+'&pVar5='+eteneva_id+'&pVar3='+mnupan_id+'&pVar9='+id,'ventana_reporteunico','width=850,height=700,scrollbars=YES');

        myWindow3.focus();



    }
    //  End -->
</script>