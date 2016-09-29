<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Multiple Accounts</h1>
    <h2>Listing all active accounts in online banking</h2>
    <ul>
<?php 
    
    foreach($data['accounts'] as $account) {
        print('<li><a href="' . URL . 'banking/statement/' . $data['bank_code'] . '/' . $data['username'] . '/' . $data['pin'] . '/' . $account->getAccountNumber() . '/' . '">' . $account->getAccountNumber() . '</a></li>');
    }
?>
    </ul>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>