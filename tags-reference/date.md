# date

The **date** tag outputs a string according to the given _format_ parameter using the given _date_ parameter. If no _date_ provided, the current time is used.

```xml
<cms:date />
```

```xml
<cms:date k_page_date />
```

```xml
<cms:date k_page_date format='jS M, Y' />
```

## Parameters

* date
* format
* gmt
* locale
* charset

### date

The date to be formated.<br>
This parameter is expected to be in '_Y-m-d H:i:s_' format (e.g. 2010-05-30 21:35:54). All date related variables set by Couch tags, e.g. *k_page_date*, *k_page_modification_date*, *k_archive_date* etc., are in this format.

If date is omitted, current date is taken with regard to variable '_K_GMT_OFFSET_' from CouchCMS configuration file (`couch/config.php`).

### format

The **date** tag supports two different types of format characters - locale-aware and non locale-aware.<br>
With locale-aware characters, you can specify that the date is to formatted according to, for example, _french_ locale or _italian_ locale by setting the **locale** parameter.<br>
The locale-aware characters all have a % sign prefixed to them.

If parameter **format** is omitted the default is assumed i.e. `format='F d, Y'`

---

**The locale-aware and the non locale-aware characters cannot be intermixed.**

<br>

#### Non Locale-aware format characters

<br>

| Format character | Description | Example returned values |
| ---------------- | ----------- | ----------------------- |
| <span style="display:block; text-align:center;">_**Day**_</span> | \--- | \--- |
| _d_ | Day of the month, 2 digits with leading zeros | _01_ to _31_ |
| _D_ | A textual representation of a day, three letters | _Mon_ through _Sun_ |
| _j_ | Day of the month without leading zeros | _1_ to _31_ |
| _l_ (lowercase&nbsp;'L') | A full textual representation of the day of the week | _Sunday_ through _Saturday_ |
| _N_ |	ISO 8601 numeric representation of the day of the week |	_1_ (for Monday) through _7_ (for Sunday) |
| _S_ | English ordinal suffix for the day of the month, 2 characters | _st_, _nd_, _rd_ or _th_. Works well with _j_ |
| _w_ | Numeric representation of the day of the week | _0_ (for Sunday) through _6_ (for Saturday) |
| _z_ | The day of the year (starting from 0) | _0_ through _365_ |
| <span style="display:block; text-align:center;">_**Week**_</span> | \--- | \--- |
| _W_ | ISO-8601 week number of year, weeks starting on Monday | Example: _42_ (the 42nd week in the year) |
| <span style="display:block; text-align:center;">_**Month**_</span> | \--- | \--- |
| _F_ | A full textual representation of a month, such as January or March | _January_ through _December_ |
| _m_ | Numeric representation of a month, with leading zeros | _01_ through _12_ |
| _M_ | A short textual representation of a month, three letters | _Jan_ through _Dec_ |
| _n_ | Numeric representation of a month, without leading zeros | _1_ through _12_ |
| _t_ | Number of days in the given month | _28_ through _31_ |
| <span style="display:block; text-align:center;">_**Year**_</span> | \--- | \--- |
| _L_ | Whether it's a leap year | _1_ if it is a leap year, _0_ otherwise. |
| _o_ |	ISO 8601 week-numbering year. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead. | Examples: 1999 or 2003 |
| _Y_ | A full numeric representation of a year, 4 digits | Examples: _1999_ or _2003_ |
| _y_ | A two digit representation of a year | Examples: _99_ or _03_ |
| <span style="display:block; text-align:center;">_**Time**_</span> | \--- | \--- |
| _a_ | Lowercase Ante meridiem and Post meridiem | _am_ or _pm_ |
| _A_ | Uppercase Ante meridiem and Post meridiem | _AM_ or _PM_ |
| _B_ | Swatch Internet time | _000_ through _999_ |
| _g_ | 12-hour format of an hour without leading zeros | _1_ through _12_ |
| _G_ | 24-hour format of an hour without leading zeros | _0_ through _23_ |
| _h_ | 12-hour format of an hour with leading zeros | _01_ through _12_ |
| _H_ | 24-hour format of an hour with leading zeros | _00_ through _23_ |
| _i_ | Minutes with leading zeros | _00_ to _59_ |
| _s_ | Seconds, with leading zeros | _00_ through _59_ |
| <span style="display:block; text-align:center;">_**Timezone**_</span> | \--- | \--- |
| _I_ (capital&nbsp;'i') | Whether or not the date is in daylight saving time | _1_ if Daylight Saving Time, _0_ otherwise. |
| _O_ | Difference to Greenwich time (GMT) in hours | Example: _+0200_ |
| _P_ |	Difference to Greenwich time (GMT) with colon between hours and minutes |	Example: _+02:00_ |
| _T_ | Timezone abbreviation, if known; otherwise the GMT offset. | Examples: _EST_, _MDT_, _+05_&hellip;
| _Z_ | Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive. | _-43200_ through _50400_ |
| <span style="display:block; text-align:center;">_**Full&nbsp;Date/Time**_</span> | \--- | \--- |
| _c_ |	ISO 8601 date |	_2004-02-12T15:19:21+00:00_ |
| _r_ | [faqs.org » RFC 2822](http://www.faqs.org/rfcs/rfc2822) formatted date | Example: _Thu, 21 Dec 2000 16:01:07 +0200_ |
| _U_ | Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT) | |

