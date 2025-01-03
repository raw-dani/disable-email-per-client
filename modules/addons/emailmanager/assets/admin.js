jQuery(document).ready(function() {
    if (location.search.indexOf('success=true') > -1) {
        WHMCS.ui.notification.showSuccess('Email preferences saved successfully');
    }
});
