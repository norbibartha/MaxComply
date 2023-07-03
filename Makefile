dev:
	# Copy environmental variables
	cp .env.dist .env
	# Build containers and start servers
	docker compose up -d --build
	# Install dependencies for api
	docker compose exec api composer install
	# Wait 1 minute before load data so MySQL server finishes the initialization
	sleep 60
	# Create database structure via migrations
	docker compose exec api php bin/console doctrine:migrations:migrate
	# Load some data fixtures
	docker compose exec api php bin/console doctrine:fixtures:load

run-unit-tests:
	# Run unit tests
	docker compose exec api php bin/phpunit
