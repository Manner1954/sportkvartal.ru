;(function($) {
  var Selected = $(0),
      UnSelect = null;

  $.widget("gi.selectable", {
    options: {
      className: "gi-selected",
      selected: false,
      select: null
    },

    _create: function() {
      this.element.addClass(this.widgetFullName);
      if (this.options.select) {
        this.element.on("mousedown"+this.eventNamespace+" touchstart"+this.eventNamespace,
          $.proxy(this, "triggerSelect"));
      }
      if (this.options.selected) this.triggerSelect();
    },

    triggerSelect: function(e) {
      Selected.removeClass(Selected.selectable("option", "className"));
      Selected = this.element.addClass(this.options.className);
      this._trigger('select', e, Selected);
    },

    unSelect: function() {
      this.element.removeClass(this.options.className);
      this.options.selected = false;
      if (UnSelect) UnSelect(Selected);
      Selected = $(0);
    }
  });

  $.extend($.fn.selectable, {
    getSelected: function() {
      return Selected;
    },

    removeSelection: function(e) {
      if (e) {
        var node = e.target;
        while (node.parentNode) {
          if ($(node).hasClass("gi-selectable")) return;
          else node = node.parentNode;
        }
      }
      Selected.selectable("unSelect");
    },

    onUnSelect: function(eHandler) {
      UnSelect = eHandler;
    }
  });
})(jQuery);

/*
;(function($, undefined) {
  var style,
      ss;

  function init() {
    style = $('<style type="liveCSS" />').appendTo(document.head)[0];
    ss = document.styleSheets[document.styleSheets.length - 1];
    ss.selectors = {};
  }

  function addRule(selector, rules) {
    if (ss.insertRule) {
      var i = ss.insertRule(selector + "{}", ss.cssRules.length);
      ss.selectors[ss.cssRules[i].selectorText] = i;
      ss.cssRules[i].style
    } else {
      console.warn("Old browser! CSS will be not correct!");
    }
  }

  function editRule() {
  }

  $.liveCSS = function(selector, rules) {
    if (!style) init();
    if (ss.selectors[selector] === undefined) addRule(selector, rules);
    else editRule(selector, rules);
  };

})(jQuery);
*/

