# Taitava/silverstripe-serverrequirementschecker

When you install SilverStripe by using the installation wizard, SilverStripe will check that the server environment meets all requirements. For example, certain PHP extensions are ensured to be available and directory writing permissions are checked. This is nice and handy. However, if you move your website/application to a new server or do some other changes to your server environment, SilverStripe by default does not provide any way to recheck the server environment's compatibility. This module simply adds a new BuildTask to your `/dev/tasks` list that you can use to recheck the requirements anytime. It runs the same tests the SilverStripe installer runs.

Note that for SS3, a copy-pasted version of `InstallRequirements` class is used. This class is originally presented in SilverStripe framework, but it's tied together with the installation script, so I needed to extract it. The situation is better in SS4 where the class has already been extracted from the installation script, which is why this "hack" does not appear in the 2.x release line of this module.

## Requirements

This module requires SilverStripe 3.x framework. For compatibility with SS4, use the 2.x release line.

## Usage

### 1. Install the module using composer
```bash
composer require "taitava/silverstripe-serverrequirementschecker:*"
php vendor/silverstripe/framework/cli-script.php dev/build flush=all
```

### 2. Test the environment requirements in browser

For this to work you need to be logged in as an administrator user. Visit the following url: http://*website url*/dev/tasks/Taitava-ServerRequirementsChecker-ServerRequirementsCheckerTask

### 3. Alternatively use a terminal for testing

```bash
php vendor/silverstripe/framework/cli-script.php /dev/tasks/Taitava-ServerRequirementsChecker-ServerRequirementsCheckerTask
```


## Future plans
 - None at the moment.

Have your own ideas? Please let me know in the issues! :) Pull requests are also welcome.

## Author

Jarkko Linnanvirta
jarkko@taitavasti.fi