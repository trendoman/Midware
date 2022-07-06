# arr_key_exists • [Arrays](#related-pages)

Tag **cms:arr_key_exists** helps to check if a key exists in associative array.

```xml
<cms:arr_key_exists key='mykey' in=myarray />
```

Returned value is *1* or *0*.

## Parameters

* **key**
* **in**

Parameter **in** is defined *without* single or double quotes i.e. array passed as a variable, not as array's name.

## Example

Define an array as follows –

```xml
<cms:set rec='{"name":"John", "age":30, "cars":[ "Ford", "BMW", "Fiat" ]}' is_json='1' />
<cms:show rec as_json='1' />
```

and check if it contains 'cars' –

```xml
<cms:arr_key_exists 'cars' in=rec />
```

or 'age' –

```xml
<cms:arr_key_exists key='age' in=rec />
```

### Negation

Inverted result can be queried with a tag [**cms:not**](#related-tags) e.g.

```xml
<cms:not "<cms:arr_key_exists 'mykey' in=array />" />
```

as a condition –

```xml
<cms:if  "<cms:not  "<cms:arr_key_exists 'mykey' in=array />"  />"  >...</cms:if>
```

## Related tags

* [**arr_val_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_val_exists.md)
* [**arr_count**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/arr_count.md)
* [**array_count**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/array_count.md)
* [**is**](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays/is.md)
* [**not**](https://github.com/trendoman/Midware/tree/main/tags-reference/not.md)
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)
* [**Tweakus-Dilectus &raquo; show_json**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/show_json/)

## Related pages

* [**Core Concepts &raquo; Couch Arrays**](/concepts/Arrays)
* [**Cms-Fu Funcs &raquo; JSON**](https://github.com/trendoman/Cms-Fu/tree/master/JSON)
