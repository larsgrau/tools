<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Time Tracking</h1>

    <p>Enter your Toggl API Key:
        <form method="GET" action="<?php echo URL; ?>toggl/workspaces/">
            <fieldset>
                <label for="toggl_api_key">API key</label><br />
                <input type="text" name="toggl_api_key" value="" size="33" maxlength="40" /><br />
                <br />
                <input type="submit" />
            </fieldset>
        </form>
        <br />or <a href="./upload">upload CSV export</a>
    </p>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>