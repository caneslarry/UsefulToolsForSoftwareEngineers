<?php

/**
 * Class FooController
 */
class FooController {
    /**
     * FooController constructor.
     */
    public function __construct() {}

    /**
     * barAction - Sample controller action.
     * Called from browser like this
     * ~/Foo/bar
     */
    public function barAction() {
        echo 'Foo bard';
    }
}