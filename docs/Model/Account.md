# Account

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**uid** | **string** | Alphanumeric user identification. Used as username for Basic Authentication | [optional] 
**token** | **string** | Token password for this account. Used as password in Basic Authentication | [optional] 
**is_parent** | **bool** | There is generally only one parent account in list. Rest are child subaccounts. Possible values:   - &#x60;true&#x60;: If the account is a parent account   - &#x60;false&#x60;: If the account is a subaccount of the parent account | [optional] 
**created_time** | [**\DateTime**](\DateTime.md) | Date when this account was created | [optional] 
**updated_time** | [**\DateTime**](\DateTime.md) | Date when this account was last updated | [optional] 
**account_type** | **string** | Signifies whether the account is prepaid, postpaid or trial | [optional] 
**credit_balance** | [**BigDecimal**](BigDecimal.md) | Account&#39;s credit balance in US dollars.   - For postpaid accounts this value will be &#x60;null&#x60;.   - For subaccounts this value will reflect balance of parent account | [optional] 
**auto_recharge** | **bool** | Whether auto-recharge has been enabled. | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


