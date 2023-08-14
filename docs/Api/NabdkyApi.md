# RaynetApiClient\NabdkyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**offerDelete()**](NabdkyApi.md#offerDelete) | **DELETE** /offer/{offerId}/ | smazání nabídky |
| [**offerDetailGet()**](NabdkyApi.md#offerDetailGet) | **GET** /offer/{offerId}/ | detail nabídky |
| [**offerEdit()**](NabdkyApi.md#offerEdit) | **POST** /offer/{offerId}/ | upravení nabídky |
| [**offerGet()**](NabdkyApi.md#offerGet) | **GET** /offer/ | seznam nabídek |
| [**offerInsert()**](NabdkyApi.md#offerInsert) | **PUT** /offer/ | nová nabídka |
| [**offerInvalidEdit()**](NabdkyApi.md#offerInvalidEdit) | **POST** /offer/{offerId}/invalid | zneplatnění nabídky |
| [**offerItemDelete()**](NabdkyApi.md#offerItemDelete) | **DELETE** /offer/{offerId}/item/{offerItemId}/ | smazání položky nabídky |
| [**offerItemEdit()**](NabdkyApi.md#offerItemEdit) | **POST** /offer/{offerId}/item/{offerItemId}/ | upravení položky nabídky |
| [**offerItemInsert()**](NabdkyApi.md#offerItemInsert) | **PUT** /offer/{offerId}/item/ | přidání položek nabídky |
| [**offerLockEdit()**](NabdkyApi.md#offerLockEdit) | **POST** /offer/{offerId}/lock | uzamčení nabídky |
| [**offerPdfExportDetailGet()**](NabdkyApi.md#offerPdfExportDetailGet) | **GET** /offer/{offerId}/pdfExport | export nabídky do PDF |
| [**offerSyncDelete()**](NabdkyApi.md#offerSyncDelete) | **DELETE** /offer/{offerId}/sync | zrušení synchronizace nabídky s obchodním případem |
| [**offerSyncEdit()**](NabdkyApi.md#offerSyncEdit) | **POST** /offer/{offerId}/sync | synchronizace nabídky s obchodním případem |
| [**offerUnlockEdit()**](NabdkyApi.md#offerUnlockEdit) | **POST** /offer/{offerId}/unlock | odemčení nabídky |
| [**offerValidEdit()**](NabdkyApi.md#offerValidEdit) | **POST** /offer/{offerId}/valid | obnovení platnosti nabídky |


## `offerDelete()`

```php
offerDelete($offer_id)
```

smazání nabídky



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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerDelete($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerDetailGet()`

```php
offerDetailGet($offer_id)
```

detail nabídky

Získání detailu nabídky. Pokud záznam nabídky obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/offerId/1/ ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerDetailGet($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerEdit()`

```php
offerEdit($offer_id, $offer_edit_dto)
```

upravení nabídky

Upravení dat nabídky.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky
$offer_edit_dto = {"name":"test","company":1,"businessCase":1,"owner":3,"totalAmount":123.5,"estimatedValue":11,"validFrom":"2022-11-08","description":"test","customFields":{"Popis_prio_c49d5":""}}; // \RaynetApiClient\Model\OfferEditDto

try {
    $apiInstance->offerEdit($offer_id, $offer_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |
| **offer_edit_dto** | [**\RaynetApiClient\Model\OfferEditDto**](../Model/OfferEditDto.md)|  | [optional] |

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

## `offerGet()`

```php
offerGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags)
```

seznam nabídek

Získání seznamu nabídek. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/offer/?offset=0&limit=1&name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = name; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$code = NAB-15-001; // string | Filtrování nabídek podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$name = RAY; // string | Filtrování nabídek podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 1; // int | Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id)
$person = 1; // int | Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id)
$business_case = 1; // int | Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id)
$owner = 1; // int | Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$expiration_date = 2022-06-01; // string | Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_from = 2022-06-01; // string | Filtrování nabídek podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_till = 2022-06-01; // string | Filtrování nabídek podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = E_WIN; // string | Filtrování nabídek podle skupiny stavu. Lze využít operátoru `EQ`, `NE`.  - `B_ACTIVE` otevřené nabídky,  - `E_WIN` vyhrané nabídky,  - `F_LOST` prohrané nabídky,  - `G_STORNO` stornované nabídky
$offer_status = 21; // int | Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$contains_product = 21; // int | Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor `CUSTOM`
$product_category = 21; // int | Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor `CUSTOM` a lze použít více hodnot `productCategory[CUSTOM]=1,2,3`
$product_line = 21; // int | Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor `CUSTOM` a lze použít více hodnot `productLine[CUSTOM]=1,2,3`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování nabídek podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování nabídek podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných nabídek. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->offerGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **code** | **string**| Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **name** | **string**| Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **int**| Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) | [optional] |
| **person** | **int**| Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) | [optional] |
| **business_case** | **int**| Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) | [optional] |
| **owner** | **int**| Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **expiration_date** | **string**| Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_from** | **string**| Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_till** | **string**| Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky | [optional] |
| **offer_status** | **int**| Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **contains_product** | **int**| Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; | [optional] |
| **product_category** | **int**| Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **product_line** | **int**| Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
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

## `offerInsert()`

```php
offerInsert($offer_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová nabídka

Založení nové nabídky

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_insert_dto = {"name":"test","company":1,"businessCase":1,"owner":3,"totalAmount":123.5,"estimatedValue":11,"validFrom":"2022-11-08","description":"test","offerStatus":35}; // \RaynetApiClient\Model\OfferInsertDto

try {
    $result = $apiInstance->offerInsert($offer_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_insert_dto** | [**\RaynetApiClient\Model\OfferInsertDto**](../Model/OfferInsertDto.md)|  | [optional] |

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

## `offerInvalidEdit()`

```php
offerInvalidEdit($offer_id)
```

zneplatnění nabídky

Zneplatnění záznamu nabídky.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerInvalidEdit($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerItemDelete()`

```php
offerItemDelete($offer_id, $offer_item_id)
```

smazání položky nabídky

Smazání položky na nabídkce  ``` https://app.raynet.cz/api/v2/offer/1/item/2/ ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky
$offer_item_id = 123; // int | ID položky nabídky

try {
    $apiInstance->offerItemDelete($offer_id, $offer_item_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerItemDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |
| **offer_item_id** | **int**| ID položky nabídky | |

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

## `offerItemEdit()`

```php
offerItemEdit($offer_id, $offer_item_id, $offer_item_edit_dto)
```

upravení položky nabídky

Upravení položky na nabídce.  ``` https://app.raynet.cz/api/v2/offer/1/item/2/ ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky
$offer_item_id = 123; // int | ID položky nabídky
$offer_item_edit_dto = {"name":"produkt 1","price":123,"taxRate":21,"count":2,"discountPercent":10.5,"cost":10,"unit":"ks","description":"poznamka k nabidce"}; // \RaynetApiClient\Model\OfferItemEditDto

try {
    $apiInstance->offerItemEdit($offer_id, $offer_item_id, $offer_item_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerItemEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |
| **offer_item_id** | **int**| ID položky nabídky | |
| **offer_item_edit_dto** | [**\RaynetApiClient\Model\OfferItemEditDto**](../Model/OfferItemEditDto.md)|  | [optional] |

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

## `offerItemInsert()`

```php
offerItemInsert($offer_id, $offer_item_insert_dto)
```

přidání položek nabídky

Přidání položek na nabídku. Položku je možno vytvořit dvojím způsobem: bez napojení na produkt (nekategorizovaný produkt) nebo položku s napojením na vybraný produkt. Pokud chci vytvořit napojenou položku, zadám do těla requestu parametr \"product\" (ID produktu) nebo \"productCode\" (kód produktu). Systém poté na zakladě zadané hodnoty produkt dohledá a na položku napojí. Pokud chci množinu produktů (pro dohledání) omezit pouze na nějaký konkrétní ceník, musím navíc zadat parametr \"priceList\" (ID vybraného ceníku). Pro nekategorizovaný produkt se žádný z výše uvedených parametrů nezadává, ale je potřeba vložit alespoň název produktu (\"name\").  ``` https://app.raynet.cz/api/v2/offerId/1/item/ ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky
$offer_item_insert_dto = {"productCode":"A001","name":"Muj produkt","priceList":2,"count":2,"price":123,"taxRate":21,"discountPercent":10.5,"cost":10,"description":"poznamka k produktu"}; // \RaynetApiClient\Model\OfferItemInsertDto

try {
    $apiInstance->offerItemInsert($offer_id, $offer_item_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerItemInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |
| **offer_item_insert_dto** | [**\RaynetApiClient\Model\OfferItemInsertDto**](../Model/OfferItemInsertDto.md)|  | [optional] |

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

## `offerLockEdit()`

```php
offerLockEdit($offer_id)
```

uzamčení nabídky

Uzamčení záznamu nabídky pro editaci.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerLockEdit($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerPdfExportDetailGet()`

```php
offerPdfExportDetailGet($offer_id, $locale)
```

export nabídky do PDF

Export nabídky do PDF. Konkrétně dojde k vytvoření dočasného souboru v CRM uložišti. K obsahu tohoto souboru je pak možné přistoupit prostřednictvím API /exportBody (Více v sekci: Soubory / Stažení těla exportu).  ``` https://app.raynet.cz/api/v2/offer/3/pdfExport ```

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky
$locale = en; // string | Jazyk exportované nabídky

try {
    $apiInstance->offerPdfExportDetailGet($offer_id, $locale);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerPdfExportDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |
| **locale** | **string**| Jazyk exportované nabídky | [optional] |

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

## `offerSyncDelete()`

```php
offerSyncDelete($offer_id)
```

zrušení synchronizace nabídky s obchodním případem

Vypne synchronizaci dané nabídky s navázaným obchodním případem.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerSyncDelete($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerSyncDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerSyncEdit()`

```php
offerSyncEdit($offer_id)
```

synchronizace nabídky s obchodním případem

Zapne synchronizaci dané nabídky s navázaným obchodním případem. Ukončí synchronizaci ostatních nabídek / objednávek, pokud je u nich zapnutá. Nakonec zaktualizuje položky obchodního případu tak, aby odpovídaly položkám zadané nabídky.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerSyncEdit($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerSyncEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerUnlockEdit()`

```php
offerUnlockEdit($offer_id)
```

odemčení nabídky

Odemčení záznamu nabídky k editaci.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerUnlockEdit($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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

## `offerValidEdit()`

```php
offerValidEdit($offer_id)
```

obnovení platnosti nabídky

Obnovení platnosti záznamu nabídky.

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


$apiInstance = new RaynetApiClient\Api\NabdkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 123; // int | ID nabídky

try {
    $apiInstance->offerValidEdit($offer_id);
} catch (Exception $e) {
    echo 'Exception when calling NabdkyApi->offerValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offer_id** | **int**| ID nabídky | |

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
