# not

The tag **not** is used to test the 'reverse' of a logical statement.

```xml
<cms:not condition />
```

Returned value is *1* or *0*.

## Parameters

* logical expression

## Example

```xml
<cms:if "<cms:not username = 'admin' />" >
    <h3>Your are user: <cms:show username />!</h3>
    <cms:else />
    <h3>Hello <cms:show username />!</h3>
</cms:if>
```

```xml
<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
```

```xml
<cms:if "<cms:not "<cms:is 'en' in=langcodes />" />"></cms:if>
```

The last example looks overburdened with nesting. Such use-cases justify a custom tag [**cms:is_not**](#related-tags).

## Related tags

* [**Documentation &raquo; if**](https://docs.couchcms.com/tags-reference/if.html)
* [**Documentation &raquo; else**](https://docs.couchcms.com/tags-reference/else.html)
* [**else_if**](./else_if.md)
* [**is**](./Arrays/is.md)
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)

<!--## Related pages-->

