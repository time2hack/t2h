<?php
/**
 * Displays the footer section of the theme.
 *
 * @package 	Time to Hack
 * @subpackage 	T2H
 * @since 		T2H 1.0
 */
?>
	   </div><!-- #main -->
	   <footer id="colophon" class="clearfix">
		<div class="container">
<?php if( !is_single() ){ ?>
<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<?php if(function_exists("wp_template_ad")) { wp_template_ad("1"); } ?>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<?php if(function_exists("wp_template_ad")) { wp_template_ad("1"); } ?>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<?php if(function_exists("wp_template_ad")) { wp_template_ad("1"); } ?>
</div>
</div>
<?php } ?>
	   		<div class="row">
			  <div class="col-lg-12">
				<ul class="list-unstyled">
				  <li class="pull-right"><a href="#top">Back to top</a></li>
				  <li><a href="http://feeds.feedburner.com/time_to_hack">RSS</a></li>
				  <li><a href="https://twitter.com/time2hack">Twitter</a></li>
				  <li><a href="https://github.com/pankajpatel">GitHub</a></li>
				  <!-- <li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=F22JEM3Q78JC2">Donate</a></li> -->
				</ul>
				<!--<p>Made by <a href="http://thomaspark.me">Thomas Park</a>. Contact him at <a href="mailto:hello@thomaspark.me">hello@thomaspark.me</a>.</p>
				<p>Code licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.</p> Favicon by <a href="https://twitter.com/geraldhiller">Gerald Hiller</a>.-->
				<p>Based on <a href="http://getbootstrap.com">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts">Google</a>.Reach us at <a href="https://plus.google.com/+Time2hack" rel="publisher">Google+</a></p>
			  </div>
			</div>
			</div><!-- .container -->
		</footer>
	</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>