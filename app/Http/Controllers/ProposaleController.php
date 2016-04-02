<?php

namespace App\Http\Controllers;

use App\Children;
use App\Part;
use App\User;
use App\Proposale;
use Request;
use App\Temporary_proposale;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use Session;
use Input;
use App\News;
use App\Vacation;
use App;
use PDF;
use Validator;

class ProposaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposales = Proposale::join('childrens','proposales.children_id','=','childrens.id')
            ->join('users','proposales.user_id','=','users.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.name as children_name','programs.title as program_name',
                'users.name as user_name',
                'programs.start_date as program_start','programs.finish_date as program_finish')
            ->orderBy('proposales.id','desc')
            ->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('admin.proposales')->with('proposales',$proposales)->with('all_news',$all_news);
    }

    public function get_proposale($id){
        $selected_program_id = $id;
        $selected_program = Program::find($selected_program_id);
         if (!$selected_program){
             $selected_program_id=Program::first()->id;
             $selected_program = Program::find($selected_program_id);
         }
        $selected_vacation = Vacation::where('program_id','=',$selected_program_id)->first();
        $selected_vacation_id = $selected_vacation->id;
        $programs = Program::all();
        $vacations = Vacation::where('program_id','=',$selected_program_id)->get();
        $parts = Part::where('vacation_id','=',$selected_vacation_id)->get();
        $user_id = Session::get('user_id');
        $childrens = Children::where('user_id','=',$user_id)->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale')
            ->with('selected_program',$selected_program)
            ->with('selected_vacation',$selected_vacation)
            ->with('programs',$programs)
            ->with('vacations',$vacations)
            ->with('parts',$parts)
            ->with('childrens',$childrens)
            ->with('all_news',$all_news);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_temporary()
    {
        $proposale = new Temporary_proposale();
        $user_id = Session::get('user_id');
        $proposale->user_id = $user_id;
        $proposale->children_id = Input::get('children');
        $proposale->program_id = Input::get('program_id');
        $proposale->vacation_id = Input::get('vacation_id');
        $proposale->part_id = Input::get('part_id');
        if (!Input::get('transfer')){
            $proposale->transfer = 'нет';
        } else {
            $proposale->transfer = Input::get('transfer');
        }
        $proposale->registration_date = date("d.m.Y");
        $proposale->save();
        $program  = Program::find($proposale->program_id);
        $program->busy_places=$program->busy_places+1;
        $program->save();
        $user=User::find($user_id);
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale_parent')->with('user',$user)
            ->with('proposale_id',$proposale->id)
            ->with('all_news',$all_news);
    }

    public function parent_data_save(){
        $user_id = Input::get('id');
        $proposale_id = Input::get('proposale_id');
        $user = User::find($user_id);
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        if(Input::get('data_processing')){
            $user->data_processing=Input::get('data_processing');
        }
        $user->passport=Input::get('passport');
        $user->passport_date=Input::get('passport_date');
        $user->save();
        $proposale = Temporary_proposale::find($proposale_id);
        $children = Children::find($proposale->children_id);
        if(!$children){
            $children = new Children();
        }
        $all_news = News::where('active','=','1')
            ->get();

        return view('user.proposale_children')
            ->with('children',$children)
            ->with('user',$user)
            ->with('proposale_id',$proposale_id)
            ->with('all_news',$all_news);

    }

    public function children_data_save(){

        $children_id = Input::get('children_id');
        $children = Children::find($children_id);
        if(!$children){
            $children = new Children();
        }

        $children->surname =Input::get('surname');
        $children->name =Input::get('name');
        $children->patronymic=Input::get('patronymic');
        $children->birthday_date=Input::get('birthday_date');
        $children->document=Input::get('document');
        $children->document_number=Input::get('document_number');
        $proposales = Proposale::where('children_id','=',$children_id)->count();
        if ($proposales!=0){
            $children->member=1;
        } else{
            $children->member=0;
            $children->marketing = Input::get('marketing');
        }
        $children->registration=Input::get('registration');
        $children->save();

        $user_id = Input::get('id');

        $proposale_id = Input::get('proposale_id');
        $temporary_proposale = Temporary_proposale::find($proposale_id);
        $proposale = new Proposale();
        $proposale->children_id = $children_id;
        $proposale->user_id = $user_id;
        $proposale->program_id = $temporary_proposale->program_id;
        $proposale->vacation_id = $temporary_proposale->vacation_id;
        $proposale->part_id = $temporary_proposale->part_id;
        $proposale->transfer =$temporary_proposale->transfer;
        $proposale->registration_date = $temporary_proposale->registration_date;
        $proposale->save();
        $temporary_proposale->delete();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale_success',['children'=> $children, 'all_news'=>$all_news]);

    }

    public function all_proposales()
    {
        $user_id = Session::get('user_id');
        $proposales = Proposale::where('proposales.user_id','=',$user_id)
            ->join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->join('vacations','proposales.vacation_id','=','vacations.id')
            ->join('parts','proposales.part_id','=','parts.id')
            ->select('proposales.*','childrens.name as children_name','programs.title as program_name',
                'vacations.start_date as program_start','vacations.finish_date as program_finish',
                'parts.start_date as part_start','parts.finish_date as part_finish',
                'childrens.application_form as application_form','childrens.id as children_id')
            ->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposales')->with('proposales',$proposales)->with('all_news',$all_news);
    }

    public function agreement($id){
        $all_news = News::where('active','=','1')
            ->get();
        $proposale = Proposale::find($id);
        if(!$proposale){
            return view ('user.empty_agreement')->with('all_news',$all_news);
        } else {
//            $program = Program::find($proposale->program_id);
//            $user = User::find($proposale->user_id);
//            $children = Children::find($proposale->children_id);
            return view ('user.agreement')
                ->with('all_news',$all_news)
                //->with('program',$program)
                //->with('user',$user)
                ->with('proposale',$proposale);
                //->with('children',$children);
        }


    }

    public function save_agreement(){
        $proposale = Proposale::find(Input::get('id'));
        if(Request::hasFile('agreement')){
            $image = Input::file('agreement');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png,pdf,doc,docx',)
            );
            $proposale->agreement = upload_file(Input::file('agreement'));
        }
        $proposale->agreement_save = Input::get('agreement_save');
        $proposale->save();
        $all_news = News::where('active','=','1')
            ->get();
        return view ('user.agreement')
            ->with('all_news',$all_news)
            //->with('program',$program)
            //->with('user',$user)
            ->with('proposale',$proposale);
    }

    public function print_agreement($id){
        $all_news = News::where('active','=','1')
            ->get();
        $proposale = Proposale::find($id);
        if(!$proposale){
            return view ('user.empty_agreement')->with('all_news',$all_news);
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
<h3>СОГЛАШЕНИЕ № '.$proposale->id.'</h3>
        <p>на участие ребенка в выездной образовательной программе
        физического и личностного роста</p>
        <p>' . $program->title . '</p>

        <p>г. Пушкино	«___»_________ 20__г.</p>

        <p>Межрегиональная молодёжная общественная организация «Федерация Русского Воинского</p>
        <p> Искусства», именуемая в дальнейшем Организация, в лице Председателя Правления Карпачева Павла</p>
        <p>Юрьевича, действующего на основании Устава, с одной стороны, и родитель</p>

        <p>'.$user->name.'</p>
        <p>(Ф.И.О.)</p>

        <p>паспорт '.$user->passport.' выдан '.$user->passport_date.'</p>
        <p>прописан '.$user->registration.'</p>
        <p>(контактные тел.: '.$user->phone.')</p>
        <p>именуемый(ая) в дальнейшем «Родитель», добровольно, по взаимному согласию заключили Соглашение о нижеследующем:</p>

        <br>
            <h4><b>1. ПРЕДМЕТ СОГЛАШЕНИЯ</b></h4>
        <p>По настоящему Соглашению «Родитель» доверяет своего ребенка</p>
        <p> '.$children->surname.' '.$children->name.''.$children->patronymic.',</p>
        <p>№ св-ва о рождении/паспорта '.$children->document.' Дата рождения '.$children->birthday_date.'</p>
        <p>в поездку (по адресу: '.$program->address.'),</p>
        <p>организуемую «Организацией», для участия в программе «'.$program->title.'», </p>
        <p>а «Организация» обязуется выполнять программу в полном объеме в соответствии с Уставом «Организации»</p>
        <p>и действующим законодательством РФ.</p>
    <br>
        <h4><b>2. ПРАВА И ОБЯЗАННОСТИ СТОРОН</b></h4>
        <p><b>2.1. Права «Родителя»:</b></p>
            <p>-	знакомиться с Уставными документами «Организации» и основными направлениями программы лагеря;</p>
            <p>-	требовать соблюдения «Организацией» своих обязанностей, связанных с проведением программы и обеспечением безопасности жизни и здоровья ребенка;</p>
            <p>-	за «Родителя» может частично или полностью внести денежный взнос 3-е лицо или организация. В этом случае «Родитель» несет полную ответственность за своевременный взнос.</p>
            <p><b>2.2. Обязанности «Родителя»:</b></p>
            <p>-	обеспечить доставку ребенка – участника программы к месту проведения выездных занятий и обратно, в случае если родители сами осуществляют доставку ребёнка к месту проведения программы;</p>
            <p>-	обеспечить, со своей стороны, безопасность ребенка, проконтролировав отсутствие любых видов пирсинга на его теле;</p>

            <p>-	предоставить для участия ребенка в программе все необходимые документы и медицинские справки в соответствии с Приложением №11 настоящего Соглашения</p>
            <p>и нести полную ответственность за подлинность документов и достоверность информации;</p>
            <p>-обеспечить ребенка всеми необходимыми вещами;</p>
            <p>-	перед поездкой осуществить проверку багажа и личных вещей ребенка на наличие запрещенных предметов;</p>
            <p>-	разъяснить ребенку важность соблюдения обязанностей согласно п.2.3 настоящего Соглашения;</p>
            <p>- в соответствии с Приложением №22 настоящего Соглашения ознакомить ребенка с общими правилами поведения и инструкциями по технике безопасности:</p>
            <p>а) на территории базы пребывания;</p>
            <p>б) при выходе на экскурсии за территорию базы расположения;</p>
            <p>в) во время спортивных мероприятий;</p>
            <p>г) при купании;</p>
            <p>д) при выходе в поход</p>
            <p>-оплатить материальный ущерб, нанесенный лагерю, в случае порчи ребенком имущества.</p>
            <p><b>2.3. Обязанности «Ребенка – участника программы»:</b></p>
            <p>-	соблюдать правила внутреннего распорядка дня и дисциплины;</p>
            <p>-	соблюдать технику безопасности;</p>
            <p>-	с уважением относиться к своим сверстникам и персоналу;</p>
            <p>-	следить за чистотой и соблюдать порядок на территории и в помещениях;</p>
            <p>-	бережно относиться к имуществу лагеря; в случае неоднократной порчи имущества или оборудования лагеря ребенок может </p>
            <p>быть лишен возможности дальнейшего участия в программе;</p>
            <p>-	самому отвечать за сохранность своих вещей;</p>
            <p>-	незамедлительно сообщать вожатому или инструктору, медицинскому сотруднику или директору о недомоганиях или болезнях.</p>
            <p><b>2.4. Права «Организации»:</b></p>
            <p>-	самостоятельно разрабатывать и выбирать направления программы и педагогические методы преподавания, не противоречащие </p>
            <p>Уставу «Организации», настоящему Соглашению и действующему законодательству РФ;</p>
            <p>-	проводить дополнительные сверхурочные образовательные и досуговые мероприятия;</p>
            <p>-	расходовать денежные средства организационного взноса на приобретение билетов, оплату проживания, питания, прочих расходов,</p>
            <p>связанных с проведением программы;</p>
            <p>-	отправить ребенка домой без возврата денежного взноса за грубое нарушение правил внутреннего распорядка дня и дисциплины,</p>
            <p>нецензурную речь и оскорбления, сознательное нарушение техники безопасности, порчу имущества, курение, употребление спиртных напитков, </p>
            <p>психотропных и наркотических средств.</p>
            <p><b>2.5. Обязанности «Организации»:</b></p>
            <p>-	провести программу в полном объеме;</p>
            <p>-	обеспечить сохранность здоровья ребенка при прохождении программы.</p>
            <h4><b>3. ОТВЕТСТВЕННОСТЬ СТОРОН</b></h4>
            <p>3.1.	«Организация» несет ответственность за проведение и организацию программы.</p>
            <p>3.2.	«Родитель» несет ответственность за поведение ребенка, правдивость информации о ребенке, а также достоверность и подлинность предоставленных</p>
            <p>медицинских справок и документов.</p>

            <h4><b>4. ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ И ЗАКЛЮЧИТЕЛЬНЫЕ ПОЛОЖЕНИЯ</b></h4>
            <p>4.1.	Настоящий договор составлен в двух экземплярах, имеющих одинаковую юридическую силу.</p>
            <p>4.2.	Обязательства считаются выполненными, если в течение 1 дня после окончания программы одна из сторон не предъявила своих претензий или возражений</p>
                <p>в письменном виде лицу, заключившему договор или руководителю программы.</p>

            <h4>   <b>     5. АДРЕСА И РЕКВИЗИТЫ СТОРОН</b></h4>

            <p>        ММОО «Федерация Русского Воинского Искусства», Адрес: 141231, Московская область, Пушкинский р-н,</p>
            <p>п.Лесной, ул.Гагарина, 6, оф.29</p>

            <p>        Наш сайт:	www.skillcamp.ru</p>
            <p>Е-mail:	info@skillcamp.ru</p>
            <p>Тел.:	+7 (495) 943-79-25, +7 (495) 973-14-28</p>

            <p>        Председатель</p>
            <p>Правления	П.Ю. Карпачев</p>
            <p>«____»_____________20___ г.</p>

            <p>        Родитель</p>

            <p>        '.$user->name.'</p>


            <p>        Подпись ______________/_____________________________/</p>

            <p>«____»_____________20___ г.</p>


            <p>В случае отказа от участия в программе до ее начала или в течение программы, добровольный организационный взнос не возвращается,</p>
            <p>а  может быть частично перенесен на последующие программы за вычетом понесенных (от 10 до 30 % при отказе до начала программы.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Доверяю расходовать денежные средства организационного взноса на приобретение билетов, оплату проживания, питания, прочих расходов,</p>
            <p>связанных с проведением программы.</p>

            <p>        _________________________</p>
            <p>(подпись родителя)</p>
            <p>Согласен на участие ребенка во всех мероприятиях программы, принципами и методами работы.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Не возражаю против применения дисциплинарных мер, адекватных ситуации, в случае несоблюдения моим ребенком правил техники безопасности</p>
            <p>и установленных правил.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Подтверждаю, что мой ребенок здоров физически и психически.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Даю согласие на участие моего ребенка в занятиях, с повышенной физической нагрузкой (справку от педиатра, допускающая ребенка до занятий</p>
            <p>с повышенной физической нагрузкой обязуюсь предоставить до начала программы).</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Согласен с условиями возвращения ребенка до окончания программы, в случае грубого нарушения им правил техники безопасность или по</p>
            <p>собственному желанию ребенка, без возмещения стоимости пребывания на программе.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>Даю согласие на размещение фотографий с участием моего ребенка с программы «________________» в сети интернет в оригинальном разрешении,</p>
            <p>а также на их использование в печатном виде.</p>
            <p>_________________________</p>
            <p>(подпись родителя)</p>
            <p>С программой, Сводом правил и положений, техникой безопасности и условиями пребывания моего ребенка (информация на сайте) ознакомлен(а).</p>

            <p>        Ребенок ознакомлен с общими правилами поведения и инструкциями по технике безопасности (п.2.2)</p>


            <p>(подпись родителя)</p>


            <p>_________________________</p>
            <p>(подпись родителя)</p>

            <p>        Даю согласие на добровольное участие в программе физического и личностного роста «_______________», с общими правилами поведения</p>
            <p>и инструкциями по технике безопасности ознакомлен(а) (п.2.2.).</p>



            <p>_________________________</p>
            <p>(подпись ребенка)</p>
            </body>
</html>
            ');

            return $pdf->stream();
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
        //
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
        $temporary_proposale = Temporary_proposale::find($id);
        if(!$temporary_proposale){
            return redirect('/');
        }
        $temporary_proposale->delete();
        $all_news = News::where('active','=','1')
            ->get();
        return redirect('/');
    }
}
