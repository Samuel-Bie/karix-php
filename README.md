# SwaggerClient-php
# Overview  Karix API lets you interact with the Karix platform using an omnichannel messaging API. It also allows you to query your account, set up webhooks and buy phone numbers.  # API Endpoint https://api.karix.io/  # API and Clients Versioning  Karix APIs are versioned using the format vX.Y where X is the major version number and Y is minor. All minor version releases are backwards compatible but major releases are not, please be careful when upgrading.  Version header `api-version` is used by Karix platform to determine the version of the API request. To use Karix API v2 you can send `api-version` as `\"2.0\"`.  If an API request does not contain `api-version` header then Karix platform uses the pinned API version of the account as the default verison. Your account defaults to the latest API version release at the time of signup. You can check the pinned API version form the [dashboard](https://cloud.karix.io/dashboard).  Karix also provides Helper Libraries for all major languages. Release versions of these libraries correspond to their API Version supported. Client version vX.Y.Z supports API version vX.Y. Helper libraries are configured to send `api-version` header based on the library version. When using official Karix helper libraries, you dont need to concern yourself with pinned version. Using helper library of latest version will give you access to latest features.  # Supported Channels  Karix omnichannel messaging API supports the following channels:   - sms   - whatsapp  ## SMS Channel To send a message to one or more destinations over SMS channel set `channel` to `sms` in the [Messaging API](#operation/sendMessage).  In trial mode, your account can only send messages to numbers within the sandbox.  ## Whatsapp Channel To send a message to a destination over WhatsApp channel set `channel` to `whatsapp` in the [Messaging API](#operation/sendMessage).  By default WhatsApp channel can only be used from within the sandbox. Contact [support](mailto:support@karix.io) for sending message outside the sandbox and getting your own Whatsapp Business Account.  ### Message Types Any messages you initiate over WhatsApp to end users must conform to a template configured in WhatsApp. These messages are called \"Notification Messages\". Both text and media content can be sent as a notification message. Please contact your sales representative to get templates approved (or mail [sales](mailto:support@karix.io))  Any responses you receive from end users and all replies you send within 24 hours of the last received response are called \"Conversation Messages\".  Both Notification and Conversation messages are priced differently, please refer to the [pricing page](http://karix.io/messaging/pricing/) for more details.  #### Text Notification To send a notification message with text content the `content.text` parameter in [Send Message API](#operation/sendMessage) request needs to match an approved template pattern.  When using the sandbox for testing and development purposes, we have provided for the following pre-approved templates for \"Notification Messages\":    - Your order * has been dispatched. Please expect delivery by *   - OTP requested by you on * is *   - Thank you for your payment of * * on *. Your transaction ID is *  You can replace `*` with any text of your choice.  #### Media Notification To send a notification message with media content the `content.media.caption` parameter in [Send Message API](#operation/sendMessage) request needs to match an approved template pattern. Additionally, the `content.media.url` parameter should link to a media type which is approved for that pattern. The following media types can be supported: image, video (only MP4), and document (only PDF).  When using the sandbox for testing and development purposes, we have provided for the following pre-approved templates for \"Notification Messages\":    - Caption: Your Ticket for movie * On * Time * Seat no : *     Media Type: image   - Caption: Hey here is the demo on steps to install *     Media Type: video   - Caption: Flight Confirmation for * on *     Media Type: document  You can replace `*` with any text of your choice.  ### Content Types WhatsApp supports the following content types for outbound media messages: | Content Type | File Format                          | |:------------ |:------------------------------------ | | audio        | AAC, M4A, AMR, MP3, OGG OPUS         | | image        | JPG/JPEG, PNG                        | | documents    | PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX | | video        | MP4, 3GPP                            |  Besides video content, it is also possible to send links to sites which support preview (like YouTube) as a conversation text message. WhatsApp will render video preview depending on the user's device.  For inbound media, Karix supports all file formats which can be sent using WhatsApp. An incoming media message event will be reported to the Webhook attached to the Number resource. You can read more about Karix event structure [here](#section/Events-and-Webhooks).  # Common Request Structures  All Karix APIs follow a common REST format with the following resources:   - account   - message   - webhook   - number  ## Creating a resource To create a resource send a `POST` request with the desired parameters in a JSON object to `/<resource>/` url. A successful response will contain the details of the single resource created with HTTP status code `201 Created`. Note: An exception to this is the `Create Message` API which is a bulk API and returns       a list of message records.  ## Fetching a resource To fetch a resource by its Unique ID send a `GET` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource. A successful response will contain the details of the single resource fetched with HTTP status code `200 OK`  ## Editing a resource To edit certain parameters of a resource send a `PATCH` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource, with a JSON object containing only the parameters which need to be updated. Edit resource APIs generally have no required parameters. A successful response will contain all the details of the single resource after editing.  ## Deleting a resource To delete a resource send a `DELETE` request to `/<resource>/<uid>/` where `uid` is the Alphanumeric Unique ID of the resource. A successful response will return HTTP status code `204 No Content` with no body.  ## Fetching a list of resources To fetch a list of resources send a `GET` request to `/<resource>/` with filters as GET parameters. A successful response will contain a list of filtered paginated objects with HTTP status code `200 OK`.  ### Pagination Pagination for list APIs are controlled using GET parameters:   - `limit`: Number of objects to be returned   - `offset`: Number of objects to skip before collecting the output list.  # Common Response Structures  All Karix APIs follow a common respose structure.  ## Success Responses  ### Single Resource Response  Responses returning a single object will have the following keys | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | | data          |               | Details of the object                     |  ### List Resource Response  Responses returning a list of objects will have the following keys | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | |               | previous      | Link to the previous page of the list     | |               | next          | Link to the next page of the list         | |               | total         | Total number of objects over all pages    | | objects       |               | List of objects with details              |  ## Error Responses  ### Validation Error Response  Responses for requests which failed due to validation errors will have the follwing keys: | Key           | Child Key     | Description                                | |:------------- |:------------- |:------------------------------------------ | | meta          |               | Meta Details about request and response    | |               | request_uuid  | Unique request identifier                  | | error         |               | Details for the error                      | |               | message       | Error message                              | |               | param         | (Optional) parameter this error relates to |  Validation error responses will return HTTP Status Code `400 Bad Request`  ### Insufficient Balance Response  Some requests will require to consume account credits. In case of insufficient balance the following keys will be returned: | Key           | Child Key     | Description                               | |:------------- |:------------- |:----------------------------------------- | | meta          |               | Meta Details about request and response   | |               | request_uuid  | Unique request identifier                 | | error         |               | Details for the error                     | |               | message       | `Insufficient Balance`                    |  Insufficient balance response will return HTTP Status Code `402 Payment Required`  # Events and Webhooks  All asynchronous events generated by Karix platform follow a common structure:  | Key           | Child Key     | Description                                 | |:------------- |:------------- |:------------------------------------------- | | uid           |               | Alphanumeric unique ID of the event         | | api_version   |               | 2.0                                         | | type          |               | Type of the event.                          | | data          |               | Details of the object attached to the event |  On an asynchronous event, an HTTP POST request is sent with the above JSON playload.  - For outbound messages, a message event is sent to events_url specified in   [Send Message API](#operation/sendMessage). - For inbound messages, a message event is either sent to the `events_url`   of the Webhook attached to the [Number](#tag/Number) or the Sandbox URL   configured in the [Dashboard](https://cloud.karix.io/dashboard/#whatsapp-demo).  ## Events List  ### Outbound Message Status Update `message` events are generated when a message status is changed to `sent`, `delivered`, `undelivered` or `failed`. These events are sent to `events_url` parameter of [Send Message](#operation/sendMessage) API  ### Inbound Message Received `message` events are generated when a message is received on a [Number](#tag/Number) with capability to receive messages on a channel. These events are sent to the webhook attached to the phone number resource using [Edit Number](#tag/Number) API  For inbound messages to WhatsApp Sandbox, `message` events are sent to Webhook URL set on the [Dashboard](https://cloud.karix.io/dashboard/#whatsapp-demo).  ### Inbound Media Message Received `message` events are generated when a message containing media content is received on a [Number](#tag/Number) with capability to receive messages through a media capable channel. An inbound message to WhatsApp Sandbox may also contain media.  The parameter `data.content.media.url` will link to the [Media URL](#operation/getMedia) hosted with Karix from where you can download the media.

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 2.0
- Build package: io.swagger.codegen.languages.PhpClientCodegen

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com//.git"
    }
  ],
  "require": {
    "/": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/SwaggerClient-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
    ->setUsername('YOUR_USERNAME')
    ->setPassword('YOUR_PASSWORD');

$apiInstance = new Swagger\Client\Api\AccountsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$subaccount = new \Swagger\Client\Model\CreateAccount(); // \Swagger\Client\Model\CreateAccount | Subaccount object

try {
    $result = $apiInstance->createSubaccount($api_version, $subaccount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->createSubaccount: ', $e->getMessage(), PHP_EOL;
}

?>
```

## Documentation for API Endpoints

All URIs are relative to *https://api.karix.io*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountsApi* | [**createSubaccount**](docs/Api/AccountsApi.md#createsubaccount) | **POST** /account/ | Create a new subaccount
*AccountsApi* | [**getSubaccount**](docs/Api/AccountsApi.md#getsubaccount) | **GET** /account/ | Get a list of accounts
*AccountsApi* | [**getSubaccountById**](docs/Api/AccountsApi.md#getsubaccountbyid) | **GET** /account/{uid}/ | Get details of an account
*AccountsApi* | [**patchSubaccount**](docs/Api/AccountsApi.md#patchsubaccount) | **PATCH** /account/{uid}/ | Edit an account
*MediaApi* | [**getMedia**](docs/Api/MediaApi.md#getmedia) | **GET** /media/{uid}/ | Get media by id
*MessageApi* | [**getMessage**](docs/Api/MessageApi.md#getmessage) | **GET** /message/ | Get list of messages sent or received
*MessageApi* | [**getMessageById**](docs/Api/MessageApi.md#getmessagebyid) | **GET** /message/{uid}/ | Get message details by id.
*MessageApi* | [**patchMessageById**](docs/Api/MessageApi.md#patchmessagebyid) | **PATCH** /message/{uid}/ | Redact message record by uid.
*MessageApi* | [**sendMessage**](docs/Api/MessageApi.md#sendmessage) | **POST** /message/ | Send a message to a list of destinations
*NumberApi* | [**getNumber**](docs/Api/NumberApi.md#getnumber) | **GET** /number/ | Get details of all phone numbers linked to your account.
*NumberApi* | [**numberNumDelete**](docs/Api/NumberApi.md#numbernumdelete) | **DELETE** /number/{num}/ | Unrent number from your account
*NumberApi* | [**numberNumGet**](docs/Api/NumberApi.md#numbernumget) | **GET** /number/{num}/ | Get details of a number
*NumberApi* | [**numberNumPatch**](docs/Api/NumberApi.md#numbernumpatch) | **PATCH** /number/{num}/ | Edit phone number belonging to your account
*NumberApi* | [**rentNumber**](docs/Api/NumberApi.md#rentnumber) | **POST** /number/ | Rent a phone number
*NumberSearchApi* | [**numbersearchGet**](docs/Api/NumberSearchApi.md#numbersearchget) | **GET** /numbersearch/ | Query for phone numbers in our inventory.
*WebhookApi* | [**createWebhook**](docs/Api/WebhookApi.md#createwebhook) | **POST** /webhook/ | Create webhooks to receive Message
*WebhookApi* | [**deleteWebhookById**](docs/Api/WebhookApi.md#deletewebhookbyid) | **DELETE** /webhook/{uid}/ | Delete a webhook by ID
*WebhookApi* | [**getWebhook**](docs/Api/WebhookApi.md#getwebhook) | **GET** /webhook/ | Get a list of your webhooks
*WebhookApi* | [**getWebhookById**](docs/Api/WebhookApi.md#getwebhookbyid) | **GET** /webhook/{uid}/ | Get a webhook by ID
*WebhookApi* | [**patchWebhook**](docs/Api/WebhookApi.md#patchwebhook) | **PATCH** /webhook/{uid}/ | Edit a webhook
*WhatsappApi* | [**createWhatsappTemplate**](docs/Api/WhatsappApi.md#createwhatsapptemplate) | **POST** /whatsapp/template/ | Create whatsapp templates
*WhatsappApi* | [**getWhatsappAccount**](docs/Api/WhatsappApi.md#getwhatsappaccount) | **GET** /whatsapp/account/ | Get a list of your whatsapp accounts
*WhatsappApi* | [**getWhatsappAccountById**](docs/Api/WhatsappApi.md#getwhatsappaccountbyid) | **GET** /whatsapp/account/{uid}/ | Get a whatsapp account by Unique ID
*WhatsappApi* | [**getWhatsappProfileAbout**](docs/Api/WhatsappApi.md#getwhatsappprofileabout) | **GET** /whatsapp/profile/about/{num}/ | Get whatsapp profile about text of a number
*WhatsappApi* | [**getWhatsappProfileAboutList**](docs/Api/WhatsappApi.md#getwhatsappprofileaboutlist) | **GET** /whatsapp/profile/about/ | Get a list of your whatsapp profile about texts
*WhatsappApi* | [**getWhatsappProfileBusiness**](docs/Api/WhatsappApi.md#getwhatsappprofilebusiness) | **GET** /whatsapp/profile/business/{num}/ | Get the business details for your Whatsapp number
*WhatsappApi* | [**getWhatsappProfileBusinessList**](docs/Api/WhatsappApi.md#getwhatsappprofilebusinesslist) | **GET** /whatsapp/profile/business/ | Get a list of business details for your Whatsapp numbers
*WhatsappApi* | [**getWhatsappProfilePhoto**](docs/Api/WhatsappApi.md#getwhatsappprofilephoto) | **GET** /whatsapp/profile/photo/{num}/ | Get whatsapp profile photo details of a number
*WhatsappApi* | [**getWhatsappProfilePhotos**](docs/Api/WhatsappApi.md#getwhatsappprofilephotos) | **GET** /whatsapp/profile/photo/ | Get a list of your whatsapp profile photos
*WhatsappApi* | [**getWhatsappTemplate**](docs/Api/WhatsappApi.md#getwhatsapptemplate) | **GET** /whatsapp/template/ | Get a list of your whatsapp templates
*WhatsappApi* | [**getWhatsappTemplateById**](docs/Api/WhatsappApi.md#getwhatsapptemplatebyid) | **GET** /whatsapp/template/{uid}/ | Get a whatsapp template by ID
*WhatsappApi* | [**patchWhatsappProfileAbout**](docs/Api/WhatsappApi.md#patchwhatsappprofileabout) | **PATCH** /whatsapp/profile/about/{num}/ | Edit Whatsapp About text of a number
*WhatsappApi* | [**patchWhatsappProfileBusiness**](docs/Api/WhatsappApi.md#patchwhatsappprofilebusiness) | **PATCH** /whatsapp/profile/business/{num}/ | Edit the business details for your Whatsapp number
*WhatsappApi* | [**putWhatsappProfilePhoto**](docs/Api/WhatsappApi.md#putwhatsappprofilephoto) | **PUT** /whatsapp/profile/photo/{num}/ | Upload a profile photo for a Whatsapp Number


## Documentation For Models

 - [Account](docs/Model/Account.md)
 - [AccountNumber](docs/Model/AccountNumber.md)
 - [ArrayMetaResponse](docs/Model/ArrayMetaResponse.md)
 - [CreateAccount](docs/Model/CreateAccount.md)
 - [CreateMessage](docs/Model/CreateMessage.md)
 - [CreateWebhook](docs/Model/CreateWebhook.md)
 - [CreateWhatsappTemplate](docs/Model/CreateWhatsappTemplate.md)
 - [EditAccount](docs/Model/EditAccount.md)
 - [EditAccountNumber](docs/Model/EditAccountNumber.md)
 - [EditMessage](docs/Model/EditMessage.md)
 - [EditWebhook](docs/Model/EditWebhook.md)
 - [EditWhatsappProfileAbout](docs/Model/EditWhatsappProfileAbout.md)
 - [EditWhatsappProfileBusiness](docs/Model/EditWhatsappProfileBusiness.md)
 - [Message](docs/Model/Message.md)
 - [MetaResponse](docs/Model/MetaResponse.md)
 - [MetaResponseWithBalance](docs/Model/MetaResponseWithBalance.md)
 - [ObjectMetaResponse](docs/Model/ObjectMetaResponse.md)
 - [PhoneNumber](docs/Model/PhoneNumber.md)
 - [RentNumber](docs/Model/RentNumber.md)
 - [Webhook](docs/Model/Webhook.md)
 - [WhatsappAccount](docs/Model/WhatsappAccount.md)
 - [WhatsappProfileAbout](docs/Model/WhatsappProfileAbout.md)
 - [WhatsappProfileBusiness](docs/Model/WhatsappProfileBusiness.md)
 - [WhatsappProfilePhoto](docs/Model/WhatsappProfilePhoto.md)
 - [WhatsappTemplate](docs/Model/WhatsappTemplate.md)


## Documentation For Authorization


## basicAuth

- **Type**: HTTP basic authentication


## Author

support@karix.io


