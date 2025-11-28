<style>
    .ui-autocomplete {
        max-height: 400px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }

    /* IE 6 doesn't support max-height
     * we use height instead, but this forces the menu to always be this tall
     */
    * html .ui-autocomplete {
        height: 400px;
    }

    .tableScroll_grids {
        z-index: 99;
        height: 190px;
        overflow: auto;
    }


</style>
<?php


//---ENLACE
$enlace_general = $rs_datosmenu->fields["mnupan_campoenlace"] . "x";
$objformulario->sendvar["fechax"] = date("Y-m-d H:i:s");
$objformulario->sendvar[$enlace_general] = @$_SESSION['ces1313777_sessid_emp_id'];
$objformulario->sendvar["horax"] = date("H:i:s");
$objformulario->sendvar["usua_idx"] = @$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"] = 0;
$objformulario->sendvar["clie_idx"] = $clie_id;
$objformulario->sendvar["hcx"] = $rs_atencion->fields["atenc_hc"];
$objformulario->sendvar["atenc_idx"] = $atenc_id;
$objformulario->bloqueo_valor = $bloque_registro;
$objformulario->imprpt = $bloque_registro;
$objformulario->sendvar["centro_idx"] = $centro_id;
$objformulario->sendvar["conext_etiquetasignosvx"] = $enlace_atencion;
$objformulario->sendvar["atenc_enlacex"] = $enlace_atencion;
$objformulario->sendvar["estaatenc_idx"] = 1;

//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
//$rs_atencion = $DB_gogess->executec($datos_atencion,array());

$objformulario->sendvar["anamn_entrevistaclinicax"] = utf8_encode($rs_atencion->fields["atenc_observacion"]);

$valoralet = mt_rand(1, 500);
$aletorioid = $clie_id . '01' . @$_SESSION['ces1313777_sessid_cedula'] . $_SESSION['ces1313777_sessid_inicio'] . date("Ymdhis") . $valoralet;
$objformulario->sendvar["conext_enlacex"] = $aletorioid;

//obtiene datos del representante
$objformulario->sendvar["codex"] = $aletorioid;

$objformulario->sendvar["conext_fecharx"] = date("Y-m-d");
$objformulario->sendvar["conext_horarx"] = date("H:i");
$objformulario->sendvar["anam_idx"] = $anam_id;

//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

    <tr>

        <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_atencion->fields["atenc_hc"]; ?></td>

        <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_direccion"]; ?></td>
    </tr>

    <tr>

        <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php $objformulario->generar_formulario(@$submit, $table, 55, $DB_gogess); ?>
      <?php //echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>
      <?php echo $rs_dcliente->fields["clie_nombre"] . " " . $rs_dcliente->fields["clie_apellido"]; ?>

    </span></td>

        <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"]; ?></td>
    </tr>

    <tr>

        <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"]; ?></td>

        <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

        <td bgcolor="#F1F7F8" class="css_texto"><?php
            $num_mes = calcular_edad($rs_dcliente->fields["clie_fechanacimiento"], $rs_atencion->fields["atenc_fechaingreso"]);
            echo $num_mes["anio"] . " a&ntildeos y " . $num_mes["mes"] . " meses";

            ?></td>
    </tr>
    <tr>
        <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
        <td bgcolor="#D3E0EB"
            class="css_texto"><?php $objformulario->generar_formulario(@$submit, $table, 77, $DB_gogess); ?> </td>
        <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
        <td bgcolor="#D3E0EB"
            class="css_texto"><?php $objformulario->generar_formulario(@$submit, $table, 88, $DB_gogess); ?></td>
    </tr>
</table>
<br/>
<?php
$objformulario->generar_formulario_bootstrap(@$submit, $table, 1, $DB_gogess);
?>
<br/>
<?php
$objformulario->generar_formulario_bootstrap(@$submit, $table, 2, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 3, $DB_gogess);
?>
<input type="button" name="btn_diagnostico_id" id="btn_diagnostico_id" value="DIAGNOSTICO"
       onclick="ocultar_mostrar('diagnostico_id')"/>
<input type="button" name="btn_signos_id" id="btn_signos_id" value="SIGNOS VITALES"
       onclick="ocultar_mostrar('signos_id')"/>
<input type="button" name="btn_antecedentesp_id" id="btn_antecedentesp_id" value="ANTECEDENTES PERSONALES"
       onclick="ocultar_mostrar('antecedentesp_id')"/>
<input type="button" name="btn_antecedentesf_id" id="btn_antecedentesf_id" value="ANTECEDENTES FAMILIARES"
       onclick="ocultar_mostrar('antecedentesf_id')"/>
<input type="button" name="btn_revicionorgf_id" id="btn_revicionorgf_id" value="REVISION ACTUAL DE ORGANOS Y SISTEMAS"
       onclick="ocultar_mostrar('revicionorgf_id')"/>
