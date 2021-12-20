
<!-- HEADER DESKTOP-->
<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button pull-right">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <?php 
                                        $count_msgs = Database::getInstance()->count_msgs($user_id);
                                        if ($count_msgs > 0) { ?>
                                            <span class="quantity"><?php echo $count_msgs; ?></span>
                                       <?php }
                                        ?>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have <?php echo $count_msgs; ?> new message</p>
                                            </div>
                                            <?php 
                                                $messages = Database::getInstance()->show_messages_admin($user_id);
                                                foreach ($messages as $message) {
                                                    if ($message['status'] == 0) { 
                                                        $sender_name = Database::getInstance()->select_from_where2('users','a_user_id',$message['from_user']);
                                                        foreach ($sender_name as $user) { 
                                                            $sender_fn = $user['surname']." ".$user['middle_name']." ".$user['first_name'];
                                                            $sender_image = $user['image'];
                                                        }
                                                        ?>
                                                        <a class="mess__item" href="chat.php?id=<?php echo $message['from_user']; ?>">
                                                            <div class="image img-cir img-40">
                                                                <img src="../member/images/<?php echo $sender_image; ?>" alt="<?php echo $sender_fn; ?>" />
                                                            </div>
                                                            <div class="content">
                                                                <h6><?php echo $sender_fn; ?></h6>
                                                                <p>Sent You A Message</p>
                                                                <span class="time"><?php echo Database::getInstance()->time_elapsed_string($message['date_created']); ?></span>
                                                            </div>
                                                        </a>
                                                   <? }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <?php 
                                        $count_noti = Database::getInstance()->count_notifications_admin($user_id);
                                            if ($count_noti > 0) {
                                                ?>
                                                <span class="quantity"><?php echo $count_noti; ?></span>
                                                <?php
                                            }
                                        ?>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo Database::getInstance()->count_notifications_admin($user_id); ?> New Notifications</p>
                                            </div>
                                            <?php 
                                                $notifications =  Database::getInstance()->show_notification_admin($user_id);
                                                foreach ($notifications as $notification) {
                                                    if ($notification['status'] == 1) {
                                                        ?>
                                                            <div class="notifi__item" onclick="window.location='<?php echo $notification['link']; ?>'">
                                                                <div class="bg-c1 img-cir img-40">
                                                                    <i class="zmdi zmdi-email-open"></i>
                                                                </div>
                                                                <div class="content">
                                                                    <p><?php echo ucwords($notification['message']); ?></p>
                                                                    <span class="date"><?php echo $notification['date_added']; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    } else {
                                                        $link = (strpos($notification['link'],"?")) ? $notification['link'].'&id='.$notification['id'] : $notification['link'].'?id='.$notification['id'];
                                                        ?>
                                                    <div class="notifi__item" onclick="window.location='<?php echo $link; ?>'">
                                                        <div class="bg-c1 img-cir img-40">
                                                            <i class="zmdi zmdi-email-open"></i>
                                                        </div>
                                                        <div class="content">
                                                            <p><b><?php echo ucwords($notification['message']); ?></b></p>
                                                            <span class="date"><b><?php echo $notification['date_added']; ?></b></span>
                                                        </div>
                                                    </div>
                                                <?php
                                                    }
                                                    
                                                }
                                            ?>
<!--                                             
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg"/>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $fullname; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="<?php echo $fullname; ?>" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $fullname; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo Database::getInstance()->get_email_by_id($user_id); ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="account.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->