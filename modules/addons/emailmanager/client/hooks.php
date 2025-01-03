<?php
add_hook('ClientAreaPrimaryNavbar', 1, function($vars) {
    $primaryNavbar = Menu::primaryNavbar();
    
    $primaryNavbar->addChild(
        'Email Preferences',
        array(
            'uri' => 'index.php?m=emailmanager&action=preferences',
            'order' => 15,
        )
    )->setExtra('icon', 'fas fa-envelope');
    
    return null;
});

add_hook('ClientAreaPageAccountUsers', 1, function($vars) {
    $userid = $_SESSION['uid'];
    $prefs = getClientEmailPreferences($userid);
    
    return [
        'emailPreferences' => $prefs,
        'templatefile' => 'emailpreferences',
        'vars' => [
            'preferences' => $prefs
        ]
    ];
});
