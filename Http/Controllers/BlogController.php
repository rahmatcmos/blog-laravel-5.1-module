<?php namespace Modules\Blog\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BlogController extends Controller {

	public function index()
	{
		$title = "Blog";
		return view('blog::index')->with('title',$title);
	}

	public function contact()
	{
		$title = "Blog";
		return view('blog::contact')->with('title',$title);
	}

	public function about()
	{
		$title = "Blog";
		return view('blog::about')->with('title',$title);
	}

	public function post()
	{
		$title = "Blog";
		return view('blog::post')->with('title',$title);
	}

}