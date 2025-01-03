<h2>Email Notification Preferences</h2>
<form method="post" action="">
    <div class="form-group">
        <label>
            <input type="checkbox" name="disable_invoice" value="1" {if $preferences.disable_invoice}checked{/if}>
            Disable Invoice Notifications
        </label>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="disable_domain" value="1" {if $preferences.disable_domain}checked{/if}>
            Disable Domain Notifications
        </label>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="disable_hosting" value="1" {if $preferences.disable_hosting}checked{/if}>
            Disable Hosting Notifications
        </label>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="disable_product" value="1" {if $preferences.disable_product}checked{/if}>
            Disable Product Notifications
        </label>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="disable_all" value="1" {if $preferences.disable_all}checked{/if}>
            Disable All Notifications
        </label>
    </div>
    <button type="submit" name="save_preferences" class="btn btn-primary">Save Preferences</button>
</form>
