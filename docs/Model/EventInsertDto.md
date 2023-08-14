# # EventInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**title** | **string** | [Předmět] |
**priority** | **string** | [Priorita] |
**category** | **int** | [Kategorie] ID záznamu z číselníku ActivityCategory | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, který je vlastníkem záznamu |
**person** | **int** | [Kontaktní osoba] ID kontaktní osoby, která je účastníkem události | [optional]
**company** | **int** | [Klient] ID klienta v kontextu záznamu | [optional]
**business_case** | **int** | [Obch. případ] ID obch. případu v kontextu záznamu | [optional]
**offer** | **int** | [Nabídka] ID nabídky v kontextu záznamu | [optional]
**sales_order** | **int** | [Objednávka] ID objednávky v kontextu záznamu | [optional]
**project** | **int** | [Projekt] ID projektu v kontextu záznamu | [optional]
**activity** | **int** | [Aktivita] ID aktivity v kontextu záznamu | [optional]
**lead** | **int** | [Lead] ID leadu v kontextu záznamu | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna, je nastavena výchozí bezpečnostní skupina. | [optional]
**scheduled_from** | **\DateTime** | [Naplánování v kalendáři od] | [optional]
**scheduled_till** | **\DateTime** | [Naplánování v kalendáři do] | [optional]
**completed** | **\DateTime** | [Datum realizace] | [optional]
**description** | **string** | [Informace o události] | [optional]
**tags** | **string[]** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
