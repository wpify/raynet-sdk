# RaynetApiClient\ObjednvkyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**salesOrderDelete()**](ObjednvkyApi.md#salesOrderDelete) | **DELETE** /salesOrder/{salesOrderId}/ | smazání objednávky |
| [**salesOrderDetailGet()**](ObjednvkyApi.md#salesOrderDetailGet) | **GET** /salesOrder/{salesOrderId}/ | detail objednávky |
| [**salesOrderEdit()**](ObjednvkyApi.md#salesOrderEdit) | **POST** /salesOrder/{salesOrderId}/ | upravení objednávky |
| [**salesOrderGet()**](ObjednvkyApi.md#salesOrderGet) | **GET** /salesOrder/ | seznam objednávek |
| [**salesOrderInsert()**](ObjednvkyApi.md#salesOrderInsert) | **PUT** /salesOrder/ | nová objednávka |
| [**salesOrderInvalidEdit()**](ObjednvkyApi.md#salesOrderInvalidEdit) | **POST** /salesOrder/{salesOrderId}/invalid | zneplatnění objednávky |
| [**salesOrderItemDelete()**](ObjednvkyApi.md#salesOrderItemDelete) | **DELETE** /salesOrder/{salesOrderId}/item/{salesOrderItemId}/ | smazání položky objednávky |
| [**salesOrderItemEdit()**](ObjednvkyApi.md#salesOrderItemEdit) | **POST** /salesOrder/{salesOrderId}/item/{salesOrderItemId}/ | upravení položky objednávky |
| [**salesOrderItemInsert()**](ObjednvkyApi.md#salesOrderItemInsert) | **PUT** /salesOrder/{salesOrderId}/item/ | přidání položek objednávky |
| [**salesOrderLockEdit()**](ObjednvkyApi.md#salesOrderLockEdit) | **POST** /salesOrder/{salesOrderId}/lock | uzamčení objednávky |
| [**salesOrderPdfExportDetailGet()**](ObjednvkyApi.md#salesOrderPdfExportDetailGet) | **GET** /salesOrder/{salesOrderId}/pdfExport | export objednávky do PDF |
| [**salesOrderSyncDelete()**](ObjednvkyApi.md#salesOrderSyncDelete) | **DELETE** /salesOrder/{salesOrderId}/sync | zrušení synchronizace objednávky s obchodním případem |
| [**salesOrderSyncEdit()**](ObjednvkyApi.md#salesOrderSyncEdit) | **POST** /salesOrder/{salesOrderId}/sync | synchronizace objednávky s obchodním případem |
| [**salesOrderUnlockEdit()**](ObjednvkyApi.md#salesOrderUnlockEdit) | **POST** /salesOrder/{salesOrderId}/unlock | odemčení objednávky |
| [**salesOrderValidEdit()**](ObjednvkyApi.md#salesOrderValidEdit) | **POST** /salesOrder/{salesOrderId}/valid | obnovení platnosti objednávky |


## `salesOrderDelete()`

```php
salesOrderDelete($sales_order_id)
```

smazání objednávky



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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderDelete($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderDetailGet()`

```php
salesOrderDetailGet($sales_order_id)
```

detail objednávky

Získání detailu objednávky. Pokud záznam objednávky obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/salesOrder/1/ ```

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderDetailGet($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderEdit()`

```php
salesOrderEdit($sales_order_id, $sales_order_edit_dto)
```

upravení objednávky

Upravení dat objednávky.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky
$sales_order_edit_dto = {"name":"test","company":1,"businessCase":1,"offer":4,"owner":3,"totalAmount":123.5,"estimatedValue":11,"validFrom":"2022-11-08","description":"test","salesOrderStatus":54,"deliveryAddress":{"name":"RAYNET Praha s.r.o.","city":"Praha","country":"CZ","province":"Praha","street":"Albertov 2038/6","zipCode":"128 00"},"invoiceAddress":{"name":"RAYNET s.r.o.","city":"Ostrava-Poruba","country":"CZ","province":"Moravskoslezský kraj","street":"Francouzská 6167/5","zipCode":"708 00"},"customFields":{"Popis_prio_c49d5":""}}; // \RaynetApiClient\Model\SalesOrderEditDto

try {
    $apiInstance->salesOrderEdit($sales_order_id, $sales_order_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |
| **sales_order_edit_dto** | [**\RaynetApiClient\Model\SalesOrderEditDto**](../Model/SalesOrderEditDto.md)|  | [optional] |

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

## `salesOrderGet()`

```php
salesOrderGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags)
```

seznam objednávek

Získání seznamu objednávek. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/salesOrder/?offset=0&limit=1&name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
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
$code = OP-15-001; // string | Filtrování objednávek podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$name = RAY; // string | Filtrování objednávek podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 1; // int | Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id)
$person = 1; // int | Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id)
$business_case = 1; // int | Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id)
$owner = 1; // int | Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$expiration_date = 2022-06-01; // string | Filtrování objednávek podle data dodání. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$request_delivery_date = 2022-06-01; // string | Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_from = 2022-06-01; // string | Filtrování objednávek podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_till = 2022-06-01; // string | Filtrování objednávek podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = E_WIN; // string | Filtrování OP podle skupiny stavu. Lze využít operátoru `EQ`, `NE`. - `B_ACTIVE` otevřené nabídky, - `E_WIN` vyhrané nabídky, - `F_LOST` prohrané nabídky, - `G_STORNO` stornované nabídky
$sales_order_status = 21; // int | Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$contains_product = 21; // int | Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor `CUSTOM`
$product_category = 21; // int | Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor `CUSTOM` a lze použít více hodnot `productCategory[CUSTOM]=1,2,3`
$product_line = 21; // int | Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor `CUSTOM` a lze použít více hodnot `productLine[CUSTOM]=1,2,3`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování objednávek podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování objednávek podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných objednávek. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->salesOrderGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderGet: ', $e->getMessage(), PHP_EOL;
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
| **code** | **string**| Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **name** | **string**| Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **int**| Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) | [optional] |
| **person** | **int**| Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) | [optional] |
| **business_case** | **int**| Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) | [optional] |
| **owner** | **int**| Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **expiration_date** | **string**| Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **request_delivery_date** | **string**| Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_from** | **string**| Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_till** | **string**| Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky | [optional] |
| **sales_order_status** | **int**| Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **contains_product** | **int**| Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; | [optional] |
| **product_category** | **int**| Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **product_line** | **int**| Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
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

## `salesOrderInsert()`

```php
salesOrderInsert($sales_order_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová objednávka

Založení nové objednávky

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_insert_dto = {"name":"test","company":1,"businessCase":1,"offer":4,"owner":3,"totalAmount":123.5,"estimatedValue":11,"validFrom":"2022-11-08","description":"test","salesOrderStatus":74}; // \RaynetApiClient\Model\SalesOrderInsertDto

try {
    $result = $apiInstance->salesOrderInsert($sales_order_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_insert_dto** | [**\RaynetApiClient\Model\SalesOrderInsertDto**](../Model/SalesOrderInsertDto.md)|  | [optional] |

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

## `salesOrderInvalidEdit()`

```php
salesOrderInvalidEdit($sales_order_id)
```

zneplatnění objednávky

Zneplatnění záznamu objednávky.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderInvalidEdit($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderItemDelete()`

```php
salesOrderItemDelete($sales_order_id, $sales_order_item_id)
```

smazání položky objednávky

Smazání položky na nabídkce

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky
$sales_order_item_id = 123; // int | ID položky objednávky

try {
    $apiInstance->salesOrderItemDelete($sales_order_id, $sales_order_item_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderItemDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |
| **sales_order_item_id** | **int**| ID položky objednávky | |

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

## `salesOrderItemEdit()`

```php
salesOrderItemEdit($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto)
```

upravení položky objednávky

Upravení položky na nabídce.  ``` https://app.raynet.cz/api/v2/salesOrder/1/item/2/ ```

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky
$sales_order_item_id = 123; // int | ID položky objednávky
$sales_order_item_edit_dto = {"name":"produkt 1","price":123,"taxRate":21,"count":2,"discountPercent":10.5,"cost":10,"unit":"ks","description":"poznamka k produktu"}; // \RaynetApiClient\Model\SalesOrderItemEditDto

try {
    $apiInstance->salesOrderItemEdit($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderItemEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |
| **sales_order_item_id** | **int**| ID položky objednávky | |
| **sales_order_item_edit_dto** | [**\RaynetApiClient\Model\SalesOrderItemEditDto**](../Model/SalesOrderItemEditDto.md)|  | [optional] |

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

## `salesOrderItemInsert()`

```php
salesOrderItemInsert($sales_order_id, $sales_order_item_insert_dto)
```

přidání položek objednávky

Přidání položek na objednávku. Položku je možno vytvořit dvojím způsobem: bez napojení na produkt (nekategorizovaný produkt) nebo položku s napojením na vybraný produkt. Pokud chci vytvořit napojenou položku, zadám do těla requestu parametr \"product\" (ID produktu) nebo \"productCode\" (kód produktu). Systém poté na zakladě zadané hodnoty produkt dohledá a na položku napojí. Pokud chci množinu produktů (pro dohledání) omezit pouze na nějaký konkrétní ceník, musím navíc zadat parametr \"priceList\" (ID vybraného ceníku). Pro nekategorizovaný produkt se žádný z výše uvedených parametrů nezadává, ale je potřeba vložit alespoň název produktu (\"name\").  ``` https://app.raynet.cz/api/v2/salesOrder/1/item/ ```

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky
$sales_order_item_insert_dto = {"productCode":"A001","name":"Muj produkt","priceList":2,"count":2,"price":123,"taxRate":21,"discountPercent":10.5,"cost":10,"description":"poznamka k produktu"}; // \RaynetApiClient\Model\SalesOrderItemInsertDto

try {
    $apiInstance->salesOrderItemInsert($sales_order_id, $sales_order_item_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderItemInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |
| **sales_order_item_insert_dto** | [**\RaynetApiClient\Model\SalesOrderItemInsertDto**](../Model/SalesOrderItemInsertDto.md)|  | [optional] |

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

## `salesOrderLockEdit()`

```php
salesOrderLockEdit($sales_order_id)
```

uzamčení objednávky

Uzamčení záznamu objednávky pro editaci.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderLockEdit($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderPdfExportDetailGet()`

```php
salesOrderPdfExportDetailGet($sales_order_id, $locale)
```

export objednávky do PDF

Export objednávky do PDF. Konkrétně dojde k vytvoření dočasného souboru v CRM uložišti. K obsahu tohoto souboru je pak možné přistoupit prostřednictvím API /exportBody (Více v sekci: Soubory / Stažení těla exportu).  ``` https://app.raynet.cz/api/v2/salesOrder/3/pdfExport ```

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky
$locale = en; // string | Jazyk exportované objednávky

try {
    $apiInstance->salesOrderPdfExportDetailGet($sales_order_id, $locale);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderPdfExportDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |
| **locale** | **string**| Jazyk exportované objednávky | [optional] |

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

## `salesOrderSyncDelete()`

```php
salesOrderSyncDelete($sales_order_id)
```

zrušení synchronizace objednávky s obchodním případem

Vypne synchronizaci dané objednávky s navázaným obchodním případem.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderSyncDelete($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderSyncDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderSyncEdit()`

```php
salesOrderSyncEdit($sales_order_id)
```

synchronizace objednávky s obchodním případem

Zapne synchronizaci dané objednávky s navázaným obchodním případem. Ukončí synchronizaci ostatních nabídek / objednávek, pokud je u nich zapnutá. Nakonec zaktualizuje položky obchodního případu tak, aby odpovídaly položkám zadané objednávky.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderSyncEdit($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderSyncEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderUnlockEdit()`

```php
salesOrderUnlockEdit($sales_order_id)
```

odemčení objednávky

Odemčení záznamu objednávky k editaci.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderUnlockEdit($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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

## `salesOrderValidEdit()`

```php
salesOrderValidEdit($sales_order_id)
```

obnovení platnosti objednávky

Obnovení platnosti záznamu objednávky.

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


$apiInstance = new RaynetApiClient\Api\ObjednvkyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sales_order_id = 123; // int | ID objednávky

try {
    $apiInstance->salesOrderValidEdit($sales_order_id);
} catch (Exception $e) {
    echo 'Exception when calling ObjednvkyApi->salesOrderValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sales_order_id** | **int**| ID objednávky | |

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
