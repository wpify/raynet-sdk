<?php
/**
 * SelnkyApiTest
 * PHP version 7.4
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * RAYNET CRM API
 *
 * Cloud CRM REST API je programové rozhraní systému RAYNET CRM, které umožňuje pracovat s daty uvnitř CRM z aplikací třetích stran. Komunikace probíhá standardním protokolem HTTP s ohledem na [REST](https://en.wikipedia.org/wiki/Representational_state_transfer) principy. ## Připojení k RAYNET CRM Komunikačním protokolem je HTTP, proto je možné použít libovolnou aplikaci nebo knihovnu, která tento protokol podporuje. Pro demonstraci bude využita aplikace [curl](https://curl.haxx.se/). Alternativou je například add-on [Talend API Tester](https://chrome.google.com/webstore/detail/talend-api-tester-free-ed/aejoelaoggembcahagimdiliamlcdmfm) do prohlížeče Google Chrome. Přístup je zabezpečen pomocí basic authentication (uživatelským jménem a API klíčem) a šifrován protokolem TLSv1.2 a vyšším (HTTPS) pro zajištění maximální bezpečnosti. V hlavičce požadavku je nutné zaslat název Vaší instance (např. `moje-crm`).  ```bash   curl -X GET -u 'uzivatel:api-klic' -H 'X-Instance-Name: moje-crm' 'https://app.raynet.cz/api/v2/company/' ```  ## Datové typy  Hodnoty jednotlivých atributů v systému RAYNET CRM jsou tvořeny několika základními datovými typy:  + `Řetězec` - Textová hodnota.  + `Číslo` - Číselná hodnota. V závislosti na kontextu se může jednat buď o číslo celé nebo o číslo desetinné. V desetinných číslech se používá desetinná tečka.  + `Pravdivostní hodnota` - Hodnota ANO/NE. Pro hodnotu ANO lze využít true, on, yes a 1; pro hodnotu NE pak false, off, no a 0.  + `Datum` - Datum jako řetězec ve formátu `yyyy-MM-dd`.  + `Datum a čas` - Datum a čas jako řetězec ve formátu `yyyy-MM-dd HH:mm`. Akceptovány jsou také datum a čas ve formátu ISO8601 (např. `2022-01-01T12:00:00.000+01:00`).  + `Reference` - Datový typ reference odkazuje na jiný záznam v systému RAYNET CRM. V příchozích datech je reference mapou (JavaScriptový objektem), která obsahuje klíče:   + id - Identifikátor referencovaného záznamu.  ### Datum a čas  Datum a čas jako řetězec ve formátu `yyyy-MM-dd HH:mm` je v časové zóně uživatele, přes kterého jsou API požadavky realizovány. Pro filtrování a zápis (`PUT`, `POST`) je možné využít oba formáty (`yyyy-MM-dd HH:mm`, ISO8601).  V response je ve výchozím stavu datum a čas formátován jako `yyyy-MM-dd HH:mm` v časové zóně uživatele. Přidáním parametru `dateFormat=ISO8601` lze ovlivnit výstupní formát, kdy bude hodnota formátována do tvaru `2022-01-01T12:00:00.000+01:00`. např. `https://ww....company/?dateFormat=ISO8601`  ## Filtrování seznamu  Operátory pracující nad atributy a hodnotami jsou následující:  + `EQ` - Test na rovnost hodnot. + `EQ_OR_NULL` - Test na rovnost nebo prázdnou hodnotu.  + `NE` - Test na nerovnost hodnot.  + `NE_OR_NULL` - Test na nerovnost nebo prázdnou hodnotu.  + `LT` - Hodnota v databázi je menší než zadaná.  + `LE` - Hodnota v databázi je menší nebo rovna než zadaná.  + `GT` - Hodnota v databázi je větší než zadaná.  + `GE` - Hodnota v databázi je větší nebo rovna než zadaná.  + `LIKE` - Test na hodnotu odpovídající výrazu (např. hodnota filtru ABC% nalezne všechny záznamy, které začínají znaky ABC).  + `LIKE_NOCASE` - Obdoba LIKE, ale bez ohledu na malá a velká písmena.  + `IN` - Test na rovnost (více) hodnot oddělených čárkou. Správný formát vstupu je např.: `1,2,3,4`.  + `NOT_IN` - Test na nerovnost (více) hodnot oddělených čárkou. Správný formát vstupu je např.: `1,2,3,4`.  + `CUSTOM` - Speciální operátor - chování testu je popsáno dále v dokumentaci.  Výchozím operátorem je rovnost `EQ`. Operátor se zapisuje do hranatých závorek za název atributu. Je tak možné zadat více filtrovacích kritérií nad stejným atributem. `https://app..../?validFrom[GT]=\"2014-06-01\"&validTill[LT]=\"2014-06-10\"` Častým scénářem je vyfiltrování všech záznamů, které mají daný atribut prázdný nebo naopak neprázdný. Pro tyto účely lze použít hodnotu `prázdný řetězec` v kombinaci s operátorem `EQ` nebo `NE`.  ## Uspořádání seznamu  Uspořádání seznamu je kontrolováno parametrem `sortColumn` a `sortDirection`. U každého API je výčet hodnot, pomocí kterých lze seznam řadit. Parametr `sortDirection` může nabývat hodnot:  + `ASC` - Hodnoty jsou řazeny vzestupně  + `DESC` - Hodnoty jsou řazeny sestupně  ## Stránkování seznamu  Seznam je možné stránkovat nastavením parametrů `offset` a `limit`. Offset udává první záznam, který bude zobrazen, limit pak počet záznamů. Maximální velikost stránky je 1 000 položek. Například `https://app..../?offset=0&limit=2`  ## Fulltext  Ve většině seznamů je možné využít fulltextové vyhledání podle zadaného textového řetězce. Slouží k tomu parametr `fulltext`, který se aplikuje např. takto: `https://app..../?fulltext=nejakytext`  ## Limity API  Každá API odpověď obsahuje hlavičky, které popisují stav využití API pro danou instanci.  ``` curl -X GET -u 'uzivatel:api-klic' -H 'X-Instance-Name: moje-crm' 'https://app.raynet.cz/api/v2/company/'  HTTP/1.1 200 OK Status: 200 OK X-Ratelimit-Limit: 24000 X-Ratelimit-Remaining: 23999 X-Ratelimit-Reset: 1508889600 ```  Význam jednotlivých hlaviček je následující:  | Hlavička | Význam | | -------- | ------ | | X-Ratelimit-Limit | Celkový limit pro aktuální časové okno a instanci. | | X-Ratelimit-Remaining | Zbývající počet požadavků. | | X-Ratelimit-Reset | Čas, kdy bude vyprší časové okno a limit bude resetován. Hodnota udává [unixový čas](https://cs.wikipedia.org/wiki/Unixov%C3%BD_%C4%8Das). |  Pokud je limit překročen, je navrácena chybová hláška s HTTP kódem `429 Too Many Requests`:  ```json {   \"type\": \"RequestLimitReached\",   \"message\": \"API request limit reached. See the X-RateLimit-* headers and check out the API documentation for more details.\" } ```  ### Co když mi limity nestačí  Ve výchozím stavu je přístup limitován na 24 000 požadavků za den (uvažováno od půlnoci do další půlnoci v časové zóně UTC). V případě, že limit pro vaši integraci nestačí, kontaktujte naší zákaznickou podporu na e-mailu podpora@raynet.cz a spolu se určitě dobereme vhodného řešení.  ### Špatné přihlášení  V případě zaslaní více než 20 požadavků se špatnými přihlašovacími údaji, bude tento přístup na 60 minut zablokován. Toto omezení platí pro konkrétní IP adresu.
 *
 * The version of the OpenAPI document: 2.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.5.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Please update the test case below to test the endpoint.
 */

