<div id="tym_sidebar">
	<div id="tym_sidebar_holder">
		<div id="tym_sidebar_transactions"></div>
		<div id="tym_sidebar_menu_box">
			<ul class="menu_list">
				<li class="first"><a href='<?php echo $base."expenses"; ?>'>Expenses</a></li>
				<?php
				if($this->session->userdata('banking_flag')) {
					?>
					<li><a href='<?php echo $base."withdraw"; ?>'>Withdraw Money</a></li>
					<?php
				}
				?>
				<li><a href='<?php echo $base."money"; ?>'>Add Cycle Money</a></li>
				<li class="last"><a href='<?php echo $base."cycle"; ?>'>Next Cycle</a></li>
			 </ul>
		</div>
	</div>
	<div id="tym_sidebar_holder">
		<div id="tym_sidebar_setup"></div>
		<div id="tym_sidebar_menu_box">
			<ul class="menu_list">
				<li class="first"><a href='<?php echo $base."category"; ?>'>Categories</a></li>
				<li class="last"><a href='<?php echo $base."resources"; ?>'>Resources</a></li>
			</ul>
		</div>
	</div>
</div>