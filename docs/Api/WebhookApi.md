# RaynetApiClient\WebhookApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**webhookDelete()**](WebhookApi.md#webhookDelete) | **DELETE** /webhook/{uuid}/ | smazání webhooku |
| [**webhookGet()**](WebhookApi.md#webhookGet) | **GET** /webhook/ | seznam webhooků |
| [**webhookInsert()**](WebhookApi.md#webhookInsert) | **PUT** /webhook/ | nový webhook |
| [**webhookTechnicalContactEdit()**](WebhookApi.md#webhookTechnicalContactEdit) | **POST** /webhook/technicalContact/ | upravení technického kontaktu |


## `webhookDelete()`

```php
webhookDelete($uuid)
```

smazání webhooku



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


$apiInstance = new RaynetApiClient\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = 532d339c0a874f68ae8f2cc108c7f7b2; // int | UUID webhooku

try {
    $apiInstance->webhookDelete($uuid);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->webhookDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **int**| UUID webhooku | |

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

## `webhookGet()`

```php
webhookGet()
```

seznam webhooků

Získání seznamu webhooků

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


$apiInstance = new RaynetApiClient\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->webhookGet();
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->webhookGet: ', $e->getMessage(), PHP_EOL;
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

## `webhookInsert()`

```php
webhookInsert($webhook_insert_dto): \RaynetApiClient\Model\WebhookInsert201Response
```

nový webhook

Založení nového webhooku.

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


$apiInstance = new RaynetApiClient\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$webhook_insert_dto = {"url":"https://webhook.site","events":["record.created","record.updated","record.deleted"]}; // \RaynetApiClient\Model\WebhookInsertDto

try {
    $result = $apiInstance->webhookInsert($webhook_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->webhookInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_insert_dto** | [**\RaynetApiClient\Model\WebhookInsertDto**](../Model/WebhookInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\WebhookInsert201Response**](../Model/WebhookInsert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `webhookTechnicalContactEdit()`

```php
webhookTechnicalContactEdit($webhook_technical_contact_edit_dto): \RaynetApiClient\Model\WebhookTechnicalContactEdit200Response
```

upravení technického kontaktu

Upravení emailů pro technický kontakt, který bude notifikován v případě obtíží (viz. výše).

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


$apiInstance = new RaynetApiClient\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$webhook_technical_contact_edit_dto = {"technicalContacts":["technical@contact.cz"]}; // \RaynetApiClient\Model\WebhookTechnicalContactEditDto

try {
    $result = $apiInstance->webhookTechnicalContactEdit($webhook_technical_contact_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->webhookTechnicalContactEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_technical_contact_edit_dto** | [**\RaynetApiClient\Model\WebhookTechnicalContactEditDto**](../Model/WebhookTechnicalContactEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\WebhookTechnicalContactEdit200Response**](../Model/WebhookTechnicalContactEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
