# RaynetApiClient\LeadyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**leadAnonymizeEdit()**](LeadyApi.md#leadAnonymizeEdit) | **POST** /lead/{leadId}/anonymize/ | GDPR anonymize leadu |
| [**leadDelete()**](LeadyApi.md#leadDelete) | **DELETE** /lead/{leadId}/ | smazání leadu |
| [**leadDetailGet()**](LeadyApi.md#leadDetailGet) | **GET** /lead/{leadId}/ | detail leadu |
| [**leadEdit()**](LeadyApi.md#leadEdit) | **POST** /lead/{leadId}/ | upravení leadu |
| [**leadGet()**](LeadyApi.md#leadGet) | **GET** /lead/ | seznam leadů |
| [**leadInsert()**](LeadyApi.md#leadInsert) | **PUT** /lead/ | nový lead |
| [**leadLockEdit()**](LeadyApi.md#leadLockEdit) | **POST** /lead/{leadId}/lock | uzamčení leadu |
| [**leadMergeEdit()**](LeadyApi.md#leadMergeEdit) | **POST** /lead/{leadId}/merge/{sourceLeadId}/ | Sloučení duplicitního leadu |
| [**leadUnlockEdit()**](LeadyApi.md#leadUnlockEdit) | **POST** /lead/{leadId}/unlock | odemčení leadu |


## `leadAnonymizeEdit()`

```php
leadAnonymizeEdit($lead_id)
```

GDPR anonymize leadu

U záznamu se provede anonimizace data.

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID leadu

try {
    $apiInstance->leadAnonymizeEdit($lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadAnonymizeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID leadu | |

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

## `leadDelete()`

```php
leadDelete($lead_id)
```

smazání leadu



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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID lead

try {
    $apiInstance->leadDelete($lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID lead | |

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

## `leadDetailGet()`

```php
leadDetailGet($lead_id)
```

detail leadu

Získání detailu leadu. Pokud záznam leadu obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/lead/3/ ```

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID lead

try {
    $apiInstance->leadDetailGet($lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID lead | |

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

## `leadEdit()`

```php
leadEdit($lead_id, $lead_edit_dto): \RaynetApiClient\Model\LeadEdit200Response
```

upravení leadu

Upravení dat leadu

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID leadu
$lead_edit_dto = {"topic":"Objednávka","priority":"DEFAULT","companyName":"Neteče a nepoteče s.r.o","firstName":"Jan","lastName":"Kapka","owner":1,"leadPhase":105,"notice":"Importováno xxxxz webu","category":91,"contactSource":61,"regNumber":"regNumber","contactInfo":{"email":"netece@nepotece.cz","email2":"test@nepotece.cz","tel1":"+420 800 123 123 ","tel1Type":"Mobil","tel2":"+420 123 456 789","tel2Type":"Pevná linka","www":"nepotece.cz","fax":"+420 123 123 123","otherContact":"Pobočka XY","doNotSendMM":false},"address":{"street":"Hlavní ulice","city":"Velká Lhota","province":"Jihomoravký kraj","zipCode":"123 00","country":"CZ","lat":null,"lng":null},"socialNetworkContact":{"facebook":"kapkafb","googleplus":"kapkagp","twitter":"kapkatw","linkedin":"kapkali","pinterest":"kapkapi","instagram":"kapkain","skype":"kapkask","youtube":"kapkayo"},"customFields":{"VIP_b91d1":false},"tags":"aaa,bbb"}; // \RaynetApiClient\Model\LeadEditDto

try {
    $result = $apiInstance->leadEdit($lead_id, $lead_edit_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID leadu | |
| **lead_edit_dto** | [**\RaynetApiClient\Model\LeadEditDto**](../Model/LeadEditDto.md)|  | [optional] |

### Return type

[**\RaynetApiClient\Model\LeadEdit200Response**](../Model/LeadEdit200Response.md)

### Authorization

[instanceName](../../README.md#instanceName), [basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `leadGet()`

```php
leadGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $company_name, $last_name, $contact_info_email, $contact_info_email2, $reg_number, $owner, $lead_date, $status, $lead_phase, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $gdpr_template, $without_gdpr, $view, $tags)
```

seznam leadů

Získání seznamu leadů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/lead/?offset=0&limit=1&companyName[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených leadů je `1000`
$sort_column = code; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$code = L-16-1111; // string | Filtrování leadů podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company_name = RAY; // string | Filtrování leadů podle jména klienta. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$last_name = Novak; // string | Filtrování leadů podle příjmení. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$contact_info_email = novak@raynet.cz; // string | Filtrování leadů podle emailu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$contact_info_email2 = novak@raynet.cz; // string | Filtrování leadů podle druhého emailu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$reg_number = 1234567; // string | Filtrování leadů podle IČ. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$owner = 1; // int | Filtrování leadů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$lead_date = 2022-06-01; // string | Filtrování leadů podle přijato. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = D_DONE; // string | Filtrování OP podle skupiny stavu. Lze využít operátoru `EQ`, `NE`. - `B_ACTIVE` otevřené leady,  - `G_STORNO` stornované leady,  - `D_DONE` převedené leady
$lead_phase = 21; // int | Filtrování leadů podle stavu (LeadPhase). Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování leadů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování leadů podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování leadů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$gdpr_template = 56; // int | Filtrování leadů podle právního titulu. Lze použít jen operátor `CUSTOM`.
$without_gdpr = 56; // int | Filtrování leadů, kteří nemají platný právní titul. Lze využít jen operátor `CUSTOM`.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->leadGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $company_name, $last_name, $contact_info_email, $contact_info_email2, $reg_number, $owner, $lead_date, $status, $lead_phase, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $gdpr_template, $without_gdpr, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených leadů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **code** | **string**| Filtrování leadů podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company_name** | **string**| Filtrování leadů podle jména klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **last_name** | **string**| Filtrování leadů podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **contact_info_email** | **string**| Filtrování leadů podle emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **contact_info_email2** | **string**| Filtrování leadů podle druhého emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **reg_number** | **string**| Filtrování leadů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **owner** | **int**| Filtrování leadů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **lead_date** | **string**| Filtrování leadů podle přijato. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **status** | **string**| Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené leady,  - &#x60;G_STORNO&#x60; stornované leady,  - &#x60;D_DONE&#x60; převedené leady | [optional] |
| **lead_phase** | **int**| Filtrování leadů podle stavu (LeadPhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování leadů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování leadů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování leadů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **gdpr_template** | **int**| Filtrování leadů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
| **without_gdpr** | **int**| Filtrování leadů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
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

## `leadInsert()`

```php
leadInsert($lead_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový lead

Založení nového leadu. S volitelnou možností zaslat notifikaci o vytvoření leadu na vybrané emailové adresy (vhodné pro webové formuláře).

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_insert_dto = {"topic":"Objednávka","priority":"DEFAULT","companyName":"Neteče a nepoteče s.r.o","firstName":"Jan","lastName":"Kapka","owner":1,"notice":"Importováno xxxxz webu","category":91,"contactSource":61,"regNumber":"regNumber","leadPhase":122,"contactInfo":{"email":"metece@nepotece.cz","email2":"test@nepotece.cz","tel1":"+420 800 123 123 ","tel1Type":"Mobil","tel2":"+420 123 456 789","tel2Type":"Pevná linka","www":"nepotece.cz","fax":"+420 123 123 123","otherContact":"Pobočka XY","doNotSendMM":false},"address":{"street":"Hlavní ulice","city":"Velká Lhota","province":"Jihomoravký kraj","zipCode":"123 00","country":"CZ","lat":null,"lng":null},"socialNetworkContact":{"facebook":"kapkafb","googleplus":"kapkagp","twitter":"kapkatw","linkedin":"kapkali","pinterest":"kapkapi","instagram":"kapkain","skype":"kapkask","youtube":"kapkayo"},"customFields":{"VIP_b91d1":false},"tags":"aaa,bbb","notificationMessage":"Poptávka z webového formuláře","notificationEmailAddresses":["email@raynet.cz","email2@raynet.cz"]}; // \RaynetApiClient\Model\LeadInsertDto

try {
    $result = $apiInstance->leadInsert($lead_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_insert_dto** | [**\RaynetApiClient\Model\LeadInsertDto**](../Model/LeadInsertDto.md)|  | [optional] |

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

## `leadLockEdit()`

```php
leadLockEdit($lead_id)
```

uzamčení leadu

Uzamčení záznamu leadu pro editaci.

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID leadu

try {
    $apiInstance->leadLockEdit($lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID leadu | |

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

## `leadMergeEdit()`

```php
leadMergeEdit($lead_id, $source_lead_id)
```

Sloučení duplicitního leadu

Při sloučení dojde k převedení všech dat ze zdrojového leadu do cílového leadu s následným smazáním zdrojového leadu. Podrobnosti o slučování najdete v [tomto článku](https://podpora.raynet.cz/hc/cs/articles/360000822106).

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID cílového leadu, do tohoto záznamu se budou převádět data
$source_lead_id = 123; // int | ID zdrojového leadu, který bude sloučen s cílovým leadem a následně smazán

try {
    $apiInstance->leadMergeEdit($lead_id, $source_lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadMergeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID cílového leadu, do tohoto záznamu se budou převádět data | |
| **source_lead_id** | **int**| ID zdrojového leadu, který bude sloučen s cílovým leadem a následně smazán | |

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

## `leadUnlockEdit()`

```php
leadUnlockEdit($lead_id)
```

odemčení leadu

Odemčení záznamu leadu k editaci.

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


$apiInstance = new RaynetApiClient\Api\LeadyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lead_id = 123; // int | ID leadu

try {
    $apiInstance->leadUnlockEdit($lead_id);
} catch (Exception $e) {
    echo 'Exception when calling LeadyApi->leadUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lead_id** | **int**| ID leadu | |

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
