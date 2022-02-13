# WhatsappTemplate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**uid** | **string** | Unique ID of the Whatsapp template. | 
**status** | **string** | Approval status of whatsapp template. Newly created templates are in pending state until they are approved or rejected by Whatsapp. | 
**category** | **string** | Category of the template. | 
**whatsapp_account_uid** | **string** | Unique ID of the whatsapp account which owns this template | 
**name** | **string** | The name of the template. | 
**language_code** | **string** | Language code for the template. | 
**attachment** | **string** | Media attachment for the template if exists. If no media is attached then the value is null. | 
**text** | **string** | Templated text or media caption for the template. Please note that a variable is represented using the placeholder {{*}} which is different from Whatsapp placeholder. | 
**rejected_reason** | **string** | Reason given by whatsapp for rejection of the template. This field is non-null only for rejected templates. | 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


