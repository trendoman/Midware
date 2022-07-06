# process_logout • [**Extended Users**](#related-pages)

Tag **cms:process_logout** processes the logout.

```xml
<cms:process_logout />
```

## Parameters

* **nonce**
* **redirect**

### nonce

Parameter **nonce** is supplied in background from the URL or can be created manually. For the latter, use tag [**cms:create_nonce**](#related-tags) e.g.

```xml
<cms:create_nonce "<cms:concat 'logout' k_extended_user_id />" />
```

Pattern 'logout' + user_id must be followed, otherwise nonce will be incorrect.

### redirect

Successful logout proceeds to follow parameter **redirect**. Valid values are — ***0, 1, 2*** or explicit link.

* **redirect='0'** — no redirection happens.
* **redirect='1'** — redirect to current page.
* **redirect='2'** — (default) expects a querystring param '?redirect=' with link as its value e.g. `login.php?act=logout&redirect=/couch/`
* **redirect=my_link** — link is explicitly provided as a string or variable.

By default its value is ***2*** even if parameter is omitted.

## Usage

In contrast to login, the logout function does not require a form e.g.

```xml
<cms:if action='logout'>
   <cms:process_logout />
</cms:if>
```

If user was not logged in then tag will not do anything and will not redirect.

Successful logout will nullify cookie.

Login template is configured in `couch/addons/extended/config.php` — make sure to register the login template first in Admin-panel. Make sure template appears in backend. Activate it in config as the last step.

Page with this tag is always served non-cached with cache explicitly turned off, similar to using tag [**cms:no_cache**](#related-tags).

## Variables

Tag does not set variables.

Addon **Extended Users** adds following variables in context —

* k_user_template
* k_user_login_template
* k_user_lost_password_template
* k_user_registration_template

## Related tags

* **create_nonce**
* [**no_cache**](https://github.com/trendoman/Midware/tree/main/tags-reference/no_cache.md)

Addon **Extended Users** features following tags —

* [**process_activation**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_activation.md)
* [**activation_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/activation_link.md)
* [**login_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/login_link.md)
* [**logout_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/logout_link.md)
* [**process_login**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_login.md)
* [**process_logout**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_logout.md)
* [**process_forgot_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_forgot_password.md)
* [**process_reset_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_reset_password.md)

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)
