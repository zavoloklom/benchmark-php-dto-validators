<?php

/**
 * Allows to create Illuminate's validator
 * which requires a translation class to build errors messages.
 */

declare(strict_types=1);

namespace pushworld\ValidationTools;

use Closure;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation;
use Illuminate\Validation;

use function call_user_func_array;
use function dirname;

/**
 * @see \Illuminate\Validation\Factory
 *
 * @method static Validator make(array $data, array $rules, array $messages = [], array $customAttributes = [])
 * @method static void extend(string $rule, Closure|string $extension, string $message = null)
 * @method static void extendImplicit(string $rule, Closure|string $extension, string $message = null)
 * @method static void replacer(string $rule, Closure|string $replacer)
 * @method static array validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
 */
class ValidatorFactory
{
    /** @var Validation\Factory */
    private $factory;

    public function __construct()
    {
        $this->factory = new Validation\Factory(
            $this->loadTranslator()
        );
    }

    protected function loadTranslator(): Translation\Translator
    {
        $filesystem = new Filesystem();
        $loader = new Translation\FileLoader(
            $filesystem,
            dirname(__FILE__) . '/lang'
        );
        $loader->addNamespace(
            'lang',
            dirname(dirname(__FILE__)) . '/lang'
        );
        $loader->load('en', 'validation', 'lang');

        return new Translation\Translator($loader, 'en');
    }

    /**
     * @param string $method
     * @param mixed  $args
     *
     * @return mixed
     */
    public function __call(string $method, $args)
    {
        return call_user_func_array(
            [$this->factory, $method],
            $args
        );
    }
}
