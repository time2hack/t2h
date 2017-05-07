jQuery(document).ready(function(e){
  var $ = jQuery;
  jQuery('#fixed-navbar').scrollToFixed({
    preFixed: function() { jQuery(this).css('box-shadow', '0px 1px 1px #888').find('.navbar-brand').css('display', 'inline'); },
    postFixed: function() { jQuery(this).css('box-shadow', '0px 2px 2px #888').find('.navbar-brand').css({display:'none'}); }
  });

  jQuery('article .entry-content').each(function(i,e){
    jQuery(e).html(jQuery(e).html().replace(/`(.*?)`/ig, '<code>$1</code>'));
  })
  window.hljs && hljs.configure({useBR: false});
  
  jQuery('pre, code.hljs').each(function(i, block) {
    if($(block).attr('remotepath')){
      $.get($(block).attr('remotepath'), function(data){
        $(block).text(data);
      }).promise().done(function() {
        window.PR && (function(){ 
          $(block).addClass('prettyprint');
          PR.prettyPrint();
        })()
        window.hljs && hljs.highlightBlock( block );
      });
    } else {
      window.PR && $(block).addClass('prettyprint');
      window.hljs && hljs.highlightBlock(block);
    }
  });
});
