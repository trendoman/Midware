# trim

The **trim** tag is used to strip whitespace from the beginning and end of a string.

```html
<cms:trim ' Is there any luck?' />
```

Following characters will be stripped &mdash;
* " " &ndash; an ordinary space.
* "\t" &ndash; a tab.
* "\n" &ndash; a new line (line feed).
* "\r" &ndash; a carriage return.
* "\v" &ndash; a vertical tab.
* "\0" &ndash; the NUL-byte.

There are numerous occasions where a trimmed output is desired. For instance, working with user input demands trimming as one never knows how many spaces were introduced to a user name or a password. The history of this tag shows it was demanded for trimming output of 'cms:call' via a parameter '_trim'. However it soon became obvious that a standalone tag has much broader application.

## Example

```html
<cms:trim><cms:call 'some_func' /></cms:trim>

<cms:trim some_var />
```

As can be seen, it works as both a self-closing tag and otherwise.

## Parameters

No named parameters. Uses the first provided parameter. None if used as a tag-pair.

## Variables

This tag does not set any variables of its own.

## Related Tags

* [**capture**](./capture.md)
