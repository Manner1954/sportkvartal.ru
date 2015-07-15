<?php
/*------------------------------------------------------------------------
# plg_improved_ajax_login - Improved AJAX Login
# ------------------------------------------------------------------------
# author    Balint Polgarfi
# copyright Copyright (C) 2012 Offlajn.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die('Restricted access');

if (isset($_REQUEST['ialCheck'])) {
  $check = JRequest::getString('ialCheck');
  $db = JFactory::getDBO();
  $lang = JFactory::getLanguage();
  $json = array('error' => '', 'msg' => '');
  switch ($check) {
  case 'ialLogin':
    $json['field'] = 'password';
    if (JSession::checkToken()) {
      $username = JRequest::getVar(isset($_REQUEST['username'])? 'username' : 'email', '');
      $password = JRequest::getString('password', '', 'method', JREQUEST_ALLOWRAW);
    	if (!empty($password)) {
        $field = preg_match('/^[\d\w.-]+@[\da-zA-Z.-]+\.[a-zA-Z]{2,4}$/', $username)?
          'email' : 'username';
      	$db->setQuery("SELECT username, password FROM #__users WHERE $field = '$username'");
      	if ($result = $db->loadObject()) {
      		$parts = explode(':', $result->password);
      		$crypt = $parts[0];
      		$salt = @$parts[1];
      		$testcrypt = JUserHelper::getCryptedPassword($password, $salt);
          $json['username'] = $result->username;
      		if ($crypt != $testcrypt) $json['error'] = 'JGLOBAL_AUTH_INVALID_PASS';
      	} else $json['error'] = 'JGLOBAL_AUTH_NO_USER';
      } else $json['error'] = 'JGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED';
    } else $json['error'] = 'JINVALID_TOKEN';
    $json['msg'] = JText::_($json['error']);
    die(json_encode($json));
  case 'jform[username]':
    $username = JRequest::getString('value');
    $db->setQuery("SELECT id FROM #__users WHERE username LIKE '$username'");
    if ($db->loadRow()) $json['error'] = 'COM_USERS_REGISTER_USERNAME_MESSAGE';
    $lang->load("com_users");
    $json['msg'] = JText::_($json['error']);
    die(json_encode($json));
  case 'jform[email1]':
    $email = JRequest::getString('value');
    $db->setQuery("SELECT id FROM #__users WHERE email LIKE '$email'");
    if ($db->loadRow()) $json['error'] = 'COM_USERS_REGISTER_EMAIL1_MESSAGE';
    $lang->load("com_users");
    $json['msg'] = JText::_($json['error']);
    die(json_encode($json));
  case 'ialRegister':
    if (!JSession::checkToken()) {
      $json['error'] = 'JINVALID_TOKEN';
      $json['msg'] = JText::_($json['error']);
      die(json_encode($json));
    }
    if (isset($_SESSION['reCaptcha'])) {
      require dirname(__FILE__).'/lib/recaptchalib.php';
      $resp = recaptcha_check_answer(
        $_SESSION['reCaptcha']['private'],
        $_SERVER['REMOTE_ADDR'],
        $_POST['recaptchaChallenge'],
        $_POST['jform']['captcha']
      );
      if ($resp->error) {
        $lang->load("lib_joomla");
        $json['field'] = 'jform[captcha]';
        $json['error'] = 'JLIB_FORM_FIELD_INVALID';
        $json['msg'] = JText::_($json['error']);
        die(json_encode($json));
      }
    }
    $jf = JRequest::getVar('jform', array(), 'array');
    if (!isset($jf['username']))
      list($jf['username']) = explode('@', $jf['email1']);
    if (!isset($jf['name'])) $jf['name'] = $jf['username'];
    if (!isset($jf['email2'])) $jf['email2'] = $jf['email1'];
    if (!isset($jf['password2'])) $jf['password2'] = $jf['password1'];
    JRequest::setVar('jform', $jf);
    JFactory::getApplication()->input->post->set('jform', $jf);
    $_SESSION['ialRegister'] = 1;
    break;
  }
}

if (preg_match('/improved_ajax_login/', $_SERVER['REQUEST_URI']) &&
    !JFactory::getApplication()->isAdmin())
{
  $task = JRequest::getCmd('task');
  if ($task == 'login' || $task == 'register') return;

  $mainframe = JFactory::getApplication();
  $db = JFactory::getDBO();
  $v15 = version_compare(JVERSION,'1.6.0','lt');
  $v30 = version_compare(JVERSION,'3.0.0','ge');

  require dirname(__FILE__).'/oauth.php';
}

jimport('joomla.plugin.plugin');

class plgSystemImproved_Ajax_Login extends JPlugin
{

  function plgSystemImproved_Ajax_Login(&$subject, $config)
  {
    parent::__construct($subject, $config);
  }

  function onAfterDispatch()
  {
    if (isset($_SESSION['ialRegister'])) {
      unset($_SESSION['ialRegister']);
      $msg = JFactory::getApplication()->getMessageQueue();
      $error = $msg[0]['type'] != "message";
      $json = array(
        'field' => 'submit',
        'error' => $error,
        'msg' => $msg[0]['message']
      );
      if (!$error) {
        $usersConfig = JComponentHelper::getParams('com_users');
        if (!$usersConfig->get('useractivation', 1)) $json['autologin'] = 1;
      }
      die(json_encode($json));
    }

    if (!$this->params->get('override', 1)) return;

    $app = JFactory::getApplication();
    if ($app->isAdmin()) return;

    jimport('joomla.application.module.helper');
    $option = JRequest::getCmd('option');
    $view = JRequest::getCmd('view');

    if (($option == 'com_user' && $view == 'login') || ($option == 'com_users' && $view == 'login'))
    {
      $module = JModuleHelper::getModule('improved_ajax_login');
      if (!$module) return;

      $user = JFactory::getUser();
      if (!$user->guest)
      {
          $app->redirect($option=='com_user'?'index.php?option=com_user&view=user':'index.php?option=com_users&view=profile');
          $app->close();
      }

      $module->view = 'log';
      $this->render($module);
    }
    elseif (($option == 'com_user' && $view == 'register') || ($option == 'com_users' && $view == 'registration'))
    {
      $module = JModuleHelper::getModule('improved_ajax_login');
      if (!$module) return;

      if ($option == com_user)
      {
        $params = new JParameter( $module->params );
        $regpage = $params->get('regpage');
      }
      else
      {
        $params = json_decode($module->params);
        $regpage = $params->moduleparametersTab->regpage;
      }
      $regpage = explode('|*|', $regpage);
      if (@$regpage[0] != 'joomla') return;

      $module->view = 'reg';
      $this->render($module);
    }
  }

  function render($module)
  {
    $contents = '<div class="gkPage" style="text-align: center;"><div id="loginComp">';
    $contents.= JModuleHelper::renderModule($module);
    $contents.= '</div></div>';
    $document = JFactory::getDocument();
    $document->setBuffer($contents, 'component');
  }

}