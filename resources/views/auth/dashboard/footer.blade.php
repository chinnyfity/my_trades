<div class="footer">
            <div class="copyright">
                <p>Copyright © Microfinance Trades 2022</p>
            </div>
        </div>
		

	</div>





	
	
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/global/global.min.js"></script>
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/chart.js/Chart.bundle.min.js"></script>

	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/apexchart/apexchart.js"></script>
	<!-- <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/flot/jquery.flot.js"></script>
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/flot/jquery.flot.pie.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/flot/jquery.flot.resize.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/flot-spline/jquery.flot.spline.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/js/plugins-init/flot-init.js"></script> -->
	
    <!-- <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/peity/jquery.peity.min.js"></script> -->

	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/peity/jquery.peity.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/js/plugins-init/piety-init.js"></script>
	
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/owl-carousel/owl.carousel.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/js/custom.min.js"></script>
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/js/deznav-init.js"></script>
	<script src="{{ url('/') }}/{{$folder}}dashboard_files/js/demo.js"></script>

	<script src="{{ url('/') }}/{{$folder}}js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/{{$folder}}js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}js/dataTables.bootstrap4.min.js"></script>

	<script src="{{ url('/') }}/{{$folder}}js/jscripts.js"></script>


	@php
	$columns = "";

	if($page_name == "transactions"){
		$columns = "
		{data: 'status', name: 'status'},
		{data: 'trans_type', name: 'trans_type'},
		{data: 'receiver_addr', name: 'receiver_addr'},
		{data: 'amt_usd', name: 'amt_usd'},
		//{data: 'action', name: 'action'},
		{data: 'decline_reason', name: 'decline_reason'},
		{data: 'notes', name: 'notes'},
		{data: 'date_created', name: 'date_created'},";
	}

	if($page_name == "orders"){
		$columns = "
		{data: 'cus_id', name: 'cus_id'},
		{data: 'prod_id', name: 'prod_id'},
		{data: 'paid', name: 'paid'},
		{data: 'order_no', name: 'order_no'},
		{data: 'total_price', name: 'total_price'},
		{data: 'total_taji', name: 'total_taji'},
		{data: 'isShip', name: 'isShip'},
		{data: 'notes', name: 'notes'},
		{data: 'date_created', name: 'date_created'},
		{data: 'action', name: 'action', orderable: true, searchable: true},";
	}
	@endphp
        
    <script>
        //if(page_names == "orders") page_names = "myOrders";
        var page_names1 = page_name+"_";
        //alert(page_names1)
        var table = $('#products, #transactions').DataTable({
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


	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/621f720a1ffac05b1d7c983f/1ft5dav0i';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
</body>

</html>