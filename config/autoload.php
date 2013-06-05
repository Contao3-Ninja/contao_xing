<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Xing
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'BugBuster',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'BugBuster\Xing\ModuleXingList'  => 'system/modules/gl_xing/modules/ModuleXingList.php',

	// Classes
	'BugBuster\Xing\XingImage'       => 'system/modules/gl_xing/classes/XingImage.php',
	'BugBuster\Xing\DCA_xing'        => 'system/modules/gl_xing/classes/DCA_xing.php',
	'BugBuster\Xing\DCA_module_xing' => 'system/modules/gl_xing/classes/DCA_module_xing.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_xing_list'         => 'system/modules/gl_xing/templates',
	'mod_xing_list_company' => 'system/modules/gl_xing/templates',
	'mod_xing_list_team'    => 'system/modules/gl_xing/templates',
	'mod_xing_empty'        => 'system/modules/gl_xing/templates',
	'mod_xing_list_profile' => 'system/modules/gl_xing/templates',
));
