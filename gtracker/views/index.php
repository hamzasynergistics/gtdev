
<?php
foreach($graph as $g){
    $gold[]   = round($g['gold_rate'], 2);
//    $silver[] = round($g['silver_rate'], 2);
//    $plat[]   = round($g['platinum_rate'], 2);   
}
    
$codes = 'AEDAFNALLAMDANGAOAARSAUDAWGAZNBAMBBDBDTBGNBHDBIFBMDBNDBOBBRLBSDBTNBWPBYRBZDCADCDFCHFCLFCLPCNYCOPCRCCUPCVECZKDJFDKKDOPDZDEEKEGPETBEURFJDFKPGBPGELGHSGIPGMDGNFGTQGYDHKDHNLHRKHTGHUFIDRILSINRIQDIRRISKJEPJMDJODJPYKESKGSKHRKMFKPWKRWKWDKYDKZTLAKLBPLKRLRDLSLLTLLVLLYDMADMDLMGAMKDMMKMNTMOPMROMTLMURMVRMWKMXNMYRMZNNADNGNNIONOKNPRNZDOMRPABPENPGKPHPPKRPLNPYGQARRONRSDRUBRWFSARSBDSCRSDGSEKSGDSHPSLLSOSSRDSTDSVCSYPSZLTHBTJSTMTTNDTOPTRYTTDTWDTZSUAHUGXUSDUYUUZSVEFVNDVUVWSTYERZARZMKZMWZWL';
$split_codes = str_split($codes, 3);

?>

