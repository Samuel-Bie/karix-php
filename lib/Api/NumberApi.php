<?php
/**
 * NumberApi
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
 * NumberApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class NumberApi
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
     * Operation getNumber
     *
     * Get details of all phone numbers linked to your account.
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $country Filter by country ISO (optional)
     * @param  string $contains Filter by numbers which contain this value (optional)
     * @param  string[] $number_type Filter by number type: fixed, mobile, tollfree (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getNumber($api_version = '2.0', $offset = '0', $limit = '10', $country = null, $contains = null, $number_type = null)
    {
        list($response) = $this->getNumberWithHttpInfo($api_version, $offset, $limit, $country, $contains, $number_type);
        return $response;
    }

    /**
     * Operation getNumberWithHttpInfo
     *
     * Get details of all phone numbers linked to your account.
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $country Filter by country ISO (optional)
     * @param  string $contains Filter by numbers which contain this value (optional)
     * @param  string[] $number_type Filter by number type: fixed, mobile, tollfree (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNumberWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $country = null, $contains = null, $number_type = null)
    {
        $returnType = 'object';
        $request = $this->getNumberRequest($api_version, $offset, $limit, $country, $contains, $number_type);

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
     * Operation getNumberAsync
     *
     * Get details of all phone numbers linked to your account.
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $country Filter by country ISO (optional)
     * @param  string $contains Filter by numbers which contain this value (optional)
     * @param  string[] $number_type Filter by number type: fixed, mobile, tollfree (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNumberAsync($api_version = '2.0', $offset = '0', $limit = '10', $country = null, $contains = null, $number_type = null)
    {
        return $this->getNumberAsyncWithHttpInfo($api_version, $offset, $limit, $country, $contains, $number_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNumberAsyncWithHttpInfo
     *
     * Get details of all phone numbers linked to your account.
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $country Filter by country ISO (optional)
     * @param  string $contains Filter by numbers which contain this value (optional)
     * @param  string[] $number_type Filter by number type: fixed, mobile, tollfree (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNumberAsyncWithHttpInfo($api_version = '2.0', $offset = '0', $limit = '10', $country = null, $contains = null, $number_type = null)
    {
        $returnType = 'object';
        $request = $this->getNumberRequest($api_version, $offset, $limit, $country, $contains, $number_type);

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
     * Create request for operation 'getNumber'
     *
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  int $offset The number of items to skip before starting to collect the result set. (optional, default to 0)
     * @param  int $limit The numbers of items to return. (optional, default to 10)
     * @param  string $country Filter by country ISO (optional)
     * @param  string $contains Filter by numbers which contain this value (optional)
     * @param  string[] $number_type Filter by number type: fixed, mobile, tollfree (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getNumberRequest($api_version = '2.0', $offset = '0', $limit = '10', $country = null, $contains = null, $number_type = null)
    {

        $resourcePath = '/number/';
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
        if ($country !== null) {
            $queryParams['country'] = ObjectSerializer::toQueryValue($country);
        }
        // query params
        if ($contains !== null) {
            $queryParams['contains'] = ObjectSerializer::toQueryValue($contains);
        }
        // query params
        if (is_array($number_type)) {
            $queryParams['number_type'] = $number_type;
        } else
        if ($number_type !== null) {
            $queryParams['number_type'] = ObjectSerializer::toQueryValue($number_type);
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
     * Operation numberNumDelete
     *
     * Unrent number from your account
     *
     * @param  int $num Number which needs to be unrented (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function numberNumDelete($num, $api_version = '2.0')
    {
        $this->numberNumDeleteWithHttpInfo($num, $api_version);
    }

    /**
     * Operation numberNumDeleteWithHttpInfo
     *
     * Unrent number from your account
     *
     * @param  int $num Number which needs to be unrented (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function numberNumDeleteWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = '';
        $request = $this->numberNumDeleteRequest($num, $api_version);

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

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
     * Operation numberNumDeleteAsync
     *
     * Unrent number from your account
     *
     * @param  int $num Number which needs to be unrented (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumDeleteAsync($num, $api_version = '2.0')
    {
        return $this->numberNumDeleteAsyncWithHttpInfo($num, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation numberNumDeleteAsyncWithHttpInfo
     *
     * Unrent number from your account
     *
     * @param  int $num Number which needs to be unrented (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumDeleteAsyncWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = '';
        $request = $this->numberNumDeleteRequest($num, $api_version);

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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'numberNumDelete'
     *
     * @param  int $num Number which needs to be unrented (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function numberNumDeleteRequest($num, $api_version = '2.0')
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling numberNumDelete'
            );
        }

        $resourcePath = '/number/{num}/';
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation numberNumGet
     *
     * Get details of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function numberNumGet($num, $api_version = '2.0')
    {
        list($response) = $this->numberNumGetWithHttpInfo($num, $api_version);
        return $response;
    }

    /**
     * Operation numberNumGetWithHttpInfo
     *
     * Get details of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function numberNumGetWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->numberNumGetRequest($num, $api_version);

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
     * Operation numberNumGetAsync
     *
     * Get details of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumGetAsync($num, $api_version = '2.0')
    {
        return $this->numberNumGetAsyncWithHttpInfo($num, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation numberNumGetAsyncWithHttpInfo
     *
     * Get details of a number
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumGetAsyncWithHttpInfo($num, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->numberNumGetRequest($num, $api_version);

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
     * Create request for operation 'numberNumGet'
     *
     * @param  int $num Number for which details need to be fetched (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function numberNumGetRequest($num, $api_version = '2.0')
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling numberNumGet'
            );
        }

        $resourcePath = '/number/{num}/';
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
     * Operation numberNumPatch
     *
     * Edit phone number belonging to your account
     *
     * @param  int $num Number which needs to be edited (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditAccountNumber $number Account Number object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function numberNumPatch($num, $api_version = '2.0', $number = null)
    {
        list($response) = $this->numberNumPatchWithHttpInfo($num, $api_version, $number);
        return $response;
    }

    /**
     * Operation numberNumPatchWithHttpInfo
     *
     * Edit phone number belonging to your account
     *
     * @param  int $num Number which needs to be edited (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditAccountNumber $number Account Number object (optional)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function numberNumPatchWithHttpInfo($num, $api_version = '2.0', $number = null)
    {
        $returnType = 'object';
        $request = $this->numberNumPatchRequest($num, $api_version, $number);

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
     * Operation numberNumPatchAsync
     *
     * Edit phone number belonging to your account
     *
     * @param  int $num Number which needs to be edited (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditAccountNumber $number Account Number object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumPatchAsync($num, $api_version = '2.0', $number = null)
    {
        return $this->numberNumPatchAsyncWithHttpInfo($num, $api_version, $number)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation numberNumPatchAsyncWithHttpInfo
     *
     * Edit phone number belonging to your account
     *
     * @param  int $num Number which needs to be edited (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditAccountNumber $number Account Number object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function numberNumPatchAsyncWithHttpInfo($num, $api_version = '2.0', $number = null)
    {
        $returnType = 'object';
        $request = $this->numberNumPatchRequest($num, $api_version, $number);

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
     * Create request for operation 'numberNumPatch'
     *
     * @param  int $num Number which needs to be edited (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     * @param  \Swagger\Client\Model\EditAccountNumber $number Account Number object (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function numberNumPatchRequest($num, $api_version = '2.0', $number = null)
    {
        // verify the required parameter 'num' is set
        if ($num === null || (is_array($num) && count($num) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $num when calling numberNumPatch'
            );
        }

        $resourcePath = '/number/{num}/';
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
        if (isset($number)) {
            $_tempBody = $number;
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
     * Operation rentNumber
     *
     * Rent a phone number
     *
     * @param  \Swagger\Client\Model\RentNumber $number Rent Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function rentNumber($number, $api_version = '2.0')
    {
        list($response) = $this->rentNumberWithHttpInfo($number, $api_version);
        return $response;
    }

    /**
     * Operation rentNumberWithHttpInfo
     *
     * Rent a phone number
     *
     * @param  \Swagger\Client\Model\RentNumber $number Rent Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function rentNumberWithHttpInfo($number, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->rentNumberRequest($number, $api_version);

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
                case 402:
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
     * Operation rentNumberAsync
     *
     * Rent a phone number
     *
     * @param  \Swagger\Client\Model\RentNumber $number Rent Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rentNumberAsync($number, $api_version = '2.0')
    {
        return $this->rentNumberAsyncWithHttpInfo($number, $api_version)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rentNumberAsyncWithHttpInfo
     *
     * Rent a phone number
     *
     * @param  \Swagger\Client\Model\RentNumber $number Rent Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rentNumberAsyncWithHttpInfo($number, $api_version = '2.0')
    {
        $returnType = 'object';
        $request = $this->rentNumberRequest($number, $api_version);

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
     * Create request for operation 'rentNumber'
     *
     * @param  \Swagger\Client\Model\RentNumber $number Rent Details object (required)
     * @param  string $api_version API Version. If not specified your pinned verison is used. (optional, default to 2.0)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function rentNumberRequest($number, $api_version = '2.0')
    {
        // verify the required parameter 'number' is set
        if ($number === null || (is_array($number) && count($number) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $number when calling rentNumber'
            );
        }

        $resourcePath = '/number/';
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
        if (isset($number)) {
            $_tempBody = $number;
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
