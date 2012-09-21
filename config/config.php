<?php 

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @link http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 *
 * PHP version 5
 * @copyright  Glen Langer 2008..2012
 * @author     Glen Langer
 * @package    Xing 
 * @license    LGPL 
 */


/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['gl_xing'] = array
(
	'tables' => array('tl_xing_category', 'tl_xing'),
	'icon'   => 'system/modules/gl_xing/public/icon.gif'
);


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'xing' => array
	(
		'xinglist'   => 'Xing\ModuleXingList'
	)
));

