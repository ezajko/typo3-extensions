# dkd_bsbh

    Diese Extension stellt eine Event-Liste für einmalige und regelmäßige Termine bereit.

## Plugins

Es gibt nur ein Plugin ("Eventliste")

### Plugin optionen (backend)

* Anzuzeigende Kategorien

Das Plugin zeigt eine Liste mit Events an, die den ausgewählten Kategorien entsprechen.

### url parameter

* ``tx_bsbhevents_show%5Bevent-type%5D=one-time`` einmalige Events auflisten
* ``tx_bsbhevents_show%5Bevent-type%5D=recurring`` mehrmalige Events auflisten
* ``type=110&markdown=your%20markdown`` gibt das übergebene Markdown als HTML zurück

## login handling

A frontend user can edit/create events in all listings whose plugin has at least one matching category.

### Example:
User has categories A, B, C |
Plugin has categories B,E,F

User _is_ allowed to edit all events in Plugin, because category B is matching.

### Example 2:
User has categories A, B, C |
Plugin has categories D,E,F

User _is not_ allowed to edit all events in Plugin, because no category is matching.

