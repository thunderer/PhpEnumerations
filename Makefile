docker-restart: docker-down docker-up
docker-up:
	docker-compose up -d --force-recreate
docker-down:
	docker-compose down --remove-orphans

composer-update:
	docker-compose run --rm composer composer update

run-verify:
	docker-compose run --rm fpm-web php bin/verify verify
