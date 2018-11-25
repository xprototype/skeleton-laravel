## XPrototype Laravel Skeleton

### Start environment
```
$ cp .env.develop .env
$ cp docker-compose.yml.develop docker-compose.yml
$ docker-compose up -d
```

### Prepare app
```
$ composer install
$ artisan key:generate
```

### Configure database
```
$ artisan migrate
```

### Open in browser
```
$ xdg-open http://localhost:8010 </dev/null &>/dev/null &
```

> Storage::disk('minio')->put(
>   'statics/photo/default.jpg',
>   file_get_contents('/var/www/app/resources/photo/default.jpg')
> );