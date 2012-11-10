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
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\Xing;

/**
 * Class XingImage 
 *
 */
class XingImage
{
    protected $image_file  = '';
    protected $image_size  = 'width="0" height="0"';
    protected $image_titel = '';

	/**
	 * get Image Link
	 */
	public function getXingImageLink($xinglayout)
	{
    	switch ($xinglayout) 
    	{
    		case 1:
    			$this->image_file  = '1_de_btn.gif';
    			$this->image_size  = 'width="85" height="23"';
    			$this->image_titel = 'mein XING Profil';
    			break;
    		case 2:
    			$this->image_file  = '2_de_btn.gif';
    			$this->image_size  = 'width="118" height="23"';
    			$this->image_titel = 'mein XING Profil';
    			break;
    		case 3:
    		    $this->image_file  = '3_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 4:
    		    $this->image_file  = '4_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 5:
    		    $this->image_file  = '5_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 6:
    		    $this->image_file  = '6_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 7:
    		    $this->image_file  = '7_de_btn.gif';
    		    $this->image_size  = 'width="139" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 8:
    		    $this->image_file  = '8_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 9:
    		    $this->image_file  = '9_de_btn.gif';
    		    $this->image_size  = 'width="80" height="15"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		case 10:
    		    $this->image_file  = '16_de_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'mein XING Profil';
    			break;
    		// EN	
    		case 11:
    		    $this->image_file  = '10_en_btn.gif';
    		    $this->image_size  = 'width="85" height="23"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		case 12:
    		    $this->image_file  = '11_en_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		case 13:
    		    $this->image_file  = '12_en_btn.gif';
    		    $this->image_size  = 'width="99" height="23"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		case 14:
    		    $this->image_file  = '13_en_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		case 15:
    		    $this->image_file  = '14_en_btn.gif';
    		    $this->image_size  = 'width="80" height="15"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		case 16:
    		    $this->image_file  = '15_en_btn.gif';
    		    $this->image_size  = 'width="99" height="23"';
    		    $this->image_titel = 'my XING Profile';
    			break;
    		// FR	
    		case 17:
    		    $this->image_file  = '40_fr_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 18:
    		    $this->image_file  = '41_fr_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 19:
    		    $this->image_file  = '42_fr_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 20:
    		    $this->image_file  = '43_fr_btn.gif';
    		    $this->image_size  = 'width="139" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 21:
    		    $this->image_file  = '44_fr_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 22:
    		    $this->image_file  = '45_fr_btn.gif';
    		    $this->image_size  = 'width="74" height="14"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
    		case 23:
    		    $this->image_file  = '46_fr_btn.gif';
    		    $this->image_size  = 'width="118" height="23"';
    		    $this->image_titel = 'Mon profil XING';
    			break;
            // PL	
            case 24:
                $this->image_file  = '86_pl_btn.gif';
                $this->image_size  = 'width="94" height="24"';
                $this->image_titel = 'Mój XING';
            	break;
            case 25:
                $this->image_file  = '87_pl_btn.gif';
                $this->image_size  = 'width="115" height="23"';
                $this->image_titel = 'Mój XING';
            	break;
            case 26:
                $this->image_file  = '88_pl_btn.gif';
                $this->image_size  = 'width="100" height="23"';
                $this->image_titel = 'Mój XING';
            	break;
            case 27:
                $this->image_file  = '89_pl_btn.gif';
                $this->image_size  = 'width="126" height="23"';
                $this->image_titel = 'Mój XING';
            	break;
            case 28:
                $this->image_file  = '90_pl_btn.gif';
                $this->image_size  = 'width="167" height="23"';
                $this->image_titel = 'Mój XING';
            	break;
            case 29:
                $this->image_file  = '91_pl_btn.gif';
                $this->image_size  = 'width="160" height="24"';
                $this->image_titel = 'Mój XING';
            	break;
            case 30:
                $this->image_file  = '92_pl_btn.gif';
                $this->image_size  = 'width="74" height="14"';
                $this->image_titel = 'Mój XING';
            	break;
            case 31:
                $this->image_file  = '93_pl_btn.gif';
                $this->image_size  = 'width="130" height="24"';
                $this->image_titel = 'Mój XING';
            	break;
            // SV	
            case 41:
                $this->image_file  = '109_sv_btn.gif';
                $this->image_size  = 'width="100" height="23"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 42:
                $this->image_file  = '110_sv_btn.gif';
                $this->image_size  = 'width="119" height="23"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 43:
                $this->image_file  = '111_sv_btn.gif';
                $this->image_size  = 'width="126" height="23"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 44:
                $this->image_file  = '112_sv_btn.gif';
                $this->image_size  = 'width="126" height="23"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 45:
                $this->image_file  = '113_sv_btn.gif';
                $this->image_size  = 'width="151" height="23"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 46:
                $this->image_file  = '114_sv_btn.gif';
                $this->image_size  = 'width="133" height="24"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 47:
                $this->image_file  = '115_sv_btn.gif';
                $this->image_size  = 'width="75" height="14"';
                $this->image_titel = 'Mitt XING';
            	break;
            case 48:
                $this->image_file  = '116_sv_btn.gif';
                $this->image_size  = 'width="116" height="24"';
                $this->image_titel = 'Mitt XING';
            	break;
            // JP
            case 62:
                $this->image_file  = '62_ja_btn.gif';
                $this->image_size  = 'width="93" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 63:
                $this->image_file  = '63_ja_btn.gif';
                $this->image_size  = 'width="149" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 64:
                $this->image_file  = '64_ja_btn.gif';
                $this->image_size  = 'width="160" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 65:
                $this->image_file  = '65_ja_btn.gif';
                $this->image_size  = 'width="115" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 66:
                $this->image_file  = '66_ja_btn.gif';
                $this->image_size  = 'width="157" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 67:
                $this->image_file  = '67_ja_btn.gif';
                $this->image_size  = 'width="130" height="23"';
                $this->image_titel = 'My XING';
            	break;
            case 68:
                $this->image_file  = '68_ja_btn.gif';
                $this->image_size  = 'width="100" height="14"';
                $this->image_titel = 'My XING';
            	break;
            case 69:
                $this->image_file  = '69_ja_btn.gif';
                $this->image_size  = 'width="149" height="23"';
                $this->image_titel = 'My XING';
            	break;
        	// PT
        	case 71:
        	    $this->image_file  = '94_pt_btn.gif';
        	    $this->image_size  = 'width="118" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 72:
        	    $this->image_file  = '95_pt_btn.gif';
        	    $this->image_size  = 'width="118" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 73:
        	    $this->image_file  = '96_pt_btn.gif';
        	    $this->image_size  = 'width="118" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 74:
        	    $this->image_file  = '97_pt_btn.gif';
        	    $this->image_size  = 'width="139" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 75:
        	    $this->image_file  = '98_pt_btn.gif';
        	    $this->image_size  = 'width="118" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 76:
        	    $this->image_file  = '99_pt_btn.gif';
        	    $this->image_size  = 'width="80" height="15"';
        	    $this->image_titel = 'Meu XING';
        	    break;
        	case 77:
        	    $this->image_file  = '100_pt_btn.gif';
        	    $this->image_size  = 'width="118" height="23"';
        	    $this->image_titel = 'Meu XING';
        	    break;
            // Company Button
            case 999:
                $this->image_file  = 'cp_button.png';
                $this->image_size  = 'width="98" height="23"';
                $this->image_titel = 'Company';
        		break;
    		default:
    		    $this->image_titel = '404, wrong xing image id';
    			break;
    	} // switch
    	if ($xinglayout < 999) 
    	{
    	    $xing_images = '<img src="http://www.xing.com/img/buttons/'.$this->image_file.'" '.$this->image_size.' alt="XING" title="'.$this->image_titel.'" />';
    	}
    	else
    	{
    	    $xing_images = '<img src="http://www.xing.com/img/xing/xe/corporate_pages/'.$this->image_file.'" '.$this->image_size.' alt="XING" title="'.$this->image_titel.'" />';
    	}
        return $xing_images;
	} // getXingImageLink
	
} // class

