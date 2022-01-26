<?php

require_once(dirname(__FILE__) . '/../util/curl.php');
require_once(dirname(__FILE__) . '/../util/encryption.php');

/**
 * Manager for the process of authentication with the UdeA Portal
 *
 * @author Diego Rendón
 */
class authentication_manager {

    const AUTHENTICATION_WS_NAME = 'validarusuariooidxcn';
    const AUTHENTICATION_WS_PARAM1 = 'usuario';
    const AUTHENTICATION_WS_PARAM2 = 'clave';
    const USERNAME_WS_NAME = "buscarnombreusuariomua";
    const USERNAME_WS_PARAM1 = "cedula";
    const USERNAME_WS_PARAM2 = "tipoDocumento";
    const MARES_USERINFORMATION_WS_NAME = "consultapersonamares";
    const MARES_USERINFORMATION_WS_PARAM1 = "cedula";
    const SIPE_USERINFORMATION_WS_NAME = "consultaempleadossipe";
    const SIPE_USERINFORMATION_WS_PARAM1 = "cedula";
    const WS_RESPONSE_EXPECTED_KEY = 'object';
    const ERROR_MESSAGE = "ERROR: acceso denegado.";

    /**
     * Constructor.
     */
    function __construct() {
        date_default_timezone_set('America/Bogota');
        $ini_file_path = dirname(__FILE__) . '/../config.ini.php';
        $ini_array = parse_ini_file($ini_file_path);
        if (array_key_exists('token', $ini_array)) {
            //The token for access to the UdeA's RESTful web services producer application.
            $token = $ini_array['token'];
            if (!defined("TOKEN")) {
                define("TOKEN", $token);
            }
        }
        if (array_key_exists('public_key', $ini_array)) {
            //The public key used to encrypt/decrypt the data.
            $public_key = $ini_array['public_key'];
            if (!defined("PUBLIC_KEY")) {
                define("PUBLIC_KEY", $public_key);
            }
        }
        if (array_key_exists('secret_key', $ini_array)) {
            //The 128-bits secret key used to encrypt/decrypt the data.
            $secret_key = $ini_array['secret_key'];
            if (!defined("SECRET_KEY")) {
                define("SECRET_KEY", $secret_key);
            }
        }
        if (array_key_exists('initialization_vector', $ini_array)) {
            //The 16 bytes initialization vector used to encrypt/decrypt the data.
            $initialization_vector = $ini_array['initialization_vector'];
            if (!defined("INITIALIZATION_VECTOR")) {
                define("INITIALIZATION_VECTOR", $initialization_vector);
            }
        }
        if (array_key_exists('module', $ini_array)) {
            //The module used to encrypt/decrypt the data.
            $module = $ini_array['module'];
            if (!defined("MODULE")) {
                define("MODULE", $module);
            }
        }
        if (array_key_exists('connection_type', $ini_array)) {
            //The connection_type used to configuration for run enviroment.
            $connection_type = $ini_array['connection_type'];
            if (!defined("CONNECTION_TYPE")) {
                define("CONNECTION_TYPE", $connection_type);
            }
        }
        if (array_key_exists('log_path', $ini_array)) {
            //The log path
            $log_path = $ini_array['log_path'];
            if (!defined("LOG_PATH")) {
                define("LOG_PATH", $log_path);
            }
        }
    }
    
    /**
     * Retrieve the identification associated with the user credentials from the UdeA Portal's databases.
     *
     * @param string $username The username (without system magic quotes).
     * @param string $password The password (without system magic quotes).
     *
     * @return String the external identification associated with the user credentials or NULL.
     */
    public function get_identification_for_authentication($username, $password) {
        $encryption = new encryption();
        $encrypted_username = $encryption->encrypt($username, PUBLIC_KEY, MODULE);
        $encrypted_password = $encryption->encrypt($password, PUBLIC_KEY, MODULE);
        $params = array(self::AUTHENTICATION_WS_PARAM1 => $encrypted_username, self::AUTHENTICATION_WS_PARAM2 => $encrypted_password);
        $curl = new curl();
        $url = $curl->get_ws_url(self::AUTHENTICATION_WS_NAME, $params);
        $json_response = $curl->send_get_json_request($url, TOKEN);
        $response_data = json_decode($json_response, TRUE);
        $expected_key = self::WS_RESPONSE_EXPECTED_KEY;
        $identification = "";
        if (!empty($response_data) && array_key_exists($expected_key, (array) $response_data) && !empty($response_data[$expected_key])) {
            $decrypted_response = trim($encryption->decrypt($response_data[$expected_key], PUBLIC_KEY, MODULE));
            if ($this->validate_identification($decrypted_response)) {
                $identification = $decrypted_response;
            } else {
                $this->logger(self::AUTHENTICATION_WS_NAME, " | ".$username." | ".$decrypted_response);
                $identification = self::ERROR_MESSAGE;
            }
        } else {
            $this->logger(self::AUTHENTICATION_WS_NAME, " | ".$username." | ".$response_data);
            $identification = self::ERROR_MESSAGE;
        }
        return $identification;
    }


