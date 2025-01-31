<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

require_once(SEATREG_PLUGIN_FOLDER_DIR . 'php/libs/phpqrcode/qrlib.php');

function seatreg_send_booking_notification_email($registrationName, $bookedSeatsString, $emailAddress) {
    $message = esc_html__("Hello", 'seatreg') . "<br>" . sprintf(esc_html__("This is a notification email telling you that %s has a new booking", "seatreg"), esc_html($registrationName) ) . "<br><br> $bookedSeatsString <br><br>" . esc_html__("You can disable booking notification in options if you don't want to receive them.", "seatreg");
    $adminEmail = get_option( 'admin_email' );

    wp_mail($adminEmail, "$registrationName has a new booking", $message, array(
        "Content-type: text/html",
        "FROM: $adminEmail"
    ));
}

function seatreg_send_approved_booking_email($bookingId, $registrationCode) {
    global $seatreg_db_table_names;
    global $phpmailer;

    $GLOBALS['seatreg_qr_code_bookingid'] = $bookingId;

    $bookings = SeatregBookingRepository::getBookingsById($bookingId);
    $registration = SeatregRegistrationRepository::getRegistrationWithOptionsByCode($registrationCode);

    if( $registration->send_approved_booking_email === '0' ) {
        return false;
    }

    $roomData = json_decode($registration->registration_layout)->roomData;
    foreach ($bookings as $booking) {
        $booking->room_name = SeatregRegistrationService::getRoomNameFromLayout($roomData, $booking->room_uuid);
    }
    $isSingleBooking = count($bookings) === 1;
    $registrationName = $registration->registration_name;
    $bookerEmail = $bookings[0]->booker_email;
    $bookingStatusUrl = seatreg_get_registration_status_url($registration->registration_code, $bookingId);

    if(!$bookerEmail) {
        //No booker email detected. Booker email column was added with version 1.7.0.
        if($isSingleBooking) {
            $bookerEmail = $bookings[0]->email;
        }else {
            seatreg_add_activity_log('booking', $bookingId, "Not able to send out approved booking email. Booker email not specified", false);

            return false;
        }
    }

    $adminEmail = get_option( 'admin_email' );
    $message = '<p>' . sprintf(esc_html__("Thank you for booking at %s.", "seatreg"), esc_html($registrationName) ) . ' ' . esc_html__("Your booking is now approved", "seatreg")  . '</p>';

    $message .= '<p>';
    $message .= esc_html__('Booking ID: ', 'seatreg') . ' <strong>'. esc_html($bookingId) .'</strong><br>';
    $message .= esc_html__('Booking status link:', 'seatreg') . ' <a href="'. $bookingStatusUrl .'" target="_blank">'. esc_url($bookingStatusUrl) .'</a>';
    $message .= '</p>';

    $registrationCustomFields = json_decode($registration->custom_fields);
    $enteredCustomFieldData = json_decode($bookings[0]->custom_field_data);
    $customFieldLabels = array_map(function($customField) {
        return $customField->label;
    }, is_array( $enteredCustomFieldData) ? $enteredCustomFieldData : [] );

    $bookingTable = '<table style="border: 1px solid black;border-collapse: collapse;">
        <tr>
            <th style=";border:1px solid black;text-align: left;padding: 6px;">' . __('Name', 'seatreg') . '</th>
            <th style=";border:1px solid black;text-align: left;padding: 6px;"">' . __('Seat', 'seatreg') . '</th>
            <th style=";border:1px solid black;text-align: left;padding: 6px;"">' . __('Room', 'seatreg') . '</th>
            <th style=";border:1px solid black;text-align: left;padding: 6px;"">' . __('Email', 'seatreg') . '</th>';
    foreach($customFieldLabels as $customFieldLabel) {
        $bookingTable .= '<th style=";border:1px solid black;text-align: left;padding: 6px;">' . esc_html($customFieldLabel) . '</th>';
    }

    $bookingTable .= '</tr>';
 
    foreach ($bookings as $booking) {
        $bookingCustomFields = json_decode($booking->custom_field_data);
        $bookingTable .= '<tr>
            <td style=";border:1px solid black;padding: 6px;"">'. esc_html($booking->first_name . ' ' .  $booking->last_name) .'</td>
            <td style=";border:1px solid black;padding: 6px;"">'. esc_html($booking->seat_nr) . '</td>
            <td style=";border:1px solid black;padding: 6px;"">'. esc_html($booking->room_name) . '</td>
            <td style=";border:1px solid black;padding: 6px;"">'. esc_html($booking->email) . '</td>';

            if( is_array($bookingCustomFields) ) {
                foreach($bookingCustomFields as $bookingCustomField) {
                    $valueToDisplay = $bookingCustomField->value;

                    $customFieldObject = array_values(array_filter($registrationCustomFields, function($custField) use($bookingCustomField) {
                        return $custField->label === $bookingCustomField->label;
                    }));
    
                    if( count($customFieldObject) > 0 && $customFieldObject[0]->type === 'check' ) {
                        $valueToDisplay = $bookingCustomField->value === '1' ? esc_html__('Yes', 'seatreg') : esc_html__('No', 'seatreg');
                    }
                    $bookingTable .= '<td style=";border:1px solid black;padding: 6px;"">'. esc_html($valueToDisplay) . '</td>';
                }
            }
        
        $bookingTable .= '</tr>';
    }

    $bookingTable .= '</table>';
    $message .= $bookingTable;
    $qrType = $registration->send_approved_booking_email_qr_code;
    
    if( extension_loaded('gd') && $qrType ) {
        if (!file_exists(SEATREG_TEMP_FOLDER_DIR)) {
            mkdir(SEATREG_TEMP_FOLDER_DIR, 0775, true);
        }

        $bookingCheckURL = get_site_url() . '?seatreg=booking-status&registration=' . $registration->registration_code . '&id=' . $bookingId;
        $qrContent = $qrType === 'booking-id' ? $bookingId : $bookingCheckURL;

        QRcode::png($qrContent, SEATREG_TEMP_FOLDER_DIR. '/'.$bookingId.'.png', QR_ECLEVEL_L, 4);
        
        add_action( 'phpmailer_init', function($phpmailer){
            $bookingId = $GLOBALS['seatreg_qr_code_bookingid'];
            $phpmailer->AddEmbeddedImage( SEATREG_TEMP_FOLDER_DIR. '/' .$bookingId.'.png', 'qrcode', 'qrcode.png');
        });
        
        $message .= '<br><img src="cid:qrcode" />';
    }
    
    $isSent = wp_mail($bookerEmail, "Your booking at $registrationName is approved", $message, array(
        "Content-type: text/html",
        "FROM: $adminEmail"
    ));

    if($isSent) {
        $activityMessage = $qrType ? "Approved booking email with QR Code sent to $bookerEmail": "Approved booking email sent to $bookerEmail";
        seatreg_add_activity_log('booking', $bookingId, $activityMessage, false);
        return true;
    }
    return false;
}