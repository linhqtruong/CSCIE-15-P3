<?php
/**
* Running example Lorum Ipsum Generator
* Include: validation + lorum-ipsum library
*/
class LoremController extends BaseController {
	/*
	* 
	*/
	public function index() {
		$data['title'] = 'Lorem Ipsum Generator';
		$method = Request::method();
		$input = Input::all();
		Input::flash();
		if (Request::isMethod('post')) {
			//Set rules 
			$rules = array('paragraphs' => 'required|integer|max:99');

			$validation = Validator::make($input,$rules);
			if ($validation->fails()) {
				return View::make('lorem.index',$data)->withErrors($validation);
			} else {
				$paragraphs = $input['paragraphs'];
				$generator = new Badcow\LoremIpsum\Generator();
				$data['word'] = $generator->getParagraphs($paragraphs);
			}
		//	var_dump($validation->fails());
		}
		return View::make('lorem.index',$data);
	}
}

/**
* End file LoremController
* Location:
*/