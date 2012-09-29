<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/** Grupo de funciones necesarias para realizar el login de los usuarios */

/** Realiza una llamada curl */
function get_curl($address, $method, $fields, $options) {
    $c = curl_init();

    if(isset($options['ssl'])) {
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
    } else curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

    if( isset($options['no_return'])) {
        curl_setopt($c, CURLOPT_RETURNTRANSFER, false);
    } else {
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    }
    
    if($method == 'post') {
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
        $opt_string = '';
        foreach($fields as $key => $value) {
            $opt_string .= "&{$key}={$value}";
        }
        curl_setopt($c, CURLOPT_POSTFIELDS, $opt_string);
    } elseif($method == 'get') {
        if(is_array($fields)) {
            $address .= '?';
            $i = 0;
            $keys = array_keys($fields);
            $values = array_values($fields);
            for($i; $i < count($fields); $i++) {
                $address .= "{$keys[$i]}={$values[$i]}&";
            }
        }
    }
    curl_setopt($c, CURLOPT_URL, $address);    
    $result = curl_exec($c);
    $error = curl_error($c);
    curl_close($c);
    return array('result' => $result, 'error' => $error);
}
