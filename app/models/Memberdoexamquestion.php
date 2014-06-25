<?php

class Memberdoexamquestion extends \Eloquent {

	protected $table = 'memberdoexamquestion';
	protected $primaryKey = 'mdxid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}