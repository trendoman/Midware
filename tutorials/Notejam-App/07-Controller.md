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

# Controller

So we finally step out of the definitions in **cms:template** and reach the first executable statement found in the body of the template -

```xml match_route
<!-- find the matched route (view). Respond with 404 if no route matches. -->
<cms:match_route debug='0' is_404='1' />
```

This tag is the 'heart' of any routable template as this is what (as explained in the docs) matches the URL used to access the template with the defined routes. If you wish to study how it works and which variables are made available in the various views, set the 'debug' parameter to '1' temporarily.

Please note that we have set the 'is_404' parameter of **cms:match_route** to '1' so if no route matches, a 404 response will automatically be returned.
This means that any code that comes after this tag can be sure that a valid route has been selected and that the variable 'k_matched_route' contains the selected route's name.

The code that follows **cms:match_route** checks this variable and decides the course of execution depending on the selected route, effectively acting as a '**controller**'.

If you have followed the docs on routes, you'll remember that we used the following code to create the decision tree -

```xml
<!-- implement the selected view -->
<cms:if k_matched_route='list_view'>
    <h2>This is list_view</h2>
<cms:else_if k_matched_route='page_view' />
    <h2>This is page_view</h2>
<cms:else_if k_matched_route='create_view' />
    <h2>This is create_view</h2>
    ..
    ..
</cms:if>
```

Of course, in a real application like the one we are studying, implementing a view will entail much more that just printing out its name.

To keep things manageable, for our Notejam application we have implemented each view as a separate snippet.

In the `snippets` folder of your site (this is the folder where, by default, Couch begins looking for snippets used by **cms:embed** tag), you'll find a subfolder named `views`. Within it you'll find two subfolders - `notes` and `pads`. The `notes` folder houses all the snippets implementing the views of ***notes.php***. The `pads` folder, expectedly, houses all the views of ***pads.php***.

```
snippets
   |_views
     |_notes
       |_page_view.html
       |_edit_view.html
       ( more..)
     |_pads
       |_page_view.html
       |_edit_view.html
```

> **NOTE:** Couch, as you know, doesn't dictate where you place your code in e.g. all the code for views could have been within ***notes.php*** itself or all the snippets could have been put directly in 'snippets' root.
>
> Segregating the views as separate files and keeping them within a folder hierarchy as shown above is just to divide the code into manageable chunks. For complex applications, for your sanity's sake, this becomes almost a necessity.

Our decision tree can now become -

```xml
<!-- implement the selected view -->
<cms:if k_matched_route='list_view'>
    <cms:embed 'views/notes/list_view.html' />
<cms:else_if k_matched_route='page_view' />
    <cms:embed 'views/notes/page_view.html' />
<cms:else_if k_matched_route='create_view' />
    <cms:embed 'views/notes/create_view.html' />
    ..
    ..
</cms:if>
```

If you notice above, we have named all the snippet files after the view they are implementing (e.g. `list_view.html` implements 'list_view').
Again, this convention is a self-imposed one as Couch does not mandate what names are to be used for snippets. However, by virtue of this convention, we can shorten our decision tree above to just a single line -

```xml
<cms:embed "views/notes/<cms:show k_matched_route />.html" />
```

As you can see, the line of code above always tries to embed a '.html' file named after the selected view (as indicated by 'k_matched_route' variable) from the 'views/notes' folder.

This version of the decision tree, apart from being concise, is also future-proof as it does not contain any hard-coded file names.

Suppose we add a new route named 'test_view' to our template. We don't have to make any changes to the code above as it'll automatically try to embed the `views/notes/test_view.html` snippet whenever a URL matches the new route.

Another nice thing about this arrangement is that the snippet being invoked need not be necessarily be present for the application to work. An absent snippet will only show a message like

    Error embedding file: path/snippets/views/notes/test_view.html.

This makes it possible for us to just define all routes to begin with and then implement each of the views as we proceed.

So, using the technique describe above, the last statement in our 'notes.php' template is

```xml
<!-- and invoke snippet corresponding to the selected view -->
<cms:embed "views/notes/<cms:show k_matched_route />.html" />
```

From here on, depending on the route selected, the action will move to the corresponding view snippet. Since our template has 6 routes defined, there are 6 corresponding view snippets within `snippets/views/notes` folder.

Let us go through each of them to see how the views have been implemented.

---

**Next: [Views →](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/08-Views.md#views)**
