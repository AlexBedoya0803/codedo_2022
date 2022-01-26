<?php

/**
 * The cURL utilities.
 *
 * @package     udearroba/util
 * @copyright   Copyright (c) 2017, Universidad de Antioquia - Facultad de Ingeniería - DRAI - Ude@
 * @author      Diego Rendón [diego3d3@gmail.com]
 */


/**
 * The cURL util class.
 */
class curl {

    // The list of available web services
    const WEB_SERVICES_LIST_URL = 'http://link.udea.edu.co/listadows';
    const CURL_TIMEOUT = 5;

    /**
     * Send a GET request using cURL.
     *
     * @param string $url to request.
     * @param array $token the provided token by the UdeA Portal.
     * @param string $connection_type the type of the connection.
     * @param array $options for cURL.
     * @return string the json response or FALSE if the request call fails.
     */
    function send_get_json_request($url, $token, $connection_type = "Producción", array $options = array()) {

	if(empty($url)){
            return FALSE;
        }

        $headers = array(
            "OAuth_Token: $token",
            "Tipo_Conexion: $connection_type",
            "Content-Type: application/json",
            "Accept: application/json"
        );

        // Create an array for the query URL and the default cURL options.
        $defaults = array(
            CURLOPT_URL => $url, // Set the URI for the REST resource.
            CURLOPT_HTTPGET => TRUE, // Set the HTTP request method to GET.
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => FALSE, // Don't Include the header in the output.
            CURLOPT_RETURNTRANSFER => TRUE, // Return the transfer as a string of the return value of curl_exec().
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSLVERSION => 3,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_TIMEOUT => self::CURL_TIMEOUT
//            CURLOPT_CERTINFO                      // TODO: check this later for SSL if needed.
        );

        try {
            $session = curl_init();                 // Start a new cURL session.
            curl_setopt_array($session, ($options + $defaults)); // Set the cURL options.
            $response = curl_exec($session);        // Make the request and get the response.
            curl_close($session);                   // Close the cURL session.
        } catch (Exception $e) {
            error_log("[UDEA_WS] An exception has occurred while trying to use cURL to make this request: {$request}. The exception message was: " . $e->getMessage(), 0);
            die('Your call to Ude@ Web Services failed due to a cURL exception.');
        }
        return $response;
    }

    /**
     * Gets the URL for the specific web service.
     *
     * @param string $ws_name The name of the web service requested.
     *
     * @return string the URL with query parameters for the specific web service
     * or FALSE if the request call fails.
     */
    function get_ws_url($ws_name, array $params = NULL) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_TIMEOUT => self::CURL_TIMEOUT,
            CURLOPT_URL => self::WEB_SERVICES_LIST_URL,
        ));
        $ws_list = curl_exec($ch);
        curl_close($ch);
        $ws_array = preg_split('/\s+/', $ws_list);
        foreach ($ws_array as $ws) {
            $tokens = explode("=", $ws);
            if ($tokens[0] == $ws_name) {
                $ws_url = $tokens[1];
            }
        }
        if (!isset($ws_url)) {
            return false;
        } else {
            $url = $ws_url . '?' . http_build_query($params, "", "&");
            return($url);
        }
    }

}
