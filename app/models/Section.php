<?php

class Section extends \Eloquent {
	protected $table = 'section';
	protected $primaryKey = 'secid';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'

	];
	protected $guarded = array('');
	// Don't forget to fill this array

	protected $fillable = [];

}