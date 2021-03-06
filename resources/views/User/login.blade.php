<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8" />
	<title>SimpliQ - Flat & Responsive Bootstrap Admin Template</title>
	<meta name="description" content="SimpliQ - Flat & Responsive Bootstrap Admin Template." />
	<meta name="author" content="Łukasz Holeczek" />
	<meta name="keyword" content="SimpliQ, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina" />
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('css/style.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('css/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('css/retina.css') }}" rel="stylesheet" />
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<!-- <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> -->
		<link id="ie-style" href="{{ URL::asset('css/ie.css') }}" rel="stylesheet">
	<!--[endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="{{ URL::asset('css/ie9.css') }}" rel="stylesheet">
	<!--[endif]-->
	
	<!-- start: Favicon and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('ico/apple-touch-icon-144-precomposed.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('ico/apple-touch-icon-114-precomposed.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('ico/apple-touch-icon-72-precomposed.png') }}" />
	<link rel="apple-touch-icon-precomposed" href="{{ URL::asset('ico/apple-touch-icon-57-precomposed.png') }}" />
	<link rel="shortcut icon" href="{{ URL::asset('ico/favicon.png') }}" />
	<!-- end: Favicon and Touch Icons -->	
		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<h2>Login to your account</h2>
					<form class="form-horizontal" action="index.html" method="post" />
						<fieldset>
							
							<input class="input-large span12" name="username" id="username" type="text" placeholder="username" />

							<input class="input-large span12" name="password" id="password" type="password" placeholder="password" />

							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							
							<div class="clearfix"></div>
							
							<button type="submit" class="btn btn-primary span12">Login</button>
						</fieldset>	

					</form>
					<hr />
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div>
			</div><!--/row-->
			
				</div><!--/fluid-row-->
				
	</div><!--/.fluid-container-->

	<!-- start: JavaScript-->
		<script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ URL::asset('js/modernizr.js') }}"></script>
		<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.cookie.js') }}"></script>
		<script src='js/fullcalendar.min.js'></script>	
		<script src='js/jquery.dataTables.min.js'></script>
		<script src="{{ URL::asset('js/excanvas.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.flot.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.flot.pie.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.flot.stack.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.flot.resize.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.flot.time.js') }}"></script>
		
		<script src="{{ URL::asset('js/jquery.chosen.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.uniform.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.cleditor.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.noty.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.elfinder.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.raty.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.iphone.toggle.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.uploadify-3.1.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.gritter.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.imagesloaded.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.masonry.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.knob.modified.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.sparkline.min.js') }}"></script>
		<script src="{{ URL::asset('js/counter.min.js') }}"></script>
		<script src="{{ URL::asset('js/raphael.2.1.0.min.js') }}"></script>
	<script src="{{ URL::asset('js/justgage.1.0.1.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.autosize.min.js') }}"></script>
		<script src="{{ URL::asset('js/retina.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.placeholder.min.js') }}"></script>
		<script src="{{ URL::asset('js/wizard.min.js') }}"></script>
		<script src="{{ URL::asset('js/core.min.js') }}"></script>
		<script src="{{ URL::asset('js/charts.min.js') }}"></script>
		<script src="{{ URL::asset('js/custom.min.js') }}"></script>
	<!-- end: JavaScript-->
	

</body>
</html>