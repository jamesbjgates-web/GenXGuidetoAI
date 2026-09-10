# Gen X Guide to AI — GitHub/cPanel package v16

This package is ready to upload to the root of the GitHub repository used for genxguidetoai.com.

## Files
- `index.html` — latest approved v16 site
- `styles.css` — current site styling
- `Hero-Master.png` — current hero artwork
- `.cpanel.yml` — cPanel Git deployment instructions

## Deployment
1. Replace the corresponding files in the repository root with these files.
2. Commit the changes to the branch connected to cPanel.
3. In cPanel Git Version Control, update from remote if needed and deploy the HEAD commit.

The `.cpanel.yml` deploys `index.html`, `styles.css`, and `Hero-Master.png` to `/home/genxguidetoai/public_html/`.

## Included approved copy
- CHALLENGE US — “Come and have a go if you think you’re hard enough.”
- STUFF WE ACTUALLY USE — “Cutting through the shite. This is the good stuff.”
- COME AND SAY HELLO — “We don’t bite, honest. (Unless you ask really, really nicely.)”

The page is deliberately mostly self-contained: the section artwork is embedded in `index.html`, while the hero remains an external file.
