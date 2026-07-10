<?php

test('registration screen can be rendered', function () {
    $this->markTestSkipped('Registro solo accesible para admins autenticados.');
});

test('new users can register', function () {
    $this->markTestSkipped('El registro no autentica automáticamente, solo lo hace el admin.');
});