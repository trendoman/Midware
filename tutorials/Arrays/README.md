# Multi-level variables or Arrays

As anyone who has worked with Couch would have noticed, Couch variables have so far been only simple strings or numbers. A conversation with [**@trendoman**](https://github.com/trendoman) led to the development of this feature where now Couch variables can contain multiple values thus acting like Arrays in JavaScript or PHP.

Functionality showcased below does not require installation of addons as this now is a native Couch feature.

## Syntax

Try out the following in any of your template -

```xml
<cms:capture into='climate' is_json='1'>
{
    "Russia" : {
       "Moscow" : "cold",
       "Sochi"   : "warm"
    }
}
</cms:capture >

Climate in Moscow: <cms:show climate.Russia.Moscow /><br>
Climate in Sochi: <cms:show climate.Russia.Sochi />
```

Output:

```
Climate in Moscow: cold
Climate in Sochi: warm
```

Point to note is that we are using regular 'cms:show' and 'cms:capture'. The only new point above is the use of 'is_json' with cms:capture.

Another example -

```xml
<cms:set i18 = '
{
  "en" : {
      "app" : {
          "greet" : "Hello!"
      }
  },
  "es" : {
      "app" : {
          "greet" : "Hola!"
      }
  }
}
' is_json='1' />

<cms:set lang='es' />
<cms:get "i18.<cms:show lang />.app.greet" /><br>

<cms:set lang='en' />
<cms:get "i18.<cms:show lang />.app.greet" /><br>
```

Output:

```
Hola!
Hello!
```

Again the only new thing is 'is_json' with cms:set. Rest is regular Couch code.

So news is that now Couch natively supports 'arrays' which makes possible the use of the 'dotted' syntax we saw above.
All the 'setter' tags (cms:set, cms:capture, cms:put), all the 'getter' tags (cms:show, cms:get), all 'conditional' tags(cms:if, cms:else, cms:else_if, cms:not) and the iterator tag cms:each now recognize 'array' as a valid type.

This is a feature that will be useful as we go ahead and the newer addons begin exposing their data as arrays. So, for example, we could be iterating through cart items as follows -

```xml
<cms:each cart_items as='item'>
   <cms:show item.price />
   <cms:show item.qty />
   <cms:show item.discount />
</cms:each>
```

## Setting arrays

The syntax for initially setting an array is a valid JSON string with the 'is_json' parameter set to '1'.

Once a variable is set as an array, further interaction with it can be done using the 'dot' syntax alone, as seen previously. Consider the following, for example -

```xml
<cms:set my_climate=climate.Russia />
<cms:show my_climate.Sochi />
```

output:

```
warm
```

In the example above, the 'my_climate' automatically becomes an array because we used a preexisting array variable (`climate.Russia`) to set it. There was no need to use 'is_json' while setting it.

---

**IMP: Using a valid JSON to set an array variable is crucial as anything invalid will result in the variable not getting set at all.**

It would be a good idea to use a validator (e.g. https://jsonformatter.curiousconcept.com/ ) to first verify the validity of a complex JSON string.

---

OK, moving on and extending the example a bit further now, try adding this -

```xml
<cms:set climate='[]' is_json='1' />
<cms:set climate.India='[]' is_json='1' />
<cms:set climate.India.Mumbai='pleasant' />
<cms:set climate.India.Delhi='moderate' />

<cms:set climate.Miami = 'great' />

Climate in Mumbai: <cms:show climate.India.Mumbai /><br>
Climate in Delhi: <cms:show climate.India.Delhi /><br>
Climate in Miami: <cms:show climate.Miami /><br>
```

output:

```
Climate in Mumbai: pleasant
Climate in Delhi: moderate
Climate in Miami: great
```

Example above shows how we can dynamically add to existing arrays.

To see a textual representation of an array variable (for perhaps debugging), we can ask Couch to spit it out as JSON, as in the following example -

```xml
<cms:show climate as_json='1' /><br>
```

output:

```js
{"Russia":{"Moscow":"cold","Sochi":"warm"},"India":{"Mumbai":"pleasant","Delhi":"moderate"},"Miami":"great"}
```

Moving on, all the examples we saw above set values within arrays (e.g. 'Russia', 'India') using 'keys' (e.g. 'Moscow', 'Mumbai' etc.). If we so wish, we can set values directly without using keys, for example as follows -

```xml
<cms:set climate='[]' is_json='1' />
<cms:set climate.Utopia='[]' is_json='1' />

<cms:set climate.Utopia. = 'unknown' />
<cms:set climate.Utopia. = 'uncertain' />
<cms:set climate.Utopia. = 'finicky' />
```

As you can see, we are still using the 'dots' but there are no named keys after those. Internally, Couch automatically creates numeric keys for you (using the last unnamed key) for each unnamed key. So, in the example above, we actually created the following variables -

```xml
<cms:show climate.Utopia.0 /><br>
<cms:show climate.Utopia.1 /><br>
<cms:show climate.Utopia.2 /><br>
```

output:

```
unknown
uncertain
finicky
```

Let us take a look at how the array internally looks like -

```xml
<cms:show climate as_json='1' /><br>
```

output:

```js
{
   "Russia": {
      "Moscow": "cold",
      "Sochi": "warm"
   },
   "India": {
      "Mumbai": "pleasant",
      "Delhi": "moderate"
   },
   "Miami": "great",
   "Utopia": ["unknown", "uncertain", "finicky"]
}
```

Let us now see how 'conditionals' work with arrays -

```xml
<cms:if climate.Russia.Moscow == 'cold'>
   Cold!
<cms:else />
   Warm
</cms:if>
```

As you can see, we can use the dotted syntax with no problems.

## Iterate arrays

Finally, take a look at how we can use cms:each to iterate through the arrays -

```xml
<cms:each climate>
   <cms:show key /> - <cms:show item /><br>
</cms:each>
```

output:

```
Russia - Array
India - Array
Miami - great
Utopia - Array
```

In the example above, the 'climate' variable is an array with three of its keys in turn being arrays themselves. The cms:each loop correctly reported this (outputting the term 'Array'). The 'Miami' key was a simple variable (i.e. not an array) and so its value was outputted verbatim.

The real meat could be had by looping through the sub-arrays themselves, for example -

```xml
<cms:each climate.Russia>
   <cms:show key /> - <cms:show item /><br>
</cms:each>
```

output:

```
Moscow - cold
Sochi - warm
```

```xml
<cms:each climate.India>
   <cms:show key /> - <cms:show item /><br>
</cms:each>
```

output:

```
Mumbai - pleasant
Delhi - moderate
```

To loop through all countries with their cities in our example, we can use the following (shown in two steps for clarity) -

Step 1 –

```xml
<cms:each climate>
   <cms:if "<cms:is_array item />">
      <cms:show key /> (<cms:array_count item />)<br>
   <cms:else />
      <cms:show key /> - <cms:show item /><br>
   </cms:if>
</cms:each>
```

output:

```
Russia (2)
India (2)
Miami - great
Utopia (3)
```

Step 2 –

In the block above that shows we are dealing with an array, add the 'cms:each' once again to loop through its descendants like this -

```xml
<cms:each climate>
   <cms:if "<cms:is_array item />">
      <cms:show key /> (<cms:array_count item />)<br>

      <cms:each item>
         <cms:if "<cms:is_array item />">
            -- <cms:show key /> (<cms:array_count item />)<br>
         <cms:else />
            -- <cms:show key /> - <cms:show item /><br>
         </cms:if>
      </cms:each>

   <cms:else />
      <cms:show key /> - <cms:show item /><br>
   </cms:if>
</cms:each>
```

output:

```
Russia (2)
-- Moscow - cold
-- Sochi - warm
India (2)
-- Mumbai - pleasant
-- Delhi - moderate
Miami - great
Utopia (3)
-- 0 - unknown
-- 1 - uncertain
-- 2 - finicky
```


# Practice

## cms:capture vs. cms:set

There should be no difference between cms:capture and cms:set.

For example, following sample code used with cms:capture, works the same with cms:set -

```xml
<cms:capture into='guests' is_json='1'>
[
   { "firstname":"Marilyn", "lastname":"Monroe" },
   { "firstname":"Arthur", "lastname":"Miller" }
]
</cms:capture>

<cms:set hosts='
[
   { "firstname":"Christopher", "lastname":"Columbus" },
   { "firstname":"Abraham", "lastname":"Lincoln" }
]
   ' is_json='1' />

<cms:show guests as_json='1' /> — 'cms:capture'<br>
<cms:show hosts as_json='1' /> — 'cms:set'<br>

<cms:each guests as='person' >
   <cms:show person.firstname /> <cms:show person.lastname /><br>
</cms:each>
```

---

Note that 'cms:capture' tag executes in **global** scope by default, it means that 'set' working with the same variable must also use the same global scope or things would mix up. 'capture' tag has only 2 scopes: *global* and *parent*, while 'set' can be *local* (by default), *global* and *parent*. This knowledge is very important, as much time can be spent debugging why some values are not appearing. **Watch Your Scope!**

Examples above with 'capture' and 'set' are supposed to be operating in global scope i.e. someplace where the variable is accessible throughout the page. That's why setting scope explicitly is redundant. Note that *local* default scope of 'set' finds no scoped parent tag therefore 'attaches' itself to the global scope.

## Objects vs. Arrays

'Arrays' in JavaScript, as opposed to PHP *cannot* have keys while 'Objects' *always* have keys.

```
["Apple", "Banana", "Strawberry", "Mango"]
```

JavaScript arrays must be accessed using nonnegative integers (or their respective string form) as indexes, the first element of an array is at index *0* or _"0"_. Look at the 'inventory' array below (**square brackets**) that contains "food" objects (**curly braces**) that have a 'name' and a 'type'. Indexes ("0", "1", "2", "3", "4") are assumed but *must not* be written.
```
[
  { "name": "asparagus", "type": "vegetables" },
  { "name": "bananas",  "type": "fruit" },
  { "name": "goat", "type": "meat" },
  { "name": "cherries", "type": "fruit" },
  { "name": "fish", "type": "meat" }
]
```

In Couch –

```xml
<cms:capture into='inventory' is_json='1'>
[
  { "name": "asparagus", "type": "vegetables" },
  { "name": "bananas",  "type": "fruit" },
  { "name": "goat", "type": "meat" },
  { "name": "cherries", "type": "fruit" },
  { "name": "fish", "type": "meat" }
]
</cms:capture>

array's third object — <cms:show inventory.3 as_json='1' /><br>
it's "name" — <cms:show inventory.3.name  /><br>
```

Output –

```
array's third object — {"name":"cherries","type":"fruit"}
it's "name" — cherries
```

JavaScript Object (curly braces) -

```js
{
   "name" : "Vivekananda School",
   "location" : "Delhi",
   "established" : "1971"
}
```

In the above example "name", "location", "established" are all **keys** and "Vivekananda School", "Delhi" and "1971" are values of these keys respectively.


A point of possible confusion is that Objects may have integer keys in string form that may be erroneously thought of as indexes –

```js
{
   "name" : "Vivekananda School",
   "location" : "Delhi",
   "established" : "1971",
   "0" : "Anand Vihar Rd, Block D, Anand Vihar, Delhi, 110092, India"
}
```

One may forget that 'real' indexes are never written, so the _"0"_ above is what may *look like* an 'index' but is actually a 'key'.

Couch –

```xml
<cms:set fruits = '["Apple", "Banana", "Strawberry", "Mango"]' is_json='1' />
<cms:capture into='org' is_json='1'>
{
   "name" : "Vivekananda School",
   "location" : "Delhi",
   "established" : "1971",
   "0" : "Anand Vihar Rd, Block D, Anand Vihar, Delhi, 110092, India"
}
</cms:capture>

<cms:show fruits.0 /><br>
<cms:show org.0 /><br>
```

Output –

```
Apple
Anand Vihar Rd, Block D, Anand Vihar, Delhi, 110092, India
```

Since Couch insists on skipping double quotes in 'getting' syntax following accepted notation, there is no actual *visible* difference between keys and indexes with 'cms:show' tag.

So finally, here is the side-by-side example with array and object, both valid JSON, and identical 'getting' code producing the identical result –

```xml
<cms:set person1='
  [
      { "firstname":"Christopher", "lastname":"Columbus" }
  ]
  ' is_json='1' />
<cms:set person2='
  {
      "0" : { "firstname":"Christopher", "lastname":"Columbus" }
  }
  ' is_json='1' />

<cms:show person1.0.firstname /><br>
<cms:show person2.0.firstname /><br>
```

Outputs -

```
Christopher
Christopher
```

It is imperative to see Couch arrays as 'multi-string' variables that can store both Arrays and Objects. Couch arrays are **always defined with squared brackets** '[]' no matter what –

```xml
<cms:set object = '[]' is_json='1' />
<cms:set object.sky = 'blue' />
<cms:show object as_json='1' />
```

Output –

```
{"sky":"blue"}
```

The ultimate veracious judge is valid JSON. You've done everything right when you have a valid JSON in input and output.

## Adding to arrays

Following alternative syntax allows to add new items to arrays with automatic indexing –

```xml
<cms:set persons='[]' is_json='1' />
<cms:set persons. = '{ "firstname":"Marilyn", "lastname":"Monroe" }' is_json='1' />
<cms:set persons. = '{ "firstname":"Abraham", "lastname":"Lincoln" }' is_json='1' />
<cms:set persons. = '{ "firstname":"Christopher", "lastname":"Columbus" }' is_json='1' />
```

Adding to nested values –

```xml
<cms:set party = '[]' is_json='1' />
<cms:set party.hosts = '[]' is_json='1' />
<cms:set party.guests = '[]' is_json='1' />

<cms:set party.hosts. = "John" />
<cms:set party.hosts. = "Tanya" />
<cms:set party.guests. = "Michael" />
<cms:set party.guests. = "Kim" />
<cms:show party as_json='1' />
```

Output –

```js
{"hosts":["John","Tanya"],"guests":["Michael","Kim"]}
```

Same can be achieved in less lines –

```xml
<cms:set party = '{ "hosts" : "", "guests" : "" }' is_json='1' />
<cms:set party.hosts = '[ "John", "Tanya" ]' is_json='1'/>
<cms:set party.guests = '[ "Michael", "Kim" ]' is_json='1' />
```

In the code above we define object 'party' and at the same moment prepare keys "hosts" and "guests" to have them filled with values (arrays with names) on the second and third lines. The result comes out as expected.

What would happen if instead we defined 'party' as array and not object as above?

```xml
<cms:set party = '[ "hosts", "guests" ]' is_json='1' />
<cms:set party.hosts = '[ "John", "Tanya" ]' is_json='1'/>
<cms:set party.guests = '[ "Michael", "Kim" ]' is_json='1' />
<cms:show_json party as_json='1' />
```

Couch arrays can not have array elements and objects on the same level of hierarchy, so the 'party' set initially as array would be converted to an object with keys "0" and "1" (values "hosts" and "guests") and subsequently, 2 *new* keys would be added below.

```js
{
   "0":"hosts",
   "1":"guests",
   "hosts":[
      "John",
      "Tanya"
   ],
   "guests":[
      "Michael",
      "Kim"
   ]
}
```

## Dynamic values

It is possible, of course, to set values programmatically from your variables. As always, valid JSON is what must be retained under any circumstances.

### Escaping

May use escaping of double quotes manually –

```xml
<cms:set location = "{ \"country\" : \"<cms:show 'Japan' />\" }" scope='global' is_json='1' />
```

or by tag 'cms:escape_json' –

```xml
<cms:set location = "{
   <cms:escape_json>country</cms:escape_json> : <cms:escape_json><cms:show 'Japan' /></cms:escape_json>
   }" scope='global' is_json='1' />
```

In above examples, however, the use of double-quotes necessitated escaping to avoid confusing the parser. For such cases, using 'cms:capture' would be simpler as it wouldn't need that escaping e.g.

```xml
<cms:set country = 'Japan' />
<cms:capture into='location' is_json='1'>
{
   "country" : "<cms:show country />"
}
</cms:capture>
```

If you are unsure what value the variable country actually took somewhere before, prefer automatic escaping e.g.

```xml
<cms:set mycountry = 'The "not so" Great Utopia' />
<cms:capture into='location' is_json='1'>
{
   "country" : <cms:escape_json><cms:show mycountry /></cms:escape_json>
}
</cms:capture>
```

Output if printed –

```
{"country":"The \"not so\" Great Utopia"}
```

In practice, it is very reliable and **faultless** to add values one by one using direct notation e.g.

```xml
<cms:set mycountry = 'Sweet Russia' />
<cms:set location = '[]' is_json='1' />
<cms:set location.country = mycountry is_json='1' />
```

### Multi-word keys

In rare cases, the keys are not a single word but multi-word. See –

```xml
<cms:capture into='person' is_json='1'>
{ "First Name" : "Jane" }
</cms:capture>
```

Alternative way of doing the same would be creating an empty variable and then adding to it:

```xml
<cms:set person = '[]' is_json='1' scope='global' />
<cms:capture into='person.First Name'>Jane</cms:capture>
```

Alternative way of doing the same would be using 'set' tag e.g.

```xml
<cms:set person = '[]' is_json='1' scope='global' />
<cms:set person = '{"First Name" : "Jane"}' scope='global' is_json='1' />
```

Alternative way to do the above 2 operations in one go is:

```xml
<cms:set person = '[{"First Name" : "Jane"}]' scope='global' is_json='1' />
```

### cms:get and cms:put

Let's add a valid string as our new key 'Last Name'. It is not possible with 'cms:set' to add keys with spaces though, so we'll switch to 'cms:put' as it allows to tweak defined names e.g.

```xml
<cms:put var="person.Last Name" value='Doe' scope='global' />
<cms:show person as_json='1' />
```

Output –

```
{"First Name":"Jane","Last Name":"Doe"}
```

It is required to use 'cms:get' tag to output Last Name or First Name, because it allows to put variable key in quotes, unlike 'show' tag.

```xml
<cms:get "person.Last Name" scope='global' />
```

Tag 'get' will be useful on various occasions, including iterating arrays or 'getting' an item by its index e.g.

```xml
<cms:set requested_book_page = "<cms:gpc 'page' />" />
<cms:set requested_book_page = "<cms:get 'requested_book_page' default='1' />" />

<cms:get "book_pages.<cms:show requested_book_page />" /><br>
```

In a nutshell where we need to craft variable names on the fly —
1. For retrieving data, instead of `<cms:show>`, we use `<cms:get>`.
2. For setting data, instead of `<cms:set>`, we use `<cms:put>`

### Loops

We have already seen the use of 'cms:get'. Following is an example of 'cms:put' where we manipulate only certain items of an array -

```xml
<cms:set climate='[]' is_json='1' />
<cms:set climate. = 'unknown' />
<cms:set climate. = 'uncertain' />
<cms:set climate. = 'finicky' />

Before: <cms:show climate as_json='1' /><br>

<cms:set loop_values = '0|1|2' />
<cms:each loop_values sep='|' >
   <cms:if item eq '0' || item eq '2'>
      <cms:put "climate.<cms:show item />" 'wibble' scope='parent' /><br>
   </cms:if>
</cms:each>
After: <cms:show climate as_json='1' /><br>
```

Output:

```
Before: ["unknown","uncertain","finicky"]

After: ["wibble","uncertain","wibble"]
```

Please do note the use of **scope='parent'** in the snippet above. It was necessitated because the `<cms:put>` statement was being used from within a `<cms:each>` block. The default behavior of all setters is to put variables in 'local' scope - in the case above since we are using `<cms:put>` from within `<cms:each>` block that itself has a scope (i.e. can hold variables that are not visible beyond the block) it would have set a variable within `<cms:each>` itself instead of targeting the one we want which happens to lie outside `<cms:each>`.

By specifying the scope as 'parent', we tell `<cms:put>` that we wish to set a variable that is already present somewhere in the parent scope (i.e. somewhere above `<cms:each>`). This way we were able to change the existing array.

## Tags

Please welcome the constellation of tags that come alongside presented feature in hopes to simplify day-to-day work with arrays —

* **arr_count**
* **array_count**
* [**arr_key_exists**](../../tags-reference/Arrays/arr_key_exists.md)
* **arr_val_exists**
* **is**
* [**Tweakus-Dilectus &raquo; is_not**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/is_not/)

## Thank you

That should be it. As always feedback solicited.


## Related tags

* **escape_json**
* **put**
* [**capture**](capture.md)
* [**Documentation &raquo; set**](https://docs.couchcms.com/tags-reference/set.html)
* [**Documentation &raquo; show**](https://docs.couchcms.com/tags-reference/show.html)
* [**Documentation &raquo; get**](https://docs.couchcms.com/tags-reference/get.html)
* [**Tweakus-Dilectus &raquo; show_json**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/show_json/) – a custom tag that prints beautiful JSON

## Related pages

* A good online JSON validator and formatter – [**JSONLint Editor**](https://jsonlint.com/)
* Some functions that work with Couch Arrays — [**Cms-Fu &raquo; JSON**](https://github.com/trendoman/Cms-Fu/tree/master/JSON)
