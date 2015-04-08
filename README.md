Albums thing in Zend 1.12

## Getting started

Bootstrapped using the http://phansible.com/

You will need VirtualBox, Vagrant and Ansible installed.

Run `vagrant up`

```
Zend latest actually has a github repo with a provisioning Vagranfile using puppet.
That said, initial impression is that's for developing the framework itself rather than project development.
Worth considering using it as a submodule though.
```

There is some manual config needed as the provisioner isn't complete. See `ansible/roles/app/tasks/main.yml`


## DB

The DB needs manual setup and seeding. Two files are provided in `zf-app/db`. One for setting up the schema, and another for seeding it with data.

In an ideal world, this would be managed by migrations, e.g. https://github.com/michaelhodgins/Mooduino


## Testing

`cd zf-app/tests && phpunit`