<!--<input type="button" name="btn_examenfisico_id" id="btn_examenfisico_id" value="EXAMEN FÍSICO REGIONAL"  onclick="ocultar_mostrar('examenfisico_id')"  /> -->
<div id="signos_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 4, $DB_gogess);
    ?>
</div>
<div id="diagnostico_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 5, $DB_gogess);
    ?>
</div>
<div id="antecedentesp_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 6, $DB_gogess);
    ?>
</div>
<div id="antecedentesf_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 7, $DB_gogess);
    ?>
</div>
<div id="revicionorgf_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 8, $DB_gogess);
    ?>
</div>
<div id="examenfisico_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 9, $DB_gogess);
    ?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit, $table, 10, $DB_gogess);
?>
<input type="button" name="btn_recetapres_id" id="btn_recetapres_id" value="RECETA / PRESCRIPCION"
       onclick="ocultar_mostrar2('recetapres_id')"/>
<!--<input type="button" name="btn_dispositivosm_id" id="btn_dispositivosm_id" value="DISPOSITIVOS MEDICOS" onclick="ocultar_mostrar2('dispositivosm_id')" /> -->
<!-- <input type="button" name="Button" value="TARIFARIO" onclick="ocultar_mostrar2('tarifario_id')" />-->

<div id="recetapres_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 11, $DB_gogess);
    ?>
</div>
<div id="dispositivosm_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 12, $DB_gogess);
    ?>
</div>
<div id="tarifario_id">
    <?php
    $objformulario->generar_formulario_bootstrap(@$submit, $table, 13, $DB_gogess);
    ?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit, $table, 14, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 15, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 16, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 17, $DB_gogess);

