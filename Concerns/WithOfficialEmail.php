<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Support\Carbon;
use StaffConfig;

trait WithOfficialEmail
{
    /**
     * @param string|null $domain
     * @return void
     */
    public function makeEmail(string $domain = null): void
    {
        if (empty($domain)) {
            $domain = $this->emailDomain();
            if (empty($domain)) {
                $domain = request()->getHost();
            }
        }
        $email = $this->suggestEmail($domain);
        if (isset($email)) {
            $this->setAttribute('official_email', $email);
        }
    }

    /**
     * @return mixed
     */
    protected function emailDomain(): mixed
    {
        return StaffConfig::get('email_domain');
    }

    /**
     * @param $domain
     * @return mixed|null
     */
    public function suggestEmail($domain): mixed
    {
        $choice = null;
        $suggestions = $this->emailSuggestions($domain);
        foreach ($suggestions as $suggestion) {
            if ($this->emailNotTaken($suggestion)) {
                $choice = $suggestion;
                break;
            }
        }
        return $choice;
    }

    /**
     * @param string $domain
     * @return array
     */
    protected function emailSuggestions(string $domain): array
    {
        $firstname = strtolower($this->firstname[0]);
        $middlename = isset($this->middlename) ? strtolower($this->middlename[0]) : null;
        $lastname = strtolower($this->lastname);
        $date = Carbon::createFromDate($this->date_of_birth)->format('Y');
        $year = substr($date, -2);

        $suggestions = [];

        $suggestions[] = $firstname . $middlename . $lastname . "@" . $domain; // jsmith@domain.com or jdsmith@domain.com
        $suggestions[] = $firstname . $middlename . $lastname . $year . "@" . $domain; // jsmith90@domain.com or jdsmith90@domain.com
        $suggestions[] = $firstname . $middlename . "." . $lastname . "@" . $domain; // j.smith@domain.com or jd.smith@domain.com
        $suggestions[] = $firstname . $middlename . "." . $lastname . $year . "@" . $domain; // j.smith90@domain.com or jd.smith90@domain.com
        $suggestions[] = $firstname . $middlename . "_" . $lastname . "@" . $domain; // j_smith@domain.com or jd_smith@domain.com
        $suggestions[] = $firstname . $middlename . "_" . $lastname . $year . "@" . $domain; //j_smith90@domain.com or jd_smith90@domain.com

        return $suggestions;
    }

    /**
     * @param string $email
     * @return bool
     */
    protected function emailNotTaken(string $email): bool
    {
        $exists = static::where('official_email', $email)->exists();
        if ($exists) {
            return true;
        } else {
            return false;
        }
    }

}
