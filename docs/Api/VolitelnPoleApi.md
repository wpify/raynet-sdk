# RaynetApiClient\VolitelnPoleApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**customFieldConfigDelete()**](VolitelnPoleApi.md#customFieldConfigDelete) | **DELETE** /customField/config/{entityName}/{fieldName} | Smazání volitelného pole |
| [**customFieldConfigEdit()**](VolitelnPoleApi.md#customFieldConfigEdit) | **POST** /customField/config/{entityName}/{fieldName} | Upravení volitelného pole |
| [**customFieldConfigGet()**](VolitelnPoleApi.md#customFieldConfigGet) | **GET** /customField/config/ | Načtení konfigurace |
| [**customFieldConfigInsert()**](VolitelnPoleApi.md#customFieldConfigInsert) | **PUT** /customField/config/{entityName}/ | Nové volitelné pole |
| [**customFieldEnumDelete()**](VolitelnPoleApi.md#customFieldEnumDelete) | **DELETE** /customField/enum/{entityName}/{fieldName}/ | Smazání položky enumerace |
| [**customFieldEnumEdit()**](VolitelnPoleApi.md#customFieldEnumEdit) | **POST** /customField/enum/{entityName}/{fieldName}/ | Upravení položky enumerace |
| [**customFieldEnumGet()**](VolitelnPoleApi.md#customFieldEnumGet) | **GET** /customField/enum/{entityName}/{fieldName}/ | Načtení seznamu položek enumerace |
| [**customFieldEnumInsert()**](VolitelnPoleApi.md#customFieldEnumInsert) | **PUT** /customField/enum/{entityName}/{fieldName}/ | Založení nové položky enumerace |


## `customFieldConfigDelete()`

```php
customFieldConfigDelete($entity_name, $field_name): \RaynetApiClient\Model\CustomFieldEnumDelete200Response
```

Smazání volitelného pole

Smazání volitelného pole

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, ze které se má volitelné pole smazat
$field_name = datum_6ae6f; // string | Kód volitelného pole, které se má smazat

try {
    $result = $apiInstance->customFieldConfigDelete($entity_name, $field_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldConfigDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, ze které se má volitelné pole smazat | |
| **field_name** | **string**| Kód volitelného pole, které se má smazat | |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumDelete200Response**](../Model/CustomFieldEnumDelete200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldConfigEdit()`

```php
customFieldConfigEdit($entity_name, $field_name, $custom_field_config_edit_dto): \RaynetApiClient\Model\CustomFieldEnumEdit200Response
```

Upravení volitelného pole

Upravení volitelného pole

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, ve které se má volitelné pole upravit
$field_name = datum_6ae6f; // string | Kód volitelného pole, které se má upravit
$custom_field_config_edit_dto = {"label":"Datum","groupName":"Revize","showInListView":true}; // \RaynetApiClient\Model\CustomFieldConfigEditDto

try {
    $result = $apiInstance->customFieldConfigEdit($entity_name, $field_name, $custom_field_config_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldConfigEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, ve které se má volitelné pole upravit | |
| **field_name** | **string**| Kód volitelného pole, které se má upravit | |
| **custom_field_config_edit_dto** | [**\RaynetApiClient\Model\CustomFieldConfigEditDto**](../Model/CustomFieldConfigEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumEdit200Response**](../Model/CustomFieldEnumEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldConfigGet()`

```php
customFieldConfigGet(): \RaynetApiClient\Model\CustomFieldConfigGet200Response
```

Načtení konfigurace

Načtení konfigurace (meta-dat) volitených polí, včetně klíčů, uživatelských názvů a skupin polí.

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->customFieldConfigGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldConfigGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\RaynetApiClient\Model\CustomFieldConfigGet200Response**](../Model/CustomFieldConfigGet200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldConfigInsert()`

```php
customFieldConfigInsert($entity_name, $custom_field_config_insert_dto): \RaynetApiClient\Model\CustomFieldConfigInsert201Response
```

Nové volitelné pole

Založení nového volitelného pole

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = businessCase; // string | Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `project`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$custom_field_config_insert_dto = {"label":"Datum","groupName":"Revize","dataType":"DATE","showInFilterView":true}; // \RaynetApiClient\Model\CustomFieldConfigInsertDto

try {
    $result = $apiInstance->customFieldConfigInsert($entity_name, $custom_field_config_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldConfigInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **custom_field_config_insert_dto** | [**\RaynetApiClient\Model\CustomFieldConfigInsertDto**](../Model/CustomFieldConfigInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomFieldConfigInsert201Response**](../Model/CustomFieldConfigInsert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldEnumDelete()`

```php
customFieldEnumDelete($entity_name, $field_name, $custom_field_enum_delete_dto): \RaynetApiClient\Model\CustomFieldEnumDelete200Response
```

Smazání položky enumerace

Smazání hodnoty enumerace

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, která volitelné pole obsahuje
$field_name = Priorita_O_a5fab; // string | Klíč volitelného pole
$custom_field_enum_delete_dto = {"value":"položka 1"}; // \RaynetApiClient\Model\CustomFieldEnumDeleteDto

try {
    $result = $apiInstance->customFieldEnumDelete($entity_name, $field_name, $custom_field_enum_delete_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldEnumDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, která volitelné pole obsahuje | |
| **field_name** | **string**| Klíč volitelného pole | |
| **custom_field_enum_delete_dto** | [**\RaynetApiClient\Model\CustomFieldEnumDeleteDto**](../Model/CustomFieldEnumDeleteDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumDelete200Response**](../Model/CustomFieldEnumDelete200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldEnumEdit()`

```php
customFieldEnumEdit($entity_name, $field_name, $custom_field_enum_edit_dto): \RaynetApiClient\Model\CustomFieldEnumEdit200Response
```

Upravení položky enumerace

Upravení hodnoty enumerace

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, která volitelné pole obsahuje
$field_name = Priorita_O_a5fab; // string | Klíč volitelného pole
$custom_field_enum_edit_dto = {"oldValue":"položka 1","newValue":"položka 11"}; // \RaynetApiClient\Model\CustomFieldEnumEditDto

try {
    $result = $apiInstance->customFieldEnumEdit($entity_name, $field_name, $custom_field_enum_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldEnumEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, která volitelné pole obsahuje | |
| **field_name** | **string**| Klíč volitelného pole | |
| **custom_field_enum_edit_dto** | [**\RaynetApiClient\Model\CustomFieldEnumEditDto**](../Model/CustomFieldEnumEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumEdit200Response**](../Model/CustomFieldEnumEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldEnumGet()`

```php
customFieldEnumGet($entity_name, $field_name): \RaynetApiClient\Model\CustomFieldEnumGet200Response
```

Načtení seznamu položek enumerace

Načtení seznamu všech dostupných položek enumerace (číselníku, alias roletky).

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, která volitelné pole obsahuje
$field_name = Priorita_O_a5fab; // string | Klíč volitelného pole

try {
    $result = $apiInstance->customFieldEnumGet($entity_name, $field_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldEnumGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, která volitelné pole obsahuje | |
| **field_name** | **string**| Klíč volitelného pole | |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumGet200Response**](../Model/CustomFieldEnumGet200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customFieldEnumInsert()`

```php
customFieldEnumInsert($entity_name, $field_name, $custom_field_enum_insert_dto): \RaynetApiClient\Model\CustomFieldEnumInsert200Response
```

Založení nové položky enumerace

Vložení nové hodnoty do enumerace

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


$apiInstance = new RaynetApiClient\Api\VolitelnPoleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = BusinessCase; // string | Název entity, která volitelné pole obsahuje
$field_name = Priorita_O_a5fab; // string | Klíč volitelného pole
$custom_field_enum_insert_dto = {"value":"položka 1"}; // \RaynetApiClient\Model\CustomFieldEnumInsertDto

try {
    $result = $apiInstance->customFieldEnumInsert($entity_name, $field_name, $custom_field_enum_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolitelnPoleApi->customFieldEnumInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity, která volitelné pole obsahuje | |
| **field_name** | **string**| Klíč volitelného pole | |
| **custom_field_enum_insert_dto** | [**\RaynetApiClient\Model\CustomFieldEnumInsertDto**](../Model/CustomFieldEnumInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\CustomFieldEnumInsert200Response**](../Model/CustomFieldEnumInsert200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
