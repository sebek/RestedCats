<?php namespace RestedCats\Helpers;

class Response
{
    /**
     * Takes a response as a string or an array.
     * If it's an array it will be converted to a json string.
     *
     * Will also set the http response code.
     * Defaults to 200.
     *
     * @param $response
     * @param int $code
     *
     * @return string
     */
    public function send($response, $code = 200)
    {
        if (is_array($response)) {
            $response = json_encode($response);
        }

        http_response_code($code);
        return $response;
    }
}