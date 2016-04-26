<?php

namespace DtlSocial;

return [
    'hybridconfig' => array(
        "base_url" => "http://acacio.com/vendor/hybridauth/hybridauth/src",
        "providers" => array(
            "Facebook" => array(
                "enabled" => true,
                "keys" => array("id" => "", "secret" => ""),
                "trustForwarded" => false
            ),
            "Twitter" => array(
                "enabled" => true,
                "keys" => array("key" => "2vvwfEL3XHbwHaS301lA8tO2h", "secret" => "TXQWk7iRYcBVnwHCnJ2GBY9BvEqKznU5gaiWXGu5R03KL1WVHn"),
                "includeEmail" => true
            ),
            "Instagram" => array(
                "enabled" => true,
                "keys" => array("key" => "49c77d8c37bb4dc2a909f192a196531b", "secret" => "7d8d0a4fa1a54afbb4a973079258dc54")
            ),
        ),
        // If you want to enable logging, set 'debug_mode' to true.
// You can also set it to
// - "error" To log only error messages. Useful in production
// - "info" To log info and error messages (ignore debug messages)
        "debug_mode" => false,
        // Path to file writable by the web server. Required if 'debug_mode' is not false
        "debug_file" => "",
    )
];
