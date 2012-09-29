<?php

/**
 * Archivo: menu_helper.php
 * Descripción del archivo :
 *
 * Autor:
 * Fecha: 06/08/2012
 */

/** Determina el valor de la página actual, en el biz para saber en cual opcion se está parado */
function mbiz_option($td='index', &$html, &$current) {

    $td = $td ? $td : 'index.php';
    $a = array(
        "/biz/coupon_mobile.php" => array('Buscar Cupón', '3',
            array('pos' => 'top', 'icon' => 'search')),
        "/biz/coupon_with_serial.php" => array('Marcar Cupón', '4',
            array('pos' => 'top', 'icon' => 'check')),
        "/biz/settings.php" => array('Configurar Cuenta', '5',
            array('pos' => 'top', 'icon' => 'gear')),
    );
    $current = $l = "/biz/{$td}.php";
    $html = current_link_mobile($l, $a);
    return $html;
}

/** Tomando en cuenta el formato solicitado por jquery mobile formatea los botones */
function current_link_mobile($link, $links) {
    $html = '<ul>';
    foreach ($links AS $l => $n) {
        //Se verifica si el link es el actual
        if (trim($l, '/') == trim($link, '/')) {
            $html .= "<li><a href='{$l}' data-inline='true' data-role='button' accesskey='{$n[MOVIL_ACCESSKEY]}' class='ui-state-persist'";
            if ($n[MOVIL_ICON]) {
                $html .=  " data-icon-pos='{$n[MOVIL_ICON]['pos']}' data-icon='{$n[MOVIL_ICON]['icon']}' ";
            }
            $html .=  ">{$n[MOVIL_URL]}</a></li>";
        } else {
            $html .= "<li><a href='{$l}' data-inline='true'  data-role='button' accesskey='{$n[MOVIL_ACCESSKEY]}'";
            if ($n[MOVIL_ICON]) {
                $html .=  " data-icon-pos='{$n[MOVIL_ICON]['pos']}' data-icon='{$n[MOVIL_ICON]['icon']}' ";
            }
            $html .= ">{$n[MOVIL_URL]}</a></li>";
        }
    }
    $html .=  '</ul>';
    return $html;
}

/* Fin de archivo menu_helper.php */
/* Ubicación: C:\wamp\www\td\_recycledapp\helpers\menu_helper.php
 */