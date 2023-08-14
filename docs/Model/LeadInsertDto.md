# # LeadInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**topic** | **string** | [Předmět] |
**priority** | **string** | [Priorita] |
**company_name** | **string** | [Název společnosti] | [optional]
**reg_number** | **string** | [IČ] | [optional]
**first_name** | **string** | [Jméno] | [optional]
**last_name** | **string** | [Příjmení] | [optional]
**title_before** | **string** | [Titul před] | [optional]
**title_after** | **string** | [Titul za] | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**contact_source** | **int** | [Zdroj] ID záznamu z číselníku ContactSource | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku LeadCategory | [optional]
**notice** | **string** | [Poznámka k leadu] | [optional]
**lead_phase** | **int** | [Stav leadu] ID záznamu z číselníku LeadPhase | [optional]
**tags** | **string** | [Seznam štítků oddělených čárkou] | [optional]
**territory** | **int** | [Teritorium] ID záznamu z číselníku Territory | [optional]
**lead_person** | **bool** | [Jedná se o fyzickou osobu] | [optional]
**contact_info** | [**\RaynetApiClient\Model\LeadInsertDtoContactInfo**](LeadInsertDtoContactInfo.md) |  | [optional]
**address** | [**\RaynetApiClient\Model\LeadInsertDtoAddress**](LeadInsertDtoAddress.md) |  | [optional]
**social_network_contact** | [**\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact**](CompanyInsertDtoSocialNetworkContact.md) |  | [optional]
**custom_fields** | [**\RaynetApiClient\Model\CompanyInsertDtoCustomFields**](CompanyInsertDtoCustomFields.md) |  | [optional]
**notification_message** | **string** | [Text notifikace] | [optional]
**notification_email_addresses** | **string[]** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
