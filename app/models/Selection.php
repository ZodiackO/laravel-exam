<?php

class Selection extends \Eloquent {

	// Add your validation rules here
	protected $table = 'selection';
	protected $primaryKey = 'selectid';
	public static $rules = [
		// 'title' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}