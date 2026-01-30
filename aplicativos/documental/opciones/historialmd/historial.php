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

// ARRAYS PARA CONTROLAR DUPLICADOS
$laboratorios_mostrados = array();
$imagenes_mostradas = array();

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


    // NOTA: Se removió 'dns_newtraumatologiaanamesis' de la lista de exclusión para que se muestren los registros
    $lista_tabeval="select * from gogess_sistable where tab_name not in ('dns_imagenologia','dns_laboratorio','dns_laboratorioinforme','dns_consultaexterna','dns_rehabilitacionanamesis','dns_otorrinoanamesis','dns_ginecologiaconsultaexterna','dns_emergenciaconsultaexterna','dns_gastroenterologiaconsultaexterna','dns_pediatriaconsultaexterna','dns_cardiologiaconsultaexterna','dns_traumatologiaconsultaexterna','dns_enfermeria','dns_hospitalconsultaexterna','dns_newinterconsulta','dns_newhospitalizacionconsultaexterna','dns_newgastroenterologiaanamesis','dns_newgastroenterologiaconsultaexterna','dns_newcardiologiaanamesis','dns_newcardiologiaconsultaexterna','dns_newpediatriaanamesis','dns_newpediatriaconsultaexterna','dns_newtraumatologiaconsultaexterna','dns_newconsultaexternaconsultaexterna','dns_newemergenciaanamesis','dns_newemergenciaconsultaexterna','dns_newprotocolooperatorio','dns_protocolooperatorio','dns_epicrisisanamesis','dns_epicrisisconsultaexterna','dns_newepicrisisanamesis','dns_newreferencia','dns_newimagenologiainfo','dns_odontologia','dns_imagenologiainfo') and  tab_sysmedico=1";
    $rs_tabeval = $DB_gogess->executec($lista_tabeval,array());
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

                        $linkpdfg="pdformulariotraumatologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                        // MOSTRAR EL REGISTRO PRINCIPAL (PRIMERA VEZ)
                        ?>
                        <tr>
                            <td><?php echo $rs_seccion->fields[$campo_fecha]; ?></td>
                            <td><?php echo $rs_datosmenu->fields["mnupan_nombre"]; ?> - PRIMERA VEZ</td>
                            <td <?php echo $linkimprimirg; ?> style="cursor:pointer"><img src="images/pdfdoc.png" ></td>
                        </tr>
                        <?php

                        // BUSCAR Y MOSTRAR SUBSECUENTES RELACIONADOS
                        $anam_id_principal = $rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];

                        // Buscar subsecuentes vinculados a esta anamnesis (primera vez)
                        $busca_subsecuentes = "SELECT * FROM dns_newtraumatologiaconsultaexterna 
                                              WHERE anam_id = '".$anam_id_principal."' 
                                              ORDER BY cons_fecharegistro DESC";
                        $rs_subsecuentes = $DB_gogess->executec($busca_subsecuentes, array());

                        if($rs_subsecuentes && !$rs_subsecuentes->EOF)
                        {
                            while (!$rs_subsecuentes->EOF)
                            {
                                // Preparar datos para PDF de subsecuente
                                $eteneva_id_sub = '';
                                $tab_id_sub = $rs_tabeval->fields["tab_id"]; // Usar el mismo tab_id o buscar el específico
                                $mnupan_id_sub = $mnupan_id;

                                $campos_data_sub = 'iddata='.$tab_id_sub.'&pVar2='.$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id_sub.'&pVar3='.$mnupan_id_sub;
                                $campos_data64_sub = base64_encode($campos_data_sub);

                                $linkpdf_sub = "pdformulariotraumatologiaconsultaexterna"; // Nombre del PDF para subsecuentes
                                $urllink_sub = "pdfformularios/".$linkpdf_sub.".php?ssr=".$campos_data64_sub."|"."+".$rs_subsecuentes->fields["cons_id"];
                                $linkimprimir_sub = "onClick=ver_pdfform('".$urllink_sub."')";
                                ?>
                                <tr class="subsecuente">
                                    <td><?php echo $rs_subsecuentes->fields["cons_fecharegistro"]; ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;↳ SUBSECUENTE</td>
                                    <td <?php echo $linkimprimir_sub; ?> style="cursor:pointer"><img src="images/pdfdoc.png" ></td>
                                </tr>
                                <?php
                                $rs_subsecuentes->MoveNext();
                            }
                        }
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

                    if($rs_tabeval->fields["tab_name"]=='dns_otorrinolaringologiaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariootorrinolaringologiaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }

                    if($rs_tabeval->fields["tab_name"]=='dns_rehabilitacionfisicaanamesis')
                    {

                        $campos_data='';
                        $campos_data64='';
                        $campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                        $campos_data64=base64_encode($campos_data);

                        $linkpdfg="pdformulariorehabilitacionfisicaanamesis";
                        $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];
                        $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";

                        $campo_fecha='anam_fecharegistro';

                    }

                    // MOSTRAR EL TR PARA TODAS LAS DEMÁS TABLAS (EXCEPTO dns_newtraumatologiaanamesis que ya se mostró arriba)
                    if($rs_tabeval->fields["tab_name"]!='dns_newtraumatologiaanamesis' && $campo_fecha!='')
                    {
                        ?>
                        <tr>
                            <td><?php echo $rs_seccion->fields[$campo_fecha]; ?></td>
                            <td><?php echo $rs_datosmenu->fields["mnupan_nombre"]; ?></td>
                            <td <?php echo $linkimprimirg; ?> style="cursor:pointer"><img src="images/pdfdoc.png" ></td>
                        </tr>
                        <?php
                    }


                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                    //busca laboratorio nuevo

                    $busca_laborato="select * from dns_newlaboratorio where lab_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and lab_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."' order by lab_fecharegistro desc";
                    $rs_laborato = $DB_gogess->executec($busca_laborato,array());
                    if($rs_laborato)
                    {
                        while (!$rs_laborato->EOF) {

                            // CONTROL DE DUPLICADOS: Solo mostrar si no se ha mostrado antes
                            if(!in_array($rs_laborato->fields["lab_id"], $laboratorios_mostrados)) {
                                // Agregar al array de mostrados
                                $laboratorios_mostrados[] = $rs_laborato->fields["lab_id"];

                                $campo_fechasecun='lab_fecharegistro';

                                $eteneva_id=0;
                                $tab_id=504;
                                $mnupan_id=207;
                                $campos_data='';
                                $campos_data64='';
                                $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                                $campos_data64=base64_encode($campos_data);
                                $linkpdf="pdfnewlaboratorio";
                                $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_laborato->fields["lab_id"];
                                $linkimprimir="onClick=ver_pdfform('".$urllink."')";

                                //busca id informe
                                $busca_laboratoinforme="select * from dns_newlaboratorioinforme where lab_id='".$rs_laborato->fields["lab_id"]."'";
                                $rs_laboratoinforme = $DB_gogess->executec($busca_laboratoinforme,array());
                                //busca id informe

                                $logoinforme='';
                                $eteneva_idi=0;
                                $tab_idi=586;
                                $mnupan_idi=216;
                                $linkpdfi="pdfnewlaboratorioinforme";
                                $campos_datai='';
                                $campos_data64i='';
                                $campos_datai='iddata=586&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=216';
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
    ?>
</table>

<script type="text/javascript">
    <!--

    function ver_pdfform(url)
    {

        location.href = url;

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