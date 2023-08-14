<?php
/**
 * ObjednvkyApi
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
 * ObjednvkyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjednvkyApi
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
        'salesOrderDelete' => [
            'application/json',
        ],
        'salesOrderDetailGet' => [
            'application/json',
        ],
        'salesOrderEdit' => [
            'application/json',
        ],
        'salesOrderGet' => [
            'application/json',
        ],
        'salesOrderInsert' => [
            'application/json',
        ],
        'salesOrderInvalidEdit' => [
            'application/json',
        ],
        'salesOrderItemDelete' => [
            'application/json',
        ],
        'salesOrderItemEdit' => [
            'application/json',
        ],
        'salesOrderItemInsert' => [
            'application/json',
        ],
        'salesOrderLockEdit' => [
            'application/json',
        ],
        'salesOrderPdfExportDetailGet' => [
            'application/json',
        ],
        'salesOrderSyncDelete' => [
            'application/json',
        ],
        'salesOrderSyncEdit' => [
            'application/json',
        ],
        'salesOrderUnlockEdit' => [
            'application/json',
        ],
        'salesOrderValidEdit' => [
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
     * Operation salesOrderDelete
     *
     * smazání objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderDelete($sales_order_id, string $contentType = self::contentTypes['salesOrderDelete'][0])
    {
        $this->salesOrderDeleteWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderDeleteWithHttpInfo
     *
     * smazání objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderDeleteWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderDelete'][0])
    {
        $request = $this->salesOrderDeleteRequest($sales_order_id, $contentType);

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
     * Operation salesOrderDeleteAsync
     *
     * smazání objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderDeleteAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderDelete'][0])
    {
        return $this->salesOrderDeleteAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderDeleteAsyncWithHttpInfo
     *
     * smazání objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderDeleteAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderDelete'][0])
    {
        $returnType = '';
        $request = $this->salesOrderDeleteRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderDelete'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderDeleteRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderDelete'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderDelete'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderDetailGet
     *
     * detail objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderDetailGet($sales_order_id, string $contentType = self::contentTypes['salesOrderDetailGet'][0])
    {
        $this->salesOrderDetailGetWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderDetailGetWithHttpInfo
     *
     * detail objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderDetailGetWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderDetailGet'][0])
    {
        $request = $this->salesOrderDetailGetRequest($sales_order_id, $contentType);

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
     * Operation salesOrderDetailGetAsync
     *
     * detail objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderDetailGetAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderDetailGet'][0])
    {
        return $this->salesOrderDetailGetAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderDetailGetAsyncWithHttpInfo
     *
     * detail objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderDetailGetAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderDetailGet'][0])
    {
        $returnType = '';
        $request = $this->salesOrderDetailGetRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderDetailGet'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderDetailGetRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderDetailGet'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderDetailGet'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderEdit
     *
     * upravení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderEditDto $sales_order_edit_dto sales_order_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderEdit($sales_order_id, $sales_order_edit_dto = null, string $contentType = self::contentTypes['salesOrderEdit'][0])
    {
        $this->salesOrderEditWithHttpInfo($sales_order_id, $sales_order_edit_dto, $contentType);
    }

    /**
     * Operation salesOrderEditWithHttpInfo
     *
     * upravení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderEditDto $sales_order_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderEditWithHttpInfo($sales_order_id, $sales_order_edit_dto = null, string $contentType = self::contentTypes['salesOrderEdit'][0])
    {
        $request = $this->salesOrderEditRequest($sales_order_id, $sales_order_edit_dto, $contentType);

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
     * Operation salesOrderEditAsync
     *
     * upravení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderEditDto $sales_order_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderEditAsync($sales_order_id, $sales_order_edit_dto = null, string $contentType = self::contentTypes['salesOrderEdit'][0])
    {
        return $this->salesOrderEditAsyncWithHttpInfo($sales_order_id, $sales_order_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderEditAsyncWithHttpInfo
     *
     * upravení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderEditDto $sales_order_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderEditAsyncWithHttpInfo($sales_order_id, $sales_order_edit_dto = null, string $contentType = self::contentTypes['salesOrderEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderEditRequest($sales_order_id, $sales_order_edit_dto, $contentType);

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
     * Create request for operation 'salesOrderEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderEditDto $sales_order_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderEditRequest($sales_order_id, $sales_order_edit_dto = null, string $contentType = self::contentTypes['salesOrderEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderEdit'
            );
        }



        $resourcePath = '/salesOrder/{salesOrderId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($sales_order_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($sales_order_edit_dto));
            } else {
                $httpBody = $sales_order_edit_dto;
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
     * Operation salesOrderGet
     *
     * seznam objednávek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $request_delivery_date Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $sales_order_status Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $request_delivery_date = null, $valid_from = null, $valid_till = null, $status = null, $sales_order_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['salesOrderGet'][0])
    {
        $this->salesOrderGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);
    }

    /**
     * Operation salesOrderGetWithHttpInfo
     *
     * seznam objednávek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $request_delivery_date Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $sales_order_status Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $request_delivery_date = null, $valid_from = null, $valid_till = null, $status = null, $sales_order_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['salesOrderGet'][0])
    {
        $request = $this->salesOrderGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);

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
     * Operation salesOrderGetAsync
     *
     * seznam objednávek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $request_delivery_date Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $sales_order_status Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $request_delivery_date = null, $valid_from = null, $valid_till = null, $status = null, $sales_order_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['salesOrderGet'][0])
    {
        return $this->salesOrderGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderGetAsyncWithHttpInfo
     *
     * seznam objednávek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $request_delivery_date Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $sales_order_status Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $request_delivery_date = null, $valid_from = null, $valid_till = null, $status = null, $sales_order_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['salesOrderGet'][0])
    {
        $returnType = '';
        $request = $this->salesOrderGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $request_delivery_date, $valid_from, $valid_till, $status, $sales_order_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);

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
     * Create request for operation 'salesOrderGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování objednávek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování objednávek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování objednávek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování objednávek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování objednávek podle obchodního případu objednávky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování objednávek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování objednávek podle data dodání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $request_delivery_date Filtrování objednávek podle data vypršení objednávky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování objednávek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování OP podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. - &#x60;B_ACTIVE&#x60; otevřené nabídky, - &#x60;E_WIN&#x60; vyhrané nabídky, - &#x60;F_LOST&#x60; prohrané nabídky, - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $sales_order_status Filtrování objednávek podle stavu (SalesOrderStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování objednávek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování objednávek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování objednávek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování objednávek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování objednávek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování objednávek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných objednávek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $request_delivery_date = null, $valid_from = null, $valid_till = null, $status = null, $sales_order_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['salesOrderGet'][0])
    {




























        $resourcePath = '/salesOrder/';
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
            $person,
            'person', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $business_case,
            'businessCase', // param base name
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
            $expiration_date,
            'expirationDate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $request_delivery_date,
            'requestDeliveryDate', // param base name
            'string', // openApiType
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
            $status,
            'status', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sales_order_status,
            'salesOrderStatus', // param base name
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
     * Operation salesOrderInsert
     *
     * nová objednávka
     *
     * @param  \RaynetApiClient\Model\SalesOrderInsertDto $sales_order_insert_dto sales_order_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function salesOrderInsert($sales_order_insert_dto = null, string $contentType = self::contentTypes['salesOrderInsert'][0])
    {
        list($response) = $this->salesOrderInsertWithHttpInfo($sales_order_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation salesOrderInsertWithHttpInfo
     *
     * nová objednávka
     *
     * @param  \RaynetApiClient\Model\SalesOrderInsertDto $sales_order_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderInsertWithHttpInfo($sales_order_insert_dto = null, string $contentType = self::contentTypes['salesOrderInsert'][0])
    {
        $request = $this->salesOrderInsertRequest($sales_order_insert_dto, $contentType);

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
     * Operation salesOrderInsertAsync
     *
     * nová objednávka
     *
     * @param  \RaynetApiClient\Model\SalesOrderInsertDto $sales_order_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderInsertAsync($sales_order_insert_dto = null, string $contentType = self::contentTypes['salesOrderInsert'][0])
    {
        return $this->salesOrderInsertAsyncWithHttpInfo($sales_order_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderInsertAsyncWithHttpInfo
     *
     * nová objednávka
     *
     * @param  \RaynetApiClient\Model\SalesOrderInsertDto $sales_order_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderInsertAsyncWithHttpInfo($sales_order_insert_dto = null, string $contentType = self::contentTypes['salesOrderInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->salesOrderInsertRequest($sales_order_insert_dto, $contentType);

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
     * Create request for operation 'salesOrderInsert'
     *
     * @param  \RaynetApiClient\Model\SalesOrderInsertDto $sales_order_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderInsertRequest($sales_order_insert_dto = null, string $contentType = self::contentTypes['salesOrderInsert'][0])
    {



        $resourcePath = '/salesOrder/';
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
        if (isset($sales_order_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($sales_order_insert_dto));
            } else {
                $httpBody = $sales_order_insert_dto;
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
     * Operation salesOrderInvalidEdit
     *
     * zneplatnění objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderInvalidEdit($sales_order_id, string $contentType = self::contentTypes['salesOrderInvalidEdit'][0])
    {
        $this->salesOrderInvalidEditWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderInvalidEditWithHttpInfo
     *
     * zneplatnění objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderInvalidEditWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderInvalidEdit'][0])
    {
        $request = $this->salesOrderInvalidEditRequest($sales_order_id, $contentType);

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
     * Operation salesOrderInvalidEditAsync
     *
     * zneplatnění objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderInvalidEditAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderInvalidEdit'][0])
    {
        return $this->salesOrderInvalidEditAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderInvalidEditAsyncWithHttpInfo
     *
     * zneplatnění objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderInvalidEditAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderInvalidEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderInvalidEditRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderInvalidEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderInvalidEditRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderInvalidEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderInvalidEdit'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/invalid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderItemDelete
     *
     * smazání položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderItemDelete($sales_order_id, $sales_order_item_id, string $contentType = self::contentTypes['salesOrderItemDelete'][0])
    {
        $this->salesOrderItemDeleteWithHttpInfo($sales_order_id, $sales_order_item_id, $contentType);
    }

    /**
     * Operation salesOrderItemDeleteWithHttpInfo
     *
     * smazání položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderItemDeleteWithHttpInfo($sales_order_id, $sales_order_item_id, string $contentType = self::contentTypes['salesOrderItemDelete'][0])
    {
        $request = $this->salesOrderItemDeleteRequest($sales_order_id, $sales_order_item_id, $contentType);

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
     * Operation salesOrderItemDeleteAsync
     *
     * smazání položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemDeleteAsync($sales_order_id, $sales_order_item_id, string $contentType = self::contentTypes['salesOrderItemDelete'][0])
    {
        return $this->salesOrderItemDeleteAsyncWithHttpInfo($sales_order_id, $sales_order_item_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderItemDeleteAsyncWithHttpInfo
     *
     * smazání položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemDeleteAsyncWithHttpInfo($sales_order_id, $sales_order_item_id, string $contentType = self::contentTypes['salesOrderItemDelete'][0])
    {
        $returnType = '';
        $request = $this->salesOrderItemDeleteRequest($sales_order_id, $sales_order_item_id, $contentType);

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
     * Create request for operation 'salesOrderItemDelete'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderItemDeleteRequest($sales_order_id, $sales_order_item_id, string $contentType = self::contentTypes['salesOrderItemDelete'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderItemDelete'
            );
        }

        // verify the required parameter 'sales_order_item_id' is set
        if ($sales_order_item_id === null || (is_array($sales_order_item_id) && count($sales_order_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_item_id when calling salesOrderItemDelete'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/item/{salesOrderItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
                $resourcePath
            );
        }
        // path params
        if ($sales_order_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderItemId' . '}',
                ObjectSerializer::toPathValue($sales_order_item_id),
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
     * Operation salesOrderItemEdit
     *
     * upravení položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemEditDto $sales_order_item_edit_dto sales_order_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderItemEdit($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto = null, string $contentType = self::contentTypes['salesOrderItemEdit'][0])
    {
        $this->salesOrderItemEditWithHttpInfo($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto, $contentType);
    }

    /**
     * Operation salesOrderItemEditWithHttpInfo
     *
     * upravení položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemEditDto $sales_order_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderItemEditWithHttpInfo($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto = null, string $contentType = self::contentTypes['salesOrderItemEdit'][0])
    {
        $request = $this->salesOrderItemEditRequest($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto, $contentType);

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
     * Operation salesOrderItemEditAsync
     *
     * upravení položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemEditDto $sales_order_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemEditAsync($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto = null, string $contentType = self::contentTypes['salesOrderItemEdit'][0])
    {
        return $this->salesOrderItemEditAsyncWithHttpInfo($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderItemEditAsyncWithHttpInfo
     *
     * upravení položky objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemEditDto $sales_order_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemEditAsyncWithHttpInfo($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto = null, string $contentType = self::contentTypes['salesOrderItemEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderItemEditRequest($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto, $contentType);

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
     * Create request for operation 'salesOrderItemEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  int $sales_order_item_id ID položky objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemEditDto $sales_order_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderItemEditRequest($sales_order_id, $sales_order_item_id, $sales_order_item_edit_dto = null, string $contentType = self::contentTypes['salesOrderItemEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderItemEdit'
            );
        }

        // verify the required parameter 'sales_order_item_id' is set
        if ($sales_order_item_id === null || (is_array($sales_order_item_id) && count($sales_order_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_item_id when calling salesOrderItemEdit'
            );
        }



        $resourcePath = '/salesOrder/{salesOrderId}/item/{salesOrderItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
                $resourcePath
            );
        }
        // path params
        if ($sales_order_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderItemId' . '}',
                ObjectSerializer::toPathValue($sales_order_item_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($sales_order_item_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($sales_order_item_edit_dto));
            } else {
                $httpBody = $sales_order_item_edit_dto;
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
     * Operation salesOrderItemInsert
     *
     * přidání položek objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemInsertDto $sales_order_item_insert_dto sales_order_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderItemInsert($sales_order_id, $sales_order_item_insert_dto = null, string $contentType = self::contentTypes['salesOrderItemInsert'][0])
    {
        $this->salesOrderItemInsertWithHttpInfo($sales_order_id, $sales_order_item_insert_dto, $contentType);
    }

    /**
     * Operation salesOrderItemInsertWithHttpInfo
     *
     * přidání položek objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemInsertDto $sales_order_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderItemInsertWithHttpInfo($sales_order_id, $sales_order_item_insert_dto = null, string $contentType = self::contentTypes['salesOrderItemInsert'][0])
    {
        $request = $this->salesOrderItemInsertRequest($sales_order_id, $sales_order_item_insert_dto, $contentType);

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
     * Operation salesOrderItemInsertAsync
     *
     * přidání položek objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemInsertDto $sales_order_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemInsertAsync($sales_order_id, $sales_order_item_insert_dto = null, string $contentType = self::contentTypes['salesOrderItemInsert'][0])
    {
        return $this->salesOrderItemInsertAsyncWithHttpInfo($sales_order_id, $sales_order_item_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderItemInsertAsyncWithHttpInfo
     *
     * přidání položek objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemInsertDto $sales_order_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderItemInsertAsyncWithHttpInfo($sales_order_id, $sales_order_item_insert_dto = null, string $contentType = self::contentTypes['salesOrderItemInsert'][0])
    {
        $returnType = '';
        $request = $this->salesOrderItemInsertRequest($sales_order_id, $sales_order_item_insert_dto, $contentType);

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
     * Create request for operation 'salesOrderItemInsert'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  \RaynetApiClient\Model\SalesOrderItemInsertDto $sales_order_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderItemInsertRequest($sales_order_id, $sales_order_item_insert_dto = null, string $contentType = self::contentTypes['salesOrderItemInsert'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderItemInsert'
            );
        }



        $resourcePath = '/salesOrder/{salesOrderId}/item/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($sales_order_item_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($sales_order_item_insert_dto));
            } else {
                $httpBody = $sales_order_item_insert_dto;
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
     * Operation salesOrderLockEdit
     *
     * uzamčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderLockEdit($sales_order_id, string $contentType = self::contentTypes['salesOrderLockEdit'][0])
    {
        $this->salesOrderLockEditWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderLockEditWithHttpInfo
     *
     * uzamčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderLockEditWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderLockEdit'][0])
    {
        $request = $this->salesOrderLockEditRequest($sales_order_id, $contentType);

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
     * Operation salesOrderLockEditAsync
     *
     * uzamčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderLockEditAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderLockEdit'][0])
    {
        return $this->salesOrderLockEditAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderLockEditAsyncWithHttpInfo
     *
     * uzamčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderLockEditAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderLockEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderLockEditRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderLockEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderLockEditRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderLockEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderLockEdit'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderPdfExportDetailGet
     *
     * export objednávky do PDF
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $locale Jazyk exportované objednávky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderPdfExportDetailGet($sales_order_id, $locale = null, string $contentType = self::contentTypes['salesOrderPdfExportDetailGet'][0])
    {
        $this->salesOrderPdfExportDetailGetWithHttpInfo($sales_order_id, $locale, $contentType);
    }

    /**
     * Operation salesOrderPdfExportDetailGetWithHttpInfo
     *
     * export objednávky do PDF
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $locale Jazyk exportované objednávky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderPdfExportDetailGetWithHttpInfo($sales_order_id, $locale = null, string $contentType = self::contentTypes['salesOrderPdfExportDetailGet'][0])
    {
        $request = $this->salesOrderPdfExportDetailGetRequest($sales_order_id, $locale, $contentType);

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
     * Operation salesOrderPdfExportDetailGetAsync
     *
     * export objednávky do PDF
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $locale Jazyk exportované objednávky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderPdfExportDetailGetAsync($sales_order_id, $locale = null, string $contentType = self::contentTypes['salesOrderPdfExportDetailGet'][0])
    {
        return $this->salesOrderPdfExportDetailGetAsyncWithHttpInfo($sales_order_id, $locale, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderPdfExportDetailGetAsyncWithHttpInfo
     *
     * export objednávky do PDF
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $locale Jazyk exportované objednávky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderPdfExportDetailGetAsyncWithHttpInfo($sales_order_id, $locale = null, string $contentType = self::contentTypes['salesOrderPdfExportDetailGet'][0])
    {
        $returnType = '';
        $request = $this->salesOrderPdfExportDetailGetRequest($sales_order_id, $locale, $contentType);

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
     * Create request for operation 'salesOrderPdfExportDetailGet'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $locale Jazyk exportované objednávky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderPdfExportDetailGetRequest($sales_order_id, $locale = null, string $contentType = self::contentTypes['salesOrderPdfExportDetailGet'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderPdfExportDetailGet'
            );
        }



        $resourcePath = '/salesOrder/{salesOrderId}/pdfExport';
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
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderSyncDelete
     *
     * zrušení synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderSyncDelete($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncDelete'][0])
    {
        $this->salesOrderSyncDeleteWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderSyncDeleteWithHttpInfo
     *
     * zrušení synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderSyncDeleteWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncDelete'][0])
    {
        $request = $this->salesOrderSyncDeleteRequest($sales_order_id, $contentType);

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
     * Operation salesOrderSyncDeleteAsync
     *
     * zrušení synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderSyncDeleteAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncDelete'][0])
    {
        return $this->salesOrderSyncDeleteAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderSyncDeleteAsyncWithHttpInfo
     *
     * zrušení synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderSyncDeleteAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncDelete'][0])
    {
        $returnType = '';
        $request = $this->salesOrderSyncDeleteRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderSyncDelete'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderSyncDeleteRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncDelete'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderSyncDelete'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/sync';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderSyncEdit
     *
     * synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderSyncEdit($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncEdit'][0])
    {
        $this->salesOrderSyncEditWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderSyncEditWithHttpInfo
     *
     * synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderSyncEditWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncEdit'][0])
    {
        $request = $this->salesOrderSyncEditRequest($sales_order_id, $contentType);

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
     * Operation salesOrderSyncEditAsync
     *
     * synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderSyncEditAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncEdit'][0])
    {
        return $this->salesOrderSyncEditAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderSyncEditAsyncWithHttpInfo
     *
     * synchronizace objednávky s obchodním případem
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderSyncEditAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderSyncEditRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderSyncEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderSyncEditRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderSyncEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderSyncEdit'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/sync';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation salesOrderUnlockEdit
     *
     * odemčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderUnlockEdit($sales_order_id, string $contentType = self::contentTypes['salesOrderUnlockEdit'][0])
    {
        $this->salesOrderUnlockEditWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderUnlockEditWithHttpInfo
     *
     * odemčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderUnlockEditWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderUnlockEdit'][0])
    {
        $request = $this->salesOrderUnlockEditRequest($sales_order_id, $contentType);

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
     * Operation salesOrderUnlockEditAsync
     *
     * odemčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderUnlockEditAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderUnlockEdit'][0])
    {
        return $this->salesOrderUnlockEditAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderUnlockEditAsyncWithHttpInfo
     *
     * odemčení objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderUnlockEditAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderUnlockEditRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderUnlockEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderUnlockEditRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderUnlockEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderUnlockEdit'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
     * Operation salesOrderValidEdit
     *
     * obnovení platnosti objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function salesOrderValidEdit($sales_order_id, string $contentType = self::contentTypes['salesOrderValidEdit'][0])
    {
        $this->salesOrderValidEditWithHttpInfo($sales_order_id, $contentType);
    }

    /**
     * Operation salesOrderValidEditWithHttpInfo
     *
     * obnovení platnosti objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function salesOrderValidEditWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderValidEdit'][0])
    {
        $request = $this->salesOrderValidEditRequest($sales_order_id, $contentType);

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
     * Operation salesOrderValidEditAsync
     *
     * obnovení platnosti objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderValidEditAsync($sales_order_id, string $contentType = self::contentTypes['salesOrderValidEdit'][0])
    {
        return $this->salesOrderValidEditAsyncWithHttpInfo($sales_order_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation salesOrderValidEditAsyncWithHttpInfo
     *
     * obnovení platnosti objednávky
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function salesOrderValidEditAsyncWithHttpInfo($sales_order_id, string $contentType = self::contentTypes['salesOrderValidEdit'][0])
    {
        $returnType = '';
        $request = $this->salesOrderValidEditRequest($sales_order_id, $contentType);

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
     * Create request for operation 'salesOrderValidEdit'
     *
     * @param  int $sales_order_id ID objednávky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['salesOrderValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function salesOrderValidEditRequest($sales_order_id, string $contentType = self::contentTypes['salesOrderValidEdit'][0])
    {

        // verify the required parameter 'sales_order_id' is set
        if ($sales_order_id === null || (is_array($sales_order_id) && count($sales_order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $sales_order_id when calling salesOrderValidEdit'
            );
        }


        $resourcePath = '/salesOrder/{salesOrderId}/valid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($sales_order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'salesOrderId' . '}',
                ObjectSerializer::toPathValue($sales_order_id),
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
