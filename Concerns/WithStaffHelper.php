<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Support\Carbon;

trait WithStaffHelper
{
    /**
     * Concatenate firstname and lastname
     * @return string
     */
    public function name(): string
    {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Get Staff official email
     *
     * @return string
     */
    public function emailAddress(): string
    {
        if (empty($this->official_email)) {
            return $this->personal_email;
        } else {
            return $this->official_email;
        }
    }

    /**
     * Concatenate title, firstname and lastname
     * @return string
     */
    public function fullname(): string
    {
        return $this->title . " " . $this->firstname . " " . $this->lastname;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function age(): string
    {
        return Carbon::createFromDate($this->date_of_birth)
            ->diff(Carbon::now())->format('%y Years');
    }

    /**
     * @return string
     */
    public function pronoun(): string
    {
        if ($this->gender == 'Male' || $this->gender == 'M') {
            return 'He';
        } elseif ($this->gender == 'Female' || $this->gender == 'F') {
            return 'She';
        } else {
            return 'They';
        }
    }

    /**
     * @return string
     */
    public function possessivePronoun(): string
    {
        if ($this->gender == 'Male' || $this->gender == 'M') {
            return 'His';
        } elseif ($this->gender == 'Female' || $this->gender == 'F') {
            return 'Her';
        } else {
            return 'Their';
        }
    }

    /**
     * Date of Birth
     *
     * @return string|null
     */
    public function dateOfBirth(): ?string
    {
        return (isset($this->date_of_birth)) ? $this->date_of_birth->format('d-M-Y') : null;
    }

    /**
     * Date of Birth
     *
     * @return string|null
     */
    public function dob(): ?string
    {
        return (isset($this->date_of_birth)) ? $this->date_of_birth->format('Y-m-d') : null;
    }

    /**
     * Status
     *
     * @return string
     */
    public function statusBadge(): string
    {
        return (strtolower($this->status) == strtolower('active')) ?
            "<span class='badge badge-success'>{$this->status}</span>" :
            "<span class='badge badge-danger'>{$this->status}</span>";
    }

    /**
     * Check whether staff is not active
     * @return bool
     */
    public function isNotActive(): bool
    {
        return !$this->isActive();
    }

    /**
     * Check whether staff is active
     * @return bool
     */
    public function isActive(): bool
    {
        return strtolower($this->status) == strtolower('active');
    }

    /**
     * @return array
     */
    public function qualificationKeys(): array
    {
        return $this->qualifications()->pluck('id')->toArray();
    }

}
