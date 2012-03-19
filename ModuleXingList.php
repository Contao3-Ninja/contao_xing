<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * 
 * Modul Xing - Frontend
 *
 * PHP version 5
 * @copyright  Glen Langer 2008..2011
 * @author     Glen Langer
 * @package    Xing
 * @license    GPL
 * @filesource
 */


/**
 * Class ModuleXingList 
 *
 */
class ModuleXingList extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_xing_list';

	/**
	 * Target pages
	 * @var array
	 */
	protected $arrTargets = array();


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### XING LIST ###';
			$objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            if (version_compare(VERSION . '.' . BUILD, '2.8.9', '>'))
			{
			   // Code für Versionen ab 2.9.0
			   $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			}
			else
			{
			   // Code für Versionen < 2.9.0
			   $objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;
			}
			return $objTemplate->parse();
		}

		//alte und neue Art gemeinsam zum Array bringen
		if (strpos($this->xing_categories,':') !== false) 
		{
			$this->xing_categories = deserialize($this->xing_categories, true);
		} else {
			$this->xing_categories = array($this->xing_categories);
		}

		// Return if there are no categories
		if (!is_array($this->xing_categories) || !is_numeric($this->xing_categories[0]))
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		$objXing = $this->Database->prepare("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
		                                  ." FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
		                                  ." WHERE pid IN(" . implode(',', $this->xing_categories) . ")" . (!BE_USER_LOGGED_IN ? " AND published=?" : "") 
		                                  ." ORDER BY title, sorting")
								  ->execute(1);
		if ($objXing->numRows < 1)
		{
			//mod_xing_empty.tpl
			$this->strTemplate = 'mod_xing_empty';
            $this->Template = new FrontendTemplate($this->strTemplate); 
			return;
		}
        
		$arrXing = array();

		while ($objXing->next())
		{
    		switch ($objXing->xinglayout) {
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
               		$xing_images = '<img src="http://www.xing.com/img/buttons/115_sv_btn.gif" width="75" height="14"  alt="XING" title="Mitt XING" />';
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
                // Company Button
                case 999:
           			$xing_images = '<img src="http://www.xing.com/img/xing/xe/corporate_pages/cp_button.png" width="98" height="23" alt="XING" title="Company" />';
            		break;
   				default:
    				break;
    		} // switch
    		if (($this->xing_template != $this->strTemplate) && ($this->xing_template == 'mod_xing_list_company')) {
    			$xing_images = preg_replace('/title="[^"]*"/', 'title="Company"', $xing_images);  
    		}
    		
    		if (version_compare(VERSION . '.' . BUILD, '2.9.9', '>'))
    		{
    			// Contao 2.10
    			global $objPage;
				if ($objPage->outputFormat == 'html5')
				{
					$this->import('String');
					$xing_images = $this->String->toHtml5($xing_images);
					$arrXing[] = array
					(
		                'xingprofil' => trim($objXing->xingprofil),
						'xinglayout' => $xing_images,
						'xingtarget' => ($objXing->xingtarget == '1') ? '' : ' target="_blank"'
					);
				} else {
					$arrXing[] = array
					(
		                'xingprofil' => trim($objXing->xingprofil),
						'xinglayout' => $xing_images,
						'xingtarget' => ($objXing->xingtarget == '1') ? LINK_BLUR : LINK_NEW_WINDOW
					);
				}
    		} else {
    			// Contao 2.9
    			$arrXing[] = array
				(
	                'xingprofil' => trim($objXing->xingprofil),
					'xinglayout' => $xing_images,
					'xingtarget' => ($objXing->xingtarget == '1') ? LINK_BLUR : LINK_NEW_WINDOW
				);
    		}
		} // while
		if (($this->xing_template != $this->strTemplate) && ($this->xing_template != '')) {
	        $this->strTemplate = $this->xing_template;
	        $this->Template = new FrontendTemplate($this->strTemplate); 
		}
		$this->Template->category = $objXing->title;
		$this->Template->xing = $arrXing;
	} // compile
} // class

?>