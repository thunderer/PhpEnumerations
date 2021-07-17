docker-restart: docker-down docker-up
docker-up:
	docker-compose up -d --force-recreate
docker-down:
	docker-compose down --remove-orphans
docker-build:
	docker-compose build

composer-update:
	docker-compose run --rm fpm composer update

run-verify:
	docker-compose run --rm fpm php bin/verify verify
