# Caching Part I — Caching Pages

Couch Cache is a very nice feature – serves pre-generated files, makes pages load lightning fast, does not call any tags and mysql. Basically, serving a static page. The cache is smart enough to bypass the requests that should not be cached e.g. submitted forms etc. and invalidates itself when any pages are modified or added through the admin panel.

The way Couch's caching works, anytime you hit the 'save' button on any of your pages in the admin-panel, the cache gets invalidated (destroyed in a sense) and all further requests are fulfilled by dynamic generation (of course, with the output getting cached so another request for the same page is handed over the cached output).

Couch's caching is totally independent of browser's caching. The browser will never know if it is being served a cached page or a dynamically generated page by the web server.

## Enable cache

Cache can be enabled/disabled in `couch/config.php`:

`define( 'K_USE_CACHE', 1 );`

Log-out of the admin-panel ( or use another browser / Incognito mode ) and visit some page. View the source of your page from the browser. Scroll down to the bottom. You should see –

`<!-- Cached page -->`

– if the page was served from cache. This HTML comment appears on all cached HTML pages i.e. those where Content Type is 'text/html' or 'application/xhtml+xml'.

The cached files are saved to 'couch/cache' folder. You might have to set appropriate write (777) permissions to this folder if you find that caching is not working.

## How it works

Basically Couch employs a very simple kind of caching strategy. Following is some pseudo-code of the process -

