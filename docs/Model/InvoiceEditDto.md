# # InvoiceEditDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**company** | **int** | [Klient] Klient kterému se bude fakturovat | [optional]
**security_level** | **int** | [Bezpečnostní úroveň] ID bezpečnostní úrovně. Pokud není vyplněna je nastavena výchozí bezpečnostní skupina. | [optional]
**owner** | **int** | [Vlastník] ID kontaktní osoby, která je zároveň uživatelem | [optional]
**title** | **string** | [Název] Název faktury pro lepší dohledatelnost | [optional]
**variable_symbol** | **string** | [Variabilní symbol] | [optional]
**constant_symbol** | **string** | [Konstantní symbol] | [optional]
**specific_symbol** | **string** | [Specifický symbol] | [optional]
**currency** | **int** | [Měna] ID záznamu z číselníku Currency | [optional]
**due_date** | **string** | [Datum splatnosti] | [optional]
**issue_date** | **string** | [Datum vystavení] | [optional]
**taxable_supply_date** | **string** | [Datum zdanitelného plnění] | [optional]
**invoice_type** | **string** | [Typ faktury] | [optional]
**payment_term_days** | **float** | [Splatnost] | [optional]
**payment_type** | **string** | [Způsob úhrady] | [optional]
**business_case** | **int** | [Obchodní případ] ID záznamu obchodního případu. Není kontrolována integrita Klient - Obchodní případ - Faktura (tzn. faktura může být na jiného klienta než OP). | [optional]
**note** | **string** | [Poznámka pro příjemce] Pokud není vyplněna, použije se předvyplnění z konfigurace fakturačního modulu | [optional]
**delivery_note** | **string** | [Poznámka pro příjemce - dodací list] | [optional]
**private_note** | **string** | [Poznámka interní] | [optional]
**vendor_name** | **string** | [Dodavatel - Jméno klienta] | [optional]
**vendor_reg_number** | **string** | [Dodavatel - IČ] | [optional]
**vendor_tax_number** | **string** | [Dodavatel - DIČ] | [optional]
**vendor_address** | [**\RaynetApiClient\Model\InvoiceEditDtoVendorAddress**](InvoiceEditDtoVendorAddress.md) |  | [optional]
**vendor_email** | **string** | [Dodavatel - Email] | [optional]
**vendor_fax** | **string** | [Dodavatel - Fax] | [optional]
**vendor_phone_number** | **string** | [Dodavatel - Telefon] | [optional]
**vendor_website** | **string** | [Dodavatel - Web] | [optional]
**vendor_bank_name** | **string** | [Dodavatel - Název banky] | [optional]
**vendor_bank_account_number** | **string** | [Dodavatel - Číslo účtu] | [optional]
**vendor_bank_iban** | **string** | [Dodavatel - IBAN] | [optional]
**vendor_bank_swift** | **string** | [Dodavatel - SWIFT] | [optional]
**vendor_business_register_note** | **string** | [Dodavatel - Zapsán v rejstříku] | [optional]
**billing_name** | **string** | [Odběratel - Jméno klienta] | [optional]
**billing_reg_number** | **string** | [Odběratel - IČ] | [optional]
**billing_tax_number** | **string** | [Odběratel - DIČ] | [optional]
**billing_address** | [**\RaynetApiClient\Model\InvoiceEditDtoBillingAddress**](InvoiceEditDtoBillingAddress.md) |  | [optional]
**items** | [**\RaynetApiClient\Model\InvoiceEditDtoItemsInner[]**](InvoiceEditDtoItemsInner.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
