<?php
/**
 * InvoiceInsertDto
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
 * InvoiceInsertDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InvoiceInsertDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceInsertDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'company' => 'int',
        'security_level' => 'int',
        'title' => 'string',
        'constant_symbol' => 'string',
        'specific_symbol' => 'string',
        'currency' => 'int',
        'due_date' => 'string',
        'issue_date' => 'string',
        'invoice_type' => 'string',
        'payment_term_days' => 'int',
        'payment_type' => 'string',
        'taxable_supply_date' => 'string',
        'business_case' => 'int',
        'note' => 'string',
        'delivery_note' => 'string',
        'private_note' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'company' => 'int64',
        'security_level' => 'int64',
        'title' => null,
        'constant_symbol' => null,
        'specific_symbol' => null,
        'currency' => 'int64',
        'due_date' => null,
        'issue_date' => null,
        'invoice_type' => null,
        'payment_term_days' => null,
        'payment_type' => null,
        'taxable_supply_date' => null,
        'business_case' => 'int64',
        'note' => null,
        'delivery_note' => null,
        'private_note' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'company' => false,
		'security_level' => false,
		'title' => false,
		'constant_symbol' => false,
		'specific_symbol' => false,
		'currency' => false,
		'due_date' => false,
		'issue_date' => false,
		'invoice_type' => false,
		'payment_term_days' => false,
		'payment_type' => false,
		'taxable_supply_date' => false,
		'business_case' => false,
		'note' => false,
		'delivery_note' => false,
		'private_note' => false
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
        'company' => 'company',
        'security_level' => 'securityLevel',
        'title' => 'title',
        'constant_symbol' => 'constantSymbol',
        'specific_symbol' => 'specificSymbol',
        'currency' => 'currency',
        'due_date' => 'dueDate',
        'issue_date' => 'issueDate',
        'invoice_type' => 'invoiceType',
        'payment_term_days' => 'paymentTermDays',
        'payment_type' => 'paymentType',
        'taxable_supply_date' => 'taxableSupplyDate',
        'business_case' => 'businessCase',
        'note' => 'note',
        'delivery_note' => 'deliveryNote',
        'private_note' => 'privateNote'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'company' => 'setCompany',
        'security_level' => 'setSecurityLevel',
        'title' => 'setTitle',
        'constant_symbol' => 'setConstantSymbol',
        'specific_symbol' => 'setSpecificSymbol',
        'currency' => 'setCurrency',
        'due_date' => 'setDueDate',
        'issue_date' => 'setIssueDate',
        'invoice_type' => 'setInvoiceType',
        'payment_term_days' => 'setPaymentTermDays',
        'payment_type' => 'setPaymentType',
        'taxable_supply_date' => 'setTaxableSupplyDate',
        'business_case' => 'setBusinessCase',
        'note' => 'setNote',
        'delivery_note' => 'setDeliveryNote',
        'private_note' => 'setPrivateNote'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'company' => 'getCompany',
        'security_level' => 'getSecurityLevel',
        'title' => 'getTitle',
        'constant_symbol' => 'getConstantSymbol',
        'specific_symbol' => 'getSpecificSymbol',
        'currency' => 'getCurrency',
        'due_date' => 'getDueDate',
        'issue_date' => 'getIssueDate',
        'invoice_type' => 'getInvoiceType',
        'payment_term_days' => 'getPaymentTermDays',
        'payment_type' => 'getPaymentType',
        'taxable_supply_date' => 'getTaxableSupplyDate',
        'business_case' => 'getBusinessCase',
        'note' => 'getNote',
        'delivery_note' => 'getDeliveryNote',
        'private_note' => 'getPrivateNote'
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

    public const INVOICE_TYPE_NORMAL = 'NORMAL';
    public const INVOICE_TYPE_PROFORMA = 'PROFORMA';
    public const PAYMENT_TYPE_DIRECT_DEBIT = 'PAYMENT_DIRECT_DEBIT';
    public const PAYMENT_TYPE_CASH = 'PAYMENT_CASH';
    public const PAYMENT_TYPE_CASH_ON_DELIVERY = 'PAYMENT_CASH_ON_DELIVERY';
    public const PAYMENT_TYPE_CARD = 'PAYMENT_CARD';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceTypeAllowableValues()
    {
        return [
            self::INVOICE_TYPE_NORMAL,
            self::INVOICE_TYPE_PROFORMA,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentTypeAllowableValues()
    {
        return [
            self::PAYMENT_TYPE_DIRECT_DEBIT,
            self::PAYMENT_TYPE_CASH,
            self::PAYMENT_TYPE_CASH_ON_DELIVERY,
            self::PAYMENT_TYPE_CARD,
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
        $this->setIfExists('company', $data ?? [], null);
        $this->setIfExists('security_level', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('constant_symbol', $data ?? [], null);
        $this->setIfExists('specific_symbol', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('due_date', $data ?? [], null);
        $this->setIfExists('issue_date', $data ?? [], null);
        $this->setIfExists('invoice_type', $data ?? [], null);
        $this->setIfExists('payment_term_days', $data ?? [], null);
        $this->setIfExists('payment_type', $data ?? [], null);
        $this->setIfExists('taxable_supply_date', $data ?? [], null);
        $this->setIfExists('business_case', $data ?? [], null);
        $this->setIfExists('note', $data ?? [], null);
        $this->setIfExists('delivery_note', $data ?? [], null);
        $this->setIfExists('private_note', $data ?? [], null);
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

        if ($this->container['company'] === null) {
            $invalidProperties[] = "'company' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalidProperties[] = "'currency' can't be null";
        }
        if ($this->container['due_date'] === null) {
            $invalidProperties[] = "'due_date' can't be null";
        }
        if ($this->container['issue_date'] === null) {
            $invalidProperties[] = "'issue_date' can't be null";
        }
        if ($this->container['invoice_type'] === null) {
            $invalidProperties[] = "'invoice_type' can't be null";
        }
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_type', must be one of '%s'",
                $this->container['invoice_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['payment_type'] === null) {
            $invalidProperties[] = "'payment_type' can't be null";
        }
        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!is_null($this->container['payment_type']) && !in_array($this->container['payment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_type', must be one of '%s'",
                $this->container['payment_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['taxable_supply_date'] === null) {
            $invalidProperties[] = "'taxable_supply_date' can't be null";
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
     * Gets company
     *
     * @return int
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param int $company [Klient] Klient kterému se bude fakturovat
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
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title [Název] Název faktury pro lepší dohledatelnost
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
     * Gets constant_symbol
     *
     * @return string|null
     */
    public function getConstantSymbol()
    {
        return $this->container['constant_symbol'];
    }

    /**
     * Sets constant_symbol
     *
     * @param string|null $constant_symbol [Konstantní symbol]
     *
     * @return self
     */
    public function setConstantSymbol($constant_symbol)
    {
        if (is_null($constant_symbol)) {
            throw new \InvalidArgumentException('non-nullable constant_symbol cannot be null');
        }
        $this->container['constant_symbol'] = $constant_symbol;

        return $this;
    }

    /**
     * Gets specific_symbol
     *
     * @return string|null
     */
    public function getSpecificSymbol()
    {
        return $this->container['specific_symbol'];
    }

    /**
     * Sets specific_symbol
     *
     * @param string|null $specific_symbol [Specifický symbol]
     *
     * @return self
     */
    public function setSpecificSymbol($specific_symbol)
    {
        if (is_null($specific_symbol)) {
            throw new \InvalidArgumentException('non-nullable specific_symbol cannot be null');
        }
        $this->container['specific_symbol'] = $specific_symbol;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return int
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param int $currency [Měna] ID záznamu z číselníku Currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets due_date
     *
     * @return string
     */
    public function getDueDate()
    {
        return $this->container['due_date'];
    }

    /**
     * Sets due_date
     *
     * @param string $due_date [Datum splatnosti]
     *
     * @return self
     */
    public function setDueDate($due_date)
    {
        if (is_null($due_date)) {
            throw new \InvalidArgumentException('non-nullable due_date cannot be null');
        }
        $this->container['due_date'] = $due_date;

        return $this;
    }

    /**
     * Gets issue_date
     *
     * @return string
     */
    public function getIssueDate()
    {
        return $this->container['issue_date'];
    }

    /**
     * Sets issue_date
     *
     * @param string $issue_date [Datum vystavení]
     *
     * @return self
     */
    public function setIssueDate($issue_date)
    {
        if (is_null($issue_date)) {
            throw new \InvalidArgumentException('non-nullable issue_date cannot be null');
        }
        $this->container['issue_date'] = $issue_date;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string $invoice_type [Typ faktury]
     *
     * @return self
     */
    public function setInvoiceType($invoice_type)
    {
        if (is_null($invoice_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_type cannot be null');
        }
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_type', must be one of '%s'",
                    $invoice_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_type'] = $invoice_type;

        return $this;
    }

    /**
     * Gets payment_term_days
     *
     * @return int|null
     */
    public function getPaymentTermDays()
    {
        return $this->container['payment_term_days'];
    }

    /**
     * Sets payment_term_days
     *
     * @param int|null $payment_term_days [Splatnost]
     *
     * @return self
     */
    public function setPaymentTermDays($payment_term_days)
    {
        if (is_null($payment_term_days)) {
            throw new \InvalidArgumentException('non-nullable payment_term_days cannot be null');
        }
        $this->container['payment_term_days'] = $payment_term_days;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string $payment_type [Způsob úhrady]
     *
     * @return self
     */
    public function setPaymentType($payment_type)
    {
        if (is_null($payment_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type cannot be null');
        }
        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!in_array($payment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_type', must be one of '%s'",
                    $payment_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets taxable_supply_date
     *
     * @return string
     */
    public function getTaxableSupplyDate()
    {
        return $this->container['taxable_supply_date'];
    }

    /**
     * Sets taxable_supply_date
     *
     * @param string $taxable_supply_date [Datum zdanitelného plnění]
     *
     * @return self
     */
    public function setTaxableSupplyDate($taxable_supply_date)
    {
        if (is_null($taxable_supply_date)) {
            throw new \InvalidArgumentException('non-nullable taxable_supply_date cannot be null');
        }
        $this->container['taxable_supply_date'] = $taxable_supply_date;

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
     * @param int|null $business_case [Obchodní případ] ID záznamu obchodního případu. Pokud je vloženo jsou zkopírovány položky OP na fakturu. Není kontrolována integrita Klient - Obchodní případ - Faktura (tzn. faktura může být na jiného klienta než OP).
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
     * Gets note
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param string|null $note [Poznámka pro příjemce] Pokud není vyplněna, použije se předvyplnění z konfigurace fakturačního modulu
     *
     * @return self
     */
    public function setNote($note)
    {
        if (is_null($note)) {
            throw new \InvalidArgumentException('non-nullable note cannot be null');
        }
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets delivery_note
     *
     * @return string|null
     */
    public function getDeliveryNote()
    {
        return $this->container['delivery_note'];
    }

    /**
     * Sets delivery_note
     *
     * @param string|null $delivery_note [Poznámka pro příjemce - dodací list]
     *
     * @return self
     */
    public function setDeliveryNote($delivery_note)
    {
        if (is_null($delivery_note)) {
            throw new \InvalidArgumentException('non-nullable delivery_note cannot be null');
        }
        $this->container['delivery_note'] = $delivery_note;

        return $this;
    }

    /**
     * Gets private_note
     *
     * @return string|null
     */
    public function getPrivateNote()
    {
        return $this->container['private_note'];
    }

    /**
     * Sets private_note
     *
     * @param string|null $private_note [Poznámka interní]
     *
     * @return self
     */
    public function setPrivateNote($private_note)
    {
        if (is_null($private_note)) {
            throw new \InvalidArgumentException('non-nullable private_note cannot be null');
        }
        $this->container['private_note'] = $private_note;

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


