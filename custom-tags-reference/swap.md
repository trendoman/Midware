# `<cms:swap>`

Replace, cut, insert strings in a text with support of Arrays and Regular Expressions (regex).

```xml
<cms:swap val='mr.' with='Mr.'><cms:show mytext /></cms:swap>
<cms:swap val='mr.' with='Mr.' text=mytext />
```

Both self-closed and open tag-pair versions are valid, with priority given to parameter **text** over enclosed text.

## Parameters

* **val** – a string, or array of strings, or regular expression pattern(s) that will be searched for in the text.
* **with** – a string or array of strings that will be used as replacement(s).
* **is_regex** – a flag to indicate that **val** is a regex pattern (or array of patterns) – takes either ***0*** (default) or ***1***
* **trim** – value ***1*** (***0*** is default) requests to trim incoming text before swapping
* **text** – incoming text
* **into** – variable name to save output into (will be created in global scope or reused existing in parent scope)
* **scope** – scope of the variable (***global***, ***parent***)

## Example with strings

### Swap multiple tags

The task is to swap tag "pre" with "code" in the string

```html
<pre style="color:darkblue">$a = 5;</pre>
```

Either use arrays to supply the tag with multiple values and replacements or add an inner tag, each with a single-value swapping

#### with arrays

```xml
<cms:set arr_search = '["<pre", "</pre>"]' is_json='1'/>
<cms:set arr_replace = '["<code", "</code>"]' is_json='1'/>
<cms:swap val=arr_search with=arr_replace><pre style="color:darkblue">$a = 5;</pre></cms:swap>
```

> Result:\
> ```<code style="color:darkblue">$a = 5;</code>```

#### with inner tag

```xml
<cms:swap val='<pre' with='<code'>
  <cms:swap val='</pre' with='</code'>
    <pre style="color:darkblue">$a = 5;</pre>
  </cms:swap>
</cms:swap>
```

> Result:\
> ```<code style="color:darkblue">$a = 5;</code>```

Regex allows to write a one-liner

#### with regex

```xml
<cms:swap val='~<(/)?pre~' with='<$1code' is_regex='1'><pre style="color:darkblue">$a = 5;</pre></cms:swap>
```

## More examples with regex

### Swap space with underscore

Converts a *Default value* to ***default_value***
```xml
<cms:swap val='~\s~' with='_' is_regex='1'><cms:show 'Default value' case='lower' /></cms:swap>
```

### Keep only money without currency symbol

```xml
<cms:swap val='/[^0-9.]/' with='' is_regex='1'>$ 123.00</cms:swap>
```

> Result:\
> **123.00**

### Convert a text to HTML

```xml
<cms:swap val='/(\r\n)?\s*(\w*):\s*(\w*)/' with='$1<b>$2</b>: $3<br>$1' is_regex='1'>
  key1: value1
  key2: value2
</cms:swap>
```

> Result:
> ```html
> <b>key1</b>: value1<br>
> <b>key2</b>: value2<br>
> ```
> HTML preview:
> <pre>
> <b>key1</b>: value1
> <b>key2</b>: value2


### Short regex reference

The following should be escaped if you are trying to match that character

```txt
\ ^ . $ | ( ) [ ]
* + ? { } ,
```

<details><summary><strong>Common Special Character Definitions</strong></summary>

<pre>
\ Quote the next metacharacter
^ Match the beginning of the line
. Match any character (except newline)
$ Match the end of the line (or before newline at the end)
| Alternation
() Grouping
[] Character class
* Match 0 or more times
+ Match 1 or more times
? Match 1 or 0 times
{n} Match exactly n times
{n,} Match at least n times
{n,m} Match at least n but not more than m times

More Special Character Stuff

\t tab (HT, TAB)
\n newline (LF, NL)
\r return (CR)
\w Match a "word" character (alphanumeric plus "_")
\W Match a non-word character
\s Match a whitespace character
\S Match a non-whitespace character
\d Match a digit character
\D Match a non-digit character
\b Match a word boundary
\B Match a non-(word boundary)
</pre>

</details>

## Advanced example with dynamic code

```xml
<!-- setting vars for example -->
<cms:set myvar='1' />
<cms:set name='myvar' />
<!-- begin -->
<cms:capture into='dynatext'>
    <%cms:if <cms:show name /> eq '1'>Yes<%cms:else/>No</%cms:if>
</cms:capture>
<!-- run "dynatext" as code -->
<cms:embed code="<cms:swap val='%cms:' with='cms:' text=dynatext />" />
```

> Result:\
> Yes

A simple (and silly) example that first executes valid "show" tag in the "dynacode" text which becomes

```xml
<cms:if myvar eq '1'>Yes<cms:else />No</cms:if>
```

– then executes the text itself (it is now perfectly valid Couch code) with help of "embed" tag.

Any dynamic code can be written and converted to valid via this elegant swap.

## Various practical examples

#### Remove "LIMIT" from SQL query

```xml
<cms:swap val='~(LIMIT.*$)~' with='' is_regex='1' text=sql/>
```

#### Remove draft check from SQL query

```xml
<cms:swap val='AND p.parent_id=0' with=' ' text=k_sql_where />
```

#### Remove banned chars for building `opt_select`

```xml
<cms:set chars = '[ "=", "|" ]' is_json='1' />
<cms:swap val=chars with=' ' text=k_page_title />
```

#### Replace non-word symbols to make 'safe' text

```xml
<cms:swap val='~\W~' with='-' is_regex='1' trim='1' text=k_page_title />
```

#### Restore quotes

```xml
<cms:swap val='&quot;' with='"' text=pk0 />
```

#### Remove invalid comments from JSON

```xml
<cms:swap val='~\/\/.*~' with='' is_regex='1'>{
   "id"      :"",  // k_page_id
   "title"   :""   // k_page_title
}
</cms:swap>
```

## Related funcs

* **Converters » trim-tags**
* **Money » inr-format**

## Related tags

- **Tweakus-Dilectus Tags » hilite**
- **Tweakus-Dilectus Tags » transliterate**
- **Tweakus-Dilectus Tags » arr_filter_values**

## Credits

If you need help with RegEx, ask me via email.

Anton S.\
tony.smirnov@gmail.com
