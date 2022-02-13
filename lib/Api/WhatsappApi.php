<?php
/**
 * WhatsappApi
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * karix api
 *
 * # Overview  Karix API lets you interact with the Karix platform using an omnichannel messaging API. It also allows you to query your account, set up webhooks and buy phone numbers.  # API Endpoint https://api.karix.io/  # API and Clients Versioning  Karix APIs are versioned using the format vX.Y where X is the major version number and Y is minor. All minor version releases are backwards compatible but major releases are not, please be careful when upgrading.  Version header `api-version` is used by Karix platform to determine the version of the API request. To use Karix API v2 you can send `api-version` as `\"2.0\"`.  If an API request does not contain `api-version` header then Karix platform uses the pinned API version of the account as the default verison. Your account defaults to the latest API version release at the time of signup. You can check the pinned API version form the [dashboard](https://cloud.karix.io/dashboard).  Karix also provides Helper Libraries for all major languages. Release versions of these libraries correspond to their API Version supported. Client version vX.Y.Z supports API version vX.Y. Helper libraries are configured to send `api-version` header based on the library version. When using official Karix helper libraries, you dont need to concern yourself with pinned version. Using helper library of latest version will give you access to latest features.  # Supported Channels  Karix omnichannel messaging API supports the following channels:   - sms   - whatsapp  ## SMS Channel To send a message to one or more destinations over SMS channel set `channel` to `sms` in the [Messaging API](#operation/sendMessage).  In trial mode, your account can only send messages to numbers within the sandbox.  ## Whatsapp Channel To send a message to a destination over WhatsApp channel set `channel` to `whatsapp` in the [Messaging API](#operation/sendMessage).  By default WhatsApp channel can only be used from within the sandbox. Contact [support](mailto:support@karix.io) for sending message outside the sandbox and getting your own Whatsapp Business Account.  ### Message Types Any messages you initiate over WhatsApp to end users must conform to a template configured in WhatsApp. These messages are called \"Notification Messages\". Both text and media content can be sent as a notification message. Please contact your sales representative to get templates approved (or mail [sales](mailto:support@karix.io))  Any responses you receive from end users and all replies you send within 24 hours of the last received response are called \"Conversation Messages\".  Both Notification and Conversation messages are priced differently, please refer to the [pricing page](http://karix.io/messaging/pricing/) for more details.  #### Text Notification To send a notification message with text content the `content.text` parameter in [Send Message API](#operation/sendMessage) request needs to match an approved template pattern.  When using the sandbox for testing and development purposes, we have provided for the following pre-approved templates for \"Notification Messages\":    - Your order * has been dispatched. Please expect delivery by *   - OTP requested by you on * is *   - Thank you for your payment of * * on *. Your transaction ID is *  You can replace `*` with any text of your choice.  #### Media Notification To send a notification message with media content the `content.media.caption` parameter in [Send Message API](#operation/sendMessage) request needs to match an approved template pattern. Additionally, the `content.media.url` parameter should link to a media type which is approved for that pattern. The following media types can be supported: image, video (only MP4), and document (only PDF).  When using the sandbox for testing and development purposes, we have provided for the following pre-approved templates for \"Notification Messages\":    - Caption: Your Ticket for movie * On * Time * Seat no : *     Media Type: image   - Caption: Hey here is the demo on steps to install *     Media Type: video   - Caption: Flight Confirmation for * on *     Media Type: document  You can replace `*` with any text of your choice.  ### Content Types WhatsApp supports the following content types for outbound media messages: | Content Type | File Format                          | |:------------ |:------------------------------------ | | audio        | AAC, M4A, AMR, MP3, OGG OPUS         | | image        | JPG/JPEG, PNG                        | | documents    | PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX | | video        | MP4, 3GPP                            |  Besides video content, it is also possible to send links to sites which support preview (like YouTube) as a conversation text message. WhatsApp will render video preview depending on the user's device.  For inbound media, Karix supports all file formats which can be sent using WhatsApp. An incoming media message event will be reported to the Webhook attached to the Number resource. You can read more about Karix event structure [here](#section/Events-and-Webhooks).  # Common Request Structures  All Karix APIs follow a common REST format with the following resources:   - account   - message   - webhook   - number  ## Creating a resource To create a resource send a `POST` request with the desired parameters in a JSON object to `/<resource>/` url. A successful response will contain the details of the single resource created with HTTP status code `201 Created`. Note: An exception to this is the `Create Message` API which is a bulk API and returns       a list of message records.  ## Fetching a resource To fetch a resource by its Unique ID send a `GET` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource. A successful response will contain the details of the single resource fetched with HTTP status code `200 OK`  ## Editing a resource To edit certain parameters of a resource send a `PATCH` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource, with a JSON object containing only the parameters which need to be updated. Edit resource APIs generally have no required parameters. A successful response will contain all the details of the single resource after editing.  ## Deleting a resource To delete a resource send a `DELETE` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource. A successful response will return HTTP status code `204 No Content` with no body.  ## Fetching a list of resources To fetch a list of resources send a `GET` request to `/<resource>/` with filters as GET parameters. A successful response will contain a list of filtered paginated objects with HTTP status code `200 OK`.  ### Pagination Pagination for list APIs are controlled using GET parameters:   - `limit`: Number of objects to be returned   - `offset`: Number of objects to skip before collecting the output list.  # Common Response Structures  All Karix APIs follow a common respose structure.  ## Success Responses  ### Single Resource Response  Responses returning a single object will have the following keys | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | | data          |               | Details of the object                     |  ### List Resource Response  Responses returning a list of objects will have the following keys | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | |               | previous      | Link to the previous page of the list     | |               | next          | Link to the next page of the list         | |               | total         | Total number of objects over all pages    | | objects       |               | List of objects with details              |  ## Error Responses  ### Validation Error Response  Responses for requests which failed due to validation errors will have the follwing keys: | Key           | Child Key     | Description                                | |:------------- |:------------- |:------------------------------------------ | | meta          |               | Meta Details about request and response    | |               | request_uuid  | Unique request identifier                  | | error         |               | Details for the error                      | |               | message       | Error message                              | |               | param         | (Optional) parameter this error relates to |  Validation error responses will return HTTP Status Code `400 Bad Request`  ### Insufficient Balance Response  Some requests will require to consume account credits. In case of insufficient balance the following keys will be returned: | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | | error         |               | Details for the error                     | |               | message       | `Insufficient Balance`                    |  Insufficient balance response will return HTTP Status Code `402 Payment Required`  # Events and Webhooks  All asynchronous events generated by Karix platform follow a common structure:  | Key           | Child Key     | Description                                 | |:------------- |:------------- |:------------------------------------------- | | uid           |               | Alphanumeric unique ID of the event         | | api_version   |               | 2.0                                         | | type          |               | Type of the event.                          | | data          |               | Details of the object attached to the event |  On an asynchronous event, an HTTP POST request is sent with the above JSON playload.  - For outbound messages, a message event is sent to events_url specified in   [Send Message API](#operation/sendMessage). - For inbound messages, a message event is either sent to the `events_url`   of the Webhook attached to the [Number](#tag/Number) or the Sandbox URL   configured in the [Dashboard](https://cloud.karix.io/dashboard/#whatsapp-demo).  ## Events List  ### Outbound Message Status Update `message` events are generated when a message status is changed to `sent`, `delivered`, `undelivered` or `failed`. These events are sent to `events_url` parameter of [Send Message](#operation/sendMessage) API  ### Inbound Message Received `message` events are generated when a message is received on a [Number](#tag/Number) with capability to receive messages on a channel. These events are sent to the webhook attached to the phone number resource using [Edit Number](#tag/Number) API  For inbound messages to WhatsApp Sandbox, `message` events are sent to Webhook URL set on the [Dashboard](https://cloud.karix.io/dashboard/#whatsapp-demo).  ### Inbound Media Message Received `message` events are generated when a message containing media content is received on a [Number](#tag/Number) with capability to receive messages through a media capable channel. An inbound message to WhatsApp Sandbox may also contain media.  The parameter `data.content.media.url` will link to the [Media URL](#operation/getMedia) hosted with Karix from where you can download the media.
 *
 * OpenAPI spec version: 2.0
 * Contact: support@karix.io
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.25
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Swagger\Client\ApiException;
use Swagger\Client\Configuration;
use Swagger\Client\HeaderSelector;
use Swagger\Client\ObjectSerializer;

/**
 * WhatsappApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class WhatsappApi
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
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation createWhatsappTemplate
     *
     * Create whatsapp templates
     *
     * @param  \Swagger\Client\Model\CreateWhatsappTemplate $template Whatsapp Template Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function createWhatsappTemplate($template, $api_version = '2.0')
    {
        list($response) = $this->createWhatsappTemplateWithHttpInfo($template, $api_version);
        return $response;
    }

    /**
     * Operation createWhatsappTemplateWithHttpInfo
     *
     * Create whatsapp templates
     *
     * @param  \Swagger\Client\Model\CreateWhatsappTemplate $template Whatsapp Template Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function createWhatsappTemplateWithHttpInfo($template, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->createWhatsappTemplateRequest($template, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createWhatsappTemplateAsync
     *
     * Create whatsapp templates
     *
     * @param  \Swagger\Client\Model\CreateWhatsappTemplate $template Whatsapp Template Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createWhatsappTemplateAsync($template, $api_version = '2.0')
    {
        return $this->createWhatsappTemplateAsyncWithHttpInfo($template, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createWhatsappTemplateAsyncWithHttpInfo
     *
     * Create whatsapp templates
     *
     * @param  \Swagger\Client\Model\CreateWhatsappTemplate $template Whatsapp Template Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createWhatsappTemplateAsyncWithHttpInfo($template, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->createWhatsappTemplateRequest($template, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createWhatsappTemplate'
     *
     * @param  \Swagger\Client\Model\CreateWhatsappTemplate $template Whatsapp Template Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function createWhatsappTemplateRequest($template, $api_version = '2.0')
    {
        // verify the required parameter 'template' is set
        if ($template === null || (is_array($template) && count($template) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $template when calling createWhatsappTemplate'
            );
        }

        $resourcePath = '/whatsapp/template/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;
        if (isset($template)) {
            $_tempBody = $template;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappAccount
     *
     * Get a list of your whatsapp accounts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $name Filter by whatsapp account name (optional)
     * @param  string $karix_account_uid Filter by karix account uid (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappAccount($api_version = '2.0', $offset = '0', $limit = '10', $name = null, $karix_account_uid = null)
    {
        list($response) = $this->getWhatsappAccountWithHttpInfo($api_version, $offset, $limit, $name, $karix_account_uid);
        return $response;
    }

    /**
     * Operation getWhatsappAccountWithHttpInfo
     *
     * Get a list of your whatsapp accounts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $name Filter by whatsapp account name (optional)
     * @param  string $karix_account_uid Filter by karix account uid (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappAccountWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $name = null, $karix_account_uid = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappAccountRequest($api_version, $offset, $limit, $name, $karix_account_uid);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappAccountAsync
     *
     * Get a list of your whatsapp accounts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $name Filter by whatsapp account name (optional)
     * @param  string $karix_account_uid Filter by karix account uid (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappAccountAsync($api_version = '2.0', $offset = '0', $limit = '10', $name = null, $karix_account_uid = null)
    {
        return $this->getWhatsappAccountAsyncWithHttpInfo($api_version, $offset, $limit, $name, $karix_account_uid)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappAccountAsyncWithHttpInfo
     *
     * Get a list of your whatsapp accounts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $name Filter by whatsapp account name (optional)
     * @param  string $karix_account_uid Filter by karix account uid (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappAccountAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $name = null, $karix_account_uid = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappAccountRequest($api_version, $offset, $limit, $name, $karix_account_uid);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappAccount'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $name Filter by whatsapp account name (optional)
     * @param  string $karix_account_uid Filter by karix account uid (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappAccountRequest($api_version = '2.0', $offset = '0', $limit = '10', $name = null, $karix_account_uid = null)
    {

        $resourcePath = '/whatsapp/account/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit);
        }
        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name);
        }
        // query params
        if ($karix_account_uid !== null) {
            $queryParams['karix_account_uid'] = ObjectSerializer::toQueryValue($karix_account_uid);
        }
        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappAccountById
     *
     * Get a whatsapp account by Unique ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp account to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappAccountById($uid, $api_version = '2.0')
    {
        list($response) = $this->getWhatsappAccountByIdWithHttpInfo($uid, $api_version);
        return $response;
    }

    /**
     * Operation getWhatsappAccountByIdWithHttpInfo
     *
     * Get a whatsapp account by Unique ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp account to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappAccountByIdWithHttpInfo($uid, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappAccountByIdRequest($uid, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappAccountByIdAsync
     *
     * Get a whatsapp account by Unique ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp account to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappAccountByIdAsync($uid, $api_version = '2.0')
    {
        return $this->getWhatsappAccountByIdAsyncWithHttpInfo($uid, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappAccountByIdAsyncWithHttpInfo
     *
     * Get a whatsapp account by Unique ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp account to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappAccountByIdAsyncWithHttpInfo($uid, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappAccountByIdRequest($uid, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappAccountById'
     *
     * @param  string $uid Alphanumeric ID of the whatsapp account to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappAccountByIdRequest($uid, $api_version = '2.0')
    {
        // verify the required parameter 'uid' is set
        if ($uid === null || (is_array($uid) && count($uid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $uid when calling getWhatsappAccountById'
            );
        }

        $resourcePath = '/whatsapp/account/{uid}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($uid !== null) {
            $resourcePath = str_replace(
                '{' . 'uid' . '}',
                ObjectSerializer::toPathValue($uid),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfileAbout
     *
     * Get whatsapp profile about text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfileAbout($num, $api_version = '2.0')
    {
        list($response) = $this->getWhatsappProfileAboutWithHttpInfo($num, $api_version);
        return $response;
    }

    /**
     * Operation getWhatsappProfileAboutWithHttpInfo
     *
     * Get whatsapp profile about text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfileAboutWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileAboutRequest($num, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfileAboutAsync
     *
     * Get whatsapp profile about text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileAboutAsync($num, $api_version = '2.0')
    {
        return $this->getWhatsappProfileAboutAsyncWithHttpInfo($num, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfileAboutAsyncWithHttpInfo
     *
     * Get whatsapp profile about text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileAboutAsyncWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileAboutRequest($num, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfileAbout'
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfileAboutRequest($num, $api_version = '2.0')
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling getWhatsappProfileAbout'
            );
        }

        $resourcePath = '/whatsapp/profile/about/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfileAboutList
     *
     * Get a list of your whatsapp profile about texts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     * @param  string $text Search about texts (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfileAboutList($api_version = '2.0', $offset = '0', $limit = '10', $number = null, $text = null)
    {
        list($response) = $this->getWhatsappProfileAboutListWithHttpInfo($api_version, $offset, $limit, $number, $text);
        return $response;
    }

    /**
     * Operation getWhatsappProfileAboutListWithHttpInfo
     *
     * Get a list of your whatsapp profile about texts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     * @param  string $text Search about texts (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfileAboutListWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null, $text = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileAboutListRequest($api_version, $offset, $limit, $number, $text);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfileAboutListAsync
     *
     * Get a list of your whatsapp profile about texts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     * @param  string $text Search about texts (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileAboutListAsync($api_version = '2.0', $offset = '0', $limit = '10', $number = null, $text = null)
    {
        return $this->getWhatsappProfileAboutListAsyncWithHttpInfo($api_version, $offset, $limit, $number, $text)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfileAboutListAsyncWithHttpInfo
     *
     * Get a list of your whatsapp profile about texts
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     * @param  string $text Search about texts (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileAboutListAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null, $text = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileAboutListRequest($api_version, $offset, $limit, $number, $text);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfileAboutList'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     * @param  string $text Search about texts (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfileAboutListRequest($api_version = '2.0', $offset = '0', $limit = '10', $number = null, $text = null)
    {

        $resourcePath = '/whatsapp/profile/about/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit);
        }
        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number);
        }
        // query params
        if ($text !== null) {
            $queryParams['text'] = ObjectSerializer::toQueryValue($text);
        }
        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfileBusiness
     *
     * Get the business details for your Whatsapp number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfileBusiness($num, $api_version = '2.0')
    {
        list($response) = $this->getWhatsappProfileBusinessWithHttpInfo($num, $api_version);
        return $response;
    }

    /**
     * Operation getWhatsappProfileBusinessWithHttpInfo
     *
     * Get the business details for your Whatsapp number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfileBusinessWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileBusinessRequest($num, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfileBusinessAsync
     *
     * Get the business details for your Whatsapp number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileBusinessAsync($num, $api_version = '2.0')
    {
        return $this->getWhatsappProfileBusinessAsyncWithHttpInfo($num, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfileBusinessAsyncWithHttpInfo
     *
     * Get the business details for your Whatsapp number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileBusinessAsyncWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileBusinessRequest($num, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfileBusiness'
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfileBusinessRequest($num, $api_version = '2.0')
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling getWhatsappProfileBusiness'
            );
        }

        $resourcePath = '/whatsapp/profile/business/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfileBusinessList
     *
     * Get a list of business details for your Whatsapp numbers
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfileBusinessList($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        list($response) = $this->getWhatsappProfileBusinessListWithHttpInfo($api_version, $offset, $limit, $number);
        return $response;
    }

    /**
     * Operation getWhatsappProfileBusinessListWithHttpInfo
     *
     * Get a list of business details for your Whatsapp numbers
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfileBusinessListWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileBusinessListRequest($api_version, $offset, $limit, $number);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfileBusinessListAsync
     *
     * Get a list of business details for your Whatsapp numbers
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileBusinessListAsync($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        return $this->getWhatsappProfileBusinessListAsyncWithHttpInfo($api_version, $offset, $limit, $number)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfileBusinessListAsyncWithHttpInfo
     *
     * Get a list of business details for your Whatsapp numbers
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfileBusinessListAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfileBusinessListRequest($api_version, $offset, $limit, $number);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfileBusinessList'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfileBusinessListRequest($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {

        $resourcePath = '/whatsapp/profile/business/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit);
        }
        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number);
        }
        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfilePhoto
     *
     * Get whatsapp profile photo details of a number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfilePhoto($num, $api_version = '2.0')
    {
        list($response) = $this->getWhatsappProfilePhotoWithHttpInfo($num, $api_version);
        return $response;
    }

    /**
     * Operation getWhatsappProfilePhotoWithHttpInfo
     *
     * Get whatsapp profile photo details of a number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfilePhotoWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfilePhotoRequest($num, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfilePhotoAsync
     *
     * Get whatsapp profile photo details of a number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfilePhotoAsync($num, $api_version = '2.0')
    {
        return $this->getWhatsappProfilePhotoAsyncWithHttpInfo($num, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfilePhotoAsyncWithHttpInfo
     *
     * Get whatsapp profile photo details of a number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfilePhotoAsyncWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfilePhotoRequest($num, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfilePhoto'
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfilePhotoRequest($num, $api_version = '2.0')
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling getWhatsappProfilePhoto'
            );
        }

        $resourcePath = '/whatsapp/profile/photo/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappProfilePhotos
     *
     * Get a list of your whatsapp profile photos
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappProfilePhotos($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        list($response) = $this->getWhatsappProfilePhotosWithHttpInfo($api_version, $offset, $limit, $number);
        return $response;
    }

    /**
     * Operation getWhatsappProfilePhotosWithHttpInfo
     *
     * Get a list of your whatsapp profile photos
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappProfilePhotosWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfilePhotosRequest($api_version, $offset, $limit, $number);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappProfilePhotosAsync
     *
     * Get a list of your whatsapp profile photos
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfilePhotosAsync($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        return $this->getWhatsappProfilePhotosAsyncWithHttpInfo($api_version, $offset, $limit, $number)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappProfilePhotosAsyncWithHttpInfo
     *
     * Get a list of your whatsapp profile photos
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappProfilePhotosAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappProfilePhotosRequest($api_version, $offset, $limit, $number);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappProfilePhotos'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $number Filter by whatsapp number (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappProfilePhotosRequest($api_version = '2.0', $offset = '0', $limit = '10', $number = null)
    {

        $resourcePath = '/whatsapp/profile/photo/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit);
        }
        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number);
        }
        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappTemplate
     *
     * Get a list of your whatsapp templates
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $whatsapp_account_uid Filter by whatsapp account uid (optional)
     * @param  string $status Filter by approval status (optional)
     * @param  string $category Filter by template category (optional)
     * @param  string $name Filter by template name (optional)
     * @param  string $language_code Filter by language code (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappTemplate($api_version = '2.0', $offset = '0', $limit = '10', $whatsapp_account_uid = null, $status = null, $category = null, $name = null, $language_code = null)
    {
        list($response) = $this->getWhatsappTemplateWithHttpInfo($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code);
        return $response;
    }

    /**
     * Operation getWhatsappTemplateWithHttpInfo
     *
     * Get a list of your whatsapp templates
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $whatsapp_account_uid Filter by whatsapp account uid (optional)
     * @param  string $status Filter by approval status (optional)
     * @param  string $category Filter by template category (optional)
     * @param  string $name Filter by template name (optional)
     * @param  string $language_code Filter by language code (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappTemplateWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $whatsapp_account_uid = null, $status = null, $category = null, $name = null, $language_code = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappTemplateRequest($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappTemplateAsync
     *
     * Get a list of your whatsapp templates
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $whatsapp_account_uid Filter by whatsapp account uid (optional)
     * @param  string $status Filter by approval status (optional)
     * @param  string $category Filter by template category (optional)
     * @param  string $name Filter by template name (optional)
     * @param  string $language_code Filter by language code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappTemplateAsync($api_version = '2.0', $offset = '0', $limit = '10', $whatsapp_account_uid = null, $status = null, $category = null, $name = null, $language_code = null)
    {
        return $this->getWhatsappTemplateAsyncWithHttpInfo($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappTemplateAsyncWithHttpInfo
     *
     * Get a list of your whatsapp templates
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $whatsapp_account_uid Filter by whatsapp account uid (optional)
     * @param  string $status Filter by approval status (optional)
     * @param  string $category Filter by template category (optional)
     * @param  string $name Filter by template name (optional)
     * @param  string $language_code Filter by language code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappTemplateAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $whatsapp_account_uid = null, $status = null, $category = null, $name = null, $language_code = null)
    {
        $returnType = 'object';
        $request = $this->getWhatsappTemplateRequest($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappTemplate'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $whatsapp_account_uid Filter by whatsapp account uid (optional)
     * @param  string $status Filter by approval status (optional)
     * @param  string $category Filter by template category (optional)
     * @param  string $name Filter by template name (optional)
     * @param  string $language_code Filter by language code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappTemplateRequest($api_version = '2.0', $offset = '0', $limit = '10', $whatsapp_account_uid = null, $status = null, $category = null, $name = null, $language_code = null)
    {

        $resourcePath = '/whatsapp/template/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = ObjectSerializer::toQueryValue($limit);
        }
        // query params
        if ($whatsapp_account_uid !== null) {
            $queryParams['whatsapp_account_uid'] = ObjectSerializer::toQueryValue($whatsapp_account_uid);
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status);
        }
        // query params
        if ($category !== null) {
            $queryParams['category'] = ObjectSerializer::toQueryValue($category);
        }
        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name);
        }
        // query params
        if ($language_code !== null) {
            $queryParams['language_code'] = ObjectSerializer::toQueryValue($language_code);
        }
        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getWhatsappTemplateById
     *
     * Get a whatsapp template by ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp template to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getWhatsappTemplateById($uid, $api_version = '2.0')
    {
        list($response) = $this->getWhatsappTemplateByIdWithHttpInfo($uid, $api_version);
        return $response;
    }

    /**
     * Operation getWhatsappTemplateByIdWithHttpInfo
     *
     * Get a whatsapp template by ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp template to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWhatsappTemplateByIdWithHttpInfo($uid, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappTemplateByIdRequest($uid, $api_version);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getWhatsappTemplateByIdAsync
     *
     * Get a whatsapp template by ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp template to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappTemplateByIdAsync($uid, $api_version = '2.0')
    {
        return $this->getWhatsappTemplateByIdAsyncWithHttpInfo($uid, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getWhatsappTemplateByIdAsyncWithHttpInfo
     *
     * Get a whatsapp template by ID
     *
     * @param  string $uid Alphanumeric ID of the whatsapp template to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWhatsappTemplateByIdAsyncWithHttpInfo($uid, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->getWhatsappTemplateByIdRequest($uid, $api_version);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getWhatsappTemplateById'
     *
     * @param  string $uid Alphanumeric ID of the whatsapp template to get. (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getWhatsappTemplateByIdRequest($uid, $api_version = '2.0')
    {
        // verify the required parameter 'uid' is set
        if ($uid === null || (is_array($uid) && count($uid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $uid when calling getWhatsappTemplateById'
            );
        }

        $resourcePath = '/whatsapp/template/{uid}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($uid !== null) {
            $resourcePath = str_replace(
                '{' . 'uid' . '}',
                ObjectSerializer::toPathValue($uid),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation patchWhatsappProfileAbout
     *
     * Edit Whatsapp About text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileAbout $details Whatsapp About object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function patchWhatsappProfileAbout($num, $api_version = '2.0', $details = null)
    {
        list($response) = $this->patchWhatsappProfileAboutWithHttpInfo($num, $api_version, $details);
        return $response;
    }

    /**
     * Operation patchWhatsappProfileAboutWithHttpInfo
     *
     * Edit Whatsapp About text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileAbout $details Whatsapp About object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchWhatsappProfileAboutWithHttpInfo($num, $api_version = '2.0', $details = null)
    {
        $returnType = 'object';
        $request = $this->patchWhatsappProfileAboutRequest($num, $api_version, $details);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation patchWhatsappProfileAboutAsync
     *
     * Edit Whatsapp About text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileAbout $details Whatsapp About object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchWhatsappProfileAboutAsync($num, $api_version = '2.0', $details = null)
    {
        return $this->patchWhatsappProfileAboutAsyncWithHttpInfo($num, $api_version, $details)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchWhatsappProfileAboutAsyncWithHttpInfo
     *
     * Edit Whatsapp About text of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileAbout $details Whatsapp About object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchWhatsappProfileAboutAsyncWithHttpInfo($num, $api_version = '2.0', $details = null)
    {
        $returnType = 'object';
        $request = $this->patchWhatsappProfileAboutRequest($num, $api_version, $details);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'patchWhatsappProfileAbout'
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileAbout $details Whatsapp About object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function patchWhatsappProfileAboutRequest($num, $api_version = '2.0', $details = null)
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling patchWhatsappProfileAbout'
            );
        }

        $resourcePath = '/whatsapp/profile/about/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($details)) {
            $_tempBody = $details;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation patchWhatsappProfileBusiness
     *
     * Edit the business details for your Whatsapp number
     *
     * @param  int $num Number for which details need to be patched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileBusiness $details Whatsapp Business object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function patchWhatsappProfileBusiness($num, $api_version = '2.0', $details = null)
    {
        list($response) = $this->patchWhatsappProfileBusinessWithHttpInfo($num, $api_version, $details);
        return $response;
    }

    /**
     * Operation patchWhatsappProfileBusinessWithHttpInfo
     *
     * Edit the business details for your Whatsapp number
     *
     * @param  int $num Number for which details need to be patched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileBusiness $details Whatsapp Business object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchWhatsappProfileBusinessWithHttpInfo($num, $api_version = '2.0', $details = null)
    {
        $returnType = 'object';
        $request = $this->patchWhatsappProfileBusinessRequest($num, $api_version, $details);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation patchWhatsappProfileBusinessAsync
     *
     * Edit the business details for your Whatsapp number
     *
     * @param  int $num Number for which details need to be patched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileBusiness $details Whatsapp Business object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchWhatsappProfileBusinessAsync($num, $api_version = '2.0', $details = null)
    {
        return $this->patchWhatsappProfileBusinessAsyncWithHttpInfo($num, $api_version, $details)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchWhatsappProfileBusinessAsyncWithHttpInfo
     *
     * Edit the business details for your Whatsapp number
     *
     * @param  int $num Number for which details need to be patched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileBusiness $details Whatsapp Business object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchWhatsappProfileBusinessAsyncWithHttpInfo($num, $api_version = '2.0', $details = null)
    {
        $returnType = 'object';
        $request = $this->patchWhatsappProfileBusinessRequest($num, $api_version, $details);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'patchWhatsappProfileBusiness'
     *
     * @param  int $num Number for which details need to be patched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditWhatsappProfileBusiness $details Whatsapp Business object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function patchWhatsappProfileBusinessRequest($num, $api_version = '2.0', $details = null)
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling patchWhatsappProfileBusiness'
            );
        }

        $resourcePath = '/whatsapp/profile/business/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($details)) {
            $_tempBody = $details;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation putWhatsappProfilePhoto
     *
     * Upload a profile photo for a Whatsapp Number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \SplFileObject $file The profile photo file to upload. Supports JPG and PNG formats. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function putWhatsappProfilePhoto($num, $api_version = '2.0', $file = null)
    {
        list($response) = $this->putWhatsappProfilePhotoWithHttpInfo($num, $api_version, $file);
        return $response;
    }

    /**
     * Operation putWhatsappProfilePhotoWithHttpInfo
     *
     * Upload a profile photo for a Whatsapp Number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \SplFileObject $file The profile photo file to upload. Supports JPG and PNG formats. (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function putWhatsappProfilePhotoWithHttpInfo($num, $api_version = '2.0', $file = null)
    {
        $returnType = 'object';
        $request = $this->putWhatsappProfilePhotoRequest($num, $api_version, $file);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
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
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation putWhatsappProfilePhotoAsync
     *
     * Upload a profile photo for a Whatsapp Number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \SplFileObject $file The profile photo file to upload. Supports JPG and PNG formats. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putWhatsappProfilePhotoAsync($num, $api_version = '2.0', $file = null)
    {
        return $this->putWhatsappProfilePhotoAsyncWithHttpInfo($num, $api_version, $file)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putWhatsappProfilePhotoAsyncWithHttpInfo
     *
     * Upload a profile photo for a Whatsapp Number
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \SplFileObject $file The profile photo file to upload. Supports JPG and PNG formats. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putWhatsappProfilePhotoAsyncWithHttpInfo($num, $api_version = '2.0', $file = null)
    {
        $returnType = 'object';
        $request = $this->putWhatsappProfilePhotoRequest($num, $api_version, $file);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'putWhatsappProfilePhoto'
     *
     * @param  int $num Whatsapp Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \SplFileObject $file The profile photo file to upload. Supports JPG and PNG formats. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function putWhatsappProfilePhotoRequest($num, $api_version = '2.0', $file = null)
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling putWhatsappProfilePhoto'
            );
        }

        $resourcePath = '/whatsapp/profile/photo/{num}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($api_version !== null) {
            $headerParams['api-version'] = ObjectSerializer::toHeaderValue($api_version);
        }

        // path params
        if ($num !== null) {
            $resourcePath = str_replace(
                '{' . 'num' . '}',
                ObjectSerializer::toPathValue($num),
                $resourcePath
            );
        }

        // form params
        if ($file !== null) {
            $multipart = true;
            $formParams['file'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($file), 'rb');
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
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
