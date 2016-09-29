<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Workspaces</h1>
    <h2>Listing all active workspaces</h2>
    <ul>
<?php 
    
    foreach($data['workspaces'] as $workspace) {
        print('<li><a href="' . URL . 'toggl/projects/' . $data['toggl_api_key'] . '/' . $workspace['id'] . '">' . $workspace['name'] . '</a></li>');
    }
?>
    </ul>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>