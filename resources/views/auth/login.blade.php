
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css?family=Average&display=swap" rel="stylesheet">
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		.background{
			position: relative;
			width: 100%;
		  	background:url('images/fullcalendar_bg_03.png');
		  	height: 100vh;
		}
		.background::after{
			content:'';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.75);
			z-index: 1;
		}
		.login-box{
			z-index: 2;
		    position: fixed;
		    right: 100px;
		    top: 250px;
		    width: 417px;
		    background-color: white;
		    font-family: 'Average', serif;
		    padding: 2.8rem;
		    border-radius: 5px;
		}
		.login-box h6{
			font-size: 28px;
			line-height: 1.6;
			font-weight: 500;
			/* margin:auto; */
			text-align: center;
			margin-bottom: 10px;
		}
		.login-box p{
			font-size: 18px;
			line-height: 1.6;
			margin-bottom: 23px;
		}
		.login-box .btnLogin{
			display: flex;
		    align-items: center;
		    text-decoration: none;
		    color: black;
		    border: 1px solid black;
		    width: 161px;
		    padding: 5px;
		    border-radius: 7px;
		    margin: auto;
		    margin-top: 10px;
		}
		
	</style>
</head>
<body>
	<div class="background">
	</div>
	<div class="login-box">
		<h6>Plan For Your Time</h6>
		<p>FullCalendar is an application inspried FullCalendar.io
		You can write down your events that you want to remember, and share them with other people
		</p>
			<a href="http://localhost/fullcalendar.io/public/redirect/google" 
	        class="btnLogin">
	        <svg width="25" height="25" class="ie if l"><g fill="none" fill-rule="evenodd"><path d="M20.66 12.7c0-.61-.05-1.19-.15-1.74H12.5v3.28h4.58a3.91 3.91 0 0 1-1.7 2.57v2.13h2.74a8.27 8.27 0 0 0 2.54-6.24z" fill="#4285F4"></path><path d="M12.5 21a8.1 8.1 0 0 0 5.63-2.06l-2.75-2.13a5.1 5.1 0 0 1-2.88.8 5.06 5.06 0 0 1-4.76-3.5H4.9v2.2A8.5 8.5 0 0 0 12.5 21z" fill="#34A853"></path><path d="M7.74 14.12a5.11 5.11 0 0 1 0-3.23v-2.2H4.9A8.49 8.49 0 0 0 4 12.5c0 1.37.33 2.67.9 3.82l2.84-2.2z" fill="#FBBC05"></path><path d="M12.5 7.38a4.6 4.6 0 0 1 3.25 1.27l2.44-2.44A8.17 8.17 0 0 0 12.5 4a8.5 8.5 0 0 0-7.6 4.68l2.84 2.2a5.06 5.06 0 0 1 4.76-3.5z" fill="#EA4335"></path></g></svg>
	        <span>Log in with Google</span>
        	</a>
    	
	</div>
</body>
</html>



