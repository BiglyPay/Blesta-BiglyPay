# Blesta-BiglyPay
# BiglyPay Crypto Payment Gateway for Blesta

BiglyPay is a cryptocurrency payment gateway module for Blesta that enables your business to accept crypto payments seamlessly. This module monitors blockchain transactions, updates invoice statuses (e.g., Partially Paid or Fully Paid), and logs transaction details in Blesta. For fee details, please visit: https://biglypay.com/#Fees

## Register
https://biglypay.com/register.php

## Features

- **Seamless Integration:**  
  Integrates natively with Blesta using its gateway system.
  
- **Multi-Crypto Support:**  
  Accept payments in various cryptocurrencies (e.g., ETH, BNB, BIGLY, USDT, DOGE, TRX, BTC/LTC, etc.) via BiglyPay’s infrastructure.
  
- **Automatic Invoice Updates:**  
  Automatically update invoice statuses based on blockchain payment confirmations.
  
- **Transaction Logging:**  
  All transaction details are recorded within Blesta for reconciliation and audit purposes.
  
- **Centralized Settings:**  
  Configure API Key, IPN Key, and logo directly from the Blesta admin interface.

## Requirements

- **Blesta:**  
  A compatible version that supports non-merchant gateway modules.
  
- **PHP:**  
  Version 7.2 or above.
  
- **MySQL:**  
  Required for storing transaction and invoice data.

## Installation

1. **Clone the Repository:**

   git clone https://github.com/BiglyPay/Blesta-BiglyPay.git

2. **Copy Files:**

   - Copy the entire folder `/components/gateways/nonmerchant/biglypay/` from the repository into your Blesta installation directory under `/components/gateways/nonmerchant/`.

3. **Set Permissions:**

   Ensure all module files have the correct file permissions so that they are readable by your web server.

## Activate and Configure the Gateway Module

1. **Activate the Module:**

   - Log in to your Blesta admin area.
   - Navigate to the Gateways section.
   - Locate and activate the **BiglyPay** gateway.

2. **Configure Module Settings:**

   In the configuration screen, set the following values:
   
   - **API Key:**  
     Enter the API Key provided by your BiglyPay account. This key authenticates your transactions.
   
   - **IPN Key:**  
     Enter the IPN Key for secure callback validation. This key should match what is configured on the BiglyPay Merchant Settings page.
   
   - **Company Logo URL (Optional):**  
     Enter the URL of your logo to display on the BiglyPay remote checkout page.

## Usage

Once activated and configured, the BiglyPay module in Blesta will:

- Present a remote checkout option for customers via BiglyPay.
- Monitor blockchain transactions associated with invoices.
- Automatically update invoice statuses based on confirmed transactions.
- Log transaction details for review and reconciliation within Blesta.

## Contributing

Contributions are welcome! If you have improvements or suggestions, please open an issue or submit a pull request. Make sure to adhere to the project’s coding standards and include appropriate tests for any new functionality.

## License

This project is licensed under the MIT License. See the LICENSE file for further details.

## Support

For additional support or inquiries, please visit the BiglyPay website or contact support via the BiglyPay control panel.
