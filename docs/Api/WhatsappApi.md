# Swagger\Client\WhatsappApi

All URIs are relative to *https://api.karix.io*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createWhatsappTemplate**](WhatsappApi.md#createWhatsappTemplate) | **POST** /whatsapp/template/ | Create whatsapp templates
[**getWhatsappAccount**](WhatsappApi.md#getWhatsappAccount) | **GET** /whatsapp/account/ | Get a list of your whatsapp accounts
[**getWhatsappAccountById**](WhatsappApi.md#getWhatsappAccountById) | **GET** /whatsapp/account/{uid}/ | Get a whatsapp account by Unique ID
[**getWhatsappProfileAbout**](WhatsappApi.md#getWhatsappProfileAbout) | **GET** /whatsapp/profile/about/{num}/ | Get whatsapp profile about text of a number
[**getWhatsappProfileAboutList**](WhatsappApi.md#getWhatsappProfileAboutList) | **GET** /whatsapp/profile/about/ | Get a list of your whatsapp profile about texts
[**getWhatsappProfileBusiness**](WhatsappApi.md#getWhatsappProfileBusiness) | **GET** /whatsapp/profile/business/{num}/ | Get the business details for your Whatsapp number
[**getWhatsappProfileBusinessList**](WhatsappApi.md#getWhatsappProfileBusinessList) | **GET** /whatsapp/profile/business/ | Get a list of business details for your Whatsapp numbers
[**getWhatsappProfilePhoto**](WhatsappApi.md#getWhatsappProfilePhoto) | **GET** /whatsapp/profile/photo/{num}/ | Get whatsapp profile photo details of a number
[**getWhatsappProfilePhotos**](WhatsappApi.md#getWhatsappProfilePhotos) | **GET** /whatsapp/profile/photo/ | Get a list of your whatsapp profile photos
[**getWhatsappTemplate**](WhatsappApi.md#getWhatsappTemplate) | **GET** /whatsapp/template/ | Get a list of your whatsapp templates
[**getWhatsappTemplateById**](WhatsappApi.md#getWhatsappTemplateById) | **GET** /whatsapp/template/{uid}/ | Get a whatsapp template by ID
[**patchWhatsappProfileAbout**](WhatsappApi.md#patchWhatsappProfileAbout) | **PATCH** /whatsapp/profile/about/{num}/ | Edit Whatsapp About text of a number
[**patchWhatsappProfileBusiness**](WhatsappApi.md#patchWhatsappProfileBusiness) | **PATCH** /whatsapp/profile/business/{num}/ | Edit the business details for your Whatsapp number
[**putWhatsappProfilePhoto**](WhatsappApi.md#putWhatsappProfilePhoto) | **PUT** /whatsapp/profile/photo/{num}/ | Upload a profile photo for a Whatsapp Number


# **createWhatsappTemplate**
> object createWhatsappTemplate($template, $api_version)

Create whatsapp templates

Create a new template request with whatsapp

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$template = new \Swagger\Client\Model\CreateWhatsappTemplate(); // \Swagger\Client\Model\CreateWhatsappTemplate | Whatsapp Template Details object
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->createWhatsappTemplate($template, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->createWhatsappTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **template** | [**\Swagger\Client\Model\CreateWhatsappTemplate**](../Model/CreateWhatsappTemplate.md)| Whatsapp Template Details object |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappAccount**
> object getWhatsappAccount($api_version, $offset, $limit, $name, $karix_account_uid)

Get a list of your whatsapp accounts

Get a list of whatsapp accounts added to your Karix account. Whatsapp accounts cannot be added using Karix API. Please contact sales@karix.io to your Whatsapp Account provisioned.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$name = "name_example"; // string | Filter by whatsapp account name
$karix_account_uid = "karix_account_uid_example"; // string | Filter by karix account uid

try {
    $result = $apiInstance->getWhatsappAccount($api_version, $offset, $limit, $name, $karix_account_uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappAccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **name** | **string**| Filter by whatsapp account name | [optional]
 **karix_account_uid** | **string**| Filter by karix account uid | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappAccountById**
> object getWhatsappAccountById($uid, $api_version)

Get a whatsapp account by Unique ID

Get a whatsapp account by Unique ID

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = "uid_example"; // string | Alphanumeric ID of the whatsapp account to get.
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getWhatsappAccountById($uid, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappAccountById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uid** | **string**| Alphanumeric ID of the whatsapp account to get. |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfileAbout**
> object getWhatsappProfileAbout($num, $api_version)

Get whatsapp profile about text of a number

Get whatsapp profile about text of a number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Number for which details need to be fetched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getWhatsappProfileAbout($num, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfileAbout: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Number for which details need to be fetched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfileAboutList**
> object getWhatsappProfileAboutList($api_version, $offset, $limit, $number, $text)

Get a list of your whatsapp profile about texts

Get a list of your whatsapp profile about texts

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$number = "number_example"; // string | Filter by whatsapp number
$text = "text_example"; // string | Search about texts

try {
    $result = $apiInstance->getWhatsappProfileAboutList($api_version, $offset, $limit, $number, $text);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfileAboutList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **number** | **string**| Filter by whatsapp number | [optional]
 **text** | **string**| Search about texts | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfileBusiness**
> object getWhatsappProfileBusiness($num, $api_version)

Get the business details for your Whatsapp number

Get the business details for your Whatsapp number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Whatsapp Number for which details need to be fetched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getWhatsappProfileBusiness($num, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfileBusiness: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Whatsapp Number for which details need to be fetched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfileBusinessList**
> object getWhatsappProfileBusinessList($api_version, $offset, $limit, $number)

Get a list of business details for your Whatsapp numbers

Get a list of business details for your Whatsapp numbers

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$number = "number_example"; // string | Filter by whatsapp number

try {
    $result = $apiInstance->getWhatsappProfileBusinessList($api_version, $offset, $limit, $number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfileBusinessList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **number** | **string**| Filter by whatsapp number | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfilePhoto**
> object getWhatsappProfilePhoto($num, $api_version)

Get whatsapp profile photo details of a number

Get whatsapp profile photo details of a number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Whatsapp Number for which details need to be fetched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getWhatsappProfilePhoto($num, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfilePhoto: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Whatsapp Number for which details need to be fetched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappProfilePhotos**
> object getWhatsappProfilePhotos($api_version, $offset, $limit, $number)

Get a list of your whatsapp profile photos

Get a list of your whatsapp profile photos

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$number = "number_example"; // string | Filter by whatsapp number

try {
    $result = $apiInstance->getWhatsappProfilePhotos($api_version, $offset, $limit, $number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappProfilePhotos: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **number** | **string**| Filter by whatsapp number | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappTemplate**
> object getWhatsappTemplate($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code)

Get a list of your whatsapp templates

Get a list of your whatsapp templates for all whatsapp accounts

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$whatsapp_account_uid = "whatsapp_account_uid_example"; // string | Filter by whatsapp account uid
$status = "status_example"; // string | Filter by approval status
$category = "category_example"; // string | Filter by template category
$name = "name_example"; // string | Filter by template name
$language_code = "language_code_example"; // string | Filter by language code

try {
    $result = $apiInstance->getWhatsappTemplate($api_version, $offset, $limit, $whatsapp_account_uid, $status, $category, $name, $language_code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **whatsapp_account_uid** | **string**| Filter by whatsapp account uid | [optional]
 **status** | **string**| Filter by approval status | [optional]
 **category** | **string**| Filter by template category | [optional]
 **name** | **string**| Filter by template name | [optional]
 **language_code** | **string**| Filter by language code | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getWhatsappTemplateById**
> object getWhatsappTemplateById($uid, $api_version)

Get a whatsapp template by ID

Get a whatsapp template by ID

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = "uid_example"; // string | Alphanumeric ID of the whatsapp template to get.
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getWhatsappTemplateById($uid, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->getWhatsappTemplateById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uid** | **string**| Alphanumeric ID of the whatsapp template to get. |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **patchWhatsappProfileAbout**
> object patchWhatsappProfileAbout($num, $api_version, $details)

Edit Whatsapp About text of a number

Edit Whatsapp About text of a number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Number for which details need to be fetched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$details = new \Swagger\Client\Model\EditWhatsappProfileAbout(); // \Swagger\Client\Model\EditWhatsappProfileAbout | Whatsapp About object

try {
    $result = $apiInstance->patchWhatsappProfileAbout($num, $api_version, $details);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->patchWhatsappProfileAbout: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Number for which details need to be fetched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **details** | [**\Swagger\Client\Model\EditWhatsappProfileAbout**](../Model/EditWhatsappProfileAbout.md)| Whatsapp About object | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **patchWhatsappProfileBusiness**
> object patchWhatsappProfileBusiness($num, $api_version, $details)

Edit the business details for your Whatsapp number

Edit the business details for your Whatsapp number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Number for which details need to be patched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$details = new \Swagger\Client\Model\EditWhatsappProfileBusiness(); // \Swagger\Client\Model\EditWhatsappProfileBusiness | Whatsapp Business object

try {
    $result = $apiInstance->patchWhatsappProfileBusiness($num, $api_version, $details);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->patchWhatsappProfileBusiness: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Number for which details need to be patched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **details** | [**\Swagger\Client\Model\EditWhatsappProfileBusiness**](../Model/EditWhatsappProfileBusiness.md)| Whatsapp Business object | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putWhatsappProfilePhoto**
> object putWhatsappProfilePhoto($num, $api_version, $file)

Upload a profile photo for a Whatsapp Number

Upload a profile photo for a Whatsapp Number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\WhatsappApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$num = 56; // int | Whatsapp Number for which details need to be fetched
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$file = "/path/to/file.txt"; // \SplFileObject | The profile photo file to upload. Supports JPG and PNG formats.

try {
    $result = $apiInstance->putWhatsappProfilePhoto($num, $api_version, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WhatsappApi->putWhatsappProfilePhoto: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **num** | **int**| Whatsapp Number for which details need to be fetched |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **file** | **\SplFileObject**| The profile photo file to upload. Supports JPG and PNG formats. | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

