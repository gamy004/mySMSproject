<?php

function flash($message, $status = 'Info'){
	session()->flash('status', $status);
	session()->flash('message', $message);
}

function dump_db(){
	$debug = true;
	if ($debug === true) {
		DB::listen(function($query){
			echo "<pre>";
			var_dump($query->sql, $query->bindings);
			echo "</pre>";
		});
	}
}