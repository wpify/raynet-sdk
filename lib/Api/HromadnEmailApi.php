<?php
/**
 * HromadnEmailApi
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
 * HromadnEmailApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class HromadnEmailApi
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
        'massEmailDelete' => [
            'application/json',
        ],
        'massEmailDetailGet' => [
            'application/json',
        ],
        'massEmailEdit' => [
            'application/json',
        ],
        'massEmailGet' => [
            'application/json',
        ],
        'massEmailInsert' => [
            'application/json',
        ],
        'massEmailRecipientBulkDeleteEdit' => [
            'application/json',
        ],
        'massEmailRecipientBulkUpdateEdit' => [
            'application/json',
        ],
        'massEmailRecipientDelete' => [
            'application/json',
        ],
        'massEmailRecipientDetailGet' => [
            'application/json',
        ],
        'massEmailRecipientEdit' => [
            'application/json',
        ],
        'massEmailRecipientInsert' => [
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
     * Operation massEmailDelete
     *
     * smazání hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailDelete($mass_email_id, string $contentType = self::contentTypes['massEmailDelete'][0])
    {
        $this->massEmailDeleteWithHttpInfo($mass_email_id, $contentType);
    }

    /**
     * Operation massEmailDeleteWithHttpInfo
     *
     * smazání hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailDeleteWithHttpInfo($mass_email_id, string $contentType = self::contentTypes['massEmailDelete'][0])
    {
        $request = $this->massEmailDeleteRequest($mass_email_id, $contentType);

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
     * Operation massEmailDeleteAsync
     *
     * smazání hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailDeleteAsync($mass_email_id, string $contentType = self::contentTypes['massEmailDelete'][0])
    {
        return $this->massEmailDeleteAsyncWithHttpInfo($mass_email_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailDeleteAsyncWithHttpInfo
     *
     * smazání hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailDeleteAsyncWithHttpInfo($mass_email_id, string $contentType = self::contentTypes['massEmailDelete'][0])
    {
        $returnType = '';
        $request = $this->massEmailDeleteRequest($mass_email_id, $contentType);

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
     * Create request for operation 'massEmailDelete'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailDeleteRequest($mass_email_id, string $contentType = self::contentTypes['massEmailDelete'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailDelete'
            );
        }


        $resourcePath = '/massEmail/{massEmailId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
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
     * Operation massEmailDetailGet
     *
     * detail hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailDetailGet($mass_email_id, string $contentType = self::contentTypes['massEmailDetailGet'][0])
    {
        $this->massEmailDetailGetWithHttpInfo($mass_email_id, $contentType);
    }

    /**
     * Operation massEmailDetailGetWithHttpInfo
     *
     * detail hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailDetailGetWithHttpInfo($mass_email_id, string $contentType = self::contentTypes['massEmailDetailGet'][0])
    {
        $request = $this->massEmailDetailGetRequest($mass_email_id, $contentType);

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
     * Operation massEmailDetailGetAsync
     *
     * detail hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailDetailGetAsync($mass_email_id, string $contentType = self::contentTypes['massEmailDetailGet'][0])
    {
        return $this->massEmailDetailGetAsyncWithHttpInfo($mass_email_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailDetailGetAsyncWithHttpInfo
     *
     * detail hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailDetailGetAsyncWithHttpInfo($mass_email_id, string $contentType = self::contentTypes['massEmailDetailGet'][0])
    {
        $returnType = '';
        $request = $this->massEmailDetailGetRequest($mass_email_id, $contentType);

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
     * Create request for operation 'massEmailDetailGet'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailDetailGetRequest($mass_email_id, string $contentType = self::contentTypes['massEmailDetailGet'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailDetailGet'
            );
        }


        $resourcePath = '/massEmail/{massEmailId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
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
     * Operation massEmailEdit
     *
     * upravení hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailEditDto $mass_email_edit_dto mass_email_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailEdit($mass_email_id, $mass_email_edit_dto = null, string $contentType = self::contentTypes['massEmailEdit'][0])
    {
        $this->massEmailEditWithHttpInfo($mass_email_id, $mass_email_edit_dto, $contentType);
    }

    /**
     * Operation massEmailEditWithHttpInfo
     *
     * upravení hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailEditDto $mass_email_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailEditWithHttpInfo($mass_email_id, $mass_email_edit_dto = null, string $contentType = self::contentTypes['massEmailEdit'][0])
    {
        $request = $this->massEmailEditRequest($mass_email_id, $mass_email_edit_dto, $contentType);

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
     * Operation massEmailEditAsync
     *
     * upravení hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailEditDto $mass_email_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailEditAsync($mass_email_id, $mass_email_edit_dto = null, string $contentType = self::contentTypes['massEmailEdit'][0])
    {
        return $this->massEmailEditAsyncWithHttpInfo($mass_email_id, $mass_email_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailEditAsyncWithHttpInfo
     *
     * upravení hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailEditDto $mass_email_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailEditAsyncWithHttpInfo($mass_email_id, $mass_email_edit_dto = null, string $contentType = self::contentTypes['massEmailEdit'][0])
    {
        $returnType = '';
        $request = $this->massEmailEditRequest($mass_email_id, $mass_email_edit_dto, $contentType);

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
     * Create request for operation 'massEmailEdit'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailEditDto $mass_email_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailEditRequest($mass_email_id, $mass_email_edit_dto = null, string $contentType = self::contentTypes['massEmailEdit'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailEdit'
            );
        }



        $resourcePath = '/massEmail/{massEmailId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($mass_email_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($mass_email_edit_dto));
            } else {
                $httpBody = $mass_email_edit_dto;
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
     * Operation massEmailGet
     *
     * seznam hromadných emailů
     *
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $tags Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $completed Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $campaign_name Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $source Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $tags = null, $completed = null, $campaign_name = null, $source = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailGet'][0])
    {
        $this->massEmailGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);
    }

    /**
     * Operation massEmailGetWithHttpInfo
     *
     * seznam hromadných emailů
     *
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $tags Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $completed Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $campaign_name Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $source Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $tags = null, $completed = null, $campaign_name = null, $source = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailGet'][0])
    {
        $request = $this->massEmailGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Operation massEmailGetAsync
     *
     * seznam hromadných emailů
     *
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $tags Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $completed Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $campaign_name Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $source Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $tags = null, $completed = null, $campaign_name = null, $source = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailGet'][0])
    {
        return $this->massEmailGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailGetAsyncWithHttpInfo
     *
     * seznam hromadných emailů
     *
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $tags Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $completed Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $campaign_name Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $source Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $tags = null, $completed = null, $campaign_name = null, $source = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailGet'][0])
    {
        $returnType = '';
        $request = $this->massEmailGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $tags, $completed, $campaign_name, $source, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Create request for operation 'massEmailGet'
     *
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování hromadných emailů podle názvu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $tags Filtrování hromadných emailů podle štítků. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $completed Filtrování hromadných emailů podle data odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $campaign_name Filtrování hromadných emailů podle názvu kampaně (pojmenování v externí emailové službě). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $source Filtrování hromadných emailů podle zdroje. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování hromadných emailů podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování hromadných emailů podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování hromadných emailů podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $tags = null, $completed = null, $campaign_name = null, $source = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailGet'][0])
    {
















        $resourcePath = '/massEmail/';
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
            $title,
            'title', // param base name
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
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $completed,
            'completed', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $campaign_name,
            'campaignName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $source,
            'source', // param base name
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
     * Operation massEmailInsert
     *
     * založení nového hromadného emailu
     *
     * @param  \RaynetApiClient\Model\MassEmailInsertDto $mass_email_insert_dto mass_email_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function massEmailInsert($mass_email_insert_dto = null, string $contentType = self::contentTypes['massEmailInsert'][0])
    {
        list($response) = $this->massEmailInsertWithHttpInfo($mass_email_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation massEmailInsertWithHttpInfo
     *
     * založení nového hromadného emailu
     *
     * @param  \RaynetApiClient\Model\MassEmailInsertDto $mass_email_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailInsertWithHttpInfo($mass_email_insert_dto = null, string $contentType = self::contentTypes['massEmailInsert'][0])
    {
        $request = $this->massEmailInsertRequest($mass_email_insert_dto, $contentType);

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
     * Operation massEmailInsertAsync
     *
     * založení nového hromadného emailu
     *
     * @param  \RaynetApiClient\Model\MassEmailInsertDto $mass_email_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailInsertAsync($mass_email_insert_dto = null, string $contentType = self::contentTypes['massEmailInsert'][0])
    {
        return $this->massEmailInsertAsyncWithHttpInfo($mass_email_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailInsertAsyncWithHttpInfo
     *
     * založení nového hromadného emailu
     *
     * @param  \RaynetApiClient\Model\MassEmailInsertDto $mass_email_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailInsertAsyncWithHttpInfo($mass_email_insert_dto = null, string $contentType = self::contentTypes['massEmailInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->massEmailInsertRequest($mass_email_insert_dto, $contentType);

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
     * Create request for operation 'massEmailInsert'
     *
     * @param  \RaynetApiClient\Model\MassEmailInsertDto $mass_email_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailInsertRequest($mass_email_insert_dto = null, string $contentType = self::contentTypes['massEmailInsert'][0])
    {



        $resourcePath = '/massEmail/';
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
        if (isset($mass_email_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($mass_email_insert_dto));
            } else {
                $httpBody = $mass_email_insert_dto;
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
     * Operation massEmailRecipientBulkDeleteEdit
     *
     * smazání adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string[] $request_body request_body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkDeleteEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailRecipientBulkDeleteEdit($mass_email_id, $request_body = null, string $contentType = self::contentTypes['massEmailRecipientBulkDeleteEdit'][0])
    {
        $this->massEmailRecipientBulkDeleteEditWithHttpInfo($mass_email_id, $request_body, $contentType);
    }

    /**
     * Operation massEmailRecipientBulkDeleteEditWithHttpInfo
     *
     * smazání adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string[] $request_body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkDeleteEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientBulkDeleteEditWithHttpInfo($mass_email_id, $request_body = null, string $contentType = self::contentTypes['massEmailRecipientBulkDeleteEdit'][0])
    {
        $request = $this->massEmailRecipientBulkDeleteEditRequest($mass_email_id, $request_body, $contentType);

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
     * Operation massEmailRecipientBulkDeleteEditAsync
     *
     * smazání adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string[] $request_body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkDeleteEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientBulkDeleteEditAsync($mass_email_id, $request_body = null, string $contentType = self::contentTypes['massEmailRecipientBulkDeleteEdit'][0])
    {
        return $this->massEmailRecipientBulkDeleteEditAsyncWithHttpInfo($mass_email_id, $request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientBulkDeleteEditAsyncWithHttpInfo
     *
     * smazání adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string[] $request_body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkDeleteEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientBulkDeleteEditAsyncWithHttpInfo($mass_email_id, $request_body = null, string $contentType = self::contentTypes['massEmailRecipientBulkDeleteEdit'][0])
    {
        $returnType = '';
        $request = $this->massEmailRecipientBulkDeleteEditRequest($mass_email_id, $request_body, $contentType);

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
     * Create request for operation 'massEmailRecipientBulkDeleteEdit'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  string[] $request_body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkDeleteEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientBulkDeleteEditRequest($mass_email_id, $request_body = null, string $contentType = self::contentTypes['massEmailRecipientBulkDeleteEdit'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientBulkDeleteEdit'
            );
        }



        $resourcePath = '/massEmail/{massEmailId}/recipientBulkDelete/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
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
     * Operation massEmailRecipientBulkUpdateEdit
     *
     * vložení/upravení adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[] $mass_email_recipient_bulk_update_edit_dto_inner mass_email_recipient_bulk_update_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkUpdateEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function massEmailRecipientBulkUpdateEdit($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner = null, string $contentType = self::contentTypes['massEmailRecipientBulkUpdateEdit'][0])
    {
        list($response) = $this->massEmailRecipientBulkUpdateEditWithHttpInfo($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner, $contentType);
        return $response;
    }

    /**
     * Operation massEmailRecipientBulkUpdateEditWithHttpInfo
     *
     * vložení/upravení adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[] $mass_email_recipient_bulk_update_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkUpdateEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of mixed, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientBulkUpdateEditWithHttpInfo($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner = null, string $contentType = self::contentTypes['massEmailRecipientBulkUpdateEdit'][0])
    {
        $request = $this->massEmailRecipientBulkUpdateEditRequest($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner, $contentType);

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
     * Operation massEmailRecipientBulkUpdateEditAsync
     *
     * vložení/upravení adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[] $mass_email_recipient_bulk_update_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkUpdateEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientBulkUpdateEditAsync($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner = null, string $contentType = self::contentTypes['massEmailRecipientBulkUpdateEdit'][0])
    {
        return $this->massEmailRecipientBulkUpdateEditAsyncWithHttpInfo($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientBulkUpdateEditAsyncWithHttpInfo
     *
     * vložení/upravení adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[] $mass_email_recipient_bulk_update_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkUpdateEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientBulkUpdateEditAsyncWithHttpInfo($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner = null, string $contentType = self::contentTypes['massEmailRecipientBulkUpdateEdit'][0])
    {
        $returnType = 'mixed';
        $request = $this->massEmailRecipientBulkUpdateEditRequest($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner, $contentType);

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
     * Create request for operation 'massEmailRecipientBulkUpdateEdit'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientBulkUpdateEditDtoInner[] $mass_email_recipient_bulk_update_edit_dto_inner (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientBulkUpdateEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientBulkUpdateEditRequest($mass_email_id, $mass_email_recipient_bulk_update_edit_dto_inner = null, string $contentType = self::contentTypes['massEmailRecipientBulkUpdateEdit'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientBulkUpdateEdit'
            );
        }



        $resourcePath = '/massEmail/{massEmailId}/recipientBulkUpdate/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($mass_email_recipient_bulk_update_edit_dto_inner)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($mass_email_recipient_bulk_update_edit_dto_inner));
            } else {
                $httpBody = $mass_email_recipient_bulk_update_edit_dto_inner;
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
     * Operation massEmailRecipientDelete
     *
     * smazání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailRecipientDelete($mass_email_id, $recipient_id, string $contentType = self::contentTypes['massEmailRecipientDelete'][0])
    {
        $this->massEmailRecipientDeleteWithHttpInfo($mass_email_id, $recipient_id, $contentType);
    }

    /**
     * Operation massEmailRecipientDeleteWithHttpInfo
     *
     * smazání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientDeleteWithHttpInfo($mass_email_id, $recipient_id, string $contentType = self::contentTypes['massEmailRecipientDelete'][0])
    {
        $request = $this->massEmailRecipientDeleteRequest($mass_email_id, $recipient_id, $contentType);

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
     * Operation massEmailRecipientDeleteAsync
     *
     * smazání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientDeleteAsync($mass_email_id, $recipient_id, string $contentType = self::contentTypes['massEmailRecipientDelete'][0])
    {
        return $this->massEmailRecipientDeleteAsyncWithHttpInfo($mass_email_id, $recipient_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientDeleteAsyncWithHttpInfo
     *
     * smazání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientDeleteAsyncWithHttpInfo($mass_email_id, $recipient_id, string $contentType = self::contentTypes['massEmailRecipientDelete'][0])
    {
        $returnType = '';
        $request = $this->massEmailRecipientDeleteRequest($mass_email_id, $recipient_id, $contentType);

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
     * Create request for operation 'massEmailRecipientDelete'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientDeleteRequest($mass_email_id, $recipient_id, string $contentType = self::contentTypes['massEmailRecipientDelete'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientDelete'
            );
        }

        // verify the required parameter 'recipient_id' is set
        if ($recipient_id === null || (is_array($recipient_id) && count($recipient_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $recipient_id when calling massEmailRecipientDelete'
            );
        }


        $resourcePath = '/massEmail/{massEmailId}/recipient/{recipientId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }
        // path params
        if ($recipient_id !== null) {
            $resourcePath = str_replace(
                '{' . 'recipientId' . '}',
                ObjectSerializer::toPathValue($recipient_id),
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
     * Operation massEmailRecipientDetailGet
     *
     * seznam adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $company Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $person Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $lead Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailRecipientDetailGet($mass_email_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $company = null, $person = null, $lead = null, $status = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailRecipientDetailGet'][0])
    {
        $this->massEmailRecipientDetailGetWithHttpInfo($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);
    }

    /**
     * Operation massEmailRecipientDetailGetWithHttpInfo
     *
     * seznam adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $company Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $person Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $lead Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientDetailGetWithHttpInfo($mass_email_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $company = null, $person = null, $lead = null, $status = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailRecipientDetailGet'][0])
    {
        $request = $this->massEmailRecipientDetailGetRequest($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Operation massEmailRecipientDetailGetAsync
     *
     * seznam adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $company Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $person Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $lead Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientDetailGetAsync($mass_email_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $company = null, $person = null, $lead = null, $status = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailRecipientDetailGet'][0])
    {
        return $this->massEmailRecipientDetailGetAsyncWithHttpInfo($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientDetailGetAsyncWithHttpInfo
     *
     * seznam adresátů hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $company Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $person Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $lead Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientDetailGetAsyncWithHttpInfo($mass_email_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $company = null, $person = null, $lead = null, $status = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailRecipientDetailGet'][0])
    {
        $returnType = '';
        $request = $this->massEmailRecipientDetailGetRequest($mass_email_id, $offset, $limit, $sort_column, $sort_direction, $fulltext, $company, $person, $lead, $status, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $contentType);

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
     * Create request for operation 'massEmailRecipientDetailGet'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $offset Od kterého záznamu v pořadí seznam zobrazit (stránkování) (optional)
     * @param  int $limit Maximální počet vrácených záznamů je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $company Filtrování adresátů podle jednoznačného identifikátoru klienta (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $person Filtrování adresátů podle jednoznačného identifikátoru kontaktní osoby (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $lead Filtrování adresátů podle jednoznačného identifikátoru leadu (id). Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $status Filtrování adresátů podle stavu odeslání. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. (optional)
     * @param  string $row_info_created_at Filtrování adresátů podle data vytvoření záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování adresátů podle posledního data upravení záznamu. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování OP podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientDetailGetRequest($mass_email_id, $offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $company = null, $person = null, $lead = null, $status = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, string $contentType = self::contentTypes['massEmailRecipientDetailGet'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientDetailGet'
            );
        }















        $resourcePath = '/massEmail/{massEmailId}/recipient/';
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
            $company,
            'company', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $person,
            'person', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lead,
            'lead', // param base name
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
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
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
     * Operation massEmailRecipientEdit
     *
     * upravení adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientEditDto $mass_email_recipient_edit_dto mass_email_recipient_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailRecipientEdit($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto = null, string $contentType = self::contentTypes['massEmailRecipientEdit'][0])
    {
        $this->massEmailRecipientEditWithHttpInfo($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto, $contentType);
    }

    /**
     * Operation massEmailRecipientEditWithHttpInfo
     *
     * upravení adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientEditDto $mass_email_recipient_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientEditWithHttpInfo($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto = null, string $contentType = self::contentTypes['massEmailRecipientEdit'][0])
    {
        $request = $this->massEmailRecipientEditRequest($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto, $contentType);

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
     * Operation massEmailRecipientEditAsync
     *
     * upravení adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientEditDto $mass_email_recipient_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientEditAsync($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto = null, string $contentType = self::contentTypes['massEmailRecipientEdit'][0])
    {
        return $this->massEmailRecipientEditAsyncWithHttpInfo($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientEditAsyncWithHttpInfo
     *
     * upravení adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientEditDto $mass_email_recipient_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientEditAsyncWithHttpInfo($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto = null, string $contentType = self::contentTypes['massEmailRecipientEdit'][0])
    {
        $returnType = '';
        $request = $this->massEmailRecipientEditRequest($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto, $contentType);

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
     * Create request for operation 'massEmailRecipientEdit'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  int $recipient_id ID adresáta (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientEditDto $mass_email_recipient_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientEditRequest($mass_email_id, $recipient_id, $mass_email_recipient_edit_dto = null, string $contentType = self::contentTypes['massEmailRecipientEdit'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientEdit'
            );
        }

        // verify the required parameter 'recipient_id' is set
        if ($recipient_id === null || (is_array($recipient_id) && count($recipient_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $recipient_id when calling massEmailRecipientEdit'
            );
        }



        $resourcePath = '/massEmail/{massEmailId}/recipient/{recipientId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }
        // path params
        if ($recipient_id !== null) {
            $resourcePath = str_replace(
                '{' . 'recipientId' . '}',
                ObjectSerializer::toPathValue($recipient_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($mass_email_recipient_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($mass_email_recipient_edit_dto));
            } else {
                $httpBody = $mass_email_recipient_edit_dto;
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
     * Operation massEmailRecipientInsert
     *
     * přidání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientInsertDto $mass_email_recipient_insert_dto mass_email_recipient_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function massEmailRecipientInsert($mass_email_id, $mass_email_recipient_insert_dto = null, string $contentType = self::contentTypes['massEmailRecipientInsert'][0])
    {
        $this->massEmailRecipientInsertWithHttpInfo($mass_email_id, $mass_email_recipient_insert_dto, $contentType);
    }

    /**
     * Operation massEmailRecipientInsertWithHttpInfo
     *
     * přidání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientInsertDto $mass_email_recipient_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function massEmailRecipientInsertWithHttpInfo($mass_email_id, $mass_email_recipient_insert_dto = null, string $contentType = self::contentTypes['massEmailRecipientInsert'][0])
    {
        $request = $this->massEmailRecipientInsertRequest($mass_email_id, $mass_email_recipient_insert_dto, $contentType);

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
     * Operation massEmailRecipientInsertAsync
     *
     * přidání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientInsertDto $mass_email_recipient_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientInsertAsync($mass_email_id, $mass_email_recipient_insert_dto = null, string $contentType = self::contentTypes['massEmailRecipientInsert'][0])
    {
        return $this->massEmailRecipientInsertAsyncWithHttpInfo($mass_email_id, $mass_email_recipient_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation massEmailRecipientInsertAsyncWithHttpInfo
     *
     * přidání adresáta hromadného emailu
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientInsertDto $mass_email_recipient_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function massEmailRecipientInsertAsyncWithHttpInfo($mass_email_id, $mass_email_recipient_insert_dto = null, string $contentType = self::contentTypes['massEmailRecipientInsert'][0])
    {
        $returnType = '';
        $request = $this->massEmailRecipientInsertRequest($mass_email_id, $mass_email_recipient_insert_dto, $contentType);

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
     * Create request for operation 'massEmailRecipientInsert'
     *
     * @param  int $mass_email_id ID hromadného emailu (required)
     * @param  \RaynetApiClient\Model\MassEmailRecipientInsertDto $mass_email_recipient_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['massEmailRecipientInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function massEmailRecipientInsertRequest($mass_email_id, $mass_email_recipient_insert_dto = null, string $contentType = self::contentTypes['massEmailRecipientInsert'][0])
    {

        // verify the required parameter 'mass_email_id' is set
        if ($mass_email_id === null || (is_array($mass_email_id) && count($mass_email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mass_email_id when calling massEmailRecipientInsert'
            );
        }



        $resourcePath = '/massEmail/{massEmailId}/recipient/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($mass_email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'massEmailId' . '}',
                ObjectSerializer::toPathValue($mass_email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($mass_email_recipient_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($mass_email_recipient_insert_dto));
            } else {
                $httpBody = $mass_email_recipient_insert_dto;
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
