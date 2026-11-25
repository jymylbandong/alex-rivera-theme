# Project: Dr Alex Rivera, one-page WordPress block theme

## Context
One-page website for Dr Alex Rivera, a clinical psychologist and trainer in Sydney
who runs online Acceptance and Commitment Therapy courses for practitioners.
Priorities: accessibility, SEO and AEO, clean and maintainable code, mobile-friendly.
The client must be able to update course details easily. Decision: course updates
are made by editing inc/content.php (see "Content and editing" below).

## Hard rules
- Custom block theme only. No plugins, no page builders, no external CSS frameworks.
- All content must render on the server. No JavaScript is required to see or navigate content.
- The client's copy is final. Use the name, title, bio, course names, descriptions,
  lengths, and email exactly as provided, word for word. Don't rewrite, shorten,
  or "improve" it. If anything conflicts with another rule, the provided copy wins.
- en-AU applies to the site language (lang="en-AU") and to any text I write myself
  (meta description, link text, alt text, labels), e.g. "counsellors", "colour".
- One h1 (the name in the hero). Then h2 per section, h3 per course. No skipped levels.
- Header site name: output from inc/content.php as a <p> linked to home_url('/'),
  not the Site Title block, so it always matches the name everywhere else.
- Navigation: no Navigation block. patterns/header.php outputs a wp:html block with
  <nav aria-label="Main"> and a plain <ul> of links with absolute URLs, e.g.
  home_url( '/#about' ), so they work from any page. This guarantees the label and
  needs no JavaScript; content is edited in code anyway, so the Navigation block's
  editing features don't help.
- Course links have descriptive visible text, never repeated "Learn more".
  Visible course links keep href "#" as the brief specifies, until real URLs exist.
