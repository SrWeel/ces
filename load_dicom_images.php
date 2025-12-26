<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_load_dicom.txt');

// Incluir archivos de configuración
include('cfg/clases.php');
include('cfg/declaracion.php');

try {
    $imgag_id = isset($_POST['imgag_id']) ? intval($_POST['imgag_id']) : 0;
    $imginfo_id = isset($_POST['imginfo_id']) ? intval($_POST['imginfo_id']) : 0;
    $imginfo_enlace = isset($_POST['imginfo_enlace']) ? trim($_POST['imginfo_enlace']) : '';
    $folder_path = isset($_POST['folder_path']) ? trim($_POST['folder_path']) : '';

    error_log("=== LOAD DICOM IMAGES ===");
    error_log("imgag_id: " . $imgag_id);
    error_log("imginfo_id: " . $imginfo_id);
    error_log("imginfo_enlace: " . $imginfo_enlace);
    error_log("folder_path: " . $folder_path);

    // ✅ PASO 1: Buscar datos en dns_newimagenologiainfo
    if ($imginfo_id <= 0 && $imgag_id > 0) {
        error_log("Buscando por imgag_id: $imgag_id");

        $sql = "SELECT imginfo_id, imginfo_enlace, imginfo_rutadicom, imginfo_cantarchivos 
                FROM dns_newimagenologiainfo 
                WHERE imgag_id = ? 
                ORDER BY imginfo_id DESC 
                LIMIT 1";
        $rs = $DB_gogess->executec($sql, [$imgag_id]);

        if ($rs && !$rs->EOF) {
            $imginfo_id = intval($rs->fields['imginfo_id']);
            $imginfo_enlace = trim($rs->fields['imginfo_enlace'] ?? '');
            $folder_path = trim($rs->fields['imginfo_rutadicom'] ?? '');
            error_log("✅ Encontrado imginfo_id: $imginfo_id");
        }
    }

    if ($imginfo_id <= 0 && !empty($imginfo_enlace)) {
        error_log("Buscando por imginfo_enlace: $imginfo_enlace");

        $sql = "SELECT imginfo_id, imgag_id, imginfo_rutadicom, imginfo_cantarchivos 
                FROM dns_newimagenologiainfo 
                WHERE imginfo_enlace = ?";
        $rs = $DB_gogess->executec($sql, [$imginfo_enlace]);

        if ($rs && !$rs->EOF) {
            $imginfo_id = intval($rs->fields['imginfo_id']);
            $imgag_id = intval($rs->fields['imgag_id']);
            $folder_path = trim($rs->fields['imginfo_rutadicom'] ?? '');
            error_log("✅ Encontrado imginfo_id: $imginfo_id");
        }
    }

    // ✅ PASO 2: Buscar en tabla de archivos
    if (empty($folder_path) && $imgag_id > 0) {
        error_log("Buscando en tabla de archivos...");

        $sql = "SELECT imginfoarchi_pathcompleto 
                FROM dns_newimagenologiainfo_archivos 
                WHERE imgag_id = ? 
                LIMIT 1";
        $rs = $DB_gogess->executec($sql, [$imgag_id]);

        if ($rs && !$rs->EOF) {
            $path_completo = trim($rs->fields['imginfoarchi_pathcompleto']);
            $folder_path = dirname($path_completo) . '/';
            error_log("✅ Carpeta extraída: $folder_path");
        }
    }

    if (empty($folder_path)) {
        error_log("ℹ️ No hay archivos DICOM guardados");
        echo json_encode([
            'success' => false,
            'message' => 'No hay archivos DICOM guardados para este estudio',
            'files' => [],
            'count' => 0
        ]);
        exit;
    }

    // ✅ PASO 3: Normalizar y verificar carpeta
    $folder_path = rtrim($folder_path, '/') . '/';
    $folder_path = str_replace('\\', '/', $folder_path);

    // Si no es ruta absoluta, intentar ubicarla
    if (!file_exists($folder_path)) {
        $possible_paths = [
            __DIR__ . '/' . $folder_path,
            $_SERVER['DOCUMENT_ROOT'] . '/' . $folder_path,
            dirname(__FILE__) . '/' . $folder_path
        ];

        foreach ($possible_paths as $path) {
            $path = str_replace('\\', '/', $path);
            if (is_dir($path)) {
                $folder_path = $path;
                break;
            }
        }
    }

    if (!file_exists($folder_path)) {
        throw new Exception('La carpeta DICOM no existe: ' . $folder_path);
    }

    // ✅ PASO 4: Obtener archivos .dcm
    $files = glob($folder_path . '*.dcm');

    if ($files === false || empty($files)) {
        throw new Exception('No se encontraron archivos DICOM en: ' . $folder_path);
    }

    // ✅ PASO 5: Generar URLs web
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '/' : $script_dir . '/';

    $web_files = [];
    foreach ($files as $file) {
        $file = str_replace('\\', '/', $file);

        // Buscar 'uploads/dicom' en la ruta
        if (strpos($file, 'uploads/dicom') !== false) {
            $relative_path = substr($file, strpos($file, 'uploads/dicom'));
        } else {
            $doc_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
            $relative_path = str_replace($doc_root . '/', '', $file);
        }

        $web_url = $protocol . '://' . $host . $base_path . $relative_path;
        $web_files[] = $web_url;
    }

    error_log("✅ Total archivos: " . count($web_files));

    echo json_encode([
        'success' => true,
        'files' => $web_files,
        'count' => count($web_files),
        'folder_path' => $folder_path,
        'imginfo_id' => $imginfo_id,
        'imgag_id' => $imgag_id
    ]);

} catch (Exception $e) {
    error_log("❌ ERROR: " . $e->getMessage());

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'files' => [],
        'count' => 0
    ]);
}
?>