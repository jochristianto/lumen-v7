# Lumen 7

## Problems

Passing float, and double numbers causing issues on Eloquent.

### Replicating the issue

1. Migrate the database, `php artisan migrate`
2. Run the app, `php -S localhost:8000 -t public`.
3. Open your terminal and run this command
    ```sh
    curl --location --request POST 'http://localhost:8000/create' \
    --header 'Content-Type: application/json' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "test_string": "1.1",
        "test_float": 1.1,
        "test_decimal": 1.1,
        "test_double": 1.1
    }'
    ```

Based on the response of the CURL above, it should print:

```json
{
    "data": {
        "test_string": "1.1",
        "test_float": 1.100000000000000088817841970012523233890533447265625,
        "test_decimal": "1.10",
        "test_double": 1.100000000000000088817841970012523233890533447265625
    }
}
```

Notice that the `1.1` value on the `test_float` column returned as `1.100000000000000088817841970012523233890533447265625`.

Same thing also happened with the `test_double`.

If you prefer to see the whole result, you can use `curl --location --request GET 'http://localhost:8000/all'`.

## PHP Version
```sh
$ php -v
PHP 7.2.27 (cli) (built: Jan 30 2020 02:16:26) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
```

## Docker
```sh
$ docker-compose up -d
```

Generated using https://phpdocker.io/generator