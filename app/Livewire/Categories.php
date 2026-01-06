<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\CategoryHistory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title("Categories - ExpenseApp")]
class Categories extends Component
{
    public $confirmingDelete = false;
    public $deleteId = null;

    public $name = "";
    public $color = "#3B82F6";
    public $icon = "";
    public $editingId = null;
    public $isEditing = false;

    protected $listeners = ['historyUpdated' => '$refresh'];

    public $colors = [
        '#DC2626', // Red (600)
        '#EA580C', // Orange (600)
        '#D97706', // Amber (600)
        '#CA8A04', // Yellow (600)
        '#65A30D', // Lime (600)
        '#16A34A', // Green (600)
        '#059669', // Emerald (600)
        '#0F766E', // Teal (600)
        '#0891B2', // Cyan (600)
        '#0284C7', // Sky (600)
        '#2563EB', // Blue (600)
        '#4F46E5', // Indigo (600)
        '#7C3AED', // Violet (600)
        '#9333EA', // Purple (600)
        '#C026D3', // Fuchsia (600)
        '#DB2777', // Pink (600)
        '#E11D48', // Rose (600)
    ];

    //Validated Rules
    protected function rules() {
        return [
            'name' => 'required|string|max:50',
            'color' => 'required|string',
            'icon' => 'nullable|string|max:50',
        ];
    }

    //Use computes properties
    #[Computed]
    public function categories() {
        return Category::withCount('expenses')
            ->where('user_id', auth()->id())
            ->orderBy('name')
            ->get();
    }

    //Display History
    #[Computed]
    public function history(){
        return CategoryHistory::where('user_id', auth()->id())
            ->latest()
            ->take(10) //last 10 actions
            ->get();
    }

    public function edit($categoryId) {
        $category = Category::findOrFail($categoryId);

        if($category->user_id !== auth()->id()) {
            abort(403);
        }

        $this->editingId = $category->id;
        $this->name = $category->name;
        $this->color = $category->color;
        $this->icon = $category->icon;
        $this->isEditing = true;
    }

    public function save() {
        $this->validate();

        //Update Category
        if($this->isEditing && $this->editingId) {
            $category = Category::findOrFail($this->editingId);

            //Optional ownership check
            if($category->user_id !== auth()->id()) {
                abort(403);
            }

            $category->update([
                'name' => $this->name,
                'color' => $this->color,
                'icon' => $this->icon,
            ]);
            

            //History
            CategoryHistory::create([
                'user_id' => auth()->id(),
                'category_id' => $category->id,
                'action' => 'updated',
                'details' => json_encode([
                    'name' => $category->name,
                    'color' => $category->color,
                    'icon' => $category->icon,
                ]),
            ]);
            $this->emit('historyUpdated');

            session()->flash('message', 'Category updated successfully.');
        } else {
            //Creating
            $category = Category::create([
                'user_id' => auth()->id(),
                'name' => $this->name,
                'color' => $this->color,
                'icon' => $this->icon,
            ]);

            //History 
            CategoryHistory::create([
                'user_id' => auth()->id(),
                'category_id' => $category->id,
                'action' => 'created',
                'details' => json_encode([
                    'name' => $category->name,
                    'color' => $category->color,
                    'icon' => $category->icon,
                ]),
            ]);
            $this->emit('historyUpdated');


            session()->flash('message', 'Category created successfully.');
        }

        $this->reset(['name', 'color', 'icon', 'editingId', 'isEditing']);
    }

    public function cancelEdit() {
        $this->reset(['name', 'color', 'icon', 'editingId', 'isEditing']);
        $this->color = "#3B82F6";
    }


    //Confirmation 
    public function confirmDelete($id) {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function cancelDelete() {
        $this->confirmingDelete = false;
        $this->deleteId = null;
    }

    public function deleteConfirmed() {
        $category = Category::findOrFail($this->deleteId);

        if($category->user_id !== auth()->id()) {
            abort(403);
        }

        if($category->expenses()->count() > 0) {
            session()->flash('error', 'Cannot delete category with existing expenses.');
            $this->cancelDelete();
            return;
        }

        //History
        CategoryHistory::create([
            'user_id' => auth()->id(),
            'category_id' => $category->id,
            'action' => 'deleted',
            'details' => json_encode([
                'name' => $category->name,
                'color' => $category->color,
                'icon' => $category->icon,
            ]),
        ]);
        $this->emit('historyUpdated');


        $category->delete();

        session()->flash('message', 'Category deleted successfully!');
        $this->cancelDelete();
    }


    public function render()
    {
        return view('livewire.categories', [
            'categories' => $this->categories,
        ]);
    }
}
