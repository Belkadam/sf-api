#!/bin/bash
cd ../nexus-stack-docker
docker compose exec -it sf_api bin/console "$@"