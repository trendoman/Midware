# addslashes

The tag **addslashes** has become a necessary addition to escape characters. Very helpful in many situations where a mixture of single and double quotes creates problems.

```xml
<cms:addslashes>Welcome to the "DinoWorld"!</cms:addslashes>
```

## Parameters

* unnamed
* quote (optional)

### quote

Default value is *double* for the double quotes to be escaped. Alternative value is *single*.

```xml
<cms:addslashes quote='single'><cms:show test /></cms:addslashes>
```

## Example

### set PHP variables

For instance, use it with **php** tag where a PHP variable is usually set by Couch statements.

```xml
<cms:set test="O'Reilly" />
<cms:show test />
<cms:php>
    //$test = '<cms:show test />'; // this throws parse error because the value being set contains a single-quote (which is also used to surround the statement)
    $test = '<cms:addslashes quote='single'><cms:show test /></cms:addslashes>'; //default is 'double'
    echo '<h1>' . $test . '</h1>';
</cms:php>
```

### build JSON

Extremely helpful in getting Couch data as json to keep output correctly formatted e.g.

```xml
<cms:content_type "application/json"/>
 [
    <cms:pages masterpage='products.php' skip_custom_fields='1'>
       {
         "name":"<cms:addslashes><cms:show k_page_title/></cms:addslashes>",
         "link":"<cms:addslashes><cms:show k_page_link/></cms:addslashes>"
       }<cms:if "<cms:not k_paginated_bottom/>">,</cms:if>
     </cms:pages>
 ]
```

## Related Tags


