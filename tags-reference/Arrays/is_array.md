# is_array • [Arrays](#related-pages)

Helps to check if a value is an array.

```xml
<cms:is_array my_arr />
```

Returned value is ***1*** or ***0***.

## Parameters

* ***unnamed***

Pass array variable as the parameter to the tag.

## Example

Using following array –

```xml
<cms:set langcodes='["de", "fr", "es", "ru"]' is_json='1' />
<cms:is_array langcodes />

→ 1
```

## Related tags

* [**arr_count**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_count.md)
* [**array_count**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/array_count.md)
* [**arr_key_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_key_exists.md)
* [**arr_val_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_val_exists.md)
* [**is**](https://github.com/trendoman/Midware/tree/main/tags-reference/is.md)
* [**not**](https://github.com/trendoman/Midware/tree/main/tags-reference/not.md)
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)
* [**Tweakus-Dilectus &raquo; show_json**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/show_json/)

## Related pages

* [**Core Concepts &raquo; Couch Arrays**](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)
