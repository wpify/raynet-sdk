<?php
/**
 * CompanyInsertDto
 *
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
 * Do not edit the class manually.
 */

namespace RaynetApiClient\Model;

use \ArrayAccess;
use \RaynetApiClient\ObjectSerializer;

/**
 * CompanyInsertDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CompanyInsertDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CompanyInsertDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'person' => 'bool',
        'last_name' => 'string',
        'first_name' => 'string',
        'title_before' => 'string',
        'title_after' => 'string',
        'salutation' => 'string',
        'security_level' => 'int',
        'owner' => 'int',
        'rating' => 'string',
        'state' => 'string',
        'role' => 'string',
        'notice' => 'string',
        'category' => 'int',
        'contact_source' => 'int',
        'employees_number' => 'int',
        'legal_form' => 'int',
        'payment_term' => 'int',
        'turnover' => 'int',
        'economy_activity' => 'int',
        'company_classification1' => 'int',
        'company_classification2' => 'int',
        'company_classification3' => 'int',
        'reg_number' => 'string',
        'tax_number' => 'string',
        'tax_number2' => 'string',
        'tax_payer' => 'string',
        'bank_account' => 'string',
        'databox' => 'string',
        'court' => 'string',
        'birthday' => '\DateTime',
        'addresses' => '\RaynetApiClient\Model\CompanyInsertDtoAddressesInner[]',
        'social_network_contact' => '\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact',
        'origin_lead' => 'int',
        'tags' => 'string[]',
        'custom_fields' => '\RaynetApiClient\Model\CompanyInsertDtoCustomFields'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'person' => null,
        'last_name' => null,
        'first_name' => null,
        'title_before' => null,
        'title_after' => null,
        'salutation' => null,
        'security_level' => 'int64',
        'owner' => 'int64',
        'rating' => null,
        'state' => null,
        'role' => null,
        'notice' => null,
        'category' => 'int64',
        'contact_source' => 'int64',
        'employees_number' => 'int64',
        'legal_form' => 'int64',
        'payment_term' => 'int64',
        'turnover' => 'int64',
        'economy_activity' => 'int64',
        'company_classification1' => 'int64',
        'company_classification2' => 'int64',
        'company_classification3' => 'int64',
        'reg_number' => null,
        'tax_number' => null,
        'tax_number2' => null,
        'tax_payer' => null,
        'bank_account' => null,
        'databox' => null,
        'court' => null,
        'birthday' => 'date',
        'addresses' => null,
        'social_network_contact' => null,
        'origin_lead' => 'int64',
        'tags' => null,
        'custom_fields' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
		'person' => false,
		'last_name' => false,
		'first_name' => false,
		'title_before' => false,
		'title_after' => false,
		'salutation' => false,
		'security_level' => false,
		'owner' => false,
		'rating' => false,
		'state' => false,
		'role' => false,
		'notice' => false,
		'category' => false,
		'contact_source' => false,
		'employees_number' => false,
		'legal_form' => false,
		'payment_term' => false,
		'turnover' => false,
		'economy_activity' => false,
		'company_classification1' => false,
		'company_classification2' => false,
		'company_classification3' => false,
		'reg_number' => false,
		'tax_number' => false,
		'tax_number2' => false,
		'tax_payer' => false,
		'bank_account' => false,
		'databox' => false,
		'court' => false,
		'birthday' => false,
		'addresses' => false,
		'social_network_contact' => false,
		'origin_lead' => false,
		'tags' => false,
		'custom_fields' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'name' => 'name',
        'person' => 'person',
        'last_name' => 'lastName',
        'first_name' => 'firstName',
        'title_before' => 'titleBefore',
        'title_after' => 'titleAfter',
        'salutation' => 'salutation',
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'rating' => 'rating',
        'state' => 'state',
        'role' => 'role',
        'notice' => 'notice',
        'category' => 'category',
        'contact_source' => 'contactSource',
        'employees_number' => 'employeesNumber',
        'legal_form' => 'legalForm',
        'payment_term' => 'paymentTerm',
        'turnover' => 'turnover',
        'economy_activity' => 'economyActivity',
        'company_classification1' => 'companyClassification1',
        'company_classification2' => 'companyClassification2',
        'company_classification3' => 'companyClassification3',
        'reg_number' => 'regNumber',
        'tax_number' => 'taxNumber',
        'tax_number2' => 'taxNumber2',
        'tax_payer' => 'taxPayer',
        'bank_account' => 'bankAccount',
        'databox' => 'databox',
        'court' => 'court',
        'birthday' => 'birthday',
        'addresses' => 'addresses',
        'social_network_contact' => 'socialNetworkContact',
        'origin_lead' => 'originLead',
        'tags' => 'tags',
        'custom_fields' => 'customFields'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'person' => 'setPerson',
        'last_name' => 'setLastName',
        'first_name' => 'setFirstName',
        'title_before' => 'setTitleBefore',
        'title_after' => 'setTitleAfter',
        'salutation' => 'setSalutation',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'rating' => 'setRating',
        'state' => 'setState',
        'role' => 'setRole',
        'notice' => 'setNotice',
        'category' => 'setCategory',
        'contact_source' => 'setContactSource',
        'employees_number' => 'setEmployeesNumber',
        'legal_form' => 'setLegalForm',
        'payment_term' => 'setPaymentTerm',
        'turnover' => 'setTurnover',
        'economy_activity' => 'setEconomyActivity',
        'company_classification1' => 'setCompanyClassification1',
        'company_classification2' => 'setCompanyClassification2',
        'company_classification3' => 'setCompanyClassification3',
        'reg_number' => 'setRegNumber',
        'tax_number' => 'setTaxNumber',
        'tax_number2' => 'setTaxNumber2',
        'tax_payer' => 'setTaxPayer',
        'bank_account' => 'setBankAccount',
        'databox' => 'setDatabox',
        'court' => 'setCourt',
        'birthday' => 'setBirthday',
        'addresses' => 'setAddresses',
        'social_network_contact' => 'setSocialNetworkContact',
        'origin_lead' => 'setOriginLead',
        'tags' => 'setTags',
        'custom_fields' => 'setCustomFields'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'person' => 'getPerson',
        'last_name' => 'getLastName',
        'first_name' => 'getFirstName',
        'title_before' => 'getTitleBefore',
        'title_after' => 'getTitleAfter',
        'salutation' => 'getSalutation',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'rating' => 'getRating',
        'state' => 'getState',
        'role' => 'getRole',
        'notice' => 'getNotice',
        'category' => 'getCategory',
        'contact_source' => 'getContactSource',
        'employees_number' => 'getEmployeesNumber',
        'legal_form' => 'getLegalForm',
        'payment_term' => 'getPaymentTerm',
        'turnover' => 'getTurnover',
        'economy_activity' => 'getEconomyActivity',
        'company_classification1' => 'getCompanyClassification1',
        'company_classification2' => 'getCompanyClassification2',
        'company_classification3' => 'getCompanyClassification3',
        'reg_number' => 'getRegNumber',
        'tax_number' => 'getTaxNumber',
        'tax_number2' => 'getTaxNumber2',
        'tax_payer' => 'getTaxPayer',
        'bank_account' => 'getBankAccount',
        'databox' => 'getDatabox',
        'court' => 'getCourt',
        'birthday' => 'getBirthday',
        'addresses' => 'getAddresses',
        'social_network_contact' => 'getSocialNetworkContact',
        'origin_lead' => 'getOriginLead',
        'tags' => 'getTags',
        'custom_fields' => 'getCustomFields'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const RATING_A = 'A';
    public const RATING_B = 'B';
    public const RATING_C = 'C';
    public const STATE_A_POTENTIAL = 'A_POTENTIAL';
    public const STATE_B_ACTUAL = 'B_ACTUAL';
    public const STATE_C_DEFERRED = 'C_DEFERRED';
    public const STATE_D_UNATTRACTIVE = 'D_UNATTRACTIVE';
    public const ROLE_A_SUBSCRIBER = 'A_SUBSCRIBER';
    public const ROLE_B_PARTNER = 'B_PARTNER';
    public const ROLE_C_SUPPLIER = 'C_SUPPLIER';
    public const ROLE_D_RIVAL = 'D_RIVAL';
    public const TAX_PAYER_YES = 'YES';
    public const TAX_PAYER_NO = 'NO';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRatingAllowableValues()
    {
        return [
            self::RATING_A,
            self::RATING_B,
            self::RATING_C,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStateAllowableValues()
    {
        return [
            self::STATE_A_POTENTIAL,
            self::STATE_B_ACTUAL,
            self::STATE_C_DEFERRED,
            self::STATE_D_UNATTRACTIVE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRoleAllowableValues()
    {
        return [
            self::ROLE_A_SUBSCRIBER,
            self::ROLE_B_PARTNER,
            self::ROLE_C_SUPPLIER,
            self::ROLE_D_RIVAL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTaxPayerAllowableValues()
    {
        return [
            self::TAX_PAYER_YES,
            self::TAX_PAYER_NO,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('person', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('title_before', $data ?? [], null);
        $this->setIfExists('title_after', $data ?? [], null);
        $this->setIfExists('salutation', $data ?? [], null);
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('rating', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], null);
        $this->setIfExists('role', $data ?? [], null);
        $this->setIfExists('notice', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('contact_source', $data ?? [], null);
        $this->setIfExists('employees_number', $data ?? [], null);
        $this->setIfExists('legal_form', $data ?? [], null);
        $this->setIfExists('payment_term', $data ?? [], null);
        $this->setIfExists('turnover', $data ?? [], null);
        $this->setIfExists('economy_activity', $data ?? [], null);
        $this->setIfExists('company_classification1', $data ?? [], null);
        $this->setIfExists('company_classification2', $data ?? [], null);
        $this->setIfExists('company_classification3', $data ?? [], null);
        $this->setIfExists('reg_number', $data ?? [], null);
        $this->setIfExists('tax_number', $data ?? [], null);
        $this->setIfExists('tax_number2', $data ?? [], null);
        $this->setIfExists('tax_payer', $data ?? [], null);
        $this->setIfExists('bank_account', $data ?? [], null);
        $this->setIfExists('databox', $data ?? [], null);
        $this->setIfExists('court', $data ?? [], null);
        $this->setIfExists('birthday', $data ?? [], null);
        $this->setIfExists('addresses', $data ?? [], null);
        $this->setIfExists('social_network_contact', $data ?? [], null);
        $this->setIfExists('origin_lead', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('custom_fields', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['rating'] === null) {
            $invalidProperties[] = "'rating' can't be null";
        }
        $allowedValues = $this->getRatingAllowableValues();
        if (!is_null($this->container['rating']) && !in_array($this->container['rating'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'rating', must be one of '%s'",
                $this->container['rating'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['state'] === null) {
            $invalidProperties[] = "'state' can't be null";
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($this->container['state']) && !in_array($this->container['state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'state', must be one of '%s'",
                $this->container['state'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['role'] === null) {
            $invalidProperties[] = "'role' can't be null";
        }
        $allowedValues = $this->getRoleAllowableValues();
        if (!is_null($this->container['role']) && !in_array($this->container['role'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'role', must be one of '%s'",
                $this->container['role'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTaxPayerAllowableValues();
        if (!is_null($this->container['tax_payer']) && !in_array($this->container['tax_payer'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tax_payer', must be one of '%s'",
                $this->container['tax_payer'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['addresses']) && (count($this->container['addresses']) < 0)) {
            $invalidProperties[] = "invalid value for 'addresses', number of items must be greater than or equal to 0.";
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name [Název]
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets person
     *
     * @return bool|null
     */
    public function getPerson()
    {
        return $this->container['person'];
    }

    /**
     * Sets person
     *
     * @param bool|null $person [Jedná se o fyzickou osobu]
     *
     * @return self
     */
    public function setPerson($person)
    {
        if (is_null($person)) {
            throw new \InvalidArgumentException('non-nullable person cannot be null');
        }
        $this->container['person'] = $person;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string|null $last_name [Příjmení fyzické osoby] - povinný v případě, že je aktivní příznak 'Jedná se o fyzickou osobu'
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        if (is_null($last_name)) {
            throw new \InvalidArgumentException('non-nullable last_name cannot be null');
        }
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string|null $first_name [Jméno fyzické osoby]
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        if (is_null($first_name)) {
            throw new \InvalidArgumentException('non-nullable first_name cannot be null');
        }
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets title_before
     *
     * @return string|null
     */
    public function getTitleBefore()
    {
        return $this->container['title_before'];
    }

    /**
     * Sets title_before
     *
     * @param string|null $title_before [Titul před jménem fyzické osoby]
     *
     * @return self
     */
    public function setTitleBefore($title_before)
    {
        if (is_null($title_before)) {
            throw new \InvalidArgumentException('non-nullable title_before cannot be null');
        }
        $this->container['title_before'] = $title_before;

        return $this;
    }

    /**
     * Gets title_after
     *
     * @return string|null
     */
    public function getTitleAfter()
    {
        return $this->container['title_after'];
    }

    /**
     * Sets title_after
     *
     * @param string|null $title_after [Titul za jménem fyzické osoby]
     *
     * @return self
     */
    public function setTitleAfter($title_after)
    {
        if (is_null($title_after)) {
            throw new \InvalidArgumentException('non-nullable title_after cannot be null');
        }
        $this->container['title_after'] = $title_after;

        return $this;
    }

    /**
     * Gets salutation
     *
     * @return string|null
     */
    public function getSalutation()
    {
        return $this->container['salutation'];
    }

    /**
     * Sets salutation
     *
     * @param string|null $salutation [Oslovení]
     *
     * @return self
     */
    public function setSalutation($salutation)
    {
        if (is_null($salutation)) {
            throw new \InvalidArgumentException('non-nullable salutation cannot be null');
        }
        $this->container['salutation'] = $salutation;

        return $this;
    }

    /**
     * Gets security_level
     *
     * @return int|null
     */
    public function getSecurityLevel()
    {
        return $this->container['security_level'];
    }

    /**
     * Sets security_level
     *
     * @param int|null $security_level [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina.
     *
     * @return self
     */
    public function setSecurityLevel($security_level)
    {
        if (is_null($security_level)) {
            throw new \InvalidArgumentException('non-nullable security_level cannot be null');
        }
        $this->container['security_level'] = $security_level;

        return $this;
    }

    /**
     * Gets owner
     *
     * @return int|null
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     *
     * @param int|null $owner [Vlastník] ID kontaktní osoby, která je zároveň uživatelem
     *
     * @return self
     */
    public function setOwner($owner)
    {
        if (is_null($owner)) {
            throw new \InvalidArgumentException('non-nullable owner cannot be null');
        }
        $this->container['owner'] = $owner;

        return $this;
    }

    /**
     * Gets rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->container['rating'];
    }

    /**
     * Sets rating
     *
     * @param string $rating [Rating]
     *
     * @return self
     */
    public function setRating($rating)
    {
        if (is_null($rating)) {
            throw new \InvalidArgumentException('non-nullable rating cannot be null');
        }
        $allowedValues = $this->getRatingAllowableValues();
        if (!in_array($rating, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'rating', must be one of '%s'",
                    $rating,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['rating'] = $rating;

        return $this;
    }

    /**
     * Gets state
     *
     * @return string
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string $state [Stav]
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            throw new \InvalidArgumentException('non-nullable state cannot be null');
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!in_array($state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'state', must be one of '%s'",
                    $state,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->container['role'];
    }

    /**
     * Sets role
     *
     * @param string $role [Vztah]
     *
     * @return self
     */
    public function setRole($role)
    {
        if (is_null($role)) {
            throw new \InvalidArgumentException('non-nullable role cannot be null');
        }
        $allowedValues = $this->getRoleAllowableValues();
        if (!in_array($role, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'role', must be one of '%s'",
                    $role,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['role'] = $role;

        return $this;
    }

    /**
     * Gets notice
     *
     * @return string|null
     */
    public function getNotice()
    {
        return $this->container['notice'];
    }

    /**
     * Sets notice
     *
     * @param string|null $notice [Poznámka ke klientovi]
     *
     * @return self
     */
    public function setNotice($notice)
    {
        if (is_null($notice)) {
            throw new \InvalidArgumentException('non-nullable notice cannot be null');
        }
        $this->container['notice'] = $notice;

        return $this;
    }

    /**
     * Gets category
     *
     * @return int|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param int|null $category [Kategorie] ID záznamu z číselníku CompanyCategory
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets contact_source
     *
     * @return int|null
     */
    public function getContactSource()
    {
        return $this->container['contact_source'];
    }

    /**
     * Sets contact_source
     *
     * @param int|null $contact_source [Zdroj kontaktu] ID záznamu z číselníku ContactSource
     *
     * @return self
     */
    public function setContactSource($contact_source)
    {
        if (is_null($contact_source)) {
            throw new \InvalidArgumentException('non-nullable contact_source cannot be null');
        }
        $this->container['contact_source'] = $contact_source;

        return $this;
    }

    /**
     * Gets employees_number
     *
     * @return int|null
     */
    public function getEmployeesNumber()
    {
        return $this->container['employees_number'];
    }

    /**
     * Sets employees_number
     *
     * @param int|null $employees_number [Zaměstnanců] ID záznamu z číselníku EmployeesNumber
     *
     * @return self
     */
    public function setEmployeesNumber($employees_number)
    {
        if (is_null($employees_number)) {
            throw new \InvalidArgumentException('non-nullable employees_number cannot be null');
        }
        $this->container['employees_number'] = $employees_number;

        return $this;
    }

    /**
     * Gets legal_form
     *
     * @return int|null
     */
    public function getLegalForm()
    {
        return $this->container['legal_form'];
    }

    /**
     * Sets legal_form
     *
     * @param int|null $legal_form [Právní forma] ID záznamu z číselníku LegalForm
     *
     * @return self
     */
    public function setLegalForm($legal_form)
    {
        if (is_null($legal_form)) {
            throw new \InvalidArgumentException('non-nullable legal_form cannot be null');
        }
        $this->container['legal_form'] = $legal_form;

        return $this;
    }

    /**
     * Gets payment_term
     *
     * @return int|null
     */
    public function getPaymentTerm()
    {
        return $this->container['payment_term'];
    }

    /**
     * Sets payment_term
     *
     * @param int|null $payment_term [Platbní podmínky] ID záznamu z číselníku PaymentTerm
     *
     * @return self
     */
    public function setPaymentTerm($payment_term)
    {
        if (is_null($payment_term)) {
            throw new \InvalidArgumentException('non-nullable payment_term cannot be null');
        }
        $this->container['payment_term'] = $payment_term;

        return $this;
    }

    /**
     * Gets turnover
     *
     * @return int|null
     */
    public function getTurnover()
    {
        return $this->container['turnover'];
    }

    /**
     * Sets turnover
     *
     * @param int|null $turnover [Obrat] ID záznamu z číselníku CompanyTurnover
     *
     * @return self
     */
    public function setTurnover($turnover)
    {
        if (is_null($turnover)) {
            throw new \InvalidArgumentException('non-nullable turnover cannot be null');
        }
        $this->container['turnover'] = $turnover;

        return $this;
    }

    /**
     * Gets economy_activity
     *
     * @return int|null
     */
    public function getEconomyActivity()
    {
        return $this->container['economy_activity'];
    }

    /**
     * Sets economy_activity
     *
     * @param int|null $economy_activity [Obor] ID záznamu z číselníku EconomyActivity
     *
     * @return self
     */
    public function setEconomyActivity($economy_activity)
    {
        if (is_null($economy_activity)) {
            throw new \InvalidArgumentException('non-nullable economy_activity cannot be null');
        }
        $this->container['economy_activity'] = $economy_activity;

        return $this;
    }

    /**
     * Gets company_classification1
     *
     * @return int|null
     */
    public function getCompanyClassification1()
    {
        return $this->container['company_classification1'];
    }

    /**
     * Sets company_classification1
     *
     * @param int|null $company_classification1 [Klasifikace 1]ID záznamu z číselníku CompanyClassification1
     *
     * @return self
     */
    public function setCompanyClassification1($company_classification1)
    {
        if (is_null($company_classification1)) {
            throw new \InvalidArgumentException('non-nullable company_classification1 cannot be null');
        }
        $this->container['company_classification1'] = $company_classification1;

        return $this;
    }

    /**
     * Gets company_classification2
     *
     * @return int|null
     */
    public function getCompanyClassification2()
    {
        return $this->container['company_classification2'];
    }

    /**
     * Sets company_classification2
     *
     * @param int|null $company_classification2 [Klasifikace 2] ID záznamu z číselníku CompanyClassification2
     *
     * @return self
     */
    public function setCompanyClassification2($company_classification2)
    {
        if (is_null($company_classification2)) {
            throw new \InvalidArgumentException('non-nullable company_classification2 cannot be null');
        }
        $this->container['company_classification2'] = $company_classification2;

        return $this;
    }

    /**
     * Gets company_classification3
     *
     * @return int|null
     */
    public function getCompanyClassification3()
    {
        return $this->container['company_classification3'];
    }

    /**
     * Sets company_classification3
     *
     * @param int|null $company_classification3 [Klasifikace 3] ID záznamu z číselníku CompanyClassification3
     *
     * @return self
     */
    public function setCompanyClassification3($company_classification3)
    {
        if (is_null($company_classification3)) {
            throw new \InvalidArgumentException('non-nullable company_classification3 cannot be null');
        }
        $this->container['company_classification3'] = $company_classification3;

        return $this;
    }

    /**
     * Gets reg_number
     *
     * @return string|null
     */
    public function getRegNumber()
    {
        return $this->container['reg_number'];
    }

    /**
     * Sets reg_number
     *
     * @param string|null $reg_number [IČ]
     *
     * @return self
     */
    public function setRegNumber($reg_number)
    {
        if (is_null($reg_number)) {
            throw new \InvalidArgumentException('non-nullable reg_number cannot be null');
        }
        $this->container['reg_number'] = $reg_number;

        return $this;
    }

    /**
     * Gets tax_number
     *
     * @return string|null
     */
    public function getTaxNumber()
    {
        return $this->container['tax_number'];
    }

    /**
     * Sets tax_number
     *
     * @param string|null $tax_number [DIČ]
     *
     * @return self
     */
    public function setTaxNumber($tax_number)
    {
        if (is_null($tax_number)) {
            throw new \InvalidArgumentException('non-nullable tax_number cannot be null');
        }
        $this->container['tax_number'] = $tax_number;

        return $this;
    }

    /**
     * Gets tax_number2
     *
     * @return string|null
     */
    public function getTaxNumber2()
    {
        return $this->container['tax_number2'];
    }

    /**
     * Sets tax_number2
     *
     * @param string|null $tax_number2 [IČ DPH] Pro slovenské klienty
     *
     * @return self
     */
    public function setTaxNumber2($tax_number2)
    {
        if (is_null($tax_number2)) {
            throw new \InvalidArgumentException('non-nullable tax_number2 cannot be null');
        }
        $this->container['tax_number2'] = $tax_number2;

        return $this;
    }

    /**
     * Gets tax_payer
     *
     * @return string|null
     */
    public function getTaxPayer()
    {
        return $this->container['tax_payer'];
    }

    /**
     * Sets tax_payer
     *
     * @param string|null $tax_payer [Plátce DPH]
     *
     * @return self
     */
    public function setTaxPayer($tax_payer)
    {
        if (is_null($tax_payer)) {
            throw new \InvalidArgumentException('non-nullable tax_payer cannot be null');
        }
        $allowedValues = $this->getTaxPayerAllowableValues();
        if (!in_array($tax_payer, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tax_payer', must be one of '%s'",
                    $tax_payer,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_payer'] = $tax_payer;

        return $this;
    }

    /**
     * Gets bank_account
     *
     * @return string|null
     */
    public function getBankAccount()
    {
        return $this->container['bank_account'];
    }

    /**
     * Sets bank_account
     *
     * @param string|null $bank_account [Bankovní spojení]
     *
     * @return self
     */
    public function setBankAccount($bank_account)
    {
        if (is_null($bank_account)) {
            throw new \InvalidArgumentException('non-nullable bank_account cannot be null');
        }
        $this->container['bank_account'] = $bank_account;

        return $this;
    }

    /**
     * Gets databox
     *
     * @return string|null
     */
    public function getDatabox()
    {
        return $this->container['databox'];
    }

    /**
     * Sets databox
     *
     * @param string|null $databox [Datová schránka]
     *
     * @return self
     */
    public function setDatabox($databox)
    {
        if (is_null($databox)) {
            throw new \InvalidArgumentException('non-nullable databox cannot be null');
        }
        $this->container['databox'] = $databox;

        return $this;
    }

    /**
     * Gets court
     *
     * @return string|null
     */
    public function getCourt()
    {
        return $this->container['court'];
    }

    /**
     * Sets court
     *
     * @param string|null $court [Spisová značka]
     *
     * @return self
     */
    public function setCourt($court)
    {
        if (is_null($court)) {
            throw new \InvalidArgumentException('non-nullable court cannot be null');
        }
        $this->container['court'] = $court;

        return $this;
    }

    /**
     * Gets birthday
     *
     * @return \DateTime|null
     */
    public function getBirthday()
    {
        return $this->container['birthday'];
    }

    /**
     * Sets birthday
     *
     * @param \DateTime|null $birthday [Narozeniny/Výročí]
     *
     * @return self
     */
    public function setBirthday($birthday)
    {
        if (is_null($birthday)) {
            throw new \InvalidArgumentException('non-nullable birthday cannot be null');
        }
        $this->container['birthday'] = $birthday;

        return $this;
    }

    /**
     * Gets addresses
     *
     * @return \RaynetApiClient\Model\CompanyInsertDtoAddressesInner[]|null
     */
    public function getAddresses()
    {
        return $this->container['addresses'];
    }

    /**
     * Sets addresses
     *
     * @param \RaynetApiClient\Model\CompanyInsertDtoAddressesInner[]|null $addresses addresses
     *
     * @return self
     */
    public function setAddresses($addresses)
    {
        if (is_null($addresses)) {
            throw new \InvalidArgumentException('non-nullable addresses cannot be null');
        }


        if ((count($addresses) < 0)) {
            throw new \InvalidArgumentException('invalid length for $addresses when calling CompanyInsertDto., number of items must be greater than or equal to 0.');
        }
        $this->container['addresses'] = $addresses;

        return $this;
    }

    /**
     * Gets social_network_contact
     *
     * @return \RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact|null
     */
    public function getSocialNetworkContact()
    {
        return $this->container['social_network_contact'];
    }

    /**
     * Sets social_network_contact
     *
     * @param \RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact|null $social_network_contact social_network_contact
     *
     * @return self
     */
    public function setSocialNetworkContact($social_network_contact)
    {
        if (is_null($social_network_contact)) {
            throw new \InvalidArgumentException('non-nullable social_network_contact cannot be null');
        }
        $this->container['social_network_contact'] = $social_network_contact;

        return $this;
    }

    /**
     * Gets origin_lead
     *
     * @return int|null
     */
    public function getOriginLead()
    {
        return $this->container['origin_lead'];
    }

    /**
     * Sets origin_lead
     *
     * @param int|null $origin_lead [Lead] ID leadu, ze kterého klient vznikl
     *
     * @return self
     */
    public function setOriginLead($origin_lead)
    {
        if (is_null($origin_lead)) {
            throw new \InvalidArgumentException('non-nullable origin_lead cannot be null');
        }
        $this->container['origin_lead'] = $origin_lead;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string[]|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string[]|null $tags tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        if (is_null($tags)) {
            throw new \InvalidArgumentException('non-nullable tags cannot be null');
        }
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return \RaynetApiClient\Model\CompanyInsertDtoCustomFields|null
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param \RaynetApiClient\Model\CompanyInsertDtoCustomFields|null $custom_fields custom_fields
     *
     * @return self
     */
    public function setCustomFields($custom_fields)
    {
        if (is_null($custom_fields)) {
            throw new \InvalidArgumentException('non-nullable custom_fields cannot be null');
        }
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


