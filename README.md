# Taitava/silverstripe-serverrequirementschecker

When you install SilverStripe by using the installation wizard, SilverStripe will check that the server environment meets all requirements. For example, certain PHP extensions are ensured to be available and directory writing permissions are checked. This is nice and handy. However, if you move your website/application to a new server or do some other changes to your server environment, SilverStripe by default does not provide any way to recheck the server environment's compatibility. This module simply adds a new BuildTask to your `/dev/tasks` list that you can use to recheck the requirements anytime. It runs the same tests the SilverStripe installer runs.

## Requirements

This module requires SilverStripe 4.x framework. For compatibility with SS3, use the 1.x release line.

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