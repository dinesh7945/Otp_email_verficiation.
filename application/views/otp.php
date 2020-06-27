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

                    <!-- otp -->
                    <div id="otpform">
                        <form method="POST">
                            <div class="input-container secondbox">
                                <input id='otp' name='otp' value="<?= set_value('otp'); ?>" type="number" />
                                <span id="er"></span>
                                <label>OTP</label>
                                <!-- <?php echo $this->session->userdata('session_id'); ?> -->
                            </div>
                            <div class="btn-wrap secondbox">
                                <button id="otp_btn" type="submit" name='submit'>Verify OTP</button>
                            </div>
                        </form>
                    </div>
                    <!-- //otp -->
                </div>
            </div>

        </div>
        <br /><br /><br /><br />
    </div>

</body>

</html>