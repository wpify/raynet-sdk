<?php
/**
 * NabdkyApi
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
 * NabdkyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class NabdkyApi
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
        'offerDelete' => [
            'application/json',
        ],
        'offerDetailGet' => [
            'application/json',
        ],
        'offerEdit' => [
            'application/json',
        ],
        'offerGet' => [
            'application/json',
        ],
        'offerInsert' => [
            'application/json',
        ],
        'offerInvalidEdit' => [
            'application/json',
        ],
        'offerItemDelete' => [
            'application/json',
        ],
        'offerItemEdit' => [
            'application/json',
        ],
        'offerItemInsert' => [
            'application/json',
        ],
        'offerLockEdit' => [
            'application/json',
        ],
        'offerPdfExportDetailGet' => [
            'application/json',
        ],
        'offerSyncDelete' => [
            'application/json',
        ],
        'offerSyncEdit' => [
            'application/json',
        ],
        'offerUnlockEdit' => [
            'application/json',
        ],
        'offerValidEdit' => [
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
     * Operation offerDelete
     *
     * smazání nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerDelete($offer_id, string $contentType = self::contentTypes['offerDelete'][0])
    {
        $this->offerDeleteWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerDeleteWithHttpInfo
     *
     * smazání nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerDeleteWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerDelete'][0])
    {
        $request = $this->offerDeleteRequest($offer_id, $contentType);

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
     * Operation offerDeleteAsync
     *
     * smazání nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerDeleteAsync($offer_id, string $contentType = self::contentTypes['offerDelete'][0])
    {
        return $this->offerDeleteAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerDeleteAsyncWithHttpInfo
     *
     * smazání nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerDeleteAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerDelete'][0])
    {
        $returnType = '';
        $request = $this->offerDeleteRequest($offer_id, $contentType);

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
     * Create request for operation 'offerDelete'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerDeleteRequest($offer_id, string $contentType = self::contentTypes['offerDelete'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerDelete'
            );
        }


        $resourcePath = '/offer/{offerId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerDetailGet
     *
     * detail nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerDetailGet($offer_id, string $contentType = self::contentTypes['offerDetailGet'][0])
    {
        $this->offerDetailGetWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerDetailGetWithHttpInfo
     *
     * detail nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerDetailGetWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerDetailGet'][0])
    {
        $request = $this->offerDetailGetRequest($offer_id, $contentType);

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
     * Operation offerDetailGetAsync
     *
     * detail nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerDetailGetAsync($offer_id, string $contentType = self::contentTypes['offerDetailGet'][0])
    {
        return $this->offerDetailGetAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerDetailGetAsyncWithHttpInfo
     *
     * detail nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerDetailGetAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerDetailGet'][0])
    {
        $returnType = '';
        $request = $this->offerDetailGetRequest($offer_id, $contentType);

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
     * Create request for operation 'offerDetailGet'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerDetailGetRequest($offer_id, string $contentType = self::contentTypes['offerDetailGet'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerDetailGet'
            );
        }


        $resourcePath = '/offer/{offerId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerEdit
     *
     * upravení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferEditDto $offer_edit_dto offer_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerEdit($offer_id, $offer_edit_dto = null, string $contentType = self::contentTypes['offerEdit'][0])
    {
        $this->offerEditWithHttpInfo($offer_id, $offer_edit_dto, $contentType);
    }

    /**
     * Operation offerEditWithHttpInfo
     *
     * upravení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferEditDto $offer_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerEditWithHttpInfo($offer_id, $offer_edit_dto = null, string $contentType = self::contentTypes['offerEdit'][0])
    {
        $request = $this->offerEditRequest($offer_id, $offer_edit_dto, $contentType);

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
     * Operation offerEditAsync
     *
     * upravení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferEditDto $offer_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerEditAsync($offer_id, $offer_edit_dto = null, string $contentType = self::contentTypes['offerEdit'][0])
    {
        return $this->offerEditAsyncWithHttpInfo($offer_id, $offer_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerEditAsyncWithHttpInfo
     *
     * upravení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferEditDto $offer_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerEditAsyncWithHttpInfo($offer_id, $offer_edit_dto = null, string $contentType = self::contentTypes['offerEdit'][0])
    {
        $returnType = '';
        $request = $this->offerEditRequest($offer_id, $offer_edit_dto, $contentType);

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
     * Create request for operation 'offerEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferEditDto $offer_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerEditRequest($offer_id, $offer_edit_dto = null, string $contentType = self::contentTypes['offerEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerEdit'
            );
        }



        $resourcePath = '/offer/{offerId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($offer_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($offer_edit_dto));
            } else {
                $httpBody = $offer_edit_dto;
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
     * Operation offerGet
     *
     * seznam nabídek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $offer_status Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $valid_from = null, $valid_till = null, $status = null, $offer_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['offerGet'][0])
    {
        $this->offerGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);
    }

    /**
     * Operation offerGetWithHttpInfo
     *
     * seznam nabídek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $offer_status Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $valid_from = null, $valid_till = null, $status = null, $offer_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['offerGet'][0])
    {
        $request = $this->offerGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);

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
     * Operation offerGetAsync
     *
     * seznam nabídek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $offer_status Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $valid_from = null, $valid_till = null, $status = null, $offer_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['offerGet'][0])
    {
        return $this->offerGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerGetAsyncWithHttpInfo
     *
     * seznam nabídek
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $offer_status Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $valid_from = null, $valid_till = null, $status = null, $offer_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['offerGet'][0])
    {
        $returnType = '';
        $request = $this->offerGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $code, $name, $company, $person, $business_case, $owner, $expiration_date, $valid_from, $valid_till, $status, $offer_status, $contains_product, $product_category, $product_line, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $row_info_row_access, $view, $tags, $contentType);

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
     * Create request for operation 'offerGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $code Filtrování nabídek podle kódu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $name Filtrování nabídek podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $company Filtrování nabídek podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $person Filtrování nabídek podle kontaktní osoby. Filtruje se podle jednoznačného identifikátoru kontaktní osoby (id) (optional)
     * @param  int $business_case Filtrování nabídek podle obchodního případu nabídky. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  int $owner Filtrování nabídek podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  string $expiration_date Filtrování nabídek podle data vypršení nabídky. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_from Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $valid_till Filtrování nabídek podle data otevření. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování nabídek podle skupiny stavu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;.  - &#x60;B_ACTIVE&#x60; otevřené nabídky,  - &#x60;E_WIN&#x60; vyhrané nabídky,  - &#x60;F_LOST&#x60; prohrané nabídky,  - &#x60;G_STORNO&#x60; stornované nabídky (optional)
     * @param  int $offer_status Filtrování nabídek podle stavu (OfferStatus). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;, &#x60;NOT_IN&#x60; (optional)
     * @param  int $contains_product Filtrování nabídek podle produktu. Pokud záznam obsahuje zvolený produkt, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; (optional)
     * @param  int $product_category Filtrování nabídek podle kategorie produktu. Pokud záznam obsahuje produkt ve vybrané kategorii, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productCategory[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  int $product_line Filtrování nabídek podle produktové řady produktu. Pokud záznam obsahuje produkt ve vybrané produktové řadě, bude zobrazen. Je nutné použít operátor &#x60;CUSTOM&#x60; a lze použít více hodnot &#x60;productLine[CUSTOM]&#x3D;1,2,3&#x60; (optional)
     * @param  string $row_info_created_at Filtrování nabídek podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování nabídek podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování nabídek podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných nabídek. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $code = null, $name = null, $company = null, $person = null, $business_case = null, $owner = null, $expiration_date = null, $valid_from = null, $valid_till = null, $status = null, $offer_status = null, $contains_product = null, $product_category = null, $product_line = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $row_info_row_access = null, $view = null, $tags = null, string $contentType = self::contentTypes['offerGet'][0])
    {



























        $resourcePath = '/offer/';
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
            $offer_status,
            'offerStatus', // param base name
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
     * Operation offerInsert
     *
     * nová nabídka
     *
     * @param  \RaynetApiClient\Model\OfferInsertDto $offer_insert_dto offer_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function offerInsert($offer_insert_dto = null, string $contentType = self::contentTypes['offerInsert'][0])
    {
        list($response) = $this->offerInsertWithHttpInfo($offer_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation offerInsertWithHttpInfo
     *
     * nová nabídka
     *
     * @param  \RaynetApiClient\Model\OfferInsertDto $offer_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerInsertWithHttpInfo($offer_insert_dto = null, string $contentType = self::contentTypes['offerInsert'][0])
    {
        $request = $this->offerInsertRequest($offer_insert_dto, $contentType);

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
     * Operation offerInsertAsync
     *
     * nová nabídka
     *
     * @param  \RaynetApiClient\Model\OfferInsertDto $offer_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerInsertAsync($offer_insert_dto = null, string $contentType = self::contentTypes['offerInsert'][0])
    {
        return $this->offerInsertAsyncWithHttpInfo($offer_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerInsertAsyncWithHttpInfo
     *
     * nová nabídka
     *
     * @param  \RaynetApiClient\Model\OfferInsertDto $offer_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerInsertAsyncWithHttpInfo($offer_insert_dto = null, string $contentType = self::contentTypes['offerInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->offerInsertRequest($offer_insert_dto, $contentType);

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
     * Create request for operation 'offerInsert'
     *
     * @param  \RaynetApiClient\Model\OfferInsertDto $offer_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerInsertRequest($offer_insert_dto = null, string $contentType = self::contentTypes['offerInsert'][0])
    {



        $resourcePath = '/offer/';
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
        if (isset($offer_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($offer_insert_dto));
            } else {
                $httpBody = $offer_insert_dto;
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
     * Operation offerInvalidEdit
     *
     * zneplatnění nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerInvalidEdit($offer_id, string $contentType = self::contentTypes['offerInvalidEdit'][0])
    {
        $this->offerInvalidEditWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerInvalidEditWithHttpInfo
     *
     * zneplatnění nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerInvalidEditWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerInvalidEdit'][0])
    {
        $request = $this->offerInvalidEditRequest($offer_id, $contentType);

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
     * Operation offerInvalidEditAsync
     *
     * zneplatnění nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerInvalidEditAsync($offer_id, string $contentType = self::contentTypes['offerInvalidEdit'][0])
    {
        return $this->offerInvalidEditAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerInvalidEditAsyncWithHttpInfo
     *
     * zneplatnění nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerInvalidEditAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerInvalidEdit'][0])
    {
        $returnType = '';
        $request = $this->offerInvalidEditRequest($offer_id, $contentType);

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
     * Create request for operation 'offerInvalidEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerInvalidEditRequest($offer_id, string $contentType = self::contentTypes['offerInvalidEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerInvalidEdit'
            );
        }


        $resourcePath = '/offer/{offerId}/invalid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerItemDelete
     *
     * smazání položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerItemDelete($offer_id, $offer_item_id, string $contentType = self::contentTypes['offerItemDelete'][0])
    {
        $this->offerItemDeleteWithHttpInfo($offer_id, $offer_item_id, $contentType);
    }

    /**
     * Operation offerItemDeleteWithHttpInfo
     *
     * smazání položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerItemDeleteWithHttpInfo($offer_id, $offer_item_id, string $contentType = self::contentTypes['offerItemDelete'][0])
    {
        $request = $this->offerItemDeleteRequest($offer_id, $offer_item_id, $contentType);

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
     * Operation offerItemDeleteAsync
     *
     * smazání položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemDeleteAsync($offer_id, $offer_item_id, string $contentType = self::contentTypes['offerItemDelete'][0])
    {
        return $this->offerItemDeleteAsyncWithHttpInfo($offer_id, $offer_item_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerItemDeleteAsyncWithHttpInfo
     *
     * smazání položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemDeleteAsyncWithHttpInfo($offer_id, $offer_item_id, string $contentType = self::contentTypes['offerItemDelete'][0])
    {
        $returnType = '';
        $request = $this->offerItemDeleteRequest($offer_id, $offer_item_id, $contentType);

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
     * Create request for operation 'offerItemDelete'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerItemDeleteRequest($offer_id, $offer_item_id, string $contentType = self::contentTypes['offerItemDelete'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerItemDelete'
            );
        }

        // verify the required parameter 'offer_item_id' is set
        if ($offer_item_id === null || (is_array($offer_item_id) && count($offer_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_item_id when calling offerItemDelete'
            );
        }


        $resourcePath = '/offer/{offerId}/item/{offerItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
                $resourcePath
            );
        }
        // path params
        if ($offer_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerItemId' . '}',
                ObjectSerializer::toPathValue($offer_item_id),
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
     * Operation offerItemEdit
     *
     * upravení položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemEditDto $offer_item_edit_dto offer_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerItemEdit($offer_id, $offer_item_id, $offer_item_edit_dto = null, string $contentType = self::contentTypes['offerItemEdit'][0])
    {
        $this->offerItemEditWithHttpInfo($offer_id, $offer_item_id, $offer_item_edit_dto, $contentType);
    }

    /**
     * Operation offerItemEditWithHttpInfo
     *
     * upravení položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemEditDto $offer_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerItemEditWithHttpInfo($offer_id, $offer_item_id, $offer_item_edit_dto = null, string $contentType = self::contentTypes['offerItemEdit'][0])
    {
        $request = $this->offerItemEditRequest($offer_id, $offer_item_id, $offer_item_edit_dto, $contentType);

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
     * Operation offerItemEditAsync
     *
     * upravení položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemEditDto $offer_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemEditAsync($offer_id, $offer_item_id, $offer_item_edit_dto = null, string $contentType = self::contentTypes['offerItemEdit'][0])
    {
        return $this->offerItemEditAsyncWithHttpInfo($offer_id, $offer_item_id, $offer_item_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerItemEditAsyncWithHttpInfo
     *
     * upravení položky nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemEditDto $offer_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemEditAsyncWithHttpInfo($offer_id, $offer_item_id, $offer_item_edit_dto = null, string $contentType = self::contentTypes['offerItemEdit'][0])
    {
        $returnType = '';
        $request = $this->offerItemEditRequest($offer_id, $offer_item_id, $offer_item_edit_dto, $contentType);

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
     * Create request for operation 'offerItemEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  int $offer_item_id ID položky nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemEditDto $offer_item_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerItemEditRequest($offer_id, $offer_item_id, $offer_item_edit_dto = null, string $contentType = self::contentTypes['offerItemEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerItemEdit'
            );
        }

        // verify the required parameter 'offer_item_id' is set
        if ($offer_item_id === null || (is_array($offer_item_id) && count($offer_item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_item_id when calling offerItemEdit'
            );
        }



        $resourcePath = '/offer/{offerId}/item/{offerItemId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
                $resourcePath
            );
        }
        // path params
        if ($offer_item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerItemId' . '}',
                ObjectSerializer::toPathValue($offer_item_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($offer_item_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($offer_item_edit_dto));
            } else {
                $httpBody = $offer_item_edit_dto;
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
     * Operation offerItemInsert
     *
     * přidání položek nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemInsertDto $offer_item_insert_dto offer_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerItemInsert($offer_id, $offer_item_insert_dto = null, string $contentType = self::contentTypes['offerItemInsert'][0])
    {
        $this->offerItemInsertWithHttpInfo($offer_id, $offer_item_insert_dto, $contentType);
    }

    /**
     * Operation offerItemInsertWithHttpInfo
     *
     * přidání položek nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemInsertDto $offer_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerItemInsertWithHttpInfo($offer_id, $offer_item_insert_dto = null, string $contentType = self::contentTypes['offerItemInsert'][0])
    {
        $request = $this->offerItemInsertRequest($offer_id, $offer_item_insert_dto, $contentType);

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
     * Operation offerItemInsertAsync
     *
     * přidání položek nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemInsertDto $offer_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemInsertAsync($offer_id, $offer_item_insert_dto = null, string $contentType = self::contentTypes['offerItemInsert'][0])
    {
        return $this->offerItemInsertAsyncWithHttpInfo($offer_id, $offer_item_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerItemInsertAsyncWithHttpInfo
     *
     * přidání položek nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemInsertDto $offer_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerItemInsertAsyncWithHttpInfo($offer_id, $offer_item_insert_dto = null, string $contentType = self::contentTypes['offerItemInsert'][0])
    {
        $returnType = '';
        $request = $this->offerItemInsertRequest($offer_id, $offer_item_insert_dto, $contentType);

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
     * Create request for operation 'offerItemInsert'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  \RaynetApiClient\Model\OfferItemInsertDto $offer_item_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerItemInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerItemInsertRequest($offer_id, $offer_item_insert_dto = null, string $contentType = self::contentTypes['offerItemInsert'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerItemInsert'
            );
        }



        $resourcePath = '/offer/{offerId}/item/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($offer_item_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($offer_item_insert_dto));
            } else {
                $httpBody = $offer_item_insert_dto;
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
     * Operation offerLockEdit
     *
     * uzamčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerLockEdit($offer_id, string $contentType = self::contentTypes['offerLockEdit'][0])
    {
        $this->offerLockEditWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerLockEditWithHttpInfo
     *
     * uzamčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerLockEditWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerLockEdit'][0])
    {
        $request = $this->offerLockEditRequest($offer_id, $contentType);

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
     * Operation offerLockEditAsync
     *
     * uzamčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerLockEditAsync($offer_id, string $contentType = self::contentTypes['offerLockEdit'][0])
    {
        return $this->offerLockEditAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerLockEditAsyncWithHttpInfo
     *
     * uzamčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerLockEditAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerLockEdit'][0])
    {
        $returnType = '';
        $request = $this->offerLockEditRequest($offer_id, $contentType);

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
     * Create request for operation 'offerLockEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerLockEditRequest($offer_id, string $contentType = self::contentTypes['offerLockEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerLockEdit'
            );
        }


        $resourcePath = '/offer/{offerId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerPdfExportDetailGet
     *
     * export nabídky do PDF
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $locale Jazyk exportované nabídky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerPdfExportDetailGet($offer_id, $locale = null, string $contentType = self::contentTypes['offerPdfExportDetailGet'][0])
    {
        $this->offerPdfExportDetailGetWithHttpInfo($offer_id, $locale, $contentType);
    }

    /**
     * Operation offerPdfExportDetailGetWithHttpInfo
     *
     * export nabídky do PDF
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $locale Jazyk exportované nabídky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerPdfExportDetailGetWithHttpInfo($offer_id, $locale = null, string $contentType = self::contentTypes['offerPdfExportDetailGet'][0])
    {
        $request = $this->offerPdfExportDetailGetRequest($offer_id, $locale, $contentType);

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
     * Operation offerPdfExportDetailGetAsync
     *
     * export nabídky do PDF
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $locale Jazyk exportované nabídky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerPdfExportDetailGetAsync($offer_id, $locale = null, string $contentType = self::contentTypes['offerPdfExportDetailGet'][0])
    {
        return $this->offerPdfExportDetailGetAsyncWithHttpInfo($offer_id, $locale, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerPdfExportDetailGetAsyncWithHttpInfo
     *
     * export nabídky do PDF
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $locale Jazyk exportované nabídky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerPdfExportDetailGetAsyncWithHttpInfo($offer_id, $locale = null, string $contentType = self::contentTypes['offerPdfExportDetailGet'][0])
    {
        $returnType = '';
        $request = $this->offerPdfExportDetailGetRequest($offer_id, $locale, $contentType);

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
     * Create request for operation 'offerPdfExportDetailGet'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $locale Jazyk exportované nabídky (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerPdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerPdfExportDetailGetRequest($offer_id, $locale = null, string $contentType = self::contentTypes['offerPdfExportDetailGet'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerPdfExportDetailGet'
            );
        }



        $resourcePath = '/offer/{offerId}/pdfExport';
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
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerSyncDelete
     *
     * zrušení synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerSyncDelete($offer_id, string $contentType = self::contentTypes['offerSyncDelete'][0])
    {
        $this->offerSyncDeleteWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerSyncDeleteWithHttpInfo
     *
     * zrušení synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerSyncDeleteWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerSyncDelete'][0])
    {
        $request = $this->offerSyncDeleteRequest($offer_id, $contentType);

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
     * Operation offerSyncDeleteAsync
     *
     * zrušení synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerSyncDeleteAsync($offer_id, string $contentType = self::contentTypes['offerSyncDelete'][0])
    {
        return $this->offerSyncDeleteAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerSyncDeleteAsyncWithHttpInfo
     *
     * zrušení synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerSyncDeleteAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerSyncDelete'][0])
    {
        $returnType = '';
        $request = $this->offerSyncDeleteRequest($offer_id, $contentType);

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
     * Create request for operation 'offerSyncDelete'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerSyncDeleteRequest($offer_id, string $contentType = self::contentTypes['offerSyncDelete'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerSyncDelete'
            );
        }


        $resourcePath = '/offer/{offerId}/sync';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerSyncEdit
     *
     * synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerSyncEdit($offer_id, string $contentType = self::contentTypes['offerSyncEdit'][0])
    {
        $this->offerSyncEditWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerSyncEditWithHttpInfo
     *
     * synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerSyncEditWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerSyncEdit'][0])
    {
        $request = $this->offerSyncEditRequest($offer_id, $contentType);

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
     * Operation offerSyncEditAsync
     *
     * synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerSyncEditAsync($offer_id, string $contentType = self::contentTypes['offerSyncEdit'][0])
    {
        return $this->offerSyncEditAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerSyncEditAsyncWithHttpInfo
     *
     * synchronizace nabídky s obchodním případem
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerSyncEditAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerSyncEdit'][0])
    {
        $returnType = '';
        $request = $this->offerSyncEditRequest($offer_id, $contentType);

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
     * Create request for operation 'offerSyncEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerSyncEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerSyncEditRequest($offer_id, string $contentType = self::contentTypes['offerSyncEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerSyncEdit'
            );
        }


        $resourcePath = '/offer/{offerId}/sync';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerUnlockEdit
     *
     * odemčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerUnlockEdit($offer_id, string $contentType = self::contentTypes['offerUnlockEdit'][0])
    {
        $this->offerUnlockEditWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerUnlockEditWithHttpInfo
     *
     * odemčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerUnlockEditWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerUnlockEdit'][0])
    {
        $request = $this->offerUnlockEditRequest($offer_id, $contentType);

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
     * Operation offerUnlockEditAsync
     *
     * odemčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerUnlockEditAsync($offer_id, string $contentType = self::contentTypes['offerUnlockEdit'][0])
    {
        return $this->offerUnlockEditAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerUnlockEditAsyncWithHttpInfo
     *
     * odemčení nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerUnlockEditAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->offerUnlockEditRequest($offer_id, $contentType);

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
     * Create request for operation 'offerUnlockEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerUnlockEditRequest($offer_id, string $contentType = self::contentTypes['offerUnlockEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerUnlockEdit'
            );
        }


        $resourcePath = '/offer/{offerId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
     * Operation offerValidEdit
     *
     * obnovení platnosti nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function offerValidEdit($offer_id, string $contentType = self::contentTypes['offerValidEdit'][0])
    {
        $this->offerValidEditWithHttpInfo($offer_id, $contentType);
    }

    /**
     * Operation offerValidEditWithHttpInfo
     *
     * obnovení platnosti nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function offerValidEditWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerValidEdit'][0])
    {
        $request = $this->offerValidEditRequest($offer_id, $contentType);

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
     * Operation offerValidEditAsync
     *
     * obnovení platnosti nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerValidEditAsync($offer_id, string $contentType = self::contentTypes['offerValidEdit'][0])
    {
        return $this->offerValidEditAsyncWithHttpInfo($offer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation offerValidEditAsyncWithHttpInfo
     *
     * obnovení platnosti nabídky
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function offerValidEditAsyncWithHttpInfo($offer_id, string $contentType = self::contentTypes['offerValidEdit'][0])
    {
        $returnType = '';
        $request = $this->offerValidEditRequest($offer_id, $contentType);

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
     * Create request for operation 'offerValidEdit'
     *
     * @param  int $offer_id ID nabídky (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['offerValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function offerValidEditRequest($offer_id, string $contentType = self::contentTypes['offerValidEdit'][0])
    {

        // verify the required parameter 'offer_id' is set
        if ($offer_id === null || (is_array($offer_id) && count($offer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $offer_id when calling offerValidEdit'
            );
        }


        $resourcePath = '/offer/{offerId}/valid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($offer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'offerId' . '}',
                ObjectSerializer::toPathValue($offer_id),
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
