<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Projects</h1>
    <h2>Listing all active projects in workspace<sup>*</sup></h2>
    <ul>
<?php 
    
    foreach($data['toggl_projects'] as $project) {
        print('<li><a href="' . URL . 'toggl/report/' . $data['toggl_api_key'] . '/' . $data['toggl_workspace_id'] . '/' . $project['id'] . '">' . $project['name'] . '</a></li>');
    }
?>
    </ul>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>