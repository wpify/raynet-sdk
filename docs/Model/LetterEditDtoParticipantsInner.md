# # LetterEditDtoParticipantsInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | [ID] id participanta aktivity (prázdné ID &#x3D;&gt; participant bude založen nový, záporné ID &#x3D;&gt; participant bude smazán, kladné ID &#x3D;&gt; participant bude změněn) | [optional]
**owner** | **bool** | [Vlastník] příznak, že je participant zároveň vlastníkem aktivity | [optional]
**role** | **string** | [Směr aktivity] | [optional]
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby, pokud je participant kontaktní osoba | [optional]
**company** | **int** | [Klient] ID klienta, pokud je participant klient | [optional]
**lead** | **int** | [Lead] ID leadu, pokud je participant lead | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
