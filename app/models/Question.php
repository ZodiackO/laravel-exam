<?php

class Question extends \Eloquent {

	protected $table = 'question';
	protected $primaryKey = 'qid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	protected $guarded = array('');
	// Don't forget to fill this array
	protected $fillable = [];

}