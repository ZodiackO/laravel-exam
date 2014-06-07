<?php

class Member extends \Eloquent {
	protected $table = 'member';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}