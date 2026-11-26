# Alex Rivera

A one-page WordPress block theme for Dr Alex Rivera, clinical psychologist and trainer.
It needs WordPress 7.0 or later and uses no plugins and no front-end JavaScript.

## Setup

1. Activate the theme.
2. In **Settings → General**, set:
   - **Site Title** to `Dr Alex Rivera`
   - **Site Language** to `English (Australia)`, which outputs `lang="en-AU"`

## Editing content

All the page's text and the structured data (JSON-LD) come from one file:
`inc/content.php`. To change a course, edit its entry there. The page and the
JSON-LD update together, so they always match.

If you change a course's `length`, also update the related keys next to it:
- `workload`: total hours, in ISO 8601 format, e.g. `PT6H`
- `schedule`: for recurring courses
- `mode`: e.g. `online`

### Don't save templates in the Site Editor

The front-page template loads each section as a pattern, and the patterns read
`inc/content.php` on every page load. When a template is saved in the Site Editor,
WordPress stores the expanded blocks in the database instead. From then on the page
no longer reads `inc/content.php`, and it drifts from the JSON-LD.

Opening the Site Editor to look is fine. If a template was saved by mistake, use
**Appearance → Editor → Templates → (template) → Reset** to go back to the theme's version.

## Notes for a production site

- **Courses as a custom post type.** For a client who edits their own content, courses
  should move to a custom post type with fields for length, workload and link. That
  makes them editable in wp-admin, with the pattern and the JSON-LD reading the same
  posts.
- **Course offers.** Google's Course rich results also want `offers` (pricing). The
  current markup is valid schema.org without it. A real site would add `offers` once
  prices are known, rather than inventing them.
- **Course links** are `#` placeholders. When real URLs exist, set them in
  `inc/content.php` and add `url` to each Course in `inc/seo.php`.

## Development

WordPress caches the list of theme pattern files. A new file in `/patterns` won't
appear until the cache clears. While developing, add this to `wp-config.php`:

```php
define( 'WP_DEVELOPMENT_MODE', 'theme' );
```

## Structure

| Path | Purpose |
|---|---|
| `theme.json` | Palette, system font stack, type scale, spacing, layout |
| `style.css` | Theme header, focus outlines, nav, hero photo and course list styles |
| `functions.php` | Loads `inc/` and enqueues `style.css` |
| `inc/content.php` | All person and course data |
| `inc/seo.php` | Front-page meta description, canonical and JSON-LD |
| `templates/` | `front-page.html` (the page) and `index.html` (required fallback) |
| `parts/` | Header and footer, each loading a pattern |
| `patterns/` | Header, hero, about, courses, contact and footer |

## What I checked and fixed

All checks run on the live site, https://alex-rivera.jymyl.dev/

- **PageSpeed Insights:** 100 in performance, accessibility, best practices
  and SEO, on both mobile and desktop.
- **WAVE:** 0 errors, 0 contrast errors. Two "possible heading" alerts on
  the site name and job title; both are paragraphs on purpose, so the page
  has a single h1.
- **W3C validator:** no HTML errors. One CSS message about `container-type`
  in WordPress core's block styles, which is valid CSS the validator
  doesn't support yet.
- **Schema Markup Validator and Google Rich Results Test:** 0 errors,
  0 warnings. One Person and three Courses, linked by @id.
- **Keyboard:** the skip link appears on the first Tab and moves focus past
  the navigation; every link has a visible focus outline.
- **JavaScript disabled:** all content, navigation and the skip link work.
- **320px wide:** no horizontal scrolling; the navigation wraps and the
  course cards stack.
- **robots.txt and sitemap:** crawlers are allowed; the sitemap lists only
  the homepage.

### Fixed during review
- **Editor styles:** the Site Editor didn't load style.css, so it didn't
  match the front end. Added `add_editor_style()`.
- **Alignment:** section headings didn't line up with the course cards.
  Every section now uses the same layout width and left edge.
- **Card spacing:** each course description sat directly against its
  Length row. Added spacing between them.
