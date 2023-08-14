# RaynetApiClient\SouboryApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**attachmentDelete()**](SouboryApi.md#attachmentDelete) | **DELETE** /attachment/{attachmentId}/ | Smazání přílohy |
| [**attachmentInsert()**](SouboryApi.md#attachmentInsert) | **PUT** /attachment/{entityName}/{entityId}/ | Přidání přílohy |
| [**attachmentInsertCustomField()**](SouboryApi.md#attachmentInsertCustomField) | **PUT** /attachment/{entityName}/{entityId}/{customFieldId}/ | Přidání přílohy se souborem do volitelného pole |
| [**exportBodyGet()**](SouboryApi.md#exportBodyGet) | **GET** /exportBody/{uuid}/{accessToken}/{instanceName}/ | Stažení těla exportu |
| [**fileBodyGet()**](SouboryApi.md#fileBodyGet) | **GET** /fileBody/{uuid}/{accessToken}/{instanceName}/ | Stažení těla souboru |
| [**fileHeaderDetailGet()**](SouboryApi.md#fileHeaderDetailGet) | **GET** /fileHeader/{fileId}/ | Stažení meta informací o souboru |
| [**fileUploadEdit()**](SouboryApi.md#fileUploadEdit) | **POST** /fileUpload | Upload souboru do CRM |
| [**iconDetailGet()**](SouboryApi.md#iconDetailGet) | **GET** /icon/{fileId}/ | Stažení ikony obrázku |
| [**imageDetailGet()**](SouboryApi.md#imageDetailGet) | **GET** /image/{fileId}/ | Stažení obrázku |


## `attachmentDelete()`

```php
attachmentDelete($attachment_id)
```

Smazání přílohy

API umožňuje smazat existující přílohu na základě zadaného ID přílohy.  ``` https://app.raynet.cz/api/v2/attachment/125/ ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$attachment_id = 125; // int | ID přílohy

try {
    $apiInstance->attachmentDelete($attachment_id);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->attachmentDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **attachment_id** | **int**| ID přílohy | |

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

## `attachmentInsert()`

```php
attachmentInsert($entity_name, $entity_id, $attachment_insert_dto): \RaynetApiClient\Model\AttachmentInsert201Response
```

Přidání přílohy

```   https://app.raynet.cz/api/v2/attachment/company/3/ ``` API slouží k:  a) vytvoření záznamu přílohy odkazující na libovolné URL, např. na webové stránky. Příloha se přiřadí k vybrané entitě, zadané jejím ID a názvem entity. API ke své funkci potřebuje znát URL odkazu a název odkazu. ```   { \"link\": \"https://raynet.cz\", \"linkName\": \"raynet.cz\"} ``` b) vytvoření záznamu přílohy, která odkazuje na předem uploadovaný soubor.  Příloha se přiřadí k vybrané entitě, zadané jejím ID a názvem entity.  API ke své funkci potřebuje znát UUID předem nahraného souboru spolu s dalšími parametry tohoto souboru. ```   {\"fileName\":\"upload.bin\",\"uuid\":\"0cd5d016-f534-4093-943b-740961b03b6f\",\"contentType\":\"application/octet-stream\",\"fileSize\":21195} ``` c) vytvoření záznamu přílohy odkazující na složku z knihovny dokumentů.  Příloha se přiřadí k vybrané entitě, zadané jejím ID a názvem entity.  API ke své funkci potřebuje znát ID složky. ```   { \"folderId\": 6 } ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$attachment_insert_dto = {"link":"https://raynet.cz","linkName":"raynet.cz"}; // \RaynetApiClient\Model\AttachmentInsertDto

try {
    $result = $apiInstance->attachmentInsert($entity_name, $entity_id, $attachment_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->attachmentInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **attachment_insert_dto** | [**\RaynetApiClient\Model\AttachmentInsertDto**](../Model/AttachmentInsertDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\AttachmentInsert201Response**](../Model/AttachmentInsert201Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `attachmentInsertCustomField()`

```php
attachmentInsertCustomField($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto): \RaynetApiClient\Model\Insert201Response
```

Přidání přílohy se souborem do volitelného pole

API slouží k vytvoření záznamu přílohy, která odkazuje na předem uploadovaný soubor. Příloha se přiřadí volitelnému poli typu soubor (zadaného klíčem volitelného pole) na vybraném záznamu dané entity, zadané ID záznamu a názvem entity. API ke své funkci potřebuje znát UUID předem nahraného souboru spolu s dalšími parametry tohoto souboru.  ``` https://app.raynet.cz/api/v2/attachment/company/3/soubor_29f53 ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$entity_name = company; // string | Název entity (podporované hodnoty jsou: `company`, `lead`, `person`, `businessCase`, `offer`, `salesOrder`, `product`, `project`, `invoice`, `task`, `email`, `event`, `letter`, `phoneCall`, `meeting`)
$entity_id = 123; // int | ID entity
$custom_field_id = soubor_29f53; // string | Klíč (name) volitelného pole
$attachment_insert_custom_field_dto = {"uuid":"7d694dbb4e6241829de8a385da797283","fileName":"picture.png","contentType":"image/png","fileSize":24309}; // \RaynetApiClient\Model\AttachmentInsertCustomFieldDto

try {
    $result = $apiInstance->attachmentInsertCustomField($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->attachmentInsertCustomField: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **entity_name** | **string**| Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) | |
| **entity_id** | **int**| ID entity | |
| **custom_field_id** | **string**| Klíč (name) volitelného pole | |
| **attachment_insert_custom_field_dto** | [**\RaynetApiClient\Model\AttachmentInsertCustomFieldDto**](../Model/AttachmentInsertCustomFieldDto.md)|  | [optional] |

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

## `exportBodyGet()`

```php
exportBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type): \SplFileObject
```

Stažení těla exportu

Stažení těla (obsahu) souboru, který byl v předchozím kroku z CRM vyexportován prostřednictvím některého z export API (např. API /businessCase/:businessCaseId/pdfExport). Jedná se o file request bez vlastních http hlaviček a bez autorizace (aby mohl být volán automaticky prohlížečem prostřednictvím  hyperlinku). Z tohoto důvodu je potřeba do url předat údaje (uuid, acces token a název instance), které se získají z předchozího volání export API. Navíc se za url do parametrů přidává název (fileName) a typ souboru (contentType), což se následně vrátí v hlavičce odpovědi (prohlížeč pak má správné údaje o stahovaném souboru - např. pro korektní zobrazení a otevření v asociované aplikaci).  ``` https://app.raynet.cz/api/v2/exportBody/6775ac8cebd548e9b94a8ec99c30bab7/d9b38352c39f4ca2b7d367cffe089d20/ mojecrm/?fileName=obchodni_pripad.png&contentType=application%2Foctet-stream ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = 6775ac8cebd548e9b94a8ec99c30bab7; // int | UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport)
$access_token = d9b38352c39f4ca2b7d367cffe089d20; // string | Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport)
$instance_name = mojecrm; // string | Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport)
$file_name = priloha.png; // string | Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport)
$content_type = application/octet-stream; // string | Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport)

try {
    $result = $apiInstance->exportBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->exportBodyGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **int**| UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) | |
| **access_token** | **string**| Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) | |
| **instance_name** | **string**| Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) | |
| **file_name** | **string**| Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) | |
| **content_type** | **string**| Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) | |

### Return type

**\SplFileObject**

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `fileBodyGet()`

```php
fileBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type): \SplFileObject
```

Stažení těla souboru

Stažení těla (obsahu) jakéhokoliv souboru v CRM (přílohy, loga atd). Jedná se o file request bez vlastních http hlaviček a bez autorizace (aby mohl být volán automaticky prohlížečem prostřednictvím  hyperlinku). Z tohoto důvodu je potřeba do url předat údaje (uuid, acces token a název instance), které se získají z předchozího volání API /fileHeader (viz výše). Navíc se za url do parametrů přidává název (fileName) a typ souboru (contentType), což se následně vrátí v hlavičce odpovědi (prohlížeč pak má správné údaje o stahovaném souboru - např. pro korektní zobrazení a otevření v asociované aplikaci).  ``` https://app.raynet.cz/api/v2/fileBody/6775ac8cebd548e9b94a8ec99c30bab7/d9b38352c39f4ca2b7d367cffe089d20/ mojecrm/?fileName=priloha.png&contentType=image%2Fpng ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = 6775ac8cebd548e9b94a8ec99c30bab7; // int | UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader)
$access_token = d9b38352c39f4ca2b7d367cffe089d20; // string | Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader)
$instance_name = mojecrm; // string | Název instance (název vašeho CRM, získaný z API /fileHeader)
$file_name = priloha.png; // string | Název souboru (získaný z API /fileHeader)
$content_type = image/png; // string | Typ obsahu souboru (získaný z API /fileHeader)

try {
    $result = $apiInstance->fileBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->fileBodyGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **int**| UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) | |
| **access_token** | **string**| Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) | |
| **instance_name** | **string**| Název instance (název vašeho CRM, získaný z API /fileHeader) | |
| **file_name** | **string**| Název souboru (získaný z API /fileHeader) | |
| **content_type** | **string**| Typ obsahu souboru (získaný z API /fileHeader) | |

### Return type

**\SplFileObject**

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/octet-stream`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `fileHeaderDetailGet()`

```php
fileHeaderDetailGet($file_id)
```

Stažení meta informací o souboru

Stažení meta informací o jakémkoliv souboru v CRM (příloha, logo atd). API vrátí jméno souboru, typ souboru, unikátní identifikátor (UUID), název instance CRM a vygenerovaný access token. Tyto údaje pak slouží k jednorázovému použití v api /fileBody pro získání obsahu souboru.  ``` https://app.raynet.cz/api/v2/fileHeader/3/ ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file_id = 123; // int | ID souboru (získaného z detailu záznamu (např.: attachment -> file -> id), kde se foto, logo nebo příloha nachází)

try {
    $apiInstance->fileHeaderDetailGet($file_id);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->fileHeaderDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file_id** | **int**| ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) | |

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

## `fileUploadEdit()`

```php
fileUploadEdit($file): \RaynetApiClient\Model\FileUploadEdit200Response
```

Upload souboru do CRM

Nahrání souboru do uložiště v CRM. Obsah souboru je potřeba nahrát ve formátu 'multipart/form-data' (standardní formát pro odeslání formulářových dat obsahujících soubor http requestem) a to pod atributem s názvem 'file'. API vrací informace o nově nahraném souboru (zejména unikátní identifikátr souboru - UUID). Výstupní parametry pak slouží jako vstup pro API k založení nové přílohy (viz níže).  ``` https://app.raynet.cz/api/v2/fileUpload ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = "/path/to/file.txt"; // \SplFileObject

try {
    $result = $apiInstance->fileUploadEdit($file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->fileUploadEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file** | **\SplFileObject****\SplFileObject**|  | |

### Return type

[**\RaynetApiClient\Model\FileUploadEdit200Response**](../Model/FileUploadEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `iconDetailGet()`

```php
iconDetailGet($file_id)
```

Stažení ikony obrázku

Získání obsahu obrázku (loga nebo fota) v malé velikosti, zakódovaného do Base 64 formátu.  ``` https://app.raynet.cz/api/v2/icon/3/ ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file_id = 123; // int | ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází)

try {
    $apiInstance->iconDetailGet($file_id);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->iconDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file_id** | **int**| ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `image/png`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `imageDetailGet()`

```php
imageDetailGet($file_id)
```

Stažení obrázku

Získání obsahu obrázku (loga nebo fota) v plné velikosti zakódovaného do Base 64 formátu.  ``` https://app.raynet.cz/api/v2/image/3/ ```

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


$apiInstance = new RaynetApiClient\Api\SouboryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file_id = 123; // int | ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází)

try {
    $apiInstance->imageDetailGet($file_id);
} catch (Exception $e) {
    echo 'Exception when calling SouboryApi->imageDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file_id** | **int**| ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) | |

### Return type

void (empty response body)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `image/png`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
