jQuery(document).ready(function(e){
	var $ = jQuery;
	jQuery('#fixed-navbar').scrollToFixed({
		preFixed: function() { jQuery(this).css('box-shadow', '0px 1px 1px #888').find('.navbar-brand').css('display', 'inline'); },
		postFixed: function() { jQuery(this).css('box-shadow', '0px 2px 2px #888').find('.navbar-brand').css({display:'none'}); }
	});

	jQuery('article .entry-content').each(function(i,e){
		jQuery(e).html(jQuery(e).html().replace(/`(.*?)`/ig, '<code>$1</code>'));
	})

	hljs.configure({useBR: false});

	jQuery('pre, code.hljs').each(function(i, block) {
		// if($(block).attr('class') != '' && $(block).attr('class').match('lang')){
		// 	var x = $(block).attr('class').split(' ')
		// }
		if($(block).attr('remotepath')){
			$.get($(block).attr('remotepath'), function(data){
				$(block).text(data);
			}).promise().done(function() {
				hljs.highlightBlock( block );
			});
		} else {
			hljs.highlightBlock(block);
		}
	});

});