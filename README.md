# TYPO3 pluploadfe_powermail

A TYPO3 CMS extension providing an integration of EXT:pluploadfe into EXT:powermail

**Features**

* New Powermail form type
* Pluploadfe configuration for each form type element
* PHP validation (using a Powermail validator)
* Email attachment (using a Powermail signal / slot)
* Basic export and BE module support (using a Powermail data processor)
* Upload on form submit (using a Java-Script plugin, jQuery needed!)



## Installation

* Install extension using composer or TER
* Add static TypoScript template (after EXT:pluploadfe and EXT:powermail)
* Adjust TypoScript configuration as needed
* Adjust JavaScript / CSS as needed (see includes in TypoScript)
* Adjust template as needed


## Todo & Known bugs

Please see Github Issues: https://github.com/fnagel/pluploadfe_powermail/issues

* Full integration with Powermail's file handling
* Support for Powermail's AJAX submit functionality
* Use Powermail frontend validation for JS validation
* Support for EXT:powermail_cond



## Contribution

Any help is appreciated. Please feel free to drop me a line, open issues or send pull requests.



## Sponsoring

The initial development of this extension has been sponsored by BECKER media - https://www.beckermedia.de/



## Donation

Please consider a donation: https://www.felixnagel.com/donate/
