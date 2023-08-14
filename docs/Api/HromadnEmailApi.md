# RaynetApiClient\HromadnEmailApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**massEmailDelete()**](HromadnEmailApi.md#massEmailDelete) | **DELETE** /massEmail/{massEmailId}/ | smazání hromadného emailu |
| [**massEmailDetailGet()**](HromadnEmailApi.md#massEmailDetailGet) | **GET** /massEmail/{massEmailId}/ | detail hromadného emailu |
| [**massEmailEdit()**](HromadnEmailApi.md#massEmailEdit) | **POST** /massEmail/{massEmailId}/ | upravení hromadného emailu |
| [**massEmailGet()**](HromadnEmailApi.md#massEmailGet) | **GET** /massEmail/ | seznam hromadných emailů |
| [**massEmailInsert()**](HromadnEmailApi.md#massEmailInsert) | **PUT** /massEmail/ | založení nového hromadného emailu |
| [**massEmailRecipientBulkDeleteEdit()**](HromadnEmailApi.md#massEmailRecipientBulkDeleteEdit) | **POST** /massEmail/{massEmailId}/recipientBulkDelete/ | smazání adresátů hromadného emailu |
| [**massEmailRecipientBulkUpdateEdit()**](HromadnEmailApi.md#massEmailRecipientBulkUpdateEdit) | **POST** /massEmail/{massEmailId}/recipientBulkUpdate/ | vložení/upravení adresátů hromadného emailu |
| [**massEmailRecipientDelete()**](HromadnEmailApi.md#massEmailRecipientDelete) | **DELETE** /massEmail/{massEmailId}/recipient/{recipientId}/ | smazání adresáta hromadného emailu |
| [**massEmailRecipientDetailGet()**](HromadnEmailApi.md#massEmailRecipientDetailGet) | **GET** /massEmail/{massEmailId}/recipient/ | seznam adresátů hromadného emailu |
| [**massEmailRecipientEdit()**](HromadnEmailApi.md#massEmailRecipientEdit) | **POST** /massEmail/{massEmailId}/recipient/{recipientId}/ | upravení adresáta hromadného emailu |
| [**massEmailRecipientInsert()**](HromadnEmailApi.md#massEmailRecipientInsert) | **PUT** /massEmail/{massEmailId}/recipient/ | přidání adresáta hromadného emailu |


## `massEmailDelete()`

```php
massEmailDelete($mass_email_id)
```

smazání hromadného emailu



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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu

try {
    $apiInstance->massEmailDelete($mass_email_id);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |

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

## `massEmailDetailGet()`

```php
massEmailDetailGet($mass_email_id)
```

detail hromadného emailu

Získání detailu hromadného emailu.  ``` https://app.raynet.cz/api/v2/massEmail/3/ ```

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu

try {
    $apiInstance->massEmailDetailGet($mass_email_id);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |

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

## `massEmailEdit()`

```php
massEmailEdit($mass_email_id, $mass_email_edit_dto)
```

upravení hromadného emailu

Upravení dat hromadného emailu.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$mass_email_edit_dto = {"title":"Druhá emailová kampaň","completed":"2022-01-29 10:00","description":"Druhá testovací kampaň pro VIP členy organizace","tags":["VIP","Test"],"campaignName":"Druhá emailová kampaň SparkPost","source":"SPARKPOST","externalId":"656464568","externalOverviewUrl":"https://www.sparkpost.com/656464568/Overview","externalThumbnailUrl":"https://www.sparkpost.com/656464568/Thumbnail","stats":{"sent":500,"clicked":300,"opened":400,"unsubscribed":200}}; // \RaynetApiClient\Model\MassEmailEditDto

try {
    $apiInstance->massEmailEdit($mass_email_id, $mass_email_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **mass_email_edit_dto** | [**\RaynetApiClient\Model\MassEmailEditDto**](../Model/MassEmailEditDto.md)|  | [optional] |

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

## `massEmailGet()`

```php
massEmailGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam hromadných emailů



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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Od kterého záznamu v pořadí seznam zobrazit (stránkování)
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = title; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$title = První; // string | Filtrování hromadných emailů podle názvu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$tags = VIP; // string | Filtrování hromadných emailů podle štítků. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$completed = 2022-06-01; // string | Filtrování hromadných emailů podle data odeslání. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$campaign_name = První; // string | Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$source = SPARKPOST; // string | Filtrování hromadných emailů podle zdroje. Lze využít operátoru `EQ`, `NE`.
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->massEmailGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Od kterého záznamu v pořadí seznam zobrazit (stránkování) | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **title** | **string**| Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **tags** | **string**| Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **completed** | **string**| Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **campaign_name** | **string**| Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **source** | **string**| Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |
| **row_info_created_at** | **string**| Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `massEmailInsert()`

```php
massEmailInsert($mass_email_insert_dto): \RaynetApiClient\Model\Insert201Response
```

založení nového hromadného emailu



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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_insert_dto = {"title":"Druhá emailová kampaň","completed":"2022-01-29 10:00","description":"Druhá testovací kampaň pro VIP členy organizace","tags":["VIP","Test"],"campaignName":"Druhá emailová kampaň SparkPost","source":"SPARKPOST","externalId":"656464568","externalOverviewUrl":"https://www.sparkpost.com/656464568/Overview","externalThumbnailUrl":"https://www.sparkpost.com/656464568/Thumbnail","stats":{"sent":500,"clicked":300,"opened":400,"unsubscribed":200}}; // \RaynetApiClient\Model\MassEmailInsertDto

try {
    $result = $apiInstance->massEmailInsert($mass_email_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_insert_dto** | [**\RaynetApiClient\Model\MassEmailInsertDto**](../Model/MassEmailInsertDto.md)|  | [optional] |

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

## `massEmailRecipientBulkDeleteEdit()`

```php
massEmailRecipientBulkDeleteEdit($mass_email_id, $request_body)
```

smazání adresátů hromadného emailu

Hromadné smazání adresátů hromadného emailu podle emailové adresy. Budou smazáni všichni adresáti dohledáni podle emailu.  Maximální počet adres ke smazání, které lze zaslat je 1000.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$request_body = ["info@klient.cz","kontakty@uslunce.com"]; // string[]

try {
    $apiInstance->massEmailRecipientBulkDeleteEdit($mass_email_id, $request_body);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientBulkDeleteEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **request_body** | [**string[]**](../Model/string.md)|  | [optional] |

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

## `massEmailRecipientBulkUpdateEdit()`

```php
massEmailRecipientBulkUpdateEdit($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner): mixed
```

vložení/upravení adresátů hromadného emailu

Hromadné vložení nebo upravení adresátů hromadného emailu (upsert). Podle emailu bude buď upraven záznam adresáta nebo bude do hromadného emailu vložen nový adresát. Nový adresát se dohledá v adresáři (Klienti, Kontaktní osoby, Leady) podle zadaného emailu vždy v obou možných polích (email, email2). Pokud nebude adresát dohledán, nebude do hromadného emailu založen. Jestliže bude email dohledán u více kontaktů, budou do hromadného emailu přidány všechny entity.  Maximální počet adres k úpravě/přidání, které lze zaslat jedním požadavkem je 1000.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$mass_email_recipient_bulk_update_edit_dto_inner = [{"email":"info@klient.cz","status":"DELIVERED","opened":"2022-01-29","clicked":"2022-01-30","unsubscribed":"2022-01-31"},{"email":"kontakty@uslunce.cz","status":"SENT","opened":"2022-01-29","clicked":"2022-01-30","unsubscribed":"2022-01-31"}]; // \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[]

try {
    $result = $apiInstance->massEmailRecipientBulkUpdateEdit($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientBulkUpdateEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **mass_email_recipient_bulk_update_edit_dto_inner** | [**\RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[]**](../Model/MassEmailRecipientBulkUpdateEditDtoInner.md)|  | [optional] |

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

## `massEmailRecipientDelete()`

```php
massEmailRecipientDelete($mass_email_id, $recipient_id)
```

smazání adresáta hromadného emailu

Smazání adresáta hromadného emailu.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$recipient_id = 123; // int | ID adresáta

try {
    $apiInstance->massEmailRecipientDelete($mass_email_id, $recipient_id);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **recipient_id** | **int**| ID adresáta | |

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

## `massEmailRecipientDetailGet()`

```php
massEmailRecipientDetailGet($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam adresátů hromadného emailu

Získání seznamu adresátů hromadného emailu. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$offset = 0; // int | Od kterého záznamu v pořadí seznam zobrazit (stránkování)
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$company = 3; // string | Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person = 3; // string | Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$lead = 3; // string | Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = SENT; // string | Filtrování adresátů podle stavu odeslání. Lze využít operátoru `EQ`, `NE`.
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->massEmailRecipientDetailGet($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **offset** | **int**| Od kterého záznamu v pořadí seznam zobrazit (stránkování) | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **company** | **string**| Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **person** | **string**| Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **lead** | **string**| Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. | [optional] |
| **row_info_created_at** | **string**| Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `massEmailRecipientEdit()`

```php
massEmailRecipientEdit($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto)
```

upravení adresáta hromadného emailu

Upravení adresáta hromadného emailu.

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$recipient_id = 123; // int | ID adresáta
$mass_email_recipient_edit_dto = {"person":4,"status":"DELIVERED","email":"info@klient.cz","opened":"2022-01-29","clicked":"2022-01-30","unsubscribed":"2022-01-31"}; // \RaynetApiClient\Model\MassEmailRecipientEditDto

try {
    $apiInstance->massEmailRecipientEdit($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **recipient_id** | **int**| ID adresáta | |
| **mass_email_recipient_edit_dto** | [**\RaynetApiClient\Model\MassEmailRecipientEditDto**](../Model/MassEmailRecipientEditDto.md)|  | [optional] |

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

## `massEmailRecipientInsert()`

```php
massEmailRecipientInsert($mass_email_id, $mass_email_recipient_insert_dto)
```

přidání adresáta hromadného emailu

Přidání adresáta, kterému byl hromadný email odeslán (resp. bude odeslán).

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


$apiInstance = new RaynetApiClient\Api\HromadnEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mass_email_id = 123; // int | ID hromadného emailu
$mass_email_recipient_insert_dto = {"person":4,"status":"DELIVERED","email":"Text emailu","opened":"2022-01-29","clicked":"2022-01-30","unsubscribed":"2022-01-31"}; // \RaynetApiClient\Model\MassEmailRecipientInsertDto

try {
    $apiInstance->massEmailRecipientInsert($mass_email_id, $mass_email_recipient_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling HromadnEmailApi->massEmailRecipientInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mass_email_id** | **int**| ID hromadného emailu | |
| **mass_email_recipient_insert_dto** | [**\RaynetApiClient\Model\MassEmailRecipientInsertDto**](../Model/MassEmailRecipientInsertDto.md)|  | [optional] |

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
