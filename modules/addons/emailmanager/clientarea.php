<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
  function emailmanager_clientarea($vars) {
      return [
          'pagetitle' => 'Email Preferences',
          'breadcrumb' => [
              'index.php?m=emailmanager' => 'Email Settings'
          ],
          'templatefile' => 'templates/clientarea',
          'requirelogin' => true,
          'vars' => [
              'preferences' => getClientEmailPreferences($vars['clientsdetails']['userid'])
          ],
      ];
  }