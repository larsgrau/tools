<?php

class TogglController extends Controller
{
	public function index()
	{
		$this->view('toggl/index');
	}

	public function workspaces($api_key = '')
	{

		// Load model
		$toggl = $this->model('Toggl');
		
		// Grab API key and update model		
		if (isset($_GET['toggl_api_key']) AND !empty($_GET['toggl_api_key'])) {
  
            // Set API key
    		$toggl->setApiKey($_GET['toggl_api_key']);

            // Initiate the Toggl API client
            $toggl->initiateCLient();			

            // Get all workspaces
            $workspaces = $toggl->getWorkspaces();

            $this->view('toggl/workspaces', ['toggl_api_key' => $toggl->getApiKey(), 'workspaces' => $workspaces]);
        } else {
	    	die ("No API key given");
		}
	}

    public function projects($api_key = '', $workspace_id = '')
	{

		// Load model
		$toggl = $this->model('Toggl');
		
		// Grab API key and update model		
		if (isset($api_key) AND !empty($api_key)) {
            // Set API key
    		$toggl->setApiKey($api_key);

            // Initiate the Toggl API client
            $toggl->initiateCLient();			

            if (isset($workspace_id) AND !empty($workspace_id)) {
            
                // Get all clients             
                //$clients = $toggl->getClients();
                $clients = [];

                // Get all projects in this workspace
                $projects = $toggl->getProjects((int) $workspace_id);

                // Load view
                $this->view('toggl/projects', ['toggl_api_key' => $toggl->getApiKey(), 'toggl_workspace_id' => $workspace_id, 'toggl_clients' => $clients, 'toggl_projects' => $projects]);
            } else {
                die ("No workspace id given");
            }
		} else {
	    	die ("No API key given");
		}
	}

    public function report($toggl_api_key = NULL, $toggl_workspace_id = NULL, $toggl_project_id = NULL)
	{
		// Load model
		$toggl = $this->model('Toggl');

        // Set API key
        $toggl->setApiKey($toggl_api_key);

        // Initiate the Toggl API client
        $toggl->initiateReportClient();	
        $detailed_report_params = array(
            'user_agent' => 'toggl@larsgrau.de',
            'workspace_id' => (int)$toggl_workspace_id,
            'project_ids' => (int)$toggl_project_id,
            'since' => '2016-09-01',
            'until' => '2016-09-30'
        );
        $detailed_report = $toggl->getDetailedReport($detailed_report_params);

        /*
        array(6) {
            ["total_grand"]=> int(475778000) 
            ["total_billable"]=> NULL 
            ["total_currencies"]=> array(1) { 
                [0]=> array(2) { 
                    ["currency"]=> NULL 
                    ["amount"]=> NULL
                 }
            }
            ["total_count"]=> int(31)
            ["per_page"]=> int(50)
            ["data"]=> array(31) {
                [0]=> array(20) {
                    ["id"]=> int(450421864)
                    ["pid"]=> int(7045095)
                    ["tid"]=> NULL
                    ["uid"]=> int(1587913)
                    ["description"]=> string(54) "B2C/B2B User Management International, Role Management"
                    ["start"]=> string(25) "2016-09-22T16:14:09+02:00"
                    ["end"]=> string(25) "2016-09-23T00:45:47+02:00"
                    ["updated"]=> string(25) "2016-09-23T00:45:50+02:00"
                    ["dur"]=> int(30698000)
                    ["user"]=> string(17) "Siniša Jagarinec"
                    ["use_stop"]=> bool(false)
                    ["client"]=> string(5) "Bosch"
                    ["project"]=> string(14)"TT: CPP Portal"
                    ["project_color"]=> string(1) "7"
                    ["project_hex_color"]=> string(7) "#268bb5"
                    ["task"]=> NULL
                    ["billable"]=> NULL
                    ["is_billable"]=> bool(false)
                    ["cur"]=> NULL
                    ["tags"]=> array(0) {}
                }
                [1]=> array(20) {
                    ["id"]=> int(450450965)
                    ["pid"]=> int(7045095)
                    ["tid"]=> NULL
                    ["uid"]=> int(1405159)
                    ["description"]=> string(21) "Pre-Diagnostic Wizard"
                    ["start"]=> string(25) "2016-09-22T14:04:25+02:00"
                    ["end"]=> string(25) "2016-09-22T17:38:59+02:00"
                    ["updated"]=> string(25) "2016-09-22T17:40:34+02:00"
                    ["dur"]=> int(12874000)
                    ["user"]=> string(9) "Lars Grau"
                    ["use_stop"]=> bool(true)
                    ["client"]=> string(5) "Bosch"
                    ["project"]=> string(14) "TT: CPP Portal"
                    ["project_color"]=> string(1) "7"
                    ["project_hex_color"]=> string(7) "#268bb5"
                    ["task"]=> NULL
                    ["billable"]=> NULL
                    ["is_billable"]=> bool(false)
                    ["cur"]=> NULL
                    ["tags"]=> array(0) {}
                }
            }
        }   
        */

        // Load view
        $this->view('toggl/report', ['toggl_entries' => $detailed_report]);

    }
}