<div id="page">
	<header id="header" class="site-header">
		<nav id="navbar" class="site-navbar navbar navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars"></i> </button>
					<a href="https://itunes.apple.com/ae/app/personal-goldtracker/id714110397?mt=8" class="logo"> <img src="<?php echo base_url(); ?>assets/images/appstore.png" alt="logo" width="250"> </a> </div>
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
					<ul id="navigation" class="nav navbar-nav navbar-right">
						<li class="active"><a href="#header" class="current">Home</a></li>
						<li><a href="#features">How App works</a></li>
						<li><a href="#portfolio">Features</a></li>
						<li><a href="#testimonials">Reviews</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main id="main" class="site-main">
		<img src="<?php echo base_url(); ?>assets/images/img1.png" alt="banner image" class="banner-img">
		<section id="features" class="section section-center section-hilite section-features">
			<div class="container">
				<h2 class="section-title"><span>How App works?</span></h2>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img2.jpg" alt=""></div>
						<h4>Step 1</h4>
						<p>Click on Gold Section</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img3.jpg" alt=""></div>
						<h4>Step 2</h4>
						<p>Input your required values</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img4.jpg" alt=""></div>
						<h4>Step 3</h4>
						<p>See the results</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img5.jpg" alt=""></div>
						<h4>Step 4</h4>
						<p>Click on Silver Section, input your required values and see the result.</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img6.jpg" alt=""></div>
						<h4>Step 5</h4>
						<p>Click on Platinum Section, input your required values and see the result.</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="icon-wrap"><img src="<?php echo base_url(); ?>assets/images/img7.jpg" alt=""></div>
						<h4>Step 6</h4>
						<p>Tell your friend about latest Gold, Silver and Platinum prices.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="section section-graph">
			<div class="container">
				<h2 class="section-title"><span>Rates History Graph</span></h2>
				<ul class="currency-filter">
                                        <li class="active"><a href="#" data-metal="Gold">Gold</a></li>
					<li><a href="#" data-metal="Silver">Silver</a></li>
					<li><a href="#" data-metal="Platinum">Platinum</a></li>
				</ul>
				<div class="visual-graph"></div>
				<div class="graph-filters">
                                        <select name="currency" id="currency" class="currency-filter" onchange="graphFilter();">
                                            <?php foreach ($split_codes as $c) { ?>
                                                <option <?php if ($c == 'USD') { echo 'selected="selected"'; } ?> value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                            <?php } ?>
					</select>
					<ul class="history-filter">
						<li class="active"><a href="#" data-history="1">24h</a></li>
						<li><a href="#" data-history="3">3d</a></li>
						<li><a href="#" data-history="30">30d</a></li>
					</ul>
					<ul class="unit-filter">
						<li class="active"><a href="#" data-unit="ounce">Ounce</a></li>
						<li><a href="#" data-unit="gram">Gram</a></li>
						<li><a href="#" data-unit="kg">KG</a></li>
					</ul>
				</div>
			</div>
		</section>
		<section id="portfolio" class="section section-portfolio">
			<div class="container">
				<div class="updated-rates">
					<h2 class="section-title"><span>Latest Rates &amp; Calculator</span></h2>
					<div class="filter-area">
						<form class="filter-form">
							<div class="input-wrap">
								<label for="weight">Weight</label>
								<input type="number" min="0" id="weight" name="weight" value="1" onkeyup="loadRate();">
							</div>
							<div class="input-wrap">
								
								<label for="">Currency</label>
								<select id="cal_currency" onchange="loadRate();">
									<?php foreach($split_codes as $c){ ?>
									<option <?php if($c == 'USD'){ echo 'selected="selected"';} ?> value="<?php echo $c; ?>"><?php echo $c; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="input-wrap">
								<label for="units">Units</label>
								<select id="units" onchange="loadRate();">
									<option value="oz">Ounces</option>
									<option value="g">Grams</option>
									<option value="kg">KGs</option>
									<option value="tola">Ten Tola</option>
								</select>
							</div>
						</form>
					</div>
					<table class="latest-rates">
						<tbody>
							<tr class="heading-area">
								<td class="metal-name">&nbsp;</td>
								<td class="metal-ask">Ask</td>
								<td class="metal-bid">Bid</td>
							</tr>
							<tr class="gold-area">
								<td class="metal-name">Gold</td>
								<td class="metal-ask lt_g_ask"></td>
								<td class="metal-bid lt_g_bid"></td>
							</tr>
							<tr class="silver-area">
								<td class="metal-name">Silver</td>
								<td class="metal-ask lt_s_ask"></td>
								<td class="metal-bid lt_s_bid"></td>
							</tr>
							<tr class="platinum-area">
								<td class="metal-name">Platinum</td>
								<td class="metal-ask lt_p_ask"></td>
								<td class="metal-bid lt_p_bid"></td>
							</tr>
							<tr class="loader">
								<td><img src="<?php echo base_url(); ?>assets/images/loader.gif" /></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<section id="testimonials" class="section section-center section-hilite section-testimonial">
			<div class="container">
				<h2 class="section-title"><span>App Reviews</span></h2>
				<i class="fa fa-quote-left fa-3x"></i>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="item active">
							<blockquote>
								<p>Accurate fast information on prices and more.</p>
								<img src="<?php echo base_url(); ?>assets/images/5star.png" alt="5 stars" class="stars-rating" width="200"> <small>John<cite title="Source Title">Randell</cite></small> </blockquote>
						</div>
						<div class="item">
							<blockquote>
								<p>We've been using spot checker for 2 weeks. It is very helpful and easy to use. Very good tool! </p>
								<img src="<?php echo base_url(); ?>assets/images/5star.png" alt="5 stars" class="stars-rating" width="200"> <small>Edge of <cite title="Source Title">Vine</cite></small> </blockquote>
						</div>
						<div class="item">
							<blockquote>
								<p>Very good app for real time Gold rates</p>
								<img src="<?php echo base_url(); ?>assets/images/5star.png" alt="5 stars" class="stars-rating" width="200"> <small> Peter <cite title="Source Title"> Foronda </cite></small> </blockquote>
						</div>
					</div>
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"> <img src="<?php echo base_url(); ?>assets/images/img9.jpg" width="64" height="64" alt="" class="img-circle"> </li>
						<li data-target="#carousel-example-generic" data-slide-to="1"> <img src="<?php echo base_url(); ?>assets/images/img10.jpg" width="64" height="64" alt="" class="img-circle"> </li>
						<li data-target="#carousel-example-generic" data-slide-to="2"> <img src="<?php echo base_url(); ?>assets/images/img11.jpg" width="64" height="64" alt="" class="img-circle"> </li>
					</ol>
				</div>
			</div>
		</section>
		<section id="contact" class="section section-center section-contact">
			<div class="container">
				<h2 class="section-title"><span>Contact Us</span></h2>
				<p>Want to say hello? Want to know more about us? Give us a call or drop us an email and we will get back to you as soon as we can.</p>
				<div class="main-action">
					<form method="post" action="<?php echo base_url(); ?>gold/contactUs" name="contactform" id="contactform">
						<div class="results"></div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="sr-only">Message</label>
									<textarea name="message" class="form-control" placeholder="Message" style="height: 181px" rows="6" required></textarea>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="sr-only">Subject</label>
									<input name="subject" type="text" class="form-control" placeholder="Subject" required>
								</div>
								<div class="form-group">
									<label class="sr-only">Name</label>
									<input name="username" type="text" class="form-control" placeholder="Name" required>
								</div>
								<div class="form-group">
									<label class="sr-only">Email</label>
									<input name="email" type="email" class="form-control" placeholder="Email" required>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 no-padding">
									<button id="submit" type="submit" class="btn btn-default btn-block">Send</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>
	<div class="iphone-popup">
	<div class="details-area">
		<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="app logo" class="app-icon">
		<div class="text-area">
			<h2>Use the <span class="device-name">&nbsp;</span> App!</h2>
			<p>It's faster and way more fun.</p>
		</div>
	</div>
	<a href="https://itunes.apple.com/bw/app/personal-goldtracker/id714110397?mt=8" class="btn-get">Get</a>
</div>
</div>
<script>
$(document).ready(function(){
	$.ajax({
		url : "<?php echo base_url(); ?>gold/xmlDataLoad",
		success : function(data){
			$(".latest-rates .loader").hide();
			var a = $.parseJSON(data);
			$('.lt_g_ask').text('$'+parseFloat(a.gold_ask).toFixed(2));
			$('.lt_g_bid').text('$'+parseFloat(a.gold_bid).toFixed(2));
			$('.lt_s_ask').text('$'+parseFloat(a.silver_ask).toFixed(2));
			$('.lt_s_bid').text('$'+parseFloat(a.silver_bid).toFixed(2));
			$('.lt_p_ask').text('$'+parseFloat(a.plat_ask).toFixed(2));
			$('.lt_p_bid').text('$'+parseFloat(a.plat_bid).toFixed(2));
		}
	});
});

function loadRate(){
	var wt    = $('#weight').val();
	var unit  = $('#units').val();
	var curr  = $('#cal_currency').val();
	$(".latest-rates .loader").show();
	
	$.ajax({
		type : "POST",
		data : {
			weight : wt,
			unit : unit,
			curr : curr
		},
		url : "<?php echo base_url(); ?>gold/xmlData",
		success : function(data){
			$(".latest-rates .loader").hide();
			var a = $.parseJSON(data);
			$('.lt_g_ask').html(parseFloat(a.gold_ask).toFixed(2));
			$('.lt_g_bid').html(parseFloat(a.gold_bid).toFixed(2));
			$('.lt_s_ask').html(parseFloat(a.silver_ask).toFixed(2));
			$('.lt_s_bid').html(parseFloat(a.silver_bid).toFixed(2));
			$('.lt_p_ask').html(parseFloat(a.plat_ask).toFixed(2));
			$('.lt_p_bid').html(parseFloat(a.plat_bid).toFixed(2));
		}
	});
}

var gold = <?php echo json_encode($gold); ?>;

$(".history-filter li a, .currency-filter li a, .unit-filter li a").click(function(e){
	e.preventDefault();
	$(this).parent().addClass("active").siblings().removeClass('active');
	var metalName = $('.currency-filter li.active a').data("metal");
	var day = $('.history-filter li.active a').data("history");
	var cur = $('#currency').val();
        var unit = $('.unit-filter li.active a').data("unit");
        
        $.ajax({
            type: 'POST',
            data: {
                type : metalName,
                day : day,
                cur : cur,
                unit : unit,
            },
            url: "<?php echo base_url(); ?>gold/graphRate/",
            success: function (data) {
                var a = $.parseJSON(data);
                loadGraph(metalName, a, cur);                
            }                        
        });  
});

function graphFilter(){
    var metalName = $('.currency-filter li.active a').data("metal");
    var day = $('.history-filter li.active a').data("history");
    var cur = $('#currency').val();
    var unit = $('.unit-filter li.active a').data("unit");
    
    $.ajax({
        type: 'POST',
        data: {
            type : metalName,
            day : day,
            cur : cur,
            unit : unit,
        },
        url: "<?php echo base_url(); ?>gold/graphRate/",
        success: function (data) {
            var a = $.parseJSON(data);
            loadGraph(metalName, a, cur);                
        }                        
    });   
}



loadGraph("Gold", gold, 'USD');

function loadGraph(dataName, vals, currency) {  
    
	$('.visual-graph').highcharts({
		chart: {type: 'line'},
		title: {text: 'Rates History Graph'},
		subtitle: {text: 'This is subtitle'},
		xAxis: { categories: [], tickmarkPlacement: 'on', title: { enabled: false } },
		yAxis: { 
			title: { text: 'Rate per Ounce' },
			labels: {
				formatter: function () { return this.value; }
			}
		},
		tooltip: { shared: true, valueSuffix: currency },
		plotOptions: {
			area: {
				stacking: 'normal',
				lineColor: '#666666',
				lineWidth: 1,
				marker: {
					lineWidth: 1,
					lineColor: '#666666'
				}
			}
		},
		series: [{
			name: dataName,
			data : vals
		}]
	});
}
</script>