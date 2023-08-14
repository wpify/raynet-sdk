# # MassEmailRecipientEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby, která je adresátem emailu | [optional]
**company** | **int** | [Klient] ID klienta, který je adresátem emailu | [optional]
**lead** | **int** | [Lead] ID leadu, který je adresátem emailu | [optional]
**status** | **string** | [Stav] Stav odeslání | [optional]
**email** | **string** | [Email] Email, kam byla zpráva odeslána | [optional]
**opened** | **\DateTime** | [Otevřeno] Datum, kdy adresátem email otevřel | [optional]
**clicked** | **\DateTime** | [Kliknuto] Datum, kdy adresát provedl akci (klik) | [optional]
**unsubscribed** | **\DateTime** | [Odhlášeno] Datum, kdy se adresát z kampaně odhlásil | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
