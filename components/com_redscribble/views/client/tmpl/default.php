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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_redscribble.' . $this->item->id);

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_redscribble' . $this->item->id))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_CLIENT_NAME'); ?></th>
			<td><?php echo $this->item->client_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_PHYSICAL_ADDRESS'); ?></th>
			<td><?php echo $this->item->physical_address; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_BILLING_ADDRESS'); ?></th>
			<td><?php echo $this->item->billing_address; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_HEAD_OFFICE_PHONE'); ?></th>
			<td><?php echo $this->item->head_office_phone; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_WEBSITE'); ?></th>
			<td><?php echo $this->item->website; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_TYPE'); ?></th>
			<td><?php echo $this->item->type; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_KEY_CONTACT_NAME'); ?></th>
			<td><?php echo $this->item->key_contact_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_KEY_CONTACT_DDI'); ?></th>
			<td><?php echo $this->item->key_contact_ddi; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_KEY_CONTACT_EMAIL'); ?></th>
			<td><?php echo $this->item->key_contact_email; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_REDSCRIBBLE_FORM_LBL_CLIENT_KEY_CONTACT_POSTAL_ADDRESS'); ?></th>
			<td><?php echo $this->item->key_contact_postal_address; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_redscribble&task=client.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_REDSCRIBBLE_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_redscribble.client.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_REDSCRIBBLE_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_REDSCRIBBLE_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_REDSCRIBBLE_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_redscribble&task=client.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_REDSCRIBBLE_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>