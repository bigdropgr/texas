# texas.gr — θέμα και εργαλεία

Custom θέμα WordPress (`texas`) και δύο αυτόνομα plugin υπολογιστών για το texas.gr — Texas BBQ στα ελληνικά.

## Δομή

```
wp-content/
├── themes/texas/                  # κλασικό θέμα PHP, χωρίς page builder, χωρίς jQuery
│   ├── style.css / functions.php
│   ├── inc/                       # setup, enqueue, template-tags, footer fallback
│   ├── template-parts/            # content-single, content-syntagi, content-psimo, content-leksiko, content-exoplismos
│   ├── header.php / footer.php / index.php / front-page.php / single.php / page.php
│   ├── archive.php / taxonomy.php / search.php / 404.php
│   └── assets/css/style.css       # design tokens (σκοτεινό θέμα + prefers-color-scheme) + components
├── mu-plugins/texas-core.php      # CPTs (syntagi, psimo, leksiko, exoplismos), ταξινομίες, meta, θωράκιση
└── plugins/
    ├── texas-cook-calc/           # [texas_cook_calc] — υπολογιστής χρόνου ψησίματος
    └── texas-smoker-builder/      # [texas_smoker_builder] — διαστασιολόγηση smoker
```

## Εγκατάσταση

1. Ανέβασε τα `wp-content/themes/texas`, `wp-content/mu-plugins/texas-core.php` και τα δύο plugins στον server (π.χ. μέσω του `deploy.sh`).
2. Ενεργοποίησε το θέμα **texas**.
3. Τα mu-plugins φορτώνουν αυτόματα.
4. Ενεργοποίησε τα plugin **texas-cook-calc** και **texas-smoker-builder**.
5. Δημιούργησε σελίδες και βάλε τα shortcodes:
   - `/ergaleia/ypologismos-chronou-psisimatos/` → `[texas_cook_calc]`
   - `/ergaleia/diastasiologisi-smoker/` → `[texas_smoker_builder]`

## Απόδοση

- Τα CSS/JS κάθε υπολογιστή φορτώνονται **μόνο** στη σελίδα που περιέχει το αντίστοιχο shortcode.
- Vanilla JavaScript, μηδέν εξαρτήσεις, μηδέν cookies, μηδέν εξωτερικά αιτήματα.
- Τα στυλ χρησιμοποιούν τα CSS custom properties του θέματος (`--texas-*`) με fallback τιμές.
- Οι υπολογισμοί είναι εκτιμήσεις σχεδιασμού — στο UI αναφέρεται πάντα ότι η ετοιμότητα μετριέται με θερμόμετρο.
