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
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################


class j06002editinplace 
	{
	function j06002editinplace()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$thisJRUser=jomres_singleton_abstract::getInstance('jr_user');
		if (!$thisJRUser->userIsManager)
			return;
		$siteConfig = jomres_singleton_abstract::getInstance('jomres_config_site_singleton');
		$jrConfig=$siteConfig->get();
		$property_uid=(int)getDefaultProperty();
		if ($jrConfig['allowHTMLeditor'] == "1")
			$customText = jomresGetParam( $_POST, 'newtext', "" , _MOS_ALLOWHTML );
		else
			$customText = jomresGetParam( $_POST, 'newtext', '','string' );

		$theConstant =filter_var($_POST['theConstant'],FILTER_SANITIZE_SPECIAL_CHARS);

		$result=updateCustomText($theConstant,$customText,$property_uid);
		if ($result)
			echo jomres_decode($customText);
		else
			echo "Something burped";
		}


	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
?>