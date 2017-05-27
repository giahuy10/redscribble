<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_stats
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_redscribble/models', 'RedscribbleModel');
$model = JModelLegacy::getInstance('Types', 'RedscribbleModel', array('ignore_request' => true));
$appParams = JFactory::getApplication()->getParams();
$model->setState('params', $appParams);
$types = $model->getItems();

foreach ($types as $type) {
?>
	<div id="type-item-<?php echo $type->id?>" class="type-item" onclick="open_des(<?php echo $type->id?>)">
		<div class="type-item-inner">
			<h3><?php echo $type->name?></h3>
			<img src="images/<?php echo $type->intro_img?>"/>
		</div>
		<div id="type-description-<?php echo $type->id?>" class="type-description ">
			
			<div class="inner-type-description row-fluid">
				<div class="span3 text-center type-icon">
					
					<img class="symbol-type" src="images/<?php echo $type->icon?>"/>
					<h3><?php echo $type->name?></h3>
				</div>
				<div class="span6">
					<?php echo $type->group_name?><br/>
					<?php echo $type->name?>
					<br/>
					<br/>
					<?php echo $type->description?>
				</div>
				<div class="span3 logo">
					<img src="images/logo.png"/>
				</div>
			</div>	
			
		</div>	
	</div>
<?php }?>
<div class="bottom-line">
 Local team. Global reach. Focused delivery
</div>
<div class="clearfix"></div>
<script>
	
	function open_des(i) {
		
		jQuery(function($) {
			$(".type-description").hide();
			$("#type-description-"+i).toggle();
		 });	
	}
</script>

