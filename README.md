# A project with starshot enablers ready to dev.

Notes
* I tend to disable settings management with DDEV. The *.settings.php should "just work". 

## Drupaul

The config/sync basically includes enabled project_browser, automatic_updates
and some setting. The rest is just a standard profile install. I export
the snapshot now and then.

```
git clone git@github.com:simesy/starshot-dev.git 
cd starshot-dev
ddev start
ddev composer install
ddev drush si minimal --existing-config -y
ddev drush uli
```

## App

Remember to commit the results of the build.

```
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs install
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs build
```
