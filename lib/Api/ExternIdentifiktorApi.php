<?php
/**
 * ExternIdentifiktorApi
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
 * ExternIdentifiktorApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ExternIdentifiktorApi
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
        'extIdDelete' => [
            'application/json',
        ],
        'extIdInsert' => [
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
     * Operation extIdDelete
     *
     * odstranění externího identifikátoru
     *
     * @param  string $entity_name entita od které má být externí identifikátor odebrán (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  int $ext_id externí identifikátor, který má být u záznamu uveden (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function extIdDelete($entity_name, $entity_id, $ext_id, string $contentType = self::contentTypes['extIdDelete'][0])
    {
        $this->extIdDeleteWithHttpInfo($entity_name, $entity_id, $ext_id, $contentType);
    }

    /**
     * Operation extIdDeleteWithHttpInfo
     *
     * odstranění externího identifikátoru
     *
     * @param  string $entity_name entita od které má být externí identifikátor odebrán (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  int $ext_id externí identifikátor, který má být u záznamu uveden (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function extIdDeleteWithHttpInfo($entity_name, $entity_id, $ext_id, string $contentType = self::contentTypes['extIdDelete'][0])
    {
        $request = $this->extIdDeleteRequest($entity_name, $entity_id, $ext_id, $contentType);

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
     * Operation extIdDeleteAsync
     *
     * odstranění externího identifikátoru
     *
     * @param  string $entity_name entita od které má být externí identifikátor odebrán (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  int $ext_id externí identifikátor, který má být u záznamu uveden (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function extIdDeleteAsync($entity_name, $entity_id, $ext_id, string $contentType = self::contentTypes['extIdDelete'][0])
    {
        return $this->extIdDeleteAsyncWithHttpInfo($entity_name, $entity_id, $ext_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation extIdDeleteAsyncWithHttpInfo
     *
     * odstranění externího identifikátoru
     *
     * @param  string $entity_name entita od které má být externí identifikátor odebrán (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  int $ext_id externí identifikátor, který má být u záznamu uveden (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function extIdDeleteAsyncWithHttpInfo($entity_name, $entity_id, $ext_id, string $contentType = self::contentTypes['extIdDelete'][0])
    {
        $returnType = '';
        $request = $this->extIdDeleteRequest($entity_name, $entity_id, $ext_id, $contentType);

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
     * Create request for operation 'extIdDelete'
     *
     * @param  string $entity_name entita od které má být externí identifikátor odebrán (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  int $ext_id externí identifikátor, který má být u záznamu uveden (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function extIdDeleteRequest($entity_name, $entity_id, $ext_id, string $contentType = self::contentTypes['extIdDelete'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling extIdDelete'
            );
        }

        // verify the required parameter 'entity_id' is set
        if ($entity_id === null || (is_array($entity_id) && count($entity_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_id when calling extIdDelete'
            );
        }

        // verify the required parameter 'ext_id' is set
        if ($ext_id === null || (is_array($ext_id) && count($ext_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ext_id when calling extIdDelete'
            );
        }


        $resourcePath = '/{entityName}/{entityId}/extId/{extId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($entity_name !== null) {
            $resourcePath = str_replace(
                '{' . 'entityName' . '}',
                ObjectSerializer::toPathValue($entity_name),
                $resourcePath
            );
        }
        // path params
        if ($entity_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entityId' . '}',
                ObjectSerializer::toPathValue($entity_id),
                $resourcePath
            );
        }
        // path params
        if ($ext_id !== null) {
            $resourcePath = str_replace(
                '{' . 'extId' . '}',
                ObjectSerializer::toPathValue($ext_id),
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
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation extIdInsert
     *
     * přidání externího identifikátoru
     *
     * @param  string $entity_name entita ke které má být externí identifikátor přiřazen (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  \RaynetApiClient\Model\ExtIdInsertDto $ext_id_insert_dto ext_id_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function extIdInsert($entity_name, $entity_id, $ext_id_insert_dto = null, string $contentType = self::contentTypes['extIdInsert'][0])
    {
        $this->extIdInsertWithHttpInfo($entity_name, $entity_id, $ext_id_insert_dto, $contentType);
    }

    /**
     * Operation extIdInsertWithHttpInfo
     *
     * přidání externího identifikátoru
     *
     * @param  string $entity_name entita ke které má být externí identifikátor přiřazen (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  \RaynetApiClient\Model\ExtIdInsertDto $ext_id_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function extIdInsertWithHttpInfo($entity_name, $entity_id, $ext_id_insert_dto = null, string $contentType = self::contentTypes['extIdInsert'][0])
    {
        $request = $this->extIdInsertRequest($entity_name, $entity_id, $ext_id_insert_dto, $contentType);

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
     * Operation extIdInsertAsync
     *
     * přidání externího identifikátoru
     *
     * @param  string $entity_name entita ke které má být externí identifikátor přiřazen (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  \RaynetApiClient\Model\ExtIdInsertDto $ext_id_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function extIdInsertAsync($entity_name, $entity_id, $ext_id_insert_dto = null, string $contentType = self::contentTypes['extIdInsert'][0])
    {
        return $this->extIdInsertAsyncWithHttpInfo($entity_name, $entity_id, $ext_id_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation extIdInsertAsyncWithHttpInfo
     *
     * přidání externího identifikátoru
     *
     * @param  string $entity_name entita ke které má být externí identifikátor přiřazen (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  \RaynetApiClient\Model\ExtIdInsertDto $ext_id_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function extIdInsertAsyncWithHttpInfo($entity_name, $entity_id, $ext_id_insert_dto = null, string $contentType = self::contentTypes['extIdInsert'][0])
    {
        $returnType = '';
        $request = $this->extIdInsertRequest($entity_name, $entity_id, $ext_id_insert_dto, $contentType);

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
     * Create request for operation 'extIdInsert'
     *
     * @param  string $entity_name entita ke které má být externí identifikátor přiřazen (required)
     * @param  int $entity_id ID záznamu (required)
     * @param  \RaynetApiClient\Model\ExtIdInsertDto $ext_id_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['extIdInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function extIdInsertRequest($entity_name, $entity_id, $ext_id_insert_dto = null, string $contentType = self::contentTypes['extIdInsert'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling extIdInsert'
            );
        }

        // verify the required parameter 'entity_id' is set
        if ($entity_id === null || (is_array($entity_id) && count($entity_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_id when calling extIdInsert'
            );
        }



        $resourcePath = '/{entityName}/{entityId}/extId/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($entity_name !== null) {
            $resourcePath = str_replace(
                '{' . 'entityName' . '}',
                ObjectSerializer::toPathValue($entity_name),
                $resourcePath
            );
        }
        // path params
        if ($entity_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entityId' . '}',
                ObjectSerializer::toPathValue($entity_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($ext_id_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($ext_id_insert_dto));
            } else {
                $httpBody = $ext_id_insert_dto;
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
