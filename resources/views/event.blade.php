@extends('layout')
@section('content')

	<div class="page wrapper event">
		<div class="content wrap">
			<div class="head">
				<div class="image"><img src="{!! web_url() !!}/uploads/big/{{ $program->image }}" alt=""></div>
				<div class="title"><h1>« {{ $program->title }} » Зима 2016</h1></div>
			</div>
			<div class="information clear">
				<div class="head"><span>Основная информация</span></div>
				<div class="content">
					<div class="col clear">
						<div class="line">
							<div class="title"><span>Возраст</span></div>
							<div class="value"><span>Для детей {{  $program->age }}</span></div>
						</div>
						<div class="line">
							<div class="title"><span>Пол</span></div>
							<div class="value"><span>
									@if($program->sex=="mens")мальчики
									@elseif($program->sex=="womens")девочки
									@elseмальчики и девочки
									@endif
								</span></div>
						</div>
						<div class="line">
							<div class="title"><span>Количество мест</span></div>
							<div class="value"><span>осталось {{ $program->places - $program->busy_places }}</span></div>
						</div>
						<div class="line">
							<div class="title"><span>Дата проведения</span></div>
							<div class="value"><span>с {{ date('d/m/Y'($program->start_date) }} по {{ date('d/m/Y'($program->finish_date) }}</span></div>
						</div>
					</div>
					<div class="col clear">
						<div class="price">
							<div class="main">
								<div class="sale"><span>{{ $program->action_price }}</span><div class="info" tooltip="{{$program->action_description}}"><i class="fa fa-info-circle"></i></div></div>
								<div class="original"><span>{{ $program->price }}</span></div>
							</div>
							<div class="bottom">
								<div class="order"><i class="fa pull-left fa-shopping-cart"></i><span><a href="{{web_url()}}/user/proposale/{{$program->id}}">Заказать</a></span></div>
								<div class="info"><a href=""><span><i class="fa pull-left fa-info"></i>Получить дополнительную информацию</span></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="description">
				<div class="head"><span>Описание программы</span></div>
				<div class="content">
					<p>{{  $program->description }}</p>

				</div>
			</div>
			<div class="description">
				<div class="head"><span>Подробная информация</span></div>
				<div class="content">
					<h3>Цель программы:</h3>
					<p>- развитие самостоятельности, ответственности, осознанности, приобретение навыков самообслуживания.</p>
					<h3>Задачи программы:</h3>
					<p>- воспитание трудом;</p>
					<p>- приучить ребёнка к внутреннему порядку;</p>
					<p>- мотивировать участника быть самодостаточным;</p>
					<p>- показать преимущества умелого над неумёхой;</p>
					<p>- погрузить в образцовую среду, где все заняты делом;</p>
					<p>- развивать навыки общения со сверстниками;</p>
					<p>- освоение каждым участником конкретных бытовых навыков;</p>
					<p>- воспитание общинности и коллективизма:</p>
					<p>- воспитание ребёнка-созидателя-помощника, а не потребителя.</p>
					<h3>Дисциплины на программе:</h3>
					<p>- приготовление простых блюд (яичницы, блинов, макарон, вареного и печеного картофеля);</p>
					<p>- воспитание культуры тела (базовая зарядка каждый день);</p>
					<p>- навыки самообороны в школе и на улице (учим просто и эффективно постоять за себя) и защиты от уличных собак;</p>
					<p>- стирка одежды вручную;</p>
					<p>- поддержание опрятного внешнего вида и порядка в жилом помещении;</p>
					<p>- личная гигиена (мытье ног и рук, умывание, чистка зубов, гигиена тела);</p>
					<p>- мелкий ремонт одежды (пришивание пуговиц и заплат);</p>
					<p>- знакомство с лесом и базовые лесные правила (выбор и оборудование стоянки, разведение костра и заготовка дров для него);</p>
					<p>- совместные задачи с программой «Штурм» ;</p>
					<p>- активные игры на улице и в лесу, посещение бассейна.</p>
					<h3>Возраст, условия участия:</h3>
					<p>Стать участником программы могут мальчишки и девчонки, в возрасте от 6 до 12 лет. Родители участника должны полностью согласиться с методами работы, принятыми на программе, разделять ценности Лагеря навыка. Участник должен быть здоров (не иметь кардио-, психо-, невропатологий). До подписания соглашения родителям необходимо ознакомиться с фильмами про программы Лагеря навыка, со статьями и правилами на сайте Лагеря навыка, с целями и задачами программы и в случае неприятия чего-либо отказаться от участия. Необходимо понимать, что Лагерь навыка - не массовый оздоровительный лагерь и подходит не всем.</p>
					<h3>Проживание:</h3>
					<p>в кирпичных корпусах, комфортабельных номерах, рассчитанных на 3-5 чел., удобства рядом с номером на блок. В номере кровать, тумбочка, шкаф. Все номера, душ и туалет после современного ремонта.</p>
					<h3>Инфраструктура базы:</h3>
					<p>- большой плавательный бассейн (включён в стоимость, просим иметь с собой шапочку, плавки и справку для бассейна);</p>
					<p>- несколько больших спортивных залов;</p>
					<p>- просторные холлы в корпусе;</p>
					<p>- большая ухоженная территория, удаленность от населённых пунктов, дорог и предприятий;</p>
					<p>- большой кинотеатр;</p>
					<p>- площадка для занятий на открытом воздухе.</p>
					<h3>Питание:</h3>
					<p>- 5 разовое (завтрак, обед, полдник, ужин, сонник) - согласно нормам детского питания.</p>
					<h3>Медобслуживание:</h3>
					<p>На территории базы имеется медицинский корпус, оснащённый всем необходимым, есть изолятор. На программах Лагеря навыка работает собственный медицинский работник.</p>
					<p>- территория базы охраняется собственной службой безопасности.</p>
					<h3>Педагогический состав:</h3>
					<p>Руководитель программы – Коптев Кирилл Владимирович.</p>
					<h3>Режим дня:</h3>
					<p>8.00 Подъём</p>
					<p>8.15 Зарядка</p>
					<p>8.45 Утренняя гигиена</p>
					<p>9.00 Завтрак</p>
					<p>9.30 Уборка комнат</p>
					<p>10.00 Учебный Блок №1</p>
					<p>12.00 Учебный Блок №2</p>
					<p>13.30 Обед</p>
					<p>14.00 Время для сна и отдыха</p>
					<p>14.00 Время для дополнительных занятий</p>
					<p>15.45 Полдник</p>
					<p>16.00 Учебный Блок №3, бассейн / игровой блок</p>
					<p>19.30 Ужин</p>
					<p>20.00 Блок №4 вечерний</p>
					<p>22.00 Второй ужин, общий сбор</p>
					<p>23.00 Отбой</p>
					<h3>Традиции лагеря:</h3>
					<p>На всех программах Лагеря навыка участникам запрещено пользоваться мобильными телефонами и другими электронными устройствами, давать их с собой не следует. Если ребёнок по какой-либо причине отстраняется от участия в программе об этом администратор или медик уведомит родителей. Родительский день, а также телефонные разговоры с ребёнком на коротких семидневных программах не предусмотрены. Исключение составляют экстренные случаи, связаться можно через телефон руководителя.</p>
					<p>Можно дать ребёнку неограниченное количество лакомств, имеющих длительный срок хранения без холодильника (конфеты, печенья, шоколад). Но имейте ввиду, что по традициям нашего Лагеря всё это пойдёт на общий стол его группы к вечернему чаю. Весь скоропорт будет изъят и утилизирован.
					<h3>Место проведения:</h3>
					<p>ДОЦ «Родник» Московская область, Пушкинский район, пос. Зверосовхоз, д. Хотилово (ориентир КП «Медвежье озеро»). Проезд через малое бетонное кольцо, с Красноармейского шоссе поворот в сторону Ногинска, через несколько километров поворот направо по указателю.</p>
					<p>К месту проведения программы участники доставляются организованной группой.</p>
					<h3>В стоимость участия входит:</h3>
					<p>- проведение указанной программы;</p>
					<p>- проживание;</p>
					<p>- питание;</p>
					<p>- медицинское обслуживание;</p>
					<p>- прохождение всех заявленных дисциплин и пользование оборудованием;</p>
				</div>
			</div>
			<div class="gallery">
				<div class="head">
					<span>Фотографии</span>
					<div class="more"><a href="/gallery/event-1-11022016/"><span><i class="fa pull-left fa-picture-o"></i>Посмотреть все</span></a></div>
				</div>
				<div class="content-list clear">
					<div class="item" gallery-image-link="images/gallery/big/1.jpg" gallery-image="1" gallery-id="event-1-11022016" gallery-title="Название фото">
						<div class="content">
							<div class="image"><img src="images/gallery/small/1.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/2.jpg" gallery-image="2" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/2.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/3.jpg" gallery-image="3" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/3.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/4.jpg" gallery-image="4" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/4.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/5.jpg" gallery-image="5" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/5.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/6.jpg" gallery-image="6" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/6.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/7.jpg" gallery-image="7" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/7.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/8.jpg" gallery-image="8" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/8.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/9.jpg" gallery-image="9" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/9.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/10.jpg" gallery-image="10" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/10.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
					<div class="item" gallery-image-link="images/gallery/big/11.jpg" gallery-image="11" gallery-id="event-1-11022016">
						<div class="content">
							<div class="image"><img src="images/gallery/small/11.jpg" alt=""></div>
							<div class="overlay"><div class="title"><span>Название фото</span></div></div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					(function($) {
						$('.gallery .item').children('.content').on('click', function() {
							openGallery($(this).parent());
						});

						$(document).ready(function() {
							$(".gallery .item img").each(function(){
								$(this).cover();
							});
						});
					})(jQuery);
				</script>
			</div>
			<div class="description">
				<div class="head"><span>Необходимые документы</span></div>
				<div class="content">
					<p>- соглашение (оригинал) - высылается по электронной  почте после бронирования;</p>
					<p>- свидетельство о рождении;</p>
					<p>- копию полиса обязательного медицинского страхования;</p>
					<p>- справку для отъезжающего в лагерь (прививки и отсутствие контактов с инфекционными больными);</p>
					<p>- справку для бассейна;</p>
					<p>* При передаче документов представителям лагеря, необходимо также сдать 2000 рублей на временный счёт. Деньги возвращаются обратно, если ребёнок сдаст весь выданный инвентарь.</p>
				</div>
			</div>
			<div class="description">
				<div class="head"><span>Что брать с собой</span></div>
				<div class="content">
					<p>1. Рюкзак или спортивная сумка, или чемодан на колесиках, чтобы в руках не было большого количества сумочек и пакетов. Сумка не должна быть большой, она подбирается из расчета того, чтобы ребенок мог нести ее самостоятельно. Желательно, чтобы сумка была одна, при необходимости можно дать ребенку небольшой рюкзак. Важно – багаж должен быть в количестве не более двух единиц, ребёнку самостоятельно придётся нести свои вещи.</p>
					<p>2. Шлёпки для хождения по корпусу и посещения бассейна.</p>
					<p>3. Кеды для занятий в зале.</p>
					<p>4. Полуботинки или ботинки для занятий на улице в сырую и прохладную погоду.</p>
					<p>5. Свитер - 2 шт.</p>
					<p>6. Спортивный костюм.</p>
					<p>7. Брюки плотные не маркие.</p>
					<p>8. Комплект влаговетрозащитной верхней одежды (штормовка, накидка от дождя).</p>
					<p>9. Шерстяная шапочка.</p>
					<p>10. Перчатки тёплые - 2 пары.</p>
					<p>11. Термобельё.</p>
					<p>12. Нижнее бельё не менее 2/х комплектов (носки х/б, футболки, трусы).</p>
					<p>13. Шерстяные носки - 2 пары.</p>
					<p>14. Принадлежности для личной г.игиены (полотенца для тела и ног, зубную щётку и пасту, мыло, шампунь, мочалку, иные предметы личной гигиены).</p>
					<p>15. Шапочку, плавки, полотенце, справка для бассейна.</p>
					<p>16. Личная аптечка (особенные лекарства необходимые именно вашему ребёнку). В случае, если Вы даете ребенку с собой какие-либо лекарства, обязательно предупредите его, чтобы он не «лечил» друзей. Потребление любых, даже личных, препаратов только под контролем кураторов или врача.</p>
					<p>17. Налобный фонарик с запасом батареек.</p>
					<p>18. Блокнот, ручка, карандаш.</p>
					<p>19. Часы наручные (самые простые, для контроля времени).</p>
					<p>20. Рекомендуем иметь свою кружку для вечерних чаепитий.</p>
					<p>21. Остальное – на усмотрение родителей.</p>
					<p>* Мобильные телефоны, плееры, игровые консоли строго запрещены и будут изъяты по приезду.</p>
					<p>Не давайте дорогих вещей, дети мелкого возраста теряют их в неимоверных количествах. Лагерь навыка – это не то место, где можно выделиться шмотками, дайте самое просто из вещей.</p>
					<p>Уважаемые родители, во всех без исключения сменах обязательно находится несколько детей, обувь которых абсолютно не соответствует условиям проведения программы. БОЛЬШУЮ ЧАСТЬ ВРЕМЕНИ МЫ ПРОВОДИМ НА УЛИЦЕ, и там не очищенный от снега асфальт!</p>
				</div>
			</div>
			<div class="place">
				<div class="head"><span>Место проведения</span></div>
				<div class="content">
					<div id="place-map"></div>
					<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=cMaesNNr-Pbg8a3DazJQ6ITWFhHkTTY3&id=place-map&lang=ru_RU&sourceType=constructor"></script>
				</div>
			</div>
		</div>
	</div>
	<div class="news block">
		<div class="head wrap"><span>Новости</span></div>
		<div class="content wrap">
			<div class="content-list clear">
				@foreach($all_news as $news)
					<div class="item">
						<div class="content">
							<div class="image">
								@if($news->image == '')
									<div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" alt="" width="340" height="127"></div>
								@else
									<div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $news->image }}" alt="" width="340" height="127"></div>
								@endif
							</div>
							<div class="head"><a href="{{web_url()}}/news/{{$news->id}}"><span>{{ $news->title }}</span></a></div>
							<div class="text">
								<span>{{ $news->description }}</span>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@stop