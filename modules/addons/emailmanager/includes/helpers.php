<?php

if (!defined("WHMCS")) {
    die("Direct access not permitted");
}

function getClientEmailPreferences($userid) {
    $result = select_query('mod_email_preferences', '*', array('client_id' => $userid));
    $data = mysql_fetch_array($result);
    return $data ?: array(
        'disable_invoice' => 0,
        'disable_domain' => 0,
        'disable_hosting' => 0,
        'disable_product' => 0,
        'disable_all' => 0
    );
}
