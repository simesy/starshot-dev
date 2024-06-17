# A Starshot flavoured Project Browser (etc) setup for local development

A project that can be used to develop Starshot stuff, but mainly
Project Browser. Following the instructions should allow you to install
projects through the UI.

This is not Starshot nor the recommended way to work on Starshot modules.
But you're welcome to read, use, learn, etc. The goal of putting
something like this up is for learning (and helping me remember how to 
do things between context switching).

## General Drupal settings

* I disable DDEV "settings management" but it should still "just work".
* If you want to override any settings use `web/sites/default/local.settings.php`.

## Building

The `config/sync` directory has all the config to install project_browser
and package_manager on top of the Drupal standard profile.

```
git clone git@github.com:simesy/starshot-dev.git 
cd starshot-dev
ddev start
ddev composer install
ddev drush si minimal --existing-config -y
ddev drush uli
```

If everything worked correctly you can login and start installing projects
directly through the UI. This will update the root composer.json
so sometimes I reset it and re-run composer install to remove those projects
that have been added.

## Patching and issue forks

You can follow the instructions in Drupal issues to fetch and checkout branches.
Be aware that composer isn't doing any dependency checking in this case so you
need to be aware of that.

If you use composer patches plugin to patch `project_browser`, the plugin will
nuke the module (and any branches you've created). So I don't use patches, I
just checkout branches and add issue forks, etc.

## Svelte app

This is the app the runs when you visit `/admin/modules/browse`. DDEV has
a yarn command that is suitable for this.

```
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs install
ddev yarn --cwd ./web/modules/contrib/project_browser/sveltejs build
```

If you modify the app and rebuild it, remember to commit the compiled
results of the build as there is no build step anywhere else.

## Testing

I'm constantly comparing what other projects and tooling are doing, notably 
[ddev/ddev-drupal-contrib](https://github.com/ddev/ddev-drupal-contrib).

So these commands are like fallback commands, I don't always use them like
this, but if I've been AFK for a while they are good to mentally ground me.
That's why they are all running in the container with no shortcuts.

FWIW I've also been playing with putting these commands in composer.json, so
you can check the scripts section and `ddev composer run-script ...`). 

### PHP CodeSniffer

The phpcs.xml in the root directory matches gitlab, so you just need to run phpcs
from the repo root

```
ddev ssh
./vendor/bin/phpcs web/modules/contrib/project_browser --ignore=sveltejs
```

### PHP Stan

You need the phpstan.neon from the project_browser root. So if you run
the command from that directory it will pick up that context.

```
ddev ssh
cd web/modules/contrib/project_browser
../../../../vendor/bin/phpstan analyse .
```

### PHPUnit

The root phpunit.xml matches Gitlab so you can just pass a path to to it.

```
# Bunch of tests.
ddev ssh
./vendor/bin/phpunit web/modules/contrib/project_browser/tests/src/Kernel
```

```
# Usually you just want to run one test though.
ddev ssh
./vendor/bin/phpunit web/modules/contrib/project_browser/tests/src/FunctionalJavascript/ProjectBrowserInstallerUiTest.php --filter=testPackageManagerWarningAllowsDownloadInstall
```

## Performance

Uses the [tyler36/ddev-xhgui]https://github.com/tyler36/ddev-xhgui) plugin.

```
# Enable profiling.
ddev xhprof
ddev st # Shows you the XHProf dashboard URL.
```

Run some pages and see the results on the dashboard 
