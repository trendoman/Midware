# Functions

## Intro

Generally speaking, a function is a "subprogram" that can be *called* by code external (or internal in the case of recursion) to the function. Like the program itself, a function is composed of a sequence of statements called the *function body*. Values can be passed to a function, and the function will *return* a value.

Functions are one of the fundamental building blocks in all programming languages. A function is similar to a procedure — a set of statements that performs a task or calculates a value, but for a procedure to qualify as a function, it should take some input and return an output where there is some obvious relationship between the input and the output. To use a function, you must define it somewhere in the scope from which you wish to call it.

A function definition (also called a function declaration, or function statement) consists of the opening tag **&lt;cms:func>**, followed by:

* The name of the function.
* A list of parameters to the function separated by space.

## Example 1

For example, the following code defines a simple function named ***makecoffee***:

```xml
<cms:func 'makecoffee' type='cappuccino' >
   Making a cup of <cms:show type />.<br />
</cms:func>
```

Parameters are essentially passed to functions by value — so if the code within the body of a function assigns a completely new value to a parameter that was passed to the function, the change is not reflected globally or in the code which called that function.

Defined function can be called from any part of the code with tag ***&lt;cms:call /&gt;*** followed by a name of the function and optional parameters with values. For example, the following code calls the aforesaid function without any parameters assuming the default values will be used in the function body:

```xml
<cms:call 'makecoffee' />

→ Making a cup of cappuccino.<br />
```

Function's definition invariably has *named* parameters, while can be called with *named* and/or *unnamed* parameters:

```xml
<cms:call 'makecoffee' 'espresso' />
```

## Example 2

With more than a single parameter function will assign values to the parameters depending on the placement order.

```xml
<cms:func 'makecoffee2' type='cappuccino' size='medium'>
   Making a <cms:show size /> cup of <cms:show type />.<br />
</cms:func>

<cms:call 'makecoffee2' />
<cms:call 'makecoffee2' 'espresso' 'large' />
<cms:call 'makecoffee2' size='small' type='espresso' />
```

Output:

    Making a medium cup of cappuccino.
    Making a large cup of espresso.
    Making a small cup of espresso.

The example above defines another function (named 'makecoffee2') that takes two parameters - **type** and **size**.
Please note the third &lt;cms:call /&gt; statement above - it shows how we can pass parameters to the function in any order by explicitly using their names. If names are not used with the parameters then they have to be passed in strictly the same order as that defined by the function being called, as shown by the second &lt;cms:call /&gt; (i.e. first 'type' and then 'size').

## Example 3

Function body consists of any combination of HTML and tags, including other functions and calls. It is thus possible to call the function itself from within its body i.e. recurse:

```xml
<cms:func 'recursion' count='0'>
   <cms:if count lt '20'>
      count: <cms:show count /><br>
      <cms:call 'recursion' "<cms:add count '1' />" />
  </cms:if>
</cms:func>

<cms:call 'recursion' />
```

Output:

    count: 0
    count: 1
    count: 2
    count: 3
    count: 4
    count: 5
    ..
    ..

Hopefully the simple examples above should be sufficient to illustrate how we can use &lt;cms:func /&gt; for creating resusable chunks of code.

## Default values

I'd like to stress one point about &lt;cms:func /&gt; here - **every parameter we define for it needs to have a default value** (it may be blank but it has to be present) e.g. the following is incorrect

```xml
<cms:func 'makecoffee' type >
```

Following is the right syntax if the parameter has no visible default value -

```xml
<cms:func 'makecoffee' type='' >
```

## Code management

### Embed

Finally, you might find it more manageable to put all functions (or groups of related functions) as snippets e.g. I could create a snippet named `funcs.inc` as follows (the cms:hide allows me to freely use text as comments) -

```xml
<cms:hide>
   <!-- makes coffee (what else did you expect?) -->
   <cms:func 'makecoffee' type='cappuccino' >
      Making a cup of <cms:show type />.<br />
   </cms:func>

   <!-- make coffee version 2 -->
   <cms:func 'makecoffee2' type='cappuccino' size='medium'>
      Making a <cms:show size /> cup of <cms:show type />.<br />
   </cms:func>

   <!-- look Ma! I can recurse! -->
   <cms:func 'recursion' count='0'>
      <cms:if count lt '20'>
          count: <cms:show count /><br>
          <cms:call 'recursion' "<cms:add count '1' />" />
      </cms:if>
   </cms:func>
</cms:hide>
```

And now my test template could embed the snippet somewhere at its beginning -

```xml
<cms:embed 'funcs.html' />
```

and *then* call the functions as usual -

```xml
<cms:call 'makecoffee' />
<cms:call 'makecoffee' '' />
<cms:call 'makecoffee' 'espresso' />

<cms:call 'makecoffee2' />
<cms:call 'makecoffee2' 'espresso' 'large' />
<cms:call 'makecoffee2' size='small' type='espresso' />

<cms:call 'recursion' />
```

### Autoload

