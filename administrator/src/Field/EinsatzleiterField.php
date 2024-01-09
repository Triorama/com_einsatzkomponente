<?php

/**
 * @version     3.15.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2017 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */

namespace EikoNamespace\Component\Einsatzkomponente\Administrator\Field;

defined('JPATH_BASE') or die;

use Joomla\CMS\Form\FormField;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormHelper;

/**
 * Supports an HTML select list of categories
 */
class EinsatzleiterField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Einsatzleiter';
	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();
		$address = array();



		$db = Factory::getDBO();
		$query = 'SELECT id, boss as title FROM #__eiko_einsatzberichte WHERE state="1" GROUP BY boss ORDER BY boss';
		$db->setQuery($query);
		$arrayDb = $db->loadObjectList();

		$html[] = '<input class="control-label" type="text"  name="' . $this->name . '"  id="' . $this->id . '"  value="' . $this->value . '" size="' . $this->size . '" />';

		if (count($arrayDb)) :
			$array[] = JHTML::_('select.option', '', 'Einsatzleiter auswählen', 'title', 'title');
			$array = array_merge($array, $arrayDb);
			$html[] .= '<br/><br/>' . JHTML::_('select.genericlist', $array, "boss", 'onchange="changeText_einsatzleiter()" ', 'title', 'title', '0');

			$html[] .= '<script type="text/javascript">
function changeText_einsatzleiter(){
    var userInput1 = document.getElementById("boss").value;
	document.getElementById("' . $this->id . '").value = userInput1;
}
</script>';
		endif;

		return implode($html);
	}
}