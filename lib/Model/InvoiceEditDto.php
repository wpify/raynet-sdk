<?php
/**
 * InvoiceEditDto
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
 * InvoiceEditDto Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InvoiceEditDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceEditDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'company' => 'int',
        'security_level' => 'int',
        'owner' => 'int',
        'title' => 'string',
        'variable_symbol' => 'string',
        'constant_symbol' => 'string',
        'specific_symbol' => 'string',
        'currency' => 'int',
        'due_date' => 'string',
        'issue_date' => 'string',
        'taxable_supply_date' => 'string',
        'invoice_type' => 'string',
        'payment_term_days' => 'float',
        'payment_type' => 'string',
        'business_case' => 'int',
        'note' => 'string',
        'delivery_note' => 'string',
        'private_note' => 'string',
        'vendor_name' => 'string',
        'vendor_reg_number' => 'string',
        'vendor_tax_number' => 'string',
        'vendor_address' => '\RaynetApiClient\Model\InvoiceEditDtoVendorAddress',
        'vendor_email' => 'string',
        'vendor_fax' => 'string',
        'vendor_phone_number' => 'string',
        'vendor_website' => 'string',
        'vendor_bank_name' => 'string',
        'vendor_bank_account_number' => 'string',
        'vendor_bank_iban' => 'string',
        'vendor_bank_swift' => 'string',
        'vendor_business_register_note' => 'string',
        'billing_name' => 'string',
        'billing_reg_number' => 'string',
        'billing_tax_number' => 'string',
        'billing_address' => '\RaynetApiClient\Model\InvoiceEditDtoBillingAddress',
        'items' => '\RaynetApiClient\Model\InvoiceEditDtoItemsInner[]'
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
        'owner' => 'int64',
        'title' => null,
        'variable_symbol' => null,
        'constant_symbol' => null,
        'specific_symbol' => null,
        'currency' => 'int64',
        'due_date' => null,
        'issue_date' => null,
        'taxable_supply_date' => null,
        'invoice_type' => null,
        'payment_term_days' => null,
        'payment_type' => null,
        'business_case' => 'int64',
        'note' => null,
        'delivery_note' => null,
        'private_note' => null,
        'vendor_name' => null,
        'vendor_reg_number' => null,
        'vendor_tax_number' => null,
        'vendor_address' => null,
        'vendor_email' => null,
        'vendor_fax' => null,
        'vendor_phone_number' => null,
        'vendor_website' => null,
        'vendor_bank_name' => null,
        'vendor_bank_account_number' => null,
        'vendor_bank_iban' => null,
        'vendor_bank_swift' => null,
        'vendor_business_register_note' => null,
        'billing_name' => null,
        'billing_reg_number' => null,
        'billing_tax_number' => null,
        'billing_address' => null,
        'items' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'company' => false,
		'security_level' => false,
		'owner' => false,
		'title' => false,
		'variable_symbol' => false,
		'constant_symbol' => false,
		'specific_symbol' => false,
		'currency' => false,
		'due_date' => false,
		'issue_date' => false,
		'taxable_supply_date' => false,
		'invoice_type' => false,
		'payment_term_days' => false,
		'payment_type' => false,
		'business_case' => false,
		'note' => false,
		'delivery_note' => false,
		'private_note' => false,
		'vendor_name' => false,
		'vendor_reg_number' => false,
		'vendor_tax_number' => false,
		'vendor_address' => false,
		'vendor_email' => false,
		'vendor_fax' => false,
		'vendor_phone_number' => false,
		'vendor_website' => false,
		'vendor_bank_name' => false,
		'vendor_bank_account_number' => false,
		'vendor_bank_iban' => false,
		'vendor_bank_swift' => false,
		'vendor_business_register_note' => false,
		'billing_name' => false,
		'billing_reg_number' => false,
		'billing_tax_number' => false,
		'billing_address' => false,
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
        'company' => 'company',
        'security_level' => 'securityLevel',
        'owner' => 'owner',
        'title' => 'title',
        'variable_symbol' => 'variableSymbol',
        'constant_symbol' => 'constantSymbol',
        'specific_symbol' => 'specificSymbol',
        'currency' => 'currency',
        'due_date' => 'dueDate',
        'issue_date' => 'issueDate',
        'taxable_supply_date' => 'taxableSupplyDate',
        'invoice_type' => 'invoiceType',
        'payment_term_days' => 'paymentTermDays',
        'payment_type' => 'paymentType',
        'business_case' => 'businessCase',
        'note' => 'note',
        'delivery_note' => 'deliveryNote',
        'private_note' => 'privateNote',
        'vendor_name' => 'vendorName',
        'vendor_reg_number' => 'vendorRegNumber',
        'vendor_tax_number' => 'vendorTaxNumber',
        'vendor_address' => 'vendorAddress',
        'vendor_email' => 'vendorEmail',
        'vendor_fax' => 'vendorFax',
        'vendor_phone_number' => 'vendorPhoneNumber',
        'vendor_website' => 'vendorWebsite',
        'vendor_bank_name' => 'vendorBankName',
        'vendor_bank_account_number' => 'vendorBankAccountNumber',
        'vendor_bank_iban' => 'vendorBankIban',
        'vendor_bank_swift' => 'vendorBankSwift',
        'vendor_business_register_note' => 'vendorBusinessRegisterNote',
        'billing_name' => 'billingName',
        'billing_reg_number' => 'billingRegNumber',
        'billing_tax_number' => 'billingTaxNumber',
        'billing_address' => 'billingAddress',
        'items' => 'items'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'company' => 'setCompany',
        'security_level' => 'setSecurityLevel',
        'owner' => 'setOwner',
        'title' => 'setTitle',
        'variable_symbol' => 'setVariableSymbol',
        'constant_symbol' => 'setConstantSymbol',
        'specific_symbol' => 'setSpecificSymbol',
        'currency' => 'setCurrency',
        'due_date' => 'setDueDate',
        'issue_date' => 'setIssueDate',
        'taxable_supply_date' => 'setTaxableSupplyDate',
        'invoice_type' => 'setInvoiceType',
        'payment_term_days' => 'setPaymentTermDays',
        'payment_type' => 'setPaymentType',
        'business_case' => 'setBusinessCase',
        'note' => 'setNote',
        'delivery_note' => 'setDeliveryNote',
        'private_note' => 'setPrivateNote',
        'vendor_name' => 'setVendorName',
        'vendor_reg_number' => 'setVendorRegNumber',
        'vendor_tax_number' => 'setVendorTaxNumber',
        'vendor_address' => 'setVendorAddress',
        'vendor_email' => 'setVendorEmail',
        'vendor_fax' => 'setVendorFax',
        'vendor_phone_number' => 'setVendorPhoneNumber',
        'vendor_website' => 'setVendorWebsite',
        'vendor_bank_name' => 'setVendorBankName',
        'vendor_bank_account_number' => 'setVendorBankAccountNumber',
        'vendor_bank_iban' => 'setVendorBankIban',
        'vendor_bank_swift' => 'setVendorBankSwift',
        'vendor_business_register_note' => 'setVendorBusinessRegisterNote',
        'billing_name' => 'setBillingName',
        'billing_reg_number' => 'setBillingRegNumber',
        'billing_tax_number' => 'setBillingTaxNumber',
        'billing_address' => 'setBillingAddress',
        'items' => 'setItems'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'company' => 'getCompany',
        'security_level' => 'getSecurityLevel',
        'owner' => 'getOwner',
        'title' => 'getTitle',
        'variable_symbol' => 'getVariableSymbol',
        'constant_symbol' => 'getConstantSymbol',
        'specific_symbol' => 'getSpecificSymbol',
        'currency' => 'getCurrency',
        'due_date' => 'getDueDate',
        'issue_date' => 'getIssueDate',
        'taxable_supply_date' => 'getTaxableSupplyDate',
        'invoice_type' => 'getInvoiceType',
        'payment_term_days' => 'getPaymentTermDays',
        'payment_type' => 'getPaymentType',
        'business_case' => 'getBusinessCase',
        'note' => 'getNote',
        'delivery_note' => 'getDeliveryNote',
        'private_note' => 'getPrivateNote',
        'vendor_name' => 'getVendorName',
        'vendor_reg_number' => 'getVendorRegNumber',
        'vendor_tax_number' => 'getVendorTaxNumber',
        'vendor_address' => 'getVendorAddress',
        'vendor_email' => 'getVendorEmail',
        'vendor_fax' => 'getVendorFax',
        'vendor_phone_number' => 'getVendorPhoneNumber',
        'vendor_website' => 'getVendorWebsite',
        'vendor_bank_name' => 'getVendorBankName',
        'vendor_bank_account_number' => 'getVendorBankAccountNumber',
        'vendor_bank_iban' => 'getVendorBankIban',
        'vendor_bank_swift' => 'getVendorBankSwift',
        'vendor_business_register_note' => 'getVendorBusinessRegisterNote',
        'billing_name' => 'getBillingName',
        'billing_reg_number' => 'getBillingRegNumber',
        'billing_tax_number' => 'getBillingTaxNumber',
        'billing_address' => 'getBillingAddress',
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
        $this->setIfExists('owner', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('variable_symbol', $data ?? [], null);
        $this->setIfExists('constant_symbol', $data ?? [], null);
        $this->setIfExists('specific_symbol', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('due_date', $data ?? [], null);
        $this->setIfExists('issue_date', $data ?? [], null);
        $this->setIfExists('taxable_supply_date', $data ?? [], null);
        $this->setIfExists('invoice_type', $data ?? [], null);
        $this->setIfExists('payment_term_days', $data ?? [], null);
        $this->setIfExists('payment_type', $data ?? [], null);
        $this->setIfExists('business_case', $data ?? [], null);
        $this->setIfExists('note', $data ?? [], null);
        $this->setIfExists('delivery_note', $data ?? [], null);
        $this->setIfExists('private_note', $data ?? [], null);
        $this->setIfExists('vendor_name', $data ?? [], null);
        $this->setIfExists('vendor_reg_number', $data ?? [], null);
        $this->setIfExists('vendor_tax_number', $data ?? [], null);
        $this->setIfExists('vendor_address', $data ?? [], null);
        $this->setIfExists('vendor_email', $data ?? [], null);
        $this->setIfExists('vendor_fax', $data ?? [], null);
        $this->setIfExists('vendor_phone_number', $data ?? [], null);
        $this->setIfExists('vendor_website', $data ?? [], null);
        $this->setIfExists('vendor_bank_name', $data ?? [], null);
        $this->setIfExists('vendor_bank_account_number', $data ?? [], null);
        $this->setIfExists('vendor_bank_iban', $data ?? [], null);
        $this->setIfExists('vendor_bank_swift', $data ?? [], null);
        $this->setIfExists('vendor_business_register_note', $data ?? [], null);
        $this->setIfExists('billing_name', $data ?? [], null);
        $this->setIfExists('billing_reg_number', $data ?? [], null);
        $this->setIfExists('billing_tax_number', $data ?? [], null);
        $this->setIfExists('billing_address', $data ?? [], null);
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

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_type', must be one of '%s'",
                $this->container['invoice_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!is_null($this->container['payment_type']) && !in_array($this->container['payment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_type', must be one of '%s'",
                $this->container['payment_type'],
                implode("', '", $allowedValues)
            );
        }

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
     * @param int|null $company [Klient] Klient kterému se bude fakturovat
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
     * Gets variable_symbol
     *
     * @return string|null
     */
    public function getVariableSymbol()
    {
        return $this->container['variable_symbol'];
    }

    /**
     * Sets variable_symbol
     *
     * @param string|null $variable_symbol [Variabilní symbol]
     *
     * @return self
     */
    public function setVariableSymbol($variable_symbol)
    {
        if (is_null($variable_symbol)) {
            throw new \InvalidArgumentException('non-nullable variable_symbol cannot be null');
        }
        $this->container['variable_symbol'] = $variable_symbol;

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
     * @return int|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param int|null $currency [Měna] ID záznamu z číselníku Currency
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
     * @return string|null
     */
    public function getDueDate()
    {
        return $this->container['due_date'];
    }

    /**
     * Sets due_date
     *
     * @param string|null $due_date [Datum splatnosti]
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
     * @return string|null
     */
    public function getIssueDate()
    {
        return $this->container['issue_date'];
    }

    /**
     * Sets issue_date
     *
     * @param string|null $issue_date [Datum vystavení]
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
     * Gets taxable_supply_date
     *
     * @return string|null
     */
    public function getTaxableSupplyDate()
    {
        return $this->container['taxable_supply_date'];
    }

    /**
     * Sets taxable_supply_date
     *
     * @param string|null $taxable_supply_date [Datum zdanitelného plnění]
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
     * Gets invoice_type
     *
     * @return string|null
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string|null $invoice_type [Typ faktury]
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
     * @return float|null
     */
    public function getPaymentTermDays()
    {
        return $this->container['payment_term_days'];
    }

    /**
     * Sets payment_term_days
     *
     * @param float|null $payment_term_days [Splatnost]
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
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string|null $payment_type [Způsob úhrady]
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
     * @param int|null $business_case [Obchodní případ] ID záznamu obchodního případu. Není kontrolována integrita Klient - Obchodní případ - Faktura (tzn. faktura může být na jiného klienta než OP).
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
     * Gets vendor_name
     *
     * @return string|null
     */
    public function getVendorName()
    {
        return $this->container['vendor_name'];
    }

    /**
     * Sets vendor_name
     *
     * @param string|null $vendor_name [Dodavatel - Jméno klienta]
     *
     * @return self
     */
    public function setVendorName($vendor_name)
    {
        if (is_null($vendor_name)) {
            throw new \InvalidArgumentException('non-nullable vendor_name cannot be null');
        }
        $this->container['vendor_name'] = $vendor_name;

        return $this;
    }

    /**
     * Gets vendor_reg_number
     *
     * @return string|null
     */
    public function getVendorRegNumber()
    {
        return $this->container['vendor_reg_number'];
    }

    /**
     * Sets vendor_reg_number
     *
     * @param string|null $vendor_reg_number [Dodavatel - IČ]
     *
     * @return self
     */
    public function setVendorRegNumber($vendor_reg_number)
    {
        if (is_null($vendor_reg_number)) {
            throw new \InvalidArgumentException('non-nullable vendor_reg_number cannot be null');
        }
        $this->container['vendor_reg_number'] = $vendor_reg_number;

        return $this;
    }

    /**
     * Gets vendor_tax_number
     *
     * @return string|null
     */
    public function getVendorTaxNumber()
    {
        return $this->container['vendor_tax_number'];
    }

    /**
     * Sets vendor_tax_number
     *
     * @param string|null $vendor_tax_number [Dodavatel - DIČ]
     *
     * @return self
     */
    public function setVendorTaxNumber($vendor_tax_number)
    {
        if (is_null($vendor_tax_number)) {
            throw new \InvalidArgumentException('non-nullable vendor_tax_number cannot be null');
        }
        $this->container['vendor_tax_number'] = $vendor_tax_number;

        return $this;
    }

    /**
     * Gets vendor_address
     *
     * @return \RaynetApiClient\Model\InvoiceEditDtoVendorAddress|null
     */
    public function getVendorAddress()
    {
        return $this->container['vendor_address'];
    }

    /**
     * Sets vendor_address
     *
     * @param \RaynetApiClient\Model\InvoiceEditDtoVendorAddress|null $vendor_address vendor_address
     *
     * @return self
     */
    public function setVendorAddress($vendor_address)
    {
        if (is_null($vendor_address)) {
            throw new \InvalidArgumentException('non-nullable vendor_address cannot be null');
        }
        $this->container['vendor_address'] = $vendor_address;

        return $this;
    }

    /**
     * Gets vendor_email
     *
     * @return string|null
     */
    public function getVendorEmail()
    {
        return $this->container['vendor_email'];
    }

    /**
     * Sets vendor_email
     *
     * @param string|null $vendor_email [Dodavatel - Email]
     *
     * @return self
     */
    public function setVendorEmail($vendor_email)
    {
        if (is_null($vendor_email)) {
            throw new \InvalidArgumentException('non-nullable vendor_email cannot be null');
        }
        $this->container['vendor_email'] = $vendor_email;

        return $this;
    }

    /**
     * Gets vendor_fax
     *
     * @return string|null
     */
    public function getVendorFax()
    {
        return $this->container['vendor_fax'];
    }

    /**
     * Sets vendor_fax
     *
     * @param string|null $vendor_fax [Dodavatel - Fax]
     *
     * @return self
     */
    public function setVendorFax($vendor_fax)
    {
        if (is_null($vendor_fax)) {
            throw new \InvalidArgumentException('non-nullable vendor_fax cannot be null');
        }
        $this->container['vendor_fax'] = $vendor_fax;

        return $this;
    }

    /**
     * Gets vendor_phone_number
     *
     * @return string|null
     */
    public function getVendorPhoneNumber()
    {
        return $this->container['vendor_phone_number'];
    }

    /**
     * Sets vendor_phone_number
     *
     * @param string|null $vendor_phone_number [Dodavatel - Telefon]
     *
     * @return self
     */
    public function setVendorPhoneNumber($vendor_phone_number)
    {
        if (is_null($vendor_phone_number)) {
            throw new \InvalidArgumentException('non-nullable vendor_phone_number cannot be null');
        }
        $this->container['vendor_phone_number'] = $vendor_phone_number;

        return $this;
    }

    /**
     * Gets vendor_website
     *
     * @return string|null
     */
    public function getVendorWebsite()
    {
        return $this->container['vendor_website'];
    }

    /**
     * Sets vendor_website
     *
     * @param string|null $vendor_website [Dodavatel - Web]
     *
     * @return self
     */
    public function setVendorWebsite($vendor_website)
    {
        if (is_null($vendor_website)) {
            throw new \InvalidArgumentException('non-nullable vendor_website cannot be null');
        }
        $this->container['vendor_website'] = $vendor_website;

        return $this;
    }

    /**
     * Gets vendor_bank_name
     *
     * @return string|null
     */
    public function getVendorBankName()
    {
        return $this->container['vendor_bank_name'];
    }

    /**
     * Sets vendor_bank_name
     *
     * @param string|null $vendor_bank_name [Dodavatel - Název banky]
     *
     * @return self
     */
    public function setVendorBankName($vendor_bank_name)
    {
        if (is_null($vendor_bank_name)) {
            throw new \InvalidArgumentException('non-nullable vendor_bank_name cannot be null');
        }
        $this->container['vendor_bank_name'] = $vendor_bank_name;

        return $this;
    }

    /**
     * Gets vendor_bank_account_number
     *
     * @return string|null
     */
    public function getVendorBankAccountNumber()
    {
        return $this->container['vendor_bank_account_number'];
    }

    /**
     * Sets vendor_bank_account_number
     *
     * @param string|null $vendor_bank_account_number [Dodavatel - Číslo účtu]
     *
     * @return self
     */
    public function setVendorBankAccountNumber($vendor_bank_account_number)
    {
        if (is_null($vendor_bank_account_number)) {
            throw new \InvalidArgumentException('non-nullable vendor_bank_account_number cannot be null');
        }
        $this->container['vendor_bank_account_number'] = $vendor_bank_account_number;

        return $this;
    }

    /**
     * Gets vendor_bank_iban
     *
     * @return string|null
     */
    public function getVendorBankIban()
    {
        return $this->container['vendor_bank_iban'];
    }

    /**
     * Sets vendor_bank_iban
     *
     * @param string|null $vendor_bank_iban [Dodavatel - IBAN]
     *
     * @return self
     */
    public function setVendorBankIban($vendor_bank_iban)
    {
        if (is_null($vendor_bank_iban)) {
            throw new \InvalidArgumentException('non-nullable vendor_bank_iban cannot be null');
        }
        $this->container['vendor_bank_iban'] = $vendor_bank_iban;

        return $this;
    }

    /**
     * Gets vendor_bank_swift
     *
     * @return string|null
     */
    public function getVendorBankSwift()
    {
        return $this->container['vendor_bank_swift'];
    }

    /**
     * Sets vendor_bank_swift
     *
     * @param string|null $vendor_bank_swift [Dodavatel - SWIFT]
     *
     * @return self
     */
    public function setVendorBankSwift($vendor_bank_swift)
    {
        if (is_null($vendor_bank_swift)) {
            throw new \InvalidArgumentException('non-nullable vendor_bank_swift cannot be null');
        }
        $this->container['vendor_bank_swift'] = $vendor_bank_swift;

        return $this;
    }

    /**
     * Gets vendor_business_register_note
     *
     * @return string|null
     */
    public function getVendorBusinessRegisterNote()
    {
        return $this->container['vendor_business_register_note'];
    }

    /**
     * Sets vendor_business_register_note
     *
     * @param string|null $vendor_business_register_note [Dodavatel - Zapsán v rejstříku]
     *
     * @return self
     */
    public function setVendorBusinessRegisterNote($vendor_business_register_note)
    {
        if (is_null($vendor_business_register_note)) {
            throw new \InvalidArgumentException('non-nullable vendor_business_register_note cannot be null');
        }
        $this->container['vendor_business_register_note'] = $vendor_business_register_note;

        return $this;
    }

    /**
     * Gets billing_name
     *
     * @return string|null
     */
    public function getBillingName()
    {
        return $this->container['billing_name'];
    }

    /**
     * Sets billing_name
     *
     * @param string|null $billing_name [Odběratel - Jméno klienta]
     *
     * @return self
     */
    public function setBillingName($billing_name)
    {
        if (is_null($billing_name)) {
            throw new \InvalidArgumentException('non-nullable billing_name cannot be null');
        }
        $this->container['billing_name'] = $billing_name;

        return $this;
    }

    /**
     * Gets billing_reg_number
     *
     * @return string|null
     */
    public function getBillingRegNumber()
    {
        return $this->container['billing_reg_number'];
    }

    /**
     * Sets billing_reg_number
     *
     * @param string|null $billing_reg_number [Odběratel - IČ]
     *
     * @return self
     */
    public function setBillingRegNumber($billing_reg_number)
    {
        if (is_null($billing_reg_number)) {
            throw new \InvalidArgumentException('non-nullable billing_reg_number cannot be null');
        }
        $this->container['billing_reg_number'] = $billing_reg_number;

        return $this;
    }

    /**
     * Gets billing_tax_number
     *
     * @return string|null
     */
    public function getBillingTaxNumber()
    {
        return $this->container['billing_tax_number'];
    }

    /**
     * Sets billing_tax_number
     *
     * @param string|null $billing_tax_number [Odběratel - DIČ]
     *
     * @return self
     */
    public function setBillingTaxNumber($billing_tax_number)
    {
        if (is_null($billing_tax_number)) {
            throw new \InvalidArgumentException('non-nullable billing_tax_number cannot be null');
        }
        $this->container['billing_tax_number'] = $billing_tax_number;

        return $this;
    }

    /**
     * Gets billing_address
     *
     * @return \RaynetApiClient\Model\InvoiceEditDtoBillingAddress|null
     */
    public function getBillingAddress()
    {
        return $this->container['billing_address'];
    }

    /**
     * Sets billing_address
     *
     * @param \RaynetApiClient\Model\InvoiceEditDtoBillingAddress|null $billing_address billing_address
     *
     * @return self
     */
    public function setBillingAddress($billing_address)
    {
        if (is_null($billing_address)) {
            throw new \InvalidArgumentException('non-nullable billing_address cannot be null');
        }
        $this->container['billing_address'] = $billing_address;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \RaynetApiClient\Model\InvoiceEditDtoItemsInner[]|null
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \RaynetApiClient\Model\InvoiceEditDtoItemsInner[]|null $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        if (is_null($items)) {
            throw new \InvalidArgumentException('non-nullable items cannot be null');
        }


        if ((count($items) < 1)) {
            throw new \InvalidArgumentException('invalid length for $items when calling InvoiceEditDto., number of items must be greater than or equal to 1.');
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


