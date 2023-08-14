<?php
/**
 * MassEmailRecipientEditDto
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
 * MassEmailRecipientEditDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MassEmailRecipientEditDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MassEmailRecipientEditDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'person' => 'int',
        'company' => 'int',
        'lead' => 'int',
        'status' => 'string',
        'email' => 'string',
        'opened' => '\DateTime',
        'clicked' => '\DateTime',
        'unsubscribed' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'person' => 'int64',
        'company' => 'int64',
        'lead' => 'int64',
        'status' => null,
        'email' => null,
        'opened' => 'date',
        'clicked' => 'date',
        'unsubscribed' => 'date'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'person' => false,
		'company' => false,
		'lead' => false,
		'status' => false,
		'email' => false,
		'opened' => false,
		'clicked' => false,
		'unsubscribed' => false
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
        'person' => 'person',
        'company' => 'company',
        'lead' => 'lead',
        'status' => 'status',
        'email' => 'email',
        'opened' => 'opened',
        'clicked' => 'clicked',
        'unsubscribed' => 'unsubscribed'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'person' => 'setPerson',
        'company' => 'setCompany',
        'lead' => 'setLead',
        'status' => 'setStatus',
        'email' => 'setEmail',
        'opened' => 'setOpened',
        'clicked' => 'setClicked',
        'unsubscribed' => 'setUnsubscribed'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'person' => 'getPerson',
        'company' => 'getCompany',
        'lead' => 'getLead',
        'status' => 'getStatus',
        'email' => 'getEmail',
        'opened' => 'getOpened',
        'clicked' => 'getClicked',
        'unsubscribed' => 'getUnsubscribed'
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

    public const STATUS_NOT_SENT = 'NOT_SENT';
    public const STATUS_DELIVERED = 'DELIVERED';
    public const STATUS_REJECTED = 'REJECTED';
    public const STATUS_SENT = 'SENT';
    public const STATUS_UNKNOWN = 'UNKNOWN';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_NOT_SENT,
            self::STATUS_DELIVERED,
            self::STATUS_REJECTED,
            self::STATUS_SENT,
            self::STATUS_UNKNOWN,
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
        $this->setIfExists('person', $data ?? [], null);
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('lead', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('opened', $data ?? [], null);
        $this->setIfExists('clicked', $data ?? [], null);
        $this->setIfExists('unsubscribed', $data ?? [], null);
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

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
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
     * @param int|null $person [Kontaktní osoba] ID kontaktní osoby, která je adresátem emailu
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
     * @param int|null $company [Klient] ID klienta, který je adresátem emailu
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
     * @param int|null $lead [Lead] ID leadu, který je adresátem emailu
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
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status [Stav] Stav odeslání
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email [Email] Email, kam byla zpráva odeslána
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets opened
     *
     * @return \DateTime|null
     */
    public function getOpened()
    {
        return $this->container['opened'];
    }

    /**
     * Sets opened
     *
     * @param \DateTime|null $opened [Otevřeno] Datum, kdy adresátem email otevřel
     *
     * @return self
     */
    public function setOpened($opened)
    {
        if (is_null($opened)) {
            throw new \InvalidArgumentException('non-nullable opened cannot be null');
        }
        $this->container['opened'] = $opened;

        return $this;
    }

    /**
     * Gets clicked
     *
     * @return \DateTime|null
     */
    public function getClicked()
    {
        return $this->container['clicked'];
    }

    /**
     * Sets clicked
     *
     * @param \DateTime|null $clicked [Kliknuto] Datum, kdy adresát provedl akci (klik)
     *
     * @return self
     */
    public function setClicked($clicked)
    {
        if (is_null($clicked)) {
            throw new \InvalidArgumentException('non-nullable clicked cannot be null');
        }
        $this->container['clicked'] = $clicked;

        return $this;
    }

    /**
     * Gets unsubscribed
     *
     * @return \DateTime|null
     */
    public function getUnsubscribed()
    {
        return $this->container['unsubscribed'];
    }

    /**
     * Sets unsubscribed
     *
     * @param \DateTime|null $unsubscribed [Odhlášeno] Datum, kdy se adresát z kampaně odhlásil
     *
     * @return self
     */
    public function setUnsubscribed($unsubscribed)
    {
        if (is_null($unsubscribed)) {
            throw new \InvalidArgumentException('non-nullable unsubscribed cannot be null');
        }
        $this->container['unsubscribed'] = $unsubscribed;

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


