<?php

namespace App\Http\Livewire;

use App\Models\CRM\Leeds;
use Livewire\Component;
use App\Models\CRM\HouseAreaType;
use App\Models\CRM\DecorationType;
use App\Models\CRM\Quotation;

class HtDepDrop extends Component
{
    public $housetypes;
    public $decTypes;

    public $selectedHouseType = NULL;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount()
    {
        $this->housetypes = HouseAreaType::all();
        $this->decTypes = collect();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.ht-dep-drop')->extends('CRM.layouts_successLeeds.app');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedHouseType($houseType)
    {
        if (!is_null($houseType)) {
            $this->decTypes = DecorationType::where('houseAreaTypeId', $houseType)->get();
        }
    }
}
