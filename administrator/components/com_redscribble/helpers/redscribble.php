<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Redscribble
 * @author     Eddy Nguyen <email@giahuy10.com>
 * @copyright  2017 Eddy Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Redscribble helper.
 *
 * @since  1.6
 */
class RedscribbleHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_CLIENTS'),
			'index.php?option=com_redscribble&view=clients',
			$vName == 'clients'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_CLIENTLOCATIONS'),
			'index.php?option=com_redscribble&view=clientlocations',
			$vName == 'clientlocations'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_DOCUMENTS'),
			'index.php?option=com_redscribble&view=documents',
			$vName == 'documents'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_CATEGORIES'),
			'index.php?option=com_redscribble&view=categories',
			$vName == 'categories'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_TYPES'),
			'index.php?option=com_redscribble&view=types',
			$vName == 'types'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REDSCRIBBLE_TITLE_GENERALSURVEYS'),
			'index.php?option=com_redscribble&view=generalsurveys',
			$vName == 'generalsurveys'
		);
		
		

	}

	/**
	 * Gets the files attached to an item
	 *
	 * @param   int     $pk     The item's id
	 *
	 * @param   string  $table  The table's name
	 *
	 * @param   string  $field  The field's name
	 *
	 * @return  array  The files
	 */
	public static function getFiles($pk, $table, $field)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($field)
			->from($table)
			->where('id = ' . (int) $pk);

		$db->setQuery($query);

		return explode(',', $db->loadResult());
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_redscribble';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}

