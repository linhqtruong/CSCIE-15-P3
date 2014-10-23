<?php
namespace permissionCal;
class Calculator
{
	/************************************* DECLARE VARIABLE **************************************/
	/**
	 * The permission array
	 */
	protected $permission = array(
		"special" => 0,
		"user" => 0,
		"group" => 0,
		"other" => 0
	);	
	/************************************* DECLARE FUNCTION **************************************/
	/**
	 * @brief	Set value for special permission
	 * @params string 
	 * 		"u":	setuid
	 * 		"g":	setgid
	 * 		"o":	Sticky-bit
	 */
	public function set_encode_octal_special($spec_str){
		$this->permission["special"] = 0;
		for ($i = 0; $i < strlen($spec_str); $i++){
			switch($spec_str[$i]){
				case "u":
					$this->permission["special"] += 4;
					break;
				case "g":
					$this->permission["special"] += 2;
					break;
				case "o":
					$this->permission["special"] += 1;
					break;
				default:
					break;
			}
			
		}
	}
	/**
	 * @brief	Set value for user permission
	 * @params string 
	 * 		"r":	read
	 * 		"w":	write
	 * 		"x":	execute
	 */
	public function set_encode_octal_user($user_str){
		$this->permission["user"] = 0;
		for ($i = 0; $i < strlen($user_str); $i++){
			switch($user_str[$i]){
				case "r":
					$this->permission["user"] += 4;					
					break;
				case "w":
					$this->permission["user"] += 2;
					break;
				case "x":
					$this->permission["user"] += 1;
					break;
				default:
					break;
			}
		}	
	}
	/**
	 * @brief	Set value for group permission
	 * @params string 
	 * 		"r":	read
	 * 		"w":	write
	 * 		"x":	execute
	 */
	public function set_encode_octal_group($group_str){
		$this->permission["group"] = 0;
		for ($i = 0; $i < strlen($group_str); $i++){
			switch ($group_str[$i]){
				case "r":
					$this->permission["group"] += 4;
					break;
				case "w":
					$this->permission["group"] += 2;
					break;
				case "x":
					$this->permission["group"] += 1;
					break;
				default:
					break;
			}
		}
	}
	/**
	 * @brief	Set value for other permission
	 * @params string 
	 * 		"r":	read
	 * 		"w":	write
	 * 		"x":	execute
	 */
	public function set_encode_octal_other($other_str){
		$this->permission["other"] = 0;
		for ($i = 0; $i < strlen($other_str); $i++){
			switch ($other_str[$i]){
				case "r":
					$this->permission["other"] += 4;
					break;
				case "w":
					$this->permission["other"] += 2;
					break;
				case "x":
					$this->permission["other"] += 1;
					break;
				default:
					break;
			}
		}
	}
	/**
	 * @brief	Get permission in octal
	 * $return	String	xxxx
	 */
	public function get_encode_octal(){
		$str = "";
		$str .= $this->permission["special"];
		$str .= $this->permission["user"];
		$str .= $this->permission["group"];
		$str .= $this->permission["other"];
		return $str;
	}
	/**
	 * @brief	Get 
	 * @params	
	 * 		$decode_str	String format xxxx
	 * @return
	 * 		Array format
	 * 		["special" => ["u" => x, "g" => x, "o" => x],
	 * 		 "user" => ["r" => x, "w" => x, "x" => x],
	 * 		 "group" => ["r" => x, "w" => x, "x" => x],
	 * 		 "other" => ["r" => x, "w" => x, "x" => x]]
	 * @note
	 * 		x = 0 or 1
	 */
	public function get_decode_octal($decode_str){
		if (strlen($decode_str) < 4){
			for ($i = 0; $i < 4 - strlen($decode_str); $i++){
				$decode_str = "0" . $decode_str;
			}
		}
		for ($i = 0; $i < strlen($decode_str); $i++){
			switch ($i){
				case 0:
					$this->permission["special"] = intval($decode_str[$i]);
					break;
				case 1:
					$this->permission["user"] = intval($decode_str[$i]);
					break;
				case 2:
					$this->permission["group"] = intval($decode_str[$i]);
					break;
				case 3:
					$this->permission["other"] = intval($decode_str[$i]);
					break;
				default:
					break;
			}
		}
		$decode_result = array();
		$special_result = array();
		$user_result = array();
		$group_result = array();
		$other_result = array();
		/* Decode special result */
		$special_result["u"] = 0;
		$special_result["g"] = 0;
		$special_result["o"] = 0;
		if ($this->permission["special"] & 0x04){
			$special_result["u"] = 1;
		}
		if ($this->permission["special"] & 0x02){
			$special_result["g"] = 1;
		}
		if ($this->permission["special"] & 0x01){
			$special_result["o"] = 1;
		}
		/* Decode user result */
		$user_result["r"] = 0;
		$user_result["w"] = 0;
		$user_result["x"] = 0;
		if ($this->permission["user"] & 0x04){
			$user_result["r"] = 1;
		}
		if ($this->permission["user"] & 0x02){
			$user_result["w"] = 1;
		}
		if ($this->permission["user"] & 0x01){
			$user_result["x"] = 1;
		}
		/* Decode group result */
		$group_result["r"] = 0;
		$group_result["w"] = 0;
		$group_result["x"] = 0;
		if ($this->permission["group"] & 0x04){
			$group_result["r"] = 1;
		}
		if ($this->permission["group"] & 0x02){
			$group_result["w"] = 1;
		}
		if ($this->permission["group"] & 0x01){
			$group_result["x"] = 1;
		}
		/* Decode other result */
		$other_result["r"] = 0;
		$other_result["w"] = 0;
		$other_result["x"] = 0;
		if ($this->permission["other"] & 0x04){
			$other_result["r"] = 1;
		}
		if ($this->permission["other"] & 0x02){
			$other_result["w"] = 1;
		}
		if ($this->permission["other"] & 0x01){
			$other_result["x"] = 1;
		}
		$decode_result["special"] = $special_result;
		$decode_result["user"] = $user_result;
		$decode_result["group"] = $group_result;
		$decode_result["other"] = $other_result;
		return $decode_result;
	}
	/**
	 * @brief	Get permission string
	 * @params
	 * 		$octal	int, range value [0..15]
	 * @return
	 * 		permission string
	 */
	protected function __get_encode_symbol($old, $new){
		if ($old == $new)
			return "";
		$add = '';
		$sub = '';
		if ( $old & 0x04 | $new & 0x04) {
			if ( ($old & 0x04 ) > ($new & 0x04)) {
				$sub .= 'r';
			} else {
				$add .= 'r';
			}
		}
		if ($old & 0x02 | $new & 0x02) {
			if ( ($old & 0x02 ) > ($new & 0x02)) {
				$sub .= 'w';
			} else {
				$add .= 'w';
			}
		}
		if ($old & 0x01 | $new & 0x01) {
			if ( ($old & 0x01 ) > ($new & 0x01)) {
				$sub .= 'x';
			} else {
				$add .= 'x';
			}
		}
		if ($old & 0x08 | $new & 0x08){
			if ( ($old & 0x08 ) > ($new & 0x08)) {
				$sub .= 's';
			} else {
				$add .= 's';
			}
		}
		$result = "";
		if (strlen($add) > 0) {
			$result .= '+'.$add;
		}
		if (strlen($sub) > 0) {
			$result .= '-'.$sub;
		}
		return $result;
	}
	/**
	 * @brief	Get permission in symbolic format
	 * @params	None
	 * @return
	 * 		permission in symbolic format	
	 */
	public function get_encode_symbol($old,$new){
		$length = strlen($old);
		for ($i = 0 ; $i < 4 - $length ; $i++ ) {
			$old = '0'.$old;
		}
		//parse to array
		for ($i = 0 ; $i < 4 ; $i++ ) {
			$current[$i] = $old[$i];
			$target[$i] = $new[$i];
		}
		$resultString = "";

		if ($current[0] & 0x02) {
			$current[2] = $current[2] + 8;
		}
		if ($current[0] & 0x04) {
			$current[1] = $current[1] + 8;
		}

		if ($target[0] & 0x02) {
			$target[2] = $target[2] + 8;
		}
		if ($target[0] & 0x04) {
			$target[1] = $target[1] + 8;
		}

		$user 	= $target[1] - $current[1];
		$group 	= $target[2] - $current[2];
		$other 	= $target[3] - $current[3];

		if ($user == $group && $other == $group && $user != 0) {
			$resultString = "a".$this->__get_encode_symbol($current[1],$target[1]);
		} else if ($user == $group && $user != 0) {
			if ($user != 0)
				$resultString = "ug".$this->__get_encode_symbol($current[1],$target[1]);
			if ($other != 0)
				$resultString .= ",o".$this->__get_encode_symbol($current[3],$target[3]);
		} else if ($user == $other && $user != 0) {
			if ($user != 0)
				$resultString = "uo".$this->__get_encode_symbol($current[1],$target[1]);
			if ($group != 0)
				$resultString .= ",g".$this->__get_encode_symbol($current[2],$target[2]);
		} else if ($group == $other && $other != 0) {
			if ($user != 0 )
				$resultString = "u".$this->__get_encode_symbol($current[1],$target[1]).",";
			if ($group != 0 )
				$resultString .= "go".$this->__get_encode_symbol($current[2],$target[2]);
		} else {
			if ($user != 0) {
				$resultString = "u".$this->__get_encode_symbol($current[1],$target[1]);
			}
			if ($group != 0) {
				if ($user != 0) {
					$resultString .= ",";
				}
				$resultString .= "g".$this->__get_encode_symbol($current[2],$target[2]);
			}
			if ($other != 0) {
				if ($user != 0 || $group != 0) {
					$resultString .= ",";
				}
				$resultString .= "o".$this->__get_encode_symbol($current[3],$target[3]);
			}
		}
		if (($current[0] & 0x01) && !($target[0] & 0x01)) {
			if ($resultString != '')
				$resultString .= ',';
			$resultString .= "-t";
		} else if ( ! ($current[0] & 0x01) && ($target[0] & 0x01)) {
			if ($resultString != '')
				$resultString .= ',';
			$resultString .= "+t";
		}
		return $resultString;
	}

}
	/*******************EXAMPLE*************************/
	// $cal = new Calculator();
	// $cal->set_encode_octal_user("r");
	// $cal->set_encode_octal_group("w");
	// $cal->set_encode_octal_other("x");
	// var_dump($cal->get_decode_octal("1111"));
	// echo $cal->get_encode_symbol();
	/*******************EXAMPLE*************************/