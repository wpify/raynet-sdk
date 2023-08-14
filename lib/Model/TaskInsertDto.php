<?php
/**
 * TaskInsertDto
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
 * TaskInsertDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TaskInsertDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TaskInsertDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'title' => 'string',
        'priority' => 'string',
        'category' => 'int',
        'person' => 'int',
        'company' => 'int',
        'business_case' => 'int',
        'offer' => 'int',
        'sales_order' => 'int',
        'project' => 'int',
        'activity' => 'int',
        'lead' => 'int',
        'security_level' => 'int',
        'owner' => 'int',
        'resolver' => 'int',
        'deadline' => '\DateTime',
        'scheduled_from' => '\DateTime',
        'scheduled_till' => '\DateTime',
        'completed' => '\DateTime',
        'description' => 'string',
        'solution' => 'string',
        'tags' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title' => null,
        'priority' => null,
        'category' => 'int64',
        'person' => 'int64',
        'company' => 'int64',
        'business_case' => 'int64',
        'offer' => 'int64',
        'sales_order' => 'int64',
        'project' => 'int64',
        'activity' => 'int64',
        'lead' => 'int64',
        'security_level' => 'int64',
        'owner' => 'int64',
        'resolver' => 'int64',
        'deadline' => 'date-time',
        'scheduled_from' => 'date-time',
        'scheduled_till' => 'date-time',
        'completed' => 'date-time',
        'description' => null,
        'solution' => null,
        'tags' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'title' => false,
		'priority' => false,
		'category' => false,
		'person' => false,
		'company' => false,
		'business_case' => false,
		'offer' => false,
		'sales_order' => false,
		'project' => false,
		'activity' => false,
		'lead' => false,
		'security_level' => false,
		'owner' => false,
		'resolver' => false,
		'deadline' => false,
		'scheduled_from' => false,
		'scheduled_till' => false,
		'completed' => false,
		'description' => false,
		'solution' => false,
		'tags' => false
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
        'title' => 'title',
        'priority' => 'priority',
        'category' => 'category',
        'person' => 'person',
        'company' => 'company',
        'business_case' => 'businessCase',
        'offer' => 'offer',
        'sales_order' => 'salesOrder',
        'project' => 'project',
        'activity' => 'activity',
        'lead' => 'lead',
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'resolver' => 'resolver',
        'deadline' => 'deadline',
        'scheduled_from' => 'scheduledFrom',
        'scheduled_till' => 'scheduledTill',
        'completed' => 'completed',
        'description' => 'description',
        'solution' => 'solution',
        'tags' => 'tags'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title' => 'setTitle',
        'priority' => 'setPriority',
        'category' => 'setCategory',
        'person' => 'setPerson',
        'company' => 'setCompany',
        'business_case' => 'setBusinessCase',
        'offer' => 'setOffer',
        'sales_order' => 'setSalesOrder',
        'project' => 'setProject',
        'activity' => 'setActivity',
        'lead' => 'setLead',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'resolver' => 'setResolver',
        'deadline' => 'setDeadline',
        'scheduled_from' => 'setScheduledFrom',
        'scheduled_till' => 'setScheduledTill',
        'completed' => 'setCompleted',
        'description' => 'setDescription',
        'solution' => 'setSolution',
        'tags' => 'setTags'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title' => 'getTitle',
        'priority' => 'getPriority',
        'category' => 'getCategory',
        'person' => 'getPerson',
        'company' => 'getCompany',
        'business_case' => 'getBusinessCase',
        'offer' => 'getOffer',
        'sales_order' => 'getSalesOrder',
        'project' => 'getProject',
        'activity' => 'getActivity',
        'lead' => 'getLead',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'resolver' => 'getResolver',
        'deadline' => 'getDeadline',
        'scheduled_from' => 'getScheduledFrom',
        'scheduled_till' => 'getScheduledTill',
        'completed' => 'getCompleted',
        'description' => 'getDescription',
        'solution' => 'getSolution',
        'tags' => 'getTags'
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
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('priority', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('person', $data ?? [], null);
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('business_case', $data ?? [], null);
        $this->setIfExists('offer', $data ?? [], null);
        $this->setIfExists('sales_order', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('activity', $data ?? [], null);
        $this->setIfExists('lead', $data ?? [], null);
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('resolver', $data ?? [], null);
        $this->setIfExists('deadline', $data ?? [], null);
        $this->setIfExists('scheduled_from', $data ?? [], null);
        $this->setIfExists('scheduled_till', $data ?? [], null);
        $this->setIfExists('completed', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('solution', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
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

        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
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

        if ($this->container['owner'] === null) {
            $invalidProperties[] = "'owner' can't be null";
        }
        if ($this->container['resolver'] === null) {
            $invalidProperties[] = "'resolver' can't be null";
        }
        if ($this->container['deadline'] === null) {
            $invalidProperties[] = "'deadline' can't be null";
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
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title [Předmět]
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

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
     * @param int|null $category [Kategorie] ID záznamu z číselníku ActivityCategory
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
     * Gets person
     *
     * @return int|null
     */
    public function getPerson()
    {
        return $this->container['person'];
    }

    /**
     * Sets person
     *
     * @param int|null $person [Kontaktní osoba] ID kontaktní osoby v kontextu záznamu
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
     * Gets company
     *
     * @return int|null
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param int|null $company [Klient] ID klienta v kontextu záznamu
     *
     * @return self
     */
    public function setCompany($company)
    {
        if (is_null($company)) {
            throw new \InvalidArgumentException('non-nullable company cannot be null');
        }
        $this->container['company'] = $company;

        return $this;
    }

    /**
     * Gets business_case
     *
     * @return int|null
     */
    public function getBusinessCase()
    {
        return $this->container['business_case'];
    }

    /**
     * Sets business_case
     *
     * @param int|null $business_case [Obch. případ] ID obch. případu v kontextu záznamu
     *
     * @return self
     */
    public function setBusinessCase($business_case)
    {
        if (is_null($business_case)) {
            throw new \InvalidArgumentException('non-nullable business_case cannot be null');
        }
        $this->container['business_case'] = $business_case;

        return $this;
    }

    /**
     * Gets offer
     *
     * @return int|null
     */
    public function getOffer()
    {
        return $this->container['offer'];
    }

    /**
     * Sets offer
     *
     * @param int|null $offer [Nabídka] ID nabídky v kontextu záznamu
     *
     * @return self
     */
    public function setOffer($offer)
    {
        if (is_null($offer)) {
            throw new \InvalidArgumentException('non-nullable offer cannot be null');
        }
        $this->container['offer'] = $offer;

        return $this;
    }

    /**
     * Gets sales_order
     *
     * @return int|null
     */
    public function getSalesOrder()
    {
        return $this->container['sales_order'];
    }

    /**
     * Sets sales_order
     *
     * @param int|null $sales_order [Objednávka] ID objednávky v kontextu záznamu
     *
     * @return self
     */
    public function setSalesOrder($sales_order)
    {
        if (is_null($sales_order)) {
            throw new \InvalidArgumentException('non-nullable sales_order cannot be null');
        }
        $this->container['sales_order'] = $sales_order;

        return $this;
    }

    /**
     * Gets project
     *
     * @return int|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param int|null $project [Projekt] ID projektu v kontextu záznamu
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets activity
     *
     * @return int|null
     */
    public function getActivity()
    {
        return $this->container['activity'];
    }

    /**
     * Sets activity
     *
     * @param int|null $activity [Aktivita] ID aktivity v kontextu záznamu
     *
     * @return self
     */
    public function setActivity($activity)
    {
        if (is_null($activity)) {
            throw new \InvalidArgumentException('non-nullable activity cannot be null');
        }
        $this->container['activity'] = $activity;

        return $this;
    }

    /**
     * Gets lead
     *
     * @return int|null
     */
    public function getLead()
    {
        return $this->container['lead'];
    }

    /**
     * Sets lead
     *
     * @param int|null $lead [Lead] ID leadu v kontextu záznamu
     *
     * @return self
     */
    public function setLead($lead)
    {
        if (is_null($lead)) {
            throw new \InvalidArgumentException('non-nullable lead cannot be null');
        }
        $this->container['lead'] = $lead;

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
     * @param int|null $security_level [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna, je nastavena výchozí bezpečnostní skupina.
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
     * @return int
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     *
     * @param int $owner [Vlastník] ID kontaktní osoby, který je vlastníkem (zadavatelem) úkolu
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
     * Gets resolver
     *
     * @return int
     */
    public function getResolver()
    {
        return $this->container['resolver'];
    }

    /**
     * Sets resolver
     *
     * @param int $resolver [Řešitel] ID kontaktní osoby, který je řešitelem úkolu
     *
     * @return self
     */
    public function setResolver($resolver)
    {
        if (is_null($resolver)) {
            throw new \InvalidArgumentException('non-nullable resolver cannot be null');
        }
        $this->container['resolver'] = $resolver;

        return $this;
    }

    /**
     * Gets deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->container['deadline'];
    }

    /**
     * Sets deadline
     *
     * @param \DateTime $deadline [Deadline]
     *
     * @return self
     */
    public function setDeadline($deadline)
    {
        if (is_null($deadline)) {
            throw new \InvalidArgumentException('non-nullable deadline cannot be null');
        }
        $this->container['deadline'] = $deadline;

        return $this;
    }

    /**
     * Gets scheduled_from
     *
     * @return \DateTime|null
     */
    public function getScheduledFrom()
    {
        return $this->container['scheduled_from'];
    }

    /**
     * Sets scheduled_from
     *
     * @param \DateTime|null $scheduled_from [Naplánování v kalendáři od]
     *
     * @return self
     */
    public function setScheduledFrom($scheduled_from)
    {
        if (is_null($scheduled_from)) {
            throw new \InvalidArgumentException('non-nullable scheduled_from cannot be null');
        }
        $this->container['scheduled_from'] = $scheduled_from;

        return $this;
    }

    /**
     * Gets scheduled_till
     *
     * @return \DateTime|null
     */
    public function getScheduledTill()
    {
        return $this->container['scheduled_till'];
    }

    /**
     * Sets scheduled_till
     *
     * @param \DateTime|null $scheduled_till [Naplánování v kalendáři do]
     *
     * @return self
     */
    public function setScheduledTill($scheduled_till)
    {
        if (is_null($scheduled_till)) {
            throw new \InvalidArgumentException('non-nullable scheduled_till cannot be null');
        }
        $this->container['scheduled_till'] = $scheduled_till;

        return $this;
    }

    /**
     * Gets completed
     *
     * @return \DateTime|null
     */
    public function getCompleted()
    {
        return $this->container['completed'];
    }

    /**
     * Sets completed
     *
     * @param \DateTime|null $completed [Datum realizace]
     *
     * @return self
     */
    public function setCompleted($completed)
    {
        if (is_null($completed)) {
            throw new \InvalidArgumentException('non-nullable completed cannot be null');
        }
        $this->container['completed'] = $completed;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description [Zadání úkolu]
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets solution
     *
     * @return string|null
     */
    public function getSolution()
    {
        return $this->container['solution'];
    }

    /**
     * Sets solution
     *
     * @param string|null $solution [Řešení úkolu]
     *
     * @return self
     */
    public function setSolution($solution)
    {
        if (is_null($solution)) {
            throw new \InvalidArgumentException('non-nullable solution cannot be null');
        }
        $this->container['solution'] = $solution;

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


