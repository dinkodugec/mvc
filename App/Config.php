<?php

    namespace App;

 /*    Apication configuration */

 class Config
 {
 
     /**
      * Database host
      * @var string
      */
     const DB_HOST = 'localhost';
 
     /**
      * Database name
      * @var string
      */
     const DB_NAME = 'mvc';
 
     /**
      * Database user
      * @var string
      */
     const DB_USER = 'mvcuser';
 
     /**
      * Database password
      * @var string
      */
     const DB_PASSWORD = 'ronbetelges';
 
     /**
      * Show or hide error messages on screen
      * @var boolean
      */
     const SHOW_ERRORS = true;

        /**
     * Secret key for hashing
     * @var boolean
     */
    const SECRET_KEY = 'S0MYpu1Ulp9yezp4TdjTD40KHEnamwnD';

     /**
     * Mailgun API key
     *
     * @var string
     */
    const MAILGUN_API_KEY = '';

    /**
     * Mailgun domain
     *
     * @var string
     */
    const MAILGUN_DOMAIN = '';
 }