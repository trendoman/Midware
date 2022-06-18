# func_exists

The **func_exists** tag can be used to check if a particular 'cms:func' function is available.

```xml
<cms:func_exists 'show-ms' />
```

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
