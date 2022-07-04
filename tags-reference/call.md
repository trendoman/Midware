# call

The **call** tag executes a function with optional parameters. It is a self-closed tag and if used as a tag-pair will not execute anything enclosed within.

```xml
<cms:call 'read-aloud' />
```

Call invokes both named functions and anonymous functions (those stored in a variable).

## Parameters

The very first parameter is invariably expected to be the name of the called function or variable (for anonymous functions).<br />
As for the rest, call takes any number of named/unnamed parameters (either literal strings or variables).

**Note:** Unnamed parameters must appear in the same order, defined by **func** tag. Named parameters can appear in any order.

**Important:** Use only named parameters or only unnamed parameters if you are using original, not [**modded**](#related-pages) tag.

## Example

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>
    Making a <cms:show size /> cup of <cms:show type />.<br />
</cms:func>

<cms:call 'makecoffee' />
=> Making a medium cup of cappuccino.<br />

<cms:call 'makecoffee' 'espresso' 'large' />
=> Making a large cup of espresso.<br />

<cms:call 'makecoffee' size='small' type='espresso' />
=> Making a small cup of espresso.<br />
```

### Anonymous

Anonymous functions are stored in a variable, hence we supply the variable itself without quotes i.e. passing by value, not by name.

```xml
<cms:func _into='my_cond' previous_work_experience=''>
    <cms:if previous_work_experience='Yes'>show<cms:else />hide</cms:if>
</cms:func>

<cms:call my_cond previous_work_experience='Yes' />
=> show
```

## Troubleshooting

### Avoid mixed parameters

Use only named parameters or only unnamed parameters, otherwise if parameters are mixed the result is not guaranteed e.g.

```xml
WRONG: <cms:call 'makecoffee' 'small' type='espresso' />
```

***UPDATE:*** Tweak [**Tweakus-Dilectus Modded Tags » call**](#related-pages) fixes the issue with mixing parameters, as long as the original order of unnamed parameters is matched.

### Keep order matched

Always keep the order of **unnamed** values as declared in the function's parameters e.g.

```xml
WRONG: <cms:call 'makecoffee' 'small' 'espresso' />
OK: <cms:call 'makecoffee' 'espresso' 'small' />
```

If all values are named, the order is not important –

```xml
OK: <cms:call 'makecoffee' size='small' type='espresso' />
```

## Variables

Sets no variables of its own.

## Related Tags

* [**func**](./func.md)
* [**func_exists**](./func_exists.md)

## Related pages

* [**Tweakus-Dilectus Modded Tags &raquo; call**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/call)
* [**Tweakus-Dilectus Addon » Func-on-demand**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand) — autoloading and caching for funcs

<!--* An exemplar tutorial on using functions as well as examples are in [&raquo; forum post](https://www.couchcms.com/forum/viewtopic.php?f=8&t=11368&start=10#p30174)-->
<!--* Invoking anonymous functions in Conditional Fields is explained in tutorial in [CouchCMS Forum &raquo; forum topic](https://www.couchcms.com/forum/viewtopic.php?f=5&t=11512)-->
