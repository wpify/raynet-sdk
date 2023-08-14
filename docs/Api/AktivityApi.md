# RaynetApiClient\AktivityApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**activityGet()**](AktivityApi.md#activityGet) | **GET** /activity/ | seznam aktivit |
| [**lockEdit()**](AktivityApi.md#lockEdit) | **POST** /{activityType}/{activityId}/lock | uzamčení aktivity |
| [**unlockEdit()**](AktivityApi.md#unlockEdit) | **POST** /{activityType}/{activityId}/unlock | odemčení aktivity |


## `activityGet()`

```php
activityGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags)
```

seznam aktivit

Získání seznamu všech aktivit, nezávisle na typu. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/activity/?offset=0&limit=1&title[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\AktivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených událostí je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$id = 3; // int | Filtrování aktivit podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$title = myTag; // string | Filtrování aktivit podle předmětu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$scheduled_from = 2022-06-01 10:00; // string | Filtrování aktivit podle data naplánování (\"od\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$scheduled_till = 2022-06-01 10:00; // string | Filtrování aktivit podle data naplánování (\"do\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$completed = 2022-06-01 10:00; // string | Filtrování aktivit podle data realizování. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$category_id = 3; // int | Filtrování aktivit podle ID kategorie. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = SCHEDULED; // string | Filtrování aktivit podle statusu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$owner_id = 3; // int | Filtrování aktivit podle ID kontaktní osoby, která je vlastníkem aktivity. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person_filter = 3; // int | Filtrování aktivit podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů.
$company_context_filter = 3; // int | Filtrování aktivit podle ID klienta, kterého se aktivity týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$lead_context_filter = 3; // int | Filtrování aktivit podle ID leadu, kterého se aktivity týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$business_case = 3; // int | Filtrování aktivit podle ID obchodního případu, kterého se události týkají. Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování aktivit podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování aktivit podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování aktivit podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->activityGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling AktivityApi->activityGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených událostí je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **id** | **int**| Filtrování aktivit podle ID. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **title** | **string**| Filtrování aktivit podle předmětu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **scheduled_from** | **string**| Filtrování aktivit podle data naplánování (\&quot;od\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **scheduled_till** | **string**| Filtrování aktivit podle data naplánování (\&quot;do\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **completed** | **string**| Filtrování aktivit podle data realizování. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **category_id** | **int**| Filtrování aktivit podle ID kategorie. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování aktivit podle statusu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **owner_id** | **int**| Filtrování aktivit podle ID kontaktní osoby, která je vlastníkem aktivity. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **person_filter** | **int**| Filtrování aktivit podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů. | [optional] |
| **company_context_filter** | **int**| Filtrování aktivit podle ID klienta, kterého se aktivity týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **lead_context_filter** | **int**| Filtrování aktivit podle ID leadu, kterého se aktivity týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **business_case** | **int**| Filtrování aktivit podle ID obchodního případu, kterého se události týkají. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování aktivit podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování aktivit podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování aktivit podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `lockEdit()`

```php
lockEdit($activity_type, $activity_id)
```

uzamčení aktivity

Uzamčení záznamu aktivity pro editaci.

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


$apiInstance = new RaynetApiClient\Api\AktivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$activity_type = task; // string | Typ aktivity, může nabývat hodnot: 'task', 'meeting', 'event', 'email', 'phonecall' nebo 'letter'
$activity_id = 123; // int | ID aktivity

try {
    $apiInstance->lockEdit($activity_type, $activity_id);
} catch (Exception $e) {
    echo 'Exception when calling AktivityApi->lockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **activity_type** | **string**| Typ aktivity, může nabývat hodnot: &#39;task&#39;, &#39;meeting&#39;, &#39;event&#39;, &#39;email&#39;, &#39;phonecall&#39; nebo &#39;letter&#39; | |
| **activity_id** | **int**| ID aktivity | |

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

## `unlockEdit()`

```php
unlockEdit($activity_type, $activity_id)
```

odemčení aktivity

Odemčení záznamu aktivity k editaci.

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


$apiInstance = new RaynetApiClient\Api\AktivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$activity_type = meeting; // string | Typ aktivity, může nabývat hodnot: 'task', 'meeting', 'event', 'email', 'phonecall' nebo 'letter'
$activity_id = 123; // int | ID aktivity

try {
    $apiInstance->unlockEdit($activity_type, $activity_id);
} catch (Exception $e) {
    echo 'Exception when calling AktivityApi->unlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **activity_type** | **string**| Typ aktivity, může nabývat hodnot: &#39;task&#39;, &#39;meeting&#39;, &#39;event&#39;, &#39;email&#39;, &#39;phonecall&#39; nebo &#39;letter&#39; | |
| **activity_id** | **int**| ID aktivity | |

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
