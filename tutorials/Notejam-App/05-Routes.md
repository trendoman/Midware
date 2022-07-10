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

# Routes

---

**IMP**: The discussion in this section assumes you have already gone through the 'Custom routes' tutorial - [/concepts/Custom-Routes/](https://github.com/trendoman/Midware/tree/main/concepts/Custom-Routes#custom-routes)

---

The ***notes.php*** template makes use of the 'routes' module to implement custom URLs. You'll notice that it does this by defining the template as 'routable'

```xml
<cms:template title='Notes' clonable='1'  routable='1'>
```

and then asking Couch not to apply the default URLS to it -

```php
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>
```

If you play around with Notejam, you'll see the various URLs that the 'notes' part of it responds to when listing, editing, creating or deleting the notes.

I'll list below all those URLs and the corresponding routes defining them in the template.

## 1. list_view

Shows a list of all the notes related to the logged-in user.

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/***

&emsp;***http:​//www​.yoursite​.com/notes.php*** (without prettyURLs)

**Route definition:**

```xml
<cms:route name='list_view' path='' filters='authenticated'/>
```

## 2. page_view

Shows the content of the note specified by the id (***'16'*** in the sample URLs below).

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/16***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=16*** (without prettyURLs)

**Route definition:**

```xml
<cms:route
    name='page_view'
    path='{:id}'
    filters='authenticated | note_exists | owns_note'
    >

    <cms:route_validators
        id='non_zero_integer'
    />
</cms:route>
```

## 3. create_view

Shows a form that can be used to create a new note.

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/create***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=create*** (without prettyURLs)

**Route definition:**

```xml
<cms:route name='create_view' path='create' filters='authenticated' />
```

## 4. create_with_pad_view

This is identical to 'create_view' above except that it automatically adds the new note to the pad specified by the id ('12' in the sample URLs below). (Click on a pad in side bar to see the notes within it. Now press the 'New note' button to invoke this URL).

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/12/create***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=12/create*** (without prettyURLs)

**Route definition:**

```xml
<cms:route
    name='create_with_pad_view'
    path='{:id}/create'
    filters='authenticated | pad_exists | owns_pad'
    >

    <cms:route_validators
        id='non_zero_integer'
    />
</cms:route>
```

## 5. edit_view

Shows a form that can be used to edit the note specified by the id ('16' in the sample URLs below).

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/16/edit***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=16/edit*** (without prettyURLs)

**Route definition:**

```xml
<cms:route
    name='edit_view'
    path='{:id}/edit'
    filters='authenticated | note_exists | owns_note'
    >

    <cms:route_validators
        id='non_zero_integer'
    />
</cms:route>
```

## 6. delete_view

Shows a form that can be used to seek confirmation and subsequently delete the note specified by the id ('16' in the sample URLs below).

**Sample URLs:**

&emsp;***http:​//www​.yoursite​.com/notes/16/delete***

&emsp;***http:​//www​.yoursite​.com/notes.php?q=16/delete*** (without prettyURLs)

**Route definition:**

```xml
<cms:route
    name='delete_view'
    path='{:id}/delete'
    filters='authenticated | note_exists | owns_note'
    >

    <cms:route_validators
        id='non_zero_integer'
    />
</cms:route>
```

The routes above reflect the entire range of operations that are supported by notes.

Please notice in the route definitions above how we use '**cms:route_validators**' to ensure only a valid ID is provided as URL parameter -

```xml
<cms:route_validators
    id='non_zero_integer'
/>
```

Notice also how the '**filters**' used in the routes enforce that only a authenticated user can access the notes section and that she can see only notes that belong to her.

I think we should take a closer look at how the filters have been implemented.

---

**Next: [Filters →](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/06-Filters.md#filters)**
