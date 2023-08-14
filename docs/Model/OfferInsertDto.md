# # OfferInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | [Předmět] |
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**company** | **int** | [Klient] ID klienta, pro kterého je nabídka vytvářena |
**person** | **int** | [Kontaktní osoba] ID zodp. kontaktní osoby klienta pro kterou je nabídka vytvářena | [optional]
**business_case** | **int** | [OP] ID obch. případu nabídky |
**total_amount** | **float** | [Konečná cena] konečná cena nabídky | [optional]
**estimated_value** | **float** | [Předpokládané náklady] předpokládané náklady v nabídce | [optional]
**valid_from** | **\DateTime** | [Otevřeno od] datum vytvoření nabídky | [optional]
**valid_till** | **\DateTime** | [Otevřeno od] datum uzavření nabídky | [optional]
**expiration_date** | **\DateTime** | [Konec platnosti] konec platnosti nabídky | [optional]
**description** | **string** | [Poznámka] | [optional]
**category** | **int** | [Kategorie] ID záznamu z číselníku OfferCategory | [optional]
**offer_status** | **int** | [Stav] ID záznamu z OfferStatus. Pokud nebude vyplněno, založí se nabídka do prvního stavu. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
