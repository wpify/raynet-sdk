# # BusinessCaseEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Předmět] | [optional]
**business_case_phase** | **int** | [Stav] ID záznamu z číselníku BusinessCasePhase | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna, je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**company** | **int** | [Klient] ID klienta, pro kterého je obchodní případ vytvářen | [optional]
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby zodpovědné za OP na straně klienta | [optional]
**project** | **int** | [Projekt] ID projektu na který má být OP připojen | [optional]
**total_amount** | **float** | [Konečná cena] konečná cena OP | [optional]
**estimated_value** | **float** | [Předpokládané náklady] předpokládané náklady na OP | [optional]
**probability** | **int** | [Pravděpodobnost] pravděpodobnost na úspěch OP | [optional]
**valid_from** | **\DateTime** | [Otevřeno od] datum otevřeno od | [optional]
**valid_till** | **\DateTime** | [Uzavřeno] datum uzavření OP | [optional]
**description** | **string** | [Poznámka] | [optional]
**currency** | **int** | [Měna] ID z áznamu z číselníku Currency | [optional]
**exchange_rate** | **float** | [Kurz] kurz pro přepočet na výchozí měnu CRM | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku BusinessCaseCategory | [optional]
**source** | **int** | [Zdroj kontaktu] ID záznamu z číselníku ContactSource | [optional]
**business_case_classification1** | **int** | [Klasifikace 1] ID záznamu z číselníku BusinessCaseClassification1 | [optional]
**business_case_classification2** | **int** | [Klasifikace 2] ID záznamu z číselníku BusinessCaseClassification2 | [optional]
**business_case_classification3** | **int** | [Klasifikace 3] ID záznamu z číselníku BusinessCaseClassification3 | [optional]
**original_lead** | **int** | [Lead] ID leadu, ze kterého obchodní případ vznikl | [optional]
**tags** | **string[]** |  | [optional]
**custom_fields** | [**\RaynetApiClient\Model\CompanyInsertDtoCustomFields**](CompanyInsertDtoCustomFields.md) |  | [optional]
**items** | [**\RaynetApiClient\Model\BusinessCaseEditDtoItemsInner[]**](BusinessCaseEditDtoItemsInner.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
