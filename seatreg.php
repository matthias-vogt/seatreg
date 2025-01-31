<?php
/*
	Plugin Name: SeatReg
	Plugin URI: https://github.com/SiimKirjanen/seatreg
	Description: Create and manage seat registrations. Design your own seat maps and manage seat bookings
	Author: Siim Kirjanen
	Author URI: https://github.com/SiimKirjanen
	Text Domain: seatreg
	Domain Path: /languages
	Version: 1.13.0
	Requires at least: 5.3
	Requires PHP: 7.2.28
	License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

require( 'php/constants.php' );
require( 'php/repositories/SeatregBookingRepository.php' );
require( 'php/repositories/SeatregRegistrationRepository.php' );
require( 'php/repositories/SeatregPaymentRepository.php' );
require( 'php/repositories/SeatregOptionsRepository.php' );
require( 'php/repositories/SeatregActivityLogRepository.php' );
require( 'php/repositories/SeatregPaymentLogRepository.php' );
require( 'php/services/SeatregRegistrationService.php' );
require( 'php/services/SeatregBookingService.php' );
require( 'php/services/SeatregPaymentService.php' );
require( 'php/emails.php' );
require( 'php/SeatregBooking.php' );
require( 'php/SeatregSubmitBookings.php' );
require( 'php/SeatregDataValidation.php' );
require( 'php/util/registration_time_status.php' );

if( is_admin() ) {
	require( 'php/enqueue_admin.php' );
	require( 'php/seatreg_admin_panel.php' );	
}

if( !is_admin() ) {
	require( 'php/enqueue_public.php' );
}

require( 'php/seatreg_functions.php' );
require( 'php/SeatregJsonResponse.php' );

//Actions
require( 'php/seatreg_actions.php' );

//Hooks
function seatreg_plugin_activate() {
	seatreg_set_up_db();
}
register_activation_hook( __FILE__, 'seatreg_plugin_activate' );

//Filters
require( 'php/seatreg_filters.php' );

//shortcode
require( 'php/seatreg_shortcode.php' );