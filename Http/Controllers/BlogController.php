<?php namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Prologue\Alerts\Facades\Alert;

class BlogController extends Controller {

	public function index()
	{
		$title = "Blog::Home";
		return view('blog::index')->with('title',$title);
	}

	public function contact()
	{
		$title = "Blog::Contato";
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

	public function post_contact(Request $request)
	{
		$rules = [
			'name'=>'required|min:1',
			'email'=>'required|email',
			'phone'=>'required|regex:/^\([1-9]{2}\) [2-9][0-9]{3,4}\-[0-9]{4}$/',
			'message'=>'required|min:10',
			'g-recaptcha-response' => 'required|captcha'
		];

		$messages = [
			'name.min'=>'O campo Nome precisa ser preenchido!',
			'phone.regex'=>'O campo telefone precisa estar no padrão (xx) xxxxx-xxxx!',
			'g-recaptcha-response.required'=>'Você precisa confirmar que não é um robô!',
			'g-recaptcha-response.captcha'=>'O ReCAPTCHA precisa ser um código CAPTCHA válido!'
		];

		$validator = Validator::make($request->all(),$rules,$messages);

		if($validator->fails()){
			return redirect()
				->route('blog.contact')
				->withErrors($validator->errors())
				->withInput();
		}


		//Enviar email

		/*Mail::send('email.template',
			array(
				'site_domain' => $this->site_domain,

				'nome' => $request->get('nome'),
				'email' => $request->get('email'),
				'telefone' => $request->get('telefone'),
				'mensagem' => $request->get('mensagem')
			), function($message)
			{
				$message->from(env('MAIL_USERNAME', null));
				$message->to(env('MAIL_USERNAME', null), 'Site Admin')->subject('Contato do site '.$this->site_domain);
			});*/

		//Log Users action
		Log::info('Usuário com ip '.$request->getClientIp(). ' enviou um email pelo site');


		//Redirect back
		Alert::success('Obrigado pelo contato!');
		return redirect(route('blog.contact'));
	}

}