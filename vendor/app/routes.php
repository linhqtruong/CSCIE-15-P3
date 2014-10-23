<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an applicatio);It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('lorem-ipsum', 'LoremController@index');
Route::post('lorem-ipsum', 'LoremController@index');

Route::get('user-generator','UserController@get');
Route::post('user-generator',function(){
	$input = Input::all();
	Input::flash();
	$rules = array(
			'user' => 'required|integer|max:99'
		);

	$validation = Validator::make($input,$rules);

	if ($validation->fails()) {
		return Redirect::to('user-generator')->withErrors($validation);
	} else {
		$faker = Faker\Factory::create();

		$user = $input['user'];

		$arrayData = array();

		for ($i = 0 ; $i < $user ; $i++) {
			$data['name'] = $faker->name;
			if (Input::has('birthday')) {
				$data['birthday'] = $faker->date;
			}
			if (Input::has('profile')) {
				$data['profile'] = $faker->text;
			}
			array_push($arrayData,$data);
		}

		return Redirect::to('user-generator')->with(array(
									'result'	=> $arrayData
								));
	}
});

Route::get('pass-generator','PasswordGenerator@get');
Route::post('pass-generator','PasswordGenerator@post');

Route::get('call-permission','Permission@get');
Route::get('call-permission/{url}','Permission@get');

Route::post('call-permission','Permission@post');
Route::post('call-permission/{url}','Permission@post');

Route::any('{all}',function($page) {
	return Redirect::to('/');
})->where('all','.*');

