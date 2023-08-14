# RaynetApiClient\DiskuzeApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**postDelete()**](DiskuzeApi.md#postDelete) | **DELETE** /{entityName}/{entityId}/post/{postId}/ | smazání příspěvku z diskuze |
| [**postDetailGet()**](DiskuzeApi.md#postDetailGet) | **GET** /{entityName}/{entityId}/post/ | seznam příspěvků diskuze |
| [**postInsert()**](DiskuzeApi.md#postInsert) | **PUT** /{entityName}/{entityId}/post/ | nový příspěvek do diskuze |
| [**watcherDelete()**](DiskuzeApi.md#watcherDelete) | **DELETE** /{entityName}/{entityId}/watcher/{personId}/ | odebrání sledovače diskuze |
| [**watcherDetailGet()**](DiskuzeApi.md#watcherDetailGet) | **GET** /{entityName}/{entityId}/watcher/ | seznam sledovačů diskuze |
| [**watcherInsert()**](DiskuzeApi.md#watcherInsert) | **PUT** /{entityName}/{entityId}/watcher/{personId}/ | přidání sledovače diskuze |


## `postDelete()`

```php
postDelete($entity_name, $entity_id, $post_id): \RaynetApiClient\Model\PostDelete201Response
```

smazání příspěvku z diskuze

``` https://app.raynet.cz/api/v2/company/4/post/19/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$post_id = 123; // int | ID příspěvku

try {
    $result = $apiInstance->postDelete($entity_name, $entity_id, $post_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->postDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **post_id** | **int**| ID příspěvku | |

### Return type

[**\RaynetApiClient\Model\PostDelete201Response**](../Model/PostDelete201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `postDetailGet()`

```php
postDetailGet($entity_name, $entity_id)
```

seznam příspěvků diskuze

``` https://app.raynet.cz/api/v2/company/4/post/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity

try {
    $apiInstance->postDetailGet($entity_name, $entity_id);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->postDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |

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

## `postInsert()`

```php
postInsert($entity_name, $entity_id, $post_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový příspěvek do diskuze

``` https://app.raynet.cz/api/v2/company/4/post/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$post_insert_dto = {"parent":16,"comment":"Další zajímavý komentář"}; // \RaynetApiClient\Model\PostInsertDto

try {
    $result = $apiInstance->postInsert($entity_name, $entity_id, $post_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->postInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **post_insert_dto** | [**\RaynetApiClient\Model\PostInsertDto**](../Model/PostInsertDto.md)|  | [optional] |

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

## `watcherDelete()`

```php
watcherDelete($entity_name, $entity_id, $person_id): \RaynetApiClient\Model\WatcherDelete201Response
```

odebrání sledovače diskuze

``` https://app.raynet.cz/api/v2/company/4/watcher/2/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$person_id = 123; // int | ID kontaktní osoby pro odebrání ze sledovačů diskuze

try {
    $result = $apiInstance->watcherDelete($entity_name, $entity_id, $person_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->watcherDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **person_id** | **int**| ID kontaktní osoby pro odebrání ze sledovačů diskuze | |

### Return type

[**\RaynetApiClient\Model\WatcherDelete201Response**](../Model/WatcherDelete201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `watcherDetailGet()`

```php
watcherDetailGet($entity_name, $entity_id)
```

seznam sledovačů diskuze

``` https://app.raynet.cz/api/v2/company/4/watcher/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity

try {
    $apiInstance->watcherDetailGet($entity_name, $entity_id);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->watcherDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |

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

## `watcherInsert()`

```php
watcherInsert($entity_name, $entity_id, $person_id): \RaynetApiClient\Model\Insert201Response
```

přidání sledovače diskuze

``` https://app.raynet.cz/api/v2/company/4/watcher/2/ ```

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


$apiInstance = new RaynetApiClient\Api\DiskuzeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `priceList`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$person_id = 123; // int | ID kontaktní osoby pro přidání mezi sledovače diskuze

try {
    $result = $apiInstance->watcherInsert($entity_name, $entity_id, $person_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiskuzeApi->watcherInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;priceList&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **person_id** | **int**| ID kontaktní osoby pro přidání mezi sledovače diskuze | |

### Return type

[**\RaynetApiClient\Model\Insert201Response**](../Model/Insert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
