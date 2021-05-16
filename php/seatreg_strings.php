<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

function seatreg_generate_registration_strings() {
	$translations = new stdClass();
	$translations->illegalCharactersDetec = esc_html__('Illegal characters detected', 'seatreg');
	$translations->emailNotCorrect = esc_html__('Email address is not correct', 'seatreg');
	$translations->wrongCaptcha = esc_html__('Wrong code!', 'seatreg');
	$translations->somethingWentWrong = esc_html__('Something went wrong. Please try again', 'seatreg');
	$translations->selectionIsEmpty = esc_html__('Seat selection is empty', 'seatreg');
    $translations->youCanAdd_ = esc_html__('You can add ', 'seatreg');
    $translations->_toCartClickTab = esc_html__(' to selection by selecting boxes', 'seatreg');
	$translations->toCartClickTab = esc_html__(' to selection by clicking/tabbing them', 'seatreg');
	$translations->regClosedAtMoment = esc_html__('Registration is closed at the moment', 'seatreg');
	$translations->confWillBeSentTo = esc_html__('Confirmation will be sent to:', 'seatreg');
	$translations->confWillBeSentTogmail = esc_html__('Confirmation will be sent to (Gmail):', 'seatreg');
	$translations->gmailReq = esc_html__('Email (Gmail required)', 'seatreg');
	$translations->_fromRoom_ = esc_html__(' from room ', 'seatreg');
	$translations->_toSelection = esc_html__(' to booking?', 'seatreg');
	$translations->_isOccupied = esc_html__(' is occupied', 'seatreg');
	$translations->_isPendingState = esc_html__(' is in pending state', 'seatreg');
	$translations->regOwnerNotConfirmed = esc_html__('(registration admin has not confirmed it)', 'seatreg');
	$translations->selectionIsFull = esc_html__('Booking is full', 'seatreg');
	$translations->_isAlreadyInCart = esc_html__(' is already in cart!', 'seatreg');
    $translations->_isAlreadySelected = esc_html__(' is already selected!', 'seatreg');
	$translations->_regUnderConstruction = esc_html__('Under construction', 'seatreg');
	$translations->emptyField = esc_html__('Empty field', 'seatreg');
	$translations->remove = esc_html__('Remove', 'seatreg');
	$translations->add_ = esc_html__('Add ', 'seatreg');
	$translations->openSeatsInRoom_ = esc_html__('Open seats in the room: ', 'seatreg');
	$translations->pendingSeatInRoom_ = esc_html__('Pending seats in the room: ', 'seatreg');
	$translations->confirmedSeatInRoom_ = esc_html__('Confirmed seats in the room: ', 'seatreg');
	$translations->seat = esc_html__('seat', 'seatreg');
	$translations->firstName = esc_html__('Firstname', 'seatreg');
	$translations->lastName = esc_html__('Lastname', 'seatreg');
	$translations->eMail = esc_html__('Email', 'seatreg');
	$translations->this_ = esc_html__('This ', 'seatreg');
    $translations->_selected = esc_html__(' selected', 'seatreg');
    $translations->_seatSelected = esc_html__(' seat selected', 'seatreg');
    $translations->_seatsSelected = esc_html__(' seats selected', 'seatreg');
    $translations->bookingsConfirmed = esc_html__('You Booking is confirmed', 'seatreg');
    $translations->bookingsConfirmedPending = esc_html__('Your booking is now in pending state. Registration admin needs to confirm it', 'seatreg');
    $translations->selectingGuide = esc_html__('Select a seat you want to add to booking', 'seatreg');
    $translations->Booked = esc_html__('Booked', 'seatreg');
    $translations->Pending = esc_html__('Pending', 'seatreg');

	return $translations;
}

