# # InvoiceEditDtoItemsInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | [ID] id položky faktury (prázdné ID &#x3D;&gt; položka bude založena, záporné ID &#x3D;&gt; položka bude smazána, kladné ID &#x3D;&gt; položka bude změněna) | [optional]
**name** | **string** | [Položka] Název položky faktury. Je vyžadováno, pokud se vkládá nová položka (id není zadáno) | [optional]
**unit_price** | **float** | [Cena] | [optional]
**tax_rate** | **float** | [Daň] | [optional]
**amount** | **float** | [Množství] | [optional]
**unit_label** | **string** | [Jednotka] | [optional]
**discount_percent** | **float** | [Sleva %] | [optional]
**description** | **string** | [Poznámka] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
