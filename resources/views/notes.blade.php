<!-- resources/views/notes.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Note-To-Myself : Notes</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Laravel Font -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<!-- Notes Style -->
	<link href="css/notes.min.css" rel="stylesheet" type="text/css" />

	<!-- Captcha Style -->
	<!-- include the BotDetect layout stylesheet -->
 @if (class_exists('CaptchaUrls'))
	 <link href="{{ CaptchaUrls::LayoutStylesheetUrl() }}" type="text/css"
		 rel="stylesheet">
 @endif

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="pencil.ico" />
	<script type="text/javascript">
		function openInNew(textbox) {
			window.open(textbox.value);
			this.blur();
		}
	</script>
</head>

<body>
	<div id="wrapper" class="container">

		<form action="notes/{{ Auth::user()->id }}" enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
			<?php echo csrf_field(); ?>
			<h2 id="header">{{ auth()->user()-> email }} - <span><a href="{{ URL::to('auth/logout') }}">Log out</a></span></h2>

			@if (Session::has('error'))
	        <div class="alert alert-danger">{{ Session::get('error') }}</div>
	    @endif

				<div id="notes-column" class="col-md-3">
					<h2>Notes</h2>
					<textarea id="notes" name="notes" />{{$user->notes}}</textarea>
				</div>

				<div id="websites-column" class="col-md-3">
					<h2>Websites</h2>
					<h3>click to open</h3>
					@foreach($sites as $ws => $website)
						<input type="text" name="websites[]" value="{{ $website->websites }}" onClick="openInNew(this)"/>
						<br>
					@endforeach
						<input type="text" name="websites[]" onClick="openInNew(this)"/>
						<input type="text" name="websites[]" onClick="openInNew(this)"/>
						<input type="text" name="websites[]" onClick="openInNew(this)"/>
						<input type="text" name="websites[]" onClick="openInNew(this)"/>
				</div>

			<div id="images-column" class="col-md-3">
				<h2>Images</h2>
				<h3>click for full size</h3>
				<!-- <textarea cols="16" rows="40" id="image" name="image" /></textarea> -->
				<input type="file" name="i" />

				<div>
					<!-- 125px by 70px -->
					@foreach($picture as $key => $val)
						<input type="hidden" name="image_id" value="{{$val->id}}">
						<a href='{{(string) Image::make($val->picture)->encode('data-url')}}'>
							<img src='{{(string) Image::make($val->picture)->resize(125,70)->encode('data-url')}}'/>
						</a>
						<input type='checkbox' name="delete[]" value="{{$val->id}}"/>
						<label for='delete'>delete</label>
					@endforeach
					<br />
					<br />
				</div>
			</div>

			<div id="tbd-column" class="col-md-3">
				<h2>To Be Determined</h2>
				<textarea id="tbd" name="tbd" />{{$user->tbd}}</textarea>
			</div>

			<div id="submitArea" class="col-md-7 col-md-offset-5">
				<input type="submit" value="Save" name="submit" id="submit" />
			</div>
		</form>
	</div>

	<script>
		function openInNew(url) {
			var win = window.open(url.getAttribute('value'), '_blank');
			win.focus();
		}
	</script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
