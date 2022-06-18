# show_repeatable

Please visit [**Documentation &raquo; Core Concepts - Repeatable Regions**](https://docs.couchcms.com/concepts/repeatable-regions.html#displaying-the-values) for an in-depth discussion about this tag.

```xml
<cms:show_repeatable 'my_multiple_images'>
..
</cms:show_repeatable>
```

## Parameters

* var (default)
* startcount
* limit
* offset
* order
* as_json
* into
* scope
* extended_info
* token

### var

Default parameter (usually left unnamed). The name of the [**repeatable**](https://docs.couchcms.com/tags-reference/repeatable.html) tag defining the repeatable regions.

```xml
<cms:show_repeatable 'my_multiple_images' >
   <b>Image:</b> <img src="<cms:show my_image />" /> <br/>
   <b>Desc:</b> <cms:show my_desc />
   <hr>
</cms:show_repeatable>
```

In the snippet above the string 'my_multiple_images' is the name of a [**repeatable**](https://docs.couchcms.com/tags-reference/repeatable.html) tag.

### startcount

One of the variables set by this tag is *k_count*. The value of this variable increases with each iteration. By default, the first iteration is numbered 1\. The _startcount_ parameter can be used to make *k_count* begin from any arbitrary number.

If you place a `<cms:dump />` within `<cms:show_repeatable>`, you'll find that one of the variable it sets is **k_count**.
The value of this variable is '1' in the first iteration and keeps increasing with each row.
```xml
<cms:show_repeatable 'my_multiple_images' startcount='3'>
   <cms:dump />
</cms:show_repeatable>
```

The **startcount** param serves to set the initial value of **k_count** (default value being *1*).
So, `startcount='0'` will make **k_count** go *0*, *1*, *2* etc. while `startcount='3'` will make it *3*, *4*, *5* and so on.


### limit

The **limit** parameter will make the tag show only the specified number of rows -

```xml
<cms:show_repeatable 'contacts' limit='3' >..
```

### offset

The **offset** parameter will make the tag to begin showing the rows after skipping the number of rows specified in offset -
```xml
<cms:show_repeatable 'contacts' offset='2' >..
```

### order

All variants are –
* order='asc'
* order='desc'
* order='random'

Default value is *asc*. Setting the **order** parameter to '*desc*' will make the tag show the rows in reverse order.

```xml
<cms:show_repeatable 'contacts' order='desc' >..
```

```xml
<cms:show_repeatable 'random_images' order='random' limit='1'>
   <img src="<cms:show image />" />
</cms:show_repeatable>
```

### as_json

Default is *0*. If set, **show_repeatable** will return rows as a JSON-formatted data.

```xml
<cms:show_repeatable 'offices' as_json='1' />
```
Tag can be self-closed in this scenario.

If your intention is to manipulate the JSON, it is best to capture tag's output into a variable. Tags [**capture**](./capture.md#is_json) and **set** certainly help, but **show_repeatable** already has a special provision for this use-case — use the **into** parameter described below.

### into,
### scope

If **into** param is set, **show_repeatable** sets the data it possesses for the entire repeatable region (a multidimensional array) into the variable specified by the param and quits. The idea is that the calling code can process this data as it wishes.

```xml
<cms:show_repeatable 'offices' into='offices_as_json' scope='global' />
```
Alongside **into** must be present the parameter **scope** which possible values are —
* parent
* global

### *extended_info*

This parameter provides access to the full system information of the repeatable's editable fields, including data and definitions. Such extended information can be read only by a few specially crafted tags, one example of those would be 'cms:db_fields', and only if placed within 'cms:show_repeatable' tag-pair:

```xml
<cms:show_repeatable 'offices' limit='1' extended_info='1' >
   <cms:db_fields bound='1'>
      <cms:dump />
   </cms:db_fields>
</cms:show_repeatable>
```


Each row of the repeatable-region would appear as a collection of its fields, packed, for simplicity, into a dummy 'page'. Unlike usual 'pages', this one doesn't have anything besides the details on the fields, attached to it. So the inner tags that will 'bind' to that dummy object will be able to fetch info in the usual manner.

Several Couch tags can be 'bound' to the containing 'page' e.g. 'cms:db_fields' normally binds to the *current* page, being provided with a 'masterpage' parameter, and fetches info from that page's fields automatically. Setting **extended_info** param to *1* allows such tags to be used within 'cms:show_repeatable' where each row of the repeatable-region appears to be a containing bound page to them. Tag 'cms:show_repeatable' will create a 'dummy' page object for *each row* being iterated, populating it with the field objects (with current data) as expected in a real page and setting a name for that dummy object as 'k_bound_page'. Tag 'db_fields' in the code above is instructed by the parameter *bound='1'* to look for the 'k_bound_page'-named object, get it and read fields info from it, thus establishing a simplistic one-way 'communication' between the parent and child tags.

Mosaic uses **extended_info** param in admin-panel (couch\addons\mosaic\theme\fields\display_field_repeatable.html) to render a child repeatable-region.

### *token*

This parameter provides addons with a *token tracker* by which a custom code can see when a certain **show_repeatable** is executed.

As part of its default working, as 'cms:show_repeatable' iterates through the rows it makes available all data of the current row as variables set into the current context. If the **token** param is set (to an arbitrary string identifier), it then raises a PHP 'event' named *rr_alter_ctx_xyz* (where 'xyz' is the value set for 'token' e.g. if 'token' is 'my', the even name is 'rr_alter_ctx_my'). In the event's name "rr" stands for 'repeatable region' and "ctx" is a short of 'Context', where all variables appear with their values. Thanks to a token, the opportunity to alter the context for a certain repeatable-region will be opened only for the tag bearing it.

To resume, **token** allows custom code to be written that can hook onto the event and manipulate the data set for the current row.

## Examples

Sample definition may look as follows –

```xml
<cms:repeatable name='offices' label='Offices'>
    <cms:editable name='office_name' label="Name" type='text' />
    <cms:editable name='office_address' label="Address" type='textarea' />
</cms:repeatable>
```

The following will show only the very first row –

```xml
<cms:show_repeatable 'offices' limit='1' >..
```

The following will show only the second row –

```xml
<cms:show_repeatable 'offices' limit='1' offset='1'>..
```

The following will show only the last row –
```xml
<cms:show_repeatable 'offices' limit='1' order='desc' >..
```

while the following will show only the second-last row –
```xml
<cms:show_repeatable 'offices' limit='1' offset='1' order='desc' >..
```

The following will print all rows data as JSON-formatted string –

```xml
<cms:show_repeatable 'offices' as_json='1' />
```

Here is the JSON output of rows, as a couple of offices were added in admin-panel –
```js
[
   {
      "office_name":"France",
      "office_address":"22 Rue de Lourmel,
       \r\nParis,
       \r\n\u00cele-de-France,
       \r\nFrance "
   },
   {
      "office_name":"Italy",
      "office_address":"Via delle Rose 12,
       \r\nMilan,
       \r\nLombardy,
       \r\nItaly,
       \r\n20144 "
   }
]
```

## Variables

* k_count
* k_total_rows
* k_total_records
* k_first_row
* k_last_row
* *k_bound_page*

### k_count

As this tag iterates through the rows of repeated regions, this variable keeps track of the number of current iteration.<br/>
By default, the first iteration is numbered from '1' but the **startcount** parameter mentioned above can be used to change this.

### k_total_rows,
### k_total_records

The total number of rows that will be iterated.

### k_first_row,
### k_last_row

Flags with values *0* or *1*, are being set to track the first and last rows in the output respectively. Variables only respect what's being printed, i.e. within the **limit** (if set), and not what's in the region in the admin panel. So, if you decided to use **limit**, **offset**, **order** then only the resulting subset of rows will be marked.

```xml
<cms:show_repeatable 'contacts'>
    <cms:if k_first_row >..
    </cms:if>
    ..
    <cms:if k_last_row >..
    </cms:if>
</cms:show_repeatable>
```

### *k_bound_page*

An object of this name is set if [**extended_info**](#extended_info) param is set.

## Related tags

* [**Documentation &raquo; repeatable**](https://docs.couchcms.com/tags-reference/repeatable.html)
* [**Documentation &raquo; pages**](https://docs.couchcms.com/tags-reference/pages.html)

## Related pages

[**Documentation &raquo; Core Concepts - Repeatable Regions**](https://docs.couchcms.com/concepts/repeatable-regions.html#displaying-the-values)
