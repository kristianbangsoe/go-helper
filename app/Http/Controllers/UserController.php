<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use App\User;
use App\Category;
use Carbon\Carbon;
use App\Http\Resources\User as UserResource;
use DB;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{
    //
    public function profile(){
    	return view('profile', array('user' => Auth::user()) );
    }
    public function update_avatar(Request $request){

        $user = Auth::user();

        // Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user->avatar = $filename;
   
        }

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'birth' => 'required',
            'street' => 'required',
            'phone' => 'required',
            'checked_array' => 'required',
            'zip' => 'required'
        ], [
            'checked_array.required' => 'Vælg venligst hvilke områder du ønsker at arbejde med.',
            'zip' => 'Vælg venligst det postnummer du er i',
            'birth' => 'Intast venligst din fødselsdag',
            'street' => 'Intast venligst din gade og dit hus nummer',
            'phone' => 'Intast venligst dit telefonnummer',
            'firstname' => 'Intast venligst dit fornavn',
            'lastname' => 'Intast venligst dit efternavn'
        ]);



        $user->name = $request->input('firstname');
        $user->birth = $request->input('birth');
        $user->bio = $request->input('bio');
        $user->street = $request->input('street');
        $user->phone = $request->input('phone');
        $cats = $request->input('checked_array');
            DB::table('user_categories')->where('user_id', $user->id)->delete();
            foreach ($cats as $key => $val) {
                    $exp = $request->input('exp-' . $val);
                    $desc = $request->input('desc-' . $val);

                    if(!isset($exp)){
                        $exp = 0;
                    }
                    if(!isset($desc)){
                        $desc = '';
                    }

                    DB::insert(
                        'insert into `user_categories` (`user_id`, `category_id`, `experince`, `description`, `created_at`, `updated_at`) values (' . $user->id . ','. $val .','. $exp .',"'. $desc .'","2018-11-15 23:18:31","2018-11-15 23:18:31")'
                    ); 
             
            }

        $user->save();
        
        return redirect()->back()->with('success', 'Din profil er nu opdateret');
        
         // $posts = DB::select('SELECT * FROM posts');
	}
	
	public function UserIndexApi()
    {

        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts');
        //$posts = Post::where('title', 'Hello world')->get();
        //$posts = Post::orderBy('title', 'asc')->take(5)->get();
        // $posts = Post::orderBy('title', 'asc')->get();
        $users = User::all();
        return UserResource::collection($users);
        
    }

    public function index() {
        return view('users.index');
    }
}