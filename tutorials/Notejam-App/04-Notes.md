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

# Notes

The template implementing notes is ***notes.php***. Please open it in your favorite text editor. You'll notice the following within it -

**Editable regions:**

This template defines only a single editable region of type 'textarea' for inputting content.

What is important is how it defines the template's relationship with the 'pads' and 'users' templates -

```xml
<cms:editable
    name='note_owner'
    type='relation'
    has='one'
    masterpage='users/index.php'
    label='Owner'
    required='1'
    no_guix='1'
/>

<cms:editable
    name='note_pad'
    type='relation'
    has='one'
    masterpage='pads.php'
    label='Pad'
    required='1'
    no_guix='1'
/>
```

As explained in the docs on relations ([http://www.couchcms.com/docs/concepts/relationships.html](http://www.couchcms.com/docs/concepts/relationships.html)), the two regions above serve to relate the notes template in a 'Many-to-one' manner with both the users as well as the pads template.

You'll recall that we don't have to explicitly relate the users and pads template back to notes as, in Couch, we need to define only one end of the relationship and the other end is implied without stating.

Please notice the ***no_guix='1'*** in the definitions. There is actually no parameter named 'no_guix'. It should really have been ***no_gui='1'***. I've added the 'x' so that Couch now does not recognize it and hence ignore it.

This parameter hides the GUI of the 'relation' editable (a dropdown in our case) from the admin-panel. This is useful when the relations are meant to be set programmatically from the front-end (as opposed to done manually from the admin-panel), as will be done by our application. We'll remove the 'x' when the application is complete. For now, to help in debugging, we'll keep the dropdown visible.

Following the definitions of the editable region, you'll find the definitions of the routes of this template.

---

**Next: [Routes](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/05-Routes.md#routes)**
