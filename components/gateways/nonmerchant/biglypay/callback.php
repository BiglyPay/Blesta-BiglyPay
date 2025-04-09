<?php
// Set path to Blesta root
define("ROOTWEBDIR", dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR);
require ROOTWEBDIR . "config" . DIRECTORY_SEPARATOR . "core.php";

use Blesta\Core\Util\Input\Fields\InputFields;
Loader::loadModels(null, ["Invoices", "Transactions", "Clients"]);

$gateway = new GatewayPayments();
$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['invoice_id'], $input['related_invoice_id'], $input['status'], $input['received_amount'], $input['ipn_key'], $input['tx_hash'])) {
    http_response_code(400);
    echo "Invalid data";
    exit;
}

// Load gateway config
Loader::loadModels(null, ["Companies"]);
$company_id = Configure::get("Blesta.company_id");
$gatewayConfig = $gateway->getMeta("biglypay", $company_id);

if (empty($gatewayConfig) || $input['ipn_key'] !== $gatewayConfig->ipnKey) {
    http_response_code(403);
    echo "Invalid IPN key";
    exit;
}

// Fetch invoice
$Invoices = new Invoices();
$invoice = $Invoices->getById($input['related_invoice_id']);

if (!$invoice) {
    http_response_code(404);
    echo "Invoice not found";
    exit;
}

if ($input['status'] === "Confirmed") {
    $Transactions = new Transactions();
    $Transactions->add([
        'invoice_id' => $invoice->id,
        'transaction_id' => $input['tx_hash'],
        'amount' => $input['received_amount'],
        'type' => 'other',
        'gateway_id' => $gatewayConfig->gateway_id,
        'status' => 'approved'
    ]);
    echo "Payment successful";
} else {
    echo "Payment pending or failed";
}
