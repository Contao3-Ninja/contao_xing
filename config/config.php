<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * 
 * Modul Xing Config - Backend
 *
 * This is the Xing configuration file.
 *
 * PHP version 5
 * @copyright  Glen Langer 2008..2011
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


if (version_compare(VERSION . '.' . BUILD, '2.9.9', '<'))
{
	/**
	 * Migration over module based runonce for contao 2.9
	 * 
	 * Check for exists of /system/runonce
	 * if not, copy the module runonce therefore
	 */
	$runonceJob  = 'system/modules/gl_xing/config/RunonceJob.php';
	$runonceFile = 'system/runonce.php';
	
	if ( (file_exists(TL_ROOT . '/' . $runonceJob)) && (!file_exists(TL_ROOT . '/' . $runonceFile)) ) 
	{
		//keine /system/runonce, let's go
		$objFile = new File($runonceJob); // hier wird intern ein "TL_ROOT/" vorgesetzt
		if ($objFile->filesize > 100) 
		{
			$objFiles = Files::getInstance();
			$objFiles->copy($runonceJob,$runonceFile);
			//
			if (version_compare(VERSION . '.' . BUILD, '2.8.9', '>'))
			{
				$objFile->write("<?php // Module Migration Complete ?>");
			}
		}
		$objFile->close();
	}
}
?>