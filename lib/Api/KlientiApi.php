<?php
/**
 * KlientiApi
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

namespace RaynetApiClient\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use RaynetApiClient\ApiException;
use RaynetApiClient\Configuration;
use RaynetApiClient\HeaderSelector;
use RaynetApiClient\ObjectSerializer;

/**
 * KlientiApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class KlientiApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'companyAddressDelete' => [
            'application/json',
        ],
        'companyAddressEdit' => [
            'application/json',
        ],
        'companyAddressInsert' => [
            'application/json',
        ],
        'companyAddressSetContactEdit' => [
            'application/json',
        ],
        'companyAddressSetPrimaryEdit' => [
            'application/json',
        ],
        'companyAnonymizeEdit' => [
            'application/json',
        ],
        'companyDelete' => [
            'application/json',
        ],
        'companyDetailGet' => [
            'application/json',
        ],
        'companyEdit' => [
            'application/json',
        ],
        'companyGet' => [
            'application/json',
        ],
        'companyInsert' => [
            'application/json',
        ],
        'companyInvalidEdit' => [
            'application/json',
        ],
        'companyLockEdit' => [
            'application/json',
        ],
        'companyMergeEdit' => [
            'application/json',
        ],
        'companyRelationshipDelete' => [
            'application/json',
        ],
        'companyRelationshipDetailGet' => [
            'application/json',
        ],
        'companyRelationshipEdit' => [
            'application/json',
        ],
        'companyRelationshipInsert' => [
            'application/json',
        ],
        'companyTagDelete' => [
            'application/json',
        ],
        'companyTagInsert' => [
            'application/json',
        ],
        'companyUnlockEdit' => [
            'application/json',
        ],
        'companyValidEdit' => [
            'application/json',
        ],
    ];

/**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation companyAddressDelete
     *
     * smazání adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyAddressDelete($company_id, $address_id, string $contentType = self::contentTypes['companyAddressDelete'][0])
    {
        $this->companyAddressDeleteWithHttpInfo($company_id, $address_id, $contentType);
    }

    /**
     * Operation companyAddressDeleteWithHttpInfo
     *
     * smazání adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAddressDeleteWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressDelete'][0])
    {
        $request = $this->companyAddressDeleteRequest($company_id, $address_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyAddressDeleteAsync
     *
     * smazání adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressDeleteAsync($company_id, $address_id, string $contentType = self::contentTypes['companyAddressDelete'][0])
    {
        return $this->companyAddressDeleteAsyncWithHttpInfo($company_id, $address_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAddressDeleteAsyncWithHttpInfo
     *
     * smazání adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressDeleteAsyncWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressDelete'][0])
    {
        $returnType = '';
        $request = $this->companyAddressDeleteRequest($company_id, $address_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAddressDelete'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAddressDeleteRequest($company_id, $address_id, string $contentType = self::contentTypes['companyAddressDelete'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAddressDelete'
            );
        }

        // verify the required parameter 'address_id' is set
        if ($address_id === null || (is_array($address_id) && count($address_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address_id when calling companyAddressDelete'
            );
        }


        $resourcePath = '/company/{companyId}/address/{addressId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($address_id !== null) {
            $resourcePath = str_replace(
                '{' . 'addressId' . '}',
                ObjectSerializer::toPathValue($address_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyAddressEdit
     *
     * upravení adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  \RaynetApiClient\Model\CompanyAddressEditDto $company_address_edit_dto company_address_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyAddressEdit($company_id, $address_id, $company_address_edit_dto = null, string $contentType = self::contentTypes['companyAddressEdit'][0])
    {
        $this->companyAddressEditWithHttpInfo($company_id, $address_id, $company_address_edit_dto, $contentType);
    }

    /**
     * Operation companyAddressEditWithHttpInfo
     *
     * upravení adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  \RaynetApiClient\Model\CompanyAddressEditDto $company_address_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAddressEditWithHttpInfo($company_id, $address_id, $company_address_edit_dto = null, string $contentType = self::contentTypes['companyAddressEdit'][0])
    {
        $request = $this->companyAddressEditRequest($company_id, $address_id, $company_address_edit_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyAddressEditAsync
     *
     * upravení adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  \RaynetApiClient\Model\CompanyAddressEditDto $company_address_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressEditAsync($company_id, $address_id, $company_address_edit_dto = null, string $contentType = self::contentTypes['companyAddressEdit'][0])
    {
        return $this->companyAddressEditAsyncWithHttpInfo($company_id, $address_id, $company_address_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAddressEditAsyncWithHttpInfo
     *
     * upravení adresy klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  \RaynetApiClient\Model\CompanyAddressEditDto $company_address_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressEditAsyncWithHttpInfo($company_id, $address_id, $company_address_edit_dto = null, string $contentType = self::contentTypes['companyAddressEdit'][0])
    {
        $returnType = '';
        $request = $this->companyAddressEditRequest($company_id, $address_id, $company_address_edit_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAddressEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  \RaynetApiClient\Model\CompanyAddressEditDto $company_address_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAddressEditRequest($company_id, $address_id, $company_address_edit_dto = null, string $contentType = self::contentTypes['companyAddressEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAddressEdit'
            );
        }

        // verify the required parameter 'address_id' is set
        if ($address_id === null || (is_array($address_id) && count($address_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address_id when calling companyAddressEdit'
            );
        }



        $resourcePath = '/company/{companyId}/address/{addressId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($address_id !== null) {
            $resourcePath = str_replace(
                '{' . 'addressId' . '}',
                ObjectSerializer::toPathValue($address_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_address_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_address_edit_dto));
            } else {
                $httpBody = $company_address_edit_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyAddressInsert
     *
     * přidání adresy ke klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyAddressInsertDto $company_address_insert_dto company_address_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function companyAddressInsert($company_id, $company_address_insert_dto = null, string $contentType = self::contentTypes['companyAddressInsert'][0])
    {
        list($response) = $this->companyAddressInsertWithHttpInfo($company_id, $company_address_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation companyAddressInsertWithHttpInfo
     *
     * přidání adresy ke klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyAddressInsertDto $company_address_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAddressInsertWithHttpInfo($company_id, $company_address_insert_dto = null, string $contentType = self::contentTypes['companyAddressInsert'][0])
    {
        $request = $this->companyAddressInsertRequest($company_id, $company_address_insert_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\RaynetApiClient\Model\Insert201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\Insert201Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\Insert201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\Insert201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RaynetApiClient\Model\Insert201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation companyAddressInsertAsync
     *
     * přidání adresy ke klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyAddressInsertDto $company_address_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressInsertAsync($company_id, $company_address_insert_dto = null, string $contentType = self::contentTypes['companyAddressInsert'][0])
    {
        return $this->companyAddressInsertAsyncWithHttpInfo($company_id, $company_address_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAddressInsertAsyncWithHttpInfo
     *
     * přidání adresy ke klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyAddressInsertDto $company_address_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressInsertAsyncWithHttpInfo($company_id, $company_address_insert_dto = null, string $contentType = self::contentTypes['companyAddressInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->companyAddressInsertRequest($company_id, $company_address_insert_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAddressInsert'
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyAddressInsertDto $company_address_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAddressInsertRequest($company_id, $company_address_insert_dto = null, string $contentType = self::contentTypes['companyAddressInsert'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAddressInsert'
            );
        }



        $resourcePath = '/company/{companyId}/address/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_address_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_address_insert_dto));
            } else {
                $httpBody = $company_address_insert_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyAddressSetContactEdit
     *
     * nastavení kontaktní adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetContactEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyAddressSetContactEdit($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetContactEdit'][0])
    {
        $this->companyAddressSetContactEditWithHttpInfo($company_id, $address_id, $contentType);
    }

    /**
     * Operation companyAddressSetContactEditWithHttpInfo
     *
     * nastavení kontaktní adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetContactEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAddressSetContactEditWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetContactEdit'][0])
    {
        $request = $this->companyAddressSetContactEditRequest($company_id, $address_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyAddressSetContactEditAsync
     *
     * nastavení kontaktní adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetContactEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressSetContactEditAsync($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetContactEdit'][0])
    {
        return $this->companyAddressSetContactEditAsyncWithHttpInfo($company_id, $address_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAddressSetContactEditAsyncWithHttpInfo
     *
     * nastavení kontaktní adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetContactEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressSetContactEditAsyncWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetContactEdit'][0])
    {
        $returnType = '';
        $request = $this->companyAddressSetContactEditRequest($company_id, $address_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAddressSetContactEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetContactEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAddressSetContactEditRequest($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetContactEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAddressSetContactEdit'
            );
        }

        // verify the required parameter 'address_id' is set
        if ($address_id === null || (is_array($address_id) && count($address_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address_id when calling companyAddressSetContactEdit'
            );
        }


        $resourcePath = '/company/{companyId}/address/{addressId}/setContact/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($address_id !== null) {
            $resourcePath = str_replace(
                '{' . 'addressId' . '}',
                ObjectSerializer::toPathValue($address_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyAddressSetPrimaryEdit
     *
     * nastavení primární adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyAddressSetPrimaryEdit($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetPrimaryEdit'][0])
    {
        $this->companyAddressSetPrimaryEditWithHttpInfo($company_id, $address_id, $contentType);
    }

    /**
     * Operation companyAddressSetPrimaryEditWithHttpInfo
     *
     * nastavení primární adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAddressSetPrimaryEditWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetPrimaryEdit'][0])
    {
        $request = $this->companyAddressSetPrimaryEditRequest($company_id, $address_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyAddressSetPrimaryEditAsync
     *
     * nastavení primární adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressSetPrimaryEditAsync($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetPrimaryEdit'][0])
    {
        return $this->companyAddressSetPrimaryEditAsyncWithHttpInfo($company_id, $address_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAddressSetPrimaryEditAsyncWithHttpInfo
     *
     * nastavení primární adresy
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAddressSetPrimaryEditAsyncWithHttpInfo($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetPrimaryEdit'][0])
    {
        $returnType = '';
        $request = $this->companyAddressSetPrimaryEditRequest($company_id, $address_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAddressSetPrimaryEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $address_id ID adresy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAddressSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAddressSetPrimaryEditRequest($company_id, $address_id, string $contentType = self::contentTypes['companyAddressSetPrimaryEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAddressSetPrimaryEdit'
            );
        }

        // verify the required parameter 'address_id' is set
        if ($address_id === null || (is_array($address_id) && count($address_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address_id when calling companyAddressSetPrimaryEdit'
            );
        }


        $resourcePath = '/company/{companyId}/address/{addressId}/setPrimary/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($address_id !== null) {
            $resourcePath = str_replace(
                '{' . 'addressId' . '}',
                ObjectSerializer::toPathValue($address_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyAnonymizeEdit
     *
     * GDPR anonymize klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyAnonymizeEdit($company_id, string $contentType = self::contentTypes['companyAnonymizeEdit'][0])
    {
        $this->companyAnonymizeEditWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyAnonymizeEditWithHttpInfo
     *
     * GDPR anonymize klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyAnonymizeEditWithHttpInfo($company_id, string $contentType = self::contentTypes['companyAnonymizeEdit'][0])
    {
        $request = $this->companyAnonymizeEditRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyAnonymizeEditAsync
     *
     * GDPR anonymize klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAnonymizeEditAsync($company_id, string $contentType = self::contentTypes['companyAnonymizeEdit'][0])
    {
        return $this->companyAnonymizeEditAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyAnonymizeEditAsyncWithHttpInfo
     *
     * GDPR anonymize klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyAnonymizeEditAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyAnonymizeEdit'][0])
    {
        $returnType = '';
        $request = $this->companyAnonymizeEditRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyAnonymizeEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyAnonymizeEditRequest($company_id, string $contentType = self::contentTypes['companyAnonymizeEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyAnonymizeEdit'
            );
        }


        $resourcePath = '/company/{companyId}/anonymize/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyDelete
     *
     * smazání klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyDelete($company_id, string $contentType = self::contentTypes['companyDelete'][0])
    {
        $this->companyDeleteWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyDeleteWithHttpInfo
     *
     * smazání klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyDeleteWithHttpInfo($company_id, string $contentType = self::contentTypes['companyDelete'][0])
    {
        $request = $this->companyDeleteRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyDeleteAsync
     *
     * smazání klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyDeleteAsync($company_id, string $contentType = self::contentTypes['companyDelete'][0])
    {
        return $this->companyDeleteAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyDeleteAsyncWithHttpInfo
     *
     * smazání klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyDeleteAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyDelete'][0])
    {
        $returnType = '';
        $request = $this->companyDeleteRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyDelete'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyDeleteRequest($company_id, string $contentType = self::contentTypes['companyDelete'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyDelete'
            );
        }


        $resourcePath = '/company/{companyId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyDetailGet
     *
     * detail klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyDetailGet($company_id, string $contentType = self::contentTypes['companyDetailGet'][0])
    {
        $this->companyDetailGetWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyDetailGetWithHttpInfo
     *
     * detail klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyDetailGetWithHttpInfo($company_id, string $contentType = self::contentTypes['companyDetailGet'][0])
    {
        $request = $this->companyDetailGetRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyDetailGetAsync
     *
     * detail klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyDetailGetAsync($company_id, string $contentType = self::contentTypes['companyDetailGet'][0])
    {
        return $this->companyDetailGetAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyDetailGetAsyncWithHttpInfo
     *
     * detail klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyDetailGetAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyDetailGet'][0])
    {
        $returnType = '';
        $request = $this->companyDetailGetRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyDetailGet'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyDetailGetRequest($company_id, string $contentType = self::contentTypes['companyDetailGet'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyDetailGet'
            );
        }


        $resourcePath = '/company/{companyId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyEdit
     *
     * upravení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyEditDto $company_edit_dto company_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyEdit($company_id, $company_edit_dto = null, string $contentType = self::contentTypes['companyEdit'][0])
    {
        $this->companyEditWithHttpInfo($company_id, $company_edit_dto, $contentType);
    }

    /**
     * Operation companyEditWithHttpInfo
     *
     * upravení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyEditDto $company_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyEditWithHttpInfo($company_id, $company_edit_dto = null, string $contentType = self::contentTypes['companyEdit'][0])
    {
        $request = $this->companyEditRequest($company_id, $company_edit_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyEditAsync
     *
     * upravení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyEditDto $company_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyEditAsync($company_id, $company_edit_dto = null, string $contentType = self::contentTypes['companyEdit'][0])
    {
        return $this->companyEditAsyncWithHttpInfo($company_id, $company_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyEditAsyncWithHttpInfo
     *
     * upravení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyEditDto $company_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyEditAsyncWithHttpInfo($company_id, $company_edit_dto = null, string $contentType = self::contentTypes['companyEdit'][0])
    {
        $returnType = '';
        $request = $this->companyEditRequest($company_id, $company_edit_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyEditDto $company_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyEditRequest($company_id, $company_edit_dto = null, string $contentType = self::contentTypes['companyEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyEdit'
            );
        }



        $resourcePath = '/company/{companyId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_edit_dto));
            } else {
                $httpBody = $company_edit_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyGet
     *
     * seznam klientů
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených klientů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $name Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. (optional)
     * @param  string $last_name Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  bool $person Filtrování klientů podle příznaku Jedná se o fyzickou osobu (optional)
     * @param  string $reg_number Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; (optional)
     * @param  int $owner Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $rating Filtrování klientů podle Ratingu (optional)
     * @param  string $role Filtrování klientů podle Role (optional)
     * @param  string $state Filtrování klientů podle Stavu (optional)
     * @param  int $category Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $economy_activity Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification1 Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification2 Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification3 Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $primary_address_contact_info_email Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary_address_contact_info_email2 Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $gdpr_template Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $name = null, $last_name = null, $person = null, $reg_number = null, $owner = null, $rating = null, $role = null, $state = null, $category = null, $economy_activity = null, $company_classification1 = null, $company_classification2 = null, $company_classification3 = null, $primary_address_contact_info_email = null, $primary_address_contact_info_email2 = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['companyGet'][0])
    {
        $this->companyGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);
    }

    /**
     * Operation companyGetWithHttpInfo
     *
     * seznam klientů
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených klientů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $name Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. (optional)
     * @param  string $last_name Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  bool $person Filtrování klientů podle příznaku Jedná se o fyzickou osobu (optional)
     * @param  string $reg_number Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; (optional)
     * @param  int $owner Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $rating Filtrování klientů podle Ratingu (optional)
     * @param  string $role Filtrování klientů podle Role (optional)
     * @param  string $state Filtrování klientů podle Stavu (optional)
     * @param  int $category Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $economy_activity Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification1 Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification2 Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification3 Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $primary_address_contact_info_email Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary_address_contact_info_email2 Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $gdpr_template Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $name = null, $last_name = null, $person = null, $reg_number = null, $owner = null, $rating = null, $role = null, $state = null, $category = null, $economy_activity = null, $company_classification1 = null, $company_classification2 = null, $company_classification3 = null, $primary_address_contact_info_email = null, $primary_address_contact_info_email2 = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['companyGet'][0])
    {
        $request = $this->companyGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyGetAsync
     *
     * seznam klientů
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených klientů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $name Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. (optional)
     * @param  string $last_name Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  bool $person Filtrování klientů podle příznaku Jedná se o fyzickou osobu (optional)
     * @param  string $reg_number Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; (optional)
     * @param  int $owner Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $rating Filtrování klientů podle Ratingu (optional)
     * @param  string $role Filtrování klientů podle Role (optional)
     * @param  string $state Filtrování klientů podle Stavu (optional)
     * @param  int $category Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $economy_activity Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification1 Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification2 Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification3 Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $primary_address_contact_info_email Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary_address_contact_info_email2 Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $gdpr_template Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $name = null, $last_name = null, $person = null, $reg_number = null, $owner = null, $rating = null, $role = null, $state = null, $category = null, $economy_activity = null, $company_classification1 = null, $company_classification2 = null, $company_classification3 = null, $primary_address_contact_info_email = null, $primary_address_contact_info_email2 = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['companyGet'][0])
    {
        return $this->companyGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyGetAsyncWithHttpInfo
     *
     * seznam klientů
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených klientů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $name Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. (optional)
     * @param  string $last_name Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  bool $person Filtrování klientů podle příznaku Jedná se o fyzickou osobu (optional)
     * @param  string $reg_number Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; (optional)
     * @param  int $owner Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $rating Filtrování klientů podle Ratingu (optional)
     * @param  string $role Filtrování klientů podle Role (optional)
     * @param  string $state Filtrování klientů podle Stavu (optional)
     * @param  int $category Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $economy_activity Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification1 Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification2 Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification3 Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $primary_address_contact_info_email Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary_address_contact_info_email2 Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $gdpr_template Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $name = null, $last_name = null, $person = null, $reg_number = null, $owner = null, $rating = null, $role = null, $state = null, $category = null, $economy_activity = null, $company_classification1 = null, $company_classification2 = null, $company_classification3 = null, $primary_address_contact_info_email = null, $primary_address_contact_info_email2 = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['companyGet'][0])
    {
        $returnType = '';
        $request = $this->companyGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $name, $last_name, $person, $reg_number, $owner, $rating, $role, $state, $category, $economy_activity, $company_classification1, $company_classification2, $company_classification3, $primary_address_contact_info_email, $primary_address_contact_info_email2, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených klientů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $name Filtrování klientů podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60;. (optional)
     * @param  string $last_name Filtrování klientů podle příjmení fyzické osoby. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  bool $person Filtrování klientů podle příznaku Jedná se o fyzickou osobu (optional)
     * @param  string $reg_number Filtrování klientů podle IČ. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. Například: pro seznam všech klientů se zadaným IČ je nutné zadat &#x60;regNumber[NE]&#x3D;null&#x60; (optional)
     * @param  int $owner Filtrování klientů podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $rating Filtrování klientů podle Ratingu (optional)
     * @param  string $role Filtrování klientů podle Role (optional)
     * @param  string $state Filtrování klientů podle Stavu (optional)
     * @param  int $category Filtrování klientů podle ID kategorie (CompanyCategory). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $economy_activity Filtrování klientů podle ID oboru (EconomyActivity). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification1 Filtrování klientů podle ID klasifikace 1 (CompanyClassification1). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification2 Filtrování klientů podle ID klasifikace 2 (CompanyClassification2). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  int $company_classification3 Filtrování klientů podle ID klasifikace 3 (CompanyClassification3). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $primary_address_contact_info_email Filtrování klientů podle emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary_address_contact_info_email2 Filtrování klientů podle druhého emailu u primární adresy. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování klientů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování klientů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování klientů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných klientů. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $gdpr_template Filtrování klientů podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování klientů, kteří nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. &#x60;api/v2/company?withoutGdpr[CUSTOM]&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $name = null, $last_name = null, $person = null, $reg_number = null, $owner = null, $rating = null, $role = null, $state = null, $category = null, $economy_activity = null, $company_classification1 = null, $company_classification2 = null, $company_classification3 = null, $primary_address_contact_info_email = null, $primary_address_contact_info_email2 = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['companyGet'][0])
    {






























        $resourcePath = '/company/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $offset,
            'offset', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort_column,
            'sortColumn', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort_direction,
            'sortDirection', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fulltext,
            'fulltext', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $last_name,
            'lastName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $person,
            'person', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $reg_number,
            'regNumber', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $owner,
            'owner', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $rating,
            'rating', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $role,
            'role', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $state,
            'state', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $category,
            'category', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $economy_activity,
            'economyActivity', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $company_classification1,
            'companyClassification1', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $company_classification2,
            'companyClassification2', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $company_classification3,
            'companyClassification3', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $primary_address_contact_info_email,
            'primaryAddress-contactInfo.email', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $primary_address_contact_info_email2,
            'primaryAddress-contactInfo.email2', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $row_info_created_at,
            'rowInfo.createdAt', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $row_info_updated_at,
            'rowInfo.updatedAt', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $row_info_last_modified_at,
            'rowInfo.lastModifiedAt', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $row_info_row_access,
            'rowInfo.rowAccess', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $gdpr_template,
            'gdprTemplate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $without_gdpr,
            'withoutGdpr', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $view,
            'view', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tags,
            'tags', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyInsert
     *
     * nový klient
     *
     * @param  \RaynetApiClient\Model\CompanyInsertDto $company_insert_dto company_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function companyInsert($company_insert_dto = null, string $contentType = self::contentTypes['companyInsert'][0])
    {
        list($response) = $this->companyInsertWithHttpInfo($company_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation companyInsertWithHttpInfo
     *
     * nový klient
     *
     * @param  \RaynetApiClient\Model\CompanyInsertDto $company_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyInsertWithHttpInfo($company_insert_dto = null, string $contentType = self::contentTypes['companyInsert'][0])
    {
        $request = $this->companyInsertRequest($company_insert_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\RaynetApiClient\Model\Insert201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\Insert201Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\Insert201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\Insert201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RaynetApiClient\Model\Insert201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation companyInsertAsync
     *
     * nový klient
     *
     * @param  \RaynetApiClient\Model\CompanyInsertDto $company_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyInsertAsync($company_insert_dto = null, string $contentType = self::contentTypes['companyInsert'][0])
    {
        return $this->companyInsertAsyncWithHttpInfo($company_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyInsertAsyncWithHttpInfo
     *
     * nový klient
     *
     * @param  \RaynetApiClient\Model\CompanyInsertDto $company_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyInsertAsyncWithHttpInfo($company_insert_dto = null, string $contentType = self::contentTypes['companyInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->companyInsertRequest($company_insert_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyInsert'
     *
     * @param  \RaynetApiClient\Model\CompanyInsertDto $company_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyInsertRequest($company_insert_dto = null, string $contentType = self::contentTypes['companyInsert'][0])
    {



        $resourcePath = '/company/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_insert_dto));
            } else {
                $httpBody = $company_insert_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyInvalidEdit
     *
     * zneplatnění klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyInvalidEdit($company_id, string $contentType = self::contentTypes['companyInvalidEdit'][0])
    {
        $this->companyInvalidEditWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyInvalidEditWithHttpInfo
     *
     * zneplatnění klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyInvalidEditWithHttpInfo($company_id, string $contentType = self::contentTypes['companyInvalidEdit'][0])
    {
        $request = $this->companyInvalidEditRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyInvalidEditAsync
     *
     * zneplatnění klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyInvalidEditAsync($company_id, string $contentType = self::contentTypes['companyInvalidEdit'][0])
    {
        return $this->companyInvalidEditAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyInvalidEditAsyncWithHttpInfo
     *
     * zneplatnění klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyInvalidEditAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyInvalidEdit'][0])
    {
        $returnType = '';
        $request = $this->companyInvalidEditRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyInvalidEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyInvalidEditRequest($company_id, string $contentType = self::contentTypes['companyInvalidEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyInvalidEdit'
            );
        }


        $resourcePath = '/company/{companyId}/invalid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyLockEdit
     *
     * uzamčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyLockEdit($company_id, string $contentType = self::contentTypes['companyLockEdit'][0])
    {
        $this->companyLockEditWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyLockEditWithHttpInfo
     *
     * uzamčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyLockEditWithHttpInfo($company_id, string $contentType = self::contentTypes['companyLockEdit'][0])
    {
        $request = $this->companyLockEditRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyLockEditAsync
     *
     * uzamčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyLockEditAsync($company_id, string $contentType = self::contentTypes['companyLockEdit'][0])
    {
        return $this->companyLockEditAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyLockEditAsyncWithHttpInfo
     *
     * uzamčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyLockEditAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyLockEdit'][0])
    {
        $returnType = '';
        $request = $this->companyLockEditRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyLockEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyLockEditRequest($company_id, string $contentType = self::contentTypes['companyLockEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyLockEdit'
            );
        }


        $resourcePath = '/company/{companyId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyMergeEdit
     *
     * Sloučení duplicitního klienta
     *
     * @param  int $company_id ID cílového klienta, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_company_id ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyMergeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyMergeEdit($company_id, $source_company_id, string $contentType = self::contentTypes['companyMergeEdit'][0])
    {
        $this->companyMergeEditWithHttpInfo($company_id, $source_company_id, $contentType);
    }

    /**
     * Operation companyMergeEditWithHttpInfo
     *
     * Sloučení duplicitního klienta
     *
     * @param  int $company_id ID cílového klienta, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_company_id ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyMergeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyMergeEditWithHttpInfo($company_id, $source_company_id, string $contentType = self::contentTypes['companyMergeEdit'][0])
    {
        $request = $this->companyMergeEditRequest($company_id, $source_company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyMergeEditAsync
     *
     * Sloučení duplicitního klienta
     *
     * @param  int $company_id ID cílového klienta, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_company_id ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyMergeEditAsync($company_id, $source_company_id, string $contentType = self::contentTypes['companyMergeEdit'][0])
    {
        return $this->companyMergeEditAsyncWithHttpInfo($company_id, $source_company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyMergeEditAsyncWithHttpInfo
     *
     * Sloučení duplicitního klienta
     *
     * @param  int $company_id ID cílového klienta, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_company_id ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyMergeEditAsyncWithHttpInfo($company_id, $source_company_id, string $contentType = self::contentTypes['companyMergeEdit'][0])
    {
        $returnType = '';
        $request = $this->companyMergeEditRequest($company_id, $source_company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyMergeEdit'
     *
     * @param  int $company_id ID cílového klienta, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_company_id ID zdrojového klienta, který bude sloučen s cílovým klientem a následně smazán (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyMergeEditRequest($company_id, $source_company_id, string $contentType = self::contentTypes['companyMergeEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyMergeEdit'
            );
        }

        // verify the required parameter 'source_company_id' is set
        if ($source_company_id === null || (is_array($source_company_id) && count($source_company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_company_id when calling companyMergeEdit'
            );
        }


        $resourcePath = '/company/{companyId}/merge/{sourceCompanyId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($source_company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourceCompanyId' . '}',
                ObjectSerializer::toPathValue($source_company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyRelationshipDelete
     *
     * smazání propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vazby s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyRelationshipDelete($company_id, $relationship_id, string $contentType = self::contentTypes['companyRelationshipDelete'][0])
    {
        $this->companyRelationshipDeleteWithHttpInfo($company_id, $relationship_id, $contentType);
    }

    /**
     * Operation companyRelationshipDeleteWithHttpInfo
     *
     * smazání propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vazby s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyRelationshipDeleteWithHttpInfo($company_id, $relationship_id, string $contentType = self::contentTypes['companyRelationshipDelete'][0])
    {
        $request = $this->companyRelationshipDeleteRequest($company_id, $relationship_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyRelationshipDeleteAsync
     *
     * smazání propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vazby s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipDeleteAsync($company_id, $relationship_id, string $contentType = self::contentTypes['companyRelationshipDelete'][0])
    {
        return $this->companyRelationshipDeleteAsyncWithHttpInfo($company_id, $relationship_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyRelationshipDeleteAsyncWithHttpInfo
     *
     * smazání propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vazby s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipDeleteAsyncWithHttpInfo($company_id, $relationship_id, string $contentType = self::contentTypes['companyRelationshipDelete'][0])
    {
        $returnType = '';
        $request = $this->companyRelationshipDeleteRequest($company_id, $relationship_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyRelationshipDelete'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vazby s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyRelationshipDeleteRequest($company_id, $relationship_id, string $contentType = self::contentTypes['companyRelationshipDelete'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyRelationshipDelete'
            );
        }

        // verify the required parameter 'relationship_id' is set
        if ($relationship_id === null || (is_array($relationship_id) && count($relationship_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $relationship_id when calling companyRelationshipDelete'
            );
        }


        $resourcePath = '/company/{companyId}/relationship/{relationshipId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($relationship_id !== null) {
            $resourcePath = str_replace(
                '{' . 'relationshipId' . '}',
                ObjectSerializer::toPathValue($relationship_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyRelationshipDetailGet
     *
     * Propojení na jiné klienty
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyRelationshipDetailGet($company_id, string $contentType = self::contentTypes['companyRelationshipDetailGet'][0])
    {
        $this->companyRelationshipDetailGetWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyRelationshipDetailGetWithHttpInfo
     *
     * Propojení na jiné klienty
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyRelationshipDetailGetWithHttpInfo($company_id, string $contentType = self::contentTypes['companyRelationshipDetailGet'][0])
    {
        $request = $this->companyRelationshipDetailGetRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyRelationshipDetailGetAsync
     *
     * Propojení na jiné klienty
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipDetailGetAsync($company_id, string $contentType = self::contentTypes['companyRelationshipDetailGet'][0])
    {
        return $this->companyRelationshipDetailGetAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyRelationshipDetailGetAsyncWithHttpInfo
     *
     * Propojení na jiné klienty
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipDetailGetAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyRelationshipDetailGet'][0])
    {
        $returnType = '';
        $request = $this->companyRelationshipDetailGetRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyRelationshipDetailGet'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyRelationshipDetailGetRequest($company_id, string $contentType = self::contentTypes['companyRelationshipDetailGet'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyRelationshipDetailGet'
            );
        }


        $resourcePath = '/company/{companyId}/relationship/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyRelationshipEdit
     *
     * upravení propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vztahu s jiným klientem (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipEditDto $company_relationship_edit_dto company_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyRelationshipEdit($company_id, $relationship_id, $company_relationship_edit_dto = null, string $contentType = self::contentTypes['companyRelationshipEdit'][0])
    {
        $this->companyRelationshipEditWithHttpInfo($company_id, $relationship_id, $company_relationship_edit_dto, $contentType);
    }

    /**
     * Operation companyRelationshipEditWithHttpInfo
     *
     * upravení propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vztahu s jiným klientem (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipEditDto $company_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyRelationshipEditWithHttpInfo($company_id, $relationship_id, $company_relationship_edit_dto = null, string $contentType = self::contentTypes['companyRelationshipEdit'][0])
    {
        $request = $this->companyRelationshipEditRequest($company_id, $relationship_id, $company_relationship_edit_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyRelationshipEditAsync
     *
     * upravení propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vztahu s jiným klientem (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipEditDto $company_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipEditAsync($company_id, $relationship_id, $company_relationship_edit_dto = null, string $contentType = self::contentTypes['companyRelationshipEdit'][0])
    {
        return $this->companyRelationshipEditAsyncWithHttpInfo($company_id, $relationship_id, $company_relationship_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyRelationshipEditAsyncWithHttpInfo
     *
     * upravení propojení na jiného klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vztahu s jiným klientem (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipEditDto $company_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipEditAsyncWithHttpInfo($company_id, $relationship_id, $company_relationship_edit_dto = null, string $contentType = self::contentTypes['companyRelationshipEdit'][0])
    {
        $returnType = '';
        $request = $this->companyRelationshipEditRequest($company_id, $relationship_id, $company_relationship_edit_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyRelationshipEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  int $relationship_id ID vztahu s jiným klientem (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipEditDto $company_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyRelationshipEditRequest($company_id, $relationship_id, $company_relationship_edit_dto = null, string $contentType = self::contentTypes['companyRelationshipEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyRelationshipEdit'
            );
        }

        // verify the required parameter 'relationship_id' is set
        if ($relationship_id === null || (is_array($relationship_id) && count($relationship_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $relationship_id when calling companyRelationshipEdit'
            );
        }



        $resourcePath = '/company/{companyId}/relationship/{relationshipId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }
        // path params
        if ($relationship_id !== null) {
            $resourcePath = str_replace(
                '{' . 'relationshipId' . '}',
                ObjectSerializer::toPathValue($relationship_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_relationship_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_relationship_edit_dto));
            } else {
                $httpBody = $company_relationship_edit_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyRelationshipInsert
     *
     * přidání propojení na klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipInsertDto $company_relationship_insert_dto company_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function companyRelationshipInsert($company_id, $company_relationship_insert_dto = null, string $contentType = self::contentTypes['companyRelationshipInsert'][0])
    {
        list($response) = $this->companyRelationshipInsertWithHttpInfo($company_id, $company_relationship_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation companyRelationshipInsertWithHttpInfo
     *
     * přidání propojení na klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipInsertDto $company_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyRelationshipInsertWithHttpInfo($company_id, $company_relationship_insert_dto = null, string $contentType = self::contentTypes['companyRelationshipInsert'][0])
    {
        $request = $this->companyRelationshipInsertRequest($company_id, $company_relationship_insert_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\RaynetApiClient\Model\Insert201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\Insert201Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\Insert201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\Insert201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RaynetApiClient\Model\Insert201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation companyRelationshipInsertAsync
     *
     * přidání propojení na klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipInsertDto $company_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipInsertAsync($company_id, $company_relationship_insert_dto = null, string $contentType = self::contentTypes['companyRelationshipInsert'][0])
    {
        return $this->companyRelationshipInsertAsyncWithHttpInfo($company_id, $company_relationship_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyRelationshipInsertAsyncWithHttpInfo
     *
     * přidání propojení na klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipInsertDto $company_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyRelationshipInsertAsyncWithHttpInfo($company_id, $company_relationship_insert_dto = null, string $contentType = self::contentTypes['companyRelationshipInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->companyRelationshipInsertRequest($company_id, $company_relationship_insert_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyRelationshipInsert'
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyRelationshipInsertDto $company_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyRelationshipInsertRequest($company_id, $company_relationship_insert_dto = null, string $contentType = self::contentTypes['companyRelationshipInsert'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyRelationshipInsert'
            );
        }



        $resourcePath = '/company/{companyId}/relationship/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_relationship_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_relationship_insert_dto));
            } else {
                $httpBody = $company_relationship_insert_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyTagDelete
     *
     * smazání TAGu z Klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagDeleteDto $company_tag_delete_dto company_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyTagDelete($company_id, $company_tag_delete_dto = null, string $contentType = self::contentTypes['companyTagDelete'][0])
    {
        $this->companyTagDeleteWithHttpInfo($company_id, $company_tag_delete_dto, $contentType);
    }

    /**
     * Operation companyTagDeleteWithHttpInfo
     *
     * smazání TAGu z Klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagDeleteDto $company_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyTagDeleteWithHttpInfo($company_id, $company_tag_delete_dto = null, string $contentType = self::contentTypes['companyTagDelete'][0])
    {
        $request = $this->companyTagDeleteRequest($company_id, $company_tag_delete_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyTagDeleteAsync
     *
     * smazání TAGu z Klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagDeleteDto $company_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyTagDeleteAsync($company_id, $company_tag_delete_dto = null, string $contentType = self::contentTypes['companyTagDelete'][0])
    {
        return $this->companyTagDeleteAsyncWithHttpInfo($company_id, $company_tag_delete_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyTagDeleteAsyncWithHttpInfo
     *
     * smazání TAGu z Klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagDeleteDto $company_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyTagDeleteAsyncWithHttpInfo($company_id, $company_tag_delete_dto = null, string $contentType = self::contentTypes['companyTagDelete'][0])
    {
        $returnType = '';
        $request = $this->companyTagDeleteRequest($company_id, $company_tag_delete_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyTagDelete'
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagDeleteDto $company_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyTagDeleteRequest($company_id, $company_tag_delete_dto = null, string $contentType = self::contentTypes['companyTagDelete'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyTagDelete'
            );
        }



        $resourcePath = '/company/{companyId}/tag/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_tag_delete_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_tag_delete_dto));
            } else {
                $httpBody = $company_tag_delete_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyTagInsert
     *
     * přidání TAGu ke Klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagInsertDto $company_tag_insert_dto company_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyTagInsert($company_id, $company_tag_insert_dto = null, string $contentType = self::contentTypes['companyTagInsert'][0])
    {
        $this->companyTagInsertWithHttpInfo($company_id, $company_tag_insert_dto, $contentType);
    }

    /**
     * Operation companyTagInsertWithHttpInfo
     *
     * přidání TAGu ke Klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagInsertDto $company_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyTagInsertWithHttpInfo($company_id, $company_tag_insert_dto = null, string $contentType = self::contentTypes['companyTagInsert'][0])
    {
        $request = $this->companyTagInsertRequest($company_id, $company_tag_insert_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyTagInsertAsync
     *
     * přidání TAGu ke Klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagInsertDto $company_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyTagInsertAsync($company_id, $company_tag_insert_dto = null, string $contentType = self::contentTypes['companyTagInsert'][0])
    {
        return $this->companyTagInsertAsyncWithHttpInfo($company_id, $company_tag_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyTagInsertAsyncWithHttpInfo
     *
     * přidání TAGu ke Klientovi
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagInsertDto $company_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyTagInsertAsyncWithHttpInfo($company_id, $company_tag_insert_dto = null, string $contentType = self::contentTypes['companyTagInsert'][0])
    {
        $returnType = '';
        $request = $this->companyTagInsertRequest($company_id, $company_tag_insert_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyTagInsert'
     *
     * @param  int $company_id ID klienta (required)
     * @param  \RaynetApiClient\Model\CompanyTagInsertDto $company_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyTagInsertRequest($company_id, $company_tag_insert_dto = null, string $contentType = self::contentTypes['companyTagInsert'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyTagInsert'
            );
        }



        $resourcePath = '/company/{companyId}/tag/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($company_tag_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($company_tag_insert_dto));
            } else {
                $httpBody = $company_tag_insert_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyUnlockEdit
     *
     * odemčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyUnlockEdit($company_id, string $contentType = self::contentTypes['companyUnlockEdit'][0])
    {
        $this->companyUnlockEditWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyUnlockEditWithHttpInfo
     *
     * odemčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyUnlockEditWithHttpInfo($company_id, string $contentType = self::contentTypes['companyUnlockEdit'][0])
    {
        $request = $this->companyUnlockEditRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyUnlockEditAsync
     *
     * odemčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyUnlockEditAsync($company_id, string $contentType = self::contentTypes['companyUnlockEdit'][0])
    {
        return $this->companyUnlockEditAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyUnlockEditAsyncWithHttpInfo
     *
     * odemčení klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyUnlockEditAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->companyUnlockEditRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyUnlockEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyUnlockEditRequest($company_id, string $contentType = self::contentTypes['companyUnlockEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyUnlockEdit'
            );
        }


        $resourcePath = '/company/{companyId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation companyValidEdit
     *
     * obnovení platnosti klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function companyValidEdit($company_id, string $contentType = self::contentTypes['companyValidEdit'][0])
    {
        $this->companyValidEditWithHttpInfo($company_id, $contentType);
    }

    /**
     * Operation companyValidEditWithHttpInfo
     *
     * obnovení platnosti klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function companyValidEditWithHttpInfo($company_id, string $contentType = self::contentTypes['companyValidEdit'][0])
    {
        $request = $this->companyValidEditRequest($company_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation companyValidEditAsync
     *
     * obnovení platnosti klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyValidEditAsync($company_id, string $contentType = self::contentTypes['companyValidEdit'][0])
    {
        return $this->companyValidEditAsyncWithHttpInfo($company_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation companyValidEditAsyncWithHttpInfo
     *
     * obnovení platnosti klienta
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function companyValidEditAsyncWithHttpInfo($company_id, string $contentType = self::contentTypes['companyValidEdit'][0])
    {
        $returnType = '';
        $request = $this->companyValidEditRequest($company_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'companyValidEdit'
     *
     * @param  int $company_id ID klienta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['companyValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function companyValidEditRequest($company_id, string $contentType = self::contentTypes['companyValidEdit'][0])
    {

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling companyValidEdit'
            );
        }


        $resourcePath = '/company/{companyId}/valid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($company_id !== null) {
            $resourcePath = str_replace(
                '{' . 'companyId' . '}',
                ObjectSerializer::toPathValue($company_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Instance-Name');
        if ($apiKey !== null) {
            $headers['X-Instance-Name'] = $apiKey;
        }
        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
