<?php
/**
 * PersonEditDto
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
 * PersonEditDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PersonEditDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PersonEditDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'title_before' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'title_after' => 'string',
        'security_level' => 'int',
        'owner' => 'int',
        'category' => 'int',
        'person_classification1' => 'int',
        'person_classification2' => 'int',
        'person_classification3' => 'int',
        'salutation' => 'string',
        'birthday' => 'string',
        'language' => 'int',
        'marital_status' => 'int',
        'gender' => 'string',
        'contact_info' => '\RaynetApiClient\Model\CompanyInsertDtoAddressesInnerContactInfo',
        'social_network_contact' => '\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact',
        'private_address' => '\RaynetApiClient\Model\PersonInsertDtoPrivateAddress',
        'notice' => 'string',
        'custom_fields' => '\RaynetApiClient\Model\CompanyInsertDtoCustomFields',
        'keyman' => 'bool',
        'origin_lead' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title_before' => null,
        'first_name' => null,
        'last_name' => null,
        'title_after' => null,
        'security_level' => 'int64',
        'owner' => 'int64',
        'category' => 'int64',
        'person_classification1' => 'int64',
        'person_classification2' => 'int64',
        'person_classification3' => 'int64',
        'salutation' => null,
        'birthday' => null,
        'language' => 'int64',
        'marital_status' => 'int64',
        'gender' => null,
        'contact_info' => null,
        'social_network_contact' => null,
        'private_address' => null,
        'notice' => null,
        'custom_fields' => null,
        'keyman' => null,
        'origin_lead' => 'int64'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'title_before' => false,
		'first_name' => false,
		'last_name' => false,
		'title_after' => false,
		'security_level' => false,
		'owner' => false,
		'category' => false,
		'person_classification1' => false,
		'person_classification2' => false,
		'person_classification3' => false,
		'salutation' => false,
		'birthday' => false,
		'language' => false,
		'marital_status' => false,
		'gender' => false,
		'contact_info' => false,
		'social_network_contact' => false,
		'private_address' => false,
		'notice' => false,
		'custom_fields' => false,
		'keyman' => false,
		'origin_lead' => false
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
        'title_before' => 'titleBefore',
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'title_after' => 'titleAfter',
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'category' => 'category',
        'person_classification1' => 'personClassification1',
        'person_classification2' => 'personClassification2',
        'person_classification3' => 'personClassification3',
        'salutation' => 'salutation',
        'birthday' => 'birthday',
        'language' => 'language',
        'marital_status' => 'maritalStatus',
        'gender' => 'gender',
        'contact_info' => 'contactInfo',
        'social_network_contact' => 'socialNetworkContact',
        'private_address' => 'privateAddress',
        'notice' => 'notice',
        'custom_fields' => 'customFields',
        'keyman' => 'keyman',
        'origin_lead' => 'originLead'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title_before' => 'setTitleBefore',
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'title_after' => 'setTitleAfter',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'category' => 'setCategory',
        'person_classification1' => 'setPersonClassification1',
        'person_classification2' => 'setPersonClassification2',
        'person_classification3' => 'setPersonClassification3',
        'salutation' => 'setSalutation',
        'birthday' => 'setBirthday',
        'language' => 'setLanguage',
        'marital_status' => 'setMaritalStatus',
        'gender' => 'setGender',
        'contact_info' => 'setContactInfo',
        'social_network_contact' => 'setSocialNetworkContact',
        'private_address' => 'setPrivateAddress',
        'notice' => 'setNotice',
        'custom_fields' => 'setCustomFields',
        'keyman' => 'setKeyman',
        'origin_lead' => 'setOriginLead'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title_before' => 'getTitleBefore',
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'title_after' => 'getTitleAfter',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'category' => 'getCategory',
        'person_classification1' => 'getPersonClassification1',
        'person_classification2' => 'getPersonClassification2',
        'person_classification3' => 'getPersonClassification3',
        'salutation' => 'getSalutation',
        'birthday' => 'getBirthday',
        'language' => 'getLanguage',
        'marital_status' => 'getMaritalStatus',
        'gender' => 'getGender',
        'contact_info' => 'getContactInfo',
        'social_network_contact' => 'getSocialNetworkContact',
        'private_address' => 'getPrivateAddress',
        'notice' => 'getNotice',
        'custom_fields' => 'getCustomFields',
        'keyman' => 'getKeyman',
        'origin_lead' => 'getOriginLead'
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

    public const GENDER_MALE = 'MALE';
    public const GENDER_FEMALE = 'FEMALE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenderAllowableValues()
    {
        return [
            self::GENDER_MALE,
            self::GENDER_FEMALE,
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
        $this->setIfExists('title_before', $data ?? [], null);
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('title_after', $data ?? [], null);
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('person_classification1', $data ?? [], null);
        $this->setIfExists('person_classification2', $data ?? [], null);
        $this->setIfExists('person_classification3', $data ?? [], null);
        $this->setIfExists('salutation', $data ?? [], null);
        $this->setIfExists('birthday', $data ?? [], null);
        $this->setIfExists('language', $data ?? [], null);
        $this->setIfExists('marital_status', $data ?? [], null);
        $this->setIfExists('gender', $data ?? [], null);
        $this->setIfExists('contact_info', $data ?? [], null);
        $this->setIfExists('social_network_contact', $data ?? [], null);
        $this->setIfExists('private_address', $data ?? [], null);
        $this->setIfExists('notice', $data ?? [], null);
        $this->setIfExists('custom_fields', $data ?? [], null);
        $this->setIfExists('keyman', $data ?? [], null);
        $this->setIfExists('origin_lead', $data ?? [], null);
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

        $allowedValues = $this->getGenderAllowableValues();
        if (!is_null($this->container['gender']) && !in_array($this->container['gender'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'gender', must be one of '%s'",
                $this->container['gender'],
                implode("', '", $allowedValues)
            );
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
     * @param string|null $title_before [Titul před]
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
     * @param string|null $first_name [Jméno]
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
     * @param string|null $last_name [Příjmení]
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
     * @param string|null $title_after [Titul za]
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
     * @param int|null $category [Kategorie] ID záznamu z číselníku PersonCategory
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
     * Gets person_classification1
     *
     * @return int|null
     */
    public function getPersonClassification1()
    {
        return $this->container['person_classification1'];
    }

    /**
     * Sets person_classification1
     *
     * @param int|null $person_classification1 [Klasifikace 1] ID záznamu z číselníku PersonClassification1
     *
     * @return self
     */
    public function setPersonClassification1($person_classification1)
    {
        if (is_null($person_classification1)) {
            throw new \InvalidArgumentException('non-nullable person_classification1 cannot be null');
        }
        $this->container['person_classification1'] = $person_classification1;

        return $this;
    }

    /**
     * Gets person_classification2
     *
     * @return int|null
     */
    public function getPersonClassification2()
    {
        return $this->container['person_classification2'];
    }

    /**
     * Sets person_classification2
     *
     * @param int|null $person_classification2 [Klasifikace 2] ID záznamu z číselníku PersonClassification2
     *
     * @return self
     */
    public function setPersonClassification2($person_classification2)
    {
        if (is_null($person_classification2)) {
            throw new \InvalidArgumentException('non-nullable person_classification2 cannot be null');
        }
        $this->container['person_classification2'] = $person_classification2;

        return $this;
    }

    /**
     * Gets person_classification3
     *
     * @return int|null
     */
    public function getPersonClassification3()
    {
        return $this->container['person_classification3'];
    }

    /**
     * Sets person_classification3
     *
     * @param int|null $person_classification3 [Klasifikace 3] ID záznamu z číselníku PersonClassification3
     *
     * @return self
     */
    public function setPersonClassification3($person_classification3)
    {
        if (is_null($person_classification3)) {
            throw new \InvalidArgumentException('non-nullable person_classification3 cannot be null');
        }
        $this->container['person_classification3'] = $person_classification3;

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
     * Gets birthday
     *
     * @return string|null
     */
    public function getBirthday()
    {
        return $this->container['birthday'];
    }

    /**
     * Sets birthday
     *
     * @param string|null $birthday [Narozeniny]
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
     * Gets language
     *
     * @return int|null
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param int|null $language [Jazyk] ID záznamu z číselníku Language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        if (is_null($language)) {
            throw new \InvalidArgumentException('non-nullable language cannot be null');
        }
        $this->container['language'] = $language;

        return $this;
    }

    /**
     * Gets marital_status
     *
     * @return int|null
     */
    public function getMaritalStatus()
    {
        return $this->container['marital_status'];
    }

    /**
     * Sets marital_status
     *
     * @param int|null $marital_status [Rodinný stav] ID záznamu z číselníku MaritalStatus
     *
     * @return self
     */
    public function setMaritalStatus($marital_status)
    {
        if (is_null($marital_status)) {
            throw new \InvalidArgumentException('non-nullable marital_status cannot be null');
        }
        $this->container['marital_status'] = $marital_status;

        return $this;
    }

    /**
     * Gets gender
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     *
     * @param string|null $gender [Pohlaví]
     *
     * @return self
     */
    public function setGender($gender)
    {
        if (is_null($gender)) {
            throw new \InvalidArgumentException('non-nullable gender cannot be null');
        }
        $allowedValues = $this->getGenderAllowableValues();
        if (!in_array($gender, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'gender', must be one of '%s'",
                    $gender,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets contact_info
     *
     * @return \RaynetApiClient\Model\CompanyInsertDtoAddressesInnerContactInfo|null
     */
    public function getContactInfo()
    {
        return $this->container['contact_info'];
    }

    /**
     * Sets contact_info
     *
     * @param \RaynetApiClient\Model\CompanyInsertDtoAddressesInnerContactInfo|null $contact_info contact_info
     *
     * @return self
     */
    public function setContactInfo($contact_info)
    {
        if (is_null($contact_info)) {
            throw new \InvalidArgumentException('non-nullable contact_info cannot be null');
        }
        $this->container['contact_info'] = $contact_info;

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
     * Gets private_address
     *
     * @return \RaynetApiClient\Model\PersonInsertDtoPrivateAddress|null
     */
    public function getPrivateAddress()
    {
        return $this->container['private_address'];
    }

    /**
     * Sets private_address
     *
     * @param \RaynetApiClient\Model\PersonInsertDtoPrivateAddress|null $private_address private_address
     *
     * @return self
     */
    public function setPrivateAddress($private_address)
    {
        if (is_null($private_address)) {
            throw new \InvalidArgumentException('non-nullable private_address cannot be null');
        }
        $this->container['private_address'] = $private_address;

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
     * @param string|null $notice [Poznámka k osobě]
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
     * Gets keyman
     *
     * @return bool|null
     */
    public function getKeyman()
    {
        return $this->container['keyman'];
    }

    /**
     * Sets keyman
     *
     * @param bool|null $keyman [Klíčová osoba]
     *
     * @return self
     */
    public function setKeyman($keyman)
    {
        if (is_null($keyman)) {
            throw new \InvalidArgumentException('non-nullable keyman cannot be null');
        }
        $this->container['keyman'] = $keyman;

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
     * @param int|null $origin_lead [Lead] ID leadu, ze kterého kontaktní osoba vznikla
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


