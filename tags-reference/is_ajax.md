# is_ajax

Tag **is_ajax** detects a *xmlhttprequest* value in headers of a request, reading it from *HTTP_X_REQUESTED_WITH* constant.

In essense it is a flag that signals *1* for any programmatic xhr (ajax) request.

```xml
<cms:is_ajax/>
```
Tag does not break code execution.

Returned value is *1* or *0*.

## Usage

Allows to prepare some response for a visitor &mdash;

```xml
<cms:if "<cms:is_ajax />">
   ..response..
</cms:if>
```

Pair it with **abort** tag and, if needed, **content_type** tag to send back JSON e.g.

```xml
<cms:if "<cms:is_ajax />" >
   <cms:content_type 'application/json' />
   <cms:abort>{}</cms:abort>
</cms:if>
```

Place **is_ajax** as closer to the top as possible, before the rest of the code, to avoid unnecessary execution of unwanted code pre-tag.

## Parameters

None.

## Variables

This tag does not set any variables of its own.

## Related Tags

* [**abort**](./abort.md)
* [**content_type**](./content_type.md)
