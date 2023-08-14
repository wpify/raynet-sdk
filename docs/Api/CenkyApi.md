# RaynetApiClient\CenkyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**priceListDelete()**](CenkyApi.md#priceListDelete) | **DELETE** /priceList/{priceListId}/ | smazání ceníku |
| [**priceListDetailGet()**](CenkyApi.md#priceListDetailGet) | **GET** /priceList/{priceListId}/ | detail ceníku |
| [**priceListEdit()**](CenkyApi.md#priceListEdit) | **POST** /priceList/{priceListId}/ | upravení ceníku |
| [**priceListGet()**](CenkyApi.md#priceListGet) | **GET** /priceList/ | seznam ceníků |
| [**priceListInsert()**](CenkyApi.md#priceListInsert) | **PUT** /priceList/ | nový ceník |
| [**priceListItemBulkUpsertEdit()**](CenkyApi.md#priceListItemBulkUpsertEdit) | **POST** /priceList/{priceListId}/itemBulkUpsert/ | hromadné přidání/upravení položek ceníku |
| [**priceListItemDelete()**](CenkyApi.md#priceListItemDelete) | **DELETE** /priceList/{priceListId}/item/{priceListItemId}/ | smazání položky ceníku |
| [**priceListItemEdit()**](CenkyApi.md#priceListItemEdit) | **POST** /priceList/{priceListId}/item/{priceListItemId}/ | upravení položky ceníku |
| [**priceListItemInsert()**](CenkyApi.md#priceListItemInsert) | **PUT** /priceList/{priceListId}/item/ | přidání položek ceníku |
| [**priceListItemsDetailGet()**](CenkyApi.md#priceListItemsDetailGet) | **GET** /priceList/{priceListId}/items/ | seznam položek ceníku |
| [**priceListLockEdit()**](CenkyApi.md#priceListLockEdit) | **POST** /priceList/{priceListId}/lock | uzamčení ceníku |
| [**priceListUnlockEdit()**](CenkyApi.md#priceListUnlockEdit) | **POST** /priceList/{priceListId}/unlock | odemčení ceníku |


## `priceListDelete()`

```php
priceListDelete($price_list_id)
```

smazání ceníku



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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku

try {
    $apiInstance->priceListDelete($price_list_id);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListDetailGet()`

```php
priceListDetailGet($price_list_id)
```

detail ceníku

Získání detailu ceníku.  ``` https://app.raynet.cz/api/v2/priceList/1/ ```

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku

try {
    $apiInstance->priceListDetailGet($price_list_id);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |

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

## `priceListEdit()`

```php
priceListEdit($price_list_id, $price_list_edit_dto)
```

upravení ceníku

Upravení dat ceníku

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$price_list_edit_dto = {"name":"Ceník ABC","code":"CEN-002","owner":3,"currency":17,"category":13,"validFrom":"2022-11-08","validTill":"2022-11-08","description":"Text text"}; // \RaynetApiClient\Model\PriceListEditDto

try {
    $apiInstance->priceListEdit($price_list_id, $price_list_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **price_list_edit_dto** | [**\RaynetApiClient\Model\PriceListEditDto**](../Model/PriceListEditDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListGet()`

```php
priceListGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam ceníků

Získání seznamu ceníků. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/priceList/?offset=0&limit=1&code[LIKE]=CEN-001% ```

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených cenníků je `1000`
$sort_column = name; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$code = CEN-001; // string | Filtrování ceníků podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$primary = YES; // string | Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru `EQ`, `NE`
$currency = 1; // int | Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id)
$valid_from = 2022-06-01; // string | Filtrování ceníků podle data platnosti. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_till = 2022-06-01; // string | Filtrování ceníků podle data platnosti. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování ceníků podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování ceníků podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->priceListGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených cenníků je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **code** | **string**| Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **primary** | **string**| Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; | [optional] |
| **currency** | **int**| Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) | [optional] |
| **valid_from** | **string**| Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_till** | **string**| Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `priceListInsert()`

```php
priceListInsert($price_list_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový ceník

Založení nového ceníku

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_insert_dto = {"name":"Ceník ABC","code":"CEN-002","owner":3,"currency":17,"category":13,"validFrom":"2022-11-08","validTill":"2022-11-08","description":"Text text"}; // \RaynetApiClient\Model\PriceListInsertDto

try {
    $result = $apiInstance->priceListInsert($price_list_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_insert_dto** | [**\RaynetApiClient\Model\PriceListInsertDto**](../Model/PriceListInsertDto.md)|  | [optional] |

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

## `priceListItemBulkUpsertEdit()`

```php
priceListItemBulkUpsertEdit($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner): mixed
```

hromadné přidání/upravení položek ceníku

Hromadné přidání/upravení položek na ceník. API je omezeno na 100 současně vkládaných položek.  ``` https://app.raynet.cz/api/v2/priceList/1/itemBulkUpsert/ ```

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$price_list_item_bulk_upsert_edit_dto_inner = [{"price":400,"product":1,"description":"Lorem ipsum...","unit":"ks","cost":100,"taxRate":21}]; // \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[]

try {
    $result = $apiInstance->priceListItemBulkUpsertEdit($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListItemBulkUpsertEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **price_list_item_bulk_upsert_edit_dto_inner** | [**\RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[]**](../Model/PriceListItemBulkUpsertEditDtoInner.md)|  | [optional] |

### Return type

**mixed**

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListItemDelete()`

```php
priceListItemDelete($price_list_id, $price_list_item_id)
```

smazání položky ceníku

Smazání položky na ceníku

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$price_list_item_id = 123; // int | ID položky ceníku

try {
    $apiInstance->priceListItemDelete($price_list_id, $price_list_item_id);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListItemDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **price_list_item_id** | **int**| ID položky ceníku | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListItemEdit()`

```php
priceListItemEdit($price_list_id, $price_list_item_id, $price_list_item_edit_dto)
```

upravení položky ceníku

Upravení položky na ceníku

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$price_list_item_id = 123; // int | ID položky ceníku
$price_list_item_edit_dto = {"price":400,"product":1,"description":"Lorem ipsum...","unit":"ks","cost":100,"taxRate":21}; // \RaynetApiClient\Model\PriceListItemEditDto

try {
    $apiInstance->priceListItemEdit($price_list_id, $price_list_item_id, $price_list_item_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListItemEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **price_list_item_id** | **int**| ID položky ceníku | |
| **price_list_item_edit_dto** | [**\RaynetApiClient\Model\PriceListItemEditDto**](../Model/PriceListItemEditDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListItemInsert()`

```php
priceListItemInsert($price_list_id, $price_list_item_insert_dto)
```

přidání položek ceníku

Přidání položek na ceník  ``` https://app.raynet.cz/api/v2/priceList/1/item/ ```

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$price_list_item_insert_dto = {"price":400,"product":1,"description":"Lorem ipsum...","unit":"ks","cost":100,"taxRate":21}; // \RaynetApiClient\Model\PriceListItemInsertDto

try {
    $apiInstance->priceListItemInsert($price_list_id, $price_list_item_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListItemInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **price_list_item_insert_dto** | [**\RaynetApiClient\Model\PriceListItemInsertDto**](../Model/PriceListItemInsertDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListItemsDetailGet()`

```php
priceListItemsDetailGet($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at)
```

seznam položek ceníku

V rámci detailu ceníku je vráceno prvních 1000 položek ceníku. Pokud potřebujete vyčíst větší množství položek z konkrétního ceníku, je nutné použít toto volání API.

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku
$offset = 0; // int | Zobrazení záznamů od začátku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = name; // string | 
$sort_direction = ASC; // string | 
$product_id = 100; // int | Filtrování položek ceníku podle ID produktu. Lze využít operátoru `EQ`, `NE`, `IN`
$product_code = KONV; // string | Filtrování položek ceníku podle kódu produktu. Lze využít operátoru `EQ`, `NE`, `LIKE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.

try {
    $apiInstance->priceListItemsDetailGet($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListItemsDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |
| **offset** | **int**| Zobrazení záznamů od začátku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **product_id** | **int**| Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **product_code** | **string**| Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |

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

## `priceListLockEdit()`

```php
priceListLockEdit($price_list_id)
```

uzamčení ceníku

Uzamčení záznamu ceníku pro editaci.

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku

try {
    $apiInstance->priceListLockEdit($price_list_id);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `priceListUnlockEdit()`

```php
priceListUnlockEdit($price_list_id)
```

odemčení ceníku

Odemčení záznamu ceníku k editaci.

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


$apiInstance = new RaynetApiClient\Api\CenkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$price_list_id = 123; // int | ID ceníku

try {
    $apiInstance->priceListUnlockEdit($price_list_id);
} catch (Exception $e) {
    echo 'Exception when calling CenkyApi->priceListUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **price_list_id** | **int**| ID ceníku | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
