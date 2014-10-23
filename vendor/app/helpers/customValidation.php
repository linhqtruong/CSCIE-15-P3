<?php
class CustomValidation extends Illuminate\Validation\Validator {

	public function validateInitial($attribute, $value, $parameters) {
		$length = strlen($value);

		/*
		* Check length
		* length > 4 return false
		*/
		if ( strlen($value) > 4 ) {
			return false;
		}

		if (!preg_match('/\d/', $value)) {
			return false;
		}

		//fill size
		for ($i = 0 ; $i < 4 - $length ; $i++) {
			$value = '0'.$value;
		}

		//check each bit
		//bit greater than 7, return false;
		for ($i = 0 ; $i < 4 ; $i++) {
			if ($value[$i] > 7 || $value[$i] < 0 ) {
				return false;
			}
		}
		return true; //no bit has value greater than 7
	}
}