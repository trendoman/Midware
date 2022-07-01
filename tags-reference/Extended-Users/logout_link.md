# logout_link • [**Extended Users**](#related-pages)

Tag **cms:logout_link** returns a link to login template following which the user will be logged out and redirected.

```xml
<cms:logout_link />
```

Why have a separate tag?\
Suppose we have a custom page that serves as destination point for users that just logged out (perhaps a 'See you soon' or simply index page). Tag's output can have a custom redirect link, unlike the system-wide variable **k_logout_link**. With param **redirect** we instruct Couch to generate such link for us and do not return user to the previous page — page where user clicked the logout link and expects to be returned back to afterwards.

## Parameters

It accepts a parameter **redirect**.\
For example -

```xml
<cms:logout_link redirect=k_site_link />
```

## Usage

This tag outputs a link dynamically. In case the user is already logged-out tag will output a no-action call i.e. `javascript:void(0)`.

Logged-in users are treated as follows –

* **no defined login template**

  ***admin-panel default login*** page: `couch/login.php` AND query string `?act=logout&nonce={nonce}&redirect=` AND ( **redirect** param value OR admin-panel link if within admin-panel OR current page if outside of admin-panel )

* **defined login template**

   a link to the ***registered login template*** and the same query string as ↑ above.

Referenced 'current page' is taken from the `$_SERVER["REQUEST_URI"]` constant, i.e. includes query string values from URL. If user clicks logout from within admin-panel and redirect parameter is not explicitly provided with link, then user will be redirected back to admin-panel i.e. login page.

Simple example of logout link -

```xml
<cms:if k_logged_in>
   Logout <a href="<cms:logout_link redirect=k_site_link />"><cms:show k_user_title /></a>
<cms:else />
  <a href="<cms:login_link />">Login</a>
</cms:if>
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
* **process_login**
* **process_logout**
* **process_forgot_password**
* **process_reset_password**

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)
