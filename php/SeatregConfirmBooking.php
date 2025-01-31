<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit(); 
}

//===========
	/* For booking confirm */
//===========

class SeatregConfirmBooking extends SeatregBooking {
	public $reply;
	protected $_confirmationCode;
	protected $_bookindId;
	protected $_registrationOwnerEmail;
	
	public function __construct($code){
		$this->_confirmationCode = $code;
	}

	protected function getNotConfirmedBookings() {
		//find out if confirmation code is in db and return all bookings with that code
		global $wpdb;
		global $seatreg_db_table_names;

		$rows = SeatregBookingRepository::getBookingByConfCode($this->_confirmationCode);

		if(count($rows) == 0) {
			$this->reply = esc_html__('This booking is already confirmed/expired/deleted', 'seaterg');
			$this->_valid = false;
		}else {
			$registration = SeatregRegistrationRepository::getRegistrationByCode($rows[0]->registration_code);
			$roomData = json_decode($registration->registration_layout)->roomData;
			$this->_bookings = $rows; 
			foreach ($this->_bookings as $booking) {
				$booking->room_name = SeatregRegistrationService::getRoomNameFromLayout($roomData, $booking->room_uuid);
			}
			$this->_registrationCode = $this->_bookings[0]->registration_code; 
			$this->_bookingId = $this->_bookings[0]->booking_id;
		}
	}

	public function confirmBookings() {
		global $wpdb;
		global $seatreg_db_table_names;

		$approvedTimestamp = ($this->_insertState == 2) ? time() : null;

		$rowsUpdated = $wpdb->update( 
			$seatreg_db_table_names->table_seatreg_bookings,
			array( 
				'status' => $this->_insertState,
				'booking_confirm_date' => $approvedTimestamp 
			), 
			array('booking_id' => $this->_bookingId), 
			'%d',
			'%d',
			'%s'
		);

		if(!$rowsUpdated) {
			esc_html_e('Something went wrong while confirming your booking', 'seatreg');
			die();
		}

		if($this->_insertState == 1) {
			seatreg_add_activity_log('booking', $this->_bookingId, 'Booking set to pending state by the system', false);
			esc_html_e('You booking is now in pending state. Registration owner must approve it', 'seatreg');
			echo '.<br><br>';
		}else {
			seatreg_add_activity_log('booking', $this->_bookingId, 'Booking set to approved state by the system', false);
			seatreg_send_approved_booking_email($this->_bookingId, $this->_registrationCode);
			esc_html_e('You booking is now confirmed', 'seatreg');
			echo '<br><br>';
		}
		$bookingCheckURL = seatreg_get_registration_status_url($this->_registrationCode, $this->_bookingId);

		printf(
			esc_html__('You can look your booking at %s', 'seatreg'), 
			"<a href='" . esc_url($bookingCheckURL) . "'>" . esc_html($bookingCheckURL) . "</a>"
		);

		if($this->_sendNewBookingNotificationEmail) {
			$seatsString = $this->generateSeatString();
			seatreg_send_booking_notification_email($this->_registrationName, $seatsString, $this->_sendNewBookingNotificationEmail);
		}
	}

	public function startConfirm() {
		$this->getNotConfirmedBookings();

		if(!$this->_valid) {
			esc_html_e($this->reply);

			return;
		}

		$this->getRegistrationAndOptions();

		//1 step
		//Selected seat limit check
		if(!$this->seatsLimitCheck()) {
			esc_html_e('Error. Seat limit exceeded', 'seatreg');

			return;
		}

		//2 step. Does confirmation code exists? Is booking already confirmed?
		if(!$this->_valid) {
			esc_html_e($this->reply);

			return;
		}
		
		//3 step. Is registtration open?
		if(!$this->_isRegistrationOpen) {
			esc_html_e('Registration is closed at the moment', 'seaterg');

			return;
		}
		$registrationTimeCheck = seatreg_registration_time_status($this->_registrationStartTimestamp, $this->_registrationEndTimestamp);
		if($registrationTimeCheck != 'run') {
			esc_html_e('Registration is not open', 'seatreg');

			return;
		}

		//4 step. Check if all selected seats are ok
		$seatsStatusCheck = $this->doSeatsExistInRegistrationLayoutCheck();
		if($seatsStatusCheck != 'ok') {
			echo $seatsStatusCheck;

			return;
		}

		//5 step. Check if seat/seats is already bron or taken
		$seatsOpenCheck = $this->isAllSelectedSeatsOpen(); 
		if($seatsOpenCheck != 'ok') {
			echo $seatsOpenCheck;

			exit();
		}	

		//6 step. confirm bookings
		$this->confirmBookings();
	}
}