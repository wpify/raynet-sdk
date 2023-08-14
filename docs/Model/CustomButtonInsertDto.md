# # CustomButtonInsertDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**entity_name** | **string** | [Název entity, ke které se volitelné tlačítko zobrazí] - &#x60;Company&#x60; Klient - &#x60;Person&#x60; Kontaktní osoba - &#x60;Lead&#x60; Lead - &#x60;BusinessCase&#x60; Obchodní případ - &#x60;Offer&#x60; Nabídka - &#x60;SalesOrder&#x60; Objednávka - &#x60;Project&#x60; Projekt - &#x60;Product&#x60; Produkt - &#x60;PriceList&#x60; Ceník - &#x60;Invoice&#x60; Faktura - &#x60;Task&#x60; Úkol - &#x60;Meeting&#x60; Schůzka - &#x60;Event&#x60; Událost - &#x60;Email&#x60; E-mail - &#x60;PhoneCall&#x60; Telefonát - &#x60;Letter&#x60; Dopis - &#x60;MassEmail&#x60; Hromadný e-mail |
**app_class** | **string** | [Typ pohledu, kde se volitelné tlačítko zobrazí] - &#x60;DetailView&#x60; Detailní pohled - &#x60;ListView&#x60; Seznamový pohled - &#x60;MainMenu&#x60; Hlavní menu |
**name** | **string** | [Název vlastního tlačítka] |
**description** | **string** | [Popis vlastního tlačítka] Dostupné jen pro &#x60;appClass&#x3D;ListView&#x60; nebo &#x60;appClass&#x3D;DetailView&#x60;. | [optional]
**type** | **string** | [Typ akce] - &#x60;AJAX&#x60; Asynchronní požadavek - &#x60;DOWNLOAD&#x60; Stažení souboru - &#x60;OPEN_URL&#x60; Otevření URL adresy do nové záložky |
**method** | **string** | [Typ http požadavku] Dostupné jen pro &#x60;type&#x3D;AJAX&#x60; nebo &#x60;type&#x3D;DOWNLOAD&#x60;. - &#x60;GET&#x60; - &#x60;POST&#x60; - &#x60;PUT&#x60; - &#x60;DELETE&#x60; | [optional]
**url** | **string** | [Šablona URL adresy] | [optional]
**success_title** | **string** | [Titulek zprávy po úspěšném vykonání akce] Dostupné jen pro &#x60;type&#x3D;AJAX&#x60;. | [optional]
**success_message** | **string** | [Text zprávy po úspěšném vykonání akce] Dostupné jen pro &#x60;type&#x3D;AJAX&#x60;. | [optional]
**refresh** | **int** | [Obnovit data po (čas v ms)] Dostupné jen pro &#x60;appClass&#x3D;DetailView&#x60; nebo &#x60;appClass&#x3D;ListView&#x60;. | [optional]
**admin** | **bool** | [Viditelné jen pro administrátora] | [optional]
**confirm** | **bool** | [Vyžadovat potvrzení před spuštěním] | [optional]
**open_type** | **string** | [Způsob otevření url odkazu] Dostupné jen pro &#x60;type&#x3D;OPEN_URL&#x60;. - &#x60;OPEN_TAB&#x60; V nové záložce - &#x60;OPEN_WINDOW&#x60; V novém okně | [optional]
**open_type_window_width** | **int** | [Šířka nově otevřeného okna] Dostupné jen pro kombinaci &#x60;type&#x3D;OPEN_URL&#x60; a &#x60;openType&#x3D;OPEN_WINDOW&#x60;. | [optional]
**open_type_window_height** | **int** | [Výška nově otevřeného okna] Dostupné jen pro kombinaci &#x60;type&#x3D;OPEN_URL&#x60; a &#x60;openType&#x3D;OPEN_WINDOW&#x60;. | [optional]
**open_type_window_refresh** | **bool** | [Obnovit data po zavření okna] Dostupné jen pro kombinaci &#x60;type&#x3D;OPEN_URL&#x60;, &#x60;openType&#x3D;OPEN_WINDOW&#x60; a &#x60;appClass&#x3D;DetailView&#x60; nebo &#x60;appClass&#x3D;ListView&#x60;. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
