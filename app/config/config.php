<?php
// App Root
define('APPROOT', dirname(dirname(__FILE__)));
$f =APPROOT;
define('HELPERS', $f.'/helpers');
// URL Root
define('URLROOT', 'http://localhost/csv');
define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/csv');
// Site Name
define('SITENAME', 'SITE NAME');
// App Version
define('APPVERSION', '1.0.0');


use Dotenv\Dotenv,Omnipay\Omnipay;

//dont env config
$dotenv=Dotenv::createImmutable(DOCROOT);//DOCROOT = your env file link
$dotenv->load();

/*
 * //paypal config
 *
 * make $gateway variable global for functions
 * */

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId($_ENV['PAYPAL_CLIENT_ID']);
$gateway->setSecret($_ENV['PAYPAL_CLIENT_SECRET']);
$gateway->setTestMode(true); //make false for live
