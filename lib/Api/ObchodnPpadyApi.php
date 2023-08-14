<?php
/**
 * ObchodnPpadyApi
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
 * ObchodnPpadyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObchodnPpadyApi
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
        'businessCaseCreateWithItemsInsert' => [
            'application/json',
        ],
        'businessCaseDelete' => [
            'application/json',
        ],
        'businessCaseDetailGet' => [
            'application/json',
        ],
        'businessCaseEdit' => [
            'application/json',
        ],
        'businessCaseGet' => [
            'application/json',
        ],
        'businessCaseInsert' => [
            'application/json',
        ],
        'businessCaseInvalidEdit' => [
            'application/json',
        ],
        'businessCaseItemDelete' => [
            'application/json',
        ],
        'businessCaseItemEdit' => [
            'application/json',
        ],
        'businessCaseItemInsert' => [
            'application/json',
        ],
        'businessCaseLockEdit' => [
            'application/json',
        ],
        'businessCaseParticipantsDelete' => [
            'application/json',
        ],
        'businessCaseParticipantsDetailGet' => [
            'application/json',
        ],
        'businessCaseParticipantsInsert' => [
            'application/json',
        ],
        'businessCasePdfExportDetailGet' => [
            'application/json',
        ],
        'businessCasePhaseChangesDetailGet' => [
            'application/json',
        ],
        'businessCaseUnlockEdit' => [
            'application/json',
        ],
        'businessCaseValidEdit' => [
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
     * Operation businessCaseCreateWithItemsInsert
     *
     * nový OP s produkty
     *
     * @param  \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto $business_case_create_with_items_insert_dto business_case_create_with_items_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseCreateWithItemsInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function businessCaseCreateWithItemsInsert($business_case_create_with_items_insert_dto = null, string $contentType = self::contentTypes['businessCaseCreateWithItemsInsert'][0])
    {
        list($response) = $this->businessCaseCreateWithItemsInsertWithHttpInfo($business_case_create_with_items_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation businessCaseCreateWithItemsInsertWithHttpInfo
     *
     * nový OP s produkty
     *
     * @param  \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto $business_case_create_with_items_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseCreateWithItemsInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseCreateWithItemsInsertWithHttpInfo($business_case_create_with_items_insert_dto = null, string $contentType = self::contentTypes['businessCaseCreateWithItemsInsert'][0])
    {
        $request = $this->businessCaseCreateWithItemsInsertRequest($business_case_create_with_items_insert_dto, $contentType);

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
     * Operation businessCaseCreateWithItemsInsertAsync
     *
     * nový OP s produkty
     *
     * @param  \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto $business_case_create_with_items_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseCreateWithItemsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseCreateWithItemsInsertAsync($business_case_create_with_items_insert_dto = null, string $contentType = self::contentTypes['businessCaseCreateWithItemsInsert'][0])
    {
        return $this->businessCaseCreateWithItemsInsertAsyncWithHttpInfo($business_case_create_with_items_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseCreateWithItemsInsertAsyncWithHttpInfo
     *
     * nový OP s produkty
     *
     * @param  \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto $business_case_create_with_items_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseCreateWithItemsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseCreateWithItemsInsertAsyncWithHttpInfo($business_case_create_with_items_insert_dto = null, string $contentType = self::contentTypes['businessCaseCreateWithItemsInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->businessCaseCreateWithItemsInsertRequest($business_case_create_with_items_insert_dto, $contentType);

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
     * Create request for operation 'businessCaseCreateWithItemsInsert'
     *
     * @param  \RaynetApiClient\Model\BusinessCaseCreateWithItemsInsertDto $business_case_create_with_items_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseCreateWithItemsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseCreateWithItemsInsertRequest($business_case_create_with_items_insert_dto = null, string $contentType = self::contentTypes['businessCaseCreateWithItemsInsert'][0])
    {



        $resourcePath = '/businessCase/createWithItems';
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
        if (isset($business_case_create_with_items_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_create_with_items_insert_dto));
            } else {
                $httpBody = $business_case_create_with_items_insert_dto;
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
     * Operation businessCaseDelete
     *
     * smazání OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseDelete($business_case_id, string $contentType = self::contentTypes['businessCaseDelete'][0])
    {
        $this->businessCaseDeleteWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseDeleteWithHttpInfo
     *
     * smazání OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseDeleteWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseDelete'][0])
    {
        $request = $this->businessCaseDeleteRequest($business_case_id, $contentType);

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
     * Operation businessCaseDeleteAsync
     *
     * smazání OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseDeleteAsync($business_case_id, string $contentType = self::contentTypes['businessCaseDelete'][0])
    {
        return $this->businessCaseDeleteAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseDeleteAsyncWithHttpInfo
     *
     * smazání OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseDeleteAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseDelete'][0])
    {
        $returnType = '';
        $request = $this->businessCaseDeleteRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseDelete'
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseDeleteRequest($business_case_id, string $contentType = self::contentTypes['businessCaseDelete'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseDelete'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseDetailGet
     *
     * detail OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseDetailGet($business_case_id, string $contentType = self::contentTypes['businessCaseDetailGet'][0])
    {
        $this->businessCaseDetailGetWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseDetailGetWithHttpInfo
     *
     * detail OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseDetailGetWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseDetailGet'][0])
    {
        $request = $this->businessCaseDetailGetRequest($business_case_id, $contentType);

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
     * Operation businessCaseDetailGetAsync
     *
     * detail OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseDetailGetAsync($business_case_id, string $contentType = self::contentTypes['businessCaseDetailGet'][0])
    {
        return $this->businessCaseDetailGetAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseDetailGetAsyncWithHttpInfo
     *
     * detail OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseDetailGetAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseDetailGet'][0])
    {
        $returnType = '';
        $request = $this->businessCaseDetailGetRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseDetailGet'
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseDetailGetRequest($business_case_id, string $contentType = self::contentTypes['businessCaseDetailGet'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseDetailGet'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseEdit
     *
     * upravení OP
     *
     * @param  int $business_case_id ID obchodniho pripadu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseEditDto $business_case_edit_dto business_case_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseEdit($business_case_id, $business_case_edit_dto = null, string $contentType = self::contentTypes['businessCaseEdit'][0])
    {
        $this->businessCaseEditWithHttpInfo($business_case_id, $business_case_edit_dto, $contentType);
    }

    /**
     * Operation businessCaseEditWithHttpInfo
     *
     * upravení OP
     *
     * @param  int $business_case_id ID obchodniho pripadu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseEditDto $business_case_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseEditWithHttpInfo($business_case_id, $business_case_edit_dto = null, string $contentType = self::contentTypes['businessCaseEdit'][0])
    {
        $request = $this->businessCaseEditRequest($business_case_id, $business_case_edit_dto, $contentType);

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
     * Operation businessCaseEditAsync
     *
     * upravení OP
     *
     * @param  int $business_case_id ID obchodniho pripadu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseEditDto $business_case_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseEditAsync($business_case_id, $business_case_edit_dto = null, string $contentType = self::contentTypes['businessCaseEdit'][0])
    {
        return $this->businessCaseEditAsyncWithHttpInfo($business_case_id, $business_case_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseEditAsyncWithHttpInfo
     *
     * upravení OP
     *
     * @param  int $business_case_id ID obchodniho pripadu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseEditDto $business_case_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseEditAsyncWithHttpInfo($business_case_id, $business_case_edit_dto = null, string $contentType = self::contentTypes['businessCaseEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseEditRequest($business_case_id, $business_case_edit_dto, $contentType);

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
     * Create request for operation 'businessCaseEdit'
     *
     * @param  int $business_case_id ID obchodniho pripadu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseEditDto $business_case_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseEditRequest($business_case_id, $business_case_edit_dto = null, string $contentType = self::contentTypes['businessCaseEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseEdit'
            );
        }



        $resourcePath = '/businessCase/{businessCaseId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($business_case_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_edit_dto));
            } else {
                $httpBody = $business_case_edit_dto;
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
     * Operation businessCaseGet
     *
     * seznam OP
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $project Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) (optional)
     * @param  int $category Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) (optional)
     * @param  int $owner Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $valid_from Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $scheduled_end Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP (optional)
     * @param  int $business_case_phase Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $business_case_type Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $project = null, $category = null, $owner = null, $valid_from = null, $valid_till = null, $scheduled_end = null, $status = null, $business_case_phase = null, $business_case_type = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, string $contentType = self::contentTypes['businessCaseGet'][0])
    {
        $this->businessCaseGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $contentType);
    }

    /**
     * Operation businessCaseGetWithHttpInfo
     *
     * seznam OP
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $project Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) (optional)
     * @param  int $category Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) (optional)
     * @param  int $owner Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $valid_from Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $scheduled_end Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP (optional)
     * @param  int $business_case_phase Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $business_case_type Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $project = null, $category = null, $owner = null, $valid_from = null, $valid_till = null, $scheduled_end = null, $status = null, $business_case_phase = null, $business_case_type = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, string $contentType = self::contentTypes['businessCaseGet'][0])
    {
        $request = $this->businessCaseGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $contentType);

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
     * Operation businessCaseGetAsync
     *
     * seznam OP
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $project Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) (optional)
     * @param  int $category Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) (optional)
     * @param  int $owner Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $valid_from Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $scheduled_end Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP (optional)
     * @param  int $business_case_phase Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $business_case_type Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $project = null, $category = null, $owner = null, $valid_from = null, $valid_till = null, $scheduled_end = null, $status = null, $business_case_phase = null, $business_case_type = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, string $contentType = self::contentTypes['businessCaseGet'][0])
    {
        return $this->businessCaseGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseGetAsyncWithHttpInfo
     *
     * seznam OP
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $project Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) (optional)
     * @param  int $category Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) (optional)
     * @param  int $owner Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $valid_from Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $scheduled_end Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP (optional)
     * @param  int $business_case_phase Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $business_case_type Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $project = null, $category = null, $owner = null, $valid_from = null, $valid_till = null, $scheduled_end = null, $status = null, $business_case_phase = null, $business_case_type = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, string $contentType = self::contentTypes['businessCaseGet'][0])
    {
        $returnType = '';
        $request = $this->businessCaseGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $project, $category, $owner, $valid_from, $valid_till, $scheduled_end, $status, $business_case_phase, $business_case_type, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $contentType);

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
     * Create request for operation 'businessCaseGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování OP podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování OP podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování OP podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $project Filtrování OP podle projektu. Filtruje se podle jednoznačného identifikátoru projektu (id) (optional)
     * @param  int $category Filtrování OP podle kategorie (BusinessCaseCategory). Filtruje se podle jednoznačného identifikátoru kategorie (id) (optional)
     * @param  int $owner Filtrování OP podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $valid_from Filtrování OP podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování OP podle data uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $scheduled_end Filtrování OP podle data odhad uzavření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené OP,  - &#x60;E_WIN&#x60; vyhrané OP,  - &#x60;F_LOST&#x60; prohrané OP, - &#x60;G_STORNO&#x60; stornované OP (optional)
     * @param  int $business_case_phase Filtrování OP podle stavu (BusinessCasePhase). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $business_case_type Filtrování OP podle typu obchodního případu (BusinessCaseType). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování OP podle produktu. Pokud OP obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování OP podle kategorie produktu. Pokud OP obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování OP podle produktové řady produktu. Pokud OP obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování OP podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování OP podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných OP. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $project = null, $category = null, $owner = null, $valid_from = null, $valid_till = null, $scheduled_end = null, $status = null, $business_case_phase = null, $business_case_type = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, string $contentType = self::contentTypes['businessCaseGet'][0])
    {



























        $resourcePath = '/businessCase/';
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
            $code,
            'code', // param base name
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
            $company,
            'company', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $project,
            'project', // param base name
            'integer', // openApiType
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
            $owner,
            'owner', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $valid_from,
            'validFrom', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $valid_till,
            'validTill', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $scheduled_end,
            'scheduledEnd', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $status,
            'status', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $business_case_phase,
            'businessCasePhase', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $business_case_type,
            'businessCaseType', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $contains_product,
            'containsProduct', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $product_category,
            'productCategory', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $product_line,
            'productLine', // param base name
            'integer', // openApiType
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
            $view,
            'view', // param base name
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
     * Operation businessCaseInsert
     *
     * nový OP
     *
     * @param  \RaynetApiClient\Model\BusinessCaseInsertDto $business_case_insert_dto business_case_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function businessCaseInsert($business_case_insert_dto = null, string $contentType = self::contentTypes['businessCaseInsert'][0])
    {
        list($response) = $this->businessCaseInsertWithHttpInfo($business_case_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation businessCaseInsertWithHttpInfo
     *
     * nový OP
     *
     * @param  \RaynetApiClient\Model\BusinessCaseInsertDto $business_case_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseInsertWithHttpInfo($business_case_insert_dto = null, string $contentType = self::contentTypes['businessCaseInsert'][0])
    {
        $request = $this->businessCaseInsertRequest($business_case_insert_dto, $contentType);

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
     * Operation businessCaseInsertAsync
     *
     * nový OP
     *
     * @param  \RaynetApiClient\Model\BusinessCaseInsertDto $business_case_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseInsertAsync($business_case_insert_dto = null, string $contentType = self::contentTypes['businessCaseInsert'][0])
    {
        return $this->businessCaseInsertAsyncWithHttpInfo($business_case_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseInsertAsyncWithHttpInfo
     *
     * nový OP
     *
     * @param  \RaynetApiClient\Model\BusinessCaseInsertDto $business_case_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseInsertAsyncWithHttpInfo($business_case_insert_dto = null, string $contentType = self::contentTypes['businessCaseInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->businessCaseInsertRequest($business_case_insert_dto, $contentType);

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
     * Create request for operation 'businessCaseInsert'
     *
     * @param  \RaynetApiClient\Model\BusinessCaseInsertDto $business_case_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseInsertRequest($business_case_insert_dto = null, string $contentType = self::contentTypes['businessCaseInsert'][0])
    {



        $resourcePath = '/businessCase/';
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
        if (isset($business_case_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_insert_dto));
            } else {
                $httpBody = $business_case_insert_dto;
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
     * Operation businessCaseInvalidEdit
     *
     * zneplatnění OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseInvalidEdit($business_case_id, string $contentType = self::contentTypes['businessCaseInvalidEdit'][0])
    {
        $this->businessCaseInvalidEditWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseInvalidEditWithHttpInfo
     *
     * zneplatnění OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseInvalidEditWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseInvalidEdit'][0])
    {
        $request = $this->businessCaseInvalidEditRequest($business_case_id, $contentType);

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
     * Operation businessCaseInvalidEditAsync
     *
     * zneplatnění OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseInvalidEditAsync($business_case_id, string $contentType = self::contentTypes['businessCaseInvalidEdit'][0])
    {
        return $this->businessCaseInvalidEditAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseInvalidEditAsyncWithHttpInfo
     *
     * zneplatnění OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseInvalidEditAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseInvalidEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseInvalidEditRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseInvalidEdit'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseInvalidEditRequest($business_case_id, string $contentType = self::contentTypes['businessCaseInvalidEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseInvalidEdit'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/invalid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseItemDelete
     *
     * smazání položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseItemDelete($business_case_id, $business_case_item_id, string $contentType = self::contentTypes['businessCaseItemDelete'][0])
    {
        $this->businessCaseItemDeleteWithHttpInfo($business_case_id, $business_case_item_id, $contentType);
    }

    /**
     * Operation businessCaseItemDeleteWithHttpInfo
     *
     * smazání položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseItemDeleteWithHttpInfo($business_case_id, $business_case_item_id, string $contentType = self::contentTypes['businessCaseItemDelete'][0])
    {
        $request = $this->businessCaseItemDeleteRequest($business_case_id, $business_case_item_id, $contentType);

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
     * Operation businessCaseItemDeleteAsync
     *
     * smazání položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemDeleteAsync($business_case_id, $business_case_item_id, string $contentType = self::contentTypes['businessCaseItemDelete'][0])
    {
        return $this->businessCaseItemDeleteAsyncWithHttpInfo($business_case_id, $business_case_item_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseItemDeleteAsyncWithHttpInfo
     *
     * smazání položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemDeleteAsyncWithHttpInfo($business_case_id, $business_case_item_id, string $contentType = self::contentTypes['businessCaseItemDelete'][0])
    {
        $returnType = '';
        $request = $this->businessCaseItemDeleteRequest($business_case_id, $business_case_item_id, $contentType);

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
     * Create request for operation 'businessCaseItemDelete'
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseItemDeleteRequest($business_case_id, $business_case_item_id, string $contentType = self::contentTypes['businessCaseItemDelete'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseItemDelete'
            );
        }

        // verify the required parameter 'business_case_item_id' is set
        if ($business_case_item_id === null || (is_array($business_case_item_id) && count($business_case_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_item_id when calling businessCaseItemDelete'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/item/{businessCaseItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }
        // path params
        if ($business_case_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseItemId' . '}',
                ObjectSerializer::toPathValue($business_case_item_id),
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
     * Operation businessCaseItemEdit
     *
     * upravení položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemEditDto $business_case_item_edit_dto business_case_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseItemEdit($business_case_id, $business_case_item_id, $business_case_item_edit_dto = null, string $contentType = self::contentTypes['businessCaseItemEdit'][0])
    {
        $this->businessCaseItemEditWithHttpInfo($business_case_id, $business_case_item_id, $business_case_item_edit_dto, $contentType);
    }

    /**
     * Operation businessCaseItemEditWithHttpInfo
     *
     * upravení položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemEditDto $business_case_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseItemEditWithHttpInfo($business_case_id, $business_case_item_id, $business_case_item_edit_dto = null, string $contentType = self::contentTypes['businessCaseItemEdit'][0])
    {
        $request = $this->businessCaseItemEditRequest($business_case_id, $business_case_item_id, $business_case_item_edit_dto, $contentType);

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
     * Operation businessCaseItemEditAsync
     *
     * upravení položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemEditDto $business_case_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemEditAsync($business_case_id, $business_case_item_id, $business_case_item_edit_dto = null, string $contentType = self::contentTypes['businessCaseItemEdit'][0])
    {
        return $this->businessCaseItemEditAsyncWithHttpInfo($business_case_id, $business_case_item_id, $business_case_item_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseItemEditAsyncWithHttpInfo
     *
     * upravení položky OP
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemEditDto $business_case_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemEditAsyncWithHttpInfo($business_case_id, $business_case_item_id, $business_case_item_edit_dto = null, string $contentType = self::contentTypes['businessCaseItemEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseItemEditRequest($business_case_id, $business_case_item_id, $business_case_item_edit_dto, $contentType);

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
     * Create request for operation 'businessCaseItemEdit'
     *
     * @param  int $business_case_id ID obchodní případy (required)
     * @param  int $business_case_item_id ID položky obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemEditDto $business_case_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseItemEditRequest($business_case_id, $business_case_item_id, $business_case_item_edit_dto = null, string $contentType = self::contentTypes['businessCaseItemEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseItemEdit'
            );
        }

        // verify the required parameter 'business_case_item_id' is set
        if ($business_case_item_id === null || (is_array($business_case_item_id) && count($business_case_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_item_id when calling businessCaseItemEdit'
            );
        }



        $resourcePath = '/businessCase/{businessCaseId}/item/{businessCaseItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }
        // path params
        if ($business_case_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseItemId' . '}',
                ObjectSerializer::toPathValue($business_case_item_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($business_case_item_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_item_edit_dto));
            } else {
                $httpBody = $business_case_item_edit_dto;
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
     * Operation businessCaseItemInsert
     *
     * přidání položek OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemInsertDto $business_case_item_insert_dto business_case_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseItemInsert($business_case_id, $business_case_item_insert_dto = null, string $contentType = self::contentTypes['businessCaseItemInsert'][0])
    {
        $this->businessCaseItemInsertWithHttpInfo($business_case_id, $business_case_item_insert_dto, $contentType);
    }

    /**
     * Operation businessCaseItemInsertWithHttpInfo
     *
     * přidání položek OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemInsertDto $business_case_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseItemInsertWithHttpInfo($business_case_id, $business_case_item_insert_dto = null, string $contentType = self::contentTypes['businessCaseItemInsert'][0])
    {
        $request = $this->businessCaseItemInsertRequest($business_case_id, $business_case_item_insert_dto, $contentType);

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
     * Operation businessCaseItemInsertAsync
     *
     * přidání položek OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemInsertDto $business_case_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemInsertAsync($business_case_id, $business_case_item_insert_dto = null, string $contentType = self::contentTypes['businessCaseItemInsert'][0])
    {
        return $this->businessCaseItemInsertAsyncWithHttpInfo($business_case_id, $business_case_item_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseItemInsertAsyncWithHttpInfo
     *
     * přidání položek OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemInsertDto $business_case_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseItemInsertAsyncWithHttpInfo($business_case_id, $business_case_item_insert_dto = null, string $contentType = self::contentTypes['businessCaseItemInsert'][0])
    {
        $returnType = '';
        $request = $this->businessCaseItemInsertRequest($business_case_id, $business_case_item_insert_dto, $contentType);

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
     * Create request for operation 'businessCaseItemInsert'
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseItemInsertDto $business_case_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseItemInsertRequest($business_case_id, $business_case_item_insert_dto = null, string $contentType = self::contentTypes['businessCaseItemInsert'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseItemInsert'
            );
        }



        $resourcePath = '/businessCase/{businessCaseId}/item/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($business_case_item_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_item_insert_dto));
            } else {
                $httpBody = $business_case_item_insert_dto;
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
     * Operation businessCaseLockEdit
     *
     * uzamčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseLockEdit($business_case_id, string $contentType = self::contentTypes['businessCaseLockEdit'][0])
    {
        $this->businessCaseLockEditWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseLockEditWithHttpInfo
     *
     * uzamčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseLockEditWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseLockEdit'][0])
    {
        $request = $this->businessCaseLockEditRequest($business_case_id, $contentType);

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
     * Operation businessCaseLockEditAsync
     *
     * uzamčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseLockEditAsync($business_case_id, string $contentType = self::contentTypes['businessCaseLockEdit'][0])
    {
        return $this->businessCaseLockEditAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseLockEditAsyncWithHttpInfo
     *
     * uzamčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseLockEditAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseLockEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseLockEditRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseLockEdit'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseLockEditRequest($business_case_id, string $contentType = self::contentTypes['businessCaseLockEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseLockEdit'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseParticipantsDelete
     *
     * smazání participanta z obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  int $participant_id ID participanta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseParticipantsDelete($business_case_id, $participant_id, string $contentType = self::contentTypes['businessCaseParticipantsDelete'][0])
    {
        $this->businessCaseParticipantsDeleteWithHttpInfo($business_case_id, $participant_id, $contentType);
    }

    /**
     * Operation businessCaseParticipantsDeleteWithHttpInfo
     *
     * smazání participanta z obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  int $participant_id ID participanta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseParticipantsDeleteWithHttpInfo($business_case_id, $participant_id, string $contentType = self::contentTypes['businessCaseParticipantsDelete'][0])
    {
        $request = $this->businessCaseParticipantsDeleteRequest($business_case_id, $participant_id, $contentType);

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
     * Operation businessCaseParticipantsDeleteAsync
     *
     * smazání participanta z obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  int $participant_id ID participanta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsDeleteAsync($business_case_id, $participant_id, string $contentType = self::contentTypes['businessCaseParticipantsDelete'][0])
    {
        return $this->businessCaseParticipantsDeleteAsyncWithHttpInfo($business_case_id, $participant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseParticipantsDeleteAsyncWithHttpInfo
     *
     * smazání participanta z obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  int $participant_id ID participanta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsDeleteAsyncWithHttpInfo($business_case_id, $participant_id, string $contentType = self::contentTypes['businessCaseParticipantsDelete'][0])
    {
        $returnType = '';
        $request = $this->businessCaseParticipantsDeleteRequest($business_case_id, $participant_id, $contentType);

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
     * Create request for operation 'businessCaseParticipantsDelete'
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  int $participant_id ID participanta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseParticipantsDeleteRequest($business_case_id, $participant_id, string $contentType = self::contentTypes['businessCaseParticipantsDelete'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseParticipantsDelete'
            );
        }

        // verify the required parameter 'participant_id' is set
        if ($participant_id === null || (is_array($participant_id) && count($participant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $participant_id when calling businessCaseParticipantsDelete'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/participants/{participantId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }
        // path params
        if ($participant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'participantId' . '}',
                ObjectSerializer::toPathValue($participant_id),
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
     * Operation businessCaseParticipantsDetailGet
     *
     * seznam participantů OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $company_name Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (required)
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $note Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $person Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseParticipantsDetailGet($business_case_id, $company_name, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $note = null, $company = null, $person = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['businessCaseParticipantsDetailGet'][0])
    {
        $this->businessCaseParticipantsDetailGetWithHttpInfo($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);
    }

    /**
     * Operation businessCaseParticipantsDetailGetWithHttpInfo
     *
     * seznam participantů OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $company_name Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (required)
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $note Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $person Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseParticipantsDetailGetWithHttpInfo($business_case_id, $company_name, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $note = null, $company = null, $person = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['businessCaseParticipantsDetailGet'][0])
    {
        $request = $this->businessCaseParticipantsDetailGetRequest($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Operation businessCaseParticipantsDetailGetAsync
     *
     * seznam participantů OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $company_name Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (required)
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $note Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $person Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsDetailGetAsync($business_case_id, $company_name, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $note = null, $company = null, $person = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['businessCaseParticipantsDetailGet'][0])
    {
        return $this->businessCaseParticipantsDetailGetAsyncWithHttpInfo($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseParticipantsDetailGetAsyncWithHttpInfo
     *
     * seznam participantů OP
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $company_name Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (required)
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $note Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $person Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsDetailGetAsyncWithHttpInfo($business_case_id, $company_name, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $note = null, $company = null, $person = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['businessCaseParticipantsDetailGet'][0])
    {
        $returnType = '';
        $request = $this->businessCaseParticipantsDetailGetRequest($business_case_id, $company_name, $offset, $limit, $sort_column, $sort_direction, $note, $company, $person, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Create request for operation 'businessCaseParticipantsDetailGet'
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  string $company_name Filtrování participantů OP podle názvu klienta. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (required)
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $note Filtrování participantů OP podle poznámky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování participantů OP podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $person Filtrování participantů OP podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování participantů OP podle data vytvoření participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování participantů OP podle posledního data upravení participanta. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseParticipantsDetailGetRequest($business_case_id, $company_name, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $note = null, $company = null, $person = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['businessCaseParticipantsDetailGet'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseParticipantsDetailGet'
            );
        }

        // verify the required parameter 'company_name' is set
        if ($company_name === null || (is_array($company_name) && count($company_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_name when calling businessCaseParticipantsDetailGet'
            );
        }













        $resourcePath = '/businessCase/{businessCaseId}/participants/';
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
            $note,
            'note', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $company,
            'company', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $company_name,
            'company-name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $person,
            'person', // param base name
            'integer', // openApiType
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
            $view,
            'view', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseParticipantsInsert
     *
     * nový participant obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto $business_case_participants_insert_dto business_case_participants_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function businessCaseParticipantsInsert($business_case_id, $business_case_participants_insert_dto = null, string $contentType = self::contentTypes['businessCaseParticipantsInsert'][0])
    {
        list($response) = $this->businessCaseParticipantsInsertWithHttpInfo($business_case_id, $business_case_participants_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation businessCaseParticipantsInsertWithHttpInfo
     *
     * nový participant obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto $business_case_participants_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseParticipantsInsertWithHttpInfo($business_case_id, $business_case_participants_insert_dto = null, string $contentType = self::contentTypes['businessCaseParticipantsInsert'][0])
    {
        $request = $this->businessCaseParticipantsInsertRequest($business_case_id, $business_case_participants_insert_dto, $contentType);

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
     * Operation businessCaseParticipantsInsertAsync
     *
     * nový participant obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto $business_case_participants_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsInsertAsync($business_case_id, $business_case_participants_insert_dto = null, string $contentType = self::contentTypes['businessCaseParticipantsInsert'][0])
    {
        return $this->businessCaseParticipantsInsertAsyncWithHttpInfo($business_case_id, $business_case_participants_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseParticipantsInsertAsyncWithHttpInfo
     *
     * nový participant obchodního případu
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto $business_case_participants_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseParticipantsInsertAsyncWithHttpInfo($business_case_id, $business_case_participants_insert_dto = null, string $contentType = self::contentTypes['businessCaseParticipantsInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->businessCaseParticipantsInsertRequest($business_case_id, $business_case_participants_insert_dto, $contentType);

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
     * Create request for operation 'businessCaseParticipantsInsert'
     *
     * @param  int $business_case_id ID obchodního případu (required)
     * @param  \RaynetApiClient\Model\BusinessCaseParticipantsInsertDto $business_case_participants_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseParticipantsInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseParticipantsInsertRequest($business_case_id, $business_case_participants_insert_dto = null, string $contentType = self::contentTypes['businessCaseParticipantsInsert'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseParticipantsInsert'
            );
        }



        $resourcePath = '/businessCase/{businessCaseId}/participants/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($business_case_participants_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($business_case_participants_insert_dto));
            } else {
                $httpBody = $business_case_participants_insert_dto;
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
     * Operation businessCasePdfExportDetailGet
     *
     * export OP do PDF
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $locale Jazyk exportovaného obch. případu (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCasePdfExportDetailGet($business_case_id, $locale = null, string $contentType = self::contentTypes['businessCasePdfExportDetailGet'][0])
    {
        $this->businessCasePdfExportDetailGetWithHttpInfo($business_case_id, $locale, $contentType);
    }

    /**
     * Operation businessCasePdfExportDetailGetWithHttpInfo
     *
     * export OP do PDF
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $locale Jazyk exportovaného obch. případu (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCasePdfExportDetailGetWithHttpInfo($business_case_id, $locale = null, string $contentType = self::contentTypes['businessCasePdfExportDetailGet'][0])
    {
        $request = $this->businessCasePdfExportDetailGetRequest($business_case_id, $locale, $contentType);

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
     * Operation businessCasePdfExportDetailGetAsync
     *
     * export OP do PDF
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $locale Jazyk exportovaného obch. případu (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCasePdfExportDetailGetAsync($business_case_id, $locale = null, string $contentType = self::contentTypes['businessCasePdfExportDetailGet'][0])
    {
        return $this->businessCasePdfExportDetailGetAsyncWithHttpInfo($business_case_id, $locale, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCasePdfExportDetailGetAsyncWithHttpInfo
     *
     * export OP do PDF
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $locale Jazyk exportovaného obch. případu (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCasePdfExportDetailGetAsyncWithHttpInfo($business_case_id, $locale = null, string $contentType = self::contentTypes['businessCasePdfExportDetailGet'][0])
    {
        $returnType = '';
        $request = $this->businessCasePdfExportDetailGetRequest($business_case_id, $locale, $contentType);

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
     * Create request for operation 'businessCasePdfExportDetailGet'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $locale Jazyk exportovaného obch. případu (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCasePdfExportDetailGetRequest($business_case_id, $locale = null, string $contentType = self::contentTypes['businessCasePdfExportDetailGet'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCasePdfExportDetailGet'
            );
        }



        $resourcePath = '/businessCase/{businessCaseId}/pdfExport';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $locale,
            'locale', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCasePhaseChangesDetailGet
     *
     * changelog změn stavů OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePhaseChangesDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCasePhaseChangesDetailGet($business_case_id, string $contentType = self::contentTypes['businessCasePhaseChangesDetailGet'][0])
    {
        $this->businessCasePhaseChangesDetailGetWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCasePhaseChangesDetailGetWithHttpInfo
     *
     * changelog změn stavů OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePhaseChangesDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCasePhaseChangesDetailGetWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCasePhaseChangesDetailGet'][0])
    {
        $request = $this->businessCasePhaseChangesDetailGetRequest($business_case_id, $contentType);

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
     * Operation businessCasePhaseChangesDetailGetAsync
     *
     * changelog změn stavů OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePhaseChangesDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCasePhaseChangesDetailGetAsync($business_case_id, string $contentType = self::contentTypes['businessCasePhaseChangesDetailGet'][0])
    {
        return $this->businessCasePhaseChangesDetailGetAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCasePhaseChangesDetailGetAsyncWithHttpInfo
     *
     * changelog změn stavů OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePhaseChangesDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCasePhaseChangesDetailGetAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCasePhaseChangesDetailGet'][0])
    {
        $returnType = '';
        $request = $this->businessCasePhaseChangesDetailGetRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCasePhaseChangesDetailGet'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCasePhaseChangesDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCasePhaseChangesDetailGetRequest($business_case_id, string $contentType = self::contentTypes['businessCasePhaseChangesDetailGet'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCasePhaseChangesDetailGet'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/phaseChanges';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseUnlockEdit
     *
     * odemčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseUnlockEdit($business_case_id, string $contentType = self::contentTypes['businessCaseUnlockEdit'][0])
    {
        $this->businessCaseUnlockEditWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseUnlockEditWithHttpInfo
     *
     * odemčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseUnlockEditWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseUnlockEdit'][0])
    {
        $request = $this->businessCaseUnlockEditRequest($business_case_id, $contentType);

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
     * Operation businessCaseUnlockEditAsync
     *
     * odemčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseUnlockEditAsync($business_case_id, string $contentType = self::contentTypes['businessCaseUnlockEdit'][0])
    {
        return $this->businessCaseUnlockEditAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseUnlockEditAsyncWithHttpInfo
     *
     * odemčení OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseUnlockEditAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseUnlockEditRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseUnlockEdit'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseUnlockEditRequest($business_case_id, string $contentType = self::contentTypes['businessCaseUnlockEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseUnlockEdit'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
     * Operation businessCaseValidEdit
     *
     * obnovení platnosti OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function businessCaseValidEdit($business_case_id, string $contentType = self::contentTypes['businessCaseValidEdit'][0])
    {
        $this->businessCaseValidEditWithHttpInfo($business_case_id, $contentType);
    }

    /**
     * Operation businessCaseValidEditWithHttpInfo
     *
     * obnovení platnosti OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function businessCaseValidEditWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseValidEdit'][0])
    {
        $request = $this->businessCaseValidEditRequest($business_case_id, $contentType);

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
     * Operation businessCaseValidEditAsync
     *
     * obnovení platnosti OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseValidEditAsync($business_case_id, string $contentType = self::contentTypes['businessCaseValidEdit'][0])
    {
        return $this->businessCaseValidEditAsyncWithHttpInfo($business_case_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation businessCaseValidEditAsyncWithHttpInfo
     *
     * obnovení platnosti OP
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function businessCaseValidEditAsyncWithHttpInfo($business_case_id, string $contentType = self::contentTypes['businessCaseValidEdit'][0])
    {
        $returnType = '';
        $request = $this->businessCaseValidEditRequest($business_case_id, $contentType);

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
     * Create request for operation 'businessCaseValidEdit'
     *
     * @param  int $business_case_id ID obch. případu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['businessCaseValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function businessCaseValidEditRequest($business_case_id, string $contentType = self::contentTypes['businessCaseValidEdit'][0])
    {

        // verify the required parameter 'business_case_id' is set
        if ($business_case_id === null || (is_array($business_case_id) && count($business_case_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $business_case_id when calling businessCaseValidEdit'
            );
        }


        $resourcePath = '/businessCase/{businessCaseId}/valid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($business_case_id !== null) {
            $resourcePath = str_replace(
                '{' . 'businessCaseId' . '}',
                ObjectSerializer::toPathValue($business_case_id),
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
