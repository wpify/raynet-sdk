<?php
/**
 * LeadInsertDto
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
 * LeadInsertDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class LeadInsertDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'LeadInsertDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'topic' => 'string',
        'priority' => 'string',
        'company_name' => 'string',
        'reg_number' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'title_before' => 'string',
        'title_after' => 'string',
        'security_level' => 'int',
        'owner' => 'int',
        'contact_source' => 'int',
        'category' => 'int',
        'notice' => 'string',
        'lead_phase' => 'int',
        'tags' => 'string',
        'territory' => 'int',
        'lead_person' => 'bool',
        'contact_info' => '\RaynetApiClient\Model\LeadInsertDtoContactInfo',
        'address' => '\RaynetApiClient\Model\LeadInsertDtoAddress',
        'social_network_contact' => '\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact',
        'custom_fields' => '\RaynetApiClient\Model\CompanyInsertDtoCustomFields',
        'notification_message' => 'string',
        'notification_email_addresses' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'topic' => null,
        'priority' => null,
        'company_name' => null,
        'reg_number' => null,
        'first_name' => null,
        'last_name' => null,
        'title_before' => null,
        'title_after' => null,
        'security_level' => 'int64',
        'owner' => 'int64',
        'contact_source' => 'int64',
        'category' => 'int64',
        'notice' => null,
        'lead_phase' => 'int64',
        'tags' => null,
        'territory' => 'int64',
        'lead_person' => null,
        'contact_info' => null,
        'address' => null,
        'social_network_contact' => null,
        'custom_fields' => null,
        'notification_message' => null,
        'notification_email_addresses' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'topic' => false,
		'priority' => false,
		'company_name' => false,
		'reg_number' => false,
		'first_name' => false,
		'last_name' => false,
		'title_before' => false,
		'title_after' => false,
		'security_level' => false,
		'owner' => false,
		'contact_source' => false,
		'category' => false,
		'notice' => false,
		'lead_phase' => false,
		'tags' => false,
		'territory' => false,
		'lead_person' => false,
		'contact_info' => false,
		'address' => false,
		'social_network_contact' => false,
		'custom_fields' => false,
		'notification_message' => false,
		'notification_email_addresses' => false
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
        'topic' => 'topic',
        'priority' => 'priority',
        'company_name' => 'companyName',
        'reg_number' => 'regNumber',
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'title_before' => 'titleBefore',
        'title_after' => 'titleAfter',
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'contact_source' => 'contactSource',
        'category' => 'category',
        'notice' => 'notice',
        'lead_phase' => 'leadPhase',
        'tags' => 'tags',
        'territory' => 'territory',
        'lead_person' => 'leadPerson',
        'contact_info' => 'contactInfo',
        'address' => 'address',
        'social_network_contact' => 'socialNetworkContact',
        'custom_fields' => 'customFields',
        'notification_message' => 'notificationMessage',
        'notification_email_addresses' => 'notificationEmailAddresses'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'topic' => 'setTopic',
        'priority' => 'setPriority',
        'company_name' => 'setCompanyName',
        'reg_number' => 'setRegNumber',
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'title_before' => 'setTitleBefore',
        'title_after' => 'setTitleAfter',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'contact_source' => 'setContactSource',
        'category' => 'setCategory',
        'notice' => 'setNotice',
        'lead_phase' => 'setLeadPhase',
        'tags' => 'setTags',
        'territory' => 'setTerritory',
        'lead_person' => 'setLeadPerson',
        'contact_info' => 'setContactInfo',
        'address' => 'setAddress',
        'social_network_contact' => 'setSocialNetworkContact',
        'custom_fields' => 'setCustomFields',
        'notification_message' => 'setNotificationMessage',
        'notification_email_addresses' => 'setNotificationEmailAddresses'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'topic' => 'getTopic',
        'priority' => 'getPriority',
        'company_name' => 'getCompanyName',
        'reg_number' => 'getRegNumber',
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'title_before' => 'getTitleBefore',
        'title_after' => 'getTitleAfter',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'contact_source' => 'getContactSource',
        'category' => 'getCategory',
        'notice' => 'getNotice',
        'lead_phase' => 'getLeadPhase',
        'tags' => 'getTags',
        'territory' => 'getTerritory',
        'lead_person' => 'getLeadPerson',
        'contact_info' => 'getContactInfo',
        'address' => 'getAddress',
        'social_network_contact' => 'getSocialNetworkContact',
        'custom_fields' => 'getCustomFields',
        'notification_message' => 'getNotificationMessage',
        'notification_email_addresses' => 'getNotificationEmailAddresses'
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

    public const PRIORITY_MINOR = 'MINOR';
    public const PRIORITY__DEFAULT = 'DEFAULT';
    public const PRIORITY_CRITICAL = 'CRITICAL';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPriorityAllowableValues()
    {
        return [
            self::PRIORITY_MINOR,
            self::PRIORITY__DEFAULT,
            self::PRIORITY_CRITICAL,
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
        $this->setIfExists('topic', $data ?? [], null);
        $this->setIfExists('priority', $data ?? [], null);
        $this->setIfExists('company_name', $data ?? [], null);
        $this->setIfExists('reg_number', $data ?? [], null);
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('title_before', $data ?? [], null);
        $this->setIfExists('title_after', $data ?? [], null);
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('contact_source', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('notice', $data ?? [], null);
        $this->setIfExists('lead_phase', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('territory', $data ?? [], null);
        $this->setIfExists('lead_person', $data ?? [], null);
        $this->setIfExists('contact_info', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('social_network_contact', $data ?? [], null);
        $this->setIfExists('custom_fields', $data ?? [], null);
        $this->setIfExists('notification_message', $data ?? [], null);
        $this->setIfExists('notification_email_addresses', $data ?? [], null);
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

        if ($this->container['topic'] === null) {
            $invalidProperties[] = "'topic' can't be null";
        }
        if ($this->container['priority'] === null) {
            $invalidProperties[] = "'priority' can't be null";
        }
        $allowedValues = $this->getPriorityAllowableValues();
        if (!is_null($this->container['priority']) && !in_array($this->container['priority'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'priority', must be one of '%s'",
                $this->container['priority'],
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
     * Gets topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->container['topic'];
    }

    /**
     * Sets topic
     *
     * @param string $topic [Předmět]
     *
     * @return self
     */
    public function setTopic($topic)
    {
        if (is_null($topic)) {
            throw new \InvalidArgumentException('non-nullable topic cannot be null');
        }
        $this->container['topic'] = $topic;

        return $this;
    }

    /**
     * Gets priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->container['priority'];
    }

    /**
     * Sets priority
     *
     * @param string $priority [Priorita]
     *
     * @return self
     */
    public function setPriority($priority)
    {
        if (is_null($priority)) {
            throw new \InvalidArgumentException('non-nullable priority cannot be null');
        }
        $allowedValues = $this->getPriorityAllowableValues();
        if (!in_array($priority, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'priority', must be one of '%s'",
                    $priority,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['priority'] = $priority;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string|null $company_name [Název společnosti]
     *
     * @return self
     */
    public function setCompanyName($company_name)
    {
        if (is_null($company_name)) {
            throw new \InvalidArgumentException('non-nullable company_name cannot be null');
        }
        $this->container['company_name'] = $company_name;

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
     * @param int|null $contact_source [Zdroj] ID záznamu z číselníku ContactSource
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
     * @param int|null $category [Kategorie] ID záznamu z číselníku LeadCategory
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
     * @param string|null $notice [Poznámka k leadu]
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
     * Gets lead_phase
     *
     * @return int|null
     */
    public function getLeadPhase()
    {
        return $this->container['lead_phase'];
    }

    /**
     * Sets lead_phase
     *
     * @param int|null $lead_phase [Stav leadu] ID záznamu z číselníku LeadPhase
     *
     * @return self
     */
    public function setLeadPhase($lead_phase)
    {
        if (is_null($lead_phase)) {
            throw new \InvalidArgumentException('non-nullable lead_phase cannot be null');
        }
        $this->container['lead_phase'] = $lead_phase;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string|null $tags [Seznam štítků oddělených čárkou]
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
     * Gets territory
     *
     * @return int|null
     */
    public function getTerritory()
    {
        return $this->container['territory'];
    }

    /**
     * Sets territory
     *
     * @param int|null $territory [Teritorium] ID záznamu z číselníku Territory
     *
     * @return self
     */
    public function setTerritory($territory)
    {
        if (is_null($territory)) {
            throw new \InvalidArgumentException('non-nullable territory cannot be null');
        }
        $this->container['territory'] = $territory;

        return $this;
    }

    /**
     * Gets lead_person
     *
     * @return bool|null
     */
    public function getLeadPerson()
    {
        return $this->container['lead_person'];
    }

    /**
     * Sets lead_person
     *
     * @param bool|null $lead_person [Jedná se o fyzickou osobu]
     *
     * @return self
     */
    public function setLeadPerson($lead_person)
    {
        if (is_null($lead_person)) {
            throw new \InvalidArgumentException('non-nullable lead_person cannot be null');
        }
        $this->container['lead_person'] = $lead_person;

        return $this;
    }

    /**
     * Gets contact_info
     *
     * @return \RaynetApiClient\Model\LeadInsertDtoContactInfo|null
     */
    public function getContactInfo()
    {
        return $this->container['contact_info'];
    }

    /**
     * Sets contact_info
     *
     * @param \RaynetApiClient\Model\LeadInsertDtoContactInfo|null $contact_info contact_info
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
     * Gets address
     *
     * @return \RaynetApiClient\Model\LeadInsertDtoAddress|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \RaynetApiClient\Model\LeadInsertDtoAddress|null $address address
     *
     * @return self
     */
    public function setAddress($address)
    {
        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }
        $this->container['address'] = $address;

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
     * Gets notification_message
     *
     * @return string|null
     */
    public function getNotificationMessage()
    {
        return $this->container['notification_message'];
    }

    /**
     * Sets notification_message
     *
     * @param string|null $notification_message [Text notifikace]
     *
     * @return self
     */
    public function setNotificationMessage($notification_message)
    {
        if (is_null($notification_message)) {
            throw new \InvalidArgumentException('non-nullable notification_message cannot be null');
        }
        $this->container['notification_message'] = $notification_message;

        return $this;
    }

    /**
     * Gets notification_email_addresses
     *
     * @return string[]|null
     */
    public function getNotificationEmailAddresses()
    {
        return $this->container['notification_email_addresses'];
    }

    /**
     * Sets notification_email_addresses
     *
     * @param string[]|null $notification_email_addresses notification_email_addresses
     *
     * @return self
     */
    public function setNotificationEmailAddresses($notification_email_addresses)
    {
        if (is_null($notification_email_addresses)) {
            throw new \InvalidArgumentException('non-nullable notification_email_addresses cannot be null');
        }
        $this->container['notification_email_addresses'] = $notification_email_addresses;

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


