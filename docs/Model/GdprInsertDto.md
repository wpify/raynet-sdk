# # GdprInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**gdpr_template** | **int** | [Šablona právního titulu] ID Šablony právního titulu |
**gdpr_form_agreement** | **int** | [Forma udělení souhlasu] ID Formy udělení souhlasu. Jen pro právní titul CONSENT. | [optional]
**company** | **int** | [Klient] ID klienta, kterou je vytvářen právní titlu | [optional]
**person** | **int** | [Kontaktní osoba] ID zodp. kontaktní osoby klienta, pro kterou je vytvářen právní titlu | [optional]
**lead** | **int** | [Lead] ID leadu, pro kterou je vytvářen právní titlu | [optional]
**valid_from** | **\DateTime** | [Platnost od] datum platnosti právního titlulu od | [optional]
**valid_till** | **\DateTime** | [Platnost do] datum platnosti právního titlulu do | [optional]
**contract_validity** | **\DateTime** | [Platnost smlouvy do] datum platnosti smlouvy do. Jen pro právní titul CONTRACT. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