;(function($, undefined) {
  JForm = {
    save: function() {
      var elems = {page: [ {elem: []} ]},
          props = {};
      // save props
      props.layout = $(document.layoutForm).jformObject().toObject();
      $("#jform_props").val(JSON.stringify(props));
      // save fields
      $("#design-layer").children().each(function() {
        elems.page[0].elem.push(this.jfo.toObject());
      });
      $("#jform_fields").val(JSON.stringify(elems));
    },

    load: function() {
      var layer = $("#design-layer"),
          elems = $.parseJSON($("#jform_fields").val()),
          props = $.parseJSON($("#jform_props").val());
      if (props.layout) {
        $(document.layoutForm).jformObject(props.layout);
      }
      if (elems.page) {
        elems = elems.page[0].elem;
        var i, elem, jfo, type;
        for (i = 0; i < elems.length; i++) {
          elem = $('<div>').appendTo(layer);
          jfo = new JFormObject(elems[i]);
          jfo.prefix = "jform[elem_";
          jfo.suffix = "]";
          type = jfo.get("type");
          if (type.predefined) {
            elem.addClass("ui-draggable-disabled");
            elem.attr("data-elem", type.predefined);
          } else elem.attr("data-elem", type.value);
          // make saved element properties compatible with updates
          elem.prop("jfo", $.extend(true,
            new JFormObject(PredefinedElems[elem.data("elem")], "jform[elem_", "]"), jfo));
        }
      }
    }
  };

  (JFormObject = function(obj, prefix, suffix) {
    if (typeof obj === "object") {
      var key, clone = $.extend(true, {}, obj);
      if (prefix) this.prefix = prefix;
      if (suffix) this.suffix = suffix;
      for (key in clone) this[this.prefix + key + this.suffix] = clone[key];
    }
    return this;
  }).prototype = {
    prefix: "",
    suffix: "",

    get: function(key) {
      var value = this[this.prefix + key + this.suffix];
      return value? value : "";
    },
    toObject: function() {
      var key, obj = {};
      for (key in this) if (this.__proto__[key] === undefined) obj[key] = this[key];
      return obj;
    }
  };

  function disable(elem, disabled) {
    if (elem.type == "hidden") return;
    elem.parentNode.parentNode.style.display = disabled? "none" : "table-row";
  }

  $.fn.jformObject = function(obj) {
    var elems = this.length? this[0].elements : [],
        elem, name, value, i;

    if (obj === undefined || $.isArray(obj)) {
      // getter
      var jfo = new JFormObject();
      if (obj) for (i = 0; i < obj.length; i++) {
        elem = elems[ obj[i] ];
        if (!elem.name) for (var j = 0; j < elem.length; j++) {
          if (elem[j].checked) {
            jfo[ elem[j].name ] = elem[j].value;
            break;
          }
        } else jfo[elem.name] = elem.value;
      } else for (i = 0; i < elems.length; i++) {
        elem = elems[i];
        if (elem.type == "radio" && !elem.checked || !elem.name) continue;
        jfo[elem.name] = elem.value;
      }
      return jfo;
    } else {
      // setter
      for (i = 0; i < elems.length; i++) {
        elem = elems[i];
        if (elem.name) {
          // text, textarea, checkbox, hidden
          name = elem.name;
          if (obj[name]) {
            if (typeof obj[name] === "object") $(elem).attr(obj[name]);
            else $(elem).val(obj[name]);
          }
        } else if (elem.tagName.toLowerCase() == "fieldset") {
          // radio TODO
          name = elems[i+1].name;
          value = obj[name].value? obj[name].value : obj[name];
          do {
            i++;
            if (!obj[name]) continue;
            var $radio = $(elems[i]);
            if (elems[i].value === value) {
              $radio.attr("checked", true);/*
              $radio.next().addClass("active "
                +(elems[i].value == "0"? "btn-danger" : "btn-success"));*/
            } else {/*
              $radio.next().removeClass("active "
                +(elems[i].value == "0"? "btn-danger" : "btn-success"));*/
            }
          } while (elems[i+1].name == name);
        }
        disable(elem, obj[name] === undefined);
      }
      return this;
    }
  };
})(jQuery);

