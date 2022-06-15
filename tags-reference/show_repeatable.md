# show_repeatable

Please see [**Core Concepts - Repeatable Regions**](https://docs.couchcms.com/concepts/repeatable-regions.html#displaying-the-values) for an in-depth discussion about this tag.

```html
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
* extended_info
* as_json
* into
* scope
* token

### var

Default parameter (usually left unnamed). The name of the [**repeatable**](https://docs.couchcms.com/tags-reference/repeatable.html) tag defining the repeatable regions.

```html
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
```html
<cms:show_repeatable 'my_multiple_images' startcount='3'>
   <cms:dump />
</cms:show_repeatable>
```

The **startcount** param serves to set the initial value of **k_count** (default value being *1*).
So, `startcount='0'` will make **k_count** go *0*, *1*, *2* etc. while `startcount='3'` will make it *3*, *4*, *5* and so on.


### limit

The **limit** parameter will make the tag show only the specified number of rows -

```html
<cms:show_repeatable 'contacts' limit='3' >..
```

### offset

The **offset** parameter will make the tag to begin showing the rows after skipping the number of rows specified in offset -
```html
<cms:show_repeatable 'contacts' offset='2' >..
```

### order

All variants are –
* order='asc'
* order='desc'
* order='random'

Default value is *asc*. Setting the **order** parameter to '*desc*' will make the tag show the rows in reverse order.

```html
<cms:show_repeatable 'contacts' order='desc' >..
```

```html
<cms:show_repeatable 'random_images' order='random' limit='1'>
   <img src="<cms:show image />" >
</cms:show_repeatable>
```

### extended_info


### as_json

Default is *0*. If set, **show_repeatable** will return rows as a JSON-formatted data.

### into
### scope

* parent
* global

### token

## Examples

The following will show only the very first row –

```html
<cms:show_repeatable 'contacts' limit='1' >..
```

The following will show only the second row –

```html
<cms:show_repeatable 'contacts' limit='1' offset='1'>..
```

The following will show only the last row –
```html
<cms:show_repeatable 'contacts' limit='1' order='desc' >..
```

while the following will show only the second-last row –
```html
<cms:show_repeatable 'contacts' limit='1' offset='1' order='desc' >..
```

## Variables

* k_count
* k_total_rows
* k_total_records
* k_first_row
* k_last_row
* k_bound_page

### k_count

As this tag iterates through the rows of repeated regions, this variable keeps track of the number of current iteration.<br/>
By default, the first iteration is numbered from '1' but the **startcount** parameter mentioned above can be used to change this.

### k_total_rows,
### k_total_records

The total number of rows that will be iterated.

### k_first_row,
### k_last_row

Flags with values *0* or *1*, are being set to track the first and last rows in the output respectively. Variables only respect what's being printed, i.e. within the **limit** (if it is set), and not what's in the region in the admin panel. So, if you decided to use **limit**, **offset**, **order** then only the resulting subset of rows will be marked.

```html
<cms:show_repeatable 'contacts'>
    <cms:if k_first_row >..
    </cms:if>
    ..
    <cms:if k_last_row >..
    </cms:if>
</cms:show_repeatable>
```

### k_bound_page


## Related tags

* [**&raquo; repeatable**](https://docs.couchcms.com/tags-reference/repeatable.html)
* [**&raquo; pages**](https://docs.couchcms.com/tags-reference/pages.html)
