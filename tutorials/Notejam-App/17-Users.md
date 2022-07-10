<details><summary>Table of Contents</summary>

* [Intro](./01-Intro.md)
* [Installing the application](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/02-Installing-the-application.md)
* [Code Walkthrough](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/03-Code-Walkthrough.md)
   * [Notes](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/04-Notes.md)
   * [Routes](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/05-Routes.md)
   * [Filters](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/06-Filters.md)
   * [Controller](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/07-Controller.md)
   * [Views](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/08-Views.md)
       1. [List view](./09-List-View.md)
       2. [Page view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/10-Page-View.md)
       3. [Create view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/11-Create-View.md)
       4. [Create view (with pad)](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/12-Create-View-(with-Pad).md)
       5. [Edit view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/14-Edit-View.md)
       6. [Delete view](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/15-Delete-View.md)
   * [Pads](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/16-Pads.md)
   * [Users](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/17-Users.md)
* [Wrapping up..](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/18-Wrapping-up.md)
</details>

# Users

The finished Notejam application will allow visitors to register their accounts from the front-end, manage their profile, reclaim lost passwords etc. (i.e. all the paraphernalia that is usually associated with a membership site).

As already explained at the outset of this tutorial, we are using the 'extended-users' module ([Extended Users](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users#extended-users)) to implement the mentioned functionalities.

So far, we have made use of only one of the functionalities offered by that module - the creation of users using a custom template. The config file in `couch/addons/extended`, as it exists at this point, shows the fact -

```php config
// Names of the required templates
$t['users_tpl'] = 'users/index.php';
$t['login_tpl'] = '';
$t['lost_password_tpl'] = '';
$t['registration_tpl'] = '';
```

To put the rest of the functionalities in place, please use the tutorial here - [Extended Users » User accounts](https://github.com/trendoman/Midware/tree/main/concepts/Extended-Users#user-accounts).

With that we can now finally wrap up this tutorial.

---

**Next: [Wrapping up.. →](https://github.com/trendoman/Midware/tree/main/tutorials/Notejam-App/18-Wrapping-up.md#wrapping-up)**
