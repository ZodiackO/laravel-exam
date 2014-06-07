<?php

class Writting extends \Eloquent {

	protected $table = 'writting';
	protected $primaryKey = 'wid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}