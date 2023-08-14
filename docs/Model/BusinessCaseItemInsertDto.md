# # BusinessCaseItemInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**product_code** | **string** | [Kód produktu] Na základě zadaného kódu se dohledá produkt. Položka OP se pak vytvoří s tímto produktem. | [optional]
**product** | **int** | [ID produktu] Na základě zadaného ID se dohledá produkt. Položka OP se pak vytvoří s tímto produktem. | [optional]
**price_list** | **int** | [ID ceníku] Vyhledávání produktu výše uvedenými kritérii bude omezeno pouze na zadaný ceník. Pokud není zadáno, vyhledává se ve výchozích (ne-ceníkových) produktech. | [optional]
**name** | **string** | [Název] Povinná hodnota pouze pro nekategorizovaný produkt |
**price** | **float** | [Prodejní cena] | [optional]
**tax_rate** | **float** | [Daň] | [optional]
**count** | **float** | [Množství] | [optional]
**discount_percent** | **float** | [Sleva] | [optional]
**cost** | **float** | [Náklady] Náklad za kus | [optional]
**unit** | **string** | [Jednotka] | [optional]
**description** | **string** | [Poznámka] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
