<details><summary>Table of Contents</summary>

* [Intro](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/01-Intro.md#intro)
* [Installing the application](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/02-Installing-the-application.md#installing-the-application)
* [Code Walkthrough](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/03-Code-Walkthrough.md#code-walkthrough)
   * [Notes](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/04-Notes.md#notes)
   * [Routes](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/05-Routes.md#routes)
   * [Filters](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/06-Filters.md#filters)
   * [Controller](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/07-Controller.md#controller)
   * [Views](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/08-Views.md#views)
       1. [List view](./09-List-View.md#views--notes-list-view)
       2. [Page view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/10-Page-View.md#views--notes-page-view)
       3. [Create view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/11-Create-View.md#views--notes-create-view)
       4. [Create view (with pad)](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/12-Create-View-(with-Pad).md#views--notes-create-view-with-pad)
       5. [Edit view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/14-Edit-View.md#views--notes-edit-view)
       6. [Delete view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/15-Delete-View.md#views--notes-delete-view)
   * [Pads](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/16-Pads.md#pads)
   * [Users](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/17-Users.md#users)
* [Wrapping up..](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/18-Wrapping-up.md#wrapping-up)
</details>

# Filters

In the [last chapter](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/05-Routes.md#routes) we saw three different filters being used - 'authenticated', 'note_exists' and 'owns_note'.

The snippets implementing them, as explained in the docs, are located in the `snippets/filters` folder.

Let us take a look at each of the snippet files -

### 1. `authenticated.html`

```xml
<cms:if k_logged_out >

    <cms:redirect k_login_link />

</cms:if>
```

This one is simple. It checks if the visitor accessing the URL is logged out and, if that is the case, redirects her to the login page.

If you remember, with filters 'no news is good news' - if the visitor happens to be logged in, this filter will do nothing and hence will 'succeed'.

### 2. `note_exists.html`

```xml
<cms:if "<cms:not "<cms:page_exists id=rt_id masterpage='notes.php' />" />" >

    <cms:abort is_404='1' />

</cms:if>
```

The important part above is the **cms:page_exists** tag that queries the 'notes.php' template for a page with ID contained in the '**rt_id**' variable.

If you recall from the docs, the **cms:match_route** upon finding a matching route, creates variables by prefixing all 'variable parameters' in its 'path' (i.e. those defined e.g. as `{:id}`) with 'rt_' and puts into them the actual value used in the URL.

To take a concrete example, our 'edit_view' route defines the path as follows -

    path='{:id}/edit'

If the URL used to access this route happens to be -

&emsp;***http:​//www​.yoursite​.com/notes/16/edit***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=16/edit*** (without prettyURLs)

**cms:match_route** will set a variable named 'rt_id' and place within it the value '16'.

The query that our **note_exists** filter executes now becomes

```xml
<cms:page_exists id='16' masterpage='notes.php' />
```

which will return '0' or '1' depending on whether or not a cloned-page of 'notes.php' with an ***ID 16*** exists.

The **cms:not** enclosing the **cms:page_exists** will receive the result returned. So, assuming the page does not exist and **cms:page_exists** returns '0', our code effectively becomes -

```xml
<cms:if "<cms:not "0" />" >

    <cms:abort is_404='1' />

</cms:if>
```

The **cms:not** tag serves to simply reverse whatever value is provided to it, so the '0' will become '1' and our code effectively becomes -

```xml
<cms:if "1" >

    <cms:abort is_404='1' />

</cms:if>
```

which will cause the **cms:if** block to execute the enclosed code. That is

```xml
<cms:abort is_404='1' />
```

which summarily kills the executing page and returns a HTTP 404 error to the browser.

In short, this filter will only succeed (i.e. do nothing) if the page being requested really exists.

### 3. `owns_note.html`

```xml
<cms:pages
    masterpage='notes.php'
    id=rt_id
    custom_field="note_owner=<cms:show k_user_name />"
    limit='1'
    show_future_entries='1' >

    <cms:no_results>
        <cms:abort is_404='1' />
    </cms:no_results>

</cms:pages>
```

Here we use **cms:pages** to fetch a single cloned page of notes.php that has an ID as provided by the URL.

The following statement

```xml
custom_field="note_owner=<cms:show k_user_name />"
```

adds the further restriction that the page should also have its 'note_owner' field set to the currently logged-in user (k_user_name variable always points to which). In other words, this is a way of checking if the logged-in user is indeed the owner of the requested page.

> **NOTE**: The 'note_owner' field, you'll remember, is the editable region of type 'relation' in ***notes.php*** that defines a many-to-one relation with the users template ('users/index.php').

The syntax used to query a relation field made its debut very recently and so might be a little unfamiliar. If so, you'll find a complete discussion about it at [viewtopic.php?f=5&t=8581](http://www.couchcms.com/forum/viewtopic.php?f=5&t=8581) (see **'2. Enhanced cms:pages tag'** section).\]

If no such page is found, the **cms:no_results** tag executes and the HTTP 404 is served.
If, however, this page is found, the **cms:pages** tag has nothing within it to execute so it outputs a blank.
Which translates to that this is a success case for this filter.

We can now move on to see what happens when a route gets selected.

---

**Next: [Controller →](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/07-Controller.md#controller)**
