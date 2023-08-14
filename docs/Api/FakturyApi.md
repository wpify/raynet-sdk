# RaynetApiClient\FakturyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**invoiceCancelEdit()**](FakturyApi.md#invoiceCancelEdit) | **POST** /invoice/{invoiceId}/cancel | stornovat fakturu |
| [**invoiceChangeCodeEdit()**](FakturyApi.md#invoiceChangeCodeEdit) | **POST** /invoice/{invoiceId}/changeCode | změna kódu faktury |
| [**invoiceChangeDecimalPrecisionEdit()**](FakturyApi.md#invoiceChangeDecimalPrecisionEdit) | **POST** /invoice/{invoiceId}/changeDecimalPrecision | změna počtu desetinných míst |
| [**invoiceCreditNoteInsert()**](FakturyApi.md#invoiceCreditNoteInsert) | **PUT** /invoice/creditNote | nový dobropis |
| [**invoiceDelete()**](FakturyApi.md#invoiceDelete) | **DELETE** /invoice/{invoiceId}/ | smazání faktury |
| [**invoiceDetailGet()**](FakturyApi.md#invoiceDetailGet) | **GET** /invoice/{invoiceId}/ | detail faktury |
| [**invoiceEdit()**](FakturyApi.md#invoiceEdit) | **POST** /invoice/{invoiceId}/ | upravení faktury |
| [**invoiceGet()**](FakturyApi.md#invoiceGet) | **GET** /invoice/ | seznam faktur |
| [**invoiceInsert()**](FakturyApi.md#invoiceInsert) | **PUT** /invoice/ | nová faktura |
| [**invoiceLockEdit()**](FakturyApi.md#invoiceLockEdit) | **POST** /invoice/{invoiceId}/lock | uzamčení faktury |
| [**invoicePaymentDelete()**](FakturyApi.md#invoicePaymentDelete) | **DELETE** /invoice/{invoiceId}/payment/{paymentId}/ | smazání platby |
| [**invoicePaymentInsert()**](FakturyApi.md#invoicePaymentInsert) | **PUT** /invoice/{invoiceId}/payment/ | přidání platby |
| [**invoicePdfExportDetailGet()**](FakturyApi.md#invoicePdfExportDetailGet) | **GET** /invoice/{invoiceId}/pdfExport | export faktury do PDF |
| [**invoiceRenewEdit()**](FakturyApi.md#invoiceRenewEdit) | **POST** /invoice/{invoiceId}/renew | obnovení faktury |
| [**invoiceUnlockEdit()**](FakturyApi.md#invoiceUnlockEdit) | **POST** /invoice/{invoiceId}/unlock | odemčení faktury |


## `invoiceCancelEdit()`

```php
invoiceCancelEdit($invoice_id)
```

stornovat fakturu

Stornování faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceCancelEdit($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceCancelEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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

## `invoiceChangeCodeEdit()`

```php
invoiceChangeCodeEdit($invoice_id, $invoice_change_code_edit_request)
```

změna kódu faktury

Změna kódu faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$invoice_change_code_edit_request = {"code":"FV12313"}; // \RaynetApiClient\Model\InvoiceChangeCodeEditRequest

try {
    $apiInstance->invoiceChangeCodeEdit($invoice_id, $invoice_change_code_edit_request);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceChangeCodeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **invoice_change_code_edit_request** | [**\RaynetApiClient\Model\InvoiceChangeCodeEditRequest**](../Model/InvoiceChangeCodeEditRequest.md)|  | [optional] |

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

## `invoiceChangeDecimalPrecisionEdit()`

```php
invoiceChangeDecimalPrecisionEdit($invoice_id, $invoice_change_decimal_precision_edit_dto)
```

změna počtu desetinných míst

Změna počtu desetinných míst faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$invoice_change_decimal_precision_edit_dto = {"decimalPrecision":2}; // \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto

try {
    $apiInstance->invoiceChangeDecimalPrecisionEdit($invoice_id, $invoice_change_decimal_precision_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceChangeDecimalPrecisionEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **invoice_change_decimal_precision_edit_dto** | [**\RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto**](../Model/InvoiceChangeDecimalPrecisionEditDto.md)|  | [optional] |

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

## `invoiceCreditNoteInsert()`

```php
invoiceCreditNoteInsert($invoice_credit_note_insert_dto)
```

nový dobropis

Založení nového dobropisu

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_credit_note_insert_dto = {"invoiceId":1,"reason":"Dobropis, špatně vystavená faktura"}; // \RaynetApiClient\Model\InvoiceCreditNoteInsertDto

try {
    $apiInstance->invoiceCreditNoteInsert($invoice_credit_note_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceCreditNoteInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_credit_note_insert_dto** | [**\RaynetApiClient\Model\InvoiceCreditNoteInsertDto**](../Model/InvoiceCreditNoteInsertDto.md)|  | [optional] |

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

## `invoiceDelete()`

```php
invoiceDelete($invoice_id)
```

smazání faktury



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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceDelete($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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

## `invoiceDetailGet()`

```php
invoiceDetailGet($invoice_id)
```

detail faktury

Získání detailu faktury.  ``` https://app.raynet.cz/api/v2/invoice/1/ ```

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceDetailGet($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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

## `invoiceEdit()`

```php
invoiceEdit($invoice_id, $invoice_edit_dto)
```

upravení faktury

Upravení dat faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$invoice_edit_dto = {"company":1,"title":"Faktura za dobrou radu","constantSymbol":"0308","currency":15,"dueDate":"2022-10-16","invoiceType":"NORMAL","issueDate":"2022-10-02","paymentTermDays":14,"paymentType":"PAYMENT_DIRECT_DEBIT","securityLevel":1,"specificSymbol":"","taxableSupplyDate":"2022-10-02","businessCase":5,"vendorName":"RAYNET s.r.o.","vendorRegNumber":"26843820","vendorTaxNumber":"CZ26843820","vendorAddress":{"street":"Francouzská 6167/5","city":"Ostrava","zipCode":"708 00","country":"CZ","province":"Moravskoslezský kraj"},"vendorEmail":"info@raynet.cz","vendorFax":"","vendorPhoneNumber":"800 101 201","vendorWebsite":"www.raynet.cz","vendorBankName":"ČSOB","vendorBankAccountNumber":"11555511/0300","vendorBankIban":"CZ05 0300 0000 0000 1155 5511","vendorBankSwift":"CEKOCZPP","vendorBusinessRegisterNote":"Krajský obchodní soud v Ostravě, oddíl C, vložka 28180","billingName":"RAYNET s.r.o.","billingRegNumber":"26843820","billingTaxNumber":"CZ26843820","billingAddress":{"street":"Francouzská 6167/5","city":"Ostrava","zipCode":"708 00","country":"CZ","province":"Moravskoslezský kraj"},"items":[{"name":"položka 1","unitPrice":123,"taxRate":21,"amount":2,"unitLabel":"ks","discountPercent":0},{"id":2,"name":"položka 2","unitPrice":123,"taxRate":21,"amount":2,"unitLabel":"ks","discountPercent":10}]}; // \RaynetApiClient\Model\InvoiceEditDto

try {
    $apiInstance->invoiceEdit($invoice_id, $invoice_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **invoice_edit_dto** | [**\RaynetApiClient\Model\InvoiceEditDto**](../Model/InvoiceEditDto.md)|  | [optional] |

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

## `invoiceGet()`

```php
invoiceGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags)
```

seznam faktur

Získání seznamu faktur. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/invoice/?offset=0&limit=1&title[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených faktur je `1000`
$sort_column = title; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$title = RAY; // string | Filtrování faktur podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$code = 12345678; // string | Filtrování faktur podle kódu faktury. Lze využít operátoru `EQ`, `NE`, `LIKE`. Výchozím operátorem je `EQ`.
$company = 1; // int | Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id)
$owner = 1; // int | Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$business_case = 1; // int | Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id)
$issue_date = 2022-01-01; // string | Filtrování faktur podle data vystavení.
$invoice_type = NORMAL; // string | Filtrování faktur podle typu. Hodnoty jsou: `NORMAL`, `PROFORMA`, `CREDIT_NOTE`. Lze využít operátoru `EQ`, `NE`, `IN`. Výchozím operátorem je `EQ`.
$taxable_supply_date = 2022-01-01; // string | Filtrování faktur podle data zdanitelného plnění.
$due_date = 2022-01-01; // string | Filtrování faktur podle data splatnosti.
$payment_date = 2022-01-01; // string | Filtrování faktur podle data uhrazení.
$variable_symbol = 123456; // string | Filtrování faktur podle variabilního symbolu. Lze využít operátoru `EQ`, `NE`, `LIKE`
$specific_symbol = 123456; // string | Filtrování faktur podle specifického symbolu. Lze využít operátoru `EQ`, `NE`, `LIKE`
$constant_symbol = 0308; // string | Filtrování faktur podle konstantního symbolu. Lze využít operátoru `EQ`, `NE`, `LIKE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování faktur podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování faktur podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->invoiceGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených faktur je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **title** | **string**| Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **code** | **string**| Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. | [optional] |
| **company** | **int**| Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) | [optional] |
| **owner** | **int**| Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **business_case** | **int**| Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) | [optional] |
| **issue_date** | **string**| Filtrování faktur podle data vystavení. | [optional] |
| **invoice_type** | **string**| Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. | [optional] |
| **taxable_supply_date** | **string**| Filtrování faktur podle data zdanitelného plnění. | [optional] |
| **due_date** | **string**| Filtrování faktur podle data splatnosti. | [optional] |
| **payment_date** | **string**| Filtrování faktur podle data uhrazení. | [optional] |
| **variable_symbol** | **string**| Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; | [optional] |
| **specific_symbol** | **string**| Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; | [optional] |
| **constant_symbol** | **string**| Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `invoiceInsert()`

```php
invoiceInsert($invoice_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nová faktura

Založení nové faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_insert_dto = {"company":1,"title":"Faktura za dobrou radu","constantSymbol":"0308","currency":15,"dueDate":"2022-10-16","invoiceType":"NORMAL","issueDate":"2022-10-02","paymentTermDays":14,"paymentType":"PAYMENT_DIRECT_DEBIT","securityLevel":1,"specificSymbol":"","taxableSupplyDate":"2022-10-02","businessCase":4}; // \RaynetApiClient\Model\InvoiceInsertDto

try {
    $result = $apiInstance->invoiceInsert($invoice_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_insert_dto** | [**\RaynetApiClient\Model\InvoiceInsertDto**](../Model/InvoiceInsertDto.md)|  | [optional] |

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

## `invoiceLockEdit()`

```php
invoiceLockEdit($invoice_id)
```

uzamčení faktury

Uzamčení záznamu faktury pro editaci.

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceLockEdit($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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

## `invoicePaymentDelete()`

```php
invoicePaymentDelete($invoice_id, $payment_id)
```

smazání platby

Smazání platby u faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$payment_id = 123; // int | ID platby

try {
    $apiInstance->invoicePaymentDelete($invoice_id, $payment_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoicePaymentDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **payment_id** | **int**| ID platby | |

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

## `invoicePaymentInsert()`

```php
invoicePaymentInsert($invoice_id, $invoice_payment_insert_dto)
```

přidání platby

Přidání platby k faktuře

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$invoice_payment_insert_dto = {"amount":123.5,"date":"2022-06-01"}; // \RaynetApiClient\Model\InvoicePaymentInsertDto

try {
    $apiInstance->invoicePaymentInsert($invoice_id, $invoice_payment_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoicePaymentInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **invoice_payment_insert_dto** | [**\RaynetApiClient\Model\InvoicePaymentInsertDto**](../Model/InvoicePaymentInsertDto.md)|  | [optional] |

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

## `invoicePdfExportDetailGet()`

```php
invoicePdfExportDetailGet($invoice_id, $locale)
```

export faktury do PDF

Export faktury do PDF. Konkrétně dojde k vytvoření dočasného souboru v CRM uložišti. K obsahu tohoto souboru je pak možné přistoupit prostřednictvím API /exportBody (Více v sekci: Soubory / Stažení těla exportu).

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury
$locale = en; // string | Jazyk exportované faktury

try {
    $apiInstance->invoicePdfExportDetailGet($invoice_id, $locale);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoicePdfExportDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |
| **locale** | **string**| Jazyk exportované faktury | [optional] |

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

## `invoiceRenewEdit()`

```php
invoiceRenewEdit($invoice_id)
```

obnovení faktury

Obnovení stornované faktury

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceRenewEdit($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceRenewEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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

## `invoiceUnlockEdit()`

```php
invoiceUnlockEdit($invoice_id)
```

odemčení faktury

Odemčení záznamu faktury k editaci.

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


$apiInstance = new RaynetApiClient\Api\FakturyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 123; // int | ID faktury

try {
    $apiInstance->invoiceUnlockEdit($invoice_id);
} catch (Exception $e) {
    echo 'Exception when calling FakturyApi->invoiceUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **int**| ID faktury | |

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
