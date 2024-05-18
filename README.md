# A project with project_browser in dev branch.

Notes
* I disable settings management in DDEV. Using settings the way i like them, settings.php should just work. 

## Drupaul

```
git clone git@github.com:simesy/starshot-dev.git 
cd starshot-dev
ddev start
ddev composer install
ddev drush en project_browser
ddev drush uli
```

## App

Remember to commit the results of the build.

```
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs install
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs build
```
