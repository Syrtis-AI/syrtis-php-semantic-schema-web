# Superseded by the json-schema service

Written: 2026-11-04
Author: agent:main

The eight schemas of `schema/` (`field_base`, the six `*_input`,
`form_submit_response`) were the first attempt at a shared description of
web forms; `SERVICES/local/json-schema/web/` is the norm now — the same
files with relative ids, plus `form.json` and three more field kinds —, and
`wexample/symfony-forms` reads the design system's copy of it instead of
this package (symfony-forms 2026-11-04, `FormSchemaLoader`).

Nothing depends on this package but older `composer.lock` files of Syrtis's
apps. Delete it once they are updated; never add a schema here again.
