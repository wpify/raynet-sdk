<?php
/**
 * CenkyApi
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
 * CenkyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class CenkyApi
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
        'priceListDelete' => [
            'application/json',
        ],
        'priceListDetailGet' => [
            'application/json',
        ],
        'priceListEdit' => [
            'application/json',
        ],
        'priceListGet' => [
            'application/json',
        ],
        'priceListInsert' => [
            'application/json',
        ],
        'priceListItemBulkUpsertEdit' => [
            'application/json',
        ],
        'priceListItemDelete' => [
            'application/json',
        ],
        'priceListItemEdit' => [
            'application/json',
        ],
        'priceListItemInsert' => [
            'application/json',
        ],
        'priceListItemsDetailGet' => [
            'application/json',
        ],
        'priceListLockEdit' => [
            'application/json',
        ],
        'priceListUnlockEdit' => [
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
     * Operation priceListDelete
     *
     * smazání ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListDelete($price_list_id, string $contentType = self::contentTypes['priceListDelete'][0])
    {
        $this->priceListDeleteWithHttpInfo($price_list_id, $contentType);
    }

    /**
     * Operation priceListDeleteWithHttpInfo
     *
     * smazání ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListDeleteWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListDelete'][0])
    {
        $request = $this->priceListDeleteRequest($price_list_id, $contentType);

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
     * Operation priceListDeleteAsync
     *
     * smazání ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListDeleteAsync($price_list_id, string $contentType = self::contentTypes['priceListDelete'][0])
    {
        return $this->priceListDeleteAsyncWithHttpInfo($price_list_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListDeleteAsyncWithHttpInfo
     *
     * smazání ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListDeleteAsyncWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListDelete'][0])
    {
        $returnType = '';
        $request = $this->priceListDeleteRequest($price_list_id, $contentType);

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
     * Create request for operation 'priceListDelete'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListDeleteRequest($price_list_id, string $contentType = self::contentTypes['priceListDelete'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListDelete'
            );
        }


        $resourcePath = '/priceList/{priceListId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
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
     * Operation priceListDetailGet
     *
     * detail ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListDetailGet($price_list_id, string $contentType = self::contentTypes['priceListDetailGet'][0])
    {
        $this->priceListDetailGetWithHttpInfo($price_list_id, $contentType);
    }

    /**
     * Operation priceListDetailGetWithHttpInfo
     *
     * detail ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListDetailGetWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListDetailGet'][0])
    {
        $request = $this->priceListDetailGetRequest($price_list_id, $contentType);

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
     * Operation priceListDetailGetAsync
     *
     * detail ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListDetailGetAsync($price_list_id, string $contentType = self::contentTypes['priceListDetailGet'][0])
    {
        return $this->priceListDetailGetAsyncWithHttpInfo($price_list_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListDetailGetAsyncWithHttpInfo
     *
     * detail ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListDetailGetAsyncWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListDetailGet'][0])
    {
        $returnType = '';
        $request = $this->priceListDetailGetRequest($price_list_id, $contentType);

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
     * Create request for operation 'priceListDetailGet'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListDetailGetRequest($price_list_id, string $contentType = self::contentTypes['priceListDetailGet'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListDetailGet'
            );
        }


        $resourcePath = '/priceList/{priceListId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
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
     * Operation priceListEdit
     *
     * upravení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListEditDto $price_list_edit_dto price_list_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListEdit($price_list_id, $price_list_edit_dto = null, string $contentType = self::contentTypes['priceListEdit'][0])
    {
        $this->priceListEditWithHttpInfo($price_list_id, $price_list_edit_dto, $contentType);
    }

    /**
     * Operation priceListEditWithHttpInfo
     *
     * upravení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListEditDto $price_list_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListEditWithHttpInfo($price_list_id, $price_list_edit_dto = null, string $contentType = self::contentTypes['priceListEdit'][0])
    {
        $request = $this->priceListEditRequest($price_list_id, $price_list_edit_dto, $contentType);

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
     * Operation priceListEditAsync
     *
     * upravení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListEditDto $price_list_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListEditAsync($price_list_id, $price_list_edit_dto = null, string $contentType = self::contentTypes['priceListEdit'][0])
    {
        return $this->priceListEditAsyncWithHttpInfo($price_list_id, $price_list_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListEditAsyncWithHttpInfo
     *
     * upravení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListEditDto $price_list_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListEditAsyncWithHttpInfo($price_list_id, $price_list_edit_dto = null, string $contentType = self::contentTypes['priceListEdit'][0])
    {
        $returnType = '';
        $request = $this->priceListEditRequest($price_list_id, $price_list_edit_dto, $contentType);

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
     * Create request for operation 'priceListEdit'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListEditDto $price_list_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListEditRequest($price_list_id, $price_list_edit_dto = null, string $contentType = self::contentTypes['priceListEdit'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListEdit'
            );
        }



        $resourcePath = '/priceList/{priceListId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($price_list_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($price_list_edit_dto));
            } else {
                $httpBody = $price_list_edit_dto;
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
     * Operation priceListGet
     *
     * seznam ceníků
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených cenníků je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $currency Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) (optional)
     * @param  string $valid_from Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $primary = null, $currency = null, $valid_from = null, $valid_till = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['priceListGet'][0])
    {
        $this->priceListGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);
    }

    /**
     * Operation priceListGetWithHttpInfo
     *
     * seznam ceníků
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených cenníků je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $currency Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) (optional)
     * @param  string $valid_from Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $primary = null, $currency = null, $valid_from = null, $valid_till = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['priceListGet'][0])
    {
        $request = $this->priceListGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Operation priceListGetAsync
     *
     * seznam ceníků
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených cenníků je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $currency Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) (optional)
     * @param  string $valid_from Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $primary = null, $currency = null, $valid_from = null, $valid_till = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['priceListGet'][0])
    {
        return $this->priceListGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListGetAsyncWithHttpInfo
     *
     * seznam ceníků
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených cenníků je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $currency Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) (optional)
     * @param  string $valid_from Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $primary = null, $currency = null, $valid_from = null, $valid_till = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['priceListGet'][0])
    {
        $returnType = '';
        $request = $this->priceListGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $primary, $currency, $valid_from, $valid_till, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Create request for operation 'priceListGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených cenníků je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování ceníků podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $primary Filtrování ceníků podle příznaku, zda je ceník výchozí. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $currency Filtrování ceníků podle měny (Currency). Filtruje se podle jednoznačného identifikátoru měny (id) (optional)
     * @param  string $valid_from Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování ceníků podle data platnosti. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování ceníků podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování ceníků podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování ceníků podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $primary = null, $currency = null, $valid_from = null, $valid_till = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['priceListGet'][0])
    {
















        $resourcePath = '/priceList/';
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
            $primary,
            'primary', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $currency,
            'currency', // param base name
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
     * Operation priceListInsert
     *
     * nový ceník
     *
     * @param  \RaynetApiClient\Model\PriceListInsertDto $price_list_insert_dto price_list_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function priceListInsert($price_list_insert_dto = null, string $contentType = self::contentTypes['priceListInsert'][0])
    {
        list($response) = $this->priceListInsertWithHttpInfo($price_list_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation priceListInsertWithHttpInfo
     *
     * nový ceník
     *
     * @param  \RaynetApiClient\Model\PriceListInsertDto $price_list_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListInsertWithHttpInfo($price_list_insert_dto = null, string $contentType = self::contentTypes['priceListInsert'][0])
    {
        $request = $this->priceListInsertRequest($price_list_insert_dto, $contentType);

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
     * Operation priceListInsertAsync
     *
     * nový ceník
     *
     * @param  \RaynetApiClient\Model\PriceListInsertDto $price_list_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListInsertAsync($price_list_insert_dto = null, string $contentType = self::contentTypes['priceListInsert'][0])
    {
        return $this->priceListInsertAsyncWithHttpInfo($price_list_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListInsertAsyncWithHttpInfo
     *
     * nový ceník
     *
     * @param  \RaynetApiClient\Model\PriceListInsertDto $price_list_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListInsertAsyncWithHttpInfo($price_list_insert_dto = null, string $contentType = self::contentTypes['priceListInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->priceListInsertRequest($price_list_insert_dto, $contentType);

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
     * Create request for operation 'priceListInsert'
     *
     * @param  \RaynetApiClient\Model\PriceListInsertDto $price_list_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListInsertRequest($price_list_insert_dto = null, string $contentType = self::contentTypes['priceListInsert'][0])
    {



        $resourcePath = '/priceList/';
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
        if (isset($price_list_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($price_list_insert_dto));
            } else {
                $httpBody = $price_list_insert_dto;
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
     * Operation priceListItemBulkUpsertEdit
     *
     * hromadné přidání/upravení položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[] $price_list_item_bulk_upsert_edit_dto_inner price_list_item_bulk_upsert_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemBulkUpsertEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function priceListItemBulkUpsertEdit($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner = null, string $contentType = self::contentTypes['priceListItemBulkUpsertEdit'][0])
    {
        list($response) = $this->priceListItemBulkUpsertEditWithHttpInfo($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner, $contentType);
        return $response;
    }

    /**
     * Operation priceListItemBulkUpsertEditWithHttpInfo
     *
     * hromadné přidání/upravení položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[] $price_list_item_bulk_upsert_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemBulkUpsertEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of mixed, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListItemBulkUpsertEditWithHttpInfo($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner = null, string $contentType = self::contentTypes['priceListItemBulkUpsertEdit'][0])
    {
        $request = $this->priceListItemBulkUpsertEditRequest($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner, $contentType);

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
                case 200:
                    if ('mixed' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('mixed' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'mixed', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'mixed';
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
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation priceListItemBulkUpsertEditAsync
     *
     * hromadné přidání/upravení položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[] $price_list_item_bulk_upsert_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemBulkUpsertEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemBulkUpsertEditAsync($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner = null, string $contentType = self::contentTypes['priceListItemBulkUpsertEdit'][0])
    {
        return $this->priceListItemBulkUpsertEditAsyncWithHttpInfo($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListItemBulkUpsertEditAsyncWithHttpInfo
     *
     * hromadné přidání/upravení položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[] $price_list_item_bulk_upsert_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemBulkUpsertEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemBulkUpsertEditAsyncWithHttpInfo($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner = null, string $contentType = self::contentTypes['priceListItemBulkUpsertEdit'][0])
    {
        $returnType = 'mixed';
        $request = $this->priceListItemBulkUpsertEditRequest($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner, $contentType);

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
     * Create request for operation 'priceListItemBulkUpsertEdit'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemBulkUpsertEditDtoInner[] $price_list_item_bulk_upsert_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemBulkUpsertEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListItemBulkUpsertEditRequest($price_list_id, $price_list_item_bulk_upsert_edit_dto_inner = null, string $contentType = self::contentTypes['priceListItemBulkUpsertEdit'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListItemBulkUpsertEdit'
            );
        }



        $resourcePath = '/priceList/{priceListId}/itemBulkUpsert/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($price_list_item_bulk_upsert_edit_dto_inner)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($price_list_item_bulk_upsert_edit_dto_inner));
            } else {
                $httpBody = $price_list_item_bulk_upsert_edit_dto_inner;
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
     * Operation priceListItemDelete
     *
     * smazání položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListItemDelete($price_list_id, $price_list_item_id, string $contentType = self::contentTypes['priceListItemDelete'][0])
    {
        $this->priceListItemDeleteWithHttpInfo($price_list_id, $price_list_item_id, $contentType);
    }

    /**
     * Operation priceListItemDeleteWithHttpInfo
     *
     * smazání položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListItemDeleteWithHttpInfo($price_list_id, $price_list_item_id, string $contentType = self::contentTypes['priceListItemDelete'][0])
    {
        $request = $this->priceListItemDeleteRequest($price_list_id, $price_list_item_id, $contentType);

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
     * Operation priceListItemDeleteAsync
     *
     * smazání položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemDeleteAsync($price_list_id, $price_list_item_id, string $contentType = self::contentTypes['priceListItemDelete'][0])
    {
        return $this->priceListItemDeleteAsyncWithHttpInfo($price_list_id, $price_list_item_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListItemDeleteAsyncWithHttpInfo
     *
     * smazání položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemDeleteAsyncWithHttpInfo($price_list_id, $price_list_item_id, string $contentType = self::contentTypes['priceListItemDelete'][0])
    {
        $returnType = '';
        $request = $this->priceListItemDeleteRequest($price_list_id, $price_list_item_id, $contentType);

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
     * Create request for operation 'priceListItemDelete'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListItemDeleteRequest($price_list_id, $price_list_item_id, string $contentType = self::contentTypes['priceListItemDelete'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListItemDelete'
            );
        }

        // verify the required parameter 'price_list_item_id' is set
        if ($price_list_item_id === null || (is_array($price_list_item_id) && count($price_list_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_item_id when calling priceListItemDelete'
            );
        }


        $resourcePath = '/priceList/{priceListId}/item/{priceListItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
                $resourcePath
            );
        }
        // path params
        if ($price_list_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListItemId' . '}',
                ObjectSerializer::toPathValue($price_list_item_id),
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
     * Operation priceListItemEdit
     *
     * upravení položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemEditDto $price_list_item_edit_dto price_list_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListItemEdit($price_list_id, $price_list_item_id, $price_list_item_edit_dto = null, string $contentType = self::contentTypes['priceListItemEdit'][0])
    {
        $this->priceListItemEditWithHttpInfo($price_list_id, $price_list_item_id, $price_list_item_edit_dto, $contentType);
    }

    /**
     * Operation priceListItemEditWithHttpInfo
     *
     * upravení položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemEditDto $price_list_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListItemEditWithHttpInfo($price_list_id, $price_list_item_id, $price_list_item_edit_dto = null, string $contentType = self::contentTypes['priceListItemEdit'][0])
    {
        $request = $this->priceListItemEditRequest($price_list_id, $price_list_item_id, $price_list_item_edit_dto, $contentType);

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
     * Operation priceListItemEditAsync
     *
     * upravení položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemEditDto $price_list_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemEditAsync($price_list_id, $price_list_item_id, $price_list_item_edit_dto = null, string $contentType = self::contentTypes['priceListItemEdit'][0])
    {
        return $this->priceListItemEditAsyncWithHttpInfo($price_list_id, $price_list_item_id, $price_list_item_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListItemEditAsyncWithHttpInfo
     *
     * upravení položky ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemEditDto $price_list_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemEditAsyncWithHttpInfo($price_list_id, $price_list_item_id, $price_list_item_edit_dto = null, string $contentType = self::contentTypes['priceListItemEdit'][0])
    {
        $returnType = '';
        $request = $this->priceListItemEditRequest($price_list_id, $price_list_item_id, $price_list_item_edit_dto, $contentType);

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
     * Create request for operation 'priceListItemEdit'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $price_list_item_id ID položky ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemEditDto $price_list_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListItemEditRequest($price_list_id, $price_list_item_id, $price_list_item_edit_dto = null, string $contentType = self::contentTypes['priceListItemEdit'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListItemEdit'
            );
        }

        // verify the required parameter 'price_list_item_id' is set
        if ($price_list_item_id === null || (is_array($price_list_item_id) && count($price_list_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_item_id when calling priceListItemEdit'
            );
        }



        $resourcePath = '/priceList/{priceListId}/item/{priceListItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
                $resourcePath
            );
        }
        // path params
        if ($price_list_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListItemId' . '}',
                ObjectSerializer::toPathValue($price_list_item_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($price_list_item_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($price_list_item_edit_dto));
            } else {
                $httpBody = $price_list_item_edit_dto;
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
     * Operation priceListItemInsert
     *
     * přidání položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemInsertDto $price_list_item_insert_dto price_list_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListItemInsert($price_list_id, $price_list_item_insert_dto = null, string $contentType = self::contentTypes['priceListItemInsert'][0])
    {
        $this->priceListItemInsertWithHttpInfo($price_list_id, $price_list_item_insert_dto, $contentType);
    }

    /**
     * Operation priceListItemInsertWithHttpInfo
     *
     * přidání položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemInsertDto $price_list_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListItemInsertWithHttpInfo($price_list_id, $price_list_item_insert_dto = null, string $contentType = self::contentTypes['priceListItemInsert'][0])
    {
        $request = $this->priceListItemInsertRequest($price_list_id, $price_list_item_insert_dto, $contentType);

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
     * Operation priceListItemInsertAsync
     *
     * přidání položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemInsertDto $price_list_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemInsertAsync($price_list_id, $price_list_item_insert_dto = null, string $contentType = self::contentTypes['priceListItemInsert'][0])
    {
        return $this->priceListItemInsertAsyncWithHttpInfo($price_list_id, $price_list_item_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListItemInsertAsyncWithHttpInfo
     *
     * přidání položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemInsertDto $price_list_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemInsertAsyncWithHttpInfo($price_list_id, $price_list_item_insert_dto = null, string $contentType = self::contentTypes['priceListItemInsert'][0])
    {
        $returnType = '';
        $request = $this->priceListItemInsertRequest($price_list_id, $price_list_item_insert_dto, $contentType);

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
     * Create request for operation 'priceListItemInsert'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  \RaynetApiClient\Model\PriceListItemInsertDto $price_list_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListItemInsertRequest($price_list_id, $price_list_item_insert_dto = null, string $contentType = self::contentTypes['priceListItemInsert'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListItemInsert'
            );
        }



        $resourcePath = '/priceList/{priceListId}/item/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($price_list_item_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($price_list_item_insert_dto));
            } else {
                $httpBody = $price_list_item_insert_dto;
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
     * Operation priceListItemsDetailGet
     *
     * seznam položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $offset Zobrazení záznamů od začátku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  int $product_id Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $product_code Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemsDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListItemsDetailGet($price_list_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $product_id = null, $product_code = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, string $contentType = self::contentTypes['priceListItemsDetailGet'][0])
    {
        $this->priceListItemsDetailGetWithHttpInfo($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $contentType);
    }

    /**
     * Operation priceListItemsDetailGetWithHttpInfo
     *
     * seznam položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $offset Zobrazení záznamů od začátku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  int $product_id Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $product_code Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemsDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListItemsDetailGetWithHttpInfo($price_list_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $product_id = null, $product_code = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, string $contentType = self::contentTypes['priceListItemsDetailGet'][0])
    {
        $request = $this->priceListItemsDetailGetRequest($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $contentType);

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
     * Operation priceListItemsDetailGetAsync
     *
     * seznam položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $offset Zobrazení záznamů od začátku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  int $product_id Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $product_code Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemsDetailGetAsync($price_list_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $product_id = null, $product_code = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, string $contentType = self::contentTypes['priceListItemsDetailGet'][0])
    {
        return $this->priceListItemsDetailGetAsyncWithHttpInfo($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListItemsDetailGetAsyncWithHttpInfo
     *
     * seznam položek ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $offset Zobrazení záznamů od začátku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  int $product_id Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $product_code Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListItemsDetailGetAsyncWithHttpInfo($price_list_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $product_id = null, $product_code = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, string $contentType = self::contentTypes['priceListItemsDetailGet'][0])
    {
        $returnType = '';
        $request = $this->priceListItemsDetailGetRequest($price_list_id, $offset, $limit, $sort_column, $sort_direction, $product_id, $product_code, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $contentType);

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
     * Create request for operation 'priceListItemsDetailGet'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  int $offset Zobrazení záznamů od začátku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  int $product_id Filtrování položek ceníku podle ID produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60; (optional)
     * @param  string $product_code Filtrování položek ceníku podle kódu produktu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListItemsDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListItemsDetailGetRequest($price_list_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $product_id = null, $product_code = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, string $contentType = self::contentTypes['priceListItemsDetailGet'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListItemsDetailGet'
            );
        }











        $resourcePath = '/priceList/{priceListId}/items/';
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
            $product_id,
            'product-id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $product_code,
            'product-code', // param base name
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


        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
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
     * Operation priceListLockEdit
     *
     * uzamčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListLockEdit($price_list_id, string $contentType = self::contentTypes['priceListLockEdit'][0])
    {
        $this->priceListLockEditWithHttpInfo($price_list_id, $contentType);
    }

    /**
     * Operation priceListLockEditWithHttpInfo
     *
     * uzamčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListLockEditWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListLockEdit'][0])
    {
        $request = $this->priceListLockEditRequest($price_list_id, $contentType);

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
     * Operation priceListLockEditAsync
     *
     * uzamčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListLockEditAsync($price_list_id, string $contentType = self::contentTypes['priceListLockEdit'][0])
    {
        return $this->priceListLockEditAsyncWithHttpInfo($price_list_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListLockEditAsyncWithHttpInfo
     *
     * uzamčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListLockEditAsyncWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListLockEdit'][0])
    {
        $returnType = '';
        $request = $this->priceListLockEditRequest($price_list_id, $contentType);

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
     * Create request for operation 'priceListLockEdit'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListLockEditRequest($price_list_id, string $contentType = self::contentTypes['priceListLockEdit'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListLockEdit'
            );
        }


        $resourcePath = '/priceList/{priceListId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
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
     * Operation priceListUnlockEdit
     *
     * odemčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function priceListUnlockEdit($price_list_id, string $contentType = self::contentTypes['priceListUnlockEdit'][0])
    {
        $this->priceListUnlockEditWithHttpInfo($price_list_id, $contentType);
    }

    /**
     * Operation priceListUnlockEditWithHttpInfo
     *
     * odemčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function priceListUnlockEditWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListUnlockEdit'][0])
    {
        $request = $this->priceListUnlockEditRequest($price_list_id, $contentType);

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
     * Operation priceListUnlockEditAsync
     *
     * odemčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListUnlockEditAsync($price_list_id, string $contentType = self::contentTypes['priceListUnlockEdit'][0])
    {
        return $this->priceListUnlockEditAsyncWithHttpInfo($price_list_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation priceListUnlockEditAsyncWithHttpInfo
     *
     * odemčení ceníku
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function priceListUnlockEditAsyncWithHttpInfo($price_list_id, string $contentType = self::contentTypes['priceListUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->priceListUnlockEditRequest($price_list_id, $contentType);

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
     * Create request for operation 'priceListUnlockEdit'
     *
     * @param  int $price_list_id ID ceníku (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['priceListUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function priceListUnlockEditRequest($price_list_id, string $contentType = self::contentTypes['priceListUnlockEdit'][0])
    {

        // verify the required parameter 'price_list_id' is set
        if ($price_list_id === null || (is_array($price_list_id) && count($price_list_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $price_list_id when calling priceListUnlockEdit'
            );
        }


        $resourcePath = '/priceList/{priceListId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($price_list_id !== null) {
            $resourcePath = str_replace(
                '{' . 'priceListId' . '}',
                ObjectSerializer::toPathValue($price_list_id),
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
