<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Detailed Report</h1>
    <h2>September 2016</h2>
    <table>
<?php 

    foreach($data['toggl_entries']['data'] as $entry) {
        print('<tr><td>' . $entry['user'] . '</td><td>' . $entry['dur'] . '</td><td>' . $entry['description'] . '</td></tr>');
    }

?>
    </table>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>