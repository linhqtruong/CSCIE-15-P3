<?php
/**
* Generate random password
*/
class PasswordGenerator extends BaseController {
	/*
	* Function is routed via get method
	*/
	public function get()
	{
		$data['title'] = 'Password Generator';
		$data['result'] = Session::get('result') ? Session::get('result') : null;
		return View::make('password.index',$data);
	}
	/*
	* Function is routed via post method
	*/
	public function post(){
		$data = Input::all(); //Get all input
		if (Request::ajax()) {
			//check Auth. If it has any changes of data input, it return false;
			if (Session::token() != $data['token']) {
				return Response::json( 
					array(
						'msg' => 'Unauthorized attempt to create setting'
					));
			}
			//Check validation input
			$rules = array(
				'num_word' => 'required|integer|max:20',
				'max_length' => 'required|integer'
			);

			$validation = Validator::make($data,$rules);

			if ($validation->fails()) {
				$message = $validation->message();
				if ($message->has('num_word')) {
					$msg = $message->first('num_word');
				} else {
					$msg = $message->first('max_length');
				}
				return Response::json(array(
						'msg' => $msg
					));
			}


			$pass = new xkcdPassword\Generator();

			$num_word 		= $data['num_word'];
			$max_length 	= $data['max_length'];

			$incl_num		= $data['incl_num'];

			if ($incl_num != 'false') {
				$incl_num_type	= isset($data['incl_num_type']) ? $data['incl_num_type'] : null;
				$incl_num_size 	= isset($data['incl_num_size']) ? $data['incl_num_size'] : null;
				$incl_num_val 	= isset($data['incl_num_val']) ? $data['incl_num_val'] : null;
				$pass->set_incl_num($incl_num, $incl_num_type , $incl_num_size, $incl_num_val);
			} else {
				$pass->set_incl_num(false,null,null,null);
			}

			$incl_ss 		= $data['incl_ss'];
			if ($incl_ss != 'false') {
				$incl_ss_type	= isset($data['incl_ss_type']) ? $data['incl_ss_type'] : null;
				$incl_ss_size	= isset($data['incl_ss_size']) ? $data['incl_ss_size'] : null;
				$incl_ss_val 	= isset($data['incl_ss_val']) ? $data['incl_ss_val'] : null;
				$pass->set_incl_ss($incl_ss,$incl_ss_type,$incl_ss_size,$incl_ss_val);
			} else {
				$pass->set_incl_ss(false,null,null,null);
			}

			$separation_type= $data['separation_type'];
			$pass->set_sepa($separation_type);

			$case_tfm_type 	= $data['case_tfm_type'];
			$pass->set_case_tfm($case_tfm_type);

			$pass->set_max_length($max_length);
			$password = $pass->get_xkcd_password($num_word);
			return Response::json($password);
		}
	}
}