# activation_link

Tag **cms:activation_link** helps get the registration activation link and belongs to [Extended Users](https://www.couchcms.com/docs/extended-entities/post.htm) addon.

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

## Related tags

* [**process_activation**](./process_activation.md)

