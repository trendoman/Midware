# page_exists

The **cms:page_exists** tag checks whether or not a cloned page exists. It returns a ***1*** if the page exists else it returns a ***0***.

```xml
<cms:page_exists 'contact-us' masterpage='index.php' />
```

The above snippet is checking for the existence of a page named 'contact-us' that has been cloned out of a template named 'index.php'.

Tag **page_exist** does not take into consideration 'publish' status or date of the page, or its access rights.

## Parameters

* **masterpage**
* **name**
* **id**

### masterpage

Name of the template out of which the cloned page mentioned above has been cloned. If this parameter is skipped, the name of the template of the **currently executing page** will be used instead.

### name

Name of the cloned page the existence of which is to be checked.

### id

If both **id** and **name** are supplied with non-empty values, then only the **name** will be used.

## Variables

This tag is self-closing and does not set any variables of its own.

## Related Tags

* **folder_exists**
