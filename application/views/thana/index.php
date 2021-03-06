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
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>home"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url() ?>user">Thana</a></li>
        </ol>
    </section>
    <br/>





    <!-- Start Working area --> 
    <div class="col-md-8 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>

        <div class="searchbar " >
            <div class="col-md-8"  >
            </div>

            <div class="pull-right"> 
                <a href="<?php echo base_url() ?>thana/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> Add Thana</a> 
            </div>
            <div class="clearfix"></div>
        </div> 

        <div>

            <table class="table table-bordered table-hover ">
                <tr>
                    <th id="action_btn_align">SL</th>
                    <th id="action_btn_align">Thana Name</th>
                    <th id="action_btn_align">District Name</th>
                    <th id="action_btn_align">Disvision Name</th>
                    <th id="action_btn_align">Executive Name</th>
                    <th id="action_btn_align">Action</th>
                </tr>




                <?php

                $serialNo = $this->uri->segment(3);
                if($serialNo==FALSE) $serialNo=1;
                else $serialNo += 1;
                foreach ($thana_info as $thana) { ?>

                    <tr id="action_btn_align">
                        <td> <?php echo $serialNo; ?></td>
                        <td> <?php echo $thana['thana_name'] ?></td>
                        <td> <?php echo $thana['district_name'] ?></td>
                        <td> <?php echo $thana['division_name'] ?></td>
                        <td> <?php echo $thana['executive_name'] ?></td>
                        <td>     
                            <a class="btn btn-primary btn-flat" href="<?php echo base_url(); ?>thana/edit/<?php echo $thana['id'] ?>">
                                <i class="fa fa-pencil-square-o" ></i> Edit </a>
                            <a class="btn btn-danger btn-flat "  onclick="return confirm('Are you sure want to delete');" href="<?php echo base_url(); ?>thana/delete/<?php echo $thana['id'] ?>">
                                <i class="fa fa-pencil-square-o" ></i> Delete </a>
                        </td>     
                    </tr>
                <?php $serialNo ++;} ?>

                <div class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>

            </table> 

            <div class="pagination">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>

        <!-- End  Working area --> 
        <?php $this->load->view('common/footer') ?>