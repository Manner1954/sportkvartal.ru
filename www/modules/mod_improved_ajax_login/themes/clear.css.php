<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2013 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die('Restricted access');

$fonts = new OfflajnFontHelper($params);
echo $fonts->parseFonts();

$GLOBALS['googlefontsloaded'] = array();
foreach($params->toArray() AS $k => $p){
  if (strpos($k, 'grad')) $p = explode('-', $p);
  elseif (strpos($k, 'comb')) $p = explode('|*|', $p);

  if ($k != 'params') $$k = $p;
}

if(!function_exists('shift_color')){
  function shift_color($hex, $s) {
  	$c = hexdec($hex);
  	$r = (($c >> 16) & 255)+$s;
  	$g = (($c >> 8) & 255)+$s;
  	$b = ($c & 255)+$s;
  	if ($r>255) $r=255; elseif ($r<0) $r=0;
  	if ($g>255) $g=255; elseif ($g<0) $g=0;
  	if ($b>255) $b=255; elseif ($b<0) $b=0;
  	printf('%02X%02X%02X', $r, $g, $b);
  }
}
?>
.gi-elem .hidden {
  display: none;
}
.gi-elem {
  display: block;
  float: left;
  text-align: left;
  line-height: 0;
  padding-top: 2px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.red {
  font-weight: normal;
  color: inherit;
}
.gi-elem.gi-wide {
  width: 100%;
}
.ial-login,
.ial-form {
  margin: 0;
  line-height: 0;
}

.ial-trans-gpu {
  -webkit-transition: 300ms ease-out;
	-moz-transition: 300ms ease-out;
  -ms-transition: 300ms ease-out;
  -o-transition: 300ms ease-out;
	transition: 300ms ease-out;
  -webkit-transition-property: visibility, opacity, -webkit-transform;
	-moz-transition-property: visibility, opacity, -moz-transform;
  -ms-transition-property: visibility, opacity, -ms-transform;
  -o-transition-property: visibility, opacity, -o-transform;
	transition-property: visibility, opacity, transform;
}
.ial-trans-b {
  visibility: hidden;
  opacity: 0;
  -webkit-transform: translate(0, 30px);
	-moz-transform: translate(0, 30px);
  -ms-transform: translate(0, 30px);
  -o-transform: translate(0, 30px);
	transform: translate(0, 30px);
}
.ial-trans-t {
  visibility: hidden;
  opacity: 0;
  -webkit-transform: translate(0, -30px);
	-moz-transform: translate(0, -30px);
  -ms-transform: translate(0, -30px);
  -o-transform: translate(0, -30px);
	transform: translate(0, -30px);
}
.ial-trans-l {
  visibility: hidden;
  opacity: 0;
  -webkit-transform: translate(30px, 0);
	-moz-transform: translate(30px, 0);
  -ms-transform: translate(30px, 0);
  -o-transform: translate(30px, 0);
	transform: translate(30px, 0);
}
.ial-trans-r {
  visibility: hidden;
  opacity: 0;
  -webkit-transform: translate(-30px, 0);
	-moz-transform: translate(-30px, 0);
  -ms-transform: translate(-30px, 0);
  -o-transform: translate(-30px, 0);
	transform: translate(-30px, 0);
}
.ial-trans-gpu.ial-active {
  visibility: visible;
  opacity: 1;
  -webkit-transform: none;
	-moz-transform: none;
  -ms-transform: none;
  -o-transform: none;
	transform: none;
  /* safari fix */
  -webkit-transition-property: opacity, -webkit-transform;
}
#loginComp {
  display: inline-block;
  margin-bottom: 15px;
  margin-top: 45px;
}
#loginComp #loginBtn {
  display: none;
}
.selectBtn {
  display: inline-block;
  *display: inline;
  z-index: 10000;
  user-select: none;
  -moz-user-select: none;
  -webkit-user-select: auto;
  -ms-user-select: none; 
}
.selectBtn:hover,
.selectBtn:active,
.selectBtn:focus {
  background: none;
}
#logoutForm,
#loginForm {
  display: inline-block;
  margin: 0;
}