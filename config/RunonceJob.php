<?php @error_reporting(0); @ini_set("display_errors", 0);  

if (version_compare(VERSION . '.' . BUILD, '2.8.9', '>'))
{
	try { $objDatabase = Database::getInstance(); } catch (Exception $e) { $errors[] = $e->getMessage(); }		
	try { $objDatabase->listTables(); } catch (Exception $e) { $errors[] = $e->getMessage(); }
	
	$migration = false;
	$addTemplate = false;
	
	if ($objDatabase->tableExists('tl_xing_category')) 
	{
		if ($objDatabase->fieldExists('xingtemplate', 'tl_xing_category') 
		&& !$objDatabase->fieldExists('xing_template', 'tl_module'))
		{
			//Migration mit Neufeldanlegung
			//Feld anlegen
			try { $objDatabase->execute("ALTER TABLE `tl_module` ADD `xing_template` varchar(32) NOT NULL default ''"); } catch (Exception $e) { $errors[] = $e->getMessage(); }
			$addTemplate = true;
			//Feld versuchen zu fuellen, macht der naechste Abschnitt
		}
		
		if ( ($objDatabase->fieldExists('xingtemplate', 'tl_xing_category') 
		   && $objDatabase->fieldExists('xing_template', 'tl_module')) || $addTemplate === true)
		{
			//Test ob Feld in allen Xing Modulen leer
			try { $objTemplates = $objDatabase->execute("SELECT count(xing_template) AS ANZ FROM tl_module WHERE xing_template !=''"); } catch (Exception $e) { $errors[] = $e->getMessage(); }
			while ($objTemplates->next())
			{
				if ($objTemplates->ANZ > 0) {
					$migration = false;
				} else {
					//nicht gefuellt
					$migration = true;
				}
			}
			
			if ($migration == true) {
				//Feld versuchen zu fuellen
				try { $objXingTemplatesNew = $objDatabase->execute("SELECT `id`, `name` , `xing_categories` FROM `tl_module` WHERE `type`='xinglist'"); } catch (Exception $e) { $errors[] = $e->getMessage(); }
				while ($objXingTemplatesNew->next())
				{
					if (strpos($objXingTemplatesNew->xing_categories,':') !== false) 
					{
						$arrKat = deserialize($objXingTemplatesNew->xing_categories,true);
					} else {
						$arrKat = array($objXingTemplatesNew->xing_categories);
					}
					if (count($arrKat) == 1 && (int)$arrKat[0] >0) { //nicht NULL
						//eine eindeutige Zuordnung, kann eindeutig migriert werden
						try { $objTemplatesOld = $objDatabase->execute("SELECT `id`, `title`, `xingtemplate` FROM `tl_xing_category` WHERE id =".$arrKat[0].""); } catch (Exception $e) { $errors[] = $e->getMessage(); }
						while ($objTemplatesOld->next())
						{
							try { $objDatabase->prepare("UPDATE tl_module SET xing_template=? WHERE id=?")->execute($objTemplatesOld->xingtemplate, $objXingTemplatesNew->id); } catch (Exception $e) { $errors[] = $e->getMessage(); }
							//Protokoll
							$strText = 'XING-Module "'.$objXingTemplatesNew->name.'" has been migrated';
							try { $objDatabase->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'BE', 'CONFIGURATION', '', specialchars($strText), 'XING-Modul Template Migration', '127.0.0.1', 'NoBrowser'); } catch (Exception $e) { $errors[] = $e->getMessage(); }
						}
					} elseif (count($arrKat) > 1) {
						try { $objTemplatesOld = $objDatabase->execute("SELECT `id`, `title`, `xingtemplate` FROM `tl_xing_category` WHERE id =".$arrKat[0].""); } catch (Exception $e) { $errors[] = $e->getMessage(); }
						while ($objTemplatesOld->next())
						{
							//Protokoll
							$strText = 'XING-Module "'.$objXingTemplatesNew->name.'" could not be migrated';
							try { $objDatabase->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'BE', 'ERROR', '', specialchars($strText), 'XING-Modul Template Migration', '127.0.0.1', 'NoBrowser'); } catch (Exception $e) { $errors[] = $e->getMessage(); }
						}
					}
				}
			}
		}
	}
} else {
	$objDatabase = Database::getInstance();
	try { $objDatabase->prepare("INSERT INTO tl_log (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")->execute(time(), 'FE', 'ERROR', ($GLOBALS['TL_USERNAME'] ? $GLOBALS['TL_USERNAME'] : ''), 'ERROR: XING-Module requires at least Contao 2.9', 'ModulXing Runonce', '127.0.0.1', 'NoBrowser'); } catch (Exception $e) { $errors[] = $e->getMessage(); }
}

?>