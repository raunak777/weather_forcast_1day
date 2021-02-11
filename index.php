<!DOCTYPE html>
<html>
<head>
	<title>Wheather Report</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Select2 CSS --> 
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Select2 JS --> 
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<style type="text/css">
		.search{
			background-color: #a8324e;
			width: 300px;
			height: 150px;
			margin-top: 5%;
			margin-left: 35%;
			border-radius: 5px;
		}
		#getval{
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="search" style="text-align: center;"><br><br>
	<select id='country' style="width: 200px;">
		<option value=''>Select City</option> 
	</select><br>
	<input type='button' class="btn btn-primary" id="getval" value="Get">
	</div>
	<div id="weather">
		<h2> <span id="city"></span> [<span id="coun"></span>]</h2>
		<h3><span id="report"></span></h3>
		<h4>Temperature: <span id="temp"></span> &deg;C</h4>
		<h4>Wind Speed: <span id="wind"></span> Km/h</h4>
		<h4>Longitude:<span id="long"></span><br><br> Latitude: <span id="lati"></span></h4>
	</div>
</body>
<script type="text/javascript">
	$(function(){
		$("#country").select2();
		$.ajax({
			type:"GET",
			url:"citylist.json",
			dataType:"json",
			success: data=>{
				for (var i = 0; i < data.length; i++) {
					if (data[i]['country']=='IN') {
						$("#country").append("<option value="+data[i]['id']+">"+data[i]['name']+"</option>");
					}
				}
			}
		});

		$("#getval").click(()=>{
			var city = $('#country option:selected').val();
			$.ajax({
				type: "POST",
				url: "curl.php",
				dataType: "json",
				data: {city},
				success: data=>{
					console.log(data);
					$("#city").html(data['name']);
					$("#temp").html(data['main']['temp']);
					$("#coun").html(data['sys']['country']);
					$("#wind").html(data['wind']['speed']);
					$("#long").html(data['coord']['lon']);
					$("#lati").html(data['coord']['lat']);
					$("#report").html(data['weather']['0']['main']);
				}
			});
		});
		
	});
</script>

</html>