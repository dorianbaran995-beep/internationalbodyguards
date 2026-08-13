# International Bodyguards

Hosting-ready website for **internationalbodyguards.net**.

## Requirements

- Apache-compatible web hosting
- PHP 8.0 or newer
- PHP `mail()` enabled, or an SMTP replacement configured by the hosting provider
- SSL/HTTPS enabled

## Upload

Upload the contents of this repository to the domain's web root, usually `public_html`.

The main routes are:

- `/` — website
- `/request-protection/` — confidential protection request form
- `/legal/` — legal and licensing notice
- `/privacy/` — privacy notice

## Protection request email

The form posts securely to `request-protection/send.php` and sends requests to:

`enquiries@internationalbodyguards.net`

Before launch, create or confirm these addresses with the hosting provider:

- `enquiries@internationalbodyguards.net`
- `website@internationalbodyguards.net`

Test the complete form after deployment. If the host disables PHP `mail()`, configure authenticated SMTP before accepting enquiries.

## Security and compliance

Do not commit passwords, hosting credentials, API keys, or SMTP secrets. Services remain subject to assessment, availability, local law, licensing, and any required authorisations.
