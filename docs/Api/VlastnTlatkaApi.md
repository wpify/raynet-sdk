# RaynetApiClient\VlastnTlatkaApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**customButtonGet()**](VlastnTlatkaApi.md#customButtonGet) | **GET** /customButton/ | Načtení konfigurace |
| [**customButtonInsert()**](VlastnTlatkaApi.md#customButtonInsert) | **PUT** /customButton/ | Nové vlastní tlačítko |
| [**securityChecktokenDetailGet()**](VlastnTlatkaApi.md#securityChecktokenDetailGet) | **GET** /security/checktoken/{token}/{personId}/ | ověření bezpečnostního tokenu |


## `customButtonGet()`

```php
customButtonGet()
```

Načtení konfigurace

Načtení konfigurace (meta-dat) vlastních akcí.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: instanceName
$config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKey('X-Instance-Name', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Instance-Name', 'Bearer');

// Configure HTTP basic authorization: basicAuth
$config = RaynetApiClient\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new RaynetApiClient\Api\VlastnTlatkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->customButtonGet();
} catch (Exception $e) {
    echo 'Exception when calling VlastnTlatkaApi->customButtonGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customButtonInsert()`

```php
customButtonInsert($custom_button_insert_dto): \RaynetApiClient\Model\CustomButtonInsert201Response
```

Nové vlastní tlačítko

Založení nového vlastního tlačítka

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: instanceName
$config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKey('X-Instance-Name', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Instance-Name', 'Bearer');

// Configure HTTP basic authorization: basicAuth
$config = RaynetApiClient\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new RaynetApiClient\Api\VlastnTlatkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$custom_button_insert_dto = {"entityName":"Company","appClass":"DetailView","name":"RAYNET","type":"OPEN_URL","url":"https://www.raynet.cz","openType":"OPEN_WINDOW","openTypeWindowWidth":500,"openTypeWindowHeight":200}; // \RaynetApiClient\Model\CustomButtonInsertDto

try {
    $result = $apiInstance->customButtonInsert($custom_button_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VlastnTlatkaApi->customButtonInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **custom_button_insert_dto** | [**\RaynetApiClient\Model\CustomButtonInsertDto**](../Model/CustomButtonInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomButtonInsert201Response**](../Model/CustomButtonInsert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `securityChecktokenDetailGet()`

```php
securityChecktokenDetailGet($token, $person_id)
```

ověření bezpečnostního tokenu

Při použití tlačítka vlastní akce je důležité ověřit, že požadavek vzešel opravdu ze strany CRM a nebyl podrvžen. K tomuto slouží parametry URL `token` a `personId`, se kterými je možné provést ověření. Parametr `personId` je nepovinný, dodatečně ověřuje, že token vytvořil právě daný uživatel. Token je možné ověřit pouze jednou a jeho platnost je `60` sekund.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: instanceName
$config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKey('X-Instance-Name', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RaynetApiClient\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Instance-Name', 'Bearer');

// Configure HTTP basic authorization: basicAuth
$config = RaynetApiClient\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new RaynetApiClient\Api\VlastnTlatkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 38PUaFrM6g16bSCUfPuV3Ngdhcvxz00OEW4ODppPi3Q; // string | Token
$person_id = 123; // int | ID kontaktní osoby, které token patří

try {
    $apiInstance->securityChecktokenDetailGet($token, $person_id);
} catch (Exception $e) {
    echo 'Exception when calling VlastnTlatkaApi->securityChecktokenDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **token** | **string**| Token | |
| **person_id** | **int**| ID kontaktní osoby, které token patří | [optional] |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
