<?php
class Permission extends BaseController {
	public function get(){
		$data['title'] = "Calculate Permission";
		$url = Request::segment(2);
		$case = isset($url) ? $url : 'octal';
		if ($case === 'octal') {
			return View::make('permission.octal',$data);
		} elseif ($case === 'decode') {
			$result = Session::get('result');
			if (isset($result)) {
				$data['result'] = $result;
			}
			return View::make('permission.decode',$data);
		} elseif ($case === 'symbolic') {
			return View::make('permission.symbolic',$data); 
		} else {
			return Redirect::to('call-permission');
		}
	}
	public function post(){
		$data = Input::all();
		$url = Request::segment(2);
		$case = isset($url) ? $url : 'octal';
		$cal = new permissionCal\Calculator();
		if (Request::ajax()) {
			if ($case === 'octal') {
				$cal->set_encode_octal_special($data['special']);
				$cal->set_encode_octal_user($data['user']);
				$cal->set_encode_octal_group($data['group']);
				$cal->set_encode_octal_other($data['other']);
				$result = $cal->get_encode_octal();
				return Response::json($result);
			} else {

				$rules = array(
						'initial' => 'required|initial'
					);
				$message = array(
						'initial' => 'Value must be between 3-4 characters in length and use the digits 0-7 e.g: 0777 or 777'
					);

				$validation = Validator::make($data,$rules,$message);

				if ($validation->fails()) {
					$result['msg-error'] = $validation->messages()->toArray();
					$result['target'] = '0000';
					$result['result'] = '';
					return Response::json($result);
				}

				$cal->set_encode_octal_special($data['special']);
				$cal->set_encode_octal_user($data['user']);
				$cal->set_encode_octal_group($data['group']);
				$cal->set_encode_octal_other($data['other']);

				$result['target'] = $cal->get_encode_octal();

				$current = isset($data['initial']) ? $data['initial'] : '0000';
				$target = $result['target'];
				$result['result'] = $cal->get_encode_symbol($current,$target);
				return Response::json($result);
			}
		} else {
			Input::flash();
			if ($case === 'decode') {
				$rules = array(
					'initial' => 'required|initial'
				);
				$message = array(
					'initial' => 'Value must be between 3-4 characters in length and use the digits 0-7 e.g: 0777 or 777'
				);

				$validation = Validator::make($data,$rules,$message);

				if ($validation->fails()) {
					return Redirect::to('call-permission/decode')->withErrors($validation);
				} else {
					$initial = $data['initial'];
					$result = $cal->get_decode_octal($initial);
					return Redirect::back()->with('result',$result);
				}
			}
		}
	}
}
