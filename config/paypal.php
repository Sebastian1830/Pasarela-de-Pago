<?php
return array(
    // set your paypal credential
    'client_id' => 'AYLRIB-EZe-C0XmEPK5rXzpZGJKFzNibmshCZJHVXpPIT2QgZ2_a-TKLwDiRghJT8afRrBSS1aCzcCtl',
    'secret' => 'EIZQ0AyZ0v1d-j_h84RwoSDqfjZM94sxyBrJzinUPf85nkT7wEgpvSIC9F2ZsK9C2kw-SNOsZl1g0b4T',
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