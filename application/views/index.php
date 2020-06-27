<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>

    <link href="<?= base_url() . 'assets/css/style.css'   ?>" rel="stylesheet" type="text/css">
    <script src="<?= base_url() . 'assets/js/jquery.js' ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <style>
        .error {
            color: red;
            font-size: 12px;
            font-weight: 700;
        }
    </style>
</head>

<body>


    <div class="page">
        <div class="container">
            <img class='cover_img' src="<?= base_url() . 'assets/img/img.jpg' ?>  ">
            <div class="content-wrap">
                <div class="head-wrap">
                    <p class="head">horiculture</p>
                    <p>About Us</p>
                    <p>Blog</p>
                    <p>Store</p>
                </div>


                <div class="form-wrap">
                    <p class="head-title"> Excotic plants tips,</p>
                    <p class="head-title">sent to your inbox daily.</p>

                    <!-- Form -->
                    <div id="registerform">
                        <form method="POST">
                            <div class="input-container">
                                <input id='uname' name='uname' value="<?= set_value('uname'); ?>" type="text" />
                                <?php echo form_error('uname', '<div class="error">', '</div>')  ?>
                                <label>User Name</label>
                            </div>
                            <div class="input-container">
                                <input id="email" name='email' value="<?= set_value('email'); ?>" type="email" />
                                <?php echo form_error('email', '<div id=`email_result` class="error">', '</div>') ?>
                                <span id="email_error"></span>

                                <label>Email</label>
                            </div>

                            <div class="input-container">
                                <input name="pass" id="pass" type="password" style='text-transform:uppercase' />
                                <?php echo form_error('pass', '<div class="error">', '</div>') ?>
                                <label>Password</label>
                            </div>

                            <p class="txt">One email a day -unsubsribe any time with one click</p>
                            <div class="btn-wrap">
                                <button id="submit" type="submit" name='submit'>Send OTP</button>
                                <p class="txt">Terms & Conditons | Privacy Policy</p>
                            </div>
                        </form>
                    </div>
                    <!--//form  -->

                    <!-- otp -->
                    <!-- <div id="otpform">
                        <form method="POST">
                            <div class="input-container secondbox">
                                <input id='otp' name='otp' value="<?= set_value('otp'); ?>" type="number" />
                                <span id="er"></span>
                                <label>OTP</label>
                                <?php echo $this->session->userdata('session_id'); ?>
                            </div>
                            <div class="btn-wrap secondbox">
                                <button id="otpbtn" type="submit" name='submit'>Verify OTP</button>
                            </div>
                        </form>
                    </div> -->
                    <!-- //otp -->
                </div>
            </div>

        </div>
        <br /><br /><br /><br />
    </div>

</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#email').change(function() {
            var email = $('#email').val();

            if (email != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>User/check_email",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $('#email_error').html(data);
                    }
                })
            }
        })
    });




    // $('#submit').click(function(event) {
    //     var uname = $('#uname').val();
    //     var email = $('#email').val();
    //     var pass = $('#pass').val();
    //     $('#registerform').hide();
    //     $('#otpform').show();
    //     alert(uname + email + pass);
    //     $.ajax({
    //         url: "<?php echo base_url(); ?>User/index",
    //         type: 'POST',
    //         data: {
    //             'uname': uname,
    //             'email': email,
    //             'pass': pass
    //         },

    //         success: function(result) {
    //             if (result == 'exist') {
    //                 $('#registerform').hide();
    //                 $('#otpform').show();
    //             }
    //             if (result == 'not_exist') {
    //                 $('#registerform').hide();
    //                 $('#otpform').show();
    //             }
    //         }
    //     })
    // });


    // otp
</script>
<style>
    #otpform {
        display: none
    }
</style>