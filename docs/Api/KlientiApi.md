# RaynetApiClient\KlientiApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**companyAddressDelete()**](KlientiApi.md#companyAddressDelete) | **DELETE** /company/{companyId}/address/{addressId}/ | smazání adresy klienta |
| [**companyAddressEdit()**](KlientiApi.md#companyAddressEdit) | **POST** /company/{companyId}/address/{addressId}/ | upravení adresy klienta |
| [**companyAddressInsert()**](KlientiApi.md#companyAddressInsert) | **PUT** /company/{companyId}/address/ | přidání adresy ke klientovi |
| [**companyAddressSetContactEdit()**](KlientiApi.md#companyAddressSetContactEdit) | **POST** /company/{companyId}/address/{addressId}/setContact/ | nastavení kontaktní adresy |
| [**companyAddressSetPrimaryEdit()**](KlientiApi.md#companyAddressSetPrimaryEdit) | **POST** /company/{companyId}/address/{addressId}/setPrimary/ | nastavení primární adresy |
| [**companyAnonymizeEdit()**](KlientiApi.md#companyAnonymizeEdit) | **POST** /company/{companyId}/anonymize/ | GDPR anonymize klienta |
| [**companyDelete()**](KlientiApi.md#companyDelete) | **DELETE** /company/{companyId}/ | smazání klienta |
| [**companyDetailGet()**](KlientiApi.md#companyDetailGet) | **GET** /company/{companyId}/ | detail klienta |
| [**companyEdit()**](KlientiApi.md#companyEdit) | **POST** /company/{companyId}/ | upravení klienta |
| [**companyGet()**](KlientiApi.md#companyGet) | **GET** /company/ | seznam klientů |
| [**companyInsert()**](KlientiApi.md#companyInsert) | **PUT** /company/ | nový klient |
| [**companyInvalidEdit()**](KlientiApi.md#companyInvalidEdit) | **POST** /company/{companyId}/invalid | zneplatnění klienta |
| [**companyLockEdit()**](KlientiApi.md#companyLockEdit) | **POST** /company/{companyId}/lock | uzamčení klienta |
| [**companyMergeEdit()**](KlientiApi.md#companyMergeEdit) | **POST** /company/{companyId}/merge/{sourceCompanyId}/ | Sloučení duplicitního klienta |
| [**companyRelationshipDelete()**](KlientiApi.md#companyRelationshipDelete) | **DELETE** /company/{companyId}/relationship/{relationshipId}/ | smazání propojení na jiného klienta |
| [**companyRelationshipDetailGet()**](KlientiApi.md#companyRelationshipDetailGet) | **GET** /company/{companyId}/relationship/ | Propojení na jiné klienty |
| [**companyRelationshipEdit()**](KlientiApi.md#companyRelationshipEdit) | **POST** /company/{companyId}/relationship/{relationshipId}/ | upravení propojení na jiného klienta |
| [**companyRelationshipInsert()**](KlientiApi.md#companyRelationshipInsert) | **PUT** /company/{companyId}/relationship/ | přidání propojení na klienta |
| [**companyTagDelete()**](KlientiApi.md#companyTagDelete) | **DELETE** /company/{companyId}/tag/ | smazání TAGu z Klienta |
| [**companyTagInsert()**](KlientiApi.md#companyTagInsert) | **PUT** /company/{companyId}/tag/ | přidání TAGu ke Klientovi |
| [**companyUnlockEdit()**](KlientiApi.md#companyUnlockEdit) | **POST** /company/{companyId}/unlock | odemčení klienta |
| [**companyValidEdit()**](KlientiApi.md#companyValidEdit) | **POST** /company/{companyId}/valid | obnovení platnosti klienta |


## `companyAddressDelete()`

```php
companyAddressDelete($company_id, $address_id)
```

smazání adresy klienta

U klienta s identifikátorem `companyId` bude smazána adresa s identifikátorem `addressId`. Nelze smazat primární adresu (tzn. u klienta vždy musí být alespoň jedna adresa).

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$address_id = 123; // int | ID adresy

try {
    $apiInstance->companyAddressDelete($company_id, $address_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAddressDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **address_id** | **int**| ID adresy | |

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

## `companyAddressEdit()`

```php
companyAddressEdit($company_id, $address_id, $company_address_edit_dto)
```

upravení adresy klienta

U klienta s identifikátorem `companyId` bude upravena adresa s identifikátorem `addressId`.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$address_id = 123; // int | ID adresy
$company_address_edit_dto = {"address":{"name":"Sídlo klienta","street":"Francouzská 6167/5","city":"Ostrava","province":"Morava","zipCode":"708 00","country":"CZ","lat":null,"lng":null},"contactInfo":{"email":"info@raynet.cz","email2":"","fax":"","otherContact":"","tel1":"+420 553 401 520","tel1Type":"recepce","tel2":"+420 553 401 547","tel2Type":"zákaznická podpora","www":"www.raynet.cz","doNotSendMM":false},"territory":12}; // \RaynetApiClient\Model\CompanyAddressEditDto

try {
    $apiInstance->companyAddressEdit($company_id, $address_id, $company_address_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAddressEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **address_id** | **int**| ID adresy | |
| **company_address_edit_dto** | [**\RaynetApiClient\Model\CompanyAddressEditDto**](../Model/CompanyAddressEditDto.md)|  | [optional] |

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

## `companyAddressInsert()`

```php
companyAddressInsert($company_id, $company_address_insert_dto): \RaynetApiClient\Model\Insert201Response
```

přidání adresy ke klientovi

Přidání nové adresy ke klientovi s identifikátorem `companyId`. Adresa je zařazena mezi ostatní adresy (tzn. není primární).

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$company_address_insert_dto = {"address":{"name":"Sídlo klienta","street":"Francouzská 6167/5","city":"Ostrava","province":"Morava","zipCode":"708 00","country":"CZ","lat":null,"lng":null},"contactInfo":{"email":"info@raynet.cz","email2":"","fax":"","otherContact":"","tel1":"+420 553 401 520","tel1Type":"recepce","tel2":"+420 553 401 547","tel2Type":"zákaznická podpora","www":"www.raynet.cz","doNotSendMM":false},"territory":12}; // \RaynetApiClient\Model\CompanyAddressInsertDto

try {
    $result = $apiInstance->companyAddressInsert($company_id, $company_address_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAddressInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **company_address_insert_dto** | [**\RaynetApiClient\Model\CompanyAddressInsertDto**](../Model/CompanyAddressInsertDto.md)|  | [optional] |

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

## `companyAddressSetContactEdit()`

```php
companyAddressSetContactEdit($company_id, $address_id)
```

nastavení kontaktní adresy

U klienta s identifikátorem `companyId` bude nastavena adresa jako kontaktní. Tato adresa se bude zobrazovat v seznamu klientů a bude jako první v detailu klienta. Adresa, která byla doposud označena jako kontaktní se přesune mezi ostatní adresy.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$address_id = 123; // int | ID adresy

try {
    $apiInstance->companyAddressSetContactEdit($company_id, $address_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAddressSetContactEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **address_id** | **int**| ID adresy | |

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

## `companyAddressSetPrimaryEdit()`

```php
companyAddressSetPrimaryEdit($company_id, $address_id)
```

nastavení primární adresy

U klienta s identifikátorem `companyId` bude nastavena nová primární adresa. Adresa, která byla doposud označena jako primární se přesune mezi ostatní adresy.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$address_id = 123; // int | ID adresy

try {
    $apiInstance->companyAddressSetPrimaryEdit($company_id, $address_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAddressSetPrimaryEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **address_id** | **int**| ID adresy | |

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

## `companyAnonymizeEdit()`

```php
companyAnonymizeEdit($company_id)
```

GDPR anonymize klienta

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyAnonymizeEdit($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyAnonymizeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyDelete()`

```php
companyDelete($company_id)
```

smazání klienta



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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyDelete($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyDetailGet()`

```php
companyDetailGet($company_id)
```

detail klienta

Získání detailu klienta. V detailu je uveden klient se všemi evidovanými údaji včetně všech evidovaných adres. Pokud záznam klienta obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/company/1/ ```

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyDetailGet($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyEdit()`

```php
companyEdit($company_id, $company_edit_dto)
```

upravení klienta

Upravení dat klienta

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$company_edit_dto = {"name":"RAYNET s.r.o.","owner":12,"rating":"A","state":"A_POTENTIAL","role":"B_PARTNER","notice":"poznamka","category":12,"contactSource":12,"employeesNumber":12,"legalForm":12,"paymentTerm":12,"turnover":12,"economyActivity":12,"companyClassification1":12,"companyClassification2":12,"companyClassification3":12,"regNumber":"12345678","taxNumber":"CZ12345678","taxPayer":"YES","bankAccount":"123123123","customFields":{"Lonsky_zis_7aac1":666}}; // \RaynetApiClient\Model\CompanyEditDto

try {
    $apiInstance->companyEdit($company_id, $company_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **company_edit_dto** | [**\RaynetApiClient\Model\CompanyEditDto**](../Model/CompanyEditDto.md)|  | [optional] |

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

## `companyGet()`

```php
companyGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags)
```

seznam klientů

Získání seznamu klientů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/company/?offset=0&limit=1&name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených klientů je `1000`
$sort_column = name; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$name = Test s.r.o.; // string | Filtrování klientů podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`.
$last_name = RAY; // string | Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$person = true; // bool | Filtrování klientů podle příznaku Jedná se o fyzickou osobu
$reg_number = 12345678; // string | Filtrování klientů podle IČ. Lze využít operátoru `EQ`, `NE`. Výchozím operátorem je `EQ`. Například: pro seznam všech klientů se zadaným IČ je nutné zadat `regNumber[NE]=null`
$owner = 1; // int | Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$rating = 'rating_example'; // string | Filtrování klientů podle Ratingu
$role = 'role_example'; // string | Filtrování klientů podle Role
$state = 'state_example'; // string | Filtrování klientů podle Stavu
$category = 1; // int | Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru `EQ`, `NE`, `IN`
$economy_activity = 1; // int | Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru `EQ`, `NE`, `IN`
$company_classification1 = 1; // int | Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru `EQ`, `NE`, `IN`
$company_classification2 = 1; // int | Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru `EQ`, `NE`, `IN`
$company_classification3 = 1; // int | Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru `EQ`, `NE`, `IN`
$primary_address_contact_info_email = test@test.cz; // string | Filtrování klientů podle emailu u primární adresy. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$primary_address_contact_info_email2 = test@test.cz; // string | Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování klientů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování klientů podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných klientů. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$gdpr_template = 'gdpr_template_example'; // string | Filtrování klientů podle právního titulu. Lze použít jen operátor `CUSTOM`.
$without_gdpr = 'without_gdpr_example'; // string | Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor `CUSTOM`. `api/v2/company?withoutGdpr[CUSTOM]`
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->companyGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených klientů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **name** | **string**| Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. | [optional] |
| **last_name** | **string**| Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **person** | **bool**| Filtrování klientů podle příznaku Jedná se o fyzickou osobu | [optional] |
| **reg_number** | **string**| Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; | [optional] |
| **owner** | **int**| Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **rating** | **string**| Filtrování klientů podle Ratingu | [optional] |
| **role** | **string**| Filtrování klientů podle Role | [optional] |
| **state** | **string**| Filtrování klientů podle Stavu | [optional] |
| **category** | **int**| Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **economy_activity** | **int**| Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **company_classification1** | **int**| Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **company_classification2** | **int**| Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **company_classification3** | **int**| Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; | [optional] |
| **primary_address_contact_info_email** | **string**| Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **primary_address_contact_info_email2** | **string**| Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
| **gdpr_template** | **string**| Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
| **without_gdpr** | **string**| Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; | [optional] |
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

## `companyInsert()`

```php
companyInsert($company_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový klient

Založení nového klienta s adresami

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_insert_dto = {"name":"RAYNET s.r.o.","securityLevel":1,"owner":12,"rating":"A","state":"A_POTENTIAL","role":"B_PARTNER","notice":"poznamka","category":12,"contactSource":12,"employeesNumber":12,"legalForm":12,"paymentTerm":12,"turnover":12,"economyActivity":12,"companyClassification1":12,"companyClassification2":12,"companyClassification3":12,"regNumber":"12345678","taxNumber":"CZ12345678","taxPayer":"YES","bankAccount":"123123123","addresses":[{"address":{"name":"Sídlo klienta","street":"Francouzská 6167/5","city":"Ostrava","province":"Morava","zipCode":"708 00","country":"CZ","lat":49.827486,"lng":18.186497},"contactInfo":{"email":"info@raynet.cz","email2":"","fax":"","otherContact":"","tel1":"+420 553 401 520","tel1Type":"recepce","tel2":"+420 553 401 547","tel2Type":"zákaznická podpora","www":"www.raynet.cz","doNotSendMM":false},"territory":12}],"tags":["tag 1","tag 2"],"customFields":{"Spoluprace_2aa2c":"2022-01-01"}}; // \RaynetApiClient\Model\CompanyInsertDto

try {
    $result = $apiInstance->companyInsert($company_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_insert_dto** | [**\RaynetApiClient\Model\CompanyInsertDto**](../Model/CompanyInsertDto.md)|  | [optional] |

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

## `companyInvalidEdit()`

```php
companyInvalidEdit($company_id)
```

zneplatnění klienta

Zneplatnění záznamu klienta.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyInvalidEdit($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyLockEdit()`

```php
companyLockEdit($company_id)
```

uzamčení klienta

Uzamčení záznamu klienta pro editaci.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyLockEdit($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyMergeEdit()`

```php
companyMergeEdit($company_id, $source_company_id)
```

Sloučení duplicitního klienta

Při sloučení dojde k převedení všech dat ze zdrojového klienta do cílového klienta s následným smazáním zdrojového klienta. Podrobnosti o slučování najdete v [tomto článku](https://podpora.raynet.cz/hc/cs/articles/360000822106).

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID cílového klienta, do tohoto záznamu se budou převádět data
$source_company_id = 123; // int | ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán

try {
    $apiInstance->companyMergeEdit($company_id, $source_company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyMergeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID cílového klienta, do tohoto záznamu se budou převádět data | |
| **source_company_id** | **int**| ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán | |

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

## `companyRelationshipDelete()`

```php
companyRelationshipDelete($company_id, $relationship_id)
```

smazání propojení na jiného klienta

U zadaného klienta bude smazána vazba na jiného klienta. Pokud k odstraňované vazbě existuje vazba inverzní, bude rovněž smazána.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$relationship_id = 123; // int | ID vazby s klientem

try {
    $apiInstance->companyRelationshipDelete($company_id, $relationship_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyRelationshipDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **relationship_id** | **int**| ID vazby s klientem | |

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

## `companyRelationshipDetailGet()`

```php
companyRelationshipDetailGet($company_id)
```

Propojení na jiné klienty

Získání vazeb na jiné klienty.  ``` https://app.raynet.cz/api/v2/company/1/relationship/ ```

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyRelationshipDetailGet($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyRelationshipDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyRelationshipEdit()`

```php
companyRelationshipEdit($company_id, $relationship_id, $company_relationship_edit_dto)
```

upravení propojení na jiného klienta

U existujícího propojení je možné měnit už jenom poznámku.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$relationship_id = 123; // int | ID vztahu s jiným klientem
$company_relationship_edit_dto = {"notice":"Zařazení v rámci holdingu"}; // \RaynetApiClient\Model\CompanyRelationshipEditDto

try {
    $apiInstance->companyRelationshipEdit($company_id, $relationship_id, $company_relationship_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyRelationshipEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **relationship_id** | **int**| ID vztahu s jiným klientem | |
| **company_relationship_edit_dto** | [**\RaynetApiClient\Model\CompanyRelationshipEditDto**](../Model/CompanyRelationshipEditDto.md)|  | [optional] |

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

## `companyRelationshipInsert()`

```php
companyRelationshipInsert($company_id, $company_relationship_insert_dto): \RaynetApiClient\Model\Insert201Response
```

přidání propojení na klienta

Přidání nové vazby klienta na jiného klienta. Vazba může být tří typů - vazba mateřského klienta na dceřinného (\"parent\"), dceřinného na mateřského (\"slave\") nebo volná vazba (\"free\"). Po přidání nové vazby vznikne mezi oběma klienty zároveň druhá vazba - vazba inverzní (např. pro novou vazbu typu \"parent\" vznikne zároveň opačná vazba typu \"slave\").

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$company_relationship_insert_dto = {"companyJoin":5,"companyJoinType":"parent","notice":"Zařazení v rámci holdingu"}; // \RaynetApiClient\Model\CompanyRelationshipInsertDto

try {
    $result = $apiInstance->companyRelationshipInsert($company_id, $company_relationship_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyRelationshipInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **company_relationship_insert_dto** | [**\RaynetApiClient\Model\CompanyRelationshipInsertDto**](../Model/CompanyRelationshipInsertDto.md)|  | [optional] |

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

## `companyTagDelete()`

```php
companyTagDelete($company_id, $company_tag_delete_dto)
```

smazání TAGu z Klienta



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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$company_tag_delete_dto = {"tag":"muj tag"}; // \RaynetApiClient\Model\CompanyTagDeleteDto

try {
    $apiInstance->companyTagDelete($company_id, $company_tag_delete_dto);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyTagDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **company_tag_delete_dto** | [**\RaynetApiClient\Model\CompanyTagDeleteDto**](../Model/CompanyTagDeleteDto.md)|  | [optional] |

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

## `companyTagInsert()`

```php
companyTagInsert($company_id, $company_tag_insert_dto)
```

přidání TAGu ke Klientovi



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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta
$company_tag_insert_dto = {"tag":"muj tag"}; // \RaynetApiClient\Model\CompanyTagInsertDto

try {
    $apiInstance->companyTagInsert($company_id, $company_tag_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyTagInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |
| **company_tag_insert_dto** | [**\RaynetApiClient\Model\CompanyTagInsertDto**](../Model/CompanyTagInsertDto.md)|  | [optional] |

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

## `companyUnlockEdit()`

```php
companyUnlockEdit($company_id)
```

odemčení klienta

Odemčení záznamu klienta k editaci.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyUnlockEdit($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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

## `companyValidEdit()`

```php
companyValidEdit($company_id)
```

obnovení platnosti klienta

Obnovení platnosti záznamu klienta.

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


$apiInstance = new RaynetApiClient\Api\KlientiApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_id = 123; // int | ID klienta

try {
    $apiInstance->companyValidEdit($company_id);
} catch (Exception $e) {
    echo 'Exception when calling KlientiApi->companyValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **company_id** | **int**| ID klienta | |

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
