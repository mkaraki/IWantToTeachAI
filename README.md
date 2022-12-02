# I Want To Teach AI
Web Application for Supervised learning community

## Install

You have to install these software:
- MySQL or MariaDB
- PHP and php-mysql
- [Composer](https://getcomposer.org/)

### Install depending packages

Use [Composer](https://getcomposer.org/) to install depending packages.

```shell
composer install
```

### Setup database

Execute `db.sql` to setup database structure.

If you want to install table into database called `iwtt` by `root` user, type below command.
```shell
mysql -u root -p iwtt < db.sql
```

### Write config file

Copy `_config.example.php` to `_config.php` and write your DB connection information.

## Add new labelling target

In this application, labelling configuration is identified with unique number (1 &le; n &le; [PHP_INT_MAX](https://www.php.net/manual/en/reserved.constants.php)).

You have to decide unique number for labelling target before start this step.

**You have to replace `%identifier%` with your decided unique number**.

### Create labelling target directory

Create `dataset/%identifier%` and `dataset/%identifier%/src`.

```shell
mkdir -p dataset/%identifier%/src
```

## Create labelling configuration file

Put configuration file into `dataset/%identifier%/config.php`

See [wiki](https://github.com/mkaraki/IWantToTeachAI/wiki/Labelling-configuration) for configuration format.

## Usage

### Labelling

Access `/teach.php?tid=%identifier%` to labelling.

Source file will randomly chosen.

#### Specify source file

Access `/teach.php?tid=%identifier%&src=%source id%`.
`%source id%` is array index of source file.

#### Labelling from 1 to end without randomize

Access `/teach.php?tid=%identifier%&src=1&next=1`.

### Check labelled result

Access `/inspect/list.php?tid=%identifier%`
or access `/inspect/listcsv.php?tid=%identifier%` to check with csv format.

#### Filter with source id

Access `/inspect/list.php?tid=%identifier%&src=%source id%`.
`%source id%` is array index of source file.

You can get csv format data with `/inspect/listcsv.php?tid=%identifier%&src=%source id%`.
