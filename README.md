# ESIA gateway client

Клиент для общения со [шлюзом ЕСИА](https://wiki.esia.pro). Текущая версия поддерживает только взаимодействие через [ЦПГ HTTP API](https://wiki.esia.pro/docs/esia-gw/for-developers/sentinel-cpg/).

## Установка

Минимальная версия PHP: 8.1

1. Выполнить `composer require vanta/esia-gateway-client`
2. Обязательно установить PSR-совместимый клиент

## Использование

Создание инстанса клиента:

```php
use GuzzleHttp\Psr7\HttpFactory;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
use Vanta\Integration\EsiaGateway\Client\DefaultEsiaGatewayClientBuilder;

$builder = DefaultEsiaGatewayClientBuilder::create(
    new Psr18Client(new CurlHttpClient(), new HttpFactory(), new HttpFactory()),
    'YOUR_CLIENT_ID',
    'YOUT_CLIENT_SECRET',
);

$client = $builder->createEsiaGatewayClient('https://demo.gate.esia.pro', 'https://pos-credit.ru');
```

Генерация URL для авторизации пользователя:

```php
$authorizationUrl = $client->createAuthorizationUrlBuilder()
    ->withPermission(ScopePermission::DRIVERS_LICENSE_DOC)
    ->withoutPermission(ScopePermission::MOBILE)
    ->build()
;
```

Обмен авторизационного кода на токен доступа и токен обновления:

```php
$accessToken = $client->getPairKeyByAuthorizationCode($code);
```

Обмен токена обновления на токен доступа и новый токен обновления:

```php
$accessToken = $client->getPairKeyByRefreshToken($refreshToken);
```

Получение информации о пользователе:

```php
$userInfo = $client->getUserInfo($accessToken);
```