- Images have meaningful alt text plus width and height.
- Hero image: theme assets assets/images/alex-rivera.webp (800x1000) and
  alex-rivera-400.webp (400x500), keys image and image_small in inc/content.php.
  Output as <img> in a wp:html block (core/image can't hold srcset for a theme asset):
  src, srcset (400w, 800w), sizes="(max-width: 600px) 90vw, 400px", width="800"
  height="1000", fetchpriority="high", no loading="lazy", alt from image_alt.
  Escape every value.
- AEO: course length and format appear as visible text (a <dl>), not only in JSON-LD.
  One row per course, using the brief's column name: <dt>Length</dt><dd>6 hours, online</dd>.
  The <dd> is the client's length string word for word; never split it.
  Names are identical in headings, links, meta, and JSON-LD.

## Accessibility (target: WCAG 2.2 AA)
- Landmarks: one <header>, <nav aria-label="Main">, one <main id="main">, one <footer>.
  Each section is a <section> with a heading. No landmark without a purpose.
  No aria-labelledby on sections: Group blocks can't save it without failing
  block validation, and unnamed sections are correctly not region landmarks.
- Keyboard: every interactive element is a real <a> or <button>, reachable with Tab
  in visual order. No positive tabindex. No keyboard traps.
- Skip link: the first focusable element, visible on focus, jumps to #main.
  Use core's: since WordPress 7.0 it is rendered on the server (no JavaScript),
  inserted before .wp-site-blocks, and reuses <main id="main">. Don't unhook it or
  print a second one. The theme requires WordPress 7.0 for this reason.
- Focus: visible :focus-visible outline on links and buttons, at least 2px,
  3:1 contrast against the background. Never remove outlines without a replacement.
- Contrast: body text at least 4.5:1, large text and UI borders at least 3:1.
  Check every palette pair in theme.json before using it.
- Links: distinguishable without colour (underlined in body text). mailto link text
  shows the email address.
- Responsive: works from 320px wide with no horizontal scroll, readable at 200% zoom,
  touch targets at least 24x24px, text sized in rem so browser font settings apply.
- Motion: none needed. If any is added, respect prefers-reduced-motion.
- Anchor targets: scroll-margin-top on sections if the header is ever sticky,
  so headings aren't hidden under it.

## Page sections (all four required, in this order)
| Section  | Anchor   | Pattern                  | Content                                   |
|----------|----------|--------------------------|-------------------------------------------|
| Hero     | #top     | patterns/hero.php        | h1 name, title, photo                     |
| About    | #about   | patterns/about.php       | h2 "About", bio                           |
| Courses  | #courses | patterns/courses.php     | h2 "Courses", 3 x article (h3, description, <dl> length, link) |
| Contact  | #contact | patterns/contact.php     | h2 "Contact", mailto:hello@example.com    |
templates/front-page.html = header part + these four patterns inside <main id="main"> + footer part.
templates/index.html is also required (WordPress only treats a theme as a block theme
if it exists): header part + <main id="main"> with post content + footer part.

Header and footer:
- The template-part blocks use tagName "header" and "footer", so the parts themselves
  are the <header> and <footer>. The patterns inside must not add a second one.
- parts/header.html contains only the patterns/header.php pattern block. The pattern
  outputs the site name and the wp:html <nav> (see Hard rules).
- parts/footer.html contains only the patterns/footer.php pattern block. The pattern
  outputs one line: "© [current year] Dr Alex Rivera", year from PHP (wp_date( 'Y' )),
  name from inc/content.php.
- The <dl> in each course uses a Custom HTML block (wp:html); no core block outputs <dl>.

## Content and editing
- inc/content.php is the single source of truth for person and course data.
  All patterns and inc/seo.php read from it.
- Client copy keys (final, word for word): name, title, bio, email, courses
  (name, description, length, url). Technical keys: slug, mode (JSON-LD courseMode),
  workload, schedule.
- Keys added by the developer, outside the client copy:
  - meta_description: "Sydney clinical psychologist Dr Alex Rivera trains psychologists,
    counsellors and social workers in Acceptance and Commitment Therapy, online."
  - image: assets/images/alex-rivera.webp, 800x1000 (output with get_theme_file_uri()).
  - image_small: assets/images/alex-rivera-400.webp, 400x500.
  - image_alt: "Dr Alex Rivera smiling in a bright office"
  - address: Sydney, AU (addressLocality Sydney, addressCountry AU)
  - knows_about: "Acceptance and Commitment Therapy", "Clinical psychology"
- inc/content.php starts with an ABSPATH guard and ends with a trailing newline.
- Pattern blocks in templates render live from PHP only until a template is saved in
  the Site Editor. Saving stores the expanded blocks in the database, so the page stops
  reading inc/content.php and drifts from the JSON-LD. Templates must never be saved in
  the Site Editor. Opening it to check block validation is fine.
- Site Language (English (Australia), giving lang="en-AU") and Site Title
  ("Dr Alex Rivera") are set in WordPress settings, not in theme code. No filter.

## Structure
- theme.json (version 3) for palette, typography, spacing, layout. Prefer theme.json over CSS.
- Fonts: system font stack only. No Google Fonts or other external font requests.
- style.css only for what theme.json can't do: :focus-visible styles, small utilities.
- inc/seo.php: meta description, canonical, JSON-LD, front page only, hooked to wp_head.
  Core's rel_canonical is removed on the front page only, so there's exactly one canonical.
- JSON-LD: one <script type="application/ld+json"> with an @graph:
  - All @id values are absolute, built with home_url(), e.g. home_url( '/#person' ).
  - Person (@id #person): name ("Dr Alex Rivera", matching the visible text; no
    honorificPrefix), jobTitle, description (the bio), image, email, url, address
    (Sydney, AU), knowsAbout.
  - 3 x Course (@id #course-<slug>): name, description, provider - #person,
    hasCourseInstance: CourseInstance with courseMode "online" and
    courseWorkload (PT6H, PT4H) or, for Supervision, courseSchedule
    (repeatFrequency P1M, duration PT1H30M); instructor → #person.
    No url while course links are "#". No offers or invented prices.
  - Every value comes from inc/content.php, so it always matches the visible text.
  - Built as a PHP array and output with wp_json_encode(). Never hand-written JSON strings.
- style.css is NOT loaded automatically in a block theme. Enqueue it once in
  functions.php (wp_enqueue_scripts) with the theme version, so changes bust the cache.
- Patterns live in /patterns with proper file headers. Templates and parts reference them.

## README must document
- Course details are edited in inc/content.php. Never save templates in the Site Editor.
- For a real client, courses would move to a custom post type so they're editable in
  wp-admin, with the JSON-LD reading from the same posts.
- Google's Course rich results also want offers (pricing). The markup is valid
  schema.org without it; a real site would add offers once prices are known.
- Set Site Language and Site Title in settings.

## PHP
- Escape all output: esc_html, esc_attr, esc_url, wp_json_encode.
- Any block attribute JSON inside pattern markup is built with wp_json_encode(),
  not string concatenation.
- Prefix functions with alex_rivera_. No closures in hooks, so they can be removed.
- Build URLs with home_url() and get_theme_file_uri(). Never hardcode the domain.
- Follow WordPress Coding Standards.

## Block markup
- Block comments and HTML must match exactly what the editor saves, or the block shows
  "This block contains unexpected or invalid content." After generating markup,
  I open it in the Site Editor to confirm there are no block validation errors.

## Working rules
- Small, focused changes. One concern per commit.
- Explain any non-obvious code.
- Don't add plugins, packages, or JavaScript without asking.
