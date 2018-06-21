<?php

//return [
//    'driver' => \Belt\Menu\Drivers\TermMenuDriver::class,
//    'plugin' => 'plugin-menu-item-term',
//    'params' => [
//        'terms' => null,
//        'show_children' => true,
//    ]
//];

return [

    // The human-readable name of your template.
    'label' => '',

    // A short description of template.
    'description' => '',

    // A driver class that extends \Belt\Menu\Drivers\BaseMenuDriver,
    // that will run custom code for the menu item
    'driver' => \Belt\Menu\Drivers\TermMenuDriver::class,

    /*
    | A set of custom parameters that belong to the templatable object.
    |
    | Each parameters has the following configuration options:
    |
    | @type:        Required. The type of input to be used in the admin UX,
    |               ie: text, textarea, select, editor or other properly added custom values.
    |
    | @label:       The human-readable name of the parameter.
    |
    | @description: A short description of parameter.
    |
    | @options:     The list of available options where type="select". Option keys are machine-readable.
    |               Option values will be used as human-readable labels.
    */

    'params' => [

    ],

];