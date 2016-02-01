# DEVELOPER.md

## Resources

### Merchant Account Dashboard

[Amazon Seller Central](https://sellercentral.amazon.com/gp/homepage.html)

### API Documentation

[Pay with Amazon API Reference Guide](https://payments.amazon.com/documentation/apireference/201751630#201751630)

[Login and Pay with Amazon Integration Guide](https://payments.amazon.com/documentation/lpwa/201749840#201749840)

## Gotchas

### Subscriptions Support

Currently, Amazon Payments Advanced supports all Subscriptions features **except** payment method changes.

This decision is one of time management, and not of gateway capability. The plugin currently has too much of the payment widget rendering code outside of the `WC_Payment_Gateway` subclasses to easily use it for the "change payment method" form.

While supporting customer-initiated payment method changes is just a matter of correctly rendering the widgets, admin-initiated payment changes aren't _really_ possible. There is no way to request a valid Billing Agreement from Amazon outside the widget flow, so it's unlikely that an admin could replace the Billing Agreement Id with anything valid.

### Recurring Payment Limits

The recurring payments API limits total charges to a single billing agreement to $500 per calendar month.

According to [this documentation page](https://payments.amazon.com/documentation/automatic/201752090#201757640):

> **Note**: Amazon imposes a $500 per calendar month limit on the amount of funds you can charge a buyer. If you expect to exceed this limit due to an upgrade or the buyer's usage, please contact Amazon Payments.

It is unclear if/how the limit will be altered should you contact Amazon.

If an authorization/capture attempt is made that pushes a given billing agreement over the $500 monthly cap, the following error will be encountered:

> BillingAgreement C01-6601668-8704891 has already been authorized for amount 0.00 in time period i.e. Sun Nov 01 00:00:00 UTC 2015 – Tue Dec 01 00:00:00 UTC 2015. A new authorization with amount 503.00 cannot be accepted as the total authorization amount cannot exceed 500.00.

In order to curb the number of potential recurring payment failures due to the cap, the gateway will disable itself if a cart contains more than $500 of recurring monthly subscriptions.

### API Request Throttling

Both subscription cancellation and renewal can happen in bulk and rely on API endpoints that have request limits.

The `CloseBillingAgreement` and `AuthorizeOnBillingAgreement` endpoints have maximum request quotas of 10 and a restore rate of one request every second in the production environment. This decreases to a maximum request quota of two and a restore rate of one request every two seconds in the sandbox environment.

See the documentation for [CloseBillingAgreement](https://payments.amazon.com/documentation/apireference/201752660#201751950) and [AuthorizeOnBillingAgreement](https://payments.amazon.com/documentation/apireference/201752660#201751940).

Since the method calling `AuthorizeOnBillingAgreement ` is called through the [Action Scheduler](https://github.com/Prospress/action-scheduler) built into Subscriptions, simply `sleep()`ing for an interval equal to the restore rate seems to mitigate any throttling.

This same tactic is used before the call to `CloseBillingAgreement`, but is susceptible to hitting the PHP execution time limit during large bulk operations.

## Zero Total Checkout Logic

When checking out with Amazon Payments, the billing and shipping address information is only available through the Amazon Payments API.

Billing and shipping addresses are selected using Amazon-provided widgets that the gateway renders in place of the default checkout form fields.

In most cases, payment gateways don't need to do anything when an order total is zero (WooCommerce doesn't even call the chosen gateway's `process_payment()` method). Typically this is fine, but in the case of Amazon, we only have access to billing and shipping address information if the integration is in "Login App" mode.

Because of this, the gateway is not available for zero-total checkouts when not in "Login App" mode.