<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2013 Leo Feyer
 *
 * Contao Module "Xing" - DCA Helper Class DCA_module_xing
 *
 * @copyright  Glen Langer 2008..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/gl_xing
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\Xing;

/**
 * DCA Helper Class DCA_module_xing
 *
 * @copyright  Glen Langer 2008..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 *
 */
class DCA_module_xing extends \Backend 
{
	public function getXingTemplates($dc)
	{
	    return $this->getTemplateGroup('mod_xing_list', $dc->activeRecord->pid);
	}  
}

