# Repülőjárat foglaló rendszer

## Telepítés

Az applikáció egy laravel sail teszt környezetre épül ezért minimum docker megléte szükséges a telepítéshez.

Nyissunk meg a projekt mappáját és adjuk az alábbi parancsot

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Ha ezen felül van a helyi gépen verzió kompatibilis PHP és composer kombináció, akkor a telepítés így néz ki. 

```
    composer install
    docker compose up
```

Applikációs beállítások inicializálása és adatbázis migráció

```
    php artisan tinker:
```

Linux-os rendszerből van lehetőségünk  hívni a sail parancsot a vendor/bin mappán keresztül, amin keresztül tudunk parancsokat végrehajtani a laravel-es konténeren belül

```
    vendor/bin/sail [command]
```


