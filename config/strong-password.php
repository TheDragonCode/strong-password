<?php

return [
    /*
     * The minimum allowed number of characters in the password is specified.
     *
     * Moreover, the length of the password cannot be less than 10 characters.
     */

    'min_length' => 10,

    /*
     * The set of rules called when using the `Password::validate()` method.
     *
     * By default, `psw_strong`.
     */

    'rules' => [
        // 'psw_letters',
        // 'psw_case_diff',
        // 'psw_numbers',
        // 'psw_symbols',
        // 'psw_min_length',
        'psw_strong',
    ],
];