Embedding funcs as above becomes tedious and error prone when there are many of funcs. With the __[addon *"func-on-demand"*](#related-pages)__, you can keep each func separately in a single folder and only specify the path of that folder to addon. Now whenever Couch encounters a **&lt;cms:call /&gt;**, it will ask addon to locate the code for the func being called and automatically embed it.

## Func Vs. Embed

Tag **embed** (used as tag-pair i.e. ***&lt;cms:embed&gt;&lt;/cms:embed&gt;***) also supports passing variables in its own scope towards the content of the snippet:

```xml
<cms:embed 'alert.html' type='success' text='Success!' ></cms:embed>
```

With snippet `alert.html` having content —

```html
<div class="alert alert-<cms:get 'type' default='warning' /> shadow mb-3 alert-dismissible fade show">
   <cms:show text />

   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
```

output is shaped according to the passed values of parameters **type** and **text**.

Rewriting of the snippet above into a func is quite a simple process, so let's not repeat ourselves, and instead focus on the direct comparison of two tags. Behavior and output would be identical but a few considerations should help choose one or the other.

* functions must be embedded first, then called; while a snippet is only embedded. This point may look negligent with aforementioned *Autoloading* addon, however it helps to think differently about the content of the func/snippet body —
* snippets do not have any 'wrapping' code - their content is HTML, JS, JSON, CSS and whatever else you design them to hold, even without any Couch tags whatsoever if embedded without parameters. Funcs can take any content as well, but it is more natural to have markup not wrapped in extra lines of tags.
* functions are a bit more generic; snippets can be very, *very* granular – down to a single bootstrap component or even smaller.
* functions are designed to be called with strictly defined parameters and can not 'see' un-defined parameters (only variables from global context), while snippets may take parameters 'on-the-fly' (check if they are passed).
* function call is much more concise than embed, chaining function calls is easier.

Above points were the source of inspiration to create a [function](#related-pages) named ***embed***. ☺ Before 'embedding' func checks if the snippet exists and gives a quick method to store embedded snippet's output in a variable.

## Func and Embed snippets Vs. Tags

Couch is mostly based on tags (*we love tags!*), but for us embeds and funcs provide a great deal of freedom and expansion possibilities, to name a few:

* We can create multiple snippets that do a similar job with different HTML output (e.g. list parent folders with various markup)
* Embeddable snippets and funcs are easy to create for anyone (following the samples[^1]). Custom tags require PHP knowledge.
* Snippet is easy to share and just drop into a site's directory, while custom tag needs to be handled first (i.e. put in `couch/addons/kfunctions.php`). The 'handling' part is taken care of by Autoloading[^2] of tags, btw.
* We know what functions we have just by looking at the list of file names, while tags must be remembered, documented[^3] and their possible options are not visible easily (need to have a doc page for each tag or crawl PHP sources)
* Tags are very easy to use and require less writing.

Some *essential* functions (e.g. base64[^4] decoding/encoding) will look better in a tag, especially when they are adopted by the core distribution. But non-core functionality is best to keep and maintain as func-snippets.

[^1]: A lot of func samples in the **[https://github.com/trendoman/Cms-Fu](https://github.com/trendoman/Cms-Fu) repository**

[^2]: Autoloading of tags is used in the 'new tags' and 'modded tags' parts of **[https://github.com/trendoman/Tweakus-Dilectus](https://github.com/trendoman/Tweakus-Dilectus) repository**

[^3]: Many core tags and concepts have been recently documented and re-documented in **[Midware](https://github.com/trendoman/Midware/tree/main/tags-reference/) repository**. Star & watch the repo or bookmark the **[changelog.md](https://github.com/trendoman/Midware/blob/main/CHANGELOG.md) file** to be updated with latest additions.

[^4]: Working with base64 encoding is simplified with these tags: **[base64_decode](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/base64_decode#cmsbase64_decode), [base64_encode](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/base64_encode#cmsbase64_encode)**

## Related pages

* **A function *embed* is [available for download](https://github.com/trendoman/Cms-Fu/tree/master/Sapling/embed#embed)**
* **[Addon _"func-on-demand"_](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__func-on-demand#addon-func-on-demand)** makes working with funcs a real delight.
* Kung Fu with CouchCMS functions is best learned with **[https://github.com/trendoman/Cms-Fu](https://github.com/trendoman/Cms-Fu) repository** samples. Star & watch the repo or bookmark the **[changelog.md](https://github.com/trendoman/Cms-Fu/blob/master/CHANGELOG.md#whats-new-in-cms-fu) file** to be updated with latest additions.

## Related tags

* [**Documentation &raquo; embed**](https://docs.couchcms.com/tags-reference/embed.html) — a bit outdated page does not mention passing parameters yet.
* [**Midware Tags Reference &raquo; func**](https://github.com/trendoman/Midware/tree/main/tags-reference/func.md)
* [**Midware Tags Reference &raquo; call**](https://github.com/trendoman/Midware/tree/main/tags-reference/call.md)
* [**Midware Tags Reference &raquo; func_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/func_exists.md)
