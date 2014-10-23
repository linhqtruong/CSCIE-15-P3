permission Generator
/* Initialization */
	$cal = new Calculator();
/* Set permission for user*/
	$cal->set_encode_octal_user("r");
/* Set permission for group*/
	$cal->set_encode_octal_group("w");
/* Set permission for other*/	
	$cal->set_encode_octal_other("x");
/* Get decode octal */	
	$cal->get_decode_octal("1111");
/* Get permission in symbolic format*/	
	$cal->get_encode_symbol();