<br>

#### Locale-aware format characters

<br>

| Format Character | Description | Example returned values |
| ---------------- | ----------- | ----------------------- |
| <span style="display:block; text-align:center;">_**Day**_</span> | \--- | \--- |
| _%a_ | An abbreviated textual representation of the day | _Sun_ through _Sat_ |
| _%A_ | A full textual representation of the day | _Sunday_ through _Saturday_ |
| _%d_ | Two-digit day of the month (with leading zeros) | _01_ to _31_ |
| _%e_ | Day of the month, with a space preceding single digits. Not implemented as described on Windows. See below for more information. | _1_ to _31_ |
| _%j_ | Day of the year, 3 digits with leading zeros | _001_ to _366_ |
| _%u_ | ISO-8601 numeric representation of the day of the week | _1_ (for Monday) though _7_ (for Sunday) |
| _%w_ | Numeric representation of the day of the week | _0_ (for Sunday) through _6_ (for Saturday) |
| <span style="display:block; text-align:center;">_**Week**_</span> | \--- | \--- |
| _%U_ | Week number of the given year, starting with the first Sunday as the first week | _13_ (for the 13th full week of the year) |
| _%V_ | ISO-8601:1988 week number of the given year, starting with the first week of the year with at least 4 weekdays, with Monday being the start of the week | _01_ through _53_ (where 53 accounts for an overlapping week) |
| _%W_ | A numeric representation of the week of the year, starting with the first Monday as the first week | _46_ (for the 46th week of the year beginning with a Monday) |
| <span style="display:block; text-align:center;">_**Month**_</span> | \--- | \--- |
| _%b_ | Abbreviated month name, based on the locale | _Jan_ through _Dec_ |
| _%B_ | Full month name, based on the locale | _January_ through _December_ |
| _%h_ | Abbreviated month name, based on the locale (an alias of %b) | _Jan_ through _Dec_ |
| _%m_ | Two digit representation of the month | _01_ (for January) through _12_ (for December) |
| <span style="display:block; text-align:center;">_**Year**_</span> | \--- | \--- |
| _%C_ | Two digit representation of the century (year divided by 100, truncated to an integer) | _19_ for the 20th Century |
| _%g_ | Two digit representation of the year going by ISO-8601:1988 standards (see %V) | Example: _09_ for the week of January 6, 2009 |
| _%G_ | The full four-digit version of %g | Example: _2008_ for the week of January 3, 2009 |
| _%y_ | Two digit representation of the year | Example: _09_ for 2009, _79_ for 1979 |
| _%Y_ | Four digit representation for the year | Example: _2038_ |
| <span style="display:block; text-align:center;">_**Time**_</span> | \--- | \--- |
| _%H_ | Two digit representation of the hour in 24-hour format | _00_ through _23_ |
| _%k_ | Hour in 24-hour format, with a space preceding single digits |	&nbsp;_0_ through _23_ |
| _%I_ (upper-case&nbsp;'i') | Two digit representation of the hour in 12-hour format | _01_ through _12_ |
| _%l_ (lower-case&nbsp;'L') | Hour in 12-hour format, with a space preceeding single digits | _1_ through _12_ |
| _%M_ | Two digit representation of the minute | _00_ through _59_ |
| _%p_ | UPPER-CASE 'AM' or 'PM' based on the given time | Example: _AM_ for 00:31, _PM_ for 22:23 |
| _%P_ | lower-case 'am' or 'pm' based on the given time | Example: _am_ for 00:31, _pm_ for 22:23 |
| _%r_ | Same as "%I:%M:%S %p" | Example: _09:34:17 PM_ for 21:34:17 |
| _%R_ | Same as "%H:%M" | Example: _00:35_ for 12:35 AM, _16:44_ for 4:44 PM |
| _%S_ | Two digit representation of the second | _00_ through _59_ |
| _%T_ | Same as "%H:%M:%S" | Example: _21:34:17_ for 09:34:17 PM |
| _%X_ | Preferred time representation based on locale, without the date | Example: _03:59:16_ or _15:59:16_ |
| _%z_ | Either the time zone offset from UTC or the abbreviation (depends on operating system) | Example: _-0500_ or _EST_ for Eastern Time |
| _%Z_ | The time zone offset/abbreviation option NOT given by %z (depends on operating system) | Example: _-0500_ or _EST_ for Eastern Time |
| <span style="display:block; text-align:center;">_**Time&nbsp;and&nbsp;Date&nbsp;Stamps**_</span> | \--- | \--- |
| _%c_ | Preferred date and time stamp based on local | Example: _Tue Feb 5 00:45:10 2009_ for February 4, 2009 at 12:45:10 AM |
| _%D_ | Same as "%m/%d/%y" | Example: _02/05/09_ for February 5, 2009 |
| _%F_ | Same as "%Y-%m-%d" (commonly used in database datestamps) | Example: _2009-02-05_ for February 5, 2009 |
| _%s_ | Unix Epoch Time timestamp | Example: _305815200_ for September 10, 1979 08:40:00 AM |
| _%x_ | Preferred date representation based on locale, without the time | Example: _02/05/09_ for February 5, 2009 |
| <span style="display:block; text-align:center;">_**Miscellaneous**_</span> | \--- | \--- |
| _%n_ | A newline character ("\n") | \--- |
| _%t_ | A Tab character ("\t") | \--- |
| _%%_ | A literal percentage character ("%") | \--- |

