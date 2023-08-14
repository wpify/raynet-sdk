<?php
/**
 * OfferEditDto
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
 * OfferEditDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OfferEditDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'OfferEditDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'security_level' => 'int',
        'owner' => 'int',
        'company' => 'int',
        'person' => 'int',
        'business_case' => 'int',
        'total_amount' => 'float',
        'estimated_value' => 'float',
        'valid_from' => '\DateTime',
        'valid_till' => '\DateTime',
        'expiration_date' => '\DateTime',
        'description' => 'string',
        'category' => 'int',
        'offer_status' => 'int',
        'custom_fields' => '\RaynetApiClient\Model\CompanyInsertDtoCustomFields',
        'items' => '\RaynetApiClient\Model\BusinessCaseEditDtoItemsInner[]'
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
        'security_level' => 'int64',
        'owner' => 'int64',
        'company' => 'int64',
        'person' => 'int64',
        'business_case' => 'int64',
        'total_amount' => null,
        'estimated_value' => null,
        'valid_from' => 'date',
        'valid_till' => 'date',
        'expiration_date' => 'date',
        'description' => null,
        'category' => 'int64',
        'offer_status' => 'int64',
        'custom_fields' => null,
        'items' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
		'security_level' => false,
		'owner' => false,
		'company' => false,
		'person' => false,
		'business_case' => false,
		'total_amount' => false,
		'estimated_value' => false,
		'valid_from' => false,
		'valid_till' => false,
		'expiration_date' => false,
		'description' => false,
		'category' => false,
		'offer_status' => false,
		'custom_fields' => false,
		'items' => false
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
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'company' => 'company',
        'person' => 'person',
        'business_case' => 'businessCase',
        'total_amount' => 'totalAmount',
        'estimated_value' => 'estimatedValue',
        'valid_from' => 'validFrom',
        'valid_till' => 'validTill',
        'expiration_date' => 'expirationDate',
        'description' => 'description',
        'category' => 'category',
        'offer_status' => 'offerStatus',
        'custom_fields' => 'customFields',
        'items' => 'items'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'company' => 'setCompany',
        'person' => 'setPerson',
        'business_case' => 'setBusinessCase',
        'total_amount' => 'setTotalAmount',
        'estimated_value' => 'setEstimatedValue',
        'valid_from' => 'setValidFrom',
        'valid_till' => 'setValidTill',
        'expiration_date' => 'setExpirationDate',
        'description' => 'setDescription',
        'category' => 'setCategory',
        'offer_status' => 'setOfferStatus',
        'custom_fields' => 'setCustomFields',
        'items' => 'setItems'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'company' => 'getCompany',
        'person' => 'getPerson',
        'business_case' => 'getBusinessCase',
        'total_amount' => 'getTotalAmount',
        'estimated_value' => 'getEstimatedValue',
        'valid_from' => 'getValidFrom',
        'valid_till' => 'getValidTill',
        'expiration_date' => 'getExpirationDate',
        'description' => 'getDescription',
        'category' => 'getCategory',
        'offer_status' => 'getOfferStatus',
        'custom_fields' => 'getCustomFields',
        'items' => 'getItems'
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
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('person', $data ?? [], null);
        $this->setIfExists('business_case', $data ?? [], null);
        $this->setIfExists('total_amount', $data ?? [], null);
        $this->setIfExists('estimated_value', $data ?? [], null);
        $this->setIfExists('valid_from', $data ?? [], null);
        $this->setIfExists('valid_till', $data ?? [], null);
        $this->setIfExists('expiration_date', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('offer_status', $data ?? [], null);
        $this->setIfExists('custom_fields', $data ?? [], null);
        $this->setIfExists('items', $data ?? [], null);
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

        if (!is_null($this->container['items']) && (count($this->container['items']) < 1)) {
            $invalidProperties[] = "invalid value for 'items', number of items must be greater than or equal to 1.";
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
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name [Předmět]
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
     * @param int|null $company [Klient] ID klienta, pro kterého je nabídka vytvářena
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
     * @param int|null $person [Kontaktní osoba] ID zodp. kontaktní osoby klienta pro kterou je nabídka vytvářena
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
     * @param int|null $business_case [OP] ID obch. případu nabídky
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
     * Gets total_amount
     *
     * @return float|null
     */
    public function getTotalAmount()
    {
        return $this->container['total_amount'];
    }

    /**
     * Sets total_amount
     *
     * @param float|null $total_amount [Konečná cena] konečná cena nabídky
     *
     * @return self
     */
    public function setTotalAmount($total_amount)
    {
        if (is_null($total_amount)) {
            throw new \InvalidArgumentException('non-nullable total_amount cannot be null');
        }
        $this->container['total_amount'] = $total_amount;

        return $this;
    }

    /**
     * Gets estimated_value
     *
     * @return float|null
     */
    public function getEstimatedValue()
    {
        return $this->container['estimated_value'];
    }

    /**
     * Sets estimated_value
     *
     * @param float|null $estimated_value [Předpokládané náklady] předpokládané náklady v nabídce
     *
     * @return self
     */
    public function setEstimatedValue($estimated_value)
    {
        if (is_null($estimated_value)) {
            throw new \InvalidArgumentException('non-nullable estimated_value cannot be null');
        }
        $this->container['estimated_value'] = $estimated_value;

        return $this;
    }

    /**
     * Gets valid_from
     *
     * @return \DateTime|null
     */
    public function getValidFrom()
    {
        return $this->container['valid_from'];
    }

    /**
     * Sets valid_from
     *
     * @param \DateTime|null $valid_from [Otevřeno od] datum vytvoření nabídky
     *
     * @return self
     */
    public function setValidFrom($valid_from)
    {
        if (is_null($valid_from)) {
            throw new \InvalidArgumentException('non-nullable valid_from cannot be null');
        }
        $this->container['valid_from'] = $valid_from;

        return $this;
    }

    /**
     * Gets valid_till
     *
     * @return \DateTime|null
     */
    public function getValidTill()
    {
        return $this->container['valid_till'];
    }

    /**
     * Sets valid_till
     *
     * @param \DateTime|null $valid_till [Otevřeno od] datum uzavření nabídky
     *
     * @return self
     */
    public function setValidTill($valid_till)
    {
        if (is_null($valid_till)) {
            throw new \InvalidArgumentException('non-nullable valid_till cannot be null');
        }
        $this->container['valid_till'] = $valid_till;

        return $this;
    }

    /**
     * Gets expiration_date
     *
     * @return \DateTime|null
     */
    public function getExpirationDate()
    {
        return $this->container['expiration_date'];
    }

    /**
     * Sets expiration_date
     *
     * @param \DateTime|null $expiration_date [Konec platnosti] konec platnosti nabídky
     *
     * @return self
     */
    public function setExpirationDate($expiration_date)
    {
        if (is_null($expiration_date)) {
            throw new \InvalidArgumentException('non-nullable expiration_date cannot be null');
        }
        $this->container['expiration_date'] = $expiration_date;

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
     * @param string|null $description [Poznámka]
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
     * @param int|null $category [Kategorie] ID záznamu z číselníku OfferCategory
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
     * Gets offer_status
     *
     * @return int|null
     */
    public function getOfferStatus()
    {
        return $this->container['offer_status'];
    }

    /**
     * Sets offer_status
     *
     * @param int|null $offer_status [Stav] ID záznamu z OfferStatus. Pokud nebude vyplněno, založí se nabídka do prvního stavu.
     *
     * @return self
     */
    public function setOfferStatus($offer_status)
    {
        if (is_null($offer_status)) {
            throw new \InvalidArgumentException('non-nullable offer_status cannot be null');
        }
        $this->container['offer_status'] = $offer_status;

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
     * Gets items
     *
     * @return \RaynetApiClient\Model\BusinessCaseEditDtoItemsInner[]|null
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \RaynetApiClient\Model\BusinessCaseEditDtoItemsInner[]|null $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        if (is_null($items)) {
            throw new \InvalidArgumentException('non-nullable items cannot be null');
        }


        if ((count($items) < 1)) {
            throw new \InvalidArgumentException('invalid length for $items when calling OfferEditDto., number of items must be greater than or equal to 1.');
        }
        $this->container['items'] = $items;

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


