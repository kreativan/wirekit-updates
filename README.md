# WIREKIT Updates
This is main WireKit updates repo. To install updates just download the repo or releas (if available), upload .zip contents to your website `/site/` folder and confirm replace. Please take a backup before replacing the files.

#### `v0.101-alpha`
```
* Removed SeoMaestro
* Handle meta in seting() and head() functions...
```
*WireKit still supports SeoMaestro, but not default option any more. If you want to use new wirekit meta, you need to delete `_meta.php` file in templates root, and optionaly set meta defaults in _init.php `setting()`*.
``` 
// _init.php

setting([
  ...
  "meta" => [
    "title" => $page->title,
    "description" => "",
    "image" => "",
    "generator" => "wirekit.dev",
  ],
  ...
])
```