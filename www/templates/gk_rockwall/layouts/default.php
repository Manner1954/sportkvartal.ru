<?php

/**
 *
 * Default view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2013 - 2014 Manner. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;
//
$app = JFactory::getApplication();
$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// getting params
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
// defines if com_users
define('GK_COM_USERS', $option == 'com_users' && ($view == 'login' || $view == 'registration'));
// other variables
$btn_login_text = ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : JText::_('TPL_GK_LANG_LOGOUT');
$tpl_page_suffix = $this->page_suffix != '' ? ' class="'.$this->page_suffix.'"' : '';
// make sure that the modal will be loaded
JHTML::_('behavior.modal');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->APITPL->language; ?>" <?php echo $tpl_page_suffix; ?>>
<head>
	<?php if(
			$this->browser->get('browser') == 'ie6' || 
			$this->browser->get('browser') == 'ie7' || 
			$this->browser->get('browser') == 'ie8' || 
			$this->browser->get('browser') == 'ie9'
		) : ?>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<?php endif; ?>
	
	<?php if($this->API->get('rwd', 1)) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
	<?php else : ?>
	<meta name="viewport" content="width=<?php echo $this->API->get('template_width', 1020)+80; ?>">
	<?php endif; ?>
	
	<jdoc:include type="head" />
	<?php $this->layout->loadBlock('head'); ?>
	<?php $this->layout->loadBlock('cookielaw'); ?>
</head>
<body<?php echo $tpl_page_suffix; ?><?php if($this->browser->get("tablet") == true) echo ' data-tablet="true"'; ?><?php if($this->browser->get("mobile") == true) echo ' data-mobile="true"'; ?><?php $this->layout->generateLayoutWidths(); ?>>

<div style="margin: 0 auto; width: 100%;"> <!--1340px-->

	<?php if ($this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6') : ?>
	<!--[if lte IE 7]>
		<div id="ieToolbar"><div><?php echo JText::_('TPL_GK_LANG_IE_TOOLBAR'); ?></div></div>
	<![endif]-->
	<?php endif; ?>
	
	<?php if(count($app->getMessageQueue())) : ?>
	<jdoc:include type="message" />
	<?php endif; ?>
	
	<div id="gkTop"<?php if(!$this->API->modules('header')) : ?> class="noheader"<?php endif; ?>>
		
			<?php
				echo "<div class=\"-imageheadindex\">";
					echo "<div class=\"gkPage\">";
				if (!$this->layout->isFrontpage()) {
					echo "<div class=\"custom-imageheadindex\">";
				}
				else{
					echo "<div class=\"custom-imageheadindex-blank\">";
				}
			?>
				<?php $this->layout->loadBlock('logo'); ?>
				
				<?php if($this->API->modules('header')) : ?>
					<div id="gkHeader">
						<jdoc:include type="modules" name="header" style="<?php echo $this->module_styles['header']; ?>" />
					</div>
				<?php endif; ?>

				<?php if($this->API->modules('login')) : ?>
					<div id="gkLogin">
						<jdoc:include type="modules" name="login" style="<?php echo $this->module_styles['login']; ?>" />
					</div>
				<?php endif; ?>

				<?php if($this->API->modules('search')) : ?>
				<div id="gkSearch">
					<jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
				</div>
				<?php endif; ?>
				
				<?php if($this->API->modules('topmenu')) : ?>
				<div id="gkTopMenu">
					<jdoc:include type="modules" name="topmenu" style="<?php echo $this->module_styles['topmenu']; ?>" />
				</div>
				<?php endif; ?>

				<!--[if IE 8]>
					<div class="ie8clear"></div>
				<![endif]-->
				<?php echo "</div>"; ?>

			<?php echo "</div>"; ?>
		</div>
	</div>
	
	<div id="gkMenuWrapper">
		<div class="gkPage">
			<?php if($this->API->get('show_menu', 1)) : ?>
			<div id="gkMainMenu" class="gkPage">				
					<?php
	    	    		$this->mainmenu->loadMenu($this->API->get('menu_name','mainmenu')); 
	    	    	    $this->mainmenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
	    	    	?>

			</div>
			<?php endif; ?>
			
			<?php if($this->API->get('show_menu', 1)) : ?>
			<div id="gkMobileMenu" class="gkPage">
				<?php echo JText::_('TPL_GK_LANG_MOBILE_MENU'); ?>
				<select onChange="window.location.href=this.value;">
					<?php 
	        		    $this->mobilemenu->loadMenu($this->API->get('menu_name','mainmenu')); 
	        		    $this->mobilemenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
	        		?>
				</select>
			</div>
			<?php endif; ?>
			
			<?php //if(($this->API->get('reg_link') == '1' && $userID == 0) || $this->API->modules('login')) : ?>
			<!--<div id="gkUserArea">
				<?php //if($this->API->modules('login')) : ?>
				<a href="<?php //echo $this->API->get('login_url', 'index.php?option=com_users&view=login'); ?>" id="gkLogin" class="button inverse"><?php //echo ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : JText::_('TPL_GK_LANG_LOGOUT'); ?></a>
				<?php //endif; ?>
						
				<?php //$usersConfig = JComponentHelper::getParams('com_users'); ?>
				<?php //if ($usersConfig->get('allowUserRegistration') && $userID == 0) : ?>
					<a href="<?php //echo JRoute::_('index.php?option=com_users&view=registration'); ?>" id="gkRegister" class="button"> <?php //echo JText::_('TPL_GK_LANG_REGISTER'); ?></a>
				<?php //endif; ?>
			</div>-->
			<?php //endif; ?>
		</div>
	</div>
	
	<div id="gkPageContentWrap"<?php if($this->API->modules('inset and sidebar')) : ?> class="gk3Columns"<?php endif; ?>>
		<?php //if($this->API->modules('header')) : ?>
		<!--<div id="gkHeader" class="gkPage">
			<jdoc:include type="modules" name="header" style="<?php echo $this->module_styles['header']; ?>" />
		</div>
		-->
		<?php //endif; ?>
		<div id="gkPageContent"> <!--class="gkPage"-->
			<section id="gkContent"<?php if($this->API->get('sidebar_position', 'right') == 'left') : ?> class="gkColumnLeft"<?php endif; ?>>
				<div id="gkContentWrap"<?php if($this->API->get('inset_position', 'right') == 'left') : ?> class="gkInsetLeft"<?php endif; ?>>
					<?php if($this->API->modules('top1')) : ?>
					<div id="gkTop1" class="gkCols3<?php if($this->API->modules('top1') == 1) : ?> gkNoMargin<?php endif; ?>">
						<jdoc:include type="modules" name="top1" style="<?php echo $this->module_styles['top1']; ?>"  modnum="<?php echo $this->API->modules('top1'); ?>" modcol="3" />
					</div>
					<?php endif; ?>
					<?php if($this->API->modules('top2')) : ?>
					<div id="gkTop2" class="gkCols3<?php if($this->API->modules('top2') == 1) : ?> gkNoMargin<?php endif; ?>">
						<jdoc:include type="modules" name="top2" style="<?php echo $this->module_styles['top2']; ?>" modnum="<?php echo $this->API->modules('top2'); ?>" modcol="3" />
					</div>
					<?php endif; ?>

					<?php if($this->API->modules('breadcrumb') || $this->getToolsOverride()) : ?>
						<?php
						echo "<div class=\"-imageheaderindex\">";
							if (!$this->layout->isFrontpage()) {
								echo "<div class=\"custom-imageheaderindex gkPage\">";
							}
							else{
								echo "<div class=\"custom-imageheaderindex-blank gkPage\">";
							}
						?>
							<div id="gkBreadcrumb">
								<?php if($this->API->modules('breadcrumb')) : ?>
								<jdoc:include type="modules" name="breadcrumb" style="<?php echo $this->module_styles['breadcrumb']; ?>" />
								<?php endif; ?>
								<?php //if($this->getToolsOverride()) : ?>
								<?php //$this->layout->loadBlock('tools/tools'); ?>
								<?php //endif; ?>
								</jdoc:include>
							</div>
						</div>
					<?php 
					echo "</div>";
					endif; ?>

					<?php if($this->API->modules('mainbody_top')) : ?>
					<div id="gkMainbodyTop"> 
						<jdoc:include type="modules" name="mainbody_top" style="<?php echo $this->module_styles['mainbody_top']; ?>" />
					</div>
					<?php endif; ?>
					<div id="gkMainbody" class="gkMainbodyMarginTop">
						<?php if(($this->layout->isFrontpage() && !$this->API->modules('mainbody')) || !$this->layout->isFrontpage()) : ?>
						<jdoc:include type="component" />
						<?php else : ?>
						<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
						<?php endif; ?>
					</div>
					<?php if($this->API->modules('mainbody_bottom')) : ?>
					<div id="gkMainbodyBottom">
						<jdoc:include type="modules" name="mainbody_bottom" style="<?php echo $this->module_styles['mainbody_bottom']; ?>" />
					</div>
					<?php endif; ?>
				</div>
				<?php if($this->API->modules('inset')) : ?>
				<aside id="gkInset"<?php if($this->API->modules('inset') == 1) : ?> class="gkOnlyOne"<?php endif; ?>>
					<jdoc:include type="modules" name="inset" style="<?php echo $this->module_styles['inset']; ?>" />
				</aside>
				<?php endif; ?>
			</section>
			<?php if($this->API->modules('sidebar')) : ?>
			<aside id="gkSidebar"<?php if($this->API->modules('sidebar') == 1) : ?> class="gkOnlyOne"<?php endif; ?>>
				<jdoc:include type="modules" name="sidebar" style="<?php echo $this->module_styles['sidebar']; ?>" />
			</aside>
			<?php endif; ?>
			
			<!--[if IE 8]>
		    	<div class="ie8clear"></div>
		    <![endif]-->
		</div>
		
		<?php if($this->API->modules('bottom1')) : ?>
		<div id="gkBottom1">
			<div class="gkCols6<?php if($this->API->modules('bottom1') == 1) : ?> gkNoMargin<?php endif; ?>">
				<jdoc:include type="modules" name="bottom1" style="<?php echo $this->module_styles['bottom1']; ?>" modnum="<?php echo $this->API->modules('bottom1'); ?>" />
				
				<!--[if IE 8]>
					<div class="ie8clear"></div>
					<![endif]-->
			</div>
		</div>
		<?php endif; ?>
		
		<?php if($this->API->modules('bottom2')) : ?>
		<div id="gkBottom2" class="gkPage">
			<div class="gkCols6<?php if($this->API->modules('bottom2') == 1) : ?> gkNoMargin<?php endif; ?>">
				<jdoc:include type="modules" name="bottom2" style="<?php echo $this->module_styles['bottom2']; ?>" modnum="<?php echo $this->API->modules('bottom2'); ?>" />
				
				<!--[if IE 8]>
		    		<div class="ie8clear"></div>
		    	<![endif]-->
			</div>
		</div>
		<?php endif; ?>
		
		<?php if($this->API->modules('tags or search_middle')) : ?>
		<div id="gkMiddleBar" class="gkPage">
			<?php if($this->API->modules('tags')) : ?>	
			<div id="gkTags">
				<jdoc:include type="modules" name="tags" style="<?php echo $this->module_styles['tags']; ?>" />
			</div>	
			<?php endif; ?>
			
			<?php if($this->API->modules('search_middle')) : ?>
			<div id="gkSearchMiddle">
				<jdoc:include type="modules" name="search_middle" style="<?php echo $this->module_styles['search_middle']; ?>" />
			</div>
			<?php endif; ?>
			
			<!--[if IE 8]>
				<div class="ie8clear"></div>
			<![endif]-->
		<?php endif; ?>
		</div>
	</div>	
	
	<?php if($this->API->modules('bottom3')) : ?>
	<div id="gkBottom3" class="gkPage">
		<div class="gkCols6<?php if($this->API->modules('bottom3') == 1) : ?> gkNoMargin<?php endif; ?>">
			<jdoc:include type="modules" name="bottom3" style="<?php echo $this->module_styles['bottom3']; ?>" modnum="<?php echo $this->API->modules('bottom3'); ?>" />
			
			<!--[if IE 8]>
	    		<div class="ie8clear"></div>
	    	<![endif]-->
		</div>
	</div>
	<?php endif; ?>
	
	<?php if($this->API->modules('bottom4')) : ?>
	<div id="gkBottom4" class="gkPage">
		<div class="gkCols6<?php if($this->API->modules('bottom4') == 1) : ?> gkNoMargin<?php endif; ?>">
			<jdoc:include type="modules" name="bottom4" style="<?php echo $this->module_styles['bottom4']; ?>" modnum="<?php echo $this->API->modules('bottom4'); ?>" />
			
			<!--[if IE 8]>
	    		<div class="ie8clear"></div>
	    	<![endif]-->
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->API->modules('bottom5')) : ?>

		<div class="gk3bottombackground"></div>
		<div class="gk3bottom">

			<?php if($this->API->modules('bottom5-1')) : ?>
				<div id="gkBottom5-1" class="gkPageIndex">
					<div class="gkCols9<?php if($this->API->modules('bottom5-1') == 1) : ?> <?php endif; ?>">
						<jdoc:include type="modules" name="bottom5-1" style="<?php echo $this->module_styles['bottom5-1']; ?>" modnum="<?php echo $this->API->modules('bottom5-1'); ?>" />
						
						<!--[if IE 8]>
				    		<div class="ie8clear"></div>
				    	<![endif]-->
					</div>
				</div>
			<?php endif; ?>


			<div id="gkBottom5" class="gkPage">
				<div class="gkCols9<?php if($this->API->modules('bottom5') == 1) : ?> <?php endif; ?>">
					<jdoc:include type="modules" name="bottom5" style="<?php echo $this->module_styles['bottom5']; ?>" modnum="<?php echo $this->API->modules('bottom5'); ?>" />
					
					<!--[if IE 8]>
			    		<div class="ie8clear"></div>
			    	<![endif]-->
				</div>
			</div>
			<?php endif; ?>
			<?php if($this->API->modules('bottom6')) : ?>
			<div id="gkBottom6" class="gkPage">
				<div class="gkCols9<?php if($this->API->modules('bottom6') == 1) : ?> <?php endif; ?>">
					<jdoc:include type="modules" name="bottom6" style="<?php echo $this->module_styles['bottom6']; ?>" modnum="<?php echo $this->API->modules('bottom6'); ?>" />
					
					<!--[if IE 8]>
			    		<div class="ie8clear"></div>
			    	<![endif]-->
				</div>
			</div>
			<?php endif; ?>
			<?php if($this->API->modules('bottom7')) : ?>
			<div id="gkBottom7" class="gkPage">
				<div class="gkCols9<?php if($this->API->modules('bottom7') == 1) : ?> <?php endif; ?>">
					<jdoc:include type="modules" name="bottom7" style="<?php echo $this->module_styles['bottom7']; ?>" modnum="<?php echo $this->API->modules('bottom7'); ?>" />
					
					<!--[if IE 8]>
			    		<div class="ie8clear"></div>
			    	<![endif]-->
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php //$this->layout->loadBlock('footer'); ?>

	<?php if($this->API->modules('footer_nav')) : ?>
		<div class="gk3footerbackground"></div>
		<footer id="gkFooter" class="gkPage">
			<div>
				<?php if($this->API->get('show_menu', 1)) : ?>
	
				<div id="gkFooterNav">
					<?php
			    	    		$this->mainmenu->loadMenu('footermenu'); 
			    	    	    $this->mainmenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
			    	?>
				</div>

				<?php endif; ?>
				<div class="gkFooterTelefon"> 
					<div style="position: absolute; top: 5px;"><span class="imgPrefixTelefon prefixTel">(3412)</span><span class="numberTel"> 63-98-93</span></div>
					<div style="position: absolute; top: 30px;"><img class="imgFooterMail" src="/templates/<?php echo $this->API->getTemplateName(); ?>/images/foot_email.png"><span class="prefixEmail">office@sportkvartal.ru</span></div>
				</div>
				<div style="float: right; margin: -60px 0 0 0">
						<!--LiveInternet counter-->
						<script type="text/javascript"><!--
						document.write("<a href='//www.liveinternet.ru/click' "+
						"target=_blank><img src='//counter.yadro.ru/hit?t44.6;r"+
						escape(document.referrer)+((typeof(screen)=="undefined")?"":
						";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
						screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
						";"+Math.random()+
						"' alt='' title='LiveInternet' "+
						"border='0' width='31' height='31'><\/a>")
						//--></script>
						<!--/LiveInternet-->
				</div>
				<div style="float: right; margin: -60px 0 0 0">
					<!-- Yandex.Metrika counter -->
					<script type="text/javascript">
					var yaParams = {/*Здесь параметры визита*/};
					</script>

					<script type="text/javascript">
					(function (d, w, c) {
					    (w[c] = w[c] || []).push(function() {
					        try {
					            w.yaCounter7888168 = new Ya.Metrika({id:7888168,
					                    clickmap:true,params:window.yaParams||{ }});
					        } catch(e) { }
					    });

					    var n = d.getElementsByTagName("script")[0],
					        s = d.createElement("script"),
					        f = function () { n.parentNode.insertBefore(s, n); };
					    s.type = "text/javascript";
					    s.async = true;
					    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

					    if (w.opera == "[object Opera]") {
					        d.addEventListener("DOMContentLoaded", f, false);
					    } else { f(); }
					})(document, window, "yandex_metrika_callbacks");
					</script>
					<noscript><div><img src="//mc.yandex.ru/watch/7888168" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
					<!-- /Yandex.Metrika counter -->

					<script>
					  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

					  ga('create', 'UA-59786219-1', 'auto');
					  ga('send', 'pageview');

					</script>

				</div>
			</div>
			
		</footer>
	<?php endif; ?>					

	
	<?php if($this->API->modules('lang')) : ?>
	<div id="gkLang" class="gkPage">
		<jdoc:include type="modules" name="lang" style="<?php echo $this->module_styles['lang']; ?>" />
	</div>
	<?php endif; ?>
	
	<?php //$this->layout->loadBlock('social'); ?>
	<?php //$this->layout->loadBlock('tools/login'); ?>
	<jdoc:include type="modules" name="debug" />
</div>

<div class="share42init" data-top1="30%" data-top2="350"></div>

</body>
</html>