<?php
	//===========
	/* PayPal IPN */
	//===========

	if ( ! defined( 'ABSPATH' ) ) {
		exit(); 
	}

	if( empty($_POST['custom']) ) {
		exit('Missing data'); 
	}

	require_once( SEATREG_PLUGIN_FOLDER_DIR . 'php/seatreg_functions.php' );
    require_once( SEATREG_PLUGIN_FOLDER_DIR . 'php/libs/SeatregPayPalIpn.php' );

	$bookingId = sanitize_text_field($_POST['custom']);

	if( !SeatregBookingRepository::getBookingsById($bookingId) ) {
		exit('Booking not found'); 
	}

	$bookingData = SeatregBookingRepository::getDataRelatedToBooking($bookingId);
	$bookingTotalCost = seatreg_get_booking_total_cost($bookingId, $bookingData->registration_layout);
    $payPalIPN = new SeatregPayPalIpn(
		$bookingData->paypal_sandbox_mode === '1',
		$bookingData->paypal_business_email,
		$bookingData->paypal_currency_code,
		$bookingTotalCost,
		$bookingId,
		$bookingData->payment_completed_set_booking_confirmed,
		$bookingData->registration_code
	);
	$payPalIPN->run();

	header("HTTP/1.1 200 OK");