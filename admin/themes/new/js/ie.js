$(window).bind("load drilldown",function(){parseInt($.browser.version)<8&&($("table").attr("cellpadding",0).attr("cellspacing",0).attr("border",0),$("textarea, input, select, button").each(function(){updateBorderBox(this)}),$("input[type=button], input[type=submit], input[type=reset], button").each(function(){fixSize(this)}),$("a, button, input").attr("hideFocus",true));$("#wrapper > header, .user-info, .message-count, #wrapper > section > section > header, .portlet > header, .searchbox").each(function(){PIE.attach(this)})});
function updateBorderBox(a){a.runtimeStyle.width="";a.runtimeStyle.height="";var b=a.currentStyle.height;a.currentStyle.width!="auto"&&setBorderBoxWidth($(a).width(),a);b!="auto"&&setBorderBoxHeight($(a).height(),a)}function getBorderWidth(a,b){return b.currentStyle["border"+a+"Style"]=="none"?0:parseInt(b.currentStyle["border"+a+"Width"])||0}function getBorderLeftWidth(a){return getBorderWidth("Left",a)}function getBorderRightWidth(a){return getBorderWidth("Right",a)}
function getBorderTopWidth(a){return getBorderWidth("Top",a)}function getBorderBottomWidth(a){return getBorderWidth("Bottom",a)}function getPadding(a,b){return parseInt(b.currentStyle["padding"+a])||0}function getPaddingLeft(a){return getPadding("Left",a)}function getPaddingRight(a){return getPadding("Right",a)}function getPaddingTop(a){return getPadding("Top",a)}function getPaddingBottom(a){return getPadding("Bottom",a)}
function setBorderBoxWidth(a,b){b.runtimeStyle.width=Math.max(0,a-getBorderLeftWidth(b)-getPaddingLeft(b)-getPaddingRight(b)-getBorderRightWidth(b))+"px"}function setBorderBoxHeight(a,b){b.runtimeStyle.height=Math.max(0,a-getBorderTopWidth(b)-getPaddingTop(b)-getPaddingBottom(b)-getBorderBottomWidth(b))+"px"}function fixSize(a){a.runtimeStyle.height=$(a).height()-2+(getPaddingTop(a)+getPaddingBottom(a))+"px"};