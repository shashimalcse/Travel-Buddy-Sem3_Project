<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
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
    const DB_NAME = 'mvclogin';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '1234Shashi@';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;


    const SECRET_KEY = 'mAzoou9aJGWfM7Pyrjrcm7I2dmMbFFsW';


    const MAILGUN_API_KEY = 'bbb1cf7b7b48bfa95a0d9d3afa2c35d5-4a62b8e8-26887a16';


    const MAILGUN_DOMAIN = 'sandbox6cabec0a08a744f196b7a3b4219afdee.mailgun.org';
}