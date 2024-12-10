<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class UserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $check=false;
    public $allow=false;
    public $name;
    public $email;
    public $password;
    public $role;
    public $editname;
    public $editemail;
    public $editpassword;
    public $editrole;
    protected $rules = [
        'name' => 'required|max:255|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|string', 
    ];
    
    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $users=User::orderBy('id','desc')->paginate(10);
        return view('livewire.user-component',compact('users'));
    }
    public function Create()
    {
        $this->check=true;
    }
    public function Back()
    {
        $this->check=false;
    }
    public function store()
    {
        $validateData=$this->validate();
        //dd($this->name,$this->email);
        User::create($validateData);
        $this->check=false;
        $this->reset('name','email','password');
    }
    public function change(User $user)
    {
        $this->allow=$user->id;
        $this->editname=$user->name;
        $this->editemail=$user->email;
        $this->editrole=$user->role;
        $this->editpassword='';
    }
    public function edit()
    {
        $this->validate([
            'editname' => 'required|max:255|min:3',
            'editemail' => 'required|email|unique:users,email,' . $this->allow,
            'editpassword' => 'nullable|min:8',
            'editrole' => 'required|string',
        ]);
    
        $user = User::findOrFail($this->allow);
    
        if ($user) {
            if ($this->editpassword) {
                $user->update([
                    'name' => $this->editname,
                    'email' => $this->editemail,
                    'password' => bcrypt($this->editpassword),
                    'role' => $this->editrole,
                ]);
            } else {
                $user->update([
                    'name' => $this->editname,
                    'email' => $this->editemail,
                    'role' => $this->editrole,
                ]);
            }
        }
    
        $this->allow = false;
    }
    public function delete(User $user)
    {
        //dd($user);
        $user->delete();
    }
    public function updateGroup($groupId)
    {
        // dd($groupId);
        foreach ($groupId as $key) {
            // dd($key);
            User::where('id',$key['value'])->update([
                'id'=>$key['order']
            ]);
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Ism maydoni to‘ldirilishi shart.',
            'name.max' => 'Ism 255 ta belgidan oshmasligi kerak.',
            'name.min' => 'Ism kamida 3 ta belgi bo‘lishi kerak.',
            'email.required' => 'Email maydoni to‘ldirilishi shart.',
            'email.email' => 'Email manzili noto‘g‘ri formatda.',
            'email.unique' => 'Bu email allaqachon ro‘yxatdan o‘tgan.',
            'password.required' => 'Parol kiritilishi shart.',
            'password.min' => 'Parol kamida 8 ta belgi bo‘lishi kerak.',
            'role.required' => 'Role maydoni to‘ldirilishi shart.',
            'role.string' => 'Role text formatda bo‘lishi kerak.',
    
            'editname.required' => 'Ism maydoni to‘ldirilishi shart.',
            'editname.max' => 'Ism 255 ta belgidan oshmasligi kerak.',
            'editname.min' => 'Ism kamida 3 ta belgi bo‘lishi kerak.',
            'editemail.required' => 'Email maydoni to‘ldirilishi shart.',
            'editemail.email' => 'Email manzili noto‘g‘ri formatda.',
            'editemail.unique' => 'Bu email allaqachon ro‘yxatdan o‘tgan.',
            'editpassword.required' => 'Parol kiritilishi shart.',
            'editpassword.min' => 'Parol kamida 8 ta belgi bo‘lishi kerak.',
            'editrole.required' => 'Role maydoni to‘ldirilishi shart.',
            'editrole.string' => 'Role text formatda bo‘lishi kerak.',
        ];
        
    }
}
