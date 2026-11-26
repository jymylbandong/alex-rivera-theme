# AI correction log

| # | What the AI generated or claimed | What was wrong | How I fixed it |
|---|---|---|---|
| 1 | Skip link: first said core's skip link needs JavaScript and planned a custom one | On WordPress 7.x, core renders it on the server. The AI corrected itself, but I didn't take either claim on trust | Checked the rendered HTML with JavaScript disabled, then kept core's skip link and set "Requires at least" to 7.0 |
| 2 | Header using the core Navigation block | Unsure whether it would output aria-label without a saved menu | Replaced with a plain `<nav aria-label="Main">` in the header pattern: guaranteed label, no JavaScript |
| 3 | Hero image with alt, width and height only | No srcset, sizes or fetchpriority, so phones downloaded the full image | Added a 400px version, srcset/sizes, and fetchpriority="high" |
| 4 | Scaffold styled for the front end only | The Site Editor didn't load style.css | Added add_editor_style() |
| 5 | Section layout | Headings used the content width, cards the wide width, so they didn't line up | One layout width for all sections |

## The main one
The skip link. The AI first said WordPress injects it with JavaScript, which would break the "works without JavaScript" requirement, then reversed itself for WordPress 7.x. Rather than trusting either answer, I checked the server-rendered HTML with JavaScript disabled, confirmed core outputs it, and kept the core version with "Requires at least: 7.0".
