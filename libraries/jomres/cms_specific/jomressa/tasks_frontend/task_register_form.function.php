<?php
/**
* Core file
* @author Vince Wooll <sales@jomres.net>
* @version Jomres 7
* @package Jomres
* @copyright	2005-2012 Vince Wooll
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly, however all images, css and javascript which are copyright Vince Wooll are not GPL licensed and are not freely distributable. 
**/

// ################################################################
defined( "_JOMRES_INITCHECK" ) or die( "" );
// ################################################################

function task_register_form()
	{
	$JSAuser 		= 	jomressa_getSingleton('jomressa_access_user');
	if (get_showtime('registration_forbidden'))
		return;
	if (isset($_POST['Submit'])) 
		{
		$JSAuser->register_user($_POST['login'], $_POST['password'], $_POST['confirm'], $_POST['name'], $_POST['info'], $_POST['email']); // the register method
		} 
	$error = $JSAuser->the_msg; // error message

	$output=array();
	$pageoutput=array();
	
	$output['_JOMRES_SA_FORMS_REGISTRATION_TITLE'] = _JOMRES_SA_FORMS_REGISTRATION_TITLE;
	$output['_JOMRES_SA_FORMS_REGISTRATION_DESC'] = _JOMRES_SA_FORMS_REGISTRATION_DESC;
	$output['_JOMRES_SA_FORMS_UPDATEUSER_CONFIRMPASSWORD'] = _JOMRES_SA_FORMS_UPDATEUSER_CONFIRMPASSWORD;
	$output['_JOMRES_SA_FORMS_UPDATEUSER_REALNAME'] = _JOMRES_SA_FORMS_UPDATEUSER_REALNAME;
	$output['_JOMRES_SA_FORMS_UPDATEUSER_EMAIL'] = _JOMRES_SA_FORMS_UPDATEUSER_EMAIL;
	$output['_JOMRES_SA_FORMS_UPDATEUSER_EXTRAINFO'] = _JOMRES_SA_FORMS_UPDATEUSER_EXTRAINFO;
	$output['_JOMRES_SA_FORMS_CONFIRMPASSWORDIGNORE'] = _JOMRES_SA_FORMS_CONFIRMPASSWORDIGNORE;
	$output['_JOMRES_SA_FORMS_UPDATEUSER_MINCHARS'] = _JOMRES_SA_FORMS_UPDATEUSER_MINCHARS;
	
	$output['_JOMRES_SA_FORMS_USERNAME'] = _JOMRES_SA_FORMS_USERNAME;
	$output['_JOMRES_SA_FORMS_PASSWORD'] = _JOMRES_SA_FORMS_PASSWORD;
	

	$output['PASSWORD'] = '';
	if (isset($_POST['password'])) $output['PASSWORD'] =$_POST['password'];
	if (isset($_POST['login'])) $output['LOGIN'] =$_POST['login'];

	$output['PASSWORDCONFIRM'] =  (isset($_POST['confirm'])) ? $_POST['confirm'] : ""; 
	$output['FULLNAME'] =  (isset($_POST['name'])) ? $_POST['name'] : $JSAuser->user_full_name;
	$output['EMAIL'] =  (isset($_POST['email'])) ? $_POST['email'] : $JSAuser->user_email;
	$output['INFO'] =  (isset($_POST['info'])) ? $_POST['info'] : $JSAuser->user_info;

	$output['ERROR'] =(isset($error)) ? $error : "&nbsp;";

	$output['POSTACTION'] = JOMRES_SITEPAGE_URL."&jsat=register_form";

	$pageoutput[]=$output;
	$template_rows = array('pageoutput'=>$pageoutput);
	return render_template("register.html",TEMPLATES_FRONTEND,$template_rows);
	}
?>