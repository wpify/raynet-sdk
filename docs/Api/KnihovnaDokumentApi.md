# RaynetApiClient\KnihovnaDokumentApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**dmsDocumentDelete()**](KnihovnaDokumentApi.md#dmsDocumentDelete) | **DELETE** /dms/document/{documentId}/ | smazání dokumentu |
| [**dmsDocumentDetailGet()**](KnihovnaDokumentApi.md#dmsDocumentDetailGet) | **GET** /dms/document/{documentId}/ | detail dokumentu |
| [**dmsDocumentEdit()**](KnihovnaDokumentApi.md#dmsDocumentEdit) | **POST** /dms/document/{documentId}/ | upravení dokumentu |
| [**dmsDocumentInsert()**](KnihovnaDokumentApi.md#dmsDocumentInsert) | **PUT** /dms/document/ | nový dokument |
| [**dmsDocumentInvalidEdit()**](KnihovnaDokumentApi.md#dmsDocumentInvalidEdit) | **POST** /dms/document/{documentId}/invalid | zneplatnění dokumentu |
| [**dmsDocumentLockEdit()**](KnihovnaDokumentApi.md#dmsDocumentLockEdit) | **POST** /dms/document/{documentId}/lock | uzamčení dokumentu |
| [**dmsDocumentUnlockEdit()**](KnihovnaDokumentApi.md#dmsDocumentUnlockEdit) | **POST** /dms/document/{documentId}/unlock | odemčení dokumentu |
| [**dmsDocumentValidEdit()**](KnihovnaDokumentApi.md#dmsDocumentValidEdit) | **POST** /dms/document/{documentId}/valid | obnovení platnosti dokumentu |
| [**dmsFolderCascadeDelete()**](KnihovnaDokumentApi.md#dmsFolderCascadeDelete) | **DELETE** /dms/folder/{folderId}/cascade/ | smazání složky kaskádovitě |
| [**dmsFolderDelete()**](KnihovnaDokumentApi.md#dmsFolderDelete) | **DELETE** /dms/folder/{folderId}/ | smazání složky |
| [**dmsFolderInsert()**](KnihovnaDokumentApi.md#dmsFolderInsert) | **PUT** /dms/folder/ | nová složka |
| [**dmsGet()**](KnihovnaDokumentApi.md#dmsGet) | **GET** /dms/ | seznam složek a souborů |


## `dmsDocumentDelete()`

```php
dmsDocumentDelete($document_id)
```

smazání dokumentu



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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentDelete($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsDocumentDetailGet()`

```php
dmsDocumentDetailGet($document_id)
```

detail dokumentu

Získání detailu dokumentu.  ``` https://app.raynet.cz/api/v2/dms/document/1/ ```

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentDetailGet($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsDocumentEdit()`

```php
dmsDocumentEdit($document_id, $dms_document_edit_dto)
```

upravení dokumentu

Upravení dat dokumentu

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu
$dms_document_edit_dto = {"file":{"uuid":"7d694dbb4e6241829de8a385da797283","fileName":"picture.png","contentType":"image/png","fileSize":24309},"status":"E_WIN","securityLevel":4,"category":288,"template":false,"validFrom":"2022-01-01","validTill":"2022-01-01","folder":9}; // \RaynetApiClient\Model\DmsDocumentEditDto

try {
    $apiInstance->dmsDocumentEdit($document_id, $dms_document_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |
| **dms_document_edit_dto** | [**\RaynetApiClient\Model\DmsDocumentEditDto**](../Model/DmsDocumentEditDto.md)|  | [optional] |

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

## `dmsDocumentInsert()`

```php
dmsDocumentInsert($dms_document_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový dokument

Vložení nového dokumentu do knihovny dokumentů.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$dms_document_insert_dto = {"file":{"uuid":"7d694dbb4e6241829de8a385da797283","fileName":"picture.png","contentType":"image/png","fileSize":24309},"status":"E_WIN","securityLevel":4,"category":288,"template":false,"validFrom":"2022-01-01","validTill":"2022-01-01","folder":9}; // \RaynetApiClient\Model\DmsDocumentInsertDto

try {
    $result = $apiInstance->dmsDocumentInsert($dms_document_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **dms_document_insert_dto** | [**\RaynetApiClient\Model\DmsDocumentInsertDto**](../Model/DmsDocumentInsertDto.md)|  | [optional] |

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

## `dmsDocumentInvalidEdit()`

```php
dmsDocumentInvalidEdit($document_id)
```

zneplatnění dokumentu

Zneplatnění záznamu dokumnetu.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentInvalidEdit($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsDocumentLockEdit()`

```php
dmsDocumentLockEdit($document_id)
```

uzamčení dokumentu

Uzamčení záznamu dokumentu pro editaci.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentLockEdit($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsDocumentUnlockEdit()`

```php
dmsDocumentUnlockEdit($document_id)
```

odemčení dokumentu

Odemčení záznamu dokumentu k editaci.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentUnlockEdit($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsDocumentValidEdit()`

```php
dmsDocumentValidEdit($document_id)
```

obnovení platnosti dokumentu

Obnovení platnosti záznamu dokumentu.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 123; // int | ID dokumentu

try {
    $apiInstance->dmsDocumentValidEdit($document_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsDocumentValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **document_id** | **int**| ID dokumentu | |

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

## `dmsFolderCascadeDelete()`

```php
dmsFolderCascadeDelete($folder_id)
```

smazání složky kaskádovitě



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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$folder_id = 123; // int | ID klienta

try {
    $apiInstance->dmsFolderCascadeDelete($folder_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsFolderCascadeDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **folder_id** | **int**| ID klienta | |

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

## `dmsFolderDelete()`

```php
dmsFolderDelete($folder_id)
```

smazání složky



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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$folder_id = 123; // int | ID klienta

try {
    $apiInstance->dmsFolderDelete($folder_id);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsFolderDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **folder_id** | **int**| ID klienta | |

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

## `dmsFolderInsert()`

```php
dmsFolderInsert($dms_folder_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová složka

Založení nové složky v DMS. Složka musí mít unikátní název v rámci svého zařazení a nesmí obsahovat některé speciální znaky.

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$dms_folder_insert_dto = {"name":"Složka 1","parent":null,"category":143,"securityLevel":1}; // \RaynetApiClient\Model\DmsFolderInsertDto

try {
    $result = $apiInstance->dmsFolderInsert($dms_folder_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsFolderInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **dms_folder_insert_dto** | [**\RaynetApiClient\Model\DmsFolderInsertDto**](../Model/DmsFolderInsertDto.md)|  | [optional] |

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

## `dmsGet()`

```php
dmsGet($path)
```

seznam složek a souborů

Api pro listování strukturou složek. Ve výsledku je vrácen seznam složek, souborů a odkazů, které jsou relevantní pro filtrovanou cestu (path).

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


$apiInstance = new RaynetApiClient\Api\KnihovnaDokumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$path = /Dokumenty; // string | Filtrování podle cesty ve struktuře složek. Lze využít pouze operátoru `EQ`

try {
    $apiInstance->dmsGet($path);
} catch (Exception $e) {
    echo 'Exception when calling KnihovnaDokumentApi->dmsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **path** | **string**| Filtrování podle cesty ve struktuře složek. Lze využít pouze operátoru &#x60;EQ&#x60; | [optional] |

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
