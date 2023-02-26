# `<cms:delete_file>`, `<cms:del>`

Path (absolute or relative to domain) or URL is checked for indicated file, then tag <del>deletes</del> renames the target ***file.ext*** to ***file.ext.bak*** unless the special parameter is passed. Supports a few special **@keywords** instead of path. Follows symlinks. No support of wildcards. Examples —

```xml
<cms:del "@php" />
<cms:del "@mysql" />
<cms:del "log.txt" />
<cms:del "<cms:show k_admin_path />cms.php" />
<cms:del "<cms:show k_site_path />myuploads/file/log.txt" />
<cms:del "myuploads/image/test.jpg" remove='1' />
```

**TAG IS SET TO WORK ONLY FOR LOGGED-IN ADMINS**

## Parameters

* ***unnamed*** – path to file. If the file does not exist, there will be no warnings.

    also takes following **special values** —

    - ___"@php"___ — tag will clear PHP Errors Log defined in the PHP's own ini-file.
    - ___"@mysql"___ — tag will query MySQL for location of *queries.log* then clear it after backup.

* **remove** – can be ***1*** or ***0*** (default). Forces physical removal instead of rename. Works only for simple files i.e. does not apply to symlink targets or special keywords.


## Installation

Visit [**Tweakus-Dilectus » INSTALL**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/INSTALL.md) page.

## Related tags

- [**Tweakus-Dilectus Tags » write**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/write)

## Related pages

- [**Tweakus-Dilectus Tags » delete_file**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/delete_file) — source of publication
- [**Tweakus-Dilectus Addons » Aliases for tags**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-aliased)

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
