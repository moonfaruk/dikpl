<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?> 

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top:-10px!important;">
	<h1>
	    Reports : 
	    <small> Donation Distribution Report  </small>
	</h1>
	<ol class="breadcrumb">
	    <li><a href="<?php echo base_url() ?>home"><i class="fa fa-home"></i> Home</a></li>
	    <li><a href="<?php echo base_url() ?>report"><i class="fa "></i> Report</a></li>
	    <li class="active"><a href="#">Donation Distribution Report  </a></li>
	</ol>
    </section>
    <br/>


    <!--     Start Working area  -->


    <div class="col-md-12 main-mid-area">
	<?php $this->load->view('common/error_show') ?>

	<div class="row">
	    <?php echo form_open() ?>
	    <label class="col-md-3">Start Date
		<input type="text" class="datepicker form-control" id="sdate" name="sdate" placeholder="yyyy-mm-dd"   />
	    </label>
	    <label class="col-md-3">End Date
		<input type="text" class="datepicker form-control" id="edate" name="edate" placeholder="yyyy-mm-dd"  />
	    </label>
	    <label class="col-md-3">Division
		<select class="form-control" id="division_id" name="division_id" required="">
		    <option value="all">All Division</option>
		    <?php foreach ($division_list as $value) { ?>
    		    <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?></option>>
		    <?php } ?>
		</select>
	    </label>
	    <label class="col-md-3">Jonal
		<select class="form-control" id="jonal_id" name="jonal_id" >
		    <option value="all">All Jonal</option>
		</select>
	    </label>
	    <label class="col-md-3">District
		<select class="form-control" id="district_id" name="district_id" >
		    <option value="all">All District</option>
		</select>
	    </label>
	    <label class="col-md-3">Thana
		<select class="form-control" id="thana_id" name="thana_id" >
		    <option value="all">All Thana</option>
		</select>
	    </label>
	    <label class="col-md-3">College
		<select class="form-control" id="college_id" name="college_id" >
		    <option value="all">All College</option>
		</select>
	    </label>
	    <label class="col-md-2">
		&nbsp;
		<input type="submit" name="sumbit" value="Search" class="btn btn-primary form-control" />
	    </label>
	    <br/>
	    <br/>
	    <?php echo form_close() ?>
	</div>
	<div class="text-center">
	    <h3> Donation Distribution Report </h3>
	    <div> From <?php echo date('d-m-y', strtotime($sdate)) ?>  to <?php echo date('d-m-y', strtotime($edate)) ?>  </div>
	    <?php if (!empty($division_info)) { ?>
    	    <h4> Division :  <?php echo $division_info->name ?>  </h4>
	    <?php } else echo "<div> All Division </div>"; ?> 
	    <?php if (!empty($jonal_info)) { ?>
    	    <h4> Jonal :  <?php echo $jonal_info->name ?>  </h4>
	    <?php } else echo "<div> All Jonal </div>"; ?> 
	</div>
	<?php if (!empty($content_list)) { ?> 
    	<div class="clearfix"></div>
    	<br><br>
    	<table class="table table-bordered table-hover">
    	    <thead>
    		<tr>
    		    <th  style="text-align: center">#</th>
    		    <th  style="text-align: center">তারিখ</th>
    		    <th style="text-align: center">এমপিও এর নাম </th>
    		    <th  style="text-align: center">প্রতিষ্ঠানের নাম</th>
    		    <th  style="text-align: center">শিক্ষকের নাম</th>
    		    <th  style="text-align: center">বিষয়ের নাম</th>
    		    <th  style="text-align: center">শ্রেনীর নাম</th>
    		    <th  style="text-align: center">ছাত্র ছাত্রীর সংখ্যা</th>
    		    <th  style="text-align: center">সম্ভাব্য বই চলবে</th>
    		    <th  style="text-align: center">বইয়ের নাম</th>
    		    <th  style="text-align: center">টাকার পরিমান</th>


    		</tr>
    	    </thead>
    	    <tbody>
		    <?php
		    $serialNo = 1;
		    foreach ($content_list as $value) {
			?>
			<tr  style="text-align: center">
			    <td><?php echo $serialNo; ?></td>
			    <td><?php echo $value['date']; ?></td>
			    <td><?php echo $value['user_name']; ?></td>
			    <td><?php echo $value['college_name']; ?></td>
			    <td><?php echo $value['teacher_name']; ?></td>
			    <td><?php echo $value['department_name']; ?></td>
			    <td><?php echo $value['class_name']; ?></td>
			    <td><?php echo $value['student_quantity']; ?></td>
			    <td><?php echo $value['possible_book']; ?></td>
			    <td><?php echo $value['book_name']; ?></td>
			    <td><?php echo $value['money_amount']; ?></td>
			</tr>
			<?php
			$serialNo++;
		    }
		    ?>
    	    </tbody>

    	</table>
	<?php } else { ?>
    	<br/> 
    	<br/> 
    	<br/> 
    	<br/> 
    	<div class="alert alert-danger text-center">
    	    No data Found! 
    	</div>
	<?php } ?>
    </div>

    <!-- End  Working area -->

    <script>


        $(document).ready(function () {
            $('.datepicker').datepicker({
                KeyboardNavigation: false,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose: true

            });
        })

        $(document).ready(function () {
            $(".main-mid-area").on('change', '#division_id', function () {
                var division_id = $(this).val();
//                console.log(division_id);
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/home/getjonal/" + division_id,
                    beforSend: function (xhr) {
                        xhr.overrideMimeType("Text/plain; charset=x-user-defined");
                        $("#jonal_id").html("<optoin>Loading...</option>");
                    }
                })
                        .done(function (data) {
                            $("#jonal_id").html("<option value=''>Select Jonal Name..</option>");
                            data = JSON.parse(data);
                            $.each(data, function (key, val) {
                                $("#jonal_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
                            })
                        })
            })
        })

        $(document).ready(function () {
            $(".main-mid-area").on('change', '#jonal_id', function () {
                var jonal_id = $(this).val();
//                console.log(jonal_id);
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/home/getdistrict/" + jonal_id,
                    beforSend: function (xhr) {
                        xhr.overrideMimeType("Text/plain; charset=x-user-defined");
                        $("#district_id").html("<option>Loading...</option>");
                    }
                })
                        .done(function (data) {
                            $("#district_id").html("<option value=''>Select District Name..</option>");
                            data = JSON.parse(data);
                            $.each(data, function (key, val) {
                                $("#district_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
                            })
                        })
            })
        })

        $(document).ready(function () {

            $(".main-mid-area").on('change', '#district_id', function () {
                var district_id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/getthana/" + district_id,
                    beforSend: function (xhr) {
                        xhr.overrideMimeType("Text/plain; charset=x-user-defined");
                        $("#thana_id").html("<option>Loading...</option>");
                    }
                })
                        .done(function (data) {
                            $("#thana_id").html(data);
                        })
            })

        })

        $(document).ready(function () {
            $(".main-mid-area").on('change', '#thana_id', function () {
                var thana_id = $(this).val();

                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/getcollege/" + thana_id,
                    beforSend: function (xhr) {
                        xhr.overrideMimeType("Text/plain; charset=x-user-defined");
                        $("#college_id").html("<option>Loading...</option>");
                    }
                })
                        .done(function (data) {
                            $("#college_id").html("<option value=''>Select College Name..</option>");
                            data = JSON.parse(data);
                            $.each(data, function (key, val) {
                                $("#college_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
                            })
                        })
            })
        })
    </script>


    <?php $this->load->view('common/footer') ?>