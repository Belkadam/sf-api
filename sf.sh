#!/bin/bash
cd ../nexus-stack-docker
docker compose exec sf_api bin/console "$@"