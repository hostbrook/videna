# Videna PHP Framework

PHP MVC Micro-Framework, developed by [HostBrook Ltd](https://hostbrook.com).
This fast and lightweight MVC framework was developed to use at the shared hostings for small-size projects.

- Matches [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-4](https://www.php-fig.org/psr/psr-4/), [PSR-5](https://www.php-fig.org/psr/psr-5/) and [PSR-12](https://www.php-fig.org/psr/psr-12/) Standards Recommendations.
- Comes out of the box with [PHPMailer](https://github.com/PHPMailer/PHPMailer) SMTP mailer.
- Can work with applications where Database conenction is not required.
- Pre-cocked for Maria/MySQL databases via PDO.
- Pre-coocked router, no any programming required.
- Pre-coocked AJAX Handler and Cron jobs controllers.
- Multi-language support.
- Super light: 57 kB size of framework core.

The framework's landing page is a clone of this repository: [https://videna.hostbrook.com](https://videna.hostbrook.com)

The framework's documantation: [https://github.com/hostbrook/videna/wiki](https://github.com/hostbrook/videna/wiki)

## Installation & Set Up

**Step 1.** Via Composer, install the Videna demo project in the folder **above** your project root at your local host:
```shell
composer create-project hostbrook/videna project_name
```
The command above will:
- create 'project_name' folder (if it does not exist);
- upload Videna demo project at the folder 'project_name';
- install all required dependencies.

_Note: the 'project_name' folder is a project root, but you need to setup at your hosting the Document Root: 'project_name'/public/_

**Step 2.** Update all required dependencies:
```shell
composer update
```

**Step 3.** Make your application at your local host.

**Step 4.** Upload your application to your web hosting server via private GitHub repository.

## Upgrading

Whenever there is a new release, update your application from the command line in your **project root**:
```shell
composer update
```
With this command the Videna framework core will be updated.