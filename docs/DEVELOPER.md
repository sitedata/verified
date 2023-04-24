## For theme developers
### VerifiedIcon widget
The module provides a widget which returns the verified icon (or an empty string).
You can use it in your theme views as follows:

`<?= humhub\modules\verified\widgets\VerifiedIcon::widget(['container' => $user]); ?>`

#### Configuration options:

- **container** (required)  
Type: instance of User or Space  

- **icon** (optional)  
Type: string (available FontAwesome icon without leading 'fa-')  
Default: icon from module settings

- **color** (optional)  
Type: string  
Default: color from module settings  
If no color should be added, you can set `'color' => ''`

- **leadingSpace** (optional) - adds a leading space before the icon  
Type: boolean  
Default: true
