;(function($, undefined) {

$.createOOPlugin("ialHeader", "ialElem", {
  tmpl:
    '<h3 class="loginH3">'+
      '<span data-attr="label" />'+
      '<span data-attr="subtitle" class="smallTxt regRequired" />'+
    '</h3>'
});

$.createOOPlugin("ialTextfield", "ialTextfieldBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<input data-attr="id name title placeholder pattern value"'+
    ' class="loginTxt regTxt" type="text" />'+
    '<div data-attr="error" class="hidden" />'
});

$.createOOPlugin("ialPassword1", "ialPassword1Base", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<label class="smallTxt passStrongness" />'+
    '<input data-attr="id name title placeholder"'+
    ' class="loginTxt regTxt" type="password" autocomplete="off" />'+
    '<div data-attr="error" class="hidden" />'+
    '<label class="strongFields">'+
      '<i class="empty strongField" /><i class="empty strongField" />'+
      '<i class="empty strongField" /><i class="empty strongField" />'+
      '<i class="empty strongField" />'+
    '</label>'
});

$.createOOPlugin("ialPassword2", "ialElem", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<input data-attr="id name title placeholder value"'+
    ' class="loginTxt regTxt" type="password" />'+
    '<div data-attr="error" class="hidden" />'
});

$.createOOPlugin("ialTextarea", "ialElem", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<textarea data-attr="name title value placeholder"'+
    ' class="loginTxt regTxt" />'
});

$.createOOPlugin("ialCaptcha", "ialCaptchaBase", {
  tmpl:
    '<input name="recaptchaChallenge" type="hidden" />'+
    '<div class="captchaCnt">'+
      '<span class="ial-close loginBtn">'+
        '<i class="ial-icon-refr" />'+
      '</span>'+
      '<img class="ial-captcha" />'+
    '</div>'
});

$.createOOPlugin("ialButton", "ialElem", {
  tmpl:
    '<label data-attr="subtitle" class="smallTxt" />'+
    '<button class="loginBtn ial-submit" name="submit">'+
      '<span>'+
        '<i class="ial-load" />'+
        '<span data-attr="label" />'+
      '</span>'+
    '</button>'
});

$.createOOPlugin("ialLabel", "ialElem", {
  tmpl: '<span data-attr="label" class="smallTxt" />'
});

$.createOOPlugin("ialCheckbox", "ialElem", {
  tmpl:
    '<label data-attr="title required" class="ial-check-lbl smallTxt">'+
      '<input data-attr="id name checked"'+
      ' type="checkbox" class="ial-checkbox" />'+
      '<span data-attr="label" />'+
    '</label>'
});

$.createOOPlugin("ialTos", "ialTosBase", {
  tmpl:
    '<label data-attr="title required" class="ial-check-lbl smallTxt">'+
      '<input data-attr="id name checked"'+
      ' type="checkbox" class="ial-checkbox" />'+
      '<span data-attr="label" />'+
    '</label>'+
    '<a data-attr="article" class="forgetLnk" href="javascript:;" />'
});

})(window.jq183 || jQuery);