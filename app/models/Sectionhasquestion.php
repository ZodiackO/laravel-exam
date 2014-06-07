<?php

class Sectionhasquestion extends \Eloquent {
	protected $table = 'sectionhasquestion';
	protected $primaryKey = 'shqid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'

	];
	protected $guarded = array('');
	// Don't forget to fill this array

	protected $fillable = [];
}