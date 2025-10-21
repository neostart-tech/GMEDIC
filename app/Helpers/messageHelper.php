<?php
if (!function_exists('errorAlert')) {
    /**
     * @param string $message
     * @param string $describedby
     * @return string|null
     */
    function errorAlert(string $message, string $describedby = 'emailHelp'): string|null
    {
        return "<small id=" . $describedby . " class='form-text text-danger'>" . $message . "</small>";
    }
}
