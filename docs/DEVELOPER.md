## For theme developers
The module provides a widget which returns the verified icon (or an empty string).
You can use it in your theme views as follows:

`<?= humhub\modules\verified\widgets\VerifiedIcon::widget(['container' => $space]); ?>`

By default a space is added before the icon, you can add `'leadingSpace' => false` to prevent that.