namespace RaynetApiClient\Test\Api;

use \RaynetApiClient\Configuration;
use \RaynetApiClient\ApiException;
use \RaynetApiClient\ObjectSerializer;
use PHPUnit\Framework\TestCase;

/**
 * SelnkyApiTest Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SelnkyApiTest extends TestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test case for activityCategoryDelete
     *
     * smazání kategorie aktivity.
     *
     */
    public function testActivityCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for activityCategoryEdit
     *
     * upravení kategorie aktivity.
     *
     */
    public function testActivityCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for activityCategoryGet
     *
     * seznam kategorií aktivit.
     *
     */
    public function testActivityCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for activityCategoryInsert
     *
     * založení nové kategorie aktivity.
     *
     */
    public function testActivityCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseCategoryDelete
     *
     * smazání kategorie obchodního případu.
     *
     */
    public function testBusinessCaseCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseCategoryEdit
     *
     * upravení kategorie obchodního případu.
     *
     */
    public function testBusinessCaseCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseCategoryGet
     *
     * seznam kategorií obchodního případu.
     *
     */
    public function testBusinessCaseCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseCategoryInsert
     *
     * založení nové kategorie obchodního případu.
     *
     */
    public function testBusinessCaseCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification1Delete
     *
     * smazání klasifikace 1 obchodního případu.
     *
     */
    public function testBusinessCaseClassification1Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification1Edit
     *
     * upravení klasifikace 1 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification1Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification1Get
     *
     * seznam klasifikací 1 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification1Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification1Insert
     *
     * založení nové klasifikace 1 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification1Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification2Delete
     *
     * smazání klasifikace 2 obchodního případu.
     *
     */
    public function testBusinessCaseClassification2Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification2Edit
     *
     * upravení klasifikace 2 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification2Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification2Get
     *
     * seznam klasifikací 2 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification2Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification2Insert
     *
     * založení nové klasifikace 2 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification2Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification3Delete
     *
     * smazání klasifikace 3 obchodního případu.
     *
     */
    public function testBusinessCaseClassification3Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification3Edit
     *
     * upravení klasifikace 3 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification3Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification3Get
     *
     * seznam klasifikací 3 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification3Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseClassification3Insert
     *
     * založení nové klasifikace 3 pro obchodní případ.
     *
     */
    public function testBusinessCaseClassification3Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCasePhaseDelete
     *
     * smazání stavu obchodního případu.
     *
     */
    public function testBusinessCasePhaseDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCasePhaseGet
     *
     * seznam stavů obchodního případu.
     *
     */
    public function testBusinessCasePhaseGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCasePhaseInsert
     *
     * založení nového stavu obchodního případu.
     *
     */
    public function testBusinessCasePhaseInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseRelationshipCategoryDelete
     *
     * smazání kategorie participace obchodního případu.
     *
     */
    public function testBusinessCaseRelationshipCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseRelationshipCategoryEdit
     *
     * upravení kategorie participace obchodního případu.
     *
     */
    public function testBusinessCaseRelationshipCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseRelationshipCategoryGet
     *
     * seznam kategorií participace obchodního případu.
     *
     */
    public function testBusinessCaseRelationshipCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseRelationshipCategoryInsert
     *
     * založení nové kategorie participace obchodního případu.
     *
     */
    public function testBusinessCaseRelationshipCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for businessCaseTypeGet
     *
     * seznam typů obchodního případu.
     *
     */
    public function testBusinessCaseTypeGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyCategoryDelete
     *
     * smazání kategorie klienta.
     *
     */
    public function testCompanyCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyCategoryEdit
     *
     * upravení kategorie klienta.
     *
     */
    public function testCompanyCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyCategoryGet
     *
     * seznam kategorií klienta.
     *
     */
    public function testCompanyCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyCategoryInsert
     *
     * založení nové kategorie klienta.
     *
     */
    public function testCompanyCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification1Delete
     *
     * smazání klasifikace 1 klienta.
     *
     */
    public function testCompanyClassification1Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification1Edit
     *
     * upravení klasifikace 1 pro klienta.
     *
     */
    public function testCompanyClassification1Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification1Get
     *
     * seznam klasifikací 1 pro klienta.
     *
     */
    public function testCompanyClassification1Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification1Insert
     *
     * založení nové klasifikace 1 pro klienta.
     *
     */
    public function testCompanyClassification1Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification2Delete
     *
     * smazání klasifikace 2 klienta.
     *
     */
    public function testCompanyClassification2Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification2Edit
     *
     * upravení klasifikace 2 pro klienta.
     *
     */
    public function testCompanyClassification2Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification2Get
     *
     * seznam klasifikací 2 pro klienta.
     *
     */
    public function testCompanyClassification2Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification2Insert
     *
     * založení nové klasifikace 2 pro klienta.
     *
     */
    public function testCompanyClassification2Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification3Delete
     *
     * smazání klasifikace 3 klienta.
     *
     */
    public function testCompanyClassification3Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification3Edit
     *
     * upravení klasifikace 3 pro klienta.
     *
     */
    public function testCompanyClassification3Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification3Get
     *
     * seznam klasifikací 3 pro klienta.
     *
     */
    public function testCompanyClassification3Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyClassification3Insert
     *
     * založení nové klasifikace 3 pro klienta.
     *
     */
    public function testCompanyClassification3Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyTurnoverDelete
     *
     * smazání obratu.
     *
     */
    public function testCompanyTurnoverDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyTurnoverEdit
     *
     * upravení obratu.
     *
     */
    public function testCompanyTurnoverEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyTurnoverGet
     *
     * seznam obratů.
     *
     */
    public function testCompanyTurnoverGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for companyTurnoverInsert
     *
     * přidání nového obratu.
     *
     */
    public function testCompanyTurnoverInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for contactSourceDelete
     *
     * smazání zdroje kontaktu.
     *
     */
    public function testContactSourceDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for contactSourceEdit
     *
     * upravení zdroje kontaktu.
     *
     */
    public function testContactSourceEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for contactSourceGet
     *
     * seznam zdrojů kontaktu.
     *
     */
    public function testContactSourceGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for contactSourceInsert
     *
     * založení nového zdroje kontaktu.
     *
     */
    public function testContactSourceInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for currencyDelete
     *
     * smazání měny.
     *
     */
    public function testCurrencyDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for currencyEdit
     *
     * upravení měny.
     *
     */
    public function testCurrencyEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for currencyGet
     *
     * seznam měn.
     *
     */
    public function testCurrencyGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for currencyInsert
     *
     * založení nové měny.
     *
     */
    public function testCurrencyInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for economyActivityDelete
     *
     * smazání oboru činnosti.
     *
     */
    public function testEconomyActivityDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for economyActivityEdit
     *
     * upravení oboru činnosti.
     *
     */
    public function testEconomyActivityEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for economyActivityGet
     *
     * seznam oborů činnosti.
     *
     */
    public function testEconomyActivityGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for economyActivityInsert
     *
     * založení nového oboru činnosti.
     *
     */
    public function testEconomyActivityInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for employeesNumberDelete
     *
     * smazání počtu zaměstnanců.
     *
     */
    public function testEmployeesNumberDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for employeesNumberEdit
     *
     * upravení počtu zaměstnanců.
     *
     */
    public function testEmployeesNumberEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for employeesNumberGet
     *
     * seznam počtu zaměstnanců.
     *
     */
    public function testEmployeesNumberGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for employeesNumberInsert
     *
     * přidání počtu zaměstnanců.
     *
     */
    public function testEmployeesNumberInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for gdprFormAgreementDelete
     *
     * smazání formy souhlasu.
     *
     */
    public function testGdprFormAgreementDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for gdprFormAgreementEdit
     *
     * upravení formy souhlasu.
     *
     */
    public function testGdprFormAgreementEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for gdprFormAgreementGet
     *
     * seznam forem souhlasu.
     *
     */
    public function testGdprFormAgreementGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for gdprFormAgreementInsert
     *
     * založení nové formy souhlasu.
     *
     */
    public function testGdprFormAgreementInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for languageDelete
     *
     * smazání jazyku.
     *
     */
    public function testLanguageDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for languageEdit
     *
     * upravení jazyku.
     *
     */
    public function testLanguageEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for languageGet
     *
     * seznam jazyků.
     *
     */
    public function testLanguageGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for languageInsert
     *
     * založení nového jazyku.
     *
     */
    public function testLanguageInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadCategoryDelete
     *
     * smazání kategorie leadu.
     *
     */
    public function testLeadCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadCategoryEdit
     *
     * upravení kategorie leadu.
     *
     */
    public function testLeadCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadCategoryGet
     *
     * seznam kategorií leadu.
     *
     */
    public function testLeadCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadCategoryInsert
     *
     * založení nové kategorie leadu.
     *
     */
    public function testLeadCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadPhaseDelete
     *
     * smazání stavu leadu.
     *
     */
    public function testLeadPhaseDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadPhaseGet
     *
     * seznam stavů leadu.
     *
     */
    public function testLeadPhaseGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for leadPhaseInsert
     *
     * založení nového stavu leadu.
     *
     */
    public function testLeadPhaseInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for legalFormDelete
     *
     * smazání právní formy.
     *
     */
    public function testLegalFormDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for legalFormEdit
     *
     * upravení právní formy.
     *
     */
    public function testLegalFormEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for legalFormGet
     *
     * seznam právních forem.
     *
     */
    public function testLegalFormGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for legalFormInsert
     *
     * založení nové právní formy.
     *
     */
    public function testLegalFormInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for losingCategoryDelete
     *
     * smazání kategorie prohry.
     *
     */
    public function testLosingCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for losingCategoryEdit
     *
     * upravení kategorie prohry.
     *
     */
    public function testLosingCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for losingCategoryGet
     *
     * seznam kategorií prohry.
     *
     */
    public function testLosingCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for losingCategoryInsert
     *
     * založení nové kategorie prohry.
     *
     */
    public function testLosingCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for maritalStatusDelete
     *
     * smazání rodinného stavu.
     *
     */
    public function testMaritalStatusDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for maritalStatusEdit
     *
     * upravení rodinného stavu.
     *
     */
    public function testMaritalStatusEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for maritalStatusGet
     *
     * seznam rodinných stavů.
     *
     */
    public function testMaritalStatusGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for maritalStatusInsert
     *
     * přidání rodinného stavu.
     *
     */
    public function testMaritalStatusInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerCategoryDelete
     *
     * smazání kategorie nabídky.
     *
     */
    public function testOfferCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerCategoryEdit
     *
     * upravení kategorie nabídky.
     *
     */
    public function testOfferCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerCategoryGet
     *
     * seznam kategorií nabídky.
     *
     */
    public function testOfferCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerCategoryInsert
     *
     * založení nové kategorie nabídky.
     *
     */
    public function testOfferCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerStatusDelete
     *
     * smazání stavu nabídky.
     *
     */
    public function testOfferStatusDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerStatusGet
     *
     * seznam stavů nabídky.
     *
     */
    public function testOfferStatusGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for offerStatusInsert
     *
     * založení nového stavu nabídky.
     *
     */
    public function testOfferStatusInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for paymentTermDelete
     *
     * smazání platební podmínky.
     *
     */
    public function testPaymentTermDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for paymentTermEdit
     *
     * upravení platební podmínky.
     *
     */
    public function testPaymentTermEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for paymentTermGet
     *
     * seznam platebních podmínek.
     *
     */
    public function testPaymentTermGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for paymentTermInsert
     *
     * přidání platební podmínky.
     *
     */
    public function testPaymentTermInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personCategoryDelete
     *
     * smazání kategorie kontaktní osoby.
     *
     */
    public function testPersonCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personCategoryEdit
     *
     * upravení kategorie kontaktní osoby.
     *
     */
    public function testPersonCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personCategoryGet
     *
     * seznam kategorií kontaktní osoby.
     *
     */
    public function testPersonCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personCategoryInsert
     *
     * založení nové kategorie kontaktní osoby.
     *
     */
    public function testPersonCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification1Delete
     *
     * smazání klasifikace 1 kontaktní osoby.
     *
     */
    public function testPersonClassification1Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification1Edit
     *
     * upravení klasifikace 1 pro kontaktní osobu.
     *
     */
    public function testPersonClassification1Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification1Get
     *
     * seznam klasifikací 1 kontaktní osoby.
     *
     */
    public function testPersonClassification1Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification1Insert
     *
     * založení nové klasifikace 1 pro kontaktní osobu.
     *
     */
    public function testPersonClassification1Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification2Delete
     *
     * smazání klasifikace 2 kontaktní osoby.
     *
     */
    public function testPersonClassification2Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification2Edit
     *
     * upravení klasifikace 2 pro kontaktní osobu.
     *
     */
    public function testPersonClassification2Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification2Get
     *
     * seznam klasifikací 2 kontaktní osoby.
     *
     */
    public function testPersonClassification2Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification2Insert
     *
     * založení nové klasifikace 2 pro kontaktní osobu.
     *
     */
    public function testPersonClassification2Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification3Delete
     *
     * smazání klasifikace 3 kontaktní osoby.
     *
     */
    public function testPersonClassification3Delete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification3Edit
     *
     * upravení klasifikace 3 pro kontaktní osobu.
     *
     */
    public function testPersonClassification3Edit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification3Get
     *
     * seznam klasifikací 3 kontaktní osoby.
     *
     */
    public function testPersonClassification3Get()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for personClassification3Insert
     *
     * založení nové klasifikace 3 pro kontaktní osobu.
     *
     */
    public function testPersonClassification3Insert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for priceListCategoryDelete
     *
     * smazání kategorie ceníku.
     *
     */
    public function testPriceListCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for priceListCategoryEdit
     *
     * upravení kategorie ceníku.
     *
     */
    public function testPriceListCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for priceListCategoryGet
     *
     * seznam kategorií ceníku.
     *
     */
    public function testPriceListCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for priceListCategoryInsert
     *
     * založení nové kategorie ceníku.
     *
     */
    public function testPriceListCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productCategoryDelete
     *
     * smazání kategorie produktů.
     *
     */
    public function testProductCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productCategoryEdit
     *
     * upravení kategorie produktu.
     *
     */
    public function testProductCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productCategoryGet
     *
     * seznam kategorie produktů.
     *
     */
    public function testProductCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productCategoryInsert
     *
     * založení nové kategorie produktu.
     *
     */
    public function testProductCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productLineDelete
     *
     * smazání produktové řady.
     *
     */
    public function testProductLineDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productLineEdit
     *
     * upravení produktové řady.
     *
     */
    public function testProductLineEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productLineGet
     *
     * seznam produktových řad.
     *
     */
    public function testProductLineGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for productLineInsert
     *
     * založení nové produktové řady.
     *
     */
    public function testProductLineInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectCategoryDelete
     *
     * smazání kategorie projektu.
     *
     */
    public function testProjectCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectCategoryEdit
     *
     * upravení kategorie projektu.
     *
     */
    public function testProjectCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectCategoryGet
     *
     * seznam kategorií projektu.
     *
     */
    public function testProjectCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectCategoryInsert
     *
     * založení nové kategorie projektu.
     *
     */
    public function testProjectCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectRelationshipCategoryDelete
     *
     * smazání kategorie participace projektu.
     *
     */
    public function testProjectRelationshipCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectRelationshipCategoryEdit
     *
     * upravení kategorie participace projektu.
     *
     */
    public function testProjectRelationshipCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectRelationshipCategoryGet
     *
     * seznam kategorií participace projektu.
     *
     */
    public function testProjectRelationshipCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectRelationshipCategoryInsert
     *
     * založení nové kategorie participace projektu.
     *
     */
    public function testProjectRelationshipCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectStatusDelete
     *
     * smazání stavu projektu.
     *
     */
    public function testProjectStatusDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectStatusGet
     *
     * seznam stavů projektu.
     *
     */
    public function testProjectStatusGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for projectStatusInsert
     *
     * založení nového stavu projektu.
     *
     */
    public function testProjectStatusInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderCategoryDelete
     *
     * smazání kategorie objednávky.
     *
     */
    public function testSalesOrderCategoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderCategoryEdit
     *
     * upravení kategorie objednávky.
     *
     */
    public function testSalesOrderCategoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderCategoryGet
     *
     * seznam kategorií objednávky.
     *
     */
    public function testSalesOrderCategoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderCategoryInsert
     *
     * založení nové kategorie objednávky.
     *
     */
    public function testSalesOrderCategoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderStatusDelete
     *
     * smazání stavu objednávky.
     *
     */
    public function testSalesOrderStatusDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderStatusGet
     *
     * seznam stavů objednávky.
     *
     */
    public function testSalesOrderStatusGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for salesOrderStatusInsert
     *
     * založení nového stavu objednávky.
     *
     */
    public function testSalesOrderStatusInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for taxRateDelete
     *
     * smazání sazby DPH.
     *
     */
    public function testTaxRateDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for taxRateGet
     *
     * seznam sazeb DPH.
     *
     */
    public function testTaxRateGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for taxRateInsert
     *
     * založení nové sazby DPH.
     *
     */
    public function testTaxRateInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for telTypeDelete
     *
     * smazání typu telefonu.
     *
     */
    public function testTelTypeDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for telTypeEdit
     *
     * upravení typu telefonu.
     *
     */
    public function testTelTypeEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for telTypeGet
     *
     * seznam typů telefonu.
     *
     */
    public function testTelTypeGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for telTypeInsert
     *
     * založení nového typu telefonu.
     *
     */
    public function testTelTypeInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for territoryDelete
     *
     * smazání obchodního teritoria.
     *
     */
    public function testTerritoryDelete()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for territoryEdit
     *
     * upravení obchodního teritoria.
     *
     */
    public function testTerritoryEdit()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for territoryGet
     *
     * seznam obchodních teritorií.
     *
     */
    public function testTerritoryGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for territoryInsert
     *
     * založení nového obchodního teritoria.
     *
     */
    public function testTerritoryInsert()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }
}
