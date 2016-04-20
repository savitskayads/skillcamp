<?php

namespace App\Http\Controllers;

use App\Child;
use App\Part;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Input;
use App\User;
use Validator;
use Mail;
use Flash;
use Redirect;
use App\News;
use PDF;
use App;
use App\Proposale;
use App\Program;
use App\Children;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Session::get('user_id');
        $user = User::find($id);
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.person')->with('user',$user)->with('all_news',$all_news);
    }

    public function login(){

        $all_news = News::where('active','=','1')
            ->get();

        if(Auth::check()){
            return view('user.person')->with('all_news',$all_news);
        } else {
            return view('auth.login')->with('all_news',$all_news);
        }
    }

    public function authenticate()
    {
        $email=Input::get('email');
        $password=Input::get('password');
        $message = '';
        $all_news = News::where('active','=','1')
            ->get();

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            if(Auth::user()->confirmed != 1){
                $id = Auth::user()->id;
                $message = 'e-mail не подтвержден!';
                $message_type = 'not_confirmed';
                return view('auth.login')
                    ->with('message',$message)
                    ->with('message_type',$message_type)
                    ->with('email',$email)
                    ->with('id',$id)
                    ->with('all_news',$all_news);
            }
            return redirect()->intended('user')->with('all_news',$all_news);
        }
        else
        {
            $message = 'Неверные данные!';
            $message_type = 'data_error';
            return view('auth.login')
                ->with('message',$message)
                ->with('message_type',$message_type)
                ->with('email',$email)
                ->with('all_news',$all_news);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function confirmation_code($id){

        $confirmation_code = str_random(30);
        $all_news = News::where('active','=','1')
            ->get();

        $user = User::find($id);
        $email = $user->email;
        $user->confirmation_code = $confirmation_code;
        $user->save();
        Mail::send('emails.verify', array('confirmation_code' => $confirmation_code,'email' => $email), function($message) use ($email) {
            $message->to($email, 'User')
                ->subject('Подтверждение e-mail');
        });
        return view('auth.login')->with('all_news',$all_news);
    }

    public function create()
    {
        //
    }
//admin actions
    public function show_all(){
        $users = User::where('name','!=','admin')->get();
        return view('admin.users')->with('users',$users);
    }

    public function admin_create()
    {
        $user = new User();
        return view('admin.edit_user')->with('user',$user);
    }

    public function admin_edit($id)
    {
        $user = User::find($id);
        return view('admin.edit_user',['user'=> $user]);
    }

    public function admin_save()
    {
        $id = Input::get('id');
        $user = User::find($id);
        if(!$user) {
            $user = new User;
        }
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->confirmed=Input::get('confirmed');
        $user->phone=Input::get('phone');
        $user->save();
        return redirect('admin/users');
    }

    public function admin_destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/users');
    }


    public function save()
    {
        $id = Input::get('id');
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        $all_news = News::where('active','=','1')
            ->get();
        if(Input::get('passport')){
            $user->passport=Input::get('passport');
            $user->passport_date=Input::get('passport_date');
        }
        $user->data_processing=Input::get('data_processing');
        $user->delivery=Input::get('delivery');
        $user->save();
        return redirect('user/'.$user->id.'/edit')->with('all_news',$all_news);
    }

    public function check_email()
    {
        $email = Request::input('email');
        $users = User::where('email','=',$email)->count();
        if($users > 0){
            return 'false';
        }else {
            return 'true';
        }
    }

    public function check_password()
    {
        $email = Input::get('email');
        $users = User::where('email','=',$email)->count();
        if($users > 0) {
            return 'false';
        }else {
            return 'true';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.edit',['user'=> $user, 'all_news'=>$all_news]);
    }

    public function empty_form(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
  body { font-family: DejaVu Sans, sans-serif; }
</style>
</head>
<body>
            <h3><b>АНКЕТА УЧАСТНИКА<h3> программы личностного и физического роста</b>

            <p>1. <b>ФИО ребенка</b>  __________________________________________________________________________</p>
            <p>____________________________________</p>
               <p>Дата и год рождения ребенка _______________________</p>
                <p>№ школы ___________________________ _________________________</p>
                 <p>класс _________ «_________»</p>
                <p>2. Тип каникул  (сезон): ______________________________________________</p>
                <p>3. Вид документа ______________________________________</p>
                <p>4. Серия номер документа ребенка ______________________________________</p>
                <p>5. Почтовый индекс _________________________</p>
                <p>6. Адрес фактического проживания ________________________________________________________</p>
                <p>_______________________________________________________________________________________</p>
                <p>7. Выезжал ли Ваш ребенок в лагеря ранее (на 7 и более дней)? ____</p>
                 <p>Сколько раз, начиная с какого возраста______________</p>
                <p>8. Какими видами спорта занимался (занимается) Ваш ребенок</p>
                <p>_____________________________________________________</p>
                <p>9. Новый/старый участник? __________</p>
                 <p>Если новый, откуда Вы узнали о нас? _____________________</p>

                <p>            8. МЕДИЦИНСКИЕ ДАННЫЕ</p>
                <p>хронические заболевания___________________________________________________________________________________</p>
                <p>склонность к простудным заболеваниям_______________________</p>
                 <p>как переносит солнце____________________________</p>
                <p>необходимость диеты (указать, какая) _______________________________________________________________________</p>
                <p>аллергические реакции (если были, указать, когда – даже единичный случай, начиная с рождения, на что, как проявляется,</p>
                <p>какие необходимы средства для снятия аллергии)</p>
                <p>__________________________________________________________________________________________________________________________</p>
                <p>__________________________________________________________________________________________________________________________</p>
                <p>есть ли аллергические реакции на лекарственные препараты (указать, на какие)_____________________________________</p>
                <p>реакция на укусы насекомых________________________________________________________________________________</p>
                <p>укачивает ли в транспорте__________________________________________________________________________________</p>
                <p>с какими болезнями лежал в больнице (указать, когда)__________________________________________________________</p>
                <p>операции (если были, указать, какие и когда)__________________________________________________________________</p>
                <p>переломы (если были, указать, какие и когда)__________________________________________________________________</p>
                <p>сотрясения мозга (если были, указать, какой степени и когда)____________________________________________________</p>
                <p>есть ли необходимость в приеме каких-либо лекарств___________________________________________________________</p>
                <p>делали ли прививку против клещевого энцефалита _____________________________________________________________</p>
                <p>другие особенности________________________________________________________________________________________</p>

                <p>            10. ФИЗИЧЕСКОЕ СОСТОЯНИЕ</p>
                <p>группа физподготовки (основная, подготовительная, ЛФК)</p>
                <p>умение плавать__________________________________</p>
                <p>боязнь высоты___________________________________</p>
                <p>боязнь темноты__________________________________</p>
                <p>боязнь животных_________________________________</p>
                <p>реакция на физическую нагрузку __________________</p>
                <p>быстрая утомляемость____________________________</p>
                <p>зрение, ношение очков ___________________________</p>
                <p>другие особенности______________________________</p>
                <p>___________________________________________________</p>

                <p>11. ИНДИВИДУАЛЬНЫЕ ОСОБЕННОСТИ</p>
                <p>перечислите 5 наиболее выраженных черт характера, присущих Вашему ребенку: ___________________________________</p>
                <p>_________________________________________________________________________________________________________</p>
                <p>чем занимается с удовольствием? ____________________________________________________________________________</p>
                <p>чем не любит заниматься? __________________________________________________________________________________</p>
                <p>какая ситуация может оказаться трудной, стрессовой? __________________________________________________________</p>
                <p>отношение к вещам (узнает ли свои вещи, любит ли терять вещи)_________________________________________________</p>
                <p>способность к самообслуживанию (по 10-балльной шкале)______ Какие действия нужно проконтролировать</p>
                <p>(подчеркнуть нужное): личная гигиена; переодеться, если мокро и холодно; сушка и уход за вещами; поход в баню;_________________.</p>
                <p>с кем предпочитает общаться Ваш ребенок (с младшими, с ровесниками, со старшими).</p>
                <p>Есть ли трудности в общении? ___ _________________________________________________________________________________________________________</p>
                <p>каким образом можно убедить Вашего ребенка соблюдать правила и договоренности?_______________________________</p>
                <p>_________________________________________________________________________________________________________</p>
                <p>отношение к курению и употреблению спиртных напитков_______________________________________________________</p>

                <p>            12. Размер одежды ребенка (для выдачи сувенирной продукции)___________ РОСТ/ВЕС ребёнка_________________________</p>
                <p>13. Состав семьи (перечислить): _________________________________________________________________________________</p>
                <p>Фамилии, имена, отчества и контактные телефоны родителей (законных представителей):</p>
                <p>1. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________</p>
                <p>2. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________ </p>
                <p>3. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________</p>
                <p>____________________________________________________________________________________________________________</p>
                <p>E-mail (в т.ч. для информации об отъезде в лагерь) ______________________________________________________________</p>
                <p>14. Что еще Вы считаете необходимым рассказать о своем ребенке (пожелания можно так же написать на обороте анкеты)____</p>
                <p>_____________________________________________________________________________________________________________</p>
                <p>Дата заполнения анкеты «______»_________________20__  г.</p>
                 <p>Анкету заполнил (а)_____________________________________</p>_

                <p>Сведения, указанные в анкете, будут доступны начальнику лагеря, педагогам и инструкторам, работающим с участником, врачу.</p>
                <p>На обратной стороне просим указать Ваши ожидания по программе, а так же Ваши предложения и пожелания.</p>
</body></html>

        ');
        return $pdf->stream();
        //return view('form');
    }

    public function form($id){
        $proposale = Proposale::find($id);
        if(!$proposale){
            return $this->empty_form();
        } else {
            $program = Program::find($proposale->program_id);
            $user = User::find($proposale->user_id);
            $children = Children::find($proposale->children_id);

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML('
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
  body { font-family: DejaVu Sans, sans-serif; }
</style>
</head>
<body>
            <h3><b>АНКЕТА УЧАСТНИКА<h3> программы личностного и физического роста</b>

            <p>1. <b>ФИО ребенка</b> ' . $children->surname . ' ' . $children->name . ' ' . $children->patronimic . ' </p>

               <p>Дата и год рождения ребенка ' . $children->birthday_date . '</p>
                <p>№ школы '.$children->school_number.' </p>
                 <p>класс'.$children->school_class.'</p>
                <p>2. Тип каникул  (сезон): '.$program->season.'</p>
                <p>3. Вид документа '.$children->document.'</p>
                <p>4. Серия номер документа ребенка '.$children->document_number.'</p>
                <p>5. Почтовый индекс ____________ </p>
                <p>6. Адрес фактического проживания '.$children->adress.'</p>
                <p></p>
                <p>7. Выезжал ли Ваш ребенок в лагеря ранее (на 7 и более дней)? '.$children->sea.'</p>
                 <p>Сколько раз, начиная с какого '.$children->sea_item.'</p>
                <p>8. Какими видами спорта занимался (занимается) Ваш ребенок</p>
                <p>'.$children->sport.'</p>
                <p>9. Новый/старый участник? '.$children->member.'</p>
                 <p>Если новый, откуда Вы узнали о нас? '.$children->marketing.'</p>

                <p>            8. МЕДИЦИНСКИЕ ДАННЫЕ</p>
                <p>хронические '.$children->chronic.'</p>
                <p>склонность к простудным заболеваниям'.$children->cold.'</p>
                 <p>как переносит солнце '.$children->sun.'</p>
                <p>необходимость диеты (указать, какая) '.$children->diet.'</p>
                <p>аллергические реакции (если были, указать, когда – даже единичный случай, начиная с рождения, на что, как проявляется,</p>
                <p>какие необходимы средства для снятия аллергии)</p>
                <p>'.$children->allergy.' '.$children->medicine_allergy.' '.$children->not_allergy.'</p>
                <p></p>
                <p>есть ли аллергические реакции на лекарственные препараты (указать, на какие) '.$children->medicine_allergy.'</p>
                <p>реакция на укусы насекомых '.$children->insects_allergy.'</p>
                <p>укачивает ли в транспорте '.$children->train.'</p>
                <p>с какими болезнями лежал в больнице (указать, когда) '.$children->ills.'</p>
                <p>операции (если были, указать, какие и когда) '.$children->operations.'</p>
                <p>переломы (если были, указать, какие и когда) '.$children->rupture.'</p>
                <p>сотрясения мозга (если были, указать, какой степени и когда) '.$children->concussion.'</p>
                <p>есть ли необходимость в приеме каких-либо лекарств '.$children->another_medicine.'</p>
                <p>делали ли прививку против клещевого энцефалита '.$children->bad_bug.'</p>
                <p>другие особенности '.$children->another_medicine.'</p>

                <p>            10. ФИЗИЧЕСКОЕ СОСТОЯНИЕ</p>
                <p>группа физподготовки (основная, подготовительная, ЛФК) '.$children->physics.'</p>
                <p>умение плавать '.$children->swim.'</p>
                <p>боязнь высоты '.$children->fear_height.'</p>
                <p>боязнь темноты '.$children->fear_dark.'</p>
                <p>боязнь животных '.$children->fear_animals.'</p>
                <p>реакция на физическую нагрузку '.$children->physics_reaction.'</p>
                <p>быстрая утомляемость '.$children->fatiguability.'</p>
                <p>зрение, ношение очков '.$children->vision.'</p>
                <p>другие особенности '.$children->health.'</p>
                <p></p>

                <p>11. ИНДИВИДУАЛЬНЫЕ ОСОБЕННОСТИ</p>
                <p>перечислите 5 наиболее выраженных черт характера, присущих Вашему ребенку: '.$children->trait.'</p>
                <p></p>
                <p>чем занимается с удовольствием? '.$children->pleasure.'</p>
                <p>чем не любит заниматься? '.$children->not_pleasure.'</p>
                <p>какая ситуация может оказаться трудной, стрессовой? '.$children->stress.'</p>
                <p>отношение к вещам (узнает ли свои вещи, любит ли терять вещи) '.$children->things.'</p>
                <p>способность к самообслуживанию (по 10-балльной шкале) '.$children->self.' Какие действия нужно проконтролировать</p>
                <p>(подчеркнуть нужное): личная гигиена; переодеться, если мокро и холодно; сушка и уход за вещами; поход в баню; '.$children->control.'.</p>
                <p>с кем предпочитает общаться Ваш ребенок (с младшими, с ровесниками, со старшими) '.$children->communication.'</p>
                <p>Есть ли трудности в общении? '.$children->communication_discomfort.'</p>
                <p>каким образом можно убедить Вашего ребенка соблюдать правила и договоренности? '.$children->conviction.'</p>
                <p></p>
                <p>отношение к курению и употреблению спиртных напитков '.$children->bad_baby.'</p>

                <p>            12. Размер одежды ребенка (для выдачи сувенирной продукции) '.$children->clothing_size.' РОСТ/ВЕС ребёнка '.$children->height.' '.$children->weight.'</p>
                <p>13. Состав семьи (перечислить): '.$children->family.'</p>
                <p>Фамилии, имена, отчества и контактные телефоны родителей (законных представителей):</p>
                <p>1. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________</p>
                <p>2. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________ </p>
                <p>3. ФИО____________________________________Тел. (моб)___________________________ (раб)_________________________</p>
                <p>____________________________________________________________________________________________________________</p>
                <p>E-mail (в т.ч. для информации об отъезде в лагерь) '.$user->email.'</p>
                <p>14. Что еще Вы считаете необходимым рассказать о своем ребенке (пожелания можно так же написать на обороте анкеты)____</p>
                <p>_____________________________________________________________________________________________________________</p>
                <p>Дата заполнения анкеты « ______ »_________________20__  г.</p>
                 <p>Анкету заполнил (а)_____________________________________</p>_

                <p>Сведения, указанные в анкете, будут доступны начальнику лагеря, педагогам и инструкторам, работающим с участником, врачу.</p>
                <p>На обратной стороне просим указать Ваши ожидания по программе, а так же Ваши предложения и пожелания.</p>
</body></html>

        ');
            return $pdf->stream();
        }
        //return view('form');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
