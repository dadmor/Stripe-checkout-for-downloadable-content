<?php
/**
 * Main App file
 */

require_once( 'config.php' );

require_once( 'lib/Stripe.php' );
require_once( 'inc/post-handler.php' );

include( 'views/index.html' );
