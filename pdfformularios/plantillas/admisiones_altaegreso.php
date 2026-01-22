<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Informe</title>
    <style type="text/css">
        <!--
        body,td,th {
            font-family: Arial;
            font-size: 11px;
        }
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 10px;
        }
        .borde_all{
            border: 1px solid #000000;
        }
        .css_5 {font-size: 5px}
        .css_6 {font-size: 6px}
        .css_7 {font-size: 7px}
        .css_8 {font-size: 8px}
        .css_9 {font-size: 9px}
        .css_10 {font-size: 10px}
        .css_11 {font-size: 11px}
        .css_12 {font-size: 12px}

        @page { margin: 10px; }

        .cmb_campot {
            font-size: 10px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
            border: 1px solid #666666;
        }

        .cmb_campot2 {
            font-size: 7px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
        }

        .txt_odonto{
            font-size: 10px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .style1 {font-size: 12px; font-weight: bold; }

        /* Estilos para el header */
        .header-tabla {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .header-tabla td {
            padding: 5px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 100px;
            text-align: center;
            border-right: 1px solid #000;
        }

        .logo-cell img {
            max-width: 60px;
            max-height: 40px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .titulo-cell {
            text-align: center;
            border-right: 1px solid #000;
        }

        .titulo-principal {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .subtitulo {
            font-size: 11px;
            font-weight: bold;
        }

        .codigo-cell {
            width: 100px;
            text-align: center;
            font-size: 8px;
        }

        /* Estilos para centrar contenido */
        .contenedor-principal {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Footer centrado */
        .footer {
            font-size: 7px;
            text-align: center;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            max-width: 800px;
            margin: 15px auto 0;
        }
        -->
    </style>
    <style>
        @page {
            margin-top: 100px;
            margin-bottom: 50px;
            margin-left: 10px;
            margin-right: 10px;
        }

        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            height: 80px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 35px;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body>
<header>
    <div class="contenedor-principal">
        <table class="header-tabla">
            <tr>
                <td height="54" class="logo-cell">
                    <img src="../archivo/-logoreporte-" alt="Logo">                </td>
                <td class="titulo-cell">
                    <div class="titulo-principal">-empresanombre-</div>
                    <div class="subtitulo">REGISTRO DE ADMISIÓN</div>
                </td>
                <td class="codigo-cell"><p><b>-piedepagina-</b></p>
            </tr>
        </table>
    </div>
</header>

<footer></footer>

<div class="contenedor-principal">
    <table width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="5" bgcolor="#CCCCFF" class="borde_all"><span class="style1">A DATOS DEL ESTABLECIMIENTO </span></td>
        </tr>
        <tr>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">INSTITUCIÓN DEL SISTEMA</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">ESTABLECIMIENTO DE SALUD</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">UNICÓDIGO</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">NÚMERO DE HISTORIA CLÍNICA ÚNICA</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">NÚMERO DE ARCHIVO</div></td>
        </tr>
        <tr>
            <td class="borde_all css_8"><div align="center">-institucion-</div></td>
            <td class="borde_all css_8"><div align="center">-centro_id-</div></td>
            <td class="borde_all css_8"><div align="center">-ucodigo-</div></td>
            <td class="borde_all css_8"><div align="center">-hc-</div></td>
            <td class="borde_all css_8"><div align="center">-clie_hcpinos-</div></td>
        </tr>
    </table>
    <table width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" bgcolor="#CCCCFF" class="borde_all"><span class="style1">B. REGISTRO DE ADMISIÓN</span></td>

        </tr>
        <tr>
            <td  bgcolor="#CCFFCC" class="borde_all"><div align="center">FECHA DE ADMISIÓN</div></td>
            <td  bgcolor="#CCFFCC" class="borde_all"><div align="center">NOMBRE Y APELLIDO DEL ADMISIONISTA</div></td>
        </tr>
        <tr>
            <td  class="borde_all css_8"><div align="center">-clie_registro- </div></td>
            <td  class="borde_all css_8"><div align="center">-usua_id- </div></td>
        </tr>
    </table>
    <table width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td  bgcolor="#CCCCFF" class="css_8 borde_all"><span class="style1">C. DATOS PERSONALES DEL USUARIO </span></td>
        </tr>
        <tr>
            <td class="borde_all css_8"><table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">PRIMER APELLIDO</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">SEGUNDO APELLIDO</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">PRIMER NOMBRE</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">SEGUNDO NOMBRE</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">TIPO DE IDENTIFICACION</div></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="borde_all css_8"><div align="center">-clie_apellido-</div></td>
                        <td colspan="2" class="borde_all css_8"><div align="center">-clie_nombre-</div></td>
                        <td class="borde_all css_8"><div align="center">-tipoci_id-</div></td>
                    </tr>
                </table>
                <table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">ESTADO CIVIL</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">SEXO</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">No. TELÉFONO FIJO</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">No. TELÉFONO CELULAR</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">CORREO ELECTRÓNICO</div></td>
                    </tr>
                    <tr>
                        <td class="borde_all css_8"><div align="center">-civil_id-</div></td>
                        <td class="borde_all css_8"><div align="center">-genero-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_telefono-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_celular-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_email-</div></td>
                    </tr>
                </table>
                <table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="2" bgcolor="#CCFFCC" class="borde_all"><div align="center">FECHA NACIMIENTO</div></td>
                        <td rowspan="2" bgcolor="#CCFFCC" class="borde_all"><div align="center">LUGAR DE NACIMIENTO</div></td>
                        <td rowspan="2" bgcolor="#CCFFCC" class="borde_all"><div align="center">NACIONALIDAD</div></td>
                        <td rowspan="2" bgcolor="#CCFFCC" class="borde_all"><div align="center">EDAD</div></td>
                        <td colspan="4" bgcolor="#CCFFCC" class="borde_all"><div align="center">CONDICIÓN DE LA EDAD</div></td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center"><strong>H</strong></div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center"><strong>D</strong></div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center"><strong>M</strong></div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center"><strong>A</strong></div></td>
                    </tr>
                    <tr>
                        <td class="borde_all css_8"><div align="center">-clie_fechanacimiento-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_lugarnacimiento-</div></td>
                        <td class="borde_all css_8"><div align="center">-nac_id-</div></td>
                        <td class="borde_all css_8"><div align="center">-edad-</div></td>
                        <td class="borde_all css_8">&nbsp;</td>
                        <td class="borde_all css_8"><div align="center">-ced-</div></td>
                        <td class="borde_all css_8"><div align="center">-cem-</div></td>
                        <td class="borde_all css_8"><div align="center">-cea-</div></td>
                    </tr>
                </table>
                <table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="4" class="borde_all"><div align="center">RESIDENCIA  HABITUAL</div>            <div align="center"></div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">PROVINCIA</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">CANTÓN</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">PARROQUIA</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">BARRIO O SECTOR</div></td>
                    </tr>
                    <tr>
                        <td class="borde_all css_8"><div align="center">-prob_codigo-</div></td>
                        <td class="borde_all css_8"><div align="center">-cant_codigo-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_parroquia-</div></td>
                        <td class="borde_all css_8">&nbsp;</td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">CALLE PRINCIPAL</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">CALLE SECUNDARIA </div></td>
                        <td colspan="2" bgcolor="#CCFFCC" class="borde_all"><div align="center">REFERENCIA</div></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="borde_all css_8"><div align="center">-clie_direccion-</div></td>
                        <td class="borde_all css_8">&nbsp;</td>
                        <td class="borde_all css_8">&nbsp;</td>
                    </tr>
                </table>
                <table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">AUTOIDENTIFICACIÓN ÉTNICA</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">NACIONALIDAD ÉTNICA</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">*PUEBLOS</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">NIVEL DE EDUCACIÓN</div></td>
                    </tr>
                    <tr>
                        <td class="borde_all css_8"><div align="center">N/A</div></td>
                        <td class="borde_all css_8"><div align="center">N/A</div></td>
                        <td class="borde_all css_8"><div align="center">N/A</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_instruccion-</div></td>
                    </tr>
                </table>
                <table width="570" cellpadding="0" cellspacing="0">
                    <tr>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">ESTADO DE NIVEL DE EDUCACIÓN</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">OCUPACIÓN / PROFESIÓN PRINCIPAL</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">TIPO DE EMPRESA DE TRABAJO</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">SEGURO SALUD PRINCIPAL</div></td>
                        <td bgcolor="#CCFFCC" class="borde_all"><div align="center">TIPO DE BONO QUE RECIBE </div></td>
                    </tr>
                    <tr>
                        <td class="borde_all css_8"><div align="center"></div></td>
                        <td class="borde_all css_8"><div align="center">-clie_ocupacion-</div></td>
                        <td class="borde_all css_8"><div align="center">-clie_tipoempresa-</div></td>
                        <td class="borde_all css_8"><div align="center">-conve_id-</div></td>
                        <td class="borde_all css_8">&nbsp;</td>
                    </tr>
                </table></td>
        </tr>
    </table>
    * Aplica únicamente para nacionalidad étnica Kichwa
    <table width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="5" bgcolor="#CCCCFF" class="borde_all"><span class="style1">D. DATOS DE CONTACTO </span></td>
        </tr>
        <tr>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">EN CASO NECESARIO LLAMAR A: </div></td>
            <td bgcolor="#CCFFCC" class="borde_all">&nbsp;</td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">PARENTESCO</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">DIRECCIÓN</div></td>
            <td bgcolor="#CCFFCC" class="borde_all"><div align="center">No. TELÉFONO</div>      </td>
        </tr>
        <tr>
            <td height="16" class="borde_all css_8"><div align="center">-clie_encadodeemergencia-</div></td>
            <td height="16" class="borde_all css_8">&nbsp;</td>
            <td class="borde_all css_8"><div align="center">-clie_parentescocontacto-</div></td>
            <td class="borde_all css_8"><div align="center">-clie_direccioncontacto-</div></td>
            <td class="borde_all css_8"><div align="center">-clie_celular-</div></td>
        </tr>
    </table>

    <img src="plantillas/adm1.png" width="770"  />

    <table width="567" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td ><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2" class="css_11"><p align="justify">&nbsp;</p>          </td>
                    </tr>
                    <tr>
                        <td width="40%" class="css_11"><b>SNS-MSP / HCU-form.001 / 2019</b></td>
                        <td width="38%" class="css_11"><div align="right"><b>ADMISIÓN</b></div></td>
                    </tr>
                </table></td>
        </tr>
    </table>
    <p>&nbsp;</p>

    <div style="page-break-after:always;"></div>
    <img src="plantillas/adm2.png" width="770"  />

</div>
</body>
</html>