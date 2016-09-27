<?php

class Controller
{
	public function model($model, $data = [])
	{

        // Naming convention: Models start with capitalized first character and have "Model" appended to the filename
        $model = ucfirst($model) . 'Model';

		# @@@ add file_exists check
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	public function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.php';
	}
}