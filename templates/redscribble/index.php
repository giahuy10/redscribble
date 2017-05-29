<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));




// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array( 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = 'span6';
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = 'span9';
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = 'span9';
}
else
{
	$span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction === 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
	<div class="body" id="top">
	
			<!-- Header -->
			<header class="header" role="banner">
				
					<div class="container-inner">
					<div class="header-inner clearfix row-fluid">
							<div class="logo span3">
								<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
									<?php echo $logo; ?>
									<?php if ($this->params->get('sitedescription')) : ?>
										<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
									<?php endif; ?>
								</a>
								
							</div>
							<div class="main-menu span9">
							<?php if ($this->countModules('position-0')) : ?>
							
								<nav class="navigation" role="navigation">
									<div class="navbar pull-right">
										<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
									
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</a>
									</div>
									<div class="nav-collapse">
										<jdoc:include type="modules" name="position-0" style="none" />
									</div>
								</nav>
							<?php endif; ?>
							</div>
					</div>
					</div>
				
			</header>
			<?php if ($itemid == 101) {?>
			<div class="mainbanner-vid">
				<div id="video-background">
					<jdoc:include type="modules" name="banner" style="none" />
				</div>
				<div class="container bannercontent">
					<jdoc:include type="modules" name="bannercontent" style="none" />
					
				  </div>
				<div class="text-center down-scroll"> 
					<a class="jumper scroll-down"><img src="images/down-icon.png" alt="down-arrow" class="down-banner i5"></a> 
				</div>
			</div>	
			<?php } else {?>
				<div id="inner-banner">
					<jdoc:include type="modules" name="banner" style="none" />
					<div class="container inner-content">
					<jdoc:include type="modules" name="bannercontent" style="none" />
					
				  </div>
				</div>
				
			<?php }?>
			<div id="main">
				<div class="">
					<div class="row-fluid">
						<?php if ($this->countModules('position-8')) : ?>
							<!-- Begin Sidebar -->
							<div id="sidebar" class="span3">
								<div class="sidebar-nav">
									<jdoc:include type="modules" name="position-8" style="xhtml" />
								</div>
							</div>
							<!-- End Sidebar -->
						<?php endif; ?>
						<main id="content" role="main" class="<?php echo $span; ?>">
							<!-- Begin Content -->
							<jdoc:include type="modules" name="position-3" style="xhtml" />
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="position-2" style="none" />
							<!-- End Content -->
						</main>
						<?php if ($this->countModules('position-7')) : ?>
							<div id="aside" class="span3">
								<!-- Begin Right Sidebar -->
								<jdoc:include type="modules" name="position-7" style="well" />
								<!-- End Right Sidebar -->
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>	
	</div>
	
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?> text-center">
			<div class="container-inner">
				<p>Red Scribble Consultants - PO Box 153, Paraparaumu 5254, Wellington, New Zealand</p>
				<div class="row-fluid">
				<div class="span2"></div>
				<div class="span4"><p>T. + 64 4 974 0552</p></div>
				<div class="span4"><p>E. info@redscribble.com</p></div>
				<div class="span2"></div>
				</div>
			</div>	
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91001085-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
