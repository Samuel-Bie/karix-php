# Swagger\Client\AccountsApi

All URIs are relative to *https://api.karix.io*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createSubaccount**](AccountsApi.md#createSubaccount) | **POST** /account/ | Create a new subaccount
[**getSubaccount**](AccountsApi.md#getSubaccount) | **GET** /account/ | Get a list of accounts
[**getSubaccountById**](AccountsApi.md#getSubaccountById) | **GET** /account/{uid}/ | Get details of an account
[**patchSubaccount**](AccountsApi.md#patchSubaccount) | **PATCH** /account/{uid}/ | Edit an account


# **createSubaccount**
> object createSubaccount($api_version, $subaccount)

Create a new subaccount

Create a new subaccount under your account

### Example
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

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **subaccount** | [**\Swagger\Client\Model\CreateAccount**](../Model/CreateAccount.md)| Subaccount object | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getSubaccount**
> object getSubaccount($api_version, $offset, $limit, $name)

Get a list of accounts

Get a list of details of all subaccounts, including the main account. Accounts are sorted by last updated time.

### Example
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
$offset = 0; // int | The number of items to skip before starting to collect the result set.
$limit = 10; // int | The numbers of items to return.
$name = "name_example"; // string | Filter by account name

try {
    $result = $apiInstance->getSubaccount($api_version, $offset, $limit, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->getSubaccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **offset** | **int**| The number of items to skip before starting to collect the result set. | [optional] [default to 0]
 **limit** | **int**| The numbers of items to return. | [optional] [default to 10]
 **name** | **string**| Filter by account name | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getSubaccountById**
> object getSubaccountById($uid, $api_version)

Get details of an account

Get details of an account by its uid. Both main account and subaccounts can be fetched using their uids.

### Example
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
$uid = "uid_example"; // string | Alphanumeric ID of the subaccount to get.
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.

try {
    $result = $apiInstance->getSubaccountById($uid, $api_version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->getSubaccountById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uid** | **string**| Alphanumeric ID of the subaccount to get. |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **patchSubaccount**
> object patchSubaccount($uid, $api_version, $subaccount)

Edit an account

Edit details of your account or its subaccount   - An account can only change the status of subaccounts under it.     It cant change its own status   - A parent account can edit its own details and the details of its subaccounts

### Example
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
$uid = "uid_example"; // string | Alphanumeric ID of the account/subaccount to edit.
$api_version = "2.0"; // string | API Version. If not specified your pinned verison is used.
$subaccount = new \Swagger\Client\Model\EditAccount(); // \Swagger\Client\Model\EditAccount | Subaccount object

try {
    $result = $apiInstance->patchSubaccount($uid, $api_version, $subaccount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->patchSubaccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uid** | **string**| Alphanumeric ID of the account/subaccount to edit. |
 **api_version** | **string**| API Version. If not specified your pinned verison is used. | [optional] [default to 2.0]
 **subaccount** | [**\Swagger\Client\Model\EditAccount**](../Model/EditAccount.md)| Subaccount object | [optional]

### Return type

**object**

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

