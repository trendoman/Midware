# strlen

Tag **cms:strlen** counts a string's length.

```xml
<cms:strlen my_string />
```

If PHP version supports it, the multi-byte string extension is used to correctly count number of characters in a string of UTF8.

Important note is that **the string will be trimmed before counting**, i.e. stripped of any non-symbol characters before and after the string, just like tag [**cms:trim**](#related-tags) does.

Tag will always output ***0*** on non-strings, i.e. arrays.

## Parameters

An unnamed parameter with a string value.

## Example

Tag is particularly helpful in verifying the content of some output buffered by tag [**cms:capture**](#related-tags) e.g.

```xml
<cms:capture into='my_buffer'>
   <cms:show_mosaic 'gallery'>
      <a class="" href="<cms:show img_gal />" title="<cms:show title_img />">
         <img src="<cms:show img_gal_thumb />" alt="<cms:show title_img />"/>
      </a>
   </cms:show_mosaic>
</cms:capture>
```

– next, the buffer is validated for any content and some wrapper is applied to a non-empty buffer –

```xml
<cms:if "<cms:strlen my_buffer />">
   <div class="row">
      <cms:show my_buffer />
   </div>
</cms:if>
```

Use-cases where a string must be validated for actual text content, without HTML tags, demand [**not_empty**](#related-tags) tag instead.

## Related Tags

* [**Documentation &raquo; not_empty**](https://docs.couchcms.com/tags-reference/not_empty.html)
* [**Tweakus-Dilectus Tags &raquo; if_empty**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/if_empty)
* [**trim**](./trim.md)
* [**capture**](./capture.md)
