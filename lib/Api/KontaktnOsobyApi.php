<?php
/**
 * KontaktnOsobyApi
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
 * KontaktnOsobyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class KontaktnOsobyApi
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
        'personAnonymizeEdit' => [
            'application/json',
        ],
        'personDelete' => [
            'application/json',
        ],
        'personDetailGet' => [
            'application/json',
        ],
        'personEdit' => [
            'application/json',
        ],
        'personGet' => [
            'application/json',
        ],
        'personInsert' => [
            'application/json',
        ],
        'personInvalidEdit' => [
            'application/json',
        ],
        'personLockEdit' => [
            'application/json',
        ],
        'personMergeEdit' => [
            'application/json',
        ],
        'personRelationshipDelete' => [
            'application/json',
        ],
        'personRelationshipEdit' => [
            'application/json',
        ],
        'personRelationshipInsert' => [
            'application/json',
        ],
        'personRelationshipSetPrimaryEdit' => [
            'application/json',
        ],
        'personTagDelete' => [
            'application/json',
        ],
        'personTagInsert' => [
            'application/json',
        ],
        'personUnlockEdit' => [
            'application/json',
        ],
        'personValidEdit' => [
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
     * Operation personAnonymizeEdit
     *
     * GDPR anonymize kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personAnonymizeEdit($person_id, string $contentType = self::contentTypes['personAnonymizeEdit'][0])
    {
        $this->personAnonymizeEditWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personAnonymizeEditWithHttpInfo
     *
     * GDPR anonymize kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personAnonymizeEditWithHttpInfo($person_id, string $contentType = self::contentTypes['personAnonymizeEdit'][0])
    {
        $request = $this->personAnonymizeEditRequest($person_id, $contentType);

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
     * Operation personAnonymizeEditAsync
     *
     * GDPR anonymize kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personAnonymizeEditAsync($person_id, string $contentType = self::contentTypes['personAnonymizeEdit'][0])
    {
        return $this->personAnonymizeEditAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personAnonymizeEditAsyncWithHttpInfo
     *
     * GDPR anonymize kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personAnonymizeEditAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personAnonymizeEdit'][0])
    {
        $returnType = '';
        $request = $this->personAnonymizeEditRequest($person_id, $contentType);

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
     * Create request for operation 'personAnonymizeEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personAnonymizeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personAnonymizeEditRequest($person_id, string $contentType = self::contentTypes['personAnonymizeEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personAnonymizeEdit'
            );
        }


        $resourcePath = '/person/{personId}/anonymize/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personDelete
     *
     * smazání kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personDelete($person_id, string $contentType = self::contentTypes['personDelete'][0])
    {
        $this->personDeleteWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personDeleteWithHttpInfo
     *
     * smazání kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personDeleteWithHttpInfo($person_id, string $contentType = self::contentTypes['personDelete'][0])
    {
        $request = $this->personDeleteRequest($person_id, $contentType);

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
     * Operation personDeleteAsync
     *
     * smazání kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personDeleteAsync($person_id, string $contentType = self::contentTypes['personDelete'][0])
    {
        return $this->personDeleteAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personDeleteAsyncWithHttpInfo
     *
     * smazání kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personDeleteAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personDelete'][0])
    {
        $returnType = '';
        $request = $this->personDeleteRequest($person_id, $contentType);

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
     * Create request for operation 'personDelete'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personDeleteRequest($person_id, string $contentType = self::contentTypes['personDelete'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personDelete'
            );
        }


        $resourcePath = '/person/{personId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personDetailGet
     *
     * detail kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personDetailGet($person_id, string $contentType = self::contentTypes['personDetailGet'][0])
    {
        $this->personDetailGetWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personDetailGetWithHttpInfo
     *
     * detail kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personDetailGetWithHttpInfo($person_id, string $contentType = self::contentTypes['personDetailGet'][0])
    {
        $request = $this->personDetailGetRequest($person_id, $contentType);

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
     * Operation personDetailGetAsync
     *
     * detail kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personDetailGetAsync($person_id, string $contentType = self::contentTypes['personDetailGet'][0])
    {
        return $this->personDetailGetAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personDetailGetAsyncWithHttpInfo
     *
     * detail kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personDetailGetAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personDetailGet'][0])
    {
        $returnType = '';
        $request = $this->personDetailGetRequest($person_id, $contentType);

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
     * Create request for operation 'personDetailGet'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personDetailGetRequest($person_id, string $contentType = self::contentTypes['personDetailGet'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personDetailGet'
            );
        }


        $resourcePath = '/person/{personId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personEdit
     *
     * upravení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonEditDto $person_edit_dto person_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personEdit($person_id, $person_edit_dto = null, string $contentType = self::contentTypes['personEdit'][0])
    {
        $this->personEditWithHttpInfo($person_id, $person_edit_dto, $contentType);
    }

    /**
     * Operation personEditWithHttpInfo
     *
     * upravení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonEditDto $person_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personEditWithHttpInfo($person_id, $person_edit_dto = null, string $contentType = self::contentTypes['personEdit'][0])
    {
        $request = $this->personEditRequest($person_id, $person_edit_dto, $contentType);

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
     * Operation personEditAsync
     *
     * upravení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonEditDto $person_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personEditAsync($person_id, $person_edit_dto = null, string $contentType = self::contentTypes['personEdit'][0])
    {
        return $this->personEditAsyncWithHttpInfo($person_id, $person_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personEditAsyncWithHttpInfo
     *
     * upravení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonEditDto $person_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personEditAsyncWithHttpInfo($person_id, $person_edit_dto = null, string $contentType = self::contentTypes['personEdit'][0])
    {
        $returnType = '';
        $request = $this->personEditRequest($person_id, $person_edit_dto, $contentType);

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
     * Create request for operation 'personEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonEditDto $person_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personEditRequest($person_id, $person_edit_dto = null, string $contentType = self::contentTypes['personEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personEdit'
            );
        }



        $resourcePath = '/person/{personId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($person_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_edit_dto));
            } else {
                $httpBody = $person_edit_dto;
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
     * Operation personGet
     *
     * seznam kontaktních osob
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $first_name Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $last_name Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $owner Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). (optional)
     * @param  string $primary_relationship_company_name Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $primary_relationship_company_id Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $person_relationship Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  int $user_account_id Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. (optional)
     * @param  string $contact_info_email Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $contact_info_email2 Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  int $gdpr_template Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $first_name = null, $last_name = null, $row_info_created_at = null, $row_info_updated_at = null, $owner = null, $primary_relationship_company_name = null, $primary_relationship_company_id = null, $person_relationship = null, $user_account_id = null, $contact_info_email = null, $contact_info_email2 = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['personGet'][0])
    {
        $this->personGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);
    }

    /**
     * Operation personGetWithHttpInfo
     *
     * seznam kontaktních osob
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $first_name Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $last_name Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $owner Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). (optional)
     * @param  string $primary_relationship_company_name Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $primary_relationship_company_id Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $person_relationship Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  int $user_account_id Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. (optional)
     * @param  string $contact_info_email Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $contact_info_email2 Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  int $gdpr_template Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $first_name = null, $last_name = null, $row_info_created_at = null, $row_info_updated_at = null, $owner = null, $primary_relationship_company_name = null, $primary_relationship_company_id = null, $person_relationship = null, $user_account_id = null, $contact_info_email = null, $contact_info_email2 = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['personGet'][0])
    {
        $request = $this->personGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);

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
     * Operation personGetAsync
     *
     * seznam kontaktních osob
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $first_name Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $last_name Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $owner Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). (optional)
     * @param  string $primary_relationship_company_name Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $primary_relationship_company_id Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $person_relationship Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  int $user_account_id Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. (optional)
     * @param  string $contact_info_email Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $contact_info_email2 Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  int $gdpr_template Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $first_name = null, $last_name = null, $row_info_created_at = null, $row_info_updated_at = null, $owner = null, $primary_relationship_company_name = null, $primary_relationship_company_id = null, $person_relationship = null, $user_account_id = null, $contact_info_email = null, $contact_info_email2 = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['personGet'][0])
    {
        return $this->personGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personGetAsyncWithHttpInfo
     *
     * seznam kontaktních osob
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $first_name Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $last_name Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $owner Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). (optional)
     * @param  string $primary_relationship_company_name Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $primary_relationship_company_id Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $person_relationship Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  int $user_account_id Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. (optional)
     * @param  string $contact_info_email Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $contact_info_email2 Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  int $gdpr_template Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $first_name = null, $last_name = null, $row_info_created_at = null, $row_info_updated_at = null, $owner = null, $primary_relationship_company_name = null, $primary_relationship_company_id = null, $person_relationship = null, $user_account_id = null, $contact_info_email = null, $contact_info_email2 = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['personGet'][0])
    {
        $returnType = '';
        $request = $this->personGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $first_name, $last_name, $row_info_created_at, $row_info_updated_at, $owner, $primary_relationship_company_name, $primary_relationship_company_id, $person_relationship, $user_account_id, $contact_info_email, $contact_info_email2, $row_info_last_modified_at, $row_info_row_access, $gdpr_template, $without_gdpr, $view, $tags, $contentType);

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
     * Create request for operation 'personGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených kontaktních osob je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $first_name Filtrování kontaktních osob podle křestního jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $last_name Filtrování kontaktních osob podle příjmení. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování kontaktních osob podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování kontaktních osob podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  int $owner Filtrování kontaktních osob podle vlastníka (Person). Filtruje se podle jednoznačného identifikátoru vlastníka (id). (optional)
     * @param  string $primary_relationship_company_name Filtrování kontaktních osob podle názvu klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  int $primary_relationship_company_id Filtrování kontaktních osob podle ID klienta v primárním vztahu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60; (optional)
     * @param  int $person_relationship Filtrování kontaktních osob podle ID klienta, která je s osobou v nějakém vztahu (primárním nebo i vedlejším). Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  int $user_account_id Filtrování kontaktních osob podle ID uživatele. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;. Jako hodnotu lze zadat i &#x60;prázdný řetězec&#x60;, např. pro vyfiltrování kontaktních osob bez uživ. účtu. (optional)
     * @param  string $contact_info_email Filtrování kontaktních osob podle primárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $contact_info_email2 Filtrování kontaktních osob podle sekundárního emailu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování kontaktních osob podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $row_info_row_access Filtrování zneplatněných kontaktních osob. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;EQ_OR_NULL&#x60;, &#x60;NE_OR_NULL&#x60; (optional)
     * @param  int $gdpr_template Filtrování kontaktních osob podle právního titulu. Lze použít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $without_gdpr Filtrování kontaktních osob, kteřé nemají platný právní titul. Lze využít jen operátor &#x60;CUSTOM&#x60;. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $first_name = null, $last_name = null, $row_info_created_at = null, $row_info_updated_at = null, $owner = null, $primary_relationship_company_name = null, $primary_relationship_company_id = null, $person_relationship = null, $user_account_id = null, $contact_info_email = null, $contact_info_email2 = null, $row_info_last_modified_at = null, $row_info_row_access = null, $gdpr_template = null, $without_gdpr = null, $view = null, $tags = null, string $contentType = self::contentTypes['personGet'][0])
    {
























        $resourcePath = '/person/';
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
            $first_name,
            'firstName', // param base name
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
            $owner,
            'owner', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $primary_relationship_company_name,
            'primaryRelationship-company-name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $primary_relationship_company_id,
            'primaryRelationship-company-id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $person_relationship,
            'personRelationship', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_account_id,
            'userAccount-id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $contact_info_email,
            'contactInfo.email', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $contact_info_email2,
            'contactInfo.email2', // param base name
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
            'integer', // openApiType
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
     * Operation personInsert
     *
     * založení nové kontaktní osoby
     *
     * @param  \RaynetApiClient\Model\PersonInsertDto $person_insert_dto person_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function personInsert($person_insert_dto = null, string $contentType = self::contentTypes['personInsert'][0])
    {
        list($response) = $this->personInsertWithHttpInfo($person_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation personInsertWithHttpInfo
     *
     * založení nové kontaktní osoby
     *
     * @param  \RaynetApiClient\Model\PersonInsertDto $person_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function personInsertWithHttpInfo($person_insert_dto = null, string $contentType = self::contentTypes['personInsert'][0])
    {
        $request = $this->personInsertRequest($person_insert_dto, $contentType);

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
     * Operation personInsertAsync
     *
     * založení nové kontaktní osoby
     *
     * @param  \RaynetApiClient\Model\PersonInsertDto $person_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personInsertAsync($person_insert_dto = null, string $contentType = self::contentTypes['personInsert'][0])
    {
        return $this->personInsertAsyncWithHttpInfo($person_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personInsertAsyncWithHttpInfo
     *
     * založení nové kontaktní osoby
     *
     * @param  \RaynetApiClient\Model\PersonInsertDto $person_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personInsertAsyncWithHttpInfo($person_insert_dto = null, string $contentType = self::contentTypes['personInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->personInsertRequest($person_insert_dto, $contentType);

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
     * Create request for operation 'personInsert'
     *
     * @param  \RaynetApiClient\Model\PersonInsertDto $person_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personInsertRequest($person_insert_dto = null, string $contentType = self::contentTypes['personInsert'][0])
    {



        $resourcePath = '/person/';
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
        if (isset($person_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_insert_dto));
            } else {
                $httpBody = $person_insert_dto;
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
     * Operation personInvalidEdit
     *
     * zneplatnění kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personInvalidEdit($person_id, string $contentType = self::contentTypes['personInvalidEdit'][0])
    {
        $this->personInvalidEditWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personInvalidEditWithHttpInfo
     *
     * zneplatnění kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInvalidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personInvalidEditWithHttpInfo($person_id, string $contentType = self::contentTypes['personInvalidEdit'][0])
    {
        $request = $this->personInvalidEditRequest($person_id, $contentType);

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
     * Operation personInvalidEditAsync
     *
     * zneplatnění kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personInvalidEditAsync($person_id, string $contentType = self::contentTypes['personInvalidEdit'][0])
    {
        return $this->personInvalidEditAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personInvalidEditAsyncWithHttpInfo
     *
     * zneplatnění kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personInvalidEditAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personInvalidEdit'][0])
    {
        $returnType = '';
        $request = $this->personInvalidEditRequest($person_id, $contentType);

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
     * Create request for operation 'personInvalidEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personInvalidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personInvalidEditRequest($person_id, string $contentType = self::contentTypes['personInvalidEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personInvalidEdit'
            );
        }


        $resourcePath = '/person/{personId}/invalid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personLockEdit
     *
     * uzamčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personLockEdit($person_id, string $contentType = self::contentTypes['personLockEdit'][0])
    {
        $this->personLockEditWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personLockEditWithHttpInfo
     *
     * uzamčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personLockEditWithHttpInfo($person_id, string $contentType = self::contentTypes['personLockEdit'][0])
    {
        $request = $this->personLockEditRequest($person_id, $contentType);

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
     * Operation personLockEditAsync
     *
     * uzamčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personLockEditAsync($person_id, string $contentType = self::contentTypes['personLockEdit'][0])
    {
        return $this->personLockEditAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personLockEditAsyncWithHttpInfo
     *
     * uzamčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personLockEditAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personLockEdit'][0])
    {
        $returnType = '';
        $request = $this->personLockEditRequest($person_id, $contentType);

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
     * Create request for operation 'personLockEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personLockEditRequest($person_id, string $contentType = self::contentTypes['personLockEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personLockEdit'
            );
        }


        $resourcePath = '/person/{personId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personMergeEdit
     *
     * Sloučení duplicitní kontaktní osoby
     *
     * @param  int $person_id ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_person_id ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personMergeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personMergeEdit($person_id, $source_person_id, string $contentType = self::contentTypes['personMergeEdit'][0])
    {
        $this->personMergeEditWithHttpInfo($person_id, $source_person_id, $contentType);
    }

    /**
     * Operation personMergeEditWithHttpInfo
     *
     * Sloučení duplicitní kontaktní osoby
     *
     * @param  int $person_id ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_person_id ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personMergeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personMergeEditWithHttpInfo($person_id, $source_person_id, string $contentType = self::contentTypes['personMergeEdit'][0])
    {
        $request = $this->personMergeEditRequest($person_id, $source_person_id, $contentType);

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
     * Operation personMergeEditAsync
     *
     * Sloučení duplicitní kontaktní osoby
     *
     * @param  int $person_id ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_person_id ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personMergeEditAsync($person_id, $source_person_id, string $contentType = self::contentTypes['personMergeEdit'][0])
    {
        return $this->personMergeEditAsyncWithHttpInfo($person_id, $source_person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personMergeEditAsyncWithHttpInfo
     *
     * Sloučení duplicitní kontaktní osoby
     *
     * @param  int $person_id ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_person_id ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personMergeEditAsyncWithHttpInfo($person_id, $source_person_id, string $contentType = self::contentTypes['personMergeEdit'][0])
    {
        $returnType = '';
        $request = $this->personMergeEditRequest($person_id, $source_person_id, $contentType);

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
     * Create request for operation 'personMergeEdit'
     *
     * @param  int $person_id ID cílové kontaktní osoby, do tohoto záznamu se budou převádět data (required)
     * @param  int $source_person_id ID zdrojové kontaktní osoby, která bude sloučena s cílovou kontaktní osobou a následně smazána (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personMergeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personMergeEditRequest($person_id, $source_person_id, string $contentType = self::contentTypes['personMergeEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personMergeEdit'
            );
        }

        // verify the required parameter 'source_person_id' is set
        if ($source_person_id === null || (is_array($source_person_id) && count($source_person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $source_person_id when calling personMergeEdit'
            );
        }


        $resourcePath = '/person/{personId}/merge/{sourcePersonId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
                $resourcePath
            );
        }
        // path params
        if ($source_person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'sourcePersonId' . '}',
                ObjectSerializer::toPathValue($source_person_id),
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
     * Operation personRelationshipDelete
     *
     * smazání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personRelationshipDelete($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipDelete'][0])
    {
        $this->personRelationshipDeleteWithHttpInfo($person_id, $relationship_id, $contentType);
    }

    /**
     * Operation personRelationshipDeleteWithHttpInfo
     *
     * smazání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personRelationshipDeleteWithHttpInfo($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipDelete'][0])
    {
        $request = $this->personRelationshipDeleteRequest($person_id, $relationship_id, $contentType);

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
     * Operation personRelationshipDeleteAsync
     *
     * smazání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipDeleteAsync($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipDelete'][0])
    {
        return $this->personRelationshipDeleteAsyncWithHttpInfo($person_id, $relationship_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personRelationshipDeleteAsyncWithHttpInfo
     *
     * smazání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipDeleteAsyncWithHttpInfo($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipDelete'][0])
    {
        $returnType = '';
        $request = $this->personRelationshipDeleteRequest($person_id, $relationship_id, $contentType);

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
     * Create request for operation 'personRelationshipDelete'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personRelationshipDeleteRequest($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipDelete'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personRelationshipDelete'
            );
        }

        // verify the required parameter 'relationship_id' is set
        if ($relationship_id === null || (is_array($relationship_id) && count($relationship_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $relationship_id when calling personRelationshipDelete'
            );
        }


        $resourcePath = '/person/{personId}/relationship/{relationshipId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personRelationshipEdit
     *
     * upravení vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipEditDto $person_relationship_edit_dto person_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personRelationshipEdit($person_id, $relationship_id, $person_relationship_edit_dto = null, string $contentType = self::contentTypes['personRelationshipEdit'][0])
    {
        $this->personRelationshipEditWithHttpInfo($person_id, $relationship_id, $person_relationship_edit_dto, $contentType);
    }

    /**
     * Operation personRelationshipEditWithHttpInfo
     *
     * upravení vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipEditDto $person_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personRelationshipEditWithHttpInfo($person_id, $relationship_id, $person_relationship_edit_dto = null, string $contentType = self::contentTypes['personRelationshipEdit'][0])
    {
        $request = $this->personRelationshipEditRequest($person_id, $relationship_id, $person_relationship_edit_dto, $contentType);

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
     * Operation personRelationshipEditAsync
     *
     * upravení vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipEditDto $person_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipEditAsync($person_id, $relationship_id, $person_relationship_edit_dto = null, string $contentType = self::contentTypes['personRelationshipEdit'][0])
    {
        return $this->personRelationshipEditAsyncWithHttpInfo($person_id, $relationship_id, $person_relationship_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personRelationshipEditAsyncWithHttpInfo
     *
     * upravení vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipEditDto $person_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipEditAsyncWithHttpInfo($person_id, $relationship_id, $person_relationship_edit_dto = null, string $contentType = self::contentTypes['personRelationshipEdit'][0])
    {
        $returnType = '';
        $request = $this->personRelationshipEditRequest($person_id, $relationship_id, $person_relationship_edit_dto, $contentType);

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
     * Create request for operation 'personRelationshipEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipEditDto $person_relationship_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personRelationshipEditRequest($person_id, $relationship_id, $person_relationship_edit_dto = null, string $contentType = self::contentTypes['personRelationshipEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personRelationshipEdit'
            );
        }

        // verify the required parameter 'relationship_id' is set
        if ($relationship_id === null || (is_array($relationship_id) && count($relationship_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $relationship_id when calling personRelationshipEdit'
            );
        }



        $resourcePath = '/person/{personId}/relationship/{relationshipId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
        if (isset($person_relationship_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_relationship_edit_dto));
            } else {
                $httpBody = $person_relationship_edit_dto;
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
     * Operation personRelationshipInsert
     *
     * přidání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipInsertDto $person_relationship_insert_dto person_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function personRelationshipInsert($person_id, $person_relationship_insert_dto = null, string $contentType = self::contentTypes['personRelationshipInsert'][0])
    {
        list($response) = $this->personRelationshipInsertWithHttpInfo($person_id, $person_relationship_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation personRelationshipInsertWithHttpInfo
     *
     * přidání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipInsertDto $person_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function personRelationshipInsertWithHttpInfo($person_id, $person_relationship_insert_dto = null, string $contentType = self::contentTypes['personRelationshipInsert'][0])
    {
        $request = $this->personRelationshipInsertRequest($person_id, $person_relationship_insert_dto, $contentType);

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
     * Operation personRelationshipInsertAsync
     *
     * přidání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipInsertDto $person_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipInsertAsync($person_id, $person_relationship_insert_dto = null, string $contentType = self::contentTypes['personRelationshipInsert'][0])
    {
        return $this->personRelationshipInsertAsyncWithHttpInfo($person_id, $person_relationship_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personRelationshipInsertAsyncWithHttpInfo
     *
     * přidání vztahu
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipInsertDto $person_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipInsertAsyncWithHttpInfo($person_id, $person_relationship_insert_dto = null, string $contentType = self::contentTypes['personRelationshipInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->personRelationshipInsertRequest($person_id, $person_relationship_insert_dto, $contentType);

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
     * Create request for operation 'personRelationshipInsert'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonRelationshipInsertDto $person_relationship_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personRelationshipInsertRequest($person_id, $person_relationship_insert_dto = null, string $contentType = self::contentTypes['personRelationshipInsert'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personRelationshipInsert'
            );
        }



        $resourcePath = '/person/{personId}/relationship/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($person_relationship_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_relationship_insert_dto));
            } else {
                $httpBody = $person_relationship_insert_dto;
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
     * Operation personRelationshipSetPrimaryEdit
     *
     * nastavení primárního vztahu s klientem
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personRelationshipSetPrimaryEdit($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipSetPrimaryEdit'][0])
    {
        $this->personRelationshipSetPrimaryEditWithHttpInfo($person_id, $relationship_id, $contentType);
    }

    /**
     * Operation personRelationshipSetPrimaryEditWithHttpInfo
     *
     * nastavení primárního vztahu s klientem
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personRelationshipSetPrimaryEditWithHttpInfo($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipSetPrimaryEdit'][0])
    {
        $request = $this->personRelationshipSetPrimaryEditRequest($person_id, $relationship_id, $contentType);

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
     * Operation personRelationshipSetPrimaryEditAsync
     *
     * nastavení primárního vztahu s klientem
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipSetPrimaryEditAsync($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipSetPrimaryEdit'][0])
    {
        return $this->personRelationshipSetPrimaryEditAsyncWithHttpInfo($person_id, $relationship_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personRelationshipSetPrimaryEditAsyncWithHttpInfo
     *
     * nastavení primárního vztahu s klientem
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personRelationshipSetPrimaryEditAsyncWithHttpInfo($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipSetPrimaryEdit'][0])
    {
        $returnType = '';
        $request = $this->personRelationshipSetPrimaryEditRequest($person_id, $relationship_id, $contentType);

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
     * Create request for operation 'personRelationshipSetPrimaryEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  int $relationship_id ID vztahu s klientem (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personRelationshipSetPrimaryEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personRelationshipSetPrimaryEditRequest($person_id, $relationship_id, string $contentType = self::contentTypes['personRelationshipSetPrimaryEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personRelationshipSetPrimaryEdit'
            );
        }

        // verify the required parameter 'relationship_id' is set
        if ($relationship_id === null || (is_array($relationship_id) && count($relationship_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $relationship_id when calling personRelationshipSetPrimaryEdit'
            );
        }


        $resourcePath = '/person/{personId}/relationship/{relationshipId}/setPrimary/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation personTagDelete
     *
     * smazání TAGu z kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagDeleteDto $person_tag_delete_dto person_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personTagDelete($person_id, $person_tag_delete_dto = null, string $contentType = self::contentTypes['personTagDelete'][0])
    {
        $this->personTagDeleteWithHttpInfo($person_id, $person_tag_delete_dto, $contentType);
    }

    /**
     * Operation personTagDeleteWithHttpInfo
     *
     * smazání TAGu z kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagDeleteDto $person_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personTagDeleteWithHttpInfo($person_id, $person_tag_delete_dto = null, string $contentType = self::contentTypes['personTagDelete'][0])
    {
        $request = $this->personTagDeleteRequest($person_id, $person_tag_delete_dto, $contentType);

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
     * Operation personTagDeleteAsync
     *
     * smazání TAGu z kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagDeleteDto $person_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personTagDeleteAsync($person_id, $person_tag_delete_dto = null, string $contentType = self::contentTypes['personTagDelete'][0])
    {
        return $this->personTagDeleteAsyncWithHttpInfo($person_id, $person_tag_delete_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personTagDeleteAsyncWithHttpInfo
     *
     * smazání TAGu z kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagDeleteDto $person_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personTagDeleteAsyncWithHttpInfo($person_id, $person_tag_delete_dto = null, string $contentType = self::contentTypes['personTagDelete'][0])
    {
        $returnType = '';
        $request = $this->personTagDeleteRequest($person_id, $person_tag_delete_dto, $contentType);

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
     * Create request for operation 'personTagDelete'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagDeleteDto $person_tag_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personTagDeleteRequest($person_id, $person_tag_delete_dto = null, string $contentType = self::contentTypes['personTagDelete'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personTagDelete'
            );
        }



        $resourcePath = '/person/{personId}/tag/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($person_tag_delete_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_tag_delete_dto));
            } else {
                $httpBody = $person_tag_delete_dto;
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
     * Operation personTagInsert
     *
     * přidání TAGu ke kontaktní osobě
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagInsertDto $person_tag_insert_dto person_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personTagInsert($person_id, $person_tag_insert_dto = null, string $contentType = self::contentTypes['personTagInsert'][0])
    {
        $this->personTagInsertWithHttpInfo($person_id, $person_tag_insert_dto, $contentType);
    }

    /**
     * Operation personTagInsertWithHttpInfo
     *
     * přidání TAGu ke kontaktní osobě
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagInsertDto $person_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personTagInsertWithHttpInfo($person_id, $person_tag_insert_dto = null, string $contentType = self::contentTypes['personTagInsert'][0])
    {
        $request = $this->personTagInsertRequest($person_id, $person_tag_insert_dto, $contentType);

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
     * Operation personTagInsertAsync
     *
     * přidání TAGu ke kontaktní osobě
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagInsertDto $person_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personTagInsertAsync($person_id, $person_tag_insert_dto = null, string $contentType = self::contentTypes['personTagInsert'][0])
    {
        return $this->personTagInsertAsyncWithHttpInfo($person_id, $person_tag_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personTagInsertAsyncWithHttpInfo
     *
     * přidání TAGu ke kontaktní osobě
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagInsertDto $person_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personTagInsertAsyncWithHttpInfo($person_id, $person_tag_insert_dto = null, string $contentType = self::contentTypes['personTagInsert'][0])
    {
        $returnType = '';
        $request = $this->personTagInsertRequest($person_id, $person_tag_insert_dto, $contentType);

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
     * Create request for operation 'personTagInsert'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  \RaynetApiClient\Model\PersonTagInsertDto $person_tag_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personTagInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personTagInsertRequest($person_id, $person_tag_insert_dto = null, string $contentType = self::contentTypes['personTagInsert'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personTagInsert'
            );
        }



        $resourcePath = '/person/{personId}/tag/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($person_tag_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($person_tag_insert_dto));
            } else {
                $httpBody = $person_tag_insert_dto;
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
     * Operation personUnlockEdit
     *
     * odemčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personUnlockEdit($person_id, string $contentType = self::contentTypes['personUnlockEdit'][0])
    {
        $this->personUnlockEditWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personUnlockEditWithHttpInfo
     *
     * odemčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personUnlockEditWithHttpInfo($person_id, string $contentType = self::contentTypes['personUnlockEdit'][0])
    {
        $request = $this->personUnlockEditRequest($person_id, $contentType);

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
     * Operation personUnlockEditAsync
     *
     * odemčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personUnlockEditAsync($person_id, string $contentType = self::contentTypes['personUnlockEdit'][0])
    {
        return $this->personUnlockEditAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personUnlockEditAsyncWithHttpInfo
     *
     * odemčení kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personUnlockEditAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->personUnlockEditRequest($person_id, $contentType);

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
     * Create request for operation 'personUnlockEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personUnlockEditRequest($person_id, string $contentType = self::contentTypes['personUnlockEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personUnlockEdit'
            );
        }


        $resourcePath = '/person/{personId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
     * Operation personValidEdit
     *
     * obnovení platnosti kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function personValidEdit($person_id, string $contentType = self::contentTypes['personValidEdit'][0])
    {
        $this->personValidEditWithHttpInfo($person_id, $contentType);
    }

    /**
     * Operation personValidEditWithHttpInfo
     *
     * obnovení platnosti kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personValidEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function personValidEditWithHttpInfo($person_id, string $contentType = self::contentTypes['personValidEdit'][0])
    {
        $request = $this->personValidEditRequest($person_id, $contentType);

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
     * Operation personValidEditAsync
     *
     * obnovení platnosti kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personValidEditAsync($person_id, string $contentType = self::contentTypes['personValidEdit'][0])
    {
        return $this->personValidEditAsyncWithHttpInfo($person_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation personValidEditAsyncWithHttpInfo
     *
     * obnovení platnosti kontaktní osoby
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function personValidEditAsyncWithHttpInfo($person_id, string $contentType = self::contentTypes['personValidEdit'][0])
    {
        $returnType = '';
        $request = $this->personValidEditRequest($person_id, $contentType);

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
     * Create request for operation 'personValidEdit'
     *
     * @param  int $person_id ID kontaktní osoby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['personValidEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function personValidEditRequest($person_id, string $contentType = self::contentTypes['personValidEdit'][0])
    {

        // verify the required parameter 'person_id' is set
        if ($person_id === null || (is_array($person_id) && count($person_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $person_id when calling personValidEdit'
            );
        }


        $resourcePath = '/person/{personId}/valid';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($person_id !== null) {
            $resourcePath = str_replace(
                '{' . 'personId' . '}',
                ObjectSerializer::toPathValue($person_id),
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
