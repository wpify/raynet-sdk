# # CompanyEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Název] | [optional]
**person** | **bool** | [Jedná se o fyzickou osobu] | [optional]
**last_name** | **string** | [Příjmení fyzické osoby] - povinný v případě, že je aktivní příznak &#39;Jedná se o fyzickou osobu&#39; | [optional]
**first_name** | **string** | [Jméno fyzické osoby] | [optional]
**title_before** | **string** | [Titul před jménem fyzické osoby] | [optional]
**title_after** | **string** | [Titul za jménem fyzické osoby] | [optional]
**salutation** | **string** | [Oslovení] | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna, je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**rating** | **string** | [Rating] | [optional]
**state** | **string** | [Stav] | [optional]
**role** | **string** | [Vztah] | [optional]
**notice** | **string** | [Poznámka ke klientovi] | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku CompanyCategory | [optional]
**contact_source** | **int** | [Zdroj kontaktu] ID záznamu z číselníku ContactSource | [optional]
**employees_number** | **int** | [Zaměstnanců] ID záznamu z číselníku EmployeesNumber | [optional]
**legal_form** | **int** | [Právní forma] ID záznamu z číselníku LegalForm | [optional]
**payment_term** | **int** | [Platbní podmínky] ID záznamu z číselníku PaymentTerm | [optional]
**turnover** | **int** | [Obrat] ID záznamu z číselníku CompanyTurnover | [optional]
**economy_activity** | **int** | [Obor] ID záznamu z číselníku EconomyActivity | [optional]
**company_classification1** | **int** | [Klasifikace 1]ID záznamu z číselníku CompanyClassification1 | [optional]
**company_classification2** | **int** | [Klasifikace 2] ID záznamu z číselníku CompanyClassification2 | [optional]
**company_classification3** | **int** | [Klasifikace 3] ID záznamu z číselníku CompanyClassification3 | [optional]
**reg_number** | **string** | [IČ] | [optional]
**tax_number** | **string** | [DIČ] | [optional]
**tax_number2** | **string** | [IČ DPH] Pro slovenské klienty | [optional]
**tax_payer** | **string** | [Plátce DPH] | [optional]
**bank_account** | **string** | [Bankovní spojení] | [optional]
**databox** | **string** | [Datová schránka] | [optional]
**court** | **string** | [Spisová značka] | [optional]
**birthday** | **\DateTime** | [Narozeniny/Výročí] | [optional]
**social_network_contact** | [**\RaynetApiClient\Model\CompanyInsertDtoSocialNetworkContact**](CompanyInsertDtoSocialNetworkContact.md) |  | [optional]
**origin_lead** | **int** | [Lead] ID leadu, ze kterého klient vznikl | [optional]
**custom_fields** | [**\RaynetApiClient\Model\CompanyInsertDtoCustomFields**](CompanyInsertDtoCustomFields.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
