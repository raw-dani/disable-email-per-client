<?php
function getClientEmailPreferences($userid) {
    $result = select_query('mod_email_preferences', '*', array('client_id' => $userid));
    return mysql_fetch_array($result);
}
