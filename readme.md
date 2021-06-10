# Videna PHP Framework

PHP MVC Framework, developed by [HostBrook Ltd](https://hostbrook.com).
This fast and lightweight MVC framework was developed to use at the shared hostings for small-size projects.

## Installation & Set Up

**Step 1.** Via Composer, install the Videna demo project in the folder **above** your project root at your local host:
```shell
composer create-project hostbrook/videna <project-name>
```
The command above will:
- create <project-name> folder (if it does not exist);
- upload Videna demo project at the folder <project-name>;
- install all required dependencies.

_Note: the <project-name> folder is a project root, but you need to setup at your hosting the Document Root: <project-name>/public/_

**Step 2.** Update all required dependencies:
```shell
composer update
```

**Step 3.** Make your application

**Step 4.** Upload your application to the web hosting.

## Upgrading

Whenever there is a new release, then from the command line in your **project root**:

```shell
composer update
```