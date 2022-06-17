# pp_add_item_link

Tag **cms:pp_add_item_link** outputs a link that Couch treats as 'Add Item' action in [CouchCart](#related-pages) Addon.

```xml
<cms:pp_add_item_link />
```

Generated URL consists of a link to the cart template (the one set in '/addons/cart/config.php' *OR* 'cart.php') plus the special query string **`?kcart_action=1`**
(visit [**Tips for Cart developer**](./TIPS.md) page to read more about query string values).

Tag follows [Pretty URLS](#related-pages) global setting and outputs pretty link if appropriate.

## Parameters

It does not take any parameters.

## Related pages

* [**Tips for Cart developer**](./TIPS.md)
* [**Documentation &raquo; Core Concepts – Shopping Cart (Part I)**](https://docs.couchcms.com/concepts/shopping-cart-1.html)
* [**Documentation &raquo; Core Concepts – Shopping Cart (Part II)**](https://docs.couchcms.com/concepts/shopping-cart-2.html)
* [**Documentation &raquo; Core Concepts – Pretty URLS**](https://docs.couchcms.com/concepts/pretty-urls.html)
* [**Documentation &raquo; Demo – CouchCart Simple**](http://www.couchcms.com/demo/simple/)
