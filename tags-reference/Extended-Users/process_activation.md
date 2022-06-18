# process_activation • [**Extended Users**](../../tutorials/Extended-Users)

Tag **cms:process_activation** handles account activation for the user that visited template using the activation link we emailed her.

Successful activation sets account active and enables user to log in.

Tag is self-closed and belongs to the [**Extended Users**](../../tutorials/Extended-Users) addon's tags [suite](#related-tags).
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

Tag will set context variables —

* k_success
* k_error

## Related tags

* [**activation_link**](./activation_link.md)
* **login_link**
* **logout_link**
* **process_login**
* **process_logout**
* **process_forgot_password**
* **process_reset_password**