if ($csearch) {
    $valoropcion = 'actualizar';
} else {
    $valoropcion = 'guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_" . $table . "' type='hidden' value='" . $valoropcion . "' id='opcion_" . $table . "' >
<input name='table' type='hidden' value='" . $table . "'>";
?>
<div id=div_<?php echo $table ?> ></div>


<script>
    function genera_cieexterno(codigo, diagn_tipox) {
        $.ajax({
            url: 'templateformsweb/maestro_standar_anamnesisclinica/searchcie.php',
            data: {term: codigo},
            type: 'GET',
            dataType: 'json',
            success: function (json) {
                if (json && json[0]) {
                    $('#diagn_ciex').val(json[0].codigo);
                    $('#diagn_descripcionx').val(json[0].descripcion);
                    $('#diagn_tipox').val(diagn_tipox);

                    console.log('✅ Diagnóstico cargado: ' + json[0].codigo + ' - ' + json[0].descripcion);
                }
            },
            error: function (xhr, status) {
                console.log('❌ Error al cargar diagnóstico: ' + status);
            },
            complete: function (xhr, status) {
                // Actualizar el grid de diagnósticos con el ID correcto
                if (typeof grid_extras_11362 === 'function') {
                    var enlace = $('#conext_enlace').val();
                    if (enlace) {
                        grid_extras_11362(enlace, 0, 1);
                        console.log('✅ Grid actualizado con grid_extras_11362');
                    } else {
                        console.log('⚠️ No hay valor en conext_enlace');
                    }
                } else {
                    console.log('❌ grid_extras_11362 no está disponible');
                }
            }
        });
    }

    $(function () {
        $("#diagn_ciex").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
            minLength: 2,
            select: function (event, ui) {
                $('#diagn_descripcionx').val(ui.item.descripcion);

            }
        });
    });


    $(function () {
        $("#diagn_descripcionx").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
            minLength: 3,
            select: function (event, ui) {
                $('#diagn_ciex').val(ui.item.codigo);

            }
        });
    });

    $(function () {
        $("#prod_codigox").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
            minLength: 2,
            select: function (event, ui) {
                $('#prod_descripcionx').val(ui.item.descripcion);
                $('#prod_preciox').val(ui.item.precio);

            }
        });
    });


    $(function () {
        $("#prod_descripcionx").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
            minLength: 3,
            select: function (event, ui) {
                $('#prod_codigox').val(ui.item.codigo);
                $('#prod_preciox').val(ui.item.precio);

            }
        });
    });


    $(function () {
        $("#inven_descripcionx").autocomplete({
            source: "templateformsweb/maestro_standar_consultaexterna/searchmed.php",
            minLength: 1,
            select: function (event, ui) {
                $('#inven_codigox').val(ui.item.codigo);
                $('#inven_valorunitx').val(ui.item.valorunitario);

            }
        });
    });


    $(function () {
        $("#plantra_codigox").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamento.php",
            minLength: 2,
            select: function (event, ui) {
                $('#plantra_medicamentox').val(ui.item.descripcion);
                $('#plantra_concentracionx').val(ui.item.concentracion);
                $('#plantra_presentacionx').val(ui.item.presentacion);
                $('#plantra_viax').val(ui.item.via);
                $('#plantra_preciotechox').val(ui.item.techo);
                $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
                $('#plantra_indicacionesx').val(ui.item.descripcion + ':');

            }
        });
    });

    $(function () {
        $("#plantra_medicamentox").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamentotxt.php",
            minLength: 3,
            select: function (event, ui) {
                $('#plantra_codigox').val(ui.item.codigo);
                $('#plantra_concentracionx').val(ui.item.concentracion);
                $('#plantra_presentacionx').val(ui.item.presentacion);
                $('#plantra_viax').val(ui.item.via);
                $('#plantra_preciotechox').val(ui.item.techo);
                $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
                $('#plantra_indicacionesx').val(ui.item.label + ':');

            }
        });
    });


    $(function () {
        $("#plantrai_codigox").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
            minLength: 2,
            select: function (event, ui) {
                $('#plantrai_nombredispositivox').val(ui.item.descripcion);
                $('#plantrai_preciox').val(ui.item.precio);

            }
        });
    });

    $(function () {
        $("#plantrai_nombredispositivox").autocomplete({
            source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
            minLength: 3,
            select: function (event, ui) {
                $('#plantrai_codigox').val(ui.item.codigo);
                $('#plantrai_preciox').val(ui.item.precio);

            }
        });
    });


    //busca cantidad de productos

    $("#plantra_cantidadx").change(function () {
        busca_disponibles();
    });

    $("#plantra_frecuenciax").change(function () {
        busca_disponibles();
    });

    $("#plantra_diasx").change(function () {
        busca_disponibles();
    });


    function busca_disponibles() {
        $("#div_disponibilidad").load("templateformsweb/maestro_standar_anamnesisclinica/busca_disponibles.php", {
            plantra_codigox: $('#plantra_codigox').val()


        }, function (result) {


        });

        $("#div_disponibilidad").html("Espere un momento...");

    }

    function ocultar_mostrar(muestra) {

        $('#signos_id').hide();
        cambio_inactivo('signos_id', 0);
        $('#diagnostico_id').hide();
        cambio_inactivo('diagnostico_id', 0);
        $('#antecedentesp_id').hide();
        cambio_inactivo('antecedentesp_id', 0);
        $('#antecedentesf_id').hide();
        cambio_inactivo('antecedentesf_id', 0);
        $('#revicionorgf_id').hide();
        cambio_inactivo('revicionorgf_id', 0);
        $('#examenfisico_id').hide();
        cambio_inactivo('examenfisico_id', 0);

        $('#' + muestra).show();
        cambio_inactivo(muestra, 1);

    }


    function ocultar_mostrar2(muestra) {

        $('#recetapres_id').hide();
        cambio_inactivo('recetapres_id', 0);
        $('#dispositivosm_id').hide();
        cambio_inactivo('dispositivosm_id', 0);
        $('#tarifario_id').hide();
        cambio_inactivo('tarifario_id', 0);

        $('#' + muestra).show();
        cambio_inactivo(muestra, 1);

    }


    ocultar_mostrar('diagnostico_id');
    ocultar_mostrar2('recetapres_id');


    function cambio_inactivo(divdata, opcion) {
        if (opcion == 0) {
            $('#btn_' + divdata).css('background-color', '#C5E0EB');
            $('#btn_' + divdata).css('color', '#000000');
            $('#btn_' + divdata).css('border', '#000000');
            $('#btn_' + divdata).css('border', 'solid');
            $('#btn_' + divdata).css('border-width', 'thin');
        } else {
            $('#btn_' + divdata).css('background-color', '#000033');
            $('#btn_' + divdata).css('color', '#FFFFFF');
            $('#btn_' + divdata).css('border', '#000000');
            $('#btn_' + divdata).css('border', 'solid');
            $('#btn_' + divdata).css('border-width', 'thin');
        }
    }
</script>


<script>
    function genera_codproducto() {
        $.ajax({
            url: 'templateformsweb/maestro_standar_consultaexterna/searchpro.php',
            data: {term: '99214'},
            type: 'GET',
            dataType: 'json',
            success: function (json) {
                $('#prod_codigox').val(json[0].codigo);
                $('#prod_descripcionx').val(json[0].descripcion);
                $('#prod_preciox').val(json[0].precio);
            },
            error: function (xhr, status) {
                // Error
            },
            complete: function (xhr, status) {
                grid_extras_4858($('#conext_enlace').val(), 0, 1);
            }
        });
    }

    <?php
    if($bloque_registro == 0)
    {
    ?>
    //genera_codproducto();
    <?php
    }
    ?>

    // Calculo receta
    function calcular_receta() {
        var plantra_frecuenciax;
        var plantra_diasx;
        var plantra_cantidadx;
        var total;

        plantra_frecuenciax = parseFloat($('#plantra_frecuenciax').val());
        plantra_diasx = parseFloat($('#plantra_diasx').val());
        total = plantra_frecuenciax * plantra_diasx;
        $('#plantra_cantidadx').val(total);
    }

    $("#plantra_frecuenciax").change(function () {
        calcular_receta();
    });

    $("#plantra_diasx").change(function () {
        calcular_receta();
    });

