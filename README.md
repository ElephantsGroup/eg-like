To use Elephants Group like module first you must install module, then you can use like widget anywhere in your website.

Installation Steps:
===

1) run
> php composer.phar require elephantsgroup/eg-like "*"

or add `"elephantsgroup/eg-like": "*"` to the require section of your composer.json file.

2) migrate database
> yii migrate --migrationPath=vendor/elephantsgroup/eg-like/migrations

3) add like module to common configuration (common/config.php file)

```'modules' => [
    ...
    'like' => [
        'class' => 'elephantsGroup\like\Module',
    ],
    ...
]```

4) open access to module in common configuration

```'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        ...
        'like/ajax/*',
        ...
    ]
]```

5) filter admin controller in frontend configuration (frontend/config.php file)

```'modules' => [
    ...
    'like' => [
        'as frontend' => 'elephantsGroup\like\filters\FrontendFilter',
    ],
    ...
]```

5) filter ajax controller in backend configuration (backend/config.php file)

```'modules' => [
    ...
    'like' => [
        'as backend' => 'elephantsGroup\like\filters\BackendFilter',
    ],
    ...
]```

Using like widget
===

Anywhere in your code you can use like widget as follows:
```<?= Likes::widget() ?>```

You need to use Likes widget header in your page:
```use elephantsGroup\like\components\Likes;```

Like widget parameters
---

- item (integer): to separate likes between different items.
```<?= Likes::widget(['item' => 1]) ?>```
```<?= Likes::widget(['item' => $model->id]) ?>```

default value for item is 0
- service (integer): to separate likes between various item types.
```<?= Likes::widget(['service' => 1, 'item' => $model->id]) ?>```

for example you can use different values for different modules in your app, and then use like widget separately in modules.
default value for service is 0
- color (string): color of unliked icon heart, default 'black'
```<?= Likes::widget(['service' => 1, ''item' => $model->id, 'color' => 'yellow']) ?>```

- view_file (string): the view file path for rendering

```<?= Likes::widget([
    'service' => 1,
    'item' => $model->id,
    'color' => 'yellow',
    'view_file' => Yii::getAlias('@frontend') . '/views/like/widget.php'
]) ?>```

you can use these variables in your customized view:
* service
* item
* color
* is_like
