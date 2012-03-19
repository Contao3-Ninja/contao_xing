<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * 
 * Modul Xing - Backend DCA tl_xing
 *
 * This is the data container array for table tl_xing.
 *
 * PHP version 5
 * @copyright  Glen Langer 2008..2011
 * @author     Glen Langer
 * @package    Xing
 * @license    GPL
 * @filesource
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
		if (version_compare(VERSION . '.' . BUILD, '2.9.0', '<'))
		{
		   // Code für Versionen < 2.9.0
		   $style = 'style="font-size:11px;margin:-15px 0px 10px 0px;"';
		}
		else
		{
		   // Code für Versionen ab 2.9.0
		   $style = 'style="font-size:11px;margin-bottom:10px;"';
		}
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$date = date($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']);
		switch ($arrRow['xinglayout']) {
			case 1:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/1_de_btn.gif" width="85" height="23"   alt="XING" title="mein XING Profil" />';
				break;
			case 2:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/2_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 3:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/3_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 4:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/4_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 5:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/5_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 6:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/6_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 7:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/7_de_btn.gif" width="139" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 8:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/8_de_btn.gif" width="118" height="23"  alt="XING" title="mein XING Profil" />';
				break;
			case 9:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/9_de_btn.gif" width="80" height="15"   alt="XING" title="mein XING Profil" />';
				break;
			case 10:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/16_de_btn.gif" width="118" height="23" alt="XING" title="mein XING Profil" />';
				break;
			// EN	
			case 11:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/10_en_btn.gif" width="85" height="23"  alt="XING" title="my XING Profile" />';
				break;
			case 12:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/11_en_btn.gif" width="118" height="23" alt="XING" title="my XING Profile" />';
				break;
			case 13:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/12_en_btn.gif" width="99" height="23"  alt="XING" title="my XING Profile" />';
				break;
			case 14:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/13_en_btn.gif" width="118" height="23" alt="XING" title="my XING Profile" />';
				break;
			case 15:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/14_en_btn.gif" width="80" height="15"  alt="XING" title="my XING Profile" />';
				break;
			case 16:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/15_en_btn.gif" width="99" height="23"  alt="XING" title="my XING Profile" />';
				break;
			// FR	
			case 17:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/40_fr_btn.gif" width="118" height="23" alt="XING" title="Mon profil XING" />';
				break;
			case 18:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/41_fr_btn.gif" width="118" height="23" alt="XING" title="Mon profil XING" />';
				break;
			case 19:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/42_fr_btn.gif" width="118" height="23" alt="XING" title="Mon profil XING" />';
				break;
			case 20:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/43_fr_btn.gif" width="139" height="23" alt="XING" title="Mon profil XING" />';
				break;
			case 21:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/44_fr_btn.gif" width="118" height="23" alt="XING" title="Mon profil XING" />';
				break;
			case 22:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/45_fr_btn.gif" width="74"  height="14" alt="XING" title="Mon profil XING" />';
				break;
			case 23:
   				$xing_images = '<img src="http://www.xing.com/img/buttons/46_fr_btn.gif" width="118" height="23" alt="XING" title="Mon profil XING" />';
				break;
            // PL	
            case 24:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/86_pl_btn.gif" width="94"  height="24" alt="XING" title="Mój XING" />';
            	break;
            case 25:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/87_pl_btn.gif" width="115" height="23" alt="XING" title="Mój XING" />';
            	break;
            case 26:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/88_pl_btn.gif" width="100" height="23" alt="XING" title="Mój XING" />';
            	break;
            case 27:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/89_pl_btn.gif" width="126" height="23" alt="XING" title="Mój XING" />';
            	break;
            case 28:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/90_pl_btn.gif" width="167" height="23" alt="XING" title="Mój XING" />';
            	break;
            case 29:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/91_pl_btn.gif" width="160" height="24" alt="XING" title="Mój XING" />';
            	break;
            case 30:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/92_pl_btn.gif" width="74"  height="14" alt="XING" title="Mój XING" />';
            	break;
            case 31:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/93_pl_btn.gif" width="130" height="24" alt="XING" title="Mój XING" />';
            	break;
            // SV	
            case 41:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/109_sv_btn.gif" width="100" height="23" alt="XING" title="Mitt XING" />';
            	break;
            case 42:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/110_sv_btn.gif" width="119" height="23" alt="XING" title="Mitt XING" />';
            	break;
            case 43:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/111_sv_btn.gif" width="126" height="23" alt="XING" title="Mitt XING" />';
            	break;
            case 44:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/112_sv_btn.gif" width="126" height="23" alt="XING" title="Mitt XING" />';
            	break;
            case 45:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/113_sv_btn.gif" width="151" height="23" alt="XING" title="Mitt XING" />';
            	break;
            case 46:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/114_sv_btn.gif" width="133" height="24" alt="XING" title="Mitt XING" />';
            	break;
            case 47:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/115_sv_btn.gif" width="75" height="14" alt="XING"  title="Mitt XING" />';
            	break;
            case 48:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/116_sv_btn.gif" width="112" height="24" alt="XING" title="Mitt XING" />';
            	break;
            // JP
            case 62:
           		$xing_images = '<img src="http://www.xing.com/img/bittons/62_ja_btn.gif" width="93"  height="23" alt="XING" title="My XING" />';
            	break;
            case 63:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/63_ja_btn.gif" width="149" height="23" alt="XING" title="My XING" />';
            	break;
            case 64:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/64_ja_btn.gif" width="160" height="23" alt="XING" title="My XING" />';
            	break;
            case 65:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/65_ja_btn.gif" width="115" height="23" alt="XING" title="My XING" />';
            	break;
            case 66:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/66_ja_btn.gif" width="157" height="23" alt="XING" title="My XING" />';
            	break;
            case 67:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/67_ja_btn.gif" width="130" height="23" alt="XING" title="My XING" />';
            	break;
            case 68:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/68_ja_btn.gif" width="100" height="14" alt="XING" title="My XING" />';
            	break;
            case 69:
           		$xing_images = '<img src="http://www.xing.com/img/buttons/69_ja_btn.gif" width="149" height="23" alt="XING" title="My XING" />';
            	break;
            case 999: // Company Button
           		$xing_images = '<img src="http://www.xing.com/img/xing/xe/corporate_pages/cp_button.png" width="98" height="23" alt="XING" title="Company" />';
            	break;
			default:
				break;
		}

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
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), (strlen($this->Input->get('state')) ? '' : 1));
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

		return '<a href="'.$this->addToUrl($href.'&amp;id='.$this->Input->get('id')).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
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
			$this->redirect('typolight/main.php?act=error');
        }
		// Update database
		$this->Database->prepare("UPDATE tl_xing SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
	}
}

?>