<?php

class Command extends \Eloquent {

	protected $table = 'command';
	protected $primaryKey = 'cmid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array

	protected $fillable = [];

}