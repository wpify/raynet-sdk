# RaynetApiClient\ExternIdentifiktorApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**extIdDelete()**](ExternIdentifiktorApi.md#extIdDelete) | **DELETE** /{entityName}/{entityId}/extId/{extId} | odstranění externího identifikátoru |
| [**extIdInsert()**](ExternIdentifiktorApi.md#extIdInsert) | **PUT** /{entityName}/{entityId}/extId/ | přidání externího identifikátoru |


## `extIdDelete()`

```php
extIdDelete($entity_name, $entity_id, $ext_id)
```

odstranění externího identifikátoru

Odstranění externího identifikátoru od konkrétního záznamu.

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


$apiInstance = new RaynetApiClient\Api\ExternIdentifiktorApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | entita od které má být externí identifikátor odebrán
$entity_id = 123; // int | ID záznamu
$ext_id = erp:123456789; // int | externí identifikátor, který má být u záznamu uveden

try {
    $apiInstance->extIdDelete($entity_name, $entity_id, $ext_id);
} catch (Exception $e) {
    echo 'Exception when calling ExternIdentifiktorApi->extIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| entita od které má být externí identifikátor odebrán | |
| **entity_id** | **int**| ID záznamu | |
| **ext_id** | **int**| externí identifikátor, který má být u záznamu uveden | |

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

## `extIdInsert()`

```php
extIdInsert($entity_name, $entity_id, $ext_id_insert_dto)
```

přidání externího identifikátoru

Přidání externího identifikátoru ke konkrétnímu záznamu.

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


$apiInstance = new RaynetApiClient\Api\ExternIdentifiktorApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | entita ke které má být externí identifikátor přiřazen
$entity_id = 123; // int | ID záznamu
$ext_id_insert_dto = {"extId":"erp:123456789"}; // \RaynetApiClient\Model\ExtIdInsertDto

try {
    $apiInstance->extIdInsert($entity_name, $entity_id, $ext_id_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling ExternIdentifiktorApi->extIdInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| entita ke které má být externí identifikátor přiřazen | |
| **entity_id** | **int**| ID záznamu | |
| **ext_id_insert_dto** | [**\RaynetApiClient\Model\ExtIdInsertDto**](../Model/ExtIdInsertDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
