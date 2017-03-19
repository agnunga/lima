<?php require_once ("../includes/header.php"); ?>
<div class = "modal fade" id="new_user_registration" role = "dialog" data-backdrop = "false" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-sm" style="width: 450px; margin: 20% auto; ">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times;
                </button>
                <h4 style="text-align: center;">New job seeker Registration</h4>
            </div>
            <div class = "modal-body">

                <form id="new_user_reg" class="form-horizontal" method="post" action="#">
                    <?php
                    $users->regisrer_new();
                    ?>
                    <fieldset>
                        <div class="my_control_inp_row">
                            <label>Name (First and last name)</label>
                            <div>
                                <style>
                                    .my_inp_names{
                                        width: 49%;
                                        line-height: 28px;
                                        padding: 2px 5px 2px 5px;
                                        border: 1px solid lightgray;
                                        border-radius: 4px;
                                    }
                                    .my_control_inp_row{
                                        margin: 7px 0 6px 0;
                                    }
                                    .my_inp_natid{
                                        width: 30%;
                                        line-height: 28px;
                                        padding: 2px 5px 2px 5px;
                                        border: 1px solid lightgray;
                                        border-radius: 4px;
                                    }
                                    .my_inp_email{
                                        width: 68%;
                                        line-height: 28px;
                                        padding: 2px 5px 2px 5px;
                                        border: 1px solid lightgray;
                                        border-radius: 4px;
                                    }
                                </style>
                                <input class="my_inp_names" type="text" name="fname"  required placeholder="First name"/>
                                <input class="my_inp_names" type="text" name="lname" required placeholder="Lastst name"/>
                            </div>
                        </div>

                        <div>
                            <label>National ID.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email </label>
                            <div>
                                <input class="my_inp_natid" type="text" name="natid"  placeholder="ID Number" maxlength="8" size="8" required/>

                                <input class="my_inp_email" type="email" name="email"  placeholder="email eg emailname@example.com" required/>
                            </div>
                        </div>
                        <div class="my_control_inp_row">
                            <label>Gender:&nbsp;</label>
                            <input type="radio" name="sex" value="M" required>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="F">Female
                        </div>

                        <div class="my_control_inp_row">
                            <label>Date of Birth:</label> &nbsp;&nbsp;
                            <input type="text" id="user_yob" readonly required name="dob">
                        </div>  

                        <div class="my_control_inp_row">
                            <label>Passwords (Password and Confirmation)</label>
                            <div>
                                <input class="my_inp_names" type="password" name="pwd" required placeholder="Password"/>
                                <input class="my_inp_names" type="password" name="cpwd" required placeholder="Confirm password"/>
                            </div>
                        </div>

                        <input id="reg" class="btn" type="submit" name="reg" value="Register"/>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>