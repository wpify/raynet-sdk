# # InvoiceInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**company** | **int** | [Klient] Klient kterému se bude fakturovat |
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**title** | **string** | [Název] Název faktury pro lepší dohledatelnost | [optional]
**constant_symbol** | **string** | [Konstantní symbol] | [optional]
**specific_symbol** | **string** | [Specifický symbol] | [optional]
**currency** | **int** | [Měna] ID záznamu z číselníku Currency |
**due_date** | **string** | [Datum splatnosti] |
**issue_date** | **string** | [Datum vystavení] |
**invoice_type** | **string** | [Typ faktury] |
**payment_term_days** | **int** | [Splatnost] | [optional]
**payment_type** | **string** | [Způsob úhrady] |
**taxable_supply_date** | **string** | [Datum zdanitelného plnění] |
**business_case** | **int** | [Obchodní případ] ID záznamu obchodního případu. Pokud je vloženo jsou zkopírovány položky OP na fakturu. Není kontrolována integrita Klient - Obchodní případ - Faktura (tzn. faktura může být na jiného klienta než OP). | [optional]
**note** | **string** | [Poznámka pro příjemce] Pokud není vyplněna, použije se předvyplnění z konfigurace fakturačního modulu | [optional]
**delivery_note** | **string** | [Poznámka pro příjemce - dodací list] | [optional]
**private_note** | **string** | [Poznámka interní] | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
