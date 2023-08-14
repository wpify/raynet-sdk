# # CustomFieldConfigInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**label** | **string** | [Název pole] (minimálně 3 znaky) |
**group_name** | **string** | [Název panelu] (minimálně 3 znaky) |
**data_type** | **string** | [Typ pole] - &#x60;STRING&#x60; Textové pole, - &#x60;FILE&#x60; Soubor, - &#x60;TEXT&#x60; Velké textové pole, - &#x60;ENUMERATION&#x60; Roletka, - &#x60;HYPERLINK&#x60; Odkaz, - &#x60;DATE&#x60; Datum, - &#x60;DATETIME&#x60; Datum s časem, - &#x60;TIME&#x60; Časové pole, - &#x60;BIG_DECIMAL&#x60; Číslo, - &#x60;MONETARY&#x60; Měna, - &#x60;PERCENT&#x60; Procenta, - &#x60;BOOLEAN&#x60; Zatržítko |
**currency** | **string** | [Měna] - povinný v případě, že je dataType&#x3D;MONETARY | [optional]
**hint** | **string** | [Textová nápověda] | [optional]
**read_only** | **bool** | [Pouze pro čtení] | [optional]
**show_in_filter_view** | **bool** | [V pokročilých filtrech] | [optional]
**show_in_list_export** | **bool** | [V exportech] | [optional]
**show_in_list_view** | **bool** | [Jako sloupec v seznamu] | [optional]
**full_text** | **bool** | [Ve fulltextu] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
