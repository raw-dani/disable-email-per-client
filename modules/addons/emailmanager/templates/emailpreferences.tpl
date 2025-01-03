<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Email Notification Settings</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="index.php?m=emailmanager&action=save">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="prefs[disable_invoice]" value="1" {if $preferences.disable_invoice}checked{/if}>
                            Disable Invoice Notifications
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="prefs[disable_domain]" value="1" {if $preferences.disable_domain}checked{/if}>
                            Disable Domain Notifications
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="prefs[disable_hosting]" value="1" {if $preferences.disable_hosting}checked{/if}>
                            Disable Hosting Notifications
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="prefs[disable_product]" value="1" {if $preferences.disable_product}checked{/if}>
                            Disable Product Notifications
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="prefs[disable_all]" value="1" {if $preferences.disable_all}checked{/if}>
                            Disable All Notifications
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
