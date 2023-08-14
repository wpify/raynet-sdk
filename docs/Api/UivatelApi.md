# RaynetApiClient\UivatelApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**userAccountDetailGet()**](UivatelApi.md#userAccountDetailGet) | **GET** /userAccount/{userAccountId}/ | detail uživatele |
| [**userAccountGet()**](UivatelApi.md#userAccountGet) | **GET** /userAccount/ | seznam uživatelů |
| [**userAccountSecurityLevelDelete()**](UivatelApi.md#userAccountSecurityLevelDelete) | **DELETE** /userAccount/{userAccountId}/securityLevel/{securityLevelId} | odebrání bezpečností úrovně uživatele |
| [**userAccountSecurityLevelInsert()**](UivatelApi.md#userAccountSecurityLevelInsert) | **PUT** /userAccount/{userAccountId}/securityLevel/{securityLevelId} | přidání bezpečností úrovně uživatele |


## `userAccountDetailGet()`

```php
userAccountDetailGet($user_account_id)
```

detail uživatele

Získání detailu uživatelského účtu.

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


$apiInstance = new RaynetApiClient\Api\UivatelApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_account_id = 123; // int | ID uživatele

try {
    $apiInstance->userAccountDetailGet($user_account_id);
} catch (Exception $e) {
    echo 'Exception when calling UivatelApi->userAccountDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_account_id** | **int**| ID uživatele | |

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

## `userAccountGet()`

```php
userAccountGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $user_role, $username, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam uživatelů

Získání seznamu uživatelů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.

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


$apiInstance = new RaynetApiClient\Api\UivatelApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Od kterého indexu se budou záznamy zobrzovat (`0` = od začátku).
$limit = 100; // int | Počet vrácených záznamů, maximální počet je `1000`.
$sort_column = username; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$user_role = ADMIN; // string | Filtrování uživatelů podle role uživatele. Lze využít operátoru `EQ`, `NE`.
$username = info@raynet.cz; // string | Filtrování uživatelů podle uživatelského jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování uživatelů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování uživatelů podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování uživatelů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->userAccountGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $user_role, $username, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling UivatelApi->userAccountGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Od kterého indexu se budou záznamy zobrzovat (&#x60;0&#x60; &#x3D; od začátku). | [optional] |
| **limit** | **int**| Počet vrácených záznamů, maximální počet je &#x60;1000&#x60;. | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **user_role** | **string**| Filtrování uživatelů podle role uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |
| **username** | **string**| Filtrování uživatelů podle uživatelského jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování uživatelů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování uživatelů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování uživatelů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **view** | **string**| Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. | [optional] |

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

## `userAccountSecurityLevelDelete()`

```php
userAccountSecurityLevelDelete($user_account_id, $security_level_id)
```

odebrání bezpečností úrovně uživatele

Uživateli bude odebrána bezpečnostní úroveň. Tu je možné odebrat pouze uživateli, který není administrátor.

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


$apiInstance = new RaynetApiClient\Api\UivatelApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_account_id = 123; // int | ID uživatele
$security_level_id = 123; // int | ID bezpečnostní úrovně

try {
    $apiInstance->userAccountSecurityLevelDelete($user_account_id, $security_level_id);
} catch (Exception $e) {
    echo 'Exception when calling UivatelApi->userAccountSecurityLevelDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_account_id** | **int**| ID uživatele | |
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

## `userAccountSecurityLevelInsert()`

```php
userAccountSecurityLevelInsert($user_account_id, $security_level_id)
```

přidání bezpečností úrovně uživatele

Uživateli bude přidána bezpečnostní úroveň. Tu je možné přidat pouze uživateli, který není administrátor.

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


$apiInstance = new RaynetApiClient\Api\UivatelApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_account_id = 123; // int | ID uživatele
$security_level_id = 123; // int | ID bezpečnostní úrovně

try {
    $apiInstance->userAccountSecurityLevelInsert($user_account_id, $security_level_id);
} catch (Exception $e) {
    echo 'Exception when calling UivatelApi->userAccountSecurityLevelInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_account_id** | **int**| ID uživatele | |
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
