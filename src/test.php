<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 18/04/2018
 * Time: 21:32
 */

spl_autoload_register(function ($class_name) {
    $file_name = str_replace("Wuunder/", "", str_replace("\\", DIRECTORY_SEPARATOR, $class_name)) . '.php';

    if (file_exists($file_name)) {
        include $file_name;
    }
});


include("Connector.php");

$connector = new Wuunder\Connector("YVc7rKdM6e6Q_HQK81NCt7SM0LT0TtQB");
$booking = $connector->createBooking();

$bookingConfig = new Wuunder\Api\Config\BookingConfig();
$bookingConfig->setWebhookUrl("http://www.google.nl");
$bookingConfig->setRedirectUrl("http://www.google.nl");

if ($bookingConfig->validate()) {
    $booking->setConfig($bookingConfig);

    if ($booking->fire()) {
        var_dump($booking->getBookingResponse()->getBookingUrl());
    } else {
        var_dump($booking->getBookingResponse()->getError());
    }
} else {
    print("Bookingconfig not complete");
}

print("----------");

$shipment = $connector->createShipment();

$shipmentConfig = new \Wuunder\Api\Config\ShipmentConfig();
$shipmentConfig->setDescription("Test");
$shipmentConfig->setKind("package");
$shipmentConfig->setValue(200);
$shipmentConfig->setLength(10);
$shipmentConfig->setWidth(10);
$shipmentConfig->setHeight(10);
$shipmentConfig->setWeight(210);
$shipmentConfig->setPreferredServiceLevel("cheapest");

$deliveryAddress = new \Wuunder\Api\Config\AddressConfig();
$deliveryAddress->setEmailAddress("timo@transceptor.technology");
$deliveryAddress->setFamilyName("Janssen");
$deliveryAddress->setGivenName("Timo");
$deliveryAddress->setLocality("Venlo");
$deliveryAddress->setStreetName("Noorderpoort");
$deliveryAddress->setHouseNumber("69");
$deliveryAddress->setZipCode("5916PJ");
$deliveryAddress->setCountry("NL");

$shipmentConfig->setDeliveryAddress($deliveryAddress);

$pickupAddress = new \Wuunder\Api\Config\AddressConfig();
$pickupAddress->setEmailAddress("timo@transceptor.technology");
$pickupAddress->setFamilyName("Janssen");
$pickupAddress->setGivenName("Timo");
$pickupAddress->setLocality("Venlo");
$pickupAddress->setStreetName("Noorderpoort");
$pickupAddress->setHouseNumber("69");
$pickupAddress->setZipCode("5916PJ");
$pickupAddress->setCountry("NL");

$shipmentConfig->setPickupAddress($pickupAddress);

if ($shipmentConfig->validate()) {
    $shipment->setConfig($shipmentConfig);

    if ($shipment->fire()) {
        var_dump($shipment->getShipmentResponse()->getShipmentData());
    } else {
        var_dump($shipment->getShipmentResponse()->getError());
    }
} else {
    print("ShipmentConfig not complete");
}