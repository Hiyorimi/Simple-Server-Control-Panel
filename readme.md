# Simple Server Control Panel

PHP Script that displays server status and provides hook to reboot / shutdown server. This is fast and dirty solution, working out of the box. You might want to set-up key-based authentication for ssh. 

SSH works through libssh2 PHP module, which should be installed with:

```
apt-get install libssh2-php
service apache2 restart
```

## Installation
- Clone this repo in your web folder.
- Add your servers ip to the config.php
- Add your remote server username + password, or set up a key authentication

Example :

```
$_REMOTE_USER = 'your-username';
$_REMOTE_PASS = 'your-secure-password';
$hosts = [
'10.10.20.1',
'10.10.20.2',
'10.10.20.3',
'10.10.20.4'
];
``` 
- Access the index.php page.

## Securing an installation
This panel doesn't have any permission system, so one might want to secure an installation with setting up a [password authentication](https://www.digitalocean.com/community/tutorials/how-to-set-up-password-authentication-with-apache-on-ubuntu-14-04).

## Screenshot

![Main](https://github.com/Hiyorimi/Simple-Server-Control-Panel/raw/master/img/screen.png)

