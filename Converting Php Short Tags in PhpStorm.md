# Converting PHP Short Tags in PhpStorm

Sometimes you come across a project where short tags have been used in php. This guide is written for PhpStorm but
the underlying principles would be the same for any IDE which allows regex searching and replacing.

The short tags we want to resolve;
```php
<? $myString = 'Hello World' ?>
<?= $myString ?>
```

## Short Echo Tags 
First we need to find all the short php echo tags. Do a global search in PHP, make sure he file type filter is on and
it's set to PHP as this will limit any other files from being affected by the replace. Place the following Find and
Replace values in PhpStorm (excluding the quote marks). You can then either replace all or replace one by one depending
on your preference.

Find: '<\?='   
Replace: '<?php echo ' (remember to include the space)

## Normal Short Tags
Secondly we need to replace the normal short tags. Place the following Find and Replace values in PhpStorm
(excluding the quote marks). You can then either replace all or replace one by one depending on your preference.

Find: '<\?(\s)'   
Replace: '<?php$1 ' (remember to include the space)
