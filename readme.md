## Getting Compose dependencies
```
docker run --rm --interactive --tty --volume $(pwd):/app composer install
```

## Creating a site
```
docker run --rm --interactive --tty --volume $(pwd)/vendor:/app --volume $(pwd)/site:/tmp php:7.2-cli-alpine /app/bin/jigsaw init /tmp

```

## Building site
```
docker run --rm --interactive --tty --workdir /tmp --volume $(pwd)/vendor:/app --volume $(pwd)/site:/tmp php:7.2-cli-alpine /app/bin/jigsaw build 

```

## Serve
```
docker run -it \
--workdir /tmp \
--ports 8080:8080 \
--network host \
--volume $(pwd)/vendor:/app \
--volume $(pwd)/site:/tmp \
php:7.2-cli-alpine /app/bin/jigsaw serve --port=8080
```
