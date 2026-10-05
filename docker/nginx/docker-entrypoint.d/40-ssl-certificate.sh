#!/bin/sh
# Generates a self-signed certificate for localhost when none is present,
# so that nginx can start on 443 on a fresh clone.
# For a certificate trusted by the browser, run `make certs` (mkcert) on the host.
set -eu

CERT_DIR=/etc/nginx/certs
CERT="$CERT_DIR/localhost.pem"
KEY="$CERT_DIR/localhost-key.pem"

if [ -f "$CERT" ] && [ -f "$KEY" ]; then
    exit 0
fi

echo "$0: no certificate in $CERT_DIR, generating a self-signed one (run \`make certs\` for a trusted one)"
mkdir -p "$CERT_DIR"
openssl req -x509 -nodes -newkey rsa:2048 -days 825 \
    -keyout "$KEY" -out "$CERT" \
    -subj "/CN=localhost" \
    -addext "subjectAltName=DNS:localhost,IP:127.0.0.1,IP:::1" \
    2> /dev/null

# The directory is bind-mounted from the project: give the files to its owner (the host user), not root
chown "$(stat -c %u:%g "$CERT_DIR")" "$CERT" "$KEY"
