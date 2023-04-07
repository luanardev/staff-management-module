<?php

namespace Lumis\StaffManagement\Http\Livewire\Confirmation;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\JobRank;
use Lumis\StaffManagement\Entities\Staff;

class ConfirmTenure extends LivewireUI
{
    public $confirmationDate;
    public $confirmationComment;
    public Staff $staff;
    public Employment $employment;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->employment = $staff->employment;
        $this->confirmationDate = $this->employment->confirmation_date;
        $this->confirmationComment = $this->employment->confirmation_comment;

    }

    public function render()
    {
        return view('staffmanagement::livewire.confirmation.confirm-tenure');
    }

    public function confirm()
    {
        $this->validate();

        if ($this->employment->isPermanent() && $this->employment->isNotConfirmed()) {
            $this->employment->confirmTenure(
                $this->confirmationComment,
                $this->confirmationDate
            );
            $this->emitRefresh()->toastr('Confirmation successful');
        } else {
            $this->emitRefresh()->toastrError('Staff already confirmed');
        }
        return $this->redirect(route('confirmation.index'));
    }

    public function dismiss()
    {
        $this->validate();
        $this->employment->dismissTenure();
        $this->emitRefresh()->toastr('Dismissal successful');

    }

    public function rules()
    {
        return [
            'confirmationComment' => 'required|string',
            'confirmationDate' => 'required|date',
        ];
    }

    public function ranks()
    {
        return JobRank::getByCategory($this->employment->job_category_id)
            ->pluck('id', 'name')->flip()->toArray();
    }


}
