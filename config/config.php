<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * 
 * Modul Xing Config - Backend
 *
 * This is the Xing configuration file.
 *
 * PHP version 5
 * @copyright  Glen Langer 2008..2012
 * @author     Glen Langer
 * @package    Xing 
 * @license    GPL 
 * @filesource
 */


/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['gl_xing'] = array
(
	'tables' => array('tl_xing_category', 'tl_xing'),
	'icon'   => 'system/modules/gl_xing/html/icon.gif'
);


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'xing' => array
	(
		'xinglist'   => 'ModuleXingList'
	)
));

?>