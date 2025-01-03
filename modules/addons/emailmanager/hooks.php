<?php
if (!defined("WHMCS")) {
    die("Direct access not permitted");
}

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\EmailManager\Helper;

// Add this at the top of your hooks file
require_once __DIR__ . '/includes/helpers.php';

add_hook('ClientAreaPageClientSummary', 1, function($vars) {
    $userid = $vars['userid'];
    return array(
        'emailPreferences' => getClientEmailPreferences($userid)
    );
});

add_hook('AdminClientProfileTabFields', 1, function($vars) {
    $userid = $_GET['userid'];
    $prefs = getClientEmailPreferences($userid);
    
    return [
        'Email Notifications' => '
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="emailprefs[disable_invoice]" value="1" '.($prefs['disable_invoice'] ? 'checked' : '').'>
                        Disable Invoice Emails
                    </label>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="emailprefs[disable_domain]" value="1" '.($prefs['disable_domain'] ? 'checked' : '').'>
                        Disable Domain Emails
                    </label>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="emailprefs[disable_hosting]" value="1" '.($prefs['disable_hosting'] ? 'checked' : '').'>
                        Disable Hosting Emails
                    </label>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="emailprefs[disable_product]" value="1" '.($prefs['disable_product'] ? 'checked' : '').'>
                        Disable Product Emails
                    </label>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="emailprefs[disable_all]" value="1" '.($prefs['disable_all'] ? 'checked' : '').'>
                        Disable All Emails
                    </label>
                </div>
            </div>
        </div>'
    ];
});

add_hook('AdminClientProfileTabFieldsSave', 1, function($vars) {
    $userid = $_GET['userid'];
    $emailprefs = $_POST['emailprefs'];
    
    $values = [
        'client_id' => $userid,
        'disable_invoice' => isset($emailprefs['disable_invoice']) ? 1 : 0,
        'disable_domain' => isset($emailprefs['disable_domain']) ? 1 : 0,
        'disable_hosting' => isset($emailprefs['disable_hosting']) ? 1 : 0,
        'disable_product' => isset($emailprefs['disable_product']) ? 1 : 0,
        'disable_all' => isset($emailprefs['disable_all']) ? 1 : 0,
    ];
    
    insert_query('mod_email_preferences', $values, true);
});


add_hook('EmailPreSend', 1, function($vars) {
    $userid = $vars['userid'];

    // Get client preferences using standard WHMCS database methods
    $result = select_query('mod_email_preferences', '*', array('client_id' => $userid));
    $data = mysql_fetch_array($result);

    if ($data['disable_all']) {
        return false;
    }

    $email_template = $vars['messagename'];

    if ($data['disable_invoice'] && strpos($email_template, 'invoice') !== false) {
        return false;
    }

    if ($data['disable_domain'] && strpos($email_template, 'domain') !== false) {
        return false;
    }

    if ($data['disable_hosting'] && strpos($email_template, 'hosting') !== false) {
        return false;
    }

    if ($data['disable_product'] && strpos($email_template, 'product') !== false) {
        return false;
    }

    return true;
});
