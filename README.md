# moodle-helper-plugin

This plugin is designed to be the bridge between the VATSIM E-Learning Site and other systems to provide a way to indicate a member has completed a P0 Exam.

## Installation

The installation of this plugin is based on your own specs for moodle. 


## Configuation

Those who wish to use this plugin need to set the follow properties:

### ``config.php:``

Within the config.php, the following needs to be set:

```php
$CFG->vatsim_api_key = getenv('VATSIM_API_KEY');
```

This will set the API key for the request within the event handler allowing the http request to go though.

### ``.env``

The following needs to be set within the .env file:

```.dotenv
VATSIM_API_KEY: XXXX
```

This will ensure that the config paramater will have something to read.

### ``Site Admin -> Local Plugins -> VATSIM API Helper Settings Page``

The following needs to be set within the plugin settings page to ensure proper usage of the http request:

``API URL``

This will set the URL at which the http request is made.

``Quiz ID``

This sets the quiz ID so that not every quiz is being used for this plugin, only the P0 exam that is in use.

## Contributing

If you would like to contribute, you may do so by cloning the repo and submitting a pull request with any changes you want to make.

