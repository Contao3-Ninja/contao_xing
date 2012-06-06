<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Load tl_content language file
 */
$this->loadLanguageFile('tl_content');


/**
 * Table tl_xing 
 */
$GLOBALS['TL_DCA']['tl_xing'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_xing_category',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'filter'                  => true,
			'fields'                  => array('sorting'),
			'panelLayout'             => 'search,filter,limit',
			//'headerFields'            => array('title', 'headline', 'tstamp'),
			'headerFields'            => array('title', 'tstamp'),
			'child_record_callback'   => array('tl_xing', 'listProfiles')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['toggle'],
				'icon'                => 'visible.gif',
				//'attributes'          => 'onclick="Backend.getScrollOffset();"',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_xing', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'xingprofil,xinglayout,xingtarget;published'
	),

	// Fields
	'fields' => array
	(
		'xingprofil' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xingprofil'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
            'explanation'	          => 'xing_help_profile',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'helpwizard'=>true, 'tl_class'=>'w50')
		),
		'xinglayout' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xinglayout'],
			'default'                 => '2',
			'inputType'               => 'select',
			'options'                 => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10' // DE
			                                   , '11', '12', '13', '14', '15', '16'              // EN
			                                   , '17' ,'18' ,'19' ,'20' ,'21' ,'22' ,'23'        // FR
			                                   , '24' ,'25' ,'26' ,'27' ,'28' ,'29' ,'30' ,'31'  // PL
			                                   , '41' ,'42' ,'43' ,'44' ,'45' ,'46' ,'47' ,'48'  // SV
			                                   , '62' ,'63' ,'64' ,'65' ,'66' ,'67' ,'68' ,'69'  // JP
			                                   , '71' ,'72' ,'73' ,'74' ,'75' ,'76' ,'77'        // PT
			                                   , '999' // Company
			                                   ),
			'reference'               => &$GLOBALS['TL_LANG']['tl_xing'],
			'search'                  => true,
			'explanation'	          => 'xing_help_layout',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>3, 'rgxp'=>'digit', 'helpwizard'=>true, 'tl_class'=>'w50')
		),
        'xingtarget' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xingtarget'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'clr')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		)
	)
);


/**
 * Class tl_xing
 *
 * Methods that are used by the DCA 
 */
class tl_xing extends Backend
{
	/**
     * Import the back end user object
     */
    public function __construct()
    {
            parent::__construct();
            $this->import('BackendUser', 'User');
    }
        
	public function listProfiles($arrRow)
	{
        $style = 'style="font-size:11px;margin-bottom:10px;"';

		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$date = date($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']);
	
		$XingImage = new XingImage(); // classes/XingImage.php
		$xing_images = $XingImage->getXingImageLink($arrRow['xinglayout']);

		return '
<div class="cte_type ' . $key . '" ' . $style . '><strong>' . $arrRow['xingprofil'] . '</strong> - ' . $date . '</div>' 
		.$xing_images;
		
	}
	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
			$this->redirect($this->getReferer());
		}
		
		// Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_xing::published', 'alexf'))
        {
                return '';
        }

		$href .= '&amp;tid='.$row['id'].'&amp;state='. ($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href.'&amp;id='.Input::get('id')).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}
	
	/**
	 * Disable/enable xing profile
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
	    // Check permissions to publish	    
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_xing::published', 'alexf'))
        {
			$this->log('Not enough permissions to publish/unpublish Xing Profile ID "'.$intId.'"', 'tl_xing toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
        }
		// Update database
		$this->Database->prepare("UPDATE tl_xing SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
	}
}

?>