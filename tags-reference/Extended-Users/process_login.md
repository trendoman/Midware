# process_login • [**Extended Users**](#related-pages)

Tag **cms:process_login** performs login-related procedures in the Extended Users addon.

```xml
<cms:process_login />
```

## Parameters

* **username**
* **password**
* **remember**
* **redirect**

### username

Takes either email OR username OR user id (matched to the record in database in *couch_users* table). Username must not exceed 1024 chars. If username is not provided Couch will look for 'k_user_name' among submitted inputs.

### password

Takes plain text password. Password must not exceed 255 chars.
If password is not provided Couch will look for 'k_user_pwd' among submitted inputs.

### remember

Parameter **remember** takes ***1*** or ***0*** and by default is ***0***. This can be set explicitly or by input 'k_user_remember'. If 'remember me' function is not required, both parameter and input can be omitted.

### redirect

Successful login proceeds to follow the value in parameter **redirect**. Valid values are — ***0***, ***1***, ***2*** or explicit ***link***. By default its value is ***2*** even if parameter is omitted.

* **redirect='0'** — no redirection happens.
* **redirect='1'** — redirect to current page.
* **redirect='2'** — (default) expects a querystring param named '?redirect=' with link as its value e.g. login.php?redirect=/couch/
* **redirect=my_link** — link is explicitly provided as a string or variable.

## Example

```xml
<cms:process_login username='admin' password='QaWsEd11' remember='1' redirect=k_site_link />
```

Tag depends on either explicitly supplied parameters as in the snippet above, or values of the submitted login form. Form must have inputs with following names for the tag to recognize the values automatically —

* *k_user_name*
* *k_user_pwd*
* *k_user_remember*

```html
<cms:input type='text' name='k_user_name' />
<cms:input type='password' name='k_user_pwd' />
<cms:input type='checkbox' name='k_user_remember' opt_values='Remember me=1' />
```

## Usage

It is expected to be placed in code where it can be activated upon successful submission of a login form e.g.

```xml
<!-- login form submitted -->
<cms:if k_success>
   ..
   <cms:process_login />
</cms:if>
```

Failed login attempts are recorded in database and more than 3 failed attempts will lock the login for **20 seconds**. Within that period of time all login attempts are denied i.e. even valid credentials will be rejected before the grace period expires. On the other hand, successful login resets failed login counter (if logged in outside lockdown). So, 3 attempts is the maximum, 4th must be valid or there comes a lockdown.

Errors during login process clear the variable **k_success** (in form's context) and set context variables **k_error** and **k_login_error** e.g.

```xml
<cms:process_login />
<cms:if k_login_error>
<!--// password does not match or else; error is: <cms:show k_login_error />-->
</cms:if>
```

Login will fail for disabled accounts. Use error report to perform action e.g.

```xml
<cms:if k_error='Account disabled'>
  ..
</cms:if>
```

Login template is configured in `couch/addons/extended/config.php` — make sure to register that template first in Admin-panel. Make sure the template appears in backend. Activate it in config as the last step.

Page with this tag is always served non-cached with cache explicitly turned off, similar to using tag [**cms:no_cache**](#related-tags).

## Tips

If the page with login form must not be refreshed, then user-info is not available immediately and must be 'refreshed' programmatically as follows —

```xml
<cms:if k_success>
   <cms:process_login redirect="0"/>
   <cms:if k_success>
      <!--PHP code to set the info about the new login into context (this would have happened automatically had the page refreshed).-->
      <cms:php>
         global $FUNCS;
         $FUNCS->set_userinfo_in_context();
      </cms:php>

      <!--move your additional logic here. Make sure to redirect eventually-->
   </cms:if>
</cms:if>
```

To use the tag without parent form and to check for success use the **k_login_error** variable e.g.

```xml
<cms:process_login username=username password=password remember='1' redirect='0' />
<cms:if "<cms:not k_login_error />">
   ...
   <!--move your additional logic here. Make sure to redirect eventually-->
</cms:if>
```

## Variables

Tag sets variables in the login form context:

* k_error
* k_login_error

Note: Variable *k_success* is not set after a successful login.

Addon **Extended Users** adds following variables in context —

* k_user_template
* k_user_login_template
* k_user_lost_password_template
* k_user_registration_template

## Related tags

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
