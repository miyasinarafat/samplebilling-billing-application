<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="items">
        <ul class="nav menu">
            <?
            if ($_SESSION['Login_data']['is_admin'] == 1){
            ?>
            <li><a href="index.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked dashboard-dial">
                        <use xlink:href="#stroked-dashboard-dial"></use>
                    </svg>
                    Users List</a></li>
                <li><a href="trash-item.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                        <svg class="ticon glyph stroked basket ">
                            <use xlink:href="#stroked-basket"></use></svg>
                    Trash Users List</a></li>
            <li><a href="add-user.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked male-user">
                        <use xlink:href="#stroked-male-user"></use>
                    </svg>
                    Add new user</a></li>
            <li><a href="money-request.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked app window with content">
                        <use xlink:href="#stroked-app-window-with-content"></use>
                    </svg>
                    Money Request</a></li>
            <? } ?>
            <li><a href="profile.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked male-user">
                        <use xlink:href="#stroked-male-user"></use>
                    </svg>
                    Profile</a></li>
            <?
            if ($_SESSION['Login_data']['is_admin'] == 0){
            ?>
            <li><a href="request-money.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked app-window">
                        <use xlink:href="#stroked-app-window"></use>
                    </svg>
                    Request Money</a></li>
            <? } ?>
            <li><a href="transaction-history.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked clipboard with paper">
                        <use xlink:href="#stroked-clipboard-with-paper"></use>
                    </svg>
                    Transaction History</a></li>
            <li><a href="logout.php?id=<? echo $_SESSION['Login_data']['unique_id'];?>">
                    <svg class="glyph stroked cancel">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use>
                    </svg>
                    Logout</a></li>
            <li role="presentation" class="divider"></li>
            <li class="developby">Develop by <a href="//themeyellow.com">ThemeYellow</a></li>
        </ul>
    </div>


</div><!--/.sidebar-->