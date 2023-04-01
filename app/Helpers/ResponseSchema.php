<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class ResponseSchema implements Arrayable, Jsonable
{
    /** @var int */
    public $status = 200;

    /** @var string */
    public $code = "ok";

    /** @var mixed */
    public $result = null;

    /** @var string */
    public $message = null;

    /** @var string */
    public $metadatas = null;

    public function __construct(
        int $status = 200,
        $code = "ok",
        $result = null,
        string $message = null,
        $metadatas = null,
    ) {
        $this->fill([
            'status' => $status,
            'code' => $code,
            'result' => $result,
            'message' => $message,
            'metadatas' => $metadatas,
        ]);
    }

    public function fill(array $attrs)
    {
        $this->status = $attrs['status'];
        $this->code = $attrs['code'];
        $this->result = $attrs['result'];
        $this->message = $attrs['message'];
        $this->metadatas = $attrs['metadatas'];
    }

    public static function create(
        int $status = 200,
        $code = "ok",
        $result = null,
        string $message = null,
        $metadatas = null,
    ) {
        return new self($status, $code, $result, $message, $metadatas);
    }

    public function send($status = 200, array $headers = [])
    {
        $this->status = $status;
        return response($status, $headers)->json($this->toArray(), $status);
    }

    /**
     * Return the response has error
     */
    public function error(
        int $status = 400,
        string $code = 'unknown_error',
        string $message = null,
    ) {
        $this->code = $code;
        $this->status = $status;
        $this->message = $message ? $message : $this->message;

        return response($status)->json($this->toArray(), $status);
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'code' => $this->code,
            'result' => $this->result,
            'message' => $this->message,
            'metadatas' => $this->metadatas,
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function __call(string $method, array $args)
    {
        if (preg_match('#^with#i', $method) < 1) {
            throw new \RuntimeException("$method is not a property of $this.", 1);
        }

        $attr = strtolower(str_replace('with', '', $method));

        if (!property_exists($this, $attr)) {
            throw new \RuntimeException("$attr is not a property of $this.", 2);
        }

        $this->$attr = $args[0];

        return $this;
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
