<?php

class Course extends \Eloquent {
	protected $table = 'course';
	protected $primaryKey = 'courseid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'name' => 'required',
		'code' => 'required'
	];
	protected $guarded = array('');
	// Don't forget to fill this array

	protected $fillable = [];

}