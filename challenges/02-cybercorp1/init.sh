#!/bin/sh
set -e
cd /app
if [ ! -f cybercorp1.db ]; then
    sqlite3 cybercorp1.db < schema_cybercorp1.sql
fi
exec gunicorn --bind 0.0.0.0:8080 app:app
