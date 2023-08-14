# RaynetApiClient\NotifikaceApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**notificationDelete()**](NotifikaceApi.md#notificationDelete) | **DELETE** /notification/{notificationId}/ | smazání notifikace |
| [**notificationGet()**](NotifikaceApi.md#notificationGet) | **GET** /notification/ | seznam notifikací |


## `notificationDelete()`

```php
notificationDelete($notification_id)
```

smazání notifikace

Uživatelé mohou smazat jen vlastní notifikace, kdežto administrátor může smazat i cizí.

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


$apiInstance = new RaynetApiClient\Api\NotifikaceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$notification_id = 123; // int | ID notifikace

try {
    $apiInstance->notificationDelete($notification_id);
} catch (Exception $e) {
    echo 'Exception when calling NotifikaceApi->notificationDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **notification_id** | **int**| ID notifikace | |

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

## `notificationGet()`

```php
notificationGet($offset, $limit, $sort_column, $sort_direction, $id, $date, $sender, $recipient, $flag, $read, $context)
```

seznam notifikací

Získání notifikací. Pokud není použit filtr `recipient[CUSTOM]=all-recipient`, tak jsou vráceny jen notifikace aktuálního uživatele.  ``` https://app.raynet.cz/api/v2/notification/?sender[EQ]=2 ```

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


$apiInstance = new RaynetApiClient\Api\NotifikaceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = 'sort_column_example'; // string | 
$sort_direction = 'sort_direction_example'; // string | 
$id = 56; // int | Filtrování podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$date = 'date_example'; // string | Filtrování podle data notifikace. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$sender = 56; // int | Filtrování podle odesílatele. S operátorem `CUSTOM`
$recipient = 'recipient_example'; // string | Filtrování podle příjemce. V případě `recipient[CUSTOM]=all-recipient` operátoru umožní vyfiltrovat notifikace všech uživatelů. Tento filtr může použít pouze uživatel s rolí administrátor. Lze využít operátoru `EQ`, `NE`, `IN`, `CUSTOM`
$flag = True; // bool | Filtrování notifikací označených hvězdičkou. Lze využít operátoru `EQ`, `NE`.
$read = True; // bool | Filtrování přečtených notifikací. Lze využít operátoru `EQ`, `NE`.
$context = 'context_example'; // string | Filtrování podle kontextu notifikace, kde kontext musí být ve formátu NázevEntity#IdEntity (podporované názvy entit jsou: 'company', 'lead', 'person', 'businessCase', 'offer', 'salesOrder', 'product', 'project', 'invoice', 'task', 'email', 'event', 'letter', 'phoneCall', 'meeting')

try {
    $apiInstance->notificationGet($offset, $limit, $sort_column, $sort_direction, $id, $date, $sender, $recipient, $flag, $read, $context);
} catch (Exception $e) {
    echo 'Exception when calling NotifikaceApi->notificationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **id** | **int**| Filtrování podle ID. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **date** | **string**| Filtrování podle data notifikace. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **sender** | **int**| Filtrování podle odesílatele. S operátorem &#x60;CUSTOM&#x60; | [optional] |
| **recipient** | **string**| Filtrování podle příjemce. V případě &#x60;recipient[CUSTOM]&#x3D;all-recipient&#x60; operátoru umožní vyfiltrovat notifikace všech uživatelů. Tento filtr může použít pouze uživatel s rolí administrátor. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;CUSTOM&#x60; | [optional] |
| **flag** | **bool**| Filtrování notifikací označených hvězdičkou. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |
| **read** | **bool**| Filtrování přečtených notifikací. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |
| **context** | **string**| Filtrování podle kontextu notifikace, kde kontext musí být ve formátu NázevEntity#IdEntity (podporované názvy entit jsou: &#39;company&#39;, &#39;lead&#39;, &#39;person&#39;, &#39;businessCase&#39;, &#39;offer&#39;, &#39;salesOrder&#39;, &#39;product&#39;, &#39;project&#39;, &#39;invoice&#39;, &#39;task&#39;, &#39;email&#39;, &#39;event&#39;, &#39;letter&#39;, &#39;phoneCall&#39;, &#39;meeting&#39;) | [optional] |

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
