# process_activation • [**Extended Users**](#related-pages)

Tag **cms:process_activation** handles account activation for the user that visited template using the activation link we emailed her.

Successful activation sets account active and enables user to log in.

Tag is self-closed and belongs to the [Extended Users](#related-pages) addon's tags [suite](#related-tags).

```xml
<cms:process_activation />
```

## Parameters

Tag expects no parameters.

## Usage

Tag looks for the query string parameter **key** from the URL and performs in background several routines —

1. Checks if the link has not expired
2. Verifies hash to make sure the data has not been tampered with
3. Finally checks if activation key still exists for the user

User will be activated if all three succeed.

Next, you may take action depending on the result using the variables that this tag sets, namely &ndash; **k_success** and **k_error**.

```xml
<cms:process_activation />

<cms:if k_success >
     <cms:set_flash name='success_msg' value='2' />
     <cms:redirect k_page_link />
<cms:else />
    <cms:show k_error />
</cms:if>
```

Page with this tag present is always served *non-cached* with cache explicitly turned off, similar to using tag **cms:no_cache**.

## Variables

Tag **process_activation** will set following variables —

* **k_success**
* **k_error**

Addon **Extended Users** adds following variables in context —

* k_user_template
* k_user_login_template
* k_user_lost_password_template
* k_user_registration_template

## Related tags

Addon **Extended Users** features following tags -

* [**process_activation**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_activation.md)
* [**activation_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/activation_link.md)
* [**login_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/login_link.md)
* [**logout_link**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/logout_link.md)
* [**process_login**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_login.md)
* [**process_logout**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_logout.md)
* [**process_forgot_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_forgot_password.md)
* [**process_reset_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_reset_password.md)

## Related pages

* [**Core Concepts &raquo; Extended Users**](/concepts/Extended-Users)
