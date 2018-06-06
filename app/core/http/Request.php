<?php

namespace app\core\http;

use app\core\validation\Validator;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

/**
 * Description of Request
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Request extends BaseRequest implements \ArrayAccess
{

    private $convertedFiles;

    /**
     * Create a new Illuminate HTTP request from server variables.
     *
     * @return static
     */
    public static function capture()
    {
        static::enableHttpMethodParameterOverride();

        return static::createFromBase(BaseRequest::createFromGlobals());
    }

    public static function createFromBase(BaseRequest $request)
    {
        if ($request instanceof static) {
            return $request;
        }
        $content = $request->content;
        $request = (new static())->duplicate($request->query->all(), $request->request->all(), $request->attributes->all(), $request->cookies->all(), $request->files->all(), $request->server->all());
        $request->content = $content;
        $request->request = $request->getInputSource();
        return $request;
    }

    /**
     * Get the input source for the request.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected function getInputSource()
    {
        if ($this->isJson()) {
            return $this->json();
        }

        return $this->getMethod() == 'GET' ? $this->query : $this->request;
    }

    /**
     * Determine if the request is sending JSON.
     *
     * @return bool
     */
    public function isJson()
    {
        return $this->contains($this->headers->get('CONTENT_TYPE'), ['/json', '+json']);
    }

    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the JSON payload for the request.
     *
     * @param  string $key
     * @return mixed
     * @internal param mixed $default
     */
    public function json($key = null)
    {
        if (!isset($this->json)) {
            $this->json = new ParameterBag((array)json_decode($this->getContent(), true));
        }

        if (is_null($key)) {
            return $this->json;
        }

//    return data_get($this->json->all(), $key, $default);
        return ($this->json->all());
    }

    /**
     * Determine if the request is the result of an AJAX call.
     *
     * @return bool
     */
    public function isAjax()
    {
        return $this->isXmlHttpRequest();
    }

    /**
     * Check if an input element is set on the request.
     *
     * @param  string $key
     * @return bool
     */
    public function __isset($key)
    {
        return !is_null($this->__get($key));
    }

    public function __get($key)
    {
        $all = $this->all();

        if (array_key_exists($key, $all)) {
            return $all[$key];
        } else {
            return $this->get($key);
        }
    }

    /**
     * Get all of the input and files for the request.
     *
     * @return array
     */
    public function all()
    {
        return array_replace_recursive($this->input(), $this->allFiles());
    }

    /**
     * Retrieve an input item from the request.
     * @return array|string
     * @internal param string $key
     * @internal param array|null|string $default
     */
    public function input()
    {
        $input = $this->getInputSource()->all() + $this->query->all();
        return $input;
//    return data_get($input, $key, $default);
    }

    /**
     * Get an array of all of the files on the request.
     *
     * @return array
     */
    public function allFiles()
    {
        $files = $this->files->all();
        return $this->convertedFiles ? $this->convertedFiles : $this->convertedFiles = $this->convertUploadedFiles($files);
    }

    /**
     * Convert the given array of Symfony UploadedFiles to custom Laravel UploadedFiles.
     *
     * @param  array $files
     * @return array
     */
    protected function convertUploadedFiles(array $files)
    {
        return array_map(function ($file) {
            if (is_null($file) || (is_array($file) && empty(array_filter($file)))) {
                return $file;
            }

            return is_array($file) ? $this->convertUploadedFiles($file) : UploadedFile::createFromBase($file);
        }, $files);
    }

    /**
     * Get the session associated with the request.
     *
     *
     * @throws \RuntimeException
     */
    public function session()
    {
        if (!$this->hasSession()) {
            throw new \RuntimeException('Session store not set on request.');
        }

        return $this->getSession();
    }

    public function isValid($rules)
    {
        $validator = new Validator($this->all(), $rules);
        if ($validator->passes())
            return true;
        return $validator->errors()->getMessages();
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {

    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {

    }
    /**
     * Retrieve a file from the request.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile|array|null
     */
    public function file($key = null, $default = null)
    {
        return data_get($this->allFiles(), $key, $default);
    }
}
