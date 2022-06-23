# func

The **func** tag works by wrapping a piece of code and executing it sometime later upon a call. Unlike 'cms:capture' the code is not executed immediately.

Enclosed code may be configured to output different results depending on different values of its variables. Tag 'cms:func' then  helps define such variables and, titled with a name, becomes a powerful instrument with unlimited function.

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>
    Making a <cms:show size /> cup of <cms:show type />.
</cms:func>
```

Functions can be **named** and **anonymous**.

**Anonymous** functions are not registered with Couch and their code is only saved to a variable. Often used in conditional fields, they fulfill an auxiliary role and can be configured to appear within a specific **scope** &ndash; *global*, *local* or *parent*. This feature allows to view them as 'helpers' that perform some action and disappear outside their scope, mimicking the behaviour or regular variables. Functions defined with the same name can 'replace' the previous ones.

**Named** functions are registered within Couch, cached to database to improve loading and are visible in global scope e.g. can be called from inside other functions or tags. Presence of a named function can be verified by the tag 'cms:func_exists'. Functions with the same name should not appear twice - Couch will treat it as error and halt.

Functions can be nested within each other.

Functions can be chained by calling another one in code.

## Parameters

* unnamed
* _into
* _scope
* named

Named functions must have the very first mandatory parameter that gives name to it.

Parameters **_into** and **_scope** are meant for anonymous functions.

Both named and anonymous functions can have an unlimited number of user-defined named parameters that accept values from a caller.

## Example

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>
    Making a <cms:show size /> cup of <cms:show type />.
</cms:func>

<cms:call 'makecoffee' />
=> Making a medium cup of cappuccino.

<cms:call 'makecoffee' 'espresso' 'large' />
=> Making a large cup of espresso.

<cms:call 'makecoffee' size='small' type='espresso' />
=> Making a small cup of espresso.
```

Briefly take a look at the last, third, example above and note how the order of named parameters in 'cms:call' tag is different from the order of those defined by the func. Values will be correctly matched, because parameters are named explicitly in the caller. It means that if you decide to omit names, make sure values are passed in expected order. That order has been followed in the second example with unnamed passed parameters.

**Important: Best thing is to either use all named params or all unnamed params (*unnamed – in the declared order*)**. For more information see [**cms:call**](#related-tags) tag.

### Anonymous

Anonymous functions are stored in a variable. To call such function we supply the variable itself without quotes i.e. passing by value, not by name.

```xml
<cms:func _into='my_cond' previous_work_experience=''>
    <cms:if previous_work_experience='Yes'>show<cms:else />hide</cms:if>
</cms:func>

<cms:call my_cond previous_work_experience='Yes' />
=> show
```

Functions can accept any kind of value to its parameter - strings, arrays, even other anonymous functions.

The following example illustrates a method of **callback** - a function's name is passed as a parameter and will be called upon.

```xml
<cms:func 'purchase' product='' amount='' reason=''>
    I have purchased a <cms:show product /> for <cms:show amount />.
    I want to <cms:call reason />
</cms:func>

<cms:func _into='travel'>see the world.</cms:func>
<cms:func _into='donate'>donate it to charity.</cms:func>
<cms:func 'gift'>send it as a present.</cms:func>

<cms:call 'purchase' 'phone' '$200' 'gift' />
=> I have purchased a phone for $200. I want to send it as a present.

<cms:call 'purchase' 'toy' '$100' donate />
=> I have purchased a toy for $100. I want to donate it to charity.

<cms:call 'purchase' 'tour' '$500' travel />
=> I have purchased a tour for $500. I want to see the world.
```

In the example above there is no need for complicated conditions within the main function 'purchase'. Also if the number of reasons grows, there is no need to edit that function! Simply adding a smaller 'reason' function we achieve the desired effect. Here 'reason' is a callback function.

## Variables

All values that a caller sends to a function e.g. 'espresso', 'large', become available within the function as values of variables that are named after func's parameters e.g. 'size', 'type'.

Couch additionally sets 3 special variables available only within 'cms:func' during execution. Those are &mdash;

* **k_func**
* **k_args**
* **k_named_args**

These can be called *advanced vars* and are meant to mostly be processed programmatically. Vast majority of functions wouldn't need to use them.

### k\_func

Variable **k\_func** contains either name of the function or a word: *anonymous*. Variable can be used, for example, in detailed logs such as this &mdash;

```xml
<cms:func 'generate-sitemap' >
    ...
    <cms:log msg="Function [ <cms:show k_func /> ] has been called." />
</cms:func>
=> Function [ generate-sitemap ] has been called.
```

### k\_args

It provides a programmatic access to the arguments passed alongside the call. Variable **k\_args** is an array, e.g.

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>
    <cms:show k_args as_json='1' />
</cms:func>

<cms:call 'makecoffee' size='small' type='espresso' />
=> [{"name":"size","val":"small"},{"name":"type","val":"espresso"}]

<cms:call 'makecoffee' type='espresso' 'large' />
=> [{"name":"type","val":"espresso"},{"name":"","val":"large"}]

<cms:call 'makecoffee' />
=> []
```

### k\_named_args

Variable **k\_named_args** presents an array of passed named arguments, completely skipping unnamed e.g.

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>
    <cms:show k_named_args as_json='1' />
</cms:func>

<cms:call 'makecoffee' size='small' type='espresso' />
=> {"type":"espresso","size":"small"}

<cms:call 'makecoffee' type='espresso' 'large' />
=> {"type":"espresso"}
```

---

A last (but not the least) feature of **k_args** and **k_named_args** variables: they can get access not only to the parameters defined by 'cms:func', but to any number of extra parameters passed by a caller &mdash;

```xml
<cms:func 'makecoffee' type='cappuccino' size='medium'>..</cms:func>

<cms:call 'makecoffee' 'espresso' 'large' when='now' for='a friend' />

k_args => [{"name":"","val":"espresso"},{"name":"size","val":"large"},{"name":"when","val":"now"},{"name":"for","val":"a friend"}]
k_named_args => {"size":"large","when":"now","for":"a friend"}
```

This feature allows for truly unconstrained scenarious to see the light. Consider, for example, an unlimited shopping list where a function nicely formats and outputs all items passed to it at once.

We, the Couch community, can't wait to see how you apply the **func** tag. And don't forget to showcase your functions in forum!

## Related Tags

* [**call**](./call.md)
* [**func_exists**](./func_exists.md)
