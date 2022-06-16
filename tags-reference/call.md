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

Anonymous functions are stored in a variable, hence we supply the variable itself without quotes i.e. passing by value, not by name.

```xml
<cms:func _into='my_cond' previous_work_experience=''>
    <cms:if previous_work_experience='Yes'>show<cms:else />hide</cms:if>
</cms:func>

<cms:call my_cond previous_work_experience='Yes' />
=> show
```

## Variables

Sets no variables of its own.

## Related Tags

* [**func**](./func.md)
* [**func_exists**](./func_exists.md)


## Links

- An exemplar tutorial on using functions as well as examples are in [this post](https://www.couchcms.com/forum/viewtopic.php?f=8&t=11368&start=10#p30174)
- Invoking anonymous functions in Conditional Fields is explained in tutorial in [this topic](https://www.couchcms.com/forum/viewtopic.php?f=5&t=11512)
