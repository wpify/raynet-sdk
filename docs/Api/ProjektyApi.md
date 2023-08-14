# RaynetApiClient\ProjektyApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**projectDelete()**](ProjektyApi.md#projectDelete) | **DELETE** /project/{projectId}/ | smazání projektu |
| [**projectDetailGet()**](ProjektyApi.md#projectDetailGet) | **GET** /project/{projectId}/ | detail projektu |
| [**projectEdit()**](ProjektyApi.md#projectEdit) | **POST** /project/{projectId}/ | upravení projektu |
| [**projectGet()**](ProjektyApi.md#projectGet) | **GET** /project/ | seznam projektů |
| [**projectInsert()**](ProjektyApi.md#projectInsert) | **PUT** /project/ | nový projekt |
| [**projectInvalidEdit()**](ProjektyApi.md#projectInvalidEdit) | **POST** /project/{projectId}/invalid | zneplatnění projektu |
| [**projectLockEdit()**](ProjektyApi.md#projectLockEdit) | **POST** /project/{projectId}/lock | uzamčení projektu |
| [**projectParticipantsDelete()**](ProjektyApi.md#projectParticipantsDelete) | **DELETE** /project/{projectId}/participants/{participantId} | smazání participanta z projektu |
| [**projectParticipantsDetailGet()**](ProjektyApi.md#projectParticipantsDetailGet) | **GET** /project/{projectId}/participants/ | seznam participantů projektu |
| [**projectParticipantsInsert()**](ProjektyApi.md#projectParticipantsInsert) | **PUT** /project/{projectId}/participants/ | nový participant projektu |
| [**projectUnlockEdit()**](ProjektyApi.md#projectUnlockEdit) | **POST** /project/{projectId}/unlock | odemčení projektu |
| [**projectValidEdit()**](ProjektyApi.md#projectValidEdit) | **POST** /project/{projectId}/valid | obnovení platnosti projektu |


## `projectDelete()`

```php
projectDelete($project_id)
```

smazání projektu



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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectDelete($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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

## `projectDetailGet()`

```php
projectDetailGet($project_id)
```

detail projektu

Získání detailu projektu. Pokud záznam projektu obsahuje volitelná pole, ve výstupu nejsou přítomná pole, která obsahují prázdnou hodnotu (z optimalizačních důvodů).  ``` https://app.raynet.cz/api/v2/project/1/ ```

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectDetailGet($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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

## `projectEdit()`

```php
projectEdit($project_id, $project_edit_dto)
```

upravení projektu

Upravení dat projektu

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu
$project_edit_dto = {"name":"Testovací projekt upravený","company":4,"person":9,"owner":2,"totalAmount":34700,"avgValue.totalAmount":34700,"minValue.totalAmount":34700,"maxValue.totalAmount":34700,"projectStatus":60,"validFrom":"2022-02-21","scheduledEnd":"2022-04-29","description":"Poznámka lehce upravená"}; // \RaynetApiClient\Model\ProjectEditDto

try {
    $apiInstance->projectEdit($project_id, $project_edit_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |
| **project_edit_dto** | [**\RaynetApiClient\Model\ProjectEditDto**](../Model/ProjectEditDto.md)|  | [optional] |

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

## `projectGet()`

```php
projectGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project_status, $category, $owner, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags)
```

seznam projektů

Získání seznamu projektů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/project/?offset=0&limit=1&name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
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
$code = PRO-15-001; // string | Filtrování projektu podle kódu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$name = RAY; // string | Filtrování projektu podle jména. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 1; // int | Filtrování projektu podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id)
$project_status = 1; // int | Filtrování projektu podle stavu (ProjectStatus). Filtruje se podle jednoznačného identifikátoru stavu (id)
$category = 1; // int | Filtrování projektu podle kategorie (ProjectCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id)
$owner = 1; // int | Filtrování projektu podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id)
$valid_from = 2022-06-01; // string | Filtrování projektu podle data otevření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$valid_till = 2022-06-01; // string | Filtrování projektu podle data uzavření. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování projektu podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování projektu podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování projektu podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$row_info_row_access = INVALID; // string | Filtrování zneplatněných projektů. Lze využít operátoru `EQ`, `NE`, `EQ_OR_NULL`, `NE_OR_NULL`
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->projectGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project_status, $category, $owner, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectGet: ', $e->getMessage(), PHP_EOL;
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
| **code** | **string**| Filtrování projektu podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **name** | **string**| Filtrování projektu podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **int**| Filtrování projektu podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) | [optional] |
| **project_status** | **int**| Filtrování projektu podle stavu (ProjectStatus). Filtruje se podle jednoznačného identifikátoru stavu (id) | [optional] |
| **category** | **int**| Filtrování projektu podle kategorie (ProjectCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) | [optional] |
| **owner** | **int**| Filtrování projektu podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) | [optional] |
| **valid_from** | **string**| Filtrování projektu podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **valid_till** | **string**| Filtrování projektu podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování projektu podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování projektu podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování projektu podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
| **row_info_row_access** | **string**| Filtrování zneplatněných projektů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; | [optional] |
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

## `projectInsert()`

```php
projectInsert($project_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový projekt

Založení nového projektu

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_insert_dto = {"name":"Testovací projekt nový","company":4,"person":9,"owner":2,"totalAmount":34700,"avgValue.totalAmount":34700,"minValue.totalAmount":34700,"maxValue.totalAmount":34700,"validFrom":"2022-02-21","scheduledEnd":"2022-04-29","projectStatus":45,"description":"Poznámka nová","tags":["Štítek1","Štítek2"]}; // \RaynetApiClient\Model\ProjectInsertDto

try {
    $result = $apiInstance->projectInsert($project_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_insert_dto** | [**\RaynetApiClient\Model\ProjectInsertDto**](../Model/ProjectInsertDto.md)|  | [optional] |

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

## `projectInvalidEdit()`

```php
projectInvalidEdit($project_id)
```

zneplatnění projektu

Zneplatnění záznamu projektu.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectInvalidEdit($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectInvalidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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

## `projectLockEdit()`

```php
projectLockEdit($project_id)
```

uzamčení projektu

Uzamčení záznamu projektu pro editaci.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectLockEdit($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectLockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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

## `projectParticipantsDelete()`

```php
projectParticipantsDelete($project_id, $participant_id)
```

smazání participanta z projektu

U projektu s identifikátorem `projectId` bude smazán participant s identifikátorem `participantId`.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu
$participant_id = 321; // int | ID participanta

try {
    $apiInstance->projectParticipantsDelete($project_id, $participant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectParticipantsDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |
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

## `projectParticipantsDetailGet()`

```php
projectParticipantsDetailGet($project_id, $offset, $limit, $sort_column, $sort_direction, $note, $company, $company_name, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam participantů projektu

Získání seznamu participantů projektu. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/project/4/participants/?offset=0&limit=1&company-name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu
$offset = 0; // int | Zobrazení záznamu od začátku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$note = Pozor; // string | Filtrování participantů projektu podle poznámky. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$company = 3; // string | Filtrování participantů projektu podle jednoznačného identifikátoru klienta (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$company_name = RAY; // string | Filtrování participantů projektu podle názvu klienta. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$person = 3; // string | Filtrování participantů projektu podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování participantů projektu podle data vytvoření participanta. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování participantů projektu podle posledního data upravení participanta. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování projektu podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->projectParticipantsDetailGet($project_id, $offset, $limit, $sort_column, $sort_direction, $note, $company, $company_name, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectParticipantsDetailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |
| **offset** | **int**| Zobrazení záznamu od začátku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **note** | **string**| Filtrování participantů projektu podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **company** | **string**| Filtrování participantů projektu podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **company_name** | **string**| Filtrování participantů projektu podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **person** | **string**| Filtrování participantů projektu podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_created_at** | **string**| Filtrování participantů projektu podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování participantů projektu podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování projektu podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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

## `projectParticipantsInsert()`

```php
projectParticipantsInsert($project_id, $project_participants_insert_dto): \RaynetApiClient\Model\Insert201Response
```

nový participant projektu

Přidání nového participanta k projektu s identifikátorem `projectId`. Je možné přidat buď klienta nebo kontaktní osobu. V rámci volání API musí být obsažena právě jedna reference na klienta nebo kontaktní osobu.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu
$project_participants_insert_dto = {"company":1,"category":123,"note":"Poznámka k participantovi"}; // \RaynetApiClient\Model\ProjectParticipantsInsertDto

try {
    $result = $apiInstance->projectParticipantsInsert($project_id, $project_participants_insert_dto);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectParticipantsInsert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |
| **project_participants_insert_dto** | [**\RaynetApiClient\Model\ProjectParticipantsInsertDto**](../Model/ProjectParticipantsInsertDto.md)|  | [optional] |

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

## `projectUnlockEdit()`

```php
projectUnlockEdit($project_id)
```

odemčení projektu

Odemčení záznamu projektu k editaci.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectUnlockEdit($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectUnlockEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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

## `projectValidEdit()`

```php
projectValidEdit($project_id)
```

obnovení platnosti projektu

Obnovení platnosti záznamu projektu.

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


$apiInstance = new RaynetApiClient\Api\ProjektyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 123; // int | ID projektu

try {
    $apiInstance->projectValidEdit($project_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjektyApi->projectValidEdit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **int**| ID projektu | |

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