* if( caching is on ){

   * if( user is not logged-in AND has explicitly not asked to bypass cache){ // by appending 'nc=1' to the URL the cache can be bypassed

      * if( the current URL is in cache ){ // a file with the name of the current URL's MD5 hash is searched in cache

         * if( the cache has not been busted ){ // any 'save' has not been done to *any* page after this file was cached

            *  return this cached file // execution ends here

         * }

      * }

   * }

* }
* if we are here, either the user was logged in, or an unlogged user had used 'nc=1' or the current URL was not in cache ..
* process request normally (i.e. parse template and send back whatever was outputted) —
* output = parse_template() // i.e run all Couch tags to get the final output
* if( caching is on ){

   * if( [**`<cms:no_cache />`**](#related-tags) was not found anywhere in the template just parsed ){

      * cache_output() // save it as a file named with the MD5 of the current URL

   * }

* }

* return output // end of execution

That should give an over-all view of the process.

## Road to cache

All conditions must be met for Couch to even consider looking for the cached page (in order of check) —

1. website is not offline (setting **K_SITE_OFFLINE** in config.php), AND
2. frontend page is requested i.e. not the admin-panel, AND
3. cache is enabled (setting **K_USE_CACHE** in `couch/config.php`), AND
4. request method is not 'POST' (may see the [**Forms**](#submitting-forms) section below), AND
5. request URL does not contain 'nc=1' in query string, AND
6. User is not authenticated, AND
7. 'no_cache' was not explicitly asked for, AND
8. directory 'couch/cache' is writable

If any of the above condition is not met, Couch will not start checking the existance of the cached file.

Having successfully located the cache file, Couch will consider the cache expiration time and, if that is ok, verify the content of the cache file. The verified content may have additional instructions set for the particular requested URL, for one example the requested page can be a mere redirect to another one. Couch will respect that too. After all checks, the content will be served to the browser.

## Refresh cache

**Anytime you hit 'save' while *editing any* page of *any* template, the cache gets invalidated for *all* templates.**

The 'editing' part above actually means making actual changes to any of your page's content in the admin-panel (edit some content, save page).

## Purging cache

When the cache is invalidated (by adding, deleting or modifying pages in admin), existing files in cache become useless but are not deleted immediately. A purge routine gets executed at interval set to the constant **K_CACHE_PURGE_INTERVAL** in 'couch/config.php'. Default is *24* hours.

The purge routine will additionally delete all stale files that exceed the **K_MAX_CACHE_AGE** interval. Default is *7* days.

## Invalidate cache

The cache is invalidated automatically by adding, deleting or modifying pages in admin. Programmatical invalidation can be triggered by a tag 'cms:db_persist' with parameter **_invalidate_cache** e.g.

```xml
<cms:db_persist _mode='edit' _masterpage=k_template_name _page_id=k_page_id _invalidate_cache='1' />
```

Code above must be called within any page-view (requested or constructed with 'cms:pages').

Submitted Databound Forms feature tag 'cms:db_persist_form' with the same parameter.

A few [**custom functions**](#related-funcs) provide a toolbox to trigger cache invalidation programmatically without view constraints, or invalidate cache for a certain page by deleting its cached file.

## Troubleshooting

### aggressive caching

On a very, very rare occaion for reasons beyong our control (i.e. some proxy in the chain) the browsers are caching HTML too aggressively — to the extent that they never requested the web server for any page that had been accessed before.

This problem can be mitigated by making the web-server explicitly send instructions to the browsers absolutely not to cache at all (not even once) any of the admin-panel pages. Following solution might come useful to someone –

Edit the `couch/config.php` file and add the following lines at the very end of it

```php
if( defined('K_ADMIN') ){
   // HTTP headers for no cache
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
}
```

If absolutely necessary the same instructions could be given for the normal front-end pages too (by removing the 'if' condition). The client will never have to hit F5 again as the browser will always request the web server for all pages. The caching part could be handled completely by the server alone.

### if nothing happens

After setting **K_USE_CACHE** to *1* nothing is different?

Couch serves out cached pages to everybody except admin/super-admin and, with configured [**Extended Users**](#related-pages) addon, registered logged-in users.

Please use a different browser (or log out) and then access your site. The first time, if a page is not yet cached, you'll get a generated page but then onwards the cached copy will be served.

### keep *random* random

Tags that offer randomizing the output need special attention for the cache to respect the tag's parameter –

`order='random'` or for 'cms:pages' it's `orderby='random'`

– and serve random content. Since Couch cache works off URLs, let us then try and jump the cache by supplying a unique URL everytime the 'orderby' is set to random. Add a random part to the URL's query string e.g.

```html
<a href="blog.php?orderby=random&rnd={some-random-xyz}" >Random Post</a>
```

That random part might be as simple as the current time as in `rnd=150436'`. Code in Couch parlance –

```xml
<cms:set blog_link = "<cms:link 'blog.php' />" />
<cms:add_querystring blog_link qs="orderby=random&rnd=<cms:date format='His' />" />
```

Instead of date, it can be a long random string e.g.

```xml
rnd=<cms:random_name />
```

– that looks like

`rnd=9e048bcc9d9775b4cfdfba42527323eb`

Another point, tags supporting pagination like pages –

```xml
<cms:pages orderby='random' limit='10' >...</cms:pages>
```

– must never declare parameter `paginate='1'` to avoid using the random seed. This point may deserve an introspection, so let's take a look at the generated SQL –

```xml
<cms:pages orderby='random' limit='20' return_sql='1' />
```

– and compare the output with 'paginated' pages SQL e.g.

```xml
<cms:pages orderby='random' limit='20' paginate='1' return_sql='1' />
```

The part of sql of the latter code has a seed for RAND() – `ORDER BY RAND(1659813988)` – that seed in round brackets is added to split randomized set into several pages, keeping the order of pages. Take a set of 100 pages, paginated by 5 - there would be 20 paginated pages and going to another page by change of url '?pg=2' should not be randomized anew, but instead should display pages from the first query of 100 pages. Seeds are kept in user session, so the assigned RAND() number stays exactly the same every pageload. In short, you should remove parameter paginate='1' from your 'cms:pages' tag to allow Couch randomize set on each page load.


### different request – same content

A list of pages can be loaded with 10/25/100 items per page. Visitor alters the number via a dropdown but the cached content remains the same. What is the correct strategy to use cache with sorting/display options?

URL-based cache respects the query strings. Take an effort in design of your URLs to incorporate subtle changes that a visitor may do to alter content. The following URL –

`www.yoursite.com/blog.php&pg=5`

– is a bad choice when visitor may tweak pagination limit and display 10 items or 20 items per page. The paginated suffix 'pg' would be the same with unexpected number of pages as the very first cached render will be assigned to the URL above. Add `limit=xx` to the query string to keep the cache granular to reflect changes in display. In short, tweaked request demands a corresponding url.

Described strategy works very well for archives and pages where content depends on the date e.g. if the month is explicitly stated in the URL (e.g. index.php?cal=2015-12).

The number of parameters may be big, so it's up to you to decide what will be cached and what can be served dynamically i.e. 'list / grid / column' display option may be always starting with 'list'. This 'display' parameter shall not appear in the query string to avoid micro-caching and extravagant exploding of amount of cached files.

### cache files not appear

The cached files are saved in 'couch/cache' folder. You might have to set appropriate write (777) permissions to this folder if you find that caching is not working.

Look at what does the view-source show — 'Generated' or 'Cached'?

## Submitting forms

Couch never sends a cached page to the browser but processes full code dynamically if the page has been requested with method 'POST'. CouchForms set a server-side component to act upon form's submission, so make sure the form has method 'post'.

## Serving dynamic content

Caching is not granular (i.e. only the entire page can be cached). Problem is, quite a lot of times you might want to have something dynamic on an otherwise static page and it's a shame to force a page not to cache just for one small content item e.g. a 'current time' display or a page view count etc.

The correct strategy is to update this small part via Javascript and XMLHttpRequest (Ajax). If there is no dedicated dynamic page (api) to ask for small non-cached details, one may issue a request to the same page with method 'POST' with special block of code to respond e.g.

```xml
<cms:if "<cms:is_ajax />">
   <!--this block is placed on the very top of the cached page-->
   <cms:set myparam = "<cms:gpc 'myparam' method='POST' />" />
   ...
   ...
   <!--abort with response featuring dynamically requested value-->
   <cms:abort msg=response />
</cms:if>
```

And calling part may be –

```js
<script>
   /* issue POST XMLHttpRequest to self */
</script>
```

– or a GET XMLHttpRequest with query string param 'nc=1' to forcefully prevent any possible caching... (plus drop parameter 'method' from 'cms:gpc' in code above).

Refresh page a few times in a browser you're not signed in as admin... the page content is all cached but the little bit you added is now loaded dynamically when the page loads.

### dynamic CSS/JS assets

If by occasion your CSS/JS assets need be generated by Couch i.e. consist of some fetching-calculating code, make them Couch-powered templates. To do so the regular drill has to be followed i.e. extension needs to be changed to PHP and the two mandatory lines of PHP need to be added to it. Additionally, you'll also need to add the line reflecting new Content-Type right below the include statement –

```xml
<?php require_once( 'couch/cms.php' ); ?>
<cms:content_type 'application/javascript' />
```

With that now you can make the JS file turned into a PHP template serve JS code.

```html
<script src="http://www.yoursite.com/somefile.php" type="text/javascript"></script>
```

Caching will apply to such pages on general terms.

## Exclude page from caching

Forcefully exclude the page by using tag –

```xml
<cms:no_cache />
```

in any part of the page.

## Related tags

* **db_persist**
* [**no_cache**](https://github.com/trendoman/Midware/tree/main/tags-reference/no_cache.md)

## Related funcs

* [**Cms-Fu &raquo; invalidate-cache**](https://github.com/trendoman/Cms-Fu/tree/master/Cache/invalidate-cache)
* [**Cms-Fu &raquo; uncache-by-pagelink**](https://github.com/trendoman/Cms-Fu/tree/master/Cache/uncache-by-pagelink)

## Related pages

* [**Core Concepts &raquo; Extended Users**](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users)

# Caching Part II — Caching Code

In a bid to make things a bit faster, Couch caches the *compiled* output of your snippets (i.e. the 'op-codes'), parsed functions and settings to database. This behavior can be turned on and off by editing `couch/header.php` (lines 62-63 in the current version) -

```php
define( 'K_CACHE_OPCODES', '1' );
```

```php
define( 'K_CACHE_SETTINGS', '1' );
```

Cached entries show up in the table 'couch_settings'. So, depending on how many snippets your site deploys and their sizes, plus amount of functions and their sizes, the entries will vary but will reach a finite number sooner or later. The size of the table in the database shouldn't be a factor.

As a rule of thumb, if a record in 'couch_settings' has a key that is *not* human-readable e.g. *08f45742fcfadb1df8e438d006d132fb*, you may safely delete it - it belongs to the cache. If, however, the key makes sense e.g. 'k_couch_version' or 'nonce_secret_key' then it shouldn't be messed with. You don't really need to bother with the settings table; it will grow again over time but that is ok. If some weirdly unexpected cache issue happens with a snippet, deleting rows from the table may be the ultimate cache buster. Alternatively, by setting both constants to '0' we disable the cache altogether.
