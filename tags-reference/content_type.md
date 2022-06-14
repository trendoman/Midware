# content_type

The **content_type** tag can be used to make the web server send back the contents with the desired Content-Type in the HTTP header.<br/>
By default every web page is sent back as '_text/html_'.

As an example, the RSS feed requires it content type to be set as '_text/xml_' for the browsers to properly recognize the feed. The following snippet does the job -

```xml
<cms:content_type 'text/xml' />
```

Please see [**Core Concepts - RSS Feeds**](https://docs.couchcms.com/concepts/rss-feeds.html) for an example of the usage of this tag.

## Parameters

*   value

### value

The desired content type.

A comprehensive list of types can be examined at [MDN Web docs](https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types).

## Common types

Following is a basic list of common types &ndash;

**AAC audio**
 ```xml
<cms:content_type 'audio/aac' />
 ```
**AVI: Audio Video Interleave**
 ```xml
<cms:content_type 'video/x-msvideo' />
 ```
**Cascading Style Sheets (CSS)**
 ```xml
<cms:content_type 'text/css' />
 ```
**Comma-separated values (CSV)**
 ```xml
<cms:content_type 'text/csv' />
 ```
**GZip Compressed Archive**
 ```xml
<cms:content_type 'application/gzip' />
 ```
**Graphics Interchange Format (GIF)**
 ```xml
<cms:content_type 'image/gif' />
 ```
**JPEG images**
 ```xml
<cms:content_type 'image/jpeg' />
 ```
**JavaScript**
 ```xml
<cms:content_type 'text/javascript' />
 ```
**JSON format**
 ```xml
<cms:content_type 'application/json' />
 ```
**MP3 audio**
 ```xml
<cms:content_type 'audio/mpeg' />
 ```
**MP4 video**
 ```xml
<cms:content_type 'video/mp4' />
 ```
**OGG audio**
 ```xml
<cms:content_type 'audio/ogg' />
 ```
**Portable Network Graphics**
 ```xml
<cms:content_type 'image/png' />
 ```
**Adobe Portable Document Format (PDF)**
 ```xml
<cms:content_type 'application/pdf' />
 ```
**WEBP image**
 ```xml
<cms:content_type 'image/webp' />
 ```
**WEBM video**
 ```xml
<cms:content_type 'video/webm' />
 ```
**XML**
 ```xml
<cms:content_type 'application/xml' />
 ```
**ZIP archive**
 ```xml
<cms:content_type 'application/zip' />
 ```

## Variables

This tag is self-closing and does not set any variables of its own.