;(function($, undefined) {

  function getFrame(jfo) {
    var type = jfo.get("type");
    if (jfo.get("clear").checked) this.addClass("gi-clear");
    if (jfo.get("wide").checked) this.addClass("gi-wide");
    return '<span class="btn gi-elem-name"><i class="'+type.icon+'"></i> '+type.button+'</span>'+
    '<div data-attr="clear wide" class="gi-elem"></div>';
  }

  function getTmpl(jfo) {
    var type = jfo.get("type"),
        required = jfo.get("required"),
        id = jfo.get("id"),
        name = jfo.get("name"),
        label = jfo.get("label"),
        value = jfo.get("value"),
        ph = jfo.get("placeholder"),
        title = jfo.get("title"),
        error = jfo.get("error");
    if (name.prefix) name = name.prefix + name.value + "]";
    if (jfo.get("clear").checked) this.addClass("gi-clear");
    if (jfo.get("wide").checked) this.addClass("gi-auto");
    label = label.value? label.value : label.placeholder;
    switch (type.value) {
      case "textfield":
      case "password2":
        var re = jfo.get("pattern");
        return '<label data-attr="label required" class="smallTxt'+(label.match(/[^\s]/)?'':' hidden')+(required.checked?' req':'')+'" for="'+id.value+'">'+label+'</label>'+
        '<input data-attr="id name title placeholder pattern value" class="loginTxt regTxt" id="'+id.value+'" name="'+name+'"'+
         (jfo.get("autoCompOff")?' autocomplete="off"':'')+'value="'+(value? value.value : '')+'" pattern="'+(re? re.value : '')+'"'+
        ' placeholder="'+(ph.value? ph.value : ph.placeholder)+'" type="'+type.defaultValue+'" title="'+(title.value? title.value : title.placeholder)+'" /><div'+
        ' data-attr="error" class="hidden">'+(error.value? error.value : error.placeholder)+'</div>';
      case "textarea":
        var re = jfo.get("pattern");
        return '<label data-attr="label required" class="smallTxt'+(label.match(/[^\s]/)?'':' hidden')+(required.checked?' req':'')+'" for="'+id.value+'">'+label+'</label>'+
        '<textarea data-attr="name title value placeholder pattern" class="loginTxt regTxt" id="'+id.value+'" name="'+name+'" value="'+(value? value.value : '')+'"'+
        ' placeholder="'+(ph.value? ph.value : ph.placeholder)+'" pattern="'+(re? re.value: '')+'" title="'+(title.value? title.value : title.placeholder)+'"></textarea>';
      case "password1":
        return '<label data-attr="label required" class="smallTxt'+(label.match(/[^\s]/)?'':' hidden')+(required.checked?' req':'')+'" for="'+id.value+'">'+label+'</label>'+
        '<label class="smallTxt passStrongness" for="passReg"></label>'+
        '<input data-attr="id name title placeholder" class="loginTxt regTxt" id="'+id.value+'" name="'+name+'" autocomplete="off"'+
        ' placeholder="'+(ph.value? ph.value : ph.placeholder)+'" type="'+type.defaultValue+'" title="'+(title.value? title.value : title.placeholder)+'" /><div'+
        ' data-attr="error" class="hidden">'+(error.value? error.value : error.placeholder)+'</div>'+
        '<label class="strongFields" for="'+id.value+'"><i class="empty strongField"></i><i class="empty strongField"></i>'+
        '<i class="empty strongField"></i><i class="empty strongField"></i><i class="empty strongField"></i></label>';
      case "captcha":
        return '<input type="hidden" id="'+id.value+'" name="'+name+'" />'+
        '<label for="recaptchaResponse" class="captchaCnt"><span id="refreshBtn" class="ial-close loginBtn">'+
        '<img src="'+jfo.get("captchaImg")+'" alt="" width="8" height="10" /></span><img src="'+jfo.get("closeImg")+'" /></label>';
      case "button":
        var subtitle = jfo.get("subtitle");
        return '<label data-attr="subtitle" class="smallTxt'+(subtitle.value?'':' hidden')+'">'+(subtitle.value? subtitle.value : '')+'</label><br />'+
        '<button class="loginBtn ial-submit" id="submitReg"><span data-attr="label">'+label+'</span></button>';
      case "header":
        var subtitle = jfo.get("subtitle");
        return '<h3 class="loginH3"><span data-attr="label">'+label+'</span>'+
        '<span data-attr="subtitle" class="smallTxt regRequired">'+(subtitle.value? subtitle.value : subtitle.placeholder)+'</span></h3>';
      case "label":
        return '<span data-attr="label" class="smallTxt">'+label+'</span>';
      case "checkbox":
        var checked = jfo.get("checked");
        return '<span class="ial-checkbox'+(checked.checked?' avtive':'')+'"></span><input data-attr="id name checked" class="hidden" id="'+id.value+'" name="'+name+'"'+
        ' type="checkbox"'+(checked.checked?' checked="checked"':'')+' />'+
        '<label data-attr="label title required" class="smallTxt checkLbl'+(required.checked?' req':'')+'"'+
        ' for="'+id.value+'" title="'+(title.value? title.value : title.placeholder)+'">'+label+'</label>';
      case "tos":
        var checked = jfo.get("checked"),
            article = jfo.get("article");
            articleName = jfo.get("article_name");
        return '<span class="ial-checkbox'+(checked.checked?' avtive':'')+'"></span><input data-attr="id name checked" class="hidden" id="'+id.value+'" name="'+name+'"'+
        ' type="checkbox"'+(checked.checked?' checked="checked"':'')+' />'+
        '<label data-attr="label title required" class="smallTxt ial-check-lbl'+(required.checked?' req':'')+'"'+
        ' for="'+id.value+'" title="'+(title.value? title.value : title.placeholder)+'">'+label+'</label>'+
        '<a data-attr="article_name" class="forgetLnk" href="'+(article.value? JURI+'index.php?option=com_content&view=article&id='+article.value : '#')+'"'+
        ' onclick="if (JBackend) return false;" target="_blank">'+(articleName.value? articleName.value : articleName.placeholder)+'</a>';
    }
  }

  function setAttr(name, value, placeholder) {
    var attr = name.match(/_(.*)]/)[1],
        node = $("[data-attr*="+attr+"]", this);
    switch (attr) {
      case "id":
        $("[data-attr*=label]", this).attr("for", value);
      case "name":
      case "value":
      case "placeholder":
      case "pattern":
      case "title":
        this.prop("jfo")[name].value = value;
        if (this.prop("jfo")[name].prefix) value = this.prop("jfo")[name].prefix + value + "]";
        return node.attr(attr, value? value : placeholder);
      case "subtitle":
      case "label":
        node[(value?value:placeholder).match(/[^\s]/)? "removeClass" : "addClass"]("hidden");
      case "error":
        this.prop("jfo")[name].value = value;
        return node.html(value? value : placeholder);
      case "required":
        this.prop("jfo")[name].checked = value;
        return node[value? "addClass" : "removeClass"]("req");
      case "wide":
        node[value? "addClass" : "removeClass"]("gi-auto");
      case "clear":
        this.prop("jfo")[name].checked = value;
        this[value? "addClass" : "removeClass"]("gi-"+attr);
        return node;
      case "checked":
        this.prop("jfo")[name].checked = value;
        node.prev()[value? "addClass" : "removeClass"]("active");
        return node.attr("checked", value);
      case "article":
        var articleName = $("[id$=article_name]")[0];
        this.prop("jfo")[name].value = value;
        this.prop("jfo").get("article_name").value = articleName.value;
        if (value) node.attr("href", JURI+"index.php?option=com_content&view=article&id="+value);
        return node.html(articleName.value? articleName.value : articleName.placeholder);
    }
  }

  $.fn.elem = function(name, value, placeholder) {
    return this.each(function() {
      var $this = $(this);
      if (name === undefined) {
        // constructor
        var jfo = $this.prop("jfo");
        if (!jfo) jfo = new JFormObject(PredefinedElems[$this.attr("data-elem")], "jform[elem_", "]");
        $this.html(getFrame.call($this, jfo));
        var $elem = $this.find(".gi-elem");
        $elem.html(getTmpl.call($elem, jfo));
        return;
      }
      if (value !== undefined) {
        // setter
        setAttr.call($this, name, value, placeholder? placeholder : "");
        return;
      }
    });
  };
})(jQuery);

