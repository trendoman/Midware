# activation_link • [**Extended Users**](#related-pages)

Tag **cms:activation_link** helps get the registration activation link and belongs to the [Extended Users](#related-pages) addon's tags [suite](#related-tags).

```xml
<cms:activation_link user='example@example.me' />
```

## Parameters

* user
* processor

### user

Parameter **user** is mandatory and takes either email or username. Usually the variable *extended_user_email* is used, or its form-submitted version *frm_extended_user_email*.

### processor

Parameter **processor** takes template name, which the user will be visiting upon clicking the link from email.

```xml
<cms:activation_link user='example@example.cc' processor='register.php' />
```

Processor template is often explicitly stated in Addon's configuration file and therefore can be omitted in the tag.

## Usage

Tag is expected to be used in email sent to user e.g.

```xml
<cms:send_mail from=k_email_from to=frm_extended_user_email subject='New Account Confirmation'>
   Please click the following link to activate your account:
   <cms:activation_link frm_extended_user_email />

   Thanks
</cms:send_mail>
```

## Variables

This tag does not set any variables of its own.

Addon **Extended Users** adds following variables in context —

* k_user_template
* k_user_login_template
* k_user_lost_password_template
* k_user_registration_template


## Related tags

Addon **Extended Users** features following tags —

* [**process_activation**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_activation.md)
* [**activation_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/activation_link.md)
* [**login_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/login_link.md)
* [**logout_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/logout_link.md)
* [**process_login**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_login.md)
* **process_logout**
* **process_forgot_password**
* **process_reset_password**

## Related pages

* [**Core Concepts &raquo; Extended Users**](/concepts/Extended-Users)
