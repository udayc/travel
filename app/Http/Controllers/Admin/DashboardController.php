<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
Use Visitor ; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller {

	protected $dashboard;
	
	public function __construct( DashboardRepository $dashboard )
	{
		$this->dashboard = $dashboard;
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex()
	{

		return view('admin.dashboard.index' , [
		
				'users' 				=> $this->dashboard->all('user'),
				'user_login' 			=> 0,
				'user_followers' 		=> 0,
				'projects' 				=> $this->dashboard->all('project'),
				'project_funded' 		=> 0,
				'project_comments' 		=> 0,
				'project_likes' 		=> 0,
				'project_rating' 		=> 0,
				'project_flagged' 		=> $this->dashboard->all('project' , 1),
				'categories'			=> $this->dashboard->all('category'),
				'genres'				=> $this->dashboard->all('genre'), 
				'unique_visitors'		=> Visitor::count(),
				'total_visits'			=> Visitor::count(),
				'page_views'			=> Visitor::clicks(),
				'new_visit'				=> Visitor::range(date("Y-m-d" , time() - 86400), date("Y-m-d" , time() )),
				'total_revenue' 		=> 0,
		
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	
	public function getApi($val)
	{
		if($val == 'pageviews' )  			$count = Visitor::clicks();
		if($val == 'unique-visitors' )  	$count = Visitor::count();
		return response(['msg' => 'success' , 'data' => $count  ]);
		
	}
	
	
	
}
