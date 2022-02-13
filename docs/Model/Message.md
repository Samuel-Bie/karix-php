# Message

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**uid** | **string** | Unique ID for a message sent or received | [optional] 
**account_uid** | **string** | Unique ID of Account which created this message | [optional] 
**total_cost** | [**BigDecimal**](BigDecimal.md) | Total cost deducted from your credits for this message - &#x60;total_cost&#x60; will reflect refunds for this message. If there was a complete   refund, the &#x60;total_cost&#x60; will be zero. | [optional] 
**refund** | [**BigDecimal**](BigDecimal.md) | If a refund was processed for this message &#x60;refund&#x60; will be a non-null number | [optional] 
**source** | **string** | Sender ID for the message | [optional] 
**destination** | **string** | Destination number for the message in E.164 format | [optional] 
**country** | **string** | ISO2 code of the country where the destination belongs to | [optional] 
**content_type** | **string** | Content type of the message. - Its value will correspond to the key present in the &#x60;content&#x60;. | [optional] 
**content** | **object** | Content to be sent to the destinations. - For channel &#x60;sms&#x60; only &#x60;text&#x60; content is supported - Only one of &#x60;text&#x60;, &#x60;location&#x60; or &#x60;media&#x60; can be provided | [optional] 
**created_time** | [**\DateTime**](\DateTime.md) | Timestamp when the message was created | [optional] 
**sent_time** | [**\DateTime**](\DateTime.md) | Timestamp when message was sent to the selected channel | [optional] 
**delivered_time** | [**\DateTime**](\DateTime.md) | Timestamp when the message was delivered to the destination | [optional] 
**updated_time** | [**\DateTime**](\DateTime.md) | Timestamp when the message status was last updated - If the current status is &#x60;read&#x60;, then this timestamp also represents   read time - If the current status is &#x60;undelivered&#x60; then this timestamp also represents   undelivered time | [optional] 
**channel** | **string** | Channel used to send the message. Please check [Supported Channels](#section/Supported-Channels) for more details. | [optional] 
**status** | **string** | Current status of the message. Possible values: - &#x60;queued&#x60;: Message has been queued in Karix system             (for either &#x60;inbound&#x60; or &#x60;outbound&#x60; direction) - &#x60;sent&#x60;: The &#x60;outbound&#x60; message has been sent to carriers for delivery - &#x60;failed&#x60;: In case of &#x60;outbound&#x60; message, this means that Karix failed             to send the message to a carrier.             In case of &#x60;inbound&#x60; message, this means that Karix failed             to send the message to its webhook, if configured. - &#x60;delivered&#x60;: The &#x60;outbound&#x60; message was delivered to its receiver. - &#x60;read&#x60;: The outbound message was delivered and read by the the receiver.           Not supported by &#x60;sms&#x60; channel. - &#x60;undelivered&#x60;: The &#x60;outbound&#x60; message falied to be delivered to its receiver. - &#x60;rejected&#x60;: The &#x60;outbound&#x60; message was rejected by the chosen carrier. | [optional] 
**direction** | **string** | Direction of the message. - inbound: Message was sent to a number owned by the karix account - outbound: Message was sent to a destination using karix account | [optional] 
**error** | **object** | Non-null in case of a failure to send the message. | [optional] 
**redact** | **bool** | If the message was redacted using redact message API, then &#x60;redact&#x60; will be &#x60;true&#x60;. | [optional] 
**channel_details** | **object** | Channel specific details of this message. - Only contains details of the channel used to send the message | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


