<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Time Tracking</h1>

    <p>Insert Toggl API Key:
        <form method="GET" action="<?php echo URL; ?>toggl/projects/">
            <input type="text" name="toggl_api_key" value="" size="33" maxlength="40" />
            <input type="submit" />
        </form>
        <br />or <a href="./upload">upload CSV export</a>
    </p>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>


