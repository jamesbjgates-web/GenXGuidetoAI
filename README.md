# Gen X Guide to AI

GitHub/cPanel deployment package for the Gen X Guide to AI website.

## Deploy

1. Upload the contents of this folder to the root of the GitHub repository.
2. Commit and push to the branch configured in cPanel Git Version Control.
3. In cPanel, update from remote and run **Deploy HEAD Commit**.
4. `.cpanel.yml` copies the live site files into `public_html`.

## Main files

- `index.html` — homepage
- `challenge.html` — Challenge Us page
- `thanks.html` — form confirmation page
- `styles.css` — shared styling
- `submit_challenge.php` — Challenge Us form handler
- `assets/` — images and video

## Before public launch

Test the Challenge Us form on the live server and confirm mail delivery to `hello@genxguidetoai.com`.
