<?php

namespace App\Http\Livewire;

use App\Section as SectionModel;
use Livewire\Component;


class Section extends Component
{
    public $addMore = [1];
    public $count = 0;

    public $section_name, $section_status, $edit_id;
   
    //Add More
    public function AddMore()
    {
        $countable = $this->count++;
        if ($countable < 4) {
            $this->addMore[] = count($this->addMore) + 1;
        }
    }

    //Remove More
    public function Remove($index)
    {
        $this->count--;
        unset($this->addMore[$index]);
    }

    protected $lestiners = ['RecordDeleted' => 'DeletedSection'];

    public function store() 
    {
        foreach ($this->section_name as $key => $section){
            
            SectionModel::create ([
                'section_name' => $this -> section_name[$key],
                'status' => $this-> section_status[$key] ?? 0 // if status is empty 0 else 1
            
            ]);
        }

        $this->FormReset();
        $this->SwalMessageDialog('Section Created Successfully');
    }
        
       


        public function editSection($section_id)
        {
            $this->edit_id = $section_id;
            $section = SectionModel::findOrFail($section_id);
            $this->section_name = $section->section_name;
            $this->section_status = $section->status;
        }

        public function update($section_id)
        {
            
            SectionModel::updateOrCreate (  ['id' => $this->edit_id], [
                'section_name' => $this -> section_name,
                'status' => $this-> section_status ?? 0 // if status is empty 0 else 1
            
            ]);
            $this->FormReset();
            $this->SwalMessageDialog('Section Updated Successfully');
            
        }


        //Delete Dialog
        public function ConfirmDelete($section_id, $section_name)
        {
          
            $this->dispatchBrowserEvent('Swal:DeletedRecord',[
                'title' => "Are you sure you want to delete <span class='text-danger'>$section_name</span>",
                'id' => $section_id
                
            ]);
        }

        //Delete Section

        public function RecordDeleted($section_id)
        {
            
           $section = SectionModel::find($section_id);
           $section->delete();
        //   dd($countProduct);
            
        }

       public function FormReset()
        {
           $this->section_name ='';
           $this->section_status ='';
           $this->addMore = [1];

           $this->dispatchBrowserEvent('closeModel');
              
        }

        public function SwalMessageDialog($message){

            $this->dispatchBrowserEvent('MSGsuccessful',
            [
                'title' => $message,
            ]);
        }


    public function render()
    {
        return view('livewire.section', ['sections' => SectionModel::all()]);
    }
}
