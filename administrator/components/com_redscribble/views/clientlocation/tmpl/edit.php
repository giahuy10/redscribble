<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Redscribble
 * @author     sugar lead <anjakahuy@gmail.com>
 * @copyright  2017 sugar lead
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_redscribble/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.client').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('clienthidden')){
			js('#jform_client option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_client").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'clientlocation.cancel') {
			Joomla.submitform(task, document.getElementById('clientlocation-form'));
		}
		else {
			
			if (task != 'clientlocation.cancel' && document.formvalidator.isValid(document.id('clientlocation-form'))) {
				
				Joomla.submitform(task, document.getElementById('clientlocation-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_redscribble&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="clientlocation-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_REDSCRIBBLE_TITLE_CLIENTLOCATION', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
				<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->renderField('created_by'); ?>
				<?php echo $this->form->renderField('modified_by'); ?>				<?php echo $this->form->renderField('name'); ?>
				<?php echo $this->form->renderField('client'); ?>

			<?php
				foreach((array)$this->item->client as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="client" name="jform[clienthidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('physical_address'); ?>
				<?php echo $this->form->renderField('office_phone'); ?>
				<?php echo $this->form->renderField('website'); ?>
				<?php echo $this->form->renderField('key_contact_name'); ?>
				<?php echo $this->form->renderField('key_contact_ddi'); ?>
				<?php echo $this->form->renderField('key_contact_email'); ?>
				<?php echo $this->form->renderField('key_contact_postal_address'); ?>


					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if (JFactory::getUser()->authorise('core.admin','redscribble')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
