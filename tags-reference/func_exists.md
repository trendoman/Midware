# func_exists • **[Reusable Functions](https://github.com/trendoman/Midware/tree/main/concepts/Reusable-Functions#intro)**

The **func_exists** tag can be used to check if a particular '&lt;cms:func&gt;' function is available.

```xml
<cms:func_exists 'show-ms' />
```

Returned value is *1* or *0*.

## Usage

One scenario for this tag is customization of warnings when some func is not registered.<br>

```xml
<cms:if "<cms:func_exists 'makecoffee' />">
    <cms:call 'makecoffee' />
</cms:if>
```

## Parameters

* unnamed

## Variables

This tag is self-closing and does not set any variables of its own.

## Related Tags

* [**call**](./call.md)
* [**func**](./func.md)
* [**tag_exists**](./tag_exists.md)

## Related pages

* **[Concepts » Reusable Functions](https://github.com/trendoman/Midware/tree/main/concepts/Reusable-Functions#intro)** – starting tutorial on functions
* **[Tweakus-Dilectus Addon » Func-on-demand](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand)** — autoloading and caching for funcs
