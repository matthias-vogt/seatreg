=== SeatReg ===
Donate link: https://www.paypal.com/donate?hosted_button_id=9QSGHYKHL6NMU&source=url
Tags: seat registration, booking, booking seats, booking events, seat map, booking management, registration
Requires at least: 5.3
Requires PHP: 7.2.28
Tested up to: 5.8.1
Stable tag: 1.13.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Create and manage seat registrations. Design your own seat maps and manage seat bookings.
 

== Description ==

Create and manage seat registrations. Design your own seat maps and manage seat bookings. 

SeatReg is a plugin that offers the following and more to build and manage your online seat registrations.
 
* Map builder tool helps you design your seat maps. Create, delete, resize, move around and change color of your seats. You can also add price, custom legends and hover text to your seats.
* Each registration can have as many seats and rooms you wish.
* With manager you keep an eye on your bookings. You can view, search, remove, confirm, change and download (PDF, XLSX, text) them. 
* Get an overview of your registrations. See how many open, approved or pending bookings you have.
* Many settings to control the booking flow. For example you can create custom fields that allow customers to enter extra data.
* Scrollable and resizable registration view that can be provided to people via direct link or by inserting it to your website pages via shortcode (example of shortcode: [seatreg code=d0ca254995]).
* Paypal payments support.
  
== Installation ==
 
1. Install SeatReg either via the WordPress.org plugin directory, or by uploading the files to your server.
2. Activate the plugin through the ‘Plugins’ menu in WordPress.

== Screenshots ==

1. Map builder
2. Registration view
3. Booking manager
4. Custom fields
5. Overview
6. Legends and background image

== Changelog ==

= 1.13.0 =
* Map editor can now add text to registration view

= 1.12.0 =
* Shortcode modal added to more items
* Added functionality to settings to show custom field data in registration view

= 1.11.0 =
* More item added to Home page items
* Added functionality to copy existing registration
* Custom fields can now be created with space characters

= 1.10.3 =
* Added booking id to XLSX
* Removed Payment txn id and Payment received from XLSX
* Fixed booking status page link in registration page

= 1.10.2 =
* Fixed PayPal payment bugs
* Code maintenance

= 1.10.1 =
* Fixed wrong QR code in receipt emails when approving multiple bookings with booking-manager

= 1.10.0 =
* Added booking status link to booking manager and receipt email
* Booking manager improvements
* Code maintenance

= 1.9.1 =
* Booking manager bug fix on new registrations when adding a booking

= 1.9.0 =
* Booking manager can now add bookings
* Added more logging for QR Code sending
* Fixed booking manager loading spinner position
* When email confirm is turned off and you need to pay for you booking then booking success dialog has text telling people to click to pay for booking

= 1.8.0 =
* Added QR testing tool
* Changed QR code save directory
* Bug fix on receipt email custom fields

= 1.7.0 =
* Booking receipt email is now sent to booker when booking is approved (enabled by default).
* You can enable QR code for receipt email in settings (not enabled by default).

= 1.6.0 =
* Danish translations added. Thank you Kim Soenderup.
* You can now set approved bookings back to pending.
* You can now view booking and registration activity logs.
* Fixed an issue with custom field labels.
* Minor UI improvements

= 1.5.0 =
* Added support for WordPress 5.8
* You can now set registration close reason.
* Minor UI and style improvements.

= 1.4.0 =
* Added tools submenu page with email testing
* Minor UI improvements

= 1.3.0 =
* Added support for PayPal payments
* With map builder you can now add prices to seats
* In settings you can turn on and configure PayPal

= 1.2.0 =
* Added pot file for translations
* Added Estonian translations
* Text fixes and changes
* Fixed bug when trying to remove image from room

= 1.1.0 =
* Added shortcode
* Some style fixes

= 1.0.9 =
* Don't ask confirmation email when multi seats enabled and email confirmation turned off.

= 1.0.8 =
* Fixed issue with multiple seat booking edit

= 1.0.7 =
* Using Unix timestamps in DB.
* Some fixes and improvements.

= 1.0.6 =
* added logic for DB updates

= 1.0.5 =
* removed default values from db tables where it is not supported. Set table engine to innoDB.
* bug fixes

= 1.0.4 =
* xlsxwriter class update. PHP 8 compatible.

= 1.0.3 =
* PHP warning fixed

= 1.0.2 =
* Removed captcha 

= 1.0.1 =
* Using template_include filter instead of page_template
* Missing includes fix

