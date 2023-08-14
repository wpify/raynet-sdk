# OpenAPIClient-php

Cloud CRM REST API je programové rozhraní systému RAYNET CRM, které umožňuje pracovat s daty uvnitř CRM z aplikací třetích stran. Komunikace probíhá standardním protokolem HTTP s ohledem na [REST](https://en.wikipedia.org/wiki/Representational_state_transfer) principy.
## Připojení k RAYNET CRM
Komunikačním protokolem je HTTP, proto je možné použít libovolnou aplikaci nebo knihovnu, která tento protokol podporuje. Pro demonstraci bude využita aplikace [curl](https://curl.haxx.se/). Alternativou je například add-on [Talend API Tester](https://chrome.google.com/webstore/detail/talend-api-tester-free-ed/aejoelaoggembcahagimdiliamlcdmfm) do prohlížeče Google Chrome. Přístup je zabezpečen pomocí basic authentication (uživatelským jménem a API klíčem) a šifrován protokolem TLSv1.2 a vyšším (HTTPS) pro zajištění maximální bezpečnosti. V hlavičce požadavku je nutné zaslat název Vaší instance (např. `moje-crm`).

```bash
  curl -X GET -u 'uzivatel:api-klic' -H 'X-Instance-Name: moje-crm' 'https://app.raynet.cz/api/v2/company/'
```

## Datové typy

Hodnoty jednotlivých atributů v systému RAYNET CRM jsou tvořeny několika základními datovými typy:

+ `Řetězec` - Textová hodnota.

+ `Číslo` - Číselná hodnota. V závislosti na kontextu se může jednat buď o číslo celé nebo o číslo desetinné. V desetinných číslech se používá desetinná tečka.

+ `Pravdivostní hodnota` - Hodnota ANO/NE. Pro hodnotu ANO lze využít true, on, yes a 1; pro hodnotu NE pak false, off, no a 0.

+ `Datum` - Datum jako řetězec ve formátu `yyyy-MM-dd`.

+ `Datum a čas` - Datum a čas jako řetězec ve formátu `yyyy-MM-dd HH:mm`. Akceptovány jsou také datum a čas ve formátu ISO8601 (např. `2022-01-01T12:00:00.000+01:00`).

+ `Reference` - Datový typ reference odkazuje na jiný záznam v systému RAYNET CRM. V příchozích datech je reference mapou (JavaScriptový objektem), která obsahuje klíče:
  + id - Identifikátor referencovaného záznamu.

### Datum a čas

Datum a čas jako řetězec ve formátu `yyyy-MM-dd HH:mm` je v časové zóně uživatele, přes kterého jsou API požadavky realizovány. Pro filtrování a zápis (`PUT`, `POST`) je možné využít oba formáty (`yyyy-MM-dd HH:mm`, ISO8601).

V response je ve výchozím stavu datum a čas formátován jako `yyyy-MM-dd HH:mm` v časové zóně uživatele. Přidáním parametru `dateFormat=ISO8601` lze ovlivnit výstupní formát, kdy bude hodnota formátována do tvaru `2022-01-01T12:00:00.000+01:00`.
např. `https://ww....company/?dateFormat=ISO8601`

## Filtrování seznamu

Operátory pracující nad atributy a hodnotami jsou následující:

+ `EQ` - Test na rovnost hodnot.
+ `EQ_OR_NULL` - Test na rovnost nebo prázdnou hodnotu.

+ `NE` - Test na nerovnost hodnot.

+ `NE_OR_NULL` - Test na nerovnost nebo prázdnou hodnotu.

+ `LT` - Hodnota v databázi je menší než zadaná.

+ `LE` - Hodnota v databázi je menší nebo rovna než zadaná.

+ `GT` - Hodnota v databázi je větší než zadaná.

+ `GE` - Hodnota v databázi je větší nebo rovna než zadaná.

+ `LIKE` - Test na hodnotu odpovídající výrazu (např. hodnota filtru ABC% nalezne všechny záznamy, které začínají znaky ABC).

+ `LIKE_NOCASE` - Obdoba LIKE, ale bez ohledu na malá a velká písmena.

+ `IN` - Test na rovnost (více) hodnot oddělených čárkou. Správný formát vstupu je např.: `1,2,3,4`.

+ `NOT_IN` - Test na nerovnost (více) hodnot oddělených čárkou. Správný formát vstupu je např.: `1,2,3,4`.

+ `CUSTOM` - Speciální operátor - chování testu je popsáno dále v dokumentaci.

Výchozím operátorem je rovnost `EQ`. Operátor se zapisuje do hranatých závorek za název atributu. Je tak možné zadat více filtrovacích kritérií nad stejným atributem. `https://app..../?validFrom[GT]=\"2014-06-01\"&validTill[LT]=\"2014-06-10\"`
Častým scénářem je vyfiltrování všech záznamů, které mají daný atribut prázdný nebo naopak neprázdný. Pro tyto účely lze použít hodnotu `prázdný řetězec` v kombinaci s operátorem `EQ` nebo `NE`.

## Uspořádání seznamu

Uspořádání seznamu je kontrolováno parametrem `sortColumn` a `sortDirection`. U každého API je výčet hodnot, pomocí kterých lze seznam řadit. Parametr `sortDirection` může nabývat hodnot:

+ `ASC` - Hodnoty jsou řazeny vzestupně

+ `DESC` - Hodnoty jsou řazeny sestupně

## Stránkování seznamu

Seznam je možné stránkovat nastavením parametrů `offset` a `limit`. Offset udává první záznam, který bude zobrazen, limit pak počet záznamů. Maximální velikost stránky je 1 000 položek. Například `https://app..../?offset=0&limit=2`

## Fulltext

Ve většině seznamů je možné využít fulltextové vyhledání podle zadaného textového řetězce. Slouží k tomu parametr `fulltext`, který se aplikuje např. takto: `https://app..../?fulltext=nejakytext`

## Limity API

Každá API odpověď obsahuje hlavičky, které popisují stav využití API pro danou instanci.

```
curl -X GET -u 'uzivatel:api-klic' -H 'X-Instance-Name: moje-crm' 'https://app.raynet.cz/api/v2/company/'

HTTP/1.1 200 OK
Status: 200 OK
X-Ratelimit-Limit: 24000
X-Ratelimit-Remaining: 23999
X-Ratelimit-Reset: 1508889600
```

Význam jednotlivých hlaviček je následující:

| Hlavička | Význam |
| -------- | ------ |
| X-Ratelimit-Limit | Celkový limit pro aktuální časové okno a instanci. |
| X-Ratelimit-Remaining | Zbývající počet požadavků. |
| X-Ratelimit-Reset | Čas, kdy bude vyprší časové okno a limit bude resetován. Hodnota udává [unixový čas](https://cs.wikipedia.org/wiki/Unixov%C3%BD_%C4%8Das). |

Pokud je limit překročen, je navrácena chybová hláška s HTTP kódem `429 Too Many Requests`:

```json
{
  \"type\": \"RequestLimitReached\",
  \"message\": \"API request limit reached. See the X-RateLimit-* headers and check out the API documentation for more details.\"
}
```

### Co když mi limity nestačí

Ve výchozím stavu je přístup limitován na 24 000 požadavků za den (uvažováno od půlnoci do další půlnoci v časové zóně UTC). V případě, že limit pro vaši integraci nestačí, kontaktujte naší zákaznickou podporu na e-mailu podpora@raynet.cz a spolu se určitě dobereme vhodného řešení.

### Špatné přihlášení

V případě zaslaní více než 20 požadavků se špatnými přihlašovacími údaji, bude tento přístup na 60 minut zablokován. Toto omezení platí pro konkrétní IP adresu.


## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/wpify/raynet-api-php-sdk.git"
    }
  ],
  "require": {
    "wpify/raynet-api-php-sdk": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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


$apiInstance = new RaynetApiClient\Api\AktivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offset = 0; // int | Zobrazeni zaznamu od zacatku
$limit = 100; // int | Maximální počet vrácených událostí je `1000`
$sort_column = id; // string | 
$sort_direction = ASC; // string | 
$fulltext = myText; // string | Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá.
$id = 3; // int | Filtrování aktivit podle ID. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$title = myTag; // string | Filtrování aktivit podle předmětu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$scheduled_from = 2022-06-01 10:00; // string | Filtrování aktivit podle data naplánování (\"od\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$scheduled_till = 2022-06-01 10:00; // string | Filtrování aktivit podle data naplánování (\"do\"). Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$completed = 2022-06-01 10:00; // string | Filtrování aktivit podle data realizování. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$category_id = 3; // int | Filtrování aktivit podle ID kategorie. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$status = SCHEDULED; // string | Filtrování aktivit podle statusu. Lze využít operátoru `EQ`, `NE`, `LIKE`, `LIKE_NOCASE`
$owner_id = 3; // int | Filtrování aktivit podle ID kontaktní osoby, která je vlastníkem aktivity. Lze využít operátoru `EQ`, `NE`, `GT`, `GE`, `LT`, `LE`
$person_filter = 3; // int | Filtrování aktivit podle ID kontaktní osoby, která je participantem. Nelze využít standardních operátorů.
$company_context_filter = 3; // int | Filtrování aktivit podle ID klienta, kterého se aktivity týkají (klient je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$lead_context_filter = 3; // int | Filtrování aktivit podle ID leadu, kterého se aktivity týkají (lead je napojený v kontextu nebo je participantem). Nelze využít standardních operátorů.
$business_case = 3; // int | Filtrování aktivit podle ID obchodního případu, kterého se události týkají. Lze využít operátoru `EQ`, `NE`, `IN`, `NOT_IN`
$row_info_created_at = 2022-06-01 10:00; // string | Filtrování aktivit podle data vytvoření. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_updated_at = 2022-06-01 10:00; // string | Filtrování aktivit podle posledního data upravení. Lze využít operátoru `GT`, `GE`, `LT`, `LE`
$row_info_last_modified_at = 2022-06-01 10:00; // string | Filtrování aktivit podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru `GT`, `GE`, `LT`, `LE`. Vhodné pro periodickou detekci změn.
$view = rowInfo; // string | Pokud je hodnota rovna `rowInfo`, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn.
$tags = tags; // string | Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (`tag1,tag2`).

try {
    $apiInstance->activityGet($offset, $limit, $sort_column, $sort_direction, $fulltext, $id, $title, $scheduled_from, $scheduled_till, $completed, $category_id, $status, $owner_id, $person_filter, $company_context_filter, $lead_context_filter, $business_case, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags);
} catch (Exception $e) {
    echo 'Exception when calling AktivityApi->activityGet: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://app.raynet.cz/api/v2*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AktivityApi* | [**activityGet**](docs/Api/AktivityApi.md#activityget) | **GET** /activity/ | seznam aktivit
*AktivityApi* | [**lockEdit**](docs/Api/AktivityApi.md#lockedit) | **POST** /{activityType}/{activityId}/lock | uzamčení aktivity
*AktivityApi* | [**unlockEdit**](docs/Api/AktivityApi.md#unlockedit) | **POST** /{activityType}/{activityId}/unlock | odemčení aktivity
*BezpenostnRovnApi* | [**securityLevelDelete**](docs/Api/BezpenostnRovnApi.md#securityleveldelete) | **DELETE** /securityLevel/{securityLevelId}/ | smazání bezpečnostní úrovně
*BezpenostnRovnApi* | [**securityLevelGet**](docs/Api/BezpenostnRovnApi.md#securitylevelget) | **GET** /securityLevel/ | seznam bezpečnostních úrovní
*BezpenostnRovnApi* | [**securityLevelInsert**](docs/Api/BezpenostnRovnApi.md#securitylevelinsert) | **PUT** /securityLevel/ | nová bezpečnostní úroveň
*BezpenostnRovnApi* | [**securityLevelMultiAddUserEdit**](docs/Api/BezpenostnRovnApi.md#securitylevelmultiadduseredit) | **POST** /securityLevel/{securityLevelId}/multiAddUser | hromadné přidání uživatelů do bezpečnostní úrovně
*BezpenostnRovnApi* | [**securityLevelMultiRemoveUserEdit**](docs/Api/BezpenostnRovnApi.md#securitylevelmultiremoveuseredit) | **POST** /securityLevel/{securityLevelId}/multiRemoveUser | hromadné odebrání uživatelů z bezpečnostní úrovně
*CenkyApi* | [**priceListDelete**](docs/Api/CenkyApi.md#pricelistdelete) | **DELETE** /priceList/{priceListId}/ | smazání ceníku
*CenkyApi* | [**priceListDetailGet**](docs/Api/CenkyApi.md#pricelistdetailget) | **GET** /priceList/{priceListId}/ | detail ceníku
*CenkyApi* | [**priceListEdit**](docs/Api/CenkyApi.md#pricelistedit) | **POST** /priceList/{priceListId}/ | upravení ceníku
*CenkyApi* | [**priceListGet**](docs/Api/CenkyApi.md#pricelistget) | **GET** /priceList/ | seznam ceníků
*CenkyApi* | [**priceListInsert**](docs/Api/CenkyApi.md#pricelistinsert) | **PUT** /priceList/ | nový ceník
*CenkyApi* | [**priceListItemBulkUpsertEdit**](docs/Api/CenkyApi.md#pricelistitembulkupsertedit) | **POST** /priceList/{priceListId}/itemBulkUpsert/ | hromadné přidání/upravení položek ceníku
*CenkyApi* | [**priceListItemDelete**](docs/Api/CenkyApi.md#pricelistitemdelete) | **DELETE** /priceList/{priceListId}/item/{priceListItemId}/ | smazání položky ceníku
*CenkyApi* | [**priceListItemEdit**](docs/Api/CenkyApi.md#pricelistitemedit) | **POST** /priceList/{priceListId}/item/{priceListItemId}/ | upravení položky ceníku
*CenkyApi* | [**priceListItemInsert**](docs/Api/CenkyApi.md#pricelistiteminsert) | **PUT** /priceList/{priceListId}/item/ | přidání položek ceníku
*CenkyApi* | [**priceListItemsDetailGet**](docs/Api/CenkyApi.md#pricelistitemsdetailget) | **GET** /priceList/{priceListId}/items/ | seznam položek ceníku
*CenkyApi* | [**priceListLockEdit**](docs/Api/CenkyApi.md#pricelistlockedit) | **POST** /priceList/{priceListId}/lock | uzamčení ceníku
*CenkyApi* | [**priceListUnlockEdit**](docs/Api/CenkyApi.md#pricelistunlockedit) | **POST** /priceList/{priceListId}/unlock | odemčení ceníku
*DiskuzeApi* | [**postDelete**](docs/Api/DiskuzeApi.md#postdelete) | **DELETE** /{entityName}/{entityId}/post/{postId}/ | smazání příspěvku z diskuze
*DiskuzeApi* | [**postDetailGet**](docs/Api/DiskuzeApi.md#postdetailget) | **GET** /{entityName}/{entityId}/post/ | seznam příspěvků diskuze
*DiskuzeApi* | [**postInsert**](docs/Api/DiskuzeApi.md#postinsert) | **PUT** /{entityName}/{entityId}/post/ | nový příspěvek do diskuze
*DiskuzeApi* | [**watcherDelete**](docs/Api/DiskuzeApi.md#watcherdelete) | **DELETE** /{entityName}/{entityId}/watcher/{personId}/ | odebrání sledovače diskuze
*DiskuzeApi* | [**watcherDetailGet**](docs/Api/DiskuzeApi.md#watcherdetailget) | **GET** /{entityName}/{entityId}/watcher/ | seznam sledovačů diskuze
*DiskuzeApi* | [**watcherInsert**](docs/Api/DiskuzeApi.md#watcherinsert) | **PUT** /{entityName}/{entityId}/watcher/{personId}/ | přidání sledovače diskuze
*DopisApi* | [**letterDelete**](docs/Api/DopisApi.md#letterdelete) | **DELETE** /letter/{letterId}/ | smazání dopisu
*DopisApi* | [**letterDetailGet**](docs/Api/DopisApi.md#letterdetailget) | **GET** /letter/{letterId}/ | detail dopisu
*DopisApi* | [**letterEdit**](docs/Api/DopisApi.md#letteredit) | **POST** /letter/{letterId}/ | upravení dopisu
*DopisApi* | [**letterGet**](docs/Api/DopisApi.md#letterget) | **GET** /letter/ | seznam dopisů
*DopisApi* | [**letterInsert**](docs/Api/DopisApi.md#letterinsert) | **PUT** /letter/ | nový dopis
*EmailApi* | [**emailDelete**](docs/Api/EmailApi.md#emaildelete) | **DELETE** /email/{emailId}/ | smazání emailu
*EmailApi* | [**emailDetailGet**](docs/Api/EmailApi.md#emaildetailget) | **GET** /email/{emailId}/ | detail emailu
*EmailApi* | [**emailEdit**](docs/Api/EmailApi.md#emailedit) | **POST** /email/{emailId}/ | upravení emailu
*EmailApi* | [**emailGet**](docs/Api/EmailApi.md#emailget) | **GET** /email/ | seznam emailů
*EmailApi* | [**emailInsert**](docs/Api/EmailApi.md#emailinsert) | **PUT** /email/ | nový email
*ExternIdentifiktorApi* | [**extIdDelete**](docs/Api/ExternIdentifiktorApi.md#extiddelete) | **DELETE** /{entityName}/{entityId}/extId/{extId} | odstranění externího identifikátoru
*ExternIdentifiktorApi* | [**extIdInsert**](docs/Api/ExternIdentifiktorApi.md#extidinsert) | **PUT** /{entityName}/{entityId}/extId/ | přidání externího identifikátoru
*FakturyApi* | [**invoiceCancelEdit**](docs/Api/FakturyApi.md#invoicecanceledit) | **POST** /invoice/{invoiceId}/cancel | stornovat fakturu
*FakturyApi* | [**invoiceChangeCodeEdit**](docs/Api/FakturyApi.md#invoicechangecodeedit) | **POST** /invoice/{invoiceId}/changeCode | změna kódu faktury
*FakturyApi* | [**invoiceChangeDecimalPrecisionEdit**](docs/Api/FakturyApi.md#invoicechangedecimalprecisionedit) | **POST** /invoice/{invoiceId}/changeDecimalPrecision | změna počtu desetinných míst
*FakturyApi* | [**invoiceCreditNoteInsert**](docs/Api/FakturyApi.md#invoicecreditnoteinsert) | **PUT** /invoice/creditNote | nový dobropis
*FakturyApi* | [**invoiceDelete**](docs/Api/FakturyApi.md#invoicedelete) | **DELETE** /invoice/{invoiceId}/ | smazání faktury
*FakturyApi* | [**invoiceDetailGet**](docs/Api/FakturyApi.md#invoicedetailget) | **GET** /invoice/{invoiceId}/ | detail faktury
*FakturyApi* | [**invoiceEdit**](docs/Api/FakturyApi.md#invoiceedit) | **POST** /invoice/{invoiceId}/ | upravení faktury
*FakturyApi* | [**invoiceGet**](docs/Api/FakturyApi.md#invoiceget) | **GET** /invoice/ | seznam faktur
*FakturyApi* | [**invoiceInsert**](docs/Api/FakturyApi.md#invoiceinsert) | **PUT** /invoice/ | nová faktura
*FakturyApi* | [**invoiceLockEdit**](docs/Api/FakturyApi.md#invoicelockedit) | **POST** /invoice/{invoiceId}/lock | uzamčení faktury
*FakturyApi* | [**invoicePaymentDelete**](docs/Api/FakturyApi.md#invoicepaymentdelete) | **DELETE** /invoice/{invoiceId}/payment/{paymentId}/ | smazání platby
*FakturyApi* | [**invoicePaymentInsert**](docs/Api/FakturyApi.md#invoicepaymentinsert) | **PUT** /invoice/{invoiceId}/payment/ | přidání platby
*FakturyApi* | [**invoicePdfExportDetailGet**](docs/Api/FakturyApi.md#invoicepdfexportdetailget) | **GET** /invoice/{invoiceId}/pdfExport | export faktury do PDF
*FakturyApi* | [**invoiceRenewEdit**](docs/Api/FakturyApi.md#invoicerenewedit) | **POST** /invoice/{invoiceId}/renew | obnovení faktury
*FakturyApi* | [**invoiceUnlockEdit**](docs/Api/FakturyApi.md#invoiceunlockedit) | **POST** /invoice/{invoiceId}/unlock | odemčení faktury
*GDPRApi* | [**gdprDetailGet**](docs/Api/GDPRApi.md#gdprdetailget) | **GET** /gdpr/{gdprId}/ | detail právního titlulu
*GDPRApi* | [**gdprEdit**](docs/Api/GDPRApi.md#gdpredit) | **POST** /gdpr/{gdprId}/ | upravení právního titulu
*GDPRApi* | [**gdprGet**](docs/Api/GDPRApi.md#gdprget) | **GET** /gdpr/ | seznam právních titulů
*GDPRApi* | [**gdprInsert**](docs/Api/GDPRApi.md#gdprinsert) | **PUT** /gdpr/ | nový právní titul
*GDPRApi* | [**gdprInvalidEdit**](docs/Api/GDPRApi.md#gdprinvalidedit) | **POST** /gdpr/{gdprId}/invalid/ | zneplatnění právního titulu
*GDPRAblonyPrvnchTitulApi* | [**gdprTemplateGet**](docs/Api/GDPRAblonyPrvnchTitulApi.md#gdprtemplateget) | **GET** /gdprTemplate/ | seznam šablon právních titulů
*HromadnEmailApi* | [**massEmailDelete**](docs/Api/HromadnEmailApi.md#massemaildelete) | **DELETE** /massEmail/{massEmailId}/ | smazání hromadného emailu
*HromadnEmailApi* | [**massEmailDetailGet**](docs/Api/HromadnEmailApi.md#massemaildetailget) | **GET** /massEmail/{massEmailId}/ | detail hromadného emailu
*HromadnEmailApi* | [**massEmailEdit**](docs/Api/HromadnEmailApi.md#massemailedit) | **POST** /massEmail/{massEmailId}/ | upravení hromadného emailu
*HromadnEmailApi* | [**massEmailGet**](docs/Api/HromadnEmailApi.md#massemailget) | **GET** /massEmail/ | seznam hromadných emailů
*HromadnEmailApi* | [**massEmailInsert**](docs/Api/HromadnEmailApi.md#massemailinsert) | **PUT** /massEmail/ | založení nového hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientBulkDeleteEdit**](docs/Api/HromadnEmailApi.md#massemailrecipientbulkdeleteedit) | **POST** /massEmail/{massEmailId}/recipientBulkDelete/ | smazání adresátů hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientBulkUpdateEdit**](docs/Api/HromadnEmailApi.md#massemailrecipientbulkupdateedit) | **POST** /massEmail/{massEmailId}/recipientBulkUpdate/ | vložení/upravení adresátů hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientDelete**](docs/Api/HromadnEmailApi.md#massemailrecipientdelete) | **DELETE** /massEmail/{massEmailId}/recipient/{recipientId}/ | smazání adresáta hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientDetailGet**](docs/Api/HromadnEmailApi.md#massemailrecipientdetailget) | **GET** /massEmail/{massEmailId}/recipient/ | seznam adresátů hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientEdit**](docs/Api/HromadnEmailApi.md#massemailrecipientedit) | **POST** /massEmail/{massEmailId}/recipient/{recipientId}/ | upravení adresáta hromadného emailu
*HromadnEmailApi* | [**massEmailRecipientInsert**](docs/Api/HromadnEmailApi.md#massemailrecipientinsert) | **PUT** /massEmail/{massEmailId}/recipient/ | přidání adresáta hromadného emailu
*KlientiApi* | [**companyAddressDelete**](docs/Api/KlientiApi.md#companyaddressdelete) | **DELETE** /company/{companyId}/address/{addressId}/ | smazání adresy klienta
*KlientiApi* | [**companyAddressEdit**](docs/Api/KlientiApi.md#companyaddressedit) | **POST** /company/{companyId}/address/{addressId}/ | upravení adresy klienta
*KlientiApi* | [**companyAddressInsert**](docs/Api/KlientiApi.md#companyaddressinsert) | **PUT** /company/{companyId}/address/ | přidání adresy ke klientovi
*KlientiApi* | [**companyAddressSetContactEdit**](docs/Api/KlientiApi.md#companyaddresssetcontactedit) | **POST** /company/{companyId}/address/{addressId}/setContact/ | nastavení kontaktní adresy
*KlientiApi* | [**companyAddressSetPrimaryEdit**](docs/Api/KlientiApi.md#companyaddresssetprimaryedit) | **POST** /company/{companyId}/address/{addressId}/setPrimary/ | nastavení primární adresy
*KlientiApi* | [**companyAnonymizeEdit**](docs/Api/KlientiApi.md#companyanonymizeedit) | **POST** /company/{companyId}/anonymize/ | GDPR anonymize klienta
*KlientiApi* | [**companyDelete**](docs/Api/KlientiApi.md#companydelete) | **DELETE** /company/{companyId}/ | smazání klienta
*KlientiApi* | [**companyDetailGet**](docs/Api/KlientiApi.md#companydetailget) | **GET** /company/{companyId}/ | detail klienta
*KlientiApi* | [**companyEdit**](docs/Api/KlientiApi.md#companyedit) | **POST** /company/{companyId}/ | upravení klienta
*KlientiApi* | [**companyGet**](docs/Api/KlientiApi.md#companyget) | **GET** /company/ | seznam klientů
*KlientiApi* | [**companyInsert**](docs/Api/KlientiApi.md#companyinsert) | **PUT** /company/ | nový klient
*KlientiApi* | [**companyInvalidEdit**](docs/Api/KlientiApi.md#companyinvalidedit) | **POST** /company/{companyId}/invalid | zneplatnění klienta
*KlientiApi* | [**companyLockEdit**](docs/Api/KlientiApi.md#companylockedit) | **POST** /company/{companyId}/lock | uzamčení klienta
*KlientiApi* | [**companyMergeEdit**](docs/Api/KlientiApi.md#companymergeedit) | **POST** /company/{companyId}/merge/{sourceCompanyId}/ | Sloučení duplicitního klienta
*KlientiApi* | [**companyRelationshipDelete**](docs/Api/KlientiApi.md#companyrelationshipdelete) | **DELETE** /company/{companyId}/relationship/{relationshipId}/ | smazání propojení na jiného klienta
*KlientiApi* | [**companyRelationshipDetailGet**](docs/Api/KlientiApi.md#companyrelationshipdetailget) | **GET** /company/{companyId}/relationship/ | Propojení na jiné klienty
*KlientiApi* | [**companyRelationshipEdit**](docs/Api/KlientiApi.md#companyrelationshipedit) | **POST** /company/{companyId}/relationship/{relationshipId}/ | upravení propojení na jiného klienta
*KlientiApi* | [**companyRelationshipInsert**](docs/Api/KlientiApi.md#companyrelationshipinsert) | **PUT** /company/{companyId}/relationship/ | přidání propojení na klienta
*KlientiApi* | [**companyTagDelete**](docs/Api/KlientiApi.md#companytagdelete) | **DELETE** /company/{companyId}/tag/ | smazání TAGu z Klienta
*KlientiApi* | [**companyTagInsert**](docs/Api/KlientiApi.md#companytaginsert) | **PUT** /company/{companyId}/tag/ | přidání TAGu ke Klientovi
*KlientiApi* | [**companyUnlockEdit**](docs/Api/KlientiApi.md#companyunlockedit) | **POST** /company/{companyId}/unlock | odemčení klienta
*KlientiApi* | [**companyValidEdit**](docs/Api/KlientiApi.md#companyvalidedit) | **POST** /company/{companyId}/valid | obnovení platnosti klienta
*KnihovnaDokumentApi* | [**dmsDocumentDelete**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentdelete) | **DELETE** /dms/document/{documentId}/ | smazání dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentDetailGet**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentdetailget) | **GET** /dms/document/{documentId}/ | detail dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentEdit**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentedit) | **POST** /dms/document/{documentId}/ | upravení dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentInsert**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentinsert) | **PUT** /dms/document/ | nový dokument
*KnihovnaDokumentApi* | [**dmsDocumentInvalidEdit**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentinvalidedit) | **POST** /dms/document/{documentId}/invalid | zneplatnění dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentLockEdit**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentlockedit) | **POST** /dms/document/{documentId}/lock | uzamčení dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentUnlockEdit**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentunlockedit) | **POST** /dms/document/{documentId}/unlock | odemčení dokumentu
*KnihovnaDokumentApi* | [**dmsDocumentValidEdit**](docs/Api/KnihovnaDokumentApi.md#dmsdocumentvalidedit) | **POST** /dms/document/{documentId}/valid | obnovení platnosti dokumentu
*KnihovnaDokumentApi* | [**dmsFolderCascadeDelete**](docs/Api/KnihovnaDokumentApi.md#dmsfoldercascadedelete) | **DELETE** /dms/folder/{folderId}/cascade/ | smazání složky kaskádovitě
*KnihovnaDokumentApi* | [**dmsFolderDelete**](docs/Api/KnihovnaDokumentApi.md#dmsfolderdelete) | **DELETE** /dms/folder/{folderId}/ | smazání složky
*KnihovnaDokumentApi* | [**dmsFolderInsert**](docs/Api/KnihovnaDokumentApi.md#dmsfolderinsert) | **PUT** /dms/folder/ | nová složka
*KnihovnaDokumentApi* | [**dmsGet**](docs/Api/KnihovnaDokumentApi.md#dmsget) | **GET** /dms/ | seznam složek a souborů
*KolApi* | [**taskDelete**](docs/Api/KolApi.md#taskdelete) | **DELETE** /task/{taskId}/ | smazání úkolu
*KolApi* | [**taskDetailGet**](docs/Api/KolApi.md#taskdetailget) | **GET** /task/{taskId}/ | detail úkolu
*KolApi* | [**taskEdit**](docs/Api/KolApi.md#taskedit) | **POST** /task/{taskId}/ | upravení úkolu
*KolApi* | [**taskGet**](docs/Api/KolApi.md#taskget) | **GET** /task/ | seznam úkolů
*KolApi* | [**taskInsert**](docs/Api/KolApi.md#taskinsert) | **PUT** /task/ | nový úkol
*KontaktnOsobyApi* | [**personAnonymizeEdit**](docs/Api/KontaktnOsobyApi.md#personanonymizeedit) | **POST** /person/{personId}/anonymize/ | GDPR anonymize kontaktní osoby
*KontaktnOsobyApi* | [**personDelete**](docs/Api/KontaktnOsobyApi.md#persondelete) | **DELETE** /person/{personId}/ | smazání kontaktní osoby
*KontaktnOsobyApi* | [**personDetailGet**](docs/Api/KontaktnOsobyApi.md#persondetailget) | **GET** /person/{personId}/ | detail kontaktní osoby
*KontaktnOsobyApi* | [**personEdit**](docs/Api/KontaktnOsobyApi.md#personedit) | **POST** /person/{personId}/ | upravení kontaktní osoby
*KontaktnOsobyApi* | [**personGet**](docs/Api/KontaktnOsobyApi.md#personget) | **GET** /person/ | seznam kontaktních osob
*KontaktnOsobyApi* | [**personInsert**](docs/Api/KontaktnOsobyApi.md#personinsert) | **PUT** /person/ | založení nové kontaktní osoby
*KontaktnOsobyApi* | [**personInvalidEdit**](docs/Api/KontaktnOsobyApi.md#personinvalidedit) | **POST** /person/{personId}/invalid | zneplatnění kontaktní osoby
*KontaktnOsobyApi* | [**personLockEdit**](docs/Api/KontaktnOsobyApi.md#personlockedit) | **POST** /person/{personId}/lock | uzamčení kontaktní osoby
*KontaktnOsobyApi* | [**personMergeEdit**](docs/Api/KontaktnOsobyApi.md#personmergeedit) | **POST** /person/{personId}/merge/{sourcePersonId}/ | Sloučení duplicitní kontaktní osoby
*KontaktnOsobyApi* | [**personRelationshipDelete**](docs/Api/KontaktnOsobyApi.md#personrelationshipdelete) | **DELETE** /person/{personId}/relationship/{relationshipId}/ | smazání vztahu
*KontaktnOsobyApi* | [**personRelationshipEdit**](docs/Api/KontaktnOsobyApi.md#personrelationshipedit) | **POST** /person/{personId}/relationship/{relationshipId}/ | upravení vztahu
*KontaktnOsobyApi* | [**personRelationshipInsert**](docs/Api/KontaktnOsobyApi.md#personrelationshipinsert) | **PUT** /person/{personId}/relationship/ | přidání vztahu
*KontaktnOsobyApi* | [**personRelationshipSetPrimaryEdit**](docs/Api/KontaktnOsobyApi.md#personrelationshipsetprimaryedit) | **POST** /person/{personId}/relationship/{relationshipId}/setPrimary/ | nastavení primárního vztahu s klientem
*KontaktnOsobyApi* | [**personTagDelete**](docs/Api/KontaktnOsobyApi.md#persontagdelete) | **DELETE** /person/{personId}/tag/ | smazání TAGu z kontaktní osoby
*KontaktnOsobyApi* | [**personTagInsert**](docs/Api/KontaktnOsobyApi.md#persontaginsert) | **PUT** /person/{personId}/tag/ | přidání TAGu ke kontaktní osobě
*KontaktnOsobyApi* | [**personUnlockEdit**](docs/Api/KontaktnOsobyApi.md#personunlockedit) | **POST** /person/{personId}/unlock | odemčení kontaktní osoby
*KontaktnOsobyApi* | [**personValidEdit**](docs/Api/KontaktnOsobyApi.md#personvalidedit) | **POST** /person/{personId}/valid | obnovení platnosti kontaktní osoby
*LeadyApi* | [**leadAnonymizeEdit**](docs/Api/LeadyApi.md#leadanonymizeedit) | **POST** /lead/{leadId}/anonymize/ | GDPR anonymize leadu
*LeadyApi* | [**leadDelete**](docs/Api/LeadyApi.md#leaddelete) | **DELETE** /lead/{leadId}/ | smazání leadu
*LeadyApi* | [**leadDetailGet**](docs/Api/LeadyApi.md#leaddetailget) | **GET** /lead/{leadId}/ | detail leadu
*LeadyApi* | [**leadEdit**](docs/Api/LeadyApi.md#leadedit) | **POST** /lead/{leadId}/ | upravení leadu
*LeadyApi* | [**leadGet**](docs/Api/LeadyApi.md#leadget) | **GET** /lead/ | seznam leadů
*LeadyApi* | [**leadInsert**](docs/Api/LeadyApi.md#leadinsert) | **PUT** /lead/ | nový lead
*LeadyApi* | [**leadLockEdit**](docs/Api/LeadyApi.md#leadlockedit) | **POST** /lead/{leadId}/lock | uzamčení leadu
*LeadyApi* | [**leadMergeEdit**](docs/Api/LeadyApi.md#leadmergeedit) | **POST** /lead/{leadId}/merge/{sourceLeadId}/ | Sloučení duplicitního leadu
*LeadyApi* | [**leadUnlockEdit**](docs/Api/LeadyApi.md#leadunlockedit) | **POST** /lead/{leadId}/unlock | odemčení leadu
*NabdkyApi* | [**offerDelete**](docs/Api/NabdkyApi.md#offerdelete) | **DELETE** /offer/{offerId}/ | smazání nabídky
*NabdkyApi* | [**offerDetailGet**](docs/Api/NabdkyApi.md#offerdetailget) | **GET** /offer/{offerId}/ | detail nabídky
*NabdkyApi* | [**offerEdit**](docs/Api/NabdkyApi.md#offeredit) | **POST** /offer/{offerId}/ | upravení nabídky
*NabdkyApi* | [**offerGet**](docs/Api/NabdkyApi.md#offerget) | **GET** /offer/ | seznam nabídek
*NabdkyApi* | [**offerInsert**](docs/Api/NabdkyApi.md#offerinsert) | **PUT** /offer/ | nová nabídka
*NabdkyApi* | [**offerInvalidEdit**](docs/Api/NabdkyApi.md#offerinvalidedit) | **POST** /offer/{offerId}/invalid | zneplatnění nabídky
*NabdkyApi* | [**offerItemDelete**](docs/Api/NabdkyApi.md#offeritemdelete) | **DELETE** /offer/{offerId}/item/{offerItemId}/ | smazání položky nabídky
*NabdkyApi* | [**offerItemEdit**](docs/Api/NabdkyApi.md#offeritemedit) | **POST** /offer/{offerId}/item/{offerItemId}/ | upravení položky nabídky
*NabdkyApi* | [**offerItemInsert**](docs/Api/NabdkyApi.md#offeriteminsert) | **PUT** /offer/{offerId}/item/ | přidání položek nabídky
*NabdkyApi* | [**offerLockEdit**](docs/Api/NabdkyApi.md#offerlockedit) | **POST** /offer/{offerId}/lock | uzamčení nabídky
*NabdkyApi* | [**offerPdfExportDetailGet**](docs/Api/NabdkyApi.md#offerpdfexportdetailget) | **GET** /offer/{offerId}/pdfExport | export nabídky do PDF
*NabdkyApi* | [**offerSyncDelete**](docs/Api/NabdkyApi.md#offersyncdelete) | **DELETE** /offer/{offerId}/sync | zrušení synchronizace nabídky s obchodním případem
*NabdkyApi* | [**offerSyncEdit**](docs/Api/NabdkyApi.md#offersyncedit) | **POST** /offer/{offerId}/sync | synchronizace nabídky s obchodním případem
*NabdkyApi* | [**offerUnlockEdit**](docs/Api/NabdkyApi.md#offerunlockedit) | **POST** /offer/{offerId}/unlock | odemčení nabídky
*NabdkyApi* | [**offerValidEdit**](docs/Api/NabdkyApi.md#offervalidedit) | **POST** /offer/{offerId}/valid | obnovení platnosti nabídky
*NotifikaceApi* | [**notificationDelete**](docs/Api/NotifikaceApi.md#notificationdelete) | **DELETE** /notification/{notificationId}/ | smazání notifikace
*NotifikaceApi* | [**notificationGet**](docs/Api/NotifikaceApi.md#notificationget) | **GET** /notification/ | seznam notifikací
*ObchodnPpadyApi* | [**businessCaseCreateWithItemsInsert**](docs/Api/ObchodnPpadyApi.md#businesscasecreatewithitemsinsert) | **PUT** /businessCase/createWithItems | nový OP s produkty
*ObchodnPpadyApi* | [**businessCaseDelete**](docs/Api/ObchodnPpadyApi.md#businesscasedelete) | **DELETE** /businessCase/{businessCaseId}/ | smazání OP
*ObchodnPpadyApi* | [**businessCaseDetailGet**](docs/Api/ObchodnPpadyApi.md#businesscasedetailget) | **GET** /businessCase/{businessCaseId}/ | detail OP
*ObchodnPpadyApi* | [**businessCaseEdit**](docs/Api/ObchodnPpadyApi.md#businesscaseedit) | **POST** /businessCase/{businessCaseId}/ | upravení OP
*ObchodnPpadyApi* | [**businessCaseGet**](docs/Api/ObchodnPpadyApi.md#businesscaseget) | **GET** /businessCase/ | seznam OP
*ObchodnPpadyApi* | [**businessCaseInsert**](docs/Api/ObchodnPpadyApi.md#businesscaseinsert) | **PUT** /businessCase/ | nový OP
*ObchodnPpadyApi* | [**businessCaseInvalidEdit**](docs/Api/ObchodnPpadyApi.md#businesscaseinvalidedit) | **POST** /businessCase/{businessCaseId}/invalid | zneplatnění OP
*ObchodnPpadyApi* | [**businessCaseItemDelete**](docs/Api/ObchodnPpadyApi.md#businesscaseitemdelete) | **DELETE** /businessCase/{businessCaseId}/item/{businessCaseItemId}/ | smazání položky OP
*ObchodnPpadyApi* | [**businessCaseItemEdit**](docs/Api/ObchodnPpadyApi.md#businesscaseitemedit) | **POST** /businessCase/{businessCaseId}/item/{businessCaseItemId}/ | upravení položky OP
*ObchodnPpadyApi* | [**businessCaseItemInsert**](docs/Api/ObchodnPpadyApi.md#businesscaseiteminsert) | **PUT** /businessCase/{businessCaseId}/item/ | přidání položek OP
*ObchodnPpadyApi* | [**businessCaseLockEdit**](docs/Api/ObchodnPpadyApi.md#businesscaselockedit) | **POST** /businessCase/{businessCaseId}/lock | uzamčení OP
*ObchodnPpadyApi* | [**businessCaseParticipantsDelete**](docs/Api/ObchodnPpadyApi.md#businesscaseparticipantsdelete) | **DELETE** /businessCase/{businessCaseId}/participants/{participantId} | smazání participanta z obchodního případu
*ObchodnPpadyApi* | [**businessCaseParticipantsDetailGet**](docs/Api/ObchodnPpadyApi.md#businesscaseparticipantsdetailget) | **GET** /businessCase/{businessCaseId}/participants/ | seznam participantů OP
*ObchodnPpadyApi* | [**businessCaseParticipantsInsert**](docs/Api/ObchodnPpadyApi.md#businesscaseparticipantsinsert) | **PUT** /businessCase/{businessCaseId}/participants/ | nový participant obchodního případu
*ObchodnPpadyApi* | [**businessCasePdfExportDetailGet**](docs/Api/ObchodnPpadyApi.md#businesscasepdfexportdetailget) | **GET** /businessCase/{businessCaseId}/pdfExport | export OP do PDF
*ObchodnPpadyApi* | [**businessCasePhaseChangesDetailGet**](docs/Api/ObchodnPpadyApi.md#businesscasephasechangesdetailget) | **GET** /businessCase/{businessCaseId}/phaseChanges | changelog změn stavů OP
*ObchodnPpadyApi* | [**businessCaseUnlockEdit**](docs/Api/ObchodnPpadyApi.md#businesscaseunlockedit) | **POST** /businessCase/{businessCaseId}/unlock | odemčení OP
*ObchodnPpadyApi* | [**businessCaseValidEdit**](docs/Api/ObchodnPpadyApi.md#businesscasevalidedit) | **POST** /businessCase/{businessCaseId}/valid | obnovení platnosti OP
*ObjednvkyApi* | [**salesOrderDelete**](docs/Api/ObjednvkyApi.md#salesorderdelete) | **DELETE** /salesOrder/{salesOrderId}/ | smazání objednávky
*ObjednvkyApi* | [**salesOrderDetailGet**](docs/Api/ObjednvkyApi.md#salesorderdetailget) | **GET** /salesOrder/{salesOrderId}/ | detail objednávky
*ObjednvkyApi* | [**salesOrderEdit**](docs/Api/ObjednvkyApi.md#salesorderedit) | **POST** /salesOrder/{salesOrderId}/ | upravení objednávky
*ObjednvkyApi* | [**salesOrderGet**](docs/Api/ObjednvkyApi.md#salesorderget) | **GET** /salesOrder/ | seznam objednávek
*ObjednvkyApi* | [**salesOrderInsert**](docs/Api/ObjednvkyApi.md#salesorderinsert) | **PUT** /salesOrder/ | nová objednávka
*ObjednvkyApi* | [**salesOrderInvalidEdit**](docs/Api/ObjednvkyApi.md#salesorderinvalidedit) | **POST** /salesOrder/{salesOrderId}/invalid | zneplatnění objednávky
*ObjednvkyApi* | [**salesOrderItemDelete**](docs/Api/ObjednvkyApi.md#salesorderitemdelete) | **DELETE** /salesOrder/{salesOrderId}/item/{salesOrderItemId}/ | smazání položky objednávky
*ObjednvkyApi* | [**salesOrderItemEdit**](docs/Api/ObjednvkyApi.md#salesorderitemedit) | **POST** /salesOrder/{salesOrderId}/item/{salesOrderItemId}/ | upravení položky objednávky
*ObjednvkyApi* | [**salesOrderItemInsert**](docs/Api/ObjednvkyApi.md#salesorderiteminsert) | **PUT** /salesOrder/{salesOrderId}/item/ | přidání položek objednávky
*ObjednvkyApi* | [**salesOrderLockEdit**](docs/Api/ObjednvkyApi.md#salesorderlockedit) | **POST** /salesOrder/{salesOrderId}/lock | uzamčení objednávky
*ObjednvkyApi* | [**salesOrderPdfExportDetailGet**](docs/Api/ObjednvkyApi.md#salesorderpdfexportdetailget) | **GET** /salesOrder/{salesOrderId}/pdfExport | export objednávky do PDF
*ObjednvkyApi* | [**salesOrderSyncDelete**](docs/Api/ObjednvkyApi.md#salesordersyncdelete) | **DELETE** /salesOrder/{salesOrderId}/sync | zrušení synchronizace objednávky s obchodním případem
*ObjednvkyApi* | [**salesOrderSyncEdit**](docs/Api/ObjednvkyApi.md#salesordersyncedit) | **POST** /salesOrder/{salesOrderId}/sync | synchronizace objednávky s obchodním případem
*ObjednvkyApi* | [**salesOrderUnlockEdit**](docs/Api/ObjednvkyApi.md#salesorderunlockedit) | **POST** /salesOrder/{salesOrderId}/unlock | odemčení objednávky
*ObjednvkyApi* | [**salesOrderValidEdit**](docs/Api/ObjednvkyApi.md#salesordervalidedit) | **POST** /salesOrder/{salesOrderId}/valid | obnovení platnosti objednávky
*ProduktApi* | [**productDelete**](docs/Api/ProduktApi.md#productdelete) | **DELETE** /product/{productId}/ | smazání produktu
*ProduktApi* | [**productDetailGet**](docs/Api/ProduktApi.md#productdetailget) | **GET** /product/{productId}/ | detail produktu
*ProduktApi* | [**productEdit**](docs/Api/ProduktApi.md#productedit) | **POST** /product/{productId}/ | upravení produktu
*ProduktApi* | [**productGet**](docs/Api/ProduktApi.md#productget) | **GET** /product/ | seznam produktů
*ProduktApi* | [**productInsert**](docs/Api/ProduktApi.md#productinsert) | **PUT** /product/ | založení nového produktu
*ProduktApi* | [**productInvalidEdit**](docs/Api/ProduktApi.md#productinvalidedit) | **POST** /product/{productId}/invalid | zneplatnění produktu
*ProduktApi* | [**productValidEdit**](docs/Api/ProduktApi.md#productvalidedit) | **POST** /product/{productId}/valid | obnovení platnosti produktu
*ProjektyApi* | [**projectDelete**](docs/Api/ProjektyApi.md#projectdelete) | **DELETE** /project/{projectId}/ | smazání projektu
*ProjektyApi* | [**projectDetailGet**](docs/Api/ProjektyApi.md#projectdetailget) | **GET** /project/{projectId}/ | detail projektu
*ProjektyApi* | [**projectEdit**](docs/Api/ProjektyApi.md#projectedit) | **POST** /project/{projectId}/ | upravení projektu
*ProjektyApi* | [**projectGet**](docs/Api/ProjektyApi.md#projectget) | **GET** /project/ | seznam projektů
*ProjektyApi* | [**projectInsert**](docs/Api/ProjektyApi.md#projectinsert) | **PUT** /project/ | nový projekt
*ProjektyApi* | [**projectInvalidEdit**](docs/Api/ProjektyApi.md#projectinvalidedit) | **POST** /project/{projectId}/invalid | zneplatnění projektu
*ProjektyApi* | [**projectLockEdit**](docs/Api/ProjektyApi.md#projectlockedit) | **POST** /project/{projectId}/lock | uzamčení projektu
*ProjektyApi* | [**projectParticipantsDelete**](docs/Api/ProjektyApi.md#projectparticipantsdelete) | **DELETE** /project/{projectId}/participants/{participantId} | smazání participanta z projektu
*ProjektyApi* | [**projectParticipantsDetailGet**](docs/Api/ProjektyApi.md#projectparticipantsdetailget) | **GET** /project/{projectId}/participants/ | seznam participantů projektu
*ProjektyApi* | [**projectParticipantsInsert**](docs/Api/ProjektyApi.md#projectparticipantsinsert) | **PUT** /project/{projectId}/participants/ | nový participant projektu
*ProjektyApi* | [**projectUnlockEdit**](docs/Api/ProjektyApi.md#projectunlockedit) | **POST** /project/{projectId}/unlock | odemčení projektu
*ProjektyApi* | [**projectValidEdit**](docs/Api/ProjektyApi.md#projectvalidedit) | **POST** /project/{projectId}/valid | obnovení platnosti projektu
*SchzkaApi* | [**meetingDelete**](docs/Api/SchzkaApi.md#meetingdelete) | **DELETE** /meeting/{meetingId}/ | smazání schůzky
*SchzkaApi* | [**meetingDetailGet**](docs/Api/SchzkaApi.md#meetingdetailget) | **GET** /meeting/{meetingId}/ | detail schůzky
*SchzkaApi* | [**meetingEdit**](docs/Api/SchzkaApi.md#meetingedit) | **POST** /meeting/{meetingId}/ | upravení schůzky
*SchzkaApi* | [**meetingGet**](docs/Api/SchzkaApi.md#meetingget) | **GET** /meeting/ | seznam schůzek
*SchzkaApi* | [**meetingInsert**](docs/Api/SchzkaApi.md#meetinginsert) | **PUT** /meeting/ | nová schůzka
*SelnkyApi* | [**activityCategoryDelete**](docs/Api/SelnkyApi.md#activitycategorydelete) | **DELETE** /activityCategory/{id}/ | smazání kategorie aktivity
*SelnkyApi* | [**activityCategoryEdit**](docs/Api/SelnkyApi.md#activitycategoryedit) | **POST** /activityCategory/{id}/ | upravení kategorie aktivity
*SelnkyApi* | [**activityCategoryGet**](docs/Api/SelnkyApi.md#activitycategoryget) | **GET** /activityCategory/ | seznam kategorií aktivit
*SelnkyApi* | [**activityCategoryInsert**](docs/Api/SelnkyApi.md#activitycategoryinsert) | **PUT** /activityCategory/ | založení nové kategorie aktivity
*SelnkyApi* | [**businessCaseCategoryDelete**](docs/Api/SelnkyApi.md#businesscasecategorydelete) | **DELETE** /businessCaseCategory/{id}/ | smazání kategorie obchodního případu
*SelnkyApi* | [**businessCaseCategoryEdit**](docs/Api/SelnkyApi.md#businesscasecategoryedit) | **POST** /businessCaseCategory/{id}/ | upravení kategorie obchodního případu
*SelnkyApi* | [**businessCaseCategoryGet**](docs/Api/SelnkyApi.md#businesscasecategoryget) | **GET** /businessCaseCategory/ | seznam kategorií obchodního případu
*SelnkyApi* | [**businessCaseCategoryInsert**](docs/Api/SelnkyApi.md#businesscasecategoryinsert) | **PUT** /businessCaseCategory/ | založení nové kategorie obchodního případu
*SelnkyApi* | [**businessCaseClassification1Delete**](docs/Api/SelnkyApi.md#businesscaseclassification1delete) | **DELETE** /businessCaseClassification1/{id}/ | smazání klasifikace 1 obchodního případu
*SelnkyApi* | [**businessCaseClassification1Edit**](docs/Api/SelnkyApi.md#businesscaseclassification1edit) | **POST** /businessCaseClassification1/{id}/ | upravení klasifikace 1 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification1Get**](docs/Api/SelnkyApi.md#businesscaseclassification1get) | **GET** /businessCaseClassification1/ | seznam klasifikací 1 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification1Insert**](docs/Api/SelnkyApi.md#businesscaseclassification1insert) | **PUT** /businessCaseClassification1/ | založení nové klasifikace 1 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification2Delete**](docs/Api/SelnkyApi.md#businesscaseclassification2delete) | **DELETE** /businessCaseClassification2/{id}/ | smazání klasifikace 2 obchodního případu
*SelnkyApi* | [**businessCaseClassification2Edit**](docs/Api/SelnkyApi.md#businesscaseclassification2edit) | **POST** /businessCaseClassification2/{id}/ | upravení klasifikace 2 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification2Get**](docs/Api/SelnkyApi.md#businesscaseclassification2get) | **GET** /businessCaseClassification2/ | seznam klasifikací 2 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification2Insert**](docs/Api/SelnkyApi.md#businesscaseclassification2insert) | **PUT** /businessCaseClassification2/ | založení nové klasifikace 2 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification3Delete**](docs/Api/SelnkyApi.md#businesscaseclassification3delete) | **DELETE** /businessCaseClassification3/{id}/ | smazání klasifikace 3 obchodního případu
*SelnkyApi* | [**businessCaseClassification3Edit**](docs/Api/SelnkyApi.md#businesscaseclassification3edit) | **POST** /businessCaseClassification3/{id}/ | upravení klasifikace 3 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification3Get**](docs/Api/SelnkyApi.md#businesscaseclassification3get) | **GET** /businessCaseClassification3/ | seznam klasifikací 3 pro obchodní případ
*SelnkyApi* | [**businessCaseClassification3Insert**](docs/Api/SelnkyApi.md#businesscaseclassification3insert) | **PUT** /businessCaseClassification3/ | založení nové klasifikace 3 pro obchodní případ
*SelnkyApi* | [**businessCasePhaseDelete**](docs/Api/SelnkyApi.md#businesscasephasedelete) | **DELETE** /businessCasePhase/{id}/ | smazání stavu obchodního případu
*SelnkyApi* | [**businessCasePhaseGet**](docs/Api/SelnkyApi.md#businesscasephaseget) | **GET** /businessCasePhase/ | seznam stavů obchodního případu
*SelnkyApi* | [**businessCasePhaseInsert**](docs/Api/SelnkyApi.md#businesscasephaseinsert) | **PUT** /businessCasePhase/ | založení nového stavu obchodního případu
*SelnkyApi* | [**businessCaseRelationshipCategoryDelete**](docs/Api/SelnkyApi.md#businesscaserelationshipcategorydelete) | **DELETE** /businessCaseRelationshipCategory/{id}/ | smazání kategorie participace obchodního případu
*SelnkyApi* | [**businessCaseRelationshipCategoryEdit**](docs/Api/SelnkyApi.md#businesscaserelationshipcategoryedit) | **POST** /businessCaseRelationshipCategory/{id}/ | upravení kategorie participace obchodního případu
*SelnkyApi* | [**businessCaseRelationshipCategoryGet**](docs/Api/SelnkyApi.md#businesscaserelationshipcategoryget) | **GET** /businessCaseRelationshipCategory/ | seznam kategorií participace obchodního případu
*SelnkyApi* | [**businessCaseRelationshipCategoryInsert**](docs/Api/SelnkyApi.md#businesscaserelationshipcategoryinsert) | **PUT** /businessCaseRelationshipCategory/ | založení nové kategorie participace obchodního případu
*SelnkyApi* | [**businessCaseTypeGet**](docs/Api/SelnkyApi.md#businesscasetypeget) | **GET** /businessCaseType/ | seznam typů obchodního případu
*SelnkyApi* | [**companyCategoryDelete**](docs/Api/SelnkyApi.md#companycategorydelete) | **DELETE** /companyCategory/{id}/ | smazání kategorie klienta
*SelnkyApi* | [**companyCategoryEdit**](docs/Api/SelnkyApi.md#companycategoryedit) | **POST** /companyCategory/{id}/ | upravení kategorie klienta
*SelnkyApi* | [**companyCategoryGet**](docs/Api/SelnkyApi.md#companycategoryget) | **GET** /companyCategory/ | seznam kategorií klienta
*SelnkyApi* | [**companyCategoryInsert**](docs/Api/SelnkyApi.md#companycategoryinsert) | **PUT** /companyCategory/ | založení nové kategorie klienta
*SelnkyApi* | [**companyClassification1Delete**](docs/Api/SelnkyApi.md#companyclassification1delete) | **DELETE** /companyClassification1/{id}/ | smazání klasifikace 1 klienta
*SelnkyApi* | [**companyClassification1Edit**](docs/Api/SelnkyApi.md#companyclassification1edit) | **POST** /companyClassification1/{id}/ | upravení klasifikace 1 pro klienta
*SelnkyApi* | [**companyClassification1Get**](docs/Api/SelnkyApi.md#companyclassification1get) | **GET** /companyClassification1/ | seznam klasifikací 1 pro klienta
*SelnkyApi* | [**companyClassification1Insert**](docs/Api/SelnkyApi.md#companyclassification1insert) | **PUT** /companyClassification1/ | založení nové klasifikace 1 pro klienta
*SelnkyApi* | [**companyClassification2Delete**](docs/Api/SelnkyApi.md#companyclassification2delete) | **DELETE** /companyClassification2/{id}/ | smazání klasifikace 2 klienta
*SelnkyApi* | [**companyClassification2Edit**](docs/Api/SelnkyApi.md#companyclassification2edit) | **POST** /companyClassification2/{id}/ | upravení klasifikace 2 pro klienta
*SelnkyApi* | [**companyClassification2Get**](docs/Api/SelnkyApi.md#companyclassification2get) | **GET** /companyClassification2/ | seznam klasifikací 2 pro klienta
*SelnkyApi* | [**companyClassification2Insert**](docs/Api/SelnkyApi.md#companyclassification2insert) | **PUT** /companyClassification2/ | založení nové klasifikace 2 pro klienta
*SelnkyApi* | [**companyClassification3Delete**](docs/Api/SelnkyApi.md#companyclassification3delete) | **DELETE** /companyClassification3/{id}/ | smazání klasifikace 3 klienta
*SelnkyApi* | [**companyClassification3Edit**](docs/Api/SelnkyApi.md#companyclassification3edit) | **POST** /companyClassification3/{id}/ | upravení klasifikace 3 pro klienta
*SelnkyApi* | [**companyClassification3Get**](docs/Api/SelnkyApi.md#companyclassification3get) | **GET** /companyClassification3/ | seznam klasifikací 3 pro klienta
*SelnkyApi* | [**companyClassification3Insert**](docs/Api/SelnkyApi.md#companyclassification3insert) | **PUT** /companyClassification3/ | založení nové klasifikace 3 pro klienta
*SelnkyApi* | [**companyTurnoverDelete**](docs/Api/SelnkyApi.md#companyturnoverdelete) | **DELETE** /companyTurnover/{id}/ | smazání obratu
*SelnkyApi* | [**companyTurnoverEdit**](docs/Api/SelnkyApi.md#companyturnoveredit) | **POST** /companyTurnover/{id}/ | upravení obratu
*SelnkyApi* | [**companyTurnoverGet**](docs/Api/SelnkyApi.md#companyturnoverget) | **GET** /companyTurnover/ | seznam obratů
*SelnkyApi* | [**companyTurnoverInsert**](docs/Api/SelnkyApi.md#companyturnoverinsert) | **PUT** /companyTurnover/ | přidání nového obratu
*SelnkyApi* | [**contactSourceDelete**](docs/Api/SelnkyApi.md#contactsourcedelete) | **DELETE** /contactSource/{id}/ | smazání zdroje kontaktu
*SelnkyApi* | [**contactSourceEdit**](docs/Api/SelnkyApi.md#contactsourceedit) | **POST** /contactSource/{id}/ | upravení zdroje kontaktu
*SelnkyApi* | [**contactSourceGet**](docs/Api/SelnkyApi.md#contactsourceget) | **GET** /contactSource/ | seznam zdrojů kontaktu
*SelnkyApi* | [**contactSourceInsert**](docs/Api/SelnkyApi.md#contactsourceinsert) | **PUT** /contactSource/ | založení nového zdroje kontaktu
*SelnkyApi* | [**currencyDelete**](docs/Api/SelnkyApi.md#currencydelete) | **DELETE** /currency/{id}/ | smazání měny
*SelnkyApi* | [**currencyEdit**](docs/Api/SelnkyApi.md#currencyedit) | **POST** /currency/{id}/ | upravení měny
*SelnkyApi* | [**currencyGet**](docs/Api/SelnkyApi.md#currencyget) | **GET** /currency/ | seznam měn
*SelnkyApi* | [**currencyInsert**](docs/Api/SelnkyApi.md#currencyinsert) | **PUT** /currency/ | založení nové měny
*SelnkyApi* | [**economyActivityDelete**](docs/Api/SelnkyApi.md#economyactivitydelete) | **DELETE** /economyActivity/{id}/ | smazání oboru činnosti
*SelnkyApi* | [**economyActivityEdit**](docs/Api/SelnkyApi.md#economyactivityedit) | **POST** /economyActivity/{id}/ | upravení oboru činnosti
*SelnkyApi* | [**economyActivityGet**](docs/Api/SelnkyApi.md#economyactivityget) | **GET** /economyActivity/ | seznam oborů činnosti
*SelnkyApi* | [**economyActivityInsert**](docs/Api/SelnkyApi.md#economyactivityinsert) | **PUT** /economyActivity/ | založení nového oboru činnosti
*SelnkyApi* | [**employeesNumberDelete**](docs/Api/SelnkyApi.md#employeesnumberdelete) | **DELETE** /employeesNumber/{id}/ | smazání počtu zaměstnanců
*SelnkyApi* | [**employeesNumberEdit**](docs/Api/SelnkyApi.md#employeesnumberedit) | **POST** /employeesNumber/{id}/ | upravení počtu zaměstnanců
*SelnkyApi* | [**employeesNumberGet**](docs/Api/SelnkyApi.md#employeesnumberget) | **GET** /employeesNumber/ | seznam počtu zaměstnanců
*SelnkyApi* | [**employeesNumberInsert**](docs/Api/SelnkyApi.md#employeesnumberinsert) | **PUT** /employeesNumber/ | přidání počtu zaměstnanců
*SelnkyApi* | [**gdprFormAgreementDelete**](docs/Api/SelnkyApi.md#gdprformagreementdelete) | **DELETE** /gdprFormAgreement/{id}/ | smazání formy souhlasu
*SelnkyApi* | [**gdprFormAgreementEdit**](docs/Api/SelnkyApi.md#gdprformagreementedit) | **POST** /gdprFormAgreement/{id}/ | upravení formy souhlasu
*SelnkyApi* | [**gdprFormAgreementGet**](docs/Api/SelnkyApi.md#gdprformagreementget) | **GET** /gdprFormAgreement/ | seznam forem souhlasu
*SelnkyApi* | [**gdprFormAgreementInsert**](docs/Api/SelnkyApi.md#gdprformagreementinsert) | **PUT** /gdprFormAgreement/ | založení nové formy souhlasu
*SelnkyApi* | [**languageDelete**](docs/Api/SelnkyApi.md#languagedelete) | **DELETE** /language/{id}/ | smazání jazyku
*SelnkyApi* | [**languageEdit**](docs/Api/SelnkyApi.md#languageedit) | **POST** /language/{id}/ | upravení jazyku
*SelnkyApi* | [**languageGet**](docs/Api/SelnkyApi.md#languageget) | **GET** /language/ | seznam jazyků
*SelnkyApi* | [**languageInsert**](docs/Api/SelnkyApi.md#languageinsert) | **PUT** /language/ | založení nového jazyku
*SelnkyApi* | [**leadCategoryDelete**](docs/Api/SelnkyApi.md#leadcategorydelete) | **DELETE** /leadCategory/{id}/ | smazání kategorie leadu
*SelnkyApi* | [**leadCategoryEdit**](docs/Api/SelnkyApi.md#leadcategoryedit) | **POST** /leadCategory/{id}/ | upravení kategorie leadu
*SelnkyApi* | [**leadCategoryGet**](docs/Api/SelnkyApi.md#leadcategoryget) | **GET** /leadCategory/ | seznam kategorií leadu
*SelnkyApi* | [**leadCategoryInsert**](docs/Api/SelnkyApi.md#leadcategoryinsert) | **PUT** /leadCategory/ | založení nové kategorie leadu
*SelnkyApi* | [**leadPhaseDelete**](docs/Api/SelnkyApi.md#leadphasedelete) | **DELETE** /leadPhase/{id}/ | smazání stavu leadu
*SelnkyApi* | [**leadPhaseGet**](docs/Api/SelnkyApi.md#leadphaseget) | **GET** /leadPhase/ | seznam stavů leadu
*SelnkyApi* | [**leadPhaseInsert**](docs/Api/SelnkyApi.md#leadphaseinsert) | **PUT** /leadPhase/ | založení nového stavu leadu
*SelnkyApi* | [**legalFormDelete**](docs/Api/SelnkyApi.md#legalformdelete) | **DELETE** /legalForm/{id}/ | smazání právní formy
*SelnkyApi* | [**legalFormEdit**](docs/Api/SelnkyApi.md#legalformedit) | **POST** /legalForm/{id}/ | upravení právní formy
*SelnkyApi* | [**legalFormGet**](docs/Api/SelnkyApi.md#legalformget) | **GET** /legalForm/ | seznam právních forem
*SelnkyApi* | [**legalFormInsert**](docs/Api/SelnkyApi.md#legalforminsert) | **PUT** /legalForm/ | založení nové právní formy
*SelnkyApi* | [**losingCategoryDelete**](docs/Api/SelnkyApi.md#losingcategorydelete) | **DELETE** /losingCategory/{id}/ | smazání kategorie prohry
*SelnkyApi* | [**losingCategoryEdit**](docs/Api/SelnkyApi.md#losingcategoryedit) | **POST** /losingCategory/{id}/ | upravení kategorie prohry
*SelnkyApi* | [**losingCategoryGet**](docs/Api/SelnkyApi.md#losingcategoryget) | **GET** /losingCategory/ | seznam kategorií prohry
*SelnkyApi* | [**losingCategoryInsert**](docs/Api/SelnkyApi.md#losingcategoryinsert) | **PUT** /losingCategory/ | založení nové kategorie prohry
*SelnkyApi* | [**maritalStatusDelete**](docs/Api/SelnkyApi.md#maritalstatusdelete) | **DELETE** /maritalStatus/{id}/ | smazání rodinného stavu
*SelnkyApi* | [**maritalStatusEdit**](docs/Api/SelnkyApi.md#maritalstatusedit) | **POST** /maritalStatus/{id}/ | upravení rodinného stavu
*SelnkyApi* | [**maritalStatusGet**](docs/Api/SelnkyApi.md#maritalstatusget) | **GET** /maritalStatus/ | seznam rodinných stavů
*SelnkyApi* | [**maritalStatusInsert**](docs/Api/SelnkyApi.md#maritalstatusinsert) | **PUT** /maritalStatus/ | přidání rodinného stavu
*SelnkyApi* | [**offerCategoryDelete**](docs/Api/SelnkyApi.md#offercategorydelete) | **DELETE** /offerCategory/{id}/ | smazání kategorie nabídky
*SelnkyApi* | [**offerCategoryEdit**](docs/Api/SelnkyApi.md#offercategoryedit) | **POST** /offerCategory/{id}/ | upravení kategorie nabídky
*SelnkyApi* | [**offerCategoryGet**](docs/Api/SelnkyApi.md#offercategoryget) | **GET** /offerCategory/ | seznam kategorií nabídky
*SelnkyApi* | [**offerCategoryInsert**](docs/Api/SelnkyApi.md#offercategoryinsert) | **PUT** /offerCategory/ | založení nové kategorie nabídky
*SelnkyApi* | [**offerStatusDelete**](docs/Api/SelnkyApi.md#offerstatusdelete) | **DELETE** /offerStatus/{id}/ | smazání stavu nabídky
*SelnkyApi* | [**offerStatusGet**](docs/Api/SelnkyApi.md#offerstatusget) | **GET** /offerStatus/ | seznam stavů nabídky
*SelnkyApi* | [**offerStatusInsert**](docs/Api/SelnkyApi.md#offerstatusinsert) | **PUT** /offerStatus/ | založení nového stavu nabídky
*SelnkyApi* | [**paymentTermDelete**](docs/Api/SelnkyApi.md#paymenttermdelete) | **DELETE** /paymentTerm/{id}/ | smazání platební podmínky
*SelnkyApi* | [**paymentTermEdit**](docs/Api/SelnkyApi.md#paymenttermedit) | **POST** /paymentTerm/{id}/ | upravení platební podmínky
*SelnkyApi* | [**paymentTermGet**](docs/Api/SelnkyApi.md#paymenttermget) | **GET** /paymentTerm/ | seznam platebních podmínek
*SelnkyApi* | [**paymentTermInsert**](docs/Api/SelnkyApi.md#paymentterminsert) | **PUT** /paymentTerm/ | přidání platební podmínky
*SelnkyApi* | [**personCategoryDelete**](docs/Api/SelnkyApi.md#personcategorydelete) | **DELETE** /personCategory/{id}/ | smazání kategorie kontaktní osoby
*SelnkyApi* | [**personCategoryEdit**](docs/Api/SelnkyApi.md#personcategoryedit) | **POST** /personCategory/{id}/ | upravení kategorie kontaktní osoby
*SelnkyApi* | [**personCategoryGet**](docs/Api/SelnkyApi.md#personcategoryget) | **GET** /personCategory/ | seznam kategorií kontaktní osoby
*SelnkyApi* | [**personCategoryInsert**](docs/Api/SelnkyApi.md#personcategoryinsert) | **PUT** /personCategory/ | založení nové kategorie kontaktní osoby
*SelnkyApi* | [**personClassification1Delete**](docs/Api/SelnkyApi.md#personclassification1delete) | **DELETE** /personClassification1/{id}/ | smazání klasifikace 1 kontaktní osoby
*SelnkyApi* | [**personClassification1Edit**](docs/Api/SelnkyApi.md#personclassification1edit) | **POST** /personClassification1/{id}/ | upravení klasifikace 1 pro kontaktní osobu
*SelnkyApi* | [**personClassification1Get**](docs/Api/SelnkyApi.md#personclassification1get) | **GET** /personClassification1/ | seznam klasifikací 1 kontaktní osoby
*SelnkyApi* | [**personClassification1Insert**](docs/Api/SelnkyApi.md#personclassification1insert) | **PUT** /personClassification1/ | založení nové klasifikace 1 pro kontaktní osobu
*SelnkyApi* | [**personClassification2Delete**](docs/Api/SelnkyApi.md#personclassification2delete) | **DELETE** /personClassification2/{id}/ | smazání klasifikace 2 kontaktní osoby
*SelnkyApi* | [**personClassification2Edit**](docs/Api/SelnkyApi.md#personclassification2edit) | **POST** /personClassification2/{id}/ | upravení klasifikace 2 pro kontaktní osobu
*SelnkyApi* | [**personClassification2Get**](docs/Api/SelnkyApi.md#personclassification2get) | **GET** /personClassification2/ | seznam klasifikací 2 kontaktní osoby
*SelnkyApi* | [**personClassification2Insert**](docs/Api/SelnkyApi.md#personclassification2insert) | **PUT** /personClassification2/ | založení nové klasifikace 2 pro kontaktní osobu
*SelnkyApi* | [**personClassification3Delete**](docs/Api/SelnkyApi.md#personclassification3delete) | **DELETE** /personClassification3/{id}/ | smazání klasifikace 3 kontaktní osoby
*SelnkyApi* | [**personClassification3Edit**](docs/Api/SelnkyApi.md#personclassification3edit) | **POST** /personClassification3/{id}/ | upravení klasifikace 3 pro kontaktní osobu
*SelnkyApi* | [**personClassification3Get**](docs/Api/SelnkyApi.md#personclassification3get) | **GET** /personClassification3/ | seznam klasifikací 3 kontaktní osoby
*SelnkyApi* | [**personClassification3Insert**](docs/Api/SelnkyApi.md#personclassification3insert) | **PUT** /personClassification3/ | založení nové klasifikace 3 pro kontaktní osobu
*SelnkyApi* | [**priceListCategoryDelete**](docs/Api/SelnkyApi.md#pricelistcategorydelete) | **DELETE** /priceListCategory/{id}/ | smazání kategorie ceníku
*SelnkyApi* | [**priceListCategoryEdit**](docs/Api/SelnkyApi.md#pricelistcategoryedit) | **POST** /priceListCategory/{id}/ | upravení kategorie ceníku
*SelnkyApi* | [**priceListCategoryGet**](docs/Api/SelnkyApi.md#pricelistcategoryget) | **GET** /priceListCategory/ | seznam kategorií ceníku
*SelnkyApi* | [**priceListCategoryInsert**](docs/Api/SelnkyApi.md#pricelistcategoryinsert) | **PUT** /priceListCategory/ | založení nové kategorie ceníku
*SelnkyApi* | [**productCategoryDelete**](docs/Api/SelnkyApi.md#productcategorydelete) | **DELETE** /productCategory/{id}/ | smazání kategorie produktů
*SelnkyApi* | [**productCategoryEdit**](docs/Api/SelnkyApi.md#productcategoryedit) | **POST** /productCategory/{id}/ | upravení kategorie produktu
*SelnkyApi* | [**productCategoryGet**](docs/Api/SelnkyApi.md#productcategoryget) | **GET** /productCategory/ | seznam kategorie produktů
*SelnkyApi* | [**productCategoryInsert**](docs/Api/SelnkyApi.md#productcategoryinsert) | **PUT** /productCategory/ | založení nové kategorie produktu
*SelnkyApi* | [**productLineDelete**](docs/Api/SelnkyApi.md#productlinedelete) | **DELETE** /productLine/{id}/ | smazání produktové řady
*SelnkyApi* | [**productLineEdit**](docs/Api/SelnkyApi.md#productlineedit) | **POST** /productLine/{id}/ | upravení produktové řady
*SelnkyApi* | [**productLineGet**](docs/Api/SelnkyApi.md#productlineget) | **GET** /productLine/ | seznam produktových řad
*SelnkyApi* | [**productLineInsert**](docs/Api/SelnkyApi.md#productlineinsert) | **PUT** /productLine/ | založení nové produktové řady
*SelnkyApi* | [**projectCategoryDelete**](docs/Api/SelnkyApi.md#projectcategorydelete) | **DELETE** /projectCategory/{id}/ | smazání kategorie projektu
*SelnkyApi* | [**projectCategoryEdit**](docs/Api/SelnkyApi.md#projectcategoryedit) | **POST** /projectCategory/{id}/ | upravení kategorie projektu
*SelnkyApi* | [**projectCategoryGet**](docs/Api/SelnkyApi.md#projectcategoryget) | **GET** /projectCategory/ | seznam kategorií projektu
*SelnkyApi* | [**projectCategoryInsert**](docs/Api/SelnkyApi.md#projectcategoryinsert) | **PUT** /projectCategory/ | založení nové kategorie projektu
*SelnkyApi* | [**projectRelationshipCategoryDelete**](docs/Api/SelnkyApi.md#projectrelationshipcategorydelete) | **DELETE** /projectRelationshipCategory/{id}/ | smazání kategorie participace projektu
*SelnkyApi* | [**projectRelationshipCategoryEdit**](docs/Api/SelnkyApi.md#projectrelationshipcategoryedit) | **POST** /projectRelationshipCategory/{id}/ | upravení kategorie participace projektu
*SelnkyApi* | [**projectRelationshipCategoryGet**](docs/Api/SelnkyApi.md#projectrelationshipcategoryget) | **GET** /projectRelationshipCategory/ | seznam kategorií participace projektu
*SelnkyApi* | [**projectRelationshipCategoryInsert**](docs/Api/SelnkyApi.md#projectrelationshipcategoryinsert) | **PUT** /projectRelationshipCategory/ | založení nové kategorie participace projektu
*SelnkyApi* | [**projectStatusDelete**](docs/Api/SelnkyApi.md#projectstatusdelete) | **DELETE** /projectStatus/{id}/ | smazání stavu projektu
*SelnkyApi* | [**projectStatusGet**](docs/Api/SelnkyApi.md#projectstatusget) | **GET** /projectStatus/ | seznam stavů projektu
*SelnkyApi* | [**projectStatusInsert**](docs/Api/SelnkyApi.md#projectstatusinsert) | **PUT** /projectStatus/ | založení nového stavu projektu
*SelnkyApi* | [**salesOrderCategoryDelete**](docs/Api/SelnkyApi.md#salesordercategorydelete) | **DELETE** /salesOrderCategory/{id}/ | smazání kategorie objednávky
*SelnkyApi* | [**salesOrderCategoryEdit**](docs/Api/SelnkyApi.md#salesordercategoryedit) | **POST** /salesOrderCategory/{id}/ | upravení kategorie objednávky
*SelnkyApi* | [**salesOrderCategoryGet**](docs/Api/SelnkyApi.md#salesordercategoryget) | **GET** /salesOrderCategory/ | seznam kategorií objednávky
*SelnkyApi* | [**salesOrderCategoryInsert**](docs/Api/SelnkyApi.md#salesordercategoryinsert) | **PUT** /salesOrderCategory/ | založení nové kategorie objednávky
*SelnkyApi* | [**salesOrderStatusDelete**](docs/Api/SelnkyApi.md#salesorderstatusdelete) | **DELETE** /salesOrderStatus/{id}/ | smazání stavu objednávky
*SelnkyApi* | [**salesOrderStatusGet**](docs/Api/SelnkyApi.md#salesorderstatusget) | **GET** /salesOrderStatus/ | seznam stavů objednávky
*SelnkyApi* | [**salesOrderStatusInsert**](docs/Api/SelnkyApi.md#salesorderstatusinsert) | **PUT** /salesOrderStatus/ | založení nového stavu objednávky
*SelnkyApi* | [**taxRateDelete**](docs/Api/SelnkyApi.md#taxratedelete) | **DELETE** /taxRate/{id}/ | smazání sazby DPH
*SelnkyApi* | [**taxRateGet**](docs/Api/SelnkyApi.md#taxrateget) | **GET** /taxRate/ | seznam sazeb DPH
*SelnkyApi* | [**taxRateInsert**](docs/Api/SelnkyApi.md#taxrateinsert) | **PUT** /taxRate/ | založení nové sazby DPH
*SelnkyApi* | [**telTypeDelete**](docs/Api/SelnkyApi.md#teltypedelete) | **DELETE** /telType/{id}/ | smazání typu telefonu
*SelnkyApi* | [**telTypeEdit**](docs/Api/SelnkyApi.md#teltypeedit) | **POST** /telType/{id}/ | upravení typu telefonu
*SelnkyApi* | [**telTypeGet**](docs/Api/SelnkyApi.md#teltypeget) | **GET** /telType/ | seznam typů telefonu
*SelnkyApi* | [**telTypeInsert**](docs/Api/SelnkyApi.md#teltypeinsert) | **PUT** /telType/ | založení nového typu telefonu
*SelnkyApi* | [**territoryDelete**](docs/Api/SelnkyApi.md#territorydelete) | **DELETE** /territory/{id}/ | smazání obchodního teritoria
*SelnkyApi* | [**territoryEdit**](docs/Api/SelnkyApi.md#territoryedit) | **POST** /territory/{id}/ | upravení obchodního teritoria
*SelnkyApi* | [**territoryGet**](docs/Api/SelnkyApi.md#territoryget) | **GET** /territory/ | seznam obchodních teritorií
*SelnkyApi* | [**territoryInsert**](docs/Api/SelnkyApi.md#territoryinsert) | **PUT** /territory/ | založení nového obchodního teritoria
*SouboryApi* | [**attachmentDelete**](docs/Api/SouboryApi.md#attachmentdelete) | **DELETE** /attachment/{attachmentId}/ | Smazání přílohy
*SouboryApi* | [**attachmentInsert**](docs/Api/SouboryApi.md#attachmentinsert) | **PUT** /attachment/{entityName}/{entityId}/ | Přidání přílohy
*SouboryApi* | [**attachmentInsertCustomField**](docs/Api/SouboryApi.md#attachmentinsertcustomfield) | **PUT** /attachment/{entityName}/{entityId}/{customFieldId}/ | Přidání přílohy se souborem do volitelného pole
*SouboryApi* | [**exportBodyGet**](docs/Api/SouboryApi.md#exportbodyget) | **GET** /exportBody/{uuid}/{accessToken}/{instanceName}/ | Stažení těla exportu
*SouboryApi* | [**fileBodyGet**](docs/Api/SouboryApi.md#filebodyget) | **GET** /fileBody/{uuid}/{accessToken}/{instanceName}/ | Stažení těla souboru
*SouboryApi* | [**fileHeaderDetailGet**](docs/Api/SouboryApi.md#fileheaderdetailget) | **GET** /fileHeader/{fileId}/ | Stažení meta informací o souboru
*SouboryApi* | [**fileUploadEdit**](docs/Api/SouboryApi.md#fileuploadedit) | **POST** /fileUpload | Upload souboru do CRM
*SouboryApi* | [**iconDetailGet**](docs/Api/SouboryApi.md#icondetailget) | **GET** /icon/{fileId}/ | Stažení ikony obrázku
*SouboryApi* | [**imageDetailGet**](docs/Api/SouboryApi.md#imagedetailget) | **GET** /image/{fileId}/ | Stažení obrázku
*TelefontApi* | [**phoneCallDelete**](docs/Api/TelefontApi.md#phonecalldelete) | **DELETE** /phoneCall/{phoneCallId}/ | smazání telefonátu
*TelefontApi* | [**phoneCallDetailGet**](docs/Api/TelefontApi.md#phonecalldetailget) | **GET** /phoneCall/{phoneCallId}/ | detail telefonátu
*TelefontApi* | [**phoneCallEdit**](docs/Api/TelefontApi.md#phonecalledit) | **POST** /phoneCall/{phoneCallId}/ | upravení telefonátu
*TelefontApi* | [**phoneCallGet**](docs/Api/TelefontApi.md#phonecallget) | **GET** /phoneCall/ | seznam telefonátů
*TelefontApi* | [**phoneCallInsert**](docs/Api/TelefontApi.md#phonecallinsert) | **PUT** /phoneCall/ | nový telefonát
*UdlostApi* | [**eventDelete**](docs/Api/UdlostApi.md#eventdelete) | **DELETE** /event/{eventId}/ | smazání události
*UdlostApi* | [**eventDetailGet**](docs/Api/UdlostApi.md#eventdetailget) | **GET** /event/{eventId}/ | detail události
*UdlostApi* | [**eventEdit**](docs/Api/UdlostApi.md#eventedit) | **POST** /event/{eventId}/ | upravení události
*UdlostApi* | [**eventGet**](docs/Api/UdlostApi.md#eventget) | **GET** /event/ | seznam událostí
*UdlostApi* | [**eventInsert**](docs/Api/UdlostApi.md#eventinsert) | **PUT** /event/ | nová událost
*UivatelApi* | [**userAccountDetailGet**](docs/Api/UivatelApi.md#useraccountdetailget) | **GET** /userAccount/{userAccountId}/ | detail uživatele
*UivatelApi* | [**userAccountGet**](docs/Api/UivatelApi.md#useraccountget) | **GET** /userAccount/ | seznam uživatelů
*UivatelApi* | [**userAccountSecurityLevelDelete**](docs/Api/UivatelApi.md#useraccountsecurityleveldelete) | **DELETE** /userAccount/{userAccountId}/securityLevel/{securityLevelId} | odebrání bezpečností úrovně uživatele
*UivatelApi* | [**userAccountSecurityLevelInsert**](docs/Api/UivatelApi.md#useraccountsecuritylevelinsert) | **PUT** /userAccount/{userAccountId}/securityLevel/{securityLevelId} | přidání bezpečností úrovně uživatele
*VlastnTlatkaApi* | [**customButtonGet**](docs/Api/VlastnTlatkaApi.md#custombuttonget) | **GET** /customButton/ | Načtení konfigurace
*VlastnTlatkaApi* | [**customButtonInsert**](docs/Api/VlastnTlatkaApi.md#custombuttoninsert) | **PUT** /customButton/ | Nové vlastní tlačítko
*VlastnTlatkaApi* | [**securityChecktokenDetailGet**](docs/Api/VlastnTlatkaApi.md#securitychecktokendetailget) | **GET** /security/checktoken/{token}/{personId}/ | ověření bezpečnostního tokenu
*VolitelnPoleApi* | [**customFieldConfigDelete**](docs/Api/VolitelnPoleApi.md#customfieldconfigdelete) | **DELETE** /customField/config/{entityName}/{fieldName} | Smazání volitelného pole
*VolitelnPoleApi* | [**customFieldConfigEdit**](docs/Api/VolitelnPoleApi.md#customfieldconfigedit) | **POST** /customField/config/{entityName}/{fieldName} | Upravení volitelného pole
*VolitelnPoleApi* | [**customFieldConfigGet**](docs/Api/VolitelnPoleApi.md#customfieldconfigget) | **GET** /customField/config/ | Načtení konfigurace
*VolitelnPoleApi* | [**customFieldConfigInsert**](docs/Api/VolitelnPoleApi.md#customfieldconfiginsert) | **PUT** /customField/config/{entityName}/ | Nové volitelné pole
*VolitelnPoleApi* | [**customFieldEnumDelete**](docs/Api/VolitelnPoleApi.md#customfieldenumdelete) | **DELETE** /customField/enum/{entityName}/{fieldName}/ | Smazání položky enumerace
*VolitelnPoleApi* | [**customFieldEnumEdit**](docs/Api/VolitelnPoleApi.md#customfieldenumedit) | **POST** /customField/enum/{entityName}/{fieldName}/ | Upravení položky enumerace
*VolitelnPoleApi* | [**customFieldEnumGet**](docs/Api/VolitelnPoleApi.md#customfieldenumget) | **GET** /customField/enum/{entityName}/{fieldName}/ | Načtení seznamu položek enumerace
*VolitelnPoleApi* | [**customFieldEnumInsert**](docs/Api/VolitelnPoleApi.md#customfieldenuminsert) | **PUT** /customField/enum/{entityName}/{fieldName}/ | Založení nové položky enumerace
*WebhookApi* | [**webhookDelete**](docs/Api/WebhookApi.md#webhookdelete) | **DELETE** /webhook/{uuid}/ | smazání webhooku
*WebhookApi* | [**webhookGet**](docs/Api/WebhookApi.md#webhookget) | **GET** /webhook/ | seznam webhooků
*WebhookApi* | [**webhookInsert**](docs/Api/WebhookApi.md#webhookinsert) | **PUT** /webhook/ | nový webhook
*WebhookApi* | [**webhookTechnicalContactEdit**](docs/Api/WebhookApi.md#webhooktechnicalcontactedit) | **POST** /webhook/technicalContact/ | upravení technického kontaktu

## Models

- [ActivityCategoryEdit200Response](docs/Model/ActivityCategoryEdit200Response.md)
- [ActivityCategoryEditDto](docs/Model/ActivityCategoryEditDto.md)
- [ActivityCategoryInsertDto](docs/Model/ActivityCategoryInsertDto.md)
- [AttachmentInsert201Response](docs/Model/AttachmentInsert201Response.md)
- [AttachmentInsertCustomFieldDto](docs/Model/AttachmentInsertCustomFieldDto.md)
- [AttachmentInsertDto](docs/Model/AttachmentInsertDto.md)
- [BusinessCaseCategoryEdit200Response](docs/Model/BusinessCaseCategoryEdit200Response.md)
- [BusinessCaseCategoryEditDto](docs/Model/BusinessCaseCategoryEditDto.md)
- [BusinessCaseCategoryInsertDto](docs/Model/BusinessCaseCategoryInsertDto.md)
- [BusinessCaseClassification1Edit200Response](docs/Model/BusinessCaseClassification1Edit200Response.md)
- [BusinessCaseClassification1EditDto](docs/Model/BusinessCaseClassification1EditDto.md)
- [BusinessCaseClassification1InsertDto](docs/Model/BusinessCaseClassification1InsertDto.md)
- [BusinessCaseClassification2Edit200Response](docs/Model/BusinessCaseClassification2Edit200Response.md)
- [BusinessCaseClassification2EditDto](docs/Model/BusinessCaseClassification2EditDto.md)
- [BusinessCaseClassification2InsertDto](docs/Model/BusinessCaseClassification2InsertDto.md)
- [BusinessCaseClassification3Edit200Response](docs/Model/BusinessCaseClassification3Edit200Response.md)
- [BusinessCaseClassification3EditDto](docs/Model/BusinessCaseClassification3EditDto.md)
- [BusinessCaseClassification3InsertDto](docs/Model/BusinessCaseClassification3InsertDto.md)
- [BusinessCaseCreateWithItemsInsertDto](docs/Model/BusinessCaseCreateWithItemsInsertDto.md)
- [BusinessCaseCreateWithItemsInsertDtoItemsInner](docs/Model/BusinessCaseCreateWithItemsInsertDtoItemsInner.md)
- [BusinessCaseEditDto](docs/Model/BusinessCaseEditDto.md)
- [BusinessCaseEditDtoItemsInner](docs/Model/BusinessCaseEditDtoItemsInner.md)
- [BusinessCaseInsertDto](docs/Model/BusinessCaseInsertDto.md)
- [BusinessCaseInsertDtoCustomFields](docs/Model/BusinessCaseInsertDtoCustomFields.md)
- [BusinessCaseItemEditDto](docs/Model/BusinessCaseItemEditDto.md)
- [BusinessCaseItemInsertDto](docs/Model/BusinessCaseItemInsertDto.md)
- [BusinessCaseParticipantsInsertDto](docs/Model/BusinessCaseParticipantsInsertDto.md)
- [BusinessCasePhaseInsertDto](docs/Model/BusinessCasePhaseInsertDto.md)
- [BusinessCaseRelationshipCategoryEdit200Response](docs/Model/BusinessCaseRelationshipCategoryEdit200Response.md)
- [BusinessCaseRelationshipCategoryEditDto](docs/Model/BusinessCaseRelationshipCategoryEditDto.md)
- [BusinessCaseRelationshipCategoryInsertDto](docs/Model/BusinessCaseRelationshipCategoryInsertDto.md)
- [CompanyAddressEditDto](docs/Model/CompanyAddressEditDto.md)
- [CompanyAddressInsertDto](docs/Model/CompanyAddressInsertDto.md)
- [CompanyAddressInsertDtoAddress](docs/Model/CompanyAddressInsertDtoAddress.md)
- [CompanyCategoryEdit200Response](docs/Model/CompanyCategoryEdit200Response.md)
- [CompanyCategoryEditDto](docs/Model/CompanyCategoryEditDto.md)
- [CompanyCategoryInsertDto](docs/Model/CompanyCategoryInsertDto.md)
- [CompanyClassification1Edit200Response](docs/Model/CompanyClassification1Edit200Response.md)
- [CompanyClassification1EditDto](docs/Model/CompanyClassification1EditDto.md)
- [CompanyClassification1InsertDto](docs/Model/CompanyClassification1InsertDto.md)
- [CompanyClassification2Edit200Response](docs/Model/CompanyClassification2Edit200Response.md)
- [CompanyClassification2EditDto](docs/Model/CompanyClassification2EditDto.md)
- [CompanyClassification2Insert201Response](docs/Model/CompanyClassification2Insert201Response.md)
- [CompanyClassification2Insert201ResponseDto](docs/Model/CompanyClassification2Insert201ResponseDto.md)
- [CompanyClassification2InsertDto](docs/Model/CompanyClassification2InsertDto.md)
- [CompanyClassification3Edit200Response](docs/Model/CompanyClassification3Edit200Response.md)
- [CompanyClassification3EditDto](docs/Model/CompanyClassification3EditDto.md)
- [CompanyClassification3InsertDto](docs/Model/CompanyClassification3InsertDto.md)
- [CompanyEditDto](docs/Model/CompanyEditDto.md)
- [CompanyInsertDto](docs/Model/CompanyInsertDto.md)
- [CompanyInsertDtoAddressesInner](docs/Model/CompanyInsertDtoAddressesInner.md)
- [CompanyInsertDtoAddressesInnerAddress](docs/Model/CompanyInsertDtoAddressesInnerAddress.md)
- [CompanyInsertDtoAddressesInnerContactInfo](docs/Model/CompanyInsertDtoAddressesInnerContactInfo.md)
- [CompanyInsertDtoCustomFields](docs/Model/CompanyInsertDtoCustomFields.md)
- [CompanyInsertDtoSocialNetworkContact](docs/Model/CompanyInsertDtoSocialNetworkContact.md)
- [CompanyRelationshipEditDto](docs/Model/CompanyRelationshipEditDto.md)
- [CompanyRelationshipInsertDto](docs/Model/CompanyRelationshipInsertDto.md)
- [CompanyTagDeleteDto](docs/Model/CompanyTagDeleteDto.md)
- [CompanyTagInsertDto](docs/Model/CompanyTagInsertDto.md)
- [CompanyTurnoverEdit200Response](docs/Model/CompanyTurnoverEdit200Response.md)
- [CompanyTurnoverEditDto](docs/Model/CompanyTurnoverEditDto.md)
- [CompanyTurnoverInsertDto](docs/Model/CompanyTurnoverInsertDto.md)
- [ContactSourceEdit200Response](docs/Model/ContactSourceEdit200Response.md)
- [ContactSourceEditDto](docs/Model/ContactSourceEditDto.md)
- [ContactSourceInsertDto](docs/Model/ContactSourceInsertDto.md)
- [Currency201Response](docs/Model/Currency201Response.md)
- [CurrencyEdit200Response](docs/Model/CurrencyEdit200Response.md)
- [CurrencyEditDto](docs/Model/CurrencyEditDto.md)
- [CurrencyInsertDto](docs/Model/CurrencyInsertDto.md)
- [CustomButtonInsert201Response](docs/Model/CustomButtonInsert201Response.md)
- [CustomButtonInsertDto](docs/Model/CustomButtonInsertDto.md)
- [CustomFieldConfigEditDto](docs/Model/CustomFieldConfigEditDto.md)
- [CustomFieldConfigGet200Response](docs/Model/CustomFieldConfigGet200Response.md)
- [CustomFieldConfigGet200ResponseDto](docs/Model/CustomFieldConfigGet200ResponseDto.md)
- [CustomFieldConfigGet200ResponseItemDtoInner](docs/Model/CustomFieldConfigGet200ResponseItemDtoInner.md)
- [CustomFieldConfigInsert201Response](docs/Model/CustomFieldConfigInsert201Response.md)
- [CustomFieldConfigInsert201ResponseDto](docs/Model/CustomFieldConfigInsert201ResponseDto.md)
- [CustomFieldConfigInsertDto](docs/Model/CustomFieldConfigInsertDto.md)
- [CustomFieldEnumDelete200Response](docs/Model/CustomFieldEnumDelete200Response.md)
- [CustomFieldEnumDeleteDto](docs/Model/CustomFieldEnumDeleteDto.md)
- [CustomFieldEnumEdit200Response](docs/Model/CustomFieldEnumEdit200Response.md)
- [CustomFieldEnumEditDto](docs/Model/CustomFieldEnumEditDto.md)
- [CustomFieldEnumGet200Response](docs/Model/CustomFieldEnumGet200Response.md)
- [CustomFieldEnumInsert200Response](docs/Model/CustomFieldEnumInsert200Response.md)
- [CustomFieldEnumInsertDto](docs/Model/CustomFieldEnumInsertDto.md)
- [DmsDocumentEditDto](docs/Model/DmsDocumentEditDto.md)
- [DmsDocumentEditDtoFile](docs/Model/DmsDocumentEditDtoFile.md)
- [DmsDocumentInsertDto](docs/Model/DmsDocumentInsertDto.md)
- [DmsDocumentInsertDtoFile](docs/Model/DmsDocumentInsertDtoFile.md)
- [DmsDocumentInsertDtoLink](docs/Model/DmsDocumentInsertDtoLink.md)
- [DmsFolderInsertDto](docs/Model/DmsFolderInsertDto.md)
- [EconomyActivityEdit200Response](docs/Model/EconomyActivityEdit200Response.md)
- [EconomyActivityEditDto](docs/Model/EconomyActivityEditDto.md)
- [EconomyActivityInsertDto](docs/Model/EconomyActivityInsertDto.md)
- [EmailEdit200Response](docs/Model/EmailEdit200Response.md)
- [EmailEditDto](docs/Model/EmailEditDto.md)
- [EmailInsertDto](docs/Model/EmailInsertDto.md)
- [EmployeesNumberEdit200Response](docs/Model/EmployeesNumberEdit200Response.md)
- [EmployeesNumberEditDto](docs/Model/EmployeesNumberEditDto.md)
- [EmployeesNumberInsertDto](docs/Model/EmployeesNumberInsertDto.md)
- [EventEdit200Response](docs/Model/EventEdit200Response.md)
- [EventEditDto](docs/Model/EventEditDto.md)
- [EventInsertDto](docs/Model/EventInsertDto.md)
- [ExtIdInsertDto](docs/Model/ExtIdInsertDto.md)
- [FileUploadEdit200Response](docs/Model/FileUploadEdit200Response.md)
- [GdprEditDto](docs/Model/GdprEditDto.md)
- [GdprFormAgreementEdit200Response](docs/Model/GdprFormAgreementEdit200Response.md)
- [GdprFormAgreementEditDto](docs/Model/GdprFormAgreementEditDto.md)
- [GdprFormAgreementInsertDto](docs/Model/GdprFormAgreementInsertDto.md)
- [GdprInsertDto](docs/Model/GdprInsertDto.md)
- [Insert201Response](docs/Model/Insert201Response.md)
- [Insert201ResponseDto](docs/Model/Insert201ResponseDto.md)
- [InvoiceChangeCodeEditRequest](docs/Model/InvoiceChangeCodeEditRequest.md)
- [InvoiceChangeDecimalPrecisionEditDto](docs/Model/InvoiceChangeDecimalPrecisionEditDto.md)
- [InvoiceCreditNoteInsertDto](docs/Model/InvoiceCreditNoteInsertDto.md)
- [InvoiceEditDto](docs/Model/InvoiceEditDto.md)
- [InvoiceEditDtoBillingAddress](docs/Model/InvoiceEditDtoBillingAddress.md)
- [InvoiceEditDtoItemsInner](docs/Model/InvoiceEditDtoItemsInner.md)
- [InvoiceEditDtoVendorAddress](docs/Model/InvoiceEditDtoVendorAddress.md)
- [InvoiceInsertDto](docs/Model/InvoiceInsertDto.md)
- [InvoicePaymentInsertDto](docs/Model/InvoicePaymentInsertDto.md)
- [LanguageEdit200Response](docs/Model/LanguageEdit200Response.md)
- [LanguageEditDto](docs/Model/LanguageEditDto.md)
- [LanguageInsertDto](docs/Model/LanguageInsertDto.md)
- [LeadCategoryEdit200Response](docs/Model/LeadCategoryEdit200Response.md)
- [LeadCategoryEditDto](docs/Model/LeadCategoryEditDto.md)
- [LeadCategoryInsertDto](docs/Model/LeadCategoryInsertDto.md)
- [LeadEdit200Response](docs/Model/LeadEdit200Response.md)
- [LeadEditDto](docs/Model/LeadEditDto.md)
- [LeadInsertDto](docs/Model/LeadInsertDto.md)
- [LeadInsertDtoAddress](docs/Model/LeadInsertDtoAddress.md)
- [LeadInsertDtoContactInfo](docs/Model/LeadInsertDtoContactInfo.md)
- [LeadPhaseInsertDto](docs/Model/LeadPhaseInsertDto.md)
- [LegalFormEdit200Response](docs/Model/LegalFormEdit200Response.md)
- [LegalFormEditDto](docs/Model/LegalFormEditDto.md)
- [LegalFormInsertDto](docs/Model/LegalFormInsertDto.md)
- [LetterEdit200Response](docs/Model/LetterEdit200Response.md)
- [LetterEditDto](docs/Model/LetterEditDto.md)
- [LetterEditDtoParticipantsInner](docs/Model/LetterEditDtoParticipantsInner.md)
- [LetterInsertDto](docs/Model/LetterInsertDto.md)
- [LosingCategoryEdit200Response](docs/Model/LosingCategoryEdit200Response.md)
- [LosingCategoryEditDto](docs/Model/LosingCategoryEditDto.md)
- [LosingCategoryInsertDto](docs/Model/LosingCategoryInsertDto.md)
- [MaritalStatusEdit200Response](docs/Model/MaritalStatusEdit200Response.md)
- [MaritalStatusEditDto](docs/Model/MaritalStatusEditDto.md)
- [MaritalStatusInsertDto](docs/Model/MaritalStatusInsertDto.md)
- [MassEmailEditDto](docs/Model/MassEmailEditDto.md)
- [MassEmailInsertDto](docs/Model/MassEmailInsertDto.md)
- [MassEmailInsertDtoStats](docs/Model/MassEmailInsertDtoStats.md)
- [MassEmailRecipientBulkUpdateEditDtoInner](docs/Model/MassEmailRecipientBulkUpdateEditDtoInner.md)
- [MassEmailRecipientEditDto](docs/Model/MassEmailRecipientEditDto.md)
- [MassEmailRecipientInsertDto](docs/Model/MassEmailRecipientInsertDto.md)
- [MeetingEdit200Response](docs/Model/MeetingEdit200Response.md)
- [MeetingEditDto](docs/Model/MeetingEditDto.md)
- [MeetingInsertDto](docs/Model/MeetingInsertDto.md)
- [OfferCategoryEdit200Response](docs/Model/OfferCategoryEdit200Response.md)
- [OfferCategoryEditDto](docs/Model/OfferCategoryEditDto.md)
- [OfferCategoryInsertDto](docs/Model/OfferCategoryInsertDto.md)
- [OfferEditDto](docs/Model/OfferEditDto.md)
- [OfferInsertDto](docs/Model/OfferInsertDto.md)
- [OfferItemEditDto](docs/Model/OfferItemEditDto.md)
- [OfferItemInsertDto](docs/Model/OfferItemInsertDto.md)
- [OfferStatusInsertDto](docs/Model/OfferStatusInsertDto.md)
- [PaymentTermEdit200Response](docs/Model/PaymentTermEdit200Response.md)
- [PaymentTermEditDto](docs/Model/PaymentTermEditDto.md)
- [PaymentTermInsertDto](docs/Model/PaymentTermInsertDto.md)
- [PersonCategoryEdit200Response](docs/Model/PersonCategoryEdit200Response.md)
- [PersonCategoryEditDto](docs/Model/PersonCategoryEditDto.md)
- [PersonCategoryInsertDto](docs/Model/PersonCategoryInsertDto.md)
- [PersonClassification1Edit200Response](docs/Model/PersonClassification1Edit200Response.md)
- [PersonClassification1EditDto](docs/Model/PersonClassification1EditDto.md)
- [PersonClassification1InsertDto](docs/Model/PersonClassification1InsertDto.md)
- [PersonClassification2Edit200Response](docs/Model/PersonClassification2Edit200Response.md)
- [PersonClassification2EditDto](docs/Model/PersonClassification2EditDto.md)
- [PersonClassification2InsertDto](docs/Model/PersonClassification2InsertDto.md)
- [PersonClassification3Edit200Response](docs/Model/PersonClassification3Edit200Response.md)
- [PersonClassification3EditDto](docs/Model/PersonClassification3EditDto.md)
- [PersonClassification3InsertDto](docs/Model/PersonClassification3InsertDto.md)
- [PersonEditDto](docs/Model/PersonEditDto.md)
- [PersonInsertDto](docs/Model/PersonInsertDto.md)
- [PersonInsertDtoPrivateAddress](docs/Model/PersonInsertDtoPrivateAddress.md)
- [PersonInsertDtoRelationship](docs/Model/PersonInsertDtoRelationship.md)
- [PersonRelationshipEditDto](docs/Model/PersonRelationshipEditDto.md)
- [PersonRelationshipInsertDto](docs/Model/PersonRelationshipInsertDto.md)
- [PersonTagDeleteDto](docs/Model/PersonTagDeleteDto.md)
- [PersonTagInsertDto](docs/Model/PersonTagInsertDto.md)
- [PhoneCallEdit200Response](docs/Model/PhoneCallEdit200Response.md)
- [PhoneCallEditDto](docs/Model/PhoneCallEditDto.md)
- [PhonecallInsertDto](docs/Model/PhonecallInsertDto.md)
- [PostDelete201Response](docs/Model/PostDelete201Response.md)
- [PostInsertDto](docs/Model/PostInsertDto.md)
- [PriceListCategoryEdit200Response](docs/Model/PriceListCategoryEdit200Response.md)
- [PriceListCategoryEditDto](docs/Model/PriceListCategoryEditDto.md)
- [PriceListCategoryInsertDto](docs/Model/PriceListCategoryInsertDto.md)
- [PriceListEditDto](docs/Model/PriceListEditDto.md)
- [PriceListInsertDto](docs/Model/PriceListInsertDto.md)
- [PriceListItemBulkUpsertEditDtoInner](docs/Model/PriceListItemBulkUpsertEditDtoInner.md)
- [PriceListItemEditDto](docs/Model/PriceListItemEditDto.md)
- [PriceListItemInsertDto](docs/Model/PriceListItemInsertDto.md)
- [ProductCategoryEdit200Response](docs/Model/ProductCategoryEdit200Response.md)
- [ProductCategoryEditDto](docs/Model/ProductCategoryEditDto.md)
- [ProductCategoryInsertDto](docs/Model/ProductCategoryInsertDto.md)
- [ProductEditDto](docs/Model/ProductEditDto.md)
- [ProductInsertDto](docs/Model/ProductInsertDto.md)
- [ProductLineEdit200Response](docs/Model/ProductLineEdit200Response.md)
- [ProductLineEditDto](docs/Model/ProductLineEditDto.md)
- [ProductLineInsertDto](docs/Model/ProductLineInsertDto.md)
- [ProjectCategoryEdit200Response](docs/Model/ProjectCategoryEdit200Response.md)
- [ProjectCategoryEditDto](docs/Model/ProjectCategoryEditDto.md)
- [ProjectCategoryInsertDto](docs/Model/ProjectCategoryInsertDto.md)
- [ProjectEditDto](docs/Model/ProjectEditDto.md)
- [ProjectInsertDto](docs/Model/ProjectInsertDto.md)
- [ProjectParticipantsInsertDto](docs/Model/ProjectParticipantsInsertDto.md)
- [ProjectRelationshipCategoryEdit200Response](docs/Model/ProjectRelationshipCategoryEdit200Response.md)
- [ProjectRelationshipCategoryEditDto](docs/Model/ProjectRelationshipCategoryEditDto.md)
- [ProjectRelationshipCategoryInsertDto](docs/Model/ProjectRelationshipCategoryInsertDto.md)
- [ProjectStatusInsertDto](docs/Model/ProjectStatusInsertDto.md)
- [SalesOrderCategoryEdit200Response](docs/Model/SalesOrderCategoryEdit200Response.md)
- [SalesOrderCategoryEditDto](docs/Model/SalesOrderCategoryEditDto.md)
- [SalesOrderCategoryInsertDto](docs/Model/SalesOrderCategoryInsertDto.md)
- [SalesOrderEditDto](docs/Model/SalesOrderEditDto.md)
- [SalesOrderEditDtoDeliveryAddress](docs/Model/SalesOrderEditDtoDeliveryAddress.md)
- [SalesOrderEditDtoInvoiceAddress](docs/Model/SalesOrderEditDtoInvoiceAddress.md)
- [SalesOrderInsertDto](docs/Model/SalesOrderInsertDto.md)
- [SalesOrderInsertDtoDeliveryAddress](docs/Model/SalesOrderInsertDtoDeliveryAddress.md)
- [SalesOrderInsertDtoDeliveryAddressInvoiceAddress](docs/Model/SalesOrderInsertDtoDeliveryAddressInvoiceAddress.md)
- [SalesOrderItemEditDto](docs/Model/SalesOrderItemEditDto.md)
- [SalesOrderItemInsertDto](docs/Model/SalesOrderItemInsertDto.md)
- [SalesOrderStatusInsertDto](docs/Model/SalesOrderStatusInsertDto.md)
- [SecurityLevelInsertDto](docs/Model/SecurityLevelInsertDto.md)
- [SecurityLevelMultiAddUserEdit201Response](docs/Model/SecurityLevelMultiAddUserEdit201Response.md)
- [SecurityLevelMultiAddUserEditDto](docs/Model/SecurityLevelMultiAddUserEditDto.md)
- [SecurityLevelMultiRemoveUserEdit201Response](docs/Model/SecurityLevelMultiRemoveUserEdit201Response.md)
- [SecurityLevelMultiRemoveUserEditDto](docs/Model/SecurityLevelMultiRemoveUserEditDto.md)
- [TaskEdit200Response](docs/Model/TaskEdit200Response.md)
- [TaskEditDto](docs/Model/TaskEditDto.md)
- [TaskEditDtoParticipantsInner](docs/Model/TaskEditDtoParticipantsInner.md)
- [TaskInsertDto](docs/Model/TaskInsertDto.md)
- [TaxRateInsertDto](docs/Model/TaxRateInsertDto.md)
- [TelTypeEdit200Response](docs/Model/TelTypeEdit200Response.md)
- [TelTypeEditDto](docs/Model/TelTypeEditDto.md)
- [TelTypeInsertDto](docs/Model/TelTypeInsertDto.md)
- [TerritoryEdit200Response](docs/Model/TerritoryEdit200Response.md)
- [TerritoryEditDto](docs/Model/TerritoryEditDto.md)
- [TerritoryInsertDto](docs/Model/TerritoryInsertDto.md)
- [WatcherDelete201Response](docs/Model/WatcherDelete201Response.md)
- [WebhookInsert201Response](docs/Model/WebhookInsert201Response.md)
- [WebhookInsert201ResponseDto](docs/Model/WebhookInsert201ResponseDto.md)
- [WebhookInsertDto](docs/Model/WebhookInsertDto.md)
- [WebhookTechnicalContactEdit200Response](docs/Model/WebhookTechnicalContactEdit200Response.md)
- [WebhookTechnicalContactEditDto](docs/Model/WebhookTechnicalContactEditDto.md)

## Authorization

### basicAuth

- **Type**: HTTP basic authentication


### instanceName

- **Type**: API key
- **API key parameter name**: X-Instance-Name
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `2.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
