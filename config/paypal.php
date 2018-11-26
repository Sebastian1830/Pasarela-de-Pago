<?php
return array(
    // set your paypal credential
    'client_id' => 'AQZCa9BWMGJs8itFr1oxI-HUP9balbhL9segGMXHEOxlz3CEtUEY7KFPxrGc7u-B9IrvqPzmsu1FrFW-',
    'secret' => 'EDNG4ZwR_D9ejCrfPGgPwp5Cq1hTakKDhTi2u-6ftsjsRTW9tAaPDnbYqjbll14caZBHMpGCAVn37ldl',
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