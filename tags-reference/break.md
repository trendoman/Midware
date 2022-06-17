# break

The **break** tag can be used to abort a loop set by 'cms:each'. It is self-closed and takes no parameters.

```xml
<cms:break />
```

At the moment, **break** is only recognized inside the **each** pair e.g.
```xml
<cms:each myvar >
    ...
    <cms:if mycond>
        <cms:break />
    </cms:if>
</cms:each>
```

## Example

In the following elementary example only the first 3 iterations (starting with *1*) will allow the 'cms:show' to execute.

```xml
<cms:each '1,2,3,4,5' startcount='1' sep=','>
    <p>Chapter <cms:show k_count/></p>
    <cms:if k_count = '3' ><cms:break /><p>End of story.</p></cms:if>
    <cms:if k_count = '3' >
        <p>New beginning? Hardly so.</p>
    </cms:if>
</cms:each>
```

Code above produces following output &ndash;
```txt
Chapter 1
Chapter 2
Chapter 3
End of story.
```

**Note:** 'cms:break' effect kicks in *after* the HTML for the wrapping (parent) condition has been evaluated and output generated. Breaking *will not* happen immediately.<br>
The next 'cms:if' condition will have an effect of break in fullest, hence the 'story ends' right there, before the 'new beginning'.

As **each** helps iterate possibly large arrays, texts, comma-separated strings, sets of numbers, etc &ndash; **break** will help simplify conditioning and will save execution time preventing unnecessary iterations.

## Parameters

None.

## Variables

This tag is self-closing and does not set any variables of its own.

## Related Tags

* [**&raquo; each**](https://docs.couchcms.com/tags-reference/each.html)
* **continue**
