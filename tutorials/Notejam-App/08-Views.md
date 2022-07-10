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

# Views

Before we go through each of the views, please allow me a little detour to discuss a design pattern that you'll find used in all our views.

I'm sure you'll agree that, more often than not, most of the templates comprising a single site are \*structurally\* quite similar (i.e. use similar HTML markup).

As an example, suppose following are two such templates (with very simplistic HTML markup)

**`template_1.php`:**

```xml
<html>
    <head>
        <title>First Template</title>
    </head>

    <body>
        <h1>Hello! I'm First Template</h1>

        <div>
            Here is what first template has got to say to you!
        </div>
    </body>
</html>
```

**`template_2.php`:**

```xml
<html>
    <head>
        <title>Second Template</title>
    </head>

    <body>
        <h1>Hello! I'm Second Template</h1>

        <div>
            Here is what second template has got to say to you!
        </div>
    </body>
</html>
```

While implementing such templates, it is a common technique to 'chunk' up the templates to make the common portions reusable.

For example, the above templates could be split up into `header.html` and `footer.html` snippets -

**`header.html`:**

```xml
<html>
    <head>
        <title><cms:if k_template_name='template_1.php' >First Template<cms:else />Second Template</cms:if></title>
    </head>

    <body>
```

**`footer.html`:**

```xml
    </body>
</html>
```

and then the main templates would reuse the snippets like this -

**`template_1.php`:**

```xml
<cms:embed 'header.html' />
    <h1>Hello! I'm First Template</h1>

    <div>
        Here is what first template has got to say to you!
    </div>
<cms:embed 'footer.html' />
```

**`template_2.php`:**

```xml
<cms:embed 'header.html' />

    <h1>Hello! I'm Second Template</h1>

    <div>
        Here is what second template has got to say to you!
    </div>

<cms:embed 'footer.html' />
```

Nothing new in what we discussed above.

What I wanted to discuss was an alternative way of implementing the same thing as above.

Suppose, instead of two snippets (header and footer), we create a single snippet, say named `common.html`, as follows -

**`common.html`:**

```xml
<html>
    <head>
        <title><cms:show my_title /></title>
    </head>

    <body>
        <h1>Hello! I'm <cms:show my_title /></h1>

        <cms:show my_content />

    </body>
</html>
```

and then the two main templates call the `common.html` snippet like this -

**`template_1.php`:**

```xml
<cms:set my_title='First Template' />

<cms:capture into='my_content' >
    <div>
        Here is what first template has got to say to you!
    </div>
</cms:capture>

<cms:embed 'common.html' />
```

**`template_2.php`:**

```xml
<cms:set my_title='Second Template' />

<cms:capture into='my_content' >
    <div>
        Here is what second template has got to say to you!
    </div>
</cms:capture>

<cms:embed 'common.html' />
```

You'll find that the results are exactly the same as with the previous method that utilized chunking.

Can you see how this works?

The `common.html` snippet contains the full markup (i.e. from &lt;html&gt; to &lt;/html&gt;) that is common to all templates but uses two variables to fill the portions that differ between the templates (notice the *&lt;cms:show my_title /&gt;* and *&lt;cms:show my_content /&gt;* statements).

The templates fill up those two variables ('my_title' and 'my_content') with their markup and then invoke `common.html` -

```xml
<!-- fill 'my_title' -->
<cms:set my_title='Second Template' />

<!-- fill 'my_content' -->
<cms:capture into='my_content' >
    <div>
        Here is what second template has got to say to you!
    </div>
</cms:capture>

<!-- send the variables to common.html -->
<cms:embed 'common.html' />
```


> **NOTE:** The **cms:set** and **cms:capture** tags are functionally equivalent as both serve to stuff data into the specified variable.
>
> **cms:set** is more suitable for simple single line data while **cms:capture** seems a natural choice for complex data spanning multiple lines.

This is known as the '**decorator**' pattern and you'll find it very useful when dealing with templates that share significant portions of their markup. The templates of Notejam application seem to fit the bill and so I've used this pattern in implementing its views.

In the `snippets/views` folder you'll find two snippets - `layout_main.html` and `layout_with_sidebar.html`. The `layout_main.html` snippet is the equivalent of the `common.html` snippet we saw above.

Take a look at it and you'll find that it contains the markup that will shape every single page of our application.

Look closely and you'll see that it is using four variables for the portions of the markup that'll differ from view to view. These are the 'my_title', 'my_content', 'my_sidebar' and 'my_column_width'.

As we'll discuss the various views in detail below, you'll notice that each view sets the 'my_title' and 'my_content' variables where 'my_content' forms the main output for the view.

Most of the views in the application sport a sidebar but there are some (namely those that are encountered when a user is not logged-in e.g. login/logout, register etc.) that don't have a sidebar but otherwise use the same overall markup. You'll see that those views that have a sidebar, after filling the 'my_title' and 'my_content' variables, do not directly invoke the `layout_main.html` snippet. Rather they invoke the `layout_with_sidebar.html` which in turn fills the 'my_sidebar' (with markup for the sidebar) and 'my_column_width' variables and finally invokes the `layout_main.html` snippet.

Please take a cursory look at both `layout_main.html` and `layout_with_sidebar.html` and you'll see things are structured.

Winding up this detour, I'd like to add that you are free to structure the templates of your sites using whatever method suits you - Couch doesn't mandate anything. I discussed the decorator pattern here because we'll encounter it in all the views of this particular application and an understanding of it will help us in decoding them.

Ok, so now let us take a look at the first view that the routes defined in notes.php invoke -

---

**Next: [List View →](./09-List-View.md#views--notes-list-view)**
