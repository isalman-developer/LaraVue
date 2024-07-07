## Using Dynamic Settings in our Application, Cache, Config

1. Create a helper functions `function setting($key) {}` where we will get the setting for that specific key and will be returned back its value.

2. so each time we call this setting function in helper this will query the databse which is costly. so to avoid this we will user __Cache__ mechanism for this. i.e

    ```
    $settings = Cache::rememberForever('settins', function () {
        return Setting::pluck('value', 'key')->all();
    });
    ```

3. we will also fluch the cache after the setting is update so after getting the setting also we will cache it again.


## What if there are no settings in our database as well as in cache then we will get it from config file settings

1. So first create a config file `settings.php` and store the defult setting in it.

2. also add a check if there are no settings in cache or in database then load them from config file __settings__

3. also add another check inside __SettingController__  `index` function if there are no settings then load them form config file to fill out the form of update settings. when we update the form then all of the settings will be inserted again.
