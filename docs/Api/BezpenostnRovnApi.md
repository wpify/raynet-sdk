# RaynetApiClient\BezpenostnRovnApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**securityLevelDelete()**](BezpenostnRovnApi.md#securityLevelDelete) | **DELETE** /securityLevel/{securityLevelId}/ | smazání bezpečnostní úrovně |
| [**securityLevelGet()**](BezpenostnRovnApi.md#securityLevelGet) | **GET** /securityLevel/ | seznam bezpečnostních úrovní |
| [**securityLevelInsert()**](BezpenostnRovnApi.md#securityLevelInsert) | **PUT** /securityLevel/ | nová bezpečnostní úroveň |
| [**securityLevelMultiAddUserEdit()**](BezpenostnRovnApi.md#securityLevelMultiAddUserEdit) | **POST** /securityLevel/{securityLevelId}/multiAddUser | hromadné přidání uživatelů do bezpečnostní úrovně |
| [**securityLevelMultiRemoveUserEdit()**](BezpenostnRovnApi.md#securityLevelMultiRemoveUserEdit) | **POST** /securityLevel/{securityLevelId}/multiRemoveUser | hromadné odebrání uživatelů z bezpečnostní úrovně |


## `securityLevelDelete()`

```php
securityLevelDelete($security_level_id)
```

smazání bezpečnostní úrovně



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


$apiInstance = new RaynetApiClient\Api\BezpenostnRovnApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$security_level_id = 123; // int | ID bezpečnostní úrovně

try {
    $apiInstance->securityLevelDelete($security_level_id);
} catch (Exception $e) {
    echo 'Exception when calling BezpenostnRovnApi->securityLevelDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **security_level_id** | **int**| ID bezpečnostní úrovně | |

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

## `securityLevelGet()`

```php
securityLevelGet($offset, $limit, $name, $locked)
```

seznam bezpečnostních úrovní

Získání seznamu bezpečnostních úrovní. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/securityLevel/?offset=0&limit=1&name[LIKE]=Sd% ```

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


$apiInstance = new RaynetApiClient\Api\BezpenostnRovnApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$name = RAY; // string | Filtrování bezpečnostních úrovní podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$locked = YES; // bool | Filtrování bezpečnostních úrovní podle stavu uzamčení. Lze využít operátoru `EQ`, `NE`.

try {
    $apiInstance->securityLevelGet($offset, $limit, $name, $locked);
} catch (Exception $e) {
    echo 'Exception when calling BezpenostnRovnApi->securityLevelGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **name** | **string**| Filtrování bezpečnostních úrovní podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **locked** | **bool**| Filtrování bezpečnostních úrovní podle stavu uzamčení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |

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

## `securityLevelInsert()`

```php
securityLevelInsert($security_level_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová bezpečnostní úroveň

Založení nové bezpečnostní úrovně. Bude přiřazena automaticky všem administrátorům.

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


$apiInstance = new RaynetApiClient\Api\BezpenostnRovnApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$security_level_insert_dto = {"name":"Bezpečnostní úroveň 1"}; // \RaynetApiClient\Model\SecurityLevelInsertDto

try {
    $result = $apiInstance->securityLevelInsert($security_level_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BezpenostnRovnApi->securityLevelInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **security_level_insert_dto** | [**\RaynetApiClient\Model\SecurityLevelInsertDto**](../Model/SecurityLevelInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\Insert201Response**](../Model/Insert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `securityLevelMultiAddUserEdit()`

```php
securityLevelMultiAddUserEdit($security_level_id, $security_level_multi_add_user_edit_dto): \RaynetApiClient\Model\SecurityLevelMultiAddUserEdit201Response
```

hromadné přidání uživatelů do bezpečnostní úrovně



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


$apiInstance = new RaynetApiClient\Api\BezpenostnRovnApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$security_level_id = 123; // int | ID bezpečnostní úrovně
$security_level_multi_add_user_edit_dto = {"personIds":[84,102]}; // \RaynetApiClient\Model\SecurityLevelMultiAddUserEditDto

try {
    $result = $apiInstance->securityLevelMultiAddUserEdit($security_level_id, $security_level_multi_add_user_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BezpenostnRovnApi->securityLevelMultiAddUserEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **security_level_id** | **int**| ID bezpečnostní úrovně | |
| **security_level_multi_add_user_edit_dto** | [**\RaynetApiClient\Model\SecurityLevelMultiAddUserEditDto**](../Model/SecurityLevelMultiAddUserEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\SecurityLevelMultiAddUserEdit201Response**](../Model/SecurityLevelMultiAddUserEdit201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `securityLevelMultiRemoveUserEdit()`

```php
securityLevelMultiRemoveUserEdit($security_level_id, $security_level_multi_remove_user_edit_dto): \RaynetApiClient\Model\SecurityLevelMultiRemoveUserEdit201Response
```

hromadné odebrání uživatelů z bezpečnostní úrovně



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


$apiInstance = new RaynetApiClient\Api\BezpenostnRovnApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$security_level_id = 123; // int | ID bezpečnostní úrovně
$security_level_multi_remove_user_edit_dto = {"personIds":[84,102]}; // \RaynetApiClient\Model\SecurityLevelMultiRemoveUserEditDto

try {
    $result = $apiInstance->securityLevelMultiRemoveUserEdit($security_level_id, $security_level_multi_remove_user_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BezpenostnRovnApi->securityLevelMultiRemoveUserEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **security_level_id** | **int**| ID bezpečnostní úrovně | |
| **security_level_multi_remove_user_edit_dto** | [**\RaynetApiClient\Model\SecurityLevelMultiRemoveUserEditDto**](../Model/SecurityLevelMultiRemoveUserEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\SecurityLevelMultiRemoveUserEdit201Response**](../Model/SecurityLevelMultiRemoveUserEdit201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
