<?php

namespace Tests\Unit;

use App\Http\Validators\UserSearchRequest;
use DateTime;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    private array $defaultValues = ['view' => 'table', 'active' => 'NULL'];

    public function test_correctViewValues(): void
    {
        $request = new UserSearchRequest(['view' => 'table', 'active' => '1']);
        $request2 = new UserSearchRequest(['view' => 'thumb', 'active' => '1']);;

        $this->assertTrue($request->validate());
        $this->assertTrue($request2->validate());
    }

    public function test_invalidViewValues(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(['view' => 'wrong', 'active' => '1']);
        $requests[] = new UserSearchRequest(['view' => 'NULL', 'active' => '1']);
        $requests[] = new UserSearchRequest(['view' => null, 'active' => '1']);
        $requests[] = new UserSearchRequest(['view' => ['table', 'thumb'], 'active' => '1']);
        $requests[] = new UserSearchRequest(['active' => '1']);

        foreach ($requests as $request) {
            $this->assertFalse($request->validate());
        }
    }

    public function test_correctActiveValues(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest($this->defaultValues);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => '1']);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => '0']);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => 1]);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => 0]);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => true]);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => false]);

        foreach ($requests as $request) {
            $this->assertTrue($request->validate());
        }
    }

    public function test_invalidActiveValues(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => 'yes']);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => 'no']);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => '3']);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => 4]);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => null]);
        $requests[] = new UserSearchRequest(['view' => 'table', 'active' => ['1']]);

        foreach ($requests as $request) {
            $this->assertFalse($request->validate());
        }
    }

    public function test_correctDateValues(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-01T20:10:00', 'to' => '2022-12-02T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-01T24:01:10', 'to' => '2022-01-02T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-01T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['to' => '2022-01-01T00:00:00']));

        foreach ($requests as $request) {
            $this->assertTrue($request->validate());
        }
    }

    public function test_invalidDateValues(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-43T00:00:00', 'to' => '2022-01-35T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-01 00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['to' => '2022-01-01 00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '12/12/2015T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['to' => '12/12/2015T00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-18-22Y00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['to' => '2022-22-01 00:00:00']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['from' => '2022-01-01T00:00:00', 'to' => '2015-01-01T00:00:00']));

        foreach ($requests as $request) {
            $this->assertFalse($request->validate());
        }
    }

    public function test_validNameValue(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => 'John']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => 'J']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => '']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => '12414']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => 'John Smith Johnson']));

        foreach ($requests as $request) {
            $this->assertTrue($request->validate());
        }
    }

    public function test_validSurnameValue(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => 'John']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => 'J']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => '']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => '12414']));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => 'John Smith Johnson']));

        foreach ($requests as $request) {
            $this->assertTrue($request->validate());
        }
    }

    public function test_invalidNameValue(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => ['John']]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => 5464]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => true]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['name' => new DateTime()]));

        foreach ($requests as $request) {
            $this->assertFalse($request->validate());
        }
    }

    public function test_invalidSurnameValue(): void
    {
        $requests = [];
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => ['John']]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => 5464]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => true]));
        $requests[] = new UserSearchRequest(array_merge($this->defaultValues, ['surname' => new DateTime()]));

        foreach ($requests as $request) {
            $this->assertFalse($request->validate());
        }
    }
}
