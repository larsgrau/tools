<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Detailed Report</h1>
    <h2>September 2016</h2>
    <table>
<?php 

    foreach($data['toggl_entries']['data'] as $entry) {
        $duration = date("h:i:s", $entry['dur'] / 1000);
        print('<tr><td>' . $entry['user'] . '</td><td>' . $duration . '</td><td>' . $entry['description'] . '</td></tr>');
    }

?>
    </table>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>