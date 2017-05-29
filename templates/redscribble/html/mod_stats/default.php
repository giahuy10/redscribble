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
	<div id="type-item-<?php echo $type->id?>" class="type-item" >
		
		<div class="type-item-inner inactive" id="type-item-inner-<?php echo $type->id?>" onclick="open_des(<?php echo $type->id?>)">
			<h3><?php echo $type->name?></h3>
			<img src="images/<?php echo $type->intro_img?>" />
		</div>
		<div id="type-description-<?php echo $type->id?>" class="type-description inactive">
			<div class="close-button" onclick="close_des(<?php echo $type->id?>)">X</div>
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
				<div class="span3 text-center">
					<div class="item-logo">
						<img src="images/logo.png"/>
					</div>	
				</div>
			</div>	
			
		</div>	
		
	</div>
<?php }?>

<div id="type-item-inner-1000">
		</div>
		<div id="type-description-1000">
		</div>
<div class="bottom-line pull-left">
 Local team. Global reach. Focused delivery
</div>
<div class="clearfix"></div>
<script>
	
	function open_des(i) {
		
		jQuery(function($) {
			
			
			$(".type-description").removeClass('active');
			$(".type-item-inner").removeClass('active');
			
			
			$("#type-description-"+i).toggleClass('active');
			$("#type-item-inner-"+i).toggleClass('active');
		 });	
	}
	function close_des(i) {
		
		jQuery(function($) {
			

			$("#type-description-"+i).toggleClass('active');
			$("#type-item-inner-"+i).toggleClass('active');
			
			
			
		 });	
	}
</script>

