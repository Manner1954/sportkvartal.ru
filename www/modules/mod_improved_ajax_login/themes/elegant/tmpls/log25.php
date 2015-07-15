<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2013 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php defined('_JEXEC') or die('Restricted access') ?>

<?php if (count($modules = JModuleHelper::getModules($params->get('top_module', 'login-top')))): // LOGIN-TOP MODULEPOS ?>
  <?php foreach ($modules as $m): ?>
    <?php echo JModuleHelper::renderModule($m) ?>
  <?php endforeach ?>
  <div class="loginBrd"></div>
<?php endif ?>

<?php if (@$_SESSION['oauth'] && $socialpos=='top') require dirname(__FILE__).'/social.php' // TOP SOCIALPOS ?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')) ?>" method="post" name="ialLogin" class="ial-login <?php if (!$loginpopup) echo 'Width335' ?>">
  <?php if (!$module->showtitle && !$loginpopup || $loginpopup): ?>
  <div class="gi-elem gi-wide">
    <h3 class="loginH3"><?php echo $params->get('header', 'Login to your account') ?></h3>
  </div>
  <?php endif ?>

  <div class="gi-elem">
    <input id="userTxt" class="loginTxt" name="<?php echo $params->get('username', 1)? 'username':'email'?>" type="text" placeholder="<?php echo $auth ?>" />
  </div>
  <div class="gi-elem">
    <input id="passTxt" class="loginTxt" name="password" type="password" placeholder="<?php echo $password ?>" />
  </div>
  <div class="gi-elem">
    <button class="loginBtn ial-submit" id="submitBtn"><span><i class="ial-load"></i><?php echo JText::_('JLOGIN')?></span></button>
  </div>
  <div class="gi-elem">
    <?php if (JPluginHelper::isEnabled('system', 'remember')): // REMEMBER ME ?>
      <label class="ial-check-lbl smallTxt" for="keepSigned">
  		  <input id="keepSigned" name="remember" type="checkbox" class="ial-checkbox" <?php if ($params->get('rememberme', 0)) echo 'checked="checked"'?> />
  			<?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
  		</label>
  	<?php endif ?>
  	<div style="float:right; line-height:0;">
  		<a class="forgetLnk" href="<?php echo JRoute::_('index.php?option=com_users&view=reset') ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD') ?></a>
      <!--<a class="forgetLnk" href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=177') ?>"> <?php echo JText::_('JREGISTER') ?> </a>-->
      <?php if ($params->get('forgotname', 0)):?>
        <br />
        <a class="forgetLnk" href="<?php echo JRoute::_('index.php?option=com_users&view=remind') ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME') ?></a>
      <?php endif ?>
  	</div>
  </div>
  <br style="clear:both" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return ?>" />
	<?php echo JHTML::_('form.token') ?>
</form>

<?php if (@$_SESSION['oauth'] && $socialpos=='bottom') require dirname(__FILE__).'/social.php' // BOTTOM SOCIALPOS ?>

<?php if (count($modules = JModuleHelper::getModules($params->get('bottom_module', 'login-bottom')))): // LOGIN-BOTTOM MODULEPOS ?>
  <div class="loginBrd"></div>
  <?php foreach ($modules as $m): ?>
    <?php echo JModuleHelper::renderModule($m) ?>
  <?php endforeach ?>
<?php endif ?>
