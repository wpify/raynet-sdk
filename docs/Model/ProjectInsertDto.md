# # ProjectInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Předmět] |
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**company** | **int** | [Klient] ID klienta, pro kterého je projekt vytvářen |
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby zodpovědné za projekt na straně klienta | [optional]
**total_amount** | **int** | [Konečná cena] konečná cena projektu | [optional]
**avg_value_total_amount** | **float** | [Průměrná hodnota] průměrná hodnota projektu | [optional]
**min_value_total_amount** | **float** | [Minimální hodnota] minimální hodnota projektu | [optional]
**max_value_total_amount** | **float** | [Maximální hodnota] maximální hodnota projektu | [optional]
**valid_from** | **\DateTime** | [Otevřeno od] datum otevřeno od | [optional]
**valid_till** | **\DateTime** | [Uzavřeno] datum uzavření projektu | [optional]
**scheduled_end** | **\DateTime** | [Plánované ukončení] datum plánovaného ukončení projektu | [optional]
**description** | **string** | [Poznámka] | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku ProjectCategory | [optional]
**project_status** | **int** | [Stav] ID záznamu z ProjectStatus. Pokud nebude vyplněno, založí se projekt do prvního stavu. | [optional]
**tags** | **string[]** |  | [optional]
**custom_fields** | [**\RaynetApiClient\Model\BusinessCaseInsertDtoCustomFields**](BusinessCaseInsertDtoCustomFields.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
