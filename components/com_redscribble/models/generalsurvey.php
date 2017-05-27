<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Redscribble
 * @author     sugar lead <anjakahuy@gmail.com>
 * @copyright  2017 sugar lead
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

use Joomla\Utilities\ArrayHelper;

/**
 * Redscribble model.
 *
 * @since  1.6
 */
class RedscribbleModelGeneralsurvey extends JModelItem
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return void
	 *
	 * @since    1.6
	 *
	 */
	protected function populateState()
	{
		$app  = JFactory::getApplication('com_redscribble');
		$user = JFactory::getUser();

		// Check published state
		if ((!$user->authorise('core.edit.state', 'com_redscribble')) && (!$user->authorise('core.edit', 'com_redscribble')))
		{
			$this->setState('filter.published', 1);
			$this->setState('filter.archived', 2);
		}

		// Load state from the request userState on edit or from the passed variable on default
		if (JFactory::getApplication()->input->get('layout') == 'edit')
		{
			$id = JFactory::getApplication()->getUserState('com_redscribble.edit.generalsurvey.id');
		}
		else
		{
			$id = JFactory::getApplication()->input->get('id');
			JFactory::getApplication()->setUserState('com_redscribble.edit.generalsurvey.id', $id);
		}

		$this->setState('generalsurvey.id', $id);

		// Load the parameters.
		$params       = $app->getParams();
		$params_array = $params->toArray();

		if (isset($params_array['item_id']))
		{
			$this->setState('generalsurvey.id', $params_array['item_id']);
		}

		$this->setState('params', $params);
	}

	/**
	 * Method to get an object.
	 *
	 * @param   integer $id The id of the object to get.
	 *
	 * @return  mixed    Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('generalsurvey.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if (isset($table->state) && $table->state != $published)
					{
						throw new Exception(JText::_('COM_REDSCRIBBLE_ITEM_NOT_LOADED'), 403);
					}
				}

				// Convert the JTable to a clean JObject.
				$properties  = $table->getProperties(1);
				$this->_item = ArrayHelper::toObject($properties, 'JObject');
			}
		}

		if (isset($this->_item->created_by) )
		{
			$this->_item->created_by_name = JFactory::getUser($this->_item->created_by)->name;
		}if (isset($this->_item->modified_by) )
		{
			$this->_item->modified_by_name = JFactory::getUser($this->_item->modified_by)->name;
		}

			if (isset($this->_item->client) && $this->_item->client != '') {
				if (is_object($this->_item->client))
				{
					$this->_item->client = ArrayHelper::fromObject($this->_item->client);
				}

				$values = (is_array($this->_item->client)) ? $this->_item->client : explode(',',$this->_item->client);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = "SELECT id, client_name FROM #__redscribble_clients WHERE state = 1 HAVING id LIKE '" . $value . "'";
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->client_name;
					}
				}

			$this->_item->client = !empty($textValue) ? implode(', ', $textValue) : $this->_item->client;

			}

			if (isset($this->_item->categories) && $this->_item->categories != '') {
				if (is_object($this->_item->categories))
				{
					$this->_item->categories = ArrayHelper::fromObject($this->_item->categories);
				}

				$values = (is_array($this->_item->categories)) ? $this->_item->categories : explode(',',$this->_item->categories);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = "SELECT id, name FROM #__redscribble_categories WHERE state = 1 HAVING id LIKE '" . $value . "'";
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->categories = !empty($textValue) ? implode(', ', $textValue) : $this->_item->categories;

			}

			if (isset($this->_item->types) && $this->_item->types != '') {
				if (is_object($this->_item->types))
				{
					$this->_item->types = ArrayHelper::fromObject($this->_item->types);
				}

				$values = (is_array($this->_item->types)) ? $this->_item->types : explode(',',$this->_item->types);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = "SELECT id, name FROM #__content_types WHERE state = 1 HAVING id LIKE '" . $value . "'";
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->types = !empty($textValue) ? implode(', ', $textValue) : $this->_item->types;

			}

		return $this->_item;
	}

	/**
	 * Get an instance of JTable class
	 *
	 * @param   string $type   Name of the JTable class to get an instance of.
	 * @param   string $prefix Prefix for the table class name. Optional.
	 * @param   array  $config Array of configuration values for the JTable object. Optional.
	 *
	 * @return  JTable|bool JTable if success, false on failure.
	 */
	public function getTable($type = 'Generalsurvey', $prefix = 'RedscribbleTable', $config = array())
	{
		$this->addTablePath(JPATH_ADMINISTRATOR . '/components/com_redscribble/tables');

		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the id of an item by alias
	 *
	 * @param   string $alias Item alias
	 *
	 * @return  mixed
	 */
	public function getItemIdByAlias($alias)
	{
		$table      = $this->getTable();
		$properties = $table->getProperties();
		$result     = null;

		if (key_exists('alias', $properties))
		{
            $table->load(array('alias' => $alias));
            $result = $table->id;
		}

		return $result;
	}

	/**
	 * Method to check in an item.
	 *
	 * @param   integer $id The id of the row to check out.
	 *
	 * @return  boolean True on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int) $this->getState('generalsurvey.id');

		if ($id)
		{
			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
			if (method_exists($table, 'checkin'))
			{
				if (!$table->checkin($id))
				{
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param   integer $id The id of the row to check out.
	 *
	 * @return  boolean True on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int) $this->getState('generalsurvey.id');

		if ($id)
		{
			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
			if (method_exists($table, 'checkout'))
			{
				if (!$table->checkout($user->get('id'), $id))
				{
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Get the name of a category by id
	 *
	 * @param   int $id Category id
	 *
	 * @return  Object|null    Object if success, null in case of failure
	 */
	public function getCategoryName($id)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('title')
			->from('#__categories')
			->where('id = ' . $id);
		$db->setQuery($query);

		return $db->loadObject();
	}

	/**
	 * Publish the element
	 *
	 * @param   int $id    Item id
	 * @param   int $state Publish state
	 *
	 * @return  boolean
	 */
	public function publish($id, $state)
	{
		$table = $this->getTable();
		$table->load($id);
		$table->state = $state;

		return $table->store();
	}

	/**
	 * Method to delete an item
	 *
	 * @param   int $id Element id
	 *
	 * @return  bool
	 */
	public function delete($id)
	{
		$table = $this->getTable();

		return $table->delete($id);
	}

	
}
