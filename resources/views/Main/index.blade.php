@extends('Public.MainFrame')
@section('content')
    <link href="{{ URL::asset('css/style_plus.css') }}" rel="stylesheet" />
    <!-- start: Content -->
    <div id="content" class="span10">


        <div class="row-fluid">
            <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
                <div class="boxchart-overlay blue">
                    <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
                </div>
                <span class="title">地区代码</span>
                <span class="value acode"></span>
            </div>

            <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
                <div class="boxchart-overlay red">
                    <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
                </div>
                <span class="title">日期</span>
                <span class="value cur-date"></span>
            </div>

            <div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
                <i class="icon-download-alt green"></i>
                <span class="title">操作系统</span>
                <span class="value system">$1 999,99</span>
            </div>

            <div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
                <i class="icon-money yellow"></i>
                <span class="title">Shanghai</span>
                <span class="value">$19 999,99</span>
            </div>

        </div>


        <div class="row-fluid">
            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->

            <div id="world_population" class="main-chart" style="height:349px;"></div>
            <!--<div id="main" class="span6" style="height:400px;"></div>-->
        </div>

        <div class="row-fluid">

            <div class="span6" ontablet="span12" ondesktop="span6">

                <div class="row-fluid">
                    <div class="span12 multi-stat-box box">
                        <div class="header row-fluid">
                            <div class="left">
                                <h2>Land top</h2>
                                <a class="icon-chevron-down"></a>
                            </div>
                            <div class="right">
                                <h2 class="text-center">World Ranking of Territorial Areas</h2>
                            </div>
                        </div>
                        <div class="content row-fluid">
                            <div class="left">
                                <style>
                                    #height16>li{
                                        height:16px;
                                    }
                                    #container{
                                        padding:0 0 0 20px;
                                    }
                                </style>
                                <ul id="height16">
                                    @foreach($land as $value)
                                        <li>
                                            <span class="date">{{$value['country']}}</span>
                                            <span class="value">{{$value['area']}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="right">
                                <div class="multi-stat-box-chart" id="area" style="height:180px; width: 90%; padding: 10px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="box blue span12 noMarginLeft">
                        <div class="box-header">
                            <h2><i class="icon-bar-chart"></i>Weekly Stat</h2>
                            <div class="box-icon">
                                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="chart-type1" style="height:170px"></div>
                        </div>
                    </div><!--/span-->

                </div>

            </div>

            <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
                <div class="box-content">
                    <div id="container" class="chart-type2" style="height:256px;"></div>

                    <div class="verticalChart">

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                        <div class="singleBar">

                            <div class="bar">

                                <div class="value">
                                </div>

                            </div>

                            <div class="title"></div>

                        </div>

                    </div>
                    <div class="clearfix"></div>

                </div>

            </div><!--/span-->

        </div>

        <div class="row-fluid">

            <div class="span7" ontablet="span12" ondesktop="span7">

                <div class="row-fluid">

                    <div class="box calendar span12">
                        <div class="calendar-details">
                            <div class="day">World Ranking of Territorial Areas</div>
                            <div class="date">2017</div>
                            <ul class="events">
                                <li>MAY 22, 19:30 Meeting</li>
                                <li>MAY 22, 19:30 Meeting</li>
                            </ul>
                            <div class="add-event">
                                <i class="icon-plus"></i>
                                <input type="text" class="new event" value="" />
                            </div>
                        </div>
                        <div class="calendar-small"></div>
                        <div id='main' class="clearfix"></div>
                    </div><!--/span-->

                </div>

                <div class="row-fluid">

                    <div class="span6 smallchart blue box mobileHalf">

                        <div class="title">Account balance</div>

                        <div class="content">

                            <div class="chart-stat">
                                <span class="chart white">7,3,2,6,6,3,9,0,1,4</span>
                            </div>

                        </div>

                        <div class="value">$19 999,99</div>

                    </div>

                    <div class="span6 smallchart red box mobileHalf">

                        <div class="title">Weekly revenue</div>

                        <div class="content">

                            <div class="chart-stat">
                                <span class="chart white">5,8,3,9,2,5,6,2,2,5</span>
                            </div>

                        </div>

                        <div class="value">$1 849,99</div>

                    </div>

                </div>

            </div>


            <div class="box chat alt span5 noMargin" ontablet="span12" ondesktop="span5">

                <div class="contacts">
                    <ul class="list">
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar.jpg') }}" alt="avatar" />
                            <span class="name">Łukasz Holeczek</span>
                            <span class="status online"></span>
                            <span class="important">4</span>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar2.jpg') }}" alt="avatar" />
                            <span class="name">Łukasz Holeczek</span>
                            <span class="status offline"></span>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar3.jpg') }}" alt="avatar" />
                            <span class="name">Łukasz Holeczek</span>
                            <span class="status busy"></span>
                        </li>
                    </ul>
                </div>
                <div class="conversation">
                    <div class="actions">
                        <img class="avatar" src="{{ URL::asset('img/avatar.jpg') }}" alt="avatar" />
                        <img class="avatar" src="{{ URL::asset('img/avatar3.jpg') }}" alt="avatar" />
                        <img class="avatar" src="{{ URL::asset('img/avatar4.jpg') }}" alt="avatar" />
                    </div>
                    <ul class="talk">
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar3.jpg') }}" alt="avatar" />
                            <span class="name">Ann Kovalsky</span>
                            <span class="time">1:32PM</span>
                            <div class="message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar4.jpg') }}" alt="avatar" />
                            <span class="name">Megan Abbott</span>
                            <span class="time">1:32PM</span>
                            <div class="message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar3.jpg') }}" alt="avatar" />
                            <span class="name">Ann Kovalsky</span>
                            <span class="time">1:32PM</span>
                            <div class="message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar.jpg') }}" alt="avatar" />
                            <span class="name">Łukasz Holeczek</span>
                            <span class="time">1:32PM</span>
                            <div class="message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </li>
                        <li>
                            <img class="avatar" src="{{ URL::asset('img/avatar4.jpg') }}" alt="avatar" />
                            <span class="name">Megan Abbott</span>
                            <span class="time">1:32PM</span>
                            <div class="message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </li>
                    </ul>
                    <div class="form">
                        <input type="text" class="write-message" placeholder="Write Message" />
                    </div>
                </div>

            </div>

        </div>

        <div class="row-fluid">

            <div class="box span8" ontablet="span12" ondesktop="span8">
                <div class="box-header">
                    <h2>tickets</h2>
                </div>
                <div class="box-content" style="height:308px">
                    <div class="span12" style="height:308px"></div>
                </div>
            </div>

            <div class="box span4 noMargin" ontablet="span12" ondesktop="span4">
                <div class="box-header">
                    <h2><i class="icon-check"></i>To Do List</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="todo">
                        <ul class="todo-list">
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">Windows Phone 8 App</span>
                                <span class="label label-important">today</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">New frontend layout</span>
                                <span class="label label-important">today</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">Hire developers</span>
                                <span class="label label-warning">tommorow</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">Windows Phone 8 App</span>
                                <span class="label label-warning">tommorow</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">New frontend layout</span>
                                <span class="label label-success">this week</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">Hire developers</span>
                                <span class="label label-success">this week</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">New frontend layout</span>
                                <span class="label label-info">this month</span>
                            </li>
                            <li>
									<span class="todo-actions">
										<a href="#"><i class="icon-check-empty"></i></a>
									</span>
                                <span class="desc">Hire developers</span>
                                <span class="label label-info">this month</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="row-fluid">

            <div class="span12 discussions">

                <ul>

                    <li>
                        <div class="author">
                            <img src="{{ URL::asset('img/avatar.jpg') }}" alt="avatar" />
                        </div>

                        <div class="name">Łukasz Holeczek</div>
                        <div class="date">Today, 1:08 PM</div>
                        <div class="delete"><i class="icon-remove"></i></div>

                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                        </div>

                        <ul>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar3.jpg') }}" alt="avatar" />
                                </div>
                                <div class="name">Ann Kovalsky</div>
                                <div class="date">Today, 1:08 PM</div>
                                <div class="delete"><i class="icon-remove"></i></div>

                                <div class="message">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                </div>

                            </li>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar6.jpg') }}" alt="avatar" />
                                </div>
                                <div class="name">Megan Abbott</div>
                                <div class="date">Today, 1:08 PM</div>
                                <div class="delete"><i class="icon-remove"></i></div>

                                <div class="message">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                </div>
                            </li>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar.jpg') }}" alt="avatar" />
                                </div>
                                <textarea class="diss-form" placeholder="Write comment"></textarea>
                            </li>

                        </ul>

                    </li>

                    <li>
                        <div class="author">
                            <img src="{{ URL::asset('img/avatar9.jpg') }}" alt="avatar" />
                        </div>

                        <div class="name">Tom Allen</div>
                        <div class="date">Today, 1:08 PM</div>
                        <div class="delete"><i class="icon-remove"></i></div>

                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                        </div>

                        <ul>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar2.jpg') }}" alt="avatar" />
                                </div>
                                <div class="name">Katie Moss</div>
                                <div class="date">Today, 1:08 PM</div>
                                <div class="delete"><i class="icon-remove"></i></div>

                                <div class="message">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                </div>

                            </li>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar4.jpg') }}" alt="avatar" />
                                </div>
                                <div class="name">Anna Holn</div>
                                <div class="date">Today, 1:08 PM</div>
                                <div class="delete"><i class="icon-remove"></i></div>

                                <div class="message">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                </div>
                            </li>

                            <li>
                                <div class="author">
                                    <img src="{{ URL::asset('img/avatar9.jpg') }}" alt="avatar" />
                                </div>
                                <textarea class="diss-form" placeholder="Write comment"></textarea>
                            </li>

                        </ul>

                    </li>

                </ul>

            </div>

        </div>


    </div>
    <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script>
        function getOS() { // 获取当前操作系统
            var os;
            if (navigator.userAgent.indexOf('Android') > -1 || navigator.userAgent.indexOf('Linux') > -1) {
                os = 'Android';
            } else if (navigator.userAgent.indexOf('iPhone') > -1) {
                os = 'iOS';
            } else if (navigator.userAgent.indexOf('Windows') > -1) {
                os = 'Windows';
            } else {
                os = 'Others';
            }
            return os;
        }
        let acode = document.getElementsByClassName('acode')[0];
        acode.innerHTML = returnCitySN['cid'];
        let cur_date = document.getElementsByClassName('cur-date')[0];
        let d = new Date();
        cur_date.innerHTML = d.getFullYear()+'.'+(d.getMonth()+1)+'.'+d.getDate();
        let system = document.getElementsByClassName('system')[0];
        system.innerHTML = getOS();
    </script>
<script src="{{ URL::asset('js/echarts/echarts.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/map/js/china.js') }}" ></script>
<script src="{{ URL::asset('js/echarts/home.js') }}"></script>

    <!-- end: Content -->
    @endsection
