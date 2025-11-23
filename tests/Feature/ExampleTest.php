<?php

test('root returns a redirect response', function () {
    $this->get('/')->assertStatus(302);
});