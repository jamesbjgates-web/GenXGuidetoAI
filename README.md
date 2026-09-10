# Gen X Guide to AI

Current website build for GitHub/cPanel deployment.

## Episode data
`episodes.js` contains the current `latest` and `next` episode records. The page reads these values automatically via `site.js`.

This separation is intentional: the future automated production pipeline can update `episodes.js` (or replace it with generated JSON/API data) without rewriting the page layout.

## Current copy
- Latest: Episode 1 — WHAT'S GPT UP TO? — “Walks in with a coffee, but he can't drink.”
- Coming next: Episode 2 — GPT GETS VOCAL — “Now we get some answers.”

## Socials
YouTube, Instagram, TikTok, Facebook, Threads and X use the confirmed GenXGuideToAI profile URLs.


## v3 typography pass
Uses Barlow for body/interface text and Barlow Condensed for major display headings. The existing humour and social copy are intentionally retained. Fonts are loaded from Google Fonts; no font files are included in this repository.


## v4 typography test
Social-card commentary and the Find Us aside now use a restrained marker-style treatment. Copy and links are unchanged.

## Production bible

Locked production rules are kept in `PRODUCTION-BIBLE.md`, including the 16:9 master / 9:16 social derivative rule.

### v6
- Keeps the standard 16:9 YouTube Episode 1 embed and direct episode watch link.
- Restores/retains the v3-style Barlow Condensed treatment for the two major section headings.
- Keeps the handwritten marker treatment for the Find Us aside and social-card comments.
- No approved copy or social links changed.
