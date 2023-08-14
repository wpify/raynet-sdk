# # PersonEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**title_before** | **string** | [Titul před] | [optional]
**first_name** | **string** | [Jméno] | [optional]
**last_name** | **string** | [Příjmení] | [optional]
**title_after** | **string** | [Titul za] | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku PersonCategory | [optional]
**person_classification1** | **int** | [Klasifikace 1] ID záznamu z číselníku PersonClassification1 | [optional]
**person_classification2** | **int** | [Klasifikace 2] ID záznamu z číselníku PersonClassification2 | [optional]
**person_classification3** | **int** | [Klasifikace 3] ID záznamu z číselníku PersonClassification3 | [optional]
**salutation** | **string** | [Oslovení] | [optional]
**birthday** | **string** | [Narozeniny] | [optional]
**language** | **int** | [Jazyk] ID záznamu z číselníku Language | [optional]
**marital_status** | **int** | [Rodinný stav] ID záznamu z číselníku MaritalStatus | [optional]
**gender** | **string** | [Pohlaví] | [optional]
**contact_info** | [**\RaynetApiClient\Model\CompanyInsertDtoAddressesInnerContactInfo**](CompanyInsertDtoAddressesInnerContactInfo.md) |  | [optional]
**social_network_contact** | [**\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact**](CompanyInsertDtoSocialNetworkContact.md) |  | [optional]
**private_address** | [**\RaynetApiClient\Model\PersonInsertDtoPrivateAddress**](PersonInsertDtoPrivateAddress.md) |  | [optional]
**notice** | **string** | [Poznámka k osobě] | [optional]
**custom_fields** | [**\RaynetApiClient\Model\CompanyInsertDtoCustomFields**](CompanyInsertDtoCustomFields.md) |  | [optional]
**keyman** | **bool** | [Klíčová osoba] | [optional]
**origin_lead** | **int** | [Lead] ID leadu, ze kterého kontaktní osoba vznikla | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
