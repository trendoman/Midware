# else_if

Tag has been created to unclutter conditional statements. It must be self-closed.
```xml
<cms:else_if />
```

## Example

```xml
<cms:if condition1 >
<cms:else_if condition2 />
<cms:else />
</cms:if>
```
Same structure with a more 'grounded' example &mdash;
```xml
<cms:if day = 'Saturday' || day = 'Sunday' >
   Hooray, it's a weekend!
<cms:else_if day = 'Friday' />
   Uff, last day of work!
<cms:else />
   Keep going. Don't look back!
</cms:if>
```


With the current logic tags (`cms:if` and `cms:else`) it isn't uncommon to find oneself in a rather 'heavily-nested' situation. A lot of screen space is lost in the text editor and, more importantly, it can also make reading code somewhat challenging. Let's use Couch's standard view handling as an example:

```xml
<cms:if k_is_page >
    Page
<cms:else />
    <cms:if k_is_home >
        Home
    <cms:else />
        <cms:if k_is_folder >
            Folder
        <cms:else />
            Archive
        </cms:if>
    </cms:if>
</cms:if>
```

While embedding snippets certainly helps to alleviate some of the aforementioned problems, it isn't always an appropriate solution.

The addition of cms:else_if tag to the suite of logic tags now transforms the previous code example to:

```xml
<cms:if k_is_page >
    Page
<cms:else_if k_is_home />
    Home
<cms:else_if k_is_folder />
    Folder
<cms:else />
    Archive
</cms:if>
```

## Parameters

Same as **if**.

## Variables

This tag does not set any variables of its own.

## Related Tags

* **if**
* **else**
* **not**
