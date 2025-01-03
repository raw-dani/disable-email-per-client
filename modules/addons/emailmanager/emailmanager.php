<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function emailmanager_config() {
    return [
        'name' => 'Client Email Manager',
        'description' => 'Control email notifications per client',
        'version' => '1.0',
        'author' => 'Rohmat Ali Wardani',
        'language' => 'english',
        'fields' => [
            'enable_logging' => [
                'FriendlyName' => 'Enable Logging',
                'Type' => 'yesno',
                'Description' => 'Log all email preference changes',
            ],
        ]
    ];
}

function emailmanager_activate() {
    try {
        $query = "CREATE TABLE IF NOT EXISTS `mod_email_preferences` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL,
            `disable_invoice` tinyint(1) DEFAULT 0,
            `disable_domain` tinyint(1) DEFAULT 0,
            `disable_hosting` tinyint(1) DEFAULT 0,
            `disable_product` tinyint(1) DEFAULT 0,
            `disable_all` tinyint(1) DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE KEY `client_id` (`client_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        full_query($query);
        return ['status'=>'success', 'description'=>'Module activated successfully'];
    } catch (Exception $e) {
        return ["status"=>"error", "description"=>"Could not create table: " . $e->getMessage()];
    }
}

function emailmanager_deactivate() {
    try {
        $query = "DROP TABLE IF EXISTS `mod_email_preferences`";
        full_query($query);
        
        return [
            'status' => 'success',
            'description' => 'Module deactivated and database table removed successfully'
        ];
        
    } catch (Exception $e) {
        return [
            'status' => 'error',
            'description' => 'Module deactivated but failed to remove database table: ' . $e->getMessage()
        ];
    }
}

function emailmanager_upgrade($vars) {
    $currentVersion = $vars['version'];
    // Version upgrade handling
}

function emailmanager_output($vars) {
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    
    echo '<div class="alert alert-success">Module Status: Active</div>';
    
    // Display current settings
    $query = "SELECT COUNT(*) as total FROM mod_email_preferences";
    $result = full_query($query);
    $data = mysql_fetch_array($result);
    
    echo '<div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Statistics</h3>
            </div>
            <div class="panel-body">
                <p>Total Clients with Custom Settings: '.$data['total'].'</p>
                <p>Module Version: '.$version.'</p>
            </div>
          </div>';
}

if ($_GET['action'] == 'saveemailprefs') {
    $userid = (int)$_GET['userid'];
    
    $values = array(
        'client_id' => $userid,
        'disable_invoice' => isset($_POST['disable_invoice']) ? 1 : 0,
        'disable_domain' => isset($_POST['disable_domain']) ? 1 : 0,
        'disable_hosting' => isset($_POST['disable_hosting']) ? 1 : 0,
        'disable_product' => isset($_POST['disable_product']) ? 1 : 0,
        'disable_all' => isset($_POST['disable_all']) ? 1 : 0,
    );
    
    insert_query('mod_email_preferences', $values, true);
    
    header("Location: clientssummary.php?userid=" . $userid . "&success=true");
    exit;
}
