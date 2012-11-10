<?php   
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * Modul Xing - /config/runonce.php
 *
 * PHP version 5
 * @copyright  Glen Langer 2007..2012
 * @author     Glen Langer
 * @package    Xing
 * @license    GPL
 */

/**
 * Class XingRunonceJob
 *
 * @copyright  Glen Langer 2007..2012
 * @author     Glen Langer
 * @package    Xing
 * @license    GPL
 */
class XingRunonceJob extends Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->import('Database');
	}
	public function run()
	{ 
	    //nur ab Contao 2.9
	    if (version_compare(VERSION, '2.8', '>'))
	    {
	        $migration = false;
	        
	        if ($this->Database->tableExists('tl_xing_category'))
	        {
	            if ($this->Database->fieldExists('xingtemplate', 'tl_xing_category')
	            && !$this->Database->fieldExists('xingtemplate', 'tl_module'))
	            {
	                //Migration mit Neufeldanlegung
	                //Feld anlegen
	                $this->Database->execute("ALTER TABLE `tl_module` ADD `xing_template` varchar(32) NOT NULL default ''");
	            }
	            
	            if ($this->Database->fieldExists('xingtemplate', 'tl_xing_category')
	             && $this->Database->fieldExists('xingtemplate', 'tl_module')) 
	            {
	                $objTemplates = $this->Database->execute("SELECT count(xing_template) AS ANZ FROM tl_module WHERE xing_template !=''");
	                while ($objTemplates->next())
	                {
	                    if ($objTemplates->ANZ > 0) {
	                        $migration = false;
	                    } 
	                    else 
	                    {
	                        //nicht gefuellt
	                        $migration = true;
	                    }
	                }
	                
	                if ($migration == true) 
	                {
	                    //Feld versuchen zu fuellen
	                    $objXingTemplatesNew = $this->Database->execute("SELECT `id`, `name` , `xing_categories` FROM `tl_module` WHERE `type`='xinglist'");
	                    while ($objXingTemplatesNew->next())
	                    {
	                        if (strpos($objXingTemplatesNew->xing_categories,':') !== false)
	                        {
	                            $arrKat = deserialize($objXingTemplatesNew->xing_categories,true);
	                        } 
	                        else 
	                        {
	                            $arrKat = array($objXingTemplatesNew->xing_categories);
	                        }
	                        if (count($arrKat) == 1 && (int)$arrKat[0] >0) 
	                        { 
	                            //nicht NULL
	                            //eine eindeutige Zuordnung, kann eindeutig migriert werden
	                            $objTemplatesOld = $this->Database->execute("SELECT `id`, `title`, `xingtemplate` FROM `tl_xing_category` WHERE id =".$arrKat[0]."");
	                            while ($objTemplatesOld->next())
	                            {
	                                $this->Database->prepare("UPDATE tl_module SET xing_template=? WHERE id=?")->execute($objTemplatesOld->xingtemplate, $objXingTemplatesNew->id);
	                                //Protokoll
	                                $strText = 'XING-Module "'.$objXingTemplatesNew->name.'" has been migrated';
	                                $this->Database->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'BE', 'CONFIGURATION', '', specialchars($strText), 'XING-Modul Template Migration', '127.0.0.1', 'NoBrowser');
	                            }
	                        } 
	                        elseif (count($arrKat) > 1) 
	                        {
	                            $objTemplatesOld = $this->Database->execute("SELECT `id`, `title`, `xingtemplate` FROM `tl_xing_category` WHERE id =".$arrKat[0]."");
	                            while ($objTemplatesOld->next())
	                            {
	                                //Protokoll
	                                $strText = 'XING-Module "'.$objXingTemplatesNew->name.'" could not be migrated';
	                                $this->Database->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'BE', 'ERROR', '', specialchars($strText), 'XING-Modul Template Migration', '127.0.0.1', 'NoBrowser');
	                            }
	                        }
	                    }//while
	                }//migration true
	            }
            }
	    }//ab 2.9
	    else
	    {
	        $this->Database->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'FE', 'ERROR', ($GLOBALS['TL_USERNAME'] ? $GLOBALS['TL_USERNAME'] : ''), 'ERROR: Xing-Module requires at least Contao 2.9', 'ModulXing Runonce', '127.0.0.1', 'NoBrowser');
	    }
	}//run
}//class


$objXingRunonceJob = new XingRunonceJob();
$objXingRunonceJob->run();

?>