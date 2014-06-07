<?php

class Examination extends \Eloquent {

	protected $table = 'examination';
	protected $primaryKey = 'exid';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}