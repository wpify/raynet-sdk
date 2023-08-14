# RaynetApiClient\KontaktnOsobyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**personAnonymizeEdit()**](KontaktnOsobyApi.md#personAnonymizeEdit) | **POST** /person/{personId}/anonymize/ | GDPR anonymize kontaktní osoby |
| [**personDelete()**](KontaktnOsobyApi.md#personDelete) | **DELETE** /person/{personId}/ | smazání kontaktní osoby |
| [**personDetailGet()**](KontaktnOsobyApi.md#personDetailGet) | **GET** /person/{personId}/ | detail kontaktní osoby |
| [**personEdit()**](KontaktnOsobyApi.md#personEdit) | **POST** /person/{personId}/ | upravení kontaktní osoby |
| [**personGet()**](KontaktnOsobyApi.md#personGet) | **GET** /person/ | seznam kontaktních osob |
| [**personInsert()**](KontaktnOsobyApi.md#personInsert) | **PUT** /person/ | založení nové kontaktní osoby |
| [**personInvalidEdit()**](KontaktnOsobyApi.md#personInvalidEdit) | **POST** /person/{personId}/invalid | zneplatnění kontaktní osoby |
| [**personLockEdit()**](KontaktnOsobyApi.md#personLockEdit) | **POST** /person/{personId}/lock | uzamčení kontaktní osoby |
| [**personMergeEdit()**](KontaktnOsobyApi.md#personMergeEdit) | **POST** /person/{personId}/merge/{sourcePersonId}/ | Sloučení duplicitní kontaktní osoby |
| [**personRelationshipDelete()**](KontaktnOsobyApi.md#personRelationshipDelete) | **DELETE** /person/{personId}/relationship/{relationshipId}/ | smazání vztahu |
| [**personRelationshipEdit()**](KontaktnOsobyApi.md#personRelationshipEdit) | **POST** /person/{personId}/relationship/{relationshipId}/ | upravení vztahu |
| [**personRelationshipInsert()**](KontaktnOsobyApi.md#personRelationshipInsert) | **PUT** /person/{personId}/relationship/ | přidání vztahu |
| [**personRelationshipSetPrimaryEdit()**](KontaktnOsobyApi.md#personRelationshipSetPrimaryEdit) | **POST** /person/{personId}/relationship/{relationshipId}/setPrimary/ | nastavení primárního vztahu s klientem |
| [**personTagDelete()**](KontaktnOsobyApi.md#personTagDelete) | **DELETE** /person/{personId}/tag/ | smazání TAGu z kontaktní osoby |
| [**personTagInsert()**](KontaktnOsobyApi.md#personTagInsert) | **PUT** /person/{personId}/tag/ | přidání TAGu ke kontaktní osobě |
| [**personUnlockEdit()**](KontaktnOsobyApi.md#personUnlockEdit) | **POST** /person/{personId}/unlock | odemčení kontaktní osoby |
| [**personValidEdit()**](KontaktnOsobyApi.md#personValidEdit) | **POST** /person/{personId}/valid | obnovení platnosti kontaktní osoby |


## `personAnonymizeEdit()`

```php
personAnonymizeEdit($person_id)
```

GDPR anonymize kontaktní osoby

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personAnonymizeEdit($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personAnonymizeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personDelete()`

```php
personDelete($person_id)
```

smazání kontaktní osoby



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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personDelete($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personDetailGet()`

```php
personDetailGet($person_id)
```

detail kontaktní osoby

Získání detailu kontaktní osoby. V detailu kontaktní osoby je uvedena kontaktní osoba se všemi evidovanými údaji včetně všech evidovaných vztahů k jednotlivým klientům. Pokud záznam kontaktní osoby obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/person/3/ ```

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personDetailGet($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personEdit()`

```php
personEdit($person_id, $person_edit_dto)
```

upravení kontaktní osoby

Upravení dat kontaktní osoby

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$person_edit_dto = {"titleBefore":"Ing.","firstName":"Marie","lastName":"Vyležíková","titleAfter":"Phd.","owner":1,"category":96,"personClassification1":97,"personClassification2":98,"personClassification3":99,"salutation":"pani","birthday":"2022-06-10","language":70,"maritalStatus":78,"gender":"FEMALE","contactInfo":{"email":"podpora@raynet.cz","email2":"13123@4123.cz","tel1":"+420 553 401 547","tel1Type":"mobil","tel2":"13213","tel2Type":"mobil","www":"www.w.cz","fax":"+ 420 321 987 377","otherContact":"další informace","doNotSendMM":false},"socialNetworkContact":{"facebook":"vylezikovaface"},"privateAddress":{"city":"Ostrava-Poruba","country":"Česká republika","province":"Moravskoslezský kraj","street":"Francouzská 5","zipCode":"708 00"},"notice":"poznamka","customFields":{"VIP_b91d1":false},"keyman":false}; // \RaynetApiClient\Model\PersonEditDto

try {
    $apiInstance->personEdit($person_id, $person_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **person_edit_dto** | [**\RaynetApiClient\Model\PersonEditDto**](../Model/PersonEditDto.md)|  | [optional] |

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

## `personGet()`

```php
personGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags)
```

seznam kontaktních osob

``` https://app.raynet.cz/api/v2/person/?offset=0&limit=1&firstName[LIKE]=Jan% ```

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených kontaktních osob je `1000`
$sort_column = firstName; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$first_name = 'first_name_example'; // string | Filtrování kontaktních osob podle křestního jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$last_name = Novak; // string | Filtrování kontaktních osob podle příjmení. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$owner = 1; // int | Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id).
$primary_relationship_company_name = RAY; // string | Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$primary_relationship_company_id = 1; // int | Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru `EQ`, `NE`
$person_relationship = 56; // int | Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor `CUSTOM`.
$user_account_id = 3; // int | Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru `EQ`, `NE`. Jako hodnotu lze zadat i `prázdný řetězec`, např. pro vyfiltrování kontaktních osob bez uživ. účtu.
$contact_info_email = test@test.cz; // string | Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$contact_info_email2 = test@test.cz; // string | Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných kontaktních osob. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$gdpr_template = 56; // int | Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor `CUSTOM`.
$without_gdpr = 'without_gdpr_example'; // string | Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor `CUSTOM`.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->personGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **fulltext** | **string**| Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. | [optional] |
| **first_name** | **string**| Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **last_name** | **string**| Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **owner** | **int**| Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). | [optional] |
| **primary_relationship_company_name** | **string**| Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **primary_relationship_company_id** | **int**| Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; | [optional] |
| **person_relationship** | **int**| Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
| **user_account_id** | **int**| Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. | [optional] |
| **contact_info_email** | **string**| Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **contact_info_email2** | **string**| Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
| **gdpr_template** | **int**| Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
| **without_gdpr** | **string**| Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. | [optional] |
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

## `personInsert()`

```php
personInsert($person_insert_dto): \RaynetApiClient\Model\Insert201Response
```

založení nové kontaktní osoby



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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_insert_dto = {"titleBefore":"Ing.","firstName":"Marie","lastName":"Vyležíková","titleAfter":"Phd.","owner":1,"category":96,"personClassification1":97,"personClassification2":98,"personClassification3":99,"salutation":"pani","birthday":"2022-06-10","language":70,"maritalStatus":78,"gender":"FEMALE","contactInfo":{"email":"podpora@raynet.cz","email2":"13123@4123.cz","tel1":"+420 553 401 547","tel1Type":"mobil","tel2":"13213","tel2Type":"mobil","www":"www.w.cz","fax":"+ 420 321 987 377","otherContact":"další informace","doNotSendMM":false},"privateAddress":{"city":"Ostrava-Poruba","country":"Česká republika","province":"Moravskoslezský kraj","street":"Francouzská 5","zipCode":"708 00"},"notice":"poznamka","relationship":{"company":1,"companyAddress":1,"notice":"Podpora pro zákazníky","type":"podpora"},"tags":["tag 1","tag 2"],"keyman":false}; // \RaynetApiClient\Model\PersonInsertDto

try {
    $result = $apiInstance->personInsert($person_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_insert_dto** | [**\RaynetApiClient\Model\PersonInsertDto**](../Model/PersonInsertDto.md)|  | [optional] |

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

## `personInvalidEdit()`

```php
personInvalidEdit($person_id)
```

zneplatnění kontaktní osoby

Zneplatnění záznamu kontaktní osoby.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personInvalidEdit($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personLockEdit()`

```php
personLockEdit($person_id)
```

uzamčení kontaktní osoby

Uzamčení záznamu kontaktní osoby pro editaci.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personLockEdit($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personMergeEdit()`

```php
personMergeEdit($person_id, $source_person_id)
```

Sloučení duplicitní kontaktní osoby

Při sloučení dojde k převedení všech dat ze zdrojové kontaktní osoby do cílové kontaktní osoby s následným smazáním zdrojové kontaktní osoby. Podrobnosti o slučování najdete v [tomto článku](https://podpora.raynet.cz/hc/cs/articles/360000822106).

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data
$source_person_id = 123; // int | ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána

try {
    $apiInstance->personMergeEdit($person_id, $source_person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personMergeEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data | |
| **source_person_id** | **int**| ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána | |

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

## `personRelationshipDelete()`

```php
personRelationshipDelete($person_id, $relationship_id)
```

smazání vztahu

U kontaktní osoby s identifikátorem `personId` bude smazán vztah ke klientovi s identifikátorem `relationshipId`.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$relationship_id = 123; // int | ID vztahu s klientem

try {
    $apiInstance->personRelationshipDelete($person_id, $relationship_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personRelationshipDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **relationship_id** | **int**| ID vztahu s klientem | |

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

## `personRelationshipEdit()`

```php
personRelationshipEdit($person_id, $relationship_id, $person_relationship_edit_dto)
```

upravení vztahu



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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$relationship_id = 123; // int | ID vztahu s klientem
$person_relationship_edit_dto = {"company":1,"companyAddress":1,"notice":"Podpora pro zákazníky","type":"podpora"}; // \RaynetApiClient\Model\PersonRelationshipEditDto

try {
    $apiInstance->personRelationshipEdit($person_id, $relationship_id, $person_relationship_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personRelationshipEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **relationship_id** | **int**| ID vztahu s klientem | |
| **person_relationship_edit_dto** | [**\RaynetApiClient\Model\PersonRelationshipEditDto**](../Model/PersonRelationshipEditDto.md)|  | [optional] |

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

## `personRelationshipInsert()`

```php
personRelationshipInsert($person_id, $person_relationship_insert_dto): \RaynetApiClient\Model\Insert201Response
```

přidání vztahu

Přidání nového vztahu kontaktní osoby s identifikátorem `personId` ke klientovi. Vztah bude zařazen mezi vedlejší vztahy.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$person_relationship_insert_dto = {"company":1,"companyAddress":1,"notice":"Podpora pro zákazníky","type":"podpora"}; // \RaynetApiClient\Model\PersonRelationshipInsertDto

try {
    $result = $apiInstance->personRelationshipInsert($person_id, $person_relationship_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personRelationshipInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **person_relationship_insert_dto** | [**\RaynetApiClient\Model\PersonRelationshipInsertDto**](../Model/PersonRelationshipInsertDto.md)|  | [optional] |

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

## `personRelationshipSetPrimaryEdit()`

```php
personRelationshipSetPrimaryEdit($person_id, $relationship_id)
```

nastavení primárního vztahu s klientem

U kontaktní osoby s identifikátorem `personId` bude nastavena nový primární vztah s identifikátorem `relationshipId`. Tento klient se bude zobrazovat u kontaktní osoby jako hlavní (první). Vztah, který byl doposud jako primární, bude zařazen mezi vedlejší vztahy.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$relationship_id = 123; // int | ID vztahu s klientem

try {
    $apiInstance->personRelationshipSetPrimaryEdit($person_id, $relationship_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personRelationshipSetPrimaryEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **relationship_id** | **int**| ID vztahu s klientem | |

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

## `personTagDelete()`

```php
personTagDelete($person_id, $person_tag_delete_dto)
```

smazání TAGu z kontaktní osoby



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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$person_tag_delete_dto = {"tag":"muj tag"}; // \RaynetApiClient\Model\PersonTagDeleteDto

try {
    $apiInstance->personTagDelete($person_id, $person_tag_delete_dto);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personTagDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **person_tag_delete_dto** | [**\RaynetApiClient\Model\PersonTagDeleteDto**](../Model/PersonTagDeleteDto.md)|  | [optional] |

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

## `personTagInsert()`

```php
personTagInsert($person_id, $person_tag_insert_dto)
```

přidání TAGu ke kontaktní osobě



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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby
$person_tag_insert_dto = {"tag":"muj tag"}; // \RaynetApiClient\Model\PersonTagInsertDto

try {
    $apiInstance->personTagInsert($person_id, $person_tag_insert_dto);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personTagInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |
| **person_tag_insert_dto** | [**\RaynetApiClient\Model\PersonTagInsertDto**](../Model/PersonTagInsertDto.md)|  | [optional] |

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

## `personUnlockEdit()`

```php
personUnlockEdit($person_id)
```

odemčení kontaktní osoby

Odemčení záznamu kontaktní osoby k editaci.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personUnlockEdit($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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

## `personValidEdit()`

```php
personValidEdit($person_id)
```

obnovení platnosti kontaktní osoby

Obnovení platnosti záznamu kontaktní osoby.

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


$apiInstance = new RaynetApiClient\Api\KontaktnOsobyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$person_id = 123; // int | ID kontaktní osoby

try {
    $apiInstance->personValidEdit($person_id);
} catch (Exception $e) {
    echo 'Exception when calling KontaktnOsobyApi->personValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **person_id** | **int**| ID kontaktní osoby | |

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
