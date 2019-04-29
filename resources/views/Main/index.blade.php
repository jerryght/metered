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
