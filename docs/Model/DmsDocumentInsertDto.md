# # DmsDocumentInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**file** | [**\RaynetApiClient\Model\DmsDocumentInsertDtoFile**](DmsDocumentInsertDtoFile.md) |  | [optional]
**link** | [**\RaynetApiClient\Model\DmsDocumentInsertDtoLink**](DmsDocumentInsertDtoLink.md) |  | [optional]
**status** | **string** | [Stav] - výchozí hodnota A_DRAFT | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku DocumentCategory | [optional]
**template** | **bool** | [Šablona] | [optional]
**valid_from** | **\DateTime** | [Platné od] datum platné od | [optional]
**valid_till** | **\DateTime** | [Platné do] datum platné do | [optional]
**folder** | **int** | [Umístění] ID záznamu adresáře |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
