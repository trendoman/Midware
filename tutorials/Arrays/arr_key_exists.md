# arr_key_exists • [Arrays](#related-pages)

Tag **cms:arr_key_exists** helps to check if a key exists in associative array.

```xml
<cms:arr_key_exists mykey myarray />
```

## Parameters

It accepts 2 parameters: **key**, **in**.

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

## Related tags

* **arr_count**
* **array_count**
* **arr_val_exists**
* **is**
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)

## Related pages

* [**Couch Arrays – Tutorial**](../../tutorials/Arrays)
