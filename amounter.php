<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.11.2016
 * Time: 18:34
 */

require('vendor/autoload.php');
var_dump(123);
$nonce = $_POST['nonce'];

/* SANDOBX*/
$location_id = 'CBASEAHrU4SJW7UEJpuBBS6zNgQ';
$access_token = 'sandbox-sq0atb-KwoIbGoauMsD9FrYQIZn2g';


/* Production */
/*$location_id = '99AX8Y6BT493Z';
$access_token = 'sq0atp-vTT7x2z-lqdYeaixYkeZtg';
*/
$transaction_api = new \SquareConnect\Api\TransactionApi();
//var_dump(floatval($_POST['amount'])*100);
$request_body = array(

    "card_nonce" => $nonce,

    # Monetary amounts are specified in the smallest unit of the applicable currency.
    # This amount is in cents. It's also hard-coded for $1, which is not very useful.
    "amount_money" => array(
        "amount" => floatval($_POST['amount'])*100,
        "currency" => "USD"
    ),

    # Every payment you process for a given business have a unique idempotency key.
    # If you're unsure whether a particular payment succeeded, you can reattempt
    # it with the same idempotency key without worrying about double charging
    # the buyer.
    "idempotency_key" => uniqid()
);

$body = new \SquareConnect\Model\ChargeRequest($request_body);

# The SDK throws an exception if a Connect endpoint responds with anything besides 200 (success).
# This block catches any exceptions that occur from the request.
try {
    echo "Transaction successful<br/>";
    echo "<hr>";
    echo 'DEBUG INFO<br/>';
    print_r($transaction_api->charge($access_token, $location_id, $request_body));
} catch (Exception $e) {
    echo "Caught exception " . $e->getMessage();
}
/*
 * Card Number	4532759734545858
 * CVV	111
 * Expiration Date	(Any MM/YY combination in the future)
 * Postal Code	94103
 *
 * */