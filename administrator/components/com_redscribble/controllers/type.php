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

jimport('joomla.application.component.controllerform');

/**
 * Type controller class.
 *
 * @since  1.6
 */
class RedscribbleControllerType extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'types';
		parent::__construct();
	}
}
