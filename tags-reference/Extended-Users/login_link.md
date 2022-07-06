# login_link • [**Extended Users**](#related-pages)

Tag **cms:login_link** returns a link to the login template.

```xml
<cms:login_link />
```

Why have a separate tag?\
Suppose we have a custom page 'Profile' or 'Welcome' that serves as destination point for users that just logged in. Tag's output can have a custom redirect link, unlike the system-wide variable **k_login_link**. With param **redirect** we instruct Couch to generate such link for us and do not return user to the previous page – page where user clicked the login link and expects to be returned back to afterwards.

## Parameters

It accepts a parameter **redirect**.\
For example -

```xml
<cms:login_link redirect=k_site_link />
```

## Usage

This tag outputs a link dynamically. In case the user is logged-in tag will output a no-action call i.e. `javascript:void(0)`.

Anonymous users are treated as follows –

* **no defined login template**

   ***admin-panel default login*** page: `couch/login.php` AND query string `?redirect=` AND ( link to the current page OR **redirect** param value)

* **defined login template**

   a link to the ***registered login template*** and the same query string as ↑ above.

Referenced 'current page' is taken from the `$_SERVER["REQUEST_URI"]` constant, i.e. includes query string values from URL.

Example of access control -

```xml
<cms:if k_logged_out>
   <!-- Log in and redirect to Profile -->
   <cms:redirect "<cms:login_link redirect="<cms:link masterpage='profile.php' />" />" />
</cms:if>
<!-- someone who manages to reach here is certainly a logged-in user -->
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
* [**process_logout**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_logout.md)
* [**process_forgot_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_forgot_password.md)
* [**process_reset_password**](https://github.com/trendoman/Midware/tree/main/tags-reference/Extended-Users/process_reset_password.md)

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)
