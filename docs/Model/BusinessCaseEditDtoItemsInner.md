# # BusinessCaseEditDtoItemsInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | [ID] ID položky, která se má upravit. Pokud není obsaženo, je založena nová položka | [optional]
**name** | **string** | [Položka] Název položky. Je vyžadováno, pokud se vkládá nová položka (id není zadáno) | [optional]
**product_code** | **string** | [Kód produktu] Na základě zadaného kódu se dohledá produkt (nebo založí nový). Položka OP se pak vytvoří s tímto produktem. | [optional]
**price_list** | **int** | [Ceník] V případě založení nové položky napojené na produkt lze vybrat i ceník | [optional]
**price** | **float** | [Prodejní cena] | [optional]
**tax_rate** | **float** | [Daň] | [optional]
**count** | **float** | [Množství] | [optional]
**unit** | **string** | [Jednotka] | [optional]
**discount_percent** | **float** | [Sleva] | [optional]
**description** | **string** | [Poznámka] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
