<?php
class biglypay extends NonMerchantGateway
{
    public function __construct()
    {
        Language::loadLang("biglypay", null, dirname(__FILE__) . DS . "language" . DS);
        Loader::loadHelpers($this, ["Html"]);
    }

    public function getName()
    {
        return Language::_("biglypay.name", true);
    }

    public function getSettings($company_id = null)
    {
        return [
            'apiKey' => [
                'label' => Language::_("biglypay.apiKey", true),
                'type' => 'text',
                'tooltip' => 'API Key provided by BiglyPay'
            ],
            'ipnKey' => [
                'label' => Language::_("biglypay.ipnKey", true),
                'type' => 'text',
                'tooltip' => 'Secret IPN Key to validate callbacks'
            ],
            'clogo' => [
                'label' => Language::_("biglypay.clogo", true),
                'type' => 'text',
                'tooltip' => 'URL of the logo displayed on BiglyPay checkout'
            ]
        ];
    }

    public function getCurrencies()
    {
        return ["usd"];
    }

    public function buildProcess(array $params)
    {
        $invoice_id = $params['invoice']->id_code;
        $amount = $params['amount'];
        $currency = $params['currency'];
        $return_url = $this->ifSet($params['return_url']);
        $client_email = $params['client_email'];
        $client_id = $params['client_id'];
        $company_domain = $_SERVER['HTTP_HOST'];

        $apiKey = $this->ifSet($this->meta['apiKey']);
        $logo   = $this->ifSet($this->meta['clogo']);
        if (!filter_var($logo, FILTER_VALIDATE_URL)) {
            $logo = '';
        }

        $postFields = [
            'userid'     => $client_id,
            'invoiceid'  => $invoice_id,
            'amount'     => $amount,
            'currency'   => $currency,
            'returnurl'  => $return_url,
            'apiKey'     => $apiKey,
            'logo'       => $logo,
            'domain'     => $company_domain,
            'email'      => $client_email
        ];

        $form = '<form action="https://biglypay.com/remote_payment.php" method="POST">';
        foreach ($postFields as $key => $val) {
            $form .= '<input type="hidden" name="' . $this->Html->safe($key) . '" value="' . $this->Html->safe($val) . '">';
        }
        $form .= '<button type="submit">Pay with BiglyPay</button>';
        $form .= '</form>';

        return [
            'method' => 'post',
            'fields' => $form
        ];
    }

    public function validate(array $get, array $post)
    {
        return true; // No client validation needed
    }

    public function success(array $get, array $post)
    {
        return [
            'client_id' => null,
            'amount' => null,
            'status' => 'pending',
            'invoice_id' => null,
            'transaction_id' => null
        ];
    }
}
