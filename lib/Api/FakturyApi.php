<?php
/**
 * FakturyApi
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
 * FakturyApi Class Doc Comment
 *
 * @category Class
 * @package  RaynetApiClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FakturyApi
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
        'invoiceCancelEdit' => [
            'application/json',
        ],
        'invoiceChangeCodeEdit' => [
            'application/json',
        ],
        'invoiceChangeDecimalPrecisionEdit' => [
            'application/json',
        ],
        'invoiceCreditNoteInsert' => [
            'application/json',
        ],
        'invoiceDelete' => [
            'application/json',
        ],
        'invoiceDetailGet' => [
            'application/json',
        ],
        'invoiceEdit' => [
            'application/json',
        ],
        'invoiceGet' => [
            'application/json',
        ],
        'invoiceInsert' => [
            'application/json',
        ],
        'invoiceLockEdit' => [
            'application/json',
        ],
        'invoicePaymentDelete' => [
            'application/json',
        ],
        'invoicePaymentInsert' => [
            'application/json',
        ],
        'invoicePdfExportDetailGet' => [
            'application/json',
        ],
        'invoiceRenewEdit' => [
            'application/json',
        ],
        'invoiceUnlockEdit' => [
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
     * Operation invoiceCancelEdit
     *
     * stornovat fakturu
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCancelEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceCancelEdit($invoice_id, string $contentType = self::contentTypes['invoiceCancelEdit'][0])
    {
        $this->invoiceCancelEditWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceCancelEditWithHttpInfo
     *
     * stornovat fakturu
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCancelEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceCancelEditWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceCancelEdit'][0])
    {
        $request = $this->invoiceCancelEditRequest($invoice_id, $contentType);

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
     * Operation invoiceCancelEditAsync
     *
     * stornovat fakturu
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCancelEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceCancelEditAsync($invoice_id, string $contentType = self::contentTypes['invoiceCancelEdit'][0])
    {
        return $this->invoiceCancelEditAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceCancelEditAsyncWithHttpInfo
     *
     * stornovat fakturu
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCancelEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceCancelEditAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceCancelEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceCancelEditRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceCancelEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCancelEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceCancelEditRequest($invoice_id, string $contentType = self::contentTypes['invoiceCancelEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceCancelEdit'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/cancel';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoiceChangeCodeEdit
     *
     * změna kódu faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeCodeEditRequest $invoice_change_code_edit_request invoice_change_code_edit_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeCodeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceChangeCodeEdit($invoice_id, $invoice_change_code_edit_request = null, string $contentType = self::contentTypes['invoiceChangeCodeEdit'][0])
    {
        $this->invoiceChangeCodeEditWithHttpInfo($invoice_id, $invoice_change_code_edit_request, $contentType);
    }

    /**
     * Operation invoiceChangeCodeEditWithHttpInfo
     *
     * změna kódu faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeCodeEditRequest $invoice_change_code_edit_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeCodeEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceChangeCodeEditWithHttpInfo($invoice_id, $invoice_change_code_edit_request = null, string $contentType = self::contentTypes['invoiceChangeCodeEdit'][0])
    {
        $request = $this->invoiceChangeCodeEditRequest($invoice_id, $invoice_change_code_edit_request, $contentType);

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
     * Operation invoiceChangeCodeEditAsync
     *
     * změna kódu faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeCodeEditRequest $invoice_change_code_edit_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeCodeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceChangeCodeEditAsync($invoice_id, $invoice_change_code_edit_request = null, string $contentType = self::contentTypes['invoiceChangeCodeEdit'][0])
    {
        return $this->invoiceChangeCodeEditAsyncWithHttpInfo($invoice_id, $invoice_change_code_edit_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceChangeCodeEditAsyncWithHttpInfo
     *
     * změna kódu faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeCodeEditRequest $invoice_change_code_edit_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeCodeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceChangeCodeEditAsyncWithHttpInfo($invoice_id, $invoice_change_code_edit_request = null, string $contentType = self::contentTypes['invoiceChangeCodeEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceChangeCodeEditRequest($invoice_id, $invoice_change_code_edit_request, $contentType);

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
     * Create request for operation 'invoiceChangeCodeEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeCodeEditRequest $invoice_change_code_edit_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeCodeEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceChangeCodeEditRequest($invoice_id, $invoice_change_code_edit_request = null, string $contentType = self::contentTypes['invoiceChangeCodeEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceChangeCodeEdit'
            );
        }



        $resourcePath = '/invoice/{invoiceId}/changeCode';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($invoice_change_code_edit_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_change_code_edit_request));
            } else {
                $httpBody = $invoice_change_code_edit_request;
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
     * Operation invoiceChangeDecimalPrecisionEdit
     *
     * změna počtu desetinných míst
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto $invoice_change_decimal_precision_edit_dto invoice_change_decimal_precision_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeDecimalPrecisionEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceChangeDecimalPrecisionEdit($invoice_id, $invoice_change_decimal_precision_edit_dto = null, string $contentType = self::contentTypes['invoiceChangeDecimalPrecisionEdit'][0])
    {
        $this->invoiceChangeDecimalPrecisionEditWithHttpInfo($invoice_id, $invoice_change_decimal_precision_edit_dto, $contentType);
    }

    /**
     * Operation invoiceChangeDecimalPrecisionEditWithHttpInfo
     *
     * změna počtu desetinných míst
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto $invoice_change_decimal_precision_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeDecimalPrecisionEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceChangeDecimalPrecisionEditWithHttpInfo($invoice_id, $invoice_change_decimal_precision_edit_dto = null, string $contentType = self::contentTypes['invoiceChangeDecimalPrecisionEdit'][0])
    {
        $request = $this->invoiceChangeDecimalPrecisionEditRequest($invoice_id, $invoice_change_decimal_precision_edit_dto, $contentType);

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
     * Operation invoiceChangeDecimalPrecisionEditAsync
     *
     * změna počtu desetinných míst
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto $invoice_change_decimal_precision_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeDecimalPrecisionEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceChangeDecimalPrecisionEditAsync($invoice_id, $invoice_change_decimal_precision_edit_dto = null, string $contentType = self::contentTypes['invoiceChangeDecimalPrecisionEdit'][0])
    {
        return $this->invoiceChangeDecimalPrecisionEditAsyncWithHttpInfo($invoice_id, $invoice_change_decimal_precision_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceChangeDecimalPrecisionEditAsyncWithHttpInfo
     *
     * změna počtu desetinných míst
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto $invoice_change_decimal_precision_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeDecimalPrecisionEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceChangeDecimalPrecisionEditAsyncWithHttpInfo($invoice_id, $invoice_change_decimal_precision_edit_dto = null, string $contentType = self::contentTypes['invoiceChangeDecimalPrecisionEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceChangeDecimalPrecisionEditRequest($invoice_id, $invoice_change_decimal_precision_edit_dto, $contentType);

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
     * Create request for operation 'invoiceChangeDecimalPrecisionEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceChangeDecimalPrecisionEditDto $invoice_change_decimal_precision_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceChangeDecimalPrecisionEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceChangeDecimalPrecisionEditRequest($invoice_id, $invoice_change_decimal_precision_edit_dto = null, string $contentType = self::contentTypes['invoiceChangeDecimalPrecisionEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceChangeDecimalPrecisionEdit'
            );
        }



        $resourcePath = '/invoice/{invoiceId}/changeDecimalPrecision';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($invoice_change_decimal_precision_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_change_decimal_precision_edit_dto));
            } else {
                $httpBody = $invoice_change_decimal_precision_edit_dto;
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
     * Operation invoiceCreditNoteInsert
     *
     * nový dobropis
     *
     * @param  \RaynetApiClient\Model\InvoiceCreditNoteInsertDto $invoice_credit_note_insert_dto invoice_credit_note_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCreditNoteInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceCreditNoteInsert($invoice_credit_note_insert_dto = null, string $contentType = self::contentTypes['invoiceCreditNoteInsert'][0])
    {
        $this->invoiceCreditNoteInsertWithHttpInfo($invoice_credit_note_insert_dto, $contentType);
    }

    /**
     * Operation invoiceCreditNoteInsertWithHttpInfo
     *
     * nový dobropis
     *
     * @param  \RaynetApiClient\Model\InvoiceCreditNoteInsertDto $invoice_credit_note_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCreditNoteInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceCreditNoteInsertWithHttpInfo($invoice_credit_note_insert_dto = null, string $contentType = self::contentTypes['invoiceCreditNoteInsert'][0])
    {
        $request = $this->invoiceCreditNoteInsertRequest($invoice_credit_note_insert_dto, $contentType);

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
     * Operation invoiceCreditNoteInsertAsync
     *
     * nový dobropis
     *
     * @param  \RaynetApiClient\Model\InvoiceCreditNoteInsertDto $invoice_credit_note_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCreditNoteInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceCreditNoteInsertAsync($invoice_credit_note_insert_dto = null, string $contentType = self::contentTypes['invoiceCreditNoteInsert'][0])
    {
        return $this->invoiceCreditNoteInsertAsyncWithHttpInfo($invoice_credit_note_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceCreditNoteInsertAsyncWithHttpInfo
     *
     * nový dobropis
     *
     * @param  \RaynetApiClient\Model\InvoiceCreditNoteInsertDto $invoice_credit_note_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCreditNoteInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceCreditNoteInsertAsyncWithHttpInfo($invoice_credit_note_insert_dto = null, string $contentType = self::contentTypes['invoiceCreditNoteInsert'][0])
    {
        $returnType = '';
        $request = $this->invoiceCreditNoteInsertRequest($invoice_credit_note_insert_dto, $contentType);

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
     * Create request for operation 'invoiceCreditNoteInsert'
     *
     * @param  \RaynetApiClient\Model\InvoiceCreditNoteInsertDto $invoice_credit_note_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceCreditNoteInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceCreditNoteInsertRequest($invoice_credit_note_insert_dto = null, string $contentType = self::contentTypes['invoiceCreditNoteInsert'][0])
    {



        $resourcePath = '/invoice/creditNote';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($invoice_credit_note_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_credit_note_insert_dto));
            } else {
                $httpBody = $invoice_credit_note_insert_dto;
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
     * Operation invoiceDelete
     *
     * smazání faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceDelete($invoice_id, string $contentType = self::contentTypes['invoiceDelete'][0])
    {
        $this->invoiceDeleteWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceDeleteWithHttpInfo
     *
     * smazání faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceDeleteWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceDelete'][0])
    {
        $request = $this->invoiceDeleteRequest($invoice_id, $contentType);

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
     * Operation invoiceDeleteAsync
     *
     * smazání faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceDeleteAsync($invoice_id, string $contentType = self::contentTypes['invoiceDelete'][0])
    {
        return $this->invoiceDeleteAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceDeleteAsyncWithHttpInfo
     *
     * smazání faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceDeleteAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceDelete'][0])
    {
        $returnType = '';
        $request = $this->invoiceDeleteRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceDelete'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceDeleteRequest($invoice_id, string $contentType = self::contentTypes['invoiceDelete'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceDelete'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoiceDetailGet
     *
     * detail faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceDetailGet($invoice_id, string $contentType = self::contentTypes['invoiceDetailGet'][0])
    {
        $this->invoiceDetailGetWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceDetailGetWithHttpInfo
     *
     * detail faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceDetailGetWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceDetailGet'][0])
    {
        $request = $this->invoiceDetailGetRequest($invoice_id, $contentType);

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
     * Operation invoiceDetailGetAsync
     *
     * detail faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceDetailGetAsync($invoice_id, string $contentType = self::contentTypes['invoiceDetailGet'][0])
    {
        return $this->invoiceDetailGetAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceDetailGetAsyncWithHttpInfo
     *
     * detail faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceDetailGetAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceDetailGet'][0])
    {
        $returnType = '';
        $request = $this->invoiceDetailGetRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceDetailGet'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceDetailGetRequest($invoice_id, string $contentType = self::contentTypes['invoiceDetailGet'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceDetailGet'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoiceEdit
     *
     * upravení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceEditDto $invoice_edit_dto invoice_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceEdit($invoice_id, $invoice_edit_dto = null, string $contentType = self::contentTypes['invoiceEdit'][0])
    {
        $this->invoiceEditWithHttpInfo($invoice_id, $invoice_edit_dto, $contentType);
    }

    /**
     * Operation invoiceEditWithHttpInfo
     *
     * upravení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceEditDto $invoice_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceEditWithHttpInfo($invoice_id, $invoice_edit_dto = null, string $contentType = self::contentTypes['invoiceEdit'][0])
    {
        $request = $this->invoiceEditRequest($invoice_id, $invoice_edit_dto, $contentType);

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
     * Operation invoiceEditAsync
     *
     * upravení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceEditDto $invoice_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceEditAsync($invoice_id, $invoice_edit_dto = null, string $contentType = self::contentTypes['invoiceEdit'][0])
    {
        return $this->invoiceEditAsyncWithHttpInfo($invoice_id, $invoice_edit_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceEditAsyncWithHttpInfo
     *
     * upravení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceEditDto $invoice_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceEditAsyncWithHttpInfo($invoice_id, $invoice_edit_dto = null, string $contentType = self::contentTypes['invoiceEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceEditRequest($invoice_id, $invoice_edit_dto, $contentType);

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
     * Create request for operation 'invoiceEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoiceEditDto $invoice_edit_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceEditRequest($invoice_id, $invoice_edit_dto = null, string $contentType = self::contentTypes['invoiceEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceEdit'
            );
        }



        $resourcePath = '/invoice/{invoiceId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($invoice_edit_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_edit_dto));
            } else {
                $httpBody = $invoice_edit_dto;
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
     * Operation invoiceGet
     *
     * seznam faktur
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených faktur je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $code Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  int $company Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $owner Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  int $business_case Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  string $issue_date Filtrování faktur podle data vystavení. (optional)
     * @param  string $invoice_type Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  string $taxable_supply_date Filtrování faktur podle data zdanitelného plnění. (optional)
     * @param  string $due_date Filtrování faktur podle data splatnosti. (optional)
     * @param  string $payment_date Filtrování faktur podle data uhrazení. (optional)
     * @param  string $variable_symbol Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $specific_symbol Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $constant_symbol Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceGet($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $code = null, $company = null, $owner = null, $business_case = null, $issue_date = null, $invoice_type = null, $taxable_supply_date = null, $due_date = null, $payment_date = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, $tags = null, string $contentType = self::contentTypes['invoiceGet'][0])
    {
        $this->invoiceGetWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags, $contentType);
    }

    /**
     * Operation invoiceGetWithHttpInfo
     *
     * seznam faktur
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených faktur je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $code Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  int $company Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $owner Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  int $business_case Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  string $issue_date Filtrování faktur podle data vystavení. (optional)
     * @param  string $invoice_type Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  string $taxable_supply_date Filtrování faktur podle data zdanitelného plnění. (optional)
     * @param  string $due_date Filtrování faktur podle data splatnosti. (optional)
     * @param  string $payment_date Filtrování faktur podle data uhrazení. (optional)
     * @param  string $variable_symbol Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $specific_symbol Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $constant_symbol Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceGetWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $code = null, $company = null, $owner = null, $business_case = null, $issue_date = null, $invoice_type = null, $taxable_supply_date = null, $due_date = null, $payment_date = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, $tags = null, string $contentType = self::contentTypes['invoiceGet'][0])
    {
        $request = $this->invoiceGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags, $contentType);

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
     * Operation invoiceGetAsync
     *
     * seznam faktur
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených faktur je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $code Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  int $company Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $owner Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  int $business_case Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  string $issue_date Filtrování faktur podle data vystavení. (optional)
     * @param  string $invoice_type Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  string $taxable_supply_date Filtrování faktur podle data zdanitelného plnění. (optional)
     * @param  string $due_date Filtrování faktur podle data splatnosti. (optional)
     * @param  string $payment_date Filtrování faktur podle data uhrazení. (optional)
     * @param  string $variable_symbol Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $specific_symbol Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $constant_symbol Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceGetAsync($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $code = null, $company = null, $owner = null, $business_case = null, $issue_date = null, $invoice_type = null, $taxable_supply_date = null, $due_date = null, $payment_date = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, $tags = null, string $contentType = self::contentTypes['invoiceGet'][0])
    {
        return $this->invoiceGetAsyncWithHttpInfo($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceGetAsyncWithHttpInfo
     *
     * seznam faktur
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených faktur je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $code Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  int $company Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $owner Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  int $business_case Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  string $issue_date Filtrování faktur podle data vystavení. (optional)
     * @param  string $invoice_type Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  string $taxable_supply_date Filtrování faktur podle data zdanitelného plnění. (optional)
     * @param  string $due_date Filtrování faktur podle data splatnosti. (optional)
     * @param  string $payment_date Filtrování faktur podle data uhrazení. (optional)
     * @param  string $variable_symbol Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $specific_symbol Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $constant_symbol Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceGetAsyncWithHttpInfo($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $code = null, $company = null, $owner = null, $business_case = null, $issue_date = null, $invoice_type = null, $taxable_supply_date = null, $due_date = null, $payment_date = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, $tags = null, string $contentType = self::contentTypes['invoiceGet'][0])
    {
        $returnType = '';
        $request = $this->invoiceGetRequest($offset, $limit, $sort_column, $sort_direction, $fulltext, $title, $code, $company, $owner, $business_case, $issue_date, $invoice_type, $taxable_supply_date, $due_date, $payment_date, $variable_symbol, $specific_symbol, $constant_symbol, $row_info_created_at, $row_info_updated_at, $row_info_last_modified_at, $view, $tags, $contentType);

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
     * Create request for operation 'invoiceGet'
     *
     * @param  int $offset Zobrazeni zaznamu od zacatku (optional)
     * @param  int $limit Maximální počet vrácených faktur je &#x60;1000&#x60; (optional)
     * @param  string $sort_column  (optional)
     * @param  string $sort_direction  (optional)
     * @param  string $fulltext Fulltextové vyhledání v seznamu. Operátor se v tomto případě nepoužívá. (optional)
     * @param  string $title Filtrování faktur podle jména. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;, &#x60;LIKE_NOCASE&#x60; (optional)
     * @param  string $code Filtrování faktur podle kódu faktury. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  int $company Filtrování faktur podle klienta. Filtruje se podle jednoznačného identifikátoru klienta (id) (optional)
     * @param  int $owner Filtrování faktur podle vlastníka. Filtruje se podle jednoznačného identifikátoru vlastníka (id) (optional)
     * @param  int $business_case Filtrování faktur podle obchodního případu. Filtruje se podle jednoznačného identifikátoru OP (id) (optional)
     * @param  string $issue_date Filtrování faktur podle data vystavení. (optional)
     * @param  string $invoice_type Filtrování faktur podle typu. Hodnoty jsou: &#x60;NORMAL&#x60;, &#x60;PROFORMA&#x60;, &#x60;CREDIT_NOTE&#x60;. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;IN&#x60;. Výchozím operátorem je &#x60;EQ&#x60;. (optional)
     * @param  string $taxable_supply_date Filtrování faktur podle data zdanitelného plnění. (optional)
     * @param  string $due_date Filtrování faktur podle data splatnosti. (optional)
     * @param  string $payment_date Filtrování faktur podle data uhrazení. (optional)
     * @param  string $variable_symbol Filtrování faktur podle variabilního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $specific_symbol Filtrování faktur podle specifického symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $constant_symbol Filtrování faktur podle konstantního symbolu. Lze využít operátoru &#x60;EQ&#x60;, &#x60;NE&#x60;, &#x60;LIKE&#x60; (optional)
     * @param  string $row_info_created_at Filtrování faktur podle data vytvoření. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_updated_at Filtrování faktur podle posledního data upravení. Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60; (optional)
     * @param  string $row_info_last_modified_at Filtrování faktur podle posledního data modifikace (vytvoření nebo upravení). Lze využít operátoru &#x60;GT&#x60;, &#x60;GE&#x60;, &#x60;LT&#x60;, &#x60;LE&#x60;. Vhodné pro periodickou detekci změn. (optional)
     * @param  string $view Pokud je hodnota rovna &#x60;rowInfo&#x60;, jsou vráceny pouze stavové informace o záznamu (data vytvoření, upravení, verze, ...). Vhodné pro periodickou detekci změn. (optional)
     * @param  string $tags Filtrování podle štítku. Je možné hledat podle více štítků oddělených čárkou. Záznam potom musí alespoň jeden obsahovat (&#x60;tag1,tag2&#x60;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceGetRequest($offset = null, $limit = null, $sort_column = null, $sort_direction = null, $fulltext = null, $title = null, $code = null, $company = null, $owner = null, $business_case = null, $issue_date = null, $invoice_type = null, $taxable_supply_date = null, $due_date = null, $payment_date = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $row_info_created_at = null, $row_info_updated_at = null, $row_info_last_modified_at = null, $view = null, $tags = null, string $contentType = self::contentTypes['invoiceGet'][0])
    {

























        $resourcePath = '/invoice/';
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
            $code,
            'code', // param base name
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
            $owner,
            'owner', // param base name
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
            $issue_date,
            'issueDate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $invoice_type,
            'invoiceType', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $taxable_supply_date,
            'taxableSupplyDate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $due_date,
            'dueDate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $payment_date,
            'paymentDate', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $variable_symbol,
            'variableSymbol', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $specific_symbol,
            'specificSymbol', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $constant_symbol,
            'constantSymbol', // param base name
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
     * Operation invoiceInsert
     *
     * nová faktura
     *
     * @param  \RaynetApiClient\Model\InvoiceInsertDto $invoice_insert_dto invoice_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RaynetApiClient\Model\Insert201Response
     */
    public function invoiceInsert($invoice_insert_dto = null, string $contentType = self::contentTypes['invoiceInsert'][0])
    {
        list($response) = $this->invoiceInsertWithHttpInfo($invoice_insert_dto, $contentType);
        return $response;
    }

    /**
     * Operation invoiceInsertWithHttpInfo
     *
     * nová faktura
     *
     * @param  \RaynetApiClient\Model\InvoiceInsertDto $invoice_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RaynetApiClient\Model\Insert201Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceInsertWithHttpInfo($invoice_insert_dto = null, string $contentType = self::contentTypes['invoiceInsert'][0])
    {
        $request = $this->invoiceInsertRequest($invoice_insert_dto, $contentType);

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
     * Operation invoiceInsertAsync
     *
     * nová faktura
     *
     * @param  \RaynetApiClient\Model\InvoiceInsertDto $invoice_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceInsertAsync($invoice_insert_dto = null, string $contentType = self::contentTypes['invoiceInsert'][0])
    {
        return $this->invoiceInsertAsyncWithHttpInfo($invoice_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceInsertAsyncWithHttpInfo
     *
     * nová faktura
     *
     * @param  \RaynetApiClient\Model\InvoiceInsertDto $invoice_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceInsertAsyncWithHttpInfo($invoice_insert_dto = null, string $contentType = self::contentTypes['invoiceInsert'][0])
    {
        $returnType = '\RaynetApiClient\Model\Insert201Response';
        $request = $this->invoiceInsertRequest($invoice_insert_dto, $contentType);

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
     * Create request for operation 'invoiceInsert'
     *
     * @param  \RaynetApiClient\Model\InvoiceInsertDto $invoice_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceInsertRequest($invoice_insert_dto = null, string $contentType = self::contentTypes['invoiceInsert'][0])
    {



        $resourcePath = '/invoice/';
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
        if (isset($invoice_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_insert_dto));
            } else {
                $httpBody = $invoice_insert_dto;
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
     * Operation invoiceLockEdit
     *
     * uzamčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceLockEdit($invoice_id, string $contentType = self::contentTypes['invoiceLockEdit'][0])
    {
        $this->invoiceLockEditWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceLockEditWithHttpInfo
     *
     * uzamčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceLockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceLockEditWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceLockEdit'][0])
    {
        $request = $this->invoiceLockEditRequest($invoice_id, $contentType);

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
     * Operation invoiceLockEditAsync
     *
     * uzamčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceLockEditAsync($invoice_id, string $contentType = self::contentTypes['invoiceLockEdit'][0])
    {
        return $this->invoiceLockEditAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceLockEditAsyncWithHttpInfo
     *
     * uzamčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceLockEditAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceLockEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceLockEditRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceLockEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceLockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceLockEditRequest($invoice_id, string $contentType = self::contentTypes['invoiceLockEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceLockEdit'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/lock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoicePaymentDelete
     *
     * smazání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  int $payment_id ID platby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoicePaymentDelete($invoice_id, $payment_id, string $contentType = self::contentTypes['invoicePaymentDelete'][0])
    {
        $this->invoicePaymentDeleteWithHttpInfo($invoice_id, $payment_id, $contentType);
    }

    /**
     * Operation invoicePaymentDeleteWithHttpInfo
     *
     * smazání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  int $payment_id ID platby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentDelete'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoicePaymentDeleteWithHttpInfo($invoice_id, $payment_id, string $contentType = self::contentTypes['invoicePaymentDelete'][0])
    {
        $request = $this->invoicePaymentDeleteRequest($invoice_id, $payment_id, $contentType);

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
     * Operation invoicePaymentDeleteAsync
     *
     * smazání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  int $payment_id ID platby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePaymentDeleteAsync($invoice_id, $payment_id, string $contentType = self::contentTypes['invoicePaymentDelete'][0])
    {
        return $this->invoicePaymentDeleteAsyncWithHttpInfo($invoice_id, $payment_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoicePaymentDeleteAsyncWithHttpInfo
     *
     * smazání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  int $payment_id ID platby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePaymentDeleteAsyncWithHttpInfo($invoice_id, $payment_id, string $contentType = self::contentTypes['invoicePaymentDelete'][0])
    {
        $returnType = '';
        $request = $this->invoicePaymentDeleteRequest($invoice_id, $payment_id, $contentType);

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
     * Create request for operation 'invoicePaymentDelete'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  int $payment_id ID platby (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoicePaymentDeleteRequest($invoice_id, $payment_id, string $contentType = self::contentTypes['invoicePaymentDelete'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoicePaymentDelete'
            );
        }

        // verify the required parameter 'payment_id' is set
        if ($payment_id === null || (is_array($payment_id) && count($payment_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $payment_id when calling invoicePaymentDelete'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/payment/{paymentId}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
                $resourcePath
            );
        }
        // path params
        if ($payment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'paymentId' . '}',
                ObjectSerializer::toPathValue($payment_id),
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
     * Operation invoicePaymentInsert
     *
     * přidání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoicePaymentInsertDto $invoice_payment_insert_dto invoice_payment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoicePaymentInsert($invoice_id, $invoice_payment_insert_dto = null, string $contentType = self::contentTypes['invoicePaymentInsert'][0])
    {
        $this->invoicePaymentInsertWithHttpInfo($invoice_id, $invoice_payment_insert_dto, $contentType);
    }

    /**
     * Operation invoicePaymentInsertWithHttpInfo
     *
     * přidání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoicePaymentInsertDto $invoice_payment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentInsert'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoicePaymentInsertWithHttpInfo($invoice_id, $invoice_payment_insert_dto = null, string $contentType = self::contentTypes['invoicePaymentInsert'][0])
    {
        $request = $this->invoicePaymentInsertRequest($invoice_id, $invoice_payment_insert_dto, $contentType);

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
     * Operation invoicePaymentInsertAsync
     *
     * přidání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoicePaymentInsertDto $invoice_payment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePaymentInsertAsync($invoice_id, $invoice_payment_insert_dto = null, string $contentType = self::contentTypes['invoicePaymentInsert'][0])
    {
        return $this->invoicePaymentInsertAsyncWithHttpInfo($invoice_id, $invoice_payment_insert_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoicePaymentInsertAsyncWithHttpInfo
     *
     * přidání platby
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoicePaymentInsertDto $invoice_payment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePaymentInsertAsyncWithHttpInfo($invoice_id, $invoice_payment_insert_dto = null, string $contentType = self::contentTypes['invoicePaymentInsert'][0])
    {
        $returnType = '';
        $request = $this->invoicePaymentInsertRequest($invoice_id, $invoice_payment_insert_dto, $contentType);

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
     * Create request for operation 'invoicePaymentInsert'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  \RaynetApiClient\Model\InvoicePaymentInsertDto $invoice_payment_insert_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePaymentInsert'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoicePaymentInsertRequest($invoice_id, $invoice_payment_insert_dto = null, string $contentType = self::contentTypes['invoicePaymentInsert'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoicePaymentInsert'
            );
        }



        $resourcePath = '/invoice/{invoiceId}/payment/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($invoice_payment_insert_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($invoice_payment_insert_dto));
            } else {
                $httpBody = $invoice_payment_insert_dto;
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
     * Operation invoicePdfExportDetailGet
     *
     * export faktury do PDF
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $locale Jazyk exportované faktury (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoicePdfExportDetailGet($invoice_id, $locale = null, string $contentType = self::contentTypes['invoicePdfExportDetailGet'][0])
    {
        $this->invoicePdfExportDetailGetWithHttpInfo($invoice_id, $locale, $contentType);
    }

    /**
     * Operation invoicePdfExportDetailGetWithHttpInfo
     *
     * export faktury do PDF
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $locale Jazyk exportované faktury (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoicePdfExportDetailGetWithHttpInfo($invoice_id, $locale = null, string $contentType = self::contentTypes['invoicePdfExportDetailGet'][0])
    {
        $request = $this->invoicePdfExportDetailGetRequest($invoice_id, $locale, $contentType);

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
     * Operation invoicePdfExportDetailGetAsync
     *
     * export faktury do PDF
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $locale Jazyk exportované faktury (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePdfExportDetailGetAsync($invoice_id, $locale = null, string $contentType = self::contentTypes['invoicePdfExportDetailGet'][0])
    {
        return $this->invoicePdfExportDetailGetAsyncWithHttpInfo($invoice_id, $locale, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoicePdfExportDetailGetAsyncWithHttpInfo
     *
     * export faktury do PDF
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $locale Jazyk exportované faktury (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoicePdfExportDetailGetAsyncWithHttpInfo($invoice_id, $locale = null, string $contentType = self::contentTypes['invoicePdfExportDetailGet'][0])
    {
        $returnType = '';
        $request = $this->invoicePdfExportDetailGetRequest($invoice_id, $locale, $contentType);

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
     * Create request for operation 'invoicePdfExportDetailGet'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $locale Jazyk exportované faktury (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoicePdfExportDetailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoicePdfExportDetailGetRequest($invoice_id, $locale = null, string $contentType = self::contentTypes['invoicePdfExportDetailGet'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoicePdfExportDetailGet'
            );
        }



        $resourcePath = '/invoice/{invoiceId}/pdfExport';
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
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoiceRenewEdit
     *
     * obnovení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceRenewEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceRenewEdit($invoice_id, string $contentType = self::contentTypes['invoiceRenewEdit'][0])
    {
        $this->invoiceRenewEditWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceRenewEditWithHttpInfo
     *
     * obnovení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceRenewEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceRenewEditWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceRenewEdit'][0])
    {
        $request = $this->invoiceRenewEditRequest($invoice_id, $contentType);

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
     * Operation invoiceRenewEditAsync
     *
     * obnovení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceRenewEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceRenewEditAsync($invoice_id, string $contentType = self::contentTypes['invoiceRenewEdit'][0])
    {
        return $this->invoiceRenewEditAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceRenewEditAsyncWithHttpInfo
     *
     * obnovení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceRenewEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceRenewEditAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceRenewEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceRenewEditRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceRenewEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceRenewEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceRenewEditRequest($invoice_id, string $contentType = self::contentTypes['invoiceRenewEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceRenewEdit'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/renew';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
     * Operation invoiceUnlockEdit
     *
     * odemčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function invoiceUnlockEdit($invoice_id, string $contentType = self::contentTypes['invoiceUnlockEdit'][0])
    {
        $this->invoiceUnlockEditWithHttpInfo($invoice_id, $contentType);
    }

    /**
     * Operation invoiceUnlockEditWithHttpInfo
     *
     * odemčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceUnlockEdit'] to see the possible values for this operation
     *
     * @throws \RaynetApiClient\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function invoiceUnlockEditWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceUnlockEdit'][0])
    {
        $request = $this->invoiceUnlockEditRequest($invoice_id, $contentType);

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
     * Operation invoiceUnlockEditAsync
     *
     * odemčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceUnlockEditAsync($invoice_id, string $contentType = self::contentTypes['invoiceUnlockEdit'][0])
    {
        return $this->invoiceUnlockEditAsyncWithHttpInfo($invoice_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation invoiceUnlockEditAsyncWithHttpInfo
     *
     * odemčení faktury
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function invoiceUnlockEditAsyncWithHttpInfo($invoice_id, string $contentType = self::contentTypes['invoiceUnlockEdit'][0])
    {
        $returnType = '';
        $request = $this->invoiceUnlockEditRequest($invoice_id, $contentType);

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
     * Create request for operation 'invoiceUnlockEdit'
     *
     * @param  int $invoice_id ID faktury (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['invoiceUnlockEdit'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function invoiceUnlockEditRequest($invoice_id, string $contentType = self::contentTypes['invoiceUnlockEdit'][0])
    {

        // verify the required parameter 'invoice_id' is set
        if ($invoice_id === null || (is_array($invoice_id) && count($invoice_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $invoice_id when calling invoiceUnlockEdit'
            );
        }


        $resourcePath = '/invoice/{invoiceId}/unlock';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($invoice_id !== null) {
            $resourcePath = str_replace(
                '{' . 'invoiceId' . '}',
                ObjectSerializer::toPathValue($invoice_id),
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
