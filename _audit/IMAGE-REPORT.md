# Image audit report

## Done
- All 9,450 `<img>` tags now have an `alt`. Decorative icons, thumbnails and avatars use `alt=""`. Logos, social and review badges, brand logos, product shots and job photos have short descriptive alts. Suburb and keyword stuffing removed.
- About 2,600 keyword-stuffed `title` attributes removed from images.
- About 4,700 images gained `width`/`height`; 95 wrong ones corrected. `:where(img[width][height]){height:auto}` added to the 3 CSS bundles.
- About 145 meaningless or mismatched filenames renamed to describe the content (for example `img/ser/9.webp` -> `basin-drain-clearing-tool.webp`, `clear-blocked-drains.webp` -> `bathroom-dark-feature-wall-freestanding-bath.webp`). All references updated in HTML, PHP, CSS and JS.
- Water-filter product images were loaded from absolute live URLs, with "not found" alts. They now use local WebP files.
- Gallery JPGs converted to WebP; thumbnails matched to their full images.
- Stray `/` inside `<img>` tags fixed (1,550).

## Verification
- Static crawl: nothing missing except `backup_index.html` and `include/` (not live pages).
- Browser load of about 140 pages at 390 and 1280px: no broken images, no stretched visible images.

## Needs your decision: photo authenticity
I cannot verify that photos are approved Hydrolink jobs or team shots. These look like stock or supplier images:
- Wrench, plunger, drain-hair, basin-trap, tap-repair, gutter, rainwater tank, solar roof, grease trap, filter tap, kitchen and plant-room shots (`img/ser/*`, renamed).
- `gas-leak-check-detector-pipework.webp`, `gas-detector-pipework-check.webp`, `basin-trap-wrench-hydrolink-logo.webp`, `plumber-at-kitchen-sink.webp`, `bathroom-black-fittings-vanity.webp`.
- The Rinnai unit and the water-filter product images are manufacturer shots.

Photos that look genuine: bathroom/kitchen/shower jobs, commercial pipework, backflow assemblies, trailers, ute photos, the excavator, the heat pump with the technician, and the team photo `img/ser/hydrolink-team-and-van.webp` (also on blogs.html as `images/resource/plumbers-sydney.webp`).

## Left as is
- Blog and resource hero images keep their article-title alt (the titles are baked into the pictures).
- Original JPG/PNG files are kept beside the WebP copies.
- Pre-existing hidden-logo and call-button size distortions were not touched.
- `backup_index.html` and `include/` were not edited.
