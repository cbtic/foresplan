#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE USER sigplan WITH PASSWORD 'secret';
    CREATE DATABASE sigplan;
    GRANT ALL PRIVILEGES ON DATABASE sigplan TO sigplan;
EOSQL