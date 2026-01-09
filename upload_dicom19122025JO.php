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

try {
    // Crear carpeta base si no existe
    if (!file_exists($upload_base_dir) && !mkdir($upload_base_dir, 0755, true)) {
        throw new Exception('No se pudo crear el directorio base de uploads');
    }

    if (!isset($_FILES['dicom_files']) || empty($_FILES['dicom_files']['name'][0])) {
        throw new Exception('No se recibieron archivos DICOM');
    }

    // OBTENER DATOS DEL FORMULARIO
    $clie_id = isset($_POST['clie_idx']) ? intval($_POST['clie_idx']) : 0;
    $atenc_id = isset($_POST['atenc_idx']) ? intval($_POST['atenc_idx']) : 0;
    $centro_id = isset($_POST['centro_id']) ? intval($_POST['centro_id']) :
        (isset($_SESSION['ces1313777_centro_id']) ? intval($_SESSION['ces1313777_centro_id']) : 0);
    $usua_id = isset($_POST['usua_id']) ? intval($_POST['usua_id']) :
        (isset($_SESSION['ces1313777_sessid_inicio']) ? intval($_SESSION['ces1313777_sessid_inicio']) : 0);

    // Enlaces únicos
    $imginfo_enlace = isset($_POST['imginfo_enlacex']) ? trim($_POST['imginfo_enlacex']) :
        (isset($_POST['imginfo_enlace']) ? trim($_POST['imginfo_enlace']) : '');

    // IDs de las tablas relacionadas
    $imgag_id = isset($_POST['imgag_id']) ? intval($_POST['imgag_id']) : 0;
    $imginfo_id = isset($_POST['imginfo_id']) ? intval($_POST['imginfo_id']) : 0;

    // Log para debugging
    error_log("=== DICOM UPLOAD ===");
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

    // ✅ BUSCAR EN LA TABLA CORRECTA: dns_newimagenologiainfo
    if ($imginfo_id <= 0 && !empty($imginfo_enlace)) {
        // Buscar por enlace
        error_log("Buscando imginfo_id usando imginfo_enlace: $imginfo_enlace");

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

    // Crear carpeta con identificador único
    $folder_name = date('Y-m-d_His') . '_' . $clie_id . '_' . $imginfo_id . '_' . uniqid();
    $upload_dir = $upload_base_dir . $folder_name . '/';

    if (!mkdir($upload_dir, 0755, true)) {
        throw new Exception('No se pudo crear el directorio de destino: ' . $upload_dir);
    }

    error_log("Carpeta creada: $upload_dir");

    $uploaded_files = [];
    $files = $_FILES['dicom_files'];
    $file_count = count($files['name']);

    // Procesar archivos DICOM
    for ($i = 0; $i < $file_count; $i++) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $tmp_name = $files['tmp_name'][$i];
            $original_name = basename($files['name'][$i]);

            if (!preg_match('/\.dcm$/i', $original_name)) {
                error_log("⚠️ Archivo ignorado (no es .dcm): $original_name");
                continue;
            }

            if ($files['size'][$i] > $max_file_size) {
                throw new Exception("El archivo {$original_name} excede el tamaño máximo permitido");
            }

            $safe_name = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $original_name);
            $destination = $upload_dir . $safe_name;

            if (!move_uploaded_file($tmp_name, $destination)) {
                throw new Exception("No se pudo mover el archivo {$original_name}");
            }

            $uploaded_files[] = $safe_name;
            error_log("✅ Archivo subido: $safe_name");
        }
    }

    if (empty($uploaded_files)) {
        throw new Exception('No se pudo subir ningún archivo DICOM válido');
    }

    $total_archivos = count($uploaded_files);
    error_log("Total archivos procesados: $total_archivos");

    // ✅ GUARDAR EN LA TABLA DE ARCHIVOS: dns_newimagenologiainfo_archivos
    // Primero eliminar registros anteriores si es una actualización
    $sql_delete = "DELETE FROM dns_newimagenologiainfo_archivos WHERE imgag_id = ?";
    $DB_gogess->executec($sql_delete, [$imgag_id]);
    error_log("Registros anteriores eliminados para imgag_id: $imgag_id");

    // Insertar nuevos archivos
    // Insertar nuevos archivos
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
            $imginfo_id,        // ← AGREGADO
            $path_completo
        ];

        $rs_insert = $DB_gogess->executec($sql_insert, $params_insert);

        if (!$rs_insert) {
            error_log("⚠️ Error insertando archivo: $file_name");
        } else {
            error_log("✅ Archivo registrado en BD: $file_name");
        }
    }

    // ✅ ACTUALIZAR CONTADOR EN dns_newimagenologiainfo (no en dns_newimagenologia)
    // Agregar columna si no existe (para compatibilidad)
    $sql_check_column = "SHOW COLUMNS FROM dns_newimagenologiainfo LIKE 'imginfo_cantarchivos'";
    $rs_check = $DB_gogess->executec($sql_check_column, []);

    if (!$rs_check || $rs_check->EOF) {
        // La columna no existe, crearla
        error_log("Creando columna imginfo_cantarchivos...");
        $sql_add_column = "ALTER TABLE dns_newimagenologiainfo 
                          ADD COLUMN imginfo_cantarchivos INT DEFAULT 0,
                          ADD COLUMN imginfo_rutadicom VARCHAR(250) DEFAULT ''";
        $DB_gogess->executec($sql_add_column, []);
    }

    // Actualizar el registro con la ruta y cantidad
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

    error_log("=== SUBIDA COMPLETADA EXITOSAMENTE ===");

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
    error_log("❌ EXCEPCIÓN DICOM Upload: " . $e->getMessage());
    error_log("POST recibido: " . print_r($_POST, true));
    error_log("FILES recibido: " . print_r(array_keys($_FILES), true));

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'debug_info' => [
            'clie_id' => isset($_POST['clie_idx']) ? $_POST['clie_idx'] : 'NO RECIBIDO',
            'atenc_id' => isset($_POST['atenc_idx']) ? $_POST['atenc_idx'] : 'NO RECIBIDO',
            'imginfo_enlace' => isset($_POST['imginfo_enlacex']) ? $_POST['imginfo_enlacex'] : 'NO RECIBIDO',
            'imgag_id' => isset($_POST['imgag_id']) ? $_POST['imgag_id'] : 'NO RECIBIDO',
            'imginfo_id' => isset($_POST['imginfo_id']) ? $_POST['imginfo_id'] : 'NO RECIBIDO'
        ]
    ]);
}
?>