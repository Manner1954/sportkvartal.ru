<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2013 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php defined('_JEXEC') or die('Restricted access'); ?>
.strongFields {
  display: block;
  overflow: hidden;
  height: 7px;
  margin: 3px 0 2px;
	border-radius: <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
  background-color: #<?php echo $btngrad[1]?>;
	background-image: url(data:image/svg+xml;base64,<?php echo base64_encode("<svg xmlns='http://www.w3.org/2000/svg'><linearGradient id='g' x2='100%' y2='0'><stop stop-color='#{$btngrad[1]}'/><stop offset='100%' stop-color='#{$hovergrad[2]}'/></linearGradient><rect width='100%' height='100%' fill='url(#g)'/></svg>")?>);
	background-image: -moz-linear-gradient(left, #<?php echo $btngrad[1]?>, #<?php echo $hovergrad[2]?>);
  background-image: -o-linear-gradient(left, #<?php echo $btngrad[1]?>, #<?php echo $hovergrad[2]?>);
  background-image: -ms-linear-gradient(left, #<?php echo $btngrad[1]?>, #<?php echo $hovergrad[2]?>);
	background-image: -webkit-gradient(linear, left top, right top, from(#<?php echo $btngrad[1]?>), to(#<?php echo $hovergrad[2]?>));
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#<?php echo $btngrad[1]?>, endColorstr=#<?php echo $hovergrad[2]?>, GradientType=1);
}
.strongFields .strongField.empty {
  background-color: #<?php echo $txtcomb[0]?>;
  -webkit-transition: background-color 1.2s ease-out;
	-moz-transition: background-color 1.2s ease-out;
  -ms-transition: background-color 1.2s ease-out;
  -o-transition: background-color 1.2s ease-out;
	transition: background-color 1.2s ease-out;
}
.strongField.empty,
.strongField {
  display: block;
  background-color: transparent;
  width: 20%;
  height: 7px;
  float: left;
  box-shadow:
    1px 1px 2px rgba(0, 0, 0, 0.4) inset,
    -2px 0 0 #<?php echo $popupcomb[0]?>;
  -webkit-box-shadow:
    1px 1px 2px rgba(0, 0, 0, 0.4) inset,
    -2px 0 0 #<?php echo $popupcomb[0]?>;
}
.loginWndInside {
  position: relative;
  display: inline-block;
  padding: 15px 10px 8px;
  border: 1px #<?php shift_color($popupcomb[2], -39)?> solid;
  background-color: #<?php echo $popupcomb[0]?>;
	border-radius: <?php echo $buttoncomb[2]+1?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+1?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+1?>px;
  box-shadow:
		0px 0px <?php echo $popupcomb[1]-1?>px rgba(0,0,0,0.4);
	-moz-box-shadow:
		0px 0px <?php echo $popupcomb[1]-1?>px rgba(0,0,0,0.4);
	-webkit-box-shadow:
		0px 0px <?php echo $popupcomb[1]-1?>px rgba(0,0,0,0.4);
}
.loginH3 {
  <?php $fonts->printFont('titlefont', 'Text');?>
  padding-bottom: 6px;
  margin: 0 0 9px 0;
  position: relative;
  border-bottom: 1px #<?php echo $popupcomb[2]?> solid;
  box-shadow: 0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-moz-box-shadow: 0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-webkit-box-shadow: 0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
}
.socialBody {
	background-color: #<?php echo $popupcomb[2]?>;
}
.captchaCnt {
  text-align: center;
  *width: 215px;
  border: none;
  clear: both;
  padding: 4px 2px 2px 4px;
  overflow: hidden;
  position: relative;
  border-radius: <?php echo $buttoncomb[2]+0?>px;
  -webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
  margin: 0 0 6px;
  background: #fff;
  box-shadow:
    1px 1px 0 rgba(255, 255, 255, 0.8),
    1px 1px 3px rgba(0, 0, 0, 0.3) inset;
  -webkit-box-shadow:
    1px 1px 0 rgba(255, 255, 255, 0.8),
    1px 1px 3px rgba(0, 0, 0, 0.3) inset;
}
.dj_ie7 .captchaCnt,
.dj_ie8 .captchaCnt {
  border: 1px #<?php echo $popupcomb[2]?> solid\9;
}
.ial-msg .red {
  display: none;
}
#recaptchaImg {
  display: block;
  width: 100%;
  min-height: 57px;
  max-width: 300px;
  margin: 0 auto;
  opacity: 0;
  transition: opacity .33s ease-in-out;
  -o-transition: opacity .33s ease-in-out;
  -ms-transition: opacity .33s ease-in-out;
  -moz-transition: opacity .33s ease-in-out;
  -webkit-transition: opacity .33s ease-in-out;
}
#recaptchaImg.fadeIn {
  min-height: 0;
	opacity: 1;
}
a.logBtn.selectBtn:hover {
  background-color: transparent;
}
.selectBtn {
  margin: 1px 0;
  white-space: nowrap;
}
.selectBtn:hover,
.loginBtn:hover {
  *text-decoration: none;
}
.btnIco {
  display: block;
  float: left;
  background: transparent no-repeat 1px center;
  width: 20px;
  border-right: 1px #<?php echo $buttoncomb[1]?> solid;
  box-shadow: 1px 0 0 rgba(255, 255, 255, 0.5);
  -webkit-box-shadow: 1px 0 0 rgba(255, 255, 255, 0.5);
}
.socialIco {
  cursor: pointer;
  width: 36px;
  height: 36px;
  border-radius: 18px;
  -webkit-border-radius: 18px;
  background: #<?php echo $popupcomb[2]?>;
  display: inline-block;
  *display: block;
  *float: left;
  margin: 0 9px;
  text-align: left;
}
.socialIco:first-child {
  margin-left: 0;
}
.socialIco:last-child {
  margin-right: 0;
}
.socialImg {
  margin: 4px;
  width: 28px;
  height: 28px;
  border-radius: 14px;
  -webkit-border-radius: 14px;
  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3), inset 1px 1px 1px #fff;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), inset 0 1px 1px #fff;
}
.loginBtn,
.socialIco,
.socialImg {
  -webkit-transition: all .3s ease-out;
	-moz-transition: all .3s ease-out;
  -ms-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
	transition: all .3s ease-out;
}
.socialIco:hover .socialImg {
  border-radius: 7px;
  -webkit-border-radius: 7px;
}
.socialIco:hover {
  background-color: #<?php echo $textfont['Hover']['color'] ?>;
}
.facebookImg {
  background: transparent url(<?php echo $themeurl?>images/fb.png);
}
.googleImg {
  background: transparent url(<?php echo $themeurl?>images/google.png);
}
.twitterImg {
  background: transparent url(<?php echo $themeurl?>images/twitter.png);
}
.windowsImg {
  background: transparent url(<?php echo $themeurl?>images/wl.png);
}
.linkedinImg {
  background: transparent url(<?php echo $themeurl?>images/in.png);
}
.loginBrd {
  clear: both;
  *text-align: center;
  position: relative;
  margin: 13px 0;
  height: 0;
  padding: 0;
  border: 0;
}
.loginBrd {
  border-bottom: 1px #<?php echo $popupcomb[2]?> solid;
  box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-moz-box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-webkit-box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
}
.loginOr {
  display: none;
  position: absolute;
  width: 20px;
  height: 15px;
  left: 50%;
  text-align: center;
  margin: -7px 0 0 -13px;
  border: 3px solid #<?php echo $popupcomb[0]?>;
  border-top: 0;
  background: #<?php echo $popupcomb[0]?>;
}
.ial-window .loginOr {
  display: block;
}

.ial-window ::selection {
  background-color: #<?php echo $btngrad[2] ?>;
  color: #<?php echo $txtcomb[1] ?>;
}

.ial-window ::-moz-selection {
  background-color: #<?php echo $btngrad[2] ?>;
  color: #<?php echo $txtcomb[1] ?>;
}

.ial-arrow-l,
.ial-arrow-r {
  display: block;
  position: absolute;
  top: <?php echo $btnfont['Text']['size']/4+$buttoncomb[0]?>px;
  width: 0;
  height: 0;
  border: 5px transparent solid;
  border-right-color: #<?php shift_color($errorgrad[1]<$errorgrad[2]? $errorgrad[1] : $errorgrad[2], -30)?>;
  border-left-width: 0;
}
.ial-arrow-l {
	left: -11px;
}
.ial-arrow-r {
  right: -6px;
  border-left-color: #<?php shift_color($errorgrad[1]<$errorgrad[2]? $errorgrad[1] : $errorgrad[2], -30)?>;
  border-width: 5px 0 5px 5px;
}
.inf .ial-arrow-l {
  border-right-color: #<?php shift_color($hintgrad[1]<$hintgrad[2]? $hintgrad[1] : $hintgrad[2], -50)?>;
}
.inf .ial-arrow-r {
  border-left-color: #<?php shift_color($hintgrad[1]<$hintgrad[2]? $hintgrad[1] : $hintgrad[2], -50)?>;
}
.ial-msg {
  visibility: hidden;
  z-index: 10000;
  position: absolute;
	border-radius: <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
	box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.3);
	-moz-box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.3);
	-webkit-box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.3);
}
.ial-msg.inf {
  border: 1px solid #<?php shift_color($hintgrad[1]<$hintgrad[2]? $hintgrad[1] : $hintgrad[2], -40)?>;
  background-color: #<?php echo $hintgrad[1]?>;
	background-image: url(data:image/svg+xml;base64,<?php echo base64_encode("<svg xmlns='http://www.w3.org/2000/svg'><linearGradient id='g' x2='0' y2='100%'><stop stop-color='#{$hintgrad[1]}'/><stop offset='100%' stop-color='#{$hintgrad[2]}'/></linearGradient><rect width='100%' height='100%' fill='url(#g)'/></svg>")?>);
	background-image: -moz-linear-gradient(top, #<?php echo $hintgrad[1]?>, #<?php echo $hintgrad[2]?>);
  background-image: -o-linear-gradient(top, #<?php echo $hintgrad[1]?>, #<?php echo $hintgrad[2]?>);
  background-image: -ms-linear-gradient(top, #<?php echo $hintgrad[1]?>, #<?php echo $hintgrad[2]?>);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $hintgrad[1]?>), to(#<?php echo $hintgrad[2]?>));
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#<?php echo $hintgrad[1]?>, endColorstr=#<?php echo $hintgrad[2]?>);
}
.ial-msg.err {
  border: 1px solid #<?php shift_color($errorgrad[1]<$errorgrad[2]? $errorgrad[1] : $errorgrad[2], -30)?>;
  background-color: #<?php echo $errorgrad[1]?>;
	background-image: url(data:image/svg+xml;base64,<?php echo base64_encode("<svg xmlns='http://www.w3.org/2000/svg'><linearGradient id='g' x2='0' y2='100%'><stop stop-color='#{$errorgrad[1]}'/><stop offset='100%' stop-color='#{$errorgrad[2]}'/></linearGradient><rect width='100%' height='100%' fill='url(#g)'/></svg>")?>);
	background-image: -moz-linear-gradient(top, #<?php echo $errorgrad[1]?>, #<?php echo $errorgrad[2]?>);
  background-image: -o-linear-gradient(top, #<?php echo $errorgrad[1]?>, #<?php echo $errorgrad[2]?>);
  background-image: -ms-linear-gradient(top, #<?php echo $errorgrad[1]?>, #<?php echo $errorgrad[2]?>);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $errorgrad[1]?>), to(#<?php echo $errorgrad[2]?>));
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#<?php echo $errorgrad[1]?>, endColorstr=#<?php echo $errorgrad[2]?>);
}
span.ial-inf,
span.ial-err {
  position: relative;
  text-align: left;
  max-width: 360px;
  cursor: default;
  margin-left: 5px;
  padding: <?php echo $buttoncomb[0]+0?>px 8px <?php echo $buttoncomb[0]+0?>px 16px;
  text-decoration: none;
  color: #<?php echo $errorcolor?>;
	: 1px 1px 0px rgba(0,0,0,0.7);
}
span.ial-inf {
  color: #<?php echo $hintcolor?>;
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.5);
}
div.ial-icon-err,
div.ial-icon-inf {
  width: 15px;
  position: absolute;
  left: 0;
  background: url(<?php echo $themeurl?>images/info.png) no-repeat scroll left center transparent;
}
div.ial-icon-err {
  background: url(<?php echo $themeurl?>images/error.png) no-repeat left center;
}
.ial-inf,
.ial-err,
.loginBtn span,
.loginBtn {
  display: inline-block;
  <?php //$fonts->printFont('btnfont', 'Text'); //---ARt* ?>
}
.ial-icon-refr {
  display: block;
  width: 8px;
  height: 10px;
  background: url(<?php echo $themeurl?>images/refresh.png) no-repeat center center;
}
.facebookIco {
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/f.png", $btnfont['Text']['color'], "2e3192")?>);
}
.googleIco {
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/g.png", $btnfont['Text']['color'], "2e3192")?>);
}
.twitterIco {
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/t.png", $btnfont['Text']['color'], "2e3192")?>);
}
.windowsIco {
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/w.png", $btnfont['Text']['color'], "2e3192")?>);
}
.linkedinIco {
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/i.png", $btnfont['Text']['color'], "2e3192")?>);
}
.loginBtn::-moz-focus-inner {
  border:0;
  padding:0;
}
.loginBtn {
  display: inline-block;
  cursor: pointer;
  text-align: center;
	margin: 0;
	padding: <?php echo $buttoncomb[0]+0?>px 0;
	/*border: 1px solid #<?php echo $buttoncomb[1]?>;*/
	border-radius: <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
}
/*.socialIco:hover,*/
.loginBtn,
.loginBtn:hover:active,
.selectBtn:hover .leftBtn {
  /*background-color: #<?php echo $btngrad[1]?>;
	background-image: url(data:image/svg+xml;base64,<?php echo base64_encode("<svg xmlns='http://www.w3.org/2000/svg'><linearGradient id='g' x2='0' y2='100%'><stop stop-color='#{$btngrad[1]}'/><stop offset='100%' stop-color='#{$btngrad[2]}'/></linearGradient><rect width='100%' height='100%' fill='url(#g)'/></svg>")?>);
	background-image: -moz-linear-gradient(top, #<?php echo $btngrad[1]?>, #<?php echo $btngrad[2]?>);
  background-image: -o-linear-gradient(top, #<?php echo $btngrad[1]?>, #<?php echo $btngrad[2]?>);
  background-image: -ms-linear-gradient(top, #<?php echo $btngrad[1]?>, #<?php echo $btngrad[2]?>);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $btngrad[1]?>), to(#<?php echo $btngrad[2]?>));
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#<?php echo $btngrad[1]?>, endColorstr=#<?php echo $btngrad[2]?>);
	-o-background-size: 100% 100%;*/ /* ---ARt* */
}
.loginBtn,
.selectBtn:active .rightBtn {
	/*box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.5);
	-moz-box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.5);
	-webkit-box-shadow:
		1px 1px 2px rgba(0,0,0,0.4),
		inset 1px 1px 0px rgba(255,255,255,0.5);*/ /* ---ARt* */
}
.leftBtn {
  padding-left: <?php echo $buttoncomb[0]+2?>px;
  padding-right: <?php echo $buttoncomb[0]+2?>px;
	border-radius: <?php echo $buttoncomb[2]+0?>px 1px 1px <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+0?>px 1px 1px <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px 1px 1px <?php echo $buttoncomb[2]+0?>px;
}
.rightBtn {
  padding-left: <?php echo $buttoncomb[0]-2?>px;
  padding-right: <?php echo $buttoncomb[0]-2?>px;
	border-radius: 0px <?php echo $buttoncomb[2]+0?>px <?php echo $buttoncomb[2]+0?>px 0px;
	-moz-border-radius: 0px <?php echo $buttoncomb[2]+0?>px <?php echo $buttoncomb[2]+0?>px 0px;
	-webkit-border-radius: 0px <?php echo $buttoncomb[2]+0?>px <?php echo $buttoncomb[2]+0?>px 0px;
	border-left-width: 0;
	letter-spacing: -2;
}
.loginBtn:hover,
.selectBtn:hover .rightBtn {
  /*background-color: #<?php echo $hovergrad[1]?>;
	background-image: url(data:image/svg+xml;base64,<?php echo base64_encode("<svg xmlns='http://www.w3.org/2000/svg'><linearGradient id='g' x2='0' y2='100%'><stop stop-color='#{$hovergrad[1]}'/><stop offset='100%' stop-color='#{$hovergrad[2]}'/></linearGradient><rect width='100%' height='100%' fill='url(#g)'/></svg>")?>);
	background-image: -moz-linear-gradient(top, #<?php echo $hovergrad[1]?>, #<?php echo $hovergrad[2]?>);
  background-image: -o-linear-gradient(top, #<?php echo $hovergrad[1]?>, #<?php echo $hovergrad[2]?>);
  background-image: -ms-linear-gradient(top, #<?php echo $hovergrad[1]?>, #<?php echo $hovergrad[2]?>);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $hovergrad[1]?>), to(#<?php echo $hovergrad[2]?>));
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#<?php echo $hovergrad[1]?>, endColorstr=#<?php echo $hovergrad[2]?>);*/ /* ---ARt* */
}
.loginBtn:active:hover,
.selectBtn.ial-active .leftBtn,
.selectBtn:active .leftBtn {
	/*box-shadow:
		inset 1px 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow:
		inset 1px 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow:
		inset 1px 1px 3px rgba(0,0,0,0.5);*/ /* ---ARt* */
}
.ial-window,
.ial-usermenu {
  top: -10000px;
  margin-top: 15px;
  position: absolute;
  z-index: 10000;
  padding: <?php echo $popupcomb[1]+0?>px;
  border: 1px #<?php shift_color($popupcomb[2], -52)?> solid;
	border-radius: <?php echo $popupcomb[3]+0?>px;
	-moz-border-radius: <?php echo $popupcomb[3]+0?>px;
	-webkit-border-radius: <?php echo $popupcomb[3]+0?>px;
	background-color: #<?php echo $popupcomb[2]?>;
	box-shadow:
		1px 1px 5px rgba(0, 0, 0, 0.4);
	-moz-box-shadow:
		1px 1px 5px rgba(0, 0, 0, 0.4);
	-webkit-box-shadow:
		1px 1px 5px rgba(0, 0, 0, 0.4);
}
.ial-usermenu .loginWndInside {
  padding: 5px;
}
.ial-arrow-up {
  position: absolute;
  top: -14px;
}
.ial-captcha {
  max-width: 100%;
}
.upArrowOutside,
.upArrowInside {
  position: absolute;
  top: -1px;
  display: block;
  width: 2px;
  height: 0;
  border: 10px transparent solid;
  border-bottom-color: #<?php shift_color($popupcomb[2], -39)?>;
  border-top-width: 0;
}
.upArrowInside {
  width: 0;
  top: 0px;
  left: 1px;
	border-bottom-color: #<?php echo $popupcomb[2]?>;
}
.ial-close {
  position: absolute;
  right: 0;
  top: 0;
  line-height: 0;
  margin: 0;
	padding: 3px 5px;
	border: 1px solid #<?php echo $buttoncomb[1]?>;
	border-radius: 0 <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: 0 <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: 0 <?php echo $buttoncomb[2]+0?>px 0 <?php echo $buttoncomb[2]+0?>px;
  box-shadow:
		inset 1px -1px 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
	-moz-box-shadow:
		inset 1px -1px 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
	-webkit-box-shadow:
		inset 1px -1px 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
}
.ial-close:hover {
  box-shadow:
		inset 0 0 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
	-moz-box-shadow:
		inset 0 0 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
	-webkit-box-shadow:
		inset 0 0 3px rgba(0,0,0,0.3),
    0 1px 2px rgba(0, 0, 0, 0.4);
}
i.ial-correct {
  background: transparent url(<?php echo $themeurl?>images/ok.png) no-repeat 0 center;
  width: 20px;
  height: 12px;
  display: inline-block;
}
.loginOr,
.smallTxt,
.forgetLnk,
.loginLst a:link,
.loginLst a:visited,
textarea.loginTxt,
input[type=text].loginTxt,
input[type=password].loginTxt {
  <?php $fonts->printFont('textfont', 'Text');?>
}
.dj_ie8 textarea.loginTxt,
.dj_ie8 input[type=password].loginTxt,
.dj_ie8 input[type=text].loginTxt,
.dj_ie8 textarea.loginTxt:focus,
.dj_ie8 input[type=password].loginTxt:focus,
.dj_ie8 input[type=text].loginTxt:focus {
  border: 1px #<?php echo $popupcomb[2]?> solid;
}
.regTxt.loginTxt[name="jform[password1]"] {
  margin-bottom: 0;
}
input[name="jform[password1]"]:hover ~ .strongFields .strongField.empty,
input[name="jform[password1]"]:focus ~ .strongFields .strongField.empty {
  background-color: #<?php echo $txtcomb[1]?>;
}
.passStrongness {
  *display: none;
  float: right;
}
.strongField {
  box-shadow:
    inset 0 0 0 1px rgba(0, 0, 0, 0.3),
    inset 2px 2px 1px rgba(255,255,255,0.5);
  -webkit-box-shadow:
    inset 0 0 0 1px rgba(0, 0, 0, 0.3),
    inset 2px 2px 0 rgba(255,255,255,0.5);
}
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt {
  display: block;
  width: 100%;
  *width: auto;
  height: auto;
  margin: 0 0 14px;
  padding: <?php echo $buttoncomb[0]+1?>px;
  padding-left: 25px;
  background: #<?php echo $txtcomb[0]?> no-repeat;
  border: none;
  *border: 1px #<?php echo $popupcomb[2]?> solid;
	border-radius: <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
  background-position: 8px center, 8px -200%, 7px -200%;
  background-position: 8px center\9;
  -webkit-transition: background-position 0s ease-out;
	-moz-transition: background-position 0s ease-out;
  -ms-transition: background-position 0s ease-out;
  -o-transition: background-position 0s ease-out;
	transition: background-position 0s ease-out;
}
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt,
textarea.loginTxt:focus,
input[type=password].loginTxt:focus,
input[type=text].loginTxt:focus {
	box-shadow:
	  1px 1px 0 rgba(255,255,255,0.8),
		inset 1px 1px 3px rgba(0,0,0,0.3);
	-moz-box-shadow:
	  1px 1px 0 rgba(255,255,255,0.8),
		inset 1px 1px 3px rgba(0,0,0,0.3);
	-webkit-box-shadow:
	  1px 1px 0 rgba(255,255,255,0.8),
		inset 1px 1px 3px rgba(0,0,0,0.3);
}
.strongFields .strongField,
.strongFields .strongField.empty,
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt {
  -webkit-transition: background-color 0.3s ease-out;
	-moz-transition: background-color 0.3s ease-out;
  -ms-transition: background-color 0.3s ease-out;
  -o-transition: background-color 0.3s ease-out;
	transition: background-color 0.3s ease-out;
}
textarea.loginTxt:focus,
input[type=password].loginTxt:focus,
input[type=text].loginTxt:focus {
  background-position: 8px 300%, 8px center, 7px -200%;
  -webkit-transition:background 333ms;
	-moz-transition:background 333ms;
  -ms-transition:background 333ms;
  -o-transition:background 333ms;
	transition:background 333ms;
}
textarea.loginTxt.ial-correct,
input[type=password].loginTxt.ial-correct,
input[type=text].loginTxt.ial-correct {
  background-position: 8px -200%, 8px -200%, 8px center;
  background-position: 7px center\9;
  background-image: url(<?php echo $themeurl?>images/ok.png)\9;
}
textarea.loginTxt.ial-correct:focus,
input[type=password].loginTxt.ial-correct:focus,
input[type=text].loginTxt.ial-correct:focus {
  background-position: 8px center, 8px -200%, 7px 300%;
}
textarea.regTxt,
input[type=password].regTxt,
input[type=text].regTxt {
  margin-bottom: 12px;
}
button.ial-submit {
  margin: 0 0 7px;
  *clear: both;
}

#regLyr span.ial-submit:nth-child(2n<?php if ($socialpos == 'bottom') echo '+1' ?>) {
  float: left;
  clear: both;
}

.loginTxt::-webkit-input-placeholder {opacity: 1;}
.loginTxt:-moz-placeholder {opacity: 1;}
.loginTxt::-moz-placeholder {opacity: 1;}
.loginTxt:-ms-input-placeholder {opacity: 1;}
.loginTxt:focus::-webkit-input-placeholder {opacity: 0.5;}
.loginTxt:focus:-moz-placeholder {opacity: 0.5;}
.loginTxt:focus::-moz-placeholder {opacity: 0.5;}
.loginTxt:focus:-ms-input-placeholder {opacity: 0.5;}

textarea.loginTxt:hover,
textarea.loginTxt:focus,
input[type=password].loginTxt:hover,
input[type=text].loginTxt:hover,
input[type=password].loginTxt:focus,
input[type=text].loginTxt:focus {
  background-color: #<?php echo $txtcomb[1]?>;
}
input[name=email].loginTxt,
input[name="jform[email2]"].loginTxt,
input[name="jform[email1]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/email.png), url(<?php echo $themeurl?>images/email.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/email.png)\9;
}
input[name=username].loginTxt,
input[name="jform[name]"].loginTxt,
input[name="jform[username]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/user.png), url(<?php echo $themeurl?>images/user.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/user.png)\9;
}
input[name="jform[password2]"].loginTxt,
input[name="jform[password1]"].loginTxt,
input[name=password].loginTxt {
  background-image: url(<?php echo $themeurl?>images/pass.png), url(<?php echo $themeurl?>images/pass.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/pass.png)\9;
}
input[name="jform[captcha]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/pen.png), url(<?php echo $themeurl?>images/pen.png), url(<?php echo $themeurl?>images/pen.png);
  background-image: url(<?php echo $themeurl?>images/pen.png)\9;
}
input[name="jform[improved][address1]"].loginTxt,
input[name="jform[improved][address2]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/sign.png), url(<?php echo $themeurl?>images/sign.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/sign.png)\9;
}
input[name="jform[improved][city]"].loginTxt,
input[name="jform[improved][region]"].loginTxt,
input[name="jform[improved][postal_code]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/marker.png), url(<?php echo $themeurl?>images/marker.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/marker.png)\9;
}
input[name="jform[improved][phone]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/phone.png), url(<?php echo $themeurl?>images/phone.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/phone.png)\9;
}
input[name="jform[improved][country]"].loginTxt,
input[name="jform[improved][website]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/globe.png), url(<?php echo $themeurl?>images/globe.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/globe.png)\9;
}
input[name="jform[improved][favoritebook]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/book.png), url(<?php echo $themeurl?>images/book.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/book.png)\9;
}
input[name="jform[improved][dob]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/date.png), url(<?php echo $themeurl?>images/date.png), url(<?php echo $themeurl?>images/ok.png);
  background-image: url(<?php echo $themeurl?>images/date.png)\9;
}
textarea[name="jform[improved][aboutme]"].loginTxt {
  background-image: url(<?php echo $themeurl?>images/about.png);
  background-position: 8px 6px;
  height: 81px;
}
.ial-submit {
  display: block;
  *display: inline;
  width: 100%;
  *width:auto;
  margin-bottom: 10px;
  box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
}
.ial-check-lbl,
.forgetLnk:link,
.forgetLnk:visited {
  cursor: pointer;
  font-size: <?php echo $smalltext+0 ?>px;
  font-weight: normal;
	margin:0;
}
.smallTxt {
  display: inline-block;
  margin-bottom: 1px;
  font-size: <?php echo $smalltext+0 ?>px;
  font-weight: normal;
}
a.forgetLnk:link {
  padding: 0;
  margin-left: 10px;
  background: none;
}

a.forgetLnk:hover {
  background-color: transparent;
  text-decoration: underline;
}
.ial-checkbox {
  display: block;
  margin: 1px 4px 0 0;
  width: 10px;
  height: 10px;
  border: 1px #<?php shift_color($popupcomb[2], -52)?> solid;
  float: left;
  background: transparent none no-repeat 2px 2px;
	border-radius: <?php echo $buttoncomb[2]+0?>px;
	-moz-border-radius: <?php echo $buttoncomb[2]+0?>px;
	-webkit-border-radius: <?php echo $buttoncomb[2]+0?>px;
  box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25);
	-moz-box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25);
	-webkit-box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25);
}
.ial-check-lbl:hover .ial-checkbox {
  background-color: #<?php echo $txtcomb[1]?>;
	box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25) inset;
	-moz-box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25) inset;
	-webkit-box-shadow:
		1px 1px 2px rgba(0, 0, 0, 0.25) inset;
}
.ial-checkbox.ial-active {
  background-image: url(<?php echo $themeurl?>images/check.png);
}
.ial-check-lbl {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.loginLst {
  padding: 0;
  margin: 0;
  list-style: circle inside;
}
.loginLst a:link,
.loginLst a:visited {
  display: block;
  padding: 0 10px 0 20px;
  line-height: 22px;
  text-align: left;
  border-bottom: 1px #<?php echo $popupcomb[2]?> solid;
  box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-moz-box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
	-webkit-box-shadow:
		0px 1px 0px #<?php shift_color($popupcomb[0],20)?>;
  -webkit-transition: padding 0.25s ease-out;
	-moz-transition: padding 0.25s ease-out;
  -ms-transition: padding 0.25s ease-out;
  -o-transition: padding 0.25s ease-out;
	transition: padding 0.25s ease-out;
}
.forgetLnk:link,
.forgetLnk:visited,
.forgetLnk:hover,
.loginLst a.active,
.loginLst a:hover {
  padding: 0 5px 0 25px;
	<?php $fonts->printFont('textfont', 'Hover') ?>
}
.passStrongness,
.regRequired,
.smallTxt.req:after {
  color: #<?php echo $textfont['Hover']['color'] ?>;
  content: " *";
}
.regRequired {
  display: block;
  margin: 3px 0 -3px;
}
<?php $circle = $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/circle.png", "010101", "0083e2")?>
<?php $hcircle= $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/circle.png", $textfont['Hover']['color'], "0083e2")?>
.loginLst a{
  background-color: transparent;
  background-repeat: no-repeat;
  background-image: url(<?php echo $circle ?>), url(<?php echo $hcircle ?>);
  background-position: 0 center, -100% 0;
	background-image: url(<?php echo $circle ?>)\9;
  background-position: 0 center\9;
}
.loginLst a.active,
.loginLst a:hover {
  background-position: -100% 0, 0 center;
  background-image: url(<?php echo $hcircle ?>)\9;
}
<?php $settings = $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/settings.png", "010101", "0083e2")?>
<?php $hsettings= $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/settings.png", $textfont['Hover']['color'], "0083e2")?>
.loginLst .settings {
	background-image: url(<?php echo $settings ?>), url(<?php echo $hsettings ?>);
  background-image: url(<?php echo $settings ?>)\9;
}
.loginLst .settings:hover {
  background-image: url(<?php echo $hsettings ?>)\9;
}
<?php $cart = $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/cart.png", "010101", "0083e2")?>
<?php $hcart= $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/cart.png", $textfont['Hover']['color'], "0083e2")?>
.loginLst .cart {
	background-image: url(<?php echo $cart ?>), url(<?php echo $hcart ?>);
  background-image: url(<?php echo $cart ?>)\9;
}
.loginLst .cart:hover {
  background-image: url(<?php echo $hcart ?>)\9;
}
<?php $off = $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/off.png", "010101", "0083e2")?>
<?php $hoff= $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/off.png", $textfont['Hover']['color'], "0083e2")?>
.loginLst .logout {
	background-image: url(<?php echo $off ?>), url(<?php echo $hoff ?>);
  background-image: url(<?php echo $off ?>)\9;
}
.loginLst .logout:hover {
  background-image: url(<?php echo $hoff ?>)\9;
}
.loginLst a.active,
.loginLst a.active:hover{
  background-image: none;
}
.loginLst a:last-child {
  border: 0;
  box-shadow:none;
	-moz-box-shadow:none;
	-webkit-box-shadow:none;
}
.ial-bg {
	visibility: hidden;
	position:absolute;
	background:#000 <?php if ($bgpattern!=-1) echo "url({$themeurl}images/patterns/".basename($blackoutcomb[1]).')';?>;
	top:0;left:0;
	width:100%;
	height:100%;
	z-index:9999;
  opacity: 0;
}
.ial-bg.ial-active {
  visibility: visible;
  opacity: <?php echo $blackoutcomb[0]/100 ?>;
}
.ial-load {
  display: block;
	position: absolute;
	width: 14px;
	height: 14px;
  margin: 6px;
	background: transparent url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/wait.png", $textfont['Text']['color'], "0083e2")?>) repeat-y 0 0;
}
.ial-usermenu .ial-load {
	margin: 4px 2px;
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/wait.png", $btngrad[2], "0083e2")?>);
}
.loginBtn .ial-load{
  visibility: hidden;
  background-image: url(<?php echo $this->cacheUrl.$helper->NewColorizeImage(dirname(__FILE__)."/../../themes/$theme/images/wait.png", $btnfont['Text']['color'], "0083e2")?>);
	margin: <?php echo (int)((14-$btnfont['Text']['size'])/2)?>px 0 0 -16px;
}
.loginBtn span {
  display: inline-block;
  cursor: default;
}
.fullWidth.selectBtn,
.fullWidth.selectBtn span {
  display: block;
  text-decoration: none;
  z-index: 0;
}
form.fullWidth {
  width: 100%;
}

form.Width335 {
  width: 335px;
}
.dj_ie9 .socialIco,
.dj_ie9 .ial-msg,
.dj_ie9 .loginBtn,
.dj_ie9 .loginBtn:hover,
.dj_ie9 .loginBtn:hover:active,
.dj_ie9 .selectBtn:hover .leftBtn,
.dj_ie9 .selectBtn:hover .rightBtn {
  filter: none;
}

:focus {
  outline: none !important;
}
::-moz-focus-inner {
  border: none !important;
}
@media screen and (max-width: 767px) {
  .socialIco {
    margin: 0 5px;
  }
  .captchaCnt {
    width: 184px;
  }
  .recaptchaImg {
    width: 100%;
    min-height: 0;
    transition: none;
    -o-transition: none;
    -ms-transition: none;
    -moz-transition: none;
    -webkit-transition: none;
  }
}