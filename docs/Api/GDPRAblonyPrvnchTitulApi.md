# RaynetApiClient\GDPRAblonyPrvnchTitulApi

All URIs are relative to https://app.raynet.cz/api/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**gdprTemplateGet()**](GDPRAblonyPrvnchTitulApi.md#gdprTemplateGet) | **GET** /gdprTemplate/ | seznam šablon právních titulů |


## `gdprTemplateGet()`

```php
gdprTemplateGet($offset, $limit, $sort_column, $sort_direction, $id, $name, $legal_title, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view)
```

seznam šablon právních titulů

Získání seznamu šablon právních titulů. Tento seznam může být filtrován, řazen a stránkován za použítí níže uvedených parametrů.  ``` https://app.raynet.cz/api/v2/gdprTemplate/?name[LIKE]=RAY% ```

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


$apiInstance = new RaynetApiClient\Api\GDPRAblonyPrvnchTitulApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených záznamů je `1000`
$sort_column = name; // string | 
$sort_direction = ASC; // string | 
$id = 3; // int | Filtrování šablon právních titulů podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$name = RAY; // string | Filtrování šablon právních titulů podle názvu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$legal_title = LEGITIMATE_INTEREST; // string | Filtrování šablon právních titulů podle typu právního titulu (`LEGITIMATE_INTEREST`, `CONSENT`, `CONTRACT`, `LEGAL_OBLIGATION`, `PUBLIC_INTEREST`, `VITAL_INTEREST`)
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování šablon právních titulů podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování šablon právních titulů podle posledního data upravení klienta. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování šablon právních titulů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.

try {
    $apiInstance->gdprTemplateGet($offset, $limit, $sort_column, $sort_direction, $id, $name, $legal_title, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view);
} catch (Exception $e) {
    echo 'Exception when calling GDPRAblonyPrvnchTitulApi->gdprTemplateGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offset** | **int**| Zobrazeni zaznamu od zacatku | [optional] |
| **limit** | **int**| Maximální počet vrácených záznamů je &#x60;1000&#x60; | [optional] |
| **sort_column** | **string**|  | [optional] |
| **sort_direction** | **string**|  | [optional] |
| **id** | **int**| Filtrování šablon právních titulů podle ID. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **name** | **string**| Filtrování šablon právních titulů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; | [optional] |
| **legal_title** | **string**| Filtrování šablon právních titulů podle typu právního titulu (&#x60;LEGITIMATE_INTEREST&#x60;, &#x60;CONSENT&#x60;, &#x60;CONTRACT&#x60;, &#x60;LEGAL_OBLIGATION&#x60;, &#x60;PUBLIC_INTEREST&#x60;, &#x60;VITAL_INTEREST&#x60;) | [optional] |
| **row_info_created_at** | **string**| Filtrování šablon právních titulů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_updated_at** | **string**| Filtrování šablon právních titulů podle posledního data upravení klienta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; | [optional] |
| **row_info_last_modified_at** | **string**| Filtrování šablon právních titulů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. | [optional] |
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
