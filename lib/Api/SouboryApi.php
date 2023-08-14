<?php
/**
 * SouboryApi
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
 * SouboryApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SouboryApi
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
        'attachmentDelete' => [
            'application/json',
        ],
        'attachmentInsert' => [
            'application/json',
        ],
        'attachmentInsertCustomField' => [
            'application/json',
        ],
        'exportBodyGet' => [
            'application/json',
        ],
        'fileBodyGet' => [
            'application/json',
        ],
        'fileHeaderDetailGet' => [
            'application/json',
        ],
        'fileUploadEdit' => [
            'multipart/form-data',
        ],
        'iconDetailGet' => [
            'application/json',
        ],
        'imageDetailGet' => [
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
     * Operation attachmentDelete
     *
     * Smazání přílohy
     *
     * @param  int $attachment_id ID přílohy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function attachmentDelete($attachment_id, string $contentType = self::contentTypes['attachmentDelete'][0])
    {
        $this->attachmentDeleteWithHttpInfo($attachment_id, $contentType);
    }

    /**
     * Operation attachmentDeleteWithHttpInfo
     *
     * Smazání přílohy
     *
     * @param  int $attachment_id ID přílohy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function attachmentDeleteWithHttpInfo($attachment_id, string $contentType = self::contentTypes['attachmentDelete'][0])
    {
        $request = $this->attachmentDeleteRequest($attachment_id, $contentType);

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
     * Operation attachmentDeleteAsync
     *
     * Smazání přílohy
     *
     * @param  int $attachment_id ID přílohy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentDeleteAsync($attachment_id, string $contentType = self::contentTypes['attachmentDelete'][0])
    {
        return $this->attachmentDeleteAsyncWithHttpInfo($attachment_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation attachmentDeleteAsyncWithHttpInfo
     *
     * Smazání přílohy
     *
     * @param  int $attachment_id ID přílohy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentDeleteAsyncWithHttpInfo($attachment_id, string $contentType = self::contentTypes['attachmentDelete'][0])
    {
        $returnType = '';
        $request = $this->attachmentDeleteRequest($attachment_id, $contentType);

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
     * Create request for operation 'attachmentDelete'
     *
     * @param  int $attachment_id ID přílohy (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function attachmentDeleteRequest($attachment_id, string $contentType = self::contentTypes['attachmentDelete'][0])
    {

        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling attachmentDelete'
            );
        }


        $resourcePath = '/attachment/{attachmentId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachmentId' . '}',
                ObjectSerializer::toPathValue($attachment_id),
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
     * Operation attachmentInsert
     *
     * Přidání přílohy
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertDto $attachment_insert_dto attachment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\AttachmentInsert201Response
     */
    public function attachmentInsert($entity_name, $entity_id, $attachment_insert_dto = null, string $contentType = self::contentTypes['attachmentInsert'][0])
    {
        list($response) = $this->attachmentInsertWithHttpInfo($entity_name, $entity_id, $attachment_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation attachmentInsertWithHttpInfo
     *
     * Přidání přílohy
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertDto $attachment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\AttachmentInsert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function attachmentInsertWithHttpInfo($entity_name, $entity_id, $attachment_insert_dto = null, string $contentType = self::contentTypes['attachmentInsert'][0])
    {
        $request = $this->attachmentInsertRequest($entity_name, $entity_id, $attachment_insert_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\AttachmentInsert201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\AttachmentInsert201Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\AttachmentInsert201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\AttachmentInsert201Response';
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
                        '\RaynetApiClient\Model\AttachmentInsert201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation attachmentInsertAsync
     *
     * Přidání přílohy
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertDto $attachment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentInsertAsync($entity_name, $entity_id, $attachment_insert_dto = null, string $contentType = self::contentTypes['attachmentInsert'][0])
    {
        return $this->attachmentInsertAsyncWithHttpInfo($entity_name, $entity_id, $attachment_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation attachmentInsertAsyncWithHttpInfo
     *
     * Přidání přílohy
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertDto $attachment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentInsertAsyncWithHttpInfo($entity_name, $entity_id, $attachment_insert_dto = null, string $contentType = self::contentTypes['attachmentInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\AttachmentInsert201Response';
        $request = $this->attachmentInsertRequest($entity_name, $entity_id, $attachment_insert_dto, $contentType);

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
     * Create request for operation 'attachmentInsert'
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertDto $attachment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function attachmentInsertRequest($entity_name, $entity_id, $attachment_insert_dto = null, string $contentType = self::contentTypes['attachmentInsert'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling attachmentInsert'
            );
        }

        // verify the required parameter 'entity_id' is set
        if ($entity_id === null || (is_array($entity_id) && count($entity_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_id when calling attachmentInsert'
            );
        }



        $resourcePath = '/attachment/{entityName}/{entityId}/';
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
        if (isset($attachment_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($attachment_insert_dto));
            } else {
                $httpBody = $attachment_insert_dto;
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
     * Operation attachmentInsertCustomField
     *
     * Přidání přílohy se souborem do volitelného pole
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  string $custom_field_id Klíč (name) volitelného pole (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertCustomFieldDto $attachment_insert_custom_field_dto attachment_insert_custom_field_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsertCustomField'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function attachmentInsertCustomField($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto = null, string $contentType = self::contentTypes['attachmentInsertCustomField'][0])
    {
        list($response) = $this->attachmentInsertCustomFieldWithHttpInfo($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto, $contentType);
        return $response;
    }

    /**
     * Operation attachmentInsertCustomFieldWithHttpInfo
     *
     * Přidání přílohy se souborem do volitelného pole
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  string $custom_field_id Klíč (name) volitelného pole (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertCustomFieldDto $attachment_insert_custom_field_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsertCustomField'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function attachmentInsertCustomFieldWithHttpInfo($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto = null, string $contentType = self::contentTypes['attachmentInsertCustomField'][0])
    {
        $request = $this->attachmentInsertCustomFieldRequest($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto, $contentType);

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
     * Operation attachmentInsertCustomFieldAsync
     *
     * Přidání přílohy se souborem do volitelného pole
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  string $custom_field_id Klíč (name) volitelného pole (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertCustomFieldDto $attachment_insert_custom_field_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsertCustomField'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentInsertCustomFieldAsync($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto = null, string $contentType = self::contentTypes['attachmentInsertCustomField'][0])
    {
        return $this->attachmentInsertCustomFieldAsyncWithHttpInfo($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation attachmentInsertCustomFieldAsyncWithHttpInfo
     *
     * Přidání přílohy se souborem do volitelného pole
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  string $custom_field_id Klíč (name) volitelného pole (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertCustomFieldDto $attachment_insert_custom_field_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsertCustomField'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function attachmentInsertCustomFieldAsyncWithHttpInfo($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto = null, string $contentType = self::contentTypes['attachmentInsertCustomField'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->attachmentInsertCustomFieldRequest($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto, $contentType);

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
     * Create request for operation 'attachmentInsertCustomField'
     *
     * @param  string $entity_name Název entity (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;invoice&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  int $entity_id ID entity (required)
     * @param  string $custom_field_id Klíč (name) volitelného pole (required)
     * @param  \RaynetApiClient\Model\AttachmentInsertCustomFieldDto $attachment_insert_custom_field_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['attachmentInsertCustomField'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function attachmentInsertCustomFieldRequest($entity_name, $entity_id, $custom_field_id, $attachment_insert_custom_field_dto = null, string $contentType = self::contentTypes['attachmentInsertCustomField'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling attachmentInsertCustomField'
            );
        }

        // verify the required parameter 'entity_id' is set
        if ($entity_id === null || (is_array($entity_id) && count($entity_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_id when calling attachmentInsertCustomField'
            );
        }

        // verify the required parameter 'custom_field_id' is set
        if ($custom_field_id === null || (is_array($custom_field_id) && count($custom_field_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $custom_field_id when calling attachmentInsertCustomField'
            );
        }



        $resourcePath = '/attachment/{entityName}/{entityId}/{customFieldId}/';
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
        if ($custom_field_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customFieldId' . '}',
                ObjectSerializer::toPathValue($custom_field_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($attachment_insert_custom_field_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($attachment_insert_custom_field_dto));
            } else {
                $httpBody = $attachment_insert_custom_field_dto;
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
     * Operation exportBodyGet
     *
     * Stažení těla exportu
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $file_name Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $content_type Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['exportBodyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function exportBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['exportBodyGet'][0])
    {
        list($response) = $this->exportBodyGetWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);
        return $response;
    }

    /**
     * Operation exportBodyGetWithHttpInfo
     *
     * Stažení těla exportu
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $file_name Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $content_type Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['exportBodyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    public function exportBodyGetWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['exportBodyGet'][0])
    {
        $request = $this->exportBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);

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
                    if ('\SplFileObject' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\SplFileObject' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\SplFileObject', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\SplFileObject';
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
                        '\SplFileObject',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation exportBodyGetAsync
     *
     * Stažení těla exportu
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $file_name Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $content_type Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['exportBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function exportBodyGetAsync($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['exportBodyGet'][0])
    {
        return $this->exportBodyGetAsyncWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation exportBodyGetAsyncWithHttpInfo
     *
     * Stažení těla exportu
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $file_name Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $content_type Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['exportBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function exportBodyGetAsyncWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['exportBodyGet'][0])
    {
        $returnType = '\SplFileObject';
        $request = $this->exportBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);

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
     * Create request for operation 'exportBodyGet'
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $file_name Název exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $content_type Typ obsahu exportovaného souboru (získaný např. z API /businessCase/:businessCaseId/pdfExport) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['exportBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function exportBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['exportBodyGet'][0])
    {

        // verify the required parameter 'uuid' is set
        if ($uuid === null || (is_array($uuid) && count($uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $uuid when calling exportBodyGet'
            );
        }

        // verify the required parameter 'access_token' is set
        if ($access_token === null || (is_array($access_token) && count($access_token) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $access_token when calling exportBodyGet'
            );
        }

        // verify the required parameter 'instance_name' is set
        if ($instance_name === null || (is_array($instance_name) && count($instance_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instance_name when calling exportBodyGet'
            );
        }

        // verify the required parameter 'file_name' is set
        if ($file_name === null || (is_array($file_name) && count($file_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file_name when calling exportBodyGet'
            );
        }

        // verify the required parameter 'content_type' is set
        if ($content_type === null || (is_array($content_type) && count($content_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $content_type when calling exportBodyGet'
            );
        }


        $resourcePath = '/exportBody/{uuid}/{accessToken}/{instanceName}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $file_name,
            'fileName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $content_type,
            'contentType', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


        // path params
        if ($uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'uuid' . '}',
                ObjectSerializer::toPathValue($uuid),
                $resourcePath
            );
        }
        // path params
        if ($access_token !== null) {
            $resourcePath = str_replace(
                '{' . 'accessToken' . '}',
                ObjectSerializer::toPathValue($access_token),
                $resourcePath
            );
        }
        // path params
        if ($instance_name !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceName' . '}',
                ObjectSerializer::toPathValue($instance_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', ],
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
     * Operation fileBodyGet
     *
     * Stažení těla souboru
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný z API /fileHeader) (required)
     * @param  string $file_name Název souboru (získaný z API /fileHeader) (required)
     * @param  string $content_type Typ obsahu souboru (získaný z API /fileHeader) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileBodyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function fileBodyGet($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['fileBodyGet'][0])
    {
        list($response) = $this->fileBodyGetWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);
        return $response;
    }

    /**
     * Operation fileBodyGetWithHttpInfo
     *
     * Stažení těla souboru
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný z API /fileHeader) (required)
     * @param  string $file_name Název souboru (získaný z API /fileHeader) (required)
     * @param  string $content_type Typ obsahu souboru (získaný z API /fileHeader) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileBodyGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    public function fileBodyGetWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['fileBodyGet'][0])
    {
        $request = $this->fileBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);

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
                    if ('\SplFileObject' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\SplFileObject' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\SplFileObject', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\SplFileObject';
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
                        '\SplFileObject',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation fileBodyGetAsync
     *
     * Stažení těla souboru
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný z API /fileHeader) (required)
     * @param  string $file_name Název souboru (získaný z API /fileHeader) (required)
     * @param  string $content_type Typ obsahu souboru (získaný z API /fileHeader) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileBodyGetAsync($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['fileBodyGet'][0])
    {
        return $this->fileBodyGetAsyncWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation fileBodyGetAsyncWithHttpInfo
     *
     * Stažení těla souboru
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný z API /fileHeader) (required)
     * @param  string $file_name Název souboru (získaný z API /fileHeader) (required)
     * @param  string $content_type Typ obsahu souboru (získaný z API /fileHeader) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileBodyGetAsyncWithHttpInfo($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['fileBodyGet'][0])
    {
        $returnType = '\SplFileObject';
        $request = $this->fileBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, $contentType);

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
     * Create request for operation 'fileBodyGet'
     *
     * @param  int $uuid UUID souboru (jednoznačný identifikátor souboru v CRM, získaný z API /fileHeader) (required)
     * @param  string $access_token Access token (vygenerovaný jednorázový autorizační klíč, získaný z API /fileHeader) (required)
     * @param  string $instance_name Název instance (název vašeho CRM, získaný z API /fileHeader) (required)
     * @param  string $file_name Název souboru (získaný z API /fileHeader) (required)
     * @param  string $content_type Typ obsahu souboru (získaný z API /fileHeader) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileBodyGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function fileBodyGetRequest($uuid, $access_token, $instance_name, $file_name, $content_type, string $contentType = self::contentTypes['fileBodyGet'][0])
    {

        // verify the required parameter 'uuid' is set
        if ($uuid === null || (is_array($uuid) && count($uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $uuid when calling fileBodyGet'
            );
        }

        // verify the required parameter 'access_token' is set
        if ($access_token === null || (is_array($access_token) && count($access_token) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $access_token when calling fileBodyGet'
            );
        }

        // verify the required parameter 'instance_name' is set
        if ($instance_name === null || (is_array($instance_name) && count($instance_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instance_name when calling fileBodyGet'
            );
        }

        // verify the required parameter 'file_name' is set
        if ($file_name === null || (is_array($file_name) && count($file_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file_name when calling fileBodyGet'
            );
        }

        // verify the required parameter 'content_type' is set
        if ($content_type === null || (is_array($content_type) && count($content_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $content_type when calling fileBodyGet'
            );
        }


        $resourcePath = '/fileBody/{uuid}/{accessToken}/{instanceName}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $file_name,
            'fileName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $content_type,
            'contentType', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


        // path params
        if ($uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'uuid' . '}',
                ObjectSerializer::toPathValue($uuid),
                $resourcePath
            );
        }
        // path params
        if ($access_token !== null) {
            $resourcePath = str_replace(
                '{' . 'accessToken' . '}',
                ObjectSerializer::toPathValue($access_token),
                $resourcePath
            );
        }
        // path params
        if ($instance_name !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceName' . '}',
                ObjectSerializer::toPathValue($instance_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/octet-stream', ],
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
     * Operation fileHeaderDetailGet
     *
     * Stažení meta informací o souboru
     *
     * @param  int $file_id ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileHeaderDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function fileHeaderDetailGet($file_id, string $contentType = self::contentTypes['fileHeaderDetailGet'][0])
    {
        $this->fileHeaderDetailGetWithHttpInfo($file_id, $contentType);
    }

    /**
     * Operation fileHeaderDetailGetWithHttpInfo
     *
     * Stažení meta informací o souboru
     *
     * @param  int $file_id ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileHeaderDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function fileHeaderDetailGetWithHttpInfo($file_id, string $contentType = self::contentTypes['fileHeaderDetailGet'][0])
    {
        $request = $this->fileHeaderDetailGetRequest($file_id, $contentType);

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
     * Operation fileHeaderDetailGetAsync
     *
     * Stažení meta informací o souboru
     *
     * @param  int $file_id ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileHeaderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileHeaderDetailGetAsync($file_id, string $contentType = self::contentTypes['fileHeaderDetailGet'][0])
    {
        return $this->fileHeaderDetailGetAsyncWithHttpInfo($file_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation fileHeaderDetailGetAsyncWithHttpInfo
     *
     * Stažení meta informací o souboru
     *
     * @param  int $file_id ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileHeaderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileHeaderDetailGetAsyncWithHttpInfo($file_id, string $contentType = self::contentTypes['fileHeaderDetailGet'][0])
    {
        $returnType = '';
        $request = $this->fileHeaderDetailGetRequest($file_id, $contentType);

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
     * Create request for operation 'fileHeaderDetailGet'
     *
     * @param  int $file_id ID souboru (získaného z detailu záznamu (např.: attachment -&gt; file -&gt; id), kde se foto, logo nebo příloha nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileHeaderDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function fileHeaderDetailGetRequest($file_id, string $contentType = self::contentTypes['fileHeaderDetailGet'][0])
    {

        // verify the required parameter 'file_id' is set
        if ($file_id === null || (is_array($file_id) && count($file_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file_id when calling fileHeaderDetailGet'
            );
        }


        $resourcePath = '/fileHeader/{fileId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($file_id !== null) {
            $resourcePath = str_replace(
                '{' . 'fileId' . '}',
                ObjectSerializer::toPathValue($file_id),
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
     * Operation fileUploadEdit
     *
     * Upload souboru do CRM
     *
     * @param  \SplFileObject $file file (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileUploadEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\FileUploadEdit200Response
     */
    public function fileUploadEdit($file, string $contentType = self::contentTypes['fileUploadEdit'][0])
    {
        list($response) = $this->fileUploadEditWithHttpInfo($file, $contentType);
        return $response;
    }

    /**
     * Operation fileUploadEditWithHttpInfo
     *
     * Upload souboru do CRM
     *
     * @param  \SplFileObject $file (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileUploadEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\FileUploadEdit200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function fileUploadEditWithHttpInfo($file, string $contentType = self::contentTypes['fileUploadEdit'][0])
    {
        $request = $this->fileUploadEditRequest($file, $contentType);

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
                    if ('\RaynetApiClient\Model\FileUploadEdit200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\FileUploadEdit200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\FileUploadEdit200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\FileUploadEdit200Response';
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
                        '\RaynetApiClient\Model\FileUploadEdit200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation fileUploadEditAsync
     *
     * Upload souboru do CRM
     *
     * @param  \SplFileObject $file (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileUploadEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileUploadEditAsync($file, string $contentType = self::contentTypes['fileUploadEdit'][0])
    {
        return $this->fileUploadEditAsyncWithHttpInfo($file, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation fileUploadEditAsyncWithHttpInfo
     *
     * Upload souboru do CRM
     *
     * @param  \SplFileObject $file (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileUploadEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function fileUploadEditAsyncWithHttpInfo($file, string $contentType = self::contentTypes['fileUploadEdit'][0])
    {
        $returnType = '\RaynetApiClient\Model\FileUploadEdit200Response';
        $request = $this->fileUploadEditRequest($file, $contentType);

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
     * Create request for operation 'fileUploadEdit'
     *
     * @param  \SplFileObject $file (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['fileUploadEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function fileUploadEditRequest($file, string $contentType = self::contentTypes['fileUploadEdit'][0])
    {

        // verify the required parameter 'file' is set
        if ($file === null || (is_array($file) && count($file) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file when calling fileUploadEdit'
            );
        }


        $resourcePath = '/fileUpload';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        if ($file !== null) {
            $multipart = true;
            $formParams['file'] = [];
            $paramFiles = is_array($file) ? $file : [$file];
            foreach ($paramFiles as $paramFile) {
                $formParams['file'][] = \GuzzleHttp\Psr7\Utils::tryFopen(
                    ObjectSerializer::toFormValue($paramFile),
                    'rb'
                );
            }
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
     * Operation iconDetailGet
     *
     * Stažení ikony obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['iconDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function iconDetailGet($file_id, string $contentType = self::contentTypes['iconDetailGet'][0])
    {
        $this->iconDetailGetWithHttpInfo($file_id, $contentType);
    }

    /**
     * Operation iconDetailGetWithHttpInfo
     *
     * Stažení ikony obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['iconDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function iconDetailGetWithHttpInfo($file_id, string $contentType = self::contentTypes['iconDetailGet'][0])
    {
        $request = $this->iconDetailGetRequest($file_id, $contentType);

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
     * Operation iconDetailGetAsync
     *
     * Stažení ikony obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['iconDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function iconDetailGetAsync($file_id, string $contentType = self::contentTypes['iconDetailGet'][0])
    {
        return $this->iconDetailGetAsyncWithHttpInfo($file_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation iconDetailGetAsyncWithHttpInfo
     *
     * Stažení ikony obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['iconDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function iconDetailGetAsyncWithHttpInfo($file_id, string $contentType = self::contentTypes['iconDetailGet'][0])
    {
        $returnType = '';
        $request = $this->iconDetailGetRequest($file_id, $contentType);

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
     * Create request for operation 'iconDetailGet'
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['iconDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function iconDetailGetRequest($file_id, string $contentType = self::contentTypes['iconDetailGet'][0])
    {

        // verify the required parameter 'file_id' is set
        if ($file_id === null || (is_array($file_id) && count($file_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file_id when calling iconDetailGet'
            );
        }


        $resourcePath = '/icon/{fileId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($file_id !== null) {
            $resourcePath = str_replace(
                '{' . 'fileId' . '}',
                ObjectSerializer::toPathValue($file_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['image/png', ],
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
     * Operation imageDetailGet
     *
     * Stažení obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['imageDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function imageDetailGet($file_id, string $contentType = self::contentTypes['imageDetailGet'][0])
    {
        $this->imageDetailGetWithHttpInfo($file_id, $contentType);
    }

    /**
     * Operation imageDetailGetWithHttpInfo
     *
     * Stažení obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['imageDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function imageDetailGetWithHttpInfo($file_id, string $contentType = self::contentTypes['imageDetailGet'][0])
    {
        $request = $this->imageDetailGetRequest($file_id, $contentType);

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
     * Operation imageDetailGetAsync
     *
     * Stažení obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['imageDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function imageDetailGetAsync($file_id, string $contentType = self::contentTypes['imageDetailGet'][0])
    {
        return $this->imageDetailGetAsyncWithHttpInfo($file_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation imageDetailGetAsyncWithHttpInfo
     *
     * Stažení obrázku
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['imageDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function imageDetailGetAsyncWithHttpInfo($file_id, string $contentType = self::contentTypes['imageDetailGet'][0])
    {
        $returnType = '';
        $request = $this->imageDetailGetRequest($file_id, $contentType);

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
     * Create request for operation 'imageDetailGet'
     *
     * @param  int $file_id ID loga nebo fota (získaného z detailu záznamu, kde se foto / logo nachází) (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['imageDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function imageDetailGetRequest($file_id, string $contentType = self::contentTypes['imageDetailGet'][0])
    {

        // verify the required parameter 'file_id' is set
        if ($file_id === null || (is_array($file_id) && count($file_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file_id when calling imageDetailGet'
            );
        }


        $resourcePath = '/image/{fileId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($file_id !== null) {
            $resourcePath = str_replace(
                '{' . 'fileId' . '}',
                ObjectSerializer::toPathValue($file_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['image/png', ],
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
