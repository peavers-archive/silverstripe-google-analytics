## Synopsis

Very basic module which was designed to load Google Analytics in a standard manner on all websites. 

## Features
* A single text field can accept both Google Tag Manager and Universal Analytics codes
* Javascript is loaded into the template with no changes required to theme files
* Removes the default CWP GA text field to avoid confusion

## Installation

### Composer

Make sure you've removed all Google Analytics code from your template/ 

Ideally composer will be used to install this module. 
```composer require "moe/google-analytics:@stable"```

## CMS Setup/Usage

### Set Google code
* In the CMS under settings is a tab called "Google Analytics" There is a single text field in this tab which accepts
either a Universal or Tag Manager formatted code
 
