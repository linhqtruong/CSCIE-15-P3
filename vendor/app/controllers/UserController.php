<?php

class UserController extends \BaseController {
	public function get()
	{
		$data['title'] = "User Generator";
		$data['result'] = Session::get('result') ? Session::get('result') : null;
		return View::make('user.index',$data);
	}

}