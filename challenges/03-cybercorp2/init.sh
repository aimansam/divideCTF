#!/bin/sh
set -e
cd /app
if [ ! -f cybercorp2.db ]; then
    sqlite3 cybercorp2.db < schema_cybercorp2.sql
fi
exec gunicorn --bind 0.0.0.0:8080 app:app
