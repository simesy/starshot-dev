# A Starshot flavoured Project Browser setup

A project that can be used to develop Starshot stuff including
Project Browser. Should allow you to install projects through
the UI.

## Notes

* This is not Starshot.
* I disable DDEV "settings management" but it should still "just work".
* If you want to override any settings use `web/sites/default/local.settings.php`.
* Project browser and friends are installed in `web/modules/contrib`, so ...
* Be aware that a composer update/install *may* wipe any dev work you are doing there.

## The Drupal build

The `config/sync` directory has all the config to install project_browser and package_manager
on top of the Drupal standard profile. Insalling projects directly through the browser works
for me (it will update your composer.json and add the module).

```
git clone git@github.com:simesy/starshot-dev.git 
cd starshot-dev
ddev start
ddev composer install
ddev drush si minimal --existing-config -y
ddev drush uli
```

## Svelte app

This is the app the runs when you visit `/admin/modules/browse`. If you modify
the app and rebuild it, remember to commit the compiled results of the build.

```
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs install
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs build
```
