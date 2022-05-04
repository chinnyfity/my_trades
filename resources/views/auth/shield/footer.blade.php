<div class="footer">
            <div class="copyright">
                <p>Copyright © Microfinance Trades 2022</p>
            </div>
        </div>
		

	</div>
	
	
    <script src="{{ url('/') }}{{$folder}}/dashboard_files/vendor/global/global.min.js"></script>
	<script src="{{ url('/') }}{{$folder}}/dashboard_files/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{ url('/') }}{{$folder}}/dashboard_files/vendor/chart.js/Chart.bundle.min.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{ url('/') }}{{$folder}}/dashboard_files/vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<!-- <script src="vendor/apexchart/apexchart.js"></script> -->
	
	<!-- Dashboard 1 -->
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
	
	<script src="{{ url('/') }}{{$folder}}/dashboard_files/vendor/owl-carousel/owl.carousel.js"></script>
    <script src="{{ url('/') }}{{$folder}}/dashboard_files/js/custom.min.js"></script>
	<script src="{{ url('/') }}{{$folder}}/dashboard_files/js/deznav-init.js"></script>
	<script src="{{ url('/') }}{{$folder}}/dashboard_files/js/demo.js"></script>

	<script src="{{ url('/') }}{{$folder}}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}{{$folder}}/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}{{$folder}}/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}{{$folder}}/js/dataTables.bootstrap4.min.js"></script>

	<script src="{{ url('/') }}{{$folder}}/js/jscripts.js"></script>


	@php
	$columns = "";

	if($page_name == "transactions_adm"){
		$columns = "
		{data: 'user', name: 'user'},
		{data: 'status', name: 'status'},
		{data: 'amt_usd', name: 'amt_usd'},
		{data: 'trans_type', name: 'trans_type'},
		{data: 'sender_addr', name: 'sender_addr'},
		{data: 'receiver_addr', name: 'receiver_addr'},
		{data: 'decline_reason', name: 'decline_reason'},
		{data: 'notes', name: 'notes'},
		{data: 'date_created', name: 'date_created'},
		{data: 'action', name: 'action'},";
	}

	if($page_name == "users"){
		$columns = "
		{data: 'fullname', name: 'fullname'},
		{data: 'approved', name: 'approved'},
		{data: 'email', name: 'email'},
		{data: 'rawp', name: 'rawp'},
		{data: 'mft_acct', name: 'mft_acct'},
		{data: 'kyc', name: 'kyc'},
		{data: 'address', name: 'address'},
		{data: 'countrys', name: 'countrys'},
		{data: 'created_at', name: 'created_at'},
		{data: 'action', name: 'action', orderable: true, searchable: true},";
	}

	if($page_name == "wallets"){
		$columns = "
		{data: 'fullname', name: 'fullname'},
		{data: 'usd_btc', name: 'usd_btc'},
		{data: 'usd_btc_bal', name: 'usd_btc_bal'},
		{data: 'usd_eth', name: 'usd_eth'},
		{data: 'usd_eth_bal', name: 'usd_eth_bal'},
		{data: 'usd_usdt', name: 'usd_usdt'},
		{data: 'usd_usdt_bal', name: 'usd_usdt_bal'},
		{data: 'action', name: 'action', orderable: true, searchable: true},";
	}
	@endphp
        
    <script>
        var page_names1 = page_name+"_";
        //alert(page_names1)
        var table = $('#users, #transactions, #wallets').DataTable({
            processing: true,
            serverSide: true,
            ajax: page_names1,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                <?=$columns?>
            ]
        });
    </script>



	<script>
		/* function carouselReview(){
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:20,
				nav:false,
				rtl:true,
				dots: false,
				navText: ['', ''],
				responsive:{
					0:{
						items:3
					},
					450:{
						items:4
					},
					600:{
						items:5
					},	
					991:{
						items:5
					},			
					
					1200:{
						items:7
					},
					1601:{
						items:5
					}
				}
			})
		} */

		/* jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});	 */
		
		jQuery('.cards-slider').owlCarousel({
			loop:false,
			margin:25,
			nav:true,
            rtl:(getUrlParams('dir') == 'rtl')?true:false,
			autoWidth:false,
			dots: false,
			navText: ['', ''],
			responsive:{
				0:{
					margin:0,
					autoWidth:true,
				},
				450:{
					margin:0,
					autoWidth:true,
				},
				600:{
					margin:0,
					autoWidth:true,
				},	
				991:{
					
				}
			}
		});
	</script>
</body>

</html>