# Εγκατάσταση στο server (texas.gr)

## 1. Clone εκτός webroot

```bash
cd /var/www  # ή όποιος είναι ο φάκελος του server σου
git clone https://github.com/bigdropgr/texas.git texas.gr-repo
cd texas.gr-repo
git checkout vibe/texas-initial-237707
```

## 2. Αντιγραφή στο wp-content

Βρες το webroot (εκεί που είναι το `wp-config.php`), π.χ. `/var/www/texas.gr/public_html`:

```bash
bash deploy.sh /var/www/texas.gr/public_html
```

Το script αντιγράφει μόνο:
- `wp-content/themes/texas`
- `wp-content/plugins/texas-cook-calc`
- `wp-content/plugins/texas-smoker-builder`
- `wp-content/mu-plugins/texas-core.php` (φορτώνει αυτόματα)

## 3. Ενεργοποίηση (με WP-CLI αν υπάρχει)

```bash
wp theme activate texas --path=/var/www/texas.gr/public_html
wp plugin activate texas-cook-calc texas-smoker-builder --path=/var/www/texas.gr/public_html
wp rewrite structure '/%postname%/' --hard --path=/var/www/texas.gr/public_html
wp cache flush --path=/var/www/texas.gr/public_html
```

Χωρίς WP-CLI: από το wp-admin → Εμφάνιση → Θέματα → ενεργοποίησε **texas**, και Πρόσθετα → ενεργοποίησε τα δύο plugin. Μετά Ρυθμίσεις → Μόνιμοι σύνδεσμοι → «Όνομα άρθρου» και αποθήκευση.

## 4. Σελίδες εργαλείων

Δημιούργησε τρεις σελίδες (σελίδες → προσθήκη) με τα παρακάτω slug και περιεχόμενο:

| Σελίδα | Slug (permalink) | Περιεχόμενο |
|---|---|---|
| Εργαλεία | `ergaleia` | κείμενο της επιλογής σου + σύνδεσμοι στις δύο παρακάτω |
| Υπολογιστής χρόνου ψησίματος | `ergaleia/ypologismos-chronou-psisimatos` | `[texas_cook_calc]` |
| Διαστασιολόγηση smoker | `ergaleia/diastasiologisi-smoker` | `[texas_smoker_builder]` |

## 5. Έλεγχος

- Άνοιξε `/ergaleia/ypologismos-chronou-psisimatos/` και `/ergaleia/diastasiologisi-smoker/` — οι υπολογιστές πρέπει να φαίνονται και να υπολογίζουν.
- Το υπόλοιπο site δεν πρέπει να φορτώνει τα assets των plugin (έλεγξε στα devtools ότι τα `calculator.css/js` υπάρχουν μόνο σε αυτές τις σελίδες).
