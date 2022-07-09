# `<cms:delete_file>`

Deletes a file. Path is relevant to website directory.

```xml
<cms:delete_file 'log.txt' />
```

A special parameter allows to remove PHP error log defined in the ini-file. PHP will automatically re-create a new empty logfile.

A shorter tag's name e.g. **&lt;cms:del&gt;** is possible via [**Aliases for tags**](#related-pages) addon

## Parameters

* ***unnamed*** – path to file

If the file does not exist, there will be no warnings.

If a special value ***@php*** passed, tag will remove PHP's errors log.

## Example

```xml
<cms:delete_file '@php' />
→ deletes php log
```

```xml
<cms:delete_file 'log.txt' />
→ mywebsite/log.txt file
```

## Installation

Visit [**Tweakus-Dilectus » INSTALL**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/INSTALL.md) page.

## Related tags

- [**Tweakus-Dilectus Tags » write**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/write)

## Related pages

- [**Tweakus-Dilectus Tags » delete_file**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/delete_file) — source of publication
- [**Tweakus-Dilectus Addons » Aliases for tags**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-aliased)

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
