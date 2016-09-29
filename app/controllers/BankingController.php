<?php

use Fhp\FinTs;
use Fhp\Model\StatementOfAccount\Statement;
use Fhp\Model\StatementOfAccount\Transaction;

// # HBCI / FinTS Url can be found here: https://www.hbci-zka.de/institute/

class BankingController extends Controller
{
    protected $host_address;
    protected $port;
    protected $bank_code;       # bank code / Bankleitzahl
    protected $username;        # online banking username / alias
    protected $pin;             # online banking PIN
    
    protected $fints;
 
    // Show form to input banking credentials
	public function index()
	{
        // Load view
		$this->view('banking/index', []);
	}

    // List all accounts in online banking
	public function accounts()
	{

		if (isset($_POST['institute']) AND !empty($_POST['institute'])) {
            switch ($_POST['institute']) { 		  
                case "10070024" :
                    $this->host_address = 'https://fints.deutsche-bank.de/';
                    $this->port         = 443;
                    $this->bank_code    = '10070024';
                    break;
            }
                
        }

		if (isset($_POST['username']) AND !empty($_POST['username'])) {
            $this->username = $_POST['username'];
        }

		if (isset($_POST['pin']) AND !empty($_POST['pin'])) {
            $this->pin = $_POST['pin'];
        }

        $this->fints = new FinTs(
            $this->host_address,
            $this->port,
            $this->bank_code,
            $this->username,
            $this->pin
        );
        
        // Get available accounts in online banking
        $accounts = $this->fints->getSEPAAccounts();

        // Load view
		$this->view('banking/accounts', ['bank_code' => $this->bank_code, 'username' => $this->username, 'pin' => $this->pin, 'accounts' => $accounts]);

	}

    /**
     * Displays the statement of account for a specific time range and account. 
     */

    public function statement($bank_code, $username, $pin, $requestedAccountNumber)
    {
        
        if (isset($bank_code) AND !empty($bank_code)) {
            switch ($bank_code) { 		  
                case "10070024" :
                    $this->host_address = 'https://fints.deutsche-bank.de/';
                    $this->port         = 443;
                    $this->bank_code    = '10070024';
                    break;
            }                
        }

		if (isset($username) AND !empty($username)) {
            $this->username = $username;
        }

		if (isset($pin) AND !empty($pin)) {
            $this->pin = $pin;
        }

        $this->fints = new FinTs(
            $this->host_address,
            $this->port,
            $this->bank_code,
            $this->username,
            $this->pin
        );
        
        // Get available accounts in online banking
        $availableAccounts = $this->fints->getSEPAAccounts();
        
        // Select the requested account
        $useThisAccount = null;
        foreach($availableAccounts as $availableAccount) {
            if ($availableAccount->getAccountNumber() == $requestedAccountNumber) {
                $useThisAccount = $availableAccount;
                break;
            }
        }
        
        // Set timeframe

        $from   = new DateTime("first day of last month");
        $to     = new DateTime("last day of last month");
        
        // Get statement of account
        $statementOfAccount = $this->fints->getStatementOfAccount($useThisAccount, $from, $to);

        // Load view
		$this->view('banking/statement', ['account' => $requestedAccountNumber, 'soa' => $statementOfAccount, 'from' => $from, 'to' => $to]);

    }
}
