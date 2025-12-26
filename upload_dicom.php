<?php
// Configuración de logs de errores
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_upload_dicom.txt');
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Incluir clases y declaración para tener $DB_gogess
include('cfg/clases.php');
include('cfg/declaracion.php');

$upload_base_dir = 'uploads/dicom/';
$max_file_size = 500 * 1024 * 1024;

// ===================================================
// FUNCIÓN PARA INTERPRETAR ERRORES DE UPLOAD
// ===================================================
function getUploadErrorMessage($error_code) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => 'El archivo excede upload_max_filesize en php.ini',
        UPLOAD_ERR_FORM_SIZE => 'El archivo excede MAX_FILE_SIZE en el formulario',
        UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente',
        UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo',
        UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal',
        UPLOAD_ERR_CANT_WRITE => 'Error escribiendo el archivo en disco',
        UPLOAD_ERR_EXTENSION => 'Una extensión de PHP detuvo la subida'
    ];
    return $errors[$error_code] ?? "Error desconocido (código: $error_code)";
}

try {
    // ===================================================
    // DIAGNÓSTICO INICIAL: CONFIGURACIÓN PHP
    // ===================================================
    error_log("=================================");
    error_log("=== DIAGNÓSTICO CONFIGURACIÓN ===");
    error_log("=================================");
    error_log("upload_max_filesize: " . ini_get('upload_max_filesize'));
    error_log("post_max_size: " . ini_get('post_max_size'));
    error_log("max_file_uploads: " . ini_get('max_file_uploads'));
    error_log("memory_limit: " . ini_get('memory_limit'));
    error_log("max_execution_time: " . ini_get('max_execution_time'));
    error_log("file_uploads: " . (ini_get('file_uploads') ? 'Enabled' : 'Disabled'));
    error_log("upload_tmp_dir: " . (ini_get('upload_tmp_dir') ?: 'default'));
    error_log("=================================");

    // Crear carpeta base si no existe
    if (!file_exists($upload_base_dir)) {
        error_log("📁 Creando carpeta base: $upload_base_dir");
        if (!mkdir($upload_base_dir, 0755, true)) {
            throw new Exception('No se pudo crear el directorio base de uploads');
        }
    }

    // Verificar permisos de escritura
    if (!is_writable($upload_base_dir)) {
        throw new Exception("La carpeta base no tiene permisos de escritura: $upload_base_dir");
    }
    error_log("✅ Carpeta base tiene permisos de escritura");

    // ===================================================
    // VALIDAR QUE SE RECIBIERON ARCHIVOS
    // ===================================================
    error_log("=================================");
    error_log("=== VALIDACIÓN DE ARCHIVOS ===");
    error_log("=================================");
    error_log("isset(\$_FILES['dicom_files']): " . (isset($_FILES['dicom_files']) ? 'SI' : 'NO'));

    if (isset($_FILES['dicom_files'])) {
        error_log("Estructura \$_FILES['dicom_files']: " . print_r($_FILES['dicom_files'], true));
        error_log("¿Tiene name[0]?: " . (isset($_FILES['dicom_files']['name'][0]) ? 'SI' : 'NO'));
        error_log("¿name[0] está vacío?: " . (empty($_FILES['dicom_files']['name'][0]) ? 'SI' : 'NO'));
    }

    if (!isset($_FILES['dicom_files']) || empty($_FILES['dicom_files']['name'][0])) {
        throw new Exception('No se recibieron archivos DICOM. Verifica que el formulario tenga enctype="multipart/form-data"');
    }

    // ===================================================
    // OBTENER DATOS DEL FORMULARIO
    // ===================================================
    error_log("=================================");
    error_log("=== DATOS DEL FORMULARIO ===");
    error_log("=================================");

    $clie_id = isset($_POST['clie_idx']) ? intval($_POST['clie_idx']) : 0;
    $atenc_id = isset($_POST['atenc_idx']) ? intval($_POST['atenc_idx']) : 0;
    $centro_id = isset($_POST['centro_id']) ? intval($_POST['centro_id']) :
        (isset($_SESSION['ces1313777_centro_id']) ? intval($_SESSION['ces1313777_centro_id']) : 0);
    $usua_id = isset($_POST['usua_id']) ? intval($_POST['usua_id']) :
        (isset($_SESSION['ces1313777_sessid_inicio']) ? intval($_SESSION['ces1313777_sessid_inicio']) : 0);

    $imginfo_enlace = isset($_POST['imginfo_enlacex']) ? trim($_POST['imginfo_enlacex']) :
        (isset($_POST['imginfo_enlace']) ? trim($_POST['imginfo_enlace']) : '');

    $imgag_id = isset($_POST['imgag_id']) ? intval($_POST['imgag_id']) : 0;
    $imginfo_id = isset($_POST['imginfo_id']) ? intval($_POST['imginfo_id']) : 0;

    error_log("clie_id: $clie_id");
    error_log("atenc_id: $atenc_id");
    error_log("centro_id: $centro_id");
    error_log("usua_id: $usua_id");
    error_log("imginfo_enlace: $imginfo_enlace");
    error_log("imgag_id: $imgag_id");
    error_log("imginfo_id: $imginfo_id");

    if ($clie_id <= 0) {
        throw new Exception('ID de paciente no válido. clie_id: ' . $clie_id);
    }

    // ===================================================
    // BUSCAR EN LA BD SI ES NECESARIO
    // ===================================================
    if ($imginfo_id <= 0 && !empty($imginfo_enlace)) {
        error_log("🔍 Buscando imginfo_id usando imginfo_enlace: $imginfo_enlace");

        $sql_buscar = "SELECT imginfo_id, imgag_id FROM dns_newimagenologiainfo 
                       WHERE imginfo_enlace = ?";
        $rs_buscar = $DB_gogess->executec($sql_buscar, [$imginfo_enlace]);

        if ($rs_buscar && !$rs_buscar->EOF) {
            $imginfo_id = intval($rs_buscar->fields['imginfo_id']);
            $imgag_id = intval($rs_buscar->fields['imgag_id']);
            error_log("✅ Encontrado - imginfo_id: $imginfo_id, imgag_id: $imgag_id");
        } else {
            error_log("❌ No se encontró registro con imginfo_enlace: $imginfo_enlace");
            throw new Exception('No se encontró el registro de imagenología. Guarde primero el formulario antes de subir archivos DICOM.');
        }
    } elseif ($imginfo_id <= 0) {
        throw new Exception('No se proporcionó imginfo_id ni imginfo_enlace válido.');
    }

    // ===================================================
    // CREAR CARPETA DE DESTINO
    // ===================================================
    $folder_name = date('Y-m-d_His') . '_' . $clie_id . '_' . $imginfo_id . '_' . uniqid();
    $upload_dir = $upload_base_dir . $folder_name . '/';

    error_log("📁 Intentando crear carpeta: $upload_dir");

    if (!mkdir($upload_dir, 0755, true)) {
        throw new Exception('No se pudo crear el directorio de destino: ' . $upload_dir);
    }

    if (!is_writable($upload_dir)) {
        throw new Exception("La carpeta creada no tiene permisos de escritura: $upload_dir");
    }

    error_log("✅ Carpeta creada con permisos correctos: $upload_dir");

    // ===================================================
    // PROCESAR ARCHIVOS DICOM
    // ===================================================
    error_log("=================================");
    error_log("=== PROCESAMIENTO DE ARCHIVOS ===");
    error_log("=================================");

    $uploaded_files = [];
    $files = $_FILES['dicom_files'];
    $file_count = count($files['name']);

    error_log("📦 Total archivos detectados: $file_count");

    for ($i = 0; $i < $file_count; $i++) {
        error_log("--- Procesando archivo #" . ($i + 1) . " ---");
        error_log("  📄 Nombre: " . ($files['name'][$i] ?? 'N/A'));
        error_log("  🔢 Código error: " . ($files['error'][$i] ?? 'N/A'));
        error_log("  📏 Tamaño: " . ($files['size'][$i] ?? 'N/A') . " bytes");
        error_log("  📂 Tmp name: " . ($files['tmp_name'][$i] ?? 'N/A'));

        // Verificar que existe el índice de error
        if (!isset($files['error'][$i])) {
            error_log("  ⚠️ Índice de error no existe para archivo #" . ($i + 1));
            continue;
        }

        // Verificar si hubo error en la subida
        if ($files['error'][$i] !== UPLOAD_ERR_OK) {
            $error_msg = getUploadErrorMessage($files['error'][$i]);
            error_log("  ❌ Error de upload: $error_msg");
            continue;
        }

        $tmp_name = $files['tmp_name'][$i];
        $original_name = basename($files['name'][$i]);

        // Validar nombre no vacío
        if (empty($original_name)) {
            error_log("  ⚠️ Nombre de archivo vacío");
            continue;
        }

        // Validar extensión .dcm
        if (!preg_match('/\.dcm$/i', $original_name)) {
            error_log("  ⚠️ Archivo ignorado (no es .dcm): $original_name");
            continue;
        }

        // Validar que el archivo temporal existe
        if (!file_exists($tmp_name)) {
            error_log("  ❌ Archivo temporal no existe: $tmp_name");
            continue;
        }

        // Validar tamaño
        if ($files['size'][$i] > $max_file_size) {
            $size_mb = round($files['size'][$i] / 1024 / 1024, 2);
            $max_mb = round($max_file_size / 1024 / 1024, 2);
            error_log("  ❌ Archivo muy grande: {$size_mb}MB (máximo: {$max_mb}MB)");
            throw new Exception("El archivo {$original_name} excede el tamaño máximo permitido ({$max_mb}MB)");
        }

        // Sanitizar nombre
        $safe_name = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $original_name);
        $destination = $upload_dir . $safe_name;

        error_log("  🚀 Moviendo archivo...");
        error_log("     Origen: $tmp_name");
        error_log("     Destino: $destination");

        // Intentar mover el archivo
        if (!move_uploaded_file($tmp_name, $destination)) {
            error_log("  ❌ No se pudo mover el archivo");
            throw new Exception("No se pudo mover el archivo {$original_name}");
        }

        // Verificar que el archivo se movió correctamente
        if (!file_exists($destination)) {
            error_log("  ❌ El archivo no existe después de move_uploaded_file");
            throw new Exception("Error verificando el archivo movido: {$original_name}");
        }

        $uploaded_files[] = $safe_name;
        error_log("  ✅ Archivo subido exitosamente: $safe_name");
    }

    // ===================================================
    // VALIDAR QUE SE SUBIÓ AL MENOS UN ARCHIVO
    // ===================================================
    error_log("=================================");
    error_log("📊 Total archivos procesados exitosamente: " . count($uploaded_files));
    error_log("=================================");

    if (empty($uploaded_files)) {
        error_log("❌ NINGÚN ARCHIVO FUE PROCESADO EXITOSAMENTE");
        throw new Exception('No se pudo subir ningún archivo DICOM válido. Revisa los logs para más detalles sobre los errores específicos.');
    }

    $total_archivos = count($uploaded_files);

    // ===================================================
    // GUARDAR EN BASE DE DATOS
    // ===================================================
    error_log("=================================");
    error_log("=== GUARDANDO EN BASE DE DATOS ===");
    error_log("=================================");

    // Eliminar registros anteriores
    $sql_delete = "DELETE FROM dns_newimagenologiainfo_archivos WHERE imgag_id = ?";
    $DB_gogess->executec($sql_delete, [$imgag_id]);
    error_log("🗑️ Registros anteriores eliminados para imgag_id: $imgag_id");

    // Insertar nuevos archivos
    $insert_count = 0;
    foreach ($uploaded_files as $file_name) {
        $path_completo = $upload_dir . $file_name;

        $sql_insert = "INSERT INTO dns_newimagenologiainfo_archivos 
                      (centro_id, clie_id, atenc_id, usua_id, 
                       imginfoarchi_fecharegistro, imginfoarchi_enlace, 
                       imgag_id, imginfo_id, imginfoarchi_pathcompleto, 
                       imginfoarchi_fechacarga,
                       place_id, amn_id, prob_codigo, cant_codigo) 
                      VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), 0, 0, '', '')";

        $params_insert = [
            $centro_id,
            $clie_id,
            $atenc_id,
            $usua_id,
            $imginfo_enlace,
            $imgag_id,
            $imginfo_id,
            $path_completo
        ];

        error_log("💾 Insertando: $file_name");
        $rs_insert = $DB_gogess->executec($sql_insert, $params_insert);

        if (!$rs_insert) {
            error_log("  ⚠️ Error insertando archivo en BD: $file_name");
        } else {
            error_log("  ✅ Archivo registrado en BD: $file_name");
            $insert_count++;
        }
    }

    error_log("📊 Total registros insertados en BD: $insert_count de $total_archivos");

    // Verificar si las columnas existen
    $sql_check_column = "SHOW COLUMNS FROM dns_newimagenologiainfo LIKE 'imginfo_cantarchivos'";
    $rs_check = $DB_gogess->executec($sql_check_column, []);

    if (!$rs_check || $rs_check->EOF) {
        error_log("➕ Creando columnas imginfo_cantarchivos e imginfo_rutadicom...");
        $sql_add_column = "ALTER TABLE dns_newimagenologiainfo 
                          ADD COLUMN imginfo_cantarchivos INT DEFAULT 0,
                          ADD COLUMN imginfo_rutadicom VARCHAR(250) DEFAULT ''";
        $DB_gogess->executec($sql_add_column, []);
        error_log("✅ Columnas creadas");
    }

    // Actualizar contador en dns_newimagenologiainfo
    $sql_update_info = "UPDATE dns_newimagenologiainfo 
                       SET imginfo_cantarchivos = ?,
                           imginfo_rutadicom = ?
                       WHERE imginfo_id = ?";
    $params_update = [$total_archivos, $upload_dir, $imginfo_id];
    $rs_update = $DB_gogess->executec($sql_update_info, $params_update);

    if (!$rs_update) {
        error_log("⚠️ Error actualizando dns_newimagenologiainfo");
    } else {
        error_log("✅ Registro actualizado en dns_newimagenologiainfo");
    }

    error_log("=================================");
    error_log("=== ✅ SUBIDA COMPLETADA EXITOSAMENTE ===");
    error_log("=================================");

    echo json_encode([
        'success' => true,
        'message' => 'Archivos DICOM subidos correctamente',
        'folder_path' => $upload_dir,
        'files_count' => $total_archivos,
        'imginfo_id' => $imginfo_id,
        'imgag_id' => $imgag_id,
        'clie_id' => $clie_id,
        'imginfo_enlace' => $imginfo_enlace
    ]);

} catch (Exception $e) {
    error_log("=================================");
    error_log("=== ❌ EXCEPCIÓN CAPTURADA ===");
    error_log("=================================");
    error_log("Mensaje: " . $e->getMessage());
    error_log("Archivo: " . $e->getFile());
    error_log("Línea: " . $e->getLine());
    error_log("=================================");
    error_log("POST recibido:");
    error_log(print_r($_POST, true));
    error_log("=================================");
    error_log("FILES recibido:");
    error_log(print_r($_FILES, true));
    error_log("=================================");

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'debug_info' => [
            'clie_id' => isset($_POST['clie_idx']) ? $_POST['clie_idx'] : 'NO RECIBIDO',
            'atenc_id' => isset($_POST['atenc_idx']) ? $_POST['atenc_idx'] : 'NO RECIBIDO',
            'imginfo_enlace' => isset($_POST['imginfo_enlacex']) ? $_POST['imginfo_enlacex'] : (isset($_POST['imginfo_enlace']) ? $_POST['imginfo_enlace'] : 'NO RECIBIDO'),
            'imgag_id' => isset($_POST['imgag_id']) ? $_POST['imgag_id'] : 'NO RECIBIDO',
            'imginfo_id' => isset($_POST['imginfo_id']) ? $_POST['imginfo_id'] : 'NO RECIBIDO',
            'files_count' => isset($_FILES['dicom_files']) ? count($_FILES['dicom_files']['name']) : 0
        ]
    ]);
}
?>