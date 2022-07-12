# arr_count • [Arrays](#related-pages)

Tag **cms:arr_count** shows number of array elements.

```xml
<cms:arr_count my_array />
```

Returns ***empty string*** if supplied variable is not an array.

---

Tag's sibling is the [**cms:array_count**](#related-tags) tag, which does the same but returns ***0*** if value is not an array.

## Parameters

* **var**

Parameter's name can be either **var** or omitted.

## Example

```xml
<cms:set rec='["de", "fr", "es"]' is_json='1' />
<cms:arr_count rec />
```

output is ***`3`***

### Negation

Inverted result – ***0*** or ***1*** – can be achieved with a tag [**cms:not**](#related-tags) e.g.

```xml
<cms:not "<cms:arr_count rec />" />
```

as a condition –

```xml
<cms:if  "<cms:not  "<cms:arr_count var=rec />"  />"  >...</cms:if>
```

## Related tags

* [**array_count**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/array_count.md)
* [**arr_key_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_key_exists.md)
* [**arr_val_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_val_exists.md)
* [**is_array**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/is_array.md)
* [**is**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/is.md)
* [**not**](https://github.com/trendoman/Midware/tree/main/tags-reference/not.md)
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)

## Related pages

* [**Core Concepts &raquo; Couch Arrays**](/concepts/Arrays)
