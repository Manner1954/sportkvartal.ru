<?php
/*------------------------------------------------------------------------
# com_improved_ajax_login - Improved AJAX Login
# ------------------------------------------------------------------------
# author    Balint Polgarfi
# copyright Copyright (C) 2012 Offlajn.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.offlajn.com
-------------------------------------------------------------------------*/
?>
<?php
defined('_JEXEC') or die( 'Restricted access' );
require_once(dirname(__FILE__).'/lib/OfflajnOAuth.php');

$user = $newuser = 0;
$data = $_SESSION['oauth'][$task];

// OAuth 1.0
if (isset($_GET['redirect'])) {
  $oa = new OfflajnOAuth($task);
  $oa->getToken();  // redirection
}
if (isset($_REQUEST['oauth_verifier'])) {
  $oa = new OfflajnOAuth($task);
  $user = $oa->getUser();
}

// OAuth 2.0
if (isset($_GET['code'])) {
  if (!ini_get('allow_url_fopen') && ini_set('allow_url_fopen', 1) === false)
    $_SESSION['ologin']['curl'] = 1;

  $oa = new OfflajnOAuth2($task, $_GET['code'], $_SESSION['ologin']['curl']);
  $user = $oa->getUser();
} elseif (isset($_GET['error_message'])) die($_GET['error_message']);

if ($user) {
  $newuser = 0;
  if (!$user->getJUser()) {
    $newuser = 1;
    $email = $user->getEmail();
    // manual registration
    if ($_SESSION['ologin']['regpage'] == 'joomla' || !$email) oexit("
      var $ = opener.jq183 || opener.jQuery,
          btn = $('.regBtn'),
          reg = $('form[name=ialRegister]');
      reg.find('[name=\"jform[name]\"]')
        .val('{$user->getName()}').addClass('ial-correct');
      reg.find('[name=\"jform[username]\"]')
        .val('{$user->searchUserName()}').addClass('ial-correct');
      if ('$email') {
        reg.find('[name=\"jform[email1]\"]')
          .val('$email').addClass('ial-correct');
        reg.find('[name=\"jform[email2]\"]')
          .val('$email').addClass('ial-correct');
      }
      $('<input name=\"socialType\" value=\"$task\" type=\"hidden\">')
        .appendTo(reg);
      $('<input name=\"socialId\" value=\"{$user->id}\" type=\"hidden\">')
        .appendTo(reg);
      if (!btn.hasClass('ial-active')) btn.click();
      window.close();
    ");
    // auto registration
    $user->register();
  }
  if ($user->juser->block ) oexit('
    opener.ologin.$oauthBtn.ialErrorMsg({
      msg: "'.JText::_('JERROR_NOLOGIN_BLOCKED').'"
  	});
    window.close();
  ');
  if ($user->login()) oexit("
    var log = opener.ologin,
        returnUrl = ($newuser && log.socialProfile)?
          log.socialProfile : log.returnUrl;
    returnUrl = returnUrl.replace(/[&\?]_=\d+/, '');
    opener.location.href = returnUrl + (returnUrl.match(/\?/)? '&' : '?') +
      '_=' + new Date().getTime();
    window.close();
  ");
}
oexit('window.close();');

function oexit($script) {
  ob_clean(); ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>Login</title>
      <script type="text/javascript">
        <?php echo $script ?>
      </script>
    </head>
    <body>
    </body>
  </html>
  <?php
  exit;
}