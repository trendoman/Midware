# tag_exists

The **tag_exists** tag can be used to check if a particular tag is available.

```xml
<cms:tag_exists 'show_json' />
```

Returned value is *1* or *0*.

## Usage

One scenario for this tag is customization of warnings when some tag is not registered.

Addons commonly have their own set of tags, and those may not be available at the moment the code is running. This often happens when addon is forgot to be installed or registered via `couch/addons/kfunctions.php` file.

```xml
<cms:if "<cms:tag_exists 'process_login' />">
    ...
    processing ok
    ...
    <cms:else />
    <cms:abort><h1>Tag 'process_login' requires 'Extended Users' addon! Please re-enable it in 'kfunctions.php'.</h1></cms:abort>
</cms:if>
```

## Parameters

* unnamed

## Variables

This tag is self-closing and does not set any variables of its own.

## Related Tags

* [**func_exists**](./func_exists.md)
