# # PriceListInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Název] |
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**code** | **string** | [Kód] |
**currency** | **int** | [Měna] ID záznamu z číselníku Currency |
**category** | **int** | [Kategorie] ID záznamu z číselníku PriceListCategory | [optional]
**valid_from** | **\DateTime** | [Otevřeno od] datum platnosti od |
**valid_till** | **\DateTime** | [Otevřeno od] datum platnosti do | [optional]
**description** | **string** | [Poznámka] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
