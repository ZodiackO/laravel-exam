<?php

class Choice extends \Eloquent {

	// Add your validation rules here
	protected $table = 'choice';
	protected $primaryKey = 'cid';
	public static $rules = [
		// 'title' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}