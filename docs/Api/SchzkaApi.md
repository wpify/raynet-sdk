# RaynetApiClient\SchzkaApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**meetingDelete()**](SchzkaApi.md#meetingDelete) | **DELETE** /meeting/{meetingId}/ | smazání schůzky |
| [**meetingDetailGet()**](SchzkaApi.md#meetingDetailGet) | **GET** /meeting/{meetingId}/ | detail schůzky |
| [**meetingEdit()**](SchzkaApi.md#meetingEdit) | **POST** /meeting/{meetingId}/ | upravení schůzky |
| [**meetingGet()**](SchzkaApi.md#meetingGet) | **GET** /meeting/ | seznam schůzek |
| [**meetingInsert()**](SchzkaApi.md#meetingInsert) | **PUT** /meeting/ | nová schůzka |


## `meetingDelete()`

```php
meetingDelete($meeting_id)
```

smazání schůzky



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


$apiInstance = new RaynetApiClient\Api\SchzkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$meeting_id = 123; // int | ID schůzky

try {
    $apiInstance->meetingDelete($meeting_id);
} catch (Exception $e) {
    echo 'Exception when calling SchzkaApi->meetingDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **meeting_id** | **int**| ID schůzky | |

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

## `meetingDetailGet()`

```php
meetingDetailGet($meeting_id)
```

detail schůzky

Získání detailu schůzky. Pokud záznam schůzky obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/meeting/2/ ```

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


$apiInstance = new RaynetApiClient\Api\SchzkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$meeting_id = 123; // int | ID schůzky

try {
    $apiInstance->meetingDetailGet($meeting_id);
} catch (Exception $e) {
    echo 'Exception when calling SchzkaApi->meetingDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **meeting_id** | **int**| ID schůzky | |

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

## `meetingEdit()`

```php
meetingEdit($meeting_id, $meeting_edit_dto): \RaynetApiClient\Model\MeetingEdit200Response
```

upravení schůzky

Upravení dat schůzky

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


$apiInstance = new RaynetApiClient\Api\SchzkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$meeting_id = 123; // int | ID schůzky
$meeting_edit_dto = {"title":"Schůzka u kávy","category":90,"priority":"DEFAULT","status":"SCHEDULED","personal":false,"company":2,"businessCase":5,"project":4,"activity":14,"scheduledFrom":"2022-06-11 15:00","scheduledTill":"2022-06-11 16:00","description":"Otázky k projednání.","solution":"Výsledek jednání.","tags":"aaa, bbb","customFields":{"VIP_b91d1":true},"participants":[{"id":-123},{"person":4},{"id":119,"owner":true,"role":"FROM","person":8,"company":2,"lead":null}]}; // \RaynetApiClient\Model\MeetingEditDto

try {
    $result = $apiInstance->meetingEdit($meeting_id, $meeting_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SchzkaApi->meetingEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **meeting_id** | **int**| ID schůzky | |
| **meeting_edit_dto** | [**\RaynetApiClient\Model\MeetingEditDto**](../Model/MeetingEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\MeetingEdit200Response**](../Model/MeetingEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `meetingGet()`

```php
meetingGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags)
```

seznam schůzek

Získání seznamu schůzek. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/meeting/?offset=0&limit=1&title[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\SchzkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených schůzek je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$id = 3; // int | Filtrování schůzek podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$title = myTag; // string | Filtrování schůzek podle předmětu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$scheduled_from = 2022-06-01 10:00; // string | Filtrování schůzek podle data naplánování (\"od\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$scheduled_till = 2022-06-01 10:00; // string | Filtrování schůzek podle data naplánování (\"do\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$completed = 2022-06-01 10:00; // string | Filtrování schůzek podle data realizování. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$category_id = 3; // int | Filtrování schůzek podle ID kategorie. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = SCHEDULED; // string | Filtrování schůzek podle statusu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$owner_id = 3; // int | Filtrování schůzek podle ID kontaktní osoby, která je vlastníkem schůzky. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person_filter = 3; // int | Filtrování schůzek podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů.
$company_context_filter = 3; // int | Filtrování schůzek podle ID klienta, kterého se schůzky týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$lead_context_filter = 3; // int | Filtrování schůzek podle ID leadu, kterého se schůzky týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$business_case = 3; // int | Filtrování schůzek podle ID obchodního případu, kterého se schůzky týkají. Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování schůzek podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování schůzek podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování schůzek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->meetingGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling SchzkaApi->meetingGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených schůzek je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **id** | **int**| Filtrování schůzek podle ID. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **title** | **string**| Filtrování schůzek podle předmětu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **scheduled_from** | **string**| Filtrování schůzek podle data naplánování (\&quot;od\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **scheduled_till** | **string**| Filtrování schůzek podle data naplánování (\&quot;do\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **completed** | **string**| Filtrování schůzek podle data realizování. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **category_id** | **int**| Filtrování schůzek podle ID kategorie. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování schůzek podle statusu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **owner_id** | **int**| Filtrování schůzek podle ID kontaktní osoby, která je vlastníkem schůzky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **person_filter** | **int**| Filtrování schůzek podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů. | [optional] |
| **company_context_filter** | **int**| Filtrování schůzek podle ID klienta, kterého se schůzky týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **lead_context_filter** | **int**| Filtrování schůzek podle ID leadu, kterého se schůzky týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **business_case** | **int**| Filtrování schůzek podle ID obchodního případu, kterého se schůzky týkají. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování schůzek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování schůzek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování schůzek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **view** | **string**| Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. | [optional] |
| **tags** | **string**| Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). | [optional] |

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

## `meetingInsert()`

```php
meetingInsert($meeting_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová schůzka

Založení nové schůzky

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


$apiInstance = new RaynetApiClient\Api\SchzkaApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$meeting_insert_dto = {"title":"Schůzka s klientem","priority":"DEFAULT","category":1,"owner":4,"person":2,"company":3,"scheduledFrom":"2022-06-11 15:00","scheduledTill":"2022-06-11 16:00","description":"Opravdu chcete náš produkt?","solution":"Berou to.","tags":["stitek 1","stitek 2"]}; // \RaynetApiClient\Model\MeetingInsertDto

try {
    $result = $apiInstance->meetingInsert($meeting_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SchzkaApi->meetingInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **meeting_insert_dto** | [**\RaynetApiClient\Model\MeetingInsertDto**](../Model/MeetingInsertDto.md)|  | [optional] |

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