<br>

### gmt

By setting this parameter to '1', you can get the GMT equivalent of the date provided.

### locale

If you use the locale-aware format characters mentioned above, this parameter can be set to the locale desired for formatting the provided date.

```xml
<cms:date k_page_date format='%B %d, %Y' locale='french' />
```

```xml
<cms:date k_page_date format='%B %d, %Y' locale='italian' />
```

```xml
<cms:date k_page_date format='%B %d, %Y' locale='russian' charset='windows-1251'/>
```

This feature depends entirely on the indicated locale being available at your web server. If the locale is not available, the default 'english' locale is used.

### charset

Some locales do not provide their output in UTF8 character set. This causes strange ?? characters to appear in the output.<br>
The **date** tag can help converting the output to UTF8 if you can provide it with information about the charset used by the locale.

For example -

```xml
<cms:date k_page_date format='%B %d, %Y' locale='greek' charset='ISO-8859-7' />
```

```xml
<cms:date k_page_date format='%B %d, %Y' locale='russian' charset='ISO-8859-5' />
```

The following is a rough list of the charset used by different languages -

#### ISO

**ISO-8859-1**<br>
Western Europe and Americas: Afrikaans, Basque, Catalan, Danish, Dutch, English, Faeroese, Finnish, French, Galician, German, Icelandic, Irish, Italian, Norwegian, Portuguese, Spanish and Swedish.

**ISO-8859-2 - Latin 2**<br>
Latin-written Slavic and Central European languages: Czech, German, Hungarian, Polish, Romanian, Croatian, Slovak, Slovene.

**ISO-8859-3 - Latin 3**<br>
Esperanto, Galician, Maltese, and Turkish.

**ISO-8859-4 - Latin 4**<br>
Scandinavia/Baltic (mostly covered by 8859-1 also): Estonian, Latvian, and Lithuanian. It is an incomplete predecessor of Latin 6\.

**ISO-8859-5 - Cyrillic**<br>
Bulgarian, Byelorussian, Macedonian, Russian, Serbian and Ukrainian.

**ISO-8859-6 - Arabic**<br>
Non-accented Arabic.

**ISO-8859-7 - Modern Greek**<br>
Greek.

