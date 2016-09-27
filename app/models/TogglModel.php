<?php

use AJT\Toggl\TogglClient as TogglClient;
use AJT\Toggl\ReportsClient as TogglReportsClient;

class TogglModel
{
    public $toggl_api_key = NULL;
    public $toggl_client;
    public $toggl_report_client;

    public function setApiKey($toggl_api_key)
    {
        $this->toggl_api_key = $toggl_api_key;
    }   

    public function getApiKey()
    {
        return $this->toggl_api_key;
    }  

	/**
     * Initiate the Toggl client
     */
         
    public function initiateClient()
    {
        if ($this->toggl_api_key != NULL) {
            // If you want to see what is happening, add debug => true to the factory call
            $this->toggl_client = TogglClient::factory(array('api_key' => $this->toggl_api_key));
        } else {
            die('No Toggl API key given');
        }
    }
         
	/**
     * Get the user's workspaces
     */

    public function getWorkspaces()
    {
        $workspaces = $this->toggl_client->getWorkspaces(array());
        return $workspaces;
    }

	/**
     * Get clients
     */

    public function getClients()
    {
        $clients = $this->toggl_client->getClients(array());
        return $clients;
        
        /*
        Array
        (
            [0] => Array
                (
                    [id] => 16199280
                    [guid] => a2ccd236-9d85-412c-bc44-212aa6275b85
                    [wid] => 725487
                    [name] => Bosch
                    [at] => 2015-02-11T09:32:12+00:00
                )
        )
        */
    }
    
	/**
     * Get projects in workspace
     */

    public function getProjects($workspace_id)
    {
        $projects = $this->toggl_client->getProjects(array('id' => $workspace_id));
        return $projects;
        
        /*
        Array
        (
            [0] => Array
                (
                    [id] => 22931608
                    [guid] => cf6c68d6-e087-4c2d-8401-2b4f1d4424bc
                    [wid] => 725487
                    [cid] => 19002487
                    [name] => Untitled Future
                    [billable] => 
                    [is_private] => 1
                    [active] => 1
                    [template] => 
                    [at] => 2016-09-23T10:40:05+00:00
                    [created_at] => 2016-09-23T10:40:05+00:00
                    [color] => 8
                    [auto_estimates] => 
                    [actual_hours] => 6
                    [hex_color] => #6668b4
                )
        )
        */
    }
    
    /**
     * Initiate the Toggl Report client
     */
         
    public function initiateReportClient()
    {
        if ($this->toggl_api_key != NULL) {
            // If you want to see what is happening, add debug => true to the factory call
            $this->toggl_report_client = TogglReportsClient::factory(array('api_key' => $this->toggl_api_key));
        } else {
            die('No Toggl API key given');
        }
    }
    
	/**
     * Get the detailed report
     */

    public function getDetailedReport($report_params)
    {
        $details = $this->toggl_report_client->Details($report_params);
        return $details;
    }
}
