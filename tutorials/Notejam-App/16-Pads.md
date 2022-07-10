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

# Pads

OK, the good thing about the 'Pads' section is that it is almost a copy of the ['Notes'](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/04-Notes.md#notes) section that we've already studied in excruciating detail.

So, instead of hand-holding you through its template and view snippets, I'll encourage you to take a look at the source files yourselves. There shouldn't be a single point in there that we haven't already covered and so you should really find everything easy.

Begin from the ***pads.php*** template examining the routes defining its various views. Then move over to the `snippets/views/pads` folder to take a look at the snippets implementing those views.

I'll just jot down the few minor points that are slightly different in this section -

1. You won't find a 'list_view'. It isn't required for pads as we list all the pads in the sidebar of the 'notes' section.
2. The 'page_view' of pads, instead of showing details of a single pad, shows all the notes belonging to that pad. So it is almost identical to the 'list_view' of notes.

We'll now take a look at the final section of Notejam - Users

---

**Next: [Users →](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/17-Users.md#users)**
