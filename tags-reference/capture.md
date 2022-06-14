# capture

The **capture** tag can be used to store the output of its enclosed contents within any variable.<br/>
The enclosed contents can be regular HTML code as well as the Couch tags.

```html
<cms:capture into='my_variable' scope='global'>
    ...everything executed here will get stored in variable 'my_variable' at the requested scope...
</cms:capture>
```

The important point is that by 'capturing' we execute some code but do not display its output immediately.<br>
If so we choose, we can ignore that output completely or check some condition further on and then show it.<br>
It is very helpful therefore to buffer some content and display it later if needed.

Another important function this tag performs is setting arrays from JSON-formatted strings.
```html
<cms:capture into='identity' is_json='1'>
{
   "name":"John",
   "age":30,
   "cars":[ "Ford", "BMW", "Fiat" ]
}
</cms:capture>

<cms:show identity.name />
=> John
<cms:show identity.cars.1 />
=> BMW
```
Usual tag 'cms:set' does the same job, but **capture** is easier with larger JSONs or when there are tags or code within the block.


## Example

This tag is very helpful when you want to execute a portion of the code but wish to display the resulting output based on some other condition that is unknown at the point of execution of this code e.g. present in the page somewhere after the block of code in question.

This situation can be tackled by storing the output of the block of code in a variable for the time being. When we reach the required condition and if it evaluates to be true, we can display the output by showing the variable. However, if the condition fails, we can simply ignore the variable.

You'll find an interesting example of this tag's use in [**Sample Portfolio Site - Contact Form**](https://docs.couchcms.com/tutorials/portfolio-site/contact-form.html)


A good example comes when we need to display outer HTML elements only if there is some content e.g.
```html
<cms:capture into='my_buffer'>
   <h1>Reviews</h1>
   <cms:show_repeatable 'reviews' >
      .. markup
      <cms:set has_reviews='1' scope='global' />
   </cms:show_repeatable>
</cms:capture>

<cms:if has_reviews ><cms:show my_buffer /></cms:if>
```
Note how outer _&lt;h1&gt;_ heading will be displayed only if there are some reviews.


## Parameters

* into
* scope
* trim
* is_json

### into

Name of the variable to store the output in. Must not begin with 'k_' (considered system variable).

### scope

Scope of the aforesaid variable. Can be either _global_ or _parent_.<br/>
If set to _global_, the variable will be available anywhere throughout the page. If set to _parent_, the variable will only be available only within the  scope of the parent tag (if any) that is nesting the **capture** tag.

If not set, *global* is assumed.

### trim

Parameter **trim** commands stripping the content of leading and trailing whitespace.

Can be either *0* (default) or *1*.

Following characters will be stripped &mdash;
* " " &ndash; an ordinary space.
* "\t" &ndash; a tab.
* "\n" &ndash; a new line (line feed).
* "\r" &ndash; a carriage return.
* "\v" &ndash; a vertical tab.
* "\0" &ndash; the NUL-byte.

As you might have noted, the effect of applying this parameter will be identical to the output of the standalone tag `<cms:trim>`.

### is_json

The content of the tag is in json format and, if valid, the variable is converted into a multi-string array.

```html
<cms:capture into='climate' is_json='1'>
{
   "Russia" : {
      "Moscow" : "cold",
      "Sochi"   : "warm"
   }
}
</cms:capture >

Climate in Moscow: <cms:show climate.Russia.Moscow /><br>
Climate in Sochi: <cms:show climate.Russia.Sochi />
```

## Variables

Sets only the variable specified by the __into__ parameter within the specified scope. Sets no variables of its own that can be used within its opening and closing tags.

## Related tags

* **set**
