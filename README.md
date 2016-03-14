[![Latest Stable Version](https://poser.pugx.org/bszala/scaffold/v/stable)](https://packagist.org/packages/bszala/scaffold)
[![License](https://poser.pugx.org/bszala/scaffold/license)](https://packagist.org/packages/bszala/scaffold)

# scaffold
Scaffolding utility tool for generating various templates/resources via a CLI. The goal is to speed up a package/project development


## When to use this ##

In most cases this Utility tool should be used when your start developing a new package/project. 

## How to install ##

```

composer require fenix440/scaffold 
```

This package uses [composer](https://getcomposer.org/). If you do not know what that is or how it works, I recommend that you read a little about, before attempting to use this package.


## Quick start ##

When package is installed, you can create a new template (folder structure) by calling through CLI scaffold application. 

```

scaffold 
```

Then on terminal you will see an application information with allowed attributes for this application.

In order to create a new template, You need to write as below

```

scaffold template 
```

When you hit an enter, the application will ask you to pick desire template. After selecting chosen template, 
program will generate the entire template (folder structure) in Your current directory. If You wish to create  template in another target destination, then You can provide optional path to where the new template should be installed.

```

scaffold  template path_to_target_directory
```

## License ##

Scaffold is licensed under the MIT license.
