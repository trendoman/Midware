# process_reset_password • [**Extended Users**](#related-pages)

Tag **cms:process_reset_password** resets the password and emails the new password back to the user.

```xml
<cms:activation_link user='example@example.me' />
```

## Parameters

* **send_mail**

### send_mail

Parameter **send_mail** is set to ***1*** by default and can be omitted.

Email template can be changed in `couch/lang/EN.php` (or whichever language file your site is configured to use). You'll find the strings used in the emails under the "Password recovery" heading. Email helps ensure that the account holder is really the person requesting the password reset.

Use ***send_mail='0'*** to have email composed yourself and sent via [**cms:send_mail**](#related-tags) instead.

## Usage

Tag takes the query string value "key=" from the URL and then –

1. Checks if link has not expired
2. Validates key to make sure the data has not been tampered with.
3. Ensures the user exists, not disabled and key matches the stored one.
4. Generates a new password for the user
5. Sets [**variables**](#variables) in context for us to use, specifically in 'cms:send_mail'.
6. Sends email

The sent email contains a username and a new password. To maintain full control over email one could employ something like this —

```xml
<cms:if action='reset'>
    <cms:process_reset_password send_mail='0'/>
    <cms:if k_reset_password_success>
        <cms:send_mail from=k_email_from to=k_user_email subject='Your new password' debug='0'>
            <cms:show k_user_name />, your password has been reset:

            New Password: <cms:show k_user_new_password />

            Once logged in you can change your password.
        </cms:send_mail>
    </cms:if>
</cms:if>
```

Page with this tag is always served non-cached with cache explicitly turned off, similar to using tag [**cms:no_cache**](#related-tags).

## Variables

This tag sets following variables:

|<!--             -->|<!--                 -->|
|:-------------------|:-----------------------|
| k_user_id          |  k_user_access_level   |
| k_user_name        |  k_extended_user_id    |
| k_user_title       |  k_user_new_password   |
| k_user_email       |                        |
|<!--             -->|<!--                 -->|
| k_success          |  k_reset_password_success |
| k_error            |  k_reset_password_error |

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
* [**process_logout**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_logout.md)
* [**process_forgot_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_forgot_password.md)
* [**process_reset_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_reset_password.md)

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)
