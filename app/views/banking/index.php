<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Banking</h1>

    <p>Enter online banking credentials
        <form method="POST" action="<?php echo URL; ?>banking/accounts/" autocomplete="on">
            <fieldset>
                <label for="insitute">Institute</label><br />
                <select name="institute" />
                    <option value="10070024" />Deutsche Bank Berlin (10070024)</option>
                </select><br />
                <label for="username">Username (Alias)</label><br />
                <input type="text" name="username" value="" size="33" /><br />
                <label for="pin">PIN</label><br />
                <input type="password" name="pin" value="" size="33" /><br />
                <input type="submit" />
            </fieldset>
        </form>
    </p>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>


