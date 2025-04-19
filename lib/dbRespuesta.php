<?php
class Respuesta {
    private $respuesta;
    private $pregunta;
    private $encuesta;
    private $encuestado;

    // Métodos getters y setters
    public function get_respuesta() {
        return $this->respuesta;
    }

    public function set_respuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function get_pregunta() {
        return $this->pregunta;
    }

    public function set_pregunta($pregunta) {
        $this->pregunta = $pregunta;
    }

    public function get_encuesta() {
        return $this->encuesta;
    }

    public function set_encuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    public function get_encuestado() {
        return $this->encuestado;
    }

    public function set_encuestado($encuestado) {
        $this->encuestado = $encuestado;
    }

    // Método para enviar datos a la API
    public function respuesta_desde_api() {
        // Prepara los datos del objeto actual para enviarlos a la API
        $data = array(
            'respuesta' => $this->respuesta,
            'pregunta' => $this->pregunta,
            'encuesta' => $this->encuesta,
            'encuestado' => $this->encuestado
        );

        // Convierte los datos a formato JSON
        $jsonData = json_encode($data);

        // URL del endpoint de la API
        $url = 'http://localhost:3000/respuestas'; // Cambia si usas un prefijo como /api

        // Inicializa cURL
        $ch = curl_init($url);

        // Configura cURL para enviar una solicitud POST con JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Recibir la respuesta como string
        curl_setopt($ch, CURLOPT_POST, true); // Indica que es una solicitud POST
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json' // Especifica que el contenido es JSON
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Datos JSON a enviar

        // Ejecuta la solicitud
        $response = curl_exec($ch);

        // Maneja errores de cURL
        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            return false; // Devuelve false si hay un error
        }

        // Cierra cURL
        curl_close($ch);

        // Decodifica la respuesta de la API
        $result = json_decode($response, true);

        // Verifica si la API devolvió un estado exitoso
        if (isset($result['status']) && $result['status'] === 'success') {
            return true; // Devuelve true si la respuesta fue exitosa
        } else {
            return false; // Devuelve false si hubo un error en la API
        }
    }
}
?>
