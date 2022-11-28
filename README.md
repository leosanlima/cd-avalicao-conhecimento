## knowledge assessment
Laravel MVC application started with [Breeze Starter Kit](https://github.com/laravel/breeze).
### Requirements

- Docker
- Docker Compose
- Node and npm

### Setup

Creates a ``.env`` based on ``.env.example``, attention if you are a Windows user.
Start containers detached from terminal running: 
```shell script
docker-compose up -d
```

then install frontend dependencies running
```shell script
npm install
```

and to compile assets run
```shell script
npm run dev
```

to watch changes in frontend assets run
```shell script
npm run watch
```

to add upload files works run
```php 
php artisan storage:link
```


app:
- http://localhost:8000/


### Under the hood
- [Laravel](https://laravel.com/)
- [Laravel Mix](https://laravel.com/docs/8.x/mix)
- [Tailwind CSS](https://tailwindcss.com/)
## License

[MIT license](https://opensource.org/licenses/MIT).

