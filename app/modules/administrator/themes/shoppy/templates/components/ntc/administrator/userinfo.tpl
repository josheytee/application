<!-- user info -->
<div class="profile_details">
    <ul>
        <li class="dropdown profile_details_drop">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img">
                    <span class="prfil-img">
                        <img src="{$picture|default:"/application/app/modules/administrator/themes/shoppy/images/p1.png"}"
                             alt="">
                    </span>
                    <div class="user-name">
                        <p>{$name|default:"&nbsp;"}</p>
                        <span>{$role|default : ""}</span>
                    </div>
                    <i class="fa fa-angle-down lnr"></i>
                    <i class="fa fa-angle-up lnr"></i>
                    <div class="clearfix"></div>
                </div>
            </a>
            <ul class="dropdown-menu drp-mnu">
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- user info -->
