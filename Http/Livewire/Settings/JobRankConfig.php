<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobRank;

class JobRankConfig extends LivewireUI
{
    public JobRank $rank;

    public mixed $category;

    public function __construct()
    {
        parent::__construct();
        $this->rank = new JobRank();
        $this->category = null;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.settings.job-rank.index');
    }

    public function viewData()
    {
        $this->with('category', JobCategory::pluck('id', 'name')->flip()->toArray());
    }

    public function create()
    {
        $this->reset(['rank', 'category']);
        $this->createMode();
    }

    public function edit($id = null)
    {
        $this->rank = JobRank::findorfail($id);
        $this->category = $this->rank->category_id;
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        JobRank::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Job Rank deleted');
    }

    public function save()
    {
        $this->validate();
        $this->rank->jobcategory()->associate($this->category);
        $this->rank->save();
        $this->browseMode()->emitRefresh()->toastr('Job Rank saved');
    }

    public function rules()
    {
        return [
            'rank.name' => 'required|string',
            'category' => 'required',
        ];

    }

    public function getListeners()
    {
        return [
            'create-rank' => 'create',
            'edit-rank' => 'edit',
            'delete-rank' => 'delete',
        ];
    }


}
