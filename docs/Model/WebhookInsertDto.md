# # WebhookInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**url** | **string** | [Url] Adresa pro zaslání webhooku (http nebo https). |
**secret_token** | **string** | [Bezpečnostní token] Token bude zaslán spolu s požadavkem v HTTP hlavičce X-RAYNETCRM-Token. | [optional]
**events** | **string[]** | [Události] Typy událostí, které webhook bude zpracovávat (tzn. record.created, record.updated nebo record.deleted). |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
