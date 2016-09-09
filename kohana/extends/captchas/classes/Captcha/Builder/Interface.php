<?php
/**
 * A Captcha builder
 */
interface Captcha_Builder_Interface {
    /**
     * Builds the code
     */
    public function build($width, $height, $font, $fingerprint);

    /**
     * Saves the code to a file
     */
    public function save($filename, $quality);

    /**
     * Gets the image contents
     */
    public function get($quality);

    /**
     * Outputs the image
     */
    public function output($quality);
}