**ISO-8859-8 - Hebrew**<br>
Non-accented Hebrew.

**ISO-8859-9 - Latin 5**<br>
Same as 8859-1 except for Turkish instead of Icelandic

**ISO-8859-10 - Latin 6**<br>
Latin6, for Lappish/Nordic/Eskimo languages: Adds the last Inuit (Greenlandic) and Sami (Lappish) letters that were missing in Latin 4 to cover the entire Nordic area.

#### Windows

**Windows-1258**<br>
Vietnamese

**Windows-874**<br>
Thai

**Windows-1252**<br>
Latin 1 languages: Afrikaans, Basque, Catalan, Danish, Dutch, English, Faroese, Finnish, French, Galician, German,
Icelandic, Indonesian, Italian, Malay, Norwegian, Portuguese, Spanish, Swahili, Swedish

**Windows-1250**<br>
Central Europe languages: Albanian, Croatian, Czech, Hungarian, Polish, Romanian, Serbian (Latin), Slovak, Slovenian

**Windows-1257**<br>
Baltic languages: Estonian, Latvian, Lithuanian

**Windows-1251**<br>
Cyrillic languages: Azeri, Belarusian, Bulgarian, Macedonian, Kazakh, Kyrgyz, Mongolian, Russian, Serbian, Tatar, Ukrainian, Uzbek

**Windows-1256**<br>
Arabic, Farsi, Urdu

**Windows-1253**<br>
Greek

**Windows-1255**<br>
Hebrew

**Windows-1254**<br>
Turkic languages: Azeri (Latin), Turkish, Uzbek (Latin)


## Examples

### sample formats

A few ready-to-use format examples -

```xml
<cms:date format='Y-m-d H:i:s' />      (MySQL)
<cms:date format='D, d M Y H:i:s' />   (RSS)
<cms:date format='Y-m-d\TH:i:sP' />    (Atom)
<cms:date format='l, d-M-Y H:i:s T' /> (Cookie)
<cms:date format='l jS \of F Y h:i:s A' />
<cms:date format='F j, Y, g:i a' />
<cms:date format='m.d.y' />
<cms:date format='j/n/Y' />
<cms:date format='\i\t \i\s \t\h\e jS \d\a\y.' />
<cms:date format='D M j G:i:s T Y' />
```

### relative dates

Dates can be set as strings, relative to current day or another date e.g.

```xml
Current -365 days: <cms:date '-365 days' />
Current +1 day: <cms:date '+1 day' />
Current +1 week: <cms:date '+1 week' />
Current +1 month: <cms:date '+1 month' />
Current +1 day 4 hours 2 seconds: <cms:date '+1 day 4 hours 2 seconds' />
First day of current week: <cms:date 'Monday this week' />
Last day of previous week: <cms:date 'Sunday last week' />
Next Thursday: <cms:date 'next Thursday' />
Last Monday: <cms:date 'last Monday' />
First day of next month: <cms:date 'first day of next month' />
First day of next month: <cms:date 'first day of next month' format='l' />
Last day of march 2009: <cms:date '2009-03 last day of this month' format='l, j/n/Y' />
Christmas Day next year: <cms:date '25 december next year' format='l, j/n/Y' />
Yesterday 14:00: <cms:date 'yesterday 14:00' format='j F, Y H:i'/>
Tomorrow: <cms:date 'tomorrow' format='Y-m-d' />
Tomorrow noon: <cms:date 'tomorrow noon' format='j F, Y H:i' />
A minute before midnight: <cms:date 'midnight -1 minute' format='H:i' />
```

### date comparison

Compare dates with tag 'cms:if' & make sure the left-hand-side of the equation is a variable e.g.

```xml
<cms:set post_date="<cms:date k_page_date format='Ymd' />" />
<cms:if post_date lt "<cms:date format='Ymd' />" >
   ...
</cms:if>
```

### usage in filters

Use variables in *custom_field* as well (always use double quotes `"` with expressions) e.g.

```xml
<cms:set curr_date="<cms:date format='Y-m-d H:i:s' />" />
<cms:pages custom_field="my_date <= <cms:show curr_date />">
```

## Variables

This tag is self-closing and does not set any variables of its own.

## Related Tags

* [**Documentation &raquo; number_format**](https://docs.couchcms.com/tags-reference/number_format.html)