    /**
     * Retrieve the username associated with the identification from the UdeA Portal's databases.
     *
     * @param string $identification The user identification.
     *
     * @return String the external username associated with the identification or NULL.
     */
    public function get_username($identification) {
        // USERNAME_WS_PARAM2 is set to "-" in order to ignore it.
        $params = array(self::USERNAME_WS_PARAM1 => $identification, self::USERNAME_WS_PARAM2 => "-");
        $curl = new curl();
        $url = $curl->get_ws_url(self::USERNAME_WS_NAME, $params);
        $json_response = $curl->send_get_json_request($url, TOKEN);
        $response_data = json_decode($json_response, TRUE);
        $expected_key = self::WS_RESPONSE_EXPECTED_KEY;
        $username = "";
        if (!empty($response_data) && array_key_exists($expected_key, (array) $response_data) && !empty($response_data[$expected_key])) {
            $response = $response_data[$expected_key];
            if ($this->validate_username($response)) {
                $username = $response;
            }
        }
        return $username;
    }

    /**
     * Retrieve the user information from the UdeA Portal's databases.
     *
     * @param string $username The username (without system magic quotes).
     * @param string $password The user password (without system magic quotes).
     *
     * @return array An associative array with the user information retrieved from UdeA Portal´s database or NULL in other case.
     */
    public function get_user_information($username, $password) {
        $identification = $this->get_identification($username, $password);
        if (empty($identification)) {
            return null;
        }
        // First: try to get info from MARES.
        $params = array(self::MARES_USERINFORMATION_WS_PARAM1 => $identification);
        $curl = new curl();
        $url = $curl->get_ws_url(self::MARES_USERINFORMATION_WS_NAME, $params);
        $json_response = $curl->send_get_json_request($url, TOKEN);
        $response_data = json_decode($json_response, TRUE);
        $expected_key = self::WS_RESPONSE_EXPECTED_KEY;
        $information = NULL;
        $user_information = NULL;
        if (!empty($response_data) && array_key_exists($expected_key, (array) $response_data) && !empty($response_data[$expected_key])) {
            $information = (object) $response_data[$expected_key][0];
        } else {
            // Second: try to get info from SIPE
            $params = array(self::SIPE_USERINFORMATION_WS_PARAM1 => $identification);
            $url = $curl->get_ws_url(self::SIPE_USERINFORMATION_WS_NAME, $params);
            $json_response = $curl->send_get_json_request($url, TOKEN);
            $response_data = json_decode($json_response, TRUE);
            $expected_key = self::WS_RESPONSE_EXPECTED_KEY;
            if (!empty($response_data) && array_key_exists($expected_key, (array) $response_data) && !empty($response_data[$expected_key])) {
                $information = (object) $response_data[$expected_key][0];
            }
        }
        if (!empty($information)) {
            $user_information['idnumber'] = $identification;
            $user_information['username'] = $username;
            $user_information['firstname'] = $information->nombre;
            $user_information['lastname'] = $information->apellidos;
            if (!empty($information->emailInstitucional)) {
                $user_information['email'] = $information->emailInstitucional;
            } else {
                $user_information['email'] = $information->email;
            }
            $user_information['phone1'] = $information->celular;
            $user_information['phone2'] = $information->telefono;
            $user_information['city'] = $information->nombreMunicipioResidencia;
            $user_information['country'] = $information->nombrePaisNacimiento;
        }
        return $user_information;
    }

    /**
     * Validates that the identification is correct.
     *
     * @param string $identification The identification number to be validated.
     *
     * @return bool TRUE if the identification is valid or FALSE in other case.
     */
    function validate_identification($identification) {
        if ((strpos($identification, "ERROR") !== FALSE)) {
            return FALSE;
        } else {
            return is_numeric($identification);
        }
    }

    /**
     * Validates that the username is correct.
     *
     * @param string $username The username to be validated.
     *
     * @return bool TRUE if the username is valid or FALSE in other case.
     */
    function validate_username($username) {
        $username = trim($username);
        return (!(empty($username)) && !(strpos($username, "ERROR") !== FALSE));
    }
    
    /**
     * Writes a message to the log file.
     *
     * @param string $service The name of the web service.
     * @param string $message The message to be registered in the log.
     *
     */
    function logger($service, $message) {
        $date = date('d/m/Y h:i:s');
        $log = "[Error WS] | Date:  ".$date." (GMT-5) | Service: ".$service." | ".$message."\n";
        error_log($log, 3, LOG_PATH);
    }

}
