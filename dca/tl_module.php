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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['xinglist']   = 'name,type,headline;xing_categories,xing_template;guests,protected;align,space,cssID';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['xing_categories'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['xing_categories'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_xing_category.title',
	'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['xing_template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['xing_template'],
    'default'                 => 'mod_xing_list',
    'exclude'                 => true,
    'inputType'               => 'select',
    //'options'                 => $this->getTemplateGroup('mod_xing_'),
    'options_callback'        => array('tl_module_xing', 'getXingTemplates'), 
    'explanation'	          => 'xing_help_template',
    'eval'                    => array('helpwizard'=>true,'tl_class'=>'w50')
);

class tl_module_xing extends Backend 
{
	public function getXingTemplates(DataContainer $dc)
	{
	    return $this->getTemplateGroup('mod_xing_list', $dc->activeRecord->pid);
	}  
}

