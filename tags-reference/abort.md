# abort

Tag **abort** is somewhat akin to PHP *die();*. It breaks the code execution and any code after the tag will not run.

```xml
<cms:abort />
```

## Parameters

* msg
* is_404
* no_commit

### msg

Aborted page will display either **msg** text specified via this parameter,
```xml
<cms:abort msg="Not allowed." />
```
or the content enclosed within tag-pair.

```xml
<cms:abort>Not allowed!</cms:abort>
```

### is_404

Couch will send following headers if this parameter is set &mdash;
```txt
HTTP/1.1 404 Not Found
Status: 404 Not Found
```
Message from **msg** parameter or the enclosed content will be printed.

If there is no message or content set, then Couch will look for the file _404.php_ in site's root and request its output to be printed instead. If the file is not found in site's root, then a simple message "Page not found" will be displayed.

```xml
<cms:abort is_404='1' />
```

### no_commit

Parameter will instruct Couch to _not commit_ any changes made to the database during the code execution pre-abort.

```xml
<cms:abort msg='Rollback.' no_commit='1' />
```

## Usage

Wrapped in a condition &mdash;
```xml
<cms:if something_drastically_not_ok>
   <cms:abort />
</cms:if>
```

Respects Content-Type &mdash;
```xml
<cms:content_type 'application/json' />
<cms:abort>{ "error" : "1" }</cms:abort>
```

Sets its enclosed contents as the output of the current page —
```xml
<cms:abort>
   <h1>Any enclosed content would be outputted before killing off the current page</h1>
</cms:abort>
```

Particularly helpful in handling XHR requests with [**is_ajax**](./is_ajax.md) tag, because a response can be sent back without executing code outside of **abort**.
```xml
<cms:if "<cms:is_ajax />">
   <cms:abort msg=response />
</cms:if>
```

Notes:
* If code has nested **abort** tags, the output of the deepest one will be used.
* If multiple **abort** tags appear on the same page, the first encountered tag's output will be used.
* Content is never cached.
* Parameter **no_commit** helps to skip final commit to database, otherwise commit is *forced*.


## Variables

This tag does not set any variables of its own.

## Related Tags

* [**is_ajax**](./is_ajax.md)
