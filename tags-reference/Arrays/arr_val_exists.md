# arr_val_exists • [Arrays](#related-pages)

Tag **cms:arr_val_exists** helps to check if a value exists in a simple array.

```xml
<cms:arr_val_exists val='' in=array />
```

Tag has an alias [**cms:is**](#related-tags) –

```xml
<cms:is val='' in=array />
```

Returned value is *1* or *0*.

## Parameters

* **val**
* **in**

Parameter **in** is defined *without* single or double quotes i.e. array passed as a variable, not as array's name.

## Example

Using following array –

```xml
<cms:set langcodes='["de", "fr", "es", "ru"]' is_json='1' />
```

check if your language-code is present by using literal value e.g.

```xml
<cms:arr_val_exists 'ru' in=langcodes />
```

or by using some variable –

```xml
<cms:arr_val_exists val=k_lang in=langcodes />
```

Using the alias —

```xml
<cms:is 'fr' in=langcodes />
```

### Negation

Inverted result can be queried with a custom tag [**cms:is_not**](#related-tags) –

```xml
<cms:is_not k_lang in=array />
```

or with stock tag [**cms:not**](#related-tags) e.g.

```xml
<cms:not "<cms:arr_val_exists 'myvalue' in=array />" />
```

as a condition –

```xml
<cms:if  "<cms:not  "<cms:is 'myvalue' in=array />"  />"  >...</cms:if>
```

## Related tags

* [**arr_key_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_key_exists.md)
* **arr_count**
* **array_count**
* [**is**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/is.md)
* [**not**](https://github.com/trendoman/Midware/tree/main/tags-reference/not.md)
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)
* [**Tweakus-Dilectus &raquo; show_json**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/show_json/)

## Related pages

* [**Core Concepts &raquo; Couch Arrays**](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)
* [**Cms-Fu Funcs &raquo; JSON**](https://github.com/trendoman/Cms-Fu/tree/master/JSON)
