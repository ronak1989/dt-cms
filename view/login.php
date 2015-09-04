<!DOCTYPE html>
<html lang="en">
<?php
include_once _CONST_VIEW_PATH . 'header.php';
?>
<body style="background:#F7F7F7;">
    <div id="content" class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animate form">

                <section class="login_content">
                    <form method="post" action="/validate">
                        <h1>Login</h1>
                        <div>
                            <input type="email" class="form-control" placeholder="Username" name="login_userid" required="" pattern="[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$" title="Invalid Email-Id" />
                        </div>
                        <div>
                            <!--pattern="^.*(?=.{6,})(?=.*\d)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*[\W]).*$" title="Password can contain only Alphanumeric characters & need to have atleat one Uppercase Character, Lowercase Character & one digit"-->
                            <input type="password" class="form-control" placeholder="Password" name="login_password" required="" />
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Log In" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">Forgot Password?
                                <a href="#toregister" class="to_register"> Click here </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <p>&copy;2015 All Rights Reserved.</p>
                                <p>Browser support is targeted at <strong>IE9+, Google Chrome, Mozilla Firefox, Apple Safari, Opera and all Android and iOS mobile browsers</strong>. For browsers not in this list, support is not available.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form method="post" action="/reset-password">
                        <h1>Forgot Password</h1>
                        <div>
                            <input type="email" class="form-control" name="reset_userid" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Reset Password" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <p>&copy;2015 All Rights Reserved.</p>
                                <p>Browser support is targeted at <strong>IE9+, Google Chrome, Mozilla Firefox, Apple Safari, Opera and all Android and iOS mobile browsers</strong>. For browsers not in this list, support is not available.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>
<?php
include_once _CONST_VIEW_PATH . 'footer.php';
?>
</body>
</html>
