# dkd_bsbh

    This extension provides an event listing for one time and recurring events

## plugins

One plugin is provided ("Eventliste")

### plugin options (backend)

* categories to show

The plugin will show events which have at least one of the selected category.

### possible url parameters

* ``tx_bsbhevents_show%5Bevent-type%5D=one-time`` shows one time events
* ``tx_bsbhevents_show%5Bevent-type%5D=recurring`` shows recurring events
* ``type=110&markdown=your%20markdown`` returns the given markdown as HTML

## login handling

A frontend user can edit/create events in all listings whose plugin has at least one matching category.

### Example:
User has categories A, B, C |
Plugin has categories B,E,F

User _is_ allowed to edit all events in Plugin, because category B is matching.

### Example 2:
User has categories A, B, C |
Plugin has categories D,E,F

User _is not_ allowed to edit any event in Plugin, because no category is matching.

