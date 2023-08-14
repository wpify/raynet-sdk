<?php
/**
 * CustomButtonInsertDto
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
 * CustomButtonInsertDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CustomButtonInsertDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CustomButtonInsertDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'entity_name' => 'string',
        'app_class' => 'string',
        'name' => 'string',
        'description' => 'string',
        'type' => 'string',
        'method' => 'string',
        'url' => 'string',
        'success_title' => 'string',
        'success_message' => 'string',
        'refresh' => 'int',
        'admin' => 'bool',
        'confirm' => 'bool',
        'open_type' => 'string',
        'open_type_window_width' => 'int',
        'open_type_window_height' => 'int',
        'open_type_window_refresh' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'entity_name' => null,
        'app_class' => null,
        'name' => null,
        'description' => null,
        'type' => null,
        'method' => null,
        'url' => null,
        'success_title' => null,
        'success_message' => null,
        'refresh' => null,
        'admin' => null,
        'confirm' => null,
        'open_type' => null,
        'open_type_window_width' => null,
        'open_type_window_height' => null,
        'open_type_window_refresh' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'entity_name' => false,
		'app_class' => false,
		'name' => false,
		'description' => false,
		'type' => false,
		'method' => false,
		'url' => false,
		'success_title' => false,
		'success_message' => false,
		'refresh' => false,
		'admin' => false,
		'confirm' => false,
		'open_type' => false,
		'open_type_window_width' => false,
		'open_type_window_height' => false,
		'open_type_window_refresh' => false
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
        'entity_name' => 'entityName',
        'app_class' => 'appClass',
        'name' => 'name',
        'description' => 'description',
        'type' => 'type',
        'method' => 'method',
        'url' => 'url',
        'success_title' => 'successTitle',
        'success_message' => 'successMessage',
        'refresh' => 'refresh',
        'admin' => 'admin',
        'confirm' => 'confirm',
        'open_type' => 'openType',
        'open_type_window_width' => 'openTypeWindowWidth',
        'open_type_window_height' => 'openTypeWindowHeight',
        'open_type_window_refresh' => 'openTypeWindowRefresh'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'entity_name' => 'setEntityName',
        'app_class' => 'setAppClass',
        'name' => 'setName',
        'description' => 'setDescription',
        'type' => 'setType',
        'method' => 'setMethod',
        'url' => 'setUrl',
        'success_title' => 'setSuccessTitle',
        'success_message' => 'setSuccessMessage',
        'refresh' => 'setRefresh',
        'admin' => 'setAdmin',
        'confirm' => 'setConfirm',
        'open_type' => 'setOpenType',
        'open_type_window_width' => 'setOpenTypeWindowWidth',
        'open_type_window_height' => 'setOpenTypeWindowHeight',
        'open_type_window_refresh' => 'setOpenTypeWindowRefresh'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'entity_name' => 'getEntityName',
        'app_class' => 'getAppClass',
        'name' => 'getName',
        'description' => 'getDescription',
        'type' => 'getType',
        'method' => 'getMethod',
        'url' => 'getUrl',
        'success_title' => 'getSuccessTitle',
        'success_message' => 'getSuccessMessage',
        'refresh' => 'getRefresh',
        'admin' => 'getAdmin',
        'confirm' => 'getConfirm',
        'open_type' => 'getOpenType',
        'open_type_window_width' => 'getOpenTypeWindowWidth',
        'open_type_window_height' => 'getOpenTypeWindowHeight',
        'open_type_window_refresh' => 'getOpenTypeWindowRefresh'
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

    public const ENTITY_NAME_COMPANY = 'Company';
    public const ENTITY_NAME_PERSON = 'Person';
    public const ENTITY_NAME_LEAD = 'Lead';
    public const ENTITY_NAME_BUSINESS_CASE = 'BusinessCase';
    public const ENTITY_NAME_OFFER = 'Offer';
    public const ENTITY_NAME_SALES_ORDER = 'SalesOrder';
    public const ENTITY_NAME_PROJECT = 'Project';
    public const ENTITY_NAME_PRODUCT = 'Product';
    public const ENTITY_NAME_PRICE_LIST = 'PriceList';
    public const ENTITY_NAME_INVOICE = 'Invoice';
    public const ENTITY_NAME_TASK = 'Task';
    public const ENTITY_NAME_MEETING = 'Meeting';
    public const ENTITY_NAME_EVENT = 'Event';
    public const ENTITY_NAME_EMAIL = 'Email';
    public const ENTITY_NAME_PHONE_CALL = 'PhoneCall';
    public const ENTITY_NAME_LETTER = 'Letter';
    public const ENTITY_NAME_MASS_EMAIL = 'MassEmail';
    public const APP_CLASS_DETAIL_VIEW = 'DetailView';
    public const APP_CLASS_LIST_VIEW = 'ListView';
    public const APP_CLASS_MAIN_MENU = 'MainMenu';
    public const TYPE_AJAX = 'AJAX';
    public const TYPE_DOWNLOAD = 'DOWNLOAD';
    public const TYPE_OPEN_URL = 'OPEN_URL';
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';
    public const OPEN_TYPE_TAB = 'OPEN_TAB';
    public const OPEN_TYPE_WINDOW = 'OPEN_WINDOW';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEntityNameAllowableValues()
    {
        return [
            self::ENTITY_NAME_COMPANY,
            self::ENTITY_NAME_PERSON,
            self::ENTITY_NAME_LEAD,
            self::ENTITY_NAME_BUSINESS_CASE,
            self::ENTITY_NAME_OFFER,
            self::ENTITY_NAME_SALES_ORDER,
            self::ENTITY_NAME_PROJECT,
            self::ENTITY_NAME_PRODUCT,
            self::ENTITY_NAME_PRICE_LIST,
            self::ENTITY_NAME_INVOICE,
            self::ENTITY_NAME_TASK,
            self::ENTITY_NAME_MEETING,
            self::ENTITY_NAME_EVENT,
            self::ENTITY_NAME_EMAIL,
            self::ENTITY_NAME_PHONE_CALL,
            self::ENTITY_NAME_LETTER,
            self::ENTITY_NAME_MASS_EMAIL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAppClassAllowableValues()
    {
        return [
            self::APP_CLASS_DETAIL_VIEW,
            self::APP_CLASS_LIST_VIEW,
            self::APP_CLASS_MAIN_MENU,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_AJAX,
            self::TYPE_DOWNLOAD,
            self::TYPE_OPEN_URL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMethodAllowableValues()
    {
        return [
            self::METHOD_GET,
            self::METHOD_POST,
            self::METHOD_PUT,
            self::METHOD_DELETE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOpenTypeAllowableValues()
    {
        return [
            self::OPEN_TYPE_TAB,
            self::OPEN_TYPE_WINDOW,
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
        $this->setIfExists('entity_name', $data ?? [], null);
        $this->setIfExists('app_class', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('method', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('success_title', $data ?? [], null);
        $this->setIfExists('success_message', $data ?? [], null);
        $this->setIfExists('refresh', $data ?? [], null);
        $this->setIfExists('admin', $data ?? [], null);
        $this->setIfExists('confirm', $data ?? [], null);
        $this->setIfExists('open_type', $data ?? [], null);
        $this->setIfExists('open_type_window_width', $data ?? [], null);
        $this->setIfExists('open_type_window_height', $data ?? [], null);
        $this->setIfExists('open_type_window_refresh', $data ?? [], null);
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

        if ($this->container['entity_name'] === null) {
            $invalidProperties[] = "'entity_name' can't be null";
        }
        $allowedValues = $this->getEntityNameAllowableValues();
        if (!is_null($this->container['entity_name']) && !in_array($this->container['entity_name'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'entity_name', must be one of '%s'",
                $this->container['entity_name'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['app_class'] === null) {
            $invalidProperties[] = "'app_class' can't be null";
        }
        $allowedValues = $this->getAppClassAllowableValues();
        if (!is_null($this->container['app_class']) && !in_array($this->container['app_class'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'app_class', must be one of '%s'",
                $this->container['app_class'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getMethodAllowableValues();
        if (!is_null($this->container['method']) && !in_array($this->container['method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'method', must be one of '%s'",
                $this->container['method'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getOpenTypeAllowableValues();
        if (!is_null($this->container['open_type']) && !in_array($this->container['open_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'open_type', must be one of '%s'",
                $this->container['open_type'],
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
     * Gets entity_name
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->container['entity_name'];
    }

    /**
     * Sets entity_name
     *
     * @param string $entity_name [Název entity, ke které se volitelné tlačítko zobrazí] - `Company` Klient - `Person` Kontaktní osoba - `Lead` Lead - `BusinessCase` Obchodní případ - `Offer` Nabídka - `SalesOrder` Objednávka - `Project` Projekt - `Product` Produkt - `PriceList` Ceník - `Invoice` Faktura - `Task` Úkol - `Meeting` Schůzka - `Event` Událost - `Email` E-mail - `PhoneCall` Telefonát - `Letter` Dopis - `MassEmail` Hromadný e-mail
     *
     * @return self
     */
    public function setEntityName($entity_name)
    {
        if (is_null($entity_name)) {
            throw new \InvalidArgumentException('non-nullable entity_name cannot be null');
        }
        $allowedValues = $this->getEntityNameAllowableValues();
        if (!in_array($entity_name, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'entity_name', must be one of '%s'",
                    $entity_name,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['entity_name'] = $entity_name;

        return $this;
    }

    /**
     * Gets app_class
     *
     * @return string
     */
    public function getAppClass()
    {
        return $this->container['app_class'];
    }

    /**
     * Sets app_class
     *
     * @param string $app_class [Typ pohledu, kde se volitelné tlačítko zobrazí] - `DetailView` Detailní pohled - `ListView` Seznamový pohled - `MainMenu` Hlavní menu
     *
     * @return self
     */
    public function setAppClass($app_class)
    {
        if (is_null($app_class)) {
            throw new \InvalidArgumentException('non-nullable app_class cannot be null');
        }
        $allowedValues = $this->getAppClassAllowableValues();
        if (!in_array($app_class, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'app_class', must be one of '%s'",
                    $app_class,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['app_class'] = $app_class;

        return $this;
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
     * @param string $name [Název vlastního tlačítka]
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
     * @param string|null $description [Popis vlastního tlačítka] Dostupné jen pro `appClass=ListView` nebo `appClass=DetailView`.
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
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type [Typ akce] - `AJAX` Asynchronní požadavek - `DOWNLOAD` Stažení souboru - `OPEN_URL` Otevření URL adresy do nové záložky
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets method
     *
     * @return string|null
     */
    public function getMethod()
    {
        return $this->container['method'];
    }

    /**
     * Sets method
     *
     * @param string|null $method [Typ http požadavku] Dostupné jen pro `type=AJAX` nebo `type=DOWNLOAD`. - `GET` - `POST` - `PUT` - `DELETE`
     *
     * @return self
     */
    public function setMethod($method)
    {
        if (is_null($method)) {
            throw new \InvalidArgumentException('non-nullable method cannot be null');
        }
        $allowedValues = $this->getMethodAllowableValues();
        if (!in_array($method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'method', must be one of '%s'",
                    $method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['method'] = $method;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string|null $url [Šablona URL adresy]
     *
     * @return self
     */
    public function setUrl($url)
    {
        if (is_null($url)) {
            throw new \InvalidArgumentException('non-nullable url cannot be null');
        }
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets success_title
     *
     * @return string|null
     */
    public function getSuccessTitle()
    {
        return $this->container['success_title'];
    }

    /**
     * Sets success_title
     *
     * @param string|null $success_title [Titulek zprávy po úspěšném vykonání akce] Dostupné jen pro `type=AJAX`.
     *
     * @return self
     */
    public function setSuccessTitle($success_title)
    {
        if (is_null($success_title)) {
            throw new \InvalidArgumentException('non-nullable success_title cannot be null');
        }
        $this->container['success_title'] = $success_title;

        return $this;
    }

    /**
     * Gets success_message
     *
     * @return string|null
     */
    public function getSuccessMessage()
    {
        return $this->container['success_message'];
    }

    /**
     * Sets success_message
     *
     * @param string|null $success_message [Text zprávy po úspěšném vykonání akce] Dostupné jen pro `type=AJAX`.
     *
     * @return self
     */
    public function setSuccessMessage($success_message)
    {
        if (is_null($success_message)) {
            throw new \InvalidArgumentException('non-nullable success_message cannot be null');
        }
        $this->container['success_message'] = $success_message;

        return $this;
    }

    /**
     * Gets refresh
     *
     * @return int|null
     */
    public function getRefresh()
    {
        return $this->container['refresh'];
    }

    /**
     * Sets refresh
     *
     * @param int|null $refresh [Obnovit data po (čas v ms)] Dostupné jen pro `appClass=DetailView` nebo `appClass=ListView`.
     *
     * @return self
     */
    public function setRefresh($refresh)
    {
        if (is_null($refresh)) {
            throw new \InvalidArgumentException('non-nullable refresh cannot be null');
        }
        $this->container['refresh'] = $refresh;

        return $this;
    }

    /**
     * Gets admin
     *
     * @return bool|null
     */
    public function getAdmin()
    {
        return $this->container['admin'];
    }

    /**
     * Sets admin
     *
     * @param bool|null $admin [Viditelné jen pro administrátora]
     *
     * @return self
     */
    public function setAdmin($admin)
    {
        if (is_null($admin)) {
            throw new \InvalidArgumentException('non-nullable admin cannot be null');
        }
        $this->container['admin'] = $admin;

        return $this;
    }

    /**
     * Gets confirm
     *
     * @return bool|null
     */
    public function getConfirm()
    {
        return $this->container['confirm'];
    }

    /**
     * Sets confirm
     *
     * @param bool|null $confirm [Vyžadovat potvrzení před spuštěním]
     *
     * @return self
     */
    public function setConfirm($confirm)
    {
        if (is_null($confirm)) {
            throw new \InvalidArgumentException('non-nullable confirm cannot be null');
        }
        $this->container['confirm'] = $confirm;

        return $this;
    }

    /**
     * Gets open_type
     *
     * @return string|null
     */
    public function getOpenType()
    {
        return $this->container['open_type'];
    }

    /**
     * Sets open_type
     *
     * @param string|null $open_type [Způsob otevření url odkazu] Dostupné jen pro `type=OPEN_URL`. - `OPEN_TAB` V nové záložce - `OPEN_WINDOW` V novém okně
     *
     * @return self
     */
    public function setOpenType($open_type)
    {
        if (is_null($open_type)) {
            throw new \InvalidArgumentException('non-nullable open_type cannot be null');
        }
        $allowedValues = $this->getOpenTypeAllowableValues();
        if (!in_array($open_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'open_type', must be one of '%s'",
                    $open_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['open_type'] = $open_type;

        return $this;
    }

    /**
     * Gets open_type_window_width
     *
     * @return int|null
     */
    public function getOpenTypeWindowWidth()
    {
        return $this->container['open_type_window_width'];
    }

    /**
     * Sets open_type_window_width
     *
     * @param int|null $open_type_window_width [Šířka nově otevřeného okna] Dostupné jen pro kombinaci `type=OPEN_URL` a `openType=OPEN_WINDOW`.
     *
     * @return self
     */
    public function setOpenTypeWindowWidth($open_type_window_width)
    {
        if (is_null($open_type_window_width)) {
            throw new \InvalidArgumentException('non-nullable open_type_window_width cannot be null');
        }
        $this->container['open_type_window_width'] = $open_type_window_width;

        return $this;
    }

    /**
     * Gets open_type_window_height
     *
     * @return int|null
     */
    public function getOpenTypeWindowHeight()
    {
        return $this->container['open_type_window_height'];
    }

    /**
     * Sets open_type_window_height
     *
     * @param int|null $open_type_window_height [Výška nově otevřeného okna] Dostupné jen pro kombinaci `type=OPEN_URL` a `openType=OPEN_WINDOW`.
     *
     * @return self
     */
    public function setOpenTypeWindowHeight($open_type_window_height)
    {
        if (is_null($open_type_window_height)) {
            throw new \InvalidArgumentException('non-nullable open_type_window_height cannot be null');
        }
        $this->container['open_type_window_height'] = $open_type_window_height;

        return $this;
    }

    /**
     * Gets open_type_window_refresh
     *
     * @return bool|null
     */
    public function getOpenTypeWindowRefresh()
    {
        return $this->container['open_type_window_refresh'];
    }

    /**
     * Sets open_type_window_refresh
     *
     * @param bool|null $open_type_window_refresh [Obnovit data po zavření okna] Dostupné jen pro kombinaci `type=OPEN_URL`, `openType=OPEN_WINDOW` a `appClass=DetailView` nebo `appClass=ListView`.
     *
     * @return self
     */
    public function setOpenTypeWindowRefresh($open_type_window_refresh)
    {
        if (is_null($open_type_window_refresh)) {
            throw new \InvalidArgumentException('non-nullable open_type_window_refresh cannot be null');
        }
        $this->container['open_type_window_refresh'] = $open_type_window_refresh;

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