</script>
<?php
// ============================================
// CÓDIGO PHP PARA CARGAR DIAGNÓSTICOS
// ============================================

// Verificar si hay diagnósticos previos en ESTE registro
$bandera_cie = 0;

if(isset($objformulario->contenid["conext_enlace"]) && $objformulario->contenid["conext_enlace"])
{
    // EDITANDO - Verificar si ya tiene diagnósticos guardados
    $busca_diag = "SELECT COUNT(*) as total FROM dns_newdiagnostico WHERE conext_enlace='".$objformulario->contenid["conext_enlace"]."'";
    $rs_diag = $DB_gogess->executec($busca_diag, array());

    if($rs_diag && !$rs_diag->EOF)
    {
        $bandera_cie = $rs_diag->fields["total"];
    }
}
else if(isset($objformulario->sendvar["conext_enlacex"]))
{
    // NUEVO - Verificar si ya se agregaron diagnósticos
    $busca_diag = "SELECT COUNT(*) as total FROM dns_newdiagnostico WHERE conext_enlace='".$objformulario->sendvar["conext_enlacex"]."'";
    $rs_diag = $DB_gogess->executec($busca_diag, array());

    if($rs_diag && !$rs_diag->EOF)
    {
        $bandera_cie = $rs_diag->fields["total"];
    }
}

// SOLO cargar diagnósticos automáticamente si:
// 1. NO hay diagnósticos guardados ($bandera_cie == 0)
// 2. Es un registro NUEVO (no está en modo edición)
if($bandera_cie == 0 && !$csearch && isset($atenc_id) && $atenc_id > 0)
{
    // Obtener configuración de la tabla hija de diagnósticos
    $busca_campodiag = "SELECT * FROM gogess_sisfield 
                        WHERE tab_name='dns_newhospitalizacionanamesis' 
                        AND ttbl_id=1 
                        AND fie_tablasubgrid!=''";

    $rs_campodiag = $DB_gogess->executec($busca_campodiag, array());

    if($rs_campodiag && !$rs_campodiag->EOF)
    {
        $tabla_hija = $rs_campodiag->fields["fie_tablasubgrid"];
        $campo_enlace = $rs_campodiag->fields["fie_campoenlacesub"];

        // Buscar registro de hospitalización
        $busca_hosp = "SELECT anam_enlace
                       FROM dns_newhospitalizacionanamesis
                       WHERE atenc_id = ".$atenc_id."
                       ORDER BY anam_id DESC
                       LIMIT 1";

        $rs_hosp = $DB_gogess->executec($busca_hosp, array());

        if($rs_hosp && !$rs_hosp->EOF && $rs_hosp->fields["anam_enlace"])
        {
            $anam_enlace = $rs_hosp->fields["anam_enlace"];

            // Buscar diagnósticos en la tabla hija
            $busca_listadiag = "SELECT diagn_cie, diagn_tipo
                               FROM ".$tabla_hija."
                               WHERE ".$campo_enlace."='".$anam_enlace."'
                               ORDER BY 1 ASC";

            $rs_listd = $DB_gogess->executec($busca_listadiag, array());

            if($rs_listd && !$rs_listd->EOF)
            {
                $diagnosticos_array = array();

//                echo "<script>";
//                echo "console.log('🔄 Cargando diagnósticos automáticamente (registro nuevo)...');";

                while (!$rs_listd->EOF)
                {
                    $cie = trim($rs_listd->fields["diagn_cie"]);
                    $tipo = isset($rs_listd->fields["diagn_tipo"]) ? trim($rs_listd->fields["diagn_tipo"]) : '1';

                    if($cie != '' && !in_array($cie, $diagnosticos_array))
                    {
                        echo "genera_cieexterno('".$cie."', '".$tipo."');";
                        $diagnosticos_array[] = $cie;
                    }

                    $rs_listd->MoveNext();
                }

//                echo "console.log('✅ Diagnósticos cargados: ".count($diagnosticos_array)."');";
//                echo "</script>";
            }
        }
    }
}
//else if($bandera_cie > 0)
//{
//    echo "<script>console.log('ℹ️ Registro ya tiene ".$bandera_cie." diagnóstico(s) guardado(s). No se cargan automáticamente.');</script>";
//}
//else if($csearch)
//{
//    echo "<script>console.log('ℹ️ Modo edición: No se cargan diagnósticos automáticamente.');</script>";
//}

echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>