xfcd Password Generator
/*Basic usage example*/
	$pass_obj = new xkcdPassGenerator();
	$password = $pass_obj->get_xkcd_password(3);
	/*Set include number*/
	$pass_obj->set_incl_num(true, "c", 4, 0);
	/*Set include special char*/
	$pass_obj->set_incl_ss(true, "c", 4, 0);
	/*Change separator*/
	$pass_obj->set_sepa("hyphen");
	/*Change case transform*/
	$pass_obj->set_case_tfm("all_upper");