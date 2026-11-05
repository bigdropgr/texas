#!/usr/bin/env bash
set -euo pipefail

WP_PATH="${1:?Χρήση: ./deploy.sh /διαδρομή/στο/wordpress (webroot με wp-config.php)}"

if [ ! -f "$WP_PATH/wp-config.php" ]; then
	echo "Σφάλμα: το $WP_PATH δεν φαίνεται να είναι webroot WordPress (λείπει το wp-config.php)." >&2
	exit 1
fi

SRC="$(cd "$(dirname "$0")" && pwd)"

mkdir -p "$WP_PATH/wp-content/themes" "$WP_PATH/wp-content/plugins" "$WP_PATH/wp-content/mu-plugins"

rm -rf "$WP_PATH/wp-content/themes/bigdrop-texas"
cp -r "$SRC/wp-content/themes/bigdrop-texas" "$WP_PATH/wp-content/themes/bigdrop-texas"

rm -rf "$WP_PATH/wp-content/plugins/texas-cook-calc" "$WP_PATH/wp-content/plugins/texas-smoker-builder"
cp -r "$SRC/wp-content/plugins/texas-cook-calc" "$WP_PATH/wp-content/plugins/texas-cook-calc"
cp -r "$SRC/wp-content/plugins/texas-smoker-builder" "$WP_PATH/wp-content/plugins/texas-smoker-builder"

cp "$SRC"/wp-content/mu-plugins/*.php "$WP_PATH/wp-content/mu-plugins/"

echo "Ολοκληρώθηκε: θέμα + plugins αντιγράφηκαν στο $WP_PATH/wp-content"
