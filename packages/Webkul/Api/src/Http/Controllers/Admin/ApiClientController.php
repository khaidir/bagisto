<?php

namespace Webkul\Api\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Webkul\Api\Http\Controllers\Controller;
use Webkul\Api\Repositories\ApiClientRepository as ApiClient;

/**
 * ApiClient controlller
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ApiClientController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * ApiClientRepository object
     *
     * @var array
     */
    protected $apiClient;

     /**
     * Create a new controller instance.
     *
     * @param Webkul\Api\Repositories\ApiClientRepository as $apiClient;
     * @return void
     */
    public function __construct(ApiClient $apiClient )
    {
        $this->_config = request('_config');

        $this->apiClient = $apiClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $clients = $this->apiClient->findByField('user_id', auth()->guard('admin')->user()->id);

        return view($this->_config['view'], compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'redirect' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
        ]);

        $data=request()->all();

        if(request()->all()['grant_type'] == 'password') {
            $data['password_client'] = 1;
        }

        unset($data['grant_type']);

        $data['user_id'] = auth()->guard('admin')->user()->id;
        $data['secret'] = str_random(40);

        $this->apiClient->create($data);

        session()->flash('success', 'Client created successfully.');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->apiClient->findOneWhere(['id'=>$id]);

        return view($this->_config['view'], compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'redirect' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
        ]);

        $this->apiClient->update(request()->all(),$id);

        session()->flash('success', 'Client updated successfully.');

        return redirect()->route($this->_config['redirect']);
    }





    public function login() {
        return view($this->_config['view']);
    }

    public function postLogin(Request $request) {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        if(session("url")["intended"] != null){
            $redirect = session("url")["intended"];
        }else{
            $redirect = "/home";
        }

        return Redirect($redirect);
    }
}