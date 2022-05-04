@include('auth.dashboard.header')

<div class="content-body mt--10 mt-sm-10 mt-xs-20">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 pl-xs-5 pr-xs-5">
				<div class="card">
					<div class="card-body pl-xs-10 pr-xs-10">
						<div id="profile-settings">
							<div class="settings-form mb-30 pt-5 pl-10 pr-10">
								<h3 class="text-light mt-0 mb-10">Our Investment Plans</h3>
								
								<div class="demo10">
									<div class="row">
										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">Starter</h3>
													<span class="price-value">
														200<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 200% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read blue cmd_choose" attr1="starter" attr2="200">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">Silver</h3>
													<span class="price-value">
														200<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 200% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read silver cmd_choose" attr1="silver" attr2="200">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">Gold</h3>
													<span class="price-value">
														250<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 250% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read gold cmd_choose" attr1="gold" attr2="250">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">Platinum</h3>
													<span class="price-value">
														400<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 400% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>

													<button class="read green cmd_choose" attr1="platinum" attr2="400">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">High Voltage</h3>
													<span class="price-value">
														300<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 300% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read yellow cmd_choose" attr1="voltage" attr2="300">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">Super</h3>
													<span class="price-value">
														350<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 350% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read orange cmd_choose" attr1="super" attr2="350">Choose</button>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-md-4 col-sm-6 pl-10 pr-10 mb-30 mb-md-10">
											<div class="pricingTable10">
												<div class="pricingTable-header">
													<h3 class="heading">RexCoins</h3>
													<span class="price-value">
														20<span class="currency">%</span>
														<span class="month">/week</span>
													</span>
												</div>
												<div class="pricing-content">
													<ul>
														<li>Weekly 20% ROI</li>
														<li>Professional Charts</li>
														<li>Trading Alerts</li>
													</ul>
													<button class="read blue cmd_choose" attr1="rexcoins" attr2="20">Choose</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('auth.dashboard.footer')