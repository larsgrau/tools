<?php require APP . '/templates/header.inc.php'; ?>

<div class="container">
    <h1>Account Statement</h1>
    <h2>Listing all transactions from <?php echo $data['from']->format('M-d'); ?> to <?php echo $data['to']->format('M-d'); ?></h2>
    <pre>

<?php 
            echo '=======================================' . PHP_EOL;
        foreach ($data['soa']->getStatements() as $statement) {

//            echo $statement->getDate()->format('Y-m-d') . ': Start Saldo: ' . ($statement->getCreditDebit() == Statement::CD_DEBIT ? '-' : '') . $statement->getStartBalance() . PHP_EOL;

            
            foreach ($statement->getTransactions() as $transaction) {
                echo 'Date        : ' . $statement->getDate()->format('Y-m-d') . PHP_EOL;;
                echo 'Amount      : ' . ($transaction->getCreditDebit() == 'debit' ? '-' : '') . $transaction->getAmount() . PHP_EOL;
//                echo 'Amount      : ' . ($transaction->getCreditDebit() == Transaction::CD_DEBIT ? '-' : '') . $transaction->getAmount() . PHP_EOL;
//                echo 'Booking text: ' . $transaction->getBookingText() . PHP_EOL;
                echo 'Name        : ' . $transaction->getName() . PHP_EOL;
                echo 'Description : ' . $transaction->getDescription1() . PHP_EOL;
                echo '=======================================' . PHP_EOL;
            }
        }
?>
        
    </pre>
</div>

<?php require APP . '/templates/footer.inc.php'; ?>