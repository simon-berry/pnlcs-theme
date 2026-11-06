TECHTRAC CIRCUIT v1.4.0 — COMPLETE THEME + OCA INTEGRATION

DOWNLOADS
Theme ZIP: uploadable theme folder with manifest, screenshot, all templates, CSS, supplied original logo/favicon, public navigation and client-navigation adapter.
Application Integration ZIP: updated controller with OCA loading and route file. This is NOT a theme-upload archive. Apply to application root.

INSTALL / UPGRADE
1. Back up files/database and use staging first. Installed version 1.6.0-dev has NOT been runtime-tested with this package.
2. Move old themes/techtrac outside themes/ as a backup. Extract the fresh techtrac directory into themes/. Do not merge obsolete overrides. For first install use Appearance ZIP upload if supported. Existing slug may require manual folder replacement.
3. Keep TechTrac active. Use normal PNLCS branding settings for native navbar logo/favicon. Public homepage uses bundled logo.
4. Merge application integration app/ and routes/ into the app root after backing up existing custom files. Review before replacing customisations. Add ONCE, at top level in routes/web.php after use declarations:
   require __DIR__.'/techtrac-store.php';
   If already registered from earlier packages, do not duplicate the require or routes.
5. Run php artisan route:clear and php artisan view:clear INSIDE the application's runtime/container and actual working directory. Check php artisan route:list --name=techtrac. Hard-refresh browser. No npm build required.

PAGES
/vps-hosting: active products in visible group VPS Hosting.
/app-hosting: live OCA catalogue (if supported) plus active products in visible group App Hosting.
/domains-ssl: native domain-search submission plus active products in visible group SSL Certificates.
Main store retains all visible groups. Group names ignore case and outer whitespace. No products, prices or provisioning settings are created. App group naming does not enable app provisioning; native product configuration must support it.

OCA
Controller selects first active Panelica server, calls appTemplates and DockerApp::decorate($templates,true), matching the previously inspected upstream contract. Missing interfaces or catalogue failure return an empty catalogue, leaving plans available. Caught exceptions are reported. This is a compatibility fallback, not proof that 1.6.0-dev provides the API. No fabricated app names or deployment endpoints. Catalogue uses monochrome initial tiles, count and featured markers. Installation/app selection stays in native product configuration when supported. apps.blade.php contains the full catalogue inline; do not add the old oca-catalogue include again.

NAVIGATION
Theme public navigation links to registered service routes on desktop/mobile. Store adapter inserts matching links into native .pn-nav and .pn-mobile-menu containers. It leaves core layout intact and injects CSS after rendering with view()->file. The regex insertion depends on your installed HTML. If you previously added duplicate service links directly into the core layout, remove those duplicates first. If adapter rendering is incompatible, remove its override and adapt stylesheet/navigation inclusion to your installed layout. Route links are guarded and absent before route registration. Native core menu/account/mobile controls are inherited.

DESIGN
Top information strip removed; homepage manual carousel retained; store/service pages compact, no large hero/process strip. Plain-label glow buttons, cyan/white hover, focus/pressed/disabled states. Montserrat via Google Fonts with system fallback. No brackets generated; database-managed CTA copy may need manual bracket removal. Payment-provider iframes not controlled by theme. Existing homepage section-builder content remains inherited except custom navigation/hero/topbar.

CHECKS / LIMITATIONS
ZIP integrity, manifest/assets and local Blade partial references checked. No PHP/Laravel runtime or browser acceptance testing and no deployment performed. Check signed-out routes, locale middleware and prefixes, native layout hooks/CSRF, catalogue availability/filtering, multiple Panelica-server selection suitability, product groups/currency/free/stock states, app picker, domain results, cart and sandbox checkout. Verify /client/contact and /client/domain-search on your installed version. New routes do not automatically join sitemap or custom locale-prefix routing. Custom page copy is English. Preserve application additions across updates; they are outside the theme. Do not replace the full PNLCS app with these files.

ROLLBACK
Restore backed-up theme/controller/routes. If deactivating/removing the theme, remove route registration or provide equivalent page views. Clear routes/views. No migrations included.