function seatreg_generate_admin_strings() {
    $translations = new stdClass();
    $translations->hoverDeleteSuccess = esc_html__('Hover text deleted', 'seatreg');
    $translations->hoverTextAdded = esc_html__('Hover text added', 'seatreg');
    $translations->legendNameChanged = esc_html__('Legend name changed', 'seatreg');
    $translations->legendColorChanged = esc_html__('Legend color changed', 'seatreg');
    $translations->buildingGridUpdated = esc_html__('Building grid updated', 'seatreg');
    $translations->roomNameChanged = esc_html__('Room name changed', 'seatreg');
    $translations->roomNameSet = esc_html__('New Room added', 'seatreg');
    $translations->roomNotExist = esc_html__('Room does not exist', 'seatreg');
    $translations->seatNotExist = esc_html__('Seat dose not exist', 'seatreg');
    $translations->seatAlreadyBookedPending = esc_html__('Seat is already booked/pending', 'seatreg');
    $translations->errorBookingUpdate = esc_html__('Error updating booking', 'seatreg');
    $translations->hoverError = esc_html__('Error while creating hover', 'seatreg');
    $translations->legendChangeError = esc_html__('Error while changing legend', 'seatreg');
    $translations->legendNameTaken = esc_html__('Legend name is taken', 'seatreg');
    $translations->lagendNameMissing = esc_html__('Legend name missing!', 'seatreg');
    $translations->legendColorTaken = esc_html__('Legend color is taken. Choose another', 'seatreg');
    $translations->legendAddedTo = esc_html__('Legend added to', 'seatreg');
    $translations->noPermToAddRoom = esc_html__('Dont have permissions to create room', 'seatreg');
    $translations->noPermToDel = esc_html__('Dont have permission do delete', 'seatreg');
    $translations->oneRoomNeeded = esc_html__('You must have at least on room', 'seatreg');
    $translations->alreadyInRoom = esc_html__('Already in this room', 'seatreg');
    $translations->allRoomsNeedName = esc_html__('All rooms must have name', 'seatreg');
    $translations->illegalCharactersDetec = esc_html__('Illegal characters detected', 'seatreg');
    $translations->missingName = esc_html__('Name missing', 'seatreg');
    $translations->cantDelRoom_ = esc_html__('You cant delete room ', 'seatreg');
    $translations->_cantDelRoomBecause = esc_html__(' because it contains pending or confirmed seats. You must remove them with manager first.', 'seatreg');
    $translations->roomNameMissing = esc_html__('Room name missing', 'seatreg');
    $translations->roomNameExists = esc_html__('Room name already exists. You must choose another', 'seatreg');
    $translations->youHaveSelected = esc_html__('You have selected', 'seatreg');
    $translations->_boxesSpanLi = esc_html__(' box/boxes</span></li>', 'seatreg');
    $translations->toSelectOneBox_ = esc_html__('To select one box use ', 'seatreg');
    $translations->toSelectMultiBox_ = esc_html__('To select multiple boxes use ', 'seatreg');
    $translations->selectBoxesToAddHover = esc_html__('Select box/boxes to add hover text', 'seatreg');
    $translations->loading = esc_html__('Loading...', 'seatreg');
    $translations->selectBoxesToDelete = esc_html__('Select box/boxes you want to delete', 'seatreg');
    $translations->onlyPremMembUpImg = esc_html__('Only premium members can upload background-image', 'seatreg');
    $translations->fixNeededToSave = esc_html__('Fix needed to save!', 'seatreg');
    $translations->boxLimitExceeded = esc_html__('Box limit exeeded', 'seatreg');
    $translations->colorApplied = esc_html__('Color applied', 'seatreg');
    $translations->noLegendsCreated = esc_html__('You have not made and legends yet', 'seatreg');
    $translations->_noSelectBoxToAddLegend = esc_html__(' You have not selected any box/boxes to add legends', 'seatreg');
    $translations->_charRemaining = esc_html__(' characters remaining', 'seatreg');
    $translations->deleteRoom_ = esc_html__('Are you sure you want to delete room ', 'seatreg');
    $translations->unsavedChanges = esc_html__('Unsaved changes. You sure you want to leave?', 'seatreg');
    $translations->createLegend = esc_html__('Create new legend', 'seatreg');
    $translations->cancelLegendCreation = esc_html__('Cancel legend creation', 'seatreg');
    $translations->chooseLegend = esc_html__('Choose legend', 'seatreg');
    $translations->enterLegendName = esc_html__('Enter legend name', 'seatreg');
    $translations->ok = esc_html__('Ok', 'seatreg');
    $translations->cancel = esc_html__('Cancel', 'seatreg');
    $translations->unsavedChanges = esc_html__('Unsaved Changes', 'seatreg');
    $translations->boxes = esc_html__('boxes', 'seatreg');
    $translations->box = esc_html__('box', 'seatreg');
    $translations->noBoxesSelected = esc_html__('No boxes selected', 'seatreg');
    $translations->pendingSeat = esc_html__('Pending seat', 'seatreg');
    $translations->confirmedSeat = esc_html__('Confirmed seat', 'seatreg');
    $translations->save = esc_html__('Save', 'seatreg');
    $translations->saving = esc_html__('Saving...', 'seatreg');
    $translations->saved = esc_html__('Saved', 'seatreg');
    $translations->room = esc_html__('room', 'seatreg');
    $translations->bookingUpdated = esc_html__('Booking updated', 'seatreg');
    $translations->notSet = esc_html__('Not set', 'seatreg');
    $translations->enterRegistrationName = esc_html__('Please enter registration name', 'seatreg');
    $translations->registrationNameLimit = esc_html__('Name must be between 1-255 characters', 'seatreg');
    $translations->pleaseEnterName = esc_html__('Please enter name', 'seatreg');
    $translations->pleaseEnterOptionValue = esc_html__('Please enter option value', 'seatreg');
    $translations->areYouSure = esc_html__('Are you sure?', 'seatreg');
    $translations->pleaseAddAtLeastOneOption = esc_html__('Please add at least one option', 'seatreg');
 
    return $translations;
}