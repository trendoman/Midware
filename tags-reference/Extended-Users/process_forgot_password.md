# process_forgot_password • [**Extended Users**](#related-pages)

Tag **cms:process_forgot_password** generates a 'Forgot Password' link and optionally emails it to user.

```xml
<cms:process_forgot_password />
```

## Parameters

* **username**
* **send_mail**

### send_mail

Parameter **send_mail** is set to ***1*** by default and can be omitted.

Email template can be changed in `couch/lang/EN.php` (or whichever language file your site is configured to use). You'll find the strings used in the emails under the "Password recovery" heading. Email helps ensure that the account holder is really the person requesting the password reset.

Use ***send_mail='0'*** to have email composed yourself and sent via [**cms:send_mail**](#related-tags) instead.

### username

Parameter **username** can be omitted only if submitted form has input named 'k_user_name'. Value should be either username or user id or email address.

## Usage

Tag takes the submitted username (or id or email address) and then -

1. Validates the user exists
2. Validates the user is not disabled
3. Generates link and places it in context variable *k_reset_password_link*
4. Sets [**variables**](#variables) in context for us to use, specifically in 'cms:send_mail'.
5. Sends email

Page with this tag is always served non-cached with cache explicitly turned off, similar to using tag [**cms:no_cache**](#related-tags).

## Variables

This tag sets following variables:

|<!--             -->|<!--                 -->|
|:-------------------|:-----------------------|
| k_user_id          |  k_user_access_level   |
| k_user_name        |  k_extended_user_id    |
| k_user_title       |  k_reset_password_link |
| k_user_email       |                        |
|<!--             -->|<!--                 -->|
| k_success          |  k_forgot_password_success |
| k_error            |  k_forgot_password_error |

Addon **Extended Users** adds following variables in context —

* k_user_template
* k_user_login_template
* k_user_lost_password_template
* k_user_registration_template

## Related tags

* [**Documentation &raquo; send_mail**](https://docs.couchcms.com/tags-reference/send_mail.html)
* [**no_cache**](https://github.com/trendoman/Midware/tree/main/tags-reference/no_cache.md)

Addon **Extended Users** features following tags —

* [**process_activation**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_activation.md)
* [**activation_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/activation_link.md)
* [**login_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/login_link.md)
* [**logout_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/logout_link.md)
* [**process_login**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_login.md)
* **process_logout**
* [**process_forgot_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_forgot_password.md)
* **process_reset_password**

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)
