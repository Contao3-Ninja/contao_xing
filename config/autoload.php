<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Gl_xing
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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
	'BugBuster\Xing\ModuleXingList' => 'system/modules/gl_xing/modules/ModuleXingList.php',

	// Classes
	'BugBuster\Xing\XingImage'      => 'system/modules/gl_xing/classes/XingImage.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_xing_empty'        => 'system/modules/gl_xing/templates',
	'mod_xing_list'         => 'system/modules/gl_xing/templates',
	'mod_xing_list_company' => 'system/modules/gl_xing/templates',
	'mod_xing_list_profile' => 'system/modules/gl_xing/templates',
	'mod_xing_list_team'    => 'system/modules/gl_xing/templates',
));
