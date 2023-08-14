<?php
/**
 * VolitelnPoleApi
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
 * VolitelnPoleApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class VolitelnPoleApi
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
        'customFieldConfigDelete' => [
            'application/json',
        ],
        'customFieldConfigEdit' => [
            'application/json',
        ],
        'customFieldConfigGet' => [
            'application/json',
        ],
        'customFieldConfigInsert' => [
            'application/json',
        ],
        'customFieldEnumDelete' => [
            'application/json',
        ],
        'customFieldEnumEdit' => [
            'application/json',
        ],
        'customFieldEnumGet' => [
            'application/json',
        ],
        'customFieldEnumInsert' => [
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
     * Operation customFieldConfigDelete
     *
     * Smazání volitelného pole
     *
     * @param  string $entity_name Název entity, ze které se má volitelné pole smazat (required)
     * @param  string $field_name Kód volitelného pole, které se má smazat (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumDelete200Response
     */
    public function customFieldConfigDelete($entity_name, $field_name, string $contentType = self::contentTypes['customFieldConfigDelete'][0])
    {
        list($response) = $this->customFieldConfigDeleteWithHttpInfo($entity_name, $field_name, $contentType);
        return $response;
    }

    /**
     * Operation customFieldConfigDeleteWithHttpInfo
     *
     * Smazání volitelného pole
     *
     * @param  string $entity_name Název entity, ze které se má volitelné pole smazat (required)
     * @param  string $field_name Kód volitelného pole, které se má smazat (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumDelete200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldConfigDeleteWithHttpInfo($entity_name, $field_name, string $contentType = self::contentTypes['customFieldConfigDelete'][0])
    {
        $request = $this->customFieldConfigDeleteRequest($entity_name, $field_name, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumDelete200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumDelete200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumDelete200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumDelete200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumDelete200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldConfigDeleteAsync
     *
     * Smazání volitelného pole
     *
     * @param  string $entity_name Název entity, ze které se má volitelné pole smazat (required)
     * @param  string $field_name Kód volitelného pole, které se má smazat (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigDeleteAsync($entity_name, $field_name, string $contentType = self::contentTypes['customFieldConfigDelete'][0])
    {
        return $this->customFieldConfigDeleteAsyncWithHttpInfo($entity_name, $field_name, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldConfigDeleteAsyncWithHttpInfo
     *
     * Smazání volitelného pole
     *
     * @param  string $entity_name Název entity, ze které se má volitelné pole smazat (required)
     * @param  string $field_name Kód volitelného pole, které se má smazat (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigDeleteAsyncWithHttpInfo($entity_name, $field_name, string $contentType = self::contentTypes['customFieldConfigDelete'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumDelete200Response';
        $request = $this->customFieldConfigDeleteRequest($entity_name, $field_name, $contentType);

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
     * Create request for operation 'customFieldConfigDelete'
     *
     * @param  string $entity_name Název entity, ze které se má volitelné pole smazat (required)
     * @param  string $field_name Kód volitelného pole, které se má smazat (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldConfigDeleteRequest($entity_name, $field_name, string $contentType = self::contentTypes['customFieldConfigDelete'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldConfigDelete'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldConfigDelete'
            );
        }


        $resourcePath = '/customField/config/{entityName}/{fieldName}';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
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
     * Operation customFieldConfigEdit
     *
     * Upravení volitelného pole
     *
     * @param  string $entity_name Název entity, ve které se má volitelné pole upravit (required)
     * @param  string $field_name Kód volitelného pole, které se má upravit (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigEditDto $custom_field_config_edit_dto custom_field_config_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumEdit200Response
     */
    public function customFieldConfigEdit($entity_name, $field_name, $custom_field_config_edit_dto = null, string $contentType = self::contentTypes['customFieldConfigEdit'][0])
    {
        list($response) = $this->customFieldConfigEditWithHttpInfo($entity_name, $field_name, $custom_field_config_edit_dto, $contentType);
        return $response;
    }

    /**
     * Operation customFieldConfigEditWithHttpInfo
     *
     * Upravení volitelného pole
     *
     * @param  string $entity_name Název entity, ve které se má volitelné pole upravit (required)
     * @param  string $field_name Kód volitelného pole, které se má upravit (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigEditDto $custom_field_config_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumEdit200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldConfigEditWithHttpInfo($entity_name, $field_name, $custom_field_config_edit_dto = null, string $contentType = self::contentTypes['customFieldConfigEdit'][0])
    {
        $request = $this->customFieldConfigEditRequest($entity_name, $field_name, $custom_field_config_edit_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumEdit200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumEdit200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumEdit200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumEdit200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumEdit200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldConfigEditAsync
     *
     * Upravení volitelného pole
     *
     * @param  string $entity_name Název entity, ve které se má volitelné pole upravit (required)
     * @param  string $field_name Kód volitelného pole, které se má upravit (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigEditDto $custom_field_config_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigEditAsync($entity_name, $field_name, $custom_field_config_edit_dto = null, string $contentType = self::contentTypes['customFieldConfigEdit'][0])
    {
        return $this->customFieldConfigEditAsyncWithHttpInfo($entity_name, $field_name, $custom_field_config_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldConfigEditAsyncWithHttpInfo
     *
     * Upravení volitelného pole
     *
     * @param  string $entity_name Název entity, ve které se má volitelné pole upravit (required)
     * @param  string $field_name Kód volitelného pole, které se má upravit (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigEditDto $custom_field_config_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigEditAsyncWithHttpInfo($entity_name, $field_name, $custom_field_config_edit_dto = null, string $contentType = self::contentTypes['customFieldConfigEdit'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumEdit200Response';
        $request = $this->customFieldConfigEditRequest($entity_name, $field_name, $custom_field_config_edit_dto, $contentType);

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
     * Create request for operation 'customFieldConfigEdit'
     *
     * @param  string $entity_name Název entity, ve které se má volitelné pole upravit (required)
     * @param  string $field_name Kód volitelného pole, které se má upravit (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigEditDto $custom_field_config_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldConfigEditRequest($entity_name, $field_name, $custom_field_config_edit_dto = null, string $contentType = self::contentTypes['customFieldConfigEdit'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldConfigEdit'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldConfigEdit'
            );
        }



        $resourcePath = '/customField/config/{entityName}/{fieldName}';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($custom_field_config_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($custom_field_config_edit_dto));
            } else {
                $httpBody = $custom_field_config_edit_dto;
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
     * Operation customFieldConfigGet
     *
     * Načtení konfigurace
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldConfigGet200Response
     */
    public function customFieldConfigGet(string $contentType = self::contentTypes['customFieldConfigGet'][0])
    {
        list($response) = $this->customFieldConfigGetWithHttpInfo($contentType);
        return $response;
    }

    /**
     * Operation customFieldConfigGetWithHttpInfo
     *
     * Načtení konfigurace
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldConfigGet200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldConfigGetWithHttpInfo(string $contentType = self::contentTypes['customFieldConfigGet'][0])
    {
        $request = $this->customFieldConfigGetRequest($contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldConfigGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldConfigGet200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldConfigGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldConfigGet200Response';
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
                        '\RaynetApiClient\Model\CustomFieldConfigGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldConfigGetAsync
     *
     * Načtení konfigurace
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigGetAsync(string $contentType = self::contentTypes['customFieldConfigGet'][0])
    {
        return $this->customFieldConfigGetAsyncWithHttpInfo($contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldConfigGetAsyncWithHttpInfo
     *
     * Načtení konfigurace
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigGetAsyncWithHttpInfo(string $contentType = self::contentTypes['customFieldConfigGet'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldConfigGet200Response';
        $request = $this->customFieldConfigGetRequest($contentType);

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
     * Create request for operation 'customFieldConfigGet'
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldConfigGetRequest(string $contentType = self::contentTypes['customFieldConfigGet'][0])
    {


        $resourcePath = '/customField/config/';
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
     * Operation customFieldConfigInsert
     *
     * Nové volitelné pole
     *
     * @param  string $entity_name Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigInsertDto $custom_field_config_insert_dto custom_field_config_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldConfigInsert201Response
     */
    public function customFieldConfigInsert($entity_name, $custom_field_config_insert_dto = null, string $contentType = self::contentTypes['customFieldConfigInsert'][0])
    {
        list($response) = $this->customFieldConfigInsertWithHttpInfo($entity_name, $custom_field_config_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation customFieldConfigInsertWithHttpInfo
     *
     * Nové volitelné pole
     *
     * @param  string $entity_name Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigInsertDto $custom_field_config_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldConfigInsert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldConfigInsertWithHttpInfo($entity_name, $custom_field_config_insert_dto = null, string $contentType = self::contentTypes['customFieldConfigInsert'][0])
    {
        $request = $this->customFieldConfigInsertRequest($entity_name, $custom_field_config_insert_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldConfigInsert201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldConfigInsert201Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldConfigInsert201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldConfigInsert201Response';
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
                        '\RaynetApiClient\Model\CustomFieldConfigInsert201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldConfigInsertAsync
     *
     * Nové volitelné pole
     *
     * @param  string $entity_name Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigInsertDto $custom_field_config_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigInsertAsync($entity_name, $custom_field_config_insert_dto = null, string $contentType = self::contentTypes['customFieldConfigInsert'][0])
    {
        return $this->customFieldConfigInsertAsyncWithHttpInfo($entity_name, $custom_field_config_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldConfigInsertAsyncWithHttpInfo
     *
     * Nové volitelné pole
     *
     * @param  string $entity_name Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigInsertDto $custom_field_config_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldConfigInsertAsyncWithHttpInfo($entity_name, $custom_field_config_insert_dto = null, string $contentType = self::contentTypes['customFieldConfigInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldConfigInsert201Response';
        $request = $this->customFieldConfigInsertRequest($entity_name, $custom_field_config_insert_dto, $contentType);

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
     * Create request for operation 'customFieldConfigInsert'
     *
     * @param  string $entity_name Název entity, ke které se volitelné pole založí (podporované hodnoty jsou: &#x60;company&#x60;, &#x60;lead&#x60;, &#x60;person&#x60;, &#x60;businessCase&#x60;, &#x60;offer&#x60;, &#x60;salesOrder&#x60;, &#x60;product&#x60;, &#x60;project&#x60;, &#x60;task&#x60;, &#x60;email&#x60;, &#x60;event&#x60;, &#x60;letter&#x60;, &#x60;phoneCall&#x60;, &#x60;meeting&#x60;) (required)
     * @param  \RaynetApiClient\Model\CustomFieldConfigInsertDto $custom_field_config_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldConfigInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldConfigInsertRequest($entity_name, $custom_field_config_insert_dto = null, string $contentType = self::contentTypes['customFieldConfigInsert'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldConfigInsert'
            );
        }



        $resourcePath = '/customField/config/{entityName}/';
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


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($custom_field_config_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($custom_field_config_insert_dto));
            } else {
                $httpBody = $custom_field_config_insert_dto;
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
     * Operation customFieldEnumDelete
     *
     * Smazání položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumDeleteDto $custom_field_enum_delete_dto custom_field_enum_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumDelete200Response
     */
    public function customFieldEnumDelete($entity_name, $field_name, $custom_field_enum_delete_dto = null, string $contentType = self::contentTypes['customFieldEnumDelete'][0])
    {
        list($response) = $this->customFieldEnumDeleteWithHttpInfo($entity_name, $field_name, $custom_field_enum_delete_dto, $contentType);
        return $response;
    }

    /**
     * Operation customFieldEnumDeleteWithHttpInfo
     *
     * Smazání položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumDeleteDto $custom_field_enum_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumDelete200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldEnumDeleteWithHttpInfo($entity_name, $field_name, $custom_field_enum_delete_dto = null, string $contentType = self::contentTypes['customFieldEnumDelete'][0])
    {
        $request = $this->customFieldEnumDeleteRequest($entity_name, $field_name, $custom_field_enum_delete_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumDelete200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumDelete200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumDelete200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumDelete200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumDelete200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldEnumDeleteAsync
     *
     * Smazání položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumDeleteDto $custom_field_enum_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumDeleteAsync($entity_name, $field_name, $custom_field_enum_delete_dto = null, string $contentType = self::contentTypes['customFieldEnumDelete'][0])
    {
        return $this->customFieldEnumDeleteAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_delete_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldEnumDeleteAsyncWithHttpInfo
     *
     * Smazání položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumDeleteDto $custom_field_enum_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumDeleteAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_delete_dto = null, string $contentType = self::contentTypes['customFieldEnumDelete'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumDelete200Response';
        $request = $this->customFieldEnumDeleteRequest($entity_name, $field_name, $custom_field_enum_delete_dto, $contentType);

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
     * Create request for operation 'customFieldEnumDelete'
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumDeleteDto $custom_field_enum_delete_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldEnumDeleteRequest($entity_name, $field_name, $custom_field_enum_delete_dto = null, string $contentType = self::contentTypes['customFieldEnumDelete'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldEnumDelete'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldEnumDelete'
            );
        }



        $resourcePath = '/customField/enum/{entityName}/{fieldName}/';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($custom_field_enum_delete_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($custom_field_enum_delete_dto));
            } else {
                $httpBody = $custom_field_enum_delete_dto;
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
     * Operation customFieldEnumEdit
     *
     * Upravení položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumEditDto $custom_field_enum_edit_dto custom_field_enum_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumEdit200Response
     */
    public function customFieldEnumEdit($entity_name, $field_name, $custom_field_enum_edit_dto = null, string $contentType = self::contentTypes['customFieldEnumEdit'][0])
    {
        list($response) = $this->customFieldEnumEditWithHttpInfo($entity_name, $field_name, $custom_field_enum_edit_dto, $contentType);
        return $response;
    }

    /**
     * Operation customFieldEnumEditWithHttpInfo
     *
     * Upravení položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumEditDto $custom_field_enum_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumEdit200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldEnumEditWithHttpInfo($entity_name, $field_name, $custom_field_enum_edit_dto = null, string $contentType = self::contentTypes['customFieldEnumEdit'][0])
    {
        $request = $this->customFieldEnumEditRequest($entity_name, $field_name, $custom_field_enum_edit_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumEdit200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumEdit200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumEdit200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumEdit200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumEdit200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldEnumEditAsync
     *
     * Upravení položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumEditDto $custom_field_enum_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumEditAsync($entity_name, $field_name, $custom_field_enum_edit_dto = null, string $contentType = self::contentTypes['customFieldEnumEdit'][0])
    {
        return $this->customFieldEnumEditAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldEnumEditAsyncWithHttpInfo
     *
     * Upravení položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumEditDto $custom_field_enum_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumEditAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_edit_dto = null, string $contentType = self::contentTypes['customFieldEnumEdit'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumEdit200Response';
        $request = $this->customFieldEnumEditRequest($entity_name, $field_name, $custom_field_enum_edit_dto, $contentType);

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
     * Create request for operation 'customFieldEnumEdit'
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumEditDto $custom_field_enum_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldEnumEditRequest($entity_name, $field_name, $custom_field_enum_edit_dto = null, string $contentType = self::contentTypes['customFieldEnumEdit'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldEnumEdit'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldEnumEdit'
            );
        }



        $resourcePath = '/customField/enum/{entityName}/{fieldName}/';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($custom_field_enum_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($custom_field_enum_edit_dto));
            } else {
                $httpBody = $custom_field_enum_edit_dto;
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
     * Operation customFieldEnumGet
     *
     * Načtení seznamu položek enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumGet200Response
     */
    public function customFieldEnumGet($entity_name, $field_name, string $contentType = self::contentTypes['customFieldEnumGet'][0])
    {
        list($response) = $this->customFieldEnumGetWithHttpInfo($entity_name, $field_name, $contentType);
        return $response;
    }

    /**
     * Operation customFieldEnumGetWithHttpInfo
     *
     * Načtení seznamu položek enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumGet200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldEnumGetWithHttpInfo($entity_name, $field_name, string $contentType = self::contentTypes['customFieldEnumGet'][0])
    {
        $request = $this->customFieldEnumGetRequest($entity_name, $field_name, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumGet200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumGet200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldEnumGetAsync
     *
     * Načtení seznamu položek enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumGetAsync($entity_name, $field_name, string $contentType = self::contentTypes['customFieldEnumGet'][0])
    {
        return $this->customFieldEnumGetAsyncWithHttpInfo($entity_name, $field_name, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldEnumGetAsyncWithHttpInfo
     *
     * Načtení seznamu položek enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumGetAsyncWithHttpInfo($entity_name, $field_name, string $contentType = self::contentTypes['customFieldEnumGet'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumGet200Response';
        $request = $this->customFieldEnumGetRequest($entity_name, $field_name, $contentType);

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
     * Create request for operation 'customFieldEnumGet'
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldEnumGetRequest($entity_name, $field_name, string $contentType = self::contentTypes['customFieldEnumGet'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldEnumGet'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldEnumGet'
            );
        }


        $resourcePath = '/customField/enum/{entityName}/{fieldName}/';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
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
     * Operation customFieldEnumInsert
     *
     * Založení nové položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumInsertDto $custom_field_enum_insert_dto custom_field_enum_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\CustomFieldEnumInsert200Response
     */
    public function customFieldEnumInsert($entity_name, $field_name, $custom_field_enum_insert_dto = null, string $contentType = self::contentTypes['customFieldEnumInsert'][0])
    {
        list($response) = $this->customFieldEnumInsertWithHttpInfo($entity_name, $field_name, $custom_field_enum_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation customFieldEnumInsertWithHttpInfo
     *
     * Založení nové položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumInsertDto $custom_field_enum_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\CustomFieldEnumInsert200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function customFieldEnumInsertWithHttpInfo($entity_name, $field_name, $custom_field_enum_insert_dto = null, string $contentType = self::contentTypes['customFieldEnumInsert'][0])
    {
        $request = $this->customFieldEnumInsertRequest($entity_name, $field_name, $custom_field_enum_insert_dto, $contentType);

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
                    if ('\RaynetApiClient\Model\CustomFieldEnumInsert200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RaynetApiClient\Model\CustomFieldEnumInsert200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\RaynetApiClient\Model\CustomFieldEnumInsert200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RaynetApiClient\Model\CustomFieldEnumInsert200Response';
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
                        '\RaynetApiClient\Model\CustomFieldEnumInsert200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation customFieldEnumInsertAsync
     *
     * Založení nové položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumInsertDto $custom_field_enum_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumInsertAsync($entity_name, $field_name, $custom_field_enum_insert_dto = null, string $contentType = self::contentTypes['customFieldEnumInsert'][0])
    {
        return $this->customFieldEnumInsertAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation customFieldEnumInsertAsyncWithHttpInfo
     *
     * Založení nové položky enumerace
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumInsertDto $custom_field_enum_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function customFieldEnumInsertAsyncWithHttpInfo($entity_name, $field_name, $custom_field_enum_insert_dto = null, string $contentType = self::contentTypes['customFieldEnumInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\CustomFieldEnumInsert200Response';
        $request = $this->customFieldEnumInsertRequest($entity_name, $field_name, $custom_field_enum_insert_dto, $contentType);

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
     * Create request for operation 'customFieldEnumInsert'
     *
     * @param  string $entity_name Název entity, která volitelné pole obsahuje (required)
     * @param  string $field_name Klíč volitelného pole (required)
     * @param  \RaynetApiClient\Model\CustomFieldEnumInsertDto $custom_field_enum_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['customFieldEnumInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function customFieldEnumInsertRequest($entity_name, $field_name, $custom_field_enum_insert_dto = null, string $contentType = self::contentTypes['customFieldEnumInsert'][0])
    {

        // verify the required parameter 'entity_name' is set
        if ($entity_name === null || (is_array($entity_name) && count($entity_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity_name when calling customFieldEnumInsert'
            );
        }

        // verify the required parameter 'field_name' is set
        if ($field_name === null || (is_array($field_name) && count($field_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $field_name when calling customFieldEnumInsert'
            );
        }



        $resourcePath = '/customField/enum/{entityName}/{fieldName}/';
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
        if ($field_name !== null) {
            $resourcePath = str_replace(
                '{' . 'fieldName' . '}',
                ObjectSerializer::toPathValue($field_name),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($custom_field_enum_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($custom_field_enum_insert_dto));
            } else {
                $httpBody = $custom_field_enum_insert_dto;
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
