#!/bin/bash
rm -rf docker/shikakumap-db/data/*
rm -rf docker/geom-db/data/*
docker-compose build --no-cache
docker-compose up
