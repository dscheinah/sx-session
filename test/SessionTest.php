<?php

namespace Sx\SessionTest;

use Sx\Session\Session;
use PHPUnit\Framework\TestCase;
use Sx\Session\SessionException;

class SessionTest extends TestCase
{
    private const SCOPE = 'scope';

    private $session;

    protected function setUp(): void
    {
        $this->session = new Session(self::SCOPE, ['save_path' => '/tmp']);
        $_SESSION = [];
    }

    public function testStart(): void
    {
        try {
            $this->session->start();
            $this->expectOutputString('');
        } catch (SessionException $e) {
            self::assertFalse(true);
        }
        $this->session->end();
        $session = new Session('', ['save_path' => '/not/existent/writable']);
        $this->expectException(SessionException::class);
        @$session->start();
    }

    public function testSet(): void
    {
        $this->session->set('key', 'value');
        self::assertEquals('value', $_SESSION[self::SCOPE]['key']);
    }

    public function testGet(): void
    {
        try {
            $_SESSION[self::SCOPE]['key'] = 'value';
            self::assertEquals('value', $this->session->get('key'));
        } catch (SessionException $e) {
            self::assertFalse(true);
        }
        $this->expectException(SessionException::class);
        $this->session->get('error');
    }

    public function testHas(): void
    {
        $_SESSION[self::SCOPE]['key'] = 'value';
        self::assertTrue($this->session->has('key'));
        self::assertFalse($this->session->has('key2'));
    }
}
