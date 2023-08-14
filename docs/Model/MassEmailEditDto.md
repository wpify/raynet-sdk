# # MassEmailEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**title** | **string** | [Název] Název hromadného emailu | [optional]
**completed** | **\DateTime** | [Rozesláno] Datum odeslání hromadného emailu | [optional]
**description** | **string** | [Popis] | [optional]
**tags** | **string[]** |  | [optional]
**campaign_name** | **string** | [Název kampaně] Název v mailingové službě | [optional]
**source** | **string** | [Zdroj] Mailingová služba | [optional]
**external_id** | **string** | [Externí ID] ID kampaně v mailingové službě | [optional]
**external_overview_url** | **string** | [Odkaz na výsledky kampaně] URL s odkazem na výsledky kampaně v externí mailingové službě | [optional]
**external_thumbnail_url** | **string** | [Odkaz na detail kampaně] URL s odkazem na detail kampaně v externí mailingové službě | [optional]
**stats** | [**\RaynetApiClient\Model\MassEmailInsertDtoStats**](MassEmailInsertDtoStats.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
