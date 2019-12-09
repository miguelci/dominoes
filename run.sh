#!/bin/bash

docker image inspect dominoes:latest > /dev/null 2>&1 && : || docker build -t dominoes .
docker run -it --rm --name dominoes dominoes php app.php
