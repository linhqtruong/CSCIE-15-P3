<?php
namespace xkcdPassword;
class Generator
{
	/************************************* CONSTANT FUNCTION **************************************/
	/**
	 * The element of this array point at the positions in word list file
	 * Eg:
	 * 		$word_len_arr[0] point at first word having lenght equal to 1
	 * 	  	$word_len_arr[1] point at first word having lenght equal to 2
	 * 		...
	 * 		$word_len_arr[k] point at first word having lenght equal to k+1
	 */ 
	protected $word_len_arr = array(0, 1, 248, 1417, 5007, 12268, 24556, 42495, 63701, 85231, 104879, 120877, 132695);
	/**
	 * The size of word_len array
	 * @var int
	 */
	const WORD_LEN_ARR_SIZE = 12;
	/**
	 * The name of the dictionary file
	 * @var string
	 */
	const WORD_LIST_FILE_NAME = "../app/lib/xkcdPassword/wordlist/UK.dic";
	/**
	 * The array of special characters
	 * @var string 
	 */
	protected $special_symbols = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")");
	/************************************* DECLARE VARIABLE **************************************/
	/**
	 * The maximum length of password (include number, special char, separator)
	 * @var int
	 */
	protected $max_length = 20;
	/**
	 * Whether include number or not
	 * @var bool
	 */
	protected $incl_num = false;
	/**
	 * Including custom or random number
	 * @var string 
	 */
	protected $incl_num_type = "r";
	/**
	 * The number of number character in password
	 * @var int
	 */
	protected $incl_num_size = 0;
	/**
	 * The custom number value (use in custom number)
	 * @var int
	 */
	protected $incl_num_cus_val = 0;
	/**
	 * whether include special char or not
	 * @var string  
	 */
	protected $incl_ss = false;
	/**
	 * Inlcuding custom or random special char
	 * @var string
	 */
	protected $incl_ss_type = "r";
	/**
	 * The number of special char in password
	 * @var int
	 */
	protected $incl_ss_size = 0;
	/**
	 * The custom special char value (use in custom special char)
	 * @var int
	 */
	protected $incl_ss_cus_val = 0;
	/**
	 * Type of separator
	 * @var string: "none", "space", "hyphen"
	 */
	protected $sepa_type = "space";
	/**
	 * Type of case transform
	 * @var string:	"all_lower", "all_upper", "first_char"
	 */
	protected $case_tfm_type = "all_lower";
	/************************************* DECLARE FUNCTION **************************************/
	/**
	 * @params int $max_len
	 */
	public function set_max_length($max_len){
		$this->max_length = $max_len;
	}	
	/**
	 * @params 
	 * 		bool $incl_num
	 * 		char $incl_num_type
	 * 		int  $incl_num_size
	 * 		int  $incl_num_cus_val	
	 */	 
	public function set_incl_num($incl_num, $incl_num_type, $incl_num_size, $incl_num_cus_val){
		$this->incl_num = $incl_num;
		$this->incl_num_type = $incl_num_type;
		$this->incl_num_size = $incl_num_size;
		$this->incl_num_cus_val = $incl_num_cus_val;  	
	}
	/**
	 * @params
	 * 		bool  $incl_ss
	 * 		char  $incl_ss_type
	 * 		int	  $incl_ss_size
	 * 		int   $incl_ss_cus_val
	 */
	public function set_incl_ss($incl_ss, $incl_ss_type, $incl_ss_size, $incl_ss_cus_val){
		$this->incl_ss = $incl_ss;
		$this->incl_ss_type = $incl_ss_type;
		$this->incl_ss_size = $incl_ss_size;
		$this->incl_ss_cus_val = $incl_ss_cus_val;
	}
	/**
	 * @return int
	 */
	public function get_max_length(){
		return $this->max_length;
	}
	/**
	 * @return bool
	 */
	public function get_incl_num(){
		return $this->incl_num;
	}
	/**
	 * @return char
	 */
	public function get_incl_num_type(){
		return $this->incl_num_type;
	}
	/**
	 * @return int
	 */
	public function get_incl_num_size(){
		return $this->incl_num_size;
	}
	/**
	 * @return int
	 */
	public function get_incl_num_cus_val(){
		return $this->incl_num_cus_val;
	}
	/**
	 * @return bool
	 */
	public function get_incl_ss(){
		return $this->incl_ss;
	}
	/**
	 * @return char
	 */
	public function get_incl_ss_type(){
		return $this->incl_ss_type;
	}
	/**
	 * @return int
	 */
	public function get_incl_ss_size(){
		return $this->incl_ss_size;
	}
	/**
	 * @return char
	 */
	public function get_incl_ss_cus_val(){
		return $this->special_symbols[$this->incl_ss_cus_val];
	}
	/**
	 * @brief	Overload same function
	 * @params
	 * 		$name
	 * 			Name of function
	 * 		$params
	 * @note
	 * 		Refer from http://stackoverflow.com/questions/4697705/php-function-overloading
	 */
	public function __call($name, $args){
		switch ($name) {
			case "set_incl_num":
				switch (count($args)) {
					case 3:
						return call_user_func_array(array($this, "set_incl_num_without_cus_val"), $args);
						break;
					case 4:
						return call_user_func_array(array($this, "set_incl_num_with_cus_val"), $args);
						break;
					default:
						break;
				}
				break;
			case "set_incl_ss":
				switch (count($args)){
					case 3:
						return call_user_func_array(array($this, "set_incl_ss_without_cus_val"), $args);
						break;
					case 4:
						return call_user_func_array(array($this, "set_incl_ss_with_cus_val"), $args);
						break;
					default:
						break;
				}
				break;
			default:
				break;
		}
	}
	/**
	 * @params string
	 */
	public function set_sepa($sepa_type){
		$this->sepa_type = $sepa_type;
	}
	/**
	 * @params string
	 */
	public function set_case_tfm($case_tfm_type){
		$this->case_tfm_type = $case_tfm_type;
	}
	/**
	 * @brief		Generate a word with $word_len size 
	 * @params	
	 * 		$word_len	
	 * 				Length of the word
	 * @return 		random word
	 */
	protected function word_gen($word_len){
		if ($word_len > self::WORD_LEN_ARR_SIZE){
			return "";
		}
		$wordlist_file = new \SplFileObject(self::WORD_LIST_FILE_NAME);
		$first_word_pos = $this->word_len_arr[$word_len-1];	//Get the position of the first word in word list file
		$num_of_word = $this->word_len_arr[$word_len] - $this->word_len_arr[$word_len-1];	//Get number of word which have len = $word_len		
		$wordlist_file->seek($first_word_pos + rand(0, $num_of_word));     // Seek to line no. 10,000
		return trim($wordlist_file->current()); // Print contents of that line		
	}
	/** 
	 * @brief 		create 2 string of number to append with password
	 * @params		
	 * 		$num_type	random number or custom number
	 * 		$num_size	number of number character appended
	 * 		$after_size	number of number character appended at the end of password
	 * 		$custom_num	use for custom type
	 * @return 		Array
	 * 		[['before']=>"1111", ['after']=>"111"] 
	 * @note
	 * 		'before': 	appended at the head of the password
	 * 		'after':	appended at the tail of the password
	 */ 
	protected function number_gen($num_type, $num_size, $after_size, $custom_num){
		$num_str = array();
		$num_str['before'] = "";
		$num_str['after'] = "";
		switch ($num_type) {
			case "c":				
				for ($i = 0; $i < ($num_size-$after_size); $i++){
					$num_str['before'] .= $custom_num;
				}
				for ($i = 0; $i < $after_size; $i++){
					$num_str['after'] .= $custom_num;
				}
				break;
			case "r":
				$random_num = rand(0, 9);
				for ($i = 0; $i < ($num_size-$after_size); $i++){
					$num_str['before'] .= $random_num;
				}
				for ($i = 0; $i < $after_size; $i++){
					$num_str['after'] .= $random_num;
				}
				break;
			default:				
		}
		return $num_str;
	}
	/**
	 * @brief 		create 2 string of special symbols to append with password
	 * @params		
	 * 		$num_type	random special symbol or custom special symbol
	 * 		$num_size	number of special symbol appended
	 * 		$after_size	number of special symbol appended at the end of password
	 * 		$custom_num	use for custom type
	 * @return 		Array
	 * 		[['before']=>"###", ['after']=>"#"] 
	 * @note
	 * 		'before': 	appended at the head of the password
	 * 		'after':	appended at the tail of the password
	 */  
	protected function special_symbol_gen($ss_type, $ss_size, $after_size, $custom_ss){
		global $special_symbols;		
		$ss_str = array();
		$ss_str['before'] = "";
		$ss_str['after'] = "";		
		switch ($ss_type) {
			case "c":
				for ($i = 0; $i < ($ss_size-$after_size); $i++){
					$ss_str['before'] .= $this->special_symbols[$custom_ss];
				}
				for ($i = 0; $i < $after_size; $i++){
					$ss_str['after'] .= $this->special_symbols[$custom_ss];
				}
				break;
			case "r":
				$random_ss = $this->special_symbols[rand(0, 9)];
				for ($i = 0; $i < ($ss_size-$after_size); $i++){
					$ss_str['before'] .= $random_ss;
				}
				for ($i = 0; $i < $after_size; $i++){
					$ss_str['after'] .= $random_ss;
				}
				break;
			default:
		}
		return $ss_str;
	}
	/** 
	 * @brief	Add case tranform to array of words
	 * @params
	 * 		&$words		array of words which is transformed
	 * 		$case_tfm_type
	 * 					type of case transform
	 * @return	none
	 */ 
	protected function add_case_transform(&$words, $case_tfm_type){
		switch ($case_tfm_type) {
			case "all_lower":				
				break;
			case "all_upper":
				for ($i = 0; $i < count($words); $i++){
					$words[$i] = strtoupper($words[$i]);
				}
				break;
			case "first_char":
				for ($i = 0; $i < count($words); $i++){
					$words[$i] = ucfirst($words[$i]);
				}
				break;
			default: 
		}
	}
	/** 
	 * @brief		Add string of number to password
	 * @params
	 * 		$password
	 * 				Password
	 * 		$num_type
	 * 				Custom or Random number
	 * 		$num_size
	 * 				Number of number characters which are added
	 * 		$custom_num
	 * 				Value of number characters which are added ($num_type = custom only) 
	 * @return		None
	 */ 
	protected function add_num(&$password, $num_type, $num_size, $custom_num){		
		$numbers_str = $this->number_gen($num_type, $num_size, $num_size, $custom_num);
		$password = $password . $numbers_str['after'];
		$password = $numbers_str['before'] . $password; 	
	}
	/** 
	 * @brief		Add string of special character to password
	 * @params
	 * 		$password
	 * 				Password
	 * 		$ss_type
	 * 				Custom or Random special character
	 * 		$ss_size
	 * 				Number of special characters which are added
	 * 		$custom_ss
	 * 				Value of special character which are added ($ss_type = custom only) 
	 * @return		None
	 */  	
	protected function add_ss(&$password, $ss_type, $ss_size, $custom_ss){
		$special_symbols_str = $this->special_symbol_gen($ss_type, $ss_size,$ss_size, $custom_ss);
		$password = $password . $special_symbols_str['after'];
		$password = $special_symbols_str['before'] . $password;
	}
	/* @brief		Insert separated character into password
	 * @params		
	 * 		$words
	 * 				Array of words
	 * 		$sepa_type
	 * 				Type of separator
	 * @return
	 * 		a password (string format) with separator
	 */ 
	protected function add_sepa($words, $sepa_type){
		$xkcd_pass_tem = "";
		for ($i = 0; $i < count($words); $i++){
			$xkcd_pass_tem .= $words[$i];
			if ($i == count($words)-1){
				break;
			}
			switch ($sepa_type) {
				case "space":
					$xkcd_pass_tem .= " ";
					break;
				case "hyphen":
					$xkcd_pass_tem .= "-";
					break;
				default:
			}
		}
		return $xkcd_pass_tem;
	}
	/**
	 * @brief
	 * 		Gen xkcd password (randomly)
	 * @params
	 * 		$num_word
	 * 			number of words in password
	 * @return
	 * 		xkcd password (string format)
	 */
	 public function get_xkcd_password($num_word){
	 	$adjust_max_length = $this->max_length;
	 	if ($this->incl_num){
			$adjust_max_length -= $this->incl_num_size;		
		}
		if ($this->incl_ss){
			$adjust_max_length -= $this->incl_ss_size;
		}
		if ($this->sepa_type == "space" || $this->sepa_type == "hyphen"){
			$adjust_max_length -= ($num_word-1);
		}
	 	$word_average_len = floor($adjust_max_length/$num_word);		
		if ($word_average_len > 0){
			$words = array();		//Store words temporarily before add number, special symbol, ...
			for ($i = 0; $i < $num_word; $i++){
				array_push($words, $this->word_gen(rand(1, min(array(self::WORD_LEN_ARR_SIZE, $word_average_len)))));				 
				$adjust_max_length -= strlen($words[$i]);
				if ($i != $num_word-1){
					$word_average_len = floor($adjust_max_length/($num_word-$i-1));
				}
			}
			$this->add_case_transform($words, $this->case_tfm_type);
			$xkcd_password = $this->add_sepa($words, $this->sepa_type);			
			if ($this->incl_num == true){
				$this->add_num($xkcd_password, $this->incl_num_type, $this->incl_num_size, 
										$this->incl_num_cus_val);
			}
			if ($this->incl_ss == true){
				$this->add_ss($xkcd_password, $this->incl_ss_type, $this->incl_ss_size, 
										$this->incl_ss_cus_val);			
			}
		}
		/* Print result */
		return $xkcd_password;
	 }
}
?>

<?php
	/*******************EXAMPLE*************************/
	// $pass_obj = new xkcdPassGenerator();
	// $pass_obj->set_incl_num(true, "c", 4, 0);
	// $pass_obj->set_incl_ss(true, "c", 4, 0);
	// $pass_obj->set_case_tfm("all_upper");
	// $pass_obj->set_sepa("hyphen");
	// $password = $pass_obj->get_xkcd_password(3);
	// echo $password;
	/*******************EXAMPLE*************************/
?>