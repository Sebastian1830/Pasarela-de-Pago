<?php
return array(
    // set your paypal credential
    'client_id' => 'AcIhh8SpAOXuSiEop7ugeSmJfXaDOTRlAuy_X9gA9TN4OeFfq8dwG6BnRF1nTEmhjo9Fcm_C7OGLfilr',
    'secret' => 'EOjVE0BlNo0AxQbRG96ogTfEZYUIaEOyiHLbAH_6nzMHY8XPZDrs5qUOsohNI2Dk00erwuGOnj6LTg6I',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);