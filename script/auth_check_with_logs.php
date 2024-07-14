<?php
// Definir el archivo de log
$logFile = 'request_headers.log';

// Definir la clave del encabezado de autorización
$authHeaderKey = 'authorization';

// Obtener todos los encabezados de la solicitud
$headers = getallheaders();

// Función para escribir en el archivo de log
function writeLog($logFile, $message) {
    $date = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$date] $message\n", FILE_APPEND);
}

// Agregar un separador para cada nueva solicitud
writeLog($logFile, "=====================================");
writeLog($logFile, "Nueva solicitud recibida");

// Loggear todos los encabezados
foreach ($headers as $key => $value) {
    writeLog($logFile, "$key: $value");
}

// Verificar si el encabezado de autorización está presente
if (!array_key_exists($authHeaderKey, $headers)) {
    // Si no está presente, enviar una respuesta 401 (Unauthorized)
    writeLog($logFile, "Resultado: No se encontró el encabezado de autorización");
    http_response_code(401);
    echo json_encode(array("message" => "No se encontró el encabezado de autorización"));
    exit();
} else {
    // Obtener el valor del encabezado de autorización
    $authHeader = $headers[$authHeaderKey];
    
    // Loggear el encabezado de autorización
    writeLog($logFile, "$authHeaderKey Header: $authHeader");

    // Realizar la validación del token (aquí se utiliza un valor fijo para el ejemplo)
    if ($authHeader === 'Bearer 12345.qwerty.12345') {
        // Si el token es válido, enviar una respuesta 200 (OK)
        writeLog($logFile, "Resultado: Autorización válida");
        http_response_code(200);
        echo json_encode(array("message" => "Autorización válida"));
    } else {
        // Si el token es inválido, enviar una respuesta 401 (Unauthorized)
        writeLog($logFile, "Resultado: Autorización inválida");
        http_response_code(401);
        echo json_encode(array("message" => "Autorización inválida"));
    }
}
?>
