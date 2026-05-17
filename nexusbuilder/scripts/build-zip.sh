#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

VERSION=$(php -r "preg_match('/Version:\\s*([0-9.]+)/', file_get_contents('nexusbuilder.php'), \$m); echo \$m[1] ?? '0.1.0';")
ZIP_NAME="nexusbuilder-${VERSION}.zip"

rm -f "$ZIP_NAME"
zip -r "$ZIP_NAME" . -x "*.git*" "node_modules/*" "vendor/*" "tests/*"
echo "Built $ZIP_NAME"
