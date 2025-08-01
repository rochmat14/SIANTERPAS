<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Blog;
use App\Model\BlogDescription;
use App\Model\Category;
use App\Model\Tags;
use App\Http\Requests\Backend\BlogStatusRequest;
use App\UserDescription;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Svg\Tag\Rect;
use Yajra\Datatables\Datatables;
use URL;


class NewsController extends Controller
{
    private $controller = 'news';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function title(){
        return __('main.news') .' - Article';
    }


    public function index(Request $request)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

    
        $user = Auth::user();
        return view('backend.'.$this->controller.'.index', compact('user'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }


    


    public function getData(Request $request)
    {
        if (!Auth::user()->can($this->controller . '-index')) {
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $user = Auth::user();
        $rows = Blog::with(['description', 'category'])->where('status', 1);

        // Filter berdasarkan izin pengguna
        if (!auth()->user()->can($this->controller . '-all')) {
            // Jika user tidak punya akses untuk melihat semua blog, hanya tampilkan blog miliknya
            $rows->where('created_by', $user->id);
        } else {
            // Jika user punya akses untuk melihat semua blog
            $rows->where(function ($query) use ($user) {
                $query->where('publish', '!=', 'draft') // Semua yang bukan 'draft'
                    ->orWhere(function ($q) use ($user) {
                        // Atau tampilkan 'draft' jika milik user
                        $q->where('publish', '=', 'draft')
                            ->where('created_by', $user->id);
                    });
            });
        }

        // Menangani pencarian dari DataTable
        if ($search = $request->input('search')['value']) {
            $rows->where(function ($query) use ($search) {
                // Pencarian di kolom yang berasal dari relasi 'description' (title)
                $query->whereHas('description', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                

                ->orWhere('publish', 'like', "%{$search}%");
                // ->orWhere('category', 'like', "%{$search}%");

                
            });
        }

        // Menambahkan sorting setelah semua kondisi diterapkan
        $rows->orderBy('id', 'desc');

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('fiture_image', function ($row) {
                $url_image = URL::asset('/images/news/') . '/' . $row->id . '/thumb-' . $row->image;
                return "<img src='" . $url_image . "' width='100'>";
            })
            ->addColumn('writer', function ($row) {
                $user_desc = UserDescription::where('users_id', $row->created_by)->first();
                return $user_desc->nama_depan ?? 'Unknown Writer';
            })
            ->addColumn('title', function ($row) {
                $desc = $row->description()->first();
                return $desc->title ?? 'No Title';
            })
            ->addColumn('category', function ($row) {
                $get_ctg = Category::find($row->id_category);
                return $get_ctg ? $get_ctg->name : 'Un-Categories';
            })
            
            ->addColumn('status_publish', function ($row) {
                if (auth()->user()->can($this->controller . '-approval')) {
                    return "<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=change_status(" . $row->id . ") title='Change Status'>
                                <i class='fa fa-cog text-warning'></i> " . $row->publish . " | &nbsp; Change Status
                            </a>";
                }

                if ($row->publish == 'pending') {
                    return "<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=pull_article(" . $row->id . ") title='Pull Article'>
                                <i class='fa fa-cog text-info'></i> Waiting Approved | &nbsp; Pull Article
                            </a>";
                } elseif ($row->publish == 'draft') {
                    return "<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=send_article(" . $row->id . ") title='Send Article'>
                                <i class='fa fa-cog text-info'></i> Draft | &nbsp; Send Article
                            </a>";
                } elseif ($row->publish == 'reject') {
                    return "<a href='#' class='badge bg-light mt-2'>
                                <i class='fa fa-cog text-info'></i> Reject
                            </a>";
                } else {
                    return "<a href='#' class='badge bg-light mt-2'>
                                <i class='fa fa-cog text-info'></i> Publish
                            </a>";
                }
            })
            ->addColumn('action', function ($row) {
                $rest = "";
                if (!auth()->user()->can($this->controller . '-all') && $row->publish == 'draft' && auth()->user()->can($this->controller . '-update')) {
                    $url_edit = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to('dashboard/' . $this->controller . '/' . $row->id . '/edit'));
                    $rest .= "<a href='" . $url_edit . "' class='badge bg-light mt-2' title='Edit'>
                                <i class='fa fa-edit text-info'></i> Edit
                            </a>&nbsp;";
                } elseif (auth()->user()->can($this->controller . '-update')) {
                    $url_edit = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to('dashboard/' . $this->controller . '/' . $row->id . '/edit'));
                    $rest .= "<a href='" . $url_edit . "' class='badge bg-light mt-2' title='Edit'>
                                <i class='fa fa-edit text-info'></i> Edit
                            </a>&nbsp;";
                }

                $url_view = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to('dashboard/' . $this->controller . '/' . $row->id . '/show'));
                $rest .= "<a href='" . $url_view . "' class='badge bg-light mt-2' title='View'>
                            <i class='fa fa-eye'></i> Views
                        </a>&nbsp;";
                return $rest;
            })
            ->make();
    }




    public function get_data_byid(Request $request){
        
        $id= $request->get('id');
        $datas = Blog::where('id',$id)->first();

        $title = $datas->description()->first()->title;
        $data_return =array(
            'data'=>$datas,
            'title'=>$title
        );
        return response()->json($data_return);
    }

