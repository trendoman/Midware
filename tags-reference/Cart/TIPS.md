# Tips for Cart developer

## Defaults

Couch follows the Cart Config at 'addons/cart/config.php' but implies *default values* if not configured e.g.

```php
tpl_products = 'products.php'
tpl_cart = 'cart.php'
tpl_checkout = 'checkout.php'
paypal_use_sandbox' = K_PAYPAL_USE_SANDBOX
paypal_email' = K_PAYPAL_EMAIL
currency' = K_PAYPAL_CURRENCY
currency_symbol' = '$'
allow_decimal_qty' = '0'
```

## Programmatic access

Complete Cart data is stored in session variable **kcart** and contains following details —

```txt
 items                      sub_total_discounted
 count_items                taxes
 count_shippable_items      shipping
 sub_total                  total
 discount                   custom_vars
```

## Actions

Query string parameter **kcart_action** is universal for all actions in CouchCart and takes numeric values e.g.

```html
'?kcart_action=1' — Add Item action
'?kcart_action=2' — Update Item action
'?kcart_action=3' — Remove Item action
'?kcart_action=4' — Empty Cart action
'?kcart_action=5' — Checkout action
'?kcart_action=6' — Custom action
```

## Redirect

All the actions redirect to corresponding (registered or default) template, however destination can be changed via query string **`&redirect=`**

## Input values

* 'Add Item' action upon visit accepts POST values of the following inputs:
   - **pp_id**,
   - **qty**,
   - **os0**, **os1**, etc&hellip;

* 'Update Item' is interested only in POST **qty**.
* 'Remove Item' takes GET value: **line_id**.
