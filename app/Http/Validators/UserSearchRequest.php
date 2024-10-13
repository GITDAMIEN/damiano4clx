<?php

namespace App\Http\Validators;

use DateTime;

class UserSearchRequest
{
    private $active;
    private $from;
    private $to;
    private $name;
    private $surname;
    private $view;
    private $error = '';

    public function __construct(array $searchParams)
    {
        $this->active = $searchParams['active'] ?? null;
        $this->from = $searchParams['from'] ?? null;
        $this->to = $searchParams['to'] ?? null;
        $this->name = $searchParams['name'] ?? null;
        $this->surname = $searchParams['surname'] ?? null;
        $this->view = $searchParams['view'] ?? null;
    }

    /**
     * This function validates the values of the POST parameters.
     * I chose to stop the validation on any invalid parameter value and show one error at a time to the user,
     * instead of showing all errors at once.
     * @return bool
     */
    public function validate(): bool
    {
        if (!in_array($this->active, ['NULL', '0', '1'])) {
            $this->error = 'Invalid "active" value';
            return false;
        };

        if ($this->from && !DateTime::createFromFormat('Y-m-d\TH:i:s', $this->from)) {
            $this->error = 'Invalid "from" value';
            return false;
        }

        if ($this->to && !DateTime::createFromFormat('Y-m-d\TH:i:s', $this->to)) {
            $this->error = 'Invalid "to" value';
            return false;
        }

        if ($this->from && $this->to && $this->from > $this->to) {
            $this->error = 'The "to" value must be greater than the "from" value';
            return false;
        }

        if ($this->name) {
            if (is_string($this->name)) {
                $this->name = substr(trim($this->name), 0, 120);
            } else {
                $this->error = 'Invalid "name" value';
                return false;
            }
        }

        if ($this->surname) {
            if (is_string($this->surname)) {
                $this->surname = substr(trim($this->surname), 0, 120);
            } else {
                $this->error = 'Invalid "surname" value';
                return false;
            }
        }

        if (!in_array($this->view, ['table', 'thumb'])) {
            $this->error = 'Invalid "view" value';
            return false;
        }

        return true;
    }

    public function getActive(): ?int
    {
        $this->active = $this->active === 'NULL' ? null : $this->active;
        return $this->active;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function getTo(): ?string
    {
        return $this->to;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getView(): ?string
    {
        return $this->view;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getValues(): array
    {
        return [
            'active' => $this->active,
            'from' => $this->from,
            'to' => $this->to,
            'name' => $this->name,
            'surname' => $this->surname,
            'view' => $this->view,
        ];
    }
}
