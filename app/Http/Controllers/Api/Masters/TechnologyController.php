<?php

namespace App\Http\Controllers\Api\Masters;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Transformers\Common\ErrorTransformer;
use App\Transformers\Masters\TechnologyTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\ArraySerializer;
use Spatie\Fractal\Fractal;
use Throwable;

class TechnologyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['role_or_permission:Super Admin|technology.list'])->only('index');
        $this->middleware(['role_or_permission:Super Admin|technology.create'])->only(['create', 'store']);
        $this->middleware(['role_or_permission:Super Admin|technology.edit'])->only(['edit', 'update']);
        $this->middleware(['role_or_permission:Super Admin|technology.destroy'])->only(['destroy']);
        view()->share('module_title', 'technology');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Technology::paginate();
        $technologies = $paginator->getCollection();
        
        $response = fractal()
                    ->collection($technologies, new TechnologyTransformer())
                    ->serializeWith(new ArraySerializer)
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->addMeta(["message" => "the record added successfully", "status_code" => 200])
                    ->toArray();
        return response()->json($response);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'technology' => ["required" , Rule::unique('technology', 'technology')->whereNull('deleted_at')],
            'description'  => 'required'
        ]);
        try {
            $technology = new Technology();
            $technology->technology = $request->get('technology') ?? null;
            $technology->description = $request->get('description') ?? null;
            $technology->status = $request->filled('status-technology') ? 1 : 0;
            $technology->save();
            return fractal($technology->fresh(), new TechnologyTransformer())->respond();

        } catch (Throwable $thr) {
            // return response()->json(['error' => $e->getMessage()], 400);
            throw $thr;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $technology = Technology::findOrFail($id);
        return fractal($technology, new TechnologyTransformer())
        ->success(["message" => "the record added successfully", 'status_code' => 200])
        ->respond();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $technology = Technology::findOrFail($id);
        return fractal($technology, new TechnologyTransformer())->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'technology' => [
                'required',
                Rule::unique('technology')->whereNull('deleted_at')->ignore($id),
            ],
            'description'  => 'required'
        ]);
        try {
            $technology = Technology::findOrFail($id);  
            $technology->technology = $request->get('technology') ?? null;
            $technology->description = $request->get('description') ?? null;
            $technology->status = $request->filled('status') ? 1 : 0;
            $technology->save();
            return fractal($technology->fresh(), new TechnologyTransformer())->respond();
        } catch (Throwable $thr) {
            throw $thr;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $technology = Technology::where('id', '=', $id)->first();
            if ($technology) {
                $technology->delete();
            }
            return response()->json(['message' => 'Technology successfully deleted!'], 200);
        } catch (Throwable $thr) {
            throw $thr;
        }
    }
}
