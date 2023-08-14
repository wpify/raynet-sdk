# RaynetApiClient\ObchodnPpadyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**businessCaseCreateWithItemsInsert()**](ObchodnPpadyApi.md#businessCaseCreateWithItemsInsert) | **PUT** /businessCase/createWithItems | nový OP s produkty |
| [**businessCaseDelete()**](ObchodnPpadyApi.md#businessCaseDelete) | **DELETE** /businessCase/{businessCaseId}/ | smazání OP |
| [**businessCaseDetailGet()**](ObchodnPpadyApi.md#businessCaseDetailGet) | **GET** /businessCase/{businessCaseId}/ | detail OP |
| [**businessCaseEdit()**](ObchodnPpadyApi.md#businessCaseEdit) | **POST** /businessCase/{businessCaseId}/ | upravení OP |
| [**businessCaseGet()**](ObchodnPpadyApi.md#businessCaseGet) | **GET** /businessCase/ | seznam OP |
| [**businessCaseInsert()**](ObchodnPpadyApi.md#businessCaseInsert) | **PUT** /businessCase/ | nový OP |
| [**businessCaseInvalidEdit()**](ObchodnPpadyApi.md#businessCaseInvalidEdit) | **POST** /businessCase/{businessCaseId}/invalid | zneplatnění OP |
| [**businessCaseItemDelete()**](ObchodnPpadyApi.md#businessCaseItemDelete) | **DELETE** /businessCase/{businessCaseId}/item/{businessCaseItemId}/ | smazání položky OP |
| [**businessCaseItemEdit()**](ObchodnPpadyApi.md#businessCaseItemEdit) | **POST** /businessCase/{businessCaseId}/item/{businessCaseItemId}/ | upravení položky OP |
| [**businessCaseItemInsert()**](ObchodnPpadyApi.md#businessCaseItemInsert) | **PUT** /businessCase/{businessCaseId}/item/ | přidání položek OP |
| [**businessCaseLockEdit()**](ObchodnPpadyApi.md#businessCaseLockEdit) | **POST** /businessCase/{businessCaseId}/lock | uzamčení OP |
| [**businessCaseParticipantsDelete()**](ObchodnPpadyApi.md#businessCaseParticipantsDelete) | **DELETE** /businessCase/{businessCaseId}/participants/{participantId} | smazání participanta z obchodního případu |
| [**businessCaseParticipantsDetailGet()**](ObchodnPpadyApi.md#businessCaseParticipantsDetailGet) | **GET** /businessCase/{businessCaseId}/participants/ | seznam participantů OP |
| [**businessCaseParticipantsInsert()**](ObchodnPpadyApi.md#businessCaseParticipantsInsert) | **PUT** /businessCase/{businessCaseId}/participants/ | nový participant obchodního případu |
| [**businessCasePdfExportDetailGet()**](ObchodnPpadyApi.md#businessCasePdfExportDetailGet) | **GET** /businessCase/{businessCaseId}/pdfExport | export OP do PDF |
| [**businessCasePhaseChangesDetailGet()**](ObchodnPpadyApi.md#businessCasePhaseChangesDetailGet) | **GET** /businessCase/{businessCaseId}/phaseChanges | changelog změn stavů OP |
| [**businessCaseUnlockEdit()**](ObchodnPpadyApi.md#businessCaseUnlockEdit) | **POST** /businessCase/{businessCaseId}/unlock | odemčení OP |
| [**businessCaseValidEdit()**](ObchodnPpadyApi.md#businessCaseValidEdit) | **POST** /businessCase/{businessCaseId}/valid | obnovení platnosti OP |


## `businessCaseCreateWithItemsInsert()`

```php
businessCaseCreateWithItemsInsert($business_case_create_with_items_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový OP s produkty

Založení nového obchodního případu i s položkami (najednou). Položky se do vstupu zadávají jako kolekce v atributu \"items\". Každá položka z kolekce je pak v systému vytvořena dvojím způsobem: bez napojení na produkt (nekategorizovaný produkt), nebo s napojením na vybraný produkt. Pokud položka obsahuje atribut \"product\" (ID produktu) nebo \"productCode\" (kód produktu), systém produkt dohledá a na položku napojí. **Pokud takový produkt nelze dohledat, pokusí se jej nově založit**. Množinu produktů pro dohledání je možné omezit na nějaký konkrétní ceník, a to tím, že se přidá navíc atribtut \"priceList\" (ID vybraného ceníku). Pro nekategorizovaný produkt se žádný z výše uvedených parametrů nezadává, ale je potřeba vložit alespoň název produktu (\"name\").

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_create_with_items_insert_dto = {"name":"Obchodní případ s položkami","company":2,"owner":3,"totalAmount":123.5,"estimatedValue":11,"probability":80,"validFrom":"2022-11-04","description":"Popis","currency":19,"items":[{"productCode":"002","name":"Muj produjt 002","count":7},{"productCode":"003","name":"Muj produkt 003","priceList":2,"count":5},{"productCode":"004","name":"Chladící kapalina","price":250,"unit":"litr","taxRate":21,"count":3}]}; // \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto

try {
    $result = $apiInstance->businessCaseCreateWithItemsInsert($business_case_create_with_items_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseCreateWithItemsInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_create_with_items_insert_dto** | [**\RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto**](../Model/BusinessCaseCreateWithItemsInsertDto.md)|  | [optional] |

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

## `businessCaseDelete()`

```php
businessCaseDelete($business_case_id)
```

smazání OP



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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodní případy

try {
    $apiInstance->businessCaseDelete($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodní případy | |

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

## `businessCaseDetailGet()`

```php
businessCaseDetailGet($business_case_id)
```

detail OP

Získání detailu obchodního případu. Pokud záznam obch. případu obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/businessCase/1/ ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodního případu

try {
    $apiInstance->businessCaseDetailGet($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodního případu | |

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

## `businessCaseEdit()`

```php
businessCaseEdit($business_case_id, $business_case_edit_dto)
```

upravení OP

Upravení dat obchodního případu

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodniho pripadu
$business_case_edit_dto = {"name":"test","company":1,"owner":3,"totalAmount":123.5,"estimatedValue":11,"probability":80,"validFrom":"2022-11-08","validTill":"2022-11-10","description":"test","businessCaseClassification1":93,"currency":17,"exchangeRate":20,"customFields":{"Popis_prio_c49d5":""}}; // \RaynetApiClient\Model\BusinessCaseEditDto

try {
    $apiInstance->businessCaseEdit($business_case_id, $business_case_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodniho pripadu | |
| **business_case_edit_dto** | [**\RaynetApiClient\Model\BusinessCaseEditDto**](../Model/BusinessCaseEditDto.md)|  | [optional] |

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

## `businessCaseGet()`

```php
businessCaseGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view)
```

seznam OP

Získání seznamu obchodních případů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/businessCase/?offset=0&limit=1&name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
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
$code = OP-15-001; // string | Filtrování OP podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$name = RAY; // string | Filtrování OP podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 1; // int | Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id)
$project = 1; // int | Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id)
$category = 1; // int | Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id)
$owner = 1; // int | Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$valid_from = 2022-06-01; // string | Filtrování OP podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_till = 2022-06-01; // string | Filtrování OP podle data uzavření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$scheduled_end = 2022-06-01; // string | Filtrování OP podle data odhad uzavření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = E_WIN; // string | Filtrování OP podle skupiny stavu. Lze využít operátoru `EQ`, `NE`. - `B_ACTIVE` otevřené OP,  - `E_WIN` vyhrané OP,  - `F_LOST` prohrané OP, - `G_STORNO` stornované OP
$business_case_phase = 21; // int | Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$business_case_type = 21; // int | Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$contains_product = 21; // int | Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor `CUSTOM`
$product_category = 21; // int | Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor `CUSTOM` a použít více hodnot `productCategory[CUSTOM]=1,2,3`
$product_line = 21; // int | Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor `CUSTOM` a použít více hodnot `productLine[CUSTOM]=1,2,3`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování OP podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování OP podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných OP. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->businessCaseGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseGet: ', $e->getMessage(), PHP_EOL;
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
| **code** | **string**| Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **name** | **string**| Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **int**| Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) | [optional] |
| **project** | **int**| Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) | [optional] |
| **category** | **int**| Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) | [optional] |
| **owner** | **int**| Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **valid_from** | **string**| Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_till** | **string**| Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **scheduled_end** | **string**| Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP | [optional] |
| **business_case_phase** | **int**| Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **business_case_type** | **int**| Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **contains_product** | **int**| Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; | [optional] |
| **product_category** | **int**| Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **product_line** | **int**| Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
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

## `businessCaseInsert()`

```php
businessCaseInsert($business_case_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový OP

Založení nového obchodního případu.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_insert_dto = {"name":"test","company":1,"owner":3,"totalAmount":123.5,"estimatedValue":11,"probability":80,"validFrom":"2022-11-08","description":"test","businessCaseClassification1":93,"currency":17,"exchangeRate":20,"businessCasePhase":3}; // \RaynetApiClient\Model\BusinessCaseInsertDto

try {
    $result = $apiInstance->businessCaseInsert($business_case_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_insert_dto** | [**\RaynetApiClient\Model\BusinessCaseInsertDto**](../Model/BusinessCaseInsertDto.md)|  | [optional] |

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

## `businessCaseInvalidEdit()`

```php
businessCaseInvalidEdit($business_case_id)
```

zneplatnění OP

Zneplatnění záznamu OP.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu

try {
    $apiInstance->businessCaseInvalidEdit($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |

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

## `businessCaseItemDelete()`

```php
businessCaseItemDelete($business_case_id, $business_case_item_id)
```

smazání položky OP

Smazání položky na OP  ``` https://app.raynet.cz/api/v2/businessCase/1/item/2/ ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodní případy
$business_case_item_id = 123; // int | ID položky obchodního případu

try {
    $apiInstance->businessCaseItemDelete($business_case_id, $business_case_item_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseItemDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodní případy | |
| **business_case_item_id** | **int**| ID položky obchodního případu | |

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

## `businessCaseItemEdit()`

```php
businessCaseItemEdit($business_case_id, $business_case_item_id, $business_case_item_edit_dto)
```

upravení položky OP

Upravení položky na OP  ``` https://app.raynet.cz/api/v2/businessCase/1/item/2/ ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodní případy
$business_case_item_id = 123; // int | ID položky obchodního případu
$business_case_item_edit_dto = {"name":"produkt 1","price":123,"taxRate":21,"count":2,"discountPercent":10.5,"cost":10,"unit":"ks","description":"poznamka k produktu"}; // \RaynetApiClient\Model\BusinessCaseItemEditDto

try {
    $apiInstance->businessCaseItemEdit($business_case_id, $business_case_item_id, $business_case_item_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseItemEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodní případy | |
| **business_case_item_id** | **int**| ID položky obchodního případu | |
| **business_case_item_edit_dto** | [**\RaynetApiClient\Model\BusinessCaseItemEditDto**](../Model/BusinessCaseItemEditDto.md)|  | [optional] |

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

## `businessCaseItemInsert()`

```php
businessCaseItemInsert($business_case_id, $business_case_item_insert_dto)
```

přidání položek OP

Přidání položek na OP. Položku je možno vytvořit dvojím způsobem: bez napojení na produkt (nekategorizovaný produkt) nebo položku s napojením na vybraný produkt. Pokud chci vytvořit napojenou položku, zadám do těla requestu parametr \"product\" (ID produktu) nebo \"productCode\" (kód produktu). Systém poté na zakladě zadané hodnoty produkt dohledá a na položku napojí. Pokud chci množinu produktů (pro dohledání) omezit pouze na nějaký konkrétní ceník, musím navíc zadat parametr \"priceList\" (ID vybraného ceníku). Pro nekategorizovaný produkt se žádný z výše uvedených parametrů nezadává, ale je potřeba vložit alespoň název produktu (\"name\").  ``` https://app.raynet.cz/api/v2/businessCase/1/item/ ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodního případu
$business_case_item_insert_dto = {"productCode":"A001","name":"Produkt","priceList":2,"count":2,"price":123,"taxRate":21,"discountPercent":10.5,"cost":10,"description":"poznamka k produktu"}; // \RaynetApiClient\Model\BusinessCaseItemInsertDto

try {
    $apiInstance->businessCaseItemInsert($business_case_id, $business_case_item_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseItemInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodního případu | |
| **business_case_item_insert_dto** | [**\RaynetApiClient\Model\BusinessCaseItemInsertDto**](../Model/BusinessCaseItemInsertDto.md)|  | [optional] |

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

## `businessCaseLockEdit()`

```php
businessCaseLockEdit($business_case_id)
```

uzamčení OP

Uzamčení záznamu OP pro editaci.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu

try {
    $apiInstance->businessCaseLockEdit($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |

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

## `businessCaseParticipantsDelete()`

```php
businessCaseParticipantsDelete($business_case_id, $participant_id)
```

smazání participanta z obchodního případu

U obchodního případu s identifikátorem `businessCaseId` bude smazán participant s identifikátorem `participantId`.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodního případu
$participant_id = 321; // int | ID participanta

try {
    $apiInstance->businessCaseParticipantsDelete($business_case_id, $participant_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseParticipantsDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodního případu | |
| **participant_id** | **int**| ID participanta | |

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

## `businessCaseParticipantsDetailGet()`

```php
businessCaseParticipantsDetailGet($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam participantů OP

Získání seznamu participantů obchodního případu. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodního případu
$company_name = 'company_name_example'; // string | Filtrování participantů OP podle názvu klienta. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$note = Pozor; // string | Filtrování participantů OP podle poznámky. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 3; // int | Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person = 3; // int | Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->businessCaseParticipantsDetailGet($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseParticipantsDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodního případu | |
| **company_name** | **string**| Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **note** | **string**| Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **int**| Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **person** | **int**| Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
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

## `businessCaseParticipantsInsert()`

```php
businessCaseParticipantsInsert($business_case_id, $business_case_participants_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový participant obchodního případu

Přidání nového participanta k obchodnímu případu s identifikátorem `businessCaseId`. Je možné přidat buď klienta nebo kontaktní osobu. V rámci volání API musí být obsažena právě jedna reference na klienta nebo kontaktní osobu.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obchodního případu
$business_case_participants_insert_dto = {"company":1,"category":123,"note":"Poznámka k participantovi"}; // \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto

try {
    $result = $apiInstance->businessCaseParticipantsInsert($business_case_id, $business_case_participants_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseParticipantsInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obchodního případu | |
| **business_case_participants_insert_dto** | [**\RaynetApiClient\Model\BusinessCaseParticipantsInsertDto**](../Model/BusinessCaseParticipantsInsertDto.md)|  | [optional] |

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

## `businessCasePdfExportDetailGet()`

```php
businessCasePdfExportDetailGet($business_case_id, $locale)
```

export OP do PDF

Export obchodního případu do PDF. Konkrétně dojde k vytvoření dočasného souboru v CRM uložišti. K obsahu tohoto souboru je pak možné přistoupit prostřednictvím API /exportBody (Více v sekci: Soubory / Stažení těla exportu).  ``` https://app.raynet.cz/api/v2/businessCase/3/pdfExport ```

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu
$locale = en; // string | Jazyk exportovaného obch. případu

try {
    $apiInstance->businessCasePdfExportDetailGet($business_case_id, $locale);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCasePdfExportDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |
| **locale** | **string**| Jazyk exportovaného obch. případu | [optional] |

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

## `businessCasePhaseChangesDetailGet()`

```php
businessCasePhaseChangesDetailGet($business_case_id)
```

changelog změn stavů OP

Výpis historie změn stavů obchodního případu.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu

try {
    $apiInstance->businessCasePhaseChangesDetailGet($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCasePhaseChangesDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |

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

## `businessCaseUnlockEdit()`

```php
businessCaseUnlockEdit($business_case_id)
```

odemčení OP

Odemčení záznamu OP k editaci.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu

try {
    $apiInstance->businessCaseUnlockEdit($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |

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

## `businessCaseValidEdit()`

```php
businessCaseValidEdit($business_case_id)
```

obnovení platnosti OP

Obnovení platnosti záznamu OP.

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


$apiInstance = new RaynetApiClient\Api\ObchodnPpadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$business_case_id = 123; // int | ID obch. případu

try {
    $apiInstance->businessCaseValidEdit($business_case_id);
} catch (Exception $e) {
    echo 'Exception when calling ObchodnPpadyApi->businessCaseValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **business_case_id** | **int**| ID obch. případu | |

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
