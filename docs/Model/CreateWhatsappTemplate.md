# CreateWhatsappTemplate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**category** | **string** | Category of the template. Choose the appropriate category for Whatsapp to approve the template. | 
**whatsapp_account_uid** | **string** | Unique ID of the whatsapp account to which the template has to be attacheds | 
**name** | **string** | The name of the template. This must be unique for the whatsapp account. | 
**language_code** | **string** | Language code for the template. Please refer to Whatsapp Documentation for list of approved languages: https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates | 
**attachment** | **string** | Media attachment for the template if needed. For a text-only template this value should be null. | 
**text** | **string** | Templated text or media caption for the template. Please note that a variable is represented using the placeholder {{*}} which is different from Whatsapp placeholder. Using Whatsapp placeholders like {{1}}, {{2}} etc will return an error. | 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


