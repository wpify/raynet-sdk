# RaynetApiClient\DopisApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**letterDelete()**](DopisApi.md#letterDelete) | **DELETE** /letter/{letterId}/ | smazání dopisu |
| [**letterDetailGet()**](DopisApi.md#letterDetailGet) | **GET** /letter/{letterId}/ | detail dopisu |
| [**letterEdit()**](DopisApi.md#letterEdit) | **POST** /letter/{letterId}/ | upravení dopisu |
| [**letterGet()**](DopisApi.md#letterGet) | **GET** /letter/ | seznam dopisů |
| [**letterInsert()**](DopisApi.md#letterInsert) | **PUT** /letter/ | nový dopis |


## `letterDelete()`

```php
letterDelete($letter_id)
```

smazání dopisu



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


$apiInstance = new RaynetApiClient\Api\DopisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$letter_id = 123; // int | ID dopisu

try {
    $apiInstance->letterDelete($letter_id);
} catch (Exception $e) {
    echo 'Exception when calling DopisApi->letterDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **letter_id** | **int**| ID dopisu | |

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

## `letterDetailGet()`

```php
letterDetailGet($letter_id)
```

detail dopisu

Získání detailu dopisu. Pokud záznam dopisu obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/letter/2/ ```

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


$apiInstance = new RaynetApiClient\Api\DopisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$letter_id = 123; // int | ID dopisu

try {
    $apiInstance->letterDetailGet($letter_id);
} catch (Exception $e) {
    echo 'Exception when calling DopisApi->letterDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **letter_id** | **int**| ID dopisu | |

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

## `letterEdit()`

```php
letterEdit($letter_id, $letter_edit_dto): \RaynetApiClient\Model\LetterEdit200Response
```

upravení dopisu

Upravení dat dopisu

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


$apiInstance = new RaynetApiClient\Api\DopisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$letter_id = 123; // int | ID dopisu
$letter_edit_dto = {"title":"Dopis příteli","category":89,"priority":"DEFAULT","status":"SCHEDULED","personal":false,"company":2,"businessCase":5,"project":4,"activity":14,"scheduledFrom":"2022-06-11 15:00","scheduledTill":"2022-06-11 16:00","description":"Dobrý den příteli.","tags":"aaa, bbb","customFields":{"VIP_b91d1":true},"participants":[{"id":-123},{"person":4},{"id":119,"owner":true,"role":"FROM","person":8,"company":2,"lead":null}]}; // \RaynetApiClient\Model\LetterEditDto

try {
    $result = $apiInstance->letterEdit($letter_id, $letter_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DopisApi->letterEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **letter_id** | **int**| ID dopisu | |
| **letter_edit_dto** | [**\RaynetApiClient\Model\LetterEditDto**](../Model/LetterEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\LetterEdit200Response**](../Model/LetterEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `letterGet()`

```php
letterGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags)
```

seznam dopisů

Získání seznamu dopisů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/letter/?offset=0&limit=1&title[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\DopisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených dopisů je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$id = 3; // int | Filtrování dopisů podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$title = myTag; // string | Filtrování dopisů podle předmětu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$scheduled_from = 2022-06-01 10:00; // string | Filtrování dopisů podle data naplánování (\"od\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$scheduled_till = 2022-06-01 10:00; // string | Filtrování dopisů podle data naplánování (\"do\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$completed = 2022-06-01 10:00; // string | Filtrování dopisů podle data realizování. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$category_id = 3; // int | Filtrování dopisů podle ID kategorie. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = SCHEDULED; // string | Filtrování dopisů podle statusu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$owner_id = 3; // int | Filtrování dopisů podle ID kontaktní osoby, která je vlastníkem dopisu. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person_filter = 3; // int | Filtrování dopisů podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů.
$company_context_filter = 3; // int | Filtrování dopisů podle ID klienta, kterého se dopisy týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$lead_context_filter = 3; // int | Filtrování dopisů podle ID leadu, kterého se dopisy týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$business_case = 3; // int | Filtrování dopisů podle ID obchodního případu, kterého se dopisy týkají. Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování dopisů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování dopisů podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování dopisů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->letterGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling DopisApi->letterGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených dopisů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **id** | **int**| Filtrování dopisů podle ID. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **title** | **string**| Filtrování dopisů podle předmětu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **scheduled_from** | **string**| Filtrování dopisů podle data naplánování (\&quot;od\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **scheduled_till** | **string**| Filtrování dopisů podle data naplánování (\&quot;do\&quot;). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **completed** | **string**| Filtrování dopisů podle data realizování. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **category_id** | **int**| Filtrování dopisů podle ID kategorie. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování dopisů podle statusu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **owner_id** | **int**| Filtrování dopisů podle ID kontaktní osoby, která je vlastníkem dopisu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **person_filter** | **int**| Filtrování dopisů podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů. | [optional] |
| **company_context_filter** | **int**| Filtrování dopisů podle ID klienta, kterého se dopisy týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **lead_context_filter** | **int**| Filtrování dopisů podle ID leadu, kterého se dopisy týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů. | [optional] |
| **business_case** | **int**| Filtrování dopisů podle ID obchodního případu, kterého se dopisy týkají. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování dopisů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování dopisů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování dopisů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `letterInsert()`

```php
letterInsert($letter_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový dopis

Založení nového telefonátu

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


$apiInstance = new RaynetApiClient\Api\DopisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$letter_insert_dto = {"title":"Dopis příteli","priority":"DEFAULT","category":1,"owner":4,"person":2,"company":3,"scheduledFrom":"2022-06-11 15:00","scheduledTill":"2022-06-11 16:00","description":"Dobrý den příteli.","tags":["stitek 1","stitek 2"]}; // \RaynetApiClient\Model\LetterInsertDto

try {
    $result = $apiInstance->letterInsert($letter_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DopisApi->letterInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **letter_insert_dto** | [**\RaynetApiClient\Model\LetterInsertDto**](../Model/LetterInsertDto.md)|  | [optional] |

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
