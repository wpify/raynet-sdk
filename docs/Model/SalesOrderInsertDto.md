# # SalesOrderInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Předmět] |
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**company** | **int** | [Klient] ID klienta, pro kterého je objednávka vytvářena |
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby zodpovědné za OP na straně klienta | [optional]
**business_case** | **int** | [OP] ID obch. případu objednávky |
**offer** | **int** | [OP] ID nabídky, na kterou je objednávka napojena | [optional]
**total_amount** | **float** | [Konečná cena] konečná cena objednávky | [optional]
**estimated_value** | **float** | [Předpokládané náklady] předpokládané náklady v nabídce | [optional]
**valid_from** | **\DateTime** | [Otevřeno od] datum vytvoření objednávky | [optional]
**valid_till** | **\DateTime** | [Otevřeno od] datum uzavření objednávky | [optional]
**expiration_date** | **\DateTime** | [Konec platnosti] konec platnosti objednávky | [optional]
**request_delivery_date** | **\DateTime** | [Dodat do] datum dodání | [optional]
**description** | **string** | [Poznámka] | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku SalesOrderCategory | [optional]
**sales_order_status** | **int** | [Stav] ID záznamu z SalesOrderStatus. Pokud nebude vyplněno, založí se objednávka do prvního stavu. | [optional]
**delivery_address** | [**\RaynetApiClient\Model\SalesOrderInsertDtoDeliveryAddress**](SalesOrderInsertDtoDeliveryAddress.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
