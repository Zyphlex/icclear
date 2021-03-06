<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// +----------------------------------------------------------
// | xxx - notation_helper
// +----------------------------------------------------------
// | KHK - 2 TI - 201x-201x
// +----------------------------------------------------------
// | Notation Helper
// |
// +----------------------------------------------------------
// | K. Vangeel
// +----------------------------------------------------------

// databasedatum in juiste formaat zetten (van yyyy-mm-dd naar dd/mm/jjjj)

function toDDMMYYYY($input) {
    if ($input == "") {
        return "";
    } else {
        $datum = explode("-", $input);
        return $datum[2] . "/" . $datum[1] . "/" . $datum[0];
    }
}

// ingegeven datum in formaat van database plaatsen (van dd/mm/jjjj naar yyyy-mm-dd)

function toYYYYMMDD($input) {
    if ($input == "") {
        return "";
    } else {
        $datum = explode("/", $input);
        return $datum[2] . "-" . $datum[1] . "-" . $datum[0];
    }
}

// database decimaal getal tonen met komma (van 999.99 naar 999,99)

function toKomma($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode(".", $input);
        if (count($getal) == 2) {
            return $getal[0] . ',' . $getal[1];
        } else {
            return $getal[0];
        }
    }
}

// ingegeven decimaal getal omzetten in databaseformaat (van 999,99 naar 999.99)

function toPunt($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode(",", $input);
        if (count($getal) == 2) {
            return $getal[0] . '.' . $getal[1];
        } else {
            return $getal[0];
        }
    }
}
function escape_html($data)
{
    if (is_array($data)) {
        return array_map(array($this,'escape_html'), $data);
    }
    if (is_object($data)) {
        $tmp = clone $data; // avoid modifing original object
        foreach ( $data as $k => $var )
            $tmp->{$k} = escape_html($var);
        return $tmp;
    }
    return trim(htmlentities($data));
}

/* End of file notation_helper.php */
/* Location: helpers/notation_helper.php */