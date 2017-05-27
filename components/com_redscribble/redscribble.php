<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Redscribble
 * @author     Eddy Nguyen <email@giahuy10.com>
 * @copyright  2017 Eddy Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Redscribble', JPATH_COMPONENT);
JLoader::register('RedscribbleController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Redscribble');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