jQuery(function($) {
  var delBtn = $("#delete-btn"),
      formTab = $("#form-tab"),
      elemTab = $("#elem-tab"),
      prop = $(".gi-properties"),
      adminForm = $(document.adminForm),
      layoutForm = $(document.layoutForm),
      elemForm = $(document.elemForm),
      initialized = init();

  function init() {
    // load saved fields and properties
    JForm.load();
    // init layout
    onChangeLayoutProp();
    // init theme
    $("[data-elem]").elem();
    // init accordion menus
    $(".ui-accordion").accordion({
      heightStyle: "content",
      animate: 250
    });
    // init draggable elements
  	$(".ui-draggable").draggable({
  		connectToSortable: "#design-layer",
      revert: false,
      cancel: null,
  		helper: function() {
        var hlp = $(this).clone();
        hlp.find(".gi-elem-name").css("display", "none");
        hlp.find(".gi-elem").css("display", "block");
        hlp.addClass("gi-move");
        $.fn.selectable.removeSelection();
        return hlp;
      }
  	}).addClass("gi-selectable");
    // disable predefined elements which are in use
    $("#design-layer [data-elem]").each(function() {
      var predefined = this.jfo.get("type").predefined;
      if (predefined) {
        this.predefined = $("[data-elem="+predefined+"]:first").draggable("disable");
        $(".gi-elem-name", this.predefined).addClass("disabled");
      }
    });
    // init dropable and sortable elements
    $("#design-layer").droppable({
      drop: function(e, ui) {
        this.lastDropped = ui.draggable;
      }
    }).sortable({
      revert: 333,
      cursor: "move",
      cancel: null,
      receive: onReceiveSortable
  	}).disableSelection();
    // init selectable elements
    $("#design-layer").children().selectable({select: onSelect});
    $("#design-layer").on("mousedown touchstart", $.fn.selectable.removeSelection);
    $.fn.selectable.onUnSelect(onUnSelect);
    // init events
    delBtn.on("click", onClickDelBtn);
    $(document).on("keypress", onKeyPressDocument);
    $("#jform_layout_columns").on("click", onChangeLayoutProp);
    $("input[type=text]", layoutForm).on("change", onChangeLayoutProp);
    $("input[type=text]", layoutForm).on("focus", onFocusLayoutProp);
    $("input[type=text], textarea", elemForm).on("keyup", onChangeElemProp);
    $("input[type=checkbox]", elemForm).on("change", onChangeElemProp);
    $("input[type=hidden]", elemForm).on("change", onChangeElemProp);

    return true;
  }

  function onReceiveSortable(e, ui) {
    var elem = this.lastDropped.data("elem"),
        jfo = new JFormObject(PredefinedElems[elem], "jform[elem_", "]");
    this.lastDropped.prop("jfo", jfo);
    this.lastDropped.selectable({
      selected: true,
      select: onSelect
    });
    //#hernyókisfanni## xoxo gossipgilr <3123.4
    if (jfo.get("type").predefined) {
      this.lastDropped.prop("predefined", ui.item.draggable("disable"));
      $(".gi-elem-name", ui.item).addClass("disabled");
    }
  }

  function onSelect(e, ui) {
    var jfo = ui.prop("jfo");
    elemForm.jformObject(jfo);

    delBtn.removeClass("disabled");
    elemTab.parent().removeClass("hidden");
    elemTab.tab("show");
  }

  function onUnSelect(ui) {
    delBtn.addClass("disabled");
    elemTab.parent().addClass("hidden");
    formTab.tab("show");
  }

  function onClickDelBtn() {
    var selected = $.fn.selectable.getSelected();
    if (selected.length && confirm("Are you sure you want to delete?")) {
      var predefined = selected.prop("predefined");
      if (predefined) {
        $(".gi-elem-name", predefined).removeClass("disabled");
        predefined.draggable("enable");
      }
      $.fn.selectable.removeSelection();
      selected.selectable("destroy").animate({
        opacity: 0,
        height: 0
      }, 300, "swing", $.proxy(selected, "remove"));
    }
  }

  function onChangeElemProp(e) {
    var target = e.currentTarget;
    $.fn.selectable.getSelected().elem(
      target.name,
      target.type == "checkbox"? target.checked : target.value,
      target.placeholder
    );
  }

  function onChangeLayoutProp(e) {
    var lColumn = $("#jform_layout_columns :checked").val(),
        lWidth = parseInt($("#jform_layout_width").val()),
        lMargin = parseInt($("#jform_layout_margin").val()),
        d1 = 0, d2 = 0;
    if (e && e.currentTarget.prevValue) {
      var input = e.currentTarget;
      if (isNaN(parseInt(input.value))) input.value = input.prevValue;
      if (parseInt(input.prevValue) > parseInt(input.value)) d1 = 33;
      else d2 = 33;
      input.value = parseInt(input.value)+"px";
    }
    jss("#design-layer", {
      width: lColumn*(2 + lWidth + 2*lMargin) + "px",
      WebkitTransitionDelay: d1 + "ms",
      transitionDelay: d1 + "ms"
    });
    jss(".gi-elem", {
      width: lWidth + "px",
      margin: "0 " + lMargin + "px",
      WebkitTransitionDelay: d2 + "ms",
      transitionDelay: d2 + "ms"
    });
  }

  function onFocusLayoutProp(e) {
    e.currentTarget.prevValue = e.currentTarget.value;
  }

  function onKeyPressDocument(e) {
    switch(e.keyCode) {
      case 13:  // enter
        if (e.target.blur) e.target.blur();
        break;
      case 46:  // delete
        if (e.target == document.body) onClickDelBtn();
        break;
    }
  }

});