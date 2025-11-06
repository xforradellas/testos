# comandes per l'entorn de prova
tokenGithub = `cat .env | cut -d' ' -f2`
app= "test"

start-devel:
	docker compose build --no-cache
	docker compose up -d
update-devel:
	docker exec -it app composer update
	docker exec -it app composer dump-autoload

stop-devel:
	docker compose down