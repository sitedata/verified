# [HumHub](https://www.humhub.com/en) Verified Accounts

Verify your HumHub users with a verified tick on their profiles.

### To-Does
- Notify user if account is verified

### Credits
[Green Meteor](https://github.com/GreenMeteor)

[Felix Hahn](https://github.com/felixhahnweilheim)

### For theme developpers
The module provides a widget which returns the verified icon (or an empty string).
You can use it in your theme views as follows:

`<?= humhub\modules\verified\widgets\VerifiedIcon::widget(['container' => $space]); ?>`
