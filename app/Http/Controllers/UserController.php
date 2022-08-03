<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \Cache;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::rememberForever('all_users', function () {
            return User::orderBy('created_at', 'desc')->get();
          });
        
        $stats = Cache::getMemcached()->getStats();

        return view('users', [
            'users' => $users,
            'stats' => array_pop($stats)
        ]);
    }

    public function add_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password'  => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create task
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
    
        $user->save();

        Cache::forget('all_users');
    
        return redirect('/');
    }

    public function delete_user(int $id)
    {
        $user=User::where('id', $id)->first();
        $user->delete();

        Cache::forget('all_users');

        return redirect('/');
    }
}