    public function ChangeStatus(BlogStatusRequest $request){
        if (!auth()->user()->can($this->controller.'-approval')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }
        $user = Auth::user();
        $id = $request->id;
        $publish = $request->publish;

        $row = Blog::whereId($id)->firstOrFail();
        $row->publish = $publish;
        $row->proses_by = $user->id;
        $row->save(); 
        echo json_encode(array("status" => TRUE));
    }


    public function create()
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $category = Category::where('status',1)->get();
       
        
        $tags = Tags::where('status',1)->get();


        return view('backend.'.$this->controller.'.create',compact('category','tags'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $user = Auth::user();
        $tags=serialize($request->post_tags);


        $row = Blog::create([
            'published_on' => date('Y-m-d H:i:s', strtotime($request->get('published_on'))),
            'id_category' => $request->get('category'),
            'tags'=>$tags,
            'status' => $request->get('status'),
            'slug' => setUrlSlug(strtolower($request->get('slug'))),
            'meta_keyword'=>$request->get('meta_keyword'),
            'meta_description'=>$request->get('meta_description'),
            'image' => '',
            'created_by'=>$user->id
        ]);

        if ($row->save()) {

            if(!empty($request->image)){
                $file = $request->image;
                $destinationPath = 'images/news/'.$row->id.'/' ;
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
                
                $filename = $file->getClientOriginalName();
                $image = Image::make($file);
                $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
                if($isJpg && $image->exif('Orientation'))
                    $image = orientate($image, $image->exif('Orientation'));

                //$image->save(public_path() .'/'. $destinationPath. $filename);
                $image->save($destinationPath. $filename);
                //$image->fit(750, 500)->save(public_path() .'/'. $destinationPath. 'thumb-'. $filename);
                $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);
                $row->image = $filename;
                $row->save(); 

            }
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rowDesc = new BlogDescription(array(
                    'blog_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $request->get('title')[$localeCode],
                    'description' => $request->get('description_id')
                ));
                $rowDesc->save();
            }

            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_added', ['page' => $this->title()] ) );
        } else {
            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('error', 'Data has not been added' );
        }
    }

    public function edit($id)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row           = Blog::whereId($id)->firstOrFail();
        $rowDescriptions = $row->description()->get();

        
        
        $data_tags= unserialize($row->tags);



        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }


        $category = Category::where('status',1)->get();
        

        $tags = Tags::where('status',1)->get();

        return view('backend.'.$this->controller.'.edit', compact('row','descriptions','data_tags','category','tags'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $tags=serialize($request->post_tags);
        $row           = Blog::whereId($id)->firstOrFail();
        $row->id_category =$request->get('category');
        $row->tags =$tags;
        $row->published_on = date('Y-m-d H:i:s', strtotime($request->get('published_on')));
        $row->status = $request->get('status');
        $row->slug = setUrlSlug(strtolower($request->get('slug')));
        $row->meta_keyword = $request->get('meta_keyword');
        $row->meta_description = $request->get('meta_description');

        if ($row->save()) {
            $row->description()->delete();

            $file = $request->image;
            if ($file !== null && $file->isValid()) {
                $imageOld = $row->image;
                $destinationPath = 'images/news/'.$row->id.'/' ;
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
                $filename = $file->getClientOriginalName();

                $image = Image::make($file);
                $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
                if($isJpg && $image->exif('Orientation'))
                    $image = orientate($image, $image->exif('Orientation'));

                //$image->save(public_path() .'/'. $destinationPath. $filename);
                $image->save($destinationPath. $filename);
                //$image->fit(750, 500)->save(public_path() .'/'. $destinationPath. 'thumb-'. $filename);
                $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);

                $row->image = $filename;
                $row->save(); 

                if ($imageOld != '') {
                    //Storage::delete([public_path() .'/'. $destinationPath . $filename, public_path() .'/'. $destinationPath. 'thumb-'. $filename]);
                    Storage::delete([$destinationPath . $filename, $destinationPath. 'thumb-'. $filename]);
                }
            }

            
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rowDesc = new BlogDescription(array(
                    'blog_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $request->get('title')[$localeCode],
                    'description' => $request->get('description_id')
                ));

                $rowDesc->save();
            }

            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_updated', ['page' => $this->title()] ) );
        }
    }

    public function show($id)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row           = Blog::whereId($id)->firstOrFail();

        $rowDescriptions = $row->description()->get();

        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }

        return view('backend.'.$this->controller.'.view', compact('row','descriptions'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }


    public function SendArticle(Request $request){
        
        $user = Auth::user();
        $id = $request->id;
        $publish = 'pending';

        $row = Blog::whereId($id)->firstOrFail();
        $row->publish = $publish;
        $row->updated_by = $user->id;
        $row->save(); 
        $result=array(
            "data_post"=>array(
                "status"=>TRUE,
                "class" => "success",
                "message"=>"Success ! Send article data"
            )
        );
        echo json_encode($result);
    }

    public function PullArticle(Request $request){
        $user = Auth::user();
        $id = $request->id;
        $publish = 'draft';

        $row = Blog::whereId($id)->firstOrFail();
        $row->publish = $publish;
        $row->updated_by = $user->id;
        $row->save(); 
        $result=array(
            "data_post"=>array(
                "status"=>TRUE,
                "class" => "success",
                "message"=>"Success ! Draft article data"
            )
        );
        echo json_encode($result);
    }
}
