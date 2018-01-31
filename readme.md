# DeveloperResumes

### Get help from professionals on your resume

DeveloperResumes aims to help junior developers get feedback on their resume from developers, managers and others in the tech industry. We aim to help get you the best feedback possible and give you the tools to make your resume better then it is.

### Install Steps

#### Requires Virtual Box and Vagrant


WIP

1. Fork/Clone Repo to local machine
2. Composer Install (if you dont have composer, check out [Composer](https://getcomposer.org) and install it on your machine).
3. Run `./vendor/bin/make homestead && vagrant up` to create virtual machine
4. Add `192.168.10.10` to your `/etc/hosts` file
5. `vagrant ssh` into the VM and cd to the directory. 
6. `php artisan migrate`, `php artisan passport:install`, `yarn install`, and `yarn run dev`. 
