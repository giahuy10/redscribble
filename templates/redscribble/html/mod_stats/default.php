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
		
		<div class="type-item-inner inactive" id="type-item-inner-<?php echo $type->id?>" data-toggle="modal" data-target="#myModal<?php echo $type->id?>">
			<h3><?php echo $type->name?></h3>
			<img src="images/<?php echo $type->intro_img?>" />
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal<?php echo $type->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $type->id?>">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			 
			  <div class="modal-body">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				
					
					<img class="symbol-type pull-left" src="images/<?php echo $type->icon?>"/>
				
					<?php echo $type->group_name?><br/>
					<?php echo $type->name?>
				<div class="description-content">
					
					<br/>
					<br/>
					<?php echo $type->description?>
				</div>
				<div class="pull-right">
					<div class="item-logo">
						<img src="images/logo.png"/>
					</div>	
				</div>
			
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
	/*
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
	}*/
</